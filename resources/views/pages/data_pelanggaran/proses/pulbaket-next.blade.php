<input type="text" class="form-control" value="{{ $kasus->id }}" hidden id="kasus_id">
<input type="text" class="form-control" value="{{ $kasus->status_id }}" hidden id="status_id">
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
                        <a href="/surat-penghadapan/{{ $kasus->id }}" class="btn btn-outline-primary text-primar">
                            <h6 class="p-0 m-0"><i class="far fa-file-plus"></i> Dokumen</h6>
                        </a>
                        {{-- <button type="button" class="btn btn-primary">Buat Undangan <i class="far fa-file-plus"></i></button>
                        <button type="button" class="btn btn-warning">Tambah Saksi <i class="far fa-user-plus"></i></button> --}}
                        {{-- <div class="row">
                            <div class="col-md-6 col-lg-6">
                                <a href="#" class="btn btn-outline-primary text-primary">
                                    <h6 class="p-0 m-0"><i class="far fa-file-plus"></i> Undangan</h6>
                                </a>
                            </div>
                            <div class="col-md-6 col-lg-6">
                                <a href="#!" class="btn btn-outline-warning text-warning px-2"
                                    data-bs-toggle="modal" data-bs-target="#modal_tambah_saksi">
                                    <h6 class="p-0 m-0"><i class="far fa-user-plus"></i> Saksi</h6>
                                </a>
                            </div>
                        </div> --}}


                    </td>
                </tr>
                <tr>
                    <td>Undangan Wawancara</td>
                    <td>
                        @if (isset($wawancara))
                        <a href="/surat-undangan-wawancara/{{ $kasus->id }}" class="btn btn-outline-primary text-primar btn-wawancara">
                                <h6 class="p-0 m-0"><i class="far fa-file-plus"></i>Dokumen</h6>
                            </button>
                        @else
                            <button data-bs-toggle="modal" data-bs-target="#modal_wawancara" type="button"
                                class="btn btn-outline-primary text-primar btn-dokumen-wawancara">
                                <h6 class="p-0 m-0"><i class="far fa-file-plus"></i> Buat Dokumen</h6>
                            </button>
                            <a href="/surat-undangan-wawancara/{{ $kasus->id }}" class="btn btn-outline-primary text-primar btn-wawancara d-none">
                                <h6 class="p-0 m-0"><i class="far fa-file-plus"></i>Dokumen</h6>
                            </button>
                        @endif

                    </td>
                </tr>
                <tr>
                    <td>Nota Wawancara</td>
                    <td>
                        <a href="/surat-nota-wawancara/{{ $kasus->id }}" disabled
                            class="btn btn-outline-primary text-primary">
                            <h6 class="p-0 m-0"><i class="far fa-file-plus"></i> Dokumen</h6>
                        </a>
                        {{-- <button type="button" class="btn btn-outline-primary text-primary">Buat Dokumen</button> --}}
                    </td>
                </tr>
                <tr>
                    <td>Laporan Hasil Audit</td>
                    <td>
                        @if (isset($laporan))
                            <a href="/laporan-hasil-audit/{{ $kasus->id }}" class="btn btn-outline-primary text-primar btn-laporan">
                                <h6 class="p-0 m-0"><i class="far fa-file-plus"></i>Dokumen</h6>
                            </button>
                        @else
                            <button data-bs-toggle="modal" data-bs-target="#modal_laporan" type="button"
                                class="btn btn-outline-primary text-primar btn-dokumen-laporan">
                                <h6 class="p-0 m-0"><i class="far fa-file-plus"></i> Buat Dokumen</h6>
                            </button>
                            <a href="/laporan-hasil-audit/{{ $kasus->id }}" class="btn btn-outline-primary text-primar btn-laporan d-none">
                                <h6 class="p-0 m-0"><i class="far fa-file-plus"></i>Dokumen</h6>
                            </button>
                        @endif
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

@if (isset($kasus) & ($kasus->status_id === 3))
    <div class="row mt-4">
        <div class="col-lg-12">
            <form action="/data-kasus/update" method="post">
                @csrf
                <input type="text" class="form-control" value="{{ $kasus->id }}" hidden name="kasus_id">
                <input type="text" class="form-control" value="4" hidden name="disposisi_tujuan" hidden>
                <button class="btn btn-success" name="type_submit" {{ $kasus->status_id > 3 ? 'disabled' : '' }}
                    value="update_status">
                    Lanjutkan ke proses Gelar Investigasi
                </button>
            </form>
        </div>
    </div>
@endif

