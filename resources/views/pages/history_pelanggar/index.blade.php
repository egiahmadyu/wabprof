@extends('partials.master')

@prepend('styles')
    <style>
        *,
        ::after,
        ::before {
            box-sizing: border-box;
        }


        .timeline {
            --timeline-color: #9bc;
            position: relative;
            list-style: none;
            display: inline-flex;
            flex-wrap: nowrap;
            margin: 0;
            padding: 0;

            /* set here the height of the timeline */
            height: 240px;
        }

        /* middle line */
        .timeline:before {
            content: "";
            position: absolute;
            top: calc(50% - 1px);
            width: 100%;
            height: 2px;
            background: var(--timeline-color);
        }

        .timeline li {
            margin: 0;
            min-width: 200px;
            align-self: flex-start;
        }

        .timeline li:not(:last-child) {
            margin: 0 -50px 0 0;
        }

        /*  event in even position are bottom-aligned */
        .timeline li:nth-child(2n) {
            align-self: flex-end;
        }

        .timeline div {
            position: relative;
            padding: 10px;
            border: 1px var(--timeline-color) solid;
        }

        /* style for the dot over the timeline */
        .timeline li:before {
            content: "";
            position: absolute;
            top: 50%;
            margin-left: 100px;
            transform: translate(-50%, -50%);
            border: 1px #9bc solid;
            width: 10px;
            height: 10px;
            border-radius: 50%;
            background: var(--timeline-color);

        }

        /* style for the event arrow */
        .timeline div:before {
            content: "";
            position: absolute;
            left: 50%;
            top: 100%;
            width: 20px;
            height: 20px;
            transform: translate(-50%, -1px) rotateZ(45deg);
            background: #fff;
        }

        /* position of the event arrow in odd position */
        .timeline li:nth-child(2n - 1) div:before {
            top: 100%;
            margin-top: -8px;
            border-right: 1px var(--timeline-color) solid;
            border-bottom: 1px var(--timeline-color) solid;
        }

        /* position of the event arrow in even position */
        .timeline li:nth-child(2n) div:before {
            top: 0;
            margin-top: -10px;
            border-left: 1px var(--timeline-color) solid;
            border-top: 1px var(--timeline-color) solid;
        }
    </style>
@endprepend

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Data Timeline / History Pelanggar</h4>
                    {{-- <div class="float-right">
                        <a href="{{ route('penyidik.input') }}" class="btn btn-primary"><span class="fa fa-plus"></span>
                            Tambah Akreditor</a>
                    </div> --}}
                </div><!-- end card header -->

                <div class="card-body">
                    <div class="table table-bordered dt-responsive nowrap table-striped align-middle">
                        <table class="table table-centered align-middle table-nowrap mb-0" id="data-data">
                            <thead class="text-muted table-light">
                                <tr>
                                    <th scope="col">Nama</th>
                                    <th scope="col">NRP</th>
                                    <th scope="col">Pangkat</th>
                                    <th scope="col" width="50%">Timeline</th>
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

        function hapus(id) {
            $.confirm({
                title: 'Perhatian!',
                content: 'Apa kamu yakin akan menghapus data ini?',
                type: 'red',
                typeAnimated: true,
                buttons: {
                    yes: {
                        keys: ['y'],
                        action: function() {
                            var url = "{{ route('penyidik.hapus', ':id') }}";
                            url = url.replace(':id', id);
                            var table = $('#data-data').DataTable();
                            var $button = $(this);
                            $.ajax({
                                type: "GET",
                                url: url,
                                success: function(response) {
                                    table.row($button.parents('tr')).remove().draw();
                                    $.confirm({
                                        title: 'Perhatian!',
                                        content: 'Data anda berhasil di hapus!',
                                        type: 'green',
                                        typeAnimated: true,
                                        buttons: {
                                            tryAgain: {
                                                text: 'OK',
                                                action: function() {}
                                            },
                                        }
                                    });
                                },
                                error: function(e) {}
                            });
                        }
                    },
                    no: {
                        keys: ['N'],
                        action: function() {
                            $(this).hide();
                        }
                    },
                }
            });
        }

        function getData() {
            var table = $('#data-data').DataTable({
                processing: true,
                serverSide: true,
                searching: true,
                ajax: {
                    url: "/history-pelanggar/data",
                    method: "post",
                    data: function(data) {
                        data._token = '{{ csrf_token() }}'
                    }
                },
                columns: [{
                        data: 'terlapor',
                        name: 'terlapor'
                    },
                    {
                        data: 'nrp',
                        name: 'nrp'
                    },
                    {
                        data: 'pangkats.name',
                        name: 'pangkats.name'
                    },
                    {
                        data: 'timeline'
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
