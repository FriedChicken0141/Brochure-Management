@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>ホーム</h1>
@stop

@section('content')

    <div class="notification-head">
        <div class="notification-user">
            <h3>あなたへのお知らせ</h3>
            <div class="nitification-content">
                @forelse(auth()->user()->notifications()->take(1)->get() as $notification)
                    @if ($notification->read_at)
                        <p>新着通知はありません</p>
                    @else
                        <li><a href={{$notification->data['link']}}>{{ $notification->data['content'] }}</a></li>
                    @endif
                @empty
                    <p>新着通知はありません</p>
                @endforelse
                {{-- @php
                    dd($groupNotifications);
                @endphp --}}
            </div>
        </div>
        <div class="notification-whole">
            <h3>管理者からのお知らせ</h3>
            <div class="nitification-content">
                <p><h5>【重要】パンフレットを使用する際は、必ず使用申請を行ってください。</h5></p>
                <div class="nitification-ragister"><h5>【新規登録】</h5></div>
                <div class="ragister-content">
                    @forelse ($newBrochures as $newBrochure)
                        <li><a href="{{url('/brochures')}}">{{$newBrochure->created_at->format('m月d日')}}&emsp;
                            {{$newBrochure->name}}({{$newBrochure->area->area_name}})&ensp;を追加しました。</a></li>
                    @empty
                        <p>新規登録されたパンフレットはありません。</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

@stop

@section('css')
    <link rel="stylesheet" href="/css/style-home.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop
