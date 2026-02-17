<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pooptube</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        * { box-sizing: border-box; }
        body { background-color: #f5f5f5; color: #2d2d2d; margin: 0; padding: 0; }
        .sidebar-toggle { display: none; }
        #sidebar { transition: all 0.3s ease; }
        
        /* Logo POOP Estilizado */
        .poop-logo {
            display: inline-flex;
            gap: 6px;
            align-items: center;
            text-decoration: none;
            font-weight: 900;
            font-size: 24px;
            letter-spacing: 4px;
        }
        
        .logo-circle {
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            color: white;
            font-weight: 900;
            font-size: 18px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.15);
        }
        
        .logo-p1 { background: linear-gradient(135deg, #1abc9c 0%, #16a085 100%); }
        .logo-o1 { background: linear-gradient(135deg, #DE8E00 0%, #C97700 100%); }
        .logo-o2 { background: linear-gradient(135deg, #B8D400 0%, #9FB200 100%); }
        .logo-p2 { background: linear-gradient(135deg, #82C884 0%, #6CAA86 100%); }
        
        @media (max-width: 768px) {
            .sidebar-toggle { display: block; }
            #sidebar { position: fixed; left: 0; top: 60px; height: calc(100vh - 60px); width: 280px; transform: translateX(-100%); z-index: 40; overflow-y: auto; box-shadow: 2px 0 10px rgba(0,0,0,0.1); }
            #sidebar.active { transform: translateX(0); }
            .logo-circle { width: 32px; height: 32px; font-size: 14px; }
            .poop-logo { font-size: 20px; gap: 4px; }
        }
        
        .navbar-user-menu {
            position: relative;
        }
        
        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: #DE8E00;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
            cursor: pointer;
            transition: transform 0.2s, box-shadow 0.2s;
            box-shadow: 0 2px 8px rgba(222, 142, 0, 0.3);
        }
        
        .user-avatar:hover {
            transform: scale(1.1);
            box-shadow: 0 4px 12px rgba(222, 142, 0, 0.5);
        }
    </style>
</head>
<body>

    <!-- Navbar Tipo YouTube -->
    <nav style="background-color: white; border-bottom: 1px solid #e0e0e0;" class="sticky top-0 z-50 h-16">
        <div class="max-w-full h-full flex justify-between items-center px-4 md:px-8 gap-4">
            <!-- Logo + Toggle -->
            <div class="flex items-center gap-4 flex-shrink-0">
                <button id="menu-toggle" class="sidebar-toggle text-gray-700 text-2xl md:hidden hover:opacity-70 transition p-2">
                    ☰
                </button>
                
                <a href="{{ route('videos.index') }}" class="poop-logo hover:opacity-90 transition">
                    <div class="logo-circle logo-p1">P</div>
                    <div class="logo-circle logo-o1">O</div>
                    <div class="logo-circle logo-o2">O</div>
                    <div class="logo-circle logo-p2">P</div>
                </a>
            </div>

            <!-- Búsqueda Centrada -->
            <div class="hidden sm:flex flex-1 max-w-2xl mx-4">
                <div class="relative w-full">
                    <input type="text" placeholder="Buscar en Pooptube" 
                           class="w-full px-4 py-2 rounded-full bg-gray-100 text-gray-800 placeholder-gray-500 focus:outline-none focus:bg-white focus:ring-2 text-sm"
                           style="--tw-ring-color: #DE8E00;">
                    <button class="absolute right-1 top-1/2 transform -translate-y-1/2 text-gray-600 p-2 hover:opacity-60 transition rounded-full"
                            style="background-color: transparent;">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"/></svg>
                    </button>
                </div>
            </div>

            <!-- Botones Derecha -->
            <div class="flex items-center gap-2 md:gap-6 flex-shrink-0">
                @auth
                    <a href="{{ route('videos.create') }}" 
                       class="hidden md:flex items-center gap-2 text-gray-700 font-semibold px-4 py-2 rounded-full hover:bg-gray-100 transition text-sm"
                       title="Crear video">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                        </svg>
                    </a>
                    
                    <a href="{{ route('videos.create') }}" 
                       class="md:hidden text-gray-700 font-semibold px-3 py-1.5 rounded-full hover:bg-gray-100 transition text-xs"
                       title="Crear">
                        + Crear
                    </a>

                    <!-- User Avatar -->
                    <div class="navbar-user-menu">
                        <div class="user-avatar" id="user-menu-btn" title="{{ Auth::user()->name }}">
                            {{ substr(Auth::user()->name, 0, 1) }}
                        </div>
                        
                        <!-- Dropdown Menu -->
                        <div id="user-dropdown" class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg border border-gray-200 hidden" style="z-index: 100;">
                            <div class="px-4 py-3 border-b border-gray-100">
                                <p class="font-bold text-sm" style="color: #2d2d2d;">{{ Auth::user()->name }}</p>
                                <p class="text-xs" style="color: #999;">{{ Auth::user()->email }}</p>
                            </div>
                            <a href="{{ route('comments.index') }}" class="block px-4 py-3 hover:bg-gray-50 text-sm text-gray-700 transition">
                                📝 Mis comentarios
                            </a>
                            <a href="#" class="block px-4 py-3 hover:bg-gray-50 text-sm text-gray-700 transition">
                                📺 Mis videos
                            </a>
                            <div class="border-t border-gray-100"></div>
                            <form method="POST" action="{{ route('logout') }}" class="block">
                                @csrf
                                <button type="submit" class="w-full text-left px-4 py-3 hover:bg-gray-50 text-sm text-gray-700 transition">
                                    🚪 Salir
                                </button>
                            </form>
                        </div>
                    </div>
                @else
                    <a href="{{ route('login') }}" class="text-gray-700 hover:bg-gray-100 px-4 py-2 rounded-full transition font-medium text-sm">Entrar</a>
                    <a href="{{ route('register') }}" class="text-white font-semibold px-6 py-2 rounded-full hover:opacity-90 transition text-sm"
                       style="background-color: #6CAA86;">
                        Registrarse
                    </a>
                @endauth
            </div>
        </div>
    </nav>

    <div class="flex min-h-calc relative" style="min-height: calc(100vh - 64px);">
        <!-- Sidebar YouTube Style -->
        @auth
        <aside id="sidebar" class="w-64 md:w-72 p-4 md:p-5 hidden md:block md:relative overflow-y-auto" style="background-color: #f5f5f5; border-right: 1px solid #e0e0e0;">
            <div class="space-y-2">
                <!-- INICIO -->
                <a href="{{ route('videos.index') }}" class="flex items-center gap-4 px-3 py-3 rounded-lg hover:bg-gray-200 transition" style="color: #2d2d2d;">
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"/>
                    </svg>
                    <span class="font-medium text-sm">Inicio</span>
                </a>
                
                <!-- EXPLORAR -->
                <a href="#" class="flex items-center gap-4 px-3 py-3 rounded-lg hover:bg-gray-200 transition" style="color: #2d2d2d;">
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M12.316 3.051a1 1 0 01.633 1.265l-4 12a1 1 0 11-1.898-.632l4-12a1 1 0 011.265-.633zM5.707 6.293a1 1 0 010 1.414L3.414 10l2.293 2.293a1 1 0 11-1.414 1.414l-3-3a1 1 0 010-1.414l3-3a1 1 0 011.414 0zm8.586 0a1 1 0 011.414 0l3 3a1 1 0 010 1.414l-3 3a1 1 0 11-1.414-1.414L16.586 10l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd"/>
                    </svg>
                    <span class="font-medium text-sm">Explorar</span>
                </a>
                
                <!-- SUSCRIPCIONES -->
                <a href="#" class="flex items-center gap-4 px-3 py-3 rounded-lg hover:bg-gray-200 transition" style="color: #2d2d2d;">
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M2 11a1 1 0 011-1h2a1 1 0 011 1v5a1 1 0 01-1 1H3a1 1 0 01-1-1v-5zM8 7a1 1 0 011-1h2a1 1 0 011 1v9a1 1 0 01-1 1H9a1 1 0 01-1-1V7zM14 4a1 1 0 011-1h2a1 1 0 011 1v12a1 1 0 01-1 1h-2a1 1 0 01-1-1V4z"/>
                    </svg>
                    <span class="font-medium text-sm">Suscripciones</span>
                </a>
                
                <!-- DIVIDER -->
                <div style="border-top: 1px solid #e0e0e0; margin: 8px 0;"></div>
                
                <!-- TU ESPACIO -->
                <div class="text-xs font-bold px-3 pt-4 pb-2" style="color: #666;">
                    TU ESPACIO
                </div>
                
                <a href="{{ route('comments.index') }}" class="flex items-center gap-4 px-3 py-3 rounded-lg hover:bg-gray-200 transition" style="color: #2d2d2d;">
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M2 5a2 2 0 012-2h12a2 2 0 012 2v10a2 2 0 01-2 2H4a2 2 0 01-2-2V5z"/>
                    </svg>
                    <span class="font-medium text-sm">Mis comentarios</span>
                </a>
                
                <a href="#" class="flex items-center gap-4 px-3 py-3 rounded-lg hover:bg-gray-200 transition" style="color: #2d2d2d;">
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M5 4a2 2 0 012-2h6a2 2 0 012 2v14l-5-2.5L5 18V4z"/>
                    </svg>
                    <span class="font-medium text-sm">Favoritos</span>
                </a>
                
                <a href="#" class="flex items-center gap-4 px-3 py-3 rounded-lg hover:bg-gray-200 transition" style="color: #2d2d2d;">
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M5 3a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2V5a2 2 0 00-2-2H5zM5 11a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2v-2a2 2 0 00-2-2H5zM11 5a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V5zM13 11a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2v-2a2 2 0 00-2-2h-2z"/>
                    </svg>
                    <span class="font-medium text-sm">Más tarde</span>
                </a>
            </div>
        </aside>
        @endauth

        @guest
        <aside class="w-64 md:w-72 p-4 md:p-5 hidden md:block md:relative overflow-y-auto" style="background-color: #f5f5f5; border-right: 1px solid #e0e0e0;">
            <div class="space-y-2">
                <a href="{{ route('videos.index') }}" class="flex items-center gap-4 px-3 py-3 rounded-lg hover:bg-gray-200 transition" style="color: #2d2d2d;">
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"/>
                    </svg>
                    <span class="font-medium text-sm">Inicio</span>
                </a>
                
                <a href="#" class="flex items-center gap-4 px-3 py-3 rounded-lg hover:bg-gray-200 transition" style="color: #2d2d2d;">
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M12.316 3.051a1 1 0 01.633 1.265l-4 12a1 1 0 11-1.898-.632l4-12a1 1 0 011.265-.633zM5.707 6.293a1 1 0 010 1.414L3.414 10l2.293 2.293a1 1 0 11-1.414 1.414l-3-3a1 1 0 010-1.414l3-3a1 1 0 011.414 0zm8.586 0a1 1 0 011.414 0l3 3a1 1 0 010 1.414l-3 3a1 1 0 11-1.414-1.414L16.586 10l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd"/>
                    </svg>
                    <span class="font-medium text-sm">Explorar</span>
                </a>
                
                <a href="#" class="flex items-center gap-4 px-3 py-3 rounded-lg hover:bg-gray-200 transition" style="color: #2d2d2d;">
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M2 11a1 1 0 011-1h2a1 1 0 011 1v5a1 1 0 01-1 1H3a1 1 0 01-1-1v-5zM8 7a1 1 0 011-1h2a1 1 0 011 1v9a1 1 0 01-1 1H9a1 1 0 01-1-1V7zM14 4a1 1 0 011-1h2a1 1 0 011 1v12a1 1 0 01-1 1h-2a1 1 0 01-1-1V4z"/>
                    </svg>
                    <span class="font-medium text-sm">Suscripciones</span>
                </a>
            </div>
        </aside>
        @endguest

        <!-- Main Content -->
        <main class="flex-1 p-4 md:p-6 overflow-y-auto">
            @yield('content')
        </main>
    </div>

    <footer class="text-center py-6 text-xs md:text-sm border-t border-gray-200" style="color: #999; background-color: #f5f5f5;">
        <div class="max-w-6xl mx-auto px-4 space-y-2">
            <p>&copy; {{ date('Y') }} Pooptube — Una plataforma para compartir tu poop</p>
            <p style="color: #bbb;">Creado con 💚</p>
        </div>
    </footer>

    <script>
        // Sidebar Toggle
        document.getElementById('menu-toggle')?.addEventListener('click', () => {
            document.getElementById('sidebar').classList.toggle('active');
        });
        
        // User Menu Dropdown
        const userBtn = document.getElementById('user-menu-btn');
        const userDropdown = document.getElementById('user-dropdown');
        
        if (userBtn && userDropdown) {
            userBtn.addEventListener('click', (e) => {
                e.stopPropagation();
                userDropdown.classList.toggle('hidden');
            });
            
            document.addEventListener('click', (e) => {
                if (!userBtn.contains(e.target) && !userDropdown.contains(e.target)) {
                    userDropdown.classList.add('hidden');
                }
            });
        }
        
        // Close sidebar on outside click
        document.addEventListener('click', (e) => {
            const sidebar = document.getElementById('sidebar');
            const menuToggle = document.getElementById('menu-toggle');
            if (sidebar && window.innerWidth < 768 && !sidebar.contains(e.target) && !menuToggle.contains(e.target)) {
                sidebar.classList.remove('active');
            }
        });
    </script>

</body>
</html>