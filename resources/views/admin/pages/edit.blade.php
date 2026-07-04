@extends('layouts.admin')

@section('title', 'Kelola Konten Halaman')

@section('content')
<div class="space-y-8 animate-fade-in" x-data="{ activeTab: 'about' }">
    <!-- Header Section -->
    <div>
        <h1 class="text-3xl font-extrabold text-gray-900 tracking-tight">Kelola Konten Halaman</h1>
        <p class="text-gray-500 mt-1">Perbarui judul, teks, dan metadata untuk halaman Tentang Kami dan Kontak secara dinamis.</p>
    </div>

    <!-- Navigation Tabs -->
    <div class="border-b border-gray-200">
        <nav class="flex space-x-6" aria-label="Tabs">
            <button @click="activeTab = 'about'" :class="activeTab === 'about' ? 'border-indigo-600 text-indigo-650 font-bold border-b-2' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'" class="pb-4 px-1 text-sm font-semibold transition-all duration-150 cursor-pointer">
                <i class="fa-solid fa-address-card mr-1.5"></i> Tentang Kami
            </button>
            <button @click="activeTab = 'contact'" :class="activeTab === 'contact' ? 'border-indigo-600 text-indigo-650 font-bold border-b-2' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'" class="pb-4 px-1 text-sm font-semibold transition-all duration-150 cursor-pointer">
                <i class="fa-solid fa-address-book mr-1.5"></i> Hubungi Kami (Kontak)
            </button>
        </nav>
    </div>

    <!-- Editor Form -->
    <div class="bg-white rounded-3xl border border-gray-150/80 shadow-sm overflow-hidden p-6 sm:p-8">
        <form action="{{ route('admin.pages.update') }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <!-- Tab 1: Tentang Kami -->
            <div x-show="activeTab === 'about'" class="space-y-6" x-transition>
                <div class="border-b border-gray-100 pb-4">
                    <h3 class="font-bold text-gray-900 text-base">Halaman Tentang Kami</h3>
                    <p class="text-xs text-gray-400 mt-0.5">Konten yang muncul saat pengunjung mengklik menu "Tentang Kami".</p>
                </div>

                <!-- About Us Title -->
                <div>
                    <label for="about_title" class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-2">Judul Halaman <span class="text-rose-500">*</span></label>
                    <input type="text" name="about_title" id="about_title" value="{{ old('about_title', $aboutPage->title) }}" 
                        class="block w-full px-3.5 py-3 bg-gray-50 border @error('about_title') border-rose-350 bg-rose-50/20 @else border-gray-250/60 @enderror rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 focus:bg-white transition-all duration-150">
                    @error('about_title')
                        <p class="mt-2 text-xs text-rose-550 flex items-center gap-1.5 font-medium animate-pulse"><i class="fa-solid fa-circle-exclamation"></i> {{ $message }}</p>
                    @enderror
                </div>

                <!-- About Us Content -->
                <div>
                    <label for="about_content" class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-2">Konten Halaman <span class="text-rose-500">*</span></label>
                    <textarea name="about_content" id="about_content" rows="10" 
                        class="block w-full px-3.5 py-3 bg-gray-50 border @error('about_content') border-rose-350 bg-rose-50/20 @else border-gray-250/60 @enderror rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 focus:bg-white transition-all duration-150" 
                        placeholder="Masukkan deskripsi tentang platform atau organisasi Anda...">{{ old('about_content', $aboutPage->content) }}</textarea>
                    @error('about_content')
                        <p class="mt-2 text-xs text-rose-550 flex items-center gap-1.5 font-medium animate-pulse"><i class="fa-solid fa-circle-exclamation"></i> {{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Tab 2: Hubungi Kami -->
            <div x-show="activeTab === 'contact'" class="space-y-6" x-transition style="display: none;">
                <div class="border-b border-gray-100 pb-4">
                    <h3 class="font-bold text-gray-900 text-base">Halaman Hubungi Kami</h3>
                    <p class="text-xs text-gray-400 mt-0.5">Konten alamat, email, telepon, dan deskripsi pada menu "Kontak".</p>
                </div>

                <!-- Contact Title -->
                <div>
                    <label for="contact_title" class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-2">Judul Halaman <span class="text-rose-500">*</span></label>
                    <input type="text" name="contact_title" id="contact_title" value="{{ old('contact_title', $contactPage->title) }}" 
                        class="block w-full px-3.5 py-3 bg-gray-50 border @error('contact_title') border-rose-350 bg-rose-50/20 @else border-gray-250/60 @enderror rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 focus:bg-white transition-all duration-150">
                    @error('contact_title')
                        <p class="mt-2 text-xs text-rose-550 flex items-center gap-1.5 font-medium animate-pulse"><i class="fa-solid fa-circle-exclamation"></i> {{ $message }}</p>
                    @enderror
                </div>

                <!-- Contact Content -->
                <div>
                    <label for="contact_content" class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-2">Deskripsi / Pengantar <span class="text-rose-500">*</span></label>
                    <textarea name="contact_content" id="contact_content" rows="4" 
                        class="block w-full px-3.5 py-3 bg-gray-50 border @error('contact_content') border-rose-350 bg-rose-50/20 @else border-gray-250/60 @enderror rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 focus:bg-white transition-all duration-150"
                        placeholder="Contoh: Kami sangat senang mendengar dari Anda! Silakan hubungi kami...">{{ old('contact_content', $contactPage->content) }}</textarea>
                    @error('contact_content')
                        <p class="mt-2 text-xs text-rose-550 flex items-center gap-1.5 font-medium animate-pulse"><i class="fa-solid fa-circle-exclamation"></i> {{ $message }}</p>
                    @enderror
                </div>

                <!-- Contact Details Grid (Email, Phone, Address) -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <!-- Email -->
                    <div>
                        <label for="contact_email" class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-2">Alamat Email <span class="text-rose-500">*</span></label>
                        <input type="email" name="contact_email" id="contact_email" value="{{ old('contact_email', $contactPage->additional_metadata['email'] ?? '') }}" 
                            class="block w-full px-3.5 py-3 bg-gray-50 border @error('contact_email') border-rose-350 bg-rose-50/20 @else border-gray-250/60 @enderror rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 focus:bg-white transition-all duration-150"
                            placeholder="info@domain.id">
                        @error('contact_email')
                            <p class="mt-2 text-xs text-rose-550 flex items-center gap-1.5 font-medium animate-pulse"><i class="fa-solid fa-circle-exclamation"></i> {{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Phone -->
                    <div>
                        <label for="contact_phone" class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-2">Nomor Telepon <span class="text-rose-500">*</span></label>
                        <input type="text" name="contact_phone" id="contact_phone" value="{{ old('contact_phone', $contactPage->additional_metadata['phone'] ?? '') }}" 
                            class="block w-full px-3.5 py-3 bg-gray-50 border @error('contact_phone') border-rose-350 bg-rose-50/20 @else border-gray-250/60 @enderror rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 focus:bg-white transition-all duration-150"
                            placeholder="Contoh: +62 21 8765 4321">
                        @error('contact_phone')
                            <p class="mt-2 text-xs text-rose-550 flex items-center gap-1.5 font-medium animate-pulse"><i class="fa-solid fa-circle-exclamation"></i> {{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Address -->
                <div>
                    <label for="contact_address" class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-2">Alamat Kantor / Sekretariat <span class="text-rose-500">*</span></label>
                    <textarea name="contact_address" id="contact_address" rows="3" 
                        class="block w-full px-3.5 py-3 bg-gray-50 border @error('contact_address') border-rose-350 bg-rose-50/20 @else border-gray-250/60 @enderror rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 focus:bg-white transition-all duration-150"
                        placeholder="Tulis alamat fisik lengkap kantor atau sekretariat panitia...">{{ old('contact_address', $contactPage->additional_metadata['address'] ?? '') }}</textarea>
                    @error('contact_address')
                        <p class="mt-2 text-xs text-rose-550 flex items-center gap-1.5 font-medium animate-pulse"><i class="fa-solid fa-circle-exclamation"></i> {{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Submit Button (Sticky bottom or block) -->
            <div class="pt-6 border-t border-gray-100 flex justify-end">
                <button type="submit" 
                    class="py-3 px-6 text-sm font-bold text-white btn-gradient rounded-xl shadow-md hover:-translate-y-0.5 active:translate-y-0 transition-all duration-150 cursor-pointer">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
