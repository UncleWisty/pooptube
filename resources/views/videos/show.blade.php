@extends('layout')

@section('content')
    <div class="grid grid-cols-1 lg:grid-cols-4 gap-4 md:gap-6">
        <!-- Video y Detalles (3 columnas) -->
        <div class="lg:col-span-3">
            <!-- Video Player -->
            <div class="bg-black rounded-lg overflow-hidden shadow-lg mb-4">
                <video class="w-full aspect-video" controls autoplay>
                    <source src="{{ asset('storage/' . $video->video_path) }}" type="video/mp4">
                </video>
            </div>

            <!-- Información del Video -->
            <div class="bg-white rounded-lg p-4 md:p-6 shadow-md border border-gray-200">
                <h1 class="text-xl md:text-2xl font-bold mb-4" style="color: #2d2d2d;">{{ $video->title }}</h1>
                
                <div class="flex flex-col md:flex-row items-start md:items-center justify-between mb-4 pb-4 border-b border-gray-200 gap-3">
                    <div class="flex items-center gap-3">
                        <div class="w-10 md:w-12 h-10 md:h-12 rounded-full flex items-center justify-center text-white font-bold flex-shrink-0 text-sm md:text-base" style="background-color: #DE8E00;">
                            {{ substr($video->user->name, 0, 1) }}
                        </div>
                        <div>
                            <p class="font-bold text-sm md:text-base" style="color: #2d2d2d;">{{ $video->user->name }}</p>
                            <p class="text-xs md:text-sm" style="color: #666;">{{ rand(100, 999) }}K suscriptores</p>
                        </div>
                    </div>
                    
                    <div class="flex gap-2 w-full md:w-auto">
                        <button class="flex-1 md:flex-0 px-3 md:px-4 py-2 rounded-lg transition text-xs md:text-sm" style="background-color: #f5f5f5; color: #2d2d2d;" onmouseover="this.style.opacity='0.7'" onmouseout="this.style.opacity='1'">
                            ♥️
                        </button>
                        <button class="flex-1 md:flex-0 px-3 md:px-4 py-2 rounded-lg transition text-xs md:text-sm" style="background-color: #f5f5f5; color: #2d2d2d;" onmouseover="this.style.opacity='0.7'" onmouseout="this.style.opacity='1'">
                            Compartir
                        </button>
                    </div>
                </div>

                @if($video->description)
                    <div class="p-3 md:p-4 rounded-lg text-xs md:text-sm" style="background-color: #f9f9f9; color: #2d2d2d;">
                        {{ $video->description }}
                    </div>
                @endif
            </div>
        </div>

        <!-- Comentarios (1 columna) -->
        <div class="lg:col-span-1">
            <div class="bg-white rounded-lg shadow-md overflow-hidden sticky top-20 lg:top-24 border border-gray-200">
                <div class="p-3 md:p-4" style="background-color: #f5f5f5; border-bottom: 1px solid #e0e0e0;">
                    <h3 class="font-bold text-base md:text-lg" style="color: #2d2d2d;">Comentarios ({{ $video->comments->count() }})</h3>
                </div>

                <div class="max-h-96 md:max-h-screen overflow-y-auto">
                    @auth
                        <div class="p-3 md:p-4" style="border-bottom: 1px solid #e0e0e0;">
                            <textarea name="body" form="comment-form" class="w-full p-2 rounded-lg text-xs md:text-sm placeholder-gray-500 focus:outline-none focus:ring-2 resize-none" style="border: 1px solid #e0e0e0; --tw-ring-color: #6CAA86;" placeholder="Añade un comentario..." rows="2" required></textarea>
                        </div>
                    @endauth

                    <div class="p-3 md:p-4 space-y-3 md:space-y-4">
                        @forelse($video->comments as $comment)
                            <div class="pb-3 md:pb-4" style="border-bottom: 1px solid #e0e0e0;">
                                <div class="flex items-start gap-2">
                                    <div class="w-7 md:w-8 h-7 md:h-8 rounded-full flex items-center justify-center text-white font-bold text-xs flex-shrink-0" style="background-color: #447169;">
                                        {{ substr($comment->user->name, 0, 1) }}
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="font-bold text-xs md:text-sm" style="color: #2d2d2d;">{{ $comment->user->name }}</p>
                                        <p class="text-xs mb-1" style="color: #999;">{{ $comment->created_at->diffForHumans() }}</p>
                                        <p class="text-xs md:text-sm break-words" style="color: #2d2d2d;">{{ $comment->body }}</p>
                                        <div class="flex gap-2 mt-1 md:mt-2">
                                            <button class="text-xs transition" style="color: #666;" onmouseover="this.style.color='#6CAA86'" onmouseout="this.style.color='#666'">👍</button>
                                            <span class="text-xs" style="color: #999;">{{ rand(0, 1000000) }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <p class="text-xs md:text-sm text-center py-4" style="color: #999;">No hay comentarios todavía</p>
                        @endforelse
                    </div>
                </div>

                @auth
                    <form id="comment-form" action="{{ route('comments.store', $video) }}" method="POST" class="p-3 md:p-4" style="border-top: 1px solid #e0e0e0;">
                        @csrf
                        <button type="submit" class="w-full text-white py-2 rounded-lg font-bold transition text-xs md:text-sm" style="background-color: #6CAA86;" onmouseover="this.style.opacity='0.9'" onmouseout="this.style.opacity='1'">
                            Comentar
                        </button>
                    </form>
                @endauth
            </div>
        </div>
    </div>
@endsection