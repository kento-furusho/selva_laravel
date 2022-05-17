@extends('layouts.app')
@section('title', 'マイページ')
<header>
    <div class="header-left">
    </div>
    <div class="header-right">
        <a class="header-btn right-side-btn" href="{{ route('member.index')}}">
            トップに戻る
        </a>
        <form style='display:inline-block; margin-left: 4px;' method="post" action="{{ route('logout') }}">
        @csrf
            <a class="header-btn right-side-btn">
                <input class='logout-btn' type="submit" value="ログアウト">
            </a>
        </form>
    </div>
</header>
@section('content')
<div class="delete_confirm_content">
    <p style='margin:60px;'>
        退会します。よろしいですか？
    </p>
    <p>
        <a class='back_btn_blue' href="{{ route('member.index') }}">マイページに戻る</a>
    </p>
    <p>
        <a class='blue_btn' href="{{ route('member.delete') }}">退会する</a>
    </p>
</div>
@endsection
