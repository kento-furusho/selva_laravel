@extends('layouts.app')
@section('title', '商品レビュー登録完了')
@section('header')
    @extends('headers.reviews.complete')
@endsection
@section('content')
<div>
    <p style='text-align:center; margin:80px;'>
        商品レビューの登録が完了しました。
    </p>
    <form method='get' action="{{ route('review.show') }}">
        @csrf
            <input type="hidden" name="product_id" value="{{ $product_id }}">
            <p class="btn-container">
                <a>
                    <input class="back_btn_blue" type="submit" value="商品レビュー一覧へ">
                </a>
            </p>
        </form>
    <p class="btn-container">
        <a href='{{ route('product.show', $product_id) }}' class='blue_btn'>商品詳細に戻る</a>
    </p>
</div>
@endsection
