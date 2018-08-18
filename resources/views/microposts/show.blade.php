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
<div id="map" style="width: 350px; height: 350px;"></div>
<script >
$(function(){
  var lati = @json($micropost->map_lat);
  var long = @json($micropost->map_long);
  var id = @json($micropost->id);
  var ymap = new Y.Map("map");
  ymap.addControl(new Y.SliderZoomControlVertical());
  ymap.drawMap(new Y.LatLng(lati, long), 17);
  var marker = new Y.Marker(new Y.LatLng(lati, long),{title:id});
  ymap.addFeature(marker);
  console.log(lati, long);
} );
</script>
@endsection