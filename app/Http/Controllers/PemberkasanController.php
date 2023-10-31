<?php

namespace App\Http\Controllers;

use App\Models\Sidang;
use App\Models\DataPelanggar;
use App\Models\Penyerahan;
use App\Models\Permohonan;
use App\Models\Bp3kepps;
use App\Http\Controllers\AuditInvestigasiController;
use App\Models\Disposisi;
use App\Models\LaporanHasilGelar;
use App\Models\Lpa;
use App\Models\Pemberkasan;
use App\Models\SprinHistory;
use App\Models\SprinRiksa;
use Carbon\Carbon;
use Illuminate\Http\Request;
use PhpOffice\PhpWord\TemplateProcessor;

class PemberkasanController extends Controller
{
    public function generateAdmistrasiSidang(Request $request)
    {
        $sidang = Sidang::where('data_pelanggar_id', $request->data_pelanggar_id)->first();
        if (!$sidang) {
            Sidang::create([
                'data_pelanggar_id' => $request->data_pelanggar_id,
                'tanggal' => $request->tanggal,
                'jam' => $request->jam,
                'tempat' => $request->tempat,
                'pakaian' => $request->pakaian,
            ]);
        }

        $kasus_id = $request->data_pelanggar_id;
        $kasus = DataPelanggar::find($kasus_id);

        $value = AuditInvestigasiController::valueDoc($kasus_id, false, false, false, false, false, true);
        $template_document = new TemplateProcessor(storage_path('template_surat/administrasi_sidang.docx'));
        $template_document->setValues($value);
        $template_document->saveAs(storage_path('template_surat/' . $kasus->pelapor . '-administrasi-sidang.docx'));

        return response()->download(storage_path('template_surat/' . $kasus->pelapor . '-administrasi-sidang.docx'))->deleteFileAfterSend(true);
    }

    public function AdmistrasiSidang($kasus_id)
    {
        $value = AuditInvestigasiController::valueDoc($kasus_id, false, false, false, false, false, true);
        $kasus = DataPelanggar::find($kasus_id);
        $template_document = new TemplateProcessor(storage_path('template_surat/administrasi_sidang.docx'));
        $template_document->setValues($value);
        $template_document->saveAs(storage_path('template_surat/' . $kasus->pelapor . '-administrasi-sidang.docx'));

        return response()->download(storage_path('template_surat/' . $kasus->pelapor . '-administrasi-sidang.docx'))->deleteFileAfterSend(true);
    }

    public function generateNotaDinasPenyerahan(Request $request)
    {
        $penyerahan = Penyerahan::where('data_pelanggar_id', $request->data_pelanggar_id)->first();
        if (!$penyerahan) {
            Penyerahan::create([
                'data_pelanggar_id' => $request->data_pelanggar_id,
                'tanggal' => $request->tanggal,
                'nomor' => $request->nomor,
            ]);
        }

        $kasus_id = $request->data_pelanggar_id;
        $kasus = DataPelanggar::find($kasus_id);
        $pemberkasan = Pemberkasan::where('data_pelanggar_id', $kasus_id)->first();
        $sprin = SprinHistory::where('data_pelanggar_id', $kasus_id)->first();
        $value = AuditInvestigasiController::valueDoc($kasus_id, false, false, false, false, false, false, true);
        $template_document = new TemplateProcessor(storage_path('template_surat/nota_dinas_penyerahan.docx'));
        $template_document->setValues(array(
            'no_nota_dinas_penyerahan' => $pemberkasan->no_nota_dinas_penyerahan,
            'perihal' => $kasus->perihal,
            'tim' => $sprin->tim,
            'no_lpa' => '',
            'tanggal_lpa' => '',

        ));
        $template_document->saveAs(storage_path('template_surat/' . $kasus->pelapor . '-nota-dinas-penyerahan-berkas-perkara-ke-binetik.docx'));

        return response()->download(storage_path('template_surat/' . $kasus->pelapor . '-nota-dinas-penyerahan-berkas-perkara-ke-binetik.docx'))->deleteFileAfterSend(true);
    }

    public function notaDinasPenyerahan($kasus_id)
    {
        $penyerahan = Penyerahan::where('data_pelanggar_id', $kasus_id)->first();

        $kasus = DataPelanggar::find($kasus_id);
        $pemberkasan = Pemberkasan::where('data_pelanggar_id', $kasus_id)->first();
        $sprin = SprinRiksa::where('data_pelanggar_id', $kasus_id)->first();
        $disposisi = Disposisi::where('data_pelanggar_id', $kasus_id)
            ->where('type', 1)->first();
        $lpa = Lpa::where('data_pelanggar_id', $kasus_id)->first();

        $template_document = new TemplateProcessor(storage_path('template_surat/nota_dinas_penyerahan.docx'));
        $template_document->setValues(array(
            'bulan_tahun_bp3kepp' => Carbon::parse($pemberkasan->tgl_bp3kepp)->translatedFormat('F Y'),
            'tanggal_bp3kepp' => Carbon::parse($pemberkasan->tgl_bp3kepp)->translatedFormat('d F Y'),
            'nomor_bp3kepp' => $pemberkasan->no_bp3kepp,
            'no_nota_dinas_penyerahan' => $pemberkasan->no_nota_dinas_penyerahan,
            'perihal' => $kasus->perihal,
            'tim' => $disposisi->tim,
            'no_lpa' => $lpa->nomor_surat,
            'tanggal_lpa' => Carbon::parse($lpa->created_at)->translatedFormat('d F Y'),
            'perihal' => $kasus->perihal_nota_dinas,
            'pelapor' => $kasus->pelapor,
            'no_telp' => $kasus->no_telp,
            'terlapor' => $kasus->terlapor,
            'kronologi' => $kasus->kronologi,
            'nama_korban' => $kasus->nama_korban,
            'tempat_kejadian' => $kasus->tempat_kejadian,
            'nrp' => $kasus->nrp,
            'pangkat' => $kasus->pangkat->name,
            'kesatuan' => $kasus->kesatuan,
            'jabatan' => $kasus->jabatan,
            'agama' => $kasus->religi->name,

        ));
        $template_document->saveAs(storage_path('template_surat/' . $kasus->pelapor . '-nota-dinas-penyerahan-berkas-perkara-ke-binetik.docx'));

        return response()->download(storage_path('template_surat/' . $kasus->pelapor . '-nota-dinas-penyerahan-berkas-perkara-ke-binetik.docx'))->deleteFileAfterSend(true);
    }

