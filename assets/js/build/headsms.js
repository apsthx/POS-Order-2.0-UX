var service_base_url = $('#service_base_url').val();

$(function () {
    $('#form-add').parsley();
})

function modaladd() {
    $('#add').modal('show', {backdrop: 'true'});
}

function modaledit(head_sms_id) {
    url = service_base_url + 'headsms/headsmsedit';
    $('#edit').modal('show', {backdrop: 'true'});
    $.ajax({
        url: url,
        method: "POST",
        data: {
            head_sms_id: head_sms_id
        },
        success: function (response)
        {
            $('#edit .modal-content').html(response);
        }
    });
}

function modaldelete(head_sms_id) {
    $('#delete').modal('show', {backdrop: 'true'});
    url = service_base_url + 'headsms/deleteheadsms/' + head_sms_id;
    $('#delete_id').attr("href", url);
}