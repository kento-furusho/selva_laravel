@extends('layouts.app')
@section('title', '会員情報登録')
@section('content')
    <form class='forms' method="post" action="{{ route('member.store')}}">
    @csrf
    <h2>会員情報登録</h2>

    <p>氏名
        <label for="name_sei">姓</label>
        <input class='input_name' type="text" name='name_sei' id='name_sei'
        @if(old('name_sei'))
            value = '{{ old('name_sei') }}'
        @elseif(!empty($name_sei))
            value = '{{ $name_sei }}'
        @endif
        >

        <label for="name_mei">名</label>
        <input class='input_name' type="text" name='name_mei' id='name_mei'
        @if(old('name_mei'))
            value = '{{ old('name_mei') }}'
        @elseif(!empty($name_mei))
            value = '{{ $name_mei }}'
        @endif
        >
    </p>
    @error('name_sei')
        <div class="err_msg">
            {{ $message }}
        </div>
    @enderror
    @error('name_mei')
        <div class="err_msg">
            {{ $message }}
        </div>
    @enderror

    <p>
        <label for="nickname">ニックネーム</label>
        <input style="margin-left: 21px;" class='form_last_3' type="text" name='nickname' id='nickname'
        @if(old('nickname'))
            value = '{{ old('nickname') }}'
        @elseif(!empty($nickname))
            value = '{{ $nickname }}'
        @endif
        >
    </p>
    @error('nickname')
        <div class="err_msg">
            {{ $message }}
        </div>
    @enderror

    {{-- マスター値:config/master.php --}}
    <p><span style="margin-right: 40px;">性別</span>
        @foreach(config('master') as $index => $gender)
            <input type="radio" name="gender" value='{{ $index }}'
            @if(old('gender') == $index)
                {{ 'checked' }}
            @elseif(!empty($ss_gender) && $ss_gender == $index)
                {{ 'checked' }}
            @endif
            >{{ $gender }}
        @endforeach
    </p>
    @error('gender')
        <div class="err_msg">
            {{ $message }}
        </div>
    @enderror

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
        <label for="email">メールアドレス</label>
        <input style="margin-left: 5px;" class='form_last_3' type="text" name='email' id='email'
        @if(old('email'))
            value = '{{ old('email') }}'
        @elseif(!empty($email))
            value = '{{ $email }}'
        @endif>
    </p>
    @error('email')
        <div class="err_msg">
            {{ $message }}
        </div>
    @enderror

    <div class='btn-container'>
        <a>
        <input class="btn" type="submit" value="確認画面へ">
        </a>
    </div>
    <div class='btn-container'>
        <a class="back_btn" href="{{ route('member.index') }}">
            <span>トップに戻る</span>
        </a>
    </div>
    </form>
@endsection
