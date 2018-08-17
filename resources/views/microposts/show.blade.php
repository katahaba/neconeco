@extends('layouts.app')

@section('content')

@if (\Session::has('success'))
    <div class="alert alert-success">{!! \Session::get('success') !!}</div>
@endif

<img class="cat_image"  src="{{ secure_asset($micropost->image_path)}}">

<p class="p">検索タグ: {{ $micropost->search_tag }}</p>
<p class="p">POST_ID: {{$micropost->id}}</p>
<div>
    @if (Auth::id() === $micropost->user_id)
        {!! Form::open(['route' => ['microposts.destroy', $micropost->id], 'method' => 'delete']) !!}
        {!! Form::submit('Delete', ['class' => 'btn btn-danger ']) !!}
        {!! Form::close() !!}
    @endif
</div>

<div>
    @include('favorites.favorite_button', ['micropost' => $micropost])
</div>
<br>

<div>
    @if (Auth::id() === $micropost->user_id)
        {!! link_to_route('microposts.edit', 'データを編集', ['id' => $micropost->id]) !!}
    @endif
</div>

<div>
<img id="map" style="width: 350px; height: 350px;" src="https://map.yahooapis.jp/map/V1/static?appid={{ getenv('YAHOO_API_KEY') }}&pin{{$micropost->id}}={{$micropost->map_lat}},{{$micropost->map_long}},,red&z=18">
</div>   

@endsection