<?php

namespace App\Http\Controllers;

use App\Models\DataPelanggar;
use App\Models\Disposisi;
use App\Models\Bap;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;
use PhpOffice\PhpWord\TemplateProcessor;

class SidikController extends Controller
{
    public function generateBap(Request $request)
    {
        $bap = Bap::where('data_pelanggar_id', $request->data_pelanggar_id)->first();

        if (!$bap)
        {
            $bap = Bap::create([
                'data_pelanggar_id' => $request->data_pelanggar_id,
                'tanggal_pemeriksaan' => $request->tanggal_pemeriksaan,
                'jam_pemeriksaan' => $request->jam_pemeriksaan,
            ]);
        }

        $kasus = DataPelanggar::where('id', $request->data_pelanggar_id)->first();
        $bap = Bap::where('data_pelanggar_id', $request->data_pelanggar_id)->first();
        $sprin = SprinHistory::where('data_pelanggar_id', $request->data_pelanggar_id)->first();
        
        $penyidik = Penyidik::where('tim', $sprin->tim)->where('fungsional', 'anggota')->get()->toArray();
        $ketua_penyidik = Penyidik::where('tim', $sprin->tim)->where('fungsional', 'ketua')->first();
        
        $template_document = new TemplateProcessor(storage_path('template_surat/bap.docx'));

        $date = date('Y-m-d');

        $array_bln = array(1=>"I","II","III", "IV", "V","VI","VII","VIII","IX","X", "XI","XII");
        $tanggal = date("n",strtotime($sprin->tanggal_investigasi));
        $bln = $array_bln[$tanggal];
        
        $template_document->setValues( array(
            'hari_pemeriksaan' => Carbon::parse($bap->tanggal_pemeriksaan)->translatedFormat('l'),
            'tanggal_pemeriksaan' => Carbon::parse($bap->tanggal_pemeriksaan)->translatedFormat('d F Y'),
            'jam_pemeriksaan' => $bap->jam_pemeriksaan ?? '',
            'ketua' => $ketua_penyidik->name ?? '',
            'nrp_ketua' => $ketua_penyidik->nrp ?? '',
            'jabatan_ketua' => $ketua_penyidik->jabatan ?? '',
            'pangkat_ketua' => $ketua_penyidik->pangkat->name ?? '',
            'kesatuan_ketua' => $ketua_penyidik->kesatuan ?? '',
            'anggota_1' => $penyidik[0]['name'] ?? '',
            'nrp_1' => $penyidik[0]['nrp'] ?? '',
            'pangkat_1' => $penyidik[0]['pangkat'][0]['name'] ?? '',
            'jabatan_1' => $penyidik[0]['jabatan'] ?? '',
            'kesatuan_1' => $penyidik[0]['kesatuan'] ?? '',
            'anggota_2' => $penyidik[1]['name'] ?? '',
            'nrp_2' => $penyidik[1]['nrp'] ?? '',
            'pangkat_2' => $penyidik[1]['pangkat'][0]['name'] ?? '',
            'jabatan_2' => $penyidik[1]['jabatan'] ?? '',
            'kesatuan_2' => $penyidik[0]['kesatuan'] ?? '',
            'anggota_3' => $penyidik[2]['name'] ?? '',
            'nrp_3' => $penyidik[2]['nrp'] ?? '',
            'pangkat_3' => $penyidik[2]['pangkat'][0]['name'] ?? '',
            'jabatan_3' => $penyidik[2]['jabatan'] ?? '',
            'kesatuan_3' => $penyidik[0]['kesatuan'] ?? '',
            'anggota_4' => $penyidik[3]['name'] ?? '',
            'nrp_4' => $penyidik[3]['nrp'] ?? '',
            'pangkat_4' => $penyidik[3]['pangkat'][0]['name'] ?? '',
            'jabatan_4' => $penyidik[3]['jabatan'] ?? '',
            'kesatuan_4' => $penyidik[0]['kesatuan'] ?? '',
            'anggota_5' => $penyidik[4]['name'] ?? '',
            'pangkat_5' => $penyidik[4]['pangkat'][0]['name'] ?? '',
            'nrp_5' => $penyidik[4]['nrp'] ?? '',
            'jabatan_5' => $penyidik[4]['jabatan'] ?? '',
            'kesatuan_5' => $penyidik[0]['kesatuan'] ?? '',
        ));
        $template_document->saveAs(storage_path('template_surat/bap.docx'));

        return response()->download(storage_path('template_surat/bap.docx'))->deleteFileAfterSend(true);
    }

