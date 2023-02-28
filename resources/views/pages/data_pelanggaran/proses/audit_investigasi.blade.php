<div class="row">
    <div class="col-lg-12 mb-4">
        <div class="d-flex justify-content-between">
            <div>
                <button type="button" class="btn btn-info" onclick="getViewProcess(1)"><i class="far fa-arrow-left"></i>
                    Sebelumnya</button>
            </div>
            <div>

                @if ($kasus->status_id > 3)
                    <button type="button" class="btn btn-primary" onclick="getViewProcess(4)">Selanjutnya <i
                            class="far fa-arrow-right"></i></button>
                @endif

            </div>
        </div>
    </div>

    <!-- Timeline Pengaduan -->
    <div class="row">
        <div class="col-lg-12" style="text-align: center;">
            <div class="f1-steps">
                <div class="f1-progress">
                    <div class="f1-progress-line" data-now-value="32" data-number-of-steps="6" style="width: 33%;">
                    </div>
                </div>
                <div class="f1-step">
                    <div class="f1-step-icon"><i class="fa fa-user"></i></div>
                    <p>Diterima</p>
                </div>
                <div class="f1-step active">
                    <div class="f1-step-icon"><i class="fa fa-home"></i></div>
                    <p>Audit Investigasi</p>
                </div>
                <div class="f1-step">
                    <div class="f1-step-icon"><i class="fa fa-key"></i></div>
                    <p>Gelar Investigasi</p>
                </div>
                <div class="f1-step">
                    <div class="f1-step-icon"><i class="fa fa-address-book"></i></div>
                    <p>Sidik</p>
                </div>
                <div class="f1-step">
                    <div class="f1-step-icon"><i class="fa fa-address-book"></i></div>
                    <p>Pemberkasan</p>
                </div>
                <div class="f1-step">
                    <div class="f1-step-icon"><i class="fa fa-address-book"></i></div>
                    <p>Sidang KEPP</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Isi Form -->
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
                                            <td> No. SPRIN </td>
                                            <td>:</td>
                                            <td>
                                                @if (isset($sprin))
                                                    Sprin/{{ $sprin->no_sprin }}/XI/WAS.2.4./2022
                                                @else
                                                    -
                                                @endif
                                            </td>
                                        </tr>
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
                                    </table>
                                </div>
                                <div class="col-lg-6">
                                    <table>
                                        <tr>
                                            <td>Perihal</td>
                                            <td>:</td>
                                            <td>Perihal</td>
                                        </tr>
                                        <tr>
                                            <td>Unit Pelaksana</td>
                                            <td>:</td>
                                            <td>{{ $kasus->pelapor }}</td>
                                        </tr>
                                        <tr>
                                            <td>Ketua Tim</td>
                                            <td>:</td>
                                            <td>{{ $kasus->terlapor }}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="row mv-3">
                <div class="col-lg-12 mb-3">
                    <input type="text" id="test_sprin" value="{{ !empty($sprin) ? 'done' : '' }}" hidden>
                    <input type="text" id="kasus_id" value="{{ $kasus->id }}" hidden>
                    <form>
                        <div class="form-buat-surat col-lg-12 mb-3">
                            <label for="tgl_pembuatan_surat_perintah" class="form-label">Tanggal Pembuatan Surat
                                Perintah (SPRIN)</label>
                            <input type="text" class="form-control border-dark" id="tgl_pembuatan_surat_perintah"
                                aria-describedby="emailHelp"
                                value="{{ !empty($sprin) ? date('d-m-Y H:i', strtotime($sprin->created_at)) . ' WIB' : '' }}"
                                readonly>
                        </div>
                        @if (!empty($sprin))
                            <div class="row">
                                <div class="col-4">
                                    <a href="/surat-perintah/{{ $kasus->id }}">
                                        <i class="far fa-download"></i> SPRIN
                                    </a>
                                </div>
                                <div class="col-8">
                                    <a href="/surat-perintah-pengantar/{{ $kasus->id }}">
                                        <i class="far fa-download"></i> Surat Pengantar SPRIN
                                    </a>
                                </div>
                            </div>
                        @else
                            <a href="#!" data-bs-toggle="modal" data-bs-target="#modal_sprin">
                                <i class="far fa-file-plus"></i> SPRIN
                            </a>
                        @endif
                    </form>
                </div>
            </div>
            <hr>
        </div>
    </div>

    <div id="viewNext">

    </div>
