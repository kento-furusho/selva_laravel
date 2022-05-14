@extends('layouts.app')
@section('title', '商品登録')
@section('content')
    <form class='forms' method="post" action="">
    @csrf
    <h2>商品登録</h2>

    <p>
        <label for="name">商品名</label>
        <input style="margin-left: 21px;" class='form_last_3' type="text" name='name' id='name'
        {{-- @if(old('name'))
            value = '{{ old('name') }}'
        @elseif(!empty($name))
            value = '{{ $name }}'
        @endif --}}
        >
    </p>
    <p>
        <label for="category">商品カテゴリ</label>
        <select name="category" id="category" required>
            <option value="0">選択してください</option>
            @foreach ($categories as $category)
                <option value={{ $category->id }}>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>
        <select name="subcategory" id="subcategory">
            <option value="0">----------</option>
        </select>
    </p>

    <p>商品写真</p>
    <div>
        <label for="image_1">写真１</label>
        <img id="show_image_1">
        <input type="file" class="" id="image_1" name="imege_1" accept="jpg, jpeg, png, gif">
        <input type="button" id="upload_image_1" value="アップロード">
    </div>
    @error('image_1')
        <div class="err_msg">
            {{ $message }}
        </div>
    @enderror



    <div class='btn-container'>
        <a>
            <input class="btn" type="submit" value="確認画面へ">
        </a>
    </div>
    <div class='btn-container'>
        <a class="back_btn" href="{{ route('member.index') }}">
            <span>トップに戻る</span>
        </a>
    </div>
    </form>
    <script>
        // カテゴリ選択
        $(function() {
            $('#category').change(function() {
                $('#subcategory').empty();
                let category_id = $(this).val();
                $.ajax({
                    url:'/product/create/get_subcategory/'+category_id,
                    type: 'GET'
                }).done((data) => {
                    $(data.subcategories).each((i, category) => {
                        $('#subcategory').append('<option value='+category.id+'>'+category.name+'</option>')
                    })
                })
            })
        })
        // 画像アップロード
        $(document).ready(function () {
            $('#upload_image_1').on('click', function() {

                //フォームデータを作成する
                var fd = new FormData();
                // アップロードするファイルデータ取得
                var fileData = document.getElementById("image_1").files[0];
                fd.append('image', fileData);
                console.log(fileData);
                console.log(fd.get('image'));
                $.ajaxSetup({
                    headers: {'X-CSRF-Token': $('meta[name=token]').attr('content')}
                });
                //フォームデータにアップロードファイルの情報追加
                $.ajax({
                    type: "POST",
                    url: "{{ route('store.image') }}",
                    data: fd,
                    processData: false,
                    contentType: false,
                    dataType: 'text'
                    }).done((data) => {
                        //取得jsonデータ
                        var image = JSON.parse(data);
                        $('#show_image_1').attr('src', 'show_image_1/'+image.id)
                    }).fail(function(data) {
                        alert('通信に失敗しました')
                    })
            });
        });
    </script>
@endsection
