@extends('layouts.app')

@section('content')

    <p>名前編集</p>
    {!! Form::model($user, ['route' => ['users.update', $user->id], 'method' => 'put']) !!}
        {!! Form::label('name', '名前:') !!}
        {!! Form::text('name') !!}
        {!! Form::submit('更新') !!}
    {!! Form::close() !!}
    <br>
    <p>登録削除</p>
    {!! Form::model($user, ['route' => ['users.destroy', $user->id], 'method' => 'delete']) !!}
        {!! Form::submit('削除') !!}
    {!! Form::close() !!}
@endsection