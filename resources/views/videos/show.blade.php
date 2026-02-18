@extends('layout')

@section('content')

<style>
    video {
        width: 95%;              /* MÁS GRANDE */
        max-width: 1250px;       /* Límite elegante */
        border-radius: 20px;
        margin: 30px auto 50px auto;
        display: block;
    }
</style>

<div class="grid grid-cols-1 lg:grid-cols-4 gap-6 px-6">

    <!-- VIDEO + INFO -->
    <div class="lg:col-span-3" style="margin-left: 20px;">

        <!-- VIDEO CENTRADO -->
        <video controls autoplay>
            <source src="{{ asset('storage/' . $video->video_path) }}" type="video/mp4">
        </video>

        <!-- TÍTULO -->
        <h1 class="text-2xl font-bold mb-4 text-neutral-900">
            {{ $video->title }}
        </h1>

        <!-- USUARIO + BOTONES -->
        <div class="flex items-center justify-between w-full">

            <!-- IZQUIERDA: Usuario -->
            <div class="flex items-center gap-3">
                <div class="w-[55px] h-[55px] rounded-full flex items-center justify-center 
                            text-white font-bold text-xl"
                     style="background-color:#DE8E00; width: 55px; height: 55px;">
                    {{ substr($video->user->name, 0, 1) }}
                </div>

                <div>
                    <p class="font-bold text-base text-neutral-900">
                        {{ $video->user->name }}
                    </p>
                    <p class="text-sm text-neutral-600">
                        {{ rand(100, 999) }}K suscriptores
                    </p>
                </div>
            </div>

            <!-- DERECHA: Botones estilo YouTube -->
            <div class="flex items-center gap-1">

                <!-- Like -->
                <button class="w-12 h-12 rounded-full bg-neutral-200 flex items-center justify-center 
                               text-2xl hover:bg-neutral-300 transition text-orange-500">
                    L
                </button>

                <!-- Dislike -->
                <button class="w-12 h-12 rounded-full bg-neutral-200 flex items-center justify-center 
                               text-2xl hover:bg-neutral-300 transition">
                    W
                </button>

                <!-- Descargar -->
                <button class="px-5 py-2 rounded-full bg-neutral-200 text-sm font-semibold 
                               hover:bg-neutral-300 transition">
                    Descargar
                </button>

            </div>
        </div>

        <!-- DESCRIPCIÓN -->
        @if($video->description)
        <div class="mt-4 p-4  rounded-lg text-sm text-neutral-800">
            {{ $video->description }}
        </div>
        @endif

    </div>

    <!-- COMENTARIOS (estilo YouTube, SIN BORDE) -->
    <div class="lg:col-span-1">

        <div class=" rounded-lg">

            <!-- TÍTULO -->
            <div class="p-4 bg-neutral-100">
                <h3 class="font-bold text-lg text-neutral-900">
                    Comentarios ({{ $video->comments->count() }})
                </h3>
            </div>

            <div class="max-h-[80vh] overflow-y-auto">

                <!-- Caja para escribir comentario -->
                @auth
                <div class="p-4">
                    <textarea name="body" form="comment-form"
                        class=" bg-neutral-100 w-full p-3 rounded-lg text-sm placeholder-neutral-500 focus:ring-2 resize-none border border-neutral-300"
                        style="--tw-ring-color:#6CAA86;"
                        placeholder="Añade un comentario..." rows="2" required></textarea>
                </div>
                @endauth

                 @auth
            <form id="comment-form" action="{{ route('comments.store', $video) }}" method="POST"
                class="p-4">
                @csrf
                <button type="submit"
                    class="w-full text-white py-2 rounded-lg font-bold transition text-sm"
                    style="background-color:#447169; width: 30%;">
                    Comentar
                </button>
            </form>
            @endauth
                <!-- LISTA DE COMENTARIOS -->
                <div class="p-4 space-y-4">

                    @forelse($video->comments as $comment)
                    <div class="pb-4">

                        <div class="flex items-start gap-3">

                            <!-- Avatar -->
                            <div class="rounded-full flex items-center justify-center text-white font-bold text-sm"
                                style="background-color:#447169; width: 45px; height: 45px;">
                                {{ substr($comment->user->name, 0, 1) }}
                            </div>

                            <!-- Contenido -->
                            <div class="flex-1">
                                <p class="font-bold text-sm text-neutral-900">
                                    {{ $comment->user->name }}
                                </p>

                                <p class="text-xs text-neutral-500 mb-1">
                                    {{ $comment->created_at->diffForHumans() }}
                                </p>

                                <p class="text-sm text-neutral-800">
                                    {{ $comment->body }}
                                </p>

                                <!-- Like comentario -->
                                <div class="flex items-center gap-2 mt-2">
                                    <button class="text-neutral-600 hover:text-emerald-500 transition text-sm">
                                        👍
                                    </button>
                                    <span class="text-xs text-neutral-500">
                                        {{ rand(0, 1000000) }}
                                    </span>
                                </div>
                            </div>

                        </div>

                    </div>
                    @empty
                    <p class="text-sm text-center py-4 text-neutral-500">
                        No hay comentarios todavía...
                    </p>
                    @endforelse

                </div>
            </div>

            <!-- Botón comentar -->
           

        </div>

    </div>

</div>

@endsection
