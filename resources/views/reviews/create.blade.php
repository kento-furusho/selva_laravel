@extends('layouts.app')
@section('title', '商品レビュー登録')
@section('header')
    @extends('headers.reviews.create')
@endsection
@section('content')
    <div class='product'>
        <div class='product_left'>
            <img class='img' src="{{ '../../storage/' . $product->image_1 }}">
        </div>
        <div class='product-right'>
            <p>{{ $product->name }}</p>
        </div>
    </div>
    <div class='review_area'>
        <form action="">
        @csrf
            <input type="hidden" name='member_id' value='{{ auth()->user()->id }}'>
            <label>商品評価
                <select name="evaluation">
                    @for($i=1; $i<6;$i++)
                    <option value={{ $i }}
                    @if($i == old('evaluation')){{ 'selected' }}@endif
                    >
                        {{ $i }}
                    </option>
                    @endfor
                </select>
            </label>
            <label>商品コメント
                <textarea name="comment">{{ old('comment') }}</textarea>
            </label>
        </form>
    </div>
@endsection
