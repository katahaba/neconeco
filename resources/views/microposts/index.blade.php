@extends('layouts.app')

@section('content')
<div class="container">
	<ul class="sortable">
		@foreach ($microposts as $micropost)
	   		<a id="{{$micropost->id}}" class="block" href="{{ route('microposts.show', ['id' => $micropost->id]) }}"><img src="{{ secure_asset($micropost->image_path)}}"></a>
		@endforeach
	</ul>
</div>
{!! $microposts->render() !!}
@endsection