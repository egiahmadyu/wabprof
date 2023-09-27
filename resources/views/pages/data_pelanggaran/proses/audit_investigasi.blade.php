<input type="text" class="form-control" value="{{ $kasus->status_id }}" hidden id="status_id">
<div class="row">
    <div class="col-lg-12 mb-4">
        <div class="d-flex justify-content-between">
            <div>
                <button type="button" class="btn btn-info" onclick="getViewProcess(2)"><i class="far fa-arrow-left"></i>
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
                    <div class="f1-progress-line" data-now-value="40" data-number-of-steps="7" style="width: 33.6%;">
                    </div>
                </div>
                <div class="f1-step">
                    <div class="f1-step-icon"><i class="fa fa-user"></i></div>
                    <p>Diterima</p>
                </div>
                <div class="f1-step">
                    <div class="f1-step-icon"><i class="fa fa-home"></i></div>
                    <p>Time Line Klasifikasi</p>
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
                                            <td>{{ $kasus->perihal_nota_dinas }}</td>
                                        </tr>
                                        <tr>
                                            <td>Unit Pelaksana</td>
                                            <td>:</td>
                                            <td>{{ $penyidik->tim ?? '-' }}</td>
                                        </tr>
                                        <tr>
                                            <td>Ketua Tim</td>
                                            <td>:</td>
                                            <td>{{ $penyidik->name ?? '-' }}</td>
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
<div class="modal fade" id="modal_sprin" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Pembuatan Surat Perintah (SPRIN)</h5>
                <button type="button" class="btn-close btn-tutup" form="form-sprin" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="/surat-perintah/{{ $kasus->id }}" method="post" id="form-sprin">
                    @csrf
                    <div class="row mb-3">
                        <div class="col">
                            <input type="text" class="form-control" name="no_sprin"
                                placeholder="Masukan No. SPRIN" id="no_sprin">
                        </div>
                        <div class="col">
                            <input type="date" class="form-control" name="tanggal_investigasi"
                                placeholder="Tanggal Investigasi" id="tanggal_investigasi" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <input type="text" class="form-control" name="tempat_investigasi"
                                placeholder="Tempat Investigasi" required id="tempat_investigasi">
                        </div>
                        <div class="col">
                            <select name="tim" id="tim" class="form-control" readonly="">
                                <option value="">Pilih Tim</option>
                                @for ($i = 0; $i < count($tims); $i++)
                                    <option value="{{ $tims[$i] }}"
                                        @if (isset($disposisi)) @if ($disposisi->tim == $tims[$i])
                                            {{ 'selected' }} @endif
                                        @endif
                                        >{{ $tims[$i] }}</option>
                                @endfor
                            </select>
                        </div>
                    </div>
                    <div class="card card-data-penyidik" id="data-penyidik" style="display:none;">

                    </div>

                    <div class="form-outline mb-3">
                        <button type="submit" class="form-control btn btn-primary btn-generate"
                            modal="modal_sprin">Buat SPRIN</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        getNextData();
        $('#form-sprin').validate({
            rules: {
                tanggal_investigasi: {
                    required: true,
                },
                tempat_investigasi: {
                    required: true,
                },
                tim: {
                    required: true,
                },
            },
            messages: {
                tanggal_investigasi: "Silahkan isi tanggal investigasi!",
                tempat_investigasi: "Silahkan isi tempat investigasi!",
                tim: "Silahkan isi tim!",
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
                var kasus_id = $('#kasus_id').val();
                var id = $('#status_id').val();
                $('#modal_sprin').modal('hide');
                $('.loader-view').show();
                $('#viewProses').hide();
                $('#viewNext').hide();
                setTimeout(function() {
                    $.ajax({
                        type: 'get',
                        url: `/data-kasus/view/${kasus_id}/${id}`,
                        success: function(data) {
                            $('#viewProses').html(data);
                            $.ajax({
                                type: 'get',
                                url: `/pulbaket/view/next-data/${kasus_id}`,
                                success: function(data) {
                                    $('#viewNext').html(data);
                                    $('.loader-view').hide();
                                    $('#viewProses').show();
                                    $('#viewNext').show();
                                }
                            });
                        }
                    });

                }, 3000);
            }
        });

        var tim = $('#tim').val();
        console.log('isi', tim)
        if (tim != "" && tim != null) {
            $('#tim').trigger('change');
        }
    });

    function tambahSaksi() {
        let inHtml =
            '<div><input type="text" class="form-control inputNamaSaksi" name="nama_saksi[]" aria-describedby="emailHelp" placeholder="Enter Nama Saksi"></div>';
        // let inHtml = '<input type="text" class="form-control" name="nama_saksi[]" aria-describedby="emailHelp" placeholder="Enter Nama ">';
        $('#form_tambah_saksi').append(inHtml);
        // $('#form_tambah_saksi .inputNamaSaksi:last').before(inHtml);
    }

    $('#tambah').on('click', function() {
        var counter = $(this).attr('counter');
        console.log('ori', counter)
        var counter = parseInt(counter) + 1;
        console.log('add', counter)
        //    tambahAnggota(counter);
        $(this).attr('counter', counter);
    });

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

    $('#tim').on('change', function() {
        var tim = $(this).val();
        $.ajax({
            type: 'get',
            url: `/data-penyidik/${tim}/`,
            success: function(data) {
                $('#data-penyidik').html(data);
                $('#data-penyidik').show();
            }
        });
    })

    $('.btn-tutup').on('click', function() {
        $('#no_sprin').val('');
        $('#tempat_investigasi').val('');
        $('#tanggal_investigasi').val('');
        $('#tim').val('');
    })
</script>
