var service_base_url = $('#service_base_url').val();

$(function () {
    data_report();
});

function data_report() {
    var date_start_report = $('#date_start_report').val();
    var date_end_report = $('#date_end_report').val();
    var search = $('#search').val();
    if (date_start_report === '') {
        date_start_report = null;
    }
    if (date_end_report === '') {
        date_end_report = null;
    }
    if (search === '') {
        search = null;
    }
    url = service_base_url + 'reportproductmovementsub/data';
    $('body').loading();
    $.ajax({
        url: url,
        method: "POST",
        data: {
            date_start: date_start_report,
            date_end: date_end_report,
            search : search
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
    var search = $('#search').val();
    if (date_start_report === '') {
        date_start_report = null;
    }
    if (date_end_report === '') {
        date_end_report = null;
    }
    if (search === '') {
        search = null;
    }
    url = service_base_url + 'reportproductmovementsub/export/'+date_start_report+'/'+date_end_report + '/' + search;
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
