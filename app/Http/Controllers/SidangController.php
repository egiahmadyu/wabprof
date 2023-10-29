<?php

namespace App\Http\Controllers;

use App\Models\PembentukanKomisi;
use App\Models\SusunanKomisi;
use App\Models\DataPelanggar;
use App\Http\Controllers\AuditInvestigasiController;
use App\Models\SidangBanding;
use App\Models\SidangKepp;
use Carbon\Carbon;
use Illuminate\Http\Request;
use PhpOffice\PhpWord\TemplateProcessor;

class SidangController extends Controller
{
    public function generatePembentukanKomisi(Request $request)
    {
        $pembentukan_data = PembentukanKomisi::where('data_pelanggar_id', $request->data_pelanggar_id)->first();
        if (!$pembentukan_data) {
            $pembentukan_data = PembentukanKomisi::create([
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

            for ($i = 0; $i < count($request->nama_komisi); $i++) {
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

        $data['bulan_tahun_pembentukan'] = Carbon::parse($pembentukan_data->created_at)->translatedFormat('F Y');
        $data['tanggal_pembentukan'] = Carbon::parse($pembentukan_data->created_at)->translatedFormat('d F Y');
        $data['nomor_pembentukan'] = $pembentukan_data->nomor;
        $data['nomor_surat_divkum'] = $pembentukan_data->nomor_surat_divkum;
        $data['tanggal_surat_divkum'] = Carbon::parse($pembentukan_data->tanggal_surat_divkum)->translatedFormat('d F Y');
        $data['pangkat_pelanggar'] = $pembentukan_data->pangkat;
        $data['nama_pelanggar'] = $pembentukan_data->nama;
        $data['jabtan_pelanggar'] = $pembentukan_data->jabatan;
        $data['kesatuan_pelanggar'] = $pembentukan_data->kesatuan;

        $template_document->setValues($value);
        $template_document->saveAs(storage_path('template_surat/pembentukan-komisi-kode-etik.docx'));

        return response()->download(storage_path('template_surat/pembentukan-komisi-kode-etik.docx'))->deleteFileAfterSend(true);
    }

    public function pembentukanKomisi($kasus_id)
    {
        $kasus = DataPelanggar::where('id', $kasus_id)->first();
        $value = AuditInvestigasiController::valueDoc($kasus_id, false, false, false, false, false, false, false, false, false, true);
        $template_document = new TemplateProcessor(storage_path('template_surat/pembentukan_komisi.docx'));
        $template_document->setValues($value);
        $template_document->saveAs(storage_path('template_surat/' . $kasus->pelapor . '-pembentukan-komisi.docx'));

        return response()->download(storage_path('template_surat/' . $kasus->pelapor . '-pembentukan-komisi.docx'))->deleteFileAfterSend(true);
    }

    public function usulanPembentukanKomisi(Request $request, $kasus_id = null)
    {
        $kasus = DataPelanggar::where('id', $kasus_id ?? $request->data_pelanggar_id)->first();
        $value = AuditInvestigasiController::valueDoc($kasus_id, true, false, false, false, false, false, false, false, false, false);
        $template_document = new TemplateProcessor(storage_path('template_surat/usulan_pembentukan_komisi_kode_etik.docx'));
        $template_document->setValues($value);
        $template_document->saveAs(storage_path('template_surat/' . $kasus->pelapor . '-usulan-pembentukan-komisi-kode-etik.docx'));

        return response()->download(storage_path('template_surat/' . $kasus->pelapor . '-usulan-pembentukan-komisi-kode-etik.docx'))->deleteFileAfterSend(true);
    }

    public function pendampingDivkum($kasus_id)
    {
        $kasus = DataPelanggar::where('id', $kasus_id)->first();
        $value = AuditInvestigasiController::valueDoc($kasus_id, false, false, false, false, false, false, false, false, false, true);
        $template_document = new TemplateProcessor(storage_path('template_surat/pendamping_divkum.docx'));
        $template_document->setValues($value);
        $template_document->saveAs(storage_path('template_surat/' . $kasus->pelapor . '-pendamping-divkum.docx'));

        return response()->download(storage_path('template_surat/' . $kasus->pelapor . '-pendamping-divkum.docx'))->deleteFileAfterSend(true);
    }

    public function panggilanPelanggar($kasus_id)
    {
        $kasus = DataPelanggar::where('id', $kasus_id)->first();
        $value = AuditInvestigasiController::valueDoc($kasus_id, false, false, false, false, false, false, false, false, false, true);
        $template_document = new TemplateProcessor(storage_path('template_surat/panggilan_pelanggar.docx'));
        $template_document->setValues($value);
        $template_document->saveAs(storage_path('template_surat/' . $kasus->pelapor . '-panggilan-pelangar.docx'));

        return response()->download(storage_path('template_surat/' . $kasus->pelapor . '-panggilan-pelangar.docx'))->deleteFileAfterSend(true);
    }

    public function panggilanPelanggarSatker($kasus_id)
    {
        $kasus = DataPelanggar::where('id', $kasus_id)->first();
        $value = AuditInvestigasiController::valueDoc($kasus_id, false, false, false, false, false, false, false, false, false, true);
        $template_document = new TemplateProcessor(storage_path('template_surat/panggilan_pelanggar_satker.docx'));
        $template_document->setValues($value);
        $template_document->saveAs(storage_path('template_surat/' . $kasus->pelapor . '-panggilan-pelangar-satker.docx'));

        return response()->download(storage_path('template_surat/' . $kasus->pelapor . '-panggilan-pelangar-satker.docx'))->deleteFileAfterSend(true);
    }

    public function panggilanSaksiSdm($kasus_id)
    {
        $kasus = DataPelanggar::where('id', $kasus_id)->first();
        $value = AuditInvestigasiController::valueDoc($kasus_id, false, false, false, false, false, false, false, false, false, true);
        $template_document = new TemplateProcessor(storage_path('template_surat/panggilan_saksi_ahli_sdm.docx'));
        $template_document->setValues($value);
        $template_document->saveAs(storage_path('template_surat/' . $kasus->pelapor . '-panggilan-saksi-ahli-sdm.docx'));

        return response()->download(storage_path('template_surat/' . $kasus->pelapor . '-panggilan-saksi-ahli-sdm.docx'))->deleteFileAfterSend(true);
    }

    public function panggilanSaksiAnggota($kasus_id)
    {
        $kasus = DataPelanggar::where('id', $kasus_id)->first();
        $value = AuditInvestigasiController::valueDoc($kasus_id, false, false, false, false, false, false, false, false, false, true);
        $template_document = new TemplateProcessor(storage_path('template_surat/panggilan_saksi_anggota.docx'));
        $template_document->setValues($value);
        $template_document->saveAs(storage_path('template_surat/' . $kasus->pelapor . '-panggilan-saksi-anggota.docx'));

        return response()->download(storage_path('template_surat/' . $kasus->pelapor . '-panggilan-saksi-anggota.docx'))->deleteFileAfterSend(true);
    }

    public function suratDaftarNamaTerlampir($kasus_id)
    {
        $kasus = DataPelanggar::where('id', $kasus_id)->first();
        $value = AuditInvestigasiController::valueDoc($kasus_id, false, false, false, false, false, false, false, false, false, true);
        $template_document = new TemplateProcessor(storage_path('template_surat/surat_daftar_nama_terlampir.docx'));
        $template_document->setValues($value);
        $template_document->saveAs(storage_path('template_surat/' . $kasus->pelapor . '-surat-daftar-nama-terlampir.docx'));

        return response()->download(storage_path('template_surat/' . $kasus->pelapor . '-surat-daftar-nama-terlampir.docx'))->deleteFileAfterSend(true);
    }

    public function putusanSidang($kasus_id)
    {
        $kasus = DataPelanggar::where('id', $kasus_id)->first();
        $value = AuditInvestigasiController::valueDoc($kasus_id, false, false, false, false, false, false, false, false, false, true);
        $template_document = new TemplateProcessor(storage_path('template_surat/putusan_sidang_kepp.docx'));
        $template_document->setValues($value);
        $template_document->saveAs(storage_path('template_surat/' . $kasus->pelapor . '-putusan-sidang-kepp.docx'));

        return response()->download(storage_path('template_surat/' . $kasus->pelapor . '-putusan-sidang-kepp.docx'))->deleteFileAfterSend(true);
    }


    public function pengirimanPutusanSidang($kasus_id)
    {
        $kasus = DataPelanggar::where('id', $kasus_id)->first();
        $value = AuditInvestigasiController::valueDoc($kasus_id, false, false, false, false, false, false, false, false, false, true);
        $template_document = new TemplateProcessor(storage_path('template_surat/pengiriman_putusan_sidang.docx'));
        $template_document->setValues($value);
        $template_document->saveAs(storage_path('template_surat/' . $kasus->pelapor . '-pengiriman-putusan-sidang.docx'));

        return response()->download(storage_path('template_surat/' . $kasus->pelapor . '-pengiriman-putusan-sidang.docx'))->deleteFileAfterSend(true);
    }


    public function simpan_sidang_kepp(Request $request)
    {
        $keputusan_terbukti = $request->keputusan_terbukti;
        unset($request['_token']);
        unset($request['keputusan_terbukti']);
        $sidang = SidangKepp::create($request->all());
        for ($i = 0; $i < count($keputusan_terbukti); $i++) {
            if ($keputusan_terbukti[$i] == 'Keputusan Etik') $sidang->keputusan_etik = 1;
            elseif ($keputusan_terbukti[$i] == 'Keputusan Administratif') $sidang->keputusan_administratif = 1;
            $sidang->save();
        }
        return redirect()->back();
    }

    public function pengajuan_sidang_banding(Request $request)
    {
        SidangBanding::create([
            'data_pelanggar_id' => $request->kasus_id,
            'tanggal_permohonan_sidang_banding' => date('Y-m-d')
        ]);

        return redirect()->back();
    }

    public function simpan_sidang_banding(Request $request)
    {
        unset($request['_token']);
        $keputusan_terbukti = $request->keputusan_terbukti;
        unset($request['keputusan_terbukti']);
        $sidang = SidangBanding::where('data_pelanggar_id', $request->data_pelanggar_id)
            ->update($request->all());
        $sidang = SidangBanding::where('data_pelanggar_id', $request->data_pelanggar_id)->first();
        for ($i = 0; $i < count($keputusan_terbukti); $i++) {
            if ($keputusan_terbukti[$i] == 'Keputusan Etik') $sidang->keputusan_etik = 1;
            elseif ($keputusan_terbukti[$i] == 'Keputusan Administratif') $sidang->keputusan_administratif = 1;
            $sidang->save();
        }
        return redirect()->back();
    }
}
