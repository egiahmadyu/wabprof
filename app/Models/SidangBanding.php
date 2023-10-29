<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SidangBanding extends Model
{
    use HasFactory;
    protected $fillable = [
        'data_pelanggar_id', 'tgl_sidang', 'jam_sidang', 'pakaian_sidang', 'tempat_sidang', 'kehadiran', 'putusan_sidang', 'keputusan_terbukti', 'keputusan_sidang', 'tanggal_permohonan_sidang_banding'
    ];
}
