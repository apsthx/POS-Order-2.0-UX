var service_base_url = $('#service_base_url').val();

$(function () {
    data_report();
});

function data_report() {
    url = service_base_url + 'reportwarehouse/data';
    $('body').loading();
    $.ajax({
        url: url,
        method: "POST",
        data: {

        },
        success: function (res)
        {
            $('body').loading('stop');
            $('#result-page').html(res);
        }
    });
}

function excel() {
    url = service_base_url + 'reportwarehouse/export';
    window.open(url, "_self");
}