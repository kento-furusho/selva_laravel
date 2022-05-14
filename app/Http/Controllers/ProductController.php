<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Product_category;
use App\Models\Product_subcategory;
use App\Models\Tmpimg;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;


class ProductController extends Controller
{
    public function create()
    {
        $categories = Product_category::all();
        return view('products.create')
            ->with([
                'categories' => $categories
            ]);
    }
    // サブカテゴリー取得
    public function get_subcategory(Request $request)
    {
        $subcategories = Product_subcategory::where('product_category_id', $request->category_id)->get();
        return(['subcategories' => $subcategories]);
    }

    // 画像データ受け取り
    public function store_image(Request $request)
    {
        // Log::info('store.image');
        // 受け取り
        $img = $request->file('image');
         // storage/app/img に画像本体を保存
        $path = $img->store('images');
        // tmpimgテーブルに画像パスを入れ、idを取得
        $tmpimg = Tmpimg::create([
            'path' => $path
        ]);
        return response()->json(
            [
                'id' => $tmpimg->id,
                'path' => $path
            ]
        );
    }
    // 画像をパブリック下に移動し、IDからpathを取得
    public function moveImageToPublic($id)
    {
        if ($id === null) {
            return null;
        }
        $path = Tmpimg::find($id)->path;
        // ddd($path);
        Storage::move($path, 'public/' . $path);

        return  $path;
    }
    public function product_store(Request $request)
    {
        // 商品名とカテゴリーのバリデーション
        $max = Product_category::all()->count();
        $sub_max = Product_subcategory::where('product_category_id', $request->category)->count();
        $request->validate([
            'name' => 'required|max:100',
            'category' => 'integer|not_in:0|between:1,5',
            'subcategory' => 'integer|not_in:0|between:1,25',
        ], [
            'name.required' => '商品名は必須です',
            'name.max' => '商品名は100文字以内で入力してください',
            'category.not_in' => 'カテゴリーを選択してください',
            'category.integer' => 'カテゴリーを正しく選択してください',
            'category.between' => 'カテゴリーを正しく選択してください',
            'subcategory.not_in' => 'サブカテゴリーを選択してください',
            'subcategory.integer' => 'サブカテゴリーを正しく選択してください',
            'subcategory.between' => 'サブカテゴリーを正しく選択してください',
        ]);

        $path_1 = $this->moveImageToPublic($request->image_1_id);
        $path_2 = $this->moveImageToPublic($request->image_2_id);
        // $path_1 = $this->moveImageToPublic($request->image_1_id);
        // $path_1 = $this->moveImageToPublic($request->image_1_id);
        $request->session()->put([
            'name' => $request->name,
            'category' => $request->category,
            'subcategory' => $request->subcategory,
            'image_1' => $path_1,
            'image_2' => $path_2,
            'explain' => $request->explain
        ]);

        return redirect()
            ->route('product.confirm');
    }


    public function product_confirm()
    {
        $data = session()->all();

        $category = Product_category::where('id', $data['category'])->first();
        $subcategory = Product_subcategory::where('id', $data['subcategory'])->first();
        // ddd($subcategory->name);
        return view('products.confirm')
            ->with([
                'name' => $data['name'],
                'category_id' => $data['category'],
                'category' => $category->name,
                'subcategory_id' => $data['subcategory'],
                'subcategory' => $subcategory->name,
                'image_1' => $data['image_1'],
                'image_2' => $data['image_2'],
                'explain' => $data['explain']
            ]);
    }

    public function product_send(Request $request)
    {
        $id = auth()->user()->id;
        Product::create([
            'member_id' => $id,
            'product_category_id' => $request['category_id'],
            'product_subcategory_id' => $request['subcategory_id'],
            'name' => $request['name'],
            'image_1' => $request['image_1'],
            'image_2' => $request['image_2'],
            'image_3' => $request['image_3'],
            'image_4' => $request['image_4'],
            'product_content' => $request['product_content']
        ]);

        // 二重登録防止
        $request->session()->regenerateToken();

        return redirect()
            ->route('member.index');
    }


}
