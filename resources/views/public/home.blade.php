@extends('layouts.public')

@section('title', 'Beranda')

@section('content')
<!-- Hero Section -->
<section class="relative bg-slate-950 py-20 lg:py-32 overflow-hidden text-white">
    <!-- Decorative Glow Elements -->
    <div class="absolute top-0 left-1/4 w-96 h-96 bg-indigo-500/10 rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute bottom-0 right-1/4 w-96 h-96 bg-teal-500/10 rounded-full blur-3xl pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
            <!-- Left Info -->
            <div class="lg:col-span-7 space-y-6 text-center lg:text-left">
                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-indigo-500/10 text-indigo-400 border border-indigo-500/20">
                    <i class="fa-solid fa-sparkles"></i> Portal Agenda Kegiatan Terlengkap
                </span>
                <h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold tracking-tight leading-tight">
                    Temukan dan Kelola <span class="text-gradient">Kegiatan</span> Terbaik Anda
                </h1>
                <p class="text-slate-400 text-lg max-w-xl mx-auto lg:mx-0">
                    Eventure mempermudah pencarian seminar, workshop, festival, dan berbagai kegiatan menarik di sekitar Anda dengan informasi yang lengkap, akurat, dan transparan.
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center lg:justify-start">
                    <a href="{{ route('public.agendas') }}" class="inline-flex justify-center items-center gap-2 px-6 py-3.5 text-base font-bold text-white btn-gradient rounded-2xl shadow-lg shadow-indigo-500/25 hover:shadow-indigo-500/40 hover:-translate-y-0.5 active:translate-y-0 transition-all duration-200">
                        Jelajahi Agenda <i class="fa-solid fa-arrow-right text-sm"></i>
                    </a>
                    <a href="{{ route('public.about') }}" class="inline-flex justify-center items-center gap-2 px-6 py-3.5 text-base font-semibold text-slate-300 bg-white/5 hover:bg-white/10 rounded-2xl border border-white/10 transition-colors duration-150">
                        Tentang Kami
                    </a>
                </div>
            </div>
            
            <!-- Right Mockup / Image Placeholder -->
            <div class="lg:col-span-5 flex justify-center">
                <div class="relative w-full max-w-md aspect-square bg-gradient-to-tr from-indigo-500/30 to-teal-500/20 rounded-3xl p-1 shadow-2xl border border-white/10">
                    <div class="w-full h-full bg-slate-900 rounded-[22px] overflow-hidden flex flex-col items-center justify-center p-6 text-center space-y-6">
                        <div class="w-20 h-20 rounded-full bg-indigo-500/10 flex items-center justify-center text-indigo-400 shadow-inner">
                            <i class="fa-solid fa-calendar-check text-4xl"></i>
                        </div>
                        <div class="space-y-2">
                            <h3 class="text-xl font-bold text-white">Event Teratur, Kegiatan Lancar</h3>
                            <p class="text-xs text-slate-400 max-w-xs leading-relaxed">
                                Kelola seluruh data agenda acara secara real-time dan terstruktur melalui panel administrasi yang responsif.
                            </p>
                        </div>
                        <div class="flex items-center gap-4 text-xs font-semibold text-slate-300">
                            <span><i class="fa-solid fa-circle-check text-teal-400 mr-1"></i> Responsif</span>
                            <span>&bull;</span>
                            <span><i class="fa-solid fa-circle-check text-teal-400 mr-1"></i> Terorganisir</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Stats Section -->
<section class="relative z-10 -mt-10 max-w-5xl mx-auto px-4">
    <div class="bg-white rounded-3xl p-6 sm:p-8 shadow-xl border border-gray-100 grid grid-cols-1 sm:grid-cols-3 gap-6 text-center divide-y sm:divide-y-0 sm:divide-x divide-gray-100">
        <div class="py-4 sm:py-0">
            <span class="block text-3xl sm:text-4xl font-extrabold text-indigo-600 mb-1">{{ $stats['total_agenda'] }}</span>
            <span class="text-sm font-semibold text-gray-500 uppercase tracking-wider">Total Agenda</span>
        </div>
        <div class="py-4 sm:py-0">
            <span class="block text-3xl sm:text-4xl font-extrabold text-indigo-600 mb-1">{{ $stats['total_penyelenggara'] }}</span>
            <span class="text-sm font-semibold text-gray-500 uppercase tracking-wider">Penyelenggara</span>
        </div>
        <div class="py-4 sm:py-0">
            <span class="block text-3xl sm:text-4xl font-extrabold text-indigo-600 mb-1">{{ $stats['total_lokasi'] }}</span>
            <span class="text-sm font-semibold text-gray-500 uppercase tracking-wider">Lokasi Berbeda</span>
        </div>
    </div>
</section>

