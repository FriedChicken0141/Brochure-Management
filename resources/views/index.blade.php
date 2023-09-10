@extends('adminlte::page')

@section('title', 'パンフレット一覧')

@section('content_header')
    <h1>パンフレット一覧</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">在庫一覧</h3>
                    <div class="card-tools">
                        <div class="input-group input-group-sm">
                            {{-- 検索機能 --}}
                            <div class="input-group-append">
                                <form action="/brochures/search" method="get" class="search">
                                    @csrf
                                        <input type="text" name="keyword">
                                        <input type="submit" value="検索">
                                </form>
                                <form action="/brochures/register" method="get" class="register">
                                    <button type="submit" class="btn btn-default">新規登録</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- 一覧表示部分 --}}
                @if (count($brochures) >0)
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th style="width: 5%">@sortablelink('id','ID')</th>
                                <th style="width: 20%">名前</th>
                                <th style="width: 15%">@sortablelink('area_id','該当市町（県）')</th>
                                <th style="width: 10%">@sortablelink('quantity','残数')</th>
                                <th style="width: 15%">詳細</th>
                                <th style="width: 10%">プレビュー</th>
                                <th style="width: 20%">@sortablelink('updated_at','更新日')</th>
                                <th style="width: 15%"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($brochures as $brochure)
                                <tr>
                                    <td>{{ $brochure->id }}</td>
                                    <td>{{ $brochure->name }}</td>
                                    <td>{{ $brochure->area->area_name }}</td>
                                    <td>{{ $brochure->quantity }}</td>
                                    <td>{{ $brochure->detail }}</td>
                                    <td class="button">
                                        <form action="brochures/cover/{{$brochure->id}}" method="get">
                                            @csrf
                                            <button type="submit" class="btn btn-info btn-sm">表紙</button>
                                        </form>
                                    </td>
                                    <td>{{ $brochure->updated_at }}</td>
                                    <td class="button-second">
                                        <form action="brochures/edit/{{$brochure->id}}" method="post">
                                            @csrf
                                            <button type="submit" class="btn btn-secondary btn-sm">編集</button>
                                        </form>
                                        <form action="brochures/delete/{{$brochure->id}}" method="post">
                                            @csrf
                                            <button type="submit" class="btn btn-danger btn-sm btn-dell">削除</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @endif
            </div>
        </div>
    </div>
@stop

@section('css')
<link rel="stylesheet" href="{{ asset('/css/style-brochure.css')  }}" >
@stop

@section('js')
@stop
