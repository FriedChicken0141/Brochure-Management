@extends('adminlte::page')

@section('title', 'プレビュー')

@section('content_header')
    <h1>{{ $brochure->name }} 表紙</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-10">
            <div class="cover">
                <img src="{{ ($brochure->img_path) }}" alt="表紙">
            </div>
        </div>
    </div>
@stop

@section('footer')
    @include('footer')
@stop

@section('css')
    <link rel="stylesheet" href="{{ asset('/css/style-cover.css')  }}" >
@stop

@section('js')
@stop
