<div class="row">
    <div class="col-lg-12 mb-4">
        <div class="d-flex justify-content-between">
            <div>
                <button type="button" class="btn btn-info" onclick="getViewProcess(4)"><i class="far fa-arrow-left"></i>
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
                    <div class="f1-progress-line" data-now-value="66" data-number-of-steps="6" style="width: 66%;">
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
                <div class="f1-step active">
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
                        <td>Undangan Pemerikasaan</td>
                        <td>
                            <a href="/gelar-perkara-undangan/{{ $kasus->id }}">
                                <button type="button" class="btn btn-outline-primary text-primary">
                                    <h6 class="p-0 m-0"><i class="fas fa-print"></i> Dokumen</h6>
                                </button>
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <td>BAP</td>
                        <td>
                        @if (isset($usulan_pembentukan))
                            <a href="/bap/{{ $kasus->id }}">
                                <button type="button" class="btn btn-outline-primary text-primary">
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
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="/bap" method="post">
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
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Generate</button>
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
</script>
