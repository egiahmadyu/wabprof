<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KeputusanAdministratif extends Model
{
    use HasFactory;
    protected $fillable = [
        'keputusan', 'tipe_sidang', 'data_pelanggar_id'
    ];
}
