<?php

namespace App\Http\Controllers;

use App\Models\DataPelanggar;
use App\Models\Disposisi;
use App\Models\SprinHistory;
use App\Models\Penyidik;
use App\Models\Bap;
use App\Models\Klarifikasi;
use App\Models\LaporanHasilGelar;
use App\Models\Lpa;
use App\Models\SprinRiksa;
use App\Models\Timeline;
use App\Models\UndanganGelar;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;
use PhpOffice\PhpWord\TemplateProcessor;

class SidikController extends Controller
{
    public function generateBap(Request $request)
    {
        $bap = Bap::where('data_pelanggar_id', $request->data_pelanggar_id)->first();

        if (!$bap) {
            $bap = Bap::create([
                'data_pelanggar_id' => $request->data_pelanggar_id,
                'tanggal_pemeriksaan' => $request->tanggal_pemeriksaan,
                'jam_pemeriksaan' => $request->jam_pemeriksaan,
            ]);
        }

        $kasus = DataPelanggar::where('id', $request->data_pelanggar_id)->first();
        $bap = Bap::where('data_pelanggar_id', $request->data_pelanggar_id)->first();
        $sprin = SprinRiksa::where('data_pelanggar_id', $request->data_pelanggar_id)->first();
        $klarifikasi = Klarifikasi::where('data_pelanggar_id', $request->data_pelanggar_id)->first();


        $penyidik = Penyidik::where('tim', $klarifikasi->tim)->where('fungsional', '<>', 'Akreditor Utama')->with('pangkat')->get()->toArray();
        $ketua_penyidik = Penyidik::where('tim', $klarifikasi->tim)->where('fungsional', 'Akreditor Utama')->first();
        $lpa = Lpa::where('data_pelanggar_id', $request->data_pelanggar_id)->first();
        $template_document = new TemplateProcessor(storage_path('template_surat/bap.docx'));

        $date = date('Y-m-d');

        $array_bln = array(1 => "I", "II", "III", "IV", "V", "VI", "VII", "VIII", "IX", "X", "XI", "XII");
        $tanggal = date("n", strtotime($sprin->tanggal_investigasi));
        $bln = $array_bln[$tanggal];

        $template_document->setValues(array(
            'nomor_lpa' => $lpa->nomor_surat,
            'pasal' => $lpa->pasal_yang_dilanggar,
            'tanggal_lpa' => Carbon::parse($lpa->created_at)->translatedFormat('d F Y'),
            'no_sprin' => $sprin->nomor_surat,
            'tanggal_sprin' => Carbon::parse($sprin->tanggal_surat)->translatedFormat('d F Y'),
            'terlapor' => $kasus->terlapor,
            'nrp' => $kasus->nrp,
            'wujud_perbuatan' => $kasus->wujud_perbuatan->keterangan_wp,
            'alamat' => $kasus->alamat,
            'agama' => $kasus->religi->name,
            'jabatan' => $kasus->jabatan,
            'kesatuan' => $kasus->kesatuan,
            'pangkat' => $kasus->pangkat->name,
            'tempat_lahir' => $kasus->tempat_lahir,
            'hari_pemeriksaan' => Carbon::parse($bap->tanggal_pemeriksaan)->translatedFormat('l'),
            'tanggal_pemeriksaan' => Carbon::parse($bap->tanggal_pemeriksaan)->translatedFormat('d F Y'),
            'tanggal_lahir' => Carbon::parse($kasus->tanggal_lahir)->translatedFormat('d F Y'),
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
        $template_document->saveAs(storage_path('template_surat/' . $kasus->pelapor . '-bap.docx'));

        return response()->download(storage_path('template_surat/' . $kasus->pelapor . '-bap.docx'))->deleteFileAfterSend(true);
    }

    public function bap($kasus_id)
    {
        $kasus = DataPelanggar::where('id', $kasus_id)->first();
        $bap = Bap::where('data_pelanggar_id', $kasus_id)->first();
        $sprin = SprinRiksa::where('data_pelanggar_id', $kasus_id)->first();
        $klarifikasi = Klarifikasi::where('data_pelanggar_id', $kasus_id)->first();


        $penyidik = Penyidik::where('tim', $klarifikasi->tim)->where('fungsional', '<>', 'Akreditor Utama')->with('pangkat')->get()->toArray();
        $ketua_penyidik = Penyidik::where('tim', $klarifikasi->tim)->where('fungsional', 'Akreditor Utama')->first();
        $lpa = Lpa::where('data_pelanggar_id', $kasus_id)->first();
        $template_document = new TemplateProcessor(storage_path('template_surat/bap.docx'));

        $date = date('Y-m-d');

        $array_bln = array(1 => "I", "II", "III", "IV", "V", "VI", "VII", "VIII", "IX", "X", "XI", "XII");
        $tanggal = date("n", strtotime($sprin->tanggal_investigasi));
        $bln = $array_bln[$tanggal];

        $template_document->setValues(array(
            'nomor_lpa' => $lpa->nomor_surat,
            'tanggal_lpa' => Carbon::parse($lpa->created_at)->translatedFormat('d F Y'),
            'no_sprin' => $sprin->nomor_surat,
            'tanggal_sprin' => Carbon::parse($sprin->tanggal_surat)->translatedFormat('d F Y'),
            'terlapor' => $kasus->terlapor,
            'nrp' => $kasus->nrp,
            'wujud_perbuatan' => $kasus->wujud_perbuatan->keterangan_wp,
            'alamat' => $kasus->alamat,
            'agama' => $kasus->religi->name,
            'jabatan' => $kasus->jabatan,
            'kesatuan' => $kasus->kesatuan,
            'pangkat' => $kasus->pangkat->name,
            'tempat_lahir' => $kasus->tempat_lahir,
            'hari_pemeriksaan' => Carbon::parse($bap->tanggal_pemeriksaan)->translatedFormat('l'),
            'tanggal_pemeriksaan' => Carbon::parse($bap->tanggal_pemeriksaan)->translatedFormat('d F Y'),
            'tanggal_lahir' => Carbon::parse($kasus->tanggal_lahir)->translatedFormat('d F Y'),
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
        $template_document->saveAs(storage_path('template_surat/' . $kasus->pelapor . '-bap.docx'));

        return response()->download(storage_path('template_surat/' . $kasus->pelapor . '-bap.docx'))->deleteFileAfterSend(true);
    }

    public function sprin_riksa(Request $request)
    {
        // dd($request->all());
        SprinRiksa::create([
            'data_pelanggar_id' => $request->data_pelanggar_id,
            'nomor_surat' => $request->nomor_sprin_riksa,
            'tanggal_surat' => $request->tanggal,
        ]);

        return redirect()->back();
    }

    // public function generateLap(Request $request)
    // {
    //     $bap = Bap::where('data_pelanggar_id', $request->data_pelanggar_id)->first();

    //     if (!$bap)
    //     {
    //         $bap = Bap::create([
    //             'data_pelanggar_id' => $request->data_pelanggar_id,
    //             'tanggal_pemeriksaan' => $request->tanggal_pemeriksaan,
    //             'jam_pemeriksaan' => $request->jam_pemeriksaan,
    //         ]);
    //     }

    //     $kasus = DataPelanggar::where('id', $request->data_pelanggar_id)->first();
    //     $bap = Bap::where('data_pelanggar_id', $request->data_pelanggar_id)->first();
    //     $sprin = SprinHistory::where('data_pelanggar_id', $request->data_pelanggar_id)->first();

    //     $penyidik = Penyidik::where('tim', $sprin->tim)->where('fungsional', 'anggota')->get()->toArray();
    //     $ketua_penyidik = Penyidik::where('tim', $sprin->tim)->where('fungsional', 'ketua')->first();

    //     $template_document = new TemplateProcessor(storage_path('template_surat/bap.docx'));

    //     $date = date('Y-m-d');

    //     $array_bln = array(1=>"I","II","III", "IV", "V","VI","VII","VIII","IX","X", "XI","XII");
    //     $tanggal = date("n",strtotime($sprin->tanggal_investigasi));
    //     $bln = $array_bln[$tanggal];

    //     $template_document->setValues( array(
    //         'hari_pemeriksaan' => Carbon::parse($bap->tanggal_pemeriksaan)->translatedFormat('l'),
    //         'tanggal_pemeriksaan' => Carbon::parse($bap->tanggal_pemeriksaan)->translatedFormat('d F Y'),
    //         'jam_pemeriksaan' => $bap->jam_pemeriksaan ?? '',
    //         'ketua' => $ketua_penyidik->name ?? '',
    //         'nrp_ketua' => $ketua_penyidik->nrp ?? '',
    //         'jabatan_ketua' => $ketua_penyidik->jabatan ?? '',
    //         'pangkat_ketua' => $ketua_penyidik->pangkat->name ?? '',
    //         'kesatuan_ketua' => $ketua_penyidik->kesatuan ?? '',
    //         'anggota_1' => $penyidik[0]['name'] ?? '',
    //         'nrp_1' => $penyidik[0]['nrp'] ?? '',
    //         'pangkat_1' => $penyidik[0]['pangkat'][0]['name'] ?? '',
    //         'jabatan_1' => $penyidik[0]['jabatan'] ?? '',
    //         'kesatuan_1' => $penyidik[0]['kesatuan'] ?? '',
    //         'anggota_2' => $penyidik[1]['name'] ?? '',
    //         'nrp_2' => $penyidik[1]['nrp'] ?? '',
    //         'pangkat_2' => $penyidik[1]['pangkat'][0]['name'] ?? '',
    //         'jabatan_2' => $penyidik[1]['jabatan'] ?? '',
    //         'kesatuan_2' => $penyidik[0]['kesatuan'] ?? '',
    //         'anggota_3' => $penyidik[2]['name'] ?? '',
    //         'nrp_3' => $penyidik[2]['nrp'] ?? '',
    //         'pangkat_3' => $penyidik[2]['pangkat'][0]['name'] ?? '',
    //         'jabatan_3' => $penyidik[2]['jabatan'] ?? '',
    //         'kesatuan_3' => $penyidik[0]['kesatuan'] ?? '',
    //         'anggota_4' => $penyidik[3]['name'] ?? '',
    //         'nrp_4' => $penyidik[3]['nrp'] ?? '',
    //         'pangkat_4' => $penyidik[3]['pangkat'][0]['name'] ?? '',
    //         'jabatan_4' => $penyidik[3]['jabatan'] ?? '',
    //         'kesatuan_4' => $penyidik[0]['kesatuan'] ?? '',
    //         'anggota_5' => $penyidik[4]['name'] ?? '',
    //         'pangkat_5' => $penyidik[4]['pangkat'][0]['name'] ?? '',
    //         'nrp_5' => $penyidik[4]['nrp'] ?? '',
    //         'jabatan_5' => $penyidik[4]['jabatan'] ?? '',
    //         'kesatuan_5' => $penyidik[0]['kesatuan'] ?? '',
    //     ));
    //     $template_document->saveAs(storage_path('template_surat/'.$kasus->pelapor.'-bap.docx'));

    //     return response()->download(storage_path('template_surat/'.$kasus->pelapor.'-bap.docx'))->deleteFileAfterSend(true);
    // }

    public function lpa(Request $request, $kasus_id = null)
    {
        $lpa = Lpa::where('data_pelanggar_id', $kasus_id ?? $request->data_pelanggar_id)->first();
        if (!$lpa) {
            $lpa = Lpa::create([
                'data_pelanggar_id' => $request->data_pelanggar_id,
                'nomor_surat' => $request->nomor_surat_lpa,
                'pasal_yang_dilanggar' => $request->pasal_yang_dilanggar
            ]);
            $kasus_id = $request->data_pelanggar_id;
        }
        $kasus = DataPelanggar::where('id', $kasus_id)->first();
        // $value = AuditInvestigasiController::valueDoc($kasus_id, true, false, false, false, false, false, false, false, false);
        $undangan_geler = Klarifikasi::where('data_pelanggar_id', $kasus_id)->with('penyidik')->first();

        $laporan_hasil_gelar = LaporanHasilGelar::where('data_pelanggar_id', $kasus->id)->first();
        $template_document = new TemplateProcessor(storage_path('template_surat/lpa.docx'));
        $tanggal = date('Y-m-d');
        $template_document->setValues(array(
            'terlapor' => $kasus->terlapor,
            'pangkat' => $kasus->pangkats->name,
            'penyidik' => $undangan_geler->penyidik->name,
            'nrp_penyidik' => $undangan_geler->penyidik->nrp,
            'pangkat_penyidik' => $undangan_geler->penyidik->pangkat->name,
            'jabatan_penyidik' => $undangan_geler->penyidik->jabatan,
            'nama_terlapor' => $kasus->terlapor,
            'pangkat_terlapor' => $kasus->pangkat->terlapor,
            'polda_terlapor' => $kasus->kesatuan,
            'pasal' => $lpa->pasal_yang_dilanggar,
            'kronologi' => $kasus->kronologi,
            'hari' => Carbon::parse($tanggal)->translatedFormat('l'),
            'tanggal' => Carbon::parse($tanggal)->translatedFormat('d F Y'),
            'hari_kejadian' => Carbon::parse($kasus->tanggal_kejadian)->translatedFormat('l'),
            'tanggal_kejadian' => Carbon::parse($kasus->tanggal_kejadian)->translatedFormat('d F Y'),
            'nomor_lpa' => $lpa->nomor_surat
        ));
        $template_document->saveAs(storage_path('template_surat/' . $kasus->pelapor . '-lpa.docx'));
        return response()->download(storage_path('template_surat/' . $kasus->pelapor . '-lpa.docx'))->deleteFileAfterSend(true);
    }

    public function sprin($kasus_id)
    {
        $kasus = DataPelanggar::where('id', $kasus_id)->first();
        $value = AuditInvestigasiController::valueDoc($kasus_id, true, false, false, false, false, false, false, false, false, false);
        $template_document = new TemplateProcessor(storage_path('template_surat/sprin.docx'));
        $template_document->setValues($value);
        $template_document->saveAs(storage_path('template_surat/' . $kasus->pelapor . '-sprin.docx'));



        return response()->download(storage_path('template_surat/' . $kasus->pelapor . '-sprin.docx'))->deleteFileAfterSend(true);
    }
}
