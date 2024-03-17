function add_notification(selector, options) {
    Snackbar.show(options);
}

function callAPI(method_input, url_input, body_input, onsuccess) {
    var urli = url_input;
    var datai = body_input;
    var method = method_input;

    $.ajax({
        url: urli,
        // Automatically parses JSON response
        dataType: 'json',
        beforeSend: function () {
            $('.loader-view').css('display', 'block');
        },
        type: method,
        data: datai,
        success: function (data, status, xhr) {
            // success callback function
            $('.loader-view').css('display', 'none');
            window[onsuccess](data);
        },
        error: function (jqXhr, textStatus, errorMessage) {
            $('.loader-view').css('display', 'none');
            add_notification('.snackbar-bg-danger', {
                text: errorMessage,
                actionTextColor: '#fff',
                backgroundColor: '#e7515a',
                pos: 'top-center'
            })
        }
    });
}

function callAPIFile(method_input, url_input, body_input, onsuccess) {
    var urli = url_input;
    var datai = body_input;
    var method = method_input;

    $.ajax({
        url: urli,
        beforeSend: function () {
            $('.loader-view').css('display', 'block');
        },
        type: method,
        data: datai,
        processData: false,
        contentType: false,
        success: function (data, status, xhr) {
            // success callback function
            $('.loader-view').css('display', 'none');
            window[onsuccess](data);
        },
        error: function (jqXhr, textStatus, errorMessage) {
            $('.loader-view').css('display', 'none');
            add_notification('.snackbar-bg-danger', {
                text: errorMessage,
                actionTextColor: '#fff',
                backgroundColor: '#e7515a',
                pos: 'top-center'
            })
        }
    });
}

var table = '';

function getDataTable(id, url, kolom) {

    table = $('#' + id).DataTable({
        "dom": "<'dt--top-section'<'row'<'col-12 col-sm-6 d-flex justify-content-sm-start justify-content-center'l><'col-12 col-sm-6 d-flex justify-content-sm-end justify-content-center mt-sm-0 mt-3'f>>>" +
            "<'table-responsive'tr>" +
            "<'dt--bottom-section d-sm-flex justify-content-sm-between text-center'<'dt--pages-count  mb-sm-0 mb-3'i><'dt--pagination'p>>",
        "oLanguage": {
            "oPaginate": { "sPrevious": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>', "sNext": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>' },
            "sInfo": "Showing page _PAGE_ of _PAGES_",
            "sSearch": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>',
            "sSearchPlaceholder": "Search...",
            "sLengthMenu": "Results :  _MENU_",
        },
        processing: true,
        serverSide: true,
        responsive: true,
        "pageLength": 10,
        ajax: {
            url: url,
            method: "post",
            data: function (d) {
                return $('#filter_table').serialize() + "&" + $.param(d);
            }
        },
        columns: kolom


    });

    $('#kt_search').on('click', function (e) {
        e.preventDefault();
        table.table().draw();
    });

    $('#kt_reset').on('click', function (e) {
        $('.form-control').val('');
        table.table().draw();
    });
}
