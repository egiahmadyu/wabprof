<?php

namespace App\Http\Controllers;

use App\Integrations\Yanduan;
use App\Models\DataPelanggar;
use App\Models\Pangkat;
use App\Models\Evidences;
use Illuminate\Http\Request;

class YanduanController extends Controller
{
    public function import_data(Request $request)
    {
        $yanduan = new Yanduan();
        if ($yanduan->getToken() == null) {
            return response()->json([
                'status' => 500,
                'message' => 'Terjadi Kesalahan Pada Serssver'
            ]);
        }
        $body = [
            'release_date_from' => $request->tanggal_mulai,
            'release_date_to' => $request->tanggal_akhir
        ];
        $data = $yanduan->processed_reports($body);
        if ($data['status'] !== 200) {
            return response()->json([
                'status' => 500,
                'message' => 'Terjadi Kesalahan Pada Server'
            ]);
        }
        $data_dumas = $data['response'];
        if (count($data_dumas->data) == 0) {
            return response()->json([
                'status' => 200,
                'total_import' => 0
            ]);
        }
        $import = 0;
        foreach ($data_dumas->data as $key => $value) {
            if ($value->biro == 'BIRO WABPROF') {
                if (!DataPelanggar::where('no_pengaduan', $value->ticket_id)->first()) {
                    $str = strip_tags($value->chronology);
                    $kronologi = preg_replace("/\n|\r/", " ", "$str");
                    $data['kronologi'] = $kronologi;
                    $data['status_id'] = 1;
                    $data['pelapor'] = $value->reporter->name;
                    $data['jenis_kelamin'] = $value->reporter->gender ? ($value->reporter->gender == 'LAKI-LAKI' ? 1 : 2) : null;
                    $data['no_identitas'] = $value->reporter->identity_number ?? '-';
                    $data['jenis_identitas'] = 1;
                    $data['alamat'] = $value->reporter->alamat ?? '-';
                    $data['pekerjaan'] = $value->reporter->occupation ?? '-';
                    $data['no_pengaduan'] = $value->ticket_id;
                    $data['nama_korban'] = count($value->victims) > 0 ? $value->victims[0]->name : '-';
                    $data['perihal_nota_dinas'] = strtoupper($value->perihal_nota_dinas);
                    $data['no_nota_dinas'] = $value->nomor_nota_dinas;
                    $data['tanggal_nota_dinas'] = $value->tanggal_nota_dinas == '-' ? date('Y-m-d') :  $value->tanggal_nota_dinas;
                    $data['tempat_kejadian'] = count($value->crime_scenes) > 0 ? $value->crime_scenes[0]->detail : '-';
                    $data['tanggal_kejadian'] = count($value->crime_scenes) > 0 ? date('Y-m-d', strtotime($value->crime_scenes[0]->datetime)) : null;
                    $data['terlapor'] = count($value->defendants) > 0 ?  $value->defendants[0]->name : '';
                    $data['kesatuan'] = count($value->defendants) > 0 ? $value->defendants[0]->unit : '';
                    $data['jabatan'] = count($value->defendants) > 0 ? $value->defendants[0]->occupation : '';
                    if ($value->victims) {
                        $korban = '';
                        foreach ($value->victims as $key => $victim) {
                            if ($key == 0) {
                                $korban = $victim->name;
                            } else {
                                $korban = $korban . ', ' . $victim->name;
                            }
                        }
                        $data['nama_korban'] = strtoupper($korban);
                    }
                    $insert = DataPelanggar::create($data);
                    $import++;
                    for ($i = 0; $i < count($value->evidences); $i++) {
                        Evidences::create([
                            'data_pelanggar_id' => $insert->id,
                            'file_path' => $value->evidences[$i]->file_path
                        ]);
                    }
                }
            }
        }
        return response()->json([
            'status' => 200,
            'total_import' => $import
        ]);
        dd($data);
    }

    public function importPangkat()
    {
        $body = [];
        $yanduan = new Yanduan();
        if ($yanduan->getToken() == null) {
            return response()->json([
                'status' => 500,
                'message' => 'Terjadi Kesalahan Pada Serssver'
            ]);
        }

        $response = $yanduan->importPangkat($body);
        if ($response == null) {
            return response()->json([
                'status' => 200,
                'total_import' => 0
            ]);
        }

        foreach ($response->data as $key => $value) {
            # code...
            $pangkat = Pangkat::whereRaw('UPPER(name) = (?)', strtoupper($value->name))->first();
            if (!$pangkat) {
                Pangkat::create([
                    'name' => strtoupper($value->name)
                ]);
            }
        }

        return 'ok';
    }
}
