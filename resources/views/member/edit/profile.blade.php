@extends('layouts.app')
@section('title', '会員情報変更')
@section('content')
<form class='forms' method="post" action="{{ route('store.edit.profile') }}">
    @csrf
    <h2>会員情報登録</h2>

    <p>氏名
        <label for="name_sei">姓</label>
        <input class='input_name' type="text" name='name_sei' id='name_sei'
        @if(old('name_sei'))
            value = '{{ old('name_sei') }}'
        @elseif(session()->has('name_sei'))
            value = '{{ session()->get('name_sei') }}'
        @else
            value= '{{ auth()->user()->name_sei }}'
        @endif
        >

        <label for="name_mei">名</label>
        <input class='input_name' type="text" name='name_mei' id='name_mei'
        @if(old('name_mei'))
            value = '{{ old('name_mei') }}'
        @elseif(session()->has('name_mei'))
            value = '{{ session()->get('name_mei') }}'
        @else
            value= '{{ auth()->user()->name_mei }}'
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
        @else
            value= '{{ auth()->user()->nickname }}'
        @endif
        >
    </p>
    @error('nickname')
        <div class="err_msg">
            {{ $message }}
        </div>
    @enderror

    {{-- マスター値:config/master.php --}}
    <p><span style="margin-right: 83px;">性別</span>
        @foreach(config('master') as $index => $gender)
            <input type="radio" name="gender" value='{{ $index }}'
            @if(old('gender') == $index)
                {{ 'checked' }}
            @elseif(session()->has('gender') && session()->get('gender') == $index)
                {{ 'checked' }}
            @elseif(auth()->user()->gender == $index)
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

    <div class='btn-container'>
        <a>
        <input class="btn" type="submit" value="確認画面へ">
        </a>
    </div>
    <div class='btn-container'>
        <a class="back_btn" href="{{ route('member.show') }}">
            <span>マイページに戻る</span>
        </a>
    </div>
    </form>
@endsection
