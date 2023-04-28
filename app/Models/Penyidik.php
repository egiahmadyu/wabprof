<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penyidik extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'nrp', 'id_pangkat', 'jabatan', 'tim', 'unit', 'kesatuan', 'fungsional' ];

    public function pangkat()
    {
        return $this->belongsTo(Pangkat::class, 'id_pangkat');
    }

    public function sprin()
    {
        return $this->hasMany(SprinHistory::class);
    }
}