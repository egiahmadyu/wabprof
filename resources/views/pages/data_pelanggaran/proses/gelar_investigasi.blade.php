<input type="text" class="form-control" value="{{ $kasus->id }}" hidden id="kasus_id">
<input type="text" class="form-control" value="{{ $kasus->status_id }}" hidden id="status_id">
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

    <div class="row mb-4">
        <div class="div col-12">
            <button type="button" class="btn btn-primary col-12 btn-terlapor"><span class="far fa-plus-square"></span> Tambah Terlapor</button>
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
    @if (isset($undangan_gelar) && isset($laporan_gelar))
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
                        {{ $kasus->status_id > 4 && $kasus->status_id !== 8 ? 'selected' : '' }}>Riksa
                    </option>
                    <option value="8" class="text-center" {{ $kasus->status_id == 8 ? 'selected' : '' }}>Limpah
                        Polda
                    </option>
                    <option value="8" class="text-center" {{ $kasus->status_id == 8 ? 'selected' : '' }}>SP4
                    </option>
                </select>
            </div>
            <div class="col-lg-12 mb-3" id="limpah-polda">

            </div>
            <div class="col-lg-12">
                <button class="btn btn-update-diterima btn-primary col-12" type="submit" value="update_status"
                    name="type_submit" {{ $kasus->status_id > 4 ? 'disabled' : '' }}>
                    <i class="far fa-upload"></i> Update Status
                </button>
            </div>

        </div>
    </form>
    @else
        <button class="btn btn-update-diterima btn-primary disabled" type="button" value="update_status">
            <i class="far fa-upload"></i> Update Status
        </button>
    @endif
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

