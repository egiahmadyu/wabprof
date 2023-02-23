<?php

namespace App\Http\Controllers;

use App\Models\DataPelanggar;
use App\Models\Disposisi;
use Carbon\Carbon;
use Illuminate\Http\Request;
use PhpOffice\PhpWord\TemplateProcessor;

class DiterimaController extends Controller
{
    public function generateDisposisiKabag(Request $request)
    {
        $disposisi = Disposisi::where('data_pelanggar_id', $request->data_pelanggar_id)
                    ->where('type', 1)->first();
        if (!$disposisi)
        {
            $disposisi = Disposisi::create([
                'data_pelanggar_id' => $request->data_pelanggar_id,
                'no_agenda' => $request->no_agenda,
                'surat_dari' => $request->surat_dari,
                'nomor_surat' => $request->nomor_surat,
                'tanggal_surat' => $request->tanggal_surat,
                'type' => 1
            ]);
        }

        $kasus = DataPelanggar::find($request->data_pelanggar_id);

        $template_document = new TemplateProcessor(storage_path('template_surat/disposisi_kabagetika.docx'));
        $template_document->setValues( array(
            'nomor_agenda' => $disposisi->no_agenda,
            'surat_dari' => $disposisi->surat_dari,
            'nomor_surat' => $disposisi->nomor_surat,
            'tanggal_surat' => Carbon::parse($disposisi->tanggal_surat)->translatedFormat('d F Y'),
            'perihal_nota_dinas' => $kasus->perihal_nota_dinas
        ));
        $template_document->saveAs(storage_path('template_surat/surat-disposisi_kabagetika.docx'));

        return response()->download(storage_path('template_surat/surat-disposisi_kabagetika.docx'))->deleteFileAfterSend(true);
    }
}