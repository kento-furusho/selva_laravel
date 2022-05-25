@extends('layouts.admin')
@section('title', '商品カテゴリー一覧')
@section('header')
    @extends('headers.admins.search')
    @section('search_title', '商品カテゴリー一覧')
@endsection
@section('content')
<div class='btn-container'>
    <a href="{{ route('admin.category.create') }}">
        <input class="blue_btn" type="submit" value="商品カテゴリー登録">
    </a>
</div>
<form method="get" action="{{ route('admin.category.search') }}">
    @csrf
    <table class="search_table">
      <tr>
        <td class="search_title">
          <label class="title_txt" for="id">ID</label>
        </td>
        <td>
          <input class="search_content" type="text" name="id" id="id" value=''>
        </td>
      </tr>
      <tr>
        <td class="search_title">
          <label class="title_txt" for="free_word">フリーワード</label>
        </td>
        <td>
          <input class="search_content" type="text" name="free_word" id="free_word" value=''>
        </td>
      </tr>
    </table>
    <div class="btn-container">
      <input style="padding:9px 41px" class="back_btn_blue" type="submit" name="search" value="検索する">
    </div>
  </form>
  <!------ カテゴリー表示テーブル ------>
  <div>
  <table class="member_table">
      <thead>
        <tr class="member_ths">
          <th class="member_th">
            ID
            <!------ 昇順降順ボタン ------>
            @if(session()->get('order')==='desc')
                <form style="display:inline-block;" action="{{ route('admin.category.order_asc') }}" method="get">
                    <input type="hidden" name="id" value={{ Request::get('id') }}>
                    <input type="hidden" name="free_word" value={{ Request::get('free_word') }}>
                    <button class="arrow" type="submit">▼</button>
                </form>
            @elseif(session()->get('order')==='asc')
                <form style="display:inline-block;" action="{{ route('admin.category.order_desc') }}" method="get">
                    <input type="hidden" name="id" value={{ Request::get('id') }}>
                    <input type="hidden" name="free_word" value={{ Request::get('free_word') }}>
                    <button class="arrow" type="submit">▲</button>
                </form>
            @endif
          </th>
          <th class="member_th">商品カテゴリ大</th>
          <th class="member_th">
            登録日時
            <!------ 昇順降順ボタン ------>
            @if(session()->get('order')==='desc')
            <form style="display:inline-block;" action="{{ route('admin.category.order_asc') }}" method="get">
                <input type="hidden" name="id" value={{ Request::get('id') }}>
                <input type="hidden" name="free_word" value={{ Request::get('free_word') }}>
                <button class="arrow" type="submit">▼</button>
            </form>
            @elseif(session()->get('order')==='asc')
                <form style="display:inline-block;" action="{{ route('admin.category.order_desc') }}" method="get">
                    <input type="hidden" name="id" value={{ Request::get('id') }}>
                    <input type="hidden" name="free_word" value={{ Request::get('free_word') }}>
                    <button class="arrow" type="submit">▲</button>
                </form>
            @endif
          </th>
          <th class="member_th">編集</th>
          <th>詳細</th>
        </tr>
      </thead>
        @foreach($categories as $category)
          <tbody>
            <tr class="member_tds">
              <td class="member_td">{{ $category->id }}</td>
              <td class="member_td">{{ $category->name }}</td>
              <td class="member_td"><?= date('Y/m/d', strtotime($category->created_at))?></td>
              <td class="member_td">
                <a href="{{ route('admin.category.edit', $category->id) }}" style="text-decoration:none;">
                  編集
                </a>
              </td>
              <td><a style="text-decoration:none;" href='{{ route('admin.category.show', $category->id) }}'>詳細</a></td>
            </tr>
          </tbody>
        @endforeach
    </table>
    {{-- ページネーション --}}
    <div class="pagination_container">
        <p class='pagination'>
            @if(empty(request()->query()))
                {{ $categories->links('vendor.pagination.custom-pagination') }}
            @else
                {{ $categories->appends(request()->query())->links('vendor.pagination.custom-pagination') }}
            @endif
        </p>
    </div>
  </div>
  </div>
@endsection
