@extends('layouts.admin')
@section('title', '管理画面')
@section('header')
    @extends('headers.admins.create_or_edit')
    @section('create_title', '商品詳細')
    @section('back_page_btn')
        <a class="header-btn right-side-btn" href="{{ route('admin.product') }}">一覧に戻る</a>
    @endsection
@endsection
@section('content')
    <div class='content'>
    <div style="display: inline-block;">
        <p>ID</p>
    </div>
    <span style="margin-left:90px;">
        {{ $product->id }}
    </span><br>
    <div style="display: inline-block;">
        <p>商品名</p>
    </div>
    <span style="margin-left:90px;">
        {{ $product->name }}
    </span><br>
    <div style="display: inline-block;">
        <p>商品カテゴリ</p>
    </div>
    <span style="margin-left:40px;">
        @foreach ($categories as $category)
            @if($category->id == $product->product_category_id)
                    <span>{{ $category->name }}</span>
            @endif
        @endforeach
        <span>&gt;</span>
        @foreach ($subcategories as $subcategory)
            @if($subcategory->id == $product->product_subcategory_id)
                <span>{{ $subcategory->name }}</span>
            @endif
        @endforeach
    </span>
    <div>
        <p>写真1</p>
        @if(!empty($product->image_1))
            <p style='text-align:center;'>
                <img style="width: 175px; height: 175px;" src={{ '../../../../storage/' . $product->image_1}}>
            </p>
        @endif
    </div>
    <div>
        <p>写真2</p>
        @if(!empty($product->image_2))
            <p style='text-align:center;'>
                <img style="width: 175px; height: 175px;" src={{ '../../../storage/' . $product->image_2}}>
            </p>
        @endif
    </div>
    <div>
        <p>写真3</p>
        @if(!empty($product->image_3))
            <p style='text-align:center;'>
                <img style="width: 175px; height: 175px;" src={{ '../../../storage/' . $product->image_3}}>
            </p>
        @endif
    </div>
    <div>
        <p>写真4</p>
        @if(!empty($product->image_4))
            <p style='text-align:center;'>
                <img style="width: 175px; height: 175px;" src={{ '../../../storage/' . $product->image_4}}>
            </p>
        @endif
    </div>
    <div>
        <p>商品説明</p>
        <p>
            {{ $product->product_content }}
        </p>
    </div>
    </div>
    <div style='width:100%; height:60px; background-color:#cccccc;'>
        <p style='text-align:center; line-height:60px;'><span style='margin-right:100px; font-weight:bold;'>総合評価</span>
            {{ (getReviewAverage($product->id)) }}
        </p>
    </div>
    @foreach($reviews as $review)
        <div class="reviews">
            <div class='confirm'>
                <p class='confirm_comment' style='margin-bottom:10px;'>商品レビューID<span style='margin-left:111px;'>{{ $review->id }}</span></p>
            </div>
            <div class='confirm'>
                <p class='confirm_evaluation'><a href="{{ route('admin.member.show', $review->member_id) }}">{{ $review->member->name_sei.' '.$review->member->name_mei.'さん' }}</a></p>
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
                <p class='confirm_comment' style='margin-bottom:10px;'>商品コメント
                    <span style='margin-left:120px;'>
                        {{ $review->comment }}
                    </span>
                </p>
            </div>
            <div class='confirm comment_border' style="text-align: right;">
                <p>
                    <a class='admin_review_show_btn' href="{{ route('admin.review.show', $review->id) }}">
                        商品レビュー詳細
                    </a>
                </p>
            </div>
        </div>
    @endforeach
    <div class="pagination_container">
        <p class='pagination'>
            {{ $reviews->links('vendor.pagination.custom-pagination') }}
        </p>
    </div>
    <p style="text-align: center; margin-top:35px;">
        <a class='back_btn_blue' href="{{ route('admin.product.edit', $product->id) }}" style='padding: 14px 55px;
            font-size: 16px;'>編集</a>
        <a class='back_btn_blue' href="{{ route('admin.product.delete', $product->id) }}" style='padding: 14px 55px;
            font-size: 16px;'>削除</a>
    </p>
@endsection
