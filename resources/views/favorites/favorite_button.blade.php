@if (Auth::user()->is_favoriting($micropost->id))
        {!! Form::open(['route' => ['user.unfavorite', $micropost->id], 'method' => 'delete']) !!}
            {!! Form::submit('unfavorite', ['class' => "btn btn-success btn-sm"]) !!}
        {!! Form::close() !!}
    @else
        {!! Form::open(['route' => ['user.favorite', $micropost->id]]) !!}
            {!! Form::submit('favorite', ['class' => "btn btn-default btn-sm"]) !!}
        {!! Form::close() !!}
@endif