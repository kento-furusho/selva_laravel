@extends('layouts.app')
@section('title', '商品検索')
@section('header')
    @extends('headers.search_header')
@endsection
@section('content')
    <div class='search_area'>
        <form class='search_form' method='get' action="{{ route('product.search') }}">
        @csrf
            <p>
                <label for="category">商品カテゴリ</label>
                <select name="category" id="category" required>
                    <option value="0">選択してください</option>
                    @foreach ($categories as $category)
                    <option value={{ $category->id }}>{{ $category->name }}</option>
                    @endforeach
                </select>
                <select name="subcategory" id="subcategory">
                    <option value="0">----------</option>
                    {{-- エラーの時 --}}
                </select>
            </p>
            <p>
                <label for="free_word">フリーワード</label>
                <input name='free_word' id='free_word' type="text">
            </p>
            <p>
                <a>
                    <input class="pro_search_btn" type="submit" value="商品検索">
                </a>
            </p>
        </form>
    </div>
    {{-- 検索結果表示 --}}
    @if(!empty($products))
        @foreach ($products as $product)
            <div class='product'>
                <div class='product_left'>
                    <img class='img' src="{{ '../../storage/' . $product->image_1 }}">
                </div>
                <div class='product-right'>
                    <p class='category'>
                        @foreach ($categories as $category)
                            @if($category->id == $product->product_category_id)
                                    {{ $category->name }}
                            @endif
                        @endforeach
                        <span>&gt;</span>
                        @foreach ($subcategories as $subcategory)
                            @if($subcategory->id == $product->product_subcategory_id)
                                {{ $subcategory->name }}
                            @endif
                        @endforeach
                    </p>
                    <p>
                        <a href="{{ route('product.show', $product->id) }}">
                            {{ $product->name }}
                        </a>
                    </p>
                    <p style='margin-bottom:0;'>
                        {{ (getReviewAverage($product->id)) }}
                    </p>
                    <p class='show_btn_container'>
                        <a class="blue_btn" href="{{ route('product.show', $product->id) }}">
                            詳細
                        </a>
                    </p>
                </div>
            </div>
        @endforeach
    @endif
    {{-- ページネーション --}}
    <div class="pagination_container">
        <p class='pagination'>
            @if(empty(request()->query()))
                {{ $products->links('vendor.pagination.custom-pagination') }}
            @else
                {{ $products->appends(request()->query())->links('vendor.pagination.custom-pagination') }}
            @endif
        </p>
    </div>
    <div class='btn-container'>
        <a class="back_btn_blue" href="{{ route('member.index') }}">
            <span>トップに戻る</span>
        </a>
    </div>
    <script>
        $(function() {
            $('#category').change(function() {
                $('#subcategory').empty();
                let category_id = $(this).val();
                $.ajax({
                    url:'/product/create/get_subcategory/'+category_id,
                    type: 'GET'
                }).done((data) => {
                    $('#subcategory').append("<option value='0'>--------</option>")
                    $(data.subcategories).each((i, category) => {

                        $('#subcategory').append('<option value='+category.id+'>'+category.name+'</option>')
                    })
                })
            })
        })
    </script>
@endsection
