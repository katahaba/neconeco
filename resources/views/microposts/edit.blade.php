@extends('layouts.app')

@section('content')
    <div class="row show">
        <div class="col-xs-12 col-md-3 form-data">
            @if (\Session::has('updated'))
            <div class="alert alert-success">{!! \Session::get('updated') !!}</div>
            @endif
            <img class="cat_image" src="{{ secure_asset($micropost->image_path)}}"></a>
            <br>
            @if (Auth::id() === $micropost->user_id)
                {!! Form::open(['route' => ['microposts.update', $micropost->id], 'method' => 'PUT']) !!}   
                    <div class="form-group">
                        {!! Form::label('search_tag', '検索用タグを更新') !!}
                        {!! Form::text('search_tag', null,['class' => 'form-control']) !!}    
                    </div>
                    <br>
                    <h5>中心位置を撮影場所として更新: 任意</h5>
                    <div id="map" style="width: 350px; height: 350px;"></div>
                    <br>
                    {!! Form::submit('Update', ['class' => 'btn btn-warning', 'id' => 'button']) !!}
                    {!! Form::hidden('lat') !!}
                    {!! Form::hidden('long') !!}
                {!! Form::close() !!}
            @endif
    </div>    
<script src="{{ secure_asset('js/load_map.js') }}"></script>
@endsection