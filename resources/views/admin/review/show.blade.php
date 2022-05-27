@extends('layouts.admin')
@section('title', '商品レビュー詳細画面')
@section('header')
    @extends('headers.admins.create_or_edit')
    @section('create_title', '商品レビュー詳細')
    @section('back_page_btn')
        <a class="header-btn right-side-btn" href="{{ route('admin.review') }}">一覧に戻る</a>
    @endsection
@endsection
@section('content')
<div class='product'>
    <div class='product_left'>
        <img class='img' style='margin-left:27px;' src="{{ '../../../storage/' . $review->product->image_1 }}">
    </div>
    <div class='product-right'>
        <p style='margin-top: 20px;'>
             {{ '商品ID'.'  '.$review->id }}
        </p>
        <p style='display: inline-block;'>{{ $review->product->name }}</p>
        <p style='margin-bottom:0;'>
            {{ '総合評価'.'  '.(getReviewAverage($review->product->id)) }}
        </p>
    </div>
</div>
<div class='review_area' style='width:55%;'>
        <div class='confirm'>
            <p class='confirm_id'>商品ID</p><span>{{ $review->id }}</span>
        </div>
        <div class='confirm'>
            <p class='confirm_evaluation'>商品評価</p><span>{{ $review->evaluation }}</span>
        </div>
        <div class='confirm'>
            <p style='margin-bottom:0;' class='confirm_comment'>商品コメント</p><span>{!! nl2br(e($review->comment)) !!}</span>
        </div>
</div>
<p style="text-align: center; margin-top:35px;">
    <a class='back_btn_blue' href="{{ route('admin.review.edit', $review->id) }}" style='padding: 14px 55px;
        font-size: 16px;'>編集</a>
    <a class='back_btn_blue' href="{{ route('admin.review.delete', $review->id) }}" style='padding: 14px 55px;
        font-size: 16px;'>削除</a>
</p>
@endsection
