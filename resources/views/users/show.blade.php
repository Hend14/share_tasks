@extends('layouts.app')
@section('content')
<div class="content">
    @if (Auth::check())
        <div class="title m-b-md">
            <h1>MyPage</h1>
        </div>
        <a href="{{ route('groups.create') }}">新規グループ作成</a>
        <h2>グループ一覧</h2>
    @else
        <div class="title m-b-md">
            <p>ログインしてください</p>
        </div>
    @endif
@endsection