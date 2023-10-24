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
