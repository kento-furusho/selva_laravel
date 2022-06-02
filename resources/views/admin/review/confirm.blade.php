@extends('layouts.admin')
@section('title', '管理画面')
@section('header')
    @extends('headers.admins.create_or_edit')
    @if(!empty($review))
        @section('create_title', 'レビュー編集')
    @else
        @section('create_title', 'レビュー登録')
    @endif
    @section('back_page_btn')
        <a class="header-btn right-side-btn" href="{{ route('admin.review') }}">一覧に戻る</a>
    @endsection
@endsection
@section('content')
@if(!empty($review))
    <div class='product'>
        <div class='product_left'>
            <img class='img' style='margin-left:27px;' src="{{ '../../../../storage/' . $review->product->image_1 }}">
        </div>
        <div class='product-right'>
            <p  style='margin-top: 20px;'>
                {{ '商品ID'.'  '.$review->product->id }}
            </p>
            <p style='display: inline-block;'>{{ $review->product->name }}</p>
            <p style='margin-bottom:0;'>
                {{ '総合評価'.'  '.(getReviewAverage($review->product->id)) }}
            </p>
        </div>
    </div>
@else
    <div class='product'>
        <div class='product_left'>
            <img class='img' style='margin-left:27px;' src="{{ '../../../storage/' . $product->image_1 }}">
        </div>
        <div class='product-right'>
            <p  style='margin-top: 20px;'>
                {{ '商品ID'.'  '.$product->id }}
            </p>
            <p style='display: inline-block;'>{{ $product->name }}</p>
            <p style='margin-bottom:0;'>
                {{ '総合評価'.'  '.(getReviewAverage($product->id)) }}
            </p>
        </div>
    </div>
@endif
<div class='review_area'>
    <form method='post' action="
    @if(!empty($review))
        {{ route('admin.review.edit.send', $review->id) }}
    @else
        {{ route('admin.review.create.send') }}
    @endif">
    @csrf
        @if(!empty($product))
            <input type="hidden" name='product_id' value="{{ $product->id }}">
        @endif
        <input type="hidden" name='evaluation' value='{{ $evaluation }}'>
        <input type="hidden" name='comment' value='{{ $comment }}'>

        <div class='confirm'>
            <p class='confirm_id'>商品ID
            @if(!empty($review))
                <span>{{ $review->id }}</span>
            @else
                <span>{{ '登録後に自動採番' }}</span>
            @endif
        </p>
        </div>
        <div class='confirm'>
            <p class='confirm_evaluation'>商品評価</p><span>{{ $evaluation }}</span>
        </div>
        <div class='confirm'>
            <p style='margin-bottom:0;' class='confirm_comment'>商品コメント</p><span>{!! nl2br(e($comment)) !!}</span>
        </div>

        <p class="btn-container">
            <a>
                <script src="{{ asset('js/common.js') }}"></script>
                <input class='blue_btn' type="submit" value="編集完了">
            </a>
        </p>
        <p class="btn-container">
            <a href='{{ url()->previous() }}' class='back_btn_blue'>前に戻る</a>
        </p>
    </form>
</div>
@endsection
