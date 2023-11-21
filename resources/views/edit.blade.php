@extends('adminlte::page')

@section('title', '登録情報編集')

@section('content_header')
    <h1>登録情報編集</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                       @foreach ($errors->all() as $error)
                          <li>{{ $error }}</li>
                       @endforeach
                    </ul>
                </div>
            @endif

            {{-- idは不要。 nameは重要 --}}
            <div class="card card-primary">
                {{-- 入力内容をPOSTで/brochures/updateへ渡す --}}
                <form method="POST" action="/brochures/update" enctype="multipart/form-data">
                    @csrf
                    {{-- 編集部分 --}}
                    <div class="card-body">
                        <div class="col-md-6">
                            {{-- id --}}
                            <div class="form-group">
                                <input type="hidden" name="id" value="{{$brochures->id}}" class="form-control"  >
                            </div>
                            {{-- 名前 --}}
                            <div class="form-group">
                                <label for="name">名前</label>
                                <input type="text" name="name" value="{{$brochures->name}}" class="form-control" required>
                            </div>
                            {{-- 該当市町（県） --}}
                            <div class="form-group">
                                <label for="area">該当市町（県）</label>
                                <select type="area" name="area_id"  class="form-control" required >
                                    @foreach($areas as $area)
                                        <option value="{{ $area->id }}" @if ($brochures->area->id == $area->id) @endif>{{ $area->area_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            {{-- 残数 --}}
                            <div class="form-group">
                                <label for="quantity">残数</label>
                                <input type="text" name="quantity" value="{{$brochures->quantity}}" class="form-control"  required>
                            </div>

                            {{-- 詳細 --}}
                            <div class="form-group">
                                <label for="detail">詳細</label>
                                <input type="text" name="detail" value="{{$brochures->detail}}" class="form-control" >
                            </div>
                            <div class="form-group">
                                <div><label for="cover">表紙画像</label></div>
                                <input type="file" name="image" value="{{$brochures->img_path}}" class="form-image" >
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">登録</button>
                            </div>
                        </div>
                        <div class="col-md-6 ">
                            <label for="text" class="label-preview">表紙画像プレビュー</label>
                            <div class="preview">
                                <img id="preview" class="image-preview" alt="表紙画像">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop

@section('css')
<link rel="stylesheet" href="{{ asset('/css/style-register.css')  }}" >
@stop

@section('js')
<script>
        $('#form-image').on('change', function(){
	var $fr = new FileReader();

	$fr.onload = function(){
		$('#preview').attr('src', $fr.result);
        $('.image-preview').addClass('add-solid');
	}
	$fr.readAsDataURL(this.files[0]);
    });

    $(function (){
        $(".btn").click(function(){
            if(confirm("編集を完了しますか？")){

            }else{

                return false;

            }
        });
    });
</script>
@stop
