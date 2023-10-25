<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wawancara extends Model
{
    use HasFactory;
    protected $fillable = ['data_pelanggar_id', 'tanggal', 'jam', 'ruangan', 'alamat', 'id_penyidik', 'nomor_handphone', 'nomor_surat'];

    public function penyidiks()
    {
        return $this->hasOne(Penyidik::class, 'id', 'id_penyidik');
    }
}
