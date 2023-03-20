<?php

namespace App\Http\Controllers;

use App\Models\DataPelanggar;
use App\Models\Penyidik;
use App\Models\SprinHistory;
use App\Models\Wawancara;
use App\Models\UndanganGelar;
use App\Models\LaporanHasilGelar;
use App\Models\LaporanHasilAudit;
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
        $template_document = new TemplateProcessor(storage_path('template_surat/surat_penghadapan.docx'));
        $template_document->setValues($value);
        $template_document->saveAs(storage_path('template_surat/surat-penghadapan.docx'));

        return response()->download(storage_path('template_surat/surat-penghadapan.docx'))->deleteFileAfterSend(true);
    }

    public function generateWawancara(Request $request)
    {
        $wawancara = Wawancara::where('data_pelanggar_id', $request->data_pelanggar_id)->first();
        if (!$wawancara)
        {
            $wawancara = Wawancara::create([
                'data_pelanggar_id' => $request->data_pelanggar_id,
                'ruangan' => $request->ruangan,
                'tanggal' => $request->tanggal,
                'jam' => $request->jam,
                'alamat' => $request->alamat
            ]);
        }

        $value = $this->valueDoc($request->data_pelanggar_id, true);
        $template_document = new TemplateProcessor(storage_path('template_surat/undangan_wawancara.docx'));
        $template_document->setValues($value);
        $template_document->saveAs(storage_path('template_surat/surat-undangan-wawancara.docx'));

        return response()->download(storage_path('template_surat/surat-undangan-wawancara.docx'))->deleteFileAfterSend(true);
    }

    public function generateLaporanHasilAudit(Request $request)
    {
        $laporan = LaporanHasilAudit::where('data_pelanggar_id', $request->data_pelanggar_id)->first();
        if (!$laporan)
        {
            $laporan = LaporanHasilAudit::create([
                'data_pelanggar_id' => $request->data_pelanggar_id,
                'nomor_laporan' => $request->nomor_laporan,
                'tanggal_laporan' => $request->tanggal
            ]);
        }

        $value = $this->valueDoc($request->data_pelanggar_id, false, true);
        $template_document = new TemplateProcessor(storage_path('template_surat/laporan_hasil_audit.docx'));
        $template_document->setValues($value);
        $template_document->saveAs(storage_path('template_surat/laporan-hasil-audit.docx'));

        return response()->download(storage_path('template_surat/laporan-hasil-audit.docx'))->deleteFileAfterSend(true);
    }

    public function notaWawancara($kasus_id)
    {
        // $kasus = DataPelanggar::find($kasus_id);
        $value = $this->valueDoc($kasus_id, true);
        $template_document = new TemplateProcessor(storage_path('template_surat/nota_wawancara.docx'));
        $template_document->setValues($value, true);
        $template_document->saveAs(storage_path('template_surat/surat-nota-wawancara.docx'));

        return response()->download(storage_path('template_surat/surat-nota-wawancara.docx'))->deleteFileAfterSend(true);
    }

    public function undanganWawancara($kasus_id)
    {
         $value = $this->valueDoc($kasus_id, true);
        $template_document = new TemplateProcessor(storage_path('template_surat/undangan_wawancara.docx'));
        $template_document->setValues($value);
        $template_document->saveAs(storage_path('template_surat/surat-undangan-wawancara.docx'));

        return response()->download(storage_path('template_surat/surat-undangan-wawancara.docx'))->deleteFileAfterSend(true);
    }

    public function laporanHasilAudit($kasus_id)
    {
        $value = $this->valueDoc($kasus_id, false, true);
        $template_document = new TemplateProcessor(storage_path('template_surat/laporan_hasil_audit.docx'));
        $template_document->setValues($value);
        $template_document->saveAs(storage_path('template_surat/laporan-hasil-audit.docx'));

        return response()->download(storage_path('template_surat/laporan-hasil-audit.docx'))->deleteFileAfterSend(true);
    }



    Public static function valueDoc($kasus_id, $wawancara = false, $laporan = false, $undangan_gelar = false, $laporan_gelar = false)
    {
        $kasus = DataPelanggar::find($kasus_id);
        $penyidik = Penyidik::where('data_pelanggar_id', $kasus_id)->get()->toArray();
        $sprin = SprinHistory::where('data_pelanggar_id', $kasus_id)->first();

        $data = array();

        if($wawancara){
            $wawancara_data = Wawancara::where('data_pelanggar_id', $kasus_id)->first();
            $data['tanggal_wawancara'] = Carbon::parse($wawancara_data->tanggal)->translatedFormat('d F Y');
            $data['hari_wawancara'] = Carbon::parse($wawancara_data->tanggal)->translatedFormat('l');
            $data['ruangan_wawancara'] = $wawancara_data->ruangan;
            $data['jam_wawancara'] = $wawancara_data->jam;
            $data['alamat_wawancara'] = $wawancara_data->alamat;
        }

        if($laporan){
            $laporan_data = LaporanHasilAudit::where('data_pelanggar_id', $kasus_id)->first();
            $data['nomor_laporan'] = $laporan_data->nomor_laporan;
            $data['tanggal_laporan'] = Carbon::parse($laporan_data->tanggal_laporan)->translatedFormat('d F Y');
        }

        if($undangan_gelar){
            $undangan_gelar_data = UndanganGelar::where('data_pelanggar_id', $kasus_id)->first();
            $data['nomor_gelar'] = $undangan_gelar_data->nomor_gelar;
            $data['tanggal_gelar'] = Carbon::parse($undangan_gelar_data->tanggal_gelar)->translatedFormat('d F Y');
            $data['hari_gelar'] = Carbon::parse($undangan_gelar_data->tanggal_gelar)->translatedFormat('l');
            $data['pukul_gelar'] = $undangan_gelar_data->jam_gelar;
            $data['tempat_gelar'] = $undangan_gelar_data->tempat_gelar;
            $data['pangkat_akreditor'] = $undangan_gelar_data->pangkat_akreditor;
            $data['nama_akreditor'] = $undangan_gelar_data->nama_akreditor;
            $data['no_telp_akreditor'] = $undangan_gelar_data->no_telp_akreditor;
        }

        if($laporan_gelar){
            $laporan_gelar_data = LaporanHasilGelar::where('data_pelanggar_id', $kasus_id)->first();
            $data['tanggal_laporan_gelar'] = Carbon::parse($laporan_gelar_data->tanggal_laporan_gelar)->translatedFormat('d F Y');
            $data['nama_pimpinan_gelar'] = $laporan_gelar_data->nama_pimpinan_gelar;
            $data['pangkat_pimpinan_gelar'] = $laporan_gelar_data->pangkat_pimpinan_gelar;
            $data['jabatan_pimpinan_gelar'] = $laporan_gelar_data->jabatan_pimpinan_gelar;
            $data['kesatuan_pimpinan_gelar'] = $laporan_gelar_data->kesatuan_pimpinan_gelar;
            $data['nama_pemapar'] = $laporan_gelar_data->nama_pemapar;
            $data['pangkat_pemapar'] = $laporan_gelar_data->pangkat_pemapar;
            $data['jabatan_pemapar'] = $laporan_gelar_data->jabatan_pemapar;
            $data['kesatuan_pemapar'] = $laporan_gelar_data->kesatuan_pemapar;
            $data['nrp_pembuat'] = $laporan_gelar_data->nrp_pembuat;
            $data['nama_pembuat'] = $laporan_gelar_data->nama_pembuat;
            $data['pangkat_pembuat'] = $laporan_gelar_data->pangkat_pembuat;
            $data['nama_terlapor'] = strtoupper($kasus->terlapor);
            $data['pangkat_terlapor'] = strtoupper($kasus->pangkat);
            $data['jabatan_terlapor'] = strtoupper($kasus->jabatan);
            $data['kesatuan_terlapor'] = strtoupper($kasus->kesatuan);

        }

        $data += array(
            'tanggal_audit' => Carbon::parse($sprin->tanggal_investigasi)->translatedFormat('d F Y'),
            'no_sprin' => $sprin->no_sprin,
            'bulan_tahun_sprin' => Carbon::parse($sprin->created_at)->translatedFormat('F Y'),
            'tanggal_sprin' => Carbon::parse($sprin->created_at)->translatedFormat('d F Y'),
            'tanggal_no_dinas' => Carbon::parse($kasus->tanggal_nota_dinas)->translatedFormat('d F Y'),
            'no_nota_dinas' => $kasus->no_nota_dinas,
            'perihal' => $kasus->perihal_nota_dinas,
            'pelapor' => $kasus->pelapor,
            'no_telp' => $kasus->no_telp,
            'terlapor' => $kasus->terlapor,
            'nrp' => $kasus->nrp,
            'pangkat' => $kasus->pangkat,
            'kesatuan' => $kasus->kesatuan,
            'jabatan' => $kasus->jabatan,
            'agama' => $kasus->agama,
            'suku_terlapor' => $kasus->suku,
            'agama_terlapor' => $kasus->agama_terlapor,
            'alamat_terlapor' => $kasus->alamat_terlapor,
            'alamat' => $kasus->alamat,
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
            'jabatan_1' => $penyidik[0]['jabatan'] ?? '',
            'jabatan_2' => $penyidik[1]['jabatan'] ?? '',
            'jabatan_3' => $penyidik[2]['jabatan'] ?? '',
            'jabatan_4' => $penyidik[3]['jabatan'] ?? '',
            'jabatan_5' => $penyidik[4]['jabatan'] ?? '',
            'jabatan_6' => $penyidik[5]['jabatan'] ?? ''
        );

        return $data;
    }
}