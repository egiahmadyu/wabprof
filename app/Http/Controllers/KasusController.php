<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Models\Agama;
use App\Models\Bap;
use App\Models\DataPelanggar;
use App\Models\Disposisi;
use App\Models\GelarPerkaraHistory;
use App\Models\JenisIdentitas;
use App\Models\UndanganGelar;
use App\Models\LaporanHasilGelar;
use App\Models\JenisKelamin;
use App\Models\LimpahPolda;
use App\Models\Process;
use App\Models\Sidang;
use App\Models\Penyerahan;
use App\Models\Penyidik;
use App\Models\Permohonan;
use App\Models\Bp3kepps;
use App\Models\Dihentikan;
use App\Models\Klarifikasi;
use App\Models\Lpa;
use App\Models\Sp2hp2Hisory;
use App\Models\SprinHistory;
use App\Models\UukHistory;
use App\Models\Pangkat;
use App\Models\Pemberkasan;
use App\Models\Penuntutan;
use App\Models\Polda;
use App\Models\SidangBanding;
use App\Models\SidangKepp;
use App\Models\SidangPeninjauan;
use App\Models\SprinRiksa;
use App\Models\Timeline;
use App\Models\WujudPerbuatan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use DataTables;
use DB;

class KasusController extends Controller
{
    public function index()
    {
        $data['kasuss'] = DataPelanggar::get();
        $data['diterima'] = $data['kasuss']->where('status_id', 1);
        $data['diproses'] = $data['kasuss']->where('status_id', '>', 1)->where('status_id', '<', 6);
        $data['selesai'] = $data['kasuss']->where('status_id', 6);
        return view('pages.data_pelanggaran.index', $data);
    }

    public function inputKasus()
    {
        $agama = Agama::get();
        $jenis_identitas = JenisIdentitas::get();
        $jenis_kelamin = JenisKelamin::get();
        $pangkat = Pangkat::get();
        $wujud_perbuatan = WujudPerbuatan::where('jenis_wp', 'kode etik')->get();
        $data = [
            'agama' => $agama,
            'jenis_identitas' => $jenis_identitas,
            'jenis_kelamin' => $jenis_kelamin,
            'pangkat' => $pangkat,
            'wujud_perbuatan' => $wujud_perbuatan,
            'kesatuan' => Polda::all()
        ];

        return view('pages.data_pelanggaran.input_kasus.input', $data);
    }

    public function storeKasus(Request $request)
    {

        $no_pengaduan = "123456"; //generate otomatis
        // dd($request->all());
        $DP = DataPelanggar::create([
            'no_nota_dinas' => $request->no_nota_dinas,
            'no_pengaduan' => $no_pengaduan,
            'perihal_nota_dinas' => $request->perihal_nota_dinas,
            'id_wujud_perbuatan' => $request->id_wujud_perbuatan,
            'tanggal_nota_dinas' => $request->tanggal_nota_dinas,
            'pelapor' => $request->pelapor,
            'umur' => $request->umur,
            'jenis_kelamin' => $request->jenis_kelamin,
            'pekerjaan' => $request->pekerjaan,
            'agama' => $request->agama,
            'suku' => $request->suku,
            'agama_terlapor' => $request->agama_terlapor,
            'alamat' => $request->alamat,
            'alamat_terlapor' => $request->alamat_terlapor,
            'no_identitas' => $request->no_identitas,
            'pendidikan_terakhir' => $request->pendidikan_terakhir,
            'no_telp' => $request->no_telp,
            'np_hp' => $request->np_hp,
            'jenis_identitas' => $request->jenis_identitas,
            'kewarganegaraan' => 'WNI',
            'terlapor' => $request->terlapor,
            'nrp' => $request->nrp,
            'jabatan' => $request->jabatan,
            'kesatuan' => $request->kesatuan,
            'tempat_kejadian' => $request->tempat_kejadian,
            'tanggal_kejadian' => $request->tanggal_kejadian,
            'kronologi' => $request->kronologis,
            'alamat_tempat_tinggal' => $request->alamat_tempat_tinggal,
            'no_hp' => $request->no_hp,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'id_pangkat' => $request->id_pangkat,
            'nama_korban' => $request->nama_korban,
            'pengaduan_dari' => $request->pengaduan_dari,
            'created_by' => auth()->user()->id,
            'status_id' => 1
        ]);
        return redirect()->route('kasus.detail', ['id' => $DP->id]);
    }

