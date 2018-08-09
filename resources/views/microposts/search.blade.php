@extends('layouts.app')

@section('content')
<div class="container">
	<ul>
		@foreach ($sql as $micropost)
	   		<a id="{{$micropost->id}}"  href="{{ route('microposts.show', ['id' => $micropost->id]) }}"><img src="{{ secure_asset($micropost->image_path)}}"></a>
		@endforeach
	</ul>
</div>

{!! $sql->render() !!}
@endsection