<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Member;
use App\Models\Tmpimg;
use App\Models\Product;
use App\Models\Review;
use App\Models\Product_category;
use App\Models\Product_subcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Administer;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::orderBy('id', 'desc')->paginate(10);
        return view('admin.product.search')
            ->with(compact('products'));
    }
    public function search(Request $request)
    {
        $id = $request->id;
        $free_word = $request->free_word;
        // ddd(url()->full);

        if(!isset($id)&&!isset($free_word)){
            session()->forget('order');
            session()->put('order', 'desc');
            return redirect()->route('admin.product');
        }
        // \DB::enableQueryLog();
        $products = Product::adminsearch($id, $free_word)->orderBy('id', 'desc')->paginate(10);
        session()->forget('order');
        session()->put('order', 'desc');
        return view('admin.product.search')
            ->with(compact('products'));
    }
    public function orderDesc(Request $request)
    {
        $id = $request->id;
        $free_word = $request->free_word;
        // \DB::enableQueryLog();
        $url = Product::adminsearch($id, $free_word);
        $products = $url->orderBy('id', 'desc')->paginate(10);
        // ddd(\DB::getQueryLog());
        session()->forget('order');
        session()->put('order', 'desc');
        return view('admin.product.search')
            ->with(compact('products'));
    }
    public function orderAsc(Request $request)
    {
        $id = $request->id;
        $free_word = $request->free_word;
        // \DB::enableQueryLog();
        $url = Product::adminsearch($id,$free_word);
        $products = $url->orderBy('id', 'asc')->paginate(10);
        // ddd(\DB::getQueryLog());
        session()->forget('order');
        session()->put('order', 'asc');
        return view('admin.product.search')
            ->with(compact('products'));
    }
    public function create()
    {
        $categories = Product_category::all();
        $subcategories = Product_subcategory::all();
        return view('admin.product.create_or_edit')
        ->with(compact('categories', 'subcategories'));;
    }
    public function edit(Product $product)
    {
        $image_1 = Tmpimg::where('path', $product->image_1)->first();
        $image_2 = Tmpimg::where('path', $product->image_2)->first();
        $image_3 = Tmpimg::where('path', $product->image_3)->first();
        $image_4 = Tmpimg::where('path', $product->image_4)->first();
        $categories = Product_category::all();
        $subcategories = Product_subcategory::all();
        return view('admin.product.create_or_edit')
            ->with(compact('product', 'categories', 'subcategories', 'image_1'));
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
    public function createStore(Request $request)
    {
        // Log::info('admin.product.create.store');
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
            ->route('admin.product.create.confirm');
    }
    public function editStore(Request $request, Product $product)
    {
        $max = Product_category::all()->count();
        $sub_max = Product_subcategory::where('product_category_id', $request->category)->count();
        if(!empty(Tmpimg::find($request->image_1_id))){
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
            ->route('admin.product.edit.confirm', $product);
    }
    public function createConfirm()
    {
        $data = session()->all();

        $category = Product_category::where('id', $data['category'])->first();
        $subcategory = Product_subcategory::where('id', $data['subcategory'])->first();
        // ddd($subcategory->name);
        return view('admin.product.confirm')
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
    public function editConfirm(Product $product)
    {
        $data = session()->all();

        $category = Product_category::where('id', $data['category'])->first();
        $subcategory = Product_subcategory::where('id', $data['subcategory'])->first();
        return view('admin.product.confirm')
            ->with([
                'product' => $product,
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
    public function createSend(Request $request)
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
            ->route('admin.product');
    }
    public function editSend(Request $request, Product $product)
    {
        $id = auth()->user()->id;
        Product::where('id', $product->id)->update([
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
            ->route('admin.product');
    }

    public function show(Product $product)
    {
        $categories = Product_category::all();
        $subcategories = Product_subcategory::all();
        $reviews = Review::where('product_id', $product->id)->paginate(3);
        return view('admin.product.show')
            ->with(compact('product', 'reviews', 'categories', 'subcategories'));
    }
    public function delete(Product $product)
    {
        Product::where('id', $product->id)->delete();
        return redirect()->route('admin.product');
    }
}
