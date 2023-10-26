<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SprinRiksa extends Model
{
    use HasFactory;
    protected $fillable = [
        'nomor_surat', 'data_pelanggar_id', 'tanggal_surat'
    ];
}
