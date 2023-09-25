@extends('adminlte::page')

@section('title', '申請一覧')

@section('content_header')
    <h1>申請一覧</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">申請状況</h3>
                </div>

                {{-- 一覧表示部分 --}}
                {{-- @if (count($brochures) >0) --}}
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th style="width: 5%">ID</th>
                                <th style="width: 15%">名前</th>
                                <th style="width: 5%">使用数</th>
                                <th style="width: 20%">詳細</th>
                                <th style="width: 10%">申請者</th>
                                <th style="width: 15%">申請日</th>
                                <th style="width: 15%">状況</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($approvals as $approval)
                                <tr>
                                    <td>{{ $approval->id }}</td>
                                    <td>{{ $approval->brochure->name }}</td>
                                    <td>{{ $approval->quantity}}</td>
                                    <td>{{ $approval->detail }}</td>
                                    <td>{{ $approval->user->name }}</td>
                                    <td>{{ $approval->created_at->format('Y年m月d日 H時i分') }}</td>
                                    <td>{{ $approval->status }}</td>
                                    {{-- 管理者に表示 --}}
                                    {{-- @can('admin-higher')
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
                                    @endcan
                                    @can('user-higher')
                                    <td class="button-third">
                                        <form action="brochures/request/{{$brochure->id}}" method="post">
                                            @csrf
                                            <button type="submit" class="btn btn-primary btn-sm">使用申請</button>
                                        </form>
                                    @endcan --}}
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                {{-- @endif --}}
            </div>
        </div>
    </div>
@stop

@section('css')
<link rel="stylesheet" href="{{ asset('/css/style-brochure.css')  }}" >
@stop

@section('js')
<script>
    $(function (){
        $(".btn-dell").click(function(){
            if(confirm("本当に削除しますか？")){

            }else{

                return false;
            }
        });
    });
</script>
@stop
