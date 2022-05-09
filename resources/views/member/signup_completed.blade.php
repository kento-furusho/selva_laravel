@extends('layouts.app')
@section('title', '会員登録完了')
@section('content')
    <div class="regist_completed">
        <h2>会員登録完了</h2>
        <p>会員登録が完了しました。</p>
    </div>
    <div class='btn-container'>
        <a class="btn" href="{{ route('member.index') }}">
            <span>トップに戻る</span>
        </a>
    </div>
@endsection
