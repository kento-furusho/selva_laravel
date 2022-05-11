@extends('layouts.app')
@section('title', '商品登録')
@section('content')
    <form class='forms' method="post" action="">
    @csrf
    <h2>商品登録</h2>

    <p>
        <label for="name" id="name">商品名</label>
        <input style="margin-left: 21px;" class='form_last_3' type="text" name='name' id='name'
        {{-- @if(old('name'))
            value = '{{ old('name') }}'
        @elseif(!empty($name))
            value = '{{ $name }}'
        @endif --}}
        >
    </p>

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
    <button>go</button>
    <p>おはよう</p>
    <script>
    </script>
@endsection
