@extends('adminlte::page')

@section('title', 'プレビュー')

@section('content_header')
    <h1>{{ $brochure->name }} 表紙</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-10">
            <div class="cover">
                <img src="{{ Cloudinary:url($brochure->img_path) }}" alt="パンフレット表紙" width="40%">
            </div>
        </div>
    </div>
@stop

@section('css')
@stop

@section('js')
@stop
