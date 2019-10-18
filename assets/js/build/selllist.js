var service_base_url = $('#service_base_url').val();

$(function () {
    data();
});

function data() {
    if ($('#checkboxstatus').is(':checked')) {
        status_receipt_id = 0;
    } else {
        status_receipt_id = 1;
    }
    date_select = $('#date_select').val();

    url = service_base_url + 'selllist/data';

    $('body').loading();

    $.ajax({
        url: url,
        method: "POST",
        data: {
            date_select: date_select,
            status_receipt_id: status_receipt_id
        },
        success: function (res)
        {
            $('body').loading('stop');
            $('#result-page').html(res);
        }
    });
}


function dateallunready() {
    $('#date_select').val('');
    data();
}