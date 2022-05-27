@extends('layouts.admin')
@section('title', '商品管理画面')
@section('header')
    @extends('headers.admins.create_or_edit')
    @section('create_title', '商品編集')
    @section('back_page_btn')
        <a class="header-btn right-side-btn" href="{{ route('admin.review') }}">一覧に戻る</a>
    @endsection
@endsection
@section('content')
<div class='product'>
    <div class='product_left'>
        <img class='img' style='margin-left:27px;' src="{{ '../../../storage/' . $review->product->image_1 }}">
    </div>
    <div class='product-right'>
        <p style='margin-top: 20px;'>
            {{ '商品ID'.'  '.$review->id }}
       </p>
        <p style='display: inline-block;'>{{ $review->product->name }}</p>
        <p style='margin-bottom:0;'>
            {{ '総合評価'.'  '.(getReviewAverage($review->product->id)) }}
        </p>
    </div>
</div>
<div class='review_area'>
    <form method='post' action="{{ route('admin.review.edit.store', $review->id) }}">
    @csrf
        <div style='margin-bottom: 8px;'>
             {{ 'ID'.'  '.$review->id }}
        </div>
        <div>
            <label>商品評価
                <select name="evaluation">
                    @for($i=1; $i<6;$i++)
                        <option value={{ $i }}
                        @if($i == old('evaluation'))
                            {{ 'selected' }}
                        @elseif(session()->has('evaluation') && (int)session()->get('evaluation') === (int)$i && empty(old('evaluation')))
                            {{ 'selected' }}
                        @elseif($review->evaluation === $i && session()->has('evaluation') === false && empty(old('evaluation')))
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
                <input class='blue_btn' type="submit" value="確認画面へ">
            </a>
        </p>
        <p class="btn-container">
            <a href='{{ route('admin.review') }}' class='back_btn_blue'>レビュー管理に戻る</a>
        </p>
    </form>
</div>
@endsection
