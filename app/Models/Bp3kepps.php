<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bp3kepps extends Model
{
    use HasFactory;
    protected $fillable = [ 'data_pelanggar_id','tanggal','nomor','pangkat','nama','nrp','jabatan','kesatuan'];
}
