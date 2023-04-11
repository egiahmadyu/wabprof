<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PembentukanKomisi extends Model
{
    use HasFactory;
    protected $fillable = [ 'data_pelanggar_id','bp3kepp_id','nomor', 'nomor_surat_divkum', 'tanggal_surat_divkum', 'pangkat','nama','jabatan','kesatuan'];
}
