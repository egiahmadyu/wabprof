<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permohonan extends Model
{
    use HasFactory;
    protected $fillable = [ 'data_pelanggar_id','bp3kepp_id','nomor', 'tanggal', 'pasal'];
}
