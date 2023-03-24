<?php

namespace App\Http\Controllers;

use App\Models\LimpahPolda;
use App\Http\Controllers\AuditInvestigasiController;
use Carbon\Carbon;
use Illuminate\Http\Request;
use PhpOffice\PhpWord\TemplateProcessor;

class LimpahPoldaController extends Controller
{
    public function generateLimpahPolda(Request $request)
    {
      
        LimpahPolda::where('id', $request->data_pelanggar_id)
        ->update([
            'nomor_limpah' => $request->nomor_limpah,
            'alamat_polda' => $request->alamat_polda,
            'nomor_klarifikasi' => $request->nomor_klarifikasi,
            'tanggal_klarifikasi' => $request->tanggal_klarifikasi,
            'perihal_klarifikasi' => $request->perihal_klarifikasi,
        ]);

        $kasus_id = $request->data_pelanggar_id;

        $value = AuditInvestigasiController::valueDoc($kasus_id, false, false, false, false, true);
        $template_document = new TemplateProcessor(storage_path('template_surat/surat_pelimpahan_dumas.docx'));
        $template_document->setValues($value);
        $template_document->saveAs(storage_path('template_surat/surat-pelimpahan-dumas.docx'));

        return response()->download(storage_path('template_surat/surat-pelimpahan-dumas.docx'))->deleteFileAfterSend(true);
    }

    public function limpahPolda($kasus_id){
        $value = AuditInvestigasiController::valueDoc($kasus_id, false, false, false, false, true);
        $template_document = new TemplateProcessor(storage_path('template_surat/surat_pelimpahan_dumas.docx'));
        $template_document->setValues($value);
        $template_document->saveAs(storage_path('template_surat/surat-pelimpahan-dumas.docx'));

        return response()->download(storage_path('template_surat/surat-pelimpahan-dumas.docx'))->deleteFileAfterSend(true);
    }
}