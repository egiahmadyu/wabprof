<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DataPelanggar;
use App\Models\WujudPerbuatan;

class LimpahWabprofController extends Controller
{
    public function limpah_wabprof(Request $request)
    {
       try {
        $wp = WujudPerbuatan::where('jenis_wp', 'kode etik')
        ->where('keterangan_wp', $request->wujud_perbuatan)
        ->first();
        $insert = [
            'no_nota_dinas' => $request->no_nota_dinas,
            'perihal_nota_dinas' => $request->perihal_nota_dinas,
            'tanggal_nota_dinas' => $request->tanggal_nota_dinas,
            'wujud_perbuatan' => $wp ? $wp->id : null,
            'pelapor' => $request->pelapor,
            'jenis_kelamin' => $request->jenis_kelamin,
            'no_telp' => $request->no_telp,
            'alamat' => $request->alamat,
            'pekerjaan' => $request->pekerjaann,
            'no_identitas' => $request->no_identitas,
            'jenis_identitas' => $request->jenis_identitas,
            'terlapor' => $request->terlapor,
            'agama' => $request->agama,
            'umur' => $request->umur,
            'pekerjaan' => $request->pekerjaan,
            'no_hp' => $request->no_hp_terlapor,
            'kesatuan' => $request->wilayah_hukum,
            'nrp' => $request->nrp,
            'tempat_kejadian' => $request->tempat_kejadian,
            'tanggal_kejadian' => $request->tanggal_kejadian,
            'id_pangkat' => $request->pangkat,
            'jabatan' => $request->jabatan,
            'wilayah_hukum' => $request->wilayah_hukum,
            'nama_korban' => $request->nama_korban,
            'id_card' => $request->id_card,
            'selfie' => $request->selfie,
            'pengaduan_dari' => 'BIRO PAMINAL',
            'status_id' => 1,
            'no_pengaduan' => time()
        ];
        if ($request->kronologi) {
            $insert['kronologi'] = $request->kronologi;
        }

        if ($request->fakta_fakta) {
            $insert['fakta_fakta'] = $request->fakta_fakta;
        }

        if ($request->catatan) {
            $insert['catatan'] = $request->catatan;
        }

        if ($request->pendapat_pelapor) {
            $insert['pendapat_pelapor'] = $request->pendapat_pelapor;
        }

        $pelanggar = DataPelanggar::create($insert);

        return response()->json([
            'status' => 200,
            'data' => $pelanggar,
            'message' => 'insert data berhasil'
        ]);
       } catch (\Throwable $th) {
        //throw $th;
        return response()->json([
            'status' => 500,
            'message' => $th->getMessage()
        ]);
       }
    }
}
