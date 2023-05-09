<?php

namespace App\Http\Controllers;

use App\Models\UndanganGelar;
use App\Models\LaporanHasilGelar;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\AuditInvestigasiController;
use PhpOffice\PhpWord\TemplateProcessor;

class GelarInvestigasiController extends Controller
{
    public function generateUndanganGelar(Request $request)
    {
        $undangan = UndanganGelar::where('data_pelanggar_id', $request->data_pelanggar_id)->first();
        if (!$undangan)
        {
            $undangan = UndanganGelar::create([
                'data_pelanggar_id' => $request->data_pelanggar_id,
                'nomor_gelar' => $request->nomor_undangan,
                'tanggal_gelar' => $request->tanggal,
                'jam_gelar' => $request->pukul,
                'tempat_gelar' => $request->tempat_undangan,
                'id_penyidik' => $request->id_penyidik,
                'nomor_handphone' => $request->nomor_handphone,
            ]);
        }

        $kasus_id = $request->data_pelanggar_id;
        $kasus = DataPelanggar::where('id', $request->data_pelanggar_id)->first();

        $value = AuditInvestigasiController::valueDoc($kasus_id, false, false, true);
        $template_document = new TemplateProcessor(storage_path('template_surat/undangan_gelar.docx'));
        $template_document->setValues($value);
        $template_document->saveAs(storage_path('template_surat/'.$kasus->pelapor.'-undangan-gelar-perkara.docx'));

        return response()->download(storage_path('template_surat/'.$kasus->pelapor.'-undangan-gelar-perkara.docx'))->deleteFileAfterSend(true);

    }
    public function undanganGelar($kasus_id)
    {
        $value = AuditInvestigasiController::valueDoc($kasus_id, false, false, true);
        $kasus = DataPelanggar::where('id', $kasus_id)->first();
        $template_document = new TemplateProcessor(storage_path('template_surat/undangan_gelar.docx'));
        $template_document->setValues($value);
        $template_document->saveAs(storage_path('template_surat/'.$kasus->pelapor.'-undangan-gelar-perkara.docx'));

        return response()->download(storage_path('template_surat/'.$kasus->pelapor.'-undangan-gelar-perkara.docx'))->deleteFileAfterSend(true);
    }

    public function notaDinasLaporanGelarPerkara($kasus_id, Request $request)
    {
        $value = AuditInvestigasiController::valueDoc($kasus_id, false, false, true);
        $kasus = DataPelanggar::where('id', $kasus_id)->first();
        $template_document = new TemplateProcessor(storage_path('template_surat/nota_dinas_laporan_gelar.docx'));
        $template_document->setValues($value);
        $template_document->saveAs(storage_path('template_surat/'.$kasus->pelapor.'-nota-dinas-laporan-gelar-perkara.docx'));

        return response()->download(storage_path('template_surat/'.$kasus->pelapor.'-nota-dinas-laporan-gelar-perkara.docx'))->deleteFileAfterSend(true);
    }

    public function generateLaporanGelar(Request $request)
    {
        $undangan = LaporanHasilGelar::where('data_pelanggar_id', $request->data_pelanggar_id)->first();
        if (!$undangan)
        {
            $undangan = LaporanHasilGelar::create([
                'data_pelanggar_id' => $request->data_pelanggar_id,
                'tanggal_laporan_gelar' => $request->tanggal_laporan_gelar,
                'bukti' => $request->bukti,
                'nama_pimpinan_gelar' => $request->nama_pimpinan_gelar,
                'pangkat_pimpinan_gelar' => $request->pangkat_pimpinan_gelar,
                'jabatan_pimpinan_gelar' => $request->jabatan_pimpinan_gelar,
                'kesatuan_pimpinan_gelar' => $request->kesatuan_pimpinan_gelar,
                'id_penyidik_pemapar' => $request->id_penyidik_pemapar,
                'id_penyidik_pembuat' => $request->id_penyidik_pembuat,
            ]);
        }

        $kasus_id = $request->data_pelanggar_id;
        $kasus = DataPelanggar::where('id', $kasus_id)->first();

        $value = AuditInvestigasiController::valueDoc($kasus_id, false, false, true, true);
        $template_document = new TemplateProcessor(storage_path('template_surat/laporan_gelar_perkara.docx'));
        $template_document->setValues($value);
        $template_document->saveAs(storage_path('template_surat/'.$kasus->pelapor.'-laporan-gelar-perkara.docx'));

        return response()->download(storage_path('template_surat/'.$kasus->pelapor.'-laporan-gelar-perkara.docx'))->deleteFileAfterSend(true);
    }

    public function laporanGelar($kasus_id)
    {
        $value = AuditInvestigasiController::valueDoc($kasus_id, false, false, true, true);
        $kasus = DataPelanggar::where('id', $kasus_id)->first();
        $template_document = new TemplateProcessor(storage_path('template_surat/laporan_gelar_perkara.docx'));
        $template_document->setValues($value);
        $template_document->saveAs(storage_path('template_surat/'.$kasus->pelapor.'-laporan-gelar-perkara.docx'));

        return response()->download(storage_path('template_surat/'.$kasus->pelapor.'-laporan-gelar-perkara.docx'))->deleteFileAfterSend(true);
    }
}