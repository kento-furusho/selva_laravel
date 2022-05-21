<html>
<head>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
  <div class="container">
    <h1>管理者ログイン</h1>
    @error('login')
    <div class="alert alert-danger">
        &#x26A0; {{ $message }}
    </div>
    @enderror
    <form method="POST" action={{ route('admin.login.login') }}>
      @csrf
      <label class="mt-3">ログインID</label>
      <input type="text" name="login_id" class="form-control">
      <label class="mt-3">パスワード</label>
      <input class="form-control" type="password" name="password">
      <button class="btn btn-primary mt-5" type="submit">ログイン</button>
    </form>
  </div>
</body>
</html>
