@extends('layouts.public')

@section('title', 'Hubungi Kami')

@section('content')
<!-- Header Page -->
<section class="bg-slate-900 py-16 text-white text-center relative overflow-hidden">
    <div class="absolute top-0 right-1/4 w-80 h-80 bg-indigo-500/10 rounded-full blur-3xl pointer-events-none"></div>
    <div class="max-w-4xl mx-auto px-4 relative z-10 space-y-4">
        <h1 class="text-3xl sm:text-4xl font-extrabold tracking-tight">{{ $page->title }}</h1>
        <p class="text-slate-400 text-base max-w-xl mx-auto">
            Hubungi kami untuk kolaborasi, publikasi agenda kegiatan, atau informasi kerja sama.
        </p>
    </div>
</section>

<!-- Content Block -->
<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-12">
        <!-- Left Side: Interactive Contact Form -->
        <div class="lg:col-span-7" x-data="{ 
            name: '', 
            email: '', 
            message: '', 
            sent: false, 
            submitForm() {
                if (this.name && this.email && this.message) {
                    this.sent = true;
                    this.name = '';
                    this.email = '';
                    this.message = '';
                    setTimeout(() => this.sent = false, 6000);
                }
            } 
        }">
            <div class="bg-white rounded-3xl p-6 sm:p-8 shadow-md border border-gray-150/80">
                <h3 class="text-2xl font-bold text-gray-900 mb-6">Kirim Pesan</h3>
                
                <!-- Success Alert -->
                <div x-show="sent" 
                     x-transition
                     class="mb-6 p-4 rounded-2xl bg-teal-50 border border-teal-200 text-teal-800 text-sm flex items-start gap-3">
                    <div class="w-6 h-6 rounded-lg bg-teal-100 text-teal-650 flex items-center justify-center flex-shrink-0">
                        <i class="fa-solid fa-circle-check"></i>
                    </div>
                    <div>
                        <strong class="font-bold">Pesan Terkirim!</strong>
                        <p class="text-xs mt-0.5 text-teal-700">Terima kasih telah menghubungi kami. Kami akan merespons pesan Anda secepatnya.</p>
                    </div>
                </div>

                <form @submit.prevent="submitForm()" class="space-y-5">
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label for="form_name" class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-2">Nama Lengkap</label>
                            <input type="text" x-model="name" id="form_name" required 
                                class="block w-full px-3 py-2.5 bg-gray-50 border border-gray-250/60 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 focus:bg-white transition-all" 
                                placeholder="Masukkan nama Anda">
                        </div>
                        <div>
                            <label for="form_email" class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-2">Alamat Email</label>
                            <input type="email" x-model="email" id="form_email" required 
                                class="block w-full px-3 py-2.5 bg-gray-50 border border-gray-250/60 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 focus:bg-white transition-all" 
                                placeholder="name@domain.com">
                        </div>
                    </div>
                    <div>
                        <label for="form_msg" class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-2">Isi Pesan</label>
                        <textarea x-model="message" id="form_msg" rows="5" required 
                            class="block w-full px-3 py-2.5 bg-gray-50 border border-gray-250/60 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 focus:bg-white transition-all" 
                            placeholder="Tulis pesan atau pertanyaan Anda di sini..."></textarea>
                    </div>
                    
                    <div>
                        <button type="submit" 
                            class="w-full sm:w-auto px-6 py-3 text-sm font-bold text-white btn-gradient rounded-xl shadow-md hover:-translate-y-0.5 active:translate-y-0 transition-all duration-150 cursor-pointer">
                            Kirim Pesan <i class="fa-solid fa-paper-plane text-xs ml-1"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Right Side: Contact Information Cards -->
        <div class="lg:col-span-5 space-y-6">
            <!-- Details Card -->
            <div class="bg-white rounded-3xl p-6 sm:p-8 shadow-md border border-gray-150/80 space-y-6">
                <h3 class="text-xl font-bold text-gray-900 border-b border-gray-100 pb-3">Detail Kontak</h3>
                
                <p class="text-sm text-gray-500 leading-relaxed">
                    {{ $page->content }}
                </p>

                <div class="space-y-4 pt-2">
                    <!-- Address -->
                    <div class="flex items-start gap-4">
                        <div class="w-10 h-10 rounded-xl bg-indigo-50 text-indigo-600 flex items-center justify-center flex-shrink-0">
                            <i class="fa-solid fa-location-dot text-base"></i>
                        </div>
                        <div>
                            <span class="block text-xs font-bold text-gray-400 uppercase tracking-wide">Alamat Kantor</span>
                            <span class="text-sm font-semibold text-gray-800 leading-relaxed">{{ $page->additional_metadata['address'] ?? 'Tangerang Selatan, Banten' }}</span>
                        </div>
                    </div>

                    <!-- Phone -->
                    <div class="flex items-start gap-4">
                        <div class="w-10 h-10 rounded-xl bg-indigo-50 text-indigo-600 flex items-center justify-center flex-shrink-0">
                            <i class="fa-solid fa-phone text-base"></i>
                        </div>
                        <div>
                            <span class="block text-xs font-bold text-gray-400 uppercase tracking-wide">Nomor Telepon</span>
                            <span class="text-sm font-semibold text-gray-800">{{ $page->additional_metadata['phone'] ?? '-' }}</span>
                        </div>
                    </div>

                    <!-- Email -->
                    <div class="flex items-start gap-4">
                        <div class="w-10 h-10 rounded-xl bg-indigo-50 text-indigo-600 flex items-center justify-center flex-shrink-0">
                            <i class="fa-solid fa-envelope text-base"></i>
                        </div>
                        <div>
                            <span class="block text-xs font-bold text-gray-400 uppercase tracking-wide">Alamat Email</span>
                            <span class="text-sm font-semibold text-gray-800">{{ $page->additional_metadata['email'] ?? '-' }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Social Links / Badge Card -->
            <div class="bg-gray-100/50 rounded-3xl p-6 border border-gray-100 flex items-center justify-between">
                <span class="text-xs font-bold text-gray-500 uppercase tracking-wider">Ikuti Kami</span>
                <div class="flex gap-3">
                    <a href="#" class="w-9 h-9 rounded-xl bg-white hover:bg-indigo-500 hover:text-white border border-gray-200 text-gray-500 flex items-center justify-center transition-all shadow-sm"><i class="fa-brands fa-instagram text-sm"></i></a>
                    <a href="#" class="w-9 h-9 rounded-xl bg-white hover:bg-indigo-500 hover:text-white border border-gray-200 text-gray-500 flex items-center justify-center transition-all shadow-sm"><i class="fa-brands fa-youtube text-sm"></i></a>
                    <a href="#" class="w-9 h-9 rounded-xl bg-white hover:bg-indigo-500 hover:text-white border border-gray-200 text-gray-500 flex items-center justify-center transition-all shadow-sm"><i class="fa-brands fa-x-twitter text-sm"></i></a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
