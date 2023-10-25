@extends('partials.master')

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

@push('scripts')
    <script type="text/javascript">
        $(document).ready(function() {

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

            $('#input-pelanggar').validate({
                rules: {
                    no_nota_dinas: {
                        required: true,
                    },
                    perihal_nota_dinas: {
                        required: true,
                    },
                    id_wujud_perbuatan: {
                        required: true,
                    },
                    tanggal_nota_dinas: {
                        required: true,
                    },
                    pelapor: {
                        required: true,
                    },
                    umur: {
                        required: true,
                    },
                    jenis_kelamin: {
                        required: true,
                    },
                    pekerjaan: {
                        required: true,
                    },
                    agama: {
                        required: true,
                    },
                    no_identitas: {
                        required: true,
                    },
                    jenis_identitas: {
                        required: true,
                    },
                    alamat: {
                        required: true,
                    },
                    terlapor: {
                        required: true,
                    },
                    jenis_kelamin: {
                        required: true,
                    },
                    id_pangkat: {
                        required: true,
                    },
                    nrp: {
                        required: true,
                    },
                    suku: {
                        required: true,
                    },
                    agama_terlapor: {
                        required: true,
                    },
                    no_telp: {
                        required: true,
                    },
                    jabatan: {
                        required: true,
                    },
                    kesatuan: {
                        required: true,
                    },
                    alamat_terlapor: {
                        required: true,
                    },
                    tempat_kejadian: {
                        required: true,
                    },
                    tanggal_kejadian: {
                        required: true,
                    },
                    nama_korban: {
                        required: true,
                    },
                    kronologis: {
                        required: true,
                    },
                    no_hp: {
                        required: true,
                    },
                    tempat_lahir: {
                        required: true,
                    },
                    tanggal_lahir: {
                        required: true,
                    },
                    pendidikan_terakhir: {
                        required: true,
                    },
                    alamat_tempat_tinggal: {
                        required: true,
                    },
                },
                messages: {
                    no_nota_dinas: "Silahkan isi No. Nota Dinas!",
                    perihal_nota_dinas: "Silahkan isi Perihal Nota Dinas!",
                    id_wujud_perbuatan: "Silahkan Pilih Wujud Perbuatan!",
                    tanggal_nota_dinas: "Silahkan isi Tanggal Nota Dinas!",
                    pelapor: "Silahkan isi Pelapor!",
                    umur: "Silahkan isi Umur!",
                    jenis_kelamin: "Silahkan isi Jenis Kelamin!",
                    no_telp: "Silahkan isi No. Telephone!",
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
                    no_hp: "Silahkan Isi Nomor Handphone!",
                    pendidikan_terakhir: "Silahkan Isi Peniddian Terakhir!",
                    tempat_lahir: "Silahkan Isi Tempat Lahir!",
                    tanggal_lahir: "Silahkan Isi Tanggal Lahir!",
                    alamat_tempat_tinggal: "Silahkan Isi Alamat Tempat Tinggal!",
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
                }
            });
        });
        $(function() {
            $.datePicker.defaults = {

                container: 'body',
                mode: '<a href="https://www.jqueryscript.net/tags.php?/popup/">popup</a>', // or inline
                select: 'single', // single or multiple
                theme: 'theme-light', // theme-light or theme-dark
                show: 'month', // decade, year or month
                doubleSize: false,
                restrictDates: false, // past, future or custom
                strings: {
                    months: [
                        'January',
                        'February',
                        'March',
                        'April',
                        'May',
                        'June',
                        'July',
                        'August',
                        'September',
                        'October',
                        'November',
                        'December'
                    ],
                    days: [
                        'Sunday',
                        'Monday',
                        'Tuesday',
                        'Wednesday',
                        'Thursday',
                        'Friday',
                        'Saturday'
                    ]
                },
                views: {
                    decade: {
                        show: null,
                        selected: [],
                        disabled: [],
                        forbidden: [],
                        enabled: [],
                        marked: []
                    },
                    year: {
                        show: null,
                        selected: [],
                        disabled: [],
                        forbidden: [],
                        enabled: [],
                        marked: []
                    },
                    month: {
                        show: null,
                        selected: [],
                        disabled: [],
                        forbidden: [],
                        enabled: [],
                        marked: [],
                        firstDayOfWeek: 0
                    }
                },
                templates: {
                    widget: '<div class="jquery-datepicker">',
                    header: '<div class="box-row row-header"><div class="header-title">{title}</div><div class="header-actions"><div class="header-action action-down"></div><div class="header-action action-up"></div></div></div>'
                },
                dateFormat: function(date) {
                    return (date.getMonth() + 1) + '-' + date.getDate() + '-' + date.getFullYear();
                },
                dateParse: function(string) {
                    return $.datePicker.api.date(string);
                }
            }
        });
    </script>
@endpush
