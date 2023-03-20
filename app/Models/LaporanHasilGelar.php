<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaporanHasilGelar extends Model
{
    use HasFactory;
    protected $fillable = [ 'data_pelanggar_id' ,'tanggal_laporan_gelar', 'nama_pimpinan_gelar', 'pangkat_pimpinan_gelar', 'jabatan_pimpinan_gelar', 'kesatuan_pimpinan_gelar','nama_pemapar', 'pangkat_pemapar','jabatan_pemapar','kesatuan_pemapar', 'nrp_pembuat','nama_pembuat', 'pangkat_pembuat' ];
}