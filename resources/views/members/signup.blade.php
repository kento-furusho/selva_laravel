<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <link rel="stylesheet" href="{{ url('css/style.css') }}">
  <title>会員情報登録フォーム</title>
</head>
<body>
<form class='forms' method="post" action="{{ route('member.store')}}">
    @csrf
    <h2>会員情報登録</h2>

    <p>氏名
        <label for="name_sei">姓</label>
        <input class='input_name' type="text" name='name_sei' id='name_sei'
        @if(old('name_sei'))
            value = '{{ old('name_sei') }}'
        @elseif(!empty($name_sei))
            value = '{{ $name_sei }}'
        @endif
        >

        <label for="name_mei">名</label>
        <input class='input_name' type="text" name='name_mei' id='name_mei'
        @if(old('name_mei'))
            value = '{{ old('name_mei') }}'
        @elseif(!empty($name_mei))
            value = '{{ $name_mei }}'
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
        @elseif(!empty($nickname))
            value = '{{ $nickname }}'
        @endif
        >
    </p>
    @error('nickname')
        <div class="err_msg">
            {{ $message }}
        </div>
    @enderror

    <p>性別
        <input style="margin-left: 20px;" type="radio" name='gender' value='1'
        @if(old('gender') == '1')
            {{ 'checked' }}
        @elseif(!empty($gender) && $gender == '1')
            {{ 'checked' }}
        @endif
        >男性
        <input type="radio" name='gender' value='2'
        @if(old('gender') == '2')
            {{ 'checked' }}
        @elseif(!empty($gender) && $gender == '2')
            {{ 'checked' }}
        @endif
        >女性
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
        @elseif(!empty($email))
            value = '{{ $email }}'
        @endif>
    </p>
    @error('email')
        <div class="err_msg">
            {{ $message }}
        </div>
    @enderror

    <div class='btn-container'>
        <a>
        <input class="btn" type="submit" value="確認画面へ">
        </a>
    </div>
    </form>
</body>
</html>
