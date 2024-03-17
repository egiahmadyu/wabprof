<?php

namespace App\Http\Controllers;

use App\Models\DataPelanggar;
use App\Models\Lpa;
use App\Models\Pemberkasan;
use App\Models\Penuntutan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use PhpOffice\PhpWord\TemplateProcessor;

class PenuntutanController extends Controller
{
    public function simpan_data(Request $request)
    {
        unset($request['_token']);
        $data_pelanggar_id = $request->data_pelanggar_id;
        unset($request['data_pelanggar_id']);
        Penuntutan::where('data_pelanggar_id', $data_pelanggar_id)
            ->update($request->all());

        return redirect()->back();
    }

    public function permohonan_saran_hukum(Request $request)
    {
        if (!$penuntutan = Penuntutan::where('data_pelanggar_id', $request->data_pelanggar_id)->first()) {
            unset($request['_token']);
            $penuntutan = Penuntutan::create($request->all());
        }

        $template_document = new TemplateProcessor(storage_path('template_surat/permohonan_pendapat.docx'));
        $lpa = Lpa::where('data_pelanggar_id', $request->data_pelanggar_id)->first();

        $kasus = DataPelanggar::find($request->data_pelanggar_id);
        $template_document->setValues(array(
            'nomor_surat_saran_hukum' => $penuntutan->permohonan_pendapat_dan_saran,
            'bt_ssh' => Carbon::parse($penuntutan->tgl_permohonan_pendapat_dan_saran)->translatedFormat('d F Y'),
            'no_usulan_pembentukan_komisi' => $penuntutan->no_usulan_pembentukan_komisi,
            'bt_usulan_pembentukan' => Carbon::parse(date('Y-m-d'))->translatedFormat('d F Y'),
            'no_divkum' => $penuntutan->no_divkum,
            'tanggal_divkum' => Carbon::parse($penuntutan->tanggal_divkum)->translatedFormat('d F Y'),
            'nomor_lpa' => $lpa->nomor_surat,
            'pasal_lpa' => $lpa->pasal_yang_dilanggar,
            'tanggal_lpa' => Carbon::parse($lpa->created_at)->translatedFormat('d F Y'),
            'terlapor' => $kasus->terlapor,
            'kronologi' => $kasus->kronologi,
            'nrp' => $kasus->nrp,
            'pangkat' =>  $kasus->pangkat ? $kasus->pangkat->name : 'Pangkat Belum Dipilih',
            'kesatuan' => $kasus->kesatuan,
            'jabatan' => $kasus->jabatan,
            'wujud_perbuatan' => $kasus->wujud_perbuatan ? $kasus->wujud_perbuatan->keterangan_wp : '',
            'perihal' => 'pendapat dan saran hukum'
        ));
        $template_document->saveAs(storage_path('template_surat/' . $kasus->pelapor . '-permohonan_pendapat.docx'));

        return response()->download(storage_path('template_surat/' . $kasus->pelapor . '-permohonan_pendapat.docx'))->deleteFileAfterSend(true);
    }

