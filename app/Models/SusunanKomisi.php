<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SusunanKomisi extends Model
{
    use HasFactory;
    protected $fillable = [ 'data_pelanggar_id','pangkat','nama','nrp','jabatan'];
}
