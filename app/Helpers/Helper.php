<?php

namespace App\Helpers;

use App\Models\HistoryPelanggar;

class Helper
{
    public static function saveHistory($status, $pelanggar_id)
    {
        HistoryPelanggar::where('pelanggar_id', $pelanggar_id)
            ->whereNull('end_date')
            ->update([
                'end_date' => date('Y-m-d H:i:s')
            ]);
        HistoryPelanggar::create(
            [
                'pelanggar_id' => $pelanggar_id,
                'status' => $status,
                'start_date' => date('Y-m-d H:i:s')
            ]
        );
    }
}
