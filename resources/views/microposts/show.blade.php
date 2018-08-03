@extends('layouts.app')

@section('content')
<img src="{{ secure_asset($micropost->image_path)}}">

<div>
    @if (Auth::id() === $micropost->user_id)
        {!! Form::open(['route' => ['microposts.destroy', $micropost->id], 'method' => 'delete']) !!}
        {!! Form::submit('Delete', ['class' => 'btn btn-danger ']) !!}
        {!! Form::close() !!}
    @endif
</div>
@endsection