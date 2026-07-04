<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Eventure') - Portal Agenda Kegiatan</title>
    
    <!-- Google Fonts: Plus Jakarta Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Alpine.js (for simple micro-interactions) -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
        .glass-nav {
            background: rgba(255, 255, 255, 0.75);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
        }
        .text-gradient {
            background: linear-gradient(135deg, #6366f1 0%, #14b8a6 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        .btn-gradient {
            background: linear-gradient(135deg, #6366f1 0%, #06b6d4 100%);
        }
        .btn-gradient:hover {
            background: linear-gradient(135deg, #4f46e5 0%, #0891b2 100%);
        }
    </style>
</head>
<body class="bg-gray-50/50 text-gray-800 min-h-screen flex flex-col antialiased">

    <!-- Toast Notification -->
    @if(session('success') || session('error'))
    <div x-data="{ show: true }" 
         x-init="setTimeout(() => show = false, 5000)" 
         x-show="show"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 translate-y-2"
         x-transition:enter-end="opacity-100 translate-y-0"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100 translate-y-0"
         x-transition:leave-end="opacity-0 translate-y-2"
         class="fixed bottom-5 right-5 z-50 flex items-center p-4 w-full max-w-xs text-gray-500 bg-white rounded-2xl shadow-xl border border-gray-100" role="alert">
        
        @if(session('success'))
            <div class="inline-flex flex-shrink-0 justify-center items-center w-8 h-8 text-teal-500 bg-teal-50 rounded-lg">
                <i class="fa-solid fa-check"></i>
            </div>
            <div class="ms-3 text-sm font-normal">{{ session('success') }}</div>
        @else
            <div class="inline-flex flex-shrink-0 justify-center items-center w-8 h-8 text-red-500 bg-red-50 rounded-lg">
                <i class="fa-solid fa-triangle-exclamation"></i>
            </div>
            <div class="ms-3 text-sm font-normal">{{ session('error') }}</div>
        @endif
        <button type="button" @click="show = false" class="ms-auto -mx-1.5 -my-1.5 bg-white text-gray-400 hover:text-gray-950 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex items-center justify-center h-8 w-8">
            <span class="sr-only">Close</span>
            <i class="fa-solid fa-xmark"></i>
        </button>
    </div>
    @endif

    <!-- Navigation Header -->
    <header class="glass-nav sticky top-0 z-40 w-full border-b border-gray-100/80 transition-all duration-300" x-data="{ mobileMenuOpen: false }">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                <!-- Logo -->
                <div class="flex-shrink-0 flex items-center">
                    <a href="{{ route('home') }}" class="flex items-center gap-2">
                        <div class="w-10 h-10 rounded-xl btn-gradient flex items-center justify-center text-white shadow-md shadow-indigo-200">
                            <i class="fa-solid fa-calendar-days text-lg"></i>
                        </div>
                        <span class="text-xl font-extrabold tracking-tight text-gray-900">Event<span class="text-indigo-600">ure.</span></span>
                    </a>
                </div>
                
                <!-- Desktop Nav -->
                <nav class="hidden md:flex space-x-8">
                    <a href="{{ route('home') }}" class="inline-flex items-center px-1 pt-1 border-b-2 {{ Route::is('home') ? 'border-indigo-600 text-gray-900 font-semibold' : 'border-transparent text-gray-500 hover:text-gray-900 hover:border-gray-300' }} text-sm font-medium transition-all duration-200">
                        Beranda
                    </a>
                    <a href="{{ route('public.agendas') }}" class="inline-flex items-center px-1 pt-1 border-b-2 {{ Route::is('public.agendas') || Route::is('public.agenda.detail') ? 'border-indigo-600 text-gray-900 font-semibold' : 'border-transparent text-gray-500 hover:text-gray-900 hover:border-gray-300' }} text-sm font-medium transition-all duration-200">
                        Agenda
                    </a>
                    <a href="{{ route('public.about') }}" class="inline-flex items-center px-1 pt-1 border-b-2 {{ Route::is('public.about') ? 'border-indigo-600 text-gray-900 font-semibold' : 'border-transparent text-gray-500 hover:text-gray-900 hover:border-gray-300' }} text-sm font-medium transition-all duration-200">
                        Tentang Kami
                    </a>
                    <a href="{{ route('public.contact') }}" class="inline-flex items-center px-1 pt-1 border-b-2 {{ Route::is('public.contact') ? 'border-indigo-600 text-gray-900 font-semibold' : 'border-transparent text-gray-500 hover:text-gray-900 hover:border-gray-300' }} text-sm font-medium transition-all duration-200">
                        Kontak
                    </a>
                </nav>

                <!-- Right Action Button -->
                <div class="hidden md:flex items-center">
                    @auth
                        <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center gap-2 px-5 py-2.5 text-sm font-semibold text-white btn-gradient rounded-xl shadow-lg shadow-indigo-100 hover:shadow-indigo-200 hover:-translate-y-0.5 active:translate-y-0 transition-all duration-250">
                            <i class="fa-solid fa-chart-line"></i> Dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="inline-flex items-center gap-2 px-5 py-2.5 text-sm font-semibold text-indigo-600 bg-indigo-50/50 hover:bg-indigo-100/50 rounded-xl transition-all duration-200">
                            <i class="fa-solid fa-right-to-bracket"></i> Login Admin
                        </a>
                    @endauth
                </div>

                <!-- Mobile Menu Button -->
                <div class="flex items-center md:hidden">
                    <button @click="mobileMenuOpen = !mobileMenuOpen" type="button" class="inline-flex items-center justify-center p-2 rounded-xl text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none" aria-controls="mobile-menu" aria-expanded="false">
                        <span class="sr-only">Open main menu</span>
                        <i class="fa-solid" :class="mobileMenuOpen ? 'fa-xmark text-xl' : 'fa-bars text-xl'"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div class="md:hidden" id="mobile-menu" x-show="mobileMenuOpen" x-collapse>
            <div class="px-2 pt-2 pb-3 space-y-1 border-t border-gray-100 bg-white">
                <a href="{{ route('home') }}" class="block px-3 py-2.5 rounded-xl text-base font-semibold {{ Route::is('home') ? 'bg-indigo-50 text-indigo-600' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                    Beranda
                </a>
                <a href="{{ route('public.agendas') }}" class="block px-3 py-2.5 rounded-xl text-base font-semibold {{ Route::is('public.agendas') || Route::is('public.agenda.detail') ? 'bg-indigo-50 text-indigo-600' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                    Agenda
                </a>
                <a href="{{ route('public.about') }}" class="block px-3 py-2.5 rounded-xl text-base font-semibold {{ Route::is('public.about') ? 'bg-indigo-50 text-indigo-600' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                    Tentang Kami
                </a>
                <a href="{{ route('public.contact') }}" class="block px-3 py-2.5 rounded-xl text-base font-semibold {{ Route::is('public.contact') ? 'bg-indigo-50 text-indigo-600' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                    Kontak
                </a>
                <div class="pt-4 pb-2 border-t border-gray-100 mt-2">
                    @auth
                        <a href="{{ route('admin.dashboard') }}" class="flex items-center justify-center gap-2 w-full px-4 py-2.5 text-base font-semibold text-white btn-gradient rounded-xl shadow-lg">
                            <i class="fa-solid fa-chart-line"></i> Dashboard Admin
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="flex items-center justify-center gap-2 w-full px-4 py-2.5 text-base font-semibold text-indigo-600 bg-indigo-50/50 hover:bg-indigo-100/50 rounded-xl">
                            <i class="fa-solid fa-right-to-bracket"></i> Login Admin
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="flex-grow">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-gray-900 text-gray-400 py-12 border-t border-gray-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <!-- Info Section -->
                <div class="space-y-4 md:col-span-2">
                    <div class="flex items-center gap-2">
                        <div class="w-8 h-8 rounded-lg btn-gradient flex items-center justify-center text-white">
                            <i class="fa-solid fa-calendar-days"></i>
                        </div>
                        <span class="text-lg font-bold text-white tracking-tight">Event<span class="text-indigo-400">ure.</span></span>
                    </div>
                    <p class="text-sm leading-relaxed max-w-sm">
                        Eventure adalah platform pengelolaan agenda kegiatan terpercaya. Cari dan temukan berbagai agenda kegiatan menarik di sekitar Anda secara informatif dan interaktif.
                    </p>
                </div>
                
                <!-- Quick Links -->
                <div>
                    <h3 class="text-white text-sm font-semibold uppercase tracking-wider mb-4">Navigasi</h3>
                    <ul class="space-y-2 text-sm">
                        <li><a href="{{ route('home') }}" class="hover:text-white transition-colors duration-150">Beranda</a></li>
                        <li><a href="{{ route('public.agendas') }}" class="hover:text-white transition-colors duration-150">Agenda</a></li>
                        <li><a href="{{ route('public.about') }}" class="hover:text-white transition-colors duration-150">Tentang Kami</a></li>
                        <li><a href="{{ route('public.contact') }}" class="hover:text-white transition-colors duration-150">Kontak</a></li>
                    </ul>
                </div>

                <!-- Admin Link -->
                <div>
                    <h3 class="text-white text-sm font-semibold uppercase tracking-wider mb-4">Hubungi Kami</h3>
                    <ul class="space-y-2 text-sm text-gray-400">
                        <li><i class="fa-solid fa-envelope mr-2 text-xs"></i> info@agenda.id</li>
                        <li><i class="fa-solid fa-phone mr-2 text-xs"></i> +62 21 8765 4321</li>
                        <li><i class="fa-solid fa-map-marker-alt mr-2 text-xs"></i> Tangerang Selatan, Banten</li>
                    </ul>
                </div>
            </div>
            
            <div class="mt-8 pt-8 border-t border-gray-800 text-center text-xs text-gray-500">
                <p>&copy; {{ date('Y') }} Eventure - UAS Web Programming. Hak Cipta Dilindungi.</p>
            </div>
        </div>
    </footer>

</body>
</html>
