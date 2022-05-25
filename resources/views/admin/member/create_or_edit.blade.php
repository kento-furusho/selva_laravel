@extends('layouts.admin')
@section('title', '管理画面')
@section('header')
    @extends('headers.admins.create_or_edit')
    @if(!empty($member))
        @section('create_title', '会員編集')
    @else
        @section('create_title', '会員登録')
    @endif
    @section('back_page_btn')
        <a class="header-btn right-side-btn" href="{{ route('admin.member') }}">一覧に戻る</a>
    @endsection
@endsection
@section('content')
<form class='forms' method="post" action="
    @if(!empty($member))
        {{ route('admin.member.edit.store', $member->id) }}
    @else
        {{ route('admin.member.create.store') }}
    @endif
">
    @csrf

    <p>
        @if(!empty($member))
            {{ 'ID'.'  '.$member->id }}
        @else
            {{ 'ID  登録後に自動採番' }}
        @endif
    </p>
    <p>氏名
        <label for="name_sei">姓</label>
        <input class='input_name' type="text" name='name_sei' id='name_sei'
        @if(old('name_sei'))
            value = '{{ old('name_sei') }}'
        @elseif(session()->has('name_sei'))
            value = '{{ session()->get('name_sei') }}'
        @elseif(!empty($member))
            value = '{{ $member->name_sei }}'
        @endif
        >

        <label for="name_mei">名</label>
        <input class='input_name' type="text" name='name_mei' id='name_mei'
        @if(old('name_mei'))
            value = '{{ old('name_mei') }}'
        @elseif(session()->has('name_mei'))
            value = '{{ session()->get('name_mei') }}'
        @elseif(!empty($member))
            value = '{{ $member->name_mei }}'
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
        @elseif(session()->has('nickname'))
            value = '{{ session()->get('nickname') }}'
        @elseif(!empty($member))
            value = '{{ $member->nickname }}'
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
            @elseif(session()->has('gender') && session()->get('gender') === $index)
                {{ 'checked' }}
            @elseif(!empty($member) && $member->gender === $index)
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
        @elseif(session()->has('email'))
            value = '{{ session()->get('email') }}'
        @elseif(!empty($member))
            value = '{{ $member->email }}'
        @endif>
    </p>
    @error('email')
        <div class="err_msg">
            {{ $message }}
        </div>
    @enderror

    <div class='btn-container'>
        <a>
        <input class="back_btn_blue" type="submit" value="確認画面へ">
        </a>
    </div>
    </form>
@endsection
