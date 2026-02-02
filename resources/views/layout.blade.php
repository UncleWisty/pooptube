<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pooptube</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50">

    <nav class="bg-white border-b border-gray-200 p-4 mb-6 shadow-sm sticky top-0 z-50">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            <a href="{{ route('videos.index') }}" class="text-2xl font-bold text-red-600 flex items-center gap-2">
                Pooptube
            </a>

            <div class="flex items-center gap-4">
                @auth
                    <span class="text-gray-500 hidden md:inline">Hola, {{ Auth::user()->name }}</span>
                    
                    <a href="{{ route('videos.create') }}" class="bg-red-600 text-white px-4 py-2 rounded-full hover:bg-red-700 transition">
                        + Subir
                    </a>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="text-gray-600 hover:text-red-600 font-medium ml-2">
                            Salir
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="text-gray-600 hover:text-red-600 font-medium">Entrar</a>
                    <a href="{{ route('register') }}" class="border border-red-600 text-red-600 px-4 py-2 rounded-full hover:bg-red-50 transition">Registrarse</a>
                @endauth
            </div>
        </div>
    </nav>

    <main class="max-w-7xl mx-auto px-4">
        @yield('content')
    </main>

    <footer class="text-center text-gray-400 py-10 text-sm">
        &copy; {{ date('Y') }} Lorien & Izan
    </footer>

</body>
</html>