var lati = <?php echo json_encode($micropost->map_lat); ?>;
var long = <?php echo json_encode($micropost->map_long); ?>;

window.onload = function(){
  var ymap = new Y.Map("map");
  ymap.drawMap(new Y.LatLng(lati, long), 17);
  ymap.addControl(new Y.CenterMarkControl());
  ymap.addControl(new Y.SliderZoomControlVertical());
  console.log(lati, long);
} 