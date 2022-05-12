@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            @if (session('status'))
                <div style="margin: 40px">
                    <p style="text-align: center;">
                        パスワード再設定の案内メールを送信しました。<br>（まだパスワード再設定は完了しておりません）<br>届きましたメールに記載されている<br>『パスワード再設定URL』をクリックし、<br>パスワードの再設定を完了させてください。
                    </p>
                </div>
            @else
            <div style="margin: 50px 0 30px 0">
                <p style='text-align:center;'>
                    パスワード再設定用のURLを記載したメールを送信します。<br>
                    ご登録されたメールアドレスを入力してください。
                </p>
            </div>
            <form method="POST" action="{{ route('password.email') }}">
                @csrf

                <div class="form-group row">
                    <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('メールアドレス') }}</label>

                    <div class="col-md-6">
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>


                <div style='margin:40px auto; text-align:center;'>
                    <button type="submit" class="btn">
                        {{ __('送信する') }}
                    </button>
                </div>
            </form>
            @endif
            <div class='btn-container'>
                <a class="back_btn" href="{{ route('member.index') }}">
                    <span>トップに戻る</span>
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
