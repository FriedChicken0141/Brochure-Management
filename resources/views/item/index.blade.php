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
                            <div class="input-group-append">
                                <form action="hoge" method="get";>
                                    @csrf
                                        <input type="text" name="keyword">
                                        <input type="submit" value="検索">
                                <a href="{{ url('items/add') }}" class="btn btn-default">新規登録</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>名前</th>
                                <th>種別</th>
                                <th>残数</th>
                                <th>詳細</th>
                                <th>更新日</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($items as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->type }}</td>
                                    <td>{{ $item->quantity }}</td>
                                    <td>{{ $item->detail }}</td>
                                    <td>{{ $item->updated_at }}</td>
                                    <td>
                                        <div class="button">
                                            <form action="/edit/{{$item->id}}" method="post">
                                                @csrf
                                                <button type="submit" class="btn btn-secondary btn-sm">更新</button>
                                            </form>
                                            <form action="/itemDelete/{{$item->id}}" method="post">
                                                @csrf
                                                <button type="submit" class="btn btn-danger btn-sm btn-dell">削除</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
@stop

@section('js')
@stop
