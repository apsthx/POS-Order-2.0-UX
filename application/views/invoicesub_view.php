<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-block">
                <h4 class="card-title">
                    <div class="row">
                        <div class="col-md-6">
                            <i class="<?php echo $icon; ?>"></i> <?php echo " " . $title; ?> 
                        </div>
                        <div class="col-md-6 text-right">
                            <input type="checkbox" class="col-sm-4 offset-sm-2" name="" id="checkboxstatus" value="1" onchange="data();" >
                            <label for="checkboxstatus"> แสดงรายการที่จัดส่งแล้ว</label>
                        </div>
                    </div>
                </h4>  

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