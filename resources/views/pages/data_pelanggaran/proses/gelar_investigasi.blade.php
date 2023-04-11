<div class="row">
    <div class="col-lg-12 mb-4">
        <div class="d-flex justify-content-between">
            <div>
                <button type="button" class="btn btn-info" onclick="getViewProcess(3)"><i class="far fa-arrow-left"></i>
                    Sebelumnya</button>
            </div>
            <div>

                @if ($kasus->status_id > 4)
                    <button type="button" class="btn btn-primary" onclick="getViewProcess(5)">Selanjutnya <i
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
                    <div class="f1-progress-line" data-now-value="50" data-number-of-steps="6" style="width: 50%;">
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
                <div class="f1-step active">
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
                        <td>Undangan Gelar Perkara Penyelidikan</td>
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
                                <a href="/gelar-perkara-undangan/{{ $kasus->id }}">
                                    <button type="button" class="btn btn-outline-primary text-primar btn-undangan d-none">
                                        <h6 class="p-0 m-0"><i class="fas fa-print"></i> Dokumen</h6>
                                    </button>
                                </a>     
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
                    <tr>
                        <td>Laporan Gelar Perkara</td>
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
    <form action="/data-kasus/update" method="post">
        @csrf
        <input type="text" class="form-control" value="{{ $kasus->id }}" hidden name="kasus_id">
        <div class="row">
            <div class="col-lg-12 mb-3">
                <label for="exampleInputEmail1" class="form-label">Status</label>
                <select class="form-select border-dark" aria-label="Default select example" name="disposisi_tujuan"
                    {{-- {{ 2 != $kasus->status_id ? 'disabled' : '' }}  --}} onchange="getPolda()" id="disposisi-tujuan">
                    <option value="" class="text-center">-- Pilih Status --</option>
                    <option value="5" class="text-center"
                        {{ $kasus->status_id > 4 && $kasus->status_id !== 8 ? 'selected' : '' }}>Sidik
                    </option>
                    <option value="8" class="text-center" {{ $kasus->status_id == 8 ? 'selected' : '' }}>Limpah
                        Polda
                    </option>
                </select>
            </div>
            <div class="col-lg-12 mb-3" id="limpah-polda">

            </div>
            <div class="col-lg-12">
                <button class="btn btn-update-diterima btn-primary" type="submit" value="update_status"
                    name="type_submit" {{ $kasus->status_id > 4 ? 'disabled' : '' }}>
                    <i class="far fa-upload"></i> Update Status
                </button>
            </div>

        </div>
    </form>
</div>

<div class="modal fade" id="modal_sprin" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Pembuatan Surat Perintah</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="/surat-perintah/{{ $kasus->id }}">
                    <div class="form-outline mb-3">
                        <label class="form-label" for="textAreaExample2">Isi Surat</label>
                        <textarea class="form-control" name="isi_surat_perintah" rows="8"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Buat Surat</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-laporan-gelar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Template Laporan Gelar Perkara</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="/laporan-gelar-perkara" method="post">
                <input type="text" class="form-control" value="{{ $kasus->id }}" aria-describedby="emailHelp"
                    name="data_pelanggar_id" hidden>
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Tanggal</label>
                        <input type="date" class="form-control" name="tanggal_laporan_gelar"
                        >
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">NRP</label>
                        <input type="text" class="form-control" name="nrp_pembuat" placeholder="NRP Pembuat"
                        >
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Nama</label>
                        <input type="text" class="form-control" name="nama_pembuat" placeholder="Nama Pembuat"
                        >
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Pangkat</label>
                        <input type="text" class="form-control" name="pangkat_pembuat" placeholder="Pangkat Pembuat"
                        >
                    </div>
                    <hr>
                        <h5>Pimpinan Gelar </h5>
                    <hr>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Pangkat</label>
                        <input type="text" class="form-control" name="pangkat_pimpinan_gelar"
                            placeholder="Pangkat Pimpinan">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Nama</label>
                        <input type="text" class="form-control" name="nama_pimpinan_gelar" aria-describedby="emailHelp"
                            placeholder="Nama">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Jabatan</label>
                        <input type="text" class="form-control" name="jabatan_pimpinan_gelar" placeholder="Jabatan">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Satuan Kerja</label>
                        <input type="text" class="form-control" name="kesatuan_pimpinan_gelar"
                            placeholder="Satuan Kerja">
                    </div>
                    <hr>
                    <h5>Pemapar </h5>
                    <hr>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Pangkat</label>
                        <input type="text" class="form-control" name="pangkat_pemapar"
                            placeholder="Pangkat">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Nama</label>
                        <input type="text" class="form-control" name="nama_pemapar"
                            placeholder="Nama">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Jabatan</label>
                        <input type="text" class="form-control" name="jabatan_pemapar"
                            placeholder="Jabatan">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Satuan Kerja</label>
                        <input type="text" class="form-control" name="kesatuan_pemapar"
                            placeholder="Satuan Kerja">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Generate</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-undangan-gelar" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Template Undangan Gelar Perkara Penyelidikan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="/gelar-perkara-undangan" method="post">
                <input type="text" class="form-control" value="{{ $kasus->id }}" aria-describedby="emailHelp"
                    name="data_pelanggar_id" hidden>
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Nomor Undangan</label>
                        <input type="text" class="form-control" name="nomor_undangan"
                            placeholder="Nomor Undangan">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Tanggal Undangan</label>
                        <input type="date" class="form-control" name="tanggal" aria-describedby="emailHelp"
                            >
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Pukul Undangan</label>
                        <input type="time" class="form-control" name="pukul">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Tempat Undangan</label>
                        <input type="text" class="form-control" name="tempat_undangan"
                            placeholder="Tempat Undangan">
                    </div>
                    <hr>
                    <h5>Akreditor yang bisa dihubungi </h5>
                    <hr>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Pangkat Akreditor</label>
                        <input type="text" class="form-control" name="pangkat_akreditor"
                            placeholder="Pangkat Akreditor">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Nama Aktreditor</label>
                        <input type="text" class="form-control" name="nama_akreditor"
                            placeholder="Nama Akreditor">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Nomor Telepon</label>
                        <input type="text" class="form-control" name="no_telp_akreditor"
                            placeholder="Nomor Telepon Akreditor">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary btn-generate" modal="modal-undangan-gelar" btn-buat="btn-dokumen-undangan" btn-dokumen="btn-undangan">Generate</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function getPolda() {
        let disposisi = $('#disposisi-tujuan').val()
        if (disposisi == '8') {
            $.ajax({
                url: "/api/all-polda",
                method: "get"
            }).done(function(data) {
                $("#limpah-polda").html(data)
            });
        } else $("#limpah-polda").html("")
    }
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
    $('.btn-generate').on('click', function () {
        var modal = $(this).attr('modal');
        $('#'+modal).modal('hide');

        var button_buat = $(this).attr('btn-buat')
        var button_dokumen = $(this).attr('btn-dokumen')

        $('.'+button_buat).hide();
        $('.'+button_dokumen).removeClass('d-none');
        $('#viewProses').hide(0).delay(3000).show(0);
        $('.loader-view').show(0).delay(3000).hide(0);
    });
</script>
