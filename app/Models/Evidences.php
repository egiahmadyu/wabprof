<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evidences extends Model
{
    use HasFactory;
    protected $fillable = [
        'data_pelanggar_id', 'file_path'
    ];
}