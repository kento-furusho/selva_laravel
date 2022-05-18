@extends('layouts.app')
@section('title', 'メールアドレス変更認証完了ページ')
@section('content')
  <div class="container">
        <form id="myForm" method='post' action="{{ route('send.edit.email') }}">
            @csrf
            <h2 style="margin:50px; font-weight: bolder; font-size:25px;">メールアドレス変更 認証コード入力</h2>
            <div style='width:526px;' class='content'>
                <p>
                    （※ メールアドレスの変更はまだ完了していません）<br>
                    変更後のメールアドレスにお送りしましたメールに記載されている「認証コード」を
                    入力してください
                </p>
                <p style='margin:27px;'>
                    <label for="auth_code">認証コード</label>
                    <input style="margin-left: 37px;" class='form_last_3' type="text" name='input_auth_code' id='auth_code'>
                </p>
                <div class='err_msg' style='text-align: center; margin-left:0;'>
                    @if(isset($error))
                        {{ $error }}
                    @endif
                </div>
            </div>
            <div class='btn-container'>
                {{-- 二重登録防止 --}}
                <script src="{{ asset('js/common.js') }}"></script>
                <input class="btn" type="submit" value="認証コードを送信してメールアドレスの変更を完了する">
            </div>
        </form>
    </div>
@endsection
