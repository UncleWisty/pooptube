<!DOCTYPE html>
<html>
<head>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="p-10">
    <div class="mb-4">
        <a href="{{ route('videos.index') }}" class="text-blue-500">&larr; Volver</a>
    </div>

    <h1 class="text-3xl font-bold">{{ $video->title }}</h1>
    
    <p class="text-gray-600 mb-4">Subido por: <strong>{{ $video->user->name }}</strong></p>

    <video class="w-full max-w-4xl" controls autoplay>
        <source src="{{ asset('storage/' . $video->video_path) }}" type="video/mp4">
    </video>
    
    <div class="mt-4 p-4 bg-gray-100 rounded">
        <p>{{ $video->description }}</p>
    </div>

    <hr class="my-8">

    <h3 class="text-2xl font-bold mb-4">Comentarios</h3>

    @auth
        <form action="{{ route('comments.store', $video) }}" method="POST" class="mb-8">
            @csrf
            <textarea name="body" class="w-full border p-2 rounded" placeholder="Escribe un comentario..." required></textarea>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded mt-2">Comentar</button>
        </form>
    @else
        <p class="mb-4"><a href="{{ route('login') }}" class="text-blue-500">Inicia sesión</a> para comentar.</p>
    @endauth

    @foreach($video->comments as $comment)
        <div class="border-b py-2">
            <strong>{{ $comment->user->name }}</strong> dijo:
            <p>{{ $comment->body }}</p>
            <small class="text-gray-400">{{ $comment->created_at->diffForHumans() }}</small>
        </div>
    @endforeach
</body>
</html>