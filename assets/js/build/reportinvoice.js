var service_base_url = $('#service_base_url').val();

$(function () {
    data();
});

function data() {
    var checked = $("input[name='group1']:checked").val();
    var dateday = $("#dateday").val();
    var datemonth = $("#datemonth").val();
    var dateyear = $("#dateyear").val();
    var datedaystart = $("#datedaystart").val();
    var datedayend = $("#datedayend").val();
    //console.log(dateday+'/'+datemonth+'/'+dateyear+'/'+datedaystart+'/'+datedayend);
    url = service_base_url + 'reportinvoice/data';
    $('body').loading();
    $.ajax({
        url: url,
        method: "POST",
        data: {
            checked : checked,
            dateday : dateday,
            datemonth : datemonth,
            dateyear : dateyear,
            datedaystart : datedaystart,
            datedayend : datedayend,
        },
        success: function (res)
        {
            $('body').loading('stop');
            $('#result-page').html(res);
        }
    });
}

function excel() {
    var checked = $("input[name='group1']:checked").val();
    var dateday = $("#dateday").val();
    var datemonth = $("#datemonth").val();
    var dateyear = $("#dateyear").val();
    var datedaystart = $("#datedaystart").val();
    var datedayend = $("#datedayend").val();
    //console.log(dateday+'/'+datemonth+'/'+dateyear+'/'+datedaystart+'/'+datedayend);
    url = service_base_url + 'reportinvoice/export/'+checked+'/'+dateday+'/'+datemonth+'/'+dateyear+'/'+datedaystart+'/'+datedayend;
    window.open(url,"_self");
}




