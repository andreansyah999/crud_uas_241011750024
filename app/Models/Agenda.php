<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Attributes\Fillable;

#[Fillable(['nama_kegiatan', 'gambar', 'tanggal_kegiatan', 'lokasi', 'penyelenggara', 'agenda'])]
class Agenda extends Model
{
    protected function casts(): array
    {
        return [
            'tanggal_kegiatan' => 'date',
        ];
    }
}
