<ul class="media-list">
    @foreach ($microposts as $micropost)
        <?php $user = $micropost->user; ?>
            <a id="{{$micropost->id}}"  href="{{ route('microposts.show', ['id' => $micropost->id]) }}"><img src="{{ secure_asset($micropost->image_path)}}"></a>
    @endforeach
</ul>
{!! $microposts->render() !!}
