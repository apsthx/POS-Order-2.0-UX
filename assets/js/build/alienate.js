var service_base_url = $('#service_base_url').val();

$(function () {
    ajax();
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

function ajax() {
    if ($('#checkboxstatus').is(':checked')) {
        status_id = 0;
    } else {
        status_id = 1;
    }
    url = service_base_url + 'alienate/ajax';
    $('body').loading();
    $.ajax({
        url: url,
        method: 'post',
        data: {
            status_id: status_id
        },
        success: function (res)
        {
            $('#result-page').html(res);
            $('body').loading('stop');
        }
    }
    );
}

function modal_add() {
    url = service_base_url + 'alienate/modal_add';
    $('#open-modal').modal('show', {backdrop: 'true'});
    $('#open-modal .modal-content').html('<div style="text-align:center; padding:80px;"><i class="fa fa-refresh fa-spin fa-3x fa-fw"></i></div>');
    $.ajax({
        url: url,
        success: function (res)
        {
            $('#open-modal .modal-content').html(res);
        }
    });
}

function modal_edit(id) {
    url = service_base_url + 'alienate/modal_edit';
    $('#open-modal').modal('show', {backdrop: 'true'});
    $('#open-modal .modal-content').html('<div style="text-align:center; padding:80px;"><i class="fa fa-refresh fa-spin fa-3x fa-fw"></i></div>');
    $.ajax({
        url: url,
        method: "POST",
        data: {
            id: id
        },
        success: function (res)
        {
            $('#open-modal .modal-content').html(res);
        }
    });
}