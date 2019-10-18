var service_base_url = $('#service_base_url').val();

$(function () {

    ajax();
});

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

function ajax() {
    url = service_base_url + 'product/ajax';
    $('body').loading();
    $.ajax({
        url: url,
        method: "POST",
        data: {
            product_category_id: $('#product_category_id_filter').val(),
            status_product_id: $('#status_product_id_filter').val()
        },
        success: function (res)
        {
            $('#result-page').html(res);
            $('body').loading('stop');
        }
    });
}

function modal_delete(id) {
    url = service_base_url + 'product/checkdelete';
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

function modal_props(id) {
    url = service_base_url + 'product/modal_props';
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

function pull_product() {
    $('#modal-pull-product').modal('hide');
    $('body').loading();
    return true;
}

function import_modal() {
    $('#import_modal').modal('show', {backdrop: 'true'});
}
function submit_import() {
    $('#import_modal').modal('hide');
    $('body').loading();
    return true;
}