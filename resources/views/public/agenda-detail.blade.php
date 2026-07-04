@extends('layouts.public')

@section('title', $agenda->nama_kegiatan)

@section('content')
<!-- Header Page -->
<section class="bg-slate-900 py-16 text-white relative overflow-hidden">
    <div class="absolute top-0 right-1/4 w-80 h-80 bg-indigo-500/10 rounded-full blur-3xl pointer-events-none"></div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 space-y-4">
        <a href="{{ route('public.agendas') }}" class="inline-flex items-center gap-1.5 text-xs font-bold text-slate-400 hover:text-white transition-colors duration-150 uppercase tracking-widest mb-2">
            <i class="fa-solid fa-arrow-left"></i> Kembali ke Daftar Agenda
        </a>
        <div class="space-y-3">
            <span class="inline-flex px-3 py-1 text-xs font-bold text-teal-400 bg-teal-500/10 rounded-full border border-teal-500/20 uppercase tracking-wider">
                {{ $agenda->penyelenggara }}
            </span>
            <h1 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold tracking-tight leading-tight max-w-4xl text-white">
                {{ $agenda->nama_kegiatan }}
            </h1>
        </div>
    </div>
</section>

<!-- Content Block -->
<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-12">
        <!-- Left Side: Detail & Timeline -->
        <div class="lg:col-span-8 space-y-8">
            <!-- Event Image -->
            <div class="aspect-[21/9] w-full rounded-3xl overflow-hidden bg-slate-100 shadow-md border border-gray-100 relative">
                @if($agenda->gambar)
                    <img src="{{ asset($agenda->gambar) }}" alt="{{ $agenda->nama_kegiatan }}" class="w-full h-full object-cover">
                @else
                    <div class="w-full h-full flex flex-col items-center justify-center text-indigo-300 bg-gradient-to-tr from-indigo-50 to-indigo-100/30">
                        <i class="fa-regular fa-image text-5xl mb-3"></i>
                        <span class="text-sm font-semibold uppercase tracking-wider text-indigo-400/80">Gambar Agenda Belum Diunggah</span>
                    </div>
                @endif
            </div>

            <!-- Description / Schedule Timeline -->
            <div class="bg-white rounded-3xl p-6 sm:p-8 shadow-sm border border-gray-150/80 space-y-6">
                <h2 class="text-2xl font-bold text-gray-900 border-b border-gray-100 pb-4">
                    <i class="fa-solid fa-clipboard-list text-indigo-500 mr-2"></i> Rincian & Jadwal Agenda
                </h2>
                
                <!-- Format agenda using styled blocks for lines -->
                <div class="space-y-4 text-gray-650 leading-relaxed text-sm">
                    @php
                        // Split agenda text by newline to render as a neat schedule/timeline
                        $lines = array_filter(explode("\n", $agenda->agenda));
                    @endphp

                    @if(count($lines) > 0)
                        <div class="relative border-l-2 border-indigo-100 ml-4 space-y-6 py-2">
                            @foreach($lines as $line)
                                @php
                                    // Parse time or bullets if formatting matches "XX:XX - XX:XX : Deskripsi" or "XX:XX : Deskripsi"
                                    $parts = explode(':', $line, 2);
                                    $isTimed = false;
                                    $time = '';
                                    $details = $line;
                                    
                                    if (count($parts) === 2 && (preg_match('/^\d{2}[:\.]\d{2}/', trim($parts[0])) || preg_match('/^\d{2}[:\.]\d{2}\s*-\s*\d{2}[:\.]\d{2}/', trim($parts[0])))) {
                                        $isTimed = true;
                                        $time = trim($parts[0]);
                                        $details = trim($parts[1]);
                                    }
                                @endphp
                                <div class="relative pl-6 group">
                                    <!-- Timeline Node Indicator -->
                                    <div class="absolute -left-[7px] top-1.5 w-3.5 h-3.5 rounded-full bg-white border-2 border-indigo-500 group-hover:bg-indigo-500 transition-colors duration-150"></div>
                                    
                                    @if($isTimed)
                                        <div class="flex flex-col sm:flex-row sm:items-start gap-1 sm:gap-4">
                                            <span class="inline-flex px-2.5 py-0.5 rounded-lg text-xs font-bold bg-indigo-50 text-indigo-600 border border-indigo-100 flex-shrink-0 w-max">
                                                {{ $time }}
                                            </span>
                                            <span class="font-medium text-gray-700 mt-0.5">{{ $details }}</span>
                                        </div>
                                    @else
                                        <span class="font-medium text-gray-700">{{ $line }}</span>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-gray-500 italic">Rincian agenda kegiatan belum didefinisikan.</p>
                    @endif
                </div>
            </div>
        </div>

        <!-- Right Side: Sidebar Info -->
        <div class="lg:col-span-4 space-y-6">
            <!-- Event Metadata Card -->
            <div class="bg-white rounded-3xl p-6 shadow-sm border border-gray-150/80 space-y-6">
                <h3 class="text-lg font-bold text-gray-900 border-b border-gray-100 pb-3">Informasi Acara</h3>
                
                <div class="space-y-4">
                    <!-- Date -->
                    <div class="flex items-start gap-4">
                        <div class="w-10 h-10 rounded-xl bg-indigo-50 text-indigo-600 flex items-center justify-center flex-shrink-0">
                            <i class="fa-solid fa-calendar text-base"></i>
                        </div>
                        <div>
                            <span class="block text-xs font-bold text-gray-400 uppercase tracking-wide">Tanggal Kegiatan</span>
                            <span class="text-sm font-semibold text-gray-800">{{ \Carbon\Carbon::parse($agenda->tanggal_kegiatan)->translatedFormat('l, d F Y') }}</span>
                        </div>
                    </div>

                    <!-- Location -->
                    <div class="flex items-start gap-4">
                        <div class="w-10 h-10 rounded-xl bg-indigo-50 text-indigo-600 flex items-center justify-center flex-shrink-0">
                            <i class="fa-solid fa-map-location-dot text-base"></i>
                        </div>
                        <div>
                            <span class="block text-xs font-bold text-gray-400 uppercase tracking-wide">Lokasi / Tempat</span>
                            <span class="text-sm font-semibold text-gray-800">{{ $agenda->lokasi }}</span>
                        </div>
                    </div>

                    <!-- Penyelenggara -->
                    <div class="flex items-start gap-4">
                        <div class="w-10 h-10 rounded-xl bg-indigo-50 text-indigo-600 flex items-center justify-center flex-shrink-0">
                            <i class="fa-solid fa-users text-base"></i>
                        </div>
                        <div>
                            <span class="block text-xs font-bold text-gray-400 uppercase tracking-wide">Penyelenggara</span>
                            <span class="text-sm font-semibold text-gray-800">{{ $agenda->penyelenggara }}</span>
                        </div>
                    </div>
                </div>
                
                <div class="pt-4 border-t border-gray-100 text-center">
                    <span class="text-xs text-gray-400 flex items-center justify-center gap-1.5">
                        <i class="fa-solid fa-lock text-[10px]"></i> Publik &bull; Bebas Akses
                    </span>
                </div>
            </div>

            <!-- Share widget or Callout -->
            <div class="bg-gradient-to-tr from-indigo-900 to-indigo-950 rounded-3xl p-6 text-white text-center space-y-4 shadow-lg">
                <i class="fa-solid fa-circle-info text-3xl text-indigo-400"></i>
                <div class="space-y-1">
                    <h4 class="font-bold text-base">Butuh Bantuan?</h4>
                    <p class="text-xs text-indigo-200/80 leading-relaxed">
                        Jika Anda ingin bertanya seputar kegiatan ini, silakan hubungi penyelenggara secara langsung atau hubungi kontak kami di halaman Hubungi Kami.
                    </p>
                </div>
                <a href="{{ route('public.contact') }}" class="inline-flex justify-center items-center w-full py-2.5 px-4 text-xs font-bold text-indigo-900 bg-white hover:bg-indigo-50 rounded-xl transition-all">
                    Hubungi Kami
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Related Agendas -->
@if($relatedAgendas->isNotEmpty())
<section class="bg-gray-100/50 py-16 border-t border-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-2xl font-bold text-gray-900 tracking-tight mb-8">Agenda Menarik Lainnya</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @foreach($relatedAgendas as $related)
                <div class="bg-white rounded-3xl overflow-hidden border border-gray-100 shadow-md hover:shadow-lg hover:-translate-y-1 transition-all duration-300 flex flex-col group">
                    <div class="relative aspect-[16/10] bg-indigo-50/50 overflow-hidden flex-shrink-0">
                        @if($related->gambar)
                            <img src="{{ asset($related->gambar) }}" alt="{{ $related->nama_kegiatan }}" class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full flex flex-col items-center justify-center text-indigo-350">
                                <i class="fa-regular fa-image text-3xl mb-1"></i>
                                <span class="text-[10px] font-bold uppercase tracking-wider text-indigo-400/70">Tanpa Gambar</span>
                            </div>
                        @endif
                        <div class="absolute top-4 left-4">
                            <span class="inline-flex px-2.5 py-1 text-[10px] font-bold text-indigo-600 bg-white rounded-lg shadow-sm border border-indigo-50">
                                {{ \Carbon\Carbon::parse($related->tanggal_kegiatan)->translatedFormat('d M Y') }}
                            </span>
                        </div>
                    </div>
                    <div class="p-5 flex-grow flex flex-col justify-between">
                        <div class="space-y-2">
                            <span class="text-[10px] font-bold text-teal-600 uppercase tracking-widest">{{ $related->penyelenggara }}</span>
                            <h4 class="font-bold text-gray-900 leading-snug group-hover:text-indigo-600 transition-colors">
                                <a href="{{ route('public.agenda.detail', $related->id) }}">{{ Str::limit($related->nama_kegiatan, 45) }}</a>
                            </h4>
                        </div>
                        <div class="mt-4 pt-4 border-t border-gray-50 flex items-center justify-between text-[11px] text-gray-500">
                            <span><i class="fa-solid fa-map-marker-alt text-indigo-500 mr-1"></i> {{ Str::limit($related->lokasi, 20) }}</span>
                            <a href="{{ route('public.agenda.detail', $related->id) }}" class="text-indigo-600 font-bold hover:text-indigo-700">Detail <i class="fa-solid fa-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endif
@endsection
