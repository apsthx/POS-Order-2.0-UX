var service_base_url = $('#service_base_url').val();

$(function () {
    data();
});

function data() {
    if ($('#checkboxstatus').is(':checked')) {
        status_id = 0;
    } else {
        status_id = 1;
    }
    console.log(status_id);
    $('body').loading();
    url = service_base_url + 'partners/data';
    $.ajax({
        url: url,
        method: "POST",
        data: {
            partners_group_id: $('#partnersgroup').val(),
            status_id: status_id,
        },
        success: function (res)
        {
            $('body').loading('stop');
            $('#result-page').html(res);
        }
    });
}

function modaledit(partners_id_pri) {
    url = service_base_url + 'partners/partnersedit';
    $('#edit').modal('show', {backdrop: 'true'});
    $.ajax({
        url: url,
        method: "POST",
        data: {
            partners_id_pri: partners_id_pri
        },
        success: function (response)
        {
            $('#edit .modal-content').html(response);
        }
    });
}

function modaleditstatus(partners_id_pri) {
    url = service_base_url + 'partners/editstatus';
    $('#result-page').html();
    $.ajax({
        url: url,
        method: "POST",
        data: {
            partners_id_pri: partners_id_pri,
            partners_group_id: $('#partnersgroup').val(),
            status_id: $('#checkboxstatus').val(),
        },
        success: function (res)
        {
            $('#result-page').html(res);
        }
    });
}


function modaladd() {
    $('#add').modal('show', {backdrop: 'true'});
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

function open_vat(bt_vat) {
    vat = $(bt_vat);
    if (vat.val() == 0) {
        $('#vat-group').css('opacity', 0)
                .slideDown('fast')
                .animate(
                        {opacity: 1},
                {queue: false, duration: 'slow'}
                );
        vat.val(1);
    } else {
        $('#vat-group')
                .slideUp('fast')
                .animate(
                        {opacity: 0},
                {queue: false, duration: 'slow'}
                );
        vat.val(0);
    }
}

function check_id() {
    $('#bt-submit').prop('disabled', true);
    url = service_base_url + 'partners/check_id';
    if ($('#partners_id').val() != '') {
        $.ajax({
            url: url,
            method: "POST",
            data: {
                partners_id: $('#partners_id').val(),
            },
            success: function (res)
            {
                if (res == 1) {
                    $('#partners_id_massage').html('รหัสนี้มีการใช้งานแล้ว');
                    $('#partners_id').val("")
                } else {
                    $('#partners_id_massage').html('');
                }
                $('#bt-submit').prop('disabled', false);
            }
        });
    }
}

function modal_editstatus(partners_id_pri) {
    url = service_base_url + 'partners/modaleditstatus';
    $('#editstatus').modal('show', {backdrop: 'true'});
    $.ajax({
        url: url,
        method: "POST",
        data: {
            partners_id_pri: partners_id_pri,
        },
        success: function (response)
        {
            $('#editstatus .modal-content').html(response);
        }
    });
}

function editstatus() {
    if ($('#checkboxstatus').is(':checked')) {
        status_id = 0;
    } else {
        status_id = 1;
    }    
    url = service_base_url + 'partners/editstatus';
    $('#editstatus').modal('hide');
    $('body').loading();
    $.ajax({
        url: url,
        method: "POST",
        data: {
            partners_group_id: $('#partnersgroup').val(),
            status_id: status_id,
            partners_id_pri: $('#partners_id_pri').val(),
        },
        success: function (res)
        {
            $('body').loading('stop');
            $('#result-page').html(res);
        }
    });
    
    return false;
}

$(function () {
    $('#formadd').parsley();
});