    public function usulan_pembentukan_komisi(Request $request)
    {
        $penuntutan = Penuntutan::where('data_pelanggar_id', $request->kasus_id)->first();
        if ($penuntutan->no_usulan_pembentukan_komisi == null) {
            $penuntutan->no_usulan_pembentukan_komisi = $request->no_usulan_pembentukan_komisi;
            $penuntutan->save();
        }
        $pemberkasan = Pemberkasan::where('data_pelanggar_id', $request->kasus_id)->first();
        $template_document = new TemplateProcessor(storage_path('template_surat/usulan_pembentukan_komisi_kode_etik.docx'));
        $lpa = Lpa::where('data_pelanggar_id', $request->kasus_id)->first();


        $kasus = DataPelanggar::find($request->kasus_id);
        $template_document->setValues(array(
            'tanggal_sidang' => Carbon::parse($pemberkasan->tgl_sidang)->translatedFormat('d F Y'),
            'hari_sidang' => Carbon::parse($pemberkasan->tgl_sidang)->translatedFormat('l'),
            'ruangan_sidang' => $pemberkasan->tempat_sidang,
            'jam_sidang' => $pemberkasan->jam_sidang,
            'no_usulan_pembentukan_komisi' => $penuntutan->no_usulan_pembentukan_komisi,
            'bt_usulan_pembentukan' =>  Carbon::parse(date('Y-m-d'))->translatedFormat('d F Y'),
            'no_divkum' => $penuntutan->no_divkum,
            'tanggal_divkum' => Carbon::parse($penuntutan->tanggal_divkum)->translatedFormat('d F Y'),
            'no_lpa' => $lpa->nomor_surat,
            'tanggal_lpa' => Carbon::parse($lpa->created_at)->translatedFormat('d F Y'),
            'no_bp3kepp' => $pemberkasan->no_bp3kepp,
            'tanggal_bp3kepp' => Carbon::parse($pemberkasan->tgl_bp3kepp)->translatedFormat('d F Y'),
            'terlapor' => $kasus->terlapor,
            'kronologi' => $kasus->kronologi,
            'nrp' => $kasus->nrp,
            'pangkat' =>  $kasus->pangkat ? $kasus->pangkat->name : 'Pangkat Belum Dipilih',
            'kesatuan' => $kasus->kesatuan,
            'jabatan' => $kasus->jabatan,
            'wujud_perbuatan' => $kasus->wujud_perbuatan ? $kasus->wujud_perbuatan->keterangan_wp : '',
            'perihal' => 'pendapat dan saran hukum'
        ));
        $template_document->saveAs(storage_path('template_surat/' . $kasus->pelapor . '-usulan-pembentukan-komisi-kode-etik.docx'));

        return response()->download(storage_path('template_surat/' . $kasus->pelapor . '-usulan-pembentukan-komisi-kode-etik.docx'))->deleteFileAfterSend(true);
    }

    public function pembentukan_komisi(Request $request)
    {
        $penuntutan = Penuntutan::where('data_pelanggar_id', $request->kasus_id)->first();
        if ($penuntutan->no_pembentukan_komisi == null) {
            $penuntutan->no_pembentukan_komisi = $request->no_pembentukan_komisi;
            $penuntutan->tanggal_pembentukan_komisi = $request->tanggal_pembentukan_komisi;
            $penuntutan->save();
        }


        $lpa = Lpa::where('data_pelanggar_id', $request->kasus_id)->first();
        $pemberkasan = Pemberkasan::where('data_pelanggar_id', $request->kasus_id)->first();
        $kasus = DataPelanggar::find($request->kasus_id);
        $template_document = new TemplateProcessor(storage_path('template_surat/pembentukan_komisi.docx'));
        $template_document->setValues(array(
            'tanggal_sidang' => Carbon::parse($pemberkasan->tgl_sidang)->translatedFormat('d F Y'),
            'hari_sidang' => Carbon::parse($pemberkasan->tgl_sidang)->translatedFormat('l'),
            'ruangan_sidang' => $pemberkasan->tempat_sidang,
            'jam_sidang' => $pemberkasan->jam_sidang,
            'no_usulan_pembentukan_komisi' => $penuntutan->no_usulan_pembentukan_komisi,
            'no_divkum' => $penuntutan->no_divkum,
            'tanggal_divkum' => Carbon::parse($penuntutan->tanggal_divkum)->translatedFormat('d F Y'),
            'no_lpa' => $lpa->nomor_surat,
            'tanggal_lpa' => Carbon::parse($lpa->created_at)->translatedFormat('d F Y'),
            'no_bp3kepp' => $pemberkasan->no_bp3kepp,
            'tanggal_bp3kepp' => Carbon::parse($pemberkasan->tgl_bp3kepp)->translatedFormat('d F Y'),
            'terlapor' => $kasus->terlapor,
            'kronologi' => $kasus->kronologi,
            'nrp' => $kasus->nrp,
            'pangkat' =>  $kasus->pangkat ? $kasus->pangkat->name : 'Pangkat Belum Dipilih',
            'kesatuan' => $kasus->kesatuan,
            'jabatan' => $kasus->jabatan,
            'wujud_perbuatan' => $kasus->wujud_perbuatan ? $kasus->wujud_perbuatan->keterangan_wp : '',
            'nomor_pembentukan' => $penuntutan->no_pembentukan_komisi,
            'tanggal_pembentukan' => Carbon::parse($penuntutan->tanggal_pembentukan_komisi)->translatedFormat('d F Y'),
            'bulan_tahun_pembentukan' => Carbon::parse($penuntutan->tanggal_pembentukan_komisi)->translatedFormat('F Y'),
        ));
        $template_document->saveAs(storage_path('template_surat/' . $kasus->pelapor . '-pembentukan-komisi.docx'));

        return response()->download(storage_path('template_surat/' . $kasus->pelapor . '-pembentukan-komisi.docx'))->deleteFileAfterSend(true);
    }

