<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SidangBanding extends Model
{
    use HasFactory;
    protected $fillable = [
        'data_pelanggar_id', 'tgl_sidang', 'jam_sidang', 'pakaian_sidang', 'tempat_sidang', 'kehadiran', 'putusan_sidang', 'keputusan_terbukti', 'keputusan_sidang', 'tanggal_permohonan_sidang_banding', 'tanggal_memori_banding'
    ];

    public function keputusan_etiks()
    {
        return $this->hasMany(KeputusanEtik::class, 'data_pelanggar_id', 'data_pelanggar_id')->where('tipe_sidang', 'sidang_banding');
    }

    public function administratif()
    {
        return $this->hasMany(KeputusanAdministratif::class, 'data_pelanggar_id', 'data_pelanggar_id')->where('tipe_sidang', 'sidang_banding');
    }
}
