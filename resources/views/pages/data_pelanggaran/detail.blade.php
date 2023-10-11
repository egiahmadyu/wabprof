@extends('partials.master')

@prepend('styles')
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <link href="{{ asset('assets/css/responsive.css') }}" rel="stylesheet" type="text/css" />
    <style>
        select:hover,
        #datepicker:hover {
            cursor: pointer;
        }

        .loader-view {
            margin-top: 75px;
        }
    </style>
@endprepend

@section('content')
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
                    <div class="loader-view" style="display:block;">

                    </div>
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
                <form action="/tambah_terlapor" method="post" id="form-terlapor">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" name="data_pelanggar_id" value="{{ $kasus->id }}">
                        <div class="mb-3" id="form_input_terlapor">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="exampleInputPassword1" class="form-label">NRP Terlapor</label>
                                    <input type="text" class="form-control" name="nrp[]" placeholder="NRP Terlapor">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="exampleInputPassword1" class="form-label">Nama Terlapor</label>
                                    <input type="text" class="form-control" name="nama[]" placeholder="Nama Terlapor">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label for="exampleInputPassword1" class="form-label">Pangkat Terlapor</label>
                                    <input type="text" class="form-control" name="pangkat[]"
                                        placeholder="Pangkat Terlapor">
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="exampleInputPassword1" class="form-label">Jabatan Terlapor</label>
                                    <input type="text" class="form-control" name="jabatan[]"
                                        placeholder="Jabatan Terlapor">
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="exampleInputPassword1" class="form-label">Kesatuan Terlapor</label>
                                    <input type="text" class="form-control" name="kesatuan[]"
                                        placeholder="Kesatuan Terlapor">
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

@section('scripts')
    {{-- <script src="https://cdn.ckeditor.com/ckeditor5/36.0.1/classic/ckeditor.js"></script> --}}
    {{-- <script src="https://cdn.ckeditor.com/ckeditor5/36.0.1/decoupled-document/ckeditor.js"></script> --}}
    {{-- <script src="https://cdn.ckeditor.com/ckeditor5/36.0.1/inline/ckeditor.js"></script> --}}
    {{-- <script src="https://cdn.ckeditor.com/ckeditor5/36.0.1/classic/ckeditor.js"></script> --}}



    {{-- <script src="{{ asset('ckeditor/build/ckeditor.js') }}"></script> --}}
    <script>
        $(document).ready(function() {
            $('#tambah').on('click', function() {
                var counter = $(this).attr('counter');
                var counter = parseInt(counter) + 1;
                tambahTerlapor(counter);
                $(this).attr('counter', counter);
            });

            function tambahTerlapor(counter) {
                let inHtml =
                    `<div id="baris${counter}">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="exampleInputPassword1" class="form-label">NRP Terlapor</label>
                            <input type="text" class="form-control" name="nrp[]" id="nrp_${counter}" placeholder="NRP Terlapor">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="exampleInputPassword1" class="form-label">Nama Terlapor</label>
                            <input type="text" class="form-control" name="nama[]" id="nama_${counter}" placeholder="Nama Terlapor">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label for="exampleInputPassword1" class="form-label">Pangkat Terlapor</label>
                            <input type="text" class="form-control" name="pangkat[]" id="pangkat_${counter}" placeholder="Pangkat Terlapor">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="exampleInputPassword1" class="form-label">Jabatan Terlapor</label>
                            <input type="text" class="form-control" name="jabatan[]" id="jabatan_${counter}" placeholder="Jabatan Terlapor">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="exampleInputPassword1" class="form-label">Kesatuan Terlapor</label>
                            <input type="text" class="form-control" name="kesatuan[]" id="kesatuan_${counter}" placeholder="Kesatuan Terlapor">
                        </div>
                        <div class="col-12 mb-3">
                            <button type="button" class="btn btn-danger hapus btn-sm text-white col-12" counter="${counter}"><span class="fa fa-trash"></span> Hapus Terlapor</button>
                        </div>
                    </div>
                    <hr>
                    </div>`;
                $('#form_input_terlapor').append(inHtml);

                $('.hapus').on('click', function() {
                    var counter = $(this).attr('counter');
                    console.log('hapussss', counter)

                    $('#baris' + counter).remove();
                })
            }

            // ClassicEditor
            //     .create(document.querySelector('#editor'))
            //     .catch(error => {
            //         console.error(error);
            //     });
            // var page_status = $('#page_status').val();
            // if (page_status == 1){
            //     console.log('refresh')
            //     cek_status_update_refresh();
            // }else{
            //     console.log('not refresh')
            //     cek_status_update();
            // }

            let process_id = $('#process_id').val()
            getViewProcess(process_id)

        });
    </script>
    <script>
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
            }).done(function(data) {
                $('.loader-view').css("display", "none");
                $("#viewProses").html(data)
            });
        }

        function getValue() {
            console.log($('#editor').text())
        }
    </script>
@endsection