<div class="modal fade" id="modal-laporan-gelar" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Template Laporan Gelar Perkara</h5>
                <button type="button" class="btn-close btn-tutup" form="form-laporan-perkara" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="/laporan-gelar-perkara" method="post" id="form-laporan-perkara">
                <input type="hidden" class="form-control" value="{{ $kasus->id }}" aria-describedby="emailHelp"
                    name="data_pelanggar_id" >
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Tanggal</label>
                        <input type="date" class="form-control" name="tanggal_laporan_gelar" id="tanggal_laporan_gelar"
                        >
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Bukti</label>
                        <select name="bukti" id="bukti" class="form-control">
                            <option value="">Pilih Bukti</option>
                            <option value="0">Ditemukan Cukup Bukti</option>
                            <option value="1">Tidak Ditemukan Cukup Bukti</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Pilih Penyidik Pembuat</label>
                        <select name="id_penyidik_pembuat" id="id_penyidik_pembuat" class="form-control">
                            <option value="">Pilih Penyidik Pembuat</option>
                            @foreach($penyidik as $penyidik)
                                <option value="{{ $penyidik->id }}">{{ $penyidik->pangkat->name." - ".$penyidik->name }}</option>
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
                            @foreach($pangkat as $pangkat)
                                <option value="{{ $pangkat->id }}">{{ $pangkat->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Nama</label>
                        <input type="text" class="form-control" name="nama_pimpinan_gelar" id="nama_pimpinan_gelar" aria-describedby="emailHelp"
                            placeholder="Nama">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Jabatan</label>
                        <input type="text" class="form-control" name="jabatan_pimpinan_gelar" id="jabatan_pimpinan_gelar" placeholder="Jabatan">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Satuan Kerja</label>
                        <input type="text" class="form-control" name="kesatuan_pimpinan_gelar" id="kesatuan_pimpinan_gelar"
                            placeholder="Satuan Kerja">
                    </div>
                    <hr>
                    <h5>Pemapar </h5>
                    <hr>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Pilih penyidik Pemapar</label>
                        <select name="id_penyidik_pemapar" id="id_penyidik_pemapar" class="form-control">
                            <option value="">Pilih Penyidik Pemapar</option>
                            @foreach($penyidik_pemapar as $penyidik)
                                <option value="{{ $penyidik->id }}">{{ $penyidik->pangkat->name." - ".$penyidik->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-tutup" form="form-laporan-perkara" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary btn-generate" modal="modal-laporan-gelar">Generate</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-undangan-gelar" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Template Undangan Gelar Perkara Penyelidikan</h5>
                <button type="button" class="btn-close btn-tutup" form="form-gelar-perkara" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="/gelar-perkara-undangan" method="post" id="form-gelar-perkara">
                <input type="hidden" class="form-control" value="{{ $kasus->id }}" aria-describedby="emailHelp"
                    name="data_pelanggar_id" >
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
                            @foreach($penyidik_kontak as $penyidik)
                                <option value="{{ $penyidik->id }}">{{ $penyidik->pangkat->name." - ".$penyidik->name }}</option>
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
                    <button type="button" class="btn btn-secondary btn-tutup" form="form-gelar-perkara" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Generate</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('.btn-terlapor').on('click', function () {
            $('#modal_terlapor').modal('show');
        })
        $('#form-gelar-perkara').validate({
            rules: {
                nomor_undangan : {
                    required: true,
                },
                tanggal : {
                    required: true,
                },
                pukul : {
                    required: true,
                },
                tempat_undangan : {
                    required: true,
                },
                pangkat_akreditor : {
                    required: true,
                },
                nama_akreditor : {
                    required: true,
                },
                no_telp_akreditor : {
                    required: true,
                },
            },
            messages : {
                nomor_undangan: "Silahkan isi nomor undangan!",
                tanggal: "Silahkan isi tanggal undangan!",
                pukul: "Silahkan isi pukul undangan!",
                tempat_undangan: "Silahkan isi tempat undangan!",
                pangkat_akreditor: "Silahkan isi pangkat akreditor!",
                nama_akreditor: "Silahkan isi nama akreditor!",
                no_telp_akreditor: "Silahkan isi no telepon akreditor!",
            },
            errorElement : 'label',
            errorClass: 'text-danger',
            errorPlacement: function(error, element) {
                error.insertAfter(element);
            },
            success: function(label,element) {
                label.parent().removeClass('error');
                label.remove(); 
            },
            submitHandler: function (form) { // for demo
                form.submit();
                var kasus_id = $('#kasus_id').val();
                var id = $('#status_id').val();
                $('#modal-undangan-gelar').modal('hide');
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
            }
        });
        $('#form-laporan-perkara').validate({
            rules: {
                tanggal_laporan_gelar : {
                    required: true,
                },
                nrp_pembuat : {
                    required: true,
                },
                nama_pembuat : {
                    required: true,
                },
                pangkat_pembuat : {
                    required: true,
                },
                pangkat_pimpinan_gelar : {
                    required: true,
                },
                nama_pimpinan_gelar : {
                    required: true,
                },
                jabatan_pimpinan_gelar : {
                    required: true,
                },
                kesatuan_pimpinan_gelar : {
                    required: true,
                },
                pangkat_pemapar : {
                    required: true,
                },
                nama_pemapar : {
                    required: true,
                },
                jabatan_pemapar : {
                    required: true,
                },
                kesatuan_pemapar : {
                    required: true,
                },
            },
            messages : {
                tanggal_laporan_gelar: "Silahkan isi tanggal laporan gelar!",
                nrp_pembuat: "Silahkan isi nrp pembuat!",
                nama_pembuat: "Silahkan isi nama pembuat!",
                pangkat_pembuat: "Silahkan isi pangkat pembuat!",
                pangkat_pimpinan_gelar: "Silahkan isi pangkat pimpinan gelar!",
                nama_pimpinan_gelar: "Silahkan isi nama pimpinan gelar!",
                jabatan_pimpinan_gelar: "Silahkan isi jabatan pimpinan gelar!",
                kesatuan_pimpinan_gelar: "Silahkan isi kesatuan pimpinan gelar!",
                pangkat_pemapar: "Silahkan isi pangkat pemapar!",
                nama_pemapar: "Silahkan isi nama pemapar!",
                jabatan_pemapar: "Silahkan isi jabatan pemapar!",
                kesatuan_pemapar: "Silahkan isi kesatuan pemapar!",
            },
            errorElement : 'label',
            errorClass: 'text-danger',
            errorPlacement: function(error, element) {
                error.insertAfter(element);
            },
            success: function(label,element) {
                label.parent().removeClass('error');
                label.remove(); 
            },
            submitHandler: function (form) { // for demo
                form.submit();
                var kasus_id = $('#kasus_id').val();
                var id = $('#status_id').val();
                $('#modal-laporan-gelar').modal('hide');
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
            }
        });
    });
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

    $('.btn-tutup').on('click', function () {
        var form = $(this).attr('form');
        $('#'+form).find("input[type=text], input[type=time], input[type=date], textarea").val("");
    })
</script>
