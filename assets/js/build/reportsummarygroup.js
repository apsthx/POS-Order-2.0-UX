var service_base_url = $('#service_base_url').val();

$(function () {
    data_report();
});

function data_report() {
    var date_start_report = $('#date_start_report').val();
    var date_end_report = $('#date_end_report').val();
    var user_id = $("#user_id").val();
    var customer_group_id = $("#customer_group_id").val();
    if (date_start_report === '') {
        date_start_report = null;
    }
    if (date_end_report === '') {
        date_end_report = null;
    }
    if (user_id === '') {
        user_id = null;
    }
    if (customer_group_id === '') {
        customer_group_id = null;
    }
    url = service_base_url + 'reportsummarygroup/data';
    $('body').loading();
    $.ajax({
        url: url,
        method: "POST",
        data: {
            date_start: date_start_report,
            date_end: date_end_report,
            user_id: user_id,
            customer_group_id: customer_group_id,
        },
        success: function (res)
        {
            $('body').loading('stop');
            $('#result-page').html(res);
        }
    });
}

function excel() {
    var date_start_report = $('#date_start_report').val();
    var date_end_report = $('#date_end_report').val();
    var user_id = $("#user_id").val();
    var customer_group_id = $("#customer_group_id").val();
    if (date_start_report === '') {
        date_start_report = null;
    }
    if (date_end_report === '') {
        date_end_report = null;
    }
    if (user_id === '') {
        user_id = null;
    }
    if (customer_group_id === '') {
        customer_group_id = null;
    }
    url = service_base_url + 'reportsummarygroup/export/'+date_start_report+'/'+date_end_report+'/'+user_id+'/'+customer_group_id;
    window.open(url, "_blank");
}


function date_start_report() {
    $('#date_end_report').val($('#date_start_report').val());
    data_report();
}

function dateall_report() {
    $('#date_start_report').val('');
    $('#date_end_report').val('');
    data_report();
}
