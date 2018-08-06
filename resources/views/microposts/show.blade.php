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
<div id="map" style="width: 350px; height: 350px;"></div>


	@if(isset($lat))
	    lati={$lat};
	    long={$long};
	@else
	     lati=35.66572;
	     long=139.73100;
	@endif
     

<script src="{{ secure_asset('js/show_map.js') }}"></script>
@endsection