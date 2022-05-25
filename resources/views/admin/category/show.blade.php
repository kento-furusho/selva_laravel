@section('title', '商品カテゴリー詳細画面')
@extends('layouts.admin')
@section('header')
    @extends('headers.admins.create_or_edit')
    @section('create_title', '商品カテゴリー詳細画面')
    @section('back_page_btn')
    <a class="header-btn right-side-btn" href="{{ route('admin.category') }}">一覧に戻る</a>
    @endsection
@endsection
@section('content')
<div class="container">
    <div class='mypage_content'>
        <p><span style='margin-right:30px;'>商品カテゴリーID</span>
            {{ $product_category->id }}
        </p>
        <p><span style='margin-right:30px;'>商品大カテゴリー</span>
            {{ $product_category->name }}
        </p>
        <p class="">商品小カテゴリー</p>
        @foreach($product_category->product_subcategory as $subcategory)
            <p style='margin-left:183px;'>
                {{ $subcategory->name }}
            </p>
        @endforeach
        <p style="text-align: center; margin-top:35px;">
            <a class='back_btn_blue' href="{{ route('admin.category.edit', $product_category->id) }}">編集</a>
            <a class='back_btn_blue' href="{{ route('admin.category.delete', $product_category->id) }}">削除</a>
        </p>
    </div>
</div>
@endsection
