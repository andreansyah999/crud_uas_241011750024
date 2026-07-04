@extends('layouts.admin')

@section('title', 'Admin Dashboard')

@section('content')
<div class="space-y-8 animate-fade-in">
    <!-- Welcome Header -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h1 class="text-3xl font-extrabold text-gray-900 tracking-tight">Dashboard Utama</h1>
            <p class="text-gray-500 mt-1">Pantau statistik portal agenda dan kelola seluruh konten dengan cepat.</p>
        </div>
        <div class="flex gap-3">
            <a href="{{ route('admin.agenda.create') }}" class="inline-flex items-center gap-2 px-4 py-2.5 text-sm font-semibold text-white btn-gradient rounded-xl shadow-md hover:-translate-y-0.5 active:translate-y-0 transition-all duration-150">
                <i class="fa-solid fa-plus text-xs"></i> Tambah Agenda
            </a>
            <a href="{{ route('admin.agenda.pdf') }}" target="_blank" class="inline-flex items-center gap-2 px-4 py-2.5 text-sm font-semibold text-indigo-650 bg-indigo-55 bg-indigo-50 hover:bg-indigo-100 rounded-xl transition-colors duration-150">
                <i class="fa-solid fa-file-pdf"></i> Ekspor Laporan PDF
            </a>
        </div>
    </div>

    <!-- Statistics Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- Stat Card 1 -->
        <div class="bg-white rounded-3xl p-6 border border-gray-100 shadow-sm flex items-center justify-between">
            <div class="space-y-2">
                <span class="block text-xs font-bold text-gray-400 uppercase tracking-wider">Total Agenda</span>
                <span class="block text-2xl font-extrabold text-gray-900">{{ $stats['total_agenda'] }}</span>
            </div>
            <div class="w-12 h-12 rounded-2xl bg-indigo-50 text-indigo-600 flex items-center justify-center text-xl">
                <i class="fa-solid fa-calendar-days"></i>
            </div>
        </div>

        <!-- Stat Card 2 -->
        <div class="bg-white rounded-3xl p-6 border border-gray-100 shadow-sm flex items-center justify-between">
            <div class="space-y-2">
                <span class="block text-xs font-bold text-gray-400 uppercase tracking-wider">Agenda Mendatang</span>
                <span class="block text-2xl font-extrabold text-gray-900">{{ $stats['agenda_mendatang'] }}</span>
            </div>
            <div class="w-12 h-12 rounded-2xl bg-teal-50 text-teal-650 flex items-center justify-center text-xl">
                <i class="fa-solid fa-circle-check"></i>
            </div>
        </div>

        <!-- Stat Card 3 -->
        <div class="bg-white rounded-3xl p-6 border border-gray-100 shadow-sm flex items-center justify-between">
            <div class="space-y-2">
                <span class="block text-xs font-bold text-gray-400 uppercase tracking-wider">Penyelenggara</span>
                <span class="block text-2xl font-extrabold text-gray-900">{{ $stats['total_penyelenggara'] }}</span>
            </div>
            <div class="w-12 h-12 rounded-2xl bg-amber-50 text-amber-600 flex items-center justify-center text-xl">
                <i class="fa-solid fa-users"></i>
            </div>
        </div>

        <!-- Stat Card 4 -->
        <div class="bg-white rounded-3xl p-6 border border-gray-100 shadow-sm flex items-center justify-between">
            <div class="space-y-2">
                <span class="block text-xs font-bold text-gray-400 uppercase tracking-wider">Admin Terdaftar</span>
                <span class="block text-2xl font-extrabold text-gray-900">{{ $stats['total_admin'] }}</span>
            </div>
            <div class="w-12 h-12 rounded-2xl bg-rose-50 text-rose-600 flex items-center justify-center text-xl">
                <i class="fa-solid fa-user-shield"></i>
            </div>
        </div>
    </div>

    <!-- Quick Navigation & Recent Activities -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Recent Activities list (Left Col) -->
        <div class="lg:col-span-2 bg-white rounded-3xl border border-gray-150/80 shadow-sm overflow-hidden flex flex-col justify-between">
            <div>
                <div class="px-6 py-5 border-b border-gray-100 flex items-center justify-between">
                    <h3 class="font-bold text-gray-900 text-base"><i class="fa-solid fa-clock-rotate-left mr-2 text-indigo-500"></i> Agenda Terbaru Ditambahkan</h3>
                    <a href="{{ route('admin.agenda.index') }}" class="text-xs font-bold text-indigo-600 hover:text-indigo-700">Lihat Semua</a>
                </div>
                <div class="divide-y divide-gray-55 divide-gray-100">
                    @forelse($recentAgendas as $agenda)
                        <div class="px-6 py-4 flex items-center justify-between hover:bg-gray-50/50 transition-colors duration-150">
                            <div class="flex items-center gap-4">
                                <div class="w-12 h-12 rounded-xl bg-gray-100 overflow-hidden flex-shrink-0 flex items-center justify-center text-gray-450 border border-gray-200">
                                    @if($agenda->gambar)
                                        <img src="{{ asset($agenda->gambar) }}" alt="" class="w-full h-full object-cover">
                                    @else
                                        <i class="fa-regular fa-image text-lg text-indigo-300"></i>
                                    @endif
                                </div>
                                <div>
                                    <h4 class="font-bold text-sm text-gray-800 leading-snug">{{ Str::limit($agenda->nama_kegiatan, 40) }}</h4>
                                    <span class="text-xs text-gray-400 block mt-0.5">
                                        <i class="fa-solid fa-calendar text-[10px] mr-1"></i> {{ \Carbon\Carbon::parse($agenda->tanggal_kegiatan)->translatedFormat('d M Y') }}
                                        &bull; <i class="fa-solid fa-users text-[10px] mx-1"></i> {{ $agenda->penyelenggara }}
                                    </span>
                                </div>
                            </div>
                            <div class="flex gap-2">
                                <a href="{{ route('admin.agenda.edit', $agenda->id) }}" class="p-1.5 hover:bg-indigo-50 text-indigo-600 rounded-lg transition-colors duration-150" title="Edit"><i class="fa-solid fa-pen text-xs"></i></a>
                            </div>
                        </div>
                    @empty
                        <div class="p-12 text-center text-gray-450">
                            <i class="fa-solid fa-inbox text-3xl mb-2 text-gray-300"></i>
                            <p class="text-sm">Belum ada agenda kegiatan.</p>
                        </div>
                    @endforelse
                </div>
            </div>
            <div class="bg-gray-50 px-6 py-4 border-t border-gray-100 text-xs text-gray-450 flex items-center gap-1">
                <i class="fa-solid fa-circle-info text-indigo-500"></i> Data disinkronkan langsung dari basis data.
            </div>
        </div>

        <!-- Quick Access Widgets (Right Col) -->
        <div class="space-y-6">
            <div class="bg-white rounded-3xl p-6 border border-gray-150/80 shadow-sm space-y-4">
                <h3 class="font-bold text-gray-900 text-base">Akses Cepat</h3>
                <div class="space-y-2">
                    <a href="{{ route('admin.agenda.create') }}" class="flex items-center justify-between p-3 rounded-xl border border-gray-100 hover:border-indigo-150 hover:bg-indigo-50/20 text-gray-700 hover:text-indigo-700 font-semibold text-sm transition-all duration-150 group">
                        <span><i class="fa-solid fa-circle-plus text-indigo-500 mr-2"></i> Tambah Agenda Baru</span>
                        <i class="fa-solid fa-chevron-right text-xs text-gray-400 group-hover:translate-x-1 transition-transform"></i>
                    </a>
                    <a href="{{ route('admin.pages.edit') }}" class="flex items-center justify-between p-3 rounded-xl border border-gray-100 hover:border-indigo-150 hover:bg-indigo-50/20 text-gray-700 hover:text-indigo-700 font-semibold text-sm transition-all duration-150 group">
                        <span><i class="fa-solid fa-file-pen text-indigo-500 mr-2"></i> Ubah Tentang & Kontak</span>
                        <i class="fa-solid fa-chevron-right text-xs text-gray-400 group-hover:translate-x-1 transition-transform"></i>
                    </a>
                    <a href="{{ route('home') }}" target="_blank" class="flex items-center justify-between p-3 rounded-xl border border-gray-100 hover:border-indigo-150 hover:bg-indigo-50/20 text-gray-700 hover:text-indigo-700 font-semibold text-sm transition-all duration-150 group">
                        <span><i class="fa-solid fa-globe text-indigo-500 mr-2"></i> Lihat Halaman Depan</span>
                        <i class="fa-solid fa-chevron-right text-xs text-gray-400 group-hover:translate-x-1 transition-transform"></i>
                    </a>
                </div>
            </div>
            
            <!-- Quick System Info -->
            <div class="bg-gradient-to-tr from-indigo-900 to-indigo-950 rounded-3xl p-6 text-white space-y-3 shadow-lg">
                <span class="inline-flex px-2 py-0.5 rounded text-[10px] font-bold bg-indigo-500/30 text-indigo-300 border border-indigo-500/20">INFO APLIKASI</span>
                <h4 class="font-extrabold text-base leading-snug">UAS Pemrograman Web Laravel 12 App</h4>
                <div class="text-xs text-indigo-200/80 leading-relaxed space-y-1.5">
                    <p><strong>Nama Kategori:</strong> Data Agenda Kegiatan</p>
                    <p><strong>NIM / Nama:</strong> 241011750024 / UAS</p>
                    <p><strong>Status:</strong> Terkoneksi (MySQL)</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
