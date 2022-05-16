@extends('layouts.app')
@section('title', '商品レビュー登録')
@section('header')
    @extends('headers.reviews.create')
@endsection
@section('content')
    <div class='product'>
        <div class='product_left'>
            <img class='img' style='margin-left:27px;' src="{{ '../../storage/' . $product->image_1 }}">
        </div>
        <div class='product-right'>
            <p style='margin-top: 20px; display: inline-block;'>{{ $product->name }}</p>
            <p style='margin-bottom:0;'>
                {{ (getReviewAverage($product->id)) }}
            </p>
        </div>
    </div>
    <div class='review_area'>
        <form method='post' action="{{ route('review.store', $product->id) }}">
        @csrf
            <input type="hidden" name='member_id' value='{{ auth()->user()->id }}'>
            <div>
                <label>商品評価
                    <select name="evaluation">
                        @for($i=1; $i<6;$i++)
                        <option value={{ $i }}
                        @if($i == old('evaluation'))
                            {{ 'selected' }}
                        @elseif(!empty($evaluation) && $evaluation == $i)
                            {{ 'selected' }}
                        @endif
                        >
                            {{ $i }}
                        </option>
                        @endfor
                    </select>
                </label>
            </div>
            @error('evaluation')
                <div class="review_err_msg">
                    {{ $message }}
                </div>
            @enderror
            <div>
                <label for='comment'>商品コメント</label>
                <textarea id='comment' name="comment" class='comment_area'>@if(!empty(old('comment'))){{ old('comment') }}@elseif(!empty($comment)){{ $comment }}@endif</textarea>
            </div>
            @error('comment')
                <div class="review_err_msg">
                    {{ $message }}
                </div>
            @enderror
            <p class="btn-container">
                <a>
                    <input class='blue_btn' type="submit" value="商品レビュー登録確認">
                </a>
            </p>
            <p class="btn-container">
                <a href='{{ route('product.show', $product->id) }}' class='back_btn_blue'>商品詳細に戻る</a>
            </p>
        </form>
    </div>
@endsection
