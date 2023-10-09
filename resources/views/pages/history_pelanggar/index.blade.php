@extends('partials.master')

@prepend('styles')
    <link href="{{ asset('assets/css/dashboard.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/responsive.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css?family=Roboto+Condensed');
        /*
                                  reset the list elements first (normalize)
                                */

        ul,
        li {
            margin: 0;
            padding: 0;

        }

        span::first-letter {
            text-transform: capitalize;
        }

        body {
            font-family: 'Roboto Condensed', serif;
        }

        /* START TIMELINE
                                 the width of the list parent is optional
                                if you set this width
                                A hover sample effect is added as well as an active state*/

        .base-timeline {
            list-style-type: none;
            counter-reset: number;
            /* number 2021*/
            position: relative;
            display: block;
            z-index: 2;
            width: 100%;
            /* change or remove*/

        }

        .base-timeline::before {
            content: '';
            width: 100%;
            border-top: 2px solid steelblue;
            display: inline-block;
            position: absolute;
            top: 50%;
            z-index: -1;

        }

        /* set width of time-line this can be px, percentage or other unit
                                3 is the number of list items minus 1 when using percentage
                                */
        .base-timeline__item {
            position: relative;
            display: inline-block;
            width: calc(100% / 3 - 15px);
            /* change width */
        }

        .base-timeline__item::before {
            display: flex;
            justify-content: center;
            align-items: center;
            counter-increment: number;
            /* number -1*/
            content: counter(number) '';
            border-radius: 50%;
            width: 40px;
            height: 40px;
            background-color: steelblue;
            color: white;
            font-weight: bold;
            transition: all 0.6s ease-in-out;
            box-sizing: border-box;

        }

        /* modifier with use of the data-year attribute */
        .base-timeline__item--data::before {
            content: attr(data-year);
            width: 25px;
            height: 25px;
        }

        /* hover element */
        .base-timeline__item:hover::before {
            background-color: rgba(225, 114, 114, .9);
            transform: scale(2);

        }

        .base-timeline__item--active::before {
            background-color: rgba(225, 114, 114, .9);
            border: 2px solid;
            border-color: rgba(0, 0, 0, .3);


        }

        .base-timeline__item:last-child {
            width: 0;
        }

        /* summary text is optional and can be anything */

        .base-timeline__summary-text {
            position: absolute;
            margin-bottom: 1px;
            /* left: 5px; */
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
                    <div class="table-responsive table-card px-3">
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
    <script src="https://cdn.datatables.net/1.13.2/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.2/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
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
