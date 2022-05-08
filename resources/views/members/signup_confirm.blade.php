<!DOCTYPE html>
<html lang="jn">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="{{ url('css/style.css') }}">
  <title>会員情報確認画面</title>
</head>
<body>
  <div class="container">
        <form id="myForm" action="{{ route('member.send') }}">
            @csrf
            <input type="hidden" name="name_sei" value="{{ $name_sei }}">
            <input type="hidden" name="name_mei" value="{{ $name_mei }}">
            <input type="hidden" name="nickname" value="{{ $nickname }}">
            <input type="hidden" name="gender" value="{{ $gender }}">
            <input type="hidden" name="password" value="{{ $password }}">
            <input type="hidden" name="email" value="{{ $email }}">

            <h2 style="margin-top:30px;">会員情報確認画面</h2>
            <div class='content'>
            <p>氏名
                {{ $name_sei }}
                {{ $name_mei }}
            </p>
            <p>ニックネーム
                {{ $nickname }}
            </p>
            <p>性別
                <?php
                if($gender === '1') {
                    echo "男性";
                } elseif ($gender === '2') {
                    echo "女性";
                }
                ?>
            </p>
            <p>パスワード
                <?= 'セキュリティのため非表示'?>
            </p>
            <p>メールアドレス
                <span style='color: #6495ed;'>
                    {{ $email }}
                </span>
            </p>
            </div>
            <div class='btn-container'>
                {{-- 二重登録防止 --}}
                <script src="{{ asset('js/common.js') }}"></script>
                <input class="btn" type="submit" value="登録完了">
            </div>
            <div class='btn-container'>
                <a class="back_btn" href="{{ route('member.signup') }}">
                    <span>前に戻る</span>
                </a>
            </div>
        </form>
    </div>
</body>
</html>


