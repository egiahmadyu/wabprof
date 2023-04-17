<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pangkat extends Model
{
    use HasFactory;
    protected $fillable = ['name'];

    public function penyidik()
    {
        return $this->hasMany(Penyidik::class);
    }
}