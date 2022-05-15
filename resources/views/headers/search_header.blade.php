<header>
    <div class="header-left">
    <h2 style="
    line-height: 60px;
    margin-left: 15px;
    font-size: 22px;
    font-weight: bold;">
        商品一覧
    </h2>
    </div>
    <div class="header-right">
        @if(auth()->user())
            <a class="header-btn right-side-btn" href="{{ route('product.create') }}">
                新規商品登録
            </a>
        @endif
    </div>
</header>
