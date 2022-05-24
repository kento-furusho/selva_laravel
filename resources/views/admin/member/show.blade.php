@extends('layouts.admin')
@section('title', '会員詳細画面')
@section('header')
    @extends('headers.admins.create_or_edit')
    @section('create_title', '会員詳細')
@endsection
@section('content')
<div class="container">
    <div class='mypage_content'>
        <p><span class="mypage_id">ID</span>
            {{ $member->id }}
        </p>
        <p><span class="mypage_name">氏名</span>
            {{ $member->name_sei }}
            {{ $member->name_mei }}
        </p>
        <p><span class="mypage_nickname">ニックネーム</span>
            {{ $member->nickname }}
        </p>
        <p><span class="mypage_gender">性別</span>
            <?php
            if($member->gender === 1) {
                echo "男性";
            } elseif ($member->gender === 2) {
                echo "女性";
            }
            ?>
        </p>
        <p><span class="mypage_pass">パスワード</span>
            <?= 'セキュリティのため非表示'?>
        </p>
        <p><span class="mypage_email">メールアドレス</span>
            <span style='color: #6495ed;'>
                {{ $member->email }}
            </span>
        </p>
        <p style="text-align: center; margin-top:35px;">
            <a class='back_btn_blue' href="{{ route('admin.member.edit', $member->id) }}">編集</a>
            <a class='back_btn_blue' href="{{ route('admin.member.delete', $member->id) }}">削除</a>
        </p>
    </div>
</div>
@endsection
