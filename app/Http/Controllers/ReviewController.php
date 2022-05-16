<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function create(Product $product)
    {
        return view('reviews.create')
            ->with('product', $product);
    }
    public function confirm()
    {

    }
    public function complete()
    {

    }
    public function show()
    {

    }
}
