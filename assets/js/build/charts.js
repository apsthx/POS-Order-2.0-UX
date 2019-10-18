var service_base_url = $('#service_base_url').val();

$(function () {
    var url = service_base_url + "home/charts";
    $.ajax({
        type: "post",
        url: url,
        contentType: "application/json; charset=utf-8",
        dataType: "json",
        success: function (Result) {
            //console.log(Result);
            Highcharts.setOptions({
                lang: {
                    decimalPoint: '.',
                    thousandsSep: ','
                },
            });
            $('#container').highcharts({
                chart: {
                    type: 'column',
                },
                credits: {
                    style: {
                        cursor: 'pointer',
                        color: '#909090',
                        fontSize: '8px'
                    },
                    text: ""
                },
                title: {
                    text: 'กราฟเปรียบเทียบยอดขาย'
                },
                xAxis: {
                    categories: [
                        'ม.ค.',
                        'ก.พ.',
                        'มี.ค.',
                        'เม.ย.',
                        'พ.ค.',
                        'มิ.ย.',
                        'ก.ค.',
                        'ส.ค.',
                        'ก.ย.',
                        'ต.ค.',
                        'พ.ย.',
                        'ธ.ค.'
                    ],
                    crosshair: true
                },
                yAxis: {
                    min: 0,
                    title: {
                        text: 'จำนวนเงิน (บาท)'
                    }
                },
                tooltip: {
                    headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                    pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                            '<td style="color:{series.color}padding:0;text-align: right;"><b>{point.y:,.2f} บาท</b></td></tr>',
                    footerFormat: '</table>',
                    shared: true,
                    useHTML: true
                },
                plotOptions: {
                    column: {
                        pointPadding: 0.2,
                        borderWidth: 0
                    }
                },
                series: [{
                        name: (new Date).getFullYear() + 542,
                        data: Result.oldyear

                    }, {
                        name: (new Date).getFullYear() + 543,
                        data: Result.newyear

                    }]
            });
        }

    });
});