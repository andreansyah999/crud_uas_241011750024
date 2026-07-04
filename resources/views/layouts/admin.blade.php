<!DOCTYPE html>
<html lang="id" class="h-full bg-gray-50/50">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin Dashboard') - Eventure Admin</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- jQuery and DataTables CDN (Required) -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.8/css/jquery.dataTables.min.css">
    <script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>

    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
        .btn-gradient {
            background: linear-gradient(135deg, #6366f1 0%, #06b6d4 100%);
        }
        .btn-gradient:hover {
            background: linear-gradient(135deg, #4f46e5 0%, #0891b2 100%);
        }
        /* Custom overrides for DataTables to match our Tailwind layout */
        .dataTables_wrapper .dataTables_length select {
            border: 1px solid rgba(0,0,0,0.1) !important;
            border-radius: 8px !important;
            padding: 4px 24px 4px 8px !important;
            background-color: white !important;
        }
        .dataTables_wrapper .dataTables_filter input {
            border: 1px solid rgba(0,0,0,0.1) !important;
            border-radius: 8px !important;
            padding: 6px 12px !important;
            margin-left: 8px !important;
            background-color: white !important;
        }
        .dataTables_wrapper .dataTables_paginate .paginate_button {
            border-radius: 8px !important;
            border: none !important;
            background: transparent !important;
            color: #4b5563 !important;
            font-weight: 500 !important;
        }
        .dataTables_wrapper .dataTables_paginate .paginate_button.current, 
        .dataTables_wrapper .dataTables_paginate .paginate_button.current:hover {
            background: #4f46e5 !important;
            color: white !important;
            border: none !important;
        }
        .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
            background: #e0e7ff !important;
            color: #4f46e5 !important;
            border: none !important;
        }
        table.dataTable {
            border-collapse: collapse !important;
            width: 100% !important;
        }
        table.dataTable border-bottom {
            border-bottom: 1px solid #f3f4f6 !important;
        }
        table.dataTable thead th {
            background-color: #f8fafc !important;
            color: #475569 !important;
            font-weight: 600 !important;
            border-bottom: 2px solid #e2e8f0 !important;
            padding: 12px 16px !important;
        }
        table.dataTable tbody td {
            padding: 12px 16px !important;
            border-bottom: 1px solid #f1f5f9 !important;
        }
    </style>
</head>
<body class="h-full bg-gray-50/50">

<div x-data="{ sidebarOpen: false }" class="min-h-full">
    <!-- Mobile Sidebar Backdrop -->
    <div x-show="sidebarOpen" @click="sidebarOpen = false" class="fixed inset-0 z-40 bg-gray-900/40 backdrop-blur-sm lg:hidden" x-transition:enter="transition-opacity ease-linear duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition-opacity ease-linear duration-300" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"></div>

    <!-- Mobile Sidebar Drawer -->
    <div x-show="sidebarOpen" class="fixed inset-y-0 left-0 z-50 w-72 bg-gray-900 text-white flex flex-col lg:hidden" x-transition:enter="transition ease-in-out duration-300 transform" x-transition:enter-start="-translate-x-full" x-transition:enter-end="translate-x-0" x-transition:leave="transition ease-in-out duration-300 transform" x-transition:leave-start="translate-x-0" x-transition:leave-end="-translate-x-full">
        <!-- Sidebar Header -->
        <div class="h-16 flex items-center justify-between px-6 border-b border-gray-800">
            <div class="flex items-center gap-2">
                <div class="w-8 h-8 rounded-lg btn-gradient flex items-center justify-center text-white">
                    <i class="fa-solid fa-calendar-days text-sm"></i>
                </div>
                <span class="text-lg font-bold text-white tracking-tight">Event<span class="text-indigo-400">ure.</span></span>
            </div>
            <button @click="sidebarOpen = false" class="text-gray-400 hover:text-white">
                <i class="fa-solid fa-xmark text-lg"></i>
            </button>
        </div>
        
        <!-- Sidebar Navigation -->
        <nav class="flex-1 px-4 py-4 space-y-1">
            <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-semibold {{ Route::is('admin.dashboard') ? 'bg-indigo-600 text-white shadow-md shadow-indigo-800/40' : 'text-gray-400 hover:bg-gray-800 hover:text-white' }} transition-all duration-200">
                <i class="fa-solid fa-chart-pie text-base"></i> Dashboard
            </a>
            <a href="{{ route('admin.agenda.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-semibold {{ Route::is('admin.agenda.*') ? 'bg-indigo-600 text-white shadow-md shadow-indigo-800/40' : 'text-gray-400 hover:bg-gray-800 hover:text-white' }} transition-all duration-200">
                <i class="fa-solid fa-clipboard-list text-base"></i> Agenda Kegiatan
            </a>
            <a href="{{ route('admin.pages.edit') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-semibold {{ Route::is('admin.pages.edit') ? 'bg-indigo-600 text-white shadow-md shadow-indigo-800/40' : 'text-gray-400 hover:bg-gray-800 hover:text-white' }} transition-all duration-200">
                <i class="fa-solid fa-file-pen text-base"></i> Kelola Halaman
            </a>
            <div class="pt-4 border-t border-gray-800 mt-4 space-y-1">
                <a href="{{ route('home') }}" target="_blank" class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-semibold text-gray-400 hover:bg-gray-800 hover:text-white transition-all duration-200">
                    <i class="fa-solid fa-globe text-base"></i> Lihat Situs Utama
                </a>
                <form action="{{ route('logout') }}" method="POST" class="block w-full">
                    @csrf
                    <button type="submit" class="flex items-center gap-3 w-full px-4 py-3 rounded-xl text-sm font-semibold text-rose-400 hover:bg-rose-950/20 hover:text-rose-300 transition-all duration-200 text-left">
                        <i class="fa-solid fa-right-from-bracket text-base"></i> Log Out
                    </button>
                </form>
            </div>
        </nav>
    </div>

    <!-- Desktop Sidebar -->
    <div class="hidden lg:fixed lg:inset-y-0 lg:left-0 lg:z-30 lg:w-64 lg:bg-gray-900 lg:flex lg:flex-col border-r border-gray-800">
        <!-- Sidebar Header -->
        <div class="h-16 flex items-center px-6 border-b border-gray-800 bg-gray-950">
            <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-2">
                <div class="w-9 h-9 rounded-xl btn-gradient flex items-center justify-center text-white shadow-md shadow-indigo-500/20">
                    <i class="fa-solid fa-calendar-days"></i>
                </div>
                <span class="text-lg font-extrabold text-white tracking-tight">Event<span class="text-indigo-400">ure.</span></span>
            </a>
        </div>

        <!-- Sidebar Navigation -->
        <nav class="flex-1 px-4 py-6 space-y-1">
            <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-semibold {{ Route::is('admin.dashboard') ? 'bg-indigo-600 text-white shadow-md shadow-indigo-900/30' : 'text-gray-400 hover:bg-gray-800/50 hover:text-white' }} transition-all duration-150">
                <i class="fa-solid fa-chart-pie text-base"></i> Dashboard
            </a>
            <a href="{{ route('admin.agenda.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-semibold {{ Route::is('admin.agenda.*') ? 'bg-indigo-600 text-white shadow-md shadow-indigo-900/30' : 'text-gray-400 hover:bg-gray-800/50 hover:text-white' }} transition-all duration-150">
                <i class="fa-solid fa-clipboard-list text-base"></i> Agenda Kegiatan
            </a>
            <a href="{{ route('admin.pages.edit') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-semibold {{ Route::is('admin.pages.edit') ? 'bg-indigo-600 text-white shadow-md shadow-indigo-900/30' : 'text-gray-400 hover:bg-gray-800/50 hover:text-white' }} transition-all duration-150">
                <i class="fa-solid fa-file-pen text-base"></i> Kelola Halaman
            </a>
            <div class="pt-6 border-t border-gray-850 mt-6 space-y-1">
                <a href="{{ route('home') }}" target="_blank" class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-semibold text-gray-400 hover:bg-gray-800/50 hover:text-white transition-all duration-150">
                    <i class="fa-solid fa-globe text-base"></i> Lihat Situs Utama
                </a>
                <form action="{{ route('logout') }}" method="POST" class="block w-full">
                    @csrf
                    <button type="submit" class="flex items-center gap-3 w-full px-4 py-3 rounded-xl text-sm font-semibold text-rose-400 hover:bg-rose-950/20 hover:text-rose-300 transition-all duration-150 text-left cursor-pointer">
                        <i class="fa-solid fa-right-from-bracket text-base"></i> Log Out
                    </button>
                </form>
            </div>
        </nav>
    </div>

    <!-- Main Content Wrapper -->
    <div class="lg:pl-64 flex flex-col flex-1">
        <!-- Top Navigation Bar -->
        <header class="h-16 border-b border-gray-200/80 bg-white flex items-center justify-between px-6 sticky top-0 z-20">
            <!-- Sidebar Toggle (Mobile) -->
            <button @click="sidebarOpen = true" class="text-gray-500 hover:text-gray-700 lg:hidden">
                <i class="fa-solid fa-bars text-xl"></i>
            </button>
            
            <div class="hidden lg:block text-sm font-medium text-gray-500">
                Eventure Admin Panel &bull; Dashboard Pengelolaan Agenda
            </div>

            <!-- Profile Dropdown -->
            <div x-data="{ profileOpen: false }" class="relative">
                <button @click="profileOpen = !profileOpen" class="flex items-center gap-2 p-1.5 hover:bg-gray-150 rounded-xl transition-colors duration-150">
                    <div class="w-8 h-8 rounded-lg btn-gradient flex items-center justify-center text-white text-xs font-bold uppercase shadow-sm">
                        {{ substr(Auth::user()->username, 0, 2) }}
                    </div>
                    <span class="hidden md:inline text-sm font-semibold text-gray-700">{{ Auth::user()->name ?: Auth::user()->username }}</span>
                    <i class="fa-solid fa-chevron-down text-xs text-gray-400 transition-transform duration-200" :class="profileOpen ? 'rotate-180' : ''"></i>
                </button>
                
                <div x-show="profileOpen" @click.away="profileOpen = false" class="absolute right-0 mt-2 w-48 bg-white border border-gray-100 rounded-2xl shadow-xl py-1 z-30" x-transition:enter="transition ease-out duration-100" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100" x-transition:leave="transition ease-in duration-75" x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95">
                    <div class="px-4 py-2 border-b border-gray-50 text-xs text-gray-400">
                        Masuk sebagai: <strong>{{ Auth::user()->username }}</strong>
                    </div>
                    <a href="{{ route('home') }}" class="flex items-center gap-2 px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 transition-colors duration-150"><i class="fa-solid fa-globe text-gray-400 text-xs"></i> Situs Utama</a>
                    <form action="{{ route('logout') }}" method="POST" class="block w-full">
                        @csrf
                        <button type="submit" class="flex items-center gap-2 w-full px-4 py-2 text-sm text-rose-500 hover:bg-rose-50 hover:text-rose-600 transition-colors duration-150 text-left"><i class="fa-solid fa-right-from-bracket text-xs"></i> Keluar</button>
                    </form>
                </div>
            </div>
        </header>

        <!-- Main Body -->
        <main class="flex-1 py-8 px-6 lg:px-8">
            <!-- Toast notification in admin panel -->
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
                 class="mb-6 flex items-center p-4 text-gray-500 bg-white rounded-2xl shadow-md border border-gray-100 max-w-md" role="alert">
                
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

            @yield('content')
        </main>
    </div>
</div>

</body>
</html>
