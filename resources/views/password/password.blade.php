{{-- @extends('layouts.app')
@section('title', 'パスワードリセット画面')
@section('content')
<form class='login-forms' method="post" action="{{ route('password.store') }}">
    @csrf
    <p>
        <label for="email">メールアドレス</label>
        <input class='login_form_email' type="text" name='email' id='email'>
    </p>
    @error('email')
        <div style='margin-left:45px; text-align:center;' class='err_msg'>
            {{ $message }}
        </div>
    @enderror

    <div class='btn-container login-btn'>
        <input class="btn" type="submit" value="ログイン">
    </div>
    <div class='btn-container'>
        <a class="back_btn" href="{{ route('member.index') }}">
            <span>トップに戻る</span>
        </a>
    </div>
    </form>
@endsection --}}
