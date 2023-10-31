<input type="text" class="form-control" value="{{ $kasus->id }}" hidden id="kasus_id">
<input type="text" class="form-control" value="{{ $kasus->status_id }}" hidden id="status_id">
<div class="row">
    <div class="col-lg-12 mb-4">
        <div class="d-flex justify-content-between">
            <div>
                <button type="button" class="btn btn-info" onclick="getViewProcess(3)"><i
                        class="far fa-arrow-left"></i>
                    Sebelumnya</button>
            </div>
            <div>

                @if ($kasus->status_id > 5)
                    <button type="button" class="btn btn-primary" onclick="getViewProcess(6)">Selanjutnya <i
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
                    <div class="f1-progress-line" data-now-value="40" data-number-of-steps="7" style="width: 63.6%;">
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
                <div class="f1-step active">
                    <div class="f1-step-icon"><i class="fa fa-address-book"></i></div>
                    <p>Riksa</p>
                </div>
                <div class="f1-step">
                    <div class="f1-step-icon"><i class="fa fa-address-book"></i></div>
                    <p>Pemberkasan</p>
                </div>
                <div class="f1-step">
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
                                    <td>No LPA</td>
                                    <td>:</td>
                                    <td>{{ $lpa ? $lpa->nomor_surat : '-' }}</td>
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

    @if ($kasus->status_dihentikan == 0)
        <div class="row mb-4">
            <div class="div col-12">
                <button type="button" class="btn btn-primary col-12 btn-terlapor"><span
                        class="far fa-plus-square"></span>
                    Tambah Terlapor</button>
            </div>
        </div>
    @endif

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
                        <td>LPA</td>
                        <td>
                            @if ($lpa)
                                <a href="/lpa/{{ $kasus->id }}">
                                    <button type="button" class="btn btn-primary text-primary">
                                        <h6 class="p-0 m-0"><i class="fas fa-print"></i> Dokumen</h6>
                                    </button>
                                </a>
                            @else
                                <button type="button" class="btn btn-outline-primary text-primary"
                                    data-bs-toggle="modal" data-bs-target="#modal_lpa">
                                    <h6 class="p-0 m-0"><i class="fas fa-print"></i> Buat Dokumen</h6>
                                </button>
                            @endif
                        </td>

                    </tr>
                    <tr>
                        <td>Surat Perintah Pemeriksaan</td>
                        <td>
                            @if ($sprin_riksa)
                                <div class="row">
                                    <div class="col-lg-6">
                                        <label for="inputPassword5" class="form-label">Nomor Sprin Riksa</label>
                                        <input type="text" id="inputPassword5" class="form-control" readonly
                                            value="{{ $sprin_riksa->nomor_surat }}">
                                    </div>
                                    <div class="col-lg-6">
                                        <label for="inputPassword5" class="form-label">Tanggal</label>
                                        <input type="text" id="inputPassword5" class="form-control"
                                            value="{{ Carbon\Carbon::parse($sprin_riksa->tanggal_surat)->translatedFormat('d F Y') }}"
                                            aria-describedby="passwordHelpBlock" readonly>
                                    </div>
                                </div>
                            @else
                                <button type="button" class="btn btn-outline-primary text-primary"
                                    data-bs-toggle="modal" data-bs-target="#modal_sprin_riksa">
                                    <h6 class="p-0 m-0"><i class="fas fa-print"></i> Masukan Data Sprin</h6>
                                </button>
                            @endif

                        </td>

                    </tr>
                    <tr>
                        <td>Berita Acara Pemeriksaan</td>
                        <td>
                            @if (isset($bap))
                                <a href="/bap/{{ $kasus->id }}">
                                    <button type="button" class="btn btn-primary text-primary">
                                        <h6 class="p-0 m-0"><i class="fas fa-print"></i> Dokumen</h6>
                                    </button>
                                </a>
                            @else
                                <button data-bs-toggle="modal" data-bs-target="#modal_bap" type="button"
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
    @if (isset($kasus) & ($kasus->status_id === 5))
        <div class="row mt-4">
            <div class="col-lg-12">
                <form action="/data-kasus/update" method="post">
                    @csrf
                    <input type="text" class="form-control" value="{{ $kasus->id }}" hidden name="kasus_id">
                    <input type="text" class="form-control" value="6" hidden name="disposisi_tujuan" hidden>
                    <button class="btn btn-success" name="type_submit" {{ $kasus->status_id > 5 ? 'disabled' : '' }}
                        value="update_status">
                        Lanjutkan ke proses Pemberkasan
                    </button>
                </form>
            </div>
        </div>
    @endif
</div>

<div class="modal fade" id="modal_bap" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">BAP</h5>
                <button type="button" class="btn-close btn-tutup" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <form action="/bap" method="post" id="form-bap">
                @csrf
                <div class="modal-body">
                    <input type="hidden" name="data_pelanggar_id" value="{{ $kasus->id }}">
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Tanggal Pemeiksaan</label>
                        <input type="date" class="form-control" name="tanggal_pemeriksaan"
                            id="tanggal_pemeriksaan" aria-describedby="emailHelp">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Jam Pemeriksaan</label>
                        <input type="time" class="form-control" name="jam_pemeriksaan" id="jam_pemeriksaan"
                            placeholder="Jam Pemeriksaan">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-tutup" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Generate</button>
                </div>
            </form>
        </div>
    </div>
</div>


<div class="modal fade" id="modal_lpa" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">LPA</h5>
                <button type="button" class="btn-close btn-tutup" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <form action="/lpa" method="post" id="form_lpa" novalidate>
                @csrf
                <div class="modal-body">
                    <input type="hidden" name="data_pelanggar_id" value="{{ $kasus->id }}">
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Nomor LPA</label>
                        <input type="text" class="form-control" name="nomor_surat_lpa" id="nomor_surat_lpa"
                            aria-describedby="emailHelp" required>
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlTextarea1" class="form-label">Pasal Yang Dilanggar</label>
                        <textarea class="form-control" id="pasal_yang_dilanggar" rows="3" name="pasal_yang_dilanggar" required>{{ $laporan_gelar ? $laporan_gelar->pasal_yang_dilanggar : '' }}</textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-tutup" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Generate</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="modal_sprin_riksa" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Sprin Riksa</h5>
                <button type="button" class="btn-close btn-tutup" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <form action="/sprin_riksa" method="post" id="form-bap">
                @csrf
                <div class="modal-body">
                    <input type="hidden" name="data_pelanggar_id" value="{{ $kasus->id }}">
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Nomor Sprin Riksa</label>
                        <input type="text" class="form-control" name="nomor_sprin_riksa" id="nomor_sprin_riksa"
                            aria-describedby="emailHelp">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Tanggal Sprin Riksa</label>
                        <input type="date" class="form-control" name="tanggal" id="tanggal_sprin_riksa"
                            aria-describedby="emailHelp">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-tutup" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
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
    $(document).ready(function() {
        $('.btn-terlapor').on('click', function() {
            $('#modal_terlapor').modal('show');
        })
        $('#form-bap').validate({
            rules: {
                tanggal_pemeriksaan: {
                    required: true,
                },
                jam_pemeriksaan: {
                    required: true,
                },
            },
            messages: {
                tanggal_pemeriksaan: "Silahkan isi Tanggal Pemeriksan!",
                jam_pemeriksaan: "Silahkan isi Jam Pemeriksaan!",
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
                var id = $('#status_id').val();
                $('#modal_bap').modal('hide');
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

    $('.btn-tutup').on('click', function() {
        var form = $(this).attr('form');
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

    (function() {
        'use strict'

        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        var forms = $('#form_lpa')

        // Loop over them and prevent submission
        Array.prototype.slice.call(forms)
            .forEach(function(form) {
                form.addEventListener('submit', function(event) {
                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                    }

                    form.classList.add('was-validated')
                }, false)
            })
    })();
</script>
