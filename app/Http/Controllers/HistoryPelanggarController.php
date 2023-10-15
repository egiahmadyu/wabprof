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
            ->addColumn('timeline', function ($data) {
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
                //     $html = '<ul class="timeline">
                //     <li>
                //       <div>
                //         <time datetime="2018-10-09">October 9, 2018</time>
                //         <p>description event #1</p>
                //       </div>
                //     </li>
                //     <li>
                //       <div>
                //         <time datetime="2018-10-09">October 9, 2018</time>
                //         <p>description event #2</p>
                //       </div>
                //     </li>
                //     <li>
                //       <div>
                //         <time datetime="2018-10-09">October 9, 2018</time>
                //         <p>description event #3</p>
                //       </div>
                //     </li>
                //     <li>
                //       <div>
                //         <time datetime="2018-10-09">October 9, 2018</time>
                //         <p>description event #4</p>
                //       </div>
                //     </li>
                //     <li>
                //       <div>
                //         <time datetime="2018-10-09">October 9, 2018</time>
                //         <p>description event #5</p>
                //       </div>
                //     </li>
                //     <li>
                //       <div>
                //         <time datetime="2018-10-09">October 9, 2018</time>
                //         <p>description event #6</p>
                //       </div>
                //     </li>
                //   </ul>
                //   ';
                return $html;
            })
            ->rawColumns(['timeline'])
            ->make(true);
    }
}
