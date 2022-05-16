<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Product_category;
use App\Models\Product_subcategory;
use App\Models\Tmpimg;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Validator;
use Illuminate\Support\Facades\DB;


class ProductController extends Controller
{
    public function create()
    {
        $categories = Product_category::all();
        $subcategories = Product_subcategory::all();
        return view('products.create')
            ->with([
                'categories' => $categories,
                'subcategories' => $subcategories
            ]);
    }
    public function back_page()
    {
        $data = session()->all();
        $categories = Product_category::all();
        $subcategories = Product_subcategory::all();
        return view('products.create')
            ->with([
                'categories' => $categories,
                'subcategories' => $subcategories,
                'name' => $data['name'],
                'ses_category' => $data['category'],
                'ses_subcategory' => $data['subcategory'],
                'image_1' => $data['image_1'],
                'image_2' => $data['image_2'],
                'image_3' => $data['image_3'],
                'image_4' => $data['image_4'],
                'image_1_id' => $data['image_1_id'],
                'image_2_id' => $data['image_2_id'],
                'image_3_id' => $data['image_3_id'],
                'image_4_id' => $data['image_4_id'],
                'explain' => $data['explain']
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
        $validator = Validator::make($request->all(), [
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:10485'
        ]);
        if($validator->passes()){
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
        } else {
            return response()->json(
                [
                    'error' => $validator->errors()->all()
                ]
            );
        }
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
    public function getImagePath($id)
    {
        if ($id === null) {
            return null;
        }
        $path = Tmpimg::find($id)->path;
        return  $path;
    }
    public function product_store(Request $request)
    {
        // 商品名とカテゴリーのバリデーション
        $max = Product_category::all()->count();
        $sub_max = Product_subcategory::where('product_category_id', $request->category)->count();
        if(session()->has('image_1')){
            $path_1 = $this->getImagePath($request->image_1_id);
        } else {
            $path_1 = $this->moveImageToPublic($request->image_1_id);
        }
        if(session()->has('image_2')){
            $path_2 = $this->getImagePath($request->image_2_id);
        } else {
            $path_2 = $this->moveImageToPublic($request->image_2_id);
        }
        if(session()->has('image_3')){
            $path_3 = $this->getImagePath($request->image_3_id);
        } else {
            $path_3 = $this->moveImageToPublic($request->image_3_id);
        }
        if(session()->has('image_4')){
            $path_4 = $this->getImagePath($request->image_4_id);
        } else {
            $path_4 = $this->moveImageToPublic($request->image_4_id);
        }
        session()->put([
            'image_1' => $path_1,
            'image_2' => $path_2,
            'image_3' => $path_3,
            'image_4' => $path_4,
            'image_1_id' => $request->image_1_id,
            'image_2_id' => $request->image_2_id,
            'image_3_id' => $request->image_3_id,
            'image_4_id' => $request->image_4_id,
        ]);
        // ddd(session()->get('image_1'));
        $request->validate([
        'name' => 'required|max:100',
        'category' => 'integer|not_in:0|between:1,5',
        'subcategory' => 'integer|not_in:0|between:1,25',
            'explain' => 'required|max:500',
        ], [
            'name.required' => '商品名は必須です',
            'name.max' => '商品名は100文字以内で入力してください',
            'category.not_in' => 'カテゴリーを選択してください',
            'category.integer' => 'カテゴリーを正しく選択してください',
            'category.between' => 'カテゴリーを正しく選択してください',
            'subcategory.not_in' => 'サブカテゴリーを選択してください',
            'subcategory.integer' => 'サブカテゴリーを正しく選択してください',
            'subcategory.between' => 'サブカテゴリーを正しく選択してください',
            'explain.required' => '商品説明は必須です',
            'explain.max' => '商品説明は500文字以内で入力してください',
        ]);
        $request->session()->put([
            'name' => $request->name,
            'category' => $request->category,
            'subcategory' => $request->subcategory,
            'explain' => $request->explain,
            'image_1' => $path_1,
            'image_2' => $path_2,
            'image_3' => $path_3,
            'image_4' => $path_4,
            'image_1_id' => $request->image_1_id,
            'image_2_id' => $request->image_2_id,
            'image_3_id' => $request->image_3_id,
            'image_4_id' => $request->image_4_id,
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
                'image_3' => $data['image_3'],
                'image_4' => $data['image_4'],
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
            'product_content' => $request['explain']
        ]);

        // 二重登録防止
        $request->session()->regenerateToken();
        session()->forget('name');
        session()->forget('category');
        session()->forget('subcategory');
        session()->forget('image_1');
        session()->forget('image_1_id');
        session()->forget('image_2');
        session()->forget('image_2_id');
        session()->forget('image_3');
        session()->forget('image_3_id');
        session()->forget('image_4');
        session()->forget('image_4_id');
        session()->forget('explain');
        return redirect()
            ->route('search.index');
    }


    // 商品検索ぺーじ
    public function search_index()
    {
        $products = Product::orderBy('id', 'desc')->paginate(10);
        $categories = Product_category::all();
        $subcategories = Product_subcategory::all();
        return view('products.search')
            ->with([
                'index' => 'index',
                'products' => $products,
                'categories' => $categories,
                'subcategories' => $subcategories,
            ]);
    }
    public function search(Request $request)
    {

        // Log::info('product.search');
        // カテゴリ選択用
        $categories = Product_category::all();
        $subcategories = Product_subcategory::all();
        $category_id = $request->category;
        $subcategory_id = $request->subcategory;
        $free_word = $request->free_word;
        // カテゴリ、サブカテゴリ、フリーワード（全て）
        if(!empty($category_id) && !empty($subcategory_id) && !empty($free_word))
        {
            $products = Product::where('product_category_id', $category_id)
                ->where('product_subcategory_id', $subcategory_id)
                ->where(function($query)use($free_word){
                    $query->where('name', 'like', '%'.$free_word.'%')
                        ->orWhere('product_content', 'like', '%'.$free_word.'%');})
                ->orderBy('id', 'desc')
                ->paginate(10);
            // 商品レビュー計算（仮）
            
            return view('products.search')
                    ->with([
                        'categories' => $categories,
                        'subcategories' => $subcategories,
                        'products' => $products
                    ]);
        // カテゴリ、サブカテゴリ
        } elseif(!empty($category_id) && !empty($subcategory_id) && empty($free_word))
        {
            $products = Product::where('product_category_id', $category_id)
                ->where('product_subcategory_id', $subcategory_id)
                ->orderBy('id', 'desc')
                ->paginate(10);
            return view('products.search')
                    ->with([
                        'categories' => $categories,
                        'subcategories' => $subcategories,
                        'products' => $products
                    ]);
        // カテゴリのみ(subcategory==0)
        } elseif(!empty($category_id) && $subcategory_id == 0 && empty($free_word))
        {
            $products = Product::where('product_category_id', $category_id)
                ->orderBy('id', 'desc')
                ->paginate(10);
            return view('products.search')
                    ->with([
                        'categories' => $categories,
                        'subcategories' => $subcategories,
                        'products' => $products
                    ]);
        // フリーワードのみ
        } elseif($category_id == 0 && $subcategory_id == 0 && !empty($free_word))
        {
            $products = Product::where('name', 'like', '%'.$free_word.'%')
                    ->orWhere('product_content', 'like', '%'.$free_word.'%')
                    ->orderBy('id', 'desc')
                    ->paginate(10);
            return view('products.search')
                    ->with([
                        'categories' => $categories,
                        'subcategories' => $subcategories,
                        'products' => $products
                    ]);
        } elseif($category_id == 0 && $subcategory_id == 0 && empty($free_word))
        {
            $products = Product::orderBy('id', 'desc')->paginate(10);
            return view('products.search')
                    ->with([
                        'categories' => $categories,
                        'subcategories' => $subcategories,
                        'products' => $products
                    ]);
        }

        // 商品詳細
    }
        public function show(Product $product)
        {
            $categories = Product_category::all();
            $subcategories = Product_subcategory::all();
            return view('products.show')
                ->with([
                    'product' => $product,
                    'categories' => $categories,
                    'subcategories' => $subcategories
                ]);
        }


}
