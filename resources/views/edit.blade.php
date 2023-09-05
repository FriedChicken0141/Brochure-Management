@extends('adminlte::page')

@section('title', '登録情報編集')

@section('content_header')
    <h1>登録情報編集</h1>
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

            <div class="card card-primary">
                {{-- 入力内容をPOSTで/brochures/updateへ渡す --}}
                <form method="POST" action="/brochures/update">
                    @csrf

                    {{-- 編集部分 --}}
                    <div class="card-body">

                        {{-- id --}}
                        <div class="form-group">
                            <input type="hidden" id="id" name="id" value="{{$brochures->id}}" class="form-control"  >
                        </div>

                        {{-- 名前 --}}
                        <div class="form-group">
                            <label for="name">名前</label>
                            <input type="text" id="name" name="name" value="{{$brochures->name}}" class="form-control" required>
                        </div>

                        {{-- 該当市町（県） --}}
                        <div class="form-group">
                            <label for="area">該当市町（県）</label>
                            <select type="area" id="area" name="area"  class="form-control" required >
                                @foreach($areas as $area)
                                    <option value="{{ $area->id }}" @if ($brochures->area == $area->id) @endif>{{ $area->area_name}}</option>
                                @endforeach
                            </select>
                        </div>

                        {{-- 残数 --}}
                        <div class="form-group">
                            <label for="quantity">残数</label>
                            <input type="text" id="quantity" name="quantity" value="{{$brochures->quantity}}" class="form-control"  required>
                        </div>

                        {{-- 詳細 --}}
                        <div class="form-group">
                            <label for="detail">詳細</label>
                            <input type="text" id="detail" name="detail" value="{{$brochures->detail}}" class="form-control" >
                        </div>
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">編集</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop

@section('css')
@stop

@section('js')
@stop