    public function pendamping_divkum(Request $request)
    {
        $penuntutan = Penuntutan::where('data_pelanggar_id', $request->kasus_id)->first();
        if ($penuntutan->no_pendamping_divkum == null) {
            $penuntutan->no_pendamping_divkum = $request->no_pendamping_divkum;
            $penuntutan->tanggal_pendamping_divkum = $request->tanggal_pendamping_divkum;
            $penuntutan->save();
        }


        $lpa = Lpa::where('data_pelanggar_id', $request->kasus_id)->first();
        $pemberkasan = Pemberkasan::where('data_pelanggar_id', $request->kasus_id)->first();
        $kasus = DataPelanggar::find($request->kasus_id);
        $template_document = new TemplateProcessor(storage_path('template_surat/pendamping_divkum.docx'));
        $template_document->setValues(array(
            'tanggal_sidang' => Carbon::parse($pemberkasan->tgl_sidang)->translatedFormat('d F Y'),
            'hari_sidang' => Carbon::parse($pemberkasan->tgl_sidang)->translatedFormat('l'),
            'ruangan_sidang' => $pemberkasan->tempat_sidang,
            'jam_sidang' => $pemberkasan->jam_sidang,
            'pakaian_sidang' => $pemberkasan->pakaian_sidang,
            'no_usulan_pembentukan_komisi' => $penuntutan->no_usulan_pembentukan_komisi,
            'no_divkum' => $penuntutan->no_divkum,
            'tanggal_divkum' => Carbon::parse($penuntutan->tanggal_divkum)->translatedFormat('d F Y'),
            'no_lpa' => $lpa->nomor_surat,
            'tanggal_lpa' => Carbon::parse($lpa->created_at)->translatedFormat('d F Y'),
            'no_bp3kepp' => $pemberkasan->no_bp3kepp,
            'tanggal_bp3kepp' => Carbon::parse($pemberkasan->tgl_bp3kepp)->translatedFormat('d F Y'),
            'terlapor' => $kasus->terlapor,
            'kronologi' => $kasus->kronologi,
            'nrp' => $kasus->nrp,
            'pangkat' =>  $kasus->pangkat ? $kasus->pangkat->name : 'Pangkat Belum Dipilih',
            'kesatuan' => $kasus->kesatuan,
            'jabatan' => $kasus->jabatan,
            'wujud_perbuatan' => $kasus->wujud_perbuatan ? $kasus->wujud_perbuatan->keterangan_wp : '',
            'nomor_pembentukan' => $penuntutan->no_pembentukan_komisi,
            'tanggal_pembentukan' => Carbon::parse($penuntutan->tanggal_pembentukan_komisi)->translatedFormat('d F Y'),
            'bulan_tahun_pembentukan' => Carbon::parse($penuntutan->tanggal_pembentukan_komisi)->translatedFormat('F Y'),
            'nomor_pendamping_divkum' => $penuntutan->no_pendamping_divkum,
            'tanggal_pendamping_divkum' => Carbon::parse($penuntutan->tanggal_pendamping_divkum)->translatedFormat('d F Y'),
            'bulan_tahun_pendamping_divkum' => Carbon::parse($penuntutan->tanggal_pendamping_divkum)->translatedFormat('F Y'),
        ));
        $template_document->saveAs(storage_path('template_surat/' . $kasus->pelapor . '-pendamping_divkum.docx'));

        return response()->download(storage_path('template_surat/' . $kasus->pelapor . '-pendamping_divkum.docx'))->deleteFileAfterSend(true);
    }

    public function panggilan_pelanggar(Request $request)
    {
        $penuntutan = Penuntutan::where('data_pelanggar_id', $request->kasus_id)->first();
        if ($penuntutan->no_panggilan_pelanggar == null) {
            $penuntutan->no_panggilan_pelanggar = $request->no_panggilan_pelanggar;
            $penuntutan->tanggal_panggilan_pelanggar = $request->tanggal_panggilan_pelanggar;
            $penuntutan->save();
        }


        $lpa = Lpa::where('data_pelanggar_id', $request->kasus_id)->first();
        $pemberkasan = Pemberkasan::where('data_pelanggar_id', $request->kasus_id)->first();
        $kasus = DataPelanggar::find($request->kasus_id);
        $template_document = new TemplateProcessor(storage_path('template_surat/panggilan_pelanggar.docx'));
        $template_document->setValues(array(
            'tanggal_sidang' => Carbon::parse($pemberkasan->tgl_sidang)->translatedFormat('d F Y'),
            'hari_sidang' => Carbon::parse($pemberkasan->tgl_sidang)->translatedFormat('l'),
            'ruangan_sidang' => $pemberkasan->tempat_sidang,
            'jam_sidang' => $pemberkasan->jam_sidang,
            'pakaian_sidang' => $pemberkasan->pakaian_sidang,
            'no_usulan_pembentukan_komisi' => $penuntutan->no_usulan_pembentukan_komisi,
            'no_divkum' => $penuntutan->no_divkum,
            'tanggal_divkum' => Carbon::parse($penuntutan->tanggal_divkum)->translatedFormat('d F Y'),
            'no_lpa' => $lpa->nomor_surat,
            'tanggal_lpa' => Carbon::parse($lpa->created_at)->translatedFormat('d F Y'),
            'no_bp3kepp' => $pemberkasan->no_bp3kepp,
            'tanggal_bp3kepp' => Carbon::parse($pemberkasan->tgl_bp3kepp)->translatedFormat('d F Y'),
            'terlapor' => $kasus->terlapor,
            'kronologi' => $kasus->kronologi,
            'nrp' => $kasus->nrp,
            'pangkat' =>  $kasus->pangkat ? $kasus->pangkat->name : 'Pangkat Belum Dipilih',
            'kesatuan' => $kasus->kesatuan,
            'jabatan' => $kasus->jabatan,
            'wujud_perbuatan' => $kasus->wujud_perbuatan ? $kasus->wujud_perbuatan->keterangan_wp : '',
            'nomor_pembentukan' => $penuntutan->no_pembentukan_komisi,
            'tanggal_pembentukan' => Carbon::parse($penuntutan->tanggal_pembentukan_komisi)->translatedFormat('d F Y'),
            'bulan_tahun_pembentukan' => Carbon::parse($penuntutan->tanggal_pembentukan_komisi)->translatedFormat('F Y'),
            'nomor_surat_panggilan_pelanggar' => $penuntutan->no_panggilan_pelanggar,
            'tanggal_panggilan_pelanggar' => Carbon::parse($penuntutan->tanggal_panggilan_pelanggar)->translatedFormat('d F Y'),
            'bulan_tahun_panggilan_pelanggar' => Carbon::parse($penuntutan->tanggal_panggilan_pelanggar)->translatedFormat('F Y'),
        ));
        $template_document->saveAs(storage_path('template_surat/' . $kasus->pelapor . '-panggilan_pelanggar.docx'));
        return response()->download(storage_path('template_surat/' . $kasus->pelapor . '-panggilan_pelanggar.docx'))->deleteFileAfterSend(true);
    }

