@extends('layouts.app')
@section('content')
<h1>{{ $user->name }}のグループ</h1>
<ul>
  @foreach ($groups as $group)
  <li>
    <!-- <p>グループID：{{ $group->id}}</p> -->
    <p><a href="{{ route('groups.show', ['id' => $group->id]) }}">{{ $group->name }}</a></p>
    <p>作成ユーザーID：{{ $group->create_user_id }}</p>
    @if (Auth::id() == $group->create_user_id)
    {!! Form::open(['route' => ['groups.destroy', $group->id], 'method' => 'delete']) !!}
    {!! Form::button('<i class="far fa-trash-alt"></i>', ['class' => "btn", 'type' => 'submit']) !!}
    {!! Form::close() !!}
    @endif
    <div>
      {!! Form::open(['route' => ['members.store', $group->id], 'method' => 'post']) !!}
      {!! Form::button('加入する', ['class' => "btn btn-success", 'type' => 'submit']) !!}
      {!! Form::close() !!}
    </div>
    <div>
      {!! Form::open(['route' => ['members.destroy', $group->id], 'method' => 'delete']) !!}
      {!! Form::button('脱退する', ['class' => "btn btn-danger", 'type' => 'submit']) !!}
      {!! Form::close() !!}
    </div>
  </li>
  @endforeach
</ul>

@endsection