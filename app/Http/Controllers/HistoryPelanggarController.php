<?php

namespace App\Http\Controllers;

use App\Models\DataPelanggar;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class HistoryPelanggarController extends Controller
{
    public function index()
    {
        return view('pages.history_pelanggar.index');
    }

    public function data(Request $request)
    {
        $query = DataPelanggar::with('processes', 'pangkats', 'history_pelanggars');

        return DataTables::of($query)
        ->editColumn('pangkats.name', function($data) {
            return $data->id_pangkat ? $data->pangkats->name : 'Data Pangkat Tidak Terkirim Dari Yanduan';

        })->addColumn('timeline', function ($data) {
                $html = '<ul class="timeline">';
                foreach ($data->history_pelanggars as $key => $value) {
                    $list = $key + 1;
                    $html = $html . ' <li>
                    <div>
                      <time datetime="2018-10-09">' . date('d-m-Y', strtotime($value->start_date)) . '</time>
                      <p>' . $value->processes->name . '</p>
                    </div>
                  </li>';
                }
                $html = $html . '
                </ul>';
                return $html;
            })->setRowAttr([
                'style' => function ($data) {
                    return $data->status_dihentikan == 1 ? 'background-color: red;color:white' : '';
                }
            ])
            ->rawColumns(['timeline'])
            ->make(true);
    }
}
