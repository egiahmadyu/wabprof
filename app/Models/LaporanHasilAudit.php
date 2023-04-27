<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaporanHasilAudit extends Model
{
    use HasFactory;
    protected $fillable = [ 'data_pelanggar_id' ,'nomor_laporan', 'tanggal_laporan','hasil' ];
}