    public function data(Request $request)
    {
        $query = DataPelanggar::with('processes', 'pangkats');
        if (auth()->user()->hasRole('urtu')) {
            $query = $query->doesntHave('disposisi_urtu')->where('status_id', 1);
        } else if(auth()->user()->hasRole('urmin')) {
            $query = $query->where('data_pelanggars.status_id', 1)->with('disposisi_urmin')
            ->whereExists(function($query)
                {
                    $query->select(DB::raw(1))
                        ->from('disposisis')
                        ->whereRaw("data_pelanggar_id = data_pelanggars.id")
                        ->where(function($q) {
                            $q->where('type', 2)->orWhere('type', 3);
                        });
                });
        } else if(auth()->user()->hasRole('akreditor')) {
            $query = $query->with('disposisi_urmin')
            ->whereExists(function($query)
            {
                $query->select(DB::raw(1))
                    ->from('disposisis')
                    ->whereRaw("data_pelanggar_id = data_pelanggars.id")
                    ->where(function($q) {
                        $q->where('type', 1)
                        ->where('tim', auth()->user()->tim);
                    });
            });
        }

        return Datatables::of($query)->addIndexColumn()
            ->editColumn('no_nota_dinas', function ($query) {
                return '<a href="/data-kasus/detail/' . $query->id . '">' . $query->no_nota_dinas . '</a>';
            })->editColumn('pangkats.name', function ($query) {
                if (!$query->pangkats) return '-';
                return $query->pangkats->name;
            })
            ->addColumn('tgl_nd', function($query) {
                return Carbon::parse($query->tanggal_nota_dinas)->translatedFormat('d F Y');
            })
            ->setRowAttr([
                'style' => function ($data) {
                    return $data->status_dihentikan == 1 ? 'background-color: red;color:white' : '';
                }
            ])
            ->addColumn('action', function($data) {
                $html = '';
                if (auth()->user()->hasRole('admin')) {
                    $html = '<a href="/kasus/delete/'.$data->id.'"><button class="btn btn-sm btn-danger">Hapus Data</button></a>';
                }
                return $html;
            })
            ->rawColumns(['no_nota_dinas', 'action'])
            ->make(true);
    }

    public function hentikan_kasus($id)
    {
        $kasus = DataPelanggar::find($id);
        $kasus->status_dihentikan = 1;
        $kasus->save();
        Dihentikan::create([
            'data_pelanggar_id' => $kasus->id,
            'note' => 'Kasus Dihentikan'
        ]);
        Helper::saveHistory(10, $kasus->id);

        return response()->json([
            'message' => 'success',
            'status' => 200
        ]);
    }

    public function detail($id)
    {
        $kasus = DataPelanggar::find($id);
        $status = Process::find($kasus->status_id);
        $process = Process::where('sort', '<=', $status->id)->get();
        $agama = Agama::get();
        $pangkat = Pangkat::all();
        $polda = Polda::all();
        $wujud_perbuatan = WujudPerbuatan::where('jenis_wp')->get();
        $option_polda = '';
        $option_pangkat = '';
        foreach ($polda as $key => $value) {
            $option_polda .= '<option value="' . $value->name . '">' . $value->name . '</option>';
        }

        foreach ($pangkat as $key => $value) {
            $option_pangkat .= '<option value="' . $value->id . '">' . $value->name . '</option>';
        }
        // dd($pangkat);

        // dd($agama[0]->name);
        $data = [
            'kasus' => $kasus,
            'status' => $status,
            'process' =>  $process,
            'pangkat' =>  $pangkat,
            'wujud_perbuatan' =>  $wujud_perbuatan,
            'polda' => $polda,
            'option_pangkat' => $option_pangkat,
            'option_polda' => $option_polda,
        ];

        return view('pages.data_pelanggaran.detail', $data);
    }

