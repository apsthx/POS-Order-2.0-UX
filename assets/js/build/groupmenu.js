var service_base_url = $('#service_base_url').val();

function modaladd() {
    $('#add').modal('show', {backdrop: 'true'});
}

function modaledit(group_menu_id) {
    url = service_base_url + 'groupmenu/groupmenuedit';
    $('#edit').modal('show', {backdrop: 'true'});
    $.ajax({
        url: url,
        method: "POST",
        data: {
            group_menu_id: group_menu_id
        },
        success: function (response)
        {
            $('#edit .modal-content').html(response);
        }
    });
}

function modaldelete(group_menu_id) {
    $('#delete').modal('show', {backdrop: 'true'});
    url = service_base_url + 'groupmenu/deletegroupmenu/' + group_menu_id;
    $('#delete_id').attr("href", url);
}