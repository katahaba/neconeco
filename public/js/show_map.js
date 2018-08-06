window.onload = function(){
  var ymap = new Y.Map("map");
  var lati={$lat};
  var long={$long};
  ymap.drawMap(new Y.LatLng(lati, long), 17);
  ymap.addControl(new Y.CenterMarkControl());
  ymap.addControl(new Y.SliderZoomControlVertical());
}
