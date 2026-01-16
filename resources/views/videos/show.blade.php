<a href="{{ route('videos.index') }}">Atrás</a>
<h1>{{ $video->title }}</h1>
<video width="800" controls autoplay>
    <source src="{{ asset('storage/' . $video->video_path) }}" type="video/mp4">
</video>