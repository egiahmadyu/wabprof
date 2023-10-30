<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Models\Timeline;
use App\Models\Penyidik;
use App\Models\DataPelanggar;
use App\Models\Dihentikan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use DataTables;

class TimelineController extends Controller
{

    public function store(Request $request)
    {
        $DP = Timeline::create([
            'data_pelanggar_id' => $request->kasus_id,
            'penyidik_id' => $request->penyidik,
            'tanggal_klasifikasi' => $request->tanggal_klasifikasi,
            'status' => $request->status,
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
                    'status_id' => $request->saran_pendapat_klasifikasi
                ]);
            $DP->next_status = $request->saran_pendapat_klasifikasi;
            $DP->save();
            Helper::saveHistory($request->saran_pendapat_klasifikasi, $request->kasus_id);
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

    public function data(Request $request)
    {
        $query = Pangkat::select('*')->orderBy('id', 'desc')->get();

        return Datatables::of($query)->addColumn('action', function ($row) {
            return '<a href="' . route('pangkat.edit', [$row->id]) . '" class="btn btn-info btn-circle"
                  data-toggle="tooltip" data-original-title="Edit"><i class="fa fa-pencil" aria-hidden="true"></i></a>

                  <button type="button" onclick="hapus(' . $row->id . ')" class="btn btn-danger btn-circle sa-params"
                  data-toggle="tooltip" data-user-id="' . $row->id . '" data-original-title="Delete"><i class="fa fa-times" aria-hidden="true"></i></button>';
        })->make(true);
    }

    public function updateData(Request $request)
    {
        $data_pangkat = Pangkat::where('id', $request->id)->first();
        $data_pangkat->update([
            'name' => $request->name,
        ]);

        return redirect()->action([PangkatController::class, 'index']);
    }

    public function hapusData($id)
    {
        Pangkat::where('id', $id)
            ->delete();
    }
}
