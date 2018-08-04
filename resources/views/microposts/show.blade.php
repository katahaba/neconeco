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
<div style="float:left;">
    @include('favorites.favorite_button', ['micropost' => $micropost])
</div>
<script type="text/javascript" charset="utf-8" src="http://js.api.olp.yahooapis.jp/OpenLocalPlatform/V1/jsapi?appid=dj00aiZpPUo0ZXpHYWpHOFJTYSZzPWNvbnN1bWVyc2VjcmV0Jng9ZDM-"></script>
<script src="{{ secure_asset('js/show_map.js') }}"></script>
@endsection