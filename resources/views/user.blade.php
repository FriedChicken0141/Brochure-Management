@extends('adminlte::page')

@section('title', 'ユーザー管理')

@section('content_header')
    <h1>ユーザー管理</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">登録ユーザー一覧</h3>
                    <div class="card-tools">
                        <div class="input-group input-group-sm">
                            {{-- 検索機能 --}}
                            <div class="input-group-append">
                                <form action="/brochures/user/search" method="get" class="search">
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
                                <th style="width: 5%">ID</th>
                                <th style="width: 20%">登録ユーザー名</th>
                                <th style="width: 30%">E-mail</th>
                                <th style="width: 10%">権限</th>
                                <th style="width: 20%">登録日時</th>
                                <th style="width: 5%"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                    <tr>
                                        <td>{{ $user->id }}</td>
                                        <td>{{ $user->name}}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>
                                            @if($user->role == 1)
                                                管理
                                            @elseif (($user->role == 0))
                                                一般
                                            @endif
                                        </td>
                                        <td>{{ $user->created_at->format('Y年m月d日 H時i分') }}</td>
                                        <td class="button-second">
                                            @if ($user->email !='_deleted' && $user->id != auth()->id())
                                                <form action="user/change/{{$user->id}}" method="post">
                                                    @csrf
                                                    <button type="submit" name="status" class="btn btn-primary btn-sm" value="approved">権限変更</button>
                                                </form>
                                                <form action="user/delete/{{$user->id}}" method="post">
                                                    @csrf
                                                    <button type="submit" class="btn btn-danger btn-sm btn-dell">削除</button>
                                                </form>
                                            @endif
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

@section('footer')
    @include('footer')
@stop

@section('css')
    <link rel="stylesheet" href="{{ asset('/css/style-brochure.css')  }}" >
@stop

@section('js')
    <script src="{{ asset('/js/user.js')  }}"></script>
@stop
