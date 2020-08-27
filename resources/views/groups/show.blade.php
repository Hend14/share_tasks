@extends('layouts.app')
@section('content')
<h1>{{ $group->name }}</h1>
<h2>メンバー</h2>
<ul>
@foreach($users as $user)
  <li>{{ $user->name }}</li>
@endforeach
</ul>
@endsection