    public function bap($kasus_id)
    {
        $kasus = DataPelanggar::where('id', $kasus_id)->first();
        $bap = Bap::where('data_pelanggar_id', $kasus_id)->first();
        $sprin = SprinHistory::where('data_pelanggar_id', $kasus_id)->first();
        
        $penyidik = Penyidik::where('tim', $sprin->tim)->where('fungsional', 'anggota')->get()->toArray();
        $ketua_penyidik = Penyidik::where('tim', $sprin->tim)->where('fungsional', 'ketua')->first();
        
        $template_document = new TemplateProcessor(storage_path('template_surat/bap.docx'));

        $date = date('Y-m-d');

        $array_bln = array(1=>"I","II","III", "IV", "V","VI","VII","VIII","IX","X", "XI","XII");
        $tanggal = date("n",strtotime($sprin->tanggal_investigasi));
        $bln = $array_bln[$tanggal];
        
        $template_document->setValues( array(
            'hari_pemeriksaan' => Carbon::parse($bap->tanggal_pemeriksaan)->translatedFormat('l'),
            'tanggal_pemeriksaan' => Carbon::parse($bap->tanggal_pemeriksaan)->translatedFormat('d F Y'),
            'jam_pemeriksaan' => $bap->jam_pemeriksaan ?? '',
            'ketua' => $ketua_penyidik->name ?? '',
            'nrp_ketua' => $ketua_penyidik->nrp ?? '',
            'jabatan_ketua' => $ketua_penyidik->jabatan ?? '',
            'pangkat_ketua' => $ketua_penyidik->pangkat->name ?? '',
            'kesatuan_ketua' => $ketua_penyidik->kesatuan ?? '',
            'anggota_1' => $penyidik[0]['name'] ?? '',
            'nrp_1' => $penyidik[0]['nrp'] ?? '',
            'pangkat_1' => $penyidik[0]['pangkat'][0]['name'] ?? '',
            'jabatan_1' => $penyidik[0]['jabatan'] ?? '',
            'kesatuan_1' => $penyidik[0]['kesatuan'] ?? '',
            'anggota_2' => $penyidik[1]['name'] ?? '',
            'nrp_2' => $penyidik[1]['nrp'] ?? '',
            'pangkat_2' => $penyidik[1]['pangkat'][0]['name'] ?? '',
            'jabatan_2' => $penyidik[1]['jabatan'] ?? '',
            'kesatuan_2' => $penyidik[0]['kesatuan'] ?? '',
            'anggota_3' => $penyidik[2]['name'] ?? '',
            'nrp_3' => $penyidik[2]['nrp'] ?? '',
            'pangkat_3' => $penyidik[2]['pangkat'][0]['name'] ?? '',
            'jabatan_3' => $penyidik[2]['jabatan'] ?? '',
            'kesatuan_3' => $penyidik[0]['kesatuan'] ?? '',
            'anggota_4' => $penyidik[3]['name'] ?? '',
            'nrp_4' => $penyidik[3]['nrp'] ?? '',
            'pangkat_4' => $penyidik[3]['pangkat'][0]['name'] ?? '',
            'jabatan_4' => $penyidik[3]['jabatan'] ?? '',
            'kesatuan_4' => $penyidik[0]['kesatuan'] ?? '',
            'anggota_5' => $penyidik[4]['name'] ?? '',
            'pangkat_5' => $penyidik[4]['pangkat'][0]['name'] ?? '',
            'nrp_5' => $penyidik[4]['nrp'] ?? '',
            'jabatan_5' => $penyidik[4]['jabatan'] ?? '',
            'kesatuan_5' => $penyidik[0]['kesatuan'] ?? '',
        ));
        $template_document->saveAs(storage_path('template_surat/bap.docx'));

        return response()->download(storage_path('template_surat/bap.docx'))->deleteFileAfterSend(true);
    }

}