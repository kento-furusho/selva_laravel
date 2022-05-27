<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Member;
use App\Models\Product_category;
use App\Models\Product_subcategory;
use App\Models\Review;
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
    public function orderDesc(Request $request)
    {
        $id = $request->id;
        $free_word = $request->free_word;
        $reviews = Review::search($id, $free_word)->orderBy('id', 'desc')->paginate(10);
        session()->forget('order');
        session()->put('order', 'desc');
        return view('admin.review.search')
            ->with(compact('reviews'));
    }
    public function orderAsc(Request $request)
    {
        $id = $request->id;
        $free_word = $request->free_word;
        $reviews = Review::search($id, $free_word)->orderBy('id', 'asc')->paginate(10);
        session()->forget('order');
        session()->put('order', 'asc');
        return view('admin.review.search')
            ->with(compact('reviews'));
    }
    // public function create()
    // {
    //     return view('admin.review.create_or_edit');
    // }
    public function edit(Review $review)
    {
        return view('admin.review.create_or_edit')
            ->with(compact('review'));
    }
    public function editStore(Request $request, Review $review)
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