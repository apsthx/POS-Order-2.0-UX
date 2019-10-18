var service_base_url = $('#service_base_url').val();

$(function () {
    data();
});

function data() {
    url = service_base_url + 'servicescheck/data';
    $('body').loading();
    $.ajax({
        url: url,
        method: "POST",
        success: function (res)
        {
            $('body').loading('stop');
            $('#result-page').html(res);
        }
    });
}

function modal_services_status() {
    $('#modal_services_status').modal('show', {backdrop: 'true'});
}