<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistoryPelanggar extends Model
{
    use HasFactory;
    protected $fillable = [
        'pelanggar_id', 'status', 'start_date', 'end_date'
    ];

    public function processes()
    {
        return $this->hasOne(Process::class, 'id', 'status');
    }
}
