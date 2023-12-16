@extends('adminlte::page')

@section('title', '申請一覧')

@section('content_header')
    <h1>決裁履歴</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">承認済一覧</h3>
                    <div class="card-tools">
                        <div class="input-group input-group-sm">
                            {{-- 検索機能 --}}
                            <div class="input-group-append">
                                <form action="/brochures/result/search" method="get" class="search">
                                    @csrf
                                        <input type="text" name="keyword">
                                        <input type="submit" value="検索">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- 一覧表示部分 --}}
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th style="width: 20%">パンフレット名</th>
                                <th style="width: 10%">使用数</th>
                                <th style="width: 20%">詳細</th>
                                @can('admin-higher')
                                    <th style="width: 10%">申請者</th>
                                @endcan
                                @can('user-higher')
                                    <th style="width: 10%">@sortablelink('created_at','申請日時')</th>
                                @endcan
                                <th style="width: 15%">@sortablelink('updated_at','更新日時')</th>
                                @can('admin-higher')
                                <th style="width: 5%"></th>
                                @endcan
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($approvals as $approval)
                                @if($approval -> status == "承認")
                                    <tr>
                                        <td>{{ $approval->brochure->name }}</td>
                                        <td>{{ $approval->quantity}}</td>
                                        <td>{{ $approval->detail }}</td>
                                        @can('admin-higher')
                                            <td>{{ $approval->user->name }}</td>
                                        @endcan
                                        @can('user-higher')
                                            <td>{{ $approval->created_at->format('Y年m月d日 H時i分')  }}</td>
                                        @endcan
                                        <td>{{ $approval->updated_at->format('Y年m月d日 H時i分') }}</td>
                                        {{-- 管理者に表示 --}}
                                        @can('admin-higher')
                                        <td class="button-second">
                                            <form action="remand/{{$approval->id}}" method="post">
                                                @csrf
                                                <button type="submit" name="status" class="btn btn-primary btn-sm" value="remand">差し戻す</button>
                                            </form>
                                        </td>
                                        @endcan
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
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
<script>
        $(function (){
        $(".btn-primary").click(function(){
            if(confirm("この申請を差し戻します。")){

            }else{

                return false;
            }
        });
    });
</script>
@stop
