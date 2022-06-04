<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Member;
use App\Models\Product_category;
use App\Models\Product_subcategory;
use App\Models\Review;
use App\Http\Requests\ReviewRequest;
use Illuminate\Http\Request;
use App\Models\Administer;
use App\Models\Product;
use Illuminate\Support\Facades\Log;

class ReviewController extends Controller
{
    public function index()
    {
        $reviews = Review::orderBy('id', 'desc')->paginate(10);
        return view('admin.review.search')
            ->with(compact('reviews'));
    }
    public function search(Request $request)
    {
        $id = $request->id;
        $free_word = $request->free_word;
        $request->validate([
            'id' => 'nullable|integer',
            'free_word' => 'nullable|string'
        ]);
        if(!isset($id)&&!isset($free_word)){
            session()->forget('order');
            session()->put('order', 'desc');
            return redirect()->route('admin.review');
        }

        // \DB::enableQueryLog();
        $reviews = Review::search($id, $free_word)->orderBy('id', 'desc')->paginate(10);
        session()->forget('order');
        session()->put('order', 'desc');
        return view('admin.review.search')
            ->with(compact('reviews'));
    }
    public function orderChange(Request $request)
    {
        $id = $request->id;
        $free_word = $request->free_word;
        $order = $request->order;
        if($order === 'asc') {
            $reviews = Review::search($id, $free_word)->orderBy('id', 'asc')->paginate(10);
        } elseif($order === 'desc') {
            $reviews = Review::search($id, $free_word)->orderBy('id', 'desc')->paginate(10);
        }
        return view('admin.review.search')
            ->with(compact('reviews'));
    }
    public function create()
    {
        $products = Product::all();
        return view('admin.review.create_or_edit')
            ->with(compact('products'));
    }
    public function createStore(ReviewRequest $request)
    {
        $product = Product::where('id', $request->product_id)->first();
        session()->put([
            'product_id' => $request->product_id,
            'evaluation' => $request->evaluation,
            'comment' => $request->comment,
        ]);
        return view('admin.review.confirm')
            ->with([
                'evaluation' => $request->evaluation,
                'comment' => $request->comment,
                'product' => $product,
            ]);
    }
    public function createSend(Request $request)
    {
        Review::create([
            'member_id' => 74,
            'product_id' => session()->get('product_id'),
            'evaluation' => session()->get('evaluation'),
            'comment' => session()->get('comment'),
        ]);
        session()->forget('product_id');
        session()->forget('evaluation');
        session()->forget('comment');
        return redirect()->route('admin.review');
    }
    public function edit(Review $review)
    {
        return view('admin.review.create_or_edit')
            ->with(compact('review'));
    }
    public function editStore(ReviewRequest $request, Review $review)
    {
        session()->put([
            'evaluation' => $request->evaluation,
            'comment' => $request->comment,
        ]);
        return view('admin.review.confirm')
            ->with([
                'evaluation' => $request->evaluation,
                'comment' => $request->comment,
                'review' => $review
            ]);
    }
    public function editSend(Request $request, Review $review)
    {
        Review::where('id', $review->id)->update([
            'evaluation' => session()->get('evaluation'),
            'comment' => session()->get('comment')
        ]);
        session()->forget('evaluation');
        session()->forget('comment');
        return redirect()->route('admin.review');
    }
    public function show(Review $review)
    {
        return view('admin.review.show')
            ->with(compact('review'));
    }
    public function delete(Review $review)
    {
        Review::where('id', $review->id)->delete();
        return redirect()->route('admin.review');
    }
}
