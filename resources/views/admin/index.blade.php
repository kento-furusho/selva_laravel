<html>
<head>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
  <div class="container">
    <h1>管理画面トップ</h1>

    @if (session('login_msg'))
    <div class="alert alert-success">
      {{ session('login_msg') }}
    </div>
    @endif

    @if (Auth::guard('administers')->check())
    <div>ユーザーID {{ Auth::guard('administers')->user()->name }}でログイン中</div>
    @endif

    <ul>
      <li>管理者（Administrator）ログイン状態: {{ Auth::guard('administers')->check() }}</li>
    </ul>

    <div>
      <a href="/admin/logout">ログアウト</a>
    </div>
  </div>

</body>
</html>