    public function panggilan_pelanggar_satker(Request $request)
    {
        $penuntutan = Penuntutan::where('data_pelanggar_id', $request->kasus_id)->first();
        if ($penuntutan->no_panggilan_pelanggar_satker == null) {
            $penuntutan->no_panggilan_pelanggar_satker = $request->no_panggilan_pelanggar_satker;
            $penuntutan->tanggal_panggilan_pelanggan_satker = $request->tanggal_panggilan_pelanggan_satker;
            $penuntutan->save();
        }


        $lpa = Lpa::where('data_pelanggar_id', $request->kasus_id)->first();
        $pemberkasan = Pemberkasan::where('data_pelanggar_id', $request->kasus_id)->first();
        $kasus = DataPelanggar::find($request->kasus_id);
        $template_document = new TemplateProcessor(storage_path('template_surat/panggilan_pelanggar_satker.docx'));
        $template_document->setValues(array(
            'tanggal_sidang' => Carbon::parse($pemberkasan->tgl_sidang)->translatedFormat('d F Y'),
            'hari_sidang' => Carbon::parse($pemberkasan->tgl_sidang)->translatedFormat('l'),
            'ruangan_sidang' => $pemberkasan->tempat_sidang,
            'jam_sidang' => $pemberkasan->jam_sidang,
            'pakaian_sidang' => $pemberkasan->pakaian_sidang,
            'no_usulan_pembentukan_komisi' => $penuntutan->no_usulan_pembentukan_komisi,
            'no_divkum' => $penuntutan->no_divkum,
            'tanggal_divkum' => Carbon::parse($penuntutan->tanggal_divkum)->translatedFormat('d F Y'),
            'no_lpa' => $lpa->nomor_surat,
            'tanggal_lpa' => Carbon::parse($lpa->created_at)->translatedFormat('d F Y'),
            'no_bp3kepp' => $pemberkasan->no_bp3kepp,
            'tanggal_bp3kepp' => Carbon::parse($pemberkasan->tgl_bp3kepp)->translatedFormat('d F Y'),
            'terlapor' => $kasus->terlapor,
            'kronologi' => $kasus->kronologi,
            'nrp' => $kasus->nrp,
            'pangkat' =>  $kasus->pangkat ? $kasus->pangkat->name : 'Pangkat Belum Dipilih',
            'kesatuan' => $kasus->kesatuan,
            'jabatan' => $kasus->jabatan,
            'wujud_perbuatan' => $kasus->wujud_perbuatan ? $kasus->wujud_perbuatan->keterangan_wp : '',
            'nomor_pembentukan' => $penuntutan->no_pembentukan_komisi,
            'tanggal_pembentukan' => Carbon::parse($penuntutan->tanggal_pembentukan_komisi)->translatedFormat('d F Y'),
            'bulan_tahun_pembentukan' => Carbon::parse($penuntutan->tanggal_pembentukan_komisi)->translatedFormat('F Y'),
            'nomor_surat_panggilan_satker' => $penuntutan->no_panggilan_pelanggar_satker,
            'tanggal_panggilan_pelanggar_satker' => Carbon::parse($penuntutan->tanggal_panggilan_pelanggar_satker)->translatedFormat('d F Y'),
            'bulan_tahun_panggilan_satker' => Carbon::parse($penuntutan->tanggal_panggilan_pelanggar_satker)->translatedFormat('F Y'),
        ));
        $template_document->saveAs(storage_path('template_surat/' . $kasus->pelapor . '-panggilan_pelanggar_satker.docx'));
        return response()->download(storage_path('template_surat/' . $kasus->pelapor . '-panggilan_pelanggar_satker.docx'))->deleteFileAfterSend(true);
    }

    public function panggilan_saksi_anggota(Request $request)
    {
        $penuntutan = Penuntutan::where('data_pelanggar_id', $request->kasus_id)->first();
        if ($penuntutan->no_panggilan_saksi_anggota == null) {
            $penuntutan->no_panggilan_saksi_anggota = $request->no_panggilan_saksi_anggota;
            $penuntutan->tanggal_panggilan_saksi_anggota = $request->tanggal_panggilan_saksi_anggota;
            $penuntutan->save();
        }


        $lpa = Lpa::where('data_pelanggar_id', $request->kasus_id)->first();
        $pemberkasan = Pemberkasan::where('data_pelanggar_id', $request->kasus_id)->first();
        $kasus = DataPelanggar::find($request->kasus_id);
        $template_document = new TemplateProcessor(storage_path('template_surat/panggilan_saksi_anggota.docx'));
        $template_document->setValues(array(
            'tanggal_sidang' => Carbon::parse($pemberkasan->tgl_sidang)->translatedFormat('d F Y'),
            'hari_sidang' => Carbon::parse($pemberkasan->tgl_sidang)->translatedFormat('l'),
            'ruangan_sidang' => $pemberkasan->tempat_sidang,
            'jam_sidang' => $pemberkasan->jam_sidang,
            'pakaian_sidang' => $pemberkasan->pakaian_sidang,
            'no_usulan_pembentukan_komisi' => $penuntutan->no_usulan_pembentukan_komisi,
            'no_divkum' => $penuntutan->no_divkum,
            'tanggal_divkum' => Carbon::parse($penuntutan->tanggal_divkum)->translatedFormat('d F Y'),
            'no_lpa' => $lpa->nomor_surat,
            'tanggal_lpa' => Carbon::parse($lpa->created_at)->translatedFormat('d F Y'),
            'no_bp3kepp' => $pemberkasan->no_bp3kepp,
            'tanggal_bp3kepp' => Carbon::parse($pemberkasan->tgl_bp3kepp)->translatedFormat('d F Y'),
            'terlapor' => $kasus->terlapor,
            'kronologi' => $kasus->kronologi,
            'nrp' => $kasus->nrp,
            'pangkat' =>  $kasus->pangkat ? $kasus->pangkat->name : 'Pangkat Belum Dipilih',
            'kesatuan' => $kasus->kesatuan,
            'jabatan' => $kasus->jabatan,
            'wujud_perbuatan' => $kasus->wujud_perbuatan ? $kasus->wujud_perbuatan->keterangan_wp : '',
            'nomor_pembentukan' => $penuntutan->no_pembentukan_komisi,
            'tanggal_pembentukan' => Carbon::parse($penuntutan->tanggal_pembentukan_komisi)->translatedFormat('d F Y'),
            'bulan_tahun_pembentukan' => Carbon::parse($penuntutan->tanggal_pembentukan_komisi)->translatedFormat('F Y'),
            'nomor_saksi_anggota' => $penuntutan->no_panggilan_saksi_anggota,
            'tanggal_saksi_anggota' => Carbon::parse($penuntutan->tanggal_panggilan_saksi_anggota)->translatedFormat('d F Y'),
            'bt_saksi_anggota' => Carbon::parse($penuntutan->tanggal_panggilan_saksi_anggota)->translatedFormat('F Y'),
        ));
        $template_document->saveAs(storage_path('template_surat/' . $kasus->pelapor . '-panggilan_saksi_anggota.docx'));
        return response()->download(storage_path('template_surat/' . $kasus->pelapor . '-panggilan_saksi_anggota.docx'))->deleteFileAfterSend(true);
    }

