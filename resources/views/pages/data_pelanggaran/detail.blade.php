@extends('partials.master')

@prepend('styles')
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <link href="{{ asset('assets/css/responsive.css') }}" rel="stylesheet" type="text/css" />
    <style>
        select:hover,
        #datepicker:hover {
            cursor: pointer;
        }

        .loader-vieww {
            margin-top: 75px;
        }

        .date-picker-date-container.show {
            display: block;
            z-index: 10;
        }
    </style>
@endprepend

@section('content')
    <div class="loader-view" style="display:block;">
        <div class="ring"> <img src="/assets/images/logo/wabprof.png" class="" alt="logo" width="50">
            <span></span>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Data No Nota Dinas {{ $kasus->no_nota_dinas }}
                        ({{ $kasus->status->name }})</h4>
                    @if ($kasus->status_dihentikan == 1)
                        <span class="badge bg-danger">Kasus Sudah Dihentikan</span>
                    @endif

                </div><!-- end card header -->

                <div class="card-body" style="min-height:300px">
                    <input type="text" class="form-control" id="data_pelanggar_id" name="data_pelanggar_id"
                        value="{{ $kasus->id }}" hidden>
                    <input type="text" class="form-control" id="process_id" name="data_pelanggar_id"
                        value="{{ $kasus->status_id }}" hidden>

                    <input type="hidden" id="status_surat_download" value="0">
                    <input type="hidden" id="status_nota_download" value="0">
                    <input type="hidden" id="status_undangan_download" value="0">
                    <input type="hidden" id="status_laporan_download" value="0">
                    <div id="viewProses">

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modal_terlapor" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Nota Dinas Perbaikan Berkas</h5>
                    <button type="button" class="btn-close btn-tutup" form="form-terlapor" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <form action="/tambah_terlapor" method="post" id="form_terlapor_tambah" novalidate>
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" name="data_pelanggar_id" value="{{ $kasus->id }}">
                        <div class="mb-3" id="form_input_terlapor">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="exampleInputPassword1" class="form-label">NRP Terlapor</label>
                                    <input type="text" class="form-control" name="nrp[]" placeholder="NRP Terlapor"
                                        required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="exampleInputPassword1" class="form-label">Nama Terlapor</label>
                                    <input type="text" class="form-control" name="nama[]" placeholder="Nama Terlapor"
                                        required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label for="exampleInputPassword1" class="form-label">Pangkat Terlapor</label>
                                    <select class="form-select" aria-label="Default select example" name="pangkat[]"
                                        required>
                                        <option value="">Open this select menu</option>
                                        @foreach ($pangkat as $value)
                                            <option value="{{ $value->id }}">{{ $value->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="exampleInputPassword1" class="form-label">Jabatan Terlapor</label>
                                    <input type="text" class="form-control" name="jabatan[]"
                                        placeholder="Jabatan Terlapor" required>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="exampleInputPassword1" class="form-label">Kesatuan Terlapor</label>
                                    <select class="form-select" aria-label="Default select example" name="kesatuan[]"
                                        required>
                                        <option value="">Open this select menu</option>
                                        @foreach ($polda as $value)
                                            <option value="{{ $value->name }}">{{ $value->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <hr>
                        </div>
                        <div class="row mb-3" class="d-flex justify-content-end">
                            <a href="#" id="tambah" counter="0"> <i class="far fa-plus-square"></i>
                                Terlapor </a>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-tutup" form="form-perbaikan"
                            data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary btn-simpan" modal="modal_terlapor">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            let process_id = $('#process_id').val()
            getViewProcess(process_id)
            $('#tambah').on('click', function() {
                var counter = $(this).attr('counter');
                var counter = parseInt(counter) + 1;
                tambahTerlapor(counter);
                $(this).attr('counter', counter);
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
                        if (!form.checkValidity()) {
                            event.preventDefault()
                            event.stopPropagation()
                        }

                        form.classList.add('was-validated')
                    }, false)
                })
        })()
    </script>
    <script>
        function tambahTerlapor(counter) {
            var pangkat = '{!! $option_pangkat !!}';
            var polda = '{!! $option_polda !!}';
            let inHtml =
                `<div id="baris${counter}">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="exampleInputPassword1" class="form-label">NRP Terlapor</label>
                            <input type="text" class="form-control" name="nrp[]" id="nrp_${counter}" placeholder="NRP Terlapor" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="exampleInputPassword1" class="form-label">Nama Terlapor</label>
                            <input type="text" class="form-control" name="nama[]" id="nama_${counter}" placeholder="Nama Terlapor" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label for="exampleInputPassword1" class="form-label">Pangkat Terlapor</label>
                            <select class="form-select" aria-label="Default select example" name="pangkat[]" id="pangkat_${counter}" required>
                                        <option value="">Open this select menu</option>
                                        ${pangkat}
                                </select>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="exampleInputPassword1" class="form-label">Jabatan Terlapor</label>
                            <input type="text" class="form-control" name="jabatan[]" id="jabatan_${counter}" placeholder="Jabatan Terlapor" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="exampleInputPassword1" class="form-label">Kesatuan Terlapor</label>
                            <select class="form-select" aria-label="Default select example" name="kesatuan[]" id="kesatuan_${counter}" required>
                                        <option value="">Open this select menu</option>
                                        ${polda}
                                </select>
                        </div>
                        <div class="col-12 mb-3">
                            <button type="button" class="btn btn-danger hapus btn-sm text-white col-12" counter="${counter}"><span class="fa fa-trash"></span> Hapus Terlapor</button>
                        </div>
                    </div>
                    <hr>
                    </div>`;
            $('#form_input_terlapor').append(inHtml);

            $('select').select2({
                theme: 'bootstrap-5'
            });
            $('.hapus').on('click', function() {
                var counter = $(this).attr('counter');
                console.log('hapussss', counter)

                $('#baris' + counter).remove();
            })
        }

        (function() {
            'use strict'

            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            var forms = $('#form_terlapor_tambah')

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

        function getViewProcess(id) {
            let kasus_id = $('#data_pelanggar_id').val()
            let process_id = $('#process_id').val()
            $("#viewProses").html("")
            $('.loader-view').css("display", "block");
            if (id == 5 && process_id == 8) {
                id = 8
            }

            $.ajax({
                url: `/data-kasus/view/${kasus_id}/${id}`,
                method: "get"
            }).done(async function(data) {
                $('.loader-view').css("display", "none");
                await $("#viewProses").html(data)

            });
        }

        function getValue() {
            console.log($('#editor').text())
        }
    </script>
@endpush
