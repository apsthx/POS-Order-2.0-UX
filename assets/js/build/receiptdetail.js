var service_base_url = $('#service_base_url').val();
var detail_index = 2;

$(function () {
    change_select_status_tranfer();
});

function transport_tracking_change(tag_id) {
    tag = $(tag_id);
    if (tag.val() != "") {
        $('#bt_tracking_id').prop('disabled', false);
    } else {
        $('#bt_tracking_id').prop('disabled', true);
    }
}

function save_tacking_id(receipt_master_id_pri) {
    transport_tracking_id = $('#transport_tracking_id').val();
    url = service_base_url + 'invoice/save_tacking_id';
    $('body').loading();
    $.ajax({
        url: url,
        method: 'post',
        data: {
            receipt_master_id_pri: receipt_master_id_pri,
            transport_tracking_id: transport_tracking_id
        },
        success: function ()
        {
            $('#modal-success').modal('show', {backdrop: 'true'});
            $('body').loading('stop');
        }
    });
}

function sand_sms(receipt_master_id_pri) {
    url = service_base_url + 'invoice/sand_sms';
    $('body').loading();
    $.ajax({
        url: url,
        method: 'post',
        data: {
            receipt_master_id_pri: receipt_master_id_pri
        },
        success: function (res)
        {
            if (res == '0') {
                $('#modal-error').modal('show', {backdrop: 'true'});
                $('#modal-error-massage').html('การส่ง Tacking id. ผ่าน SMS ไม่สำเร็จ');
            }
            $('body').loading('stop');
        }
    });
}

function change_select_status_tranfer() {
    tag = $('#status_transfer_id');
    if (tag.val() == 1) {
        $('#bt_status_transfer').prop('disabled', true);
    } else {
        $('#bt_status_transfer').prop('disabled', false);
    }
}

function change_status_tranfer(receipt_master_id_pri) {
    status_transfer_id_befor = $('#status_transfer_id_befor').val();
    status_transfer_id = $('#status_transfer_id').val();
    product_id_arr = [];
    product_amount_arr = [];
    $('.product_id').map(function (i) {
        if (this.value !== "") {
            product_id_arr[i] = this.value;
        }
    });
    $('.product_amount').map(function (i) {
        if (this.value !== "") {
            product_amount_arr[i] = this.value;
        }
    });
    url = service_base_url + 'invoice/change_status_tranfer';
    $('body').loading();
    $.ajax({
        url: url,
        method: 'post',
        data: {
            receipt_master_id_pri: receipt_master_id_pri,
            status_transfer_id: status_transfer_id,
            status_transfer_id_befor: status_transfer_id_befor,
            product_id_arr: product_id_arr,
            product_amount_arr: product_amount_arr
        },
        success: function ()
        {
            $('#modal-success').modal('show', {backdrop: 'true'});
            $('body').loading('stop');
        }
    });
}