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

        try {
            if (!$disposisi) {
                if ($request->filepond->extension() != 'pdf') {
                    return response()->json([
                        'status' => 401,
                        'message' => 'File Harus PDF'
                    ]);
                }
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

                $dokumenName = str_replace(' ', '_', $request->no_agenda) . '_' . time() . '.' . $request->filepond->extension();
                $request->filepond->move(public_path('dokumen'), $dokumenName);
                $imagePath = 'dokumen/' . $dokumenName;
                $disposisi->dokumen = $imagePath;
                $disposisi->save();
                return response()->json([
                    'status' => 200
                ]);
                return redirect()->back();
            } else {
                if ($request->filepond) {
                    if ($request->filepond->extension() != 'pdf') {
                        return response()->json([
                            'status' => 401,
                            'message' => 'File Harus PDF'
                        ]);
                    }
                }
                $disposisi = Disposisi::where('id', $disposisi->id)
                ->update([
                    'data_pelanggar_id' => $request->data_pelanggar_id,
                    'no_agenda' => $request->no_agenda,
                    'surat_dari' => $request->surat_dari,
                    'klasifikasi' => $request->klasifikasi,
                    'derajat' => $request->derajat,
                    // 'tanggal_diterima' => $request->tanggal_diterima,
                    'tanggal_surat' => $request->tanggal_surat,
                ]);

                if ($request->filepond) {
                    $dokumenName = str_replace(' ', '_', $request->no_agenda) . '_' . time() . '.' . $request->filepond->extension();
                    $request->filepond->move(public_path('dokumen'), $dokumenName);
                    $imagePath = 'dokumen/' . $dokumenName;
                    Disposisi::where('data_pelanggar_id', $request->data_pelanggar_id)
                    ->where('type', 1)
                    ->update([
                        'dokumen' => $imagePath
                    ]);
                }
                return response()->json([
                    'status' => 200
                ]);
                return redirect()->back();
            }
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json([
                'status' => 500,
                'message' => $th->getMessage()
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
        if ($disposisi->dokumen) {
            return redirect('/'.$disposisi->dokumen);
        }
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

       try {
        if (!$disposisi) {
            $disposisi = Disposisi::create([
                'data_pelanggar_id' => $request->data_pelanggar_id,
                'no_agenda' => $request->no_agenda,
                'surat_dari' => $request->surat_dari,
                'klasifikasi' => $request->klasifikasi,
                'derajat' => $request->derajat,
                // 'tanggal_diterima' => $request->tanggal_diterima,
                'tanggal_surat' => $request->tanggal_surat,
                'type' => 2
            ]);
            $dokumenName = str_replace(' ', '_', $request->no_agenda) . '_' . time() . '.' . $request->filepond->extension();
            $request->filepond->move(public_path('dokumen'), $dokumenName);
            $imagePath = 'dokumen/' . $dokumenName;
            $disposisi->dokumen = $imagePath;
            $disposisi->save();
            return response()->json([
                'status' => 200
            ]);
            return redirect()->back();
        } else {
            $disposisi = Disposisi::where('id', $disposisi->id)
            ->update([
                'data_pelanggar_id' => $request->data_pelanggar_id,
                'no_agenda' => $request->no_agenda,
                'surat_dari' => $request->surat_dari,
                'klasifikasi' => $request->klasifikasi,
                'derajat' => $request->derajat,
                // 'tanggal_diterima' => $request->tanggal_diterima,
                'tanggal_surat' => $request->tanggal_surat,
                'type' => 2
            ]);

            if ($request->filepond) {
                $dokumenName = str_replace(' ', '_', $request->no_agenda) . '_' . time() . '.' . $request->filepond->extension();
                $request->filepond->move(public_path('dokumen'), $dokumenName);
                $imagePath = 'dokumen/' . $dokumenName;
                Disposisi::where('data_pelanggar_id', $request->data_pelanggar_id)
                ->where('type', 2)
                ->update([
                    'dokumen' => $imagePath
                ]);
            }
            return response()->json([
                'status' => 200
            ]);
            return redirect()->back();
        }
       } catch (\Throwable $th) {
        //throw $th;
            return response()->json([
                'status' => 500,
                'message' => $th->getMessage()
            ]);
       }


        $disposisi = Disposisi::where('data_pelanggar_id', $request->data_pelanggar_id)
                    ->where('type', 2)->first();
        $kasus = DataPelanggar::find($request->data_pelanggar_id);

        $template_document = new TemplateProcessor(storage_path('template_surat/disposisi_karo.docx'));
        $dt = new DateTime($disposisi->tanggal_diterima);

        $date = $dt->format('m/d/Y');
        $time = $dt->format('H:i:s');

        return redirect()->back();

        $template_document->setValues( array(
            'nomor_agenda' => $disposisi->no_agenda,
            'surat_dari' => $disposisi->surat_dari,
            'klasifikasi' => $disposisi->klasifikasi,
            'derajat' => $disposisi->derajat,
            'no_nota_dinas' => $kasus->no_nota_dinas,
            'tanggal_diterima' => Carbon::parse($date)->translatedFormat('d F Y'),
            'pukul' => $time,
            'tanggal_nota_dinas' => Carbon::parse($disposisi->tanggal_surat)->translatedFormat('d F Y'),
            'perihal_nota_dinas' => $kasus->perihal_nota_dinas
        ));
        $template_document->saveAs(storage_path('template_surat/'.$kasus->pelapor.'-surat-disposisi-karo.docx'));

        return response()->download(storage_path('template_surat/'.$kasus->pelapor.'-surat-disposisi-karo.docx'))->deleteFileAfterSend(true);
    }

    public function disposisiKaro($kasus_id)
    {

        $disposisi = Disposisi::where('data_pelanggar_id', $kasus_id)
                    ->where('type', 2)->first();
        $kasus = DataPelanggar::find($kasus_id);

        if ($disposisi->dokumen) {
            return redirect('/'.$disposisi->dokumen);
        }

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
            'perihal_nota_dinas' => $kasus->perihal_nota_dinas,
            'tanggal_nota_dinas' => Carbon::parse($disposisi->tanggal_surat)->translatedFormat('d F Y'),

        ));
        $template_document->saveAs(storage_path('template_surat/'.$kasus->pelapor.'-surat-disposisi-karo.docx'));

        return response()->download(storage_path('template_surat/'.$kasus->pelapor.'-surat-disposisi-karo.docx'))->deleteFileAfterSend(true);
    }

    public function generateDisposisiSesro(Request $request)
    {
        $disposisi = Disposisi::where('data_pelanggar_id', $request->data_pelanggar_id)
                    ->where('type', 3)->first();

        try {
            if (!$disposisi) {
                if ($request->filepond->extension() != 'pdf') {
                    return response()->json([
                        'status' => 401,
                        'message' => 'File Harus PDF'
                    ]);
                }
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
                $dokumenName = str_replace(' ', '_', $request->no_agenda) . '_' . time() . '.' . $request->filepond->extension();
                $request->filepond->move(public_path('dokumen'), $dokumenName);
                $imagePath = 'dokumen/' . $dokumenName;
                $disposisi->dokumen = $imagePath;
                $disposisi->save();
                return response()->json([
                    'status' => 200
                ]);
                return redirect()->back();
            } else {
                if ($request->filepond) {
                    if ($request->filepond->extension() != 'pdf') {
                        return response()->json([
                            'status' => 401,
                            'message' => 'File Harus PDF'
                        ]);
                    }
                }
                $disposisi = Disposisi::where('id', $disposisi->id)
                ->update([
                    'data_pelanggar_id' => $request->data_pelanggar_id,
                    'no_agenda' => $request->no_agenda,
                    'surat_dari' => $request->surat_dari,
                    'klasifikasi' => $request->klasifikasi,
                    'derajat' => $request->derajat,
                    // 'tanggal_diterima' => $request->tanggal_diterima,
                    'tanggal_surat' => $request->tanggal_surat,
                ]);

                if ($request->filepond) {
                    $dokumenName = str_replace(' ', '_', $request->no_agenda) . '_' . time() . '.' . $request->filepond->extension();
                    $request->filepond->move(public_path('dokumen'), $dokumenName);
                    $imagePath = 'dokumen/' . $dokumenName;
                    Disposisi::where('data_pelanggar_id', $request->data_pelanggar_id)
                    ->where('type', 3)
                    ->update([
                        'dokumen' => $imagePath
                    ]);
                }
                return response()->json([
                    'status' => 200
                ]);
                return redirect()->back();
            }
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 500,
                'message' => $th->getMessage()
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
            'perihal' => $kasus->perihal_nota_dinas,
            'perihal_nota_dinas' => $kasus->perihal_nota_dinas,
        ));
        $template_document->saveAs(storage_path('template_surat/'.$kasus->pelapor.'-surat-disposisi-karo.docx'));

        return response()->download(storage_path('template_surat/'.$kasus->pelapor.'-surat-disposisi-karo.docx'))->deleteFileAfterSend(true);
    }

    public function disposisiSesro($kasus_id)
    {

        $disposisi = Disposisi::where('data_pelanggar_id', $kasus_id)
                    ->where('type', 3)->first();
        $kasus = DataPelanggar::find($kasus_id);
        if ($disposisi->dokumen) {
            return redirect('/'.$disposisi->dokumen);
        }
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