    public function updateData(Request $request)
    {
        // if ($request->type_submit === 'update_status') {
        //     return $this->updateStatus(($request));
        // }
        $data_pelanggar = DataPelanggar::where('id', $request->kasus_id)->first();
        // $data_pelanggar->update([
        //     'no_nota_dinas' => $request->no_nota_dinas,
        //     'perihal_nota_dinas' => $request->perihal_nota_dinas,
        //     'pelapor' => $request->pelapor,
        //     'umur' => $request->umur,
        //     'jenis_kelamin' => $request->jenis_kelamin,
        //     'pekerjaan' => $request->pekerjaan,
        //     'agama' => $request->agama,
        //     'suku' => $request->suku,
        //     'id_wujud_perbuatan' => $request->id_wujud_perbuatan,
        //     'agama_terlapor' => $request->agama_terlapor,
        //     'alamat_terlapor' => $request->alamat_terlapor,
        //     'suku' => $request->suku,
        //     'alamat' => $request->alamat,
        //     'no_identitas' => $request->no_identitas,
        //     'no_telp' => '08212345678',
        //     'jenis_identitas' => $request->jenis_identitas,
        //     'kewarganegaraan' => 'WNI',
        //     'terlapor' => $request->terlapor,
        //     'kesatuan' => $request->kesatuan,
        //     'jabatan' => $request->jabatan,
        //     'tempat_kejadian' => $request->tempat_kejadian,
        //     'tanggal_kejadian' => Carbon::create($request->tanggal_kejadian)->format('Y-m-d'),
        //     'kronologi' => $request->kronologis,
        //     'id_pangkat' => $request->id_pangkat,
        //     'nama_korban' => $request->nama_korban,
        // ]);
        $data_pelanggar->update($request->all());
        if ($request->type_submit == 'update_status') {
            return $this->updateStatus(($request));
        }
        return redirect()->back();
    }

    public function updateStatus(Request $request)
    {
        Helper::saveHistory($request->disposisi_tujuan, $request->kasus_id);
        if ($request->disposisi_tujuan != 8) {
            DataPelanggar::where('id', $request->kasus_id)
                ->update([
                    'status_id' => $request->disposisi_tujuan
                ]);

            return redirect()->back();
        }
        return $this->limpahToPolda($request);
    }

    public function viewProcess($kasus_id, $status_id)
    {
        if ($status_id == 1) return $this->viewDiterima($kasus_id);
        elseif ($status_id == 2) return $this->viewTimeLine($kasus_id);
        elseif ($status_id == 3) return $this->viewAuditInvestigasi($kasus_id);
        elseif ($status_id == 4) return $this->viewGelarInvestigasi($kasus_id);
        elseif ($status_id == 5) return $this->viewSidik($kasus_id);
        elseif ($status_id == 6) return $this->viewPemberkasan($kasus_id);
        elseif ($status_id == 7) return $this->viewSidang($kasus_id);
        elseif ($status_id == 8) return $this->viewLimpah($kasus_id);
        elseif ($status_id == 9) return $this->viewPenuntutan($kasus_id);
        // elseif ($status_id == 4) return $this->viewPulbaket($kasus_id);
        // elseif ($status_id == 5) return $this->viewGelarPenyelidikan($kasus_id);
        // elseif ($status_id == 6) return $this->viewLimpahBiro($kasus_id);
    }

    public function viewPenuntutan($id)
    {
        $kasus = DataPelanggar::find($id);
        $perbaikan = Bp3kepps::where('data_pelanggar_id', $id)->first();
        $perbaikan_data = Bp3kepps::where('data_pelanggar_id', $id)->get();
        $disposisi = Disposisi::where('data_pelanggar_id', $id)
            ->where('type', 1)->first();
        $data = [
            'kasus' => $kasus,
            'perbaikan' => $perbaikan,
            'perbaikan_data' => $perbaikan_data,
            'sprin' => $disposisi,
            'uuk' => UukHistory::where('data_pelanggar_id', $id)->first(),
            'sp2hp_awal' => Sp2hp2Hisory::where('data_pelanggar_id', $id)->first(),
            'penuntutan' => Penuntutan::where('data_pelanggar_id', $id)->first(),
            'pemberkasan' => Pemberkasan::where('data_pelanggar_id', $id)->first()
        ];
        return view('pages.data_pelanggaran.proses.penuntutan', $data);
    }

