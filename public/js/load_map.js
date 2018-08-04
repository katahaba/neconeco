window.onload = function(){
    var ymap = new Y.Map("map");
    ymap.drawMap(new Y.LatLng(35.66572, 139.73100), 17);
    ymap.addControl(new Y.CenterMarkControl());
    ymap.addControl(new Y.SliderZoomControlVertical());
    ymap.addControl(new Y.SearchControl());

    ymap.bind("moveend", function(){
    var cent = ymap.getCenter();
    var lat = cent.lat();
    var lng = cent.lng();
    console.log(lat);
    console.log(lng);
  });
}    
