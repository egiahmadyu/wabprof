<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Saksi extends Model
{
    use HasFactory;
    protected $fillable = [ 'data_pelanggar_id','nama','id_pangkat','jabatan','nrp','kesatuan' ];

    public function pangkat()
    {
        return $this->belongsTo(Pangkat::class, 'id_pangkat');
    }
}
