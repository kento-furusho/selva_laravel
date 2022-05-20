@extends('layouts.app')
@section('title', 'メールアドレス変更')
@section('content')
<form style='width:586px;' class='forms' method="post" action="{{ route('validate.edit.email') }}">
    @csrf
    <h2 style='margin-top:45px;'>メールアドレス変更</h2>

    <p style='margin:45px;'><span class="mypage_email">現在のメールアドレス</span>
        <span style='color: #6495ed;'>
            {{ auth()->user()->email }}
        </span>
    </p>
    <p style='margin:45px;'>
        <label for="email">変更後のメールアドレス</label>
        <input style="margin-left: 5px;" class='form_last_3' type="text" name='email' id='email'
        @if(old('email'))
            value = '{{ old('email') }}'
        @elseif(!empty($email))
            value = '{{ $email }}'
        @endif>
    </p>
    @error('email')
        <div class="err_msg" style='text-align: center; margin-left:0;'>
            {{ $message }}
        </div>
    @enderror

    <div class='btn-container'>
        <a>
        <input class="btn" type="submit" value="認証メール送信">
        </a>
    </div>
    <div class='btn-container'>
        <a class="back_btn" href="{{ route('member.show') }}">
            <span>マイページに戻る</span>
        </a>
    </div>
    </form>
@endsection
