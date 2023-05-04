<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bap extends Model
{
    use HasFactory;
    protected $fillable = [
        'data_pelanggar_id',
        'tanggal_pemeriksaan',
        'jam_pemeriksaan',
    ];
}