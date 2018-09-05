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
        {!! link_to_route('microposts.edit', 'データを編集', ['id' => $micropost->id,'class' => "btn btn-info pull-right"]) !!}
    @endif
</div>
<div id="map" style="width:370px;height:370px;"></div>
<br>
<br>

<div class="row bootstrap snippets" >
    <div class="col-md-5  col-sm-12">
        <div class="comment-wrapper">
            <div class="panel panel-info">
                <div class="panel-heading">
                    Comment panel
                </div>
                @if (Auth::id() != $micropost->user_id)
                    <div id="panel-body" class="panel-body">
                        {!! Form::open(['action' => ['CommentsController@store', $micropost->id]]) !!}
                        {!! Form::textarea('comment', old('comment'), ['class' => 'form-control', 'rows' => '3', 'placeholder'=>'write a comment...']) !!}
                        {!! Form::submit('New comment', ['class' =>"btn btn-info pull-right"]) !!}
                        {!! Form::close() !!}
                    </div>
                @endif
                    <div class="clearfix"></div>
                    <hr>
                    <ul id="media-list" class="media-list">
                        @foreach($comments as $comment)
                            <li class="media">
                                <div class="media-body">
                                    <span class="text-muted pull-right">
                                        <small class="text-muted">{{ $comment->created_at }}</small>
                                    </span>
                                    <strong class="text-success">{!! link_to_route('users.show', $comment->user->name, ['id' => $comment->user_id]) !!}</strong>
                                    <p>
                                        {!! nl2br(e($comment->comment)) !!}
                                    </p>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>



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