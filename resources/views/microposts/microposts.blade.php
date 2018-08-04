<ul class="media-list">
    @foreach ($microposts as $micropost)
        <?php $user = $micropost->user; ?>
        <li class="media"><div class="media-body">
                <a id="{{$micropost->id}}" class="block" href="{{ route('microposts.show', ['id' => $micropost->id]) }}"><img src="{{ secure_asset($micropost->image_path)}}"></a>
                <div>
                    @if (Auth::id() == $micropost->user_id)
                        {!! Form::open(['route' => ['microposts.destroy', $micropost->id], 'method' => 'delete']) !!}
                        {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-xs']) !!}
                        {!! Form::close() !!}
                    @endif
                </div>
                
            </div>
        </li>
    @endforeach
</ul>
{!! $microposts->render() !!}
