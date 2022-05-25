@extends('layouts.admin')
@section('title', '商品カテゴリー管理')
@section('header')
    @extends('headers.admins.create_or_edit')
    @if(!empty($product_category))
        @section('create_title', '商品カテゴリー編集確認')
    @else
        @section('create_title', '商品カテゴリー登録確認')
    @endif
    @section('back_page_btn')
        <a class="header-btn right-side-btn" href="{{ route('admin.category') }}">一覧に戻る</a>
    @endsection
@endsection
@section('content')
<div class="container">
    <form id="myForm" method='post' action="
    @if(!empty($product_category))
    {{ route('admin.category.edit.send', $product_category->id) }}
    @else
    {{ route('admin.category.create.send') }}
    @endif
    ">
        @csrf
        <input type="hidden" name="product_category" value="{{ session()->get('product_category') }}">
        <input type="hidden" name="subcategory_1" value="{{ session()->get('subcategory_1') }}">
        <input type="hidden" name="subcategory_2" value="{{ session()->get('subcategory_2') }}">
        <input type="hidden" name="subcategory_3" value="{{ session()->get('subcategory_3') }}">
        <input type="hidden" name="subcategory_4" value="{{ session()->get('subcategory_4') }}">
        <input type="hidden" name="subcategory_5" value="{{ session()->get('subcategory_5') }}">
        <input type="hidden" name="subcategory_6" value="{{ session()->get('subcategory_6') }}">
        <input type="hidden" name="subcategory_7" value="{{ session()->get('subcategory_7') }}">
        <input type="hidden" name="subcategory_8" value="{{ session()->get('subcategory_8') }}">
        <input type="hidden" name="subcategory_9" value="{{ session()->get('subcategory_9') }}">
        <input type="hidden" name="subcategory_10" value="{{ session()->get('subcategory_10') }}">
        <div class='content'>
        <p>
            @if(!empty($product_category))
                {{ 'ID'.'  '.$product_category->id }}
            @else
                {{ 'ID  登録後に自動採番' }}
            @endif
        </p>
        <p>商品大カテゴリー
            {{ session()->get('product_category') }}
        </p>
        <p>商品小カテゴリー
            {{ session()->get('subcategory_1') }}
        </p>
        <p style="margin-left: 133px">{{ session()->get('subcategory_2') }}</p>
        <p style="margin-left: 133px">{{ session()->get('subcategory_3') }}</p>
        <p style="margin-left: 133px">{{ session()->get('subcategory_4') }}</p>
        <p style="margin-left: 133px">{{ session()->get('subcategory_5') }}</p>
        <p style="margin-left: 133px">{{ session()->get('subcategory_6') }}</p>
        <p style="margin-left: 133px">{{ session()->get('subcategory_7') }}</p>
        <p style="margin-left: 133px">{{ session()->get('subcategory_8') }}</p>
        <p style="margin-left: 133px">{{ session()->get('subcategory_9') }}</p>
        <p style="margin-left: 133px">{{ session()->get('subcategory_10') }}</p>
        </div>
        <div class='btn-container'>
            {{-- 二重登録防止 --}}
            <script src="{{ asset('js/common.js') }}"></script>
            <input class="blue_btn" type="submit" value=
            @if(!empty($product_category))
            {{ '編集完了' }}
            @else
            {{ '登録完了' }}
            @endif>
        </div>
    </form>
</div>
@endsection
