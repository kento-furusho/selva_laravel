<header>
    <div class="header-left">
    <h2 style="
    line-height: 60px;
    margin-left: 15px;
    font-size: 22px;
    font-weight: bold;">
        マイページ
    </h2>
    </div>
    <div class="header-right">
        <a class="header-btn right-side-btn" href="{{ route('member.index')}}">
            トップに戻る
        </a>
        <form style='display:inline-block; margin-left: 4px;' method="post" action="{{ route('logout') }}">
        @csrf
            <a class="header-btn right-side-btn">
                <input class='logout-btn' type="submit" value="ログアウト">
            </a>
        </form>
    </div>
</header>
