var service_base_url = $('#service_base_url').val();

$(function () {
    data_report();
});

function data_report() {
    var date_start_report = $('#date_start_report').val();
    var date_end_report = $('#date_end_report').val();
    if (date_start_report === '') {
        date_start_report = null;
    }
    if (date_end_report === '') {
        date_end_report = null;
    }
    url = service_base_url + 'reportcustomerbuy/data';
    $('body').loading();
    $.ajax({
        url: url,
        method: "POST",
        data: {
            date_start: date_start_report,
            date_end: date_end_report,
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
    if (date_start_report === '') {
        date_start_report = null;
    }
    if (date_end_report === '') {
        date_end_report = null;
    }
    url = service_base_url + 'reportcustomerbuy/export/'+date_start_report+'/'+date_end_report;
    window.open(url, "_self");
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

function modalview(customer_id_pri) {
    console.log(customer_id_pri);
    url = service_base_url + 'customer/modalview';
    $('#view .modal-content').html('<div style="text-align:center;margin-top:50px;padding:100px;"><i class="fa fa-refresh fa-spin fa-3x fa-fw"></i></div>');
    $('#view').modal('show', {backdrop: 'true'});
    $.ajax({
        url: url,
        method: 'POST',
        data: {
            customer_id_pri: customer_id_pri
        },
        success: function (response)
        {
            $('#view .modal-content').html(response);
        }
    });
}