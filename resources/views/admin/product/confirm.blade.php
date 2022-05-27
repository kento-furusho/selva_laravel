@extends('layouts.admin')
@section('title', '管理画面')
@section('header')
    @extends('headers.admins.create_or_edit')
    @if(!empty($product))
        @section('create_title', '商品編集')
    @else
        @section('create_title', '商品登録')
    @endif
    @section('back_page_btn')
        <a class="header-btn right-side-btn" href="{{ route('admin.product') }}">一覧に戻る</a>
    @endsection
@endsection
@section('content')
<form id="myForm" method='post' action="
@if(!empty($product))
{{ route('admin.product.edit.send', $product->id) }}
@else
{{ route('admin.product.create.send') }}
@endif
">
    @csrf
    <input type="hidden" name="name" value="{{ $name }}">
    <input type="hidden" name="category_id" value="{{ $category_id }}">
    <input type="hidden" name="subcategory_id" value="{{ $subcategory_id }}">
    <input type="hidden" name="image_1" value="{{ $image_1 }}">
    <input type="hidden" name="image_2" value="{{ $image_2 }}">
    <input type="hidden" name="image_3" value="{{ $image_3 }}">
    <input type="hidden" name="image_4" value="{{ $image_4 }}">
    <input type="hidden" name="explain" value="{{ $explain }}">

    <div class='content'>
    <div style="display: inline-block;">
        <p>商品名</p>
    </div>
    <span style="margin-left:90px;">
        {{ $name }}
    </span><br>
    <div style="display: inline-block;">
        <p>商品カテゴリ</p>
    </div>
    <span style="margin-left:40px;">
        {{ $category }} > {{ $subcategory }}
    </span>
    <div>
        <p>写真1</p>
        @if(!empty($image_1))
            <p style='text-align:center;'>
                <img style="width: 175px; height: 175px;" src={{ '../../../../storage/' . $image_1}}>
            </p>
        @endif
    </div>
    <div>
        <p>写真2</p>
        @if(!empty($image_2))
            <p style='text-align:center;'>
                <img style="width: 175px; height: 175px;" src={{ '../../../storage/' . $image_2}}>
            </p>
        @endif
    </div>
    <div>
        <p>写真3</p>
        @if(!empty($image_3))
            <p style='text-align:center;'>
                <img style="width: 175px; height: 175px;" src={{ '../../../storage/' . $image_3}}>
            </p>
        @endif
    </div>
    <div>
        <p>写真4</p>
        @if(!empty($image_4))
            <p style='text-align:center;'>
                <img style="width: 175px; height: 175px;" src={{ '../../../storage/' . $image_4}}>
            </p>
        @endif
    </div>
    <div>
        <p>商品説明</p>
        <p>
            {{ $explain }}
        </p>
    </div>
    </div>
    <div class='btn-container'>
        {{-- 二重登録防止 --}}
        <script src="{{ asset('js/common.js') }}"></script>
        <input class="back_btn_blue" type="submit" value=
        @if(!empty($product))
        {{ '編集完了' }}
        @else
        {{ '登録完了' }}
        @endif
        >
    </div>
</form>
@endsection