    public function panggilan_saksi_sdm(Request $request)
    {
        $penuntutan = Penuntutan::where('data_pelanggar_id', $request->kasus_id)->first();
        if ($penuntutan->no_panggilan_saksi_ahli_ssdm == null) {
            $penuntutan->no_panggilan_saksi_ahli_ssdm = $request->no_panggilan_saksi_ahli_ssdm;
            $penuntutan->tanggal_panggilan_saksi_ssdm = $request->tanggal_panggilan_saksi_ssdm;
            $penuntutan->save();
        }


        $lpa = Lpa::where('data_pelanggar_id', $request->kasus_id)->first();
        $pemberkasan = Pemberkasan::where('data_pelanggar_id', $request->kasus_id)->first();
        $kasus = DataPelanggar::find($request->kasus_id);
        $template_document = new TemplateProcessor(storage_path('template_surat/panggilan_saksi_ahli_sdm.docx'));
        $template_document->setValues(array(
            'tanggal_sidang' => Carbon::parse($pemberkasan->tgl_sidang)->translatedFormat('d F Y'),
            'hari_sidang' => Carbon::parse($pemberkasan->tgl_sidang)->translatedFormat('l'),
            'ruangan_sidang' => $pemberkasan->tempat_sidang,
            'jam_sidang' => $pemberkasan->jam_sidang,
            'pakaian_sidang' => $pemberkasan->pakaian_sidang,
            'no_usulan_pembentukan_komisi' => $penuntutan->no_usulan_pembentukan_komisi,
            'no_divkum' => $penuntutan->no_divkum,
            'tanggal_divkum' => Carbon::parse($penuntutan->tanggal_divkum)->translatedFormat('d F Y'),
            'no_lpa' => $lpa->nomor_surat,
            'tanggal_lpa' => Carbon::parse($lpa->created_at)->translatedFormat('d F Y'),
            'no_bp3kepp' => $pemberkasan->no_bp3kepp,
            'tanggal_bp3kepp' => Carbon::parse($pemberkasan->tgl_bp3kepp)->translatedFormat('d F Y'),
            'terlapor' => $kasus->terlapor,
            'kronologi' => $kasus->kronologi,
            'nrp' => $kasus->nrp,
            'pangkat' =>  $kasus->pangkat ? $kasus->pangkat->name : 'Pangkat Belum Dipilih',
            'kesatuan' => $kasus->kesatuan,
            'jabatan' => $kasus->jabatan,
            'wujud_perbuatan' => $kasus->wujud_perbuatan ? $kasus->wujud_perbuatan->keterangan_wp : '',
            'nomor_pembentukan' => $penuntutan->no_pembentukan_komisi,
            'tanggal_pembentukan' => Carbon::parse($penuntutan->tanggal_pembentukan_komisi)->translatedFormat('d F Y'),
            'bulan_tahun_pembentukan' => Carbon::parse($penuntutan->tanggal_pembentukan_komisi)->translatedFormat('F Y'),
            'nomor_saksi_sdm' => $penuntutan->no_panggilan_saksi_ahli_ssdm,
            'tanggal_saksi_sdm' => Carbon::parse($penuntutan->tanggal_panggilan_saksi_ssdm)->translatedFormat('d F Y'),
            'bt_saksi_sdm' => Carbon::parse($penuntutan->tanggal_panggilan_saksi_ssdm)->translatedFormat('F Y'),
        ));
        $template_document->saveAs(storage_path('template_surat/' . $kasus->pelapor . '-panggilan_saksi_ahli_sdm.docx'));
        return response()->download(storage_path('template_surat/' . $kasus->pelapor . '-panggilan_saksi_ahli_sdm.docx'))->deleteFileAfterSend(true);
    }

