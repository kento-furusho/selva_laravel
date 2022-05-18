@extends('layouts.app')
@section('title', '会員情報変更')
@section('content')
<form class='forms' method="post" action="{{ route('store.edit.password') }}">
    @csrf
    <h2>パスワード変更</h2>

    <p>
        <label for="password">パスワード</label>
        <input style="margin-left: 37px;" class='form_last_3' type="password" name='password' id='password'>
    </p>
    @error('password')
        <div class="err_msg">
            {{ $message }}
        </div>
    @enderror

    <p>
        <label for="re_password">パスワード確認</label>
        <input style="margin-left: 5px;" class='form_last_3' type="password" name='re_password' id='re_password'>
    </p>
    @error('re_password')
        <div class="err_msg">
            {{ $message }}
        </div>
    @enderror

    <p>

    <div class='btn-container'>
        <a>
        <input class="btn" type="submit" value="パスワードを変更">
        </a>
    </div>
    <div class='btn-container'>
        <a class="back_btn" href="{{ route('member.show') }}">
            <span>マイページに戻る</span>
        </a>
    </div>
    </form>
@endsection
