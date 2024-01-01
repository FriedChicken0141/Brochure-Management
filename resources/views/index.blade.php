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
                                {{-- 管理者に表示 --}}
                                @can('admin-higher')
                                <form action="/brochures/register" method="get" class="register">
                                    <button type="submit" class="btn btn-default">新規登録</button>
                                </form>
                                @endcan
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
                                <th style="width: 20%">パンフレット名</th>
                                <th style="width: 10%">@sortablelink('area_id','該当市町（県）')</th>
                                <th style="width: 10%">@sortablelink('quantity','残数')</th>
                                <th style="width: 30%">詳細</th>
                                <th style="width: 10%">プレビュー</th>
                                <th style="width: 15%">@sortablelink('updated_at','更新日')</th>
                                @can('admin-higher')
                                <th style="width: 5%"></th>
                                @endcan
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($brochures as $brochure)
                                <tr>
                                    <td>{{ $brochure->name }}</td>
                                    <td>{{ $brochure->area->area_name }}</td>
                                    <td>{{ $brochure->quantity }}</td>
                                    <td>{{ $brochure->detail }}</td>
                                    <td class="button">
                                        @if ($brochure->name !='削除したパンフレット')
                                            <form action="brochures/cover/{{$brochure->id}}" method="get">
                                                @csrf
                                                <button type="submit" class="btn btn-info btn-sm">表紙画像</button>
                                            </form>
                                        @endif
                                    </td>
                                    <td>{{ $brochure->updated_at->format('Y年m月d日 H時i分') }}</td>
                                    {{-- 管理者のみ表示 --}}
                                    @can('admin-higher')
                                        <td class="button-second">
                                            @if ($brochure->name !='削除したパンフレット')
                                                <form action="brochures/edit/{{$brochure->id}}" method="post">
                                                    @csrf
                                                    <button type="submit" class="btn btn-secondary btn-sm">編集</button>
                                                </form>
                                                <form action="brochures/delete/{{$brochure->id}}" method="post">
                                                    @csrf
                                                    <button type="submit" class="btn btn-danger btn-sm btn-dell">削除</button>
                                                </form>
                                            @endif
                                        </td>
                                    @endcan
                                    {{-- ユーザーのみ表示 --}}
                                    @can('user-higher')
                                        <td class="button-third">
                                            <form action="brochures/request/{{$brochure->id}}" method="post">
                                                @csrf
                                                <button type="submit" class="btn btn-primary btn-sm">使用申請</button>
                                            </form>
                                        </td>
                                    @endcan
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

@section('footer')
    @include('footer')
@stop

@section('css')
    <link rel="stylesheet" href="{{ asset('/css/style-brochure.css')  }}" >
@stop

@section('js')
    <script src="{{ asset('/js/index.js')  }}"></script>
@stop
