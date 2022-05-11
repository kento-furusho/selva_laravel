<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Product_category;
use App\Models\Product_subcategory;

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
    // 画像アップロード
    public function upload_image(Request $request, $id)
    {
        $response = [];

        $fileName = $request->file('file')->getClientOriginalName();

        $ext = pathinfo($fileName)['extension'];
        $check_extension = ['jpg', 'jpeg', 'png', 'gif'];
        if(!in_array($ext, $check_extension, true)){
            $response = [
                'is_success' => false,
                'errors_message' => ["アップロードできる画像はjpg, jpeg, png, gifです"]
            ];
            return response()->json($response);
        }
        
    }
}
