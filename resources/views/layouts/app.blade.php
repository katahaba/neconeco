<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Microposts</title>
        
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        
        <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <script src="http://code.jquery.com/ui/1.10.0/jquery-ui.js"></script>
        <script type="text/javascript" charset="utf-8" src="https://map.yahooapis.jp/js/V1/jsapi?appid=dj00aiZpPUo0ZXpHYWpHOFJTYSZzPWNvbnN1bWVyc2VjcmV0Jng9ZDM-"></script>
    </head>
    <body>
        @include('commons.navbar')

        <div class="container">
            @include('commons.error_messages')

            @yield('content')
        </div>
        
        <script>
            $(function() {
                //jquery sortableの初期化と初期設定値の設定
                $(".sortable").sortable({
                    //指定要素が入れ替わった時に発火
                    update: function(ev, ui) {
                        console.log(ev,ui);
                        //指定要素の順番を配列化し、カンマ区切りの文字列に変換
                        var updateArray =  $(".sortable").sortable("toArray").join(",");
                        //変換された文字列をcookieに３０日保持で格納
                        $.cookie("sortable", updateArray, {expires: 30});
                    }       
                });
                //すでにsortableというcookieがあるかをチェック
                if($.cookie("sortable")) {
                    //cookieのsortableをいうデータの値を取得し、カンマ区切り文字列から配列に変換後、配列を逆転する
                    var cookieValue = $.cookie("sortable").split(",").reverse();
                    //上記で取得した配列をループし、要素を追加
                    $.each(cookieValue,function(index, value) {
                        $('#'+value).prependTo(".sortable");
                    });
                }
            });
        </script>
        <script type="text/javascript">
            window.onload = function(){
                var ymap = new Y.Map("map");
                ymap.drawMap(new Y.LatLng(35.66572, 139.73100), 17, Y.LayerSetId.NORMAL);
            }
        </script>
    </body>
</html>