{{-- ログイン時ヘッダー --}}
<header>
    <div class="header-left">
    <p class="welcome-msg">
        {{ $full_name }}
        <span>様</span>
    </p>
    </div>
    <div class="header-right">
    <a class="header-btn right-side-btn" href="{{ route('logout') }}">ログアウト</a>
    </div>
</header>
