@extends('layout')

@section('content')
<div class="max-w-6xl mx-auto">
    <h1 class="text-2xl font-bold mb-4">Mis Videos</h1>

    @if($videos->isEmpty())
        <div class="panel p-6 text-center">
            <p class="mb-4">Aún no tienes videos subidos.</p>
            <a href="{{ route('videos.create') }}" class="btn-success px-4 py-2">Subir un video</a>
        </div>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            @foreach($videos as $video)
                <div class="panel p-4 rounded-lg">
                    <a href="{{ route('videos.show', $video) }}" class="block font-bold text-lg">{{ $video->title }}</a>
                    <p class="text-sm text-gray-500">{{ \Illuminate\Support\Str::limit($video->description, 120) }}</p>
                    <div class="mt-3 flex gap-2">
                        <a href="{{ route('videos.edit', $video) }}" class="btn-panel px-3 py-2">Editar</a>
                        <form action="{{ route('videos.destroy', $video) }}" method="POST" onsubmit="return confirm('¿Eliminar este video? Esta acción no se puede deshacer.')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="px-3 py-2 rounded bg-red-600 text-white">Eliminar</button>
                        </form>
                        <a href="{{ route('videos.show', $video) }}" class="ml-auto btn-panel px-3 py-2">Ver</a>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
