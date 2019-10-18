var service_base_url = $('#service_base_url').val();

$(function () {
    data();
});

function setDatePicker2text(select) {
    $(select).datetimepicker({
        lang: 'th',
        timepicker: false,
        format: 'Y-m-d',
        scrollMonth: false,
        scrollTime: false,
        scrollInput: false,
//        minDate: new Date(),
//        maxDate: new Date(date_finish)
    });
}

function data() {
    if ($('#checkboxstatus').is(':checked')) {
        status_transfer_id = 2;
    } else {
        status_transfer_id = 1;
    }
    $('body').loading();
    url = service_base_url + 'invoicelist/data';
    $.ajax({
        url: url,
        method: "POST",
        data: {
            status_transfer_id: status_transfer_id
        },
        success: function (res)
        {
            $('body').loading('stop');
            $('#result-page').html(res);
        }
    });
}

function modal_alienate(receipt_master_id_pri) {
    url = service_base_url + 'invoicelist/modal_alienate';
    $('#open-modal').modal('show', {backdrop: 'true'});
    $('#open-modal .modal-content').html('<div style="text-align:center; padding:80px;"><i class="fa fa-refresh fa-spin fa-3x fa-fw"></i></div>');
    $.ajax({
        url: url,
        method: "POST",
        data: {
            receipt_master_id_pri: receipt_master_id_pri
        },
        success: function (res)
        {
            $('#open-modal .modal-content').html(res);
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