<?php

namespace App\Http\Controllers;

use App\Models\DataPelanggar;
use App\Models\Penyidik;
use App\Models\SprinHistory;
use App\Models\Wawancara;
use App\Models\Penyerahan;
use App\Models\Bp3kepps;
use App\Models\Saksi;
use App\Models\Sidang;
use App\Models\LimpahPolda;
use App\Models\Pangkat;
use App\Models\Permohonan;
use App\Models\UndanganGelar;
use App\Models\PembentukanKomisi;
use App\Models\SuratPenghadapan;
use App\Models\Disposisi;
use App\Models\Dihentikan;
use App\Helpers\Helper;
use App\Models\LaporanHasilGelar;
use App\Models\LaporanHasilAudit;
use App\Models\Lpa;
use App\Models\Pemberkasan;
use App\Models\Penuntutan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use PhpOffice\PhpWord\TemplateProcessor;

class AuditInvestigasiController extends Controller
{

    public function printSuratPerintah($kasus_id, Request $request)
    {
        $kasus = DataPelanggar::find($kasus_id);
        if (!$data = SprinHistory::where('data_pelanggar_id', $kasus_id)->first()) {

            $data = SprinHistory::create([
                'data_pelanggar_id' => $kasus_id,
                'no_sprin' => $request->no_sprin,
                'tanggal_investigasi' => $request->tanggal_investigasi,
                'tempat_investigasi' => $request->tempat_investigasi,
                'tim' => $request->tim
            ]);
        }

        $penyidik = Penyidik::where('tim', $data->tim)->where('fungsional', '<>', 'Akreditor Utama')->with('pangkat')->get()->toArray();
        $ketua_penyidik = Penyidik::where('tim', $data->tim)->where('fungsional', 'Akreditor Utama')->first();
        $sprin = SprinHistory::where('data_pelanggar_id', $kasus_id)->first();
        $disposisi = Disposisi::where('data_pelanggar_id', $kasus_id)->first();
        $kasus = DataPelanggar::where('id', $kasus_id)->first();
        // dd($penyidik[0]);
        $template_document = new TemplateProcessor(storage_path('template_surat/template_sprin.docx'));

        $date = date('Y-m-d');

        $array_bln = array(1 => "I", "II", "III", "IV", "V", "VI", "VII", "VIII", "IX", "X", "XI", "XII");
        $tanggal = date("n", strtotime($sprin->tanggal_investigasi));
        $bln = $array_bln[$tanggal];

        $template_document->setValues(array(
            'no_sprin' => $sprin->no_sprin,
            'surat_dari' => $disposisi->surat_dari,
            'no_nota_dinas' => $kasus->no_nota_dinas,
            'tanggal' => Carbon::parse($kasus->tanggal_nota_dinas)->translatedFormat('d F Y'),
            'perihal' => $kasus->perihal_nota_dinas,
            'tanggal_sprin' => Carbon::parse($sprin->tanggal_investigasi)->translatedFormat('d F Y'),
            'tanggal_ttd' => Carbon::parse($date)->translatedFormat('d F Y'),
            'bulan_tahun_sprin' => Carbon::parse($sprin->tanggal_investigasi)->translatedFormat('F Y'),
            'tahun_sprin' => Carbon::parse($sprin->tanggal_investigasi)->translatedFormat('Y'),
            'terlapor' => $kasus->terlapor,
            'bulan_sprin' => $bln,
            'ketua' => $ketua_penyidik->name ?? '',
            'nrp_ketua' => $ketua_penyidik->nrp ?? '',
            'jabatan_ketua' => $ketua_penyidik->jabatan ?? '',
            'pangkat_ketua' => $ketua_penyidik->pangkat->name ?? '',
            'anggota_1' => $penyidik[0]['name'] ?? '',
            'nrp_1' => $penyidik[0]['nrp'] ?? '',
            'pangkat_1' => $penyidik[0]['pangkat'][0]['name'] ?? '',
            'jabatan_1' => $penyidik[0]['jabatan'] ?? '',
            'anggota_2' => $penyidik[1]['name'] ?? '',
            'nrp_2' => $penyidik[1]['nrp'] ?? '',
            'pangkat_2' => $penyidik[1]['pangkat']->name ?? '',
            'jabatan_2' => $penyidik[1]['jabatan'] ?? '',
            'anggota_3' => $penyidik[2]['name'] ?? '',
            'nrp_3' => $penyidik[2]['nrp'] ?? '',
            'pangkat_3' => $penyidik[2]['pangkat']->name ?? '',
            'jabatan_3' => $penyidik[2]['jabatan'] ?? '',
            'anggota_4' => $penyidik[3]['name'] ?? '',
            'nrp_4' => $penyidik[3]['nrp'] ?? '',
            'pangkat_4' => $penyidik[3]['pangkat']->name ?? '',
            'jabatan_4' => $penyidik[3]['jabatan'] ?? '',
            'anggota_5' => $penyidik[4]['name'] ?? '',
            'nrp_5' => $penyidik[4]['nrp'] ?? '',
            'pangkat_5' => $penyidik[4]['pangkat']->name ?? '',
            'jabatan_5' => $penyidik[4]['jabatan'] ?? '',
        ));

        $template_document->saveAs(storage_path('template_surat/' . $kasus->pelapor . '-surat-perintah.docx'));

        return response()->download(storage_path('template_surat/' . $kasus->pelapor . '-surat-perintah.docx'))->deleteFileAfterSend(true);
    }

    public function suratPenghadapan($kasus_id)
    {
        $kasus = DataPelanggar::find($kasus_id);
        $value = $this->valueDoc($kasus_id);
        $wawancara = Wawancara::where('data_pelanggar_id', $kasus_id)->first();
        $value += array(
            'nomor_surat' => $wawancara->nomor_surat,
            'bulan_tahun_surat' => Carbon::parse(date('Y-m-d'))->translatedFormat('d F Y'),
            'tangal_pelaksanaan' => Carbon::parse($wawancara->tanggal_pelaksana)->translatedFormat('d F Y'),
            'bulan_surat' => Carbon::parse($wawancara->tanggal_pelaksana)->translatedFormat('dF'),
            'tahun_surat' => Carbon::parse($wawancara->tanggal_pelaksana)->translatedFormat('Y'),
        );
        $template_document = new TemplateProcessor(storage_path('template_surat/surat_penghadapan.docx'));
        $template_document->setValues($value);
        $template_document->saveAs(storage_path('template_surat/' . $kasus->pelapor . '-surat-penghadapan.docx'));

        return response()->download(storage_path('template_surat/' . $kasus->pelapor . '-surat-penghadapan.docx'))->deleteFileAfterSend(true);
    }

    public function generateWawancara(Request $request)
    {
        $wawancara = Wawancara::where('data_pelanggar_id', $request->data_pelanggar_id)->first();
        if (!$wawancara) {
            $wawancara = Wawancara::create([
                'data_pelanggar_id' => $request->data_pelanggar_id,
                'ruangan' => $request->ruangan,
                'tanggal' => $request->tanggal,
                'jam' => $request->jam,
                'alamat' => $request->alamat,
                'id_penyidik' => $request->id_penyidik,
                'nomor_handphone' => $request->nomor_handphone,
                'nomor_surat' => $request->nomor_surat,
            ]);
        }

        $wawancara = Wawancara::where('data_pelanggar_id', $request->data_pelanggar_id)->first();
        $kasus = DataPelanggar::where('id', $request->data_pelanggar_id)->first();
        $disposisi = Disposisi::where('data_pelanggar_id', $request->data_pelanggar_id)->where('type', 1)->first();
        $penyidik = Penyidik::where('id', $wawancara->id_penyidik)->first();
        $sprin = SprinHistory::where('data_pelanggar_id', $request->data_pelanggar_id)->first();
        $ketua_penyidik = Penyidik::where('tim', $sprin->tim)->where('fungsional', 'Akreditor Utama')->first();

        $template_document = new TemplateProcessor(storage_path('template_surat/undangan_wawancara.docx'));
        $date = date('Y-m-d');

        $array_bln = array(1 => "I", "II", "III", "IV", "V", "VI", "VII", "VIII", "IX", "X", "XI", "XII");
        $tanggal = date("n", strtotime($date));
        $bln = $array_bln[$tanggal];

        $tanggal_sprin = date("n", strtotime($sprin->created_at));
        $bln_sprin = $array_bln[$tanggal_sprin];
        $nota_dinas = explode('/', $kasus->no_nota_dinas);
        $kepala_bagian = end($nota_dinas);
        $template_document->setValues(array(
            'kepala_bagian' => $kepala_bagian,
            'nama_ketua' => $ketua_penyidik->name ?? '..',
            'pangkat_ketua' => $ketua_penyidik ?  $ketua_penyidik->pangkat->name : '..',
            'nomor_surat' => $wawancara->nomor_surat,
            'surat_dari' => $disposisi->surat_dari,
            'no_nota_dinas' => $kasus->no_nota_dinas,
            'tanggal_no_dinas' => Carbon::parse($kasus->tanggal_nota_dinas)->translatedFormat('d F Y'),
            'perihal' => $kasus->perihal_nota_dinas,
            'tanggal_surat' => Carbon::parse($date)->translatedFormat('d F Y'),
            'bulan_surat_nama' => Carbon::parse($date)->translatedFormat('F'),
            'bulan_tahun_surat' => Carbon::parse($date)->translatedFormat('F Y'),
            'tahun_surat' => Carbon::parse($date)->translatedFormat('Y'),
            'terlapor' => $kasus->terlapor,
            'jabatan' => $kasus->jabatan,
            'nrp' => $kasus->nrp,
            'pangkat' =>  $kasus->pangkat ? $kasus->pangkat->name : 'Pangkat Belum Dipilih',
            'wujud_perbuatan' => $kasus->wujud_perbuatan ? $kasus->wujud_perbuatan->keterangan_wp : '',
            'bulan_surat' => $bln,
            'no_sprin' => $sprin->no_sprin,
            'bulan_sprin' => $bln_sprin,
            'pelapor' => $kasus->pelapor,
            'hari_wawancara' => Carbon::parse($wawancara->tanggal)->translatedFormat('l'),
            'tanggal_wawancara' => Carbon::parse($wawancara->tanggal)->translatedFormat('d F Y'),
            'jam_wawancara' => $wawancara->jam,
            'ruangan_wawancara' => $wawancara->ruangan,
            'alamat_wawancara' => $wawancara->alamat,
            'tahun_sprin' => Carbon::parse($sprin->created_at)->translatedFormat('Y'),
            'tanggal_sprin' => Carbon::parse($sprin->created_at)->translatedFormat('d F Y'),
            'jabatan_terhubung' => $penyidik->jabatan,
            'nama_terhubung' => $penyidik->name,
            'nomor_handphone' => $wawancara->nomor_handphone,
        ));
        $template_document->saveAs(storage_path('template_surat/' . $kasus->pelapor . '-surat-undangan-wawancara.docx'));

        return response()->download(storage_path('template_surat/' . $kasus->pelapor . '-surat-undangan-wawancara.docx'))->deleteFileAfterSend(true);
    }

    public function generateSuratPenghadapan(Request $request)
    {
        $surat_penghadapan = SuratPenghadapan::where('data_pelanggar_id', $request->data_pelanggar_id)->first();
        if (!$surat_penghadapan) {
            $surat_penghadapan = SuratPenghadapan::create([
                'data_pelanggar_id' => $request->data_pelanggar_id,
                'nomor_surat' => $request->nomor_surat,
                'tanggal_pelaksanaan' => $request->tanggal_pelaksanaan
            ]);
        }
        $disposisi = Disposisi::where('data_pelanggar_id', $request->data_pelanggar_id)->first();
        $kasus = DataPelanggar::where('id', $request->data_pelanggar_id)->first();
        $template_document = new TemplateProcessor(storage_path('template_surat/surat_penghadapan.docx'));
        $date = date('Y-m-d');

        $array_bln = array(1 => "I", "II", "III", "IV", "V", "VI", "VII", "VIII", "IX", "X", "XI", "XII");
        $tanggal = date("n", strtotime($date));
        $bln = $array_bln[$tanggal];

        $template_document->setValues(array(
            'bulan_tahun_surat' => Carbon::parse($date)->translatedFormat('F Y'),
            'bulan_surat' => $bln,
            'surat_dari' => $disposisi->surat_dari,
            'tahun_surat' => Carbon::parse($date)->translatedFormat('Y'),
            'perihal' => $kasus->perihal_nota_dinas,
            'kesatuan' => $kasus->kesatuan,
            'no_nota_dinas' => $kasus->no_nota_dinas,
            'kronologi' => $kasus->kronologi,
            'kesatuan' => $kasus->kesatuan,
            'terlapor' => $kasus->terlapor,
            'pangkat' =>  $kasus->pangkat ? $kasus->pangkat->name : 'Pangkat Belum Dipilih',
            'jabatan' => $kasus->jabatan,
            'nrp' => $kasus->nrp,
            'wujud_perbuatan' => $kasus->wujud_perbuatan ? $kasus->wujud_perbuatan->keterangan_wp : '',
            'tanggal_nota_dinas' => Carbon::parse($kasus->tanggal_nota_dinas)->translatedFormat('d F Y'),
            'tanggal_pelaksanaan' => Carbon::parse($surat_penghadapan->tanggal_pelaksanaan)->translatedFormat('d F Y'),
            'nomor_surat' => $surat_penghadapan->nomor_surat,
        ));
        $template_document->saveAs(storage_path('template_surat/' . $kasus->pelapor . '-surat-penghadapan.docx'));

        return response()->download(storage_path('template_surat/' . $kasus->pelapor . '-surat-penghadapan.docx'))->deleteFileAfterSend(true);
    }

