@extends('layouts.app')
@section('title', '商品レビュー一覧')
@section('header')
    @extends('headers.reviews.show')
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
    @foreach($reviews as $review)
        <div class="reviews">
            <div class='confirm'>
                <p class='confirm_evaluation'>{{ $review->member->name_sei.' '.$review->member->name_mei.'さん' }}</p>
                <span>
                    <?php
                    $star = '';
                    for($i=0; $i<$review->evaluation; $i++){
                        $star = $star.'★';
                    }
                    ?>
                    {{ $star }}
                </span>
                <span>{{ $review->evaluation }}</span>
            </div>
            <div class='confirm'>
                <p class='confirm_comment' style='margin-right:120px;'>商品コメント</p><span>{{ $review->comment }}</span>
            </div>
        </div>
    @endforeach
    <div class="pagination_container">
        <p class='pagination'>
            {{ $reviews->appends(request()->query())->links('vendor.pagination.custom-pagination') }}
        </p>
    </div>
    <p class="btn-container">
        <a href='{{ route('product.show', $product->id) }}' class='blue_btn'>商品詳細に戻る</a>
    </p>
@endsection