    public function generateNotaDinasPerbaikan(Request $request)
    {
        $perbaikan = Bp3kepps::where('data_pelanggar_id', $request->data_pelanggar_id)->first();
        if (!$perbaikan) {
            for ($i = 0; $i < count($request->tanggal); $i++) {
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
        $kasus = DataPelanggar::find($kasus_id);
        $value = AuditInvestigasiController::valueDoc($kasus_id, false, false, false, false, false, false, false, true);
        $template_document = new TemplateProcessor(storage_path('template_surat/nota_dinas_perbaikan.docx'));
        $template_document->setValues($value);
        $template_document->saveAs(storage_path('template_surat/' . $kasus->pelapor . '-nota-dinas-perbaikan-berkas.docx'));

        return response()->download(storage_path('template_surat/' . $kasus->pelapor . '-nota-dinas-perbaikan-berkas.docx'))->deleteFileAfterSend(true);
    }

    public function notaDinasPerbaikan($kasus_id)
    {
        $kasus = DataPelanggar::find($kasus_id);
        $permohonan_data = Pemberkasan::where('data_pelanggar_id', $kasus_id)->first();
        $laporan_gelar = LaporanHasilGelar::where('data_pelanggar_id', $kasus_id)->first();
        $lpa = Lpa::where('data_pelanggar_id', $kasus_id)->first();
        $data['bulan_tahun_lpa'] = Carbon::parse($lpa->created_at)->translatedFormat('F Y');
        $data['tanggal_lpa'] = Carbon::parse($lpa->created_at)->translatedFormat('d F Y');
        $data['no_lpa'] = $lpa->nomor_surat;
        $data['perihal'] = $kasus->perihal;
        $data['pasal_lpa'] = $laporan_gelar->pasal_dilanggar ?? '...';
        $data['no_nota_perbaikan'] = $permohonan_data->no_nota_dinas_perbaikan;
        $data['tanggal_no_perbaikan'] = Carbon::parse($permohonan_data->tgl_nota_dinas_perbaikan)->translatedFormat('F Y');
        $data['bulan_tahun_perbaikan'] = Carbon::parse($permohonan_data->tgl_nota_dinas_perbaikan)->translatedFormat('F Y');
        $template_document = new TemplateProcessor(storage_path('template_surat/nota_dinas_perbaikan.docx'));
        $template_document->setValues($data);
        $template_document->saveAs(storage_path('template_surat/' . $kasus->pelapor . '-nota-dinas-perbaikan-berkas.docx'));

        return response()->download(storage_path('template_surat/' . $kasus->pelapor . '-nota-dinas-perbaikan-berkas.docx'))->deleteFileAfterSend(true);
    }

    public function generatePermohonanPendapat(Request $request)
    {
        $permohonan = Permohonan::where('data_pelanggar_id', $request->data_pelanggar_id)->first();
        if (!$permohonan) {
            Permohonan::create([
                'data_pelanggar_id' => $request->data_pelanggar_id,
                'bp3kepp_id' => $request->bp3kepp_id,
                'nomor' => $request->nomor,
                'tanggal' => $request->tanggal,
                'pasal' => $request->pasal,
            ]);
        }

        $kasus_id = $request->data_pelanggar_id;
        $kasus = DataPelanggar::find($kasus_id);
        $value = AuditInvestigasiController::valueDoc($kasus_id, false, false, false, false, false, false, false, false, true);
        $template_document = new TemplateProcessor(storage_path('template_surat/permohonan_pendapat.docx'));
        $template_document->setValues($value);
        $template_document->saveAs(storage_path('template_surat/' . $kasus->pelapor . '-permohonan-pendapat-saran-hukum.docx'));

        return response()->download(storage_path('template_surat/' . $kasus->pelapor . '-permohonan-pendapat-saran-hukum.docx'))->deleteFileAfterSend(true);
    }

    public function permohonanPendapat($kasus_id)
    {
        $kasus = DataPelanggar::find($kasus_id);
        $value = AuditInvestigasiController::valueDoc($kasus_id, false, false, false, false, false, false, false, false, true);
        $template_document = new TemplateProcessor(storage_path('template_surat/permohonan_pendapat.docx'));
        $template_document->setValues($value);
        $template_document->saveAs(storage_path('template_surat/' . $kasus->pelapor . '-permohonan-pendapat-saran-hukum.docx'));

        return response()->download(storage_path('template_surat/' . $kasus->pelapor . '-permohonan-pendapat-saran-hukum.docx'))->deleteFileAfterSend(true);
    }

    public function simpan_data(Request $request)
    {
        unset($request['_token']);
        Pemberkasan::create($request->all());

        return redirect()->back();
    }

    public function update_data(Request $request)
    {
        unset($request['_token']);
        $data_pelanggar_id = $request->data_pelanggar_id;
        unset($request['data_pelanggar_id']);
        Pemberkasan::where('data_pelanggar_id', $data_pelanggar_id)
            ->update($request->all());

        return redirect()->back();
    }
}
