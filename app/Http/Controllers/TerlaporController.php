<?php

namespace App\Http\Controllers;

use App\Models\Terlapor;
use Illuminate\Http\Request;

class TerlaporController extends Controller
{
    public function tambah_terlapor(Request $request)
    {
        $nrp = $request->nrp;
        $nama = $request->nama;
        $pangkat = $request->pangkat;
        $jabatan = $request->jabatan;
        $kesatuan = $request->kesatuan;

        for ($i = 0; $i < count($nrp); $i++) {
            Terlapor::create([
                'nama' => $nama[$i],
                'nrp' => $nrp[$i],
                'pangkat' => $pangkat[$i],
                'jabatan' => $jabatan[$i],
                'kesatuan' => $kesatuan[$i],
                'data_pelanggar_id' => $request->data_pelanggar_id,
            ]);
        }

        return redirect()->back();
    }
}
