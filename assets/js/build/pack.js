var service_base_url = $('#service_base_url').val();

$(function () {
    data1();
    data2();
    datanum1();
    datanum2();
    //datadetail();
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
    url = service_base_url + 'pack/dataunready';
    $.ajax({
        url: url,
        method: "POST",
        data: {
            'dateunready_start': dateunready_start,
            'dateunready_end': dateunready_end,
            'transport_service_id': $('#unreadytransport_service_id').val(),
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
    url = service_base_url + 'pack/datasuccess';
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

function datanum1() {
    url = service_base_url + 'pack/datanumunready';
    $.ajax({
        url: url,
        method: "POST",
        success: function (res)
        {
            $('#num-unready').html(res);
        }
    });
}

function datanum2() {
    url = service_base_url + 'pack/datanumsuccess';
    $.ajax({
        url: url,
        method: "POST",
        success: function (res)
        {
            $('#num-success').html(res);

        }
    });
}

function datadetail() {
    url = service_base_url + 'pack/datadetail';
    receipt_master_id = $('#receipt_master_id').val();
    if (receipt_master_id !== '') {
        $.ajax({
            url: url,
            method: "POST",
            data: {
                'receipt_master_id': receipt_master_id,
            },
            success: function (res)
            {
                $('#result-page').html(res);
                checkdetail(receipt_master_id);
            }
        });
    }
}

function checkdetail(receipt_master_id) {
    url = service_base_url + 'pack/checkdetail';
    if (receipt_master_id !== '') {
        $.ajax({
            url: url,
            method: "POST",
            data: {
                'receipt_master_id': receipt_master_id,
            },
            success: function (res)
            {
                if (res == 1) {
                    $('#transport_tracking_id').prop('disabled', false);
                    $( "#transport_tracking_id" ).focus();
                } else {
                    $('#transport_tracking_id').prop('disabled', true);
                }
            }
        });
    }
}

function edit() {
    url = service_base_url + 'pack/edit';
    receipt_master_id = $('#receipt_master_id').val();
    transport_tracking_id = $('#transport_tracking_id').val();
    //console.log(transport_tracking_id);
    if (transport_tracking_id !== '') {
        $.ajax({
            url: url,
            method: "POST",
            data: {
                'receipt_master_id': receipt_master_id,
                'transport_tracking_id': transport_tracking_id,
            },
            success: function (res)
            {
                if (res == 1) {
                    $('#result-page').html('<h4 class="text-center text-success"><i class="fa fa-save"></i> บันทึกหมายเลขพัสดุและบรรจุแล้ว</h4>');
                    data1();
                    data2();
                    datanum1();
                    datanum2();
                    $('#receipt_master_id').val('');
                    $('#transport_tracking_id').val('');
                    $('#transport_tracking_id').prop('disabled', true);
                    $("#receipt_master_id").focus();
                }
            }
        });
    }
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