    private function viewSidang($id)
    {
        $kasus = DataPelanggar::find($id);
        // $status = Process::find($kasus->status_id);
        // $process = Process::where('sort', '<=', $status->id)->get();
        $perbaikan = Bp3kepps::where('data_pelanggar_id', $id)->first();
        $perbaikan_data = Bp3kepps::where('data_pelanggar_id', $id)->get();

        $data = [
            'kasus' => $kasus,
            'perbaikan' => $perbaikan,
            'perbaikan_data' => $perbaikan_data,
            'sprin' => SprinHistory::where('data_pelanggar_id', $id)->first(),
            'uuk' => UukHistory::where('data_pelanggar_id', $id)->first(),
            'sp2hp_awal' => Sp2hp2Hisory::where('data_pelanggar_id', $id)->first(),
            'sidang' => SidangKepp::where('data_pelanggar_id', $id)->with(['keputusan_etiks'])->first(),
            'sidang_banding' => SidangBanding::where('data_pelanggar_id', $id)->first(),
            'sidang_kembali' => SidangPeninjauan::where('data_pelanggar_id', $id)->first()
        ];
        return view('pages.data_pelanggaran.proses.sidang', $data);
    }

    private function viewTimeLine($id)
    {
        $kasus = DataPelanggar::find($id);
        $tim = ['A', 'B', 'C', 'D', 'E', 'F'];
        $disposisi = Disposisi::where('data_pelanggar_id', $id)->where('type', 1)->first();
        $penyidik = Penyidik::where('tim', $disposisi->tim)->get();
        $data_klarifikasi = Klarifikasi::where('data_pelanggar_id', $id)->first();;
        $data = [
            'kasus' => $kasus,
            'tims' => $tim,
            'disposisi' => $disposisi,
            'penyidiks' => $penyidik,
            'data_klarifikasi' => $data_klarifikasi,
            'sprin' => SprinHistory::where('data_pelanggar_id', $id)->first(),
            'uuk' => UukHistory::where('data_pelanggar_id', $id)->first(),
            'sp2hp_awal' => Sp2hp2Hisory::where('data_pelanggar_id', $id)->first(),
            'pangkat' => Pangkat::all(),
            'kesatuan' => Polda::all()
        ];
        return view('pages.data_pelanggaran.proses.timeline', $data);
    }

    private function viewPemberkasan($id)
    {
        $kasus = DataPelanggar::find($id);
        $administrasi_sidang = Sidang::where('data_pelanggar_id', $id)->first();
        $penyerahan = Penyerahan::where('data_pelanggar_id', $id)->first();
        $perbaikan = Bp3kepps::where('data_pelanggar_id', $id)->first();
        $perbaikan_data = Bp3kepps::where('data_pelanggar_id', $id)->get();
        $permohonan = Permohonan::where('data_pelanggar_id', $id)->first();
        $pemberkasan = Pemberkasan::where('data_pelanggar_id', $id)->first();

        // $process = Process::where('sort', '<=', $status->id)->get();

        $data = [
            'kasus' => $kasus,
            'administrasi_sidang' => $administrasi_sidang,
            'penyerahan' => $penyerahan,
            'perbaikan' => $perbaikan,
            'permohonan' => $permohonan,
            'perbaikan_data' => $perbaikan_data,
            'sprin' => SprinHistory::where('data_pelanggar_id', $id)->first(),
            'uuk' => UukHistory::where('data_pelanggar_id', $id)->first(),
            'sp2hp_awal' => Sp2hp2Hisory::where('data_pelanggar_id', $id)->first(),
            'pemberkasan' => $pemberkasan
        ];
        return view('pages.data_pelanggaran.proses.pemberkasan', $data);
    }

