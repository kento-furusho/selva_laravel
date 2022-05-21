<header class="admin_header">
      <div class="header-left">
        <h2 style="
        line-height: 60px;
        margin-left: 15px;
        font-size: 19px;
        font-weight: bold;">
          管理画面メインメニュー
        </h2>
      </div>
      <div class="header-right">
        <span style="margin-right: 15px;" class="welcome-msg">ようこそ
            @if (Auth::guard('administers')->check())
                {{ Auth::guard('administers')->user()->name }}
            @endif
          さん
        </span>
        <a class="header-btn right-side-btn" href="/admin/logout">ログアウト</a>
      </div>
  </header>
