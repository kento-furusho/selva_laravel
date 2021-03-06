@extends('layouts.app')
@section('title', '商品登録')
@section('content')
    <form class='forms' method="post" action="{{ route('product.store') }}">
    @csrf
    <h2>商品登録</h2>
    <p>
        <label for="name">商品名</label>
        <input style="margin-left: 21px;" class='form_last_3' type="text" name='name' id='name'
        @if(old('name'))
            value = '{{ old('name') }}'
        @elseif(!empty($name))
            value = '{{ $name }}'
        @endif
        >
    </p>
    <p>
        @error('name')
        <div class="err_msg">
            {{ $message }}
        </div>
        @enderror
    </p>

    <p>
        <label for="category">商品カテゴリ</label>
        <select name="category" id="category" required>
            <option value="0">選択してください</option>
            @foreach ($categories as $category)
                @if(old('category')  == $category->id)
                    <option value={{ $category->id }} selected>{{ $category->name }}</option>
                @elseif(!empty($ses_category)&& $ses_category == $category->id)
                    <option value={{ $category->id }} selected>{{ $category->name }}</option>
                @else
                    <option value={{ $category->id }}>{{ $category->name }}</option>
                @endif
            @endforeach
        </select>
        <select name="subcategory" id="subcategory">
            <option value="0">----------</option>
            {{-- エラーの時 --}}
            @if(!empty(old('subcategory')))
                @foreach($subcategories as $subcategory)
                    @if($subcategory->product_category_id == old('category'))
                        <option value="{{ $subcategory->id }}" {{ (old('subcategory') == $subcategory->id) ? 'selected': '' }}>{{ $subcategory->name }}</option>
                    @endif
                @endforeach
            {{-- 戻るボタンの時 --}}
            @elseif(!empty($ses_subcategory))
                @foreach($subcategories as $subcategory)
                    @if($subcategory->product_category_id == $ses_category)
                        <option value="{{ $subcategory->id }}" {{ ($ses_subcategory == $subcategory->id) ? 'selected': '' }}>{{ $subcategory->name }}</option>
                    @endif
                @endforeach
            @endif
        </select>
    </p>
    <p>
        @error('category')
        <div class="err_msg">
            {{ $message }}
        </div>
        @enderror
    </p>
    <p>
        @error('subcategory')
        <div class="err_msg">
            {{ $message }}
        </div>
        @enderror
    </p>

    <p>商品写真</p>
    <div>
        <p style='text-align:center;'><label for="image_1">写真1</label></p>
        <p style='text-align:center;'>
            <img id="show_image_1"
            @if(session()->has('image_1'))
                style="width: 175px; height: 175px;"
                src={{ '../../storage/' . session()->get('image_1')}}
            @endif>
        </p>
        <input type="file" class="" id="image_1" accept="jpg, jpeg, png, gif">
        <input type="hidden" id='image_1_id'
            @if (session()->has('image_1_id'))
                value={{ session()->get('image_1_id') }}
            @endif
        name="image_1_id">
        <p style='text-align:center;'>
            <input class='up_btn' type="button" id="upload_image_1" value="アップロード">
        </p>
        <div id="image_1_err"></div>
    </div>
    <div>
        <p style='text-align:center;'><label for="image_1">写真2</label></p>
        <p style='text-align:center;'>
        <img id="show_image_2"
            @if(session()->has('image_2'))
                style="width: 175px; height: 175px;"
                src={{ '../../storage/' . session()->get('image_2')}}
            @endif
        >
        </p>
        <input type="file" class="" id="image_2" accept="jpg, jpeg, png, gif">
        <input type="hidden" id='image_2_id'
            @if (session()->has('image_2_id'))
                value={{ session()->get('image_2_id') }}
            @endif
        name="image_2_id">
        <p style='text-align:center;'>
            <input class='up_btn' type="button" id="upload_image_2" value="アップロード">
        </p>
        <div id="image_2_err"></div>
    </div>
    <div>
        <p style='text-align:center;'><label for="image_1">写真3</label></p>
        <p style='text-align:center;'>
        <img id="show_image_3"
            @if(session()->has('image_3'))
                style="width: 175px; height: 175px;"
                src={{ '../../storage/' . session()->get('image_3')}}
            @endif
        ></p>
        <input type="file" class="" id="image_3" accept="jpg, jpeg, png, gif">
        <input type="hidden" id='image_3_id'
            @if (session()->has('image_3_id'))
                value={{ session()->get('image_3_id') }}
            @endif
        name="image_3_id">
        <p style='text-align:center;'>
            <input class='up_btn' type="button" id="upload_image_3" value="アップロード">
        </p>
        <div id="image_3_err"></div>
    </div>
    <div>
        <p style='text-align:center;'><label for="image_1">写真4</label></p>
        <p style='text-align:center;'>
        <img id="show_image_4"
            @if(session()->has('image_4'))
                style="width: 175px; height: 175px;"
                src={{ '../../storage/' . session()->get('image_4')}}
            @endif
        ></p>
        <input type="file" class="" id="image_4" accept="jpg, jpeg, png, gif">
        <input type="hidden" id='image_4_id'
            @if (session()->has('image_4_id'))
                value={{ session()->get('image_4_id') }}
            @endif
        name="image_4_id">
        <p style='text-align:center;'>
            <input class='up_btn' type="button" id="upload_image_4" value="アップロード">
        </p>
        <div id="image_4_err"></div>
    </div>



    <div>
        <p>商品説明</p>
        <div>
            @if(old('explain'))
                <textarea name="explain" id="" cols="30" rows="10">{{ old('explain') }}</textarea>
            @elseif(!empty($explain))
                <textarea name="explain" id="" cols="30" rows="10">{{ $explain }}</textarea>
            @else
                <textarea style='width:455px;' name="explain" id="" cols="30" rows="10"></textarea>
            @endif
        </div>
        <p>
            @error('explain')
            <div class="err_msg">
                {{ $message }}
            </div>
            @enderror
        </p>
    </div>




    <div class='btn-container'>
        <a>
            <input class="btn" type="submit" value="確認画面へ">
        </a>
    </div>
    <div class='btn-container'>
        @if(url()->previous() == 'https://ik1-407-35703.vs.sakura.ne.jp/')
            <a class="back_btn" href="{{ route('member.index') }}">
                <span>トップに戻る</span>
            </a>
        @else
            <a class="back_btn" href="{{ route('search.index') }}">
                <span>商品一覧に戻る</span>
            </a>
        @endif
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
                    }).done((data,textStatus,jqXHR) => {
                        var data = JSON.parse(data);
                        if(data.error){
                            console.log(data.error)
                            if(data.error.includes('The image may not be greater than 10485 kilobytes.')) {
                                alert("10MBまでの画像がアップロードできます");
                            }
                            if(data.error.includes('The image must be an image.')) {
                                alert("画像ファイルをアップロードしてください");
                            }
                            if(data.error.includes('The image must be a file of type: jpeg, png, jpg, gif.')) {
                                alert('アップロード可能な画像ファイルは jpeg, png, jpg, gif です');
                            }
                            if(data.error.includes('The image failed to upload.')) {
                                alert("アップロードを失敗しました");
                            }
                        } else {
                            console.log(data.path)
                            console.log(data.id)
                            $('#show_image_1').attr('src', 'show_image/'+data.id)
                            $('#image_1_id').attr('value', data.id)
                        }
                    }).fail((response) =>  {
                        alert('通信失敗しました');
                    })
            });
        });
        $(document).ready(function () {
            $('#upload_image_2').on('click', function() {
                var fd = new FormData();
                var fileData = document.getElementById("image_2").files[0];
                fd.append('image', fileData);
                $.ajaxSetup({
                    headers: {'X-CSRF-Token': $('meta[name=token]').attr('content')}
                });
                $.ajax({
                    type: "POST",
                    url: "{{ route('store.image') }}",
                    data: fd,
                    processData: false,
                    contentType: false,
                    dataType: 'text'
                    }).done((data,textStatus,jqXHR) => {
                        var data = JSON.parse(data);
                        if(data.error){
                            console.log(data.error)
                            if(data.error.includes('The image may not be greater than 10485 kilobytes.')) {
                                alert("10MBまでの画像がアップロードできます");
                            }
                            if(data.error.includes('The image must be an image.')) {
                                alert("画像ファイルをアップロードしてください");
                            }
                            if(data.error.includes('The image must be a file of type: jpeg, png, jpg, gif.')) {
                                alert("アップロード可能な画像ファイルは jpeg, png, jpg, gif です");
                            }
                            if(data.error.includes('The image failed to upload.')) {
                                alert("アップロードを失敗しました");
                            }
                        } else {
                            console.log(data.path)
                            console.log(data.id)
                            $('#show_image_2').attr('src', 'show_image/'+data.id)
                            $('#image_2_id').attr('value', data.id)
                        }
                    }).fail((error) => {
                        alert('通信失敗しました');
                    })
            });
        });
        $(document).ready(function () {
            $('#upload_image_3').on('click', function() {
                var fd = new FormData();
                var fileData = document.getElementById("image_3").files[0];
                fd.append('image', fileData);
                $.ajaxSetup({
                    headers: {'X-CSRF-Token': $('meta[name=token]').attr('content')}
                });
                $.ajax({
                    type: "POST",
                    url: "{{ route('store.image') }}",
                    data: fd,
                    processData: false,
                    contentType: false,
                    dataType: 'text'
                    }).done((data,textStatus,jqXHR) => {
                        var data = JSON.parse(data);
                        if(data.error){
                            console.log(data.error)
                            if(data.error.includes('The image may not be greater than 10485 kilobytes.')) {
                                alert("10MBまでの画像がアップロードできます");
                            }
                            if(data.error.includes('The image must be an image.')) {
                                alert("画像ファイルをアップロードしてください");
                            }
                            if(data.error.includes('The image must be a file of type: jpeg, png, jpg, gif.')) {
                                alert("アップロード可能な画像ファイルは jpeg, png, jpg, gif です");
                            }
                            if(data.error.includes('The image failed to upload.')) {
                                alert("アップロードを失敗しました");
                            }
                        } else {
                            console.log(data.path)
                            console.log(data.id)
                            $('#show_image_3').attr('src', 'show_image/'+data.id)
                            $('#image_3_id').attr('value', data.id)
                        }
                    }).fail((error) => {
                        alert('通信失敗しました');
                    })
            });
        });
        $(document).ready(function () {
            $('#upload_image_4').on('click', function() {
                var fd = new FormData();
                var fileData = document.getElementById("image_4").files[0];
                fd.append('image', fileData);
                $.ajaxSetup({
                    headers: {'X-CSRF-Token': $('meta[name=token]').attr('content')}
                });
                $.ajax({
                    type: "POST",
                    url: "{{ route('store.image') }}",
                    data: fd,
                    processData: false,
                    contentType: false,
                    dataType: 'text'
                    }).done((data,textStatus,jqXHR) => {
                        var data = JSON.parse(data);
                        if(data.error){
                            console.log(data.error)
                            if(data.error.includes('The image may not be greater than 10485 kilobytes.')) {
                                alert("10MBまでの画像がアップロードできます");
                            }
                            if(data.error.includes('The image must be an image.')) {
                                alert("画像ファイルをアップロードしてください");
                            }
                            if(data.error.includes('The image must be a file of type: jpeg, png, jpg, gif.')) {
                                alert("アップロード可能な画像ファイルは jpeg, png, jpg, gif です");
                            }
                            if(data.error.includes('The image failed to upload.')) {
                                alert("アップロードを失敗しました");
                            }
                        } else {
                            console.log(data.path)
                            console.log(data.id)
                            $('#show_image_4').attr('src', 'show_image/'+data.id)
                            $('#image_4_id').attr('value', data.id)
                        }
                    }).fail((error) => {
                        alert('通信失敗しました');
                    })
            });
        });
    </script>
@endsection
