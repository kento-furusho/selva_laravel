@extends('layouts.app')
@section('title', '商品レビュー登録確認')
@section('header')
    @extends('headers.reviews.confirm')
@endsection
@section('content')
<div class='product'>
    <div class='product_left'>
        <img class='img' style='margin-left:27px;' src="{{ '../../storage/' . $product->image_1 }}">
    </div>
    <div class='product-right'>
        <p style='margin-top: 20px; display: inline-block;'>{{ $product->name }}</p>
        <p style='margin-bottom:0;'>
            {{ '総合評価'.'  '.(getReviewAverage($product->id)) }}
        </p>
    </div>
</div>
<div class='review_area'>
    <form method='post' action="{{ route('review.send') }}">
    @csrf
        <input type="hidden" name='member_id' value='{{ $member_id }}'>
        <input type="hidden" name='product_id' value='{{ $product->id }}'>
        <input type="hidden" name='evaluation' value='{{ $evaluation }}'>
        <input type="hidden" name='comment' value='{{ $comment }}'>

        <div class='confirm'>
            <p class='confirm_evaluation'>商品評価</p><span>{{ $evaluation }}</span>
        </div>
        <div class='confirm'>
            <p class='confirm_comment'>商品コメント</p><span>{{ $comment }}</span>
        </div>

        <p class="btn-container">
            <a>
                <script src="{{ asset('js/common.js') }}"></script>
                <input class='blue_btn' type="submit" value="登録する">
            </a>
        </p>
        <p class="btn-container">
            <a href='{{ url()->previous() }}' class='back_btn_blue'>前に戻る</a>
        </p>
    </form>
</div>
@endsection
