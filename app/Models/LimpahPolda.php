<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LimpahPolda extends Model
{
    use HasFactory;

    protected $fillable = [
        'data_pelanggar_id', 'polda_id', 'tanggal_limpah', 'created_by', 'nomor_limpah', 'alamat_polda', 'nomor_klarifikasi', 'tanggal_klarifikasi','perihal_klarifikasi'
    ];

    public function polda()
    {
        return $this->hasOne(Polda::class, 'id', 'polda_id');
    }

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'created_by');
    }
}