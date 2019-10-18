var service_base_url = $('#service_base_url').val();

$(function () {
    data();
});

function data() {
    $('body').loading();
    var date_start = $('#date_start').val();
    var date_end = $('#date_end').val();
    if (date_start === '') {
        date_start = null;
    }
    if (date_end === '') {
        date_end = null;
    }
    url = service_base_url + 'transportcustomer/data';
    $.ajax({
        url: url,
        method: "POST",
        data: {
            'date_start': date_start,
            'date_end': date_end,
        },
        success: function (res)
        {
            $('body').loading('stop');
            $('#result-page').html(res);

        }
    });
}

function dateall() {
    $('#date_start').val('');
    $('#date_end').val('');
    data();
}

function date_start() {
    $('#date_end').val($('#date_start').val());
    data();
}
