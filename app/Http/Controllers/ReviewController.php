<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Requests\ReviewRequest;
use App\Models\Review;
use Illuminate\Support\Facades\Log;


class ReviewController extends Controller
{
    public function create(Product $product)
    {
        if(session()->has('evaluation') && session()->has('comment')){
            $data = session()->all();
            return view('reviews.create')
            ->with([
                'product' => $product,
                'evaluation' => $data['evaluation'],
                'comment' => $data['comment'],
            ]);
        } else {
            return view('reviews.create')
            ->with([
                'product' => $product
            ]);
        }
    }
    public function store(ReviewRequest $request, Product $product)
    {
        session()->put([
            'evaluation' => $request->evaluation,
            'comment' => $request->comment,
        ]);
        return view('reviews.confirm')
            ->with([
                'member_id' => $request->member_id,
                'evaluation' => $request->evaluation,
                'comment' => $request->comment,
                'product' => $product
            ]);
    }
    public function send(Request $request)
    {
        $product_id = $request->product_id;
        Review::create([
            'member_id' => $request->member_id,
            'product_id' => $request->product_id,
            'evaluation' => $request->evaluation,
            'comment' => $request->comment
        ]);
        session()->forget('evaluation');
        session()->forget('comment');
        return view('reviews.complete')
            ->with('product_id', $product_id);
    }
    public function show(Request $request)
    {
        Log::info('review.show');
        $product = Product::findOrFail($request->product_id);
        $reviews = Review::where('product_id', $request->product_id)->paginate(5);
        // ddd($reviews);
        return view('reviews.show')
            ->with([
                'reviews' => $reviews,
                'product' => $product
            ]);
    }
}
