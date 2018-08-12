window.onload = function(){
  var ymap = new Y.Map("map");
  var lati=35.66572;
  var long=139.73100;
  ymap.drawMap(new Y.LatLng(lati, long), 17);
  ymap.addControl(new Y.CenterMarkControl());
  ymap.addControl(new Y.SliderZoomControlVertical());
  ymap.addControl(new Y.SearchControl());

  ymap.bind("moveend", function(){
    var pos = ymap.getCenter();
    lati = pos.lat();
    long = pos.lng();
    console.log(lati,long);
  });
  
  $('form').submit(function(){
    $('[name="lat"]').val(lati);
    $('[name="long"]').val(long);
  })
}


