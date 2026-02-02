@extends('layout')

@section('content')
    <div class="max-w-2xl mx-auto bg-white p-8 rounded-lg shadow">
        <h1 class="text-2xl font-bold mb-6">Subir nuevo video</h1>
        
        <form action="{{ route('videos.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf
            <div>
                <label class="block font-bold mb-1">Título</label>
                <input type="text" name="title" class="w-full border p-2 rounded" required>
            </div>
            
            <div>
                <label class="block font-bold mb-1">Descripción</label>
                <textarea name="description" class="w-full border p-2 rounded" rows="3"></textarea>
            </div>
            
            <div>
                <label class="block font-bold mb-1">Archivo de Video</label>
                <input type="file" name="video" accept="video/*" class="w-full border p-2 rounded" required>
            </div>
            
            <button type="submit" class="w-full bg-red-600 text-white font-bold py-3 rounded hover:bg-red-700">
                Publicar Video
            </button>
        </form>
    </div>
@endsection