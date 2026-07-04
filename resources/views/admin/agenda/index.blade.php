@extends('layouts.admin')

@section('title', 'Daftar Agenda Kegiatan')

@section('content')
<div class="space-y-8 animate-fade-in" x-data="{ deleteModalOpen: false, deleteActionUrl: '', agendaName: '' }">
    <!-- Header Section -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h1 class="text-3xl font-extrabold text-gray-900 tracking-tight">Agenda Kegiatan</h1>
            <p class="text-gray-500 mt-1">Daftar lengkap agenda kegiatan, seminar, dan acara yang telah diinput.</p>
        </div>
        <div class="flex gap-3">
            <a href="{{ route('admin.agenda.create') }}" class="inline-flex items-center gap-2 px-4 py-2.5 text-sm font-semibold text-white btn-gradient rounded-xl shadow-md hover:-translate-y-0.5 active:translate-y-0 transition-all duration-150">
                <i class="fa-solid fa-plus text-xs"></i> Tambah Agenda
            </a>
            <a href="{{ route('admin.agenda.pdf') }}" target="_blank" class="inline-flex items-center gap-2 px-4 py-2.5 text-sm font-semibold text-rose-600 bg-rose-50 hover:bg-rose-100 rounded-xl transition-colors duration-150">
                <i class="fa-solid fa-file-pdf"></i> Ekspor PDF
            </a>
        </div>
    </div>

    <!-- DataTables Table -->
    <div class="bg-white rounded-3xl border border-gray-150/80 shadow-sm overflow-hidden p-6">
        <div class="overflow-x-auto">
            <table id="agendaTable" class="w-full text-sm text-left text-gray-700">
                <thead>
                    <tr>
                        <th class="w-16">No</th>
                        <th class="w-24">Gambar</th>
                        <th>Nama Kegiatan</th>
                        <th>Tanggal</th>
                        <th>Lokasi</th>
                        <th>Penyelenggara</th>
                        <th class="w-32 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($agendas as $index => $agenda)
                        <tr class="hover:bg-gray-50/50 transition-colors duration-150">
                            <td class="font-semibold text-gray-450">{{ $index + 1 }}</td>
                            <td>
                                <div class="w-12 h-12 rounded-xl bg-gray-100 border border-gray-250/50 overflow-hidden flex items-center justify-center text-gray-400">
                                    @if($agenda->gambar)
                                        <img src="{{ asset($agenda->gambar) }}" alt="" class="w-full h-full object-cover">
                                    @else
                                        <i class="fa-regular fa-image text-indigo-300 text-lg" title="Gambar Kosong"></i>
                                    @endif
                                </div>
                            </td>
                            <td>
                                <div class="font-bold text-gray-800 leading-snug">{{ $agenda->nama_kegiatan }}</div>
                                <span class="text-xs text-gray-400 block mt-0.5 line-clamp-1 max-w-xs">{{ Str::limit($agenda->agenda, 60) }}</span>
                            </td>
                            <td class="whitespace-nowrap font-medium text-gray-600">
                                {{ \Carbon\Carbon::parse($agenda->tanggal_kegiatan)->translatedFormat('d M Y') }}
                            </td>
                            <td><span class="line-clamp-2 max-w-[150px]">{{ $agenda->lokasi }}</span></td>
                            <td><span class="inline-flex px-2 py-1 text-xs font-semibold text-teal-700 bg-teal-50 border border-teal-100 rounded-lg">{{ $agenda->penyelenggara }}</span></td>
                            <td class="text-center whitespace-nowrap">
                                <div class="flex items-center justify-center gap-1.5">
                                    <a href="{{ route('public.agenda.detail', $agenda->id) }}" target="_blank" class="p-2 hover:bg-gray-100 text-gray-500 rounded-xl transition-colors duration-150" title="Pratinjau Publik">
                                        <i class="fa-solid fa-eye text-xs"></i>
                                    </a>
                                    <a href="{{ route('admin.agenda.edit', $agenda->id) }}" class="p-2 hover:bg-indigo-50 text-indigo-600 rounded-xl transition-colors duration-150" title="Ubah">
                                        <i class="fa-solid fa-pen text-xs"></i>
                                    </a>
                                    <button type="button" 
                                        @click="deleteModalOpen = true; deleteActionUrl = '{{ route('admin.agenda.destroy', $agenda->id) }}'; agendaName = '{{ addslashes($agenda->nama_kegiatan) }}'"
                                        class="p-2 hover:bg-rose-50 text-rose-600 rounded-xl transition-colors duration-150 cursor-pointer" title="Hapus">
                                        <i class="fa-solid fa-trash text-xs"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Delete Confirmation Modal (Alpine.js powered) -->
    <div x-show="deleteModalOpen" 
         class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-gray-900/40 backdrop-blur-sm"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         style="display: none;">
        
        <!-- Modal Card -->
        <div class="bg-white rounded-3xl p-6 w-full max-w-sm border border-gray-100 shadow-2xl space-y-6"
             @click.away="deleteModalOpen = false"
             x-transition:enter="transition ease-out duration-300 transform"
             x-transition:enter-start="scale-95 translate-y-4"
             x-transition:enter-end="scale-100 translate-y-0"
             x-transition:leave="transition ease-in duration-200 transform"
             x-transition:leave-start="scale-100 translate-y-0"
             x-transition:leave-end="scale-95 translate-y-4">
            
            <div class="text-center space-y-3">
                <div class="w-14 h-14 rounded-full bg-rose-50 text-rose-600 flex items-center justify-center text-2xl mx-auto">
                    <i class="fa-solid fa-trash-can"></i>
                </div>
                <h3 class="font-bold text-gray-900 text-lg">Konfirmasi Hapus</h3>
                <p class="text-sm text-gray-500 leading-relaxed">
                    Apakah Anda yakin ingin menghapus agenda kegiatan <strong class="text-gray-800" x-text="agendaName"></strong>? Tindakan ini tidak dapat dibatalkan.
                </p>
            </div>

            <div class="flex gap-3">
                <button type="button" @click="deleteModalOpen = false" 
                    class="flex-1 py-2.5 px-4 text-sm font-semibold text-gray-500 bg-gray-100 hover:bg-gray-250 hover:bg-gray-200 rounded-xl transition-all cursor-pointer">
                    Batal
                </button>
                <form :action="deleteActionUrl" method="POST" class="flex-1">
                    @csrf
                    @method('DELETE')
                    <button type="submit" 
                        class="w-full py-2.5 px-4 text-sm font-bold text-white bg-rose-600 hover:bg-rose-700 rounded-xl transition-all shadow-md shadow-rose-200 cursor-pointer">
                        Hapus
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Initialize DataTable -->
<script>
    $(document).ready(function() {
        $('#agendaTable').DataTable({
            language: {
                url: '//cdn.datatables.net/plug-ins/1.13.7/i18n/id.json',
                search: '',
                searchPlaceholder: 'Cari di tabel...',
                lengthMenu: 'Tampilkan _MENU_ data',
                info: 'Menampilkan _START_ sampai _END_ dari _TOTAL_ data',
                paginate: {
                    first: 'Pertama',
                    last: 'Terakhir',
                    next: 'Berikutnya',
                    previous: 'Sebelumnya'
                }
            },
            columnDefs: [
                { orderable: false, targets: [1, 6] } // Disable ordering on Image and Action column
            ],
            dom: '<"flex flex-col sm:flex-row items-center justify-between gap-4 mb-4"lf>rt<"flex flex-col sm:flex-row items-center justify-between gap-4 mt-6"ip>',
            drawCallback: function() {
                // Style page numbers if default ones appear
                $('.dataTables_paginate').addClass('flex items-center gap-1');
            }
        });
    });
</script>
@endsection
