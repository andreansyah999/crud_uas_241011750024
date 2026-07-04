<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Seed Admin User
        User::create([
            'name' => 'Administrator',
            'username' => 'admin',
            'password' => \Hash::make('admin123'),
        ]);

        // Seed Dynamic Pages
        \App\Models\Page::create([
            'slug' => 'about-us',
            'title' => 'Tentang Kami',
            'content' => 'Selamat datang di Portal Agenda Kegiatan kami! Kami berkomitmen untuk menyediakan platform informatif, transparan, dan terkini mengenai seluruh rangkaian kegiatan, seminar, workshop, serta acara komunitas lainnya. Melalui sistem ini, kami berharap dapat mempermudah koordinasi, kolaborasi, dan penyebaran informasi kepada seluruh pihak yang terlibat. Dukung kami untuk terus menyajikan layanan terbaik demi kemajuan bersama.',
        ]);

        \App\Models\Page::create([
            'slug' => 'contact-us',
            'title' => 'Hubungi Kami',
            'content' => 'Kami sangat senang mendengar dari Anda! Jika Anda memiliki pertanyaan, saran, atau ingin berkolaborasi terkait agenda kegiatan kami, jangan ragu untuk menghubungi kami melalui informasi kontak berikut atau kunjungi sekretariat kami.',
            'additional_metadata' => [
                'email' => 'info@agenda.id',
                'phone' => '+62 21 8765 4321',
                'address' => 'Gedung Rektorat Lt. 3, Jl. Puspiptek No. 46, Tangerang Selatan, Banten',
            ]
        ]);

        // Seed Sample Agendas
        \App\Models\Agenda::create([
            'nama_kegiatan' => 'Seminar Nasional IT & AI 2026',
            'gambar' => null,
            'tanggal_kegiatan' => '2026-07-20',
            'lokasi' => 'Aula Kampus Utama, Tangerang Selatan',
            'penyelenggara' => 'Himpunan Mahasiswa Informatika',
            'agenda' => "08:00 - 09:00 : Registrasi Peserta & Coffee Break\n09:00 - 09:30 : Sambutan Rektor & Pembukaan\n09:30 - 12:00 : Sesi Panel Utama: Masa Depan AI dan Cloud Computing\n12:00 - 13:00 : Istirahat & Makan Siang\n13:00 - 15:00 : Diskusi Interaktif & Tanya Jawab\n15:00 - 15:30 : Penyerahan Plakat & Penutupan"
        ]);

        \App\Models\Agenda::create([
            'nama_kegiatan' => 'Workshop Laravel 12 Advanced Core',
            'gambar' => null,
            'tanggal_kegiatan' => '2026-08-05',
            'lokasi' => 'Lab Komputer C, Lantai 2',
            'penyelenggara' => 'Pusat Riset dan Teknologi Informasi',
            'agenda' => "09:00 - 10:30 : Pengenalan Struktur Baru Laravel 12 & Optimasi\n10:30 - 12:00 : Hands-on: Membangun API Handal & Menggunakan Job Queue\n12:00 - 13:00 : Istirahat & Networking\n13:00 - 15:00 : Studi Kasus: Implementasi Custom Driver & Keamanan Lanjut\n15:00 - 16:00 : Evaluasi & Sertifikasi"
        ]);

        \App\Models\Agenda::create([
            'nama_kegiatan' => 'Festival Seni & Budaya Nusantara 2026',
            'gambar' => null,
            'tanggal_kegiatan' => '2026-08-15',
            'lokasi' => 'Lapangan Utama Balai Kota',
            'penyelenggara' => 'Dinas Pariwisata dan Kebudayaan',
            'agenda' => "10:00 - 12:00 : Pembukaan & Parade Kostum Adat\n12:00 - 14:00 : Kuliner Tradisional Nusantara & Musik Daerah\n14:00 - 17:00 : Kompetisi Tari Kreasi Baru Tingkat Provinsi\n19:00 - 22:00 : Malam Puncak Pentas Seni & Bintang Tamu Utama"
        ]);
    }
}
