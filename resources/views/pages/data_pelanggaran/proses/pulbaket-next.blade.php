<input type="text" class="form-control" value="{{ $kasus->id }}" hidden id="kasus_id">
<div class="row mb-4">
    <div class="div col-12">
        <button type="button" class="btn btn-primary col-12 btn-terlapor"><span class="far fa-plus-square"></span> Tambah Terlapor</button>
    </div>
</div>
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
                        @if (isset($surat_penghadapan))
                        <a href="/surat-penghadapan/{{ $kasus->id }}" class="btn btn-outline-primary text-primar btn-wawancara">
                                <h6 class="p-0 m-0"><i class="far fa-file-plus"></i>&nbsp;Dokumen</h6>
                            </button>
                        @else
                            <button data-bs-toggle="modal" data-bs-target="#modal_surat_penghadapan"  type="button"
                                class="btn btn-outline-primary text-primar btn-dokumen-surat-penghadapan">
                                <h6 class="p-0 m-0"><i class="far fa-file-plus"></i> Buat Dokumen</h6>
                            </button>
                        @endif
                    </td>
                </tr>
                <tr>
                    <td>Undangan Wawancara</td>
                    <td>
                        @if (isset($wawancara))
                        <a href="/surat-undangan-wawancara/{{ $kasus->id }}" class="btn btn-outline-primary text-primar btn-wawancara">
                                <h6 class="p-0 m-0"><i class="far fa-file-plus"></i>&nbsp;Dokumen</h6>
                            </button>
                        @else
                            <button data-bs-toggle="modal" data-bs-target="#modal_wawancara"  type="button"
                                class="btn btn-outline-primary text-primar btn-dokumen-wawancara">
                                <h6 class="p-0 m-0"><i class="far fa-file-plus"></i> Buat Dokumen</h6>
                            </button>
                        @endif
                    </td>
                </tr>
                <tr>
                    <td>Nota Wawancara</td>
                    <td>
                        @if (isset($wawancara))
                            <a href="/surat-nota-wawancara/{{ $kasus->id }}" disabled
                                class="btn btn-outline-primary text-primary btn-nota-wawancara">
                                <h6 class="p-0 m-0"><i class="far fa-file-plus"></i> Dokumen</h6>
                            </a>
                        @else
                            <div class="alert alert-warning" role="alert">
                                <span class="fa fa-warning"></span>  Buat Undanngan Wawancara Terlebih Dahulu!
                            </div>
                        @endif
                        {{-- <button type="button" class="btn btn-outline-primary text-primary">Buat Dokumen</button> --}}
                    </td>
                </tr>
                <tr>
                    <td>Laporan Hasil Audit</td>
                    <td>
                        @if (isset($laporan))
                            <a href="/laporan-hasil-audit/{{ $kasus->id }}" class="btn btn-outline-primary text-primar btn-laporan">
                                <h6 class="p-0 m-0"><i class="far fa-file-plus"></i>&nbsp;Dokumen</h6>
                            </button>
                        @else
                            <button data-bs-toggle="modal" data-bs-target="#modal_laporan" type="button"
                                class="btn btn-outline-primary text-primar btn-dokumen-laporan">
                                <h6 class="p-0 m-0"><i class="far fa-file-plus"></i> Buat Dokumen</h6>
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
                    <button class="btn btn-success btn-lanjut-update" name="type_submit" {{ $kasus->status_id > 3 ? 'disabled' : '' }}
                        value="update_status">
                        Lanjutkan ke proses Gelar Investigasi
                    </button>
                </form>
        </div>
    </div>
@endif

<div class="modal fade" id="modal_surat_penghadapan" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="exampleModalLabel" aria-hidden="true" >
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Template Surat Penghadapan</h5>
                <button type="button" class="btn-close btn-tutup" form="form-surat-penghadapan" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="/surat-penghadapan" method="post" id="form-surat-penghadapan">
                <input type="hidden" class="form-control" value="{{ $kasus->id }}" aria-describedby="emailHelp"
                    name="data_pelanggar_id">
                @csrf
                <div class="modal-body">
                    <div class="row mb-3">
                        <label for="exampleInputEmail1" class="form-label">No. Nota Dinas :</label>
                        <input type="text" class="form-control" aria-describedby="emailHelp" value="{{ $kasus->no_nota_dinas ?? '' }}" placeholder="No. Nota Dinas" readonly="">
                    </div>
                    <div class="row mb-3">
                        <label for="exampleInputEmail1" class="form-label">Perihal :</label>
                        <input type="text" class="form-control" aria-describedby="emailHelp" value="{{ $kasus->perihal_nota_dinas ?? '' }}" placeholder="Perihal" readonly="">
                    </div>
                    <div class="row mb-3">
                        <label for="exampleInputEmail1" class="form-label">Nomor Surat :</label>
                        <input type="text" class="form-control" id="nomor_surat" aria-describedby="emailHelp"
                            name="nomor_surat" placeholder="Nomor Surat">
                    </div>
                    <div class="row mb-3">
                        <label for="exampleInputEmail1" class="form-label">Tanggal Pelaksaan Audit Investigasi :</label>
                        <input type="date" class="form-control" id="tanggal_pelaksanaan" aria-describedby="emailHelp"
                        name="tanggal_pelaksanaan">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-tutup" form="form-surat-penghadapan" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" modal="modal_surat_penghadapan" btn-buat="btn-dokumen-surat-penghadapan" btn-dokumen="btn-surat-penghadapan">Generate</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="modal_wawancara" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="exampleModalLabel" aria-hidden="true" >
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Template Undangan Wawancara</h5>
                <button type="button" class="btn-close btn-tutup" form="form-wawancara" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="/surat-undangan-wawancara" method="post" id="form-wawancara">
                <input type="hidden" class="form-control" value="{{ $kasus->id }}" aria-describedby="emailHelp"
                    name="data_pelanggar_id">
                @csrf
                <div class="modal-body">
                    <div class="row mb-3">
                        <label for="exampleInputEmail1" class="form-label">Nomor Surat :</label>
                        <input type="text" class="form-control" id="nomor_surat" aria-describedby="emailHelp"
                            name="nomor_surat" placeholder="Nomor Surat">
                    </div>
                    <div class="row mb-3">
                        <label for="exampleInputEmail1" class="form-label">Tanggal Wawancara :</label>
                        <input type="date" class="form-control" id="tanggal" aria-describedby="emailHelp"
                            name="tanggal">
                    </div>
                    <div class="row mb-3">
                        <label for="exampleInputEmail1" class="form-label">Jam :</label>
                        <input type="time" class="form-control" id="jam" aria-describedby="emailHelp"
                        name="jam">
                    </div>
                    <div class="row mb-3">
                        <label for="exampleInputEmail1" class="form-label">Ruangan Wawancara :</label>
                        <input type="text" class="form-control" id="ruangan" aria-describedby="emailHelp"
                            name="ruangan" placeholder="Ruangan Wawancara">
                    </div>
                    <div class="row mb-3">
                        <label for="exampleInputEmail1" class="form-label">Alamat :</label>
                        <textarea name="alamat" class="form-control" id="alamat" cols="30" rows="7" placeholder="Alamat Wawancara" ></textarea>
                    </div>
                    <div class="row mb-3">
                        <label for="exampleInputEmail1" class="form-label">Penyidik Yamg Bisa di Hubungi :</label>
                        <select name="id_penyidik" id="id_penyidik" class="form-control">
                            <option value="">Pilih Penyidik</option>
                            @foreach ($penyidiks as $penyidik)
                                <option value="{{ $penyidik->id }}"
                                    @if(isset($wawancara))
                                        @if($penyidik->id == $wawancara->id_penyidik)
                                            {{ 'selected' }}
                                        @endif
                                    @endif
                                >{{$penyidik->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="row mb-3">
                        <label for="exampleInputEmail1" class="form-label">No. Handphone :</label>
                        <input type="number" class="form-control" id="nomor_handphone" aria-describedby="emailHelp"
                            name="nomor_handphone" placeholder="No. Handphone">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-tutup" form="form-wawancara" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" modal="modal_wawancara" btn-buat="btn-dokumen-wawancara" btn-dokumen="btn-wawancara">Generate</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="modal_laporan" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Template Laporan Hasil Audit</h5>
                <button type="button" class="btn-close btn-tutup" form="form-laporan" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="/laporan-hasil-audit" method="post" id="form-laporan">
                <input type="hidden" class="form-control" value="{{ $kasus->id }}" aria-describedby="emailHelp"
                    name="data_pelanggar_id" >
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Nomor Laporan Hasil Audit Investigas :</label>
                                <input type="text" class="form-control" id="nomor_laporan" aria-describedby="emailHelp"
                                    name="nomor_laporan" placeholder="Nomor Laporan Hasil Audit Investigas">
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
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Hasil Audit Investigasi :</label>
                                <select name="hasil" id="hasil" class="form-control">
                                    <option value="">Pilih Hasil</option>
                                    <option value="Ditemukan">Ditemukan</option>
                                    <option value="Tidak Ditemukan">Tidak Ditemukan</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="card card-data-penyidik">
                        <div class="card-header">Input Data Saksi</div>
                        <div class="card-body">
                            <div class="mb-3" id="form_input_saksi">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="exampleInputEmail1" class="form-label">Type :</label>
                                            <select name="type[]" class="form-control" id="type">
                                                <option value="">Pilih Type Saksi</option>
                                                <option value="Sipil">Sipil</option>
                                                <option value="Polri">Polri</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div id="Polri" style="display: none;">
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
                                                <select name="id_pangkat[]" id="id_pangkat" class="form-control">
                                                    <option value="">Pilih Pangkat</option>
                                                    @if(isset($pangkat))
                                                        @foreach($pangkat as $pangkat)
                                                            <option value="{{ $pangkat->id }}">{{ $pangkat->name }}</option>
                                                        @endforeach   
                                                    @endif
                                                </select>
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
                                </div>
                                <div id="Sipil" style="display: none;">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label for="exampleInputEmail1" class="form-label">Nama :</label>
                                                <input type="text" class="form-control" id="nama" aria-describedby="emailHelp"
                                                    name="nama[]" placeholder="Nama">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                            </div>
                            <div class="row mb-3" class="d-flex justify-content-end">
                                <a href="#" id="tambah" counter="0"> <i class="far fa-plus-square"></i>
                                    Saksi </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-tutup" form="form-laporan" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" modal="modal_laporan" btn-dokumen="btn-laporan">Generate</button>
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
    
        $('#form-wawancara').validate({
            rules: {
                tanggal : {
                    required: true,
                },
                jam : {
                    required: true,
                },
                ruangan : {
                    required: true,
                },
                alamat : {
                    required: true,
                },
                id_penyidik : {
                    required: true,
                },
                nomor_handphone : {
                    required: true,
                },
            },
            messages : {
                tanggal: "Silahkan isi tanggal!",
                jam: "Silahkan isi jam!",
                ruangan: "Silahkan isi ruangan wawancara!",
                alamat: "Silahkan isi alamat!",
                id_penyidik: "Silahkan Pilih Penyidik!",
                nomor_handphone: "Silahkan isi Nomor Handphone!",
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
                var modal = $(this).attr('modal');
                var kasus_id = $('#kasus_id').val();
                $('#modal_wawancara').modal('hide');
                $('.loader-view').show();
                $('#viewProses').hide();
                setTimeout(function() {
                    $.ajax({
                        type: 'get',
                        url: `/pulbaket/view/next-data/${kasus_id}`,
                        success: function(data) {
                            $('#viewProses').html(data);
                            $('.loader-view').hide();
                            $('#viewProses').show();
                        }
                    });
                }, 3000);
            }
        });

        $('#form-surat-penghadapan').validate({
            rules: {
                nomor_surat : {
                    required: true,
                },
                tanggal_pelaksanaan : {
                    required: true,
                },
                hasil : {
                    required: true,
                },
            },
            messages : {
                nomor_surat: "Silahkan isi nomor surat!",
                tanggal_pelaksanaan: "Silahkan isi tanggal pelaksanaan!",
                hasil: "Silahkan isi hasil!",
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
                var modal = $(this).attr('modal');
                var kasus_id = $('#kasus_id').val();
                $('#modal_surat_penghadapan').modal('hide');
                $('.loader-view').show();
                $('#viewProses').hide();
                setTimeout(function() {
                    $.ajax({
                        type: 'get',
                        url: `/pulbaket/view/next-data/${kasus_id}`,
                        success: function(data) {
                            $('#viewProses').html(data);
                            $('.loader-view').hide();
                            $('#viewProses').show();
                        }
                    });
                }, 3000);
            }
        });
        $('#form-laporan').validate({
            rules: {
                tanggal : {
                    required: true,
                },
                nomor_laporan : {
                    required: true,
                },
                'nama[]' :'required',
            },
            messages : {
                tanggal: "Silahkan isi tanggal!",
                nomor_laporan: "Silahkan isi nomor laporan hasil audit investigasi!",
                'nama[]': "Silahkan isi nama!",
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
                var modal = $(this).attr('modal');
                var kasus_id = $('#kasus_id').val();
                $('#modal_laporan').modal('hide');
                console.log('masuk');
                $('.loader-view').show();
                $('#viewProses').hide();
                setTimeout(function() {
                    $.ajax({
                        type: 'get',
                        url: `/pulbaket/view/next-data/${kasus_id}`,
                        success: function(data) {
                            $('#viewProses').html(data);
                console.log('masuk2');
                            $('.loader-view').hide();
                            $('#viewProses').show();
                        }
                    });
                }, 3000);
            }
        });
    });

    function getPangkat(handleData){
        $.ajax({
            type: 'get',
            url: `/get-data-pangkat/`,
            success: function(data) {
                data = JSON.parse(data);
                handleData(data); 
            }
        });
    }

    $('#type').on('change', function () {
        var type = $(this).val();
        if(type == 'Sipil'){
            $('#Sipil').show();
            $('#Polri').hide();
        }else{
            $('#Polri').show();
            $('#Sipil').hide();
        }
    })

    $('#tambah').on('click', function () {
       var counter = $(this).attr('counter');
       counter = parseInt(counter)+1;

       getPangkat(function(output){
            var pangkat = output;
            tambahSaksi(counter, pangkat);
            $('#type_'+counter).on('change', function () {
                     var type = $(this).val();
                     console.log('hasil_type', type);
                     if(type == 'Sipil'){
                         console.log('satu');
                         $('#Sipil_'+counter).show();
                         $('#Polri_'+counter).hide();
                     }else{
                         console.log('dua');
                         $('#Polri_'+counter).show();
                         $('#Sipil_'+counter).hide();
                     }
                 })
             $('#type_'+counter).trigger('change');
        });


        $(this).attr('counter', counter);
    });

    function tambahSaksi(counter, pangkat) {
            let inHtml =
            `<div class="row">
                <div class="col-md-12">
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Type :</label>
                        <select name="type[]" class="form-control" id="type_${counter}">
                            <option value="">Pilih Type Saksi</option>
                            <option value="Sipil">Sipil</option>
                            <option value="Polri">Polri</option>
                        </select>
                    </div>
                </div>
            </div>
             <div id="Polri_${counter}" style="display: none;">
                <div class="row">
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">NRP :</label>
                            <input type="text" class="form-control" id="nrp_${counter}" aria-describedby="emailHelp"
                                name="nrp[]" placeholder="NRP">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Pangkat :</label>
                            <select class="form-control" id="id_pangkat_${counter}" name="id_pangkat[]">
                                <option value=""> Pilih Pangkat </option>
                                `;
                                for(i=0; i<pangkat.length; i++)
                                {
                                    inHtml += `<option value="${pangkat[i].id}">${pangkat[i].name}</option>`; 
                                }
                                inHtml +=`
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Nama :</label>
                            <input type="text" class="form-control" id="nama_${counter}" aria-describedby="emailHelp"
                                name="nama[]" placeholder="Nama">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Jabatan :</label>
                            <input type="text" class="form-control" id="jabatan_${counter}" aria-describedby="emailHelp"
                                name="jabatan[]" placeholder="Jabatan">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Kesatuan :</label>
                            <input type="text" class="form-control" id="kesatuan_${counter}" aria-describedby="emailHelp"
                                name="kesatuan[]" placeholder="Kesatuan">
                        </div>
                    </div>
                </div>
            </div>
            <div id="Sipil_${counter}" style="display: none;">
                <div class="row">
                    <div class="col-md-12">
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Nama :</label>
                            <input type="text" class="form-control" id="nama_${counter}" aria-describedby="emailHelp"
                                name="nama[]" placeholder="Nama">
                        </div>
                    </div>
                </div>
            </div>`;
            
        $('#form_input_saksi').append(inHtml);
    }
    $('.btn-tutup').on('click', function () {
        var form = $(this).attr('form');
        
    });

   
</script>