@extends('adminlte::page')

@section('title', '申請一覧')

@section('content_header')
    <h1>申請状況</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">申請一覧</h3>
                </div>
                {{-- 一覧表示部分 --}}
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th style="width: 20%">パンフレット名</th>
                                <th style="width: 10%">使用数</th>
                                <th style="width: 30%">使用用途</th>
                                @can('admin-higher')
                                    <th style="width: 5%">申請者</th>
                                @endcan
                                    <th style="width: 10%">@sortablelink('created_at','申請日時')</th>
                                    <th style="width: 5%">状況</th>
                                @can('admin-higher')
                                <th style="width: 5%"></th>
                                @endcan
                                @can('user-higher')
                                    <th style="width: 5%"></th>
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
                                        {{-- 管理者のみ --}}
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
                                        {{-- ユーザーのみ --}}
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

@section('footer')
    @include('footer')
@stop

@section('css')
    <link rel="stylesheet" href="{{ asset('/css/style-consent.css')  }}" >
@stop

@section('js')
    <script src="{{ asset('/js/consent.js')  }}"></script>
@stop
