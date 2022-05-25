<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Requests\ReviewRequest;
use App\Models\Review;
use App\Models\Product_category;
use App\Models\Product_subcategory;
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
            ->with(compact('reviews', 'product'));
    }
    public function memberReviews()
    {
        if(session()->has('evaluation') || session()->has('comment')){
            session()->forget('evaluation');
            session()->forget('comment');
        }
        $member = auth()->user();
        $reviews = Review::where('member_id', $member->id)->paginate(5);
        $categories = Product_category::all();
        $subcategories = Product_subcategory::all();
        return view('reviews.edit.index')
            ->with(compact('member', 'reviews', 'categories', 'subcategories'));
    }
    public function reviewUpdate(Review $review)
    {
        return view('reviews.edit.update')
        ->with([
            'review' => $review
        ]);
    }
    public function validateUpdate(ReviewRequest $request, Review $review)
    {
        session()->put([
            'evaluation' => $request->evaluation,
            'comment' => $request->comment,
        ]);
        return view('reviews.edit.confirm_update')
            ->with([
                'evaluation' => $request->evaluation,
                'comment' => $request->comment,
                'review' => $review
            ]);
    }
    public function sendUpdate(Request $request)
    {
        Review::where('id', $request->review_id)->update([
            'evaluation' => session()->get('evaluation'),
            'comment' => session()->get('comment')
        ]);
        session()->forget('evaluation');
        session()->forget('comment');
        return redirect()->route('member.reviews');
    }
    public function delete(Review $review)
    {
        return view('reviews.edit.delete')
            ->with(['review' => $review]);
    }
    public function sendDelete(Review $review)
    {
        Review::find($review->id)->delete();
        return redirect()->route('member.reviews');
    }
}
