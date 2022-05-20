@extends('layouts.app')
@section('title', '商品レビュー管理')
@section('header')
<header>
    <div class="header-left">
    <h2 style="
    line-height: 60px;
    margin-left: 15px;
    font-size: 19px;
    font-weight: bold;">
        商品レビュー管理
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
@if(!empty($reviews))
    @foreach ($reviews as $review)
        <div class='product'>
            <div class='product_left'>
                <img class='img' src="{{ '../../storage/' . $review->product->image_1 }}">
            </div>
            <div class='product-right'>
                <p class='category'>
                    @foreach ($categories as $category)
                        @if($category->id == $review->product->product_category_id)
                                {{ $category->name }}
                        @endif
                    @endforeach
                    <span>&gt;</span>
                    @foreach ($subcategories as $subcategory)
                        @if($subcategory->id == $review->product->product_subcategory_id)
                            {{ $subcategory->name }}
                        @endif
                    @endforeach
                </p>
                <p>
                    {{ $review->product->name }}
                </p>
                <p style='margin-bottom:0;'>
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
                </p>
                <p>
                    @if(mb_strlen($review->comment) > 16)
                        <?php $cut_comment = mb_substr($review->comment,0,16)?>
                        {{ $cut_comment.'...' }}
                    @else
                        {{ $review->comment }}
                    @endif
                </p>
            </div>
        </div>
    @endforeach
@endif
{{-- ページネーション --}}
<div class="pagination_container">
    <p class='pagination'>
        {{ $reviews->links('vendor.pagination.custom-pagination') }}
    </p>
</div>
<div class='btn-container'>
    <a class="back_btn_blue" href="{{ route('member.show') }}">
        <span>マイページに戻る</span>
    </a>
</div>
@endsection