<div class="modal fade" id="modal_wawancara" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Template Undangan Wawancara</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="/surat-undangan-wawancara" method="post">
                <input type="text" class="form-control" value="{{ $kasus->id }}" aria-describedby="emailHelp"
                    name="data_pelanggar_id" hidden>
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Tanggal Wawancara :</label>
                        <input type="date" class="form-control" id="tanggal" aria-describedby="emailHelp"
                            name="tanggal">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Jam :</label>
                        <input type="time" class="form-control" id="jam" aria-describedby="emailHelp"
                        name="jam">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Ruangan Wawancara :</label>
                        <input type="text" class="form-control" id="ruangan" aria-describedby="emailHelp"
                            name="ruangan" placeholder="Ruangan Wawancara">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Alamat :</label>
                        <textarea name="alamat" class="form-control" id="alamat" cols="30" rows="7" placeholder="Alamat Wawancara" ></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary btn-generate" modal="modal_wawancara" btn-buat="btn-dokumen-wawancara" btn-dokumen="btn-wawancara">Generate</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="modal_laporan" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Template Laporan Hasil Audit</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="/laporan-hasil-audit" method="post">
                <input type="text" class="form-control" value="{{ $kasus->id }}" aria-describedby="emailHelp"
                    name="data_pelanggar_id" hidden>
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Nomor Laporan :</label>
                                <input type="text" class="form-control" id="nomor_laporan" aria-describedby="emailHelp"
                                    name="nomor_laporan" placeholder="Nomor Laporan">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Tanggal Laporan :</label>
                                <input type="date" class="form-control" id="tanggal" aria-describedby="emailHelp"
                                    name="tanggal">
                            </div>
                        </div>
                    </div>
                    <div class="card card-data-penyidik">
                        <div class="card-header">Input Data Saksi</div>
                        <div class="card-body">
                            <div class="mb-3" id="form_input_saksi">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="exampleInputEmail1" class="form-label">NRP :</label>
                                            <input type="text" class="form-control" id="nrp" aria-describedby="emailHelp"
                                                name="nrp[]" placeholder="NRP">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="exampleInputEmail1" class="form-label">Pangkat :</label>
                                            <input type="text" class="form-control" id="pangkat" aria-describedby="emailHelp"
                                                name="pangkat[]" placeholder="Pangkat">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="exampleInputEmail1" class="form-label">Nama :</label>
                                            <input type="text" class="form-control" id="nama" aria-describedby="emailHelp"
                                                name="nama[]" placeholder="Nama">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="exampleInputEmail1" class="form-label">Jabatan :</label>
                                            <input type="text" class="form-control" id="jabatan" aria-describedby="emailHelp"
                                                name="jabatan[]" placeholder="Jabatan">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="exampleInputEmail1" class="form-label">Kesatuan :</label>
                                            <input type="text" class="form-control" id="kesatuan" aria-describedby="emailHelp"
                                                name="kesatuan[]" placeholder="Kesatuan">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                            </div>
                            <div class="row mb-3" class="d-flex justify-content-end">
                                <a href="#" onclick="tambahSaksi()"> <i class="far fa-plus-square"></i>
                                    Saksi </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary btn-generate" modal="modal_laporan" btn-buat="btn-dokumen-laporan" btn-dokumen="btn-laporan">Generate</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    function tambahSaksi() {
        let inHtml =
            `<div class="row">
                <div class="col-md-4">
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">NRP :</label>
                        <input type="text" class="form-control" id="nrp" aria-describedby="emailHelp"
                            name="nrp[]" placeholder="NRP">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Pangkat :</label>
                        <input type="text" class="form-control" id="pangkat" aria-describedby="emailHelp"
                            name="pangkat[]" placeholder="Pangkat">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Nama :</label>
                        <input type="text" class="form-control" id="nama" aria-describedby="emailHelp"
                            name="nama[]" placeholder="Nama">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Jabatan :</label>
                        <input type="text" class="form-control" id="jabatan" aria-describedby="emailHelp"
                            name="jabatan[]" placeholder="Jabatan">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Kesatuan :</label>
                        <input type="text" class="form-control" id="kesatuan" aria-describedby="emailHelp"
                            name="kesatuan[]" placeholder="Kesatuan">
                    </div>
                </div>
            </div>
            <hr>`;
        $('#form_input_saksi').append(inHtml);

    }
    $('.btn-generate').on('click', function () {
        var modal = $(this).attr('modal');
        var kasus_id = $('#kasus_id').val();
        var id = $('#status_id').val();
        $('#'+modal).modal('hide');
        $.ajax({
            type: 'get',
            url: `/data-kasus/view/${kasus_id}/${id}`,
            beforeSend: function() {
                $('.loader-view').show();
                $('#viewProses').hide();
            },
            success: function(data) {
                $('#viewProses').append(data);
                $('.loader-view').hide();
            }
        });
        // var button_buat = $(this).attr('btn-buat')
        // var button_dokumen = $(this).attr('btn-dokumen')

        // $('.'+button_buat).hide();
        // $('.'+button_dokumen).removeClass('d-none');
    });
</script>