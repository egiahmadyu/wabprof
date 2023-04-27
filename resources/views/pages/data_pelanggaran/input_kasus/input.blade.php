@extends('partials.master')

@prepend('styles')
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <style>
        select:hover, #datepicker:hover {
            cursor: pointer;
        }
    </style>
@endprepend

@section('content')
    <div class="row form-control">
        <div class="text-center">
            <h3>Form Input Dumas</h3>
        </div>
        <form action="/input-data-kasus/store" id="input-pelanggar" method="post">
            @csrf
            <div class="row">
                <hr>
                    <h3>Nota Dinas</h3>
                <hr class="mt-2">
                <div class="col-lg-6 mb-3">
                    <label for="no_nota_dinas" class="form-label">No. Nota Dinas</label>
                    <input type="text" name="no_nota_dinas" id="no_nota_dinas"class="form-control border-dark" placeholder="No. Nota Dinas" value="{{ isset($kasus) ? $kasus->no_nota_dinas : '' }}" >
                </div>
                <div class="col-lg-6 mb-3">
                    <label for="perihal_nota_dinas" class="form-label">Perihal Nota Dinas</label>
                    <input type="text" name="perihal_nota_dinas" id="perihal_nota_dinas" class="form-control border-dark" placeholder="Perihal Nota Dinas" value="{{ isset($kasus) ? $kasus->perihal_nota_dinas : '' }}" >
                </div>
                <div class="col-lg-6 mb-3">
                    <label for="wujud_perbuatan" class="form-label">Wujud Perbuatan</label>
                    <select name="id_wujud_perbuatan" id="id_wujud_perbuatan" class="form-control">
                        <option value="">Pilih Wujud Perbuatan</option>
                        @if (isset($wujud_perbuatan))
                            @foreach ($wujud_perbuatan as $key => $wujud)
                                <option value="{{ $wujud->id }}" {{ isset($kasus) ? ($kasus->id_wujud_perbuatan == $wujud->id ? 'selected' : '') : '' }}>{{ $wujud->keterangan_wp }}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
                <div class="col-lg-6 mb-3">
                    <label for="tanggal_nota_dinas" class="form-label">Tanggal Nota Dinas</label>
                    <input type="text" id="datepicker tanggal_nota_dinas" name="tanggal_nota_dinas" class="form-control border-dark" placeholder="BB/HH/TTTT" value="{{ isset($kasus) ? $kasus->tanggal_nota_dinas : '' }}" >
                </div>
            </div>
            {{-- <input type="text" class="form-control border-dark" value="{{ isset($kasus) ? $kasus->id : '' }}" hidden name="kasus_id"> --}}
            <div class="row">
                <hr>
                    <h3>Pelapor</h3>
                <hr class="mt-2">
                <div class="col-lg-12 p-3">
                    <div class="row">
                        <div class="col-lg-12 mb-3">
                            <label for="pelapor" class="form-label">Pelapor</label>
                            <input type="text" name="pelapor" id="pelapor" class="form-control border-dark" placeholder="Nama Pelapor" value="{{ isset($kasus) ? $kasus->pelapor : '' }}" >
                        </div>
                        <div class="col-lg-6 mb-3">
                            <label for="umur" class="form-label">Umur</label>
                            <input type="number" name="umur" id="umur" class="form-control border-dark" placeholder="Umur Pelapor" value="{{ isset($kasus) ? $kasus->umur : '' }}" >
                        </div>
                        <div class="col-lg-6 mb-3">
                            <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                            {{-- <input type="text" name="jenis_kelamin" class="form-control border-dark" value="{{ isset($kasus) ? $kasus->jenis_kelamin : '' }}" > --}}
                            <select class="form-select border-dark" aria-label="Default select example" name="jenis_kelamin"id="jenis_kelamin">
                                <option value="" selected>-- Jenis Kelamin --</option>
                                {{-- <option value="0">Laki-laki</option>
                                <option value="1">Perempuan</option> --}}
                                @if (isset($jenis_kelamin))
                                    @foreach ($jenis_kelamin as $key => $jk)
                                        <option value="{{ $jk->id }}" {{ isset($kasus) ? ($kasus->jenis_kelamin == $jk->id ? 'selected' : '') : '' }}>{{ $jk->name }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="col-lg-6 mb-3">
                            <label for="pekerjaan" class="form-label">Pekerjaan</label>
                            <input type="text" name="pekerjaan" class="form-control border-dark" placeholder="Pekerjaan Pelapor" value="{{ isset($kasus) ? $kasus->pekerjaan : '' }}" >
                        </div>
                        <div class="col-lg-6 mb-3">
                            <label for="agama" class="form-label">Agama</label>
                            {{-- <input type="text" name="agama" class="form-control border-dark" placeholder="Agama Pelapor" value="{{ isset($kasus) ? $kasus->agama : '' }}" > --}}
                            <select class="form-select border-dark" aria-label="Default select example" name="agama" id="agama">
                                <option value="" selected>-- Agama --</option>
                                @foreach ($agama as $key => $ag)
                                    <option value="{{ $ag->id }}">{{ $ag->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-lg-6 mb-3">
                            <label for="no_identitas" class="form-label">No Identitas</label>
                            <input type="text" name="no_identitas" id="no_identitas" placeholder="1234-5678-9012-1234" class="form-control border-dark" value="{{ isset($kasus) ? $kasus->no_identitas : '' }}" >
                        </div>

                        <div class="col-lg-6 mb-3">
                            <label for="jenis_identitas" class="form-label">Jenis Identitas</label>
                            {{-- <input type="text" name="jenis_identitas" class="form-control border-dark" value="{{ isset($kasus) ? $kasus->jenis_identitas : '' }}" > --}}
                            <select class="form-select border-dark" aria-label="Default select example" name="jenis_identitas"id="jenis-identitas">
                                <option value="" selected>-- Jenis Identitas --</option>
                                @if (isset($jenis_identitas))
                                    @foreach ($jenis_identitas as $key => $ji)
                                        <option value="{{ $ji->id }}" {{ isset($kasus) ? ($kasus->jenis_identitas == $ji->id ? 'selected' : '') : '' }}>{{ $ji->name }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>

                        <div class="col-lg-12 mb-3">
                            <label for="alamat" class="form-label">Alamat</label>
                            <textarea name="alamat" cols="30" id="alamat" rows="9" placeholder="Alamat" class="form-control border-dark" value="{{ isset($kasus) ? $kasus->alamat : '' }}"></textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <hr>
                    <h3>Terlapor</h3>
                <hr class="mt-2">
                <div class="col-lg-12 p-3">
                    <div class="row">
                        <div class="col-lg-12 mb-3">
                            <label for="terlapor" class="form-label">Terlapor</label>
                            <input type="text" name="terlapor" id="terlapor" placeholder="Nama Terlapor" class="form-control border-dark" value="{{ isset($kasus) ? $kasus->terlapor : '' }}" >
                        </div>
                        <div class="col-lg-6 mb-3">
                            <label for="pangkat" class="form-label">Pangkat</label>
                            <select name="id_pangkat" id="id_pangkat" class="form-control">
                                <option value="">Pilih Pangkat</option>
                                @if (isset($pangkat))
                                    @foreach ($pangkat as $key => $pangkt)
                                        <option value="{{ $pangkt->id }}" {{ isset($kasus) ? ($kasus->id_pangkat == $pangkt->id ? 'selected' : '') : '' }}>{{ $pangkt->name }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="col-lg-6 mb-3">
                            <label for="nrp" class="form-label">NRP</label>
                            <input type="text" name="nrp" id="nrp" placeholder="NRP Terlapor"  maxlength="16" class="form-control border-dark" value="{{ isset($kasus) ? $kasus->nrp : '' }}" >
                        </div>
                        <div class="col-lg-6 mb-3">
                            <label for="suku" class="form-label">Suku</label>
                            <input type="text" name="suku" id="suku" class="form-control border-dark" placeholder="Suku Terlapor" value="{{ isset($kasus) ? $kasus->suku : '' }}" >
                        </div>
                        <div class="col-lg-6 mb-3">
                            <label for="agama" class="form-label">Agama</label>
                            {{-- <input type="text" name="agama_terlapor" class="form-control border-dark" placeholder="Agama Terlapor" value="{{ isset($kasus) ? $kasus->agama_terlapor : '' }}" > --}}
                            <select class="form-select border-dark" aria-label="Default select example" name="agama_terlapor" id="agama_terlapor">
                                <option value="" selected>-- Agama --</option>
                                @foreach ($agama as $key => $ag)
                                    <option value="{{ $ag->id }}">{{ $ag->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-lg-6 mb-3">
                            <label for="jabatan" class="form-label">Jabatan</label>
                            <input type="text" name="jabatan" id="jabatan" placeholder="Jabatan Terlapor" class="form-control border-dark" value="{{ isset($kasus) ? $kasus->jabatan : '' }}" >
                        </div>
                        <div class="col-lg-6 mb-3">
                            <label for="kesatuan" class="form-label">Kesatuan</label>
                            <input type="text" name="kesatuan" id="kesatuan" class="form-control border-dark" placeholder="Kesatuan" value="{{ isset($kasus) ? $kasus->kesatuan : '' }}" >
                        </div>
                        <div class="col-lg-12 mb-3">
                            <label for="alamat" class="form-label">Alamat</label>
                            <textarea name="alamat_terlapor" id="alamat_terlapor" cols="30" rows="9" placeholder="Alamat" class="form-control border-dark" value="{{ isset($kasus) ? $kasus->alamat_terlapor : '' }}"></textarea>
                        </div>
                    </div>
                    <div class="row">
                        <hr>
                            <h3>Kronologis</h3>
                        <hr class="mt-2">
                        <div class="col-lg-6 mb-3">
                            <label for="tempat_kejadian" class="form-label">Tempat Kejadian</label>
                            <input type="text" name="tempat_kejadian" id="tempat_kerjadian" class="form-control border-dark" placeholder="Tempat Kejadian" value="{{ isset($kasus) ? $kasus->tempat_kejadian : '' }}"
                                >
                        </div>
                        <div class="col-lg-6 mb-3">
                            <label for="tanggal_kejadian" class="form-label">Tanggal Kejadian</label>
                            <input type="text" id="datepicker2 tanggal_kejadian" name="tanggal_kejadian" class="form-control border-dark" placeholder="BB/HH/TTTT" value="{{ isset($kasus) ? $kasus->tanggal_kejadian : '' }}" >
                        </div>
                        <div class="col-lg-12 mb-3">
                            <label for="nama_korban" class="form-label">Nama Korban</label>
                            <input type="text" name="nama_korban" id="nama_korban" class="form-control border-dark" placeholder="Nama Korban" value="{{ isset($kasus) ? $kasus->nama_korban : '' }}" >
                        </div>
                        <div class="col-lg-12 mb-3">
                            <label for="kronologis" class="form-label">Kronologis</label>
                            <textarea name="kronologis" cols="30" id="kronologis" rows="5" class="form-control border-dark" placeholder="Kronologi Kejadian" value="{{ isset($kasus) ? $kasus->kronologi : '' }}" ></textarea>
                        </div>
                        {{-- <div class="col-lg-12 mb-3">
                            <label for="download_berkas_disposisi" class="form-label">Download Berkas Disposisi</label>
                            <button class="btn btn-primary" style="width: 100%" data-bs-toggle="modal"
                                data-bs-target="#modal_disposisi" type="button">Download</button>
                            <input type="text" class="form-control border-dark" value="{{ $kasus->terlapor }}" >
                        </div> --}}
                        {{-- <div class="col-lg-12 mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select class="form-select border-dark" aria-label="Default select example" name="status" id="status" disabled>
                                <option value="1" selected>-- Status --</option>
                                <option value=""></option>
                            </select>
                        </div> --}}
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 mb-3">
                    <button class="btn btn-success form-control" type="submit" value="input_kasus" name="type_submit">
                        Submit Data
                    </button>
                </div>
            </div>
        </form>
    </div>
@endsection

@section('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script src="{{ asset('assets/js/jquery.validate.js') }}"></script>
  <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {

            //no identitas
            no_identitas.addEventListener('keyup', function(e){
                no_identitas.value = format_no_identitas(this.value, '');
            });

            function format_no_identitas(angka, prefix){
                var number_string = angka.replace(/[^,\d]/g, '').toString(),
                split   		= number_string.split(','),
                sisa     		= split[0].length % 4,
                rupiah     		= split[0].substr(0, sisa),
                ribuan     		= split[0].substr(sisa).match(/\d{4}/gi);
                
                if(ribuan){
                    separator = sisa ? '-' : '';
                    rupiah += separator + ribuan.join('-');
                }
                
                rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
                return prefix == undefined ? rupiah : (rupiah ? rupiah : '');
            };

            $('#input-pelanggar').validate({
                rules: {
                    no_nota_dinas : {
                        required: true,
                    },
                    perihal_nota_dinas : {
                        required: true,
                    },
                    id_wujud_perbuatan : {
                        required: true,
                    },
                    tanggal_nota_dinas : {
                        required: true,
                    },
                    pelapor : {
                        required: true,
                    },
                    umur : {
                        required: true,
                    },
                    jenis_kelamin : {
                        required: true,
                    },
                    pekerjaan : {
                        required: true,
                    },
                    agama : {
                        required: true,
                    },
                    no_identitas : {
                        required: true,
                    },
                    jenis_identitas : {
                        required: true,
                    },
                    alamat : {
                        required: true,
                    },
                    terlapor : {
                        required: true,
                    },
                    jenis_kelamin : {
                        required: true,
                    },
                    id_pangkat : {
                        required: true,
                    },
                    nrp : {
                        required: true,
                    },
                    suku : {
                        required: true,
                    },
                    agama_terlapor : {
                        required: true,
                    },
                    jabatan : {
                        required: true,
                    },
                    kesatuan : {
                        required: true,
                    },
                    alamat_terlapor : {
                        required: true,
                    },
                    tempat_kejadian : {
                        required: true,
                    },
                    tanggal_kejadian : {
                        required: true,
                    },
                    nama_korban : {
                        required: true,
                    },
                    kronologis : {
                        required: true,
                    },
                },
                messages : {
                    no_nota_dinas: "Silahkan isi No. Nota Dinas!",
                    perihal_nota_dinas: "Silahkan isi Perihal Nota Dinas!",
                    id_wujud_perbuatan: "Silahkan Pilih Wujud Perbuatan!",
                    tanggal_nota_dinas: "Silahkan isi Tanggal Nota Dinas!",
                    pelapor: "Silahkan isi Pelapor!",
                    umur: "Silahkan isi Umur!",
                    jenis_kelamin: "Silahkan isi Jenis Kelamin!",
                    pekerjaan: "Silahkan isi Pekerjaan!",
                    agama: "Silahkan isi Agama!",
                    no_identitas: "Silahkan isi Nomor Identitas!",
                    jenis_identitas: "Silahkan isi Jenis Identitas!",
                    alamat: "Silahkan isi Alamat!",
                    terlapor: "Silahkan isi Terlapor!",
                    id_pangkat: "Silahkan Pilih Pangkat!",
                    nrp: "Silahkan Isi NRP Terlapor!",
                    suku: "Silahkan Isi Suku!",
                    agama_terlapor: "Silahkan Isi Agama Terlapor!",
                    jabatan: "Silahkan Isi Jabatan!",
                    kesatuan: "Silahkan Isi Kesatuan!",
                    alamat_terlapor: "Silahkan Isi Alanat Terlapor!",
                    tempat_kejadian: "Silahkan Isi Tempat Kejadian!",
                    tanggal_kejadian: "Silahkan Isi Tanggal Kejadian!",
                    nama_korban: "Silahkan Isi Nama Korban!",
                    kronologis: "Silahkan Isi Kronologis!",
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
                }
            });
        });

        $( function() {
            $( "#datepicker" ).datepicker({
                autoclose:true,
                todayHighlight:true,
                format:'yyyy-mm-dd',
                language: 'id'
            });
            $( "#datepicker2" ).datepicker({
                autoclose:true,
                todayHighlight:true,
                format:'yyyy-mm-dd',
                language: 'id'
            });
        } );

       
    </script>
@endsection
