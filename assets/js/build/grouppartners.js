var service_base_url = $('#service_base_url').val();

function modaladd() {
    $('#add').modal('show', {backdrop: 'true'});
}

function modaledit(partners_group_id) {
    url = service_base_url + 'grouppartners/grouppartnersedit';
    $('#edit').modal('show', {backdrop: 'true'});
    $.ajax({
        url: url,
        method: "POST",
        data: {
            partners_group_id: partners_group_id
        },
        success: function (response)
        {
            $('#edit .modal-content').html(response);
        }
    });
}

function modaldelete(partners_group_id) {
    $('#delete').modal('show', {backdrop: 'true'});
    url = service_base_url + 'grouppartners/delete/' + partners_group_id;
    $('#delete_id').attr("href", url);
}

$(function () {
    $('#formadd').parsley();
});