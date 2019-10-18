var service_base_url = $('#service_base_url').val();
var services_status = 1;
$(function () {
    data(services_status);
});

function data(services_status_id) {

    if (services_status_id != undefined) {
        services_status = services_status_id
    }
    //console.log(services_status);
    if (services_status == 1) {
        $('#services_pay').hide();
        $('.button_services_pay1').hide();
        $('.button_services_pay2').hide();
        $('.button_services_status1').show();
        $('.button_services_status2').hide();
        $('.button_services_print').show();
    } else if (services_status == 2) {
        $('#services_pay').show();
        $('.button_services_pay1').hide();
        $('.button_services_pay2').hide();
        $('.button_services_status1').hide();
        $('.button_services_status2').show();
        $('.button_services_print').show();
    } else {
        $('#services_pay').hide();
        $('.button_services_pay1').hide();
        $('.button_services_pay2').hide();
        $('.button_services_status1').hide();
        $('.button_services_status2').hide();
        $('.button_services_print').show();
    }
    
    if ($('#services_pay').val() == 1 && services_status == 2) {
        $('.button_services_pay1').show();
        $('.button_services_pay2').hide();
    } else if($('#services_pay').val() == 2 && services_status == 2){
        $('.button_services_pay1').hide();
        $('.button_services_pay2').show();       
    } else{
        $('.button_services_pay1').hide();
        $('.button_services_pay2').hide();     
    }

    var services_day_start = $('#services_day_start').val();
    var services_day_end = $('#services_day_end').val();
    if (services_day_start === '') {
        services_day_start = null;
    }
    if (services_day_end === '') {
        services_day_end = null;
    }

    var services_pay = $('#services_pay').val();
    url = service_base_url + 'serviceslist/data';

    $('body').loading();

    $.ajax({
        url: url,
        method: "POST",
        data: {
            services_day_start: services_day_start,
            services_day_end: services_day_end,
            services_status: services_status,
            services_pay: services_pay
        },
        success: function (res)
        {
            $('body').loading('stop');
            $('#result-page').html(res);
        }
    });
}

function dateallunready() {
    $('#services_day_start').val('');
    $('#services_day_end').val('');
    data();
}


function dateservices_day_start() {
    $('#services_day_end').val($('#services_day_start').val());
    data();
}

function modal_services_status1() {
    $('#modal_services_status1').modal('show', {backdrop: 'true'});
}

function modal_services_status2() {
    $('#modal_services_status2').modal('show', {backdrop: 'true'});
}

function services_pay() {
    data(2);
}

function modal_services_pay1() {
    $('#modal_services_pay1').modal('show', {backdrop: 'true'});
}

function modal_services_pay2() {
    $('#modal_services_pay2').modal('show', {backdrop: 'true'});
}

