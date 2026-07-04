<?php

namespace App\Http\Controllers;

use App\Models\Agenda;
use App\Models\Page;
use Illuminate\Http\Request;

class PublicController extends Controller
{
    /**
     * Tampilkan halaman Beranda (Home).
     */
    public function home()
    {
        // Ambil 3 agenda mendatang terdekat, atau 3 agenda terbaru jika tidak ada agenda mendatang
        $today = now()->toDateString();
        $agendas = Agenda::where('tanggal_kegiatan', '>=', $today)
            ->orderBy('tanggal_kegiatan', 'asc')
            ->take(3)
            ->get();
            
        if ($agendas->isEmpty()) {
            $agendas = Agenda::orderBy('tanggal_kegiatan', 'desc')
                ->take(3)
                ->get();
        }

        // Hitung statistik untuk Dashboard/Beranda
        $stats = [
            'total_agenda' => Agenda::count(),
            'total_penyelenggara' => Agenda::distinct('penyelenggara')->count('penyelenggara'),
            'total_lokasi' => Agenda::distinct('lokasi')->count('lokasi'),
        ];

        return view('public.home', compact('agendas', 'stats'));
    }

    /**
     * Tampilkan daftar agenda kegiatan dengan pencarian dan filter.
     */
    public function agendas(Request $request)
    {
        $query = Agenda::query();

        // Filter Pencarian kata kunci
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function($q) use ($search) {
                $q->where('nama_kegiatan', 'like', "%{$search}%")
                  ->orWhere('penyelenggara', 'like', "%{$search}%")
                  ->orWhere('lokasi', 'like', "%{$search}%")
                  ->orWhere('agenda', 'like', "%{$search}%");
            });
        }

        // Filter Tanggal Kegiatan
        if ($request->filled('date')) {
            $query->whereDate('tanggal_kegiatan', $request->input('date'));
        }

        // Filter Urutan
        $sort = $request->input('sort', 'latest');
        if ($sort === 'oldest') {
            $query->orderBy('tanggal_kegiatan', 'asc');
        } elseif ($sort === 'upcoming') {
            $query->where('tanggal_kegiatan', '>=', now()->toDateString())
                  ->orderBy('tanggal_kegiatan', 'asc');
        } else {
            $query->orderBy('tanggal_kegiatan', 'desc');
        }

        $agendas = $query->paginate(6)->withQueryString();

        return view('public.agendas', compact('agendas'));
    }

    /**
     * Tampilkan detail dari sebuah agenda.
     */
    public function agendaDetail($id)
    {
        $agenda = Agenda::findOrFail($id);
        
        // Ambil agenda terkait lainnya
        $relatedAgendas = Agenda::where('id', '!=', $id)
            ->orderBy('tanggal_kegiatan', 'desc')
            ->take(3)
            ->get();

        return view('public.agenda-detail', compact('agenda', 'relatedAgendas'));
    }

    /**
     * Tampilkan halaman Tentang Kami.
     */
    public function about()
    {
        $page = Page::where('slug', 'about-us')->firstOrFail();
        return view('public.about', compact('page'));
    }

    /**
     * Tampilkan halaman Kontak.
     */
    public function contact()
    {
        $page = Page::where('slug', 'contact-us')->firstOrFail();
        return view('public.contact', compact('page'));
    }
}
