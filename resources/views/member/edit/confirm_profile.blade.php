@extends('layouts.app')
@section('title', '会員情報変更確認画面')
@section('content')
  <div class="container">
        <form id="myForm" method='post' action="{{ route('send.edit.profile') }}">
            @csrf
            <input type="hidden" name="name_sei" value="{{ session()->get('name_sei') }}">
            <input type="hidden" name="name_mei" value="{{ session()->get('name_mei') }}">
            <input type="hidden" name="nickname" value="{{ session()->get('nickname') }}">
            <input type="hidden" name="gender" value="{{ session()->get('gender') }}">

            <h2 style="margin-top:30px;">会員情報変更確認画面</h2>
            <div class='content'>
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
            </div>
            <div class='btn-container'>
                {{-- 二重登録防止 --}}
                <script src="{{ asset('js/common.js') }}"></script>
                <input class="btn" type="submit" value="変更完了">
            </div>
            <div class='btn-container'>
                <a class="back_btn" href="{{ route('edit.profile') }}">
                    <span>前に戻る</span>
                </a>
            </div>
        </form>
    </div>
@endsection
