@extends('layouts.app')

@section('content')
<img class="allmap" " src="https://map.yahooapis.jp/map/V1/static?appid={{ getenv('YAHOO_API_KEY') }}&{{$datas}},&z=6">
@endsection