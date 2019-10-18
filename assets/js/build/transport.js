var service_base_url = $('#service_base_url').val();
var status_transfer = 1;
$(function () {
    data(status_transfer);
});

function data(status_transfer_id) {

    if (status_transfer_id != undefined) {
        status_transfer = status_transfer_id
    }

    var dateunready_start = $('#dateunready_start').val();
    var dateunready_end = $('#dateunready_end').val();
    if (dateunready_start === '') {
        dateunready_start = null;
    }
    if (dateunready_end === '') {
        dateunready_end = null;
    }

    var transport_service_id = $('#transport_service_id').val();
    url = service_base_url + 'transport/data';

    $('body').loading();

    $.ajax({
        url: url,
        method: "POST",
        data: {
            dateunready_start: dateunready_start,
            dateunready_end: dateunready_end,
            status_transfer_id: status_transfer,
            transport_service_id: transport_service_id
        },
        success: function (res)
        {
            $('body').loading('stop');
            $('#result-page').html(res);
        }
    });
}

function dateallunready() {
    $('#dateunready_start').val('');
    $('#dateunready_end').val('');
    data();
}


function dateunready_start() {
    $('#dateunready_end').val($('#dateunready_start').val());
    data();
}

function datesuccess_start() {
    $('#datesuccess_end').val($('#datesuccess_start').val());
    data();
}