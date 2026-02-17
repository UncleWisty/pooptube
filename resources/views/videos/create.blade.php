@extends('layout')

@section('content')
    <div class="max-w-2xl mx-auto bg-white p-4 md:p-8 rounded-lg shadow-md border border-gray-200">
        <h1 class="text-2xl md:text-3xl font-bold mb-6 md:mb-8" style="color: #2d2d2d;">Subir nuevo video</h1>
        
        <form action="{{ route('videos.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4 md:space-y-6">
            @csrf
            
            <div>
                <label class="block font-bold mb-2 text-sm md:text-base" style="color: #2d2d2d;">Título</label>
                <input type="text" name="title" class="w-full p-2 md:p-3 rounded-lg focus:outline-none focus:ring-2 transition text-sm md:text-base" style="border: 1px solid #e0e0e0; --tw-ring-color: #6CAA86;" placeholder="Nombre del video" required>
                @error('title')
                    <p class="text-red-600 text-xs md:text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <div>
                <label class="block font-bold mb-2 text-sm md:text-base" style="color: #2d2d2d;">Descripción</label>
                <textarea name="description" class="w-full p-2 md:p-3 rounded-lg focus:outline-none focus:ring-2 transition resize-none text-sm md:text-base" style="border: 1px solid #e0e0e0; --tw-ring-color: #6CAA86;" rows="4" placeholder="Describe tu video..."></textarea>
            </div>
            
            <div>
                <label class="block font-bold mb-2 text-sm md:text-base" style="color: #2d2d2d;">Archivo de Video</label>
                <div class="p-4 md:p-6 rounded-lg text-center transition cursor-pointer" style="border: 2px dashed #e0e0e0;">
                    <input type="file" name="video" accept="video/*" class="hidden" id="video-input" required>
                    <label for="video-input" class="cursor-pointer">
                        <p class="font-medium text-sm md:text-base" style="color: #666;">Selecciona o arrastra tu video</p>
                        <p class="text-xs md:text-sm mt-1" style="color: #999;">MP4, MOV, OGG — máx. 100MB</p>
                    </label>
                </div>
                @error('video')
                    <p class="text-red-600 text-xs md:text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <button type="submit" class="w-full text-white font-bold py-3 rounded-lg transition text-sm md:text-base" style="background-color: #6CAA86;" onmouseover="this.style.opacity='0.9'" onmouseout="this.style.opacity='1'">
                Publicar Video
            </button>
        </form>
    </div>
@endsection