{{-- ログイン時ヘッダー --}}
<header>
    <div class="header-left">
        @if(auth()->user())
            <p class="welcome-msg">
                <span>ようこそ</span>
                {{ auth()->user()->name_sei }}
                {{ auth()->user()->name_mei }}
                <span>様</span>
            </p>
        @else
        @endif
    </div>
    <div class="header-right">
        @if(auth()->user())
            <a class="header-btn" href="{{ route('product.create') }}">
                新規商品登録
            </a>
            <form style='display:inline-block; margin-left: 20px;' method="post" action="{{ route('logout') }}">
            @csrf
                <a class="header-btn right-side-btn">
                    <input class='logout-btn' type="submit" value="ログアウト">
                </a>
            </form>

        @else
            <a class="header-btn" href="{{ route('member.signup') }}">新規会員登録</a>
            <a class="header-btn right-side-btn" href="{{ route('login') }}">ログイン</a>
        @endif
    </div>
</header>
