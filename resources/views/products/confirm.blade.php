@extends('layouts.app')
@section('title', '商品登録確認画面')
@section('content')
    {{ $name }}
    {{ $category_id }}
    {{ $category }}
    {{ $subcategory_id }}
    {{ $subcategory }}
    {{-- <img src={{ '../../storage/' . $image_1}}> --}}
    <form id="myForm" method='post' action="{{ route('product.send') }}">
        @csrf
        <input type="hidden" name="name" value="{{ $name }}">
        <input type="hidden" name="category_id" value="{{ $category_id }}">
        <input type="hidden" name="subcategory_id" value="{{ $subcategory_id }}">
        <input type="hidden" name="image_1" value="{{ $image_1 }}">
        <input type="hidden" name="image_2" value="{{ $image_2 }}">
        <input type="hidden" name="product_content" value="{{ $explain }}">

        <h2 style="margin-top:30px;">会員情報確認画面</h2>
        <div class='content'>
        <div>
            <p>商品名</p>
            <p>
                {{ $name }}
            </p>
        </div>
        <div>
            <p>商品カテゴリ</p>
            <p>
                {{ $category }} > {{ $subcategory }}
            </p>
        </div>
        <div>
            <p>写真1</p>
            <img src={{ '../../storage/' . $image_1}}>
        </div>
        <div>
            <p>写真2</p>
            <img src={{ '../../storage/' . $image_2}}>
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
            <input class="btn" type="submit" value="商品を登録する">
        </div>
        <div class='btn-container'>
            <a class="back_btn" href="{{ route('product.create') }}">
                <span>前に戻る</span>
            </a>
        </div>
    </form>
@endsection
