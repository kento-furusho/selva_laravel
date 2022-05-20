@extends('layouts.app')
@section('title', '商品レビュー編集')
@section('header')
<header>
    <div class="header-left">
    <h2 style="
    line-height: 60px;
    margin-left: 15px;
    font-size: 19px;
    font-weight: bold;">
        商品レビュー編集
    </h2>
    </div>
    <div class="header-right">
        <a class="header-btn right-side-btn" href="{{ route('member.index')}}">
            トップに戻る
        </a>
    </div>
</header>
@endsection
@section('content')
<div class='product'>
    <div class='product_left'>
        <img class='img' style='margin-left:27px;' src="{{ '../../../storage/' . $review->product->image_1 }}">
    </div>
    <div class='product-right'>
        <p style='margin-top: 20px; display: inline-block;'>{{ $review->product->name }}</p>
        <p style='margin-bottom:0;'>
            {{ '総合評価'.'  '.(getReviewAverage($review->product->id)) }}
        </p>
    </div>
</div>
<div class='review_area'>
    <form method='post' action="{{ route('review.update.validate', $review->id) }}">
    @csrf
        <div>
            <label>商品評価
                <select name="evaluation">
                    @for($i=1; $i<6;$i++)
                    <option value={{ $i }}
                    @if($i == old('evaluation'))
                        {{ 'selected' }}
                    @elseif(session()->has('evaluation') && (int)session()->get('evaluation') === (int)$i)
                        {{ 'selected' }}
                    @elseif($review->evaluation === $i && session()->has('evaluation') === false)
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
            <textarea id='comment' name="comment" class='comment_area'>@if(!empty(old('comment'))){{ old('comment') }}@elseif(session()->has('comment')){{ session()->get('comment') }}@else{{ $review->comment }}@endif</textarea>
        </div>
        @error('comment')
            <div class="review_err_msg">
                {{ $message }}
            </div>
        @enderror
        <p class="btn-container">
            <a>
                <input class='blue_btn' type="submit" value="商品レビュー編集確認">
            </a>
        </p>
        <p class="btn-container">
            <a href='{{ route('member.reviews') }}' class='back_btn_blue'>レビュー管理に戻る</a>
        </p>
    </form>
</div>
@endsection
