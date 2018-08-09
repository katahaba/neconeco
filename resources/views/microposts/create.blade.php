@extends('layouts.app')

@section('content')
    <div class="row">
        <aside class="col-xs-4">
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
        <div class="col-xs-8">
            <ul class="nav nav-tabs nav-justified">
                @if (Auth::id() == $user->id)
                    <li role="presentation" class="{{ Request::is('microposts/create') ? 'active' : '' }}"><a href="{{ route('microposts.create') }}">New Post <span class="badge"></span></a></li>
                @endif
                <li><a href="{{ route('users.show', ['id' => $user->id]) }}">Photos <span class="badge">{{ $count_microposts }}</span></a></li>
                <!--<li role="presentation" class="{{ Request::is('users/' . $user->id) ? 'active' : '' }}"><a href="{{ route('users.show', ['id' => $user->id]) }}">Photos <span class="badge">{{ $count_microposts }}</span></a></li>-->
                <li role="presentation" class="{{ Request::is('users/*/followings') ? 'active' : '' }}"><a href="{{ route('users.followings', ['id' => $user->id]) }}">Followings <span class="badge">{{ $count_followings }}</span></a></li>
                <li role="presentation" class="{{ Request::is('users/*/followers') ? 'active' : '' }}"><a href="{{ route('users.followers', ['id' => $user->id]) }}">Followers <span class="badge">{{ $count_followers }}</span></a></li>
                <li role="presentation" class="{{ Request::is('users/*/favoritings') ? 'active' : '' }}"><a href="{{ route('users.favoritings', ['id' => $user->id]) }}">Favo_Photos <span class="badge">{{ $count_favoritings }}</span></a></li>
            </ul>
        </div> 
    </div>
    @if (Auth::id() == $user->id)
    <div class="row">
        <div class="panel-heading">
            <h4 class="panel-title">Upload</h4>
            <div class="panel-body">
                <h5>photographing_place</h5>
                <h6>(中心位置を撮影場所として保存:任意)</h6>
                <div id="map" style="width: 350px; height: 350px;"></div>
            </div>
            <div class="panel-body">
                {!! Form::open(['route' => ['microposts.store'], 'method' => 'POST', 'files' => true]) !!}
                    {!! Form::label('photo', 'photo_file') !!}
                    {!! Form::file('photo') !!}
                    <h6>(写真は必須で10Mb以下です。)</h6>
                    
                    {!! Form::label('search_tag', 'search_tag') !!}
                    {!! Form::text('search_tag') !!}
                    <h6>(猫の種類などを入れてください。)</h6>
                    
                    {!! Form::submit('Submit', ['class' => 'btn btn-primary', 'id' => 'button']) !!}
                    {!! Form::hidden('lat') !!}
                    {!! Form::hidden('long') !!}

                {!! Form::close() !!}
            </div>
        </div>   
    </div>
    @endif
<script src="{{ secure_asset('js/load_map.js') }}"></script>
@endsection