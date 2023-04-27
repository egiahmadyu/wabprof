<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SprinHistory extends Model
{
    use HasFactory;

    protected $fillable = [ 'data_pelanggar_id', 'no_sprin', 'tanggal_investigasi', 'tempat_investigasi','tim'];

    public function penyidik()
    {
        return $this->belongsTo(Penyidik::class, 'tim');
    }
}