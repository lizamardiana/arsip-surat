<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuratMasuk extends Model
{
    use HasFactory;

    protected $table = 'surat_masuk'; // pastikan nama tabel sesuai di database

    protected $fillable = [
        'pengirim',
        'no_surat',
        'perihal',
        'tanggal_surat',
        'tanggal_masuk',
        'file_upload',
    ];
}
