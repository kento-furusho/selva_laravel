@extends('layouts.app')
@section('title', '商品登録確認画面')
@section('content')
    {{-- <img src={{ '../../storage/' . $image_1}}> --}}
    <form id="myForm" method='post' action="{{ route('product.send') }}">
        @csrf
        <input type="hidden" name="name" value="{{ $name }}">
        <input type="hidden" name="category_id" value="{{ $category_id }}">
        <input type="hidden" name="subcategory_id" value="{{ $subcategory_id }}">
        <input type="hidden" name="image_1" value="{{ $image_1 }}">
        <input type="hidden" name="image_2" value="{{ $image_2 }}">
        <input type="hidden" name="image_3" value="{{ $image_3 }}">
        <input type="hidden" name="image_4" value="{{ $image_4 }}">
        <input type="hidden" name="explain" value="{{ $explain }}">

        <h2 style="margin-top:30px;">商品登録確認画面</h2>
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
                    <img style="width: 175px; height: 175px;" src={{ '../../storage/' . $image_1}}>
                </p>
            @endif
        </div>
        <div>
            <p>写真2</p>
            @if(!empty($image_2))
                <p style='text-align:center;'>
                    <img style="width: 175px; height: 175px;" src={{ '../../storage/' . $image_2}}>
                </p>
            @endif
        </div>
        <div>
            <p>写真3</p>
            @if(!empty($image_3))
                <p style='text-align:center;'>
                    <img style="width: 175px; height: 175px;" src={{ '../../storage/' . $image_3}}>
                </p>
            @endif
        </div>
        <div>
            <p>写真4</p>
            @if(!empty($image_4))
                <p style='text-align:center;'>
                    <img style="width: 175px; height: 175px;" src={{ '../../storage/' . $image_4}}>
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
            <input class="btn" type="submit" value="商品を登録する">
        </div>
        <div class='btn-container'>
            <a class="back_btn" href="{{ route('product.back') }}">
                <span>前に戻る</span>
            </a>
        </div>
    </form>
@endsection
