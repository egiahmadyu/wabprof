<?php

namespace App\Http\Controllers;

use App\Models\DataPelanggar;
use App\Models\Penyidik;
use App\Models\Polda;
use App\Models\SprinHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $data['polda'] = Polda::get();
        $data['pelanggar'] = DataPelanggar::get();
        $data['pelanggar_dihentikan'] = DataPelanggar::where('status_dihentikan', 1)->get();;
        $data['pengaduan_diproses'] = $data['pelanggar']->where('status', '>', 1);
        $data['chart_pelanggaran'] = DataPelanggar::groupBy(DB::raw("DATE_TRUNC('month', created_at), TO_CHAR(created_at, 'Month')"))
            ->select(DB::raw("DATE_TRUNC('month', created_at) as bulan, count(id) as value, TO_CHAR(created_at, 'Month') as nama_bulan"))
            ->orderBy(DB::raw("DATE_TRUNC('month', created_at)"), 'asc')
            ->get();
        $sprin = Penyidik::groupBy('tim')
            ->select('tim as name')
            ->get();
        foreach ($sprin as $key => $value) {
            $children = SprinHistory::where('tim', $value->name)
                ->join('data_pelanggars', 'data_pelanggars.id', 'sprin_histories.data_pelanggar_id')
                ->select('terlapor as name', DB::raw('0+1 as value'))->get();
            $value->children = $children;
        }
        $data['penyidik'] = $sprin;
        $data['polda'] = DataPelanggar::groupBy('kesatuan')
            ->select(DB::raw('count(id) as value'), 'kesatuan')
            ->orderBy(DB::raw('count(id)'), 'desc')
            ->get();
        return view('pages.dashboard.index', $data);
    }
}
