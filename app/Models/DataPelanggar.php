<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataPelanggar extends Model
{
    use HasFactory;

    protected $fillable = [
        'no_nota_dinas', 'no_pengaduan', 'pelapor', 'umur', 'jenis_kelamin', 'pekerjaan', 'agama', 'suku', 'agama_terlapor', 'jabatan', 'nrp',
        'alamat', 'no_identitas', 'jenis_identitas', 'terlapor', 'kesatuan', 'tempat_kejadian', 'tanggal_kejadian', 'kronologi', 'alamat_terlapor',
        'id_pangkat', 'nama_korban', 'status_id', 'no_telp', 'kewarganegaraan', 'perihal_nota_dinas', 'tanggal_nota_dinas',
        'id_wujud_perbuatan', 'tempat_lahir', 'tanggal_lahir', 'no_hp', 'pendidikan_terakhir', 'alamat_tempat_tinggal', 'status_dihentikan', 'pengaduan_dari', 'created_by'
    ];


    public function sidang_kepps()
    {
        return $this->hasOne(SidangKepp::class, 'data_pelanggar_id', 'id');
    }

    public function sidang_bandings()
    {
        return $this->hasOne(SidangBanding::class, 'data_pelanggar_id', 'id');
    }

    public function sidang_peninjauans()
    {
        return $this->hasOne(SidangPeninjauan::class, 'data_pelanggar_id', 'id');
    }

    public function total_dihentikan()
    {
        return 12000;
    }

    public function history_pelanggars()
    {
        return $this->hasMany(HistoryPelanggar::class, 'pelanggar_id', 'id')->orderBy('created_at', 'asc');
    }

    public function status()
    {
        return $this->hasOne(Process::class, 'id', 'status_id');
    }

    public function processes()
    {
        return $this->hasOne(Process::class, 'id', 'status_id');
    }

    public function religi()
    {
        return $this->hasOne(Agama::class, 'id', 'agama');
    }

    public function religi_terlapor()
    {
        return $this->hasOne(Agama::class, 'id', 'agama_terlapor');
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

    public function pangkats()
    {
        return $this->belongsTo(Pangkat::class, 'id_pangkat');
    }

    public function wujud_perbuatan()
    {
        return $this->belongsTo(WujudPerbuatan::class, 'id_wujud_perbuatan');
    }
}
