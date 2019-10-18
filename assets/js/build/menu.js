var service_base_url = $('#service_base_url').val();

function modaladd() {
    $('#add').modal('show', {backdrop: 'true'});
}

function modaledit(menu_id) {
    url = service_base_url + 'groupmenu/menuedit';
    $('#edit').modal('show', {backdrop: 'true'});
    $.ajax({
        url: url,
        method: "POST",
        data: {
            menu_id: menu_id
        },
        success: function (response)
        {
            $('#edit .modal-content').html(response);
        }
    });
}

function modaldelete($group_menu_id,menu_id) {
    $('#delete').modal('show', {backdrop: 'true'});
    url = service_base_url + 'groupmenu/deletemenu/'+ $group_menu_id +'/'+ menu_id;
    $('#delete_id').attr("href", url);
}