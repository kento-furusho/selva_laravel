@extends('layouts.admin')
@section('title', '管理画面メインメニュー')
@section('header')
    @extends('headers.admins.login')
@endsection
@section('content')
<div class='admin_container'>
    <p style='padding:15px 35px;'>
        <a class='back_btn_blue' href="{{ route('admin.member') }}">会員一覧</a>
    </p>
</div>
@endsection
