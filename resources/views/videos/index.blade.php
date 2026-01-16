<h1>Pooptube</h1>
<a href="{{ route('videos.create') }}">Subir Video</a>
@foreach($videos as $video)
    <h3>{{ $video->title }}</h3>
    <video width="300" controls>
        <source src="{{ asset('storage/' . $video->video_path) }}" type="video/mp4">
    </video>
    <a href="{{ route('videos.show', $video->id) }}">Ver</a>
@endforeach