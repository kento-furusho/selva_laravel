@extends('layouts.admin')
@section('title', '管理画面')
@section('header')
    @extends('headers.admins.logout')
@endsection
@section('content')
    <form class='admin-forms' method="POST" action={{ route('admin.login.login') }}>
      @csrf
      <h2>管理画面</h2>
      <p>
        <label for="login_id">ログインID</label>
        <input class='admin_form_email' type="text" name="login_id" value='{{ old('login_id') }}'>
      </p>
      @error('login_id')
        <div style='margin-left:0px;'class="err_msg">
             {{ $message }}
        </div>
      @enderror
      <p>
        <label for="password">パスワード</label>
        <input class='admin_form_pass' type="password" name="password" id='password'>
      </p>
      @error('password')
        <div style='margin-left:0px;'class="err_msg">
             {{ $message }}
        </div>
      @enderror
      @error('login')
        <div style='margin-left:0px;'class="err_msg">
             {{ $message }}
        </div>
      @enderror
      <div class='btn-container login-btn'>
        <a>
          <input class="blue_btn" type="submit" value="ログイン">
        </a>
      </div>
    </form>
@endsection
