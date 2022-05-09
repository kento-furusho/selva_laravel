<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <link rel="stylesheet" href="{{ url('css/style.css') }}">
  <title>@yield('title')</title>
</head>
<body>
    @yield('header')
    @yield('content')
</body>
</html>
