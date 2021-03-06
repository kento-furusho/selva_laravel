@extends('layouts.app')
@section('title', '商品レビュー編集確認')
@section('header')
<header>
    <div class="header-left">
    <h2 style="
    line-height: 60px;
    margin-left: 15px;
    font-size: 19px;
    font-weight: bold;">
        商品レビュー編集確認
    </h2>
    </div>
    <div class="header-right">
        <a class="header-btn right-side-btn" href="{{ route('member.index')}}">
            トップに戻る
        </a>
    </div>
</header>
@endsection
@section('content')
{{--  --}}
<div class='product'>
    <div class='product_left'>
        <img class='img' style='margin-left:27px;' src="{{ '../../../storage/' . $review->product->image_1 }}">
    </div>
    <div class='product-right'>
        <p style='margin-top: 20px; display: inline-block;'>{{ $review->product->name }}</p>
        <p style='margin-bottom:0;'>
            {{ '総合評価'.'  '.(getReviewAverage($review->product->id)) }}
        </p>
    </div>
</div>
<div class='review_area'>
    <form method='post' action="{{ route('review.update.send') }}">
    @csrf
        <input type="hidden" name='review_id' value='{{ $review->id }}'>
        <input type="hidden" name='evaluation' value='{{ $evaluation }}'>
        <input type="hidden" name='comment' value='{{ $comment }}'>

        <div class='confirm'>
            <p class='confirm_evaluation'>商品評価</p><span>{{ $evaluation }}</span>
        </div>
        <div class='confirm'>
            <p style='margin-bottom:0;' class='confirm_comment'>商品コメント</p><span>{!! nl2br(e($comment)) !!}</span>
        </div>

        <p class="btn-container">
            <a>
                <input class='blue_btn' type="submit" value="更新する">
            </a>
        </p>
        <p class="btn-container">
            <a href='{{ url()->previous() }}' class='back_btn_blue'>前に戻る</a>
        </p>
    </form>
</div>
@endsection
