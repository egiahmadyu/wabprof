<input type="text" class="form-control" value="{{ $kasus->id }}" hidden id="kasus_id">
<input type="text" class="form-control" value="{{ $kasus->status_id }}" hidden id="status_id">
<div class="row">
    <div class="col-lg-12 mb-4">
        <div class="d-flex justify-content-between">
            <div>
                <button type="button" class="btn btn-info" onclick="getViewProcess(6)"><i
                        class="far fa-arrow-left"></i>
                    Sebelumnya</button>
            </div>
            <div>
                @if ($kasus->status_id == 7)
                    <button type="button" class="btn btn-primary" onclick="getViewProcess(7)">Selanjutnya <i
                            class="far fa-arrow-right"></i></button>
                @endif
            </div>
        </div>
    </div>

    <!-- Timeline -->
    <div class="row">
        <div class="col-lg-12" style="text-align: center;">
            <div class="f1-steps">
                <div class="f1-progress">
                    <div class="f1-progress-line" data-now-value="40" data-number-of-steps="7" style="width: 85.6%;">
                    </div>
                </div>
                <div class="f1-step activated">
                    <div class="f1-step-icon"><i class="fa fa-user"></i></div>
                    <p>Diterima</p>
                </div>
                <div class="f1-step activated">
                    <div class="f1-step-icon"><i class="fa fa-home"></i></div>
                    <p>Klarifikasi </p>
                </div>
                <div class="f1-step activated">
                    <div class="f1-step-icon"><i class="fa fa-home"></i></div>
                    <p>Gelar Audit Investigasi</p>
                </div>
                <div class="f1-step activated">
                    <div class="f1-step-icon"><i class="fa fa-address-book"></i></div>
                    <p>Riksa</p>
                </div>
                <div class="f1-step activated">
                    <div class="f1-step-icon"><i class="fa fa-address-book"></i></div>
                    <p>Pemberkasan</p>
                </div>

                <div class="f1-step active">
                    <div class="f1-step-icon"><i class="fa fa-key"></i></div>
                    <p>Penuntutan</p>
                </div>
                <div class="f1-step">
                    <div class="f1-step-icon"><i class="fa fa-address-book"></i></div>
                    <p>Sidang KEPP</p>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card border-dark">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <table>
                                {{-- <tr>
                                    <td> No. SPRIN </td>
                                    <td>:</td>
                                    <td>
                                        @if (isset($sprin))
                                            Sprin/{{ $sprin->no_sprin }}/HUK.6.6./2023
                                        @else
                                            -
                                        @endif
                                    </td>
                                </tr> --}}
                                <tr>
                                    <td>Pelapor</td>
                                    <td>:</td>
                                    <td>{{ $kasus->pelapor }}</td>
                                </tr>
                                <tr>
                                    <td>Terlapor</td>
                                    <td>:</td>
                                    <td>{{ $kasus->terlapor }}</td>
                                </tr>
                                <tr>
                                    <td>Pangkat / NRP</td>
                                    <td>:</td>
                                    <td>{{ $kasus->pangkat->name . ' / ' . $kasus->nrp }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>Perihal</td>
                                    <td>:</td>
                                    <td>{{ $kasus->perihal_nota_dinas }}</td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-lg-6">
                            <table>
                                <tr>
                                    <td>Pelimpahan Dari</td>
                                    <td>:</td>
                                    <td>{{ $kasus->pengaduan_dari ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <td>Unit Pelaksana</td>
                                    <td>:</td>
                                    <td>{{ auth()->user()->tim }}</td>
                                </tr>
                                <tr>
                                    <td>Ketua Tim</td>
                                    <td>:</td>
                                    <td>{{ $kasus->ketua_tim->penyidik->name }}</td>
                                </tr>

                            </table>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    {{-- <div class="row mb-4">
        <div class="div col-12">
            <button type="button" class="btn btn-primary col-12 btn-terlapor"><span class="far fa-plus-square"></span>
                Tambah Terlapor</button>
        </div>
    </div> --}}

    <div class="row mb-4">
        <form class="row g-3" novalidate id="form_penuntutan_awal" method="post"
            action="/penuntutan/permohonan_saran_hukum">
            @csrf
            <input type="text" name="data_pelanggar_id" value="{{ $kasus->id }}" hidden>
            <h4>Surat Permohonan Pendapat dan Saran Hukum</h4>
            <div class="col-md-6">
                <label for="inputEmail4" class="form-label">No Surat</label>
                <input type="tezt" class="form-control" name="permohonan_pendapat_dan_saran" required
                    value="{{ $penuntutan ? $penuntutan->permohonan_pendapat_dan_saran : '' }}">
            </div>
            <div class="col-md-6">
                <label for="inputPassword4" class="form-label">Tanggal Surat</label>
                <input type="date" class="form-control" name="tgl_permohonan_pendapat_dan_saran" required
                    value="{{ $penuntutan ? date('Y-m-d', strtotime($penuntutan->tgl_permohonan_pendapat_dan_saran)) : '' }}">
            </div>
            <hr>
            <div class="col-12">
                <button type="submit" class="btn btn-primary">{{ $penuntutan ? 'Download' : 'Buat Dokumen' }}</button>
            </div>
        </form>
        @if ($penuntutan)
            <form class="row g-3" novalidate id="form_penuntutan" method="post" action="/penuntutan/save">
                @csrf
                <input type="text" name="data_pelanggar_id" value="{{ $kasus->id }}" hidden>
                <hr>
                <h4>Surat Kepala Divisi Hukum Polri</h4>
                <div class="col-md-6">
                    <label for="inputEmail4" class="form-label">No Surat</label>
                    <input type="tezt" class="form-control" name="no_divkum" required
                        value="{{ $penuntutan ? $penuntutan->no_divkum : '' }}">
                </div>
                <div class="col-md-6">
                    <label for="inputPassword4" class="form-label">Tanggal Surat</label>
                    <input type="date" class="form-control" name="tanggal_divkum" required
                        value="{{ $penuntutan && $penuntutan->tanggal_divkum ? date('Y-m-d', strtotime($penuntutan->tanggal_divkum)) : '' }}">
                </div>
                @if ($penuntutan)
                    @if (!$penuntutan->no_divkum)
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary">Simpan Data</button>
                        </div>
                    @endif
                @endif
            </form>
        @endif

    </div>



    <!-- Isi Form -->
    @if ($penuntutan)
        @if ($penuntutan->no_divkum)
            <div class="row">
                <form class="row g-3" novalidate id="form_pemberkasan_update" method="post"
                    action="/pemberkasan/update">
                    <h4>Rencana Jadwal Sidang</h4>
                    @csrf
                    <input type="text" name="data_pelanggar_id" value="{{ $kasus->id }}" hidden>
                    <div class="col-2">
                        <label for="inputAddress" class="form-label">Tanggal Sidang</label>
                        <input type="date" class="form-control" name="tgl_sidang" required
                            value="{{ $pemberkasan ? ($pemberkasan->tgl_sidang ? date('Y-m-d', strtotime($pemberkasan->tgl_sidang)) : '') : '' }}">
                    </div>
                    <div class="col-2">
                        <label for="inputAddress" class="form-label">Jam Sidang</label>
                        <input type="time" class="form-control" name="jam_sidang" required
                            value="{{ $pemberkasan ? $pemberkasan->jam_sidang : '' }}">
                    </div>
                    <div class="col-4">
                        <label for="inputAddress2" class="form-label">Tempat Sidang</label>
                        <input type="text" class="form-control" name="tempat_sidang" required
                            value="{{ $pemberkasan ? $pemberkasan->tempat_sidang : '' }}">
                    </div>
                    <div class="col-md-4">
                        <label for="inputCity" class="form-label">Pakaian Sidang</label>
                        <input type="text" class="form-control" name="pakaian_sidang" required
                            value="{{ $pemberkasan ? $pemberkasan->pakaian_sidang : '' }}">
                    </div>
                    @if (!$pemberkasan->tgl_sidang)
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary">Simpan Data</button>
                        </div>
                    @endif
                    <hr>
                </form>
            </div>
        @endif
        @if ($pemberkasan->tgl_sidang)
            <div class="row">
                <div class="col-lg-12">
                    <table class="table table-centered align-middle table-nowrap mb-0" id="data-data">
                        <thead class="text-muted table-light">
                            <tr>
                                <th scope="col"> Nama Kegiatan</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Usulan Pembentukan Komisi Etik</td>
                                <td>
                                    <form action="/penuntutan/usulan_komisi" id="form_usulan_komisi" method="post"
                                        novalidate>
                                        @csrf
                                        <div class="row">
                                            <div class="col-lg-6">

                                                <input type="text" name="kasus_id" value="{{ $kasus->id }}"
                                                    hidden>
                                                <input type="text" class="form-control"
                                                    name="no_usulan_pembentukan_komisi" required
                                                    value="{{ $penuntutan ? $penuntutan->no_usulan_pembentukan_komisi : '' }}"
                                                    placeholder="No Usulan Pembentukan Komisi Etik"
                                                    {{ $penuntutan->no_usulan_pembentukan_komisi ? 'readonly' : '' }}>
                                            </div>
                                            <div class="col-lg-6">
                                                <button type="submit"
                                                    class="btn btn-primary">{{ $penuntutan->no_usulan_pembentukan_komisi ? 'Download' : 'Buat Dokumen' }}</button>
                                            </div>
                                        </div>
                                    </form>
                                </td>
                            </tr>
                            <tr>
                                <td>Pembentukan Komisi Kode Etik</td>
                                <td>
                                    <form action="/penuntutan/pembentukan_komisi" id="form_pembentukan_komisi"
                                        method="post" novalidate>
                                        @csrf
                                        <div class="row">
                                            <div class="col-lg-6">

                                                <input type="text" name="kasus_id" value="{{ $kasus->id }}"
                                                    hidden>
                                                <input type="text" class="form-control"
                                                    name="no_pembentukan_komisi" required
                                                    value="{{ $penuntutan ? $penuntutan->no_pembentukan_komisi : '' }}"
                                                    placeholder="No Pembentukan Komisi Etik"
                                                    {{ $penuntutan->no_pembentukan_komisi ? 'readonly' : '' }}>
                                            </div>
                                            <div class="col-lg-6">
                                                <input type="text" name="kasus_id" value="{{ $kasus->id }}"
                                                    hidden>
                                                <input type="date" class="form-control"
                                                    name="tanggal_pembentukan_komisi" required
                                                    value="{{ $penuntutan ? ($penuntutan->tanggal_pembentukan_komisi ? date('Y-m-d', strtotime($penuntutan->tanggal_pembentukan_komisi)) : '') : '' }}"
                                                    placeholder="No Usulan Pembentukan Komisi Etik"
                                                    {{ $penuntutan->tanggal_pembentukan_komisi ? 'readonly' : '' }}>
                                            </div>
                                        </div>
                                        <div class="row mt-2">
                                            <div class="col-lg-6">
                                                <button type="submit"
                                                    class="btn btn-primary">{{ $penuntutan->no_usulan_pembentukan_komisi ? 'Download' : 'Buat Dokumen' }}</button>
                                            </div>
                                        </div>
                                    </form>
                                </td>
                            </tr>
                            <tr>
                                <td>Pendamping Divkum</td>
                                <td>
                                    <form action="/penuntutan/pendamping_divkum" id="form_pendamping_divkum"
                                        method="post" novalidate>
                                        @csrf
                                        <div class="row">
                                            <div class="col-lg-6">

                                                <input type="text" name="kasus_id" value="{{ $kasus->id }}"
                                                    hidden>
                                                <input type="text" class="form-control"
                                                    name="no_pendamping_divkum" required
                                                    value="{{ $penuntutan ? $penuntutan->no_pendamping_divkum : '' }}"
                                                    placeholder="No Pendamping Divkum"
                                                    {{ $penuntutan->no_pendamping_divkum ? 'readonly' : '' }}>
                                            </div>
                                            <div class="col-lg-6">
                                                <input type="text" name="kasus_id" value="{{ $kasus->id }}"
                                                    hidden>
                                                <input type="date" class="form-control"
                                                    name="tanggal_pendamping_divkum" required
                                                    value="{{ $penuntutan ? ($penuntutan->tanggal_pendamping_divkum ? date('Y-m-d', strtotime($penuntutan->tanggal_pendamping_divkum)) : '') : '' }}"
                                                    placeholder="No Usulan Pembentukan Komisi Etik"
                                                    {{ $penuntutan->tanggal_pendamping_divkum ? 'readonly' : '' }}>
                                            </div>
                                        </div>
                                        <div class="row mt-2">
                                            <div class="col-lg-6">
                                                <button type="submit"
                                                    class="btn btn-primary">{{ $penuntutan->no_usulan_pembentukan_komisi ? 'Download' : 'Buat Dokumen' }}</button>
                                            </div>
                                        </div>
                                    </form>
                                    {{-- <a href="/pendamping-divkum/{{ $kasus->id }}">
                                <button type="button" class="btn btn-outline-primary text-primary">
                                    <h6 class="p-0 m-0"><i class="fas fa-print"></i> Dokumen</h6>
                                </button>
                            </a> --}}
                                </td>
                            </tr>
                            <tr>
                                <td>Panggilan Pelanggar</td>
                                <td>
                                    <form action="/penuntutan/panggilan_pelanggar" id="form_panggilan_pelanggar"
                                        method="post" novalidate>
                                        @csrf
                                        <div class="row">
                                            <div class="col-lg-6">

                                                <input type="text" name="kasus_id" value="{{ $kasus->id }}"
                                                    hidden>
                                                <input type="text" class="form-control"
                                                    name="no_panggilan_pelanggar" required
                                                    value="{{ $penuntutan ? $penuntutan->no_panggilan_pelanggar : '' }}"
                                                    placeholder="No Panggilan Pelanggar"
                                                    {{ $penuntutan->no_panggilan_pelanggar ? 'readonly' : '' }}>
                                            </div>
                                            <div class="col-lg-6">
                                                <input type="text" name="kasus_id" value="{{ $kasus->id }}"
                                                    hidden>
                                                <input type="date" class="form-control"
                                                    name="tanggal_panggilan_pelanggar" required
                                                    value="{{ $penuntutan ? ($penuntutan->tanggal_panggilan_pelanggar ? date('Y-m-d', strtotime($penuntutan->tanggal_panggilan_pelanggar)) : '') : '' }}"
                                                    placeholder="No Usulan Pembentukan Komisi Etik"
                                                    {{ $penuntutan->tanggal_panggilan_pelanggar ? 'readonly' : '' }}>
                                            </div>
                                        </div>
                                        <div class="row mt-2">
                                            <div class="col-lg-6">
                                                <button type="submit"
                                                    class="btn btn-primary">{{ $penuntutan->no_usulan_pembentukan_komisi ? 'Download' : 'Buat Dokumen' }}</button>
                                            </div>
                                        </div>
                                    </form>
                                </td>
                            </tr>
                            <tr>
                                <td>Panggilan Pelanggar ( Satker )</td>
                                <td>
                                    <form action="/penuntutan/panggilan_pelanggar_satker"
                                        id="form_panggilan_pelanggar_satker" method="post" novalidate>
                                        @csrf
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <input type="text" name="kasus_id" value="{{ $kasus->id }}"
                                                    hidden>
                                                <input type="text" class="form-control"
                                                    name="no_panggilan_pelanggar_satker" required
                                                    value="{{ $penuntutan ? $penuntutan->no_panggilan_pelanggar_satker : '' }}"
                                                    placeholder="No Panggilan Pelanggar Satker"
                                                    {{ $penuntutan->no_panggilan_pelanggar_satker ? 'readonly' : '' }}>
                                            </div>
                                            <div class="col-lg-6">
                                                <input type="text" name="kasus_id" value="{{ $kasus->id }}"
                                                    hidden>
                                                <input type="date" class="form-control"
                                                    name="tanggal_panggilan_pelanggan_satker" required
                                                    value="{{ $penuntutan ? ($penuntutan->tanggal_panggilan_pelanggan_satker ? date('Y-m-d', strtotime($penuntutan->tanggal_panggilan_pelanggan_satker)) : '') : '' }}"
                                                    placeholder="No Usulan Pembentukan Komisi Etik"
                                                    {{ $penuntutan->tanggal_panggilan_pelanggan_satker ? 'readonly' : '' }}>
                                            </div>
                                        </div>
                                        <div class="row mt-2">
                                            <div class="col-lg-6">
                                                <button type="submit"
                                                    class="btn btn-primary">{{ $penuntutan->no_panggilan_pelanggar_satker ? 'Download' : 'Buat Dokumen' }}</button>
                                            </div>
                                        </div>
                                    </form>
                                </td>
                            </tr>
                            <tr>
                                <td>Panggilan Saksi Anggota</td>
                                <td>
                                    <form action="/penuntutan/panggilan_saksi_anggota"
                                        id="form_panggilan_saksi_anggota" method="post" novalidate>
                                        @csrf
                                        <div class="row">
                                            <div class="col-lg-6">

                                                <input type="text" name="kasus_id" value="{{ $kasus->id }}"
                                                    hidden>
                                                <input type="text" class="form-control"
                                                    name="no_panggilan_saksi_anggota" required
                                                    value="{{ $penuntutan ? $penuntutan->no_panggilan_saksi_anggota : '' }}"
                                                    placeholder="No Panggilan Saksi Anggota"
                                                    {{ $penuntutan->no_panggilan_saksi_anggota ? 'readonly' : '' }}>
                                            </div>
                                            <div class="col-lg-6">
                                                <input type="text" name="kasus_id" value="{{ $kasus->id }}"
                                                    hidden>
                                                <input type="date" class="form-control"
                                                    name="tanggal_panggilan_saksi_anggota" required
                                                    value="{{ $penuntutan ? ($penuntutan->tanggal_panggilan_saksi_anggota ? date('Y-m-d', strtotime($penuntutan->tanggal_panggilan_saksi_anggota)) : '') : '' }}"
                                                    placeholder="No Usulan Pembentukan Komisi Etik"
                                                    {{ $penuntutan->tanggal_panggilan_saksi_anggota ? 'readonly' : '' }}>
                                            </div>
                                        </div>
                                        <div class="row mt-2">
                                            <div class="col-lg-6">
                                                <button type="submit"
                                                    class="btn btn-primary">{{ $penuntutan->no_panggilan_saksi_anggota ? 'Download' : 'Buat Dokumen' }}</button>
                                            </div>
                                        </div>
                                    </form>
                                </td>
                            </tr>
                            <tr>
                                <td>Panggilan Saksi Ahli SSDM</td>
                                <td>
                                    <form action="/penuntutan/panggilan_saksi_ssdm" id="form_panggilan_saksi_ssdm"
                                        method="post" novalidate>
                                        @csrf
                                        <div class="row">
                                            <div class="col-lg-6">

                                                <input type="text" name="kasus_id" value="{{ $kasus->id }}"
                                                    hidden>
                                                <input type="text" class="form-control"
                                                    name="no_panggilan_saksi_ahli_ssdm" required
                                                    value="{{ $penuntutan ? $penuntutan->no_panggilan_saksi_ahli_ssdm : '' }}"
                                                    placeholder="No Panggilan Saksi SSDM"
                                                    {{ $penuntutan->no_panggilan_saksi_ahli_ssdm ? 'readonly' : '' }}>
                                            </div>
                                            <div class="col-lg-6">
                                                <input type="text" name="kasus_id" value="{{ $kasus->id }}"
                                                    hidden>
                                                <input type="date" class="form-control"
                                                    name="tanggal_panggilan_saksi_ssdm" required
                                                    value="{{ $penuntutan ? ($penuntutan->tanggal_panggilan_saksi_ssdm ? date('Y-m-d', strtotime($penuntutan->tanggal_panggilan_saksi_ssdm)) : '') : '' }}"
                                                    placeholder="No Usulan Pembentukan Komisi Etik"
                                                    {{ $penuntutan->tanggal_panggilan_saksi_ssdm ? 'readonly' : '' }}>
                                            </div>
                                        </div>
                                        <div class="row mt-2">
                                            <div class="col-lg-6">
                                                <button type="submit"
                                                    class="btn btn-primary">{{ $penuntutan->no_panggilan_saksi_ahli_ssdm ? 'Download' : 'Buat Dokumen' }}</button>
                                            </div>
                                        </div>
                                    </form>
                                </td>
                            </tr>
                            <tr>
                                <td>Surat Daftar Nama Terlampir</td>
                                <td>
                                    <form action="/penuntutan/surat_daftar_nama_terlampir"
                                        id="form_surat_daftar_nama_terlampir" method="post" novalidate>
                                        @csrf
                                        <div class="row">
                                            <div class="col-lg-6">

                                                <input type="text" name="kasus_id" value="{{ $kasus->id }}"
                                                    hidden>
                                                <input type="text" class="form-control"
                                                    name="no_surat_daftar_terlampir" required
                                                    value="{{ $penuntutan ? $penuntutan->no_surat_daftar_terlampir : '' }}"
                                                    placeholder="No Panggilan Saksi SSDM"
                                                    {{ $penuntutan->no_surat_daftar_terlampir ? 'readonly' : '' }}>
                                            </div>
                                            <div class="col-lg-6">
                                                <input type="text" name="kasus_id" value="{{ $kasus->id }}"
                                                    hidden>
                                                <input type="date" class="form-control"
                                                    name="tanggal_surat_daftar_nama_terlampir" required
                                                    value="{{ $penuntutan ? ($penuntutan->tanggal_surat_daftar_nama_terlampir ? date('Y-m-d', strtotime($penuntutan->tanggal_surat_daftar_nama_terlampir)) : '') : '' }}"
                                                    placeholder="No Usulan Pembentukan Komisi Etik"
                                                    {{ $penuntutan->tanggal_surat_daftar_nama_terlampir ? 'readonly' : '' }}>
                                            </div>
                                        </div>
                                        <div class="row mt-2">
                                            <div class="col-lg-6">
                                                <button type="submit"
                                                    class="btn btn-primary">{{ $penuntutan->no_surat_daftar_terlampir ? 'Download' : 'Buat Dokumen' }}</button>
                                            </div>
                                        </div>
                                    </form>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            @if (isset($kasus) & ($kasus->status_id == 9))
                <div class="row mt-4">
                    <div class="col-lg-12">
                        <form action="/data-kasus/update" method="post">
                            @csrf
                            <input type="text" class="form-control" value="{{ $kasus->id }}" hidden
                                name="kasus_id">
                            <input type="text" class="form-control" value="7" hidden name="disposisi_tujuan"
                                hidden>
                            @if (
                                $penuntutan->no_usulan_pembentukan_komisi &&
                                    $penuntutan->no_usulan_pembentukan_komisi &&
                                    $penuntutan->tanggal_pendamping_divkum &&
                                    $penuntutan->no_panggilan_pelanggar &&
                                    $penuntutan->no_panggilan_pelanggar_satker &&
                                    $penuntutan->no_panggilan_saksi_anggota &&
                                    $penuntutan->no_panggilan_saksi_ahli_ssdm &&
                                    $penuntutan->no_surat_daftar_terlampir)
                                <button class="btn btn-success" name="type_submit" value="update_status">
                                    Lanjutkan ke proses Sidang KEPP
                                </button>
                            @else
                                <button class="btn btn-success" name="type_submit" value="update_status" disabled>
                                    Lanjutkan ke proses Sidang KEPP
                                </button>
                            @endif

                        </form>
                    </div>
                </div>
            @endif
        @endif
    @endif

</div>

<div class="modal fade" id="modal_pembentukan_komisi" data-bs-backdrop="static" data-bs-keyboard="false"
    tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Pembentukan Komisi Kode Etik</h5>
                <button type="button" class="btn-close btn-tutup" form="form-pembentukan-komisi"
                    data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="/pembentukan-komisi" method="post" id="form-pembentukan-komisi">
                @csrf
                <div class="modal-body">
                    <input type="hidden" name="data_pelanggar_id" value="{{ $kasus->id }}">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Nomor Pembentukan Komisi Kode
                                    Etik</label>
                                <input type="text" class="form-control" name="nomor"
                                    aria-describedby="emailHelp" placeholder="Nomor Pembentukan Komisi Kode Etik">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">Menimbang Pelanggar</label>
                                @if (isset($perbaikan))
                                    <select name="bp3kepp_id" id="bp3kepp_id" class="form-control">
                                        <option value="">Pilih Pelanggar</option>
                                        @foreach ($perbaikan_data as $perbaikan)
                                            <option value="{{ $perbaikan->id }}">{{ $perbaikan->nama }}</option>
                                        @endforeach
                                    </select>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Nomor Surat DIVKUM</label>
                                <input type="text" class="form-control" name="nomor_surat_divkum"
                                    aria-describedby="emailHelp" placeholder="Nomor Surat DIVKUM">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">Tanggal Surat DIVKUM</label>
                                <input type="date" class="form-control" name="tanggal_surat_divkum">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">Pangkat</label>
                                <input type="text" class="form-control" name="pangkat" placeholder="Pangkat">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">Nama</label>
                                <input type="text" class="form-control" name="nama" placeholder="Nama">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">Jabatan</label>
                                <input type="text" class="form-control" name="jabatan" placeholder="Jabatan">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">Kesatuan</label>
                                <input type="text" class="form-control" name="kesatuan" placeholder="Kesatuan">
                            </div>
                        </div>
                    </div>
                    <hr>
                    <h5>
                        Susunan Komisi Kode Etik
                    </h5>
                    <hr>
                    <div class="mb-3" id="form_input_susunan">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="exampleInputPassword1" class="form-label">Nama</label>
                                    <input type="text" class="form-control" name="nama_komisi[]"
                                        placeholder="Nama">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="exampleInputPassword1" class="form-label">Pangkat</label>
                                    <input type="text" class="form-control" name="pangkat_komisi[]"
                                        placeholder="Pangkat">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="exampleInputPassword1" class="form-label">NRP</label>
                                    <input type="text" class="form-control" name="nrp_komisi[]"
                                        placeholder="NRP">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="exampleInputPassword1" class="form-label">Jabatan</label>
                                    <input type="text" class="form-control" name="jabatan_komisi[]"
                                        placeholder="Jabatan">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <select name="" id="" class="form-control text-center" disabled>
                                        <option value="">Ketua</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <hr>
                    </div>
                    <div class="row mb-3" class="d-flex justify-content-end">
                        <a href="#" onclick="tambahAnggota()"> <i class="far fa-plus-square"></i>
                            Anggota </a>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary btn-generate"
                        modal="modal_pembentukan_komisi">Generate</button>
                    <button type="button" class="btn btn-secondary btn-tutup" form="form-pembentukan-komisi"
                        data-bs-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        try {
            $("input").each(function() {
                $(this).attr("autocomplete", "off");
            });
        } catch (e) {}
    });
    $('.btn-terlapor').on('click', function() {
        $('#modal_terlapor').modal('show');
    })

    function tambahAnggota() {
        let inHtml =
            `<div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Nama</label>
                        <input type="text" class="form-control" name="nama_komisi[]" placeholder="Nama">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Pangkat</label>
                        <input type="text" class="form-control" name="pangkat_komisi[]" placeholder="Pangkat">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">NRP</label>
                        <input type="text" class="form-control" name="nrp_komisi[]" placeholder="NRP">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Jabatan</label>
                        <input type="text" class="form-control" name="jabatan_komisi[]" placeholder="Jabatan">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="mb-3">
                        <select name="" id="" class="form-control text-center" disabled>
                            <option value="">Anggota</option>
                        </select>
                    </div>
                </div>
            </div>
            <hr>`;
        $('#form_input_susunan').append(inHtml);
    }

    $('.btn-generate').on('click', function() {
        var modal = $(this).attr('modal');
        var kasus_id = $('#kasus_id').val();
        var id = $('#status_id').val();
        $('#' + modal).modal('hide');
        $('.loader-view').show();
        $('#viewProses').hide();
        setTimeout(function() {
            $.ajax({
                type: 'get',
                url: `/data-kasus/view/${kasus_id}/${id}`,
                success: function(data) {
                    $('#viewProses').html(data);
                    $('.loader-view').hide();
                    $('#viewProses').show();
                }
            });
        }, 3000);
    });

    $('.btn-tutup').on('click', function() {
        var form = $(this).attr('form');
        $('#' + form).find("input[type=text], input[type=time], input[type=date], textarea").val("");
    });

    (function() {
        'use strict'

        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        var forms = $('#form_pemberkasan_update')

        // Loop over them and prevent submission
        Array.prototype.slice.call(forms)
            .forEach(function(form) {
                form.addEventListener('submit', function(event) {
                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                    } else {
                        setTimeout(async function() {
                            let process_id = $('#process_id').val()
                            await getViewProcess(process_id)

                        }, 3000);
                    }

                    form.classList.add('was-validated')
                }, false)
            })
    })();

    (function() {
        'use strict'

        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        var forms = $('#form_penuntutan_awal')

        // Loop over them and prevent submission
        Array.prototype.slice.call(forms)
            .forEach(function(form) {
                form.addEventListener('submit', function(event) {
                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                    } else {
                        setTimeout(async function() {
                            let process_id = $('#process_id').val()
                            await getViewProcess(process_id)

                        }, 3000);
                    }

                    form.classList.add('was-validated')
                }, false)
            })
    })();
    (function() {
        'use strict'

        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        var forms = $('#form_penuntutan')

        // Loop over them and prevent submission
        Array.prototype.slice.call(forms)
            .forEach(function(form) {
                form.addEventListener('submit', function(event) {
                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                    } else {
                        setTimeout(async function() {
                            let process_id = $('#process_id').val()
                            await getViewProcess(process_id)

                        }, 3000);
                    }

                    form.classList.add('was-validated')
                }, false)
            })
    })();

    (function() {
        'use strict'

        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        var forms = $('#form_usulan_komisi')

        // Loop over them and prevent submission
        Array.prototype.slice.call(forms)
            .forEach(function(form) {
                form.addEventListener('submit', function(event) {
                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                    } else {
                        setTimeout(async function() {
                            let process_id = $('#process_id').val()
                            await getViewProcess(process_id)

                        }, 3000);
                    }

                    form.classList.add('was-validated')
                }, false)
            })
    })();

    (function() {
        'use strict'

        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        var forms = $('#form_pembentukan_komisi')

        // Loop over them and prevent submission
        Array.prototype.slice.call(forms)
            .forEach(function(form) {
                form.addEventListener('submit', function(event) {
                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                    } else {
                        setTimeout(async function() {
                            let process_id = $('#process_id').val()
                            await getViewProcess(process_id)

                        }, 3000);
                    }

                    form.classList.add('was-validated')
                }, false)
            })
    })();
    (function() {
        'use strict'

        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        var forms = $('#form_pendamping_divkum')

        // Loop over them and prevent submission
        Array.prototype.slice.call(forms)
            .forEach(function(form) {
                form.addEventListener('submit', function(event) {
                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                    } else {
                        setTimeout(async function() {
                            let process_id = $('#process_id').val()
                            await getViewProcess(process_id)

                        }, 3000);
                    }

                    form.classList.add('was-validated')
                }, false)
            })
    })();

    (function() {
        'use strict'

        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        var forms = $('#form_panggilan_pelanggar')

        // Loop over them and prevent submission
        Array.prototype.slice.call(forms)
            .forEach(function(form) {
                form.addEventListener('submit', function(event) {
                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                    } else {
                        setTimeout(async function() {
                            let process_id = $('#process_id').val()
                            await getViewProcess(process_id)

                        }, 3000);
                    }

                    form.classList.add('was-validated')
                }, false)
            })
    })();

    (function() {
        'use strict'

        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        var forms = $('#form_panggilan_pelanggar_satker')

        // Loop over them and prevent submission
        Array.prototype.slice.call(forms)
            .forEach(function(form) {
                form.addEventListener('submit', function(event) {
                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                    } else {
                        setTimeout(async function() {
                            let process_id = $('#process_id').val()
                            await getViewProcess(process_id)

                        }, 3000);
                    }

                    form.classList.add('was-validated')
                }, false)
            })
    })();

    (function() {
        'use strict'

        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        var forms = $('#form_panggilan_saksi_anggota')

        // Loop over them and prevent submission
        Array.prototype.slice.call(forms)
            .forEach(function(form) {
                form.addEventListener('submit', function(event) {
                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                    } else {
                        setTimeout(async function() {
                            let process_id = $('#process_id').val()
                            await getViewProcess(process_id)

                        }, 3000);
                    }

                    form.classList.add('was-validated')
                }, false)
            })
    })();
    (function() {
        'use strict'

        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        var forms = $('#form_panggilan_saksi_ssdm')

        // Loop over them and prevent submission
        Array.prototype.slice.call(forms)
            .forEach(function(form) {
                form.addEventListener('submit', function(event) {
                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                    } else {
                        setTimeout(async function() {
                            let process_id = $('#process_id').val()
                            await getViewProcess(process_id)

                        }, 3000);
                    }

                    form.classList.add('was-validated')
                }, false)
            })
    })();

    (function() {
        'use strict'

        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        var forms = $('#form_surat_daftar_nama_terlampir')

        // Loop over them and prevent submission
        Array.prototype.slice.call(forms)
            .forEach(function(form) {
                form.addEventListener('submit', function(event) {
                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                    } else {
                        setTimeout(async function() {
                            let process_id = $('#process_id').val()
                            await getViewProcess(process_id)

                        }, 3000);
                    }

                    form.classList.add('was-validated')
                }, false)
            })
    })();
</script>