<!-- Featured Agenda -->
<section class="py-20 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex flex-col md:flex-row md:items-end justify-between mb-12">
        <div class="space-y-2">
            <span class="text-indigo-600 text-sm font-bold uppercase tracking-wider">Highlight</span>
            <h2 class="text-3xl font-extrabold text-gray-900 tracking-tight">Agenda Kegiatan Terbaru</h2>
            <p class="text-gray-500">Berikut adalah agenda kegiatan terdekat yang dapat Anda ikuti.</p>
        </div>
        <a href="{{ route('public.agendas') }}" class="mt-4 md:mt-0 inline-flex items-center gap-1.5 text-indigo-600 hover:text-indigo-700 font-bold transition-all duration-150 group">
            Lihat Semua Agenda <i class="fa-solid fa-arrow-right group-hover:translate-x-1 transition-transform"></i>
        </a>
    </div>

    <!-- Agenda Grid -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        @forelse($agendas as $agenda)
            <div class="bg-white rounded-3xl overflow-hidden border border-gray-100 shadow-lg hover:shadow-xl hover:-translate-y-1 transition-all duration-350 flex flex-col group">
                <!-- Card Image -->
                <div class="relative aspect-[16/10] bg-indigo-50/50 overflow-hidden flex-shrink-0">
                    @if($agenda->gambar)
                        <img src="{{ asset($agenda->gambar) }}" alt="{{ $agenda->nama_kegiatan }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    @else
                        <div class="w-full h-full flex flex-col items-center justify-center text-indigo-300">
                            <i class="fa-regular fa-image text-4xl mb-2"></i>
                            <span class="text-xs font-semibold uppercase tracking-wider text-indigo-400/70">Gambar Belum Tersedia</span>
                        </div>
                    @endif
                    <div class="absolute top-4 left-4">
                        <span class="inline-flex px-3 py-1.5 text-xs font-bold text-indigo-600 bg-white rounded-xl shadow-sm border border-indigo-50">
                            <i class="fa-solid fa-calendar mr-1.5 text-indigo-500"></i>{{ \Carbon\Carbon::parse($agenda->tanggal_kegiatan)->translatedFormat('d M Y') }}
                        </span>
                    </div>
                </div>

                <!-- Card Body -->
                <div class="p-6 flex-grow flex flex-col justify-between">
                    <div class="space-y-3">
                        <span class="text-xs font-bold text-teal-600 uppercase tracking-widest">{{ $agenda->penyelenggara }}</span>
                        <h3 class="text-lg font-bold text-gray-900 leading-snug group-hover:text-indigo-600 transition-colors duration-150">
                            <a href="{{ route('public.agenda.detail', $agenda->id) }}">{{ $agenda->nama_kegiatan }}</a>
                        </h3>
                        <p class="text-sm text-gray-500 line-clamp-3">
                            {{ $agenda->agenda }}
                        </p>
                    </div>

                    <div class="mt-6 pt-5 border-t border-gray-50 flex items-center justify-between text-xs text-gray-500">
                        <span class="flex items-center gap-1.5"><i class="fa-solid fa-map-marker-alt text-indigo-500"></i> {{ Str::limit($agenda->lokasi, 25) }}</span>
                        <a href="{{ route('public.agenda.detail', $agenda->id) }}" class="inline-flex items-center gap-1 text-xs font-bold text-indigo-600 bg-indigo-50 hover:bg-indigo-100 px-3 py-1.5 rounded-lg transition-colors duration-150">
                            Detail <i class="fa-solid fa-chevron-right text-[10px]"></i>
                        </a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-full py-16 text-center">
                <div class="w-16 h-16 rounded-full bg-gray-100 flex items-center justify-center text-gray-400 mx-auto mb-4">
                    <i class="fa-regular fa-calendar-xmark text-2xl"></i>
                </div>
                <h3 class="text-lg font-bold text-gray-700">Belum Ada Agenda</h3>
                <p class="text-gray-500 text-sm mt-1">Saat ini belum ada agenda kegiatan yang terdaftar.</p>
            </div>
        @endforelse
    </div>
</section>

<!-- Call to Action Section -->
<section class="py-16 bg-slate-900 border-t border-slate-800 text-white overflow-hidden relative">
    <div class="absolute -top-40 -right-40 w-96 h-96 bg-indigo-500/10 rounded-full blur-3xl pointer-events-none"></div>
    <div class="max-w-4xl mx-auto text-center px-4 relative z-10 space-y-6">
        <h2 class="text-3xl font-extrabold sm:text-4xl">Apakah Anda Ingin Mengelola Agenda?</h2>
        <p class="text-slate-400 text-lg max-w-xl mx-auto">
            Halaman administrasi dirancang khusus untuk mempermudah panitia dalam mencatat, memperbarui, dan melaporkan agenda kegiatan.
        </p>
        <div class="inline-flex">
            <a href="{{ route('login') }}" class="inline-flex items-center gap-2 px-6 py-3.5 text-sm font-bold text-white btn-gradient rounded-2xl shadow-lg hover:-translate-y-0.5 active:translate-y-0 transition-all duration-200">
                <i class="fa-solid fa-right-to-bracket"></i> Masuk Sebagai Administrator
            </a>
        </div>
    </div>
</section>
@endsection
