<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Member;
use App\Models\Product_category;
use App\Models\Product_subcategory;
use Illuminate\Http\Request;
use App\Models\Administer;
use App\Models\Product;
use Illuminate\Support\Facades\Log;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Product_category::orderBy('id', 'desc')->paginate(10);
        return view('admin.category.search')
            ->with(compact('categories'));
    }
    public function search(Request $request)
    {
        $id = $request->id;
        $free_word = $request->free_word;

        if(!isset($id)&&!isset($free_word)){
            session()->forget('order');
            session()->put('order', 'desc');
            return redirect()->route('admin.category');
        }

        \DB::enableQueryLog();
        $categories = Product_category::search($id, $free_word)->orderBy('id', 'desc')->paginate(10);
        // ddd(\DB::getQueryLog());
        session()->forget('order');
        session()->put('order', 'desc');
        return view('admin.category.search')
            ->with(compact('categories'));
    }
    public function orderDesc(Request $request)
    {
        $id = $request->id;
        $free_word = $request->free_word;
        $categories = Product_category::search($id, $free_word)->orderBy('id', 'desc')->paginate(10);
        session()->forget('order');
        session()->put('order', 'desc');
        return view('admin.category.search')
            ->with(compact('categories'));
    }
    public function orderAsc(Request $request)
    {
        $id = $request->id;
        $free_word = $request->free_word;
        $categories = Product_category::search($id, $free_word)->orderBy('id', 'asc')->paginate(10);
        session()->forget('order');
        session()->put('order', 'asc');
        return view('admin.category.search')
            ->with(compact('categories'));
    }
    public function create()
    {
        return view('admin.category.create_or_edit');
    }
    public function edit(Product_category $product_category)
    {
        return view('admin.category.create_or_edit')
            ->with(compact('product_category'));
    }
    public function createStore(Request $request)
    {
        $request->validate([
            'product_category' => 'required|max:20',
            'subcategory_1' => 'required|max:20',
            'subcategory_2' => 'max:20',
            'subcategory_3' => 'max:20',
            'subcategory_4' => 'max:20',
            'subcategory_5' => 'max:20',
            'subcategory_6' => 'max:20',
            'subcategory_7' => 'max:20',
            'subcategory_8' => 'max:20',
            'subcategory_9' => 'max:20',
            'subcategory_10' => 'max:20',
        ], [
            'product_category.required' => '※商品大カテゴリーは必須です',
            'product_category.max' => '※商品大カテゴリーは20文字以内で入力してください',
            'subcategory_1.required' => '※商品小カテゴリーは必須です',
            'subcategory_1.max' => '※商品小カテゴリーは20文字以内で入力してください',
            'subcategory_2.max' => '※商品小カテゴリーは20文字以内で入力してください',
            'subcategory_3.max' => '※商品小カテゴリーは20文字以内で入力してください',
            'subcategory_4.max' => '※商品小カテゴリーは20文字以内で入力してください',
            'subcategory_5.max' => '※商品小カテゴリーは20文字以内で入力してください',
            'subcategory_6.max' => '※商品小カテゴリーは20文字以内で入力してください',
            'subcategory_7.max' => '※商品小カテゴリーは20文字以内で入力してください',
            'subcategory_8.max' => '※商品小カテゴリーは20文字以内で入力してください',
            'subcategory_9.max' => '※商品小カテゴリーは20文字以内で入力してください',
            'subcategory_10.max' => '※商品小カテゴリーは20文字以内で入力してください',
        ]);

        session()->put([
            'product_category' => $request->product_category,
            'subcategory_1' => $request->subcategory_1,
            'subcategory_2' => $request->subcategory_2,
            'subcategory_3' => $request->subcategory_3,
            'subcategory_4' => $request->subcategory_4,
            'subcategory_5' => $request->subcategory_5,
            'subcategory_6' => $request->subcategory_6,
            'subcategory_7' => $request->subcategory_7,
            'subcategory_8' => $request->subcategory_8,
            'subcategory_9' => $request->subcategory_9,
            'subcategory_10' => $request->subcategory_10,
        ]);

        return view('admin.category.confirm');
    }
    public function editStore(Request $request, Product_category $product_category)
    {
        $request->validate([
            'product_category' => 'required|max:20',
            'subcategory_1' => 'required|max:20',
            'subcategory_2' => 'max:20',
            'subcategory_3' => 'max:20',
            'subcategory_4' => 'max:20',
            'subcategory_5' => 'max:20',
            'subcategory_6' => 'max:20',
            'subcategory_7' => 'max:20',
            'subcategory_8' => 'max:20',
            'subcategory_9' => 'max:20',
            'subcategory_10' => 'max:20',
        ], [
            'product_category.required' => '※商品大カテゴリーは必須です',
            'product_category.max' => '※商品大カテゴリーは20文字以内で入力してください',
            'subcategory_1.required' => '※商品小カテゴリーは必須です',
            'subcategory_1.max' => '※商品小カテゴリーは20文字以内で入力してください',
            'subcategory_2.max' => '※商品小カテゴリーは20文字以内で入力してください',
            'subcategory_3.max' => '※商品小カテゴリーは20文字以内で入力してください',
            'subcategory_4.max' => '※商品小カテゴリーは20文字以内で入力してください',
            'subcategory_5.max' => '※商品小カテゴリーは20文字以内で入力してください',
            'subcategory_6.max' => '※商品小カテゴリーは20文字以内で入力してください',
            'subcategory_7.max' => '※商品小カテゴリーは20文字以内で入力してください',
            'subcategory_8.max' => '※商品小カテゴリーは20文字以内で入力してください',
            'subcategory_9.max' => '※商品小カテゴリーは20文字以内で入力してください',
            'subcategory_10.max' => '※商品小カテゴリーは20文字以内で入力してください',
        ]);

        session()->put([
            'product_category' => $request->product_category,
            'subcategory_1' => $request->subcategory_1,
            'subcategory_2' => $request->subcategory_2,
            'subcategory_3' => $request->subcategory_3,
            'subcategory_4' => $request->subcategory_4,
            'subcategory_5' => $request->subcategory_5,
            'subcategory_6' => $request->subcategory_6,
            'subcategory_7' => $request->subcategory_7,
            'subcategory_8' => $request->subcategory_8,
            'subcategory_9' => $request->subcategory_9,
            'subcategory_10' => $request->subcategory_10,
        ]);

        return view('admin.category.confirm')
            ->with(compact('product_category'));
    }
    public function createSend(Request $request)
    {
        $category = Product_category::create([
            'name' => $request->product_category
        ]);
        Product_subcategory::create([
            'product_category_id' => $category->id,
            'name' => $request->subcategory_1,
        ]);
        if(!empty($request->subcategory_2)) {
            Product_subcategory::create([
                'product_category_id' => $category->id,
                'name' => $request->subcategory_2,
            ]);
        }
        if(!empty($request->subcategory_3)) {
            Product_subcategory::create([
                'product_category_id' => $category->id,
                'name' => $request->subcategory_3,
            ]);
        }
        if(!empty($request->subcategory_4)) {
            Product_subcategory::create([
                'product_category_id' => $category->id,
                'name' => $request->subcategory_4,
            ]);
        }
        if(!empty($request->subcategory_5)) {
            Product_subcategory::create([
                'product_category_id' => $category->id,
                'name' => $request->subcategory_5,
            ]);
        }
        if(!empty($request->subcategory_6)) {
            Product_subcategory::create([
                'product_category_id' => $category->id,
                'name' => $request->subcategory_6,
            ]);
        }
        if(!empty($request->subcategory_7)) {
            Product_subcategory::create([
                'product_category_id' => $category->id,
                'name' => $request->subcategory_7,
            ]);
        }
        if(!empty($request->subcategory_8)) {
            Product_subcategory::create([
                'product_category_id' => $category->id,
                'name' => $request->subcategory_8,
            ]);
        }
        if(!empty($request->subcategory_9)) {
            Product_subcategory::create([
                'product_category_id' => $category->id,
                'name' => $request->subcategory_9,
            ]);
        }
        if(!empty($request->subcategory_10)) {
            Product_subcategory::create([
                'product_category_id' => $category->id,
                'name' => $request->subcategory_10,
            ]);
        }
        // 二重登録防止
        $request->session()->regenerateToken();
        session()->forget('product_category');
        session()->forget('subcategory_1');
        session()->forget('subcategory_2');
        session()->forget('subcategory_3');
        session()->forget('subcategory_4');
        session()->forget('subcategory_5');
        session()->forget('subcategory_6');
        session()->forget('subcategory_7');
        session()->forget('subcategory_8');
        session()->forget('subcategory_9');
        session()->forget('subcategory_10');

        return redirect()
            ->route('admin.category');
    }
    public function editSend(Request $request, Product_category $product_category)
    {

        Product_category::where('id', $product_category->id)->update([
            'name' => $request->product_category
        ]);
        Product_subcategory::where('product_category_id', $product_category->id)->forceDelete();
        Product_subcategory::create([
            'product_category_id' => $product_category->id,
            'name' => $request->subcategory_1,
        ]);
        if(!empty($request->subcategory_2)) {
            Product_subcategory::create([
                'product_category_id' => $product_category->id,
                'name' => $request->subcategory_2,
            ]);
        }
        if(!empty($request->subcategory_3)) {
            Product_subcategory::create([
                'product_category_id' => $product_category->id,
                'name' => $request->subcategory_3,
            ]);
        }
        if(!empty($request->subcategory_4)) {
            Product_subcategory::create([
                'product_category_id' => $product_category->id,
                'name' => $request->subcategory_4,
            ]);
        }
        if(!empty($request->subcategory_5)) {
            Product_subcategory::create([
                'product_category_id' => $product_category->id,
                'name' => $request->subcategory_5,
            ]);
        }
        if(!empty($request->subcategory_6)) {
            Product_subcategory::create([
                'product_category_id' => $product_category->id,
                'name' => $request->subcategory_6,
            ]);
        }
        if(!empty($request->subcategory_7)) {
            Product_subcategory::create([
                'product_category_id' => $product_category->id,
                'name' => $request->subcategory_7,
            ]);
        }
        if(!empty($request->subcategory_8)) {
            Product_subcategory::create([
                'product_category_id' => $product_category->id,
                'name' => $request->subcategory_8,
            ]);
        }
        if(!empty($request->subcategory_9)) {
            Product_subcategory::create([
                'product_category_id' => $product_category->id,
                'name' => $request->subcategory_9,
            ]);
        }
        if(!empty($request->subcategory_10)) {
            Product_subcategory::create([
                'product_category_id' => $product_category->id,
                'name' => $request->subcategory_10,
            ]);
        }

        // 二重登録防止
        $request->session()->regenerateToken();
        session()->forget('product_category');
        session()->forget('subcategory_1');
        session()->forget('subcategory_2');
        session()->forget('subcategory_3');
        session()->forget('subcategory_4');
        session()->forget('subcategory_5');
        session()->forget('subcategory_6');
        session()->forget('subcategory_7');
        session()->forget('subcategory_8');
        session()->forget('subcategory_9');
        session()->forget('subcategory_10');

        return redirect()
            ->route('admin.category');
    }
    public function show(Product_category $product_category)
    {
        return view('admin.category.show')
            ->with(compact('product_category'));
    }
    public function delete(Product_category $product_category)
    {
        Product_category::where('id', $product_category->id)->delete();
        Product_subcategory::where('product_category_id', $product_category->id)->delete();
        return redirect()->route('admin.category');
    }
}
