<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Models\DataPelanggar;
use App\Models\Dihentikan;
use App\Models\Klarifikasi;
use App\Models\Penyidik;
use Illuminate\Http\Request;

class KlarifikasiController extends Controller
{
    public function store(Request $request)
    {
        $DP = Klarifikasi::create([
            'data_pelanggar_id' => $request->kasus_id,
            'penyidik_id' => $request->penyidik,
            'tanggal_klarifikasi' => $request->tanggal_klarifikasi,
            'status' => $request->status,
            'tim' => $request->tim,
        ]);
        if ($DP->status == 'Ditolak') {
            $DP->next_status = $request->saran_ditolak;
            $DP->save();
            $pelanggar = DataPelanggar::where('id', $request->kasus_id)->first();
            $pelanggar->status_dihentikan = 1;
            $pelanggar->save();
            Dihentikan::create([
                'data_pelanggar_id' => $request->kasus_id,
                'note' => $request->catatan_berhenti ?? 'Dilimpahkan Ke Polda'
            ]);
            Helper::saveHistory($request->saran_ditolak, $request->kasus_id);
            return redirect()->back();
        }

        if ($DP) {
            $data_pelanggar = DataPelanggar::where('id', $request->kasus_id)
                ->update([
                    'status_id' => $request->saran_pendapat_klarifikasi
                ]);
            $DP->next_status = $request->saran_pendapat_klarifikasi;
            $DP->save();
            Helper::saveHistory($request->saran_pendapat_klarifikasi, $request->kasus_id);
            if ($data_pelanggar) {
                return redirect()->back();
            }
        } else {
            echo 'terjadi kesalahan';
        }
    }

    public function viewPenyidik($tim)
    {
        $penyidik = Penyidik::where('tim', $tim)->get();

        $data = [
            'penyidiks' => $penyidik,
        ];
        return $data;
    }
}
