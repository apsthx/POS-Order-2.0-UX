<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-block">
                <h4 class="card-title"><i class="<?php echo $icon; ?>"></i> <?php echo " " . $title; ?> 
                </h4> 

                <div class="row">
                    <div class="text-left col-3"></div>
                    <div class="text-left col-1">
                        <span> เลือกวันที่ </span>
                    </div>
                    <div class="text-right col-2">
                        <input class="form-control form-control-sm mydatepicker" type="text" value="" id="date_select" onchange="data();">
                    </div>
                    <div class="text-left col-1">
                        <button class="btn btn-sm btn-outline-primary"  onclick="dateallunready();"><i class="fa fa-calendar"></i> วันที่ทั้งหมด</button>
                    </div>
                    <div class="text-right col-5">
                        <div class="col-sm-12 text-right" style="padding-top: 6px">
                            <input type="checkbox" class="col-sm-4 offset-sm-2" id="checkboxstatus" value="1" onchange="data();">
                            <label for="checkboxstatus"> แสดงรายการที่ถูกยกเลิก</label>
                            &nbsp;
                            <input type="checkbox" class="col-sm-4 offset-sm-2" id="checkboxstatus_print" value="1" onchange="data();">
                            <label for="checkboxstatus_print"> แสดงรายการที่ปริ้นแล้ว</label>
                        </div> 
                    </div>
                </div>


                <div class="text-center" id="flash_message4500">
                    <?php
                    if ($this->session->flashdata('flash_message') != '') {
                        ?>
                        <br/>
                        <?php
                        echo $this->session->flashdata('flash_message');
                        ?>
                        <br/>
                        <?php
                    }
                    ?>                                
                </div>

                <div id="result-page">

                </div>
            </div>
        </div>
    </div>
</div>



<div class="modal fade" id="modelsuccess">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><i class="fa fa-save"></i>&nbsp;ทำรายการเสร็จสิ้น</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button></div>
            <div class="modal-body">
                <div class="bootbox-body text-center text-success"><b>สถานะการทำรายการเสร็จสิ้น&nbsp;<i class="fa fa-check-circle-o"></i></b></div>                    
            </div>
            <div class="modal-footer">
                <button class="btn btn-success" onclick="data();" data-dismiss="modal"><i class="fa fa-check"></i>&nbsp;โหลดใหม่</button>
            </div>
        </div>
    </div>
</div>