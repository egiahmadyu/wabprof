<?php

namespace App\Http\Controllers;

use App\Models\DataPelanggar;
use App\Models\Penyidik;
use App\Models\SprinHistory;
use Carbon\Carbon;
use Illuminate\Http\Request;
use PhpOffice\PhpWord\TemplateProcessor;

class AuditInvestigasiController extends Controller
{

    public function printSuratPerintah($kasus_id, Request $request)
    {
        $kasus = DataPelanggar::find($kasus_id);
        // dd($request->all());
        if (!$data = SprinHistory::where('data_pelanggar_id', $kasus_id)->first())
        {

            $data = SprinHistory::create([
                'data_pelanggar_id' => $kasus_id,
                'no_sprin' => $request->no_sprin,
                'tanggal_investigasi' => $request->tanggal_investigasi
                // 'isi_surat_perintah' => $request->isi_surat_perintah
            ]);
            if ($request->nama_penyelidik_ketua)
            {
                Penyidik::create([
                    'data_pelanggar_id' => $kasus_id,
                    'name' => $request->nama_penyelidik_ketua,
                    'nrp' => $request->nrp_ketua,
                    'pangkat' => $request->pangkat_ketua,
                    'jabatan' => $request->jabatan_ketua
                ]);
                if ($request->nama_penyelidik_anggota)
                {
                    for ($i=0; $i < count($request->nama_penyelidik_anggota); $i++) {
                        Penyidik::create([
                            'data_pelanggar_id' => $kasus_id,
                            'name' => $request->nama_penyelidik_anggota[$i],
                            'nrp' => $request->nrp_anggota[$i],
                            'pangkat' => $request->pangkat_anggota[$i],
                            'jabatan' => $request->jabatan_anggota[$i]
                        ]);
                    }
                }

            }

        }
        $value = $this->valueDoc($kasus_id);
        $penyidik = Penyidik::where('data_pelanggar_id', $kasus_id)->get()->toArray();
        $sprin = SprinHistory::where('data_pelanggar_id', $kasus_id)->first();
        // dd($penyidik[0]);
        $template_document = new TemplateProcessor(storage_path('template_surat/template_sprin.docx'));
        $template_document->setValues($value);

        $template_document->saveAs(storage_path('template_surat/surat-perintah.docx'));

        return response()->download(storage_path('template_surat/surat-perintah.docx'))->deleteFileAfterSend(true);
    }

    public function suratPenghadapan($kasus_id)
    {
        $kasus = DataPelanggar::find($kasus_id);
        $value = $this->valueDoc($kasus_id);
        $template_document = new TemplateProcessor(storage_path('template_surat/undangan_wawancara.docx'));
        $template_document->setValues($value);
        $template_document->saveAs(storage_path('template_surat/surat-undangan-wawancara.docx'));

        return response()->download(storage_path('template_surat/surat-undangan-wawancara.docx'))->deleteFileAfterSend(true);
    }


    Private function valueDoc($kasus_id)
    {
        $kasus = DataPelanggar::find($kasus_id);
        $penyidik = Penyidik::where('data_pelanggar_id', $kasus_id)->get()->toArray();
        $sprin = SprinHistory::where('data_pelanggar_id', $kasus_id)->first();

        return array(
            'tanggal_audit' => Carbon::parse($sprin->tanggal_investigasi)->translatedFormat('d F Y'),
            'no_sprin' => $sprin->no_sprin,
            'bulan_tahun_sprin' => Carbon::parse($sprin->created_at)->translatedFormat('F Y'),
            'tanggal_sprin' => Carbon::parse($sprin->created_at)->translatedFormat('d F Y'),
            'tanggal_no_dinas' => Carbon::parse($kasus->tanggal_nota_dinas)->translatedFormat('d F Y'),
            'no_nota_dinas' => $kasus->no_nota_dinas,
            'perihal' => $kasus->perihal_nota_dinas,
            'terlapor' => $kasus->terlapor,
            'pangkat' => $kasus->pangkat,
            'kesatuan' => $kasus->kesatuan,
            'jabatan' => $kasus->jabatan,
            'wujud_perbuatan' => $kasus->wujud_perbuatan,
            'tanggal_ttd' => Carbon::parse($sprin->created_at)->translatedFormat('d F Y'),
            'ketua' => $penyidik[0]['name'] ?? '',
            'pangkat_ketua' => $penyidik[0]['pangkat'] ?? '',
            'nrp_ketua' => $penyidik[0]['nrp'] ?? '',
            'anggota_1' => $penyidik[1]['name'] ?? '',
            'pangkat_1' => $penyidik[1]['pangkat'] ?? '',
            'nrp_1' => $penyidik[1]['nrp'] ?? '',
            'anggota_2' => $penyidik[2]['name'] ?? '',
            'pangkat_2' => $penyidik[2]['pangkat'] ?? '',
            'nrp_2' => $penyidik[2]['nrp'] ?? '',
            'anggota_3' => $penyidik[3]['name'] ?? '',
            'pangkat_3' => $penyidik[3]['pangkat'] ?? '',
            'nrp_3' => $penyidik[3]['nrp'] ?? '',
            'anggota_4' => $penyidik[4]['name'] ?? '',
            'pangkat_4' => $penyidik[4]['pangkat'] ?? '',
            'nrp_4' => $penyidik[4]['nrp'] ?? '',
            'anggota_5' => $penyidik[5]['name'] ?? '',
            'pangkat_5' => $penyidik[5]['pangkat'] ?? '',
            'nrp_5' => $penyidik[5]['nrp'] ?? '',

        );
    }
}