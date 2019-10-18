var service_base_url = $('#service_base_url').val();

function modaladd() {
    $('#add').modal('show', {backdrop: 'true'});
}

function modaledit(setting_sms_id) {
    url = service_base_url + 'settingsms/settingsmsedit';
    $('#edit').modal('show', {backdrop: 'true'});
    $.ajax({
        url: url,
        method: "POST",
        data: {
            setting_sms_id: setting_sms_id
        },
        success: function (response)
        {
            $('#edit .modal-content').html(response);
        }
    });
}

function modaldelete(setting_sms_id) {
    $('#delete').modal('show', {backdrop: 'true'});
    url = service_base_url + 'settingsms/delete/' + setting_sms_id;
    $('#delete_id').attr("href", url);
}

$(function () {
    $('#formadd').parsley();
});