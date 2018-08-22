<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1,user-scalable=no"/>

        <title>NecoNeco</title>
        
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="{{ secure_asset('css/main.css') }}" media="all">


        <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
        
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <script src="https://code.jquery.com/ui/1.10.0/jquery-ui.js"></script>
        <script src="https://map.yahooapis.jp/js/V1/jsapi?appid={{ getenv('YAHOO_API_KEY') }}"></script>
        <!--<script src="https://maps.googleapis.com/maps/api/js?v=3&key={{getenv('GOOGLE_MAPS_KEY')}}" async defer></script>  -->
        
    </head>
    <body>
        @include('commons.navbar')
        <div class="container-fluid">
            @include('commons.error_messages')
            @yield('content')
        </div>
    </body>
</html>