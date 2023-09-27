<input type="text" class="form-control" value="{{ $kasus->id }}" hidden id="kasus_id">
<input type="text" class="form-control" value="{{ $kasus->status_id }}" hidden id="status_id">
<div class="row">
    <div class="col-lg-12 mb-4">
        <div class="d-flex justify-content-between">
            <div>
                <button type="button" class="btn btn-info" onclick="getViewProcess(5)"><i
                        class="far fa-arrow-left"></i>
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
                    <div class="f1-progress-line" data-now-value="40" data-number-of-steps="7" style="width: 76.6%;">
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
                        <td>Nota Dinas Penyerahan Berkas</td>
                        <td>
                            @if (isset($penyerahan))
                                <a href="/nota-dinas-penyerahan/{{ $kasus->id }}"
                                    class="btn btn-outline-primary text-primar">
                                    <h6 class="p-0 m-0"><i class="far fa-file-plus"></i> Dokumen</h6>
                                    </button>
                                @else
                                    <button data-bs-toggle="modal" data-bs-target="#modal_nota_dinas_penyerahan"
                                        type="button" class="btn btn-outline-primary text-primar">
                                        <h6 class="p-0 m-0"><i class="far fa-file-plus"></i> Buat Dokumen</h6>
                                    </button>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td>Nota Dinas Perbaikan Berkas</td>
                        <td>
                            @if (isset($perbaikan))
                                <a href="/nota-dinas-perbaikan/{{ $kasus->id }}"
                                    class="btn btn-outline-primary text-primar">
                                    <h6 class="p-0 m-0"><i class="far fa-file-plus"></i> Dokumen</h6>
                                    </button>
                                @else
                                    <button data-bs-toggle="modal" data-bs-target="#modal_nota_dinas_perbaikan"
                                        type="button" class="btn btn-outline-primary text-primar">
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
    <div class="row mt-4">
        <div class="col-lg-4">
            @if (isset($kasus) & ($kasus->status_id === 6))
                @if (isset($penyerahan) && isset($perbaikan))
                    <form action="/data-kasus/update" method="post">
                        @csrf
                        <input type="text" class="form-control" value="{{ $kasus->id }}" hidden name="kasus_id">
                        <input type="text" class="form-control" value="7" hidden name="disposisi_tujuan" hidden>
                        <button class="btn btn-success" name="type_submit" value="update_status"
                            {{ $kasus->status_id > 6 ? 'disabled' : '' }}>
                            Lanjutkan ke proses Sidang KEPP
                        </button>
                    </form>
                @else
                    <button class="btn btn-success disabled">
                        Lanjutkan ke proses Sidang KEPP
                    </button>
                @endif
            @endif
        </div>
        <div class="col-lg-4">
            <button class="btn btn-success col-12 disabled">
                SP4
            </button>
        </div>
        <div class="col-lg-4">
            <button class="btn btn-success col-12 disabled">
                Lanjut Pemberkasan
            </button>
        </div>
    </div>
</div>

