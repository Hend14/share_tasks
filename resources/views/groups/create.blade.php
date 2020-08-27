@extends('layouts.app')
@section('content')
<div class="create-group">
  {!! Form::model($user, ['route' => ['groups.store'], 'files' => true, 'method' => 'post']) !!}
  {{ csrf_field() }}
  <div class="form-group">
    {!! Form::label('name', 'グループ名') !!}
    {!! Form::text('name', '', ['class' => 'form-control']) !!}
  </div>
  <div class="form-group">
    {!! Form::label('group_img', 'グループ画像') !!}
    {!! Form::file('group_img', ['class' => 'form-control']) !!}
  </div>
  {!! Form::submit('グループを作成', ['class' => 'btn btn-success btn-block']) !!}
  {!! Form::close() !!}
</div>
@if ($errors->any())
<div class="alert alert-danger">
  <ul>
    @foreach ($errors->all() as $error)
    <li>{{ $error }}</li>
    @endforeach
  </ul>
</div>
@endif
@endsection