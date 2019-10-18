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

    url = service_base_url + 'ordermain/data';

    $('body').loading();

    $.ajax({
        url: url,
        method: "POST",
        data: {
            type_receipt_id: $('#typereceipt').val(),
            status_pay_id: $('#statuspay').val(),
            status_transfer_id: $('#statustransfer').val(),
            status_receipt_id: status_receipt_id,
        },
        success: function (res)
        {
            $('body').loading('stop');
            $('#result-page').html(res);
        }
    });
}

function open_filter(bt_filter) {
    filter = $(bt_filter);
    if (filter.val() == 0) {
        $('#filter-group').css('opacity', 0)
                .slideDown('fast')
                .animate(
                        {opacity: 1},
                        {queue: false, duration: 'slow'}
                );
        filter.val(1);
    } else {
        $('#filter-group')
                .slideUp('fast')
                .animate(
                        {opacity: 0},
                        {queue: false, duration: 'slow'}
                );
        filter.val(0);
    }
}

function modal_edit(receipt_master_id_pri) {
    url = service_base_url + 'ordermain/modaledit';
    $('#edit').modal('show', {backdrop: 'true'});
    $.ajax({
        url: url,
        method: "POST",
        data: {
            receipt_master_id_pri: receipt_master_id_pri,
        },
        success: function (response)
        {
            $('#edit .modal-content').html(response);
        }
    });
}

function edit() {
    if ($('#checkboxstatus').is(':checked')) {
        status_receipt_id = 0;
    } else {
        status_receipt_id = 1;
    }

    url = service_base_url + 'ordermain/edit';

    $('#edit').modal('hide');

    $('body').loading();

    $.ajax({
        url: url,
        method: "POST",
        data: {
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
