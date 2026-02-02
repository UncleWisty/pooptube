@extends('layout')

@section('content')
    <div class="mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Videos Recientes</h2>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
        
        @foreach($videos as $video)
            <div class="bg-white rounded-lg shadow-sm hover:shadow-md transition duration-300 group">
                
                <a href="{{ route('videos.show', $video->id) }}" class="block relative aspect-video bg-gray-900 rounded-t-lg overflow-hidden">
                    <video class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300" muted loop onmouseover="this.play()" onmouseout="this.pause();this.currentTime=0;">
                        <source src="{{ asset('storage/' . $video->video_path) }}" type="video/mp4">
                    </video>
                    
                    <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity bg-black/30">
                        <svg class="w-12 h-12 text-white" fill="currentColor" viewBox="0 0 20 20"><path d="M6.3 2.841A1.5 1.5 0 004 4.11V15.89a1.5 1.5 0 002.3 1.269l9.344-5.89a1.5 1.5 0 000-2.538L6.3 2.84z"/></svg>
                    </div>
                </a>

                <div class="p-3">
                    <h3 class="font-bold text-gray-900 leading-tight mb-1 line-clamp-2 h-10">
                        <a href="{{ route('videos.show', $video->id) }}">
                            {{ $video->title }}
                        </a>
                    </h3>
                    
                    <p class="text-sm text-gray-500 mb-2">{{ $video->user->name }}</p>
                    
                    <div class="text-xs text-gray-400">
                        {{ $video->created_at->diffForHumans() }}
                        &bull; 
                        {{ $video->comments->count() }} comentarios
                    </div>
                </div>
            </div>
        @endforeach

    </div>

    @if($videos->isEmpty())
        <div class="text-center py-20">
            <p class="text-gray-500 text-xl">No hay videos todavía.</p>
            <a href="{{ route('videos.create') }}" class="text-red-600 font-bold hover:underline">¡Sé el primero en subir uno!</a>
        </div>
    @endif
@endsection