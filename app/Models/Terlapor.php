<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Terlapor extends Model
{
    use HasFactory;

    protected $fillable = [
        'nrp', 'nama', 'pangkat', 'kesatuan', 'jabatan', 'data_pelanggar_id'
    ];
}
