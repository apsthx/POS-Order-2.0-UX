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
    $('body').loading();
    url = service_base_url + 'user/data';
    $.ajax({
        url: url,
        method: "POST",
        data: {
            status_id: status_id,
        },
        success: function (res)
        {
            $('body').loading('stop');
            $('#result-page').html(res);

        }
    });
}

function modaledit(user_id) {
    url = service_base_url + 'user/useredit';
    $('#edit').modal('show', {backdrop: 'true'});
    $.ajax({
        url: url,
        method: "POST",
        data: {
            user_id: user_id
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

function check_username() {
    $('#bt-submit').prop('disabled', true);
    url = service_base_url + 'user/check_username';
    if ($('#username').val() != '') {
        $.ajax({
            url: url,
            method: "POST",
            data: {
                username: $('#username').val(),
            },
            success: function (res)
            {
                console.log(res)
                if (res == 1) {
                    $('#username_massage').html('username นี้มีการใช้งานแล้ว');
                    $('#username').val("")
                } else {
                    $('#username_massage').html('');
                }
                $('#bt-submit').prop('disabled', false);
            }
        });
    }
}

function modal_editstatus(user_id) {
    url = service_base_url + 'user/modaleditstatus';
    $('#editstatus').modal('show', {backdrop: 'true'});
    $.ajax({
        url: url,
        method: "POST",
        data: {
            user_id: user_id,
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
    url = service_base_url + 'user/editstatus';
    $('#editstatus').modal('hide');
    $('body').loading();
    $.ajax({
        url: url,
        method: "POST",
        data: {
            status_id: status_id,
            user_id: $('#user_id').val(),
        },
        success: function (res)
        {
            $('body').loading('stop');
            $('#result-page').html(res);
        }
    });
    
    return false;
}

function modal_editpassword(user_id,username) {
    url = service_base_url + 'user/modaleditpassword';
    $('#editpassword').modal('show', {backdrop: 'true'});
    $.ajax({
        url: url,
        method: "POST",
        data: {
            user_id: user_id,
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
    url = service_base_url + 'user/editpassword';
    $('#editpassword').modal('hide');
    $('body').loading();
    $.ajax({
        url: url,
        method: "POST",
        data: {
            status_id: status_id,
            user_id: $('#user_id_editpassword').val(),
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

$(function () {
    $('#formadd').parsley();
});