    public function generateLaporanHasilAudit(Request $request, $kasus_id = null)
    {

        $laporan = LaporanHasilAudit::where('data_pelanggar_id', $kasus_id ?? $request->data_pelanggar_id)->first();
        if (!$laporan) {
            $kasus_id = $request->data_pelanggar_id;
            $laporan = LaporanHasilAudit::create([
                'data_pelanggar_id' => $request->data_pelanggar_id,
                'nomor_laporan' => $request->nomor_laporan,
                'tanggal_laporan' => $request->tanggal,
                'hasil' => $request->hasil,
                'catatan' => $request->catatan_berhenti
            ]);
            if ($request->hasil == 'Tidak Ditemukan') {
                Dihentikan::create([
                    'data_pelanggar_id' => $request->data_pelanggar_id,
                    'note' => $request->catatan_berhenti
                ]);
                Helper::saveHistory(10, $request->data_pelanggar_id);
                $data_pelanggar = DataPelanggar::where('id', $request->data_pelanggar_id)
                    ->update([
                        'status_id' => 10
                    ]);
            }

            for ($i = 0; $i < count($request->nrp); $i++) {
                if ($request->type[$i] == "Sipil") {
                    Saksi::create([
                        'data_pelanggar_id' => $request->data_pelanggar_id,
                        'nama' => $request->nama[$i + 1],
                    ]);
                } else {
                    Saksi::create([
                        'data_pelanggar_id' => $request->data_pelanggar_id,
                        'id_pangkat' => $request->id_pangkat[$i],
                        'nrp' => $request->nrp[$i],
                        'nama' => $request->nama[$i],
                        'jabatan' => $request->jabatan[$i],
                        'kesatuan' => $request->kesatuan[$i],
                    ]);
                }
            }
        }

        $laporan = LaporanHasilAudit::where('data_pelanggar_id', $kasus_id)->first();
        $disposisi = Disposisi::where('data_pelanggar_id', $kasus_id)->first();
        $sprin = SprinHistory::where('data_pelanggar_id', $kasus_id)->first();
        $penyidik = Penyidik::where('tim', $sprin->tim)->where('fungsional', '<>', 'Akreditor Utama')->with('pangkat')->get()->toArray();
        $ketua_penyidik = Penyidik::where('tim', $sprin->tim)->where('fungsional', 'Akreditor Utama')->first();
        $kasus = DataPelanggar::where('id', $kasus_id)->first();
        $saksi = Saksi::where('data_pelanggar_id', $kasus_id)->get()->toArray();
        $template_document = new TemplateProcessor(storage_path('template_surat/laporan_hasil_audit.docx'));
        $date = date('Y-m-d');
        $wawancara = Wawancara::where('data_pelanggar_id', $kasus_id)->first();
        $array_bln = array(1 => "I", "II", "III", "IV", "V", "VI", "VII", "VIII", "IX", "X", "XI", "XII");
        $tanggal = date("n", strtotime($date));
        $bln = $array_bln[$tanggal];
        $nota_dinas = explode('/', $kasus->no_nota_dinas);
        $kepala_bagian = end($nota_dinas);
        $template_document->setValues(array(
            'kepala_bagian' => $kepala_bagian,
            'hari_wawancara' => '',
            'tanggal_wawancara' => Carbon::parse($wawancara->tanggal)->translatedFormat('d F Y'),
            'jam_wawancara' => $wawancara->jam,
            'nomor_laporan' => $laporan->nomor_laporan,
            'no_sprin' => $sprin->no_sprin,
            'saran' => $laporan->catatan,
            'tempat_investigasi' => $sprin->tempat_investigasi,
            'pangkat' =>  $kasus->pangkat ? $kasus->pangkat->name : 'Pangkat Belum Dipilih',
            'hasil' => $laporan->hasil,
            'terlapor' => $kasus->terlapor,
            'pelapor' => $kasus->pelapor,
            'kesatuan' => $kasus->kesatuan,
            'jabatan' => $kasus->jabatan,
            'kronologi' => $kasus->kronologi,
            'wujud_perbuatan' => $kasus->wujud_perbuatan ? $kasus->wujud_perbuatan->keterangan_wp : '',
            'nrp' => $kasus->nrp,
            'bulan_tahun_laporan' => Carbon::parse($laporan->tanggal_laporan)->translatedFormat('F Y'),
            'tanggal_audit' => Carbon::parse($sprin->tanggal_investigasi)->translatedFormat('d F Y'),
            'tanggal_no_dinas' => Carbon::parse($kasus->tanggal_nota_dinas)->translatedFormat('d F Y'),
            'tanggal_laporan' => Carbon::parse($laporan->tanggal_laporan)->translatedFormat('d F Y'),
            'no_nota_dinas' => $kasus->no_nota_dinas,
            'perihal' => $kasus->perihal_nota_dinas,
            'ketua' => $ketua_penyidik->name ?? '',
            'nrp_ketua' => $ketua_penyidik->nrp ?? '',
            'jabatan_ketua' => $ketua_penyidik->jabatan ?? '',
            'pangkat_ketua' => $ketua_penyidik->pangkat->name ?? '',
            'anggota_1' => $penyidik[0]['name'] ?? '',
            'nrp_1' => $penyidik[0]['nrp'] ?? '',
            'pangkat_1' => $penyidik[0]['pangkat']['name'] ?? '',
            'jabatan_1' => $penyidik[0]['jabatan'] ?? '',
            'anggota_2' => $penyidik[1]['name'] ?? '',
            'nrp_2' => $penyidik[1]['nrp'] ?? '',
            'pangkat_2' => $penyidik[1]['pangkat']['name'] ?? '',
            'jabatan_2' => $penyidik[1]['jabatan'] ?? '',
            'anggota_3' => $penyidik[2]['name'] ?? '',
            'nrp_3' => $penyidik[2]['nrp'] ?? '',
            'pangkat_3' => $penyidik[2]['pangkat']['name'] ?? '',
            'jabatan_3' => $penyidik[2]['jabatan'] ?? '',
            'anggota_4' => $penyidik[3]['name'] ?? '',
            'nrp_4' => $penyidik[3]['nrp'] ?? '',
            'pangkat_4' => $penyidik[3]['pangkat']['name'] ?? '',
            'jabatan_4' => $penyidik[3]['jabatan'] ?? '',
            'anggota_5' => $penyidik[4]['name'] ?? '',
            'pangkat_5' => $penyidik[4]['pangkat']['name'] ?? '',
            'nrp_5' => $penyidik[4]['nrp'] ?? '',
            'jabatan_5' => $penyidik[4]['jabatan'] ?? '',
            'pangkat_saksi_1' => $saksi[0]['pangkat'] ?? '',
            'nama_saksi_1' => $saksi[0]['nama'] ?? '',
            'nrp_saksi_1' => $saksi[0]['nrp'] ?? '',
            'jabatan_saksi_1' => $saksi[0]['jabatan'] ?? '',
            'kesatuan_saksi_1' => $saksi[0]['kesatuan'] ?? '',
            'pangkat_saksi_2' => $saksi[1]['pangkat'] ?? '',
            'nama_saksi_2' => $saksi[1]['nama'] ?? '',
            'nrp_saksi_2' => $saksi[1]['nrp'] ?? '',
            'jabatan_saksi_2' => $saksi[1]['jabatan'] ?? '',
            'kesatuan_saksi_2' => $saksi[1]['kesatuan'] ?? '',
            'pangkat_saksi_3' => $saksi[2]['pangkat'] ?? '',
            'nama_saksi_3' => $saksi[2]['nama'] ?? '',
            'nrp_saksi_3' => $saksi[2]['nrp'] ?? '',
            'jabatan_saksi_3' => $saksi[2]['jabatan'] ?? '',
            'kesatuan_saksi_3' => $saksi[2]['kesatuan'] ?? '',
            'pangkat_saksi_4' => $saksi[3]['pangkat'] ?? '',
            'nama_saksi_4' => $saksi[3]['nama'] ?? '',
            'nrp_saksi_4' => $saksi[3]['nrp'] ?? '',
            'jabatan_saksi_4' => $saksi[3]['jabatan'] ?? '',
            'kesatuan_saksi_4' => $saksi[3]['kesatuan'] ?? '',
            'pangkat_saksi_5' => $saksi[4]['pangkat'] ?? '',
            'nama_saksi_5' => $saksi[4]['nama'] ?? '',
            'nrp_saksi_5' => $saksi[4]['nrp'] ?? '',
            'jabatan_saksi_5' => $saksi[4]['jabatan'] ?? '',
            'kesatuan_saksi_5' => $saksi[4]['kesatuan'] ?? '',
            'nama_saksi_6' => $saksi[5]['nama'] ?? '',
            'nrp_saksi_6' => $saksi[5]['nrp'] ?? '',
            'jabatan_saksi_6' => $saksi[5]['jabatan'] ?? '',
            'kesatuan_saksi_6' => $saksi[5]['kesatuan'] ?? '',
            'pangkat_saksi_6' => $saksi[5]['pangkat'] ?? '',

        ));
        $template_document->saveAs(storage_path('template_surat/' . $kasus->pelapor . '-laporan-hasil-audit.docx'));

        return response()->download(storage_path('template_surat/' . $kasus->pelapor . '-laporan-hasil-audit.docx'))->deleteFileAfterSend(true);
    }

    public function notaWawancara($kasus_id)
    {
        // $kasus = DataPelanggar::find($kasus_id);\
        $template_document = new TemplateProcessor(storage_path('template_surat/nota_wawancara.docx'));

        $kasus = DataPelanggar::where('id', $kasus_id)->first();
        $wawancara = Wawancara::where('data_pelanggar_id', $kasus_id)->first();
        $disposisi = Disposisi::where('data_pelanggar_id', $kasus_id)->where('type', 2)->first();
        $sprin = SprinHistory::where('data_pelanggar_id', $kasus_id)->first();

        $penyidik = Penyidik::where('tim', $sprin->tim)->where('fungsional', '<>', 'Akreditor Utama')->with('pangkat')->get()->toArray();
        $ketua_penyidik = Penyidik::where('tim', $sprin->tim)->where('fungsional', 'Akreditor Utama')->first();

        $template_document = new TemplateProcessor(storage_path('template_surat/nota_wawancara.docx'));

        $date = date('Y-m-d');

        $array_bln = array(1 => "I", "II", "III", "IV", "V", "VI", "VII", "VIII", "IX", "X", "XI", "XII");
        $tanggal = date("n", strtotime($sprin->tanggal_investigasi));
        $bln = $array_bln[$tanggal];

        $template_document->setValues(array(
            'hari_wawancara' => Carbon::parse($wawancara->tanggal)->translatedFormat('l'),
            'tanggal_wawancara' => Carbon::parse($wawancara->tanggal)->translatedFormat('d F Y'),
            'ruangan_wawancara' => $wawancara->ruangan,
            'jam_wawancara' => $wawancara->jam,
            'no_sprin' => $sprin->no_sprin,
            'surat_dari' => $disposisi->surat_dari,
            'terlapor' => $kasus->terlapor,
            'pelapor' => $kasus->pelapor,
            'wujud_perbuatan' => $kasus->wujud_perbuatan ? $kasus->wujud_perbuatan->keterangan_wp : '',
            'pangkat' =>  $kasus->pangkat ? $kasus->pangkat->name : 'Pangkat Belum Dipilih',
            'nrp' => $kasus->nrp,
            'jabatan' => $kasus->jabatan,
            'kesatuan' => $kasus->kesatuan,
            // 'agama_terlapor' => $kasus->religi_terlapor->name,
            'suku_terlapor' => $kasus->suku,
            'alamat_terlapor' => $kasus->alamat_terlapor,
            'no_telp' => $kasus->no_telp,
            'tanggal_sprin' => Carbon::parse($sprin->tanggal_investigasi)->translatedFormat('d F Y'),
            'bulan_tahun_sprin' => Carbon::parse($sprin->tanggal_investigasi)->translatedFormat('F Y'),
            'tahun_sprin' => Carbon::parse($sprin->tanggal_investigasi)->translatedFormat('Y'),
            'bulan_sprin' => $bln,
            'ketua' => $ketua_penyidik->name ?? '',
            'nrp_ketua' => $ketua_penyidik->nrp ?? '',
            'jabatan_ketua' => $ketua_penyidik->jabatan ?? '',
            'pangkat_ketua' => $ketua_penyidik->pangkat->name ?? '',
            'anggota_1' => $penyidik[0]['name'] ?? '',
            'nrp_1' => $penyidik[0]['nrp'] ?? '',
            'pangkat_1' => $penyidik[0]['pangkat'][0]['name'] ?? '',
            'jabatan_1' => $penyidik[0]['jabatan'] ?? '',
            'anggota_2' => $penyidik[1]['name'] ?? '',
            'nrp_2' => $penyidik[1]['nrp'] ?? '',
            'pangkat_2' => $penyidik[1]['pangkat'][0]['name'] ?? '',
            'jabatan_2' => $penyidik[1]['jabatan'] ?? '',
            'anggota_3' => $penyidik[2]['name'] ?? '',
            'nrp_3' => $penyidik[2]['nrp'] ?? '',
            'pangkat_3' => $penyidik[2]['pangkat'][0]['name'] ?? '',
            'jabatan_3' => $penyidik[2]['jabatan'] ?? '',
            'anggota_4' => $penyidik[3]['name'] ?? '',
            'nrp_4' => $penyidik[3]['nrp'] ?? '',
            'pangkat_4' => $penyidik[3]['pangkat'][0]['name'] ?? '',
            'jabatan_4' => $penyidik[3]['jabatan'] ?? '',
            'anggota_5' => $penyidik[4]['name'] ?? '',
            'pangkat_5' => $penyidik[4]['pangkat'][0]['name'] ?? '',
            'nrp_5' => $penyidik[4]['nrp'] ?? '',
            'jabatan_5' => $penyidik[4]['jabatan'] ?? '',
        ));

        $template_document->saveAs(storage_path('template_surat/' . $kasus->pelapor . '-surat-nota-wawancara.docx'));

        return response()->download(storage_path('template_surat/' . $kasus->pelapor . '-surat-nota-wawancara.docx'))->deleteFileAfterSend(true);
    }

    public function undanganWawancara($kasus_id)
    {
        $wawancara = Wawancara::where('data_pelanggar_id', $kasus_id)->first();
        $kasus = DataPelanggar::where('id', $kasus_id)->first();
        $disposisi = Disposisi::where('data_pelanggar_id', $kasus_id)->where('type', 1)->first();
        $penyidik = Penyidik::where('id', $wawancara->id_penyidik)->first();
        $sprin = SprinHistory::where('data_pelanggar_id', $kasus_id)->first();
        $ketua_penyidik = Penyidik::where('tim', $sprin->tim)->where('fungsional', 'Akreditor Utama')->first();
        $template_document = new TemplateProcessor(storage_path('template_surat/undangan_wawancara.docx'));
        $date = date('Y-m-d');

        $array_bln = array(1 => "I", "II", "III", "IV", "V", "VI", "VII", "VIII", "IX", "X", "XI", "XII");
        $tanggal = date("n", strtotime($date));
        $bln = $array_bln[$tanggal];

        $tanggal_sprin = date("n", strtotime($sprin->created_at));
        $bln_sprin = $array_bln[$tanggal_sprin];
        $nota_dinas = explode('/', $kasus->no_nota_dinas);
        $kepala_bagian = end($nota_dinas);
        $template_document->setValues(array(
            'kepala_bagian' => $kepala_bagian,
            'nama_ketua' => $ketua_penyidik->name ?? '..',
            'pangkat_ketua' => $ketua_penyidik ?  $ketua_penyidik->pangkat->name : '..',
            'nomor_surat' => $wawancara->nomor_surat,
            'surat_dari' => $disposisi->surat_dari,
            'no_nota_dinas' => $kasus->no_nota_dinas,
            'tanggal_no_dinas' => Carbon::parse($kasus->tanggal_nota_dinas)->translatedFormat('d F Y'),
            'perihal' => $kasus->perihal_nota_dinas,
            'tanggal_surat' => Carbon::parse($date)->translatedFormat('d F Y'),
            'bulan_tahun_surat' => Carbon::parse($date)->translatedFormat('F Y'),
            'bulan_surat_nama' => Carbon::parse($date)->translatedFormat('F'),
            'tahun_surat' => Carbon::parse($date)->translatedFormat('Y'),
            'terlapor' => $kasus->terlapor,
            'jabatan' => $kasus->jabatan,
            'nrp' => $kasus->nrp,
            'pangkat' =>  $kasus->pangkat ? $kasus->pangkat->name : 'Pangkat Belum Dipilih',
            'wujud_perbuatan' => $kasus->wujud_perbuatan ? $kasus->wujud_perbuatan->keterangan_wp : '',
            'bulan_surat' => $bln,
            'no_sprin' => $sprin->no_sprin,
            'bulan_sprin' => $bln_sprin,
            'pelapor' => $kasus->pelapor,
            'hari_wawancara' => Carbon::parse($wawancara->tanggal)->translatedFormat('l'),
            'tanggal_wawancara' => Carbon::parse($wawancara->tanggal)->translatedFormat('d F Y'),
            'jam_wawancara' => $wawancara->jam,
            'ruangan_wawancara' => $wawancara->ruangan,
            'alamat_wawancara' => $wawancara->alamat,
            'tahun_sprin' => Carbon::parse($sprin->created_at)->translatedFormat('Y'),
            'tanggal_sprin' => Carbon::parse($sprin->created_at)->translatedFormat('d F Y'),
            'jabatan_terhubung' => $penyidik->jabatan,
            'nama_terhubung' => $penyidik->name,
            'nomor_handphone' => $wawancara->nomor_handphone,
        ));
        $template_document->saveAs(storage_path('template_surat/' . $kasus->pelapor . '-surat-undangan-wawancara.docx'));

        return response()->download(storage_path('template_surat/' . $kasus->pelapor . '-surat-undangan-wawancara.docx'))->deleteFileAfterSend(true);
    }

    public function laporanHasilAudit($kasus_id)
    {
        $laporan = LaporanHasilAudit::where('data_pelanggar_id', $kasus_id)->first();
        $sprin = SprinHistory::where('data_pelanggar_id', $kasus_id)->first();
        $penyidik = Penyidik::where('tim', $sprin->tim)->where('fungsional', 'Akreditor Utama')
            ->with('pangkat')
            ->get()->toArray();
        $ketua_penyidik = Penyidik::where('tim', $sprin->tim)->where('fungsional', 'Akreditor Utama')->first();
        $disposisi = Disposisi::where('data_pelanggar_id', $kasus_id)->first();
        $kasus = DataPelanggar::where('id', $kasus_id)->first();
        $saksi = Saksi::where('data_pelanggar_id', $kasus_id)->get()->toArray();
        $wawancara = Wawancara::where('data_pelanggar_id', $kasus->id)->first();
        $template_document = new TemplateProcessor(storage_path('template_surat/laporan_hasil_audit.docx'));
        $date = date('Y-m-d');

        $array_bln = array(1 => "I", "II", "III", "IV", "V", "VI", "VII", "VIII", "IX", "X", "XI", "XII");
        $tanggal = date("n", strtotime($date));
        $bln = $array_bln[$tanggal];
        $template_document->setValues(array(
            'hari_wawancara' => '',
            'tanggal_wawancara' => Carbon::parse($wawancara->tanggal)->translatedFormat('d F Y'),
            'jam_wawancara' => $wawancara->jam,
            'nomor_laporan' => $laporan->nomor_laporan,
            'no_sprin' => $sprin->no_sprin,
            'tempat_investigasi' => $sprin->tempat_investigasi,
            'pangkat' =>  $kasus->pangkat ? $kasus->pangkat->name : 'Pangkat Belum Dipilih',
            'terlapor' => $kasus->terlapor,
            'pelapor' => $kasus->pelapor,
            'jabatan' => $kasus->jabatan,
            'hasil' => $laporan->hasil,
            'nrp' => $kasus->nrp,
            'bulan_tahun_laporan' => Carbon::parse($laporan->tanggal_laporan)->translatedFormat('F Y'),
            'tanggal_audit' => Carbon::parse($sprin->tanggal_investigasi)->translatedFormat('d F Y'),
            'tanggal_no_dinas' => Carbon::parse($kasus->tanggal_nota_dinas)->translatedFormat('d F Y'),
            'tanggal_laporan' => Carbon::parse($laporan->tanggal_laporan)->translatedFormat('d F Y'),
            'no_nota_dinas' => $kasus->no_nota_dinas,
            'perihal' => $kasus->perihal_nota_dinas,
            'ketua' => $ketua_penyidik->name ?? ' ',
            'nrp_ketua' => $ketua_penyidik->nrp ?? ' ',
            'jabatan_ketua' => $ketua_penyidik->jabatan ?? ' ',
            'pangkat_ketua' => $ketua_penyidik->pangkat->name ?? ' ',
            'anggota_1' => $penyidik[0]['name'] ?? ' ',
            'nrp_1' => $penyidik[0]['nrp'] ?? ' ',
            'jabatan_1' => $penyidik[0]['jabatan'] ?? ' ',
            'anggota_2' => $penyidik[1]['name'] ?? ' ',
            'nrp_2' => $penyidik[1]['nrp'] ?? ' ',
            'jabatan_2' => $penyidik[1]['jabatan'] ?? ' ',
            'anggota_3' => $penyidik[2]['name'] ?? ' ',
            'nrp_3' => $penyidik[2]['nrp'] ?? ' ',
            'jabatan_3' => $penyidik[2]['jabatan'] ?? ' ',
            'anggota_4' => $penyidik[3]['name'] ?? ' ',
            'nrp_4' => $penyidik[3]['nrp'] ?? ' ',
            'jabatan_4' => $penyidik[3]['jabatan'] ?? ' ',
            'anggota_5' => $penyidik[4]['name'] ?? ' ',
            'nrp_5' => $penyidik[4]['nrp'] ?? ' ',
            'jabatan_5' => $penyidik[4]['jabatan'] ?? ' ',
            'pangkat_saksi_1' => $saksi[0]['pangkat'] ?? ' ',
            'nama_saksi_1' => $saksi[0]['nama'] ?? ' ',
            'nrp_saksi_1' => $saksi[0]['nrp'] ?? ' ',
            'jabatan_saksi_1' => $saksi[0]['jabatan'] ?? ' ',
            'kesatuan_saksi_1' => $saksi[0]['kesatuan'] ?? ' ',
            'pangkat_saksi_2' => $saksi[1]['pangkat'] ?? ' ',
            'nama_saksi_2' => $saksi[1]['nama'] ?? ' ',
            'nrp_saksi_2' => $saksi[1]['nrp'] ?? ' ',
            'jabatan_saksi_2' => $saksi[1]['jabatan'] ?? ' ',
            'kesatuan_saksi_2' => $saksi[1]['kesatuan'] ?? ' ',
            'pangkat_saksi_3' => $saksi[2]['pangkat'] ?? ' ',
            'nama_saksi_3' => $saksi[2]['nama'] ?? ' ',
            'nrp_saksi_3' => $saksi[2]['nrp'] ?? ' ',
            'jabatan_saksi_3' => $saksi[2]['jabatan'] ?? ' ',
            'kesatuan_saksi_3' => $saksi[2]['kesatuan'] ?? ' ',
            'pangkat_saksi_4' => $saksi[3]['pangkat'] ?? ' ',
            'nama_saksi_4' => $saksi[3]['nama'] ?? ' ',
            'nrp_saksi_4' => $saksi[3]['nrp'] ?? ' ',
            'jabatan_saksi_4' => $saksi[3]['jabatan'] ?? ' ',
            'kesatuan_saksi_4' => $saksi[3]['kesatuan'] ?? ' ',
            'pangkat_saksi_5' => $saksi[4]['pangkat'] ?? ' ',
            'nama_saksi_5' => $saksi[4]['nama'] ?? ' ',
            'nrp_saksi_5' => $saksi[4]['nrp'] ?? ' ',
            'jabatan_saksi_5' => $saksi[4]['jabatan'] ?? ' ',
            'kesatuan_saksi_5' => $saksi[4]['kesatuan'] ?? ' ',
            'pangkat_1' => $penyidik[0]['pangkat']['name'] ?? ' ',
            'pangkat_2' => $penyidik[1]['pangkat']['name'] ?? ' ',
            'pangkat_3' => $penyidik[2]['pangkat']['name'] ?? ' ',
            'pangkat_4' => $penyidik[3]['pangkat']['name'] ?? ' ',
            'pangkat_5' => $penyidik[4]['pangkat']['name'] ?? ' ',
            'nama_saksi_6' => $saksi[5]['nama'] ?? '',
            'nrp_saksi_6' => $saksi[5]['nrp'] ?? '',
            'jabatan_saksi_6' => $saksi[5]['jabatan'] ?? '',
            'kesatuan_saksi_6' => $saksi[5]['kesatuan'] ?? '',
            'pangkat_saksi_6' => $saksi[5]['pangkat'] ?? '',

        ));

        $template_document->saveAs(storage_path('template_surat/' . $kasus->pelapor . '-laporan-hasil-audit.docx'));

        return response()->download(storage_path('template_surat/' . $kasus->pelapor . '-laporan-hasil-audit.docx'))->deleteFileAfterSend(true);
    }



