<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-block">
                <h4 class="card-title"><i class="<?php echo $icon; ?>"></i> <?php echo " " . $title; ?> 
                </h4>  
                <?php
                if ($this->session->flashdata('flash_message') != '') {
                    echo '<script> $(document).ready(function () {toastralerts();}); </script>';
                }
                ?>
                <br/>
                <div class="row">
                    <div class="col-sm-7">
                        <div class="text-left">
                            <span> เลือกวันที่ </span>
                            <input class="form-control form-control-sm col-sm-4 mydatepicker" type="text" value="<?php echo date('Y-m-d'); ?>" placeholder="ปี-เดือน-วัน" id="datestart" onchange="dateStart();">
                            <span> ถึง </span>
                            <input class="form-control form-control-sm col-sm-4 mydatepicker" type="text" value="<?php echo date('Y-m-d'); ?>"  placeholder="ปี-เดือน-วัน" id="dateend">
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="text-right">
                            <select id="check" class="form-control form-control-sm">
                                <option value="" >สถานะทั้งหมด</option>
                                <option value="0" >รอตรวจ</option>
                                <option value="1" >ผ่าน</option>
                                <option value="2" >ไม่ผ่าน</option>
                            </select>
                        </div>
                    </div>      
                    <div class="col-sm-2">
                        <div class="text-right">
                            <button class="btn btn-sm btn-outline-primary"  onclick="load();"><i class="fa fa-search"></i> กรองข้อมูล</button> 
                        </div>
                    </div>
                </div>
                <br/>
                <div class="table-responsive">
                    <div id="for_table">
                        <table class="table table-striped table-bordered">                
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th class="">แพ็กเกจ</th>
                                    <th>โอนเข้าธนาคาร</th>
                                    <th class="">โอนโดย</th>
                                    <th class="">จำนวนเงิน</th>
                                    <th class="">วันที่โอน</th>
                                    <th class="">เวลาโอน</th>
                                    <th class="">เลขที่อ้างอิง</th>
                                    <th class="text-center">หลักฐานการโอน</th>
                                    <th class="text-center">วันที่แจ้งโอน</th>
                                    <th class="text-center" width="6%">สถานะ</th>
                                    <th class="text-center" width="6%">ตรวจสอบ</th>
                                </tr>
                            </thead>
                            <tbody id="for_load">

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="for_modal"></div>
<script>
    var service_base_url = $('#service_base_url').val();

    function load() {
        $('body').loading();
        $.ajax({
            url: service_base_url + 'admin/receipt/loadtable',
            type: 'post',
            data: {
                datestart: $('#datestart').val(),
                dateend: $('#dateend').val(),
                check: $('#check').val()
            },
            success: function (response) {
                $('#for_table').html(response);
                $('body').loading('stop');
            }
        });
    }
    $(function () {
        load();
    });
    function check(receipt_id, active) {
        $.ajax({
            url: service_base_url + 'admin/receipt/check',
            type: 'post',
            data: {
                receipt_id: receipt_id,
                check: active
            },
            success: function (res) {
                if (res == 1) {
                    $('#status-' + receipt_id).html('<span class="label label-success">ผ่าน</span>');
                } else {
                    $('#status-' + receipt_id).html('<span class="label label-danger">ไม่ผ่าน</span>');
                }
            }
        });
    }
    function switchCheck(receipt_id) {
        if ($('#sw-' + receipt_id).is(':checked')) {
            check(receipt_id, 1);
            $('#status-' + receipt_id).html('<span class="label label-success">ผ่าน</span>');

        } else {
            check(receipt_id, 2);
            $('#status-' + receipt_id).html('<span class="label label-danger">ไม่ผ่าน</span>');
        }
    }
    function dateStart() {
        $('#dateend').val($('#datestart').val());
    }
</script>
