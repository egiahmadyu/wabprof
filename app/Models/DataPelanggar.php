<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataPelanggar extends Model
{
    use HasFactory;

    protected $fillable = [
        'no_nota_dinas', 'no_pengaduan', 'pelapor', 'umur', 'jenis_kelamin', 'pekerjaan', 'agama','suku', 'agama_terlapor', 'jabatan', 'nrp',
        'alamat', 'no_identitas', 'jenis_identitas', 'terlapor', 'kesatuan', 'tempat_kejadian','tanggal_kejadian', 'kronologi','alamat_terlapor',
        'id_pangkat', 'nama_korban', 'status_id', 'no_telp', 'kewarganegaraan', 'perihal_nota_dinas', 'tanggal_nota_dinas',
        'id_wujud_perbuatan', 'tempat_lahir', 'tanggal_lahir','no_hp','pendidikan_terakhir','alamat_tempat_tinggal'
    ];

    public function status()
    {
        return $this->hasOne(Process::class, 'id', 'status_id');
    }

    public function religi()
    {
        return $this->hasOne(Agama::class, 'id', 'agama');
    }

    public function identitas()
    {
        return $this->hasOne(JenisIdentitas::class, 'id', 'jenis_identitas');
    }

    public function penyidik()
    {
        return $this->hasMany('penyidik');
    }

    public function pangkat()
    {
        return $this->belongsTo(Pangkat::class, 'id_pangkat');
    }

    public function wujud_perbuatan()
    {
        return $this->belongsTo(WujudPerbuatan::class, 'id_wujud_perbuatan');
    }
}