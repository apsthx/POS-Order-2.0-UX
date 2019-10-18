var service_base_url = $('#service_base_url').val();

function modalset(role_id) {
    url = service_base_url + 'role/set';
    $('#set').modal('show', {backdrop: 'true'});
    $.ajax({
        url: url,
        method: "POST",
        data: {
            role_id: role_id
        },
        success: function (response)
        {
            $('#set .modal-content').html(response);
        }
    });
}

function switchRole(role_id, menu_id, checkbox) {
    console.log(role_id,menu_id);
    if (checkbox.checked) {
        var url = $('#service_base_url').val() + 'role/add';
        $.post(url, {role_id: role_id, menu_id: menu_id}, function (response) {
            $('#role_show_checkbock' + menu_id).html('<span class="badge badge-success"><i class="fa fa-check-circle"></i>&nbsp;อนุญาต</span>');
        });
    } else {
        var url = $('#service_base_url').val() + 'role/delete';
        $.post(url, {role_id: role_id, menu_id: menu_id}, function (response) {
            $('#role_show_checkbock' + menu_id).html('<span class="badge badge-warning"><i class="fa fa-times-circle"></i>&nbsp;ไม่อนุญาต</span>');
        });
    }
}
