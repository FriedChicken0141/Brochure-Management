@extends('adminlte::page')

@section('title', 'パンフレット使用申請')

@section('content_header')
    <h1>使用申請</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary">
                <form method="POST" action="/brochures/application">
                    @csrf
                    <div class="card-body">
                        {{-- 編集部分 --}}
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="hidden" name="id" value="{{$brochures->id}}" class="form-control"  >
                            </div>
                            <div class="iabel">
                                <h2>{{$brochures->name}}</h2>
                            </div>
                            <div class="form-group">
                                <label for="quantity">使用数</label>
                                <input type="number" name="quantity" class="form-control"  required>
                            </div>
                            <div class="form-group">
                                <label for="detail">使用用途</label>
                                <input type="text" name="detail" value="" class="form-control" >
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">申請</button>
                            </div>
                        </div>
                        {{-- 画像プレビュー --}}
                        <div class="col-md-6">
                            <label for="text" class="label-preview">表紙画像プレビュー</label>
                            <div class="preview">
                                <img src="{{ ($brochures->img_path) }}" alt="表紙" id="image-preview" >
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
    <link rel="stylesheet" href="{{ asset('/css/style-request.css')  }}" >
@stop

@section('js')
    <script src="{{ asset('/js/request.js')  }}"></script>
@stop