    public function surat_daftar_nama_terlampir(Request $request)
    {
        $penuntutan = Penuntutan::where('data_pelanggar_id', $request->kasus_id)->first();
        if ($penuntutan->no_surat_daftar_terlampir == null) {
            $penuntutan->no_surat_daftar_terlampir = $request->no_surat_daftar_terlampir;
            $penuntutan->tanggal_surat_daftar_nama_terlampir = $request->tanggal_surat_daftar_nama_terlampir;
            $penuntutan->save();
        }


        $lpa = Lpa::where('data_pelanggar_id', $request->kasus_id)->first();
        $pemberkasan = Pemberkasan::where('data_pelanggar_id', $request->kasus_id)->first();
        $kasus = DataPelanggar::find($request->kasus_id);
        $template_document = new TemplateProcessor(storage_path('template_surat/surat_daftar_nama_terlampir.docx'));
        $template_document->setValues(array(
            'tanggal_sidang' => Carbon::parse($pemberkasan->tgl_sidang)->translatedFormat('d F Y'),
            'hari_sidang' => Carbon::parse($pemberkasan->tgl_sidang)->translatedFormat('l'),
            'ruangan_sidang' => $pemberkasan->tempat_sidang,
            'jam_sidang' => $pemberkasan->jam_sidang,
            'pakaian_sidang' => $pemberkasan->pakaian_sidang,
            'no_usulan_pembentukan_komisi' => $penuntutan->no_usulan_pembentukan_komisi,
            'no_divkum' => $penuntutan->no_divkum,
            'tanggal_divkum' => Carbon::parse($penuntutan->tanggal_divkum)->translatedFormat('d F Y'),
            'no_lpa' => $lpa->nomor_surat,
            'tanggal_lpa' => Carbon::parse($lpa->created_at)->translatedFormat('d F Y'),
            'no_bp3kepp' => $pemberkasan->no_bp3kepp,
            'tanggal_bp3kepp' => Carbon::parse($pemberkasan->tgl_bp3kepp)->translatedFormat('d F Y'),
            'terlapor' => $kasus->terlapor,
            'kronologi' => $kasus->kronologi,
            'nrp' => $kasus->nrp,
            'pangkat' =>  $kasus->pangkat ? $kasus->pangkat->name : 'Pangkat Belum Dipilih',
            'kesatuan' => $kasus->kesatuan,
            'jabatan' => $kasus->jabatan,
            'wujud_perbuatan' => $kasus->wujud_perbuatan ? $kasus->wujud_perbuatan->keterangan_wp : '',
            'nomor_pembentukan' => $penuntutan->no_pembentukan_komisi,
            'tanggal_pembentukan' => Carbon::parse($penuntutan->tanggal_pembentukan_komisi)->translatedFormat('d F Y'),
            'bulan_tahun_pembentukan' => Carbon::parse($penuntutan->tanggal_pembentukan_komisi)->translatedFormat('F Y'),
            'nomor_sdmt' => $penuntutan->no_surat_daftar_terlampir,
            'tanggal_sdnt' => Carbon::parse($penuntutan->tanggal_surat_daftar_nama_terlampir)->translatedFormat('d F Y'),
            'bt_sdmt' => Carbon::parse($penuntutan->tanggal_surat_daftar_nama_terlampir)->translatedFormat('F Y'),
        ));
        $template_document->saveAs(storage_path('template_surat/' . $kasus->pelapor . '-surat_daftar_nama_terlampir.docx'));
        return response()->download(storage_path('template_surat/' . $kasus->pelapor . '-surat_daftar_nama_terlampir.docx'))->deleteFileAfterSend(true);
    }
}
