var service_base_url = $('#service_base_url').val();

$(function () {
    data();
});

function data() {
    if ($('#checkboxstatus').is(':checked')) {
        confirm_order_id = 1;
    } else {
        confirm_order_id = 2;
    }
    $('body').loading();
    url = service_base_url + 'ordersub/data';
    $.ajax({
        url: url,
        method: "POST",
        data: {
            confirm_order_id: confirm_order_id
        },
        success: function (res)
        {
            $('body').loading('stop');
            $('#result-page').html(res);
        }
    });
}

function modal_confirm(receipt_master_id_pri) {
    url = service_base_url + 'ordersub/check_stock';
    $('body').loading();
    $.ajax({
        url: url,
        method: "POST",
        data: {
            receipt_master_id_pri: receipt_master_id_pri,
        },
        success: function (status)
        {
            $('body').loading('stop');
            if (status == 'fail') {
                $('#confirm_order_id').val(3);
                $('#status_confirm').html('<span style="color:#900;">ไม่มีสินค้ารอส่ง</span>');
            } else {
                $('#confirm_order_id').val(2);
                $('#status_confirm').html('มีสินค้ารอส่ง');
            }
            $('#confirm-modal').modal('show', {backdrop: 'true'});
            $('#id_pri_invoid').val(receipt_master_id_pri);
        }
    });
}

function modal_cancel(receipt_master_id_pri) {
    $('#cancel-modal').modal('show', {backdrop: 'true'});
    $('#id_pri_cancel').val(receipt_master_id_pri);
}

function cancel() {
    $('#cancel-modal').modal('hide');
    $('body').loading();
    return true;
}