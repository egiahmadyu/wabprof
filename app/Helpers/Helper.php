<?php

namespace App\Helpers;

use App\Models\HistoryPelanggar;

class Helper
{
    public static function saveHistory($status, $pelanggar_id)
    {
        HistoryPelanggar::create(
            [
                'pelanggar_id' => $pelanggar_id,
                'status' => $status,
                'start_date' => date('Y-m-d H:i:s')
            ]
        );
        HistoryPelanggar::where('pelanggar_id', $pelanggar_id)->where('status', $status - 1)
            ->update([
                'end_date' => date('Y-m-d H:i:s')
            ]);
    }
}
