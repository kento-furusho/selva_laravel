@extends('layouts.admin')
@section('title', '管理画面')
@section('header')
    @extends('headers.admins.search')
    @section('search_title', '会員一覧')
@endsection
@section('content')
<div class='btn-container'>
    <a href="{{ route('admin.member.create') }}">
        <input class="blue_btn" type="submit" value="会員登録">
    </a>
</div>
<form method="get" action="{{ route('admin.member.search') }}">
    @csrf
    <table class="search_table">
      <tr>
        <td class="search_title">
          <label class="title_txt" for="id">ID</label>
        </td>
        <td>
          <input class="search_content" type="text" name="search_id" id="id" value=''>
        </td>
      </tr>
      <tr>
        <td class="search_title">
          <label class="title_txt" for="gender">性別</label>
        </td>
        <td>
          <input style="margin-left:30px;" type="checkbox" name="gender_man" id="gender" value="1" >男性
          <input type="checkbox" name="gender_woman" id="gender" value="2">女性
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
  <!------ メンバー表示テーブル ------>
  <div>
  <table class="member_table">
      <thead>
        <tr class="member_ths">
          <th class="member_th">
            ID
            <!------ 昇順降順ボタン ------>
            @if(session()->get('order')==='desc')
                <form style="display:inline-block;" action="{{ route('admin.member.order_asc') }}" method="get">
                    <input type="hidden" name="id" value=
                    {{ Request::get('search_id') }} >
                    <input type="hidden" name="gender_man" value=
                    {{ Request::get('gender_man') }} >
                    <input type="hidden" name="gender_woman" value=
                    {{ Request::get('gender_man') }} >
                    <input type="hidden" name="free_word" value=
                    {{ Request::get('free_word') }} >
                    <button class="arrow" type="submit">▼</button>
                </form>
            @elseif(session()->get('order')==='asc')
                <form style="display:inline-block;" action="{{ route('admin.member.order_desc') }}" method="get">
                    <input type="hidden" name="id" value=
                    {{ Request::get('search_id') }} >
                    <input type="hidden" name="gender_man" value=
                    {{ Request::get('gender_man') }} >
                    <input type="hidden" name="gender_woman" value=
                    {{ Request::get('gender_man') }} >
                    <input type="hidden" name="free_word" value=
                    {{ Request::get('free_word') }} >
                    <button class="arrow" type="submit">▲</button>
                </form>
            @endif
          </th>
          <th class="member_th">氏名</th>
          <th class="member_th">性別</th>
          <th class="member_th">メールアドレス</th>
          <th class="member_th">
            登録日時
            <!------ 昇順降順ボタン ------>
            @if(session()->get('order')==='desc')
                <form style="display:inline-block;" action="{{ route('admin.member.order_asc') }}" method="get">
                    <input type="hidden" name="id" value=
                    {{ Request::get('search_id') }} >
                    <input type="hidden" name="gender_man" value=
                    {{ Request::get('gender_man') }} >
                    <input type="hidden" name="gender_woman" value=
                    {{ Request::get('gender_man') }} >
                    <input type="hidden" name="free_word" value=
                    {{ Request::get('free_word') }} >
                    <button class="arrow" type="submit">▼</button>
                </form>
            @elseif(session()->get('order')==='asc')
                <form style="display:inline-block;" action="{{ route('admin.member.order_desc') }}" method="get">
                    <input type="hidden" name="id" value=
                    {{ Request::get('search_id') }} >
                    <input type="hidden" name="gender_man" value=
                    {{ Request::get('gender_man') }} >
                    <input type="hidden" name="gender_woman" value=
                    {{ Request::get('gender_man') }} >
                    <input type="hidden" name="free_word" value=
                    {{ Request::get('free_word') }} >
                    <button class="arrow" type="submit">▲</button>
                </form>
            @endif
          </th>
          <th class="member_th">編集</th>
          <th>詳細</th>
        </tr>
      </thead>
        @foreach($members as $member)
          <tbody>
            <tr class="member_tds">
              <td class="member_td">{{ $member->id }}</td>
              <td class="member_td"><a style="text-decoration:none;" href='{{ route('admin.member.show', $member->id) }}'>{{ $member->name_sei.' '.$member->name_mei }}</a></td>
              <td class="member_td">
                <?php
                if($member->gender == 1) {
                  echo '男性';
                } else {
                  echo '女性';
                }
                ?>
              </td>
              <td class="member_td">{{ $member->email }}</td>
              <td class="member_td"><?= date('Y/m/d', strtotime($member->created_at))?></td>
              <td class="member_td">
                <a href="{{ route('admin.member.edit', $member->id) }}" style="text-decoration:none;">
                  編集
                </a>
              </td>
              <td><a style="text-decoration:none;" href='{{ route('admin.member.show', $member->id) }}'>詳細</a></td>
            </tr>
          </tbody>
        @endforeach
    </table>
    {{-- ページネーション --}}
    <div class="pagination_container">
        <p class='pagination'>
            @if(empty(request()->query()))
                {{ $members->links('vendor.pagination.custom-pagination') }}
            @else
                {{ $members->appends(request()->query())->links('vendor.pagination.custom-pagination') }}
            @endif
        </p>
    </div>
  </div>
  </div>
@endsection
