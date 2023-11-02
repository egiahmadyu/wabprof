<?php

namespace App\Http\Controllers;

use App\Models\DataPelanggar;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class KelolaSidangController extends Controller
{
    public function index()
    {
        return view('pages.kelola_sidang.index');
    }

    public function data(Request $request)
    {
        $query = DataPelanggar::with('sidang_kepps', 'sidang_bandings')
            ->where('status_id', 7);

        return DataTables::of($query)
            ->addColumn('terduga', function ($data) {
                $html = '
                <p>Nama Terduga : ' . $data->terlapor . '</p>
                <p>NRP : ' . $data->nrp . '</p>
                ';
                return $html;
            })->addColumn('sidang_1', function ($data) {
                if (!$data->sidang_kepps) return '<div class="alert alert-warning" role="alert">
                Data Belum Ada.
                 </div>';
                $html = '
                <p>Jadwal Sidang : ' . Carbon::parse($data->sidang_kepps->tgl_sidang)->translatedFormat('d F Y') . ' - ' . $data->sidang_kepps->jam_sidang . '</p>
                <p>Tempat : ' . $data->sidang_kepps->tempat_sidang . '</p>
                <p>Terduga ' . $data->terlapor . ' ' . $data->sidang_kepps->kehadiran . '</p>
                <p>Keputusan : ' . $data->sidang_kepps->putusan_sidang . '</p>
                ';
                if ($data->sidang_kepps->putusan_sidang) {
                    $html .= '<span class="badge bg-success">Selesai</span>';
                }
                return $html;
            })
            ->addColumn('sidang_2', function ($data) {
                if (!$data->sidang_bandings) return '<div class="alert alert-warning" role="alert">
                Data Belum Ada.
                 </div>';
                $html = '
                <p>Jadwal Sidang : ' . Carbon::parse($data->sidang_bandings->tgl_sidang)->translatedFormat('d F Y') . ' - ' . $data->sidang_bandings->jam_sidang . '</p>
                <p>Tempat : ' . $data->sidang_bandings->tempat_sidang . '</p>
                <p>Terduga ' . $data->terlapor . ' ' . $data->sidang_bandings->kehadiran . '</p>
                <p>Keputusan : ' . $data->sidang_bandings->putusan_sidang . '</p>
                ';
                if ($data->sidang_bandings->putusan_sidang) {
                    $html .= '<span class="badge bg-success">Selesai</span>';
                }
                return $html;
            })
            ->addColumn('sidang_3', function ($data) {
                if (!$data->sidang_peninjauans) return '<div class="alert alert-warning" role="alert">
                Data Belum Ada.
                 </div>';
                $html = '
                <p>Jadwal Sidang : ' . Carbon::parse($data->sidang_peninjauans->tgl_sidang)->translatedFormat('d F Y') . ' - ' . $data->sidang_peninjauans->jam_sidang . '</p>
                <p>Tempat : ' . $data->sidang_peninjauans->tempat_sidang . '</p>
                <p>Terduga ' . $data->terlapor . ' ' . $data->sidang_peninjauans->kehadiran . '</p>
                <p>Keputusan : ' . $data->sidang_peninjauans->putusan_sidang . '</p>
                ';
                if ($data->sidang_peninjauans->putusan_sidang) {
                    $html .= '<span class="badge bg-success">Selesai</span>';
                }
                return $html;
            })
            ->addColumn('action', function ($data) {
                $html = '<a href="/data-kasus/detail/' . $data->id . '"><button class="btn btn-primary">Kelola Sidang</button></a>';
                return $html;
            })
            ->rawColumns(['terduga', 'sidang_1', 'sidang_2', 'sidang_3', 'action'])
            ->make(true);
    }
}