    private function viewSidik($id)
    {
        $kasus = DataPelanggar::find($id);
        // $status = Process::find($kasus->status_id);
        // $process = Process::where('sort', '<=', $status->id)->get();

        $data = [
            'kasus' => $kasus,
            'sprin' => SprinHistory::where('data_pelanggar_id', $id)->first(),
            'uuk' => UukHistory::where('data_pelanggar_id', $id)->first(),
            'sp2hp_awal' => Sp2hp2Hisory::where('data_pelanggar_id', $id)->first(),
            'bap' => Bap::where('data_pelanggar_id', $id)->first(),
            'lpa' => Lpa::where('data_pelanggar_id', $id)->first(),
            'sprin_riksa' => SprinRiksa::where('data_pelanggar_id', $id)->first(),
            'laporan_gelar' => LaporanHasilGelar::where('data_pelanggar_id', $id)->first(),
        ];
        return view('pages.data_pelanggaran.proses.sidik', $data);
    }

    private function viewLimpahBiro($id)
    {
        $kasus = DataPelanggar::find($id);
        $status = Process::find($kasus->status_id);
        $data = [
            'kasus' => $kasus,
            'status' => $status,
            'sprin' => SprinHistory::where('data_pelanggar_id', $id)->first(),
            'ugp' => GelarPerkaraHistory::where('data_pelanggar_id', $id)->first()
        ];

        return view('pages.data_pelanggaran.proses.limpah-biro', $data);
    }

    private function viewGelarPenyelidikan($id)
    {
        $kasus = DataPelanggar::find($id);
        $status = Process::find($kasus->status_id);
        $data = [
            'kasus' => $kasus,
            'status' => $status,
            'sprin' => SprinHistory::where('data_pelanggar_id', $id)->first(),
            'ugp' => GelarPerkaraHistory::where('data_pelanggar_id', $id)->first()
        ];

        return view('pages.data_pelanggaran.proses.gelar_penyelidikan', $data);
    }

    private function viewLimpah($id)
    {
        $kasus = DataPelanggar::find($id);
        $status = Process::find($kasus->status_id);
        $process = Process::where('sort', '<=', $status->id)->get();

        $data = [
            'kasus' => $kasus,
            'status' => $status,
            'process' =>  $process
        ];
        $data['limpahPolda'] = LimpahPolda::where('data_pelanggar_id', $id)->first();

        return view('pages.data_pelanggaran.proses.limpah_polda', $data);
    }

    private function limpahToPolda(Request $request)
    {
        // dd(auth()->user()->id);
        $data = DataPelanggar::find($request->kasus_id);
        $limpah = LimpahPolda::create([
            'data_pelanggar_id' => $request->kasus_id,
            'polda_id' => $request->polda,
            'tanggal_limpah' => date('Y-m-d'),
            'created_by' => auth()->user()->id,
            'isi_surat' => '<ol><li>Rujukan :&nbsp;<br><b>a</b>.&nbsp;Undang-Undang Nomor 2 Tahun 2022 tentang Kepolisian Negara Republik Indonesia.<br><b>b</b>.&nbsp;Peraturan Kepolisian Negara Republik Indonesia Nomor 7 Tahun 2022 tentang Kode Etik Profesi&nbsp; &nbsp; &nbsp;dan Komisi Kode Etik Polri.<br><b>c</b>.&nbsp;Peraturan Kepala Kepolisian Negara Republik Indonesia Nomor 13 Tahun 2016 tentang Pengamanan Internal di Lingkungan Polri<br><b>d</b>.&nbsp;Nota Dinas Kepala Bagian Pelayanan Pengaduan Divpropam Polri Nomor: R/ND-2766-b/XII/WAS.2.4/2022/Divpropam tanggal 16 Desember 2022 perihal pelimpahan Dumas BRIPKA JAMALUDDIN ASYARI.</li></ol>'
        ]);
        if ($limpah) {
            $data->status_id = $request->disposisi_tujuan;
            $data->save();
        }

        return redirect()->back();
    }

    private function viewDisposisi($id)
    {
        $kasus = DataPelanggar::find($id);
        $status = Process::find($kasus->status_id);
        $process = Process::where('sort', '<=', $status->id)->get();

        $data = [
            'kasus' => $kasus,
            'status' => $status,
            'process' =>  $process
        ];

        return view('pages.data_pelanggaran.proses.disposisi', $data);
    }

    private function viewDiterima($id)
    {
        $kasus = DataPelanggar::find($id);
        $status = Process::find($kasus->status_id);
        $process = Process::where('sort', '<=', $status->id)->get();
        $agama = Agama::get();
        $tim = ['A', 'B', 'C', 'D', 'E', 'F'];

        $jenis_identitas = JenisIdentitas::get();
        $jenis_kelamin = JenisKelamin::get();
        $pangkat = Pangkat::get();
        $wujud_perbuatan = WujudPerbuatan::where('jenis_wp', 'kode etik')->get();
        $data = [
            'kasus' => $kasus,
            'status' => $status,
            'process' =>  $process,
            'agama' => $agama,
            'tims' => $tim,
            'jenis_identitas' => $jenis_identitas,
            'jenis_kelamin' => $jenis_kelamin,
            'pangkat' => $pangkat,
            'wujud_perbuatan' => $wujud_perbuatan,
            'disposisi_kabag' => Disposisi::where('data_pelanggar_id', $id)->where('type', 1)->first(),
            'disposisi_karo' => Disposisi::where('data_pelanggar_id', $id)->where('type', 2)->first(),
            'disposisi_sesro' => Disposisi::where('data_pelanggar_id', $id)->where('type', 3)->first()
        ];

        return view('pages.data_pelanggaran.proses.diterima', $data);
    }

    private function viewAuditInvestigasi($id)
    {
        $kasus = DataPelanggar::find($id);
        // $status = Process::find($kasus->status_id);
        // $process = Process::where('sort', '<=', $status->id)->get();
        $tim = ['A', 'B', 'C', 'D', 'E', 'F'];

        $sprin = SprinHistory::where('data_pelanggar_id', $id)->first();
        $disposisi = Disposisi::where('data_pelanggar_id', $id)->where('type', 1)->first();
        $klarifikasi = Klarifikasi::where('data_pelanggar_id', $id)->first();
        // dd($klarifikasi);
        $data = [
            'kasus' => $kasus,
            'tims' => $tim,
            'sprin' => $sprin,
            'klarifikasi' => $klarifikasi,
            'penyidik' => Penyidik::where('fungsional', 'ketua')->where('tim', $disposisi->tim)->first(),
            'uuk' => UukHistory::where('data_pelanggar_id', $id)->first(),
            'disposisi' => $disposisi,
            'sp2hp_awal' => Sp2hp2Hisory::where('data_pelanggar_id', $id)->first(),
        ];

        return view('pages.data_pelanggaran.proses.audit_investigasi', $data);
    }

    private function viewGelarInvestigasi($id)
    {
        $kasus = DataPelanggar::find($id);
        $undangan_gelar = UndanganGelar::where('data_pelanggar_id', $id)->first();
        $laporan_gelar = LaporanHasilGelar::where('data_pelanggar_id', $id)->first();
        $pangkat = Pangkat::get();
        // $status = Process::find($kasus->status_id);
        // $process = Process::where('sort', '<=', $status->id)->get();
        $sprin = SprinHistory::where('data_pelanggar_id', $id)->first();

        $data = [
            'kasus' => $kasus,
            'undangan_gelar' => $undangan_gelar,
            'laporan_gelar' => $laporan_gelar,
            'sprin' => $sprin,
            'pangkat' => $pangkat,
            'penyidik' => Penyidik::where('tim', $sprin->tim)->get(),
            'penyidik_pemapar' => Penyidik::where('tim', $sprin->tim)->get(),
            'penyidik_kontak' => Penyidik::where('tim', $sprin->tim)->get(),
            'uuk' => UukHistory::where('data_pelanggar_id', $id)->first(),
            'sp2hp_awal' => Sp2hp2Hisory::where('data_pelanggar_id', $id)->first(),
        ];
        return view('pages.data_pelanggaran.proses.gelar_investigasi', $data);
    }

    public function delete($id)
    {
        $data = DataPelanggar::where('id', $id)->delete();

        return redirect()->back();
    }
}
