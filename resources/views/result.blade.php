@extends('adminlte::page')

@section('title', '申請一覧')

@section('content_header')
    <h1>決裁一覧</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">決裁済み</h3>
                </div>

                {{-- 一覧表示部分 --}}
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th style="width: 20%">パンフレット名</th>
                                <th style="width: 5%">使用数</th>
                                <th style="width: 25%">詳細</th>
                                <th style="width: 10%">申請者</th>
                                <th style="width: 15%">決済日時</th>
                                <th style="width: 5%">状況</th>
                                @can('admin-higher')
                                <th style="width: 5%"></th>
                                @endcan
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($approvals as $approval)
                                @if($approval -> status == "承認" || $approval -> status == "否認" )
                                    <tr>
                                        <td>{{ $approval->brochure->name }}</td>
                                        <td>{{ $approval->quantity}}</td>
                                        <td>{{ $approval->detail }}</td>
                                        <td>{{ $approval->user->name }}</td>
                                        <td>{{ $approval->updated_at->format('Y年m月d日 H時i分') }}</td>
                                        <td>{{ $approval->status }}</td>
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
