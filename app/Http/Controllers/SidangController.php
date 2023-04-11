<?php

namespace App\Http\Controllers;

use App\Models\PembentukanKomisi;
use App\Models\SusunanKomisi;
use App\Http\Controllers\AuditInvestigasiController;
use Carbon\Carbon;
use Illuminate\Http\Request;
use PhpOffice\PhpWord\TemplateProcessor;

class SidangController extends Controller
{
    public function generatePembentukanKomisi(Request $request)
    {
        $pembentukan = PembentukanKomisi::where('data_pelanggar_id', $request->data_pelanggar_id)->first();
        if(!$pembentukan){
            PembentukanKomisi::create([
                'data_pelanggar_id' => $request->data_pelanggar_id,
                'bp3kepp_id' => $request->bp3kepp_id,
                'nomor' => $request->nomor,
                'nomor_surat_divkum' => $request->nomor_surat_divkum,
                'tanggal_surat_divkum' => $request->tanggal_surat_divkum,
                'pangkat' => $request->pangkat,
                'nama' => $request->nama,
                'kesatuan' => $request->kesatuan,
                'jabatan' => $request->jabatan
            ]);

            for ($i=0; $i < count($request->nama_komisi); $i++) { 
                SusunanKomisi::create([
                    'data_pelanggar_id' => $request->data_pelanggar_id,
                    'nama' => $request->nama_komisi[$i],
                    'nrp' => $request->nrp_komisi[$i],
                    'pangkat' => $request->pangkat_komisi[$i],
                    'nrp' => $request->nrp_komisi[$i],
                    'jabatan' => $request->jabatan_komisi[$i]
                ]);
            }
        }

        $kasus_id = $request->data_pelanggar_id;

        $value = AuditInvestigasiController::valueDoc($kasus_id, false, false, false, false, false, false, false, false, false, true);
        $template_document = new TemplateProcessor(storage_path('template_surat/pembentukan_komisi.docx'));
        $template_document->setValues($value);
        $template_document->saveAs(storage_path('template_surat/pembentukan-komisi-kode-etik.docx'));

        return response()->download(storage_path('template_surat/pembentukan-komisi-kode-etik.docx'))->deleteFileAfterSend(true);
    }

    public function pembentukanKomisi($kasus_id){
        $value = AuditInvestigasiController::valueDoc($kasus_id, false, false, false, false, false, false, false, false, false, true);
        $template_document = new TemplateProcessor(storage_path('template_surat/pembentukan_komisi.docx'));
        $template_document->setValues($value);
        $template_document->saveAs(storage_path('template_surat/pembentukan-komisi-kode-etik.docx'));

        return response()->download(storage_path('template_surat/pembentukan-komisi-kode-etik.docx'))->deleteFileAfterSend(true);
    }
}
