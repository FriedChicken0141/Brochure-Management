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
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th style="width: 5%">ID</th>
                                <th style="width: 20%">名前</th>
                                <th style="width: 5%">使用数</th>
                                <th style="width: 25%">詳細</th>
                                <th style="width: 10%">申請者</th>
                                <th style="width: 15%">申請日</th>
                                <th style="width: 5%">状況</th>
                                @can('admin-higher')
                                <th style="width: 10%">決裁</th>
                                @endcan
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($approvals as $approval)
                                @if($approval -> status == "申請中")
                                    <tr>
                                        <td>{{ $approval->id }}</td>
                                        <td>{{ $approval->brochure->name }}</td>
                                        <td>{{ $approval->quantity}}</td>
                                        <td>{{ $approval->detail }}</td>
                                        <td>{{ $approval->user->name }}</td>
                                        <td>{{ $approval->created_at->format('Y年m月d日 H時i分') }}</td>
                                        <td>{{ $approval->status }}</td>
                                        {{-- 管理者に表示 --}}
                                        @can('admin-higher')
                                        <td class="button-second">
                                            <form action="approval/{{$approval->id}}'" method="post">
                                                @csrf
                                                <button type="submit" name="status" class="btn btn-primary btn-sm" value="approved">承認</button>
                                            </form>
                                            <form action="disapproval/{{$approval->id}}" method="post">
                                                @csrf
                                                <button type="submit" name="status" class="btn btn-secondary btn-sm " value="rejected">否認</button>
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

@section('css')
<link rel="stylesheet" href="{{ asset('/css/style-brochure.css')  }}" >
@stop

@section('js')
<script>
        $(function (){
        $(".btn-primary").click(function(){
            if(confirm("この申請を承認します。")){

            }else{

                return false;
            }
        });
    });
    $(function (){
        $(".btn-secondary").click(function(){
            if(confirm("この申請を否認します。")){

            }else{

                return false;
            }
        });
    });
</script>
@stop
