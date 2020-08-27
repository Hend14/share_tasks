@extends('layouts.app')

@section('content')
    @if (Auth::check())
    <p>{{ Auth::user()->name }}</p>
    <a href="/users/{$user->id}">ID:{{ Auth::user()->id }} ページへ</a>
    @else
    <h1>Share Tasks トップページ</h1>
    @endif
@endsection
