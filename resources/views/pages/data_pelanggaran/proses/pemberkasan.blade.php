<div class="row">
    <div class="col-lg-12 mb-4">
        <div class="d-flex justify-content-between">
            <div>
                <button type="button" class="btn btn-info" onclick="getViewProcess(5)"><i class="far fa-arrow-left"></i>
                    Sebelumnya</button>
            </div>
            <div>

                @if ($kasus->status_id > 6)
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
                    <div class="f1-progress-line" data-now-value="82" data-number-of-steps="6" style="width: 82%;">
                    </div>
                </div>
                <div class="f1-step">
                    <div class="f1-step-icon"><i class="fa fa-user"></i></div>
                    <p>Diterima</p>
                </div>
                <div class="f1-step">
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
                <div class="f1-step active">
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
                        <td>Administrasi Sidang</td>
                        <td>
                            @if (isset($administrasi_sidang))
                            <a href="/administrasi-sidang/{{ $kasus->id }}" class="btn btn-outline-primary text-primar">
                                    <h6 class="p-0 m-0"><i class="far fa-file-plus"></i> Dokumen</h6>
                                </button>
                            @else
                                <button data-bs-toggle="modal" data-bs-target="#modal_administrasi_sidang" type="button"
                                    class="btn btn-outline-primary text-primar">
                                    <h6 class="p-0 m-0"><i class="far fa-file-plus"></i> Buat Dokumen</h6>
                                </button>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td>Nota Dinas Penyerahan Berkas</td>
                        <td>
                            @if (isset($penyerahan))
                            <a href="/nota-dinas-penyerahan/{{ $kasus->id }}" class="btn btn-outline-primary text-primar">
                                    <h6 class="p-0 m-0"><i class="far fa-file-plus"></i> Dokumen</h6>
                                </button>
                            @else
                                <button data-bs-toggle="modal" data-bs-target="#modal_nota_dinas_penyerahan" type="button"
                                    class="btn btn-outline-primary text-primar">
                                    <h6 class="p-0 m-0"><i class="far fa-file-plus"></i> Buat Dokumen</h6>
                                </button>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td>Nota Dinas Perbaikan Berkas</td>
                        <td>
                            @if (isset($perbaikan))
                            <a href="/nota-dinas-perbaikan/{{ $kasus->id }}" class="btn btn-outline-primary text-primar">
                                    <h6 class="p-0 m-0"><i class="far fa-file-plus"></i> Dokumen</h6>
                                </button>
                            @else
                                <button data-bs-toggle="modal" data-bs-target="#modal_nota_dinas_perbaikan" type="button"
                                    class="btn btn-outline-primary text-primar">
                                    <h6 class="p-0 m-0"><i class="far fa-file-plus"></i> Buat Dokumen</h6>
                                </button>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td>Permohonan Pendapat Saran Hukum</td>
                        <td>
                            @if (isset($perbaikan))
                                <button data-bs-toggle="modal" data-bs-target="#modal_permohonan" type="button"
                                    class="btn btn-outline-primary text-primar">
                                    <h6 class="p-0 m-0"><i class="far fa-file-plus"></i> Buat Dokumen</h6>
                                </button>
                            @else
                                <div class="alert alert-warning" role="alert">
                                    <span class="fa fa-warning"></span>  Buat Nota Dinas Perbaikan Terlebih Dahulu!
                                </div>
                            @endif
                        </td>
                    </tr>
                    {{-- <tr>
                        <td>Berita Acara Intograsi</td>
                        <td><button type="button" class="btn btn-primary">Buat Dokumen BAI</button></td>
                    </tr>
                    <tr>
                        <td>Laporan Hasil Penyelidikan</td>
                        <td><button type="button" class="btn btn-primary">Buat Dokumen</button></td>
                    </tr>
                    <tr>
                        <td>ND Permohonan Gelar Perkara</td>
                        <td><button type="button" class="btn btn-primary">Buat Dokumen</button></td>
                    </tr> --}}
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

<div class="modal fade" id="modal_administrasi_sidang" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Administrasi Sidang</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="/administrasi-sidang" method="post">
                @csrf
                <div class="modal-body">
                    <input type="hidden" name="data_pelanggar_id" value="{{ $kasus->id }}">
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Tanggal</label>
                        <input type="date" class="form-control" name="tanggal" aria-describedby="emailHelp">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Jam</label>
                        <input type="time" class="form-control" name="jam">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Tempat</label>
                        <input type="text" class="form-control" name="tempat" placeholder="Tempat">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Pakaian</label>
                        <input type="text" class="form-control" name="pakaian" placeholder="Pakaian">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Generate</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="modal_permohonan" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Permohonan Pendapat Saran Hukum</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="/permohonan-pendapat" method="post">
                @csrf
                <div class="modal-body">
                    <input type="hidden" name="data_pelanggar_id" value="{{ $kasus->id }}">
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Nomor LP-A</label>
                        <input type="text" class="form-control" name="nomor" aria-describedby="emailHelp" placeholder="Nomor LP-A">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Tanggal LP-A</label>
                        <input type="date" class="form-control" name="tanggal">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Terduga</label>
                        @if (isset($perbaikan))
                            <select name="bp3kepp_id" id="bp3kepp_id" class="form-control">
                                <option value="">Pilih Terudga</option>
                                @foreach($perbaikan_data as $perbaikan)
                                    <option value="{{ $perbaikan->id }}">{{ $perbaikan->nama }}</option>
                                @endforeach
                            </select>
                        @endif
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Pasal Yang Disangkakan</label>
                        <input type="text" class="form-control" name="pasal" placeholder="Pasal">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Generate</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="modal_nota_dinas_penyerahan" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Nota Dinas Penyerahan Berkas Perkara Ke Binetik</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="/nota-dinas-penyerahan" method="post">
                @csrf
                <div class="modal-body">
                    <input type="hidden" name="data_pelanggar_id" value="{{ $kasus->id }}">
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Tanggal BP3KEPP</label>
                        <input type="date" class="form-control" name="tanggal" aria-describedby="emailHelp">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Nomor BP3KEPP</label>
                        <input type="text" class="form-control" name="nomor" placeholder="Nomor BP3KEPP">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Generate</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="modal_nota_dinas_perbaikan" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Nota Dinas Perbaikan Berkas</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="/nota-dinas-perbaikan" method="post">
                @csrf
                <div class="modal-body">
                    <input type="hidden" name="data_pelanggar_id" value="{{ $kasus->id }}">
                    <div class="mb-3" id="form_input_terduga">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="exampleInputEmail1" class="form-label">Tanggal BP3KEPP</label>
                                <input type="date" class="form-control" name="tanggal[]" aria-describedby="emailHelp">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="exampleInputPassword1" class="form-label">Nomor BP3KEPP</label>
                                <input type="text" class="form-control" name="nomor[]" placeholder="Nomor BP3KEPP">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="exampleInputPassword1" class="form-label">NRP Terduga</label>
                                <input type="text" class="form-control" name="nrp[]" placeholder="NRP Terduga">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="exampleInputPassword1" class="form-label">Nama Terduga</label>
                                <input type="text" class="form-control" name="nama[]" placeholder="Nama Terduga">
                            </div>   
                        </div>
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label for="exampleInputPassword1" class="form-label">Pangkat Terduga</label>
                                <input type="text" class="form-control" name="pangkat[]" placeholder="Pangkat Terduga">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="exampleInputPassword1" class="form-label">Jabatan Terduga</label>
                                <input type="text" class="form-control" name="jabatan[]" placeholder="Jabatan Terduga">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="exampleInputPassword1" class="form-label">Kesatuan Terduga</label>
                                <input type="text" class="form-control" name="kesatuan[]" placeholder="Kesatuan Terduga">
                            </div>
                        </div>
                        <hr>
                    </div>
                    <div class="row mb-3" class="d-flex justify-content-end">
                        <a href="#" onclick="tambahTerduga()"> <i class="far fa-plus-square"></i>
                            Terduga </a>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Generate</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    // $(document).ready(function() {
    //     getNextData()
    // });

    // function getNextData() {
    //     console.log($('#test_sprin').val())
    //     if ($('#test_sprin').val() == 'done') {

    //         $.ajax({
    //             url: `/pulbaket/view/next-data/` + $('#kasus_id').val(),
    //             method: "get"
    //         }).done(function(data) {
    //             $('.loader-view').css("display", "none");
    //             $("#viewNext").html(data)
    //         });
    //     }
    // }

    function tambahTerduga() {
        let inHtml =
            `<div class="row">
                <div class="col-md-6 mb-3">
                    <label for="exampleInputEmail1" class="form-label">Tanggal BP3KEPP</label>
                    <input type="date" class="form-control" name="tanggal[]" aria-describedby="emailHelp">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="exampleInputPassword1" class="form-label">Nomor BP3KEPP</label>
                    <input type="text" class="form-control" name="nomor[]" placeholder="Nomor BP3KEPP">
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="exampleInputPassword1" class="form-label">NRP Terduga</label>
                    <input type="text" class="form-control" name="nrp[]" placeholder="NRP Terduga">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="exampleInputPassword1" class="form-label">Nama Terduga</label>
                    <input type="text" class="form-control" name="nama[]" placeholder="Nama Terduga">
                </div>   
            </div>
            <div class="row">
                <div class="col-md-4 mb-3">
                    <label for="exampleInputPassword1" class="form-label">Pangkat Terduga</label>
                    <input type="text" class="form-control" name="pangkat[]" placeholder="Pangkat Terduga">
                </div>
                <div class="col-md-4 mb-3">
                    <label for="exampleInputPassword1" class="form-label">Jabatan Terduga</label>
                    <input type="text" class="form-control" name="jabatan[]" placeholder="Jabatan Terduga">
                </div>
                <div class="col-md-4 mb-3">
                    <label for="exampleInputPassword1" class="form-label">Kesatuan Terduga</label>
                    <input type="text" class="form-control" name="kesatuan[]" placeholder="Kesatuan Terduga">
                </div>
            </div>
            <hr>`;
        $('#form_input_terduga').append(inHtml);
    }
</script>
