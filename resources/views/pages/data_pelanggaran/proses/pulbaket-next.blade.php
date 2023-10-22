<input type="text" class="form-control" value="{{ $kasus->id }}" hidden id="kasus_id">
<div class="row mb-4">
    <div class="div col-12">
        <button type="button" class="btn btn-primary col-12 btn-terlapor"><span class="far fa-plus-square"></span> Tambah
            Terlapor</button>
    </div>
</div>
@if (isset($wawancara))
    <h6>Wawancara</h6>
    <div class="row">
        <div class="col-lg-12 mt-4">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card border-dark">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <table>
                                        <tr>
                                            <td>Tanggal Wawancara</td>
                                            <td>:</td>
                                            <td>
                                                {{ date('d-m-Y', strtotime($wawancara->tanggal)) }} -
                                                {{ $wawancara->jam }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Ruangan</td>
                                            <td>:</td>
                                            <td>{{ $wawancara->ruangan }}</td>
                                        </tr>
                                        <tr>
                                            <td>Alamat</td>
                                            <td>:</td>
                                            <td>{{ $wawancara->alamat }}</td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="col-lg-6">
                                    <table>
                                        <tr>
                                            <td>Penyidik</td>
                                            <td>:</td>
                                            <td>{{ $wawancara->penyidiks->name }}</td>
                                        </tr>
                                        <tr>
                                            <td>Nomor Telepon</td>
                                            <td>:</td>
                                            <td>{{ $wawancara->nomor_handphone ?? '-' }}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
        </div>
    </div>
@endif
@if (isset($laporan))
    <h6>Laporan Hasil Audit</h6>
    <div class="row">
        <div class="col-lg-12 mt-4">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card border-dark">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <table>
                                        <tr>
                                            <td>Nomor Laporan</td>
                                            <td>:</td>
                                            <td>
                                                {{ $laporan->nomor_laporan }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Tanggal Laporan</td>
                                            <td>:</td>
                                            <td>{{ date('d-m-Y', strtotime($laporan->tanggal_laporan)) }}</td>
                                        </tr>
                                        <tr>
                                            <td>Hasil</td>
                                            <td>:</td>
                                            <td>{{ $laporan->hasil == 'Ditemukan' ? 'Ditemukan Cukup Bukti' : $laporan->hasil }}
                                                ({{ $laporan->catatan }})</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
        </div>
    </div>
@endif
@if ($undangan_gelar)
    <h6>Undangan Gelar Perkara
    </h6>
    <div class="row">
        <div class="col-lg-12 mt-4">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card border-dark">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <table>
                                        <tr>
                                            <td>Tanggal Undangan Gelar</td>
                                            <td>:</td>
                                            <td>
                                                {{ date('d-m-Y', strtotime($undangan_gelar->tanggal_gelar)) }}
                                                {{ $undangan_gelar->jam_gelar }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Tempat Gelar</td>
                                            <td>:</td>
                                            <td>{{ $undangan_gelar->tempat_gelar }}</td>
                                        </tr>
                                        <tr>
                                            <td>Penyidik</td>
                                            <td>:</td>
                                            <td>{{ $undangan_gelar->penyidik->name }}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
        </div>
    </div>
@endif
@if (isset($laporan_gelar))
    <h6>Laporan Hasil Gelar Perkara Audit Investigasi
    </h6>
    <div class="row">
        <div class="col-lg-12 mt-4">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card border-dark">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <table>
                                        <tr>
                                            <td>Tanggal Laporan Gelar</td>
                                            <td>:</td>
                                            <td>
                                                {{ date('d-m-Y', strtotime($laporan_gelar->tanggal_laporan_gelar)) }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Pimpinan Gelar</td>
                                            <td>:</td>
                                            <td>{{ $laporan_gelar->nama_pimpinan_gelar }} -
                                                {{ $laporan_gelar->pangkat_pimpinan_gelar }} -
                                                {{ $laporan_gelar->jabatan_pimpinan_gelar }}</td>
                                        </tr>
                                        <tr>
                                            <td>Bukti</td>
                                            <td>:</td>
                                            <td>{{ $laporan_gelar->bukti }}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
        </div>
    </div>
@endif

<div class="row mt-4">
    <div class="col-lg-12">
        <table class="table table-centered align-middle table-nowrap mb-0" id="data-data">
            <thead class="text-muted table-light">
                <tr>
                    <th scope="col"> Nama Kegiatan</th>
                    <th scope="col">Action</th>
                    {{-- <th scope="col">Pelapor</th>
                    <th scope="col">Terlapor</th>
                    <th scope="col">Pangkat</th>
                    <th scope="col">Nama Korban</th>
                    <th scope="col">Status</th> --}}
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Surat Penghadapan</td>
                    <td>
                        @if (isset($surat_penghadapan))
                            <a href="/surat-penghadapan/{{ $kasus->id }}"
                                class="btn btn-outline-primary text-primar btn-wawancara">
                                <h6 class="p-0 m-0"><i class="far fa-file-plus"></i>&nbsp;Dokumen</h6>
                                </button>
                            @else
                                <button data-bs-toggle="modal" data-bs-target="#modal_surat_penghadapan" type="button"
                                    class="btn btn-outline-primary text-primar btn-dokumen-surat-penghadapan">
                                    <h6 class="p-0 m-0"><i class="far fa-file-plus"></i> Buat Dokumen</h6>
                                </button>
                        @endif
                    </td>
                </tr>
                <tr>
                    <td>Undangan Wawancara</td>
                    <td>
                        @if (isset($wawancara))
                            <a href="/surat-undangan-wawancara/{{ $kasus->id }}"
                                class="btn btn-outline-primary text-primar btn-wawancara">
                                <h6 class="p-0 m-0"><i class="far fa-file-plus"></i>&nbsp;Dokumen</h6>
                                </button>
                            @else
                                <button data-bs-toggle="modal" data-bs-target="#modal_wawancara" type="button"
                                    class="btn btn-outline-primary text-primar btn-dokumen-wawancara">
                                    <h6 class="p-0 m-0"><i class="far fa-file-plus"></i> Buat Dokumen</h6>
                                </button>
                        @endif
                    </td>
                </tr>
                <tr>
                    <td>Nota Wawancara</td>
                    <td>
                        @if (isset($wawancara))
                            <a href="/surat-nota-wawancara/{{ $kasus->id }}" disabled
                                class="btn btn-outline-primary text-primary btn-nota-wawancara">
                                <h6 class="p-0 m-0"><i class="far fa-file-plus"></i> Dokumen</h6>
                            </a>
                        @else
                            <div class="alert alert-warning" role="alert">
                                <span class="fa fa-warning"></span> Buat Undanngan Wawancara Terlebih Dahulu!
                            </div>
                        @endif
                        {{-- <button type="button" class="btn btn-outline-primary text-primary">Buat Dokumen</button> --}}
                    </td>
                </tr>
                <tr>
                    <td>Laporan Hasil Audit</td>
                    <td>
                        @if (isset($laporan))
                            <a href="/laporan-hasil-audit/{{ $kasus->id }}"
                                class="btn btn-outline-primary text-primar btn-laporan">
                                <h6 class="p-0 m-0"><i class="far fa-file-plus"></i>&nbsp;Dokumen</h6>
                                </button>
                            @else
                                <button data-bs-toggle="modal" data-bs-target="#modal_laporan" type="button"
                                    class="btn btn-outline-primary text-primar btn-dokumen-laporan">
                                    <h6 class="p-0 m-0"><i class="far fa-file-plus"></i> Buat Dokumen</h6>
                                </button>
                        @endif
                    </td>
                </tr>
                <tr>
                    <td>Undangan Gelar Perkara Audit Investigasi</td>
                    <td>
                        @if (isset($undangan_gelar))
                            <a href="/gelar-perkara-undangan/{{ $kasus->id }}">
                                <button type="button" class="btn btn-outline-primary text-primary">
                                    <h6 class="p-0 m-0"><i class="fas fa-print"></i> Dokumen</h6>
                                </button>
                            </a>
                        @else
                            <button data-bs-toggle="modal" data-bs-target="#modal-undangan-gelar" type="button"
                                class="btn btn-outline-primary text-primar btn-dokumen-undangan">
                                <h6 class="p-0 m-0"><i class="far fa-file-plus"></i> Buat Dokumen</h6>
                            </button>
                        @endif
                    </td>
                </tr>
                <tr>
                    <td>Laporan Hasil Gelar Perkara Audit Investigasi</td>
                    <td>
                        @if (isset($laporan_gelar))
                            <a href="/laporan-gelar-perkara/{{ $kasus->id }}">
                                <button type="button" class="btn btn-outline-primary text-primary">
                                    <h6 class="p-0 m-0"><i class="fas fa-print"></i> Dokumen</h6>
                                </button>
                            </a>
                        @else
                            <button data-bs-toggle="modal" data-bs-target="#modal-laporan-gelar" type="button"
                                class="btn btn-outline-primary text-primar">
                                <h6 class="p-0 m-0"><i class="far fa-file-plus"></i> Buat Dokumen</h6>
                            </button>
                        @endif
                    </td>
                </tr>
                <tr>
                    <td>Nota Dinas Laporan Gelar Perkara</td>
                    <td>
                        <a href="/nota-dinas-laporan/{{ $kasus->id }}">
                            <button type="button" class="btn btn-outline-primary text-primary">
                                <h6 class="p-0 m-0"><i class="fas fa-print"></i> Dokumen</h6>
                            </button>
                        </a>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

@if (isset($kasus) & ($kasus->status_id === 3))
    @if ($kasus->status_dihentikan == 0)
        <div class="row mt-4">
            <div class="col-lg-12">
                <form action="/data-kasus/update" method="post">
                    @csrf
                    <input type="text" class="form-control" value="{{ $kasus->id }}" hidden name="kasus_id">
                    <input type="text" class="form-control" value="5" hidden name="disposisi_tujuan" hidden>
                    <button class="btn btn-success btn-lanjut-update" name="type_submit"
                        {{ $kasus->status_id > 3 ? 'disabled' : '' }} value="update_status">
                        Lanjutkan ke proses Riksa
                    </button>
                </form>
            </div>
        </div>

    @endif
@endif

<div class="modal fade" id="modal_surat_penghadapan" tabindex="-1" data-bs-backdrop="static"
    data-bs-keyboard="false" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Template Surat Penghadapan</h5>
                <button type="button" class="btn-close btn-tutup" form="form-surat-penghadapan"
                    data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="/surat-penghadapan" method="post" id="form-surat-penghadapan">
                <input type="hidden" class="form-control" value="{{ $kasus->id }}" aria-describedby="emailHelp"
                    name="data_pelanggar_id">
                @csrf
                <div class="modal-body">
                    <div class="row mb-3">
                        <label for="exampleInputEmail1" class="form-label">No. Nota Dinas :</label>
                        <input type="text" class="form-control" aria-describedby="emailHelp"
                            value="{{ $kasus->no_nota_dinas ?? '' }}" placeholder="No. Nota Dinas" readonly="">
                    </div>
                    <div class="row mb-3">
                        <label for="exampleInputEmail1" class="form-label">Perihal :</label>
                        <input type="text" class="form-control" aria-describedby="emailHelp"
                            value="{{ $kasus->perihal_nota_dinas ?? '' }}" placeholder="Perihal" readonly="">
                    </div>
                    <div class="row mb-3">
                        <label for="exampleInputEmail1" class="form-label">Nomor Surat :</label>
                        <input type="text" class="form-control" id="nomor_surat" aria-describedby="emailHelp"
                            name="nomor_surat" placeholder="Nomor Surat">
                    </div>
                    <div class="row mb-3">
                        <label for="exampleInputEmail1" class="form-label">Tanggal Pelaksaan Audit Investigasi
                            :</label>
                        <input type="date" class="form-control" id="tanggal_pelaksanaan"
                            aria-describedby="emailHelp" name="tanggal_pelaksanaan">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-tutup" form="form-surat-penghadapan"
                        data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" modal="modal_surat_penghadapan"
                        btn-buat="btn-dokumen-surat-penghadapan" btn-dokumen="btn-surat-penghadapan">Generate</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="modal_wawancara" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Template Undangan Wawancara</h5>
                <button type="button" class="btn-close btn-tutup" form="form-wawancara" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <form action="/surat-undangan-wawancara" method="post" id="form-wawancara">
                <input type="hidden" class="form-control" value="{{ $kasus->id }}" aria-describedby="emailHelp"
                    name="data_pelanggar_id">
                @csrf
                <div class="modal-body">
                    <div class="row mb-3">
                        <label for="exampleInputEmail1" class="form-label">Nomor Surat :</label>
                        <input type="text" class="form-control" id="nomor_surat" aria-describedby="emailHelp"
                            name="nomor_surat" placeholder="Nomor Surat">
                    </div>
                    <div class="row mb-3">
                        <label for="exampleInputEmail1" class="form-label">Tanggal Wawancara :</label>
                        <input type="date" class="form-control" id="tanggal" aria-describedby="emailHelp"
                            name="tanggal">
                    </div>
                    <div class="row mb-3">
                        <label for="exampleInputEmail1" class="form-label">Jam :</label>
                        <input type="time" class="form-control" id="jam" aria-describedby="emailHelp"
                            name="jam">
                    </div>
                    <div class="row mb-3">
                        <label for="exampleInputEmail1" class="form-label">Ruangan Wawancara :</label>
                        <input type="text" class="form-control" id="ruangan" aria-describedby="emailHelp"
                            name="ruangan" placeholder="Ruangan Wawancara">
                    </div>
                    <div class="row mb-3">
                        <label for="exampleInputEmail1" class="form-label">Alamat :</label>
                        <textarea name="alamat" class="form-control" id="alamat" cols="30" rows="7"
                            placeholder="Alamat Wawancara"></textarea>
                    </div>
                    <div class="row mb-3">
                        <label for="exampleInputEmail1" class="form-label">Penyidik Yamg Bisa di Hubungi :</label>
                        <select name="id_penyidik" id="id_penyidik" class="form-control">
                            <option value="">Pilih Penyidik</option>
                            @foreach ($penyidiks as $penyidik)
                                <option value="{{ $penyidik->id }}"
                                    @if (isset($wawancara)) @if ($penyidik->id == $wawancara->id_penyidik)
                                            {{ 'selected' }} @endif
                                    @endif
                                    >{{ $penyidik->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="row mb-3">
                        <label for="exampleInputEmail1" class="form-label">No. Handphone :</label>
                        <input type="number" class="form-control" id="nomor_handphone" aria-describedby="emailHelp"
                            name="nomor_handphone" placeholder="No. Handphone">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-tutup" form="form-wawancara"
                        data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" modal="modal_wawancara"
                        btn-buat="btn-dokumen-wawancara" btn-dokumen="btn-wawancara">Generate</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="modal_laporan" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Template Laporan Hasil Audit</h5>
                <button type="button" class="btn-close btn-tutup" form="form-laporan" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <form action="/laporan-hasil-audit" method="post" id="form-laporan">
                <input type="hidden" class="form-control" value="{{ $kasus->id }}" aria-describedby="emailHelp"
                    name="data_pelanggar_id">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Nomor Laporan Hasil Audit
                                    Investigas :</label>
                                <input type="text" class="form-control" id="nomor_laporan"
                                    aria-describedby="emailHelp" name="nomor_laporan"
                                    placeholder="Nomor Laporan Hasil Audit Investigas">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Tanggal Laporan :</label>
                                <input type="date" class="form-control" id="tanggal"
                                    aria-describedby="emailHelp" name="tanggal">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Hasil Audit Investigasi
                                    :</label>
                                <select name="hasil" id="hasil_audit" class="form-control"
                                    onchange="check_hasil_audit()">
                                    <option value="">Pilih Hasil</option>
                                    <option value="Ditemukan">Ditemukan</option>
                                    <option value="Tidak Ditemukan">Tidak Ditemukan</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12 catatan_ditolak d-none">
                            <label for="kronologis" class="form-label">Catatan</label>
                            <textarea name="catatan_berhenti" cols="30" id="catatan_berhenti" rows="5"
                                class="form-control border-dark" placeholder="Catatan"></textarea>
                        </div>
                    </div>
                    <div class="card card-data-penyidik">
                        <div class="card-header">Input Data Saksi</div>
                        <div class="card-body">
                            <div class="mb-3" id="form_input_saksi">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="exampleInputEmail1" class="form-label">Type :</label>
                                            <select name="type[]" class="form-control" id="type">
                                                <option value="">Pilih Type Saksi</option>
                                                <option value="Sipil">Sipil</option>
                                                <option value="Polri">Polri</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div id="Polri" style="display: none;">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label for="exampleInputEmail1" class="form-label">NRP :</label>
                                                <input type="text" class="form-control" id="nrp"
                                                    aria-describedby="emailHelp" name="nrp[]" placeholder="NRP">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label for="exampleInputEmail1" class="form-label">Pangkat
                                                    :</label>
                                                <select name="id_pangkat[]" id="id_pangkat" class="form-control">
                                                    <option value="">Pilih Pangkat</option>
                                                    @if (isset($pangkats))
                                                        @foreach ($pangkats as $pangkat)
                                                            <option value="{{ $pangkat->id }}">
                                                                {{ $pangkat->name }}
                                                            </option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label for="exampleInputEmail1" class="form-label">Nama :</label>
                                                <input type="text" class="form-control" id="nama"
                                                    aria-describedby="emailHelp" name="nama[]" placeholder="Nama">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="exampleInputEmail1" class="form-label">Jabatan
                                                    :</label>
                                                <input type="text" class="form-control" id="jabatan"
                                                    aria-describedby="emailHelp" name="jabatan[]"
                                                    placeholder="Jabatan">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="exampleInputEmail1" class="form-label">Kesatuan
                                                    :</label>
                                                <input type="text" class="form-control" id="kesatuan"
                                                    aria-describedby="emailHelp" name="kesatuan[]"
                                                    placeholder="Kesatuan">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="Sipil" style="display: none;">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label for="exampleInputEmail1" class="form-label">Nama :</label>
                                                <input type="text" class="form-control" id="nama"
                                                    aria-describedby="emailHelp" name="nama[]" placeholder="Nama">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                            </div>
                            <div class="row mb-3" class="d-flex justify-content-end">
                                <a href="#" id="tambah" counter="0"> <i class="far fa-plus-square"></i>
                                    Saksi </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-tutup" form="form-laporan"
                        data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" modal="modal_laporan"
                        btn-dokumen="btn-laporan">Generate</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-laporan-gelar" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Template Laporan Gelar Perkara</h5>
                <button type="button" class="btn-close btn-tutup" form="form-laporan-perkara"
                    data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="/laporan-gelar-perkara" method="post" id="form-laporan-perkara">
                <input type="hidden" class="form-control" value="{{ $kasus->id }}" aria-describedby="emailHelp"
                    name="data_pelanggar_id">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Tanggal</label>
                        <input type="date" class="form-control" name="tanggal_laporan_gelar"
                            id="tanggal_laporan_gelar">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Bukti</label>
                        <select name="bukti" id="bukti_laporan_gelar_perkara" class="form-control">
                            <option value="">Pilih Bukti</option>
                            <option value="Ditemukan Cukup Bukti">Ditemukan Cukup Bukti</option>
                            <option value="Tidak Ditemukan Cukup Bukti">Tidak Ditemukan Cukup Bukti</option>
                        </select>
                    </div>
                    <div class="mb-3 div_ditemukan_bukti d-none">
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Pasal Yang Dilanggar</label>
                            <input type="text" class="form-control" name="pasal_yang_dilanggar"
                                id="pasal_yang_dilanggar">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Wujud Perbuatan</label>
                            <select name="wujud_perbuatan" id="wujud_perbuatan" class="form-control">
                                @foreach ($wujud_perbutanas as $value)
                                    <option value="{{ $value->id }}"
                                        {{ $value->id == $kasus->id_wujud_perbuatan ? 'selected' : '' }}>
                                        {{ $value->keterangan_wp }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Kategori Pelanggaran</label>
                            <select name="kategori" id="bukti_laporan_gelar_perkara" class="form-control">
                                <option value="">Pilih Kategori</option>
                                <option value="Ringan">Ringan</option>
                                <option value="Sedang">Sedang</option>
                                <option value="Berat">Berat</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Rekomendasi</label>
                            <textarea name="catatan" class="form-control" id="catatan" cols="30" rows="7"
                                placeholder="Rekomendasi"></textarea>
                        </div>
                    </div>
                    <div class="mb-3 div__tidak_ditemukan_bukti d-none">
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Rekomendasi</label>
                            <textarea name="catatan_tidak_ditemukan" class="form-control" id="catatan" cols="30" rows="7"
                                placeholder="Rekomendasi"></textarea>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Pilih Penyidik Pembuat</label>
                        <select name="id_penyidik_pembuat" id="id_penyidik_pembuat" class="form-control">
                            <option value="">Pilih Penyidik Pembuat</option>
                            @foreach ($penyidiks as $penyidik)
                                <option value="{{ $penyidik->id }}">
                                    {{ $penyidik->pangkat->name . ' - ' . $penyidik->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <hr>
                    <h5>Pimpinan Gelar </h5>
                    <hr>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Pangkat</label>
                        <select name="id_pangkat" id="id_pangkat" class="form-control">
                            <option value="">Pilih Pangkat</option>
                            @foreach ($pangkats as $value)
                                <option value="{{ $value->id }}">{{ $value->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Nama</label>
                        <input type="text" class="form-control" name="nama_pimpinan_gelar"
                            id="nama_pimpinan_gelar" aria-describedby="emailHelp" placeholder="Nama">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Jabatan</label>
                        <input type="text" class="form-control" name="jabatan_pimpinan_gelar"
                            id="jabatan_pimpinan_gelar" placeholder="Jabatan">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Satuan Kerja</label>
                        <input type="text" class="form-control" name="kesatuan_pimpinan_gelar"
                            id="kesatuan_pimpinan_gelar" placeholder="Satuan Kerja">
                    </div>
                    <hr>
                    <h5>Pemapar </h5>
                    <hr>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Pilih penyidik Pemapar</label>
                        <select name="id_penyidik_pemapar" id="id_penyidik_pemapar" class="form-control">
                            <option value="">Pilih Penyidik Pemapar</option>
                            @foreach ($penyidiks as $penyidik)
                                <option value="{{ $penyidik->id }}">
                                    {{ $penyidik->pangkat->name . ' - ' . $penyidik->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-tutup" form="form-laporan-perkara"
                        data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary btn-generate"
                        modal="modal-laporan-gelar">Generate</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-undangan-gelar" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Template Undangan Gelar Perkara Penyelidikan</h5>
                <button type="button" class="btn-close btn-tutup" form="form-gelar-perkara" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <form action="/gelar-perkara-undangan" method="post" id="form-gelar-perkara">
                <input type="hidden" class="form-control" value="{{ $kasus->id }}" aria-describedby="emailHelp"
                    name="data_pelanggar_id">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Nomor Undangan</label>
                        <input type="text" class="form-control" name="nomor_undangan" id="nomor_undangan"
                            placeholder="Nomor Undangan">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Tanggal Undangan</label>
                        <input type="date" class="form-control" name="tanggal" aria-describedby="emailHelp"
                            id="tanggal">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Pukul Undangan</label>
                        <input type="time" class="form-control" id="pukul" name="pukul">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Tempat Undangan</label>
                        <input type="text" class="form-control" name="tempat_undangan"
                            placeholder="Tempat Undangan"id="tempat_undangan">
                    </div>
                    <hr>
                    <h5>Akreditor yang bisa dihubungi </h5>
                    <hr>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Pilih Penyidik</label>
                        <select name="id_penyidik" id="id_penyidik" class="form-control">
                            <option value="">Pilih Penyidik</option>
                            @foreach ($penyidiks as $penyidik)
                                <option value="{{ $penyidik->id }}">
                                    {{ $penyidik->pangkat->name . ' - ' . $penyidik->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Nomor Telepon</label>
                        <input type="text" class="form-control" name="nomor_handphone" id="nomor_handphone"
                            placeholder="Nomor Telepon Akreditor">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-tutup" form="form-gelar-perkara"
                        data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Generate</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('.btn-terlapor').on('click', function() {
            $('#modal_terlapor').modal('show');
        })

        $('#form-wawancara').validate({
            rules: {
                tanggal: {
                    required: true,
                },
                jam: {
                    required: true,
                },
                ruangan: {
                    required: true,
                },
                alamat: {
                    required: true,
                },
                id_penyidik: {
                    required: true,
                },
                nomor_handphone: {
                    required: true,
                },
            },
            messages: {
                tanggal: "Silahkan isi tanggal!",
                jam: "Silahkan isi jam!",
                ruangan: "Silahkan isi ruangan wawancara!",
                alamat: "Silahkan isi alamat!",
                id_penyidik: "Silahkan Pilih Penyidik!",
                nomor_handphone: "Silahkan isi Nomor Handphone!",
            },
            errorElement: 'label',
            errorClass: 'text-danger',
            errorPlacement: function(error, element) {
                error.insertAfter(element);
            },
            success: function(label, element) {
                label.parent().removeClass('error');
                label.remove();
            },
            submitHandler: function(form) { // for demo
                form.submit();
                var modal = $(this).attr('modal');
                var kasus_id = $('#kasus_id').val();
                $('#modal_wawancara').modal('hide');
                $('.loader-view').show();
                $('#viewProses').hide();
                setTimeout(function() {
                    $.ajax({
                        type: 'get',
                        url: `/pulbaket/view/next-data/${kasus_id}`,
                        success: function(data) {
                            $('#viewProses').html(data);
                            $('.loader-view').hide();
                            $('#viewProses').show();
                        }
                    });
                }, 3000);
            }
        });

        $('#form-surat-penghadapan').validate({
            rules: {
                nomor_surat: {
                    required: true,
                },
                tanggal_pelaksanaan: {
                    required: true,
                },
                hasil: {
                    required: true,
                },
            },
            messages: {
                nomor_surat: "Silahkan isi nomor surat!",
                tanggal_pelaksanaan: "Silahkan isi tanggal pelaksanaan!",
                hasil: "Silahkan isi hasil!",
            },
            errorElement: 'label',
            errorClass: 'text-danger',
            errorPlacement: function(error, element) {
                error.insertAfter(element);
            },
            success: function(label, element) {
                label.parent().removeClass('error');
                label.remove();
            },
            submitHandler: function(form) { // for demo
                form.submit();
                var modal = $(this).attr('modal');
                var kasus_id = $('#kasus_id').val();
                $('#modal_surat_penghadapan').modal('hide');
                $('.loader-view').show();
                $('#viewProses').hide();
                setTimeout(function() {
                    $.ajax({
                        type: 'get',
                        url: `/pulbaket/view/next-data/${kasus_id}`,
                        success: function(data) {
                            $('#viewProses').html(data);
                            $('.loader-view').hide();
                            $('#viewProses').show();
                        }
                    });
                }, 3000);
            }
        });
        $('#form-laporan').validate({
            rules: {
                tanggal: {
                    required: true,
                },
                nomor_laporan: {
                    required: true,
                },
                'nama[]': 'required',
            },
            messages: {
                tanggal: "Silahkan isi tanggal!",
                nomor_laporan: "Silahkan isi nomor laporan hasil audit investigasi!",
                'nama[]': "Silahkan isi nama!",
            },
            errorElement: 'label',
            errorClass: 'text-danger',
            errorPlacement: function(error, element) {
                error.insertAfter(element);
            },
            success: function(label, element) {
                label.parent().removeClass('error');
                label.remove();
            },
            submitHandler: function(form) { // for demo
                form.submit();
                var modal = $(this).attr('modal');
                var kasus_id = $('#kasus_id').val();
                $('#modal_laporan').modal('hide');
                console.log('masuk');
                $('.loader-view').show();
                $('#viewProses').hide();
                setTimeout(function() {
                    $.ajax({
                        type: 'get',
                        url: `/pulbaket/view/next-data/${kasus_id}`,
                        success: function(data) {
                            $('#viewProses').html(data);
                            console.log('masuk2');
                            $('.loader-view').hide();
                            $('#viewProses').show();
                        }
                    });
                }, 3000);
            }
        });
    });

    function getPangkat(handleData) {
        $.ajax({
            type: 'get',
            url: `/get-data-pangkat/`,
            success: function(data) {
                data = JSON.parse(data);
                handleData(data);
            }
        });
    }

    $('#type').on('change', function() {
        var type = $(this).val();
        if (type == 'Sipil') {
            $('#Sipil').show();
            $('#Polri').hide();
        } else {
            $('#Polri').show();
            $('#Sipil').hide();
        }
    })


    $('#tambah').on('click', function() {
        var counter = $(this).attr('counter');
        counter = parseInt(counter) + 1;

        getPangkat(function(output) {
            var pangkat = output;
            tambahSaksi(counter, pangkat);
            $('#type_' + counter).on('change', function() {
                var type = $(this).val();
                console.log('hasil_type', type);
                if (type == 'Sipil') {
                    console.log('satu');
                    $('#Sipil_' + counter).show();
                    $('#Polri_' + counter).hide();
                } else {
                    console.log('dua');
                    $('#Polri_' + counter).show();
                    $('#Sipil_' + counter).hide();
                }
            })
            $('#type_' + counter).trigger('change');
        });


        $(this).attr('counter', counter);
    });

    $('.btn-tutup').on('click', function() {
        var form = $(this).attr('form');
        alert('ss')
        var kasus_id = $('#kasus_id').val();
        var id = $('#status_id').val();
        $('#viewProses').hide();
        $('.loader-view').show();
        $.ajax({
            type: 'get',
            url: `/data-kasus/view/${kasus_id}/${id}`,
            success: function(data) {
                $('#viewProses').html(data);
                $('.loader-view').hide();
                $('#viewProses').show();
            }
        });

    });

    $('#bukti_laporan_gelar_perkara').on('change', function() {
        var value = $('#bukti_laporan_gelar_perkara').val()
        console.log(value)
        if (value == 'Ditemukan Cukup Bukti') {
            $('.div_ditemukan_bukti').removeClass('d-none')
            $('.div__tidak_ditemukan_bukti').addClass('d-none')
        } else if (value == 'Tidak Ditemukan Cukup Bukti') {
            $('.div_ditemukan_bukti').addClass('d-none')
            $('.div__tidak_ditemukan_bukti').removeClass('d-none')
        } else {
            $('.div__tidak_ditemukan_bukti').addClass('d-none')
            $('.div_ditemukan_bukti').addClass('d-none')
        }
    })

    function tambahSaksi(counter, pangkat) {
        let inHtml =
            `<div class="row">
                <div class="col-md-12">
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Type :</label>
                        <select name="type[]" class="form-control" id="type_${counter}">
                            <option value="">Pilih Type Saksi</option>
                            <option value="Sipil">Sipil</option>
                            <option value="Polri">Polri</option>
                        </select>
                    </div>
                </div>
            </div>
             <div id="Polri_${counter}" style="display: none;">
                <div class="row">
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">NRP :</label>
                            <input type="text" class="form-control" id="nrp_${counter}" aria-describedby="emailHelp"
                                name="nrp[]" placeholder="NRP">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Pangkat :</label>
                            <select class="form-control" id="id_pangkat_${counter}" name="id_pangkat[]">
                                <option value=""> Pilih Pangkat </option>
                                `;
        for (i = 0; i < pangkat.length; i++) {
            inHtml += `<option value="${pangkat[i].id}">${pangkat[i].name}</option>`;
        }
        inHtml += `
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Nama :</label>
                            <input type="text" class="form-control" id="nama_${counter}" aria-describedby="emailHelp"
                                name="nama[]" placeholder="Nama">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Jabatan :</label>
                            <input type="text" class="form-control" id="jabatan_${counter}" aria-describedby="emailHelp"
                                name="jabatan[]" placeholder="Jabatan">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Kesatuan :</label>
                            <input type="text" class="form-control" id="kesatuan_${counter}" aria-describedby="emailHelp"
                                name="kesatuan[]" placeholder="Kesatuan">
                        </div>
                    </div>
                </div>
            </div>
            <div id="Sipil_${counter}" style="display: none;">
                <div class="row">
                    <div class="col-md-12">
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Nama :</label>
                            <input type="text" class="form-control" id="nama_${counter}" aria-describedby="emailHelp"
                                name="nama[]" placeholder="Nama">
                        </div>
                    </div>
                </div>
            </div>`;

        $('#form_input_saksi').append(inHtml);
    }
</script>
