<?php

namespace App\Http\Controllers;

use App\Models\Sidang;
use App\Models\Penyerahan;
use App\Models\Permohonan;
use App\Models\Bp3kepps;
use App\Http\Controllers\AuditInvestigasiController;
use Carbon\Carbon;
use Illuminate\Http\Request;
use PhpOffice\PhpWord\TemplateProcessor;

class PemberkasanController extends Controller
{
    public function generateAdmistrasiSidang(Request $request)
    {
        $sidang = Sidang::where('data_pelanggar_id', $request->data_pelanggar_id)->first();
        if(!$sidang){
            Sidang::create([
                'data_pelanggar_id' => $request->data_pelanggar_id,
                'tanggal' => $request->tanggal,
                'jam' => $request->jam,
                'tempat' => $request->tempat,
                'pakaian' => $request->pakaian,
            ]);
        }

        $kasus_id = $request->data_pelanggar_id;

        $value = AuditInvestigasiController::valueDoc($kasus_id, false, false, false, false, false, true);
        $template_document = new TemplateProcessor(storage_path('template_surat/administrasi_sidang.docx'));
        $template_document->setValues($value);
        $template_document->saveAs(storage_path('template_surat/administrasi-sidang.docx'));

        return response()->download(storage_path('template_surat/administrasi-sidang.docx'))->deleteFileAfterSend(true);
    }

    public function AdmistrasiSidang($kasus_id){
        $value = AuditInvestigasiController::valueDoc($kasus_id, false, false, false, false, false, true);
        $template_document = new TemplateProcessor(storage_path('template_surat/administrasi_sidang.docx'));
        $template_document->setValues($value);
        $template_document->saveAs(storage_path('template_surat/administrasi-sidang.docx'));

        return response()->download(storage_path('template_surat/administrasi-sidang.docx'))->deleteFileAfterSend(true);
    }

    public function generateNotaDinasPenyerahan(Request $request)
    {
        $penyerahan = Penyerahan::where('data_pelanggar_id', $request->data_pelanggar_id)->first();
        if(!$penyerahan){
            Penyerahan::create([
                'data_pelanggar_id' => $request->data_pelanggar_id,
                'tanggal' => $request->tanggal,
                'nomor' => $request->nomor,
            ]);
        }

        $kasus_id = $request->data_pelanggar_id;

        $value = AuditInvestigasiController::valueDoc($kasus_id, false, false, false, false, false, false, true);
        $template_document = new TemplateProcessor(storage_path('template_surat/nota_dinas_penyerahan.docx'));
        $template_document->setValues($value);
        $template_document->saveAs(storage_path('template_surat/nota-dinas-penyerahan-berkas-perkara-ke-binetik.docx'));

        return response()->download(storage_path('template_surat/nota-dinas-penyerahan-berkas-perkara-ke-binetik.docx'))->deleteFileAfterSend(true);
    }

    public function notaDinasPenyerahan($kasus_id){
        $value = AuditInvestigasiController::valueDoc($kasus_id, false, false, false, false, false, false, true);
        $template_document = new TemplateProcessor(storage_path('template_surat/nota_dinas_penyerahan.docx'));
        $template_document->setValues($value);
        $template_document->saveAs(storage_path('template_surat/nota-dinas-penyerahan-berkas-perkara-ke-binetik.docx'));

        return response()->download(storage_path('template_surat/nota-dinas-penyerahan-berkas-perkara-ke-binetik.docx'))->deleteFileAfterSend(true);
    }

    public function generateNotaDinasPerbaikan(Request $request)
    {
        $perbaikan = Bp3kepps::where('data_pelanggar_id', $request->data_pelanggar_id)->first();
        if(!$perbaikan){
            for ($i=0; $i < count($request->tanggal); $i++) { 
                Bp3kepps::create([
                    'data_pelanggar_id' => $request->data_pelanggar_id,
                    'tanggal' => $request->tanggal[$i],
                    'nomor' => $request->nomor[$i],
                    'nama' => $request->nama[$i],
                    'pangkat' => $request->pangkat[$i],
                    'nrp' => $request->nrp[$i],
                    'jabatan' => $request->jabatan[$i],
                    'kesatuan' => $request->kesatuan[$i],
                ]);
            }
        }

        $kasus_id = $request->data_pelanggar_id;

        $value = AuditInvestigasiController::valueDoc($kasus_id, false, false, false, false, false, false, false, true);
        $template_document = new TemplateProcessor(storage_path('template_surat/nota_dinas_perbaikan.docx'));
        $template_document->setValues($value);
        $template_document->saveAs(storage_path('template_surat/nota-dinas-perbaikan-berkas.docx'));

        return response()->download(storage_path('template_surat/nota-dinas-perbaikan-berkas.docx'))->deleteFileAfterSend(true);
    }

    public function notaDinasPerbaikan($kasus_id){
        $value = AuditInvestigasiController::valueDoc($kasus_id, false, false, false, false, false, false, false, false, true);
        $template_document = new TemplateProcessor(storage_path('template_surat/nota_dinas_perbaikan.docx'));
        $template_document->setValues($value);
        $template_document->saveAs(storage_path('template_surat/nota-dinas-perbaikan-berkas.docx'));

        return response()->download(storage_path('template_surat/nota-dinas-perbaikan-berkas.docx'))->deleteFileAfterSend(true);
    }

    public function generatePermohonanPendapat(Request $request)
    {
        $permohonan = Permohonan::where('data_pelanggar_id', $request->data_pelanggar_id)->first();
        if(!$permohonan){
            Permohonan::create([
                'data_pelanggar_id' => $request->data_pelanggar_id,
                'bp3kepp_id' => $request->bp3kepp_id,
                'nomor' => $request->nomor,
                'tanggal' => $request->tanggal,
                'pasal' => $request->pasal,
            ]);
        }

        $kasus_id = $request->data_pelanggar_id;

        $value = AuditInvestigasiController::valueDoc($kasus_id, false, false, false, false, false, false, false, false, true);
        $template_document = new TemplateProcessor(storage_path('template_surat/permohonan_pendapat.docx'));
        $template_document->setValues($value);
        $template_document->saveAs(storage_path('template_surat/permohonan-pendapat-saran-hukum.docx'));

        return response()->download(storage_path('template_surat/permohonan-pendapat-saran-hukum.docx'))->deleteFileAfterSend(true);
    }

    public function permohonanPendapat($kasus_id){
        $value = AuditInvestigasiController::valueDoc($kasus_id, false, false, false, false, false, false, false, true);
        $template_document = new TemplateProcessor(storage_path('template_surat/nota_dinas_perbaikan.docx'));
        $template_document->setValues($value);
        $template_document->saveAs(storage_path('template_surat/permohonan-pendapat-saran-hukum.docx'));

        return response()->download(storage_path('template_surat/permohonan-pendapat-saran-hukum.docx'))->deleteFileAfterSend(true);
    }
}
