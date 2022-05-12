@extends('layouts.app')
@section('title', 'パスワード再設定')
@section('header')
    @extends('headers.nobtn_header')
@endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div style='margin-top:40px;'class="col-md-8">
            <form method="POST" action="{{ route('password.update') }}">
                @csrf

                <input type="hidden" name="token" value="{{ $token }}">



                    <div class="col-md-6">
                        <input id="email" type="hidden" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>

                        {{-- @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror --}}
                    </div>

                <div class="form-group row">
                    <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('パスワード') }}</label>

                    <div class="col-md-6">
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('パスワード確認') }}</label>

                    <div class="col-md-6">
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                    </div>
                </div>

                <div style='margin:40px auto; text-align:center;'>
                    <button type="submit" class="btn">
                        {{ __('パスワードリセット') }}
                    </button>
                </div>
                <div class='btn-container'>
                    <a class="back_btn text-decoration:none;" href="{{ route('member.index') }}">
                        <span>トップに戻る</span>
                    </a>
                </div>
            </form>
    </div>
</div>
@endsection
