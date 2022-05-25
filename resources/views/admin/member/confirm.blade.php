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
<div class="container">
    <form id="myForm" method='post' action="
    @if(!empty($member))
    {{ route('admin.member.edit.send', $member->id) }}
    @else
    {{ route('admin.member.create.send') }}
    @endif
    ">
        @csrf
        <input type="hidden" name="name_sei" value="{{ session()->get('name_sei') }}">
        <input type="hidden" name="name_mei" value="{{ session()->get('name_mei') }}">
        <input type="hidden" name="nickname" value="{{ session()->get('nickname') }}">
        <input type="hidden" name="gender" value="{{ session()->get('gender') }}">
        <input type="hidden" name="password" value="{{ session()->get('password') }}">
        <input type="hidden" name="email" value="{{ session()->get('email') }}">
        <div class='content'>
        <p>
            @if(!empty($member))
                {{ 'ID'.'  '.$member->id }}
            @else
                {{ 'ID  登録後に自動採番' }}
            @endif
        </p>
        <p>氏名
            {{ session()->get('name_sei') }}
            {{ session()->get('name_mei') }}
        </p>
        <p>ニックネーム
            {{ session()->get('nickname') }}
        </p>
        <p>性別
            <?php
            if(session()->get('gender') === '1') {
                echo "男性";
            } elseif (session()->get('gender') === '2') {
                echo "女性";
            }
            ?>
        </p>
        <p>パスワード
            {{ 'セキュリティのため非表示' }}
        </p>
        <p>メールアドレス
            <span style='color: #6495ed;'>
                {{ session()->get('email') }}
            </span>
        </p>
        </div>
        <div class='btn-container'>
            {{-- 二重登録防止 --}}
            <script src="{{ asset('js/common.js') }}"></script>
            <input class="blue_btn" type="submit" value=
            @if(!empty($member))
            {{ '編集完了' }}
            @else
            {{ '登録完了' }}
            @endif>
        </div>
    </form>
</div>
@endsection
