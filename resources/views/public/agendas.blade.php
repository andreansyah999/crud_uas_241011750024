@extends('layouts.public')

@section('title', 'Daftar Agenda')

@section('content')
<!-- Header Page -->
<section class="bg-slate-900 py-16 text-white text-center relative overflow-hidden">
    <div class="absolute top-0 right-1/4 w-80 h-80 bg-indigo-500/10 rounded-full blur-3xl pointer-events-none"></div>
    <div class="max-w-4xl mx-auto px-4 relative z-10 space-y-4">
        <h1 class="text-3xl sm:text-4xl font-extrabold tracking-tight">Agenda Kegiatan</h1>
        <p class="text-slate-400 text-base max-w-xl mx-auto">
            Temukan berbagai rangkaian acara, seminar, workshop, dan festival yang diselenggarakan dalam waktu dekat.
        </p>
    </div>
</section>

<!-- Filter and Search -->
<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
    <div class="bg-white rounded-3xl p-6 shadow-md border border-gray-150/80 mb-10">
        <form action="{{ route('public.agendas') }}" method="GET" class="grid grid-cols-1 md:grid-cols-12 gap-4 items-end">
            <!-- Keyword Search -->
            <div class="md:col-span-5">
                <label for="search" class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-2">Pencarian</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center text-gray-400">
                        <i class="fa-solid fa-magnifying-glass text-sm"></i>
                    </span>
                    <input type="text" name="search" id="search" value="{{ request('search') }}" 
                        class="block w-full pl-10 pr-3 py-2.5 bg-gray-50 border border-gray-250/60 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 focus:bg-white transition-all" 
                        placeholder="Cari nama kegiatan, penyelenggara...">
                </div>
            </div>

            <!-- Date Filter -->
            <div class="md:col-span-3">
                <label for="date" class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-2">Tanggal Kegiatan</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center text-gray-400">
                        <i class="fa-solid fa-calendar-day text-sm"></i>
                    </span>
                    <input type="date" name="date" id="date" value="{{ request('date') }}" 
                        class="block w-full pl-10 pr-3 py-2.5 bg-gray-50 border border-gray-250/60 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 focus:bg-white transition-all">
                </div>
            </div>

            <!-- Sort Filter -->
            <div class="md:col-span-2">
                <label for="sort" class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-2">Urutan</label>
                <select name="sort" id="sort" 
                    class="block w-full px-3 py-2.5 bg-gray-50 border border-gray-250/60 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 focus:bg-white transition-all">
                    <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>Terbaru</option>
                    <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>Terlama</option>
                    <option value="upcoming" {{ request('sort') == 'upcoming' ? 'selected' : '' }}>Mendatang</option>
                </select>
            </div>

            <!-- Buttons -->
            <div class="md:col-span-2 flex gap-2">
                <button type="submit" 
                    class="flex-1 py-2.5 px-4 text-sm font-bold text-white btn-gradient rounded-xl shadow-md hover:-translate-y-0.5 active:translate-y-0 transition-all duration-150 cursor-pointer text-center">
                    Cari
                </button>
                @if(request()->anyFilled(['search', 'date', 'sort']))
                    <a href="{{ route('public.agendas') }}" 
                        class="px-3.5 py-2.5 text-sm font-semibold text-gray-500 bg-gray-100 hover:bg-gray-200 rounded-xl transition-colors duration-150 flex items-center justify-center"
                        title="Reset Filter">
                        <i class="fa-solid fa-rotate-left"></i>
                    </a>
                @endif
            </div>
        </form>
    </div>

    <!-- Active Search Info -->
    @if(request()->filled('search') || request()->filled('date'))
        <div class="mb-6 text-sm text-gray-500">
            Ditemukan {{ $agendas->total() }} hasil pencarian untuk 
            @if(request()->filled('search')) kata kunci <strong class="text-indigo-600">"{{ request('search') }}"</strong> @endif
            @if(request()->filled('date')) tanggal <strong class="text-indigo-600">"{{ \Carbon\Carbon::parse(request('date'))->translatedFormat('d M Y') }}"</strong> @endif
        </div>
    @endif

    <!-- Agendas Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        @forelse($agendas as $agenda)
            <div class="bg-white rounded-3xl overflow-hidden border border-gray-100 shadow-md hover:shadow-xl hover:-translate-y-1 transition-all duration-300 flex flex-col group">
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
                        <span class="flex items-center gap-1.5"><i class="fa-solid fa-map-marker-alt text-indigo-500 text-xs"></i> {{ Str::limit($agenda->lokasi, 25) }}</span>
                        <a href="{{ route('public.agenda.detail', $agenda->id) }}" class="inline-flex items-center gap-1 text-xs font-bold text-indigo-600 bg-indigo-50 hover:bg-indigo-100 px-3 py-1.5 rounded-lg transition-colors duration-150">
                            Detail <i class="fa-solid fa-chevron-right text-[10px]"></i>
                        </a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-full py-20 text-center">
                <div class="w-20 h-20 rounded-full bg-gray-100 flex items-center justify-center text-gray-400 mx-auto mb-4">
                    <i class="fa-solid fa-calendar-xmark text-3xl"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-700">Agenda Tidak Ditemukan</h3>
                <p class="text-gray-500 text-sm mt-1 max-w-sm mx-auto">Kami tidak dapat menemukan agenda kegiatan yang cocok dengan kriteria pencarian Anda.</p>
                <a href="{{ route('public.agendas') }}" class="mt-6 inline-flex items-center gap-1 px-4 py-2 bg-indigo-50 hover:bg-indigo-100 text-indigo-600 font-bold rounded-xl text-sm transition-colors">
                    Reset Pencarian
                </a>
            </div>
        @endforelse
    </div>

    <!-- Pagination -->
    <div class="mt-12 flex justify-center">
        {{ $agendas->links() }}
    </div>
</section>
@endsection
