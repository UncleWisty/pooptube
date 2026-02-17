@extends('layout')

@section('content')
    <div class="max-w-4xl mx-auto">
        <div class="mb-6 md:mb-8">
            <h1 class="text-2xl md:text-3xl font-bold mb-2" style="color: #2d2d2d;">Mis Comentarios</h1>
            <p class="text-sm md:text-base" style="color: #666;">Total: {{ Auth::user()->comments->count() }} comentarios</p>
        </div>

        @if(Auth::user()->comments->isEmpty())
            <div class="bg-white rounded-lg p-8 md:p-12 text-center shadow-md border border-gray-200">
                <p class="text-lg md:text-xl mb-4" style="color: #2d2d2d;">No has dejado comentarios todavía</p>
                <p class="text-sm md:text-base mb-6" style="color: #666;">Explora videos y comparte tus opiniones</p>
                <a href="{{ route('videos.index') }}" class="inline-block px-6 py-3 rounded-lg transition text-sm md:text-base font-medium text-white" style="background-color: #6CAA86;" onmouseover="this.style.opacity='0.9'" onmouseout="this.style.opacity='1'">
                    Explorar Videos
                </a>
            </div>
        @else
            <div class="space-y-3 md:space-y-4">
                @foreach(Auth::user()->comments as $comment)
                    <div class="bg-white rounded-lg p-4 md:p-6 shadow-md border border-gray-200 hover:shadow-lg transition">
                        <div class="flex flex-col md:flex-row md:items-start md:justify-between mb-3 gap-2">
                            <div class="flex items-start gap-3 flex-1">
                                <div class="w-10 md:w-12 h-10 md:h-12 rounded-full flex items-center justify-center text-white font-bold flex-shrink-0 text-sm md:text-base" style="background-color: #447169;">
                                    {{ substr(Auth::user()->name, 0, 1) }}
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="font-bold text-sm md:text-base" style="color: #2d2d2d;">{{ Auth::user()->name }}</p>
                                    <p class="text-xs md:text-sm" style="color: #999;">{{ $comment->created_at->format('d M Y \a \l\a\s H:i') }}</p>
                                </div>
                            </div>
                        </div>

                        <p class="text-sm md:text-base mb-4 break-words" style="color: #2d2d2d; line-height: 1.6;">{{ $comment->body }}</p>

                        <div class="flex flex-col sm:flex-row gap-2">
                            <a href="{{ route('videos.show', $comment->video_id) }}" class="flex-1 sm:flex-0 text-center px-4 py-2 rounded-lg transition text-sm md:text-base font-medium text-white" style="background-color: #6CAA86;" onmouseover="this.style.opacity='0.9'" onmouseout="this.style.opacity='1'">
                                Ver Video
                            </a>
                        </div>

                        <div class="mt-3 pt-3 border-t border-gray-200">
                            <div class="flex flex-wrap gap-2 md:gap-3">
                                <span class="inline-block text-xs md:text-sm px-2 py-1 rounded" style="background-color: #f5f5f5; color: #666;">
                                    📺 {{ $comment->video->title }}
                                </span>
                                <span class="inline-block text-xs md:text-sm px-2 py-1 rounded" style="background-color: #f5f5f5; color: #666;">
                                    👤 {{ $comment->video->user->name }}
                                </span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection
