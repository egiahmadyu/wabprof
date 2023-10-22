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

    <div class="row mb-4">
        <div class="div col-12">
            <button type="button" class="btn btn-primary col-12 btn-terlapor"><span class="far fa-plus-square"></span>
                Tambah Terlapor</button>
        </div>
    </div>

    <!-- Isi Form -->
    <div class="row">
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
                        <td>Usulan Pembentukan Komisi Etik</td>
                        <td>
                            <a href="/usulan-pembentukan-komisi/{{ $kasus->id }}">
                                <button type="button" class="btn btn-outline-primary text-primary">
                                    <h6 class="p-0 m-0"><i class="fas fa-print"></i> Dokumen</h6>
                                </button>
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <td>Pembentukan Komisi Kode Etik</td>
                        <td>
                            @if (isset($pembentukan_komisi))
                                <a href="/pembentukan-komisi/{{ $kasus->id }}"
                                    class="btn btn-outline-primary text-primar">
                                    <h6 class="p-0 m-0"><i class="far fa-file-plus"></i> Dokumen</h6>
                                    </button>
                                @else
                                    <button data-bs-toggle="modal" data-bs-target="#modal_pembentukan_komisi"
                                        type="button" class="btn btn-outline-primary text-primar">
                                        <h6 class="p-0 m-0"><i class="far fa-file-plus"></i> Buat Dokumen</h6>
                                    </button>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td>Pendamping Divkum</td>
                        <td>
                            <a href="/pendamping-divkum/{{ $kasus->id }}">
                                <button type="button" class="btn btn-outline-primary text-primary">
                                    <h6 class="p-0 m-0"><i class="fas fa-print"></i> Dokumen</h6>
                                </button>
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <td>Panggilan Pelanggar</td>
                        <td>
                            <a href="/panggilan-pelanggar/{{ $kasus->id }}">
                                <button type="button" class="btn btn-outline-primary text-primary">
                                    <h6 class="p-0 m-0"><i class="fas fa-print"></i> Dokumen</h6>
                                </button>
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <td>Panggilan Pelanggar ( Satker )</td>
                        <td>
                            <a href="/panggilan-pelanggar-satker/{{ $kasus->id }}">
                                <button type="button" class="btn btn-outline-primary text-primary">
                                    <h6 class="p-0 m-0"><i class="fas fa-print"></i> Dokumen</h6>
                                </button>
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <td>Panggilan Saksi Anggota</td>
                        <td>
                            <a href="/panggilan-saksi-anggota/{{ $kasus->id }}">
                                <button type="button" class="btn btn-outline-primary text-primary">
                                    <h6 class="p-0 m-0"><i class="fas fa-print"></i> Dokumen</h6>
                                </button>
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <td>Panggilan Saksi Ahli SSDM</td>
                        <td>
                            <a href="/panggilan-saksi-sdm/{{ $kasus->id }}">
                                <button type="button" class="btn btn-outline-primary text-primary">
                                    <h6 class="p-0 m-0"><i class="fas fa-print"></i> Dokumen</h6>
                                </button>
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <td>Surat Daftar Nama Terlampir</td>
                        <td>
                            <a href="/surat-daftar-nama-terlampir/{{ $kasus->id }}">
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
    @if (isset($kasus) & ($kasus->status_id === 6))
        <div class="row mt-4">
            <div class="col-lg-12">
                <form action="/data-kasus/update" method="post">
                    @csrf
                    <input type="text" class="form-control" value="{{ $kasus->id }}" hidden name="kasus_id">
                    <input type="text" class="form-control" value="7" hidden name="disposisi_tujuan" hidden>
                    <button class="btn btn-success" name="type_submit" {{ $kasus->status_id > 6 ? 'disabled' : '' }}
                        value="update_status">
                        Lanjutkan ke proses Sidang KEPP
                    </button>
                </form>
            </div>
        </div>
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
    })
</script>
