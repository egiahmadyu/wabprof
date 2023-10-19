@extends('partials.master')

@section('content')
    <div class="row">
        <div class="col-xl-12 col-md-12 col-lg-12">

            <div class="row">
                <div class="col-lg-4 col-sm-6">
                    <div class="card-box bg-blue">
                        <div class="inner">
                            <h1> {{ isset($diterima) ? count($diterima) : 0 }} </h1>
                            <h5> Pengaduan Diterima </h5>
                        </div>
                        <div class="icon">
                            <i class="fa fa-gavel f-left" aria-hidden="true"></i>
                        </div>
                        <a href="#" class="card-box-footer">
                            <h6>Lihat Selengkapnya <i class="fa fa-arrow-circle-right"></i></h6>
                        </a>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6">
                    <div class="card-box bg-orange">
                        <div class="inner">
                            <h1> {{ isset($diproses) ? count($diproses) : 0 }} </h1>
                            <h5> Pengaduan Diproses </h5>
                        </div>
                        <div class="icon">
                            <i class="fa fa-sync-alt fa-spin" aria-hidden="true"></i>
                        </div>
                        <a href="#" class="card-box-footer">
                            <h6> Lihat Selengkapnya <i class="fa fa-arrow-circle-right"></i> </h6>
                        </a>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6">
                    <div class="card-box bg-red">
                        <div class="inner">
                            <h1> {{ isset($selesai) ? count($selesai) : 0 }} </h1>
                            <h5> Pengaduan Selesai </h5>
                        </div>
                        <div class="icon">
                            <i class="fad fa-clipboard-check fa-swap-opacity"></i>
                        </div>
                        <a href="#" class="card-box-footer">
                            <h6> Lihat Selengkapnya <i class="fa fa-arrow-circle-right"></i> </h6>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Data Kasus</h4>

                </div><!-- end card header -->

                <div class="card-body">
                    <div class="table-responsive table-card px-3">
                        <table class="table mb-0" id="data-data">
                            <thead class="text-muted table-light">
                                <tr>
                                    <th scope="col">No Nota Dinas</th>
                                    <th scope="col">Tanggal</th>
                                    <th scope="col">Pelapor</th>
                                    <th scope="col">Terlapor</th>
                                    <th scope="col">Pangkat</th>
                                    <th scope="col">Jabatan</th>
                                    <th scope="col">Nama Korban</th>
                                    <th scope="col">Status</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
    <script>
        $(document).ready(function() {
            getData()
        });

        function getData() {
            var table = $('#data-data').DataTable({
                processing: true,
                serverSide: true,
                searching: true,
                ajax: {
                    url: "{{ route('kasus.data') }}",
                    method: "post",
                    data: function(data) {
                        data._token = '{{ csrf_token() }}'
                        // data.polda = $('#polda').val(),
                        // data.jenis_kelamin = $('#jenis_kelamin').val(),
                        // data.jenis_pelanggaran = $('#jenis_pelanggaran').val(),
                        // data.pangkat = $('#pangkat').val(),
                        // data.wujud_perbuatan = $('#wujud_perbuatan').val()
                    }
                },
                columns: [
                    // {
                    //     data: 'DT_RowIndex',
                    //     name: 'DT_RowIndex',
                    //     orderable: false,
                    //     searchable: false
                    // },
                    {
                        data: 'no_nota_dinas',
                        name: 'no_nota_dinas'
                    },
                    {
                        data: 'tanggal_kejadian',
                        name: 'tanggal_kejadian'
                    },
                    {
                        data: 'pelapor',
                        name: 'pelapor'
                    },
                    {
                        data: 'terlapor',
                        name: 'terlapor'
                    },
                    {
                        data: 'pangkats.name',
                        name: 'pangkats.name'
                    },
                    {
                        data: 'jabatan',
                        name: 'jabatan'
                    },
                    {
                        data: 'nama_korban',
                        name: 'nama_korban'
                    },
                    {
                        data: 'processes.name',
                        name: 'processes.name'
                    },
                ]
            });
            $('#kt_search').on('click', function(e) {
                e.preventDefault();
                table.table().draw();
            });
        }
    </script>
@endsection
