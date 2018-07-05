@extends('layouts.app')

@section('content')

    <h1>id: {{ $user->id }} の名前編集ページ</h1>

    @if (count($errors) > 0)
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif


    {!! Form::model($user, ['route' => ['users.update', $user->id], 'method' => 'put']) !!}

        {!! Form::label('name', '名前:') !!}
        {!! Form::text('name') !!}

        {!! Form::submit('更新') !!}

    {!! Form::close() !!}

@endsection