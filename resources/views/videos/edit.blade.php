@extends('layout')

@section('content')
<div class="max-w-2xl mx-auto panel p-4 md:p-8 rounded-lg shadow-md">
    <h1 class="text-2xl md:text-3xl font-bold mb-6">Editar video</h1>

    <form action="{{ route('videos.update', $video) }}" method="POST" class="space-y-4 md:space-y-6">
        @csrf
        @method('PATCH')

        <div>
            <label class="block font-bold mb-2">Título</label>
            <input type="text" name="title" value="{{ old('title', $video->title) }}" class="w-full p-2 md:p-3 rounded-lg form-control" required>
            @error('title')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
        </div>

        <div>
            <label class="block font-bold mb-2">Descripción</label>
            <textarea name="description" class="w-full p-2 md:p-3 rounded-lg form-control" rows="6">{{ old('description', $video->description) }}</textarea>
            @error('description')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
        </div>

        <div class="flex gap-3">
            <button type="submit" class="btn-success px-4 py-2">Guardar cambios</button>
            <a href="{{ route('videos.show', $video) }}" class="btn-panel px-4 py-2">Cancelar</a>
        </div>
    </form>
</div>
@endsection
