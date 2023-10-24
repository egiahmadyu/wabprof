@extends('partials.master')

@prepend('styles')
    <link href="{{ asset('assets/css/dashboard.css') }}" rel="stylesheet" type="text/css" />
    <style>
        #chartdiv {
            width: 100%;
            height: 350px;
        }

        #chart_tim {
            width: 100%;
            height: 350px;
        }

        #chart_polda {
            width: 100%;
            height: 350px;
        }
    </style>
@endprepend


@section('content')
    <div class="row">
        <div class="col">

            <div class="h-100">
                <div class="row">
                    <div class="col-xl-4">
                        <div class="row">
                            <div class="col-xl-12 col-md-6">
                                <!-- card -->
                                <div class="card card-animate">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between">
                                            <div class="flex-grow-1">
                                                <p class="text-uppercase fw-medium text-muted text-truncate fs-13">Total
                                                    Pelanggaran</p>
                                                <h4 class="fs-22 fw-semibold mb-3"><span class="counter-value"
                                                        data-target="{{ $pelanggar->count() }}">0</span></h4>

                                            </div>
                                            <div class="avatar-sm flex-shrink-0">
                                                <span class="avatar-title bg-soft-success rounded fs-3">
                                                    <i class="bx bx-male-female text-success"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div><!-- end card body -->
                                    <div class="animation-effect-6 text-success opacity-25 fs-18">
                                        <i class="bi bi-binoculars-fill"></i>
                                    </div>
                                    <div class="animation-effect-4 text-success opacity-25 fs-18">
                                        <i class="bi bi-circle-square"></i>
                                    </div>
                                    <div class="animation-effect-3 text-success opacity-25 fs-18">
                                        <i class="bi bi-dash-circle-fill"></i>
                                    </div>
                                </div><!-- end card -->
                            </div><!-- end col -->

                            <div class="col-xl-12 col-md-6">
                                <!-- card -->
                                <div class="card card-animate">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between">
                                            <div class="avatar-sm flex-shrink-0">
                                                <span class="avatar-title bg-soft-info rounded fs-3">
                                                    <i class="bx bx-shopping-bag text-info"></i>
                                                </span>
                                            </div>
                                            <div class="text-end flex-grow-1">
                                                <p class="text-uppercase fw-medium text-muted text-truncate fs-13">
                                                    Pelanggaran Dihentikan
                                                </p>
                                                <h4 class="fs-22 fw-semibold mb-3"><span class="counter-value"
                                                        data-target="{{ $pelanggar_dihentikan->count() }}">0</span> </h4>
                                            </div>
                                        </div>
                                    </div><!-- end card body -->
                                    <div class="animation-effect-6 text-info opacity-25 left fs-18">
                                        <i class="bi bi-handbag"></i>
                                    </div>
                                    <div class="animation-effect-4 text-info opacity-25 left fs-18">
                                        <i class="bi bi-shop"></i>
                                    </div>
                                    <div class="animation-effect-3 text-info opacity-25 left fs-18">
                                        <i class="bi bi-bag-check"></i>
                                    </div>
                                </div><!-- end card -->
                            </div><!-- end col -->

                            <div class="col-xl-12 col-md-6">
                                <!-- card -->
                                <div class="card card-animate">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between">
                                            <div class="flex-grow-1">
                                                <p class="text-uppercase fw-medium text-muted text-truncate fs-13">Data
                                                    Diproses
                                                </p>
                                                <h4 class="fs-22 fw-semibold mb-3"><span class="counter-value"
                                                        data-target="{{ $pelanggar->count() - $pelanggar_dihentikan->count() }}">0</span>
                                                </h4>

                                            </div>
                                            <div class="avatar-sm flex-shrink-0">
                                                <span class="avatar-title bg-soft-warning rounded fs-3">
                                                    <i class="bx bx-user-circle text-warning"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div><!-- end card body -->
                                    <div class="animation-effect-6 text-warning opacity-25 fs-18">
                                        <i class="bi bi-person"></i>
                                    </div>
                                    <div class="animation-effect-4 text-warning opacity-25 fs-18">
                                        <i class="bi bi-person-fill"></i>
                                    </div>
                                    <div class="animation-effect-3 text-warning opacity-25 fs-18">
                                        <i class="bi bi-people"></i>
                                    </div>
                                </div><!-- end card -->
                            </div><!-- end col -->
                        </div> <!-- end row-->
                    </div>
                    <div class="col-xl-8">
                        <div class="card">
                            <div class="card-header border-0 align-items-center d-flex">
                                <h4 class="card-title mb-0 flex-grow-1">Grafik Data Perbulan</h4>
                            </div><!-- end card header -->



                            <div class="card-body p-0 pb-2">
                                <div class="w-100">
                                    <div id="chartdiv" data-colors='["--tb-dark", "--tb-primary", "--tb-secondary"]'
                                        class="apex-charts" dir="ltr"></div>
                                </div>
                            </div><!-- end card body -->
                        </div><!-- end card -->
                    </div><!-- end col -->
                </div>

                <div class="row">

                    <div class="col-xl-12">
                        <div class="card">
                            <div class="card-header align-items-center d-flex">
                                <h4 class="card-title mb-0 flex-grow-1">Data Pelanggar</h4>

                            </div><!-- end card header -->

                            <div class="card-body">
                                <div class="table table-bordered dt-responsive nowrap table-striped align-middle"
                                    style="width:100%">
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

                <div class="row">
                    <div class="col-xl-4">
                        <div class="card">
                            <div class="card-header d-flex">
                                <h5 class="card-title flex-grow-1 mb-0">Chart Tim Penyidik</h5>

                            </div>
                            <div class="card-body px-0">
                                <div id="chart_tim"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-8">
                        <div class="card">
                            <div class="card-header d-flex">
                                <h5 class="card-title flex-grow-1 mb-0">Pelanggar Terbanyak Berdasarkan Polda</h5>
                                {{-- <a href="#!" class="flex-shrink-0">View All <i
                                        class="ri-arrow-right-line align-bottom ms-1"></i></a> --}}
                            </div>
                            <div class="card-body px-0">
                                <div id="chart_polda">

                                </div>
                            </div>
                        </div>
                    </div>
                </div> <!-- end row-->

                <div class="row">
                    <div class="col-xl-4">
                        <div class="card card-height-100">
                            <div class="card-header align-items-center d-flex">
                                <h4 class="card-title mb-0 flex-grow-1">Sales by Category</h4>
                                <div class="flex-shrink-0">
                                    <div class="dropdown card-header-dropdown">
                                        <a class="text-reset dropdown-btn" href="#" data-bs-toggle="dropdown"
                                            aria-haspopup="true" aria-expanded="false">
                                            <span class="text-muted">Report<i
                                                    class="mdi mdi-chevron-down ms-1"></i></span>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-end">
                                            <a class="dropdown-item" href="#">Download Report</a>
                                            <a class="dropdown-item" href="#">Export</a>
                                            <a class="dropdown-item" href="#">Import</a>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- end card header -->

                            <div class="card-body">
                                <div id="multiple_radialbar"
                                    data-colors='["--tb-primary", "--tb-info", "--tb-success", "--tb-secondary"]'
                                    class="apex-charts" dir="ltr"></div>
                            </div>
                        </div> <!-- .card-->
                    </div> <!-- .col-->

                    <div class="col-xl-8">
                        <div class="card">
                            <div class="card-header align-items-center d-flex">
                                <h4 class="card-title mb-0 flex-grow-1">Stock Report</h4>
                                <div class="flex-shrink-0">
                                    <button type="button" class="btn btn-soft-info btn-sm">
                                        <i class="ri-file-list-3-line align-middle"></i> Generate Report
                                    </button>
                                </div>
                            </div><!-- end card header -->

                            <div class="card-body">
                                <div class="table-responsive table-card">
                                    <table
                                        class="table table-borderless table-centered table-hover align-middle table-nowrap mb-0">
                                        <thead class="text-muted table-light">
                                            <tr>
                                                <th scope="col">Product ID</th>
                                                <th scope="col">Product Name</th>
                                                <th scope="col">Updated Date</th>
                                                <th scope="col">Amount</th>
                                                <th scope="col">Stock Status</th>
                                                <th scope="col">Quantity</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <a href="#!" class="fw-medium link-primary">#00541</a>
                                                </td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <div class="flex-shrink-0 me-2">
                                                            <img src="assets/images/products/img-1.png" alt=""
                                                                class="avatar-xs rounded-circle" />
                                                        </div>
                                                        <div class="flex-grow-1">Rockerz Ear Bluetooth Headphones</div>
                                                    </div>
                                                </td>
                                                <td>16 Aug, 2022</td>
                                                <td>
                                                    <span class="text-secondary">$658.00</span>
                                                </td>
                                                <td>
                                                    <span class="badge badge-soft-success">In Stock</span>
                                                </td>
                                                <td>15 PCS</td>
                                            </tr><!-- end tr -->
                                            <tr>
                                                <td>
                                                    <a href="#!" class="fw-medium link-primary">#07484</a>
                                                </td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <div class="flex-shrink-0 me-2">
                                                            <img src="assets/images/products/img-5.png" alt=""
                                                                class="avatar-xs rounded-circle" />
                                                        </div>
                                                        <div class="flex-grow-1">United Colors Of Benetton</div>
                                                    </div>
                                                </td>
                                                <td>05 Sep, 2022</td>
                                                <td>
                                                    <span class="text-secondary">$145.00</span>
                                                </td>
                                                <td>
                                                    <span class="badge badge-soft-warning">Low Stock</span>
                                                </td>
                                                <td>05 PCS</td>
                                            </tr><!-- end tr -->
                                            <tr>
                                                <td>
                                                    <a href="#!" class="fw-medium link-primary">#01641</a>
                                                </td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <div class="flex-shrink-0 me-2">
                                                            <img src="assets/images/products/img-4.png" alt=""
                                                                class="avatar-xs rounded-circle" />
                                                        </div>
                                                        <div class="flex-grow-1">Striped Baseball Cap</div>
                                                    </div>
                                                </td>
                                                <td>28 Sep, 2022</td>
                                                <td>
                                                    <span class="text-secondary">$215.00</span>
                                                </td>
                                                <td>
                                                    <span class="badge badge-soft-danger">Out of Stock</span>
                                                </td>
                                                <td>0 PCS</td>
                                            </tr><!-- end tr -->
                                            <tr>
                                                <td>
                                                    <a href="#!" class="fw-medium link-primary">#00065</a>
                                                </td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <div class="flex-shrink-0 me-2">
                                                            <img src="assets/images/products/img-3.png" alt=""
                                                                class="avatar-xs rounded-circle" />
                                                        </div>
                                                        <div class="flex-grow-1">350 ml Glass Grocery Container</div>
                                                    </div>
                                                </td>
                                                <td>02 Oct, 2022</td>
                                                <td>
                                                    <span class="text-secondary">$79.99</span>
                                                </td>
                                                <td>
                                                    <span class="badge badge-soft-success">In Stock</span>
                                                </td>
                                                <td>37 PCS</td>
                                            </tr><!-- end tr -->
                                            <tr>
                                                <td>
                                                    <a href="#!" class="fw-medium link-primary">#00156</a>
                                                </td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <div class="flex-shrink-0 me-2">
                                                            <img src="assets/images/products/img-2.png" alt=""
                                                                class="avatar-xs rounded-circle" />
                                                        </div>
                                                        <div class="flex-grow-1">One Seater Sofa</div>
                                                    </div>
                                                </td>
                                                <td>11 Oct, 2022</td>
                                                <td>
                                                    <span class="text-secondary">$264.99</span>
                                                </td>
                                                <td>
                                                    <span class="badge badge-soft-success">In Stock</span>
                                                </td>
                                                <td>23 PCS</td>
                                            </tr><!-- end tr -->
                                            <tr>
                                                <td>
                                                    <a href="#!" class="fw-medium link-primary">#09102</a>
                                                </td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <div class="flex-shrink-0 me-2">
                                                            <img src="assets/images/products/img-8.png" alt=""
                                                                class="avatar-xs rounded-circle" />
                                                        </div>
                                                        <div class="flex-grow-1">Men's Running Shoes Active Grip</div>
                                                    </div>
                                                </td>
                                                <td>19 Nov, 2022</td>
                                                <td>
                                                    <span class="text-secondary">$264.99</span>
                                                </td>
                                                <td>
                                                    <span class="badge badge-soft-warning">Low Stock</span>
                                                </td>
                                                <td>23 PCS</td>
                                            </tr><!-- end tr -->
                                        </tbody><!-- end tbody -->
                                    </table><!-- end table -->
                                </div>
                            </div>
                        </div> <!-- .card-->
                    </div> <!-- .col-->
                </div> <!-- end row-->

                <div class="row">
                    <div class="col-xl-12">
                        <!-- card -->
                        <div class="card card-height-100">
                            <div class="card-header align-items-center d-flex">
                                <h4 class="card-title mb-0 flex-grow-1">Top Retail Sales Location</h4>
                                <div class="flex-shrink-0">
                                    <button type="button" class="btn btn-soft-primary btn-sm">
                                        Export Report
                                    </button>
                                </div>
                            </div><!-- end card header -->

                            <!-- card body -->
                            <div class="card-body">

                                <div class="row">
                                    <div class="col-lg-8">
                                        <div id="world-map-line-markers" data-colors='["--tb-light"]'
                                            style="height: 420px"></div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="mb-4">
                                            <h6 class="text-muted mb-3 fw-medium fs-12 text-uppercase">All Users Statistics
                                            </h6>
                                            <h4>1,87,42,102 <small class="text-muted fw-normal fs-13">users</small></h4>
                                        </div>
                                        <div>
                                            <p class="mb-2 fw-medium">Current Activity</p>
                                            <div class="progress mb-4">
                                                <div class="progress-bar" role="progressbar" aria-label="Segment one"
                                                    style="width: 8%" aria-valuenow="8" aria-valuemin="0"
                                                    aria-valuemax="100"></div>
                                                <div class="progress-bar bg-success" role="progressbar"
                                                    aria-label="Segment two" style="width: 20%" aria-valuenow="20"
                                                    aria-valuemin="0" aria-valuemax="100"></div>
                                                <div class="progress-bar bg-info" role="progressbar"
                                                    aria-label="Segment three" style="width: 14%" aria-valuenow="14"
                                                    aria-valuemin="0" aria-valuemax="100"></div>
                                                <div class="progress-bar bg-danger" role="progressbar"
                                                    aria-label="Segment three" style="width: 7%" aria-valuenow="7"
                                                    aria-valuemin="0" aria-valuemax="100"></div>
                                                <div class="progress-bar bg-secondary" role="progressbar"
                                                    aria-label="Segment three" style="width: 25%" aria-valuenow="25"
                                                    aria-valuemin="0" aria-valuemax="100"></div>
                                                <div class="progress-bar bg-dark" role="progressbar"
                                                    aria-label="Segment three" style="width: 10%" aria-valuenow="10"
                                                    aria-valuemin="0" aria-valuemax="100"></div>
                                                <div class="progress-bar bg-warning" role="progressbar"
                                                    aria-label="Segment three" style="width: 2%" aria-valuenow="2"
                                                    aria-valuemin="0" aria-valuemax="100"></div>
                                                <div class="progress-bar bg-light" role="progressbar"
                                                    aria-label="Segment three" style="width: 14%" aria-valuenow="14"
                                                    aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>

                                            <p><i class="ri-checkbox-blank-circle-fill text-primary align-bottom me-1"></i>
                                                Canada <span class="float-end">8%</span></p>
                                            <p><i
                                                    class="ri-checkbox-blank-circle-fill text-success align-bottom me-1"></i>Greenland
                                                <span class="float-end">20%</span>
                                            </p>
                                            <p><i class="ri-checkbox-blank-circle-fill text-info align-bottom me-1"></i>US
                                                <span class="float-end">14%</span>
                                            </p>
                                            <p><i
                                                    class="ri-checkbox-blank-circle-fill text-secondary align-bottom me-1"></i>Russia
                                                <span class="float-end">25%</span>
                                            </p>
                                            <p><i
                                                    class="ri-checkbox-blank-circle-fill text-danger align-bottom me-1"></i>Brazil
                                                <span class="float-end">7%</span>
                                            </p>
                                            <p><i
                                                    class="ri-checkbox-blank-circle-fill text-dark align-bottom me-1"></i>Sydney
                                                <span class="float-end">10%</span>
                                            </p>
                                            <p><i
                                                    class="ri-checkbox-blank-circle-fill text-warning align-bottom me-1"></i>Norway<span
                                                    class="float-end">2%</span></p>
                                            <p><i
                                                    class="ri-checkbox-blank-circle-fill text-light align-bottom me-1"></i>China
                                                <span class="float-end">14%</span>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- end card body -->
                        </div>
                        <!-- end card -->
                    </div>
                    <!-- end col -->
                </div>

            </div> <!-- end .h-100-->

        </div> <!-- end col -->
    </div>
@endsection

@section('scripts')
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>

    <script src="https://cdn.amcharts.com/lib/5/index.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/xy.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/themes/Animated.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/hierarchy.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/percent.js"></script>
    <script>
        $(document).ready(function() {
            getData();
        });

        function lineChartPelanggar() {
            var labels = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des', ''];
            var users = [100, 50, 11, 34, 86, 56, 2, 36, 50, 20, 10, 150];

            const data = {
                labels: labels,
                datasets: [{
                    label: 'Statistik Jumlah Pelanggar tahun 2022',
                    backgroundColor: 'rgb(255, 99, 132)',
                    borderColor: 'rgb(255, 99, 132)',
                    data: users,
                }]
            };

            const config = {
                type: 'line',
                data: data,
                options: {}
            };

            const myChart = new Chart(
                document.getElementById('lineChartPelanggar'),
                config
            );
        }

        function donatChartPelanggar() {
            var labels = ['Metro Jaya', 'Jabar', 'Jateng', 'Jatim'];
            var users = [50, 20, 75, 25];

            const data = {
                labels: labels,
                datasets: [{
                    label: 'Jumlah Pelanggar',
                    backgroundColor: [
                        'rgb(255, 99, 132)',
                        'rgb(54, 162, 235)',
                        'rgb(50, 205, 50)',
                        'rgb(255, 255, 0)'
                    ],
                    data: users,
                }]
            };

            const config = {
                type: 'polarArea',
                data: data,
                options: {}
            };

            const myChart = new Chart(
                document.getElementById('donatChartPelanggar'),
                config
            );
        }

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
            })
            $('#kt_search').on('click', function(e) {
                e.preventDefault();
                table.table().draw();
            });
        }
    </script>

    <script>
        am5.ready(function() {
            var root = am5.Root.new("chartdiv");
            // Set themes
            // https://www.amcharts.com/docs/v5/concepts/themes/
            root.setThemes([
                am5themes_Animated.new(root)
            ]);


            // Create chart
            // https://www.amcharts.com/docs/v5/charts/xy-chart/
            var chart = root.container.children.push(am5xy.XYChart.new(root, {
                panX: false,
                panY: false,
                wheelX: "none",
                wheelY: "none",
                layout: root.verticalLayout
            }));


            // Data
            var data_chart = {!! json_encode($chart_pelanggaran) !!};
            console.log(data_chart)
            var data = data_chart

            // Populate data
            for (var i = 0; i < (data.length - 1); i++) {
                data[i].valueNext = data[i + 1].value;
            }


            // Create axes
            // https://www.amcharts.com/docs/v5/charts/xy-chart/axes/
            var xRenderer = am5xy.AxisRendererX.new(root, {
                cellStartLocation: 0.1,
                cellEndLocation: 0.9,
                minGridDistance: 30
            });

            var xAxis = chart.xAxes.push(am5xy.CategoryAxis.new(root, {
                categoryField: "nama_bulan",
                renderer: xRenderer,
                tooltip: am5.Tooltip.new(root, {})
            }));

            xRenderer.grid.template.setAll({
                location: 1
            })

            xAxis.data.setAll(data);

            var yAxis = chart.yAxes.push(am5xy.ValueAxis.new(root, {
                min: 0,
                renderer: am5xy.AxisRendererY.new(root, {
                    strokeOpacity: 0.1
                })
            }));


            // Add series
            // https://www.amcharts.com/docs/v5/charts/xy-chart/series/

            // Column series
            var series = chart.series.push(am5xy.ColumnSeries.new(root, {
                xAxis: xAxis,
                yAxis: yAxis,
                valueYField: "value",
                categoryXField: "nama_bulan"
            }));

            series.columns.template.setAll({
                tooltipText: "{categoryX}: {valueY}",
                width: am5.percent(90),
                tooltipY: 0
            });

            series.data.setAll(data);

            // Variance indicator series
            var series2 = chart.series.push(am5xy.ColumnSeries.new(root, {
                xAxis: xAxis,
                yAxis: yAxis,
                valueYField: "valueNext",
                openValueYField: "value",
                categoryXField: "nama_bulan",
                fill: am5.color(0x555555),
                stroke: am5.color(0x555555)
            }));

            series2.columns.template.setAll({
                width: 1
            });

            series2.data.setAll(data);

            series2.bullets.push(function() {
                var label = am5.Label.new(root, {
                    text: "{valueY}",
                    fontWeight: "500",
                    fill: am5.color(0x00cc00),
                    centerY: am5.p100,
                    centerX: am5.p50,
                    populateText: true
                });

                // Modify text of the bullet with percent
                label.adapters.add("text", function(text, target) {
                    var percent = getVariancePercent(target.dataItem);
                    return percent ? percent + "%" : text;
                });

                // Set dynamic color of the bullet
                label.adapters.add("centerY", function(center, target) {
                    return getVariancePercent(target.dataItem) < 0 ? 0 : center;
                });

                // Set dynamic color of the bullet
                label.adapters.add("fill", function(fill, target) {
                    return getVariancePercent(target.dataItem) < 0 ? am5.color(0xcc0000) : fill;
                });

                return am5.Bullet.new(root, {
                    locationY: 1,
                    sprite: label
                });
            });

            series2.bullets.push(function() {
                var arrow = am5.Graphics.new(root, {
                    rotation: -90,
                    centerX: am5.p50,
                    centerY: am5.p50,
                    dy: 3,
                    fill: am5.color(0x555555),
                    stroke: am5.color(0x555555),
                    draw: function(display) {
                        display.moveTo(0, -3);
                        display.lineTo(8, 0);
                        display.lineTo(0, 3);
                        display.lineTo(0, -3);
                    }
                });

                arrow.adapters.add("rotation", function(rotation, target) {
                    return getVariancePercent(target.dataItem) < 0 ? 90 : rotation;
                });

                arrow.adapters.add("dy", function(dy, target) {
                    return getVariancePercent(target.dataItem) < 0 ? -3 : dy;
                });

                return am5.Bullet.new(root, {
                    locationY: 1,
                    sprite: arrow
                })
            })


            // Make stuff animate on load
            // https://www.amcharts.com/docs/v5/concepts/animations/
            series.appear();
            chart.appear(1000, 100);


            function getVariancePercent(dataItem) {
                if (dataItem) {
                    var value = dataItem.get("valueY");
                    var openValue = dataItem.get("openValueY");
                    var change = value - openValue;
                    return Math.round(change / openValue * 100);
                }
                return 0;
            }
        })
    </script>

    <script>
        am5.ready(function() {
            var root = am5.Root.new("chart_polda");


            // Set themes
            // https://www.amcharts.com/docs/v5/concepts/themes/
            root.setThemes([
                am5themes_Animated.new(root)
            ]);


            // Create chart
            // https://www.amcharts.com/docs/v5/charts/percent-charts/sliced-chart/
            var chart = root.container.children.push(am5percent.SlicedChart.new(root, {
                layout: root.verticalLayout
            }));


            // Create series
            // https://www.amcharts.com/docs/v5/charts/percent-charts/sliced-chart/#Series
            var series = chart.series.push(am5percent.FunnelSeries.new(root, {
                alignLabels: false,
                orientation: "vertical",
                valueField: "value",
                categoryField: "kesatuan"
            }));


            // Set data
            // https://www.amcharts.com/docs/v5/charts/percent-charts/sliced-chart/#Setting_data
            var data_chart = {!! json_encode($polda) !!};
            series.data.setAll(data_chart);


            // Play initial series animation
            // https://www.amcharts.com/docs/v5/concepts/animations/#Animation_of_series
            series.appear();


            // Create legend
            // https://www.amcharts.com/docs/v5/charts/percent-charts/legend-percent-series/
            var legend = chart.children.push(am5.Legend.new(root, {
                centerX: am5.p50,
                x: am5.p50,
                marginTop: 15,
                marginBottom: 15
            }));

            legend.data.setAll(series.dataItems);


            // Make stuff animate on load
            // https://www.amcharts.com/docs/v5/concepts/animations/
            chart.appear(1000, 100);
        })
    </script>

    <script>
        am5.ready(function() {


            var root = am5.Root.new("chart_tim");

            // Set themes
            // https://www.amcharts.com/docs/v5/concepts/themes/
            root.setThemes([
                am5themes_Animated.new(root)
            ]);
            var dat_chart = {!! $penyidik !!};

            var data = {
                value: 0,
                children: dat_chart
            };

            // Create wrapper container
            var container = root.container.children.push(am5.Container.new(root, {
                width: am5.percent(100),
                height: am5.percent(100),
                layout: root.verticalLayout
            }));

            // Create series
            // https://www.amcharts.com/docs/v5/charts/hierarchy/#Adding
            var series = container.children.push(am5hierarchy.ForceDirected.new(root, {
                singleBranchOnly: false,
                downDepth: 2,
                topDepth: 1,
                initialDepth: 1,
                valueField: "value",
                categoryField: "name",
                childDataField: "children",
                idField: "name",
                linkWithField: "linkWith",
                manyBodyStrength: -10,
                centerStrength: 0.8,
                minRadius: 20,
                maxRadius: am5.percent(15)
            }));

            series.get("colors").setAll({
                step: 2
            });

            series.links.template.set("strength", 1);

            series.data.setAll([data]);

            series.set("selectedDataItem", series.dataItems[0]);


            // Make stuff animate on load
            series.appear(1000, 100);
        })
    </script>
@endsection
