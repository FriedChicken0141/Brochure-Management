@extends('adminlte::page')

@section('title', '新規登録')

@section('content_header')
    <h1>パンフレット登録</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary">
                <form method="POST" action="/brochures/add" enctype="multipart/form-data">
                    @csrf
                    {{-- 登録部分 --}}
                    <div class="card-body">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">パンフレット名</label>
                                <input type="text" class="form-control" name="name" required>
                            </div>
                            <div class="form-group">
                                <label for="area">該当市町（県）</label>
                                <select type="area" class="form-control" name="area_id" required>
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

@section('footer')
    @include('footer')
@stop

@section('css')
    <link rel="stylesheet" href="{{ asset('/css/style-register.css')  }}" >
@stop

@section('js')
    <script src="{{ asset('/js/register.js')  }}"></script>
@stop