    public static function valueDoc($kasus_id, $wawancara = false, $laporan = false, $undangan_gelar = false, $laporan_gelar = false, $limpah = false, $sidang = false, $penyerahan = false, $perbaikan = false, $permohonan = false, $pembentukan = false)
    {
        $kasus = DataPelanggar::find($kasus_id);
        $sprin = SprinHistory::where('data_pelanggar_id', $kasus_id)->first();

        $data = array();

        if ($wawancara) {
            $wawancara_data = Wawancara::where('data_pelanggar_id', $kasus_id)->first();
            $data['tanggal_wawancara'] = $wawancara_data ? Carbon::parse($wawancara_data->tanggal)->translatedFormat('d F Y') : '';
            $data['hari_wawancara'] = $wawancara_data ? Carbon::parse($wawancara_data->tanggal)->translatedFormat('l') : '';
            $data['ruangan_wawancara'] = $wawancara_data ? $wawancara_data->ruangan : '';
            $data['jam_wawancara'] = $wawancara_data ? $wawancara_data->jam : '';
            $data['alamat_wawancara'] = $wawancara_data ? $wawancara_data->alamat : '';
        }

        if ($laporan) {
            $laporan_data = LaporanHasilAudit::where('data_pelanggar_id', $kasus_id)->first();
            $data['nomor_laporan'] = $laporan_data->nomor_laporan;
            $data['tanggal_laporan'] = Carbon::parse($laporan_data->tanggal_laporan)->translatedFormat('d F Y');

            $saksi = Saksi::where('data_pelanggar_id', $kasus_id)->get()->toArray();

            $data['pangkat_saksi_1'] = $saksi[0]['pangkat'] ?? '';
            $data['nama_saksi_1'] = $saksi[0]['nama'] ?? '';
            $data['jabatan_saksi_1'] = $saksi[0]['jabatan'] ?? '';
            $data['nrp_saksi_1'] = $saksi[0]['nrp'] ?? '';
            $data['kesatuan_saksi_1'] = $saksi[0]['kesatuan'] ?? '';

            $data['pangkat_saksi_2'] = $saksi[1]['pangkat'] ?? '';
            $data['nama_saksi_2'] = $saksi[1]['nama'] ?? '';
            $data['jabatan_saksi_2'] = $saksi[1]['jabatan'] ?? '';
            $data['nrp_saksi_2'] = $saksi[1]['nrp'] ?? '';
            $data['kesatuan_saksi_2'] = $saksi[1]['kesatuan'] ?? '';

            $data['pangkat_saksi_3'] = $saksi[2]['pangkat'] ?? '';
            $data['nama_saksi_3'] = $saksi[2]['nama'] ?? '';
            $data['jabatan_saksi_3'] = $saksi[2]['jabatan'] ?? '';
            $data['nrp_saksi_3'] = $saksi[2]['nrp'] ?? '';
            $data['kesatuan_saksi_3'] = $saksi[2]['kesatuan'] ?? '';

            $data['pangkat_saksi_4'] = $saksi[3]['pangkat'] ?? '';
            $data['nama_saksi_4'] = $saksi[3]['nama'] ?? '';
            $data['jabatan_saksi_4'] = $saksi[3]['jabatan'] ?? '';
            $data['nrp_saksi_4'] = $saksi[3]['nrp'] ?? '';
            $data['kesatuan_saksi_4'] = $saksi[3]['kesatuan'] ?? '';

            $data['pangkat_saksi_5'] = $saksi[4]['pangkat'] ?? '';
            $data['nama_saksi_5'] = $saksi[4]['nama'] ?? '';
            $data['jabatan_saksi_5'] = $saksi[4]['jabatan'] ?? '';
            $data['nrp_saksi_5'] = $saksi[4]['nrp'] ?? '';
            $data['kesatuan_saksi_5'] = $saksi[4]['kesatuan'] ?? '';

            $data['pangkat_saksi_6'] = $saksi[5]['pangkat'] ?? '';
            $data['nama_saksi_6'] = $saksi[5]['nama'] ?? '';
            $data['jabatan_saksi_6'] = $saksi[5]['jabatan'] ?? '';
            $data['nrp_saksi_6'] = $saksi[5]['nrp'] ?? '';
            $data['kesatuan_saksi_6'] = $saksi[5]['kesatuan'] ?? '';
        }

        if ($undangan_gelar) {
            $undangan_gelar_data = UndanganGelar::where('data_pelanggar_id', $kasus_id)->first();
            $penyidik = Penyidik::where('id', $undangan_gelar_data->id_penyidik)->first();
            $data['nomor_gelar'] = $undangan_gelar_data->nomor_gelar;
            $data['tanggal_gelar'] = Carbon::parse($undangan_gelar_data->tanggal_gelar)->translatedFormat('d F Y');
            $data['hari_gelar'] = Carbon::parse($undangan_gelar_data->tanggal_gelar)->translatedFormat('l');
            $data['pukul_gelar'] = $undangan_gelar_data->jam_gelar;
            $data['tempat_gelar'] = $undangan_gelar_data->tempat_gelar;
            $data['pangkat_akreditor'] = $penyidik->pangkat->name;
            $data['nama_akreditor'] = $penyidik->name;
            $data['no_telp_akreditor'] = $undangan_gelar_data->nomor_handphone;
            $date = date('Y-m-d');
            $data['bulan_tahun_surat'] = Carbon::parse($date)->translatedFormat('F Y');
        }

        if ($laporan_gelar) {
            $laporan_gelar_data = LaporanHasilGelar::where('data_pelanggar_id', $kasus_id)->first();
            $penyidik_pembuat = Penyidik::where('id', $laporan_gelar_data->id_penyidik_pembuat)->first();
            $penyidik_pemapar = Penyidik::where('id', $laporan_gelar_data->id_penyidik_pemapar)->first();
            $undangan_gelar_data = UndanganGelar::where('data_pelanggar_id', $kasus_id)->first();

            $date = date('Y-m-d');
            $bukti = $laporan_gelar_data->bukti;

            $data['nomor_gelar'] = $undangan_gelar_data->nomor_gelar;
            $data['tanggal_gelar'] = Carbon::parse($undangan_gelar_data->tanggal_gelar)->translatedFormat('d F Y');

            $data['tanggal_laporan_gelar'] = Carbon::parse($laporan_gelar_data->tanggal_laporan_gelar)->translatedFormat('d F Y');
            $data['nama_pimpinan_gelar'] = $laporan_gelar_data->nama_pimpinan_gelar;
            $data['pangkat_pimpinan_gelar'] = $laporan_gelar_data->pangkat->name;
            $data['jabatan_pimpinan_gelar'] = $laporan_gelar_data->jabatan_pimpinan_gelar;
            $data['kesatuan_pimpinan_gelar'] = $laporan_gelar_data->kesatuan_pimpinan_gelar;
            $data['bulan_tahun_surat'] = Carbon::parse($date)->translatedFormat('F Y');
            $data['bukti'] = $bukti;
            $data['nama_pemapar'] = $penyidik_pemapar->name;
            $data['pangkat_pemapar'] = $penyidik_pemapar->pangkat->name;
            $data['jabatan_pemapar'] = $penyidik_pemapar->jabatan;
            $data['kesatuan_pemapar'] = $penyidik_pemapar->kesatuan;
            $data['nrp_pembuat'] = $penyidik_pembuat->nrp;
            $data['nama_pembuat'] = $penyidik_pembuat->name;
            $data['pangkat_pembuat'] = $penyidik_pembuat->pangkat->name;
            $data['nama_terlapor'] = strtoupper($kasus->terlapor);
            $data['pangkat_terlapor'] = $kasus->pangkat ? $kasus->pangkat->name : 'TIDAK TAHU';
            $data['jabatan_terlapor'] = strtoupper($kasus->jabatan);
            $data['kesatuan_terlapor'] = strtoupper($kasus->kesatuan);
        }

        if ($limpah) {
            $limpah_data = LimpahPolda::where('data_pelanggar_id', $kasus_id)->first();
            $data['tanggal_limpah'] = Carbon::parse($limpah_data->tanggal_limpah)->translatedFormat('d F Y');
            $data['nomor_limpah'] = $limpah_data->nomor_limpah;
            $data['polda'] = $limpah_data->polda->name;
            $data['alamat_polda'] = $limpah_data->alamat_polda;
            $data['nomor_klarifikasi'] = $limpah_data->nomor_klarifikasi;
            $data['tanggal_klarifikasi'] = Carbon::parse($limpah_data->tanggal_klarifikasi)->translatedFormat('d F Y');
            $data['perihal_klarifikasi'] = $limpah_data->perihal_klarifikasi;
            $data['nama_terlapor'] = strtoupper($kasus->terlapor);
        }

        if ($sidang) {
            $sidang_data = Sidang::where('data_pelanggar_id', $kasus_id)->first();
            $data['hari_sidang'] = Carbon::parse($sidang_data->tanggal)->translatedFormat('l');
            $data['bulan_tahun_sidang'] = Carbon::parse($sidang_data->tanggal)->translatedFormat('F Y');
            $data['tanggal_sidang'] = Carbon::parse($sidang_data->tanggal)->translatedFormat('d F Y');
            $data['jam_sidang'] = $sidang_data->jam;
            $data['tempat_sidang'] = $sidang_data->tempat;
            $data['pakaian'] = $sidang_data->pakaian;
        }

        if ($penyerahan) {
            $penyerahan_data = Pemberkasan::where('data_pelanggar_id', $kasus_id)->first();
            $lpa = Lpa::where('data_pelanggar_id', $kasus_id)->first();
            $data['bulan_tahun_bp3kepp'] = Carbon::parse($penyerahan_data->tgl_bp3kepp)->translatedFormat('F Y');
            $data['tanggal_bp3kepp'] = Carbon::parse($penyerahan_data->tgl_bp3kepp)->translatedFormat('d F Y');
            $data['nomor_bp3kepp'] = $penyerahan_data->no_bp3kepp;
            $data['tanggal_lpa'] = Carbon::parse($lpa->created_at)->translatedFormat('d F Y');
            $data['no_lpa'] = $lpa->nomor_surat;
            $data['no_nota_dinas_penyerahan'] = $penyerahan_data->no_nota_dinas_penyerahan;
        }

        if ($perbaikan) {
            $perbaikan_data = Pemberkasan::where('data_pelanggar_id', $kasus_id)->get()->toArray();
            $data['bulan_tahun_perbaikan'] = Carbon::parse($perbaikan_data[0]['created_at'])->translatedFormat('F Y');
            $index = 1;
            for ($i = 0; $i < count($perbaikan_data); $i++) {
                $data['tanggal_terduga_' . $index] = Carbon::parse($perbaikan_data[$i]['tanggal'])->translatedFormat('d F Y') ?? '';
                $data['nomor_terduga_' . $index] = $perbaikan_data[$i]['nomor'] ?? '';
                $data['pangkat_terduga_' . $index] = $perbaikan_data[$i]['pangkat'] ?? '';
                $data['nama_terduga_' . $index] = $perbaikan_data[$i]['nama'] ?? '';
                $data['nrp_terduga_' . $index] = $perbaikan_data[$i]['nrp'] ?? '';
                $data['jabatan_terduga_' . $index] = $perbaikan_data[$i]['jabatan'] ?? '';
                $data['kesatuan_terduga_' . $index] = $perbaikan_data[$i]['kesatuan'] ?? '';
                $index++;
            }
        }

        if ($permohonan) {
            $permohonan_data = Pemberkasan::where('data_pelanggar_id', $kasus_id)->first();
            $laporan_gelar = LaporanHasilGelar::where('data_pelanggar_id', $kasus_id)->first();
            $lpa = Lpa::where('data_pelanggar_id', $kasus_id)->first();
            $data['bulan_tahun_lpa'] = Carbon::parse($lpa->created_at)->translatedFormat('F Y');
            $data['tanggal_lpa'] = Carbon::parse($lpa->created_at)->translatedFormat('d F Y');
            $data['no_lpa'] = $lpa->nomor_surat;
            $data['pasal_lpa'] = $laporan_gelar->pasal_dilanggar;
            $data['no_nota_perbaikan'] = $permohonan_data->no_nota_dinas_perbaikan;
            $data['tanggal_no_perbaikan'] = Carbon::parse($permohonan_data->tgl_nota_dinas_perbaikan)->translatedFormat('F Y');
            $data['bulan_tahun_perbaikan'] = Carbon::parse($permohonan_data->tgl_nota_dinas_perbaikan)->translatedFormat('F Y');
            // $perbaikan_data = Bp3kepps::where(array('data_pelanggar_id' => $kasus_id, 'id' => $permohonan_data->bp3kepp_id))->first();

            // $data['nomor_terduga'] = $perbaikan_data->nomor;
            // $data['pangkat_terduga'] = $perbaikan_data->pangkat;
            // $data['nama_terduga'] = $perbaikan_data->nama;
            // $data['nrp_terduga'] = $perbaikan_data->nrp;
            // $data['jabatan_ter'] = $perbaikan_data->jabatan;
            // $data['kesatuan_terduga'] = $perbaikan_data->kesatuan;
        }

        if ($pembentukan) {
            // $pembentukan_data = PembentukanKomisi::where('data_pelanggar_id', $kasus_id)->first();
            // $data['bulan_tahun_pembentukan'] = Carbon::parse($pembentukan_data->created_at)->translatedFormat('F Y');
            // $data['tanggal_pembentukan'] = Carbon::parse($pembentukan_data->created_at)->translatedFormat('d F Y');
            // $data['nomor_pembentukan'] = $pembentukan_data->nomor;
            // $data['nomor_surat_divkum'] = $pembentukan_data->nomor_surat_divkum;
            // $data['tanggal_surat_divkum'] = Carbon::parse($pembentukan_data->tanggal_surat_divkum)->translatedFormat('d F Y');
            // $data['pangkat_pelanggar'] = $pembentukan_data->pangkat;
            // $data['nama_pelanggar'] = $pembentukan_data->nama;
            // $data['jabtan_pelanggar'] = $pembentukan_data->jabatan;
            // $data['kesatuan_pelanggar'] = $pembentukan_data->kesatuan;
        }

        $disposisi = Disposisi::where('data_pelanggar_id', $kasus_id)
            ->where('type', 1)->first();
        $nota_dinas = explode('/', $kasus->no_nota_dinas);
        $kepala_bagian = end($nota_dinas);
        $data += array(
            'kepala_bagian' => $kepala_bagian,
            'tanggal_audit' => $sprin ? Carbon::parse($sprin->tanggal_investigasi)->translatedFormat('d F Y') : '....',
            'no_sprin' => $sprin ? $sprin->no_sprin : '...',
            'tim' => $disposisi ? $disposisi->tim : '...',
            'bulan_tahun_sprin' => $sprin ? Carbon::parse($sprin->created_at)->translatedFormat('F Y') : '...',
            'tanggal_sprin' => $sprin ? Carbon::parse($sprin->created_at)->translatedFormat('d F Y') : '...',
            'tanggal_no_dinas' => Carbon::parse($kasus->tanggal_nota_dinas)->translatedFormat('d F Y'),
            'no_nota_dinas' => $kasus->no_nota_dinas,
            'perihal' => $kasus->perihal_nota_dinas,
            'pelapor' => $kasus->pelapor,
            'no_telp' => $kasus->no_telp,
            'terlapor' => $kasus->terlapor,
            'kronologi' => $kasus->kronologi,
            'nama_korban' => $kasus->nama_korban,
            'tempat_kejadian' => $kasus->tempat_kejadian,
            'nrp' => $kasus->nrp,
            'pangkat' =>  $kasus->pangkat ? $kasus->pangkat->name : 'Pangkat Belum Dipilih',
            'kesatuan' => $kasus->kesatuan,
            'jabatan' => $kasus->jabatan,
            'agama' => $kasus->religi ? $kasus->religi->name : '',
            'suku_terlapor' => $kasus->suku,
            // 'agama_terlapor' => $kasus->religi_terlapor->name,
            'alamat_terlapor' => $kasus->alamat_terlapor,
            'alamat' => $kasus->alamat,
            'wujud_perbuatan' => $kasus->wujud_perbuatan ? $kasus->wujud_perbuatan->keterangan_wp : '',
            'tanggal_ttd' => Carbon::parse($sprin->created_at)->translatedFormat('d F Y'),
            'ketua' => $penyidik[0]['name'] ?? ' ',
            'pangkat_ketua' => $penyidik[0]['pangkat'] ?? ' ',
            'nrp_ketua' => $penyidik[0]['nrp'] ?? ' ',
            'anggota_1' => $penyidik[1]['name'] ?? ' ',
            'pangkat_1' => $penyidik[1]['pangkat'] ?? ' ',
            'nrp_1' => $penyidik[1]['nrp'] ?? ' ',
            'anggota_2' => $penyidik[2]['name'] ?? ' ',
            'pangkat_2' => $penyidik[2]['pangkat'] ?? ' ',
            'nrp_2' => $penyidik[2]['nrp'] ?? ' ',
            'anggota_3' => $penyidik[3]['name'] ?? ' ',
            'pangkat_3' => $penyidik[3]['pangkat'] ?? ' ',
            'nrp_3' => $penyidik[3]['nrp'] ?? ' ',
            'anggota_4' => $penyidik[4]['name'] ?? ' ',
            'pangkat_4' => $penyidik[4]['pangkat'] ?? ' ',
            'nrp_4' => $penyidik[4]['nrp'] ?? ' ',
            'anggota_5' => $penyidik[5]['name'] ?? ' ',
            'pangkat_5' => $penyidik[5]['pangkat'] ?? ' ',
            'nrp_5' => $penyidik[5]['nrp'] ?? ' ',
            'jabatan_1' => $penyidik[0]['jabatan'] ?? ' ',
            'jabatan_2' => $penyidik[1]['jabatan'] ?? ' ',
            'jabatan_3' => $penyidik[2]['jabatan'] ?? ' ',
            'jabatan_4' => $penyidik[3]['jabatan'] ?? ' ',
            'jabatan_5' => $penyidik[4]['jabatan'] ?? ' ',
            'jabatan_6' => $penyidik[5]['jabatan'] ?? ' '
        );

        return $data;
    }

    public function viewPenyidik($tim)
    {
        $penyidik = Penyidik::where('tim', $tim)->get();

        $data = [
            'penyidiks' => $penyidik,
        ];

        // echo "<pre>";
        // print_r($data);
        // die();

        return view('pages.data_pelanggaran.proses.data_penyidik', $data);
    }

    public function viewPangkat()
    {
        $penyidik = Pangkat::get();

        return json_encode($penyidik);
    }
}
