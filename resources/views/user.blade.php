@extends('adminlte::page')

@section('title', 'ユーザー管理')

@section('content_header')
    <h1>ユーザー一覧</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">申請状況</h3>
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
                                <th style="width: 5%">ID</th>
                                <th style="width: 10%">ユーザーネーム</th>
                                <th style="width: 20%">E-mail</th>
                                <th style="width: 10%">Password</th>
                                <th style="width: 15%">権限</th>
                                <th style="width: 10%">登録日</th>
                                <th style="width: 10%"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                    <tr>
                                        <td>{{ $user->ID }}</td>
                                        <td>{{ $user->name}}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->password }}</td>
                                        <td>{{ $user->role}}</td>
                                        <td>{{ $user->created_at}}</td>

                                        <td class="button-second">
                                            <form action="hoge" method="post">
                                                @csrf
                                                <button type="submit" name="status" class="btn btn-primary btn-sm" value="approved">権限変更</button>
                                            </form>
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
<link rel="stylesheet" href="{{ asset('/css/style-brochure.css')  }}" >
@stop

@section('js')
{{-- <script>
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
</script> --}}
@stop
