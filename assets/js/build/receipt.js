var service_base_url = $('#service_base_url').val();

$(function () {
    data();
});

function data() {
    if ($('#checkboxstatus').is(':checked')) {
        status_receipt_id = 0;
    } else {
        status_receipt_id = 1;
    }
    if ($('#checkboxstatus_order').is(':checked')) {
        status_receipt_order_id = 0;
    } else {
        status_receipt_order_id = 1;
    }
    date_select = $('#date_select').val();
    url = service_base_url + 'receipt/data';

    $('body').loading();

    $.ajax({
        url: url,
        method: "POST",
        data: {
            date_select: date_select,
            status_receipt_id: status_receipt_id,
            status_receipt_order_id: status_receipt_order_id
        },
        success: function (res)
        {
            $('body').loading('stop');
            $('#result-page').html(res);
        }
    });
}

function edit() {
    if ($('#checkboxstatus').is(':checked')) {
        status_receipt_id = 0;
    } else {
        status_receipt_id = 1;
    }

    url = service_base_url + 'receipt/edit';

    $('#edit').modal('hide');

    $('body').loading();

    $.ajax({
        url: url,
        method: "POST",
        data: {
            type_receipt_id: $('#typereceipt').val(),
            status_pay_id: $('#statuspay').val(),
            status_transfer_id: $('#statustransfer').val(),
            status_receipt_id: status_receipt_id,
            receipt_master_id_pri: $('#receipt_master_id_pri').val(),
            comment: $('#comment').val(),
        },
        success: function (res)
        {
            $('body').loading('stop');
            $('#result-page').html(res);
        }
    });

    return false;
}

function dateallunready() {
    $('#date_select').val('');
    data();
}
