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
        $data['chart_pelanggaran'] = DataPelanggar::groupBy(DB::raw("TO_CHAR(created_at, 'Month'), TO_CHAR(created_at, 'Month')"))
            ->select(DB::raw("TO_CHAR(created_at, 'Month') as bulan, count(id) as value, TO_CHAR(created_at, 'Month') as nama_bulan"))
            ->orderBy(DB::raw("TO_CHAR(created_at, 'Month')"), 'asc')
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
        $data['semester_1'] = DataPelanggar::where('created_at', '>=', date('Y') . '-01-01')
            ->where('created_at', '<=', date('Y') . '-06-30')->count();
        $data['semester_2'] = DataPelanggar::where('created_at', '>=', date('Y') . '-07-01')
            ->where('created_at', '<=', date('Y') . '-12-31')->count();
        return view('pages.dashboard.index', $data);
    }


    private function semester_chart()
    {
        $semester_1 = DataPelanggar::where('created_at', '>=', date('Y') . '-01-01')
            ->where('created_at', '<=', date('Y') . '-06-30');
        $semester_2 = DataPelanggar::where('created_at', '>=', date('Y') . '-07-01')
            ->where('created_at', '<=', date('Y') . '-12-31');

        return [
            $semester_1, $semester_2
        ];
    }
}
