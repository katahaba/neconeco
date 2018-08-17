@extends('layouts.app')

@section('content')
    <div class="row">
        <aside class="col-xs-4 col-md-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">{{ $user->name }}</h3>
                    @if(Auth::id() == $user->id)
                        <a href="{{ route('users.edit', ['id' => $user->id]) }}">Edit</a>
                    @endif
                </div>
                <div class="panel-body">
                    <img class="media-object img-rounded img-responsive" src="{{ Gravatar::src($user->email, 50) }}" alt="">
                </div>
            </div>
        </aside>
        <div class="col-xs-8 col-md-10">
            <ul class="nav nav-tabs nav-justified">
                @if (Auth::id() == $user->id)
                    <li role="presentation" class="{{ Request::is('microposts/create') ? 'active' : '' }}"><a style="text-align:left;" href="{{ route('microposts.create') }}">New Post <span class="badge"></span></a></li>
                @endif
                <li><a style="text-align:left;" href="{{ route('users.show', ['id' => $user->id]) }}">Photos <span class="badge">{{ $count_microposts }}</span></a></li>
                <!--<li role="presentation" class="{{ Request::is('users/' . $user->id) ? 'active' : '' }}"><a style="text-align:left;" href="{{ route('users.show', ['id' => $user->id]) }}">Photos <span class="badge">{{ $count_microposts }}</span></a></li>-->
                <li role="presentation" class="{{ Request::is('users/*/followings') ? 'active' : '' }}"><a style="text-align:left;" href="{{ route('users.followings', ['id' => $user->id]) }}">Followings <span class="badge">{{ $count_followings }}</span></a></li>
                <li role="presentation" class="{{ Request::is('users/*/followers') ? 'active' : '' }}"><a style="text-align:left;" href="{{ route('users.followers', ['id' => $user->id]) }}">Followers <span class="badge">{{ $count_followers }}</span></a></li>
                <li role="presentation" class="{{ Request::is('users/*/favoritings') ? 'active' : '' }}"><a style="text-align:left;" href="{{ route('users.favoritings', ['id' => $user->id]) }}">Favo_Photos <span class="badge">{{ $count_favoritings }}</span></a></li>
            </ul>
        </div> 
    </div>
    @if (Auth::id() == $user->id)
    <div class="row">
        <div class="panel-heading">
            <h4 class="panel-title">Upload</h4>
            <div class="panel-body">
                <div class="col-xs-12 col-md-3 form-data">
                    <br>
                    {!! Form::open(['route' => ['microposts.store'], 'method' => 'POST', 'files' => true]) !!}   
                        {!! Form::label('photo', 'photo_file (写真は必須で5Mb以下です)') !!}
                        {!! Form::file('photo',null,['class' => 'form-control']) !!}    
                        <br> 
                        <div class="form-group">
                            {!! Form::label('search_tag', '検索用タグを入力') !!}
                            {!! Form::text('search_tag', null,['class' => 'form-control']) !!}    
                        </div>
                        <br>
                        <h5>中心位置を撮影場所として保存: 任意</h5>
                        <div id="map" style="width: 350px; height: 350px;"></div>
                        <br>
                        
                        {!! Form::submit('Upload', ['class' => 'btn btn-warning', 'id' => 'button']) !!}
                        {!! Form::hidden('lat') !!}
                        {!! Form::hidden('long') !!}
                    {!! Form::close() !!}
                </div>    
            </div>
        </div>   
    </div>
    @endif
<script>
document.getElementById('photo').onchange = function() {
var fileSize = document.getElementById('photo').files[0].size;
console.log(fileSize);
if (fileSize > 8300000) {
  alert("ファイルが大き過ぎます。");
  document.getElementById("photo").value = null; 
}}
</script>
<script src="{{ secure_asset('js/load_map.js') }}"></script>
@endsection