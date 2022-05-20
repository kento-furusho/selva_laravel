@extends('layouts.app')
@section('title', 'マイページ')
@section('header')
    @extends('headers.mypage_header')
@endsection
@section('content')
<div class="container">
    <div class='mypage_content'>
        <p><span class="mypage_name">氏名</span>
            {{ auth()->user()->name_sei }}
            {{ auth()->user()->name_mei }}
        </p>
        <p><span class="mypage_nickname">ニックネーム</span>
            {{ auth()->user()->nickname }}
        </p>
        <p><span class="mypage_gender">性別</span>
            <?php
            if(auth()->user()->gender === 1) {
                echo "男性";
            } elseif (auth()->user()->gender === 2) {
                echo "女性";
            }
            ?>
        </p>
        <p style="text-align: center; margin:36px;">
            <a class='blue_btn' href="{{ route('edit.profile') }}">会員情報変更</a>
        </p>
        <p><span class="mypage_pass">パスワード</span>
            <?= 'セキュリティのため非表示'?>
        </p>
        <p style="text-align: center; margin:36px;">
            <a class='blue_btn' href="{{ route('edit.password') }}">パスワード変更</a>
        </p>
        <p><span class="mypage_email">メールアドレス</span>
            <span style='color: #6495ed;'>
                {{ auth()->user()->email }}
            </span>
        </p>
        <p style="text-align: center; margin:36px;">
            <a class='blue_btn' href="{{ route('edit.email') }}">メールアドレス変更</a>
        </p>
        <p style="text-align: center; margin:36px;">
            <a class='blue_btn' href="{{ route('member.reviews') }}">商品レビュー管理</a>
        </p>
        <p style="text-align: center; margin-top:35px;">
            <a class='back_btn_blue' href="{{ route('member.delete.confirm') }}">退会</a>
        </p>
    </div>
</div>
@endsection
