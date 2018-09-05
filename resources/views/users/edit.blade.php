@extends('layouts.app')

@section('content')
<div class="col-xs-12 col-md-3 form-data">
    @if (\Session::has('user_updated'))
        <div class="alert alert-success">{!! \Session::get('user_updated') !!}</div>
    @endif
    @if(Auth::id() == $user->id)
    {!! Form::model($user, ['route' => ['users.update', $user->id], 'method' => 'put']) !!}
        <div class="form-group ">
        {!! Form::text('name',null,['class' => 'form-control']) !!}
        {!! Form::submit('名前更新', ['class' => 'btn btn-warning', 'id' => 'button']) !!}
        {!! Form::close() !!}
        </div>
        <br>
        <br>
        {!! Form::model($user, ['route' => ['users.destroy', $user->id], 'method' => 'delete']) !!}
        {!! Form::submit('登録抹消!!', ['class' => 'btn btn-danger', 'id' => 'button']) !!}
    {!! Form::close() !!}
    @endif
    
</div>
@endsection