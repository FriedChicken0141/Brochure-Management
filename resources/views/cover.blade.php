@extends('adminlte::page')

@section('title', 'プレビュー')

@section('content_header')
    <h1>パンフレット表紙</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-10">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                       @foreach ($errors->all() as $error)
                          <li>{{ $error }}</li>
                       @endforeach
                    </ul>
                </div>
            @endif
            <div class="cover">
                @csrf
                @foreach ($brochures as $brochure)
                    <img src="{{ Storage::url($brochure->img_path) }}" width="40%">
                @endforeach
            </div>
        </div>
    </div>
@stop

@section('css')
@stop

@section('js')
@stop
