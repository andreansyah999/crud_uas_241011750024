@extends('layouts.public')

@section('title', 'Tentang Kami')

@section('content')
<!-- Header Page -->
<section class="bg-slate-900 py-16 text-white text-center relative overflow-hidden">
    <div class="absolute top-0 right-1/4 w-80 h-80 bg-indigo-500/10 rounded-full blur-3xl pointer-events-none"></div>
    <div class="max-w-4xl mx-auto px-4 relative z-10 space-y-4">
        <h1 class="text-3xl sm:text-4xl font-extrabold tracking-tight">{{ $page->title }}</h1>
        <p class="text-slate-400 text-base max-w-xl mx-auto">
            Ketahui visi, misi, dan komitmen kami dalam menyajikan portal informasi agenda terbaik.
        </p>
    </div>
</section>

<!-- Content Block -->
<section class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
        <!-- Left Side: Detail Content -->
        <div class="lg:col-span-7 space-y-6">
            <h2 class="text-3xl font-extrabold text-gray-900 tracking-tight">Portal Informasi Terpercaya</h2>
            <div class="h-1.5 w-20 btn-gradient rounded-full"></div>
            <div class="text-gray-650 leading-relaxed space-y-4 text-base">
                <p>
                    {!! nl2br(e($page->content)) !!}
                </p>
            </div>
            
            <!-- Features Row -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 pt-6">
                <div class="flex items-start gap-4">
                    <div class="w-10 h-10 rounded-xl bg-indigo-50 text-indigo-600 flex items-center justify-center flex-shrink-0">
                        <i class="fa-solid fa-bullseye text-base"></i>
                    </div>
                    <div>
                        <h4 class="font-bold text-gray-900 text-sm">Informasi Akurat</h4>
                        <p class="text-xs text-gray-500 mt-0.5">Seluruh agenda melewati proses verifikasi data sebelum ditayangkan.</p>
                    </div>
                </div>
                <div class="flex items-start gap-4">
                    <div class="w-10 h-10 rounded-xl bg-teal-50 text-teal-600 flex items-center justify-center flex-shrink-0">
                        <i class="fa-solid fa-mobile-screen-button text-base"></i>
                    </div>
                    <div>
                        <h4 class="font-bold text-gray-900 text-sm">Akses Responsif</h4>
                        <p class="text-xs text-gray-500 mt-0.5">Tampilan yang responsif, mudah diakses baik melalui smartphone maupun PC.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Side: Graphic Visual Mockup -->
        <div class="lg:col-span-5 flex justify-center">
            <div class="relative w-full max-w-sm aspect-[4/5] bg-gradient-to-tr from-indigo-500/10 to-teal-500/10 rounded-3xl p-6 border border-gray-100 shadow-xl flex flex-col justify-between">
                <div class="flex justify-between items-start">
                    <div class="w-12 h-12 rounded-2xl btn-gradient flex items-center justify-center text-white shadow-md">
                        <i class="fa-solid fa-users-viewfinder text-xl"></i>
                    </div>
                    <span class="text-[10px] font-bold text-teal-600 bg-teal-50 px-2 py-1 rounded-lg border border-teal-100 uppercase">Visi & Misi</span>
                </div>
                <div class="space-y-4">
                    <div class="space-y-1.5">
                        <h4 class="font-bold text-gray-900 text-sm">Visi Kami</h4>
                        <p class="text-xs text-gray-500 leading-relaxed">
                            Menjadi portal sentralisasi data agenda kegiatan kemahasiswaan dan umum nomor satu yang transparan dan adaptif terhadap kemajuan digital.
                        </p>
                    </div>
                    <div class="space-y-1.5">
                        <h4 class="font-bold text-gray-900 text-sm">Misi Kami</h4>
                        <p class="text-xs text-gray-500 leading-relaxed">
                            1. Menyajikan platform user-friendly.<br>
                            2. Memberikan layanan pengelolaan data agenda yang aman dan efisien bagi administrator.
                        </p>
                    </div>
                </div>
                <div class="border-t border-gray-100 pt-4 text-center text-[10px] text-gray-400 font-semibold uppercase tracking-wider">
                    Eventure Indonesia &bull; UAS 2026
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
