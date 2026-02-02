@extends('layout')

@section('content')
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div class="lg:col-span-2">
            <video class="w-full rounded-lg shadow-lg bg-black" controls autoplay>
                <source src="{{ asset('storage/' . $video->video_path) }}" type="video/mp4">
            </video>
            
            <h1 class="text-2xl font-bold mt-4">{{ $video->title }}</h1>
            <p class="text-gray-600">Subido por <span class="font-bold text-black">{{ $video->user->name }}</span></p>
            
            <div class="mt-4 p-4 bg-white rounded shadow-sm">
                <p>{{ $video->description }}</p>
            </div>
        </div>

        <div class="bg-white p-4 rounded shadow h-fit">
            <h3 class="font-bold text-xl mb-4">Comentarios ({{ $video->comments->count() }})</h3>
            
            @auth
                <form action="{{ route('comments.store', $video) }}" method="POST" class="mb-6">
                    @csrf
                    <textarea name="body" class="w-full border p-2 rounded mb-2" placeholder="Añade un comentario..." rows="2" required></textarea>
                    <button type="submit" class="bg-blue-600 text-white px-4 py-1 rounded text-sm hover:bg-blue-700">Comentar</button>
                </form>
            @endauth

            <div class="space-y-4">
                @foreach($video->comments as $comment)
                    <div class="border-b pb-2">
                        <p class="font-bold text-sm">{{ $comment->user->name }}</p>
                        <p class="text-gray-700">{{ $comment->body }}</p>
                        <small class="text-gray-400 text-xs">{{ $comment->created_at->diffForHumans() }}</small>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection