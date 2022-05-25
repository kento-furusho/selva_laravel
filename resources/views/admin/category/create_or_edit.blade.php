@extends('layouts.admin')
@section('title', '商品カテゴリー管理画面')
@section('header')
    @extends('headers.admins.create_or_edit')
    @if(!empty($product_category))
        @section('create_title', '商品カテゴリー編集')
    @else
        @section('create_title', '商品カテゴリー登録')
    @endif
    @section('back_page_btn')
        <a class="header-btn right-side-btn" href="{{ route('admin.category') }}">一覧に戻る</a>
    @endsection
@endsection
@section('content')
<form class='forms' method="post" action="
    @if(!empty($product_category))
        {{ route('admin.category.edit.store', $product_category->id) }}
    @else
        {{ route('admin.category.create.store') }}
    @endif
">
    @csrf

    <p>
        @if(!empty($product_category))
            {{ 'ID'.'  '.$product_category->id }}
        @else
            {{ 'ID  登録後に自動採番' }}
        @endif
    </p>

    <p>
        <label for="category">商品大カテゴリー</label>
        <input style="margin-left: 21px;" class='category_form' type="text" name='product_category' id='category'
        @if(old('product_category'))
            value = '{{ old('product_category') }}'
        @elseif(!empty($product_category))
            value = '{{ $product_category->name }}'
        @endif
        >
    </p>
    @error('product_category')
        <div class="err_msg">
            {{ $message }}
        </div>
    @enderror
    <p>
        <label for="subcategory">商品小カテゴリー</label>
        <input style="margin-left: 21px;" class='category_form' type="text" name='subcategory_1' id='subcategory'
        @if(old('subcategory_1'))
            value = '{{ old('subcategory_1') }}'
        @elseif(!empty($product_category->product_subcategory[0]))
            value = '{{ $product_category->product_subcategory[0]->name }}'
        @endif
        >
    </p>
    @error('subcategory_1')
        <div class="err_msg">
            {{ $message }}
        </div>
    @enderror
    <p>
        <input style="margin-left: 153px;" class='category_form' type="text" name='subcategory_2'
        @if(old('subcategory_2'))
            value = '{{ old('subcategory_2') }}'
        @elseif(!empty($product_category->product_subcategory[1]))
            value = '{{ $product_category->product_subcategory[1]->name }}'
        @endif
        >
    </p>
    @error('subcategory_2')
        <div class="err_msg">
            {{ $message }}
        </div>
    @enderror
    <p>
        <input style="margin-left: 153px;" class='category_form' type="text" name='subcategory_3'
        @if(old('subcategory_3'))
            value = '{{ old('subcategory_3') }}'
        @elseif(!empty($product_category->product_subcategory[2]))
            value = '{{ $product_category->product_subcategory[2]->name }}'
        @endif
        >
    </p>
    @error('subcategory_3')
        <div class="err_msg">
            {{ $message }}
        </div>
    @enderror
    <p>
        <input style="margin-left: 153px;" class='category_form' type="text" name='subcategory_4'
        @if(old('subcategory_4'))
            value = '{{ old('subcategory_4') }}'
        @elseif(!empty($product_category->product_subcategory[3]))
            value = '{{ $product_category->product_subcategory[3]->name }}'
        @endif
        >
    </p>
    @error('subcategory_4')
        <div class="err_msg">
            {{ $message }}
        </div>
    @enderror
    <p>
        <input style="margin-left: 153px;" class='category_form' type="text" name='subcategory_5'
        @if(old('subcategory_5'))
            value = '{{ old('subcategory_5') }}'
        @elseif(!empty($product_category->product_subcategory[4]))
            value = '{{ $product_category->product_subcategory[4]->name }}'
        @endif
        >
    </p>
    @error('subcategory_5')
        <div class="err_msg">
            {{ $message }}
        </div>
    @enderror
    <p>
        <input style="margin-left: 153px;" class='category_form' type="text" name='subcategory_6'
        @if(old('subcategory_6'))
            value = '{{ old('subcategory_6') }}'
        @elseif(!empty($product_category->product_subcategory[5]))
            value = '{{ $product_category->product_subcategory[5]->name }}'
        @endif
        >
    </p>
    @error('subcategory_6')
        <div class="err_msg">
            {{ $message }}
        </div>
    @enderror
    <p>
        <input style="margin-left: 153px;" class='category_form' type="text" name='subcategory_7'
        @if(old('subcategory_7'))
            value = '{{ old('subcategory_7') }}'
        @elseif(!empty($product_category->product_subcategory[6]))
            value = '{{ $product_category->product_subcategory[6]->name }}'
        @endif
        >
    </p>
    @error('subcategory_7')
        <div class="err_msg">
            {{ $message }}
        </div>
    @enderror
    <p>
        <input style="margin-left: 153px;" class='category_form' type="text" name='subcategory_8'
        @if(old('subcategory_8'))
            value = '{{ old('subcategory_8') }}'
        @elseif(!empty($product_category->product_subcategory[7]))
            value = '{{ $product_category->product_subcategory[7]->name }}'
        @endif
        >
    </p>
    @error('subcategory_8')
        <div class="err_msg">
            {{ $message }}
        </div>
    @enderror
    <p>
        <input style="margin-left: 153px;" class='category_form' type="text" name='subcategory_9'
        @if(old('subcategory_9'))
            value = '{{ old('subcategory_9') }}'
        @elseif(!empty($product_category->product_subcategory[8]))
            value = '{{ $product_category->product_subcategory[8]->name }}'
        @endif
        >
    </p>
    @error('subcategory_9')
        <div class="err_msg">
            {{ $message }}
        </div>
    @enderror
    <p>
        <input style="margin-left: 153px;" class='category_form' type="text" name='subcategory_10'
        @if(old('subcategory_10'))
            value = '{{ old('subcategory_10') }}'
        @elseif(!empty($product_category->product_subcategory[9]))
            value = '{{ $product_category->product_subcategory[9]->name }}'
        @endif
        >
    </p>
    @error('subcategory_10')
        <div class="err_msg">
            {{ $message }}
        </div>
    @enderror

    <div class='btn-container'>
        <a>
        <input class="back_btn_blue" type="submit" value="確認画面へ">
        </a>
    </div>
    </form>
@endsection
