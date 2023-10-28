<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemberkasan extends Model
{
    use HasFactory;
    protected $fillable = [
        'data_pelanggar_id', 'no_bp3kepp', 'tgl_bp3kepp', 'no_nota_dinas_administrasi', 'tgl_nota_dinas_administrasi', 'tgl_sidang', 'jam_sidang', 'pakaian_sidang', 'tempat_sidang', 'no_nota_dinas_penyerahan', 'tgl_nota_dinas_penyerahan', 'no_nota_dinas_perbaikan', 'tgl_nota_dinas_perbaikan'
    ];
}
