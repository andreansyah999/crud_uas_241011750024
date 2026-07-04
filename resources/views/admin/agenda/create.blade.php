@extends('layouts.admin')

@section('title', 'Tambah Agenda Kegiatan')

@section('content')
<div class="max-w-3xl mx-auto space-y-8 animate-fade-in">
    <!-- Header Section -->
    <div class="flex items-center gap-4">
        <a href="{{ route('admin.agenda.index') }}" class="w-10 h-10 rounded-xl bg-white border border-gray-250/60 hover:bg-gray-50 flex items-center justify-center text-gray-500 hover:text-gray-700 transition-colors shadow-sm">
            <i class="fa-solid fa-arrow-left text-sm"></i>
        </a>
        <div>
            <h1 class="text-3xl font-extrabold text-gray-900 tracking-tight font-sans">Tambah Agenda</h1>
            <p class="text-gray-500 mt-1">Lengkapi formulir di bawah ini untuk menambahkan agenda kegiatan baru.</p>
        </div>
    </div>

    <!-- Form Card -->
    <div class="bg-white rounded-3xl border border-gray-150/80 shadow-sm overflow-hidden p-6 sm:p-8">
        <form action="{{ route('admin.agenda.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6" x-data="{ 
            imagePreview: null,
            previewImage(event) {
                const file = event.target.files[0];
                if (file) {
                    this.imagePreview = URL.createObjectURL(file);
                } else {
                    this.imagePreview = null;
                }
            }
        }">
            @csrf

            <!-- Event Name -->
            <div>
                <label for="nama_kegiatan" class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-2">Nama Kegiatan <span class="text-rose-500">*</span></label>
                <input type="text" name="nama_kegiatan" id="nama_kegiatan" value="{{ old('nama_kegiatan') }}" required 
                    class="block w-full px-3.5 py-3 bg-gray-50 border @error('nama_kegiatan') border-rose-350 bg-rose-50/20 @else border-gray-250/60 @enderror rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 focus:bg-white transition-all duration-150" 
                    placeholder="Contoh: Seminar Nasional AI 2026">
                @error('nama_kegiatan')
                    <p class="mt-2 text-xs text-rose-550 flex items-center gap-1.5 font-medium animate-pulse"><i class="fa-solid fa-circle-exclamation"></i> {{ $message }}</p>
                @enderror
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <!-- Date -->
                <div>
                    <label for="tanggal_kegiatan" class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-2">Tanggal Kegiatan <span class="text-rose-500">*</span></label>
                    <input type="date" name="tanggal_kegiatan" id="tanggal_kegiatan" value="{{ old('tanggal_kegiatan') }}" required 
                        class="block w-full px-3.5 py-3 bg-gray-50 border @error('tanggal_kegiatan') border-rose-350 bg-rose-50/20 @else border-gray-250/60 @enderror rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 focus:bg-white transition-all duration-150">
                    @error('tanggal_kegiatan')
                        <p class="mt-2 text-xs text-rose-550 flex items-center gap-1.5 font-medium animate-pulse"><i class="fa-solid fa-circle-exclamation"></i> {{ $message }}</p>
                    @enderror
                </div>

                <!-- Penyelenggara -->
                <div>
                    <label for="penyelenggara" class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-2">Penyelenggara / Panitia <span class="text-rose-500">*</span></label>
                    <input type="text" name="penyelenggara" id="penyelenggara" value="{{ old('penyelenggara') }}" required 
                        class="block w-full px-3.5 py-3 bg-gray-50 border @error('penyelenggara') border-rose-350 bg-rose-50/20 @else border-gray-250/60 @enderror rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 focus:bg-white transition-all duration-150"
                        placeholder="Contoh: Himpunan Mahasiswa Informatika">
                    @error('penyelenggara')
                        <p class="mt-2 text-xs text-rose-550 flex items-center gap-1.5 font-medium animate-pulse"><i class="fa-solid fa-circle-exclamation"></i> {{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Lokasi -->
            <div>
                <label for="lokasi" class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-2">Lokasi / Tempat Acara <span class="text-rose-500">*</span></label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center text-gray-450">
                        <i class="fa-solid fa-map-location-dot text-sm"></i>
                    </span>
                    <input type="text" name="lokasi" id="lokasi" value="{{ old('lokasi') }}" required 
                        class="block w-full pl-10 pr-3.5 py-3 bg-gray-50 border @error('lokasi') border-rose-350 bg-rose-50/20 @else border-gray-250/60 @enderror rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 focus:bg-white transition-all duration-150" 
                        placeholder="Contoh: Aula Kampus Utama, Lantai 3">
                </div>
                @error('lokasi')
                    <p class="mt-2 text-xs text-rose-550 flex items-center gap-1.5 font-medium animate-pulse"><i class="fa-solid fa-circle-exclamation"></i> {{ $message }}</p>
                @enderror
            </div>

            <!-- Detail Agenda -->
            <div>
                <div class="flex items-center justify-between mb-2">
                    <label for="agenda" class="block text-xs font-bold text-gray-400 uppercase tracking-wider">Rincian Acara & Jadwal (Timeline) <span class="text-rose-500">*</span></label>
                    <span class="text-[10px] text-gray-400 font-semibold uppercase">Pisahkan per baris untuk membuat poin list</span>
                </div>
                <textarea name="agenda" id="agenda" rows="6" required 
                    class="block w-full px-3.5 py-3 bg-gray-50 border @error('agenda') border-rose-350 bg-rose-50/20 @else border-gray-250/60 @enderror rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 focus:bg-white transition-all duration-150" 
                    placeholder="Contoh format:&#10;08:00 - 09:00 : Registrasi Peserta&#10;09:00 - 10:00 : Pembukaan & Sambutan&#10;10:00 - selesai : Sesi Seminar Utama">{{ old('agenda') }}</textarea>
                @error('agenda')
                    <p class="mt-2 text-xs text-rose-550 flex items-center gap-1.5 font-medium animate-pulse"><i class="fa-solid fa-circle-exclamation"></i> {{ $message }}</p>
                @enderror
            </div>

            <!-- Image Upload with Instant Preview -->
            <div>
                <label class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-2">Gambar / Poster Kegiatan</label>
                
                <div class="grid grid-cols-1 sm:grid-cols-12 gap-6 items-center">
                    <!-- Image Input Block -->
                    <div class="sm:col-span-8">
                        <div class="flex items-center justify-center w-full">
                            <label for="gambar" class="flex flex-col items-center justify-center w-full h-36 border-2 border-gray-200 border-dashed rounded-2xl cursor-pointer bg-gray-50 hover:bg-gray-100/50 transition-colors">
                                <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                    <i class="fa-solid fa-cloud-arrow-up text-gray-400 text-2xl mb-2"></i>
                                    <p class="text-xs text-gray-500 font-bold mb-1">Klik untuk unggah poster</p>
                                    <p class="text-[10px] text-gray-400 uppercase tracking-wider font-semibold">Format: PNG, JPG, JPEG, WEBP (Maksimal 2MB)</p>
                                </div>
                                <input id="gambar" name="gambar" type="file" class="hidden" accept="image/*" @change="previewImage" />
                            </label>
                        </div>
                    </div>
                    
                    <!-- Preview block -->
                    <div class="sm:col-span-4 flex justify-center">
                        <div class="w-28 h-28 rounded-2xl border border-gray-200 overflow-hidden bg-gray-50 flex items-center justify-center text-gray-400 relative">
                            <template x-if="imagePreview">
                                <img :src="imagePreview" alt="Preview" class="w-full h-full object-cover">
                            </template>
                            <template x-if="!imagePreview">
                                <div class="text-center space-y-1">
                                    <i class="fa-regular fa-image text-xl text-indigo-300"></i>
                                    <span class="block text-[8px] font-bold uppercase text-gray-400">Belum Ada Gambar</span>
                                </div>
                            </template>
                        </div>
                    </div>
                </div>
                @error('gambar')
                    <p class="mt-2 text-xs text-rose-550 flex items-center gap-1.5 font-medium animate-pulse"><i class="fa-solid fa-circle-exclamation"></i> {{ $message }}</p>
                @enderror
            </div>

            <!-- Action buttons -->
            <div class="pt-6 border-t border-gray-100 flex justify-end gap-3">
                <a href="{{ route('admin.agenda.index') }}" 
                    class="py-2.5 px-5 text-sm font-semibold text-gray-500 bg-gray-100 hover:bg-gray-200 rounded-xl transition-all cursor-pointer">
                    Batal
                </a>
                <button type="submit" 
                    class="py-2.5 px-6 text-sm font-bold text-white btn-gradient rounded-xl shadow-md hover:-translate-y-0.5 active:translate-y-0 transition-all duration-150 cursor-pointer">
                    Simpan Agenda
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
