@extends('layouts.app')

@section('content')

    <p>id: {{ $user->id }} の名前編集ページ</p>
    {!! Form::model($user, ['route' => ['users.update', $user->id], 'method' => 'put']) !!}
        {!! Form::label('name', '名前:') !!}
        {!! Form::text('name') !!}
        {!! Form::submit('更新') !!}
    {!! Form::close() !!}

    {!! Form::model($user, ['route' => ['users.destroy', $user->id], 'method' => 'delete']) !!}
        {!! Form::submit('削除') !!}
    {!! Form::close() !!}
@endsection