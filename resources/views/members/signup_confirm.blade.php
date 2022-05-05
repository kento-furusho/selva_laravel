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
          <a class="btn" href="{{ route('member.send') }}">
            <span>登録完了</span>
          </a>
        </div>
        <div class='btn-container'>
          <a class="back_btn" href="{{ route('member.signup') }}">
            <span>前に戻る</span>
          </a>
        </div>
  </div>
</body>
</html>

