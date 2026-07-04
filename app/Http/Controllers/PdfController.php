<?php

namespace App\Http\Controllers;

use App\Models\Agenda;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class PdfController extends Controller
{
    /**
     * Ekspor daftar agenda kegiatan ke format PDF.
     */
    public function exportPdf()
    {
        $agendas = Agenda::orderBy('tanggal_kegiatan', 'asc')->get();
        
        // Konfigurasi opsi PDF
        $pdf = Pdf::loadView('admin.agenda.pdf', compact('agendas'))
                  ->setPaper('a4', 'landscape'); // Gunakan landscape agar kolom luas
                  
        return $pdf->stream('laporan-agenda-kegiatan-' . date('Ymd_His') . '.pdf');
    }
}
