var service_base_url = $('#service_base_url').val();

$(function () {
    $('#form-add').parsley();
    ajax();
});

function ajax() {
    url = service_base_url + 'category/ajax';
    $('body').loading();
    $.ajax({
        url: url,
        success: function (res)
        {
            $('#result-page').html(res);
            $('body').loading('stop');
        }
    });
}

function modaladd() {
    $('#add').modal('show', {backdrop: 'true'});
}

function edit_modal(id) {
    url = service_base_url + 'category/edit_modal';
    $('#open-modal').modal('show', {backdrop: 'true'});
    $('#open-modal .modal-content').html('<div style="text-align:center; padding:80px;"><i class="fa fa-refresh fa-spin fa-3x fa-fw"></i></div>');
    $.ajax({
        url: url,
        method: "POST",
        data: {
            id: id
        },
        success: function (res)
        {
            $('#open-modal .modal-content').html(res);
        }
    });
}

function modal_delete(id) {
    url = service_base_url + 'category/checkdelete';
    $.ajax({
        url: url,
        method: 'POST',
        data: {
            id: id
        },
        success: function (flag)
        {
            if (flag == '1') {
                $('#delete_id').val(id);
                $('#modal-delete').modal('show', {backdrop: 'true'});
            } else {
                $('#modal-delete-no').modal('show', {backdrop: 'true'});
            }
        }
    });
}