@extends('layouts.app')
@section('title', '商品検索')
@section('header')
    @extends('headers.detail_header')
@endsection
@section('content')
<div class="show_content">
    <p class='show_category'>
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
    </p>
    <div>
        <h2>
            {{ $product->name }}
        </h2>
        <span>
            更新日時:
            {{ date('Ymd', strtotime($product->created_at)) }}
        </span>
    </div>
    <div class='show_imgs'>
        <div class='show_img'>
            <img class='detail_img' src="{{ '../../storage/' . $product->image_1 }}">
        </div>
        <div class='show_img'>
            <img class='detail_img' src="{{ '../../storage/' . $product->image_2 }}">
        </div>
        <div class='show_img'>
            <img class='detail_img' src="{{ '../../storage/' . $product->image_3 }}">
        </div>
        <div class='show_img'>
            <img class='detail_img' src="{{ '../../storage/' . $product->image_4 }}">
        </div>
    </div>
    <div class='explain'>
        <p>■商品説明</p>
        <p>
            {{ $product->product_content }}
        </p>
    </div>

    <p class='show_btn_container'>
        <a class="blue_btn" href="{{ url()->previous() }}">
            一覧画面に戻る
        </a>
    </p>

</div>
@endsection
