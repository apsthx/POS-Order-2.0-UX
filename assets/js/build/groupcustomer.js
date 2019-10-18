var service_base_url = $('#service_base_url').val();

function modaladd() {
    $('#add').modal('show', {backdrop: 'true'});
}

function modaledit(customer_group_id) {
    url = service_base_url + 'groupcustomer/groupcustomeredit';
    $('#edit').modal('show', {backdrop: 'true'});
    $.ajax({
        url: url,
        method: "POST",
        data: {
            customer_group_id: customer_group_id
        },
        success: function (response)
        {
            $('#edit .modal-content').html(response);
        }
    });
}

function modaldelete(customer_group_id) {
    $('#delete').modal('show', {backdrop: 'true'});
    url = service_base_url + 'groupcustomer/delete/' + customer_group_id;
    $('#delete_id').attr("href", url);
}

$(function () {
    $('#formadd').parsley();
});