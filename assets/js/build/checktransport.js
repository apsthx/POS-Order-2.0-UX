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
    url = service_base_url + 'checktransport/dataunready';
    $.ajax({
        url: url,
        method: "POST",
        data: {
            'dateunready_start': dateunready_start,
            'dateunready_end': dateunready_end,
            'transport_service_id': $('#unreadytransport_service_id').val(),
            'transport_status_id': $('#unreadytransport_status_id').val(),
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
    url = service_base_url + 'checktransport/datasuccess';
    $.ajax({
        url: url,
        method: "POST",
        data: {
            'datesuccess_start': datesuccess_start,
            'datesuccess_end': datesuccess_end,
            'transport_service_id': $('#successtransport_service_id').val(),
        },
        success: function (res)
        {
            $('body').loading('stop');
            $('#result-page-success').html(res);

        }
    });
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

function modelprocessopen() {
    $('#modelprocess').modal('show', {backdrop: 'true'});
}
function submit_process() {
    $('#modelprocess').modal('hide');
    $('body').loading();
    return true;
}

function modal_detail(receipt_master_id_pri) {
    url = service_base_url + 'checktransport/modal_detail';
    $('#open-modal').modal('show', {backdrop: 'true'});
    $('#open-modal .modal-content').html('<div style="text-align:center; padding:80px;"><i class="fa fa-refresh fa-spin fa-3x fa-fw"></i></div>');
    $.ajax({
        url: url,
        method: 'post',
        data: {
            receipt_master_id_pri: receipt_master_id_pri
        },
        success: function (res)
        {
            $('#open-modal .modal-content').html(res);
        }
    });
}