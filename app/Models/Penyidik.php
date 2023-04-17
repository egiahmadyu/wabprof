<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penyidik extends Model
{
    use HasFactory;
    protected $fillable = [ 'data_pelanggar_id' ,'name', 'nrp', 'id_pangkat', 'jabatan', 'tim', 'unit' ];

    public function dataPelanggar()
    {
        return $this->belongsTo(DataPelanggar::class, 'data_pelanggar_id');
    }

    public function pangkat()
    {
        return $this->belongsTo(Pangkat::class, 'id_pangkat');
    }
}