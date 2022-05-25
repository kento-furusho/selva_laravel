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
}
