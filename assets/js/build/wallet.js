var service_base_url = $('#service_base_url').val();

function modal_add() {
    url = service_base_url + 'wallet/modal_add';
    $('#modal-open .modal-content').html('<div style="text-align:center; padding:80px;"><i class="fa fa-refresh fa-spin fa-3x fa-fw"></i></div>');
    $('#modal-open').modal('show', {backdrop: 'true'});
    $.ajax({
        url: url,
        method: "POST",
        success: function (res)
        {
            $('#modal-open .modal-content').html(res);
        }
    });
}

function modal_edit(id) {
    url = service_base_url + 'wallet/modal_edit';
    $('#modal-open .modal-content').html('<div style="text-align:center; padding:80px;"><i class="fa fa-refresh fa-spin fa-3x fa-fw"></i></div>');
    $('#modal-open').modal('show', {backdrop: 'true'});
    $.ajax({
        url: url,
        method: "POST",
        data: {
            id: id
        },
        success: function (res)
        {
            $('#modal-open .modal-content').html(res);
        }
    });
}

function modal_edit_money(id) {
    url = service_base_url + 'wallet/modal_edit_money';
    $('#modal-open .modal-content').html('<div style="text-align:center; padding:80px;"><i class="fa fa-refresh fa-spin fa-3x fa-fw"></i></div>');
    $('#modal-open').modal('show', {backdrop: 'true'});
    $.ajax({
        url: url,
        method: "POST",
        data: {
            id: id
        },
        success: function (res)
        {
            $('#modal-open .modal-content').html(res);
        }
    });
}

function modal_delete(id) {
    url = service_base_url + 'wallet/modal_delete';
    $('#modal-open .modal-content').html('<div style="text-align:center; padding:80px;"><i class="fa fa-refresh fa-spin fa-3x fa-fw"></i></div>');
    $('#modal-open').modal('show', {backdrop: 'true'});
    $.ajax({
        url: url,
        method: "POST",
        data: {
            id: id
        },
        success: function (res)
        {
            $('#modal-open .modal-content').html(res);
        }
    });
}

function modaldelete(group_menu_id) {
    $('#delete').modal('show', {backdrop: 'true'});
    url = service_base_url + 'groupmenu/deletegroupmenu/' + group_menu_id;
    $('#delete_id').attr("href", url);
}