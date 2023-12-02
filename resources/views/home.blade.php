@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>パンフレット管理システムへようこそ</h1>
@stop

@section('content')

    <div class="notification-head">
        <h4>お知らせ</h4>
        <div class="notification-body">
            @forelse(auth()->user()->notifications()->get() as $notification)
                <div class="{{ is_null($notification->read_at) ? 'un-read' : '' }}">
                    @if ($notification->read_at === null)
                        <p><a href="{{url('/brochures/consent')}}">{{ $notification->data['content'] }}</a></p>
                    @else
                        <p>通知はありません</p>
                    @endif
                </div>
            @empty
                <p>通知はありません</p>
            @endforelse
        </div>
    </div>

@stop

@section('css')
    <link rel="stylesheet" href="/css/style-home.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop
