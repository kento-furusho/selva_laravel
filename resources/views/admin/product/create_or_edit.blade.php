@extends('layouts.admin')
@section('title', '商品管理画面')
@section('header')
    @extends('headers.admins.create_or_edit')
    @if(!empty($product))
        @section('create_title', '商品編集')
    @else
        @section('create_title', '商品登録')
    @endif
    @section('back_page_btn')
        <a class="header-btn right-side-btn" href="{{ route('admin.product') }}">一覧に戻る</a>
    @endsection
@endsection
@section('content')
<form class='forms' method="post" action="
@if(!empty($product))
    {{ route('admin.product.edit.store', $product->id) }}
@else
    {{ route('admin.product.create.store') }}
@endif
">


    @csrf
    <p>
        @if(!empty($product))
            {{ 'ID'.'  '.$product->id }}
        @else
            {{ 'ID  登録後に自動採番' }}
        @endif
    </p>
    <p>
        <label for="name">商品名</label>
        <input style="margin-left: 21px;" class='form_last_3' type="text" name='name' id='name'
        @if(old('name'))
            value = '{{ old('name') }}'
        @elseif(!empty($product))
            value = '{{ $product->name }}'
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
                @elseif(!empty($product)&& $product->product_category_id == $category->id)
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
            {{-- 編集の時 --}}
            @elseif(!empty($product))
                @foreach($subcategories as $subcategory)
                    @if($subcategory->product_category_id == $product->product_category_id)
                        <option value="{{ $subcategory->id }}" {{ ($product->product_subcategory_id == $subcategory->id) ? 'selected': '' }}>{{ $subcategory->name }}</option>
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
    <p>
        @if(!empty($errors->first('subcategory_err')))
        <div class="err_msg">
            {{ $errors->first('subcategory_err') }}
        </div>
        @enderror
    </p>

    <p>商品写真</p>
    <div>
        <p style='text-align:center;'>写真1</p>
        <p style='text-align:center;'>
            <img id="show_image_1"
            @if(!empty($product->image_1))
                style="width: 175px; height: 175px;"
                src={{ '../../../storage/' . $product->image_1}}
            @elseif(session()->has('image_1'))
                style="width: 175px; height: 175px;"
                src={{ '../../../storage/' . session()->get('image_1')}}
            @endif>
        </p>
        <input type="file" class="" id="image_1" accept="jpg, jpeg, png, gif">
        <input type="hidden" id='image_1_id' name="image_1_id"
        @if(!empty($image_1->id))
            value={{ $image_1->id }}
        @elseif (session()->has('image_1_id'))
            value={{ session()->get('image_1_id') }}
        @endif>
        <p style='text-align:center;'>
            <input class='up_btn' type="button" id="upload_image_1" value="アップロード">
        </p>
        <div id="image_1_err"></div>
    </div>
    <div>
        <p style='text-align:center;'>写真2</p>
        <p style='text-align:center;'>
        <img id="show_image_2"
            @if(!empty($product->image_2))
                style="width: 175px; height: 175px;"
                src={{ '../../../storage/' . $product->image_2}}
            @elseif(session()->has('image_2'))
                style="width: 175px; height: 175px;"
                src={{ '../../../storage/' . session()->get('image_2')}}
            @endif
        >
        </p>
        <input type="file" class="" id="image_2" accept="jpg, jpeg, png, gif">
        <input type="hidden" id='image_2_id' name="image_2_id"
        @if(!empty($image_2->id))
            value={{ $image_2->id }}
        @elseif (session()->has('image_2_id'))
            value={{ session()->get('image_2_id') }}
        @endif>
        <p style='text-align:center;'>
            <input class='up_btn' type="button" id="upload_image_2" value="アップロード">
        </p>
        <div id="image_2_err"></div>
    </div>
    <div>
        <p style='text-align:center;'>写真3</p>
        <p style='text-align:center;'>
        <img id="show_image_3"
            @if(!empty($product->image_3))
                style="width: 175px; height: 175px;"
                src={{ '../../../storage/' . $product->image_3}}
            @elseif(session()->has('image_3'))
                style="width: 175px; height: 175px;"
                src={{ '../../../storage/' . session()->get('image_3')}}
            @endif
        ></p>
        <input type="file" class="" id="image_3" accept="jpg, jpeg, png, gif">
        <input type="hidden" id='image_3_id' name="image_3_id"
        @if(!empty($image_3->id))
            value={{ $image_3->id }}
        @elseif (session()->has('image_3_id'))
            value={{ session()->get('image_3_id') }}
        @endif>
        <p style='text-align:center;'>
            <input class='up_btn' type="button" id="upload_image_3" value="アップロード">
        </p>
        <div id="image_3_err"></div>
    </div>
    <div>
        <p style='text-align:center;'>写真4</p>
        <p style='text-align:center;'>
        <img id="show_image_4"
            @if(!empty($product->image_3))
                style="width: 175px; height: 175px;"
                src={{ '../../../storage/' . $product->image_4}}
            @elseif(session()->has('image_4'))
                style="width: 175px; height: 175px;"
                src={{ '../../../storage/' . session()->get('image_4')}}
            @endif
        ></p>
        <input type="file" class="" id="image_4" accept="jpg, jpeg, png, gif">
        <input type="hidden" id='image_4_id' name="image_4_id" @if(!empty($image_4->id))
            value={{ $image_4->id }}
        @elseif (session()->has('image_4_id'))
            value={{ session()->get('image_4_id') }}
        @endif>
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
            @elseif(!empty($product->product_content))
                <textarea name="explain" id="" cols="30" rows="10">{{ $product->product_content }}</textarea>
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
            <input class="back_btn_blue" type="submit" value="確認画面へ">
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
                            $('#show_image_1').attr('style', "width: 175px; height: 175px;")
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
                            $('#show_image_2').attr('style', "width: 175px; height: 175px;")
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
                            $('#show_image_3').attr('style', "width: 175px; height: 175px;")
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
                            $('#show_image_4').attr('style', "width: 175px; height: 175px;")
                            $('#image_4_id').attr('value', data.id)
                        }
                    }).fail((error) => {
                        alert('通信失敗しました');
                    })
            });
        });
    </script>

@endsection
