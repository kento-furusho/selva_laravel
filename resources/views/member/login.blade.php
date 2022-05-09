@extends('layouts.app')
@section('title', 'ログイン画面')
@section('content')
<form class='login-forms' method="post" action="{{ route('login.send') }}">
    @csrf
    <h2>ログイン</h2>
    {{-- アドレス --}}
    <p>
        <label for="email">メールアドレス(ID)</label>
        <input class='login_form_email' type="text" name='email' id='email'
        @if(old('email'))
            value = '{{ old('email') }}'
        @elseif(!empty(session('email')))
            value = '{{ session('email') }}'
        @endif
        >
    </p>
    @error('email')
        <div style='margin-left:45px; text-align:center;' class='err_msg'>
            {{ $message }}
        </div>
    @enderror
    {{-- パスワード --}}
    <p>
        <label for="password">パスワード</label>
        <input class='login_form_pass' type="password" name='password' id='password'>
    </p>
    @error('password')
        <div style='margin-left:45px; text-align:center;' class='err_msg'>
            {{ $message }}
        </div>
    @enderror

    {{-- ログインエラー --}}
    @if(!empty(session('login_err_msg')))
        <div style='margin-left:45px; text-align:center;' class='err_msg'>
            {{ session('login_err_msg') }}
        </div>
    @endif

    <div class='btn-container login-btn'>
        <input class="btn" type="submit" value="ログイン">
    </div>
    <div class='btn-container'>
        <a class="back_btn" href="{{ route('member.index') }}">
            <span>トップに戻る</span>
        </a>
    </div>
    </form>
@endsection
