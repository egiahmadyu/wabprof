<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Timeline extends Model
{
    use HasFactory;
    protected $fillable = [ 'data_pelanggar_id','penyidik_id','tanggal_klasifikasi','status' ];
}
