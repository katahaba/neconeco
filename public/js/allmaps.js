<!--<script >-->
<!--$(function() {-->
    var markerData = JSON.parse(@json($data));//phpでjson化したものを再度配列に
    // var lat=0;
    // var log=0;
    // var maxlat = lat;//最大緯度
    // var maxlng = log;//最大経度
    // var minlat = lat;//最小緯度
    // var minlng = log;//最小経度
<!-- var latitude = 0;-->
<!--        var longitude = 0;-->
        
<!--        var image_path = "";-->
<!--        var search_tag = "";-->
<!--        var id =null;-->
<!--    var ymap = new Y.Map("map");-->
    // ymap.addControl( new Y.SliderZoomControl() );
    // ymap.addControl( new Y.LayerSetControl() );
    // ymap.addControl(new Y.SearchControl());
    // ymap.setConfigure('weatherOverlay', true);
    
<!--    var markers = [];-->
<!--    for ( var i = 0 ; i < markerData.length ; i++ ) {-->
        
<!--         latitude = markerData[i]['map_lat'];-->
<!--         longitude = markerData[i]['map_long'];-->
        // if(maxlat<latitude){maxlat=latitude}else{maxlat=maxlat};
        // if(maxlng<longitude){maxlng=longitude}else{maxlng=maxlng};
        // if(minlat>latitude){minlat=latitude}else{minlat=minlat};
        // if(minlng>longitude){minlng=longitude}else{minlng=minlng};
<!--         image_path = markerData[i]['image_path'];-->
<!--        search_tag = markerData[i]['search_tag'];-->
<!--         id = markerData[i]['id'];-->
<!--        console.log("1",latitude, longitude);-->
<!--        markers.push(new Y.Marker(new Y.LatLng(latitude, longitude),{title:id}));-->
        // var marker = new Y.Marker(new Y.LatLng(latitude, longitude),{title:id});
<!--    }-->
<!--    console.log("3",latitude, longitude);-->
<!--        ymap.addFeatures(markers);-->
        
    //北西端の座標を設定
<!--    var sw = new Y.LatLng(maxlat,minlng);-->
    //東南端の座標を設定
<!--    var ne = new Y.LatLng(minlat,maxlng);-->
    //範囲を設定
    // var bounds = ymap.getBounds(sw,ne);
    //自動調整
    // ymap.drawBounds(sw,ne);

<!--});-->
<!--</script>-->