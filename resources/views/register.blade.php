@extends('adminlte::page')

@section('title', '新規登録')

@section('content_header')
    <h1>パンフレット登録</h1>
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

            <div class="card card-primary">
                <form method="POST" action="/brochures/add" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">パンフレット名</label>
                                <input type="text" class="form-control" name="name" required>
                            </div>
                            <div class="form-group">
                                <label for="area">該当市町（県）</label>
                                <select type="area" class="form-control" name="area_id" required>
                                    {{-- valueの中を空にすることで空欄を選択することをできなくする --}}
                                    <option value=""disabled selected>選択してください</option>
                                    @foreach($areas as $area)
                                        <option value="{{ $area->id }}">{{ $area->area_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="detail">残数</label>
                                <input type="text" class="form-control" name="quantity" required>
                            </div>

                            <div class="form-group">
                                <label for="detail">詳細</label>
                                <input type="text" class="form-control" name="detail" >
                            </div>
                            <div class="form-group">
                                <div><label for="cover">表紙画像</label></div>
                                <input type="file" class="form-image" name="image" accept="image/*" id="form-image">
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">登録</button>
                            </div>
                        </div>
                        <div class="col-md-6 ">
                            <label for="text" class="label-preview">表紙画像プレビュー</label>
                            <div class="preview">
                                <img id="preview" class="image-preview" >
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

</script>
@stop
