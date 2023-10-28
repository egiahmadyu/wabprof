<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penuntutan extends Model
{
    use HasFactory;
    protected $fillable = [
        'data_pelanggar_id', 'no_divkum', 'tanggal_divkum', 'no_usulan_pembentukan_komisi', 'no_pembentukan_komisi', 'no_pendamping_divkum', 'no_panggilan_pelanggar', 'no_panggilan_pelanggar_satker', 'no_panggilan_saksi_anggota', 'no_panggilan_saksi_ahli_ssdm', 'no_surat_daftar_terlampir'
    ];
}
