@extends('layouts.app')

@section('content')

@if (\Session::has('success'))
    <div class="alert alert-success">{!! \Session::get('success') !!}</div>
@endif

<img class="cat_image"  src="{{ secure_asset($micropost->image_path)}}">
<p>検索タグ:{{ $micropost->search_tag }}</p>
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
<div id="map" style="width: 350px; height: 350px;"></div>

<script>
var lati = <?php echo json_encode($micropost->map_lat);?>;
var long = <?php echo json_encode($micropost->map_long);?>;

window.onload = function(){
  var ymap = new Y.Map("map");
  ymap.drawMap(new Y.LatLng(lati, long), 17);
  ymap.addControl(new Y.CenterMarkControl());
  ymap.addControl(new Y.SliderZoomControlVertical());
  console.log(lati, long);
} 
</script>
@endsection