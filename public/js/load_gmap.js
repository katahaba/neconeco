// リターンキーを押しても送信されないように13番(エンターキー)を無効化
$(function() {
  $(window).keydown(function(event){
    if(event.keyCode == 13) {
      event.preventDefault();
      return false;
    }
   })
 });
  //////////////////////////////////////////
  //地図の表示と中心位置の緯度・経度取得
  var map;

function initialize() {
  if (GBrowserIsCompatible()) {
    map = new GMap2(document.getElementById("map_canvas"));
    map.setCenter(new GLatLng(40.464581,140.882835), 11);

    GEvent.addListener(map, "click", clickAction);
  }
}

function clickAction(overlay, latlng, overlaylatlng){
  map.addOverlay(new GMarker(latlng));
}

<script>
function initialize(){
  
  var mapdiv = document.getElementById("map");
  var opts = {
    center: new google.maps.LatLng(35.71, 139.8107),
    zoom: 15,
  };
  var map = new google.maps.Map(mapdiv, opts);
}
  var cent=getCenter();
  var marker = new google.maps.Marker({map: map ,position:cent }) ;

 </script>



//     var map = new google.maps.Map(document.getElementById("map"), myOptions);
//     Event.addListener(map, "click", clickAction);
    
    
//     function clickAction(overlay, latlng, overlaylatlng){
//     map.addOverlay(new GMarker(latlng));
//     var latlng = map.getCenter();
//     }
    
    
   
//     $('form').submit(function(){
//       $('[name="lat"]').val(latlang.lat());
//       $('[name="long"]').val(latlang.lng());
//    });
//    }
//    });


<script src="https://maps.googleapis.com/maps/api/js?key={{ getenv('GOOGLE_MAP_API') }}&callback=initMap?&amp"></script>
