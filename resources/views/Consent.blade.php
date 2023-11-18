@extends('adminlte::page')

@section('title', '申請一覧')

@section('content_header')
    <h1>使用申請</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">申請一覧</h3>
                </div>
                @if(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
                @endif

                {{-- 一覧表示部分 --}}
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th style="width: 15%">パンフレット名</th>
                                <th style="width: 10%">使用数</th>
                                <th style="width: 20%">使用用途</th>
                                @can('admin-higher')
                                    <th style="width: 10%">申請者</th>
                                @endcan
                                <th style="width: 20%">申請日時</th>
                                <th style="width: 10%">状況</th>
                                @can('admin-higher')
                                <th style="width: 10%"></th>
                                @endcan
                                @can('user-higher')
                                <th style="width: 3%"></th>
                                @endcan
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($approvals as $approval)
                                @if ($approval -> status == "申請中" || $approval -> status == "差戻" || $approval -> status == "再申請中")
                                    <tr>
                                        <td>{{ $approval->brochure->name }}</td>
                                        <td>{{ $approval->quantity}}</td>
                                        <td>{{ $approval->detail }}</td>
                                        @can('admin-higher')
                                            <td>{{ $approval->user->name }}</td>
                                        @endcan
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
                                                <button type="submit" name="status" class="btn btn-secondary btn-sm btn-reject " value="rejected">否認</button>
                                            </form>
                                        </td>
                                        @endcan
                                        {{-- ユーザーのみ表示 --}}
                                        @can('user-higher')
                                        <td class="button-second">
                                            <form action="consent/edit/{{$approval->id}}" method="post">
                                                @csrf
                                                <button type="submit" class="btn btn-secondary btn-sm">編集</button>
                                            </form>
                                            <form action="consent/delete/{{$approval->id}}" method="post">
                                                @csrf
                                                <button type="submit" class="btn btn-danger btn-sm btn-dell">削除</button>
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
<link rel="stylesheet" href="{{ asset('/css/style-consent.css')  }}" >
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
        $(".btn-reject").click(function(){
            if(confirm("この申請を否認します。")){

            }else{

                return false;
            }
        });
    });
    $(function (){
        $(".btn-dell").click(function(){
            if(confirm("この申請を削除しますか？")){

            }else{

                return false;
            }
        });
    });
</script>
@stop
