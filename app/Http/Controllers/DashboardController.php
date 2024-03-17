<?php

namespace App\Http\Controllers;

use App\Models\DataPelanggar;
use App\Models\Penyidik;
use App\Models\Polda;
use App\Models\SprinHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $data['polda'] = Polda::get();
        $data['pelanggar'] = DataPelanggar::get();
        $data['pelanggar_dihentikan'] = DataPelanggar::where('status_dihentikan', 1)->get();;
        $data['pengaduan_diproses'] = $data['pelanggar']->where('status', '>', 1);
        $data['chart_pelanggaran'] = DataPelanggar::groupBy(DB::raw("TO_CHAR(created_at, 'YYYY-MM'), TO_CHAR(created_at, 'Month')"))
            ->select(DB::raw("TO_CHAR(created_at, 'YYYY-MM') as bulan, count(id) as value, TO_CHAR(created_at, 'Month') as nama_bulan"))
            ->orderBy(DB::raw("TO_CHAR(created_at, 'YYYY-MM')"), 'asc')
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

    public function getDataChart($tipe, Request $request)
    {
        try {
            if ($tipe == 'trend_dumas') {
                $data = $this->getTrendDumas();
            } elseif ($tipe == 'statistik_bulanan') {
                $data = $this->getStatistikBulanan();
            } elseif ($tipe == 'rekap_dumas') {
                $data = $this->DataTriwulanSemester($request->value);
            }

            return response()->json([
                'status' => 200,
                'data' => $data
            ]);
        } catch (InvalidOrderException $e) {
            return response()->json([
                'status' => 500,
                'message' => $e->getMessage()
            ]);
        }
    }

    public function getDataTriwulanSemester()
    {
        // Triwullan
        $value = array_fill(1, 4, '');
        $label = array_fill(1, 4, '');
        $m_temp = 1;
        for ($i = 1; $i <= 4; $i++) {
            # code...
            $m = $i * 3;
            $from = Carbon::now()->month($m_temp)->firstOfMonth();
            $to = Carbon::now()->month($m)->lastOfMonth();
            $res = DataPelanggar::whereBetween('created_at', [$from, $to])->count();
            $value[$i] = $res;
            $label[$i] = 'T' . $i . ' : ' .  $from->isoFormat('MMMM') . ' - ' . $to->isoFormat('MMMM');
            $m_temp = $m + 1;
        }
        $tipe = 'triwulan';
        $triwulan = [$value, $label, $tipe];
        //End Triwulan

        //Semester
        $value = array_fill(1, 2, '');
        $label = array_fill(1, 2, '');
        $s_temp = 1;
        for ($i = 1; $i <= 2; $i++) {
            # code...
            $s = $i * 6;
            $from = Carbon::now()->month($s_temp)->firstOfMonth();
            $to = Carbon::now()->month($s)->lastOfMonth();
            $res = DataPelanggar::whereBetween('created_at', [$from, $to])->count();
            $value[$i] = $res;
            $label[$i] = 'S' . $i . ' : ' . $from->isoFormat('MMMM') . ' - ' . $to->isoFormat('MMMM');
            $s_temp = $s + 1;
        }
        $tipe = 'semester';
        $semester = [$value, $label, $tipe];
        // End Semester

        //Tahunan
        $value = array_fill(1, 12, '');
        $label = array_fill(1, 12, '');
        for ($i = 1; $i <= 12; $i++) {
            # code...
            $from = Carbon::now()->month($i)->firstOfMonth();
            $to = Carbon::now()->month($i)->lastOfMonth();
            $res = DataPelanggar::whereBetween('created_at', [$from, $to])->count();
            $value[$i] = $res;
            $label[$i] = Carbon::now()->month($i)->isoFormat('MMM');
        }
        $tipe = 'tahunan';
        $tahunan = [$value, $label, $tipe];
        //End Tahunan


        $result = [
            'triwulan' => $triwulan,
            'semester' => $semester,
            'tahunan' => $tahunan,
        ];
        return $result;
    }

    public function DataTriwulanSemester($tipe)
    {
        Carbon::setLocale('id');
        $result = $this->getDataTriwulanSemester();

        return $result;
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
