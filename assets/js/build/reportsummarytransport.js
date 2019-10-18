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
    var customer_group_id = $("#customer_group_id").val();
    //console.log(dateday+'/'+datemonth+'/'+dateyear+'/'+datedaystart+'/'+datedayend);
    url = service_base_url + 'reportsummarytransport/data';
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
    var checked = $("input[name='group1']:checked").val();
    var dateday = $("#dateday").val();
    var datemonth = $("#datemonth").val();
    var dateyear = $("#dateyear").val();
    var datedaystart = $("#datedaystart").val();
    var datedayend = $("#datedayend").val();
    var customer_group_id = $("#customer_group_id").val();
    if(customer_group_id === ''){
        customer_group_id = null;
    }
    //console.log(dateday+'/'+datemonth+'/'+dateyear+'/'+datedaystart+'/'+datedayend);
    url = service_base_url + 'reportsummarytransport/export/'+checked+'/'+dateday+'/'+datemonth+'/'+dateyear+'/'+datedaystart+'/'+datedayend+'/'+customer_group_id;
    window.open(url,"_self");
}

