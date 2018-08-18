@extends('layouts.app')

@section('content')

<div class="allmap"  id="map"></div>
<script >
$(function() {
    var markerData = JSON.parse(@json($data));//phpでjson化したものを再度配列に
    var lat=35.66572;
    var lon=139.73100;
    
    var ymap = new Y.Map("map");
    ymap.addControl( new Y.SliderZoomControl() );
    ymap.addControl( new Y.LayerSetControl() );
    ymap.drawMap(new Y.LatLng(lat,lon), 9,"map");
 
    for ( var i = 0 ; i < markerData.length ; i++ ) {
        var lati = markerData[i]['map_lat'];
        var long = markerData[i]['map_long'];
        var image_path = markerData[i]['image_path'];
        var id = markerData[i]['id'];
        var marker= new Y.Marker( new Y.LatLng(lati,long),{title:id} );
        marker.bindInfoWindow('<img src=id>');
        ymap.addFeature(marker);
        }
});
</script>
@endsection