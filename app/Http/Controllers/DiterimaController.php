<?php

namespace App\Http\Controllers;

use App\Models\DataPelanggar;
use App\Models\Disposisi;
use Carbon\Carbon;
use DateTime;
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
                'tim' => $request->tim,
                'klasifikasi' => $request->klasifikasi,
                'derajat' => $request->derajat,
                'tanggal_diterima' => date('Y-m-d h:i:s'),
                'type' => 1
            ]);
        }

        $kasus = DataPelanggar::find($request->data_pelanggar_id);

        $template_document = new TemplateProcessor(storage_path('template_surat/disposisi_kabagetika.docx'));
        $dt = new DateTime($disposisi->tanggal_diterima);

        $date = $dt->format('m/d/Y');
        $time = $dt->format('H:i:s');
        
        $template_document->setValues( array(
            'nomor_agenda' => $disposisi->no_agenda,
            'surat_dari' => $disposisi->surat_dari,
            'no_nota_dinas' => $kasus->no_nota_dinas,
            'klasifikasi' => $disposisi->klasifikasi,
            'derajat' => $disposisi->derajat,
            'tim' => $disposisi->tim,
            'tanggal_diterima' => Carbon::parse($date)->translatedFormat('d F Y'),
            'pukul' => $time,
            'tanggal_nota_dinas' => Carbon::parse($kasus->tanggal_nota_dinas)->translatedFormat('d F Y'),
            'perihal_nota_dinas' => $kasus->perihal_nota_dinas
        ));
        $template_document->saveAs(storage_path('template_surat/'.$kasus->pelapor.'-surat-disposisi_kabagetika.docx'));

        return response()->download(storage_path('template_surat/'.$kasus->pelapor.'-surat-disposisi_kabagetika.docx'))->deleteFileAfterSend(true);
    }

    public function disposisiKabag($kasus_id)
    {
        $disposisi = Disposisi::where('data_pelanggar_id', $kasus_id)
                    ->where('type', 1)->first();

        $kasus = DataPelanggar::find($kasus_id);

        $template_document = new TemplateProcessor(storage_path('template_surat/disposisi_kabagetika.docx'));
        $dt = new DateTime($disposisi->tanggal_diterima);

        $date = $dt->format('m/d/Y');
        $time = $dt->format('H:i:s');
        
        $template_document->setValues( array(
            'nomor_agenda' => $disposisi->no_agenda,
            'surat_dari' => $disposisi->surat_dari,
            'no_nota_dinas' => $kasus->no_nota_dinas,
            'klasifikasi' => $disposisi->klasifikasi,
            'derajat' => $disposisi->derajat,
            'tanggal_diterima' => Carbon::parse($date)->translatedFormat('d F Y'),
            'pukul' => $time,
            'tim' => $disposisi->tim,
            'tanggal_nota_dinas' => Carbon::parse($kasus->tanggal_nota_dinas)->translatedFormat('d F Y'),
            'perihal_nota_dinas' => $kasus->perihal_nota_dinas
        ));
        $template_document->saveAs(storage_path('template_surat/'.$kasus->pelapor.'-surat-disposisi-kabagetika.docx'));

        return response()->download(storage_path('template_surat/'.$kasus->pelapor.'-surat-disposisi-kabagetika.docx'))->deleteFileAfterSend(true);
    }

    public function generateDisposisiKaro(Request $request)
    {
        $disposisi = Disposisi::where('data_pelanggar_id', $request->data_pelanggar_id)
                    ->where('type', 2)->first();

        if (!$disposisi)
        {
            $disposisi = Disposisi::create([
                'data_pelanggar_id' => $request->data_pelanggar_id,
                'no_agenda' => $request->no_agenda,
                'surat_dari' => $request->surat_dari,
                'klasifikasi' => $request->klasifikasi,
                'derajat' => $request->derajat,
                'tanggal_diterima' => date('Y-m-d h:i:s'),
                'tanggal_surat' => $request->tanggal_surat,
                'type' => 2
            ]);
        }


        $disposisi = Disposisi::where('data_pelanggar_id', $request->data_pelanggar_id)
                    ->where('type', 2)->first();
        $kasus = DataPelanggar::find($request->data_pelanggar_id);

        $template_document = new TemplateProcessor(storage_path('template_surat/disposisi_karo.docx'));
        $dt = new DateTime($disposisi->tanggal_diterima);

        $date = $dt->format('m/d/Y');
        $time = $dt->format('H:i:s');
        
        $template_document->setValues( array(
            'nomor_agenda' => $disposisi->no_agenda,
            'surat_dari' => $disposisi->surat_dari,
            'klasifikasi' => $disposisi->klasifikasi,
            'derajat' => $disposisi->derajat,
            'no_nota_dinas' => $kasus->no_nota_dinas,
            'tanggal_diterima' => Carbon::parse($date)->translatedFormat('d F Y'),
            'pukul' => $time,
            'tanggal_nota_dinas' => Carbon::parse($disposisi->tanggal_surat)->translatedFormat('d F Y'),
            'perihal' => $kasus->perihal_nota_dinas
        ));
        $template_document->saveAs(storage_path('template_surat/'.$kasus->pelapor.'-surat-disposisi-karo.docx'));

        return response()->download(storage_path('template_surat/'.$kasus->pelapor.'-surat-disposisi-karo.docx'))->deleteFileAfterSend(true);
    }

    public function disposisiKaro($kasus_id)
    {

        $disposisi = Disposisi::where('data_pelanggar_id', $kasus_id)
                    ->where('type', 2)->first();
        $kasus = DataPelanggar::find($kasus_id);

        $template_document = new TemplateProcessor(storage_path('template_surat/disposisi_karo.docx'));
        $dt = new DateTime($disposisi->tanggal_diterima);

        $date = $dt->format('m/d/Y');
        $time = $dt->format('H:i:s');
        
        $template_document->setValues( array(
            'nomor_agenda' => $disposisi->no_agenda,
            'surat_dari' => $disposisi->surat_dari,
            'klasifikasi' => $disposisi->klasifikasi,
            'derajat' => $disposisi->derajat,
            'no_nota_dinas' => $kasus->no_nota_dinas,
            'tanggal_diterima' => Carbon::parse($date)->translatedFormat('d F Y'),
            'pukul' => $time,
            'tanggal_surat' => Carbon::parse($disposisi->tanggal_surat)->translatedFormat('d F Y'),
            'perihal_nota_dinas' => $kasus->perihal_nota_dinas
        ));
        $template_document->saveAs(storage_path('template_surat/'.$kasus->pelapor.'-surat-disposisi-karo.docx'));

        return response()->download(storage_path('template_surat/'.$kasus->pelapor.'-surat-disposisi-karo.docx'))->deleteFileAfterSend(true);
    }

    public function generateDisposisiSesro(Request $request)
    {
        $disposisi = Disposisi::where('data_pelanggar_id', $request->data_pelanggar_id)
                    ->where('type', 3)->first();

        if (!$disposisi)
        {
            $disposisi = Disposisi::create([
                'data_pelanggar_id' => $request->data_pelanggar_id,
                'no_agenda' => $request->no_agenda,
                'surat_dari' => $request->surat_dari,
                'klasifikasi' => $request->klasifikasi,
                'derajat' => $request->derajat,
                'tanggal_diterima' => date('Y-m-d h:i:s'),
                'tanggal_surat' => $request->tanggal_surat,
                'type' => 3
            ]);
        }


        $disposisi = Disposisi::where('data_pelanggar_id', $request->data_pelanggar_id)
                    ->where('type', 3)->first();
        $kasus = DataPelanggar::find($request->data_pelanggar_id);

        $template_document = new TemplateProcessor(storage_path('template_surat/disposisi_karo.docx'));
        $dt = new DateTime($disposisi->tanggal_diterima);

        $date = $dt->format('m/d/Y');
        $time = $dt->format('H:i:s');
        
        $template_document->setValues( array(
            'nomor_agenda' => $disposisi->no_agenda,
            'surat_dari' => $disposisi->surat_dari,
            'klasifikasi' => $disposisi->klasifikasi,
            'derajat' => $disposisi->derajat,
            'no_nota_dinas' => $kasus->no_nota_dinas,
            'tanggal_diterima' => Carbon::parse($date)->translatedFormat('d F Y'),
            'pukul' => $time,
            'tanggal_nota_dinas' => Carbon::parse($kasus->tanggal_nota_dinas)->translatedFormat('d F Y'),
            'perihal' => $kasus->perihal_nota_dinas
        ));
        $template_document->saveAs(storage_path('template_surat/'.$kasus->pelapor.'-surat-disposisi-karo.docx'));

        return response()->download(storage_path('template_surat/'.$kasus->pelapor.'-surat-disposisi-karo.docx'))->deleteFileAfterSend(true);
    }

    public function disposisiSesro($kasus_id)
    {

        $disposisi = Disposisi::where('data_pelanggar_id', $kasus_id)
                    ->where('type', 3)->first();
        $kasus = DataPelanggar::find($kasus_id);

        $template_document = new TemplateProcessor(storage_path('template_surat/disposisi_sesro.docx'));
        $dt = new DateTime($disposisi->tanggal_diterima);

        $date = $dt->format('m/d/Y');
        $time = $dt->format('H:i:s');
        
        $template_document->setValues( array(
            'nomor_agenda' => $disposisi->no_agenda,
            'surat_dari' => $disposisi->surat_dari,
            'klasifikasi' => $disposisi->klasifikasi,
            'derajat' => $disposisi->derajat,
            'no_nota_dinas' => $kasus->no_nota_dinas,
            'tanggal_diterima' => Carbon::parse($date)->translatedFormat('d F Y'),
            'pukul' => $time,
            'tanggal_nota_dinas' => Carbon::parse($kasus->tanggal_nota_dinas)->translatedFormat('d F Y'),
            'perihal' => $kasus->perihal_nota_dinas
        ));
        $template_document->saveAs(storage_path('template_surat/'.$kasus->pelapor.'-surat-disposisi-sesro.docx'));

        return response()->download(storage_path('template_surat/'.$kasus->pelapor.'-surat-disposisi-sesro.docx'))->deleteFileAfterSend(true);
    }

}