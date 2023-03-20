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
                'pangkat_akreditor' => $request->pangkat_akreditor,
                'nama_akreditor' => $request->nama_akreditor,
                'no_telp_akreditor' => $request->no_telp_akreditor,
            ]);
        }

        $kasus_id = $request->data_pelanggar_id;

        $value = AuditInvestigasiController::valueDoc($kasus_id, false, false, true);
        $template_document = new TemplateProcessor(storage_path('template_surat/undangan_gelar.docx'));
        $template_document->setValues($value);
        $template_document->saveAs(storage_path('template_surat/undangan-gelar-perkara.docx'));

        return response()->download(storage_path('template_surat/undangan-gelar-perkara.docx'))->deleteFileAfterSend(true);

    }
    public function undanganGelar($kasus_id)
    {
        $value = AuditInvestigasiController::valueDoc($kasus_id, false, false, true);
        $template_document = new TemplateProcessor(storage_path('template_surat/undangan_gelar.docx'));
        $template_document->setValues($value);
        $template_document->saveAs(storage_path('template_surat/undangan-gelar-perkara.docx'));

        return response()->download(storage_path('template_surat/undangan-gelar-perkara.docx'))->deleteFileAfterSend(true);
    }

    public function notaDinasLaporanGelarPerkara($kasus_id, Request $request)
    {
        $value = AuditInvestigasiController::valueDoc($kasus_id, false, false, true);
        $template_document = new TemplateProcessor(storage_path('template_surat/nota_dinas_laporan_gelar.docx'));
        $template_document->setValues($value);
        $template_document->saveAs(storage_path('template_surat/nota-dinas-laporan-gelar-perkara.docx'));

        return response()->download(storage_path('template_surat/nota-dinas-laporan-gelar-perkara.docx'))->deleteFileAfterSend(true);
    }

    public function generateLaporanGelar(Request $request)
    {
        $undangan = LaporanHasilGelar::where('data_pelanggar_id', $request->data_pelanggar_id)->first();
        if (!$undangan)
        {
            $undangan = LaporanHasilGelar::create([
                'data_pelanggar_id' => $request->data_pelanggar_id,
                'tanggal_laporan_gelar' => $request->tanggal_laporan_gelar,
                'nama_pimpinan_gelar' => $request->nama_pimpinan_gelar,
                'pangkat_pimpinan_gelar' => $request->pangkat_pimpinan_gelar,
                'jabatan_pimpinan_gelar' => $request->jabatan_pimpinan_gelar,
                'kesatuan_pimpinan_gelar' => $request->kesatuan_pimpinan_gelar,
                'nama_pemapar' => $request->nama_pemapar,
                'pangkat_pemapar' => $request->pangkat_pemapar,
                'jabatan_pemapar' => $request->jabatan_pemapar,
                'kesatuan_pemapar' => $request->kesatuan_pemapar,
                'nrp_pembuat' => $request->nrp_pembuat,
                'nama_pembuat' => $request->nama_pembuat,
                'pangkat_pembuat' => $request->pangkat_pembuat,
            ]);
        }

        $kasus_id = $request->data_pelanggar_id;

        $value = AuditInvestigasiController::valueDoc($kasus_id, false, false, true, true);
        $template_document = new TemplateProcessor(storage_path('template_surat/laporan_gelar_perkara.docx'));
        $template_document->setValues($value);
        $template_document->saveAs(storage_path('template_surat/laporan-gelar-perkara.docx'));

        return response()->download(storage_path('template_surat/laporan-gelar-perkara.docx'))->deleteFileAfterSend(true);
    }

    public function laporanGelar($kasus_id)
    {
        $value = AuditInvestigasiController::valueDoc($kasus_id, false, false, true, true);
        $template_document = new TemplateProcessor(storage_path('template_surat/laporan_gelar_perkara.docx'));
        $template_document->setValues($value);
        $template_document->saveAs(storage_path('template_surat/laporan-gelar-perkara.docx'));

        return response()->download(storage_path('template_surat/laporan-gelar-perkara.docx'))->deleteFileAfterSend(true);
    }
}