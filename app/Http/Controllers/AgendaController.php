<?php

namespace App\Http\Controllers;

use App\Models\Agenda;
use App\Models\Page;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class AgendaController extends Controller
{
    /**
     * Tampilkan halaman dashboard utama admin dengan statistika & chart visual.
     */
    public function dashboard()
    {
        $today = now()->toDateString();
        
        $stats = [
            'total_agenda' => Agenda::count(),
            'agenda_mendatang' => Agenda::where('tanggal_kegiatan', '>=', $today)->count(),
            'total_penyelenggara' => Agenda::distinct('penyelenggara')->count('penyelenggara'),
            'total_admin' => User::count(),
        ];

        // Ambil 5 agenda yang baru saja ditambahkan
        $recentAgendas = Agenda::orderBy('created_at', 'desc')->take(5)->get();

        return view('admin.dashboard', compact('stats', 'recentAgendas'));
    }

    /**
     * Tampilkan daftar agenda kegiatan (Read).
     */
    public function index()
    {
        $agendas = Agenda::orderBy('tanggal_kegiatan', 'desc')->get();
        return view('admin.agenda.index', compact('agendas'));
    }

    /**
     * Tampilkan form tambah agenda kegiatan (Create View).
     */
    public function create()
    {
        return view('admin.agenda.create');
    }

    /**
     * Simpan agenda kegiatan baru ke database (Create Store).
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_kegiatan' => ['required', 'string', 'max:255'],
            'tanggal_kegiatan' => ['required', 'date'],
            'lokasi' => ['required', 'string', 'max:255'],
            'penyelenggara' => ['required', 'string', 'max:255'],
            'agenda' => ['required', 'string'],
            'gambar' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,webp', 'max:2048'], // Maksimal 2MB
        ], [
            'nama_kegiatan.required' => 'Nama kegiatan wajib diisi.',
            'tanggal_kegiatan.required' => 'Tanggal kegiatan wajib diisi.',
            'lokasi.required' => 'Lokasi kegiatan wajib diisi.',
            'penyelenggara.required' => 'Penyelenggara wajib diisi.',
            'agenda.required' => 'Detail agenda wajib diisi.',
            'gambar.image' => 'File yang diupload harus berupa gambar.',
            'gambar.mimes' => 'Format gambar harus jpeg, png, jpg, gif, atau webp.',
            'gambar.max' => 'Ukuran gambar tidak boleh melebihi 2MB.',
        ]);

        $gambarPath = null;

        // Proses upload gambar jika ada
        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            
            // Pastikan folder uploads/agendas ada
            $destinationPath = public_path('uploads/agendas');
            if (!File::isDirectory($destinationPath)) {
                File::makeDirectory($destinationPath, 0755, true, true);
            }
            
            $file->move($destinationPath, $filename);
            $gambarPath = 'uploads/agendas/' . $filename;
        }

        Agenda::create([
            'nama_kegiatan' => $request->nama_kegiatan,
            'tanggal_kegiatan' => $request->tanggal_kegiatan,
            'lokasi' => $request->lokasi,
            'penyelenggara' => $request->penyelenggara,
            'agenda' => $request->agenda,
            'gambar' => $gambarPath,
        ]);

        return redirect()->route('admin.agenda.index')
            ->with('success', 'Agenda kegiatan berhasil ditambahkan!');
    }

    /**
     * Tampilkan detail agenda di admin (Opsional, di-redirect ke index atau edit).
     */
    public function show($id)
    {
        return redirect()->route('admin.agenda.edit', $id);
    }

    /**
     * Tampilkan form edit agenda (Update View).
     */
    public function edit($id)
    {
        $agenda = Agenda::findOrFail($id);
        return view('admin.agenda.edit', compact('agenda'));
    }

    /**
     * Simpan perubahan pada agenda kegiatan (Update Store).
     */
    public function update(Request $request, $id)
    {
        $agenda = Agenda::findOrFail($id);

        $request->validate([
            'nama_kegiatan' => ['required', 'string', 'max:255'],
            'tanggal_kegiatan' => ['required', 'date'],
            'lokasi' => ['required', 'string', 'max:255'],
            'penyelenggara' => ['required', 'string', 'max:255'],
            'agenda' => ['required', 'string'],
            'gambar' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,webp', 'max:2048'],
        ], [
            'nama_kegiatan.required' => 'Nama kegiatan wajib diisi.',
            'tanggal_kegiatan.required' => 'Tanggal kegiatan wajib diisi.',
            'lokasi.required' => 'Lokasi kegiatan wajib diisi.',
            'penyelenggara.required' => 'Penyelenggara wajib diisi.',
            'agenda.required' => 'Detail agenda wajib diisi.',
            'gambar.image' => 'File yang diupload harus berupa gambar.',
            'gambar.mimes' => 'Format gambar harus jpeg, png, jpg, gif, atau webp.',
            'gambar.max' => 'Ukuran gambar tidak boleh melebihi 2MB.',
        ]);

        $gambarPath = $agenda->gambar;

        // Proses upload gambar baru jika ada
        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            
            $destinationPath = public_path('uploads/agendas');
            if (!File::isDirectory($destinationPath)) {
                File::makeDirectory($destinationPath, 0755, true, true);
            }

            // Hapus gambar lama jika ada
            if ($agenda->gambar && File::exists(public_path($agenda->gambar))) {
                File::delete(public_path($agenda->gambar));
            }
            
            $file->move($destinationPath, $filename);
            $gambarPath = 'uploads/agendas/' . $filename;
        }

        $agenda->update([
            'nama_kegiatan' => $request->nama_kegiatan,
            'tanggal_kegiatan' => $request->tanggal_kegiatan,
            'lokasi' => $request->lokasi,
            'penyelenggara' => $request->penyelenggara,
            'agenda' => $request->agenda,
            'gambar' => $gambarPath,
        ]);

        return redirect()->route('admin.agenda.index')
            ->with('success', 'Agenda kegiatan berhasil diperbarui!');
    }

    /**
     * Hapus agenda kegiatan (Delete).
     */
    public function destroy($id)
    {
        $agenda = Agenda::findOrFail($id);

        // Hapus file gambar jika ada
        if ($agenda->gambar && File::exists(public_path($agenda->gambar))) {
            File::delete(public_path($agenda->gambar));
        }

        $agenda->delete();

        return redirect()->route('admin.agenda.index')
            ->with('success', 'Agenda kegiatan berhasil dihapus!');
    }
}
