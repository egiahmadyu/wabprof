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
        $query = DataPelanggar::orderBy('id', 'desc')->with('processes', 'pangkats', 'history_pelanggars');

        return DataTables::of($query)
            ->addColumn('timeline', function ($data) {
                $html = '<ul class="timeline">';
                foreach ($data->history_pelanggars as $key => $value) {
                    $list = $key + 1;
                    $html = $html . '<li class="base-timeline__item base-timeline__item--data"
                    data-year="' . $list . '">
                  <span class="base-timeline__summary-text">' . $value->processes->name . '</span>
                </li>';
                }
                $html = $html . '
                </ul>';
                //     $html = '<ul class="base-timeline">

                //     <li class="base-timeline__item base-timeline__item--data base-timeline__item--active"         data-year="2019">
                //       <span class="base-timeline__summary-text">two</span>
                //     </li>
                //     <li class="base-timeline__item base-timeline__item--data"
                //         data-year="2018">
                //       <span class="base-timeline__summary-text">three</span>
                //     </li>
                //     <li class="base-timeline__item base-timeline__item--data"
                //         data-year="2017">
                //       <span class="base-timeline__summary-text">four</span>
                //     </li>
                //   </ul>';
                return $html;
            })
            ->rawColumns(['timeline'])
            ->make(true);
    }
}
