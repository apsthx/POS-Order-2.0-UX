var service_base_url = $('#service_base_url').val();

$(function () {
    data();
    check_gruup();
});

$.Thailand({
    database: service_base_url + 'assets/js/thailand-db/db.json',
    $district: $('#formadd [name="district"]'),
    $amphoe: $('#formadd [name="amphoe"]'),
    $province: $('#formadd [name="province"]'),
    $zipcode: $('#formadd [name="zipcode"]')
});

function data() {
    if ($('#checkboxstatus').is(':checked')) {
        status_id = 0;
    } else {
        status_id = 1;
    }
    $('body').loading();
    url = service_base_url + 'customer/data';
    $.ajax({
        url: url,
        method: "POST",
        data: {
            customer_group_id: $('#customergroup').val(),
            status_id: status_id,
        },
        success: function (res)
        {
            $('body').loading('stop');
            $('#result-page').html(res);

        }
    });
}

function modaledit(customer_id_pri) {
    url = service_base_url + 'customer/customeredit';
    $('#edit').modal('show', {backdrop: 'true'});
    $.ajax({
        url: url,
        method: "POST",
        data: {
            customer_id_pri: customer_id_pri
        },
        success: function (response)
        {
            $('#edit .modal-content').html(response);
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

//function datafilter() {  
//    url = service_base_url + 'customer/data';
//    $('body').loading();
//    $.ajax({
//        url: url,
//        method: "POST",
//        data: {
//            customer_group_id: $('#customergroup').val(),
//            status_id: status_id,
//        },
//        success: function (res)
//        {
//            $('#result-page').html(res);
//            $('body').loading('stop');
//        }
//    });
//}

function check_id() {
    $('#bt-submit').prop('disabled', true);
    url = service_base_url + 'customer/check_id';
    if ($('#customer_id').val() != '') {
        $.ajax({
            url: url,
            method: "POST",
            data: {
                customer_id: $('#customer_id').val(),
            },
            success: function (res)
            {
                if (res == 1) {
                    $('#customer_id_massage').html('รหัสนี้มีการใช้งานแล้ว');
                    $('#customer_id').val("")
                } else {
                    $('#customer_id_massage').html('');
                }
                $('#bt-submit').prop('disabled', false);
            }
        });
    }
}


$(function () {
    $('#formadd').parsley();
});


function modal_editstatus(customer_id_pri) {
    url = service_base_url + 'customer/modaleditstatus';
    $('#editstatus').modal('show', {backdrop: 'true'});
    $.ajax({
        url: url,
        method: "POST",
        data: {
            customer_id_pri: customer_id_pri,
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
    url = service_base_url + 'customer/editstatus';
    $('#editstatus').modal('hide');
    $('body').loading();
    $.ajax({
        url: url,
        method: "POST",
        data: {
            customer_group_id: $('#customergroup').val(),
            status_id: status_id,
            customer_id_pri: $('#customer_id_pri').val(),
        },
        success: function (res)
        {
            $('body').loading('stop');
            $('#result-page').html(res);
        }
    });

    return false;
}

function modalview(customer_id_pri) {
    //console.log(customer_id_pri);
    url = service_base_url + 'customer/modalview';
    $('#view .modal-content').html('<div style="text-align:center;margin-top:50px;padding:100px;"><i class="fa fa-refresh fa-spin fa-3x fa-fw"></i></div>');
    $('#view').modal('show', {backdrop: 'true'});
    $.ajax({
        url: url,
        method: 'POST',
        data: {
            customer_id_pri: customer_id_pri
        },
        success: function (response)
        {
            $('#view .modal-content').html(response);
        }
    });
}

function modal_editpassword(customer_id_pri, username) {
    url = service_base_url + 'customer/modaleditpassword';
    $('#editpassword').modal('show', {backdrop: 'true'});
    $.ajax({
        url: url,
        method: "POST",
        data: {
            customer_id_pri: customer_id_pri,
            username: username,
        },
        success: function (response)
        {
            $('#editpassword .modal-content').html(response);
        }
    });
}

function editpassword() {
    if ($('#checkboxstatus').is(':checked')) {
        status_id = 0;
    } else {
        status_id = 1;
    }
    url = service_base_url + 'customer/editpassword';
    $('#editpassword').modal('hide');
    $('body').loading();
    $.ajax({
        url: url,
        method: "POST",
        data: {
            customer_group_id: $('#customergroup').val(),
            status_id: status_id,
            customer_id_pri: $('#customer_id_pri_editpassword').val(),
            username: $('#username_editpassword').val(),
        },
        success: function (res)
        {
            $('body').loading('stop');
            $('#result-page').html(res);
        }
    });

    return false;
}

function check_gruup() {
    if ($('#customer_group_id').val() == null) {
        $('#bt-submit').prop('disabled', true);
    } else {
        $('#bt-submit').prop('disabled', false);
    }
}

function import_modal() {
    $('#import_modal').modal('show', {backdrop: 'true'});
}
function submit_import() {
    $('#import_modal').modal('hide');
    $('body').loading();
    return true;
}