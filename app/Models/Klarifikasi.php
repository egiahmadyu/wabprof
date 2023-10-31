<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Klarifikasi extends Model
{
    use HasFactory;
    protected $fillable = ['data_pelanggar_id', 'penyidik_id', 'tanggal_klarifikasi', 'status', 'next_status', 'tim'];

    public function dihentikan()
    {
        return $this->hasOne(Dihentikan::class, 'data_pelanggar_id', 'data_pelanggar_id');
    }

    public function penyidik()
    {
        return $this->hasOne(Penyidik::class, 'id', 'penyidik_id');
    }
}
