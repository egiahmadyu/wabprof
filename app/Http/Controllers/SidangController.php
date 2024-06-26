<?php

namespace App\Http\Controllers;

use App\Models\PembentukanKomisi;
use App\Models\SusunanKomisi;
use App\Models\DataPelanggar;
use App\Http\Controllers\AuditInvestigasiController;
use App\Models\KeputusanAdministratif;
use App\Models\KeputusanEtik;
use App\Models\Penuntutan;
use App\Models\SidangBanding;
use App\Models\SidangKepp;
use App\Models\SidangPeninjauan;
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
        $keputusan_etik = $request->keputusan_etik;
        $keputusan_administratif = $request->keputusan_administratif;
        unset($request['_token']);
        unset($request['keputusan_administratif']);
        unset($request['keputusan_etik']);
        $sidang = SidangKepp::create($request->all());
        if ($keputusan_etik) {
            for ($i = 0; $i < count($keputusan_etik); $i++) {

                KeputusanEtik::create([
                    'data_pelanggar_id' => $request->data_pelanggar_id,
                    'tipe_sidang' => 'sidang_kepp',
                    'keputusan' => $keputusan_etik[$i]
                ]);
            }
        }

        if ($keputusan_administratif) {
            for ($i = 0; $i < count($keputusan_administratif); $i++) {

                KeputusanAdministratif::create([
                    'data_pelanggar_id' => $request->data_pelanggar_id,
                    'tipe_sidang' => 'sidang_kepp',
                    'keputusan' => $keputusan_administratif[$i]
                ]);
            }
        }

        return redirect()->back();
    }

    public function pengajuan_sidang_banding(Request $request)
    {
        SidangBanding::create([
            'data_pelanggar_id' => $request->kasus_id
        ]);

        return redirect()->back();
    }

    public function pengajuan_ulang(Request $request)
    {
        SidangPeninjauan::create([
            'data_pelanggar_id' => $request->kasus_id
        ]);

        return redirect()->back();
    }

    public function simpan_sidang_banding(Request $request)
    {

        $keputusan_etik = $request->keputusan_etik;
        $keputusan_administratif = $request->keputusan_administratif;
        unset($request['_token']);
        unset($request['keputusan_administratif']);
        unset($request['keputusan_etik']);
        $sidang = SidangBanding::where('data_pelanggar_id', $request->data_pelanggar_id)
            ->update($request->all());
        $sidang = SidangBanding::where('data_pelanggar_id', $request->data_pelanggar_id)->first();
        if ($keputusan_etik) {
            for ($i = 0; $i < count($keputusan_etik); $i++) {
                KeputusanEtik::create([
                    'data_pelanggar_id' => $request->data_pelanggar_id,
                    'tipe_sidang' => 'sidang_banding',
                    'keputusan' => $keputusan_etik[$i]
                ]);
            }
        }
        if ($keputusan_administratif) {
            for ($i = 0; $i < count($keputusan_administratif); $i++) {
                KeputusanAdministratif::create([
                    'data_pelanggar_id' => $request->data_pelanggar_id,
                    'tipe_sidang' => 'sidang_banding',
                    'keputusan' => $keputusan_administratif[$i]
                ]);
            }
        }
        return redirect()->back();
    }

    public function simpan_sidang_kembali(Request $request)
    {

        $keputusan_etik = $request->keputusan_etik;
        $keputusan_administratif = $request->keputusan_administratif;
        unset($request['_token']);
        unset($request['keputusan_administratif']);
        unset($request['keputusan_etik']);
        $sidang = SidangPeninjauan::where('data_pelanggar_id', $request->data_pelanggar_id)
            ->update($request->all());
        $sidang = SidangPeninjauan::where('data_pelanggar_id', $request->data_pelanggar_id)->first();
        if ($keputusan_etik) {
            for ($i = 0; $i < count($keputusan_etik); $i++) {
                KeputusanEtik::create([
                    'data_pelanggar_id' => $request->data_pelanggar_id,
                    'tipe_sidang' => 'sidang_kembali',
                    'keputusan' => $keputusan_etik[$i]
                ]);
            }
        }

        if ($keputusan_administratif) {
            for ($i = 0; $i < count($keputusan_administratif); $i++) {
                KeputusanAdministratif::create([
                    'data_pelanggar_id' => $request->data_pelanggar_id,
                    'tipe_sidang' => 'sidang_kembali',
                    'keputusan' => $keputusan_administratif[$i]
                ]);
            }
        }
        return redirect()->back();
    }

    public function laporan_hasil_sidang_kepp(Request $request)
    {
        $sidang = SidangKepp::where('data_pelanggar_id', $request->kasus_id)->first();
        if ($sidang->no_surat_lhs == null) {
            $sidang->no_surat_lhs = $request->no_surat_lhs;
            $sidang->tanggal_lhs = $request->tanggal_lhs;
            $sidang->nomor_putusan = $request->nomor_putusan;
            $sidang->tanggal_putusan = $request->tanggal_putusan;
            $sidang->save();
        }
        $kasus = DataPelanggar::find($request->kasus_id);
        $penuntutan = Penuntutan::where('data_pelanggar_id', $kasus->id)->first();
        $template_document = new TemplateProcessor(storage_path('template_surat/laporan_hasil_sidang.docx'));
        $template_document->setValues(array(
            'no_surat_lhs' => $sidang->no_surat_lhs,
            'bt_lhs' => Carbon::parse($sidang->tanggal_lhs)->translatedFormat('F Y'),
            'jenis_sidang' => 'KEPP',
            'no_kep_pembentukan' => $penuntutan->no_pembentukan_komisi,
            'tanggal_kep_pembentukan' => Carbon::parse($penuntutan->tanggal_pembentukan_komisi)->translatedFormat('d F Y'),
            'nomor_putusan' => $sidang->nomor_putusan,
            'tanggal_putusan' => Carbon::parse($sidang->tanggal_putusan)->translatedFormat('d F Y'),
            'terlapor' => $kasus->terlapor,
            'kronologi' => $kasus->kronologi,
            'nama_korban' => $kasus->nama_korban,
            'tempat_kejadian' => $kasus->tempat_kejadian,
            'nrp' => $kasus->nrp,
            'pangkat' =>  $kasus->pangkat ? $kasus->pangkat->name : 'Pangkat Belum Dipilih',
            'kesatuan' => $kasus->kesatuan,
            'jabatan' => $kasus->jabatan,
            'agama' => $kasus->religi ? $kasus->religi->name : '',

        ));
        $template_document->saveAs(storage_path('template_surat/' . $kasus->pelapor . '-laporan_hasil_sidang.docx'));

        return response()->download(storage_path('template_surat/' . $kasus->pelapor . '-laporan_hasil_sidang.docx'))->deleteFileAfterSend(true);
    }

    public function laporan_hasil_sidang_banding(Request $request)
    {
        $sidang = SidangBanding::where('data_pelanggar_id', $request->kasus_id)->first();
        if ($sidang->no_surat_lhs == null) {
            $sidang->no_surat_lhs = $request->no_surat_lhs;
            $sidang->tanggal_lhs = $request->tanggal_lhs;
            $sidang->nomor_putusan = $request->nomor_putusan;
            $sidang->tanggal_putusan = $request->tanggal_putusan;
            $sidang->save();
        }
        $kasus = DataPelanggar::find($request->kasus_id);
        $penuntutan = Penuntutan::where('data_pelanggar_id', $kasus->id)->first();
        $template_document = new TemplateProcessor(storage_path('template_surat/laporan_hasil_sidang.docx'));
        $template_document->setValues(array(
            'no_surat_lhs' => $sidang->no_surat_lhs,
            'bt_lhs' => Carbon::parse($sidang->tanggal_lhs)->translatedFormat('F Y'),
            'jenis_sidang' => 'Banding',
            'no_kep_pembentukan' => $penuntutan->no_pembentukan_komisi,
            'tanggal_kep_pembentukan' => Carbon::parse($penuntutan->tanggal_pembentukan_komisi)->translatedFormat('d F Y'),
            'nomor_putusan' => $sidang->nomor_putusan,
            'tanggal_putusan' => Carbon::parse($sidang->tanggal_putusan)->translatedFormat('d F Y'),
            'terlapor' => $kasus->terlapor,
            'kronologi' => $kasus->kronologi,
            'nama_korban' => $kasus->nama_korban,
            'tempat_kejadian' => $kasus->tempat_kejadian,
            'nrp' => $kasus->nrp,
            'pangkat' =>  $kasus->pangkat ? $kasus->pangkat->name : 'Pangkat Belum Dipilih',
            'kesatuan' => $kasus->kesatuan,
            'jabatan' => $kasus->jabatan,
            'agama' => $kasus->religi ? $kasus->religi->name : '',

        ));
        $template_document->saveAs(storage_path('template_surat/' . $kasus->pelapor . '-laporan_hasil_sidang.docx'));

        return response()->download(storage_path('template_surat/' . $kasus->pelapor . '-laporan_hasil_sidang.docx'))->deleteFileAfterSend(true);
    }

    public function laporan_hasil_sidang_kembali(Request $request)
    {
        $sidang = SidangPeninjauan::where('data_pelanggar_id', $request->kasus_id)->first();
        if ($sidang->no_surat_lhs == null) {
            $sidang->no_surat_lhs = $request->no_surat_lhs;
            $sidang->tanggal_lhs = $request->tanggal_lhs;
            $sidang->nomor_putusan = $request->nomor_putusan;
            $sidang->tanggal_putusan = $request->tanggal_putusan;
            $sidang->save();
        }
        $kasus = DataPelanggar::find($request->kasus_id);
        $penuntutan = Penuntutan::where('data_pelanggar_id', $kasus->id)->first();
        $template_document = new TemplateProcessor(storage_path('template_surat/laporan_hasil_sidang.docx'));
        $template_document->setValues(array(
            'no_surat_lhs' => $sidang->no_surat_lhs,
            'bt_lhs' => Carbon::parse($sidang->tanggal_lhs)->translatedFormat('F Y'),
            'jenis_sidang' => 'Peninjauan Kembali',
            'no_kep_pembentukan' => $penuntutan->no_pembentukan_komisi,
            'tanggal_kep_pembentukan' => Carbon::parse($penuntutan->tanggal_pembentukan_komisi)->translatedFormat('d F Y'),
            'nomor_putusan' => $sidang->nomor_putusan,
            'tanggal_putusan' => Carbon::parse($sidang->tanggal_putusan)->translatedFormat('d F Y'),
            'terlapor' => $kasus->terlapor,
            'kronologi' => $kasus->kronologi,
            'nama_korban' => $kasus->nama_korban,
            'tempat_kejadian' => $kasus->tempat_kejadian,
            'nrp' => $kasus->nrp,
            'pangkat' =>  $kasus->pangkat ? $kasus->pangkat->name : 'Pangkat Belum Dipilih',
            'kesatuan' => $kasus->kesatuan,
            'jabatan' => $kasus->jabatan,
            'agama' => $kasus->religi ? $kasus->religi->name : '',

        ));
        $template_document->saveAs(storage_path('template_surat/' . $kasus->pelapor . '-laporan_hasil_sidang.docx'));

        return response()->download(storage_path('template_surat/' . $kasus->pelapor . '-laporan_hasil_sidang.docx'))->deleteFileAfterSend(true);
    }
}
