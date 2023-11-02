@extends('partials.master')

@prepend('styles')
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <style>
        select:hover,
        #datepicker:hover {
            cursor: pointer;
        }
    </style>
@endprepend

@section('content')
    <div class="row form-control">
        <div class="text-center">
            <h3>Form Input Dumas</h3>
        </div>
        <form action="/input-data-kasus/store" id="input-pelanggar" method="post" class="row g-3 needs-validation" novalidate>
            @csrf
            <div class="row">
                <hr>
                <h3>Nota Dinas</h3>
                <hr class="mt-2">
                <div class="col-lg-6 mb-3">
                    <label for="no_nota_dinas" class="form-label">No. Nota Dinas</label>
                    <input type="text" name="no_nota_dinas" id="no_nota_dinas"class="form-control border-dark"
                        placeholder="No. Nota Dinas" value="{{ isset($kasus) ? $kasus->no_nota_dinas : '' }}" required>
                </div>
                <div class="col-lg-6 mb-3">
                    <label for="perihal_nota_dinas" class="form-label">Perihal Nota Dinas</label>
                    <input type="text" name="perihal_nota_dinas" id="perihal_nota_dinas" class="form-control border-dark"
                        placeholder="Perihal Nota Dinas" value="{{ isset($kasus) ? $kasus->perihal_nota_dinas : '' }}"
                        required>
                </div>
                <div class="col-lg-6 mb-3">
                    <label for="wujud_perbuatan" class="form-label">Wujud Perbuatan</label>
                    <select name="id_wujud_perbuatan" id="id_wujud_perbuatan" class="form-control" required>
                        <option value="">Pilih Wujud Perbuatan</option>
                        @if (isset($wujud_perbuatan))
                            @foreach ($wujud_perbuatan as $key => $wujud)
                                <option value="{{ $wujud->id }}"
                                    {{ isset($kasus) ? ($kasus->id_wujud_perbuatan == $wujud->id ? 'selected' : '') : '' }}>
                                    {{ $wujud->keterangan_wp }}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
                <div class="col-lg-6 mb-3">
                    <label for="tanggal_nota_dinas" class="form-label">Tanggal Nota Dinas</label>
                    <input type="date" id="tanggal_nota_dinas" name="tanggal_nota_dinas"
                        class="form-control border-dark datepicker"
                        value="{{ isset($kasus) ? $kasus->tanggal_nota_dinas : '' }}" required>
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
                            <input type="text" name="pelapor" id="pelapor" class="form-control border-dark"
                                placeholder="Nama Pelapor" value="{{ isset($kasus) ? $kasus->pelapor : '' }}" required>
                        </div>
                        <div class="col-lg-4 mb-3">
                            <label for="umur" class="form-label">Umur</label>
                            <input type="number" name="umur" id="umur" class="form-control border-dark"
                                placeholder="Umur Pelapor" value="{{ isset($kasus) ? $kasus->umur : '' }}">
                        </div>
                        <div class="col-lg-4 mb-3">
                            <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                            {{-- <input type="text" name="jenis_kelamin" class="form-control border-dark" value="{{ isset($kasus) ? $kasus->jenis_kelamin : '' }}" > --}}
                            <select class="form-select border-dark" aria-label="Default select example"
                                name="jenis_kelamin"id="jenis_kelamin" required>
                                <option value="" selected>-- Jenis Kelamin --</option>
                                {{-- <option value="0">Laki-laki</option>
                                <option value="1">Perempuan</option> --}}
                                @if (isset($jenis_kelamin))
                                    @foreach ($jenis_kelamin as $key => $jk)
                                        <option value="{{ $jk->id }}"
                                            {{ isset($kasus) ? ($kasus->jenis_kelamin == $jk->id ? 'selected' : '') : '' }}>
                                            {{ $jk->name }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="col-lg-4 mb-3">
                            <label for="no_telp" class="form-label">No. Telephone</label>
                            <input type="text" name="no_telp" class="form-control border-dark"
                                placeholder="No. Telephone" value="{{ isset($kasus) ? $kasus->no_telp : '' }}" required>
                        </div>
                        <div class="col-lg-6 mb-3">
                            <label for="pekerjaan" class="form-label">Pekerjaan</label>
                            <input type="text" name="pekerjaan" class="form-control border-dark"
                                placeholder="Pekerjaan Pelapor" value="{{ isset($kasus) ? $kasus->pekerjaan : '' }}"
                                required>
                        </div>
                        <div class="col-lg-6 mb-3">
                            <label for="agama" class="form-label">Agama</label>
                            {{-- <input type="text" name="agama" class="form-control border-dark" placeholder="Agama Pelapor" value="{{ isset($kasus) ? $kasus->agama : '' }}" > --}}
                            <select class="form-select border-dark" aria-label="Default select example" name="agama"
                                id="agama" required>
                                <option value="" selected>-- Agama --</option>
                                @foreach ($agama as $key => $ag)
                                    <option value="{{ $ag->id }}">{{ $ag->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-lg-6 mb-3">
                            <label for="no_identitas" class="form-label">No Identitas</label>
                            <input type="text" name="no_identitas" id="no_identitas"
                                placeholder="1234-5678-9012-1234" class="form-control border-dark"
                                value="{{ isset($kasus) ? $kasus->no_identitas : '' }}" required>
                        </div>

                        <div class="col-lg-6 mb-3">
                            <label for="jenis_identitas" class="form-label">Jenis Identitas</label>
                            {{-- <input type="text" name="jenis_identitas" class="form-control border-dark" value="{{ isset($kasus) ? $kasus->jenis_identitas : '' }}" > --}}
                            <select class="form-select border-dark" aria-label="Default select example"
                                name="jenis_identitas"id="jenis-identitas" required>
                                <option value="" selected>-- Jenis Identitas --</option>
                                @if (isset($jenis_identitas))
                                    @foreach ($jenis_identitas as $key => $ji)
                                        <option value="{{ $ji->id }}"
                                            {{ isset($kasus) ? ($kasus->jenis_identitas == $ji->id ? 'selected' : '') : '' }}>
                                            {{ $ji->name }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>

                        <div class="col-lg-12 mb-3">
                            <label for="alamat" class="form-label">Alamat</label>
                            <textarea name="alamat" cols="30" id="alamat" rows="9" placeholder="Alamat"
                                class="form-control border-dark" value="{{ isset($kasus) ? $kasus->alamat : '' }}" required></textarea>
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
                            <input type="text" name="terlapor" id="terlapor" placeholder="Nama Terlapor"
                                class="form-control border-dark" value="{{ isset($kasus) ? $kasus->terlapor : '' }}"
                                required>
                        </div>
                        <div class="col-lg-6 mb-3">
                            <label for="tempat" class="form-label">Tempat Lahir</label>
                            <input type="text" name="tempat_lahir" id="tempat_lahir" placeholder="Tempat Lahir"
                                class="form-control border-dark" value="{{ isset($kasus) ? $kasus->tempat_lahir : '' }}">
                        </div>
                        <div class="col-lg-6 mb-3">
                            <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                            <input type="date" name="tanggal_lahir" id="tanggal_lahir"
                                class="form-control border-dark datepicker"
                                value="{{ isset($kasus) ? $kasus->tanggal_lahir : '' }}">
                        </div>
                        <div class="col-lg-6 mb-3">
                            <label for="no_hp" class="form-label">No. Handphone</label>
                            <input type="text" name="no_hp" id="no_hp" placeholder="No. Handphone"
                                class="form-control border-dark" value="{{ isset($kasus) ? $kasus->no_hp : '' }}">
                        </div>
                        <div class="col-lg-6 mb-3">
                            <label for="pendidikan_terakhir" class="form-label">Pendidikan Terakhir</label>
                            <input type="text" name="pendidikan_terakhir" id="pendidikan_terakhir"
                                placeholder="Pendidikan Terakhir" class="form-control border-dark"
                                value="{{ isset($kasus) ? $kasus->pendidikan_terakhir : '' }}">
                        </div>
                        <div class="col-lg-6 mb-3">
                            <label for="pangkat" class="form-label">Pangkat</label>
                            <select name="id_pangkat" id="id_pangkat" class="form-control" required>
                                <option value="">Pilih Pangkat</option>
                                @if (isset($pangkat))
                                    @foreach ($pangkat as $key => $pangkt)
                                        <option value="{{ $pangkt->id }}"
                                            {{ isset($kasus) ? ($kasus->id_pangkat == $pangkt->id ? 'selected' : '') : '' }}>
                                            {{ $pangkt->name }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="col-lg-6 mb-3">
                            <label for="nrp" class="form-label">NRP</label>
                            <input type="tel" name="nrp" id="nrp" placeholder="NRP Terlapor" required
                                maxlength="8" class="form-control border-dark"
                                value="{{ isset($kasus) ? $kasus->nrp : '' }}">
                        </div>
                        <div class="col-lg-6 mb-3">
                            <label for="suku" class="form-label">Suku</label>
                            <input type="text" name="suku" id="suku" class="form-control border-dark"
                                placeholder="Suku Terlapor" value="{{ isset($kasus) ? $kasus->suku : '' }}">
                        </div>
                        <div class="col-lg-6 mb-3">
                            <label for="agama" class="form-label">Agama</label>
                            {{-- <input type="text" name="agama_terlapor" class="form-control border-dark" placeholder="Agama Terlapor" value="{{ isset($kasus) ? $kasus->agama_terlapor : '' }}" > --}}
                            <select class="form-select border-dark" aria-label="Default select example" required
                                name="agama_terlapor" id="agama_terlapor">
                                <option value="" selected>-- Agama --</option>
                                @foreach ($agama as $key => $ag)
                                    <option value="{{ $ag->id }}">{{ $ag->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-lg-6 mb-3">
                            <label for="jabatan" class="form-label">Jabatan</label>
                            <input type="text" name="jabatan" id="jabatan" placeholder="Jabatan Terlapor" required
                                class="form-control border-dark" value="{{ isset($kasus) ? $kasus->jabatan : '' }}">
                        </div>
                        <div class="col-lg-6 mb-3">
                            <label for="kesatuan" class="form-label">Kesatuan</label>
                            <select class="form-select border-dark" aria-label="Default select example" name="kesatuan"
                                required id="kesatuan">
                                <option value="" selected>-- Kesatuan --</option>
                                @foreach ($kesatuan as $key => $value)
                                    <option value="POLDA {{ $value->name }}">POLDA {{ $value->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-lg-12 mb-3">
                            <label for="alamat" class="form-label">Alamat</label>
                            <textarea name="alamat_terlapor" id="alamat_terlapor" cols="30" rows="4" placeholder="Alamat"
                                class="form-control border-dark" value="{{ isset($kasus) ? $kasus->alamat_terlapor : '' }}"></textarea>
                        </div>
                    </div>
                    <div class="row">
                        <hr>
                        <h3>Kronologis</h3>
                        <hr class="mt-2">
                        <div class="col-lg-6 mb-3">
                            <label for="tempat_kejadian" class="form-label">Tempat Kejadian</label>
                            <input type="text" name="tempat_kejadian" id="tempat_kerjadian"
                                class="form-control border-dark" placeholder="Tempat Kejadian"
                                value="{{ isset($kasus) ? $kasus->tempat_kejadian : '' }}" required>
                        </div>
                        <div class="col-lg-6 mb-3">
                            <label for="tanggal_kejadian" class="form-label">Tanggal Kejadian</label>
                            <input type="date" id="tanggal_kejadian" name="tanggal_kejadian"
                                class="form-control border-dark datepicker" required>
                        </div>
                        <div class="col-lg-12 mb-3">
                            <label for="nama_korban" class="form-label">Nama Korban</label>
                            <input type="text" name="nama_korban" id="nama_korban" class="form-control border-dark"
                                placeholder="Nama Korban" value="{{ isset($kasus) ? $kasus->nama_korban : '' }}"
                                required>
                        </div>
                        <div class="col-lg-12 mb-3">
                            <label for="kronologis" class="form-label">Kronologis</label>
                            <textarea name="kronologis" cols="30" id="kronologis" rows="5" class="form-control border-dark"
                                placeholder="Kronologi Kejadian" value="{{ isset($kasus) ? $kasus->kronologi : '' }}" required></textarea>
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

@push('scripts')
    <script type="text/javascript">
        $(document).ready(function() {

            // $("#tanggal_nota_dinas").pDatePicker({
            //     lang: "id"
            // });

            // $("#tanggal_lahir").pDatePicker({
            //     lang: "id"
            // });
            // $("#tanggal_kejadian").pDatePicker({
            //     lang: "id"
            // });
            //no identitas
            no_identitas.addEventListener('keyup', function(e) {
                no_identitas.value = format_no_identitas(this.value, '');
            });

            function format_no_identitas(angka, prefix) {
                var number_string = angka.replace(/[^,\d]/g, '').toString(),
                    split = number_string.split(','),
                    sisa = split[0].length % 4,
                    rupiah = split[0].substr(0, sisa),
                    ribuan = split[0].substr(sisa).match(/\d{4}/gi);

                if (ribuan) {
                    separator = sisa ? '-' : '';
                    rupiah += separator + ribuan.join('-');
                }

                rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
                return prefix == undefined ? rupiah : (rupiah ? rupiah : '');
            };

            $('select').select2({
                theme: 'bootstrap-5'
            });
        });

        // Example starter JavaScript for disabling form submissions if there are invalid fields
        (function() {
            'use strict'

            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            var forms = document.querySelectorAll('.needs-validation')

            // Loop over them and prevent submission
            Array.prototype.slice.call(forms)
                .forEach(function(form) {
                    form.addEventListener('submit', function(event) {
                        $('.date-picker-input').attr('required', 'required')
                        if (!form.checkValidity()) {
                            event.preventDefault()
                            event.stopPropagation()
                        }

                        form.classList.add('was-validated')
                    }, false)
                })
        })();
    </script>
@endpush