</div>

<!-- Modal Buat SPRIN -->
<div class="modal fade" id="modal_sprin" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Pembuatan Surat Perintah (SPRIN)</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="/surat-perintah/{{ $kasus->id }}" method="post">
                    @csrf
                    <!-- Input no SPRIN -->
                    <div class="row mb-3">
                        <div class="col">
                            <input type="text" class="form-control" name="no_sprin" placeholder="Masukan No. SPRIN"
                                required>
                        </div>
                        <div class="col">
                            <input type="text" class="form-control" name="tanggal_investigasi"
                                placeholder="Tanggal Investigasi" required>
                        </div>
                    </div>
                    <!-- Input data penyidik -->
                    <div class="card card-data-penyidik">
                        <div class="card-header">Input Data Penyelidik</div>
                        <div class="card-body">
                            <div class="mb-3" id="form_input_anggota">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-outline mb-3">
                                            <input type="text" class="form-control" name="pangkat_ketua"
                                                id="pangkat" placeholder="Pangkat Penyelidik">
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-outline mb-3">
                                            <input type="text" class="form-control" name="nama_penyelidik_ketua"
                                                id="nama_penyidik" placeholder="Nama Penyelidik">
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-outline mb-3">
                                            <input type="text" class="form-control" name="nrp_ketua"
                                                id="nrp" placeholder="NRP">
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-outline mb-3">
                                            <input type="text" class="form-control" name="jabatan_ketua"
                                                id="jabatan" placeholder="Jabatan Penyelidik">
                                        </div>
                                    </div>

                                    <div class="col-lg-12">
                                        <div class="form-outline mb-3">
                                            <label for="tipe_tim" class="form-label">Jabatan TIM : </label>
                                            <select name="tipe_tim_ketua" id="tipe_tim" class="form-control"
                                                disabeled>
                                                <option value="1" class="text-center" selected>Ketua</option>
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
                    </div>

                    <div class="form-outline mb-3">
                        <button type="submit" class="form-control btn btn-primary">Buat SPRIN</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Buat -->
<div class="modal fade" id="modal_uuk" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Pembuatan Surat Perintah</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="form-control" action="/surat-uuk/{{ $kasus->id }}">
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Nama</label>
                        <input type="text" class="form-control" name="nama" aria-describedby="emailHelp">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Pangkat</label>
                        <input type="text" class="form-control" name="pangkat">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">NRP</label>
                        <input type="text" class="form-control" name="nrp">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Nomor Telp.</label>
                        <input type="text" class="form-control" name="jabatan">
                    </div>

                    <button type="submit" class="btn btn-primary">Buat Surat</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                {{-- <button type="button" class="btn btn-primary">Save changes</button> --}}
            </div>
        </div>
    </div>
</div>

<!-- Modal Buat SP3HP2 -->
<div class="modal fade" id="modal_sp2hp2_awal" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Pembuatan Surat Perintah</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="/surat-sp2hp2-awal/{{ $kasus->id }}">
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Nama yang Menangani</label>
                        <input type="text" class="form-control" name="penangan" aria-describedby="emailHelp"
                            placeholder="Unit II Detasemen A Ropaminal Divpropam Polri">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Nama yang dihubungi</label>
                        <input type="text" class="form-control" name="dihubungi"
                            placeholder="AKP ERICSON SIREGAR, S.Kom., M.T., M.Sc">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Jabatan yang dihubungi</label>
                        <input type="text" class="form-control" name="jabatan_dihubungi"
                            placeholder="Kanit II Den A">
                    </div>
                    <div class="mb-3">
                        <label for="telp_dihubungi" class="form-label">No. Telepon yang dihubungi</label>
                        <input type="text" class="form-control" name="telp_dihubungi">
                    </div>

                    <button type="submit" class="btn btn-primary">Buat Surat</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                {{-- <button type="button" class="btn btn-primary">Save changes</button> --}}
            </div>
        </div>
    </div>
</div>

<!-- Modal Tambah Saksi -->
<div class="modal fade" id="modal_tambah_saksi" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Saksi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="/tambah-saksi/{{ $kasus->id }}" method="post">
                    @csrf
                    <div class="mb-3" id="form_tambah_saksi">
                        <div>
                            <input type="text" class="form-control inputNamaSaksi" name="nama_saksi[]"
                                aria-describedby="emailHelp" placeholder="Enter Nama Saksi">
                        </div>
                    </div>
                    <div>
                        <a href="#" onclick="tambahSaksi()"><i class="far fa-plus"></i> Tambah Saksi</a>
                    </div>
                    <div class="form-outline mb-3">
                        <button type="submit" class="btn btn-primary form-control">Simpan</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Tambah BAI Pelapor -->
<div class="modal fade" id="bai_pelapor" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Buat BAI Pelapor</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                    onclick="getViewProcess(4)"></button>
            </div>
            <form action="/bai-sipil/{{ $kasus->id }}" target="_blank">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Tanggal Introgasi</label>
                        <input type="date" class="form-control" name="tanggal_introgasi">
                    </div>
                    <div>
                        {{-- <a href="#" onclick="tambahSaksi()"><i class="far fa-plus"></i> Tambah Saksi</a> --}}
                        <button type="submit" class="btn btn-primary form-control">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Tambah BAI Terlapor -->
<div class="modal fade" id="bai_terlapor" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Buat BAI Terlapor</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                    onclick="getViewProcess(4)"></button>
            </div>
            <form action="/bai-anggota/{{ $kasus->id }}" target="_blank">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Tanggal Introgasi</label>
                        <input type="date" class="form-control" name="tanggal_introgasi">
                    </div>
                    <div>
                        {{-- <a href="#" onclick="tambahSaksi()"><i class="far fa-plus"></i> Tambah Saksi</a> --}}
                        <button type="submit" class="btn btn-primary form-control">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        getNextData();
    });

    function tambahSaksi() {
        let inHtml =
            '<div><input type="text" class="form-control inputNamaSaksi" name="nama_saksi[]" aria-describedby="emailHelp" placeholder="Enter Nama Saksi"></div>';
        // let inHtml = '<input type="text" class="form-control" name="nama_saksi[]" aria-describedby="emailHelp" placeholder="Enter Nama ">';
        $('#form_tambah_saksi').append(inHtml);
        // $('#form_tambah_saksi .inputNamaSaksi:last').before(inHtml);
    }

    function tambahAnggota() {
        let inHtml =
            `<div class="row">
            <div class="col-lg-6">
                <div class="form-outline mb-3">
                    <input type="text" class="form-control" name="pangkat_anggota[]" id="pangkat" placeholder="Pangkat Penyelidik">
                </div>
            </div>

            <div class="col-lg-6">
                <div class="form-outline mb-3">
                    <input type="text" class="form-control" name="nama_penyelidik_anggota[]" id="nama_penyidik" placeholder="Nama Penyelidik">
                </div>
            </div>

            <div class="col-lg-6">
                <div class="form-outline mb-3">
                    <input type="text" class="form-control" name="nrp_anggota[]" id="nrp" placeholder="NRP">
                </div>
            </div>

            <div class="col-lg-6">
                <div class="form-outline mb-3">
                    <input type="text" class="form-control" name="jabatan_anggota[]" id="jabatan" placeholder="Jabatan Penyelidik">
                </div>
            </div>

            <div class="col-lg-12">
                <div class="form-outline mb-3">
                <label for="tipe_tim" class="form-label">Jabatan TIM : </label>
                <select name="tipe_tim_anggota[]" id="tipe_tim" class="form-control" disabeled>
                    <option value="2" class="text-center" selected>Anggota</option>
                </select>
                </div>
            </div>
        </div>
        <hr>`;
        $('#form_input_anggota').append(inHtml);
    }

    function getNextData() {
        console.log($('#test_sprin').val())
        if ($('#test_sprin').val() == 'done') {

            $.ajax({
                url: `/pulbaket/view/next-data/` + $('#kasus_id').val(),
                method: "get"
            }).done(function(data) {
                $('.loader-view').css("display", "none");
                $("#viewNext").html(data)
            });
        }
    }
</script>
