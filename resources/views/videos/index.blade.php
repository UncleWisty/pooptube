@extends('layout')

@section('content')
    <div class="mb-6 md:mb-8">
        <h2 class="text-2xl md:text-3xl font-bold" style="color: #2d2d2d;">Inicio</h2>
        <p class="text-sm md:text-base mt-1" style="color: #666;">Videos recomendados para ti</p>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4 md:gap-6">
        
        @foreach($videos as $video)
            <div class="bg-white rounded-xl shadow-sm hover:shadow-lg transition-shadow duration-300 overflow-hidden border border-gray-100 group cursor-pointer">
                <!-- Thumbnail Container -->
                <a href="{{ route('videos.show', $video->id) }}" class="block relative w-full aspect-video bg-gray-900 overflow-hidden rounded-xl">
                    <video class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300" muted loop preload="none">
                        <source src="{{ asset('storage/' . $video->video_path) }}" type="video/mp4">
                    </video>
                    
                    <!-- Play Button Overlay -->
                    <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity bg-black/40 duration-300">
                        <svg class="w-14 h-14 text-white drop-shadow-lg" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M6.3 2.841A1.5 1.5 0 004 4.11V15.89a1.5 1.5 0 002.3 1.269l9.344-5.89a1.5 1.5 0 000-2.538L6.3 2.84z"/>
                        </svg>
                    </div>
                    
                    <!-- Duration Badge -->
                    <div class="absolute bottom-2 right-2 px-2 py-1 rounded bg-black/90 text-white text-xs font-semibold">
                        {{ rand(5, 60) }}:{{ rand(10, 59) }}
                    </div>
                </a>

                <!-- Video Info -->
                <div class="p-3 md:p-4">
                    <!-- Channel Avatar + Info -->
                    <div class="flex gap-3 mb-3">
                        <div class="w-9 h-9 rounded-full flex items-center justify-center text-white font-bold text-xs flex-shrink-0" style="background-color: #6CAA86;">
                            {{ substr($video->user->name, 0, 1) }}
                        </div>
                        
                        <div class="flex-1 min-w-0">
                            <!-- Title -->
                            <h3 class="font-bold leading-tight line-clamp-2 text-sm group-hover:text-blue-600 transition" style="color: #2d2d2d;">
                                <a href="{{ route('videos.show', $video->id) }}">
                                    {{ $video->title }}
                                </a>
                            </h3>
                            
                            <!-- Channel Name -->
                            <p class="text-xs mt-1 hover:text-gray-900 transition" style="color: #666;">
                                {{ $video->user->name }}
                            </p>
                        </div>
                    </div>

                    <!-- Stats -->
                    <div class="text-xs" style="color: #999;">
                        <div class="flex items-center justify-between">
                            <span>{{ rand(100, 999) }}K vistas</span>
                            <span>{{ $video->comments->count() }} 💬</span>
                        </div>
                        <div class="mt-1">{{ $video->created_at->diffForHumans() }}</div>
                    </div>
                </div>
            </div>
        @endforeach

    </div>

    @if($videos->isEmpty())
        <div class="col-span-full text-center py-20">
            <svg class="w-16 h-16 mx-auto mb-4 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 20h14a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
            </svg>
            <p class="text-lg md:text-xl mb-4 font-medium" style="color: #666;">No hay videos todavía</p>
            <p class="text-sm md:text-base mb-6" style="color: #999;">Sé el primero en compartir tu contenido</p>
            <a href="{{ route('videos.create') }}" class="inline-block px-6 py-2 rounded-full font-bold text-sm md:text-base text-white transition hover:opacity-90" style="background-color: #6CAA86;">
                + Subir video
            </a>
        </div>
    @endif
@endsection