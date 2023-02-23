<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Disposisi extends Model
{
    use HasFactory;
    protected $fillable = [
        'data_pelanggar_id',
        'no_agenda',
        'surat_dari',
        'nomor_surat',
        'tanggal_surat',
        'type'
    ];
}