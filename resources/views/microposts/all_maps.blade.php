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
    ymap.addControl(new Y.SearchControl());
    ymap.drawMap(new Y.LatLng(lat,lon), 6,"map");
    ymap.setConfigure('weatherOverlay', true);
    
    
    for ( var i = 0 ; i < markerData.length ; i++ ) {
        var lati = markerData[i]['map_lat'];
        var long = markerData[i]['map_long'];
        var image_path = markerData[i]['image_path'];
        var search_tag = markerData[i]['search_tag'];
        var id = markerData[i]['id'];
        // var icon = new Y.Icon(image_path, {iconSize: new Y.Size(30,30)});
        var marker = new Y.Marker(new Y.LatLng(lati, long),{title:id}); 
        ymap.addFeature(marker);
            

    }
});
</script>
@endsection