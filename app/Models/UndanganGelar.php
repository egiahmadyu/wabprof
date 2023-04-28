<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UndanganGelar extends Model
{
    use HasFactory;
    protected $fillable = [ 'data_pelanggar_id' ,'nomor_gelar', 'tanggal_gelar', 'tempat_gelar', 'jam_gelar', 'id_penyidik','nomor_handphone' ];
}