@extends('layouts.app')
@section('title', 'ログイン画面')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
                <h2 class='login_h2'>{{ __('ログイン') }}</h2>

                <div class="">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class='form-group row'>
                            <label class='col-md-4 col-form-label' for='email'>{{ __('メールアドレス(ID)') }}</label>
                            <div class='col-md-6'>

                                <input id='email' type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class='form-group row' style='margin-top: 20px;'>
                            <label class='col-md-4 col-form-label' for="password">{{ __('パスワード') }}</label>
                            <div class='col-md-6'>
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        {{-- <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div> --}}


                        <div style="text-align: center; margin:30px auto;">
                            @if (Route::has('password.request'))
                                <a class="btn-link" href="{{ route('password.request') }}">
                                    {{ __('パスワードを忘れた方はこちら') }}
                                </a>
                            @endif
                        </div>
                        <p style="text-align: center; margin:20px auto;">
                            <button type="submit" class="btn" style="text-align: center;">
                                {{ __('ログイン') }}
                            </button>
                        </p>
                        <div class='btn-container'>
                            <a class="back_btn text-decoration:none;" href="{{ route('member.index') }}">
                                <span>トップに戻る</span>
                            </a>
                        </div>
                        </form>
                </div>
        </div>
    </div>
</div>
@endsection
