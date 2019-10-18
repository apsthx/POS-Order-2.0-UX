<div class="modal-header">
    <h4 class="modal-title"><i class="fa fa-edit"></i>&nbsp;ดูรายการ <?php echo $dataview->fullname . ' ( ' . $dataview->customer_id . ' )'; ?></h4>
    <input type="hidden" id="customer_id_view" value="<?php echo $dataview->customer_id; ?>">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
</div>
<div class="modal-body">
    <div class="row">
        <div class="col-lg-12">
            <div class="text-center">
                <span> เลือกวันที่ </span>
                <input class="form-control form-control-sm col-sm-3 mydatepicker" type="text" value="" id="datestart" onchange="date_start();">
                <span> ถึง </span>
                <input class="form-control form-control-sm col-sm-3 mydatepicker" type="text" value="" id="dateend" onchange="result_page_view();">               
                <button class="btn btn-sm btn-outline-primary"  onclick="date_all();"><i class="fa fa-calendar"></i> วันที่ทั้งหมด</button>
            </div>
        </div>
        <div class="col-lg-12" id="page-result-view" style="height:65vh; overflow-y: auto !important;">

        </div>
    </div>            
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-danger" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i> ปิด</button>             
</div>

<script>
    var service_base_url = $('#service_base_url').val();
    
    $('.mydatepicker').datepicker({
        toggleActive: true, 
        format: 'yyyy-mm-dd'
    }).on('changeDate', function(e){
        $(this).datepicker('hide');
    });
    
    $(function () {
        result_page_view();
    });
    function result_page_view() {
        url = service_base_url + 'customer/ajaxview';
        customer_id = $('#customer_id_view').val();
        $('#page-result-view').html('<div style="text-align:center;margin-top:50px;padding:100px;"><i class="fa fa-refresh fa-spin fa-3x fa-fw"></i></div>');
        datestart = $('#datestart').val();
        dateend = $('#dateend').val();   
        $.ajax({
            url: url,
            method: "POST",
            data: {
                customer_id: customer_id,
                datestart: datestart,
                dateend: dateend,
            },
            success: function (response)
            {
                $('#page-result-view').html(response);
            }
        });
    }

    function date_start() {
        $('#dateend').val($('#datestart').val());
        result_page_view();
    }
    
    function date_all() {
        $('#datestart').val('');
        $('#dateend').val('');
        result_page_view();
    }
</script>