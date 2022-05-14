<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Product_category;
use App\Models\Product_subcategory;
use App\Models\Tmpimg;
use Illuminate\Support\Facades\Log;


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
                'id' => $tmpimg->id
            ]
        );
    }


}