<div class="modal fade" id="modal_administrasi_sidang" data-bs-backdrop="static" data-bs-keyboard="false"
    tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Administrasi Sidang</h5>
                <button type="button" class="btn-close btn-tutup" form="form-administrasi-sidang"
                    data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="/administrasi-sidang" method="post" id="form-administrasi-sidang">
                @csrf
                <div class="modal-body">
                    <input type="hidden" name="data_pelanggar_id" value="{{ $kasus->id }}">
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Tanggal</label>
                        <input type="date" class="form-control" name="tanggal" aria-describedby="emailHelp"
                            id="tanggal">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Jam</label>
                        <input type="time" class="form-control" name="jam" id="jam">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Tempat</label>
                        <input type="text" class="form-control" name="tempat" placeholder="Tempat"
                            id="tempat">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Pakaian</label>
                        <input type="text" class="form-control" name="pakaian" placeholder="Pakaian"
                            id="pakaian">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-tutup" form="form-administrasi-sidang"
                        data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary btn-generate"
                        modal="modal_administrasi_sidang">Generate</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="modal_permohonan" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Permohonan Pendapat Saran Hukum</h5>
                <button type="button" class="btn-close btn-tutup" form="form-permohonan" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <form action="/permohonan-pendapat" method="post" id="form-permohonan">
                @csrf
                <div class="modal-body">
                    <input type="hidden" name="data_pelanggar_id" value="{{ $kasus->id }}">
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Nomor LP-A</label>
                        <input type="text" class="form-control" name="nomor" id="nomor"
                            aria-describedby="emailHelp" placeholder="Nomor LP-A">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Tanggal LP-A</label>
                        <input type="date" class="form-control" name="tanggal" id="tanggal">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Terduga</label>
                        @if (isset($perbaikan))
                            <select name="bp3kepp_id" id="bp3kepp_id" class="form-control" required>
                                <option value="">Pilih Terudga</option>
                                @foreach ($perbaikan_data as $perbaikan)
                                    <option value="{{ $perbaikan->id }}">{{ $perbaikan->nama }}</option>
                                @endforeach
                            </select>
                        @endif
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Pasal Yang Disangkakan</label>
                        <input type="text" class="form-control" name="pasal" id="pasal"
                            placeholder="Pasal">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-tutup" form="form-permohonan"
                        data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary btn-generate"
                        modal="modal_permohonan">Generate</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="modal_nota_dinas_penyerahan" data-bs-backdrop="static" data-bs-keyboard="false"
    tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Nota Dinas Penyerahan Berkas Perkara Ke Binetik</h5>
                <button type="button" class="btn-close btn-tutup" form="form-penyerahan" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <form action="/nota-dinas-penyerahan" method="post" id="form-penyerahan">
                @csrf
                <div class="modal-body">
                    <input type="hidden" name="data_pelanggar_id" value="{{ $kasus->id }}">
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Tanggal BP3KEPP</label>
                        <input type="date" class="form-control" name="tanggal" aria-describedby="emailHelp"
                            id="tanggal">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Nomor BP3KEPP</label>
                        <input type="text" class="form-control" name="nomor" placeholder="Nomor BP3KEPP"
                            id="nomor">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-tutup" form="form-penyerahan"
                        data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary btn-generate"
                        modal="modal_nota_dinas_penyerahan">Generate</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="modal_nota_dinas_perbaikan" data-bs-backdrop="static" data-bs-keyboard="false"
    tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Nota Dinas Perbaikan Berkas</h5>
                <button type="button" class="btn-close btn-tutup" form="form-perbaikan" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <form action="/nota-dinas-perbaikan" method="post" id="form-perbaikan">
                @csrf
                <div class="modal-body">
                    <input type="hidden" name="data_pelanggar_id" value="{{ $kasus->id }}">
                    <div class="mb-3" id="form_input_terduga">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="exampleInputEmail1" class="form-label">Tanggal BP3KEPP</label>
                                <input type="date" class="form-control" name="tanggal[]"
                                    aria-describedby="emailHelp">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="exampleInputPassword1" class="form-label">Nomor BP3KEPP</label>
                                <input type="text" class="form-control" name="nomor[]"
                                    placeholder="Nomor BP3KEPP">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="exampleInputPassword1" class="form-label">NRP Terduga</label>
                                <input type="text" class="form-control" name="nrp[]" placeholder="NRP Terduga">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="exampleInputPassword1" class="form-label">Nama Terduga</label>
                                <input type="text" class="form-control" name="nama[]"
                                    placeholder="Nama Terduga">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label for="exampleInputPassword1" class="form-label">Pangkat Terduga</label>
                                <input type="text" class="form-control" name="pangkat[]"
                                    placeholder="Pangkat Terduga">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="exampleInputPassword1" class="form-label">Jabatan Terduga</label>
                                <input type="text" class="form-control" name="jabatan[]"
                                    placeholder="Jabatan Terduga">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="exampleInputPassword1" class="form-label">Kesatuan Terduga</label>
                                <input type="text" class="form-control" name="kesatuan[]"
                                    placeholder="Kesatuan Terduga">
                            </div>
                        </div>
                        <hr>
                    </div>
                    <div class="row mb-3" class="d-flex justify-content-end">
                        <a href="#" id="tambah" counter="0"> <i class="far fa-plus-square"></i>
                            Terduga </a>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-tutup" form="form-perbaikan"
                        data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary btn-generate"
                        modal="modal_nota_dinas_perbaikan">Generate</button>
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
        $('#form-administrasi-sidang').validate({
            rules: {
                tanggal: {
                    required: true,
                },
                jam: {
                    required: true,
                },
                tempat: {
                    required: true,
                },
                pakaian: {
                    required: true,
                },
            },
            messages: {
                tanggal: "Silahkan isi tanggal!",
                jam: "Silahkan isi jam!",
                tempat: "Silahkan isi tempat!",
                pakaian: "Silahkan isi pakaian!",
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
                $('#modal_administrasi_sidang').modal('hide');
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
        $('#form-penyerahan').validate({
            rules: {
                tanggal: {
                    required: true,
                },
                nomor: {
                    required: true,
                },
            },
            messages: {
                tanggal: "Silahkan isi tanggal!",
                nomor: "Silahkan isi nomor!",
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
                $('#modal_nota_dinas_penyerahan').modal('hide');
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
        $('#form-perbaikan').validate({
            rules: {
                "tanggal[]": 'required',
                'nomor[]': 'required',
                'nrp[]': 'required',
                'nama[]': 'required',
                'pangkat[]': 'required',
                'jabatan[]': 'required',
                'kesatuan[]': 'required',
            },
            messages: {
                'tanggal[]': "Silahkan isi tanggal!",
                'nomor[]': "Silahkan isi nomor!",
                'nrp[]': "Silahkan isi nrp!",
                'nama[]': "Silahkan isi nama!",
                'pangkat[]': "Silahkan isi pangkat!",
                'jabatan[]': "Silahkan isi jabatan!",
                'kesatuan[]': "Silahkan isi kesatuan!",
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
                $('#modal_nota_dinas_perbaikan').modal('hide');
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
        $('#form-permohonan').validate({
            rules: {
                tanggal: {
                    required: true,
                },
                nomor: {
                    required: true,
                },
                pasal: {
                    required: true,
                },
                bp3kepp_id: {
                    required: true,
                },
            },
            messages: {
                tanggal: "Silahkan isi tanggal!",
                nomor: "Silahkan isi nomor!",
                pasal: "Silahkan isi pasal!",
                bp3kepp_id: "Silahkan pilih terduga!",
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
                $('#modal_permohonan').modal('hide');
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
    $('#tambah').on('click', function() {
        var counter = $(this).attr('counter');
        var counter = parseInt(counter) + 1;
        tambahTerduga(counter);
        $(this).attr('counter', counter);
    });

    function tambahTerduga(counter) {
        let inHtml =
            `<div class="row">
                <div class="col-md-6 mb-3">
                    <label for="exampleInputEmail1" class="form-label">Tanggal BP3KEPP</label>
                    <input type="date" class="form-control" name="tanggal[]" id="tanggal_${counter}" aria-describedby="emailHelp">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="exampleInputPassword1" class="form-label">Nomor BP3KEPP</label>
                    <input type="text" class="form-control" name="nomor[]" id="nomor_${counter}" placeholder="Nomor BP3KEPP">
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="exampleInputPassword1" class="form-label">NRP Terduga</label>
                    <input type="text" class="form-control" name="nrp[]" id="nrp_${counter}" placeholder="NRP Terduga">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="exampleInputPassword1" class="form-label">Nama Terduga</label>
                    <input type="text" class="form-control" name="nama[]" id="nama_${counter}" placeholder="Nama Terduga">
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 mb-3">
                    <label for="exampleInputPassword1" class="form-label">Pangkat Terduga</label>
                    <input type="text" class="form-control" name="pangkat[]" id="pangkat_${counter}" placeholder="Pangkat Terduga">
                </div>
                <div class="col-md-4 mb-3">
                    <label for="exampleInputPassword1" class="form-label">Jabatan Terduga</label>
                    <input type="text" class="form-control" name="jabatan[]" id="jabatan_${counter}" placeholder="Jabatan Terduga">
                </div>
                <div class="col-md-4 mb-3">
                    <label for="exampleInputPassword1" class="form-label">Kesatuan Terduga</label>
                    <input type="text" class="form-control" name="kesatuan[]" id="kesatuan_${counter}" placeholder="Kesatuan Terduga">
                </div>
            </div>
            <hr>`;
        $('#form_input_terduga').append(inHtml);
    }
    $('.btn-tutup').on('click', function() {
        var form = $(this).attr('form');
        $('#' + form).find("input[type=text], input[type=time], input[type=date], textarea").val("");
    })
</script>
