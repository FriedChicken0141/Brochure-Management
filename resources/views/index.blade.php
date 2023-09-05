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
                                <form action="hoge" method="get";>
                                    @csrf
                                        <input type="text" name="keyword">
                                        <input type="submit" value="検索">
                                    <a href="{{ url('brochures/register') }}" class="btn btn-default">新規登録</a>
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
                                <th style="width: 10%">ID</th>
                                <th style="width: 20%">名前</th>
                                <th style="width: 15%">該当市町（県）</th>
                                <th style="width: 10%">残数</th>
                                <th style="width: 25%">詳細</th>
                                <th style="width: 20%">更新日</th>
                                <th style="width: 10%"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($brochures as $brochure)
                                <tr>
                                    <td>
                                        <div>{{ $brochure->id }}</div>
                                    </td>
                                    <td>
                                        <div>{{ $brochure->name }}</div>
                                    </td>
                                    <td>
                                        <div>{{ $brochure->area }}</div>
                                    </td>
                                    <td>
                                        <div>{{ $brochure->quantity }}</div>
                                    </td>
                                    <td>
                                        <div>{{ $brochure->detail }}</div>
                                    </td>
                                    <td>
                                        <div>{{ $brochure->updated_at }}</div>
                                    </td>
                                    <td>
                                        <div class="button">
                                            <form action="brochures/edit/{{$brochure->id}}" method="post">
                                                @csrf
                                                <button type="submit" class="btn btn-secondary btn-sm">編集</button>
                                            </form>
                                            <form action="/brochureDelete/{{$brochure->id}}" method="post">
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
