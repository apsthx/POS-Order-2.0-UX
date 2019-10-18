var service_base_url = $('#service_base_url').val();

$(function () {
    data1();
    data2();
});

function data1() {
    $('body').loading();
    var dateunready_start = $('#dateunready_start').val();
    var dateunready_end = $('#dateunready_end').val();
    if (dateunready_start === '') {
        dateunready_start = null;
    }
    if (dateunready_end === '') {
        dateunready_end = null;
    }
    url = service_base_url + 'stickertransport/dataunready';
    $.ajax({
        url: url,
        method: "POST",
        data: {
            'dateunready_start': dateunready_start,
            'dateunready_end': dateunready_end,
            'customer_group_id': $('#customer_group_id').val(),
        },
        success: function (res)
        {
            $('body').loading('stop');
            $('#result-page-unready').html(res);

        }
    });
}

function data2() {
    $('body').loading();
    var datesuccess_start = $('#datesuccess_start').val();
    if (datesuccess_start === '') {
        datesuccess_start = null;
    }
    var datesuccess_end = $('#datesuccess_end').val();
    if (datesuccess_end === '') {
        datesuccess_end = null;
    }
    url = service_base_url + 'stickertransport/datasuccess';
    $.ajax({
        url: url,
        method: "POST",
        data: {           
            'datesuccess_start': datesuccess_start,
            'datesuccess_end': datesuccess_end,
            'transport_service_id': $('#transport_service_id').val(),
        },
        success: function (res)
        {
            $('body').loading('stop');
            $('#result-page-success').html(res);

        }
    });
}

function select_unready_all() {

    if ($('#select_unready_checkbox_all').is(':checked')) {
        $('.select_unready_checkbox').prop('checked', true)
    } else {
        $('.select_unready_checkbox').prop('checked', false)
    }
}

function select_success_all() {

    if ($('#select_success_checkbox_all').is(':checked')) {
        $('.select_success_checkbox').prop('checked', true)
    } else {
        $('.select_success_checkbox').prop('checked', false)
    }
}

//function modalsuccessopen() {
//    $('#modelsuccess').modal('show', {backdrop: 'true'});
//}

function modalsuccessclose() {
    data1();
    data2();
    $('#modelsuccess').modal('hide');
}

function dateallunready() {
    $('#dateunready_start').val('');
    $('#dateunready_end').val('');
    data1();
}

function dateallsuccess() {
    $('#datesuccess_start').val('');
    $('#datesuccess_end').val('');
    data2();
}

function dateunready_start() {
    $('#dateunready_end').val($('#dateunready_start').val());
    data1();
}

function datesuccess_start() {
    $('#datesuccess_end').val($('#datesuccess_start').val());
    data2();
}