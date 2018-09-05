@extends('layouts.app')

@section('content')

@if (\Session::has('success'))
    <div class="alert alert-success">{!! \Session::get('success') !!}</div>
@endif

<img class="cat_image" src="{{ secure_asset($micropost->image_path)}}">

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
        {!! link_to_route('microposts.edit', 'データを編集', ['id' => $micropost->id,'class' => 'btn btn-success']) !!}
    @endif
</div>
<div id="map" style="width:350px;height:350px;"></div>
<br>
<br>
    <p>コメント</p>
    <div class="row">
        <div class="col-xs-12">
            {!! Form::open(['action' => ['CommentsController@store', $micropost->id]]) !!}
                <div class="form-group">
                    {!! Form::textarea('comment', old('comment'), ['class' => 'form-control', 'rows' => '2']) !!}
                </div>
                {!! Form::submit('New comment', ['class' => 'btn btn-warning btn-block']) !!}
        </div>
    </div>
<br>    
<br>    
    <p>コメント一覧</p>
    {!! $comments->render() !!}
    <ul class="media-list">
@foreach($comments as $comment)
    <li class="media">
        <div class="media-right">
        <div class="media-body">
            <div>
                {!! link_to_route('users.show', $comment->user_id, ['id' => $comment->user_id]) !!}:{!! nl2br(e($comment->comment)) !!}:{!! $comment->created_at !!}
            </div>
        </div>
        </div>
    </li>
@endforeach
</ul>


<script >
$(function(){
  var lati = parseFloat(@json($micropost -> map_lat));
  var long = parseFloat(@json($micropost -> map_long));
  var location = {lat:lati, lng:long};
  console.log("showlocatin",location);
  var options = { zoom: 10, center: location, disableDoubleClickZoom: true }; 
  var map = new google.maps.Map(document.getElementById('map'), options);
  var marker=new google.maps.Marker({position: location,map: map,});
});
</script>
@endsection