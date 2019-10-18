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
        status_pay_id = 2;
    } else {
        status_pay_id = 1;
    }
    $('body').loading();
    url = service_base_url + 'invoicesub/data';
    $.ajax({
        url: url,
        method: "POST",
        data: {
            status_pay_id: status_pay_id
        },
        success: function (res)
        {
            $('body').loading('stop');
            $('#result-page').html(res);
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