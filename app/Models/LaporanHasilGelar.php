<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaporanHasilGelar extends Model
{
    use HasFactory;
    protected $fillable = ['data_pelanggar_id', 'tanggal_laporan_gelar', 'nama_pimpinan_gelar', 'pangkat_pimpinan_gelar', 'jabatan_pimpinan_gelar', 'kesatuan_pimpinan_gelar', 'id_penyidik_pemapar', 'id_penyidik_pembuat', 'bukti', 'pasal_dilanggar', 'kategori_pelanggaran', 'catatan'];
}
