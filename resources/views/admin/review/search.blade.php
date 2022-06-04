@extends('layouts.admin')
@section('title', 'レビュー管理画面')
@section('header')
    @extends('headers.admins.search')
    @section('search_title', '商品レビュー一覧')
@endsection
@section('content')
<div class='btn-container'>
    <a href="{{ route('admin.review.create') }}">
        <input class="blue_btn" type="submit" value="レビュー登録">
    </a>
</div>
<form method="get" action="{{ route('admin.review.search') }}">
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
  <div>
  <table class="member_table">
      <thead>
        <tr class="member_ths">
          <th class="member_th">
            ID
            <!------ 昇順降順ボタン ------>
            <form style="display:inline-block;" action="{{ route('admin.review.orderChange') }}" method="get">
                <input type="hidden" name="id" value={{ Request::get('id') }}>
                <input type="hidden" name="free_word" value={{ Request::get('free_word') }}>
                <input type="hidden" name="order" value=

                @if(!empty(Request::get('order')) && Request::get('order')==='asc')
                    {{ 'desc' }}
                @else
                    {{ 'asc' }}
                @endif
                >
                <button class="arrow" type="submit">
                    @if(!empty(Request::get('order')) && Request::get('order')==='asc')
                        ▲
                    @else
                        ▼
                    @endif
                </button>
            </form>
          </th>
          <th class="member_th">商品ID</th>
          <th class="member_th">評価</th>
          <th class="member_th">商品コメント</th>
          <th class="member_th">
            登録日時
            <form style="display:inline-block;" action="{{ route('admin.review.orderChange') }}" method="get">
                <input type="hidden" name="id" value={{ Request::get('id') }}>
                <input type="hidden" name="free_word" value={{ Request::get('free_word') }}>
                <input type="hidden" name="order" value=

                @if(!empty(Request::get('order')) && Request::get('order')==='asc')
                    {{ 'desc' }}
                @else
                    {{ 'asc' }}
                @endif
                >
                <button class="arrow" type="submit">
                    @if(!empty(Request::get('order')) && Request::get('order')==='asc')
                        ▲
                    @else
                        ▼
                    @endif
                </button>
            </form>
          </th>
          <th class="member_th">編集</th>
          <th>詳細</th>
        </tr>
      </thead>
        @foreach($reviews as $review)
          <tbody>
            <tr class="member_tds">
              <td class="member_td">{{ $review->id }}</td>
              <td class="member_td">{{ $review->product_id }}</td>
              <td class="member_td">{{ $review->evaluation }}</td>
              <td class="member_td"><a style="text-decoration:none;" href='{{ route('admin.review.show', $review->id) }}'>{{ $review->comment }}</a></td>
              <td class="member_td"><?= date('Y/m/d', strtotime($review->created_at))?></td>
              <td class="member_td">
                <a href="{{ route('admin.review.edit', $review->id) }}" style="text-decoration:none;">
                  編集
                </a>
              </td>
              <td><a style="text-decoration:none;" href='{{ route('admin.review.show', $review->id) }}'>詳細</a></td>
            </tr>
          </tbody>
        @endforeach
    </table>
    {{-- ページネーション --}}
    <div class="pagination_container">
        <p class='pagination'>
            @if(empty(request()->query()))
                {{ $reviews->links('vendor.pagination.custom-pagination') }}
            @else
                {{ $reviews->appends(request()->query())->links('vendor.pagination.custom-pagination') }}
            @endif
        </p>
    </div>
  </div>
  </div>
@endsection
