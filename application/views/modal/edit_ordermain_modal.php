<div class="modal-header">
    <h4 class="modal-title"><i class="fa fa-edit"></i>&nbsp;ยกเลิกใบสั่งซื้อ</h4>
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
</div>
<div class="modal-body">
    <div class="bootbox-body">
        <form class="form-material m-t-10" method="post" onsubmit="return edit();" autocomplete="off">
            <input type="hidden" name="receipt_master_id_pri" id='receipt_master_id_pri' value="<?php echo $receipt_master_id_pri; ?>">
            <div class="form-group">
                <label> ยกเลิกเพราะ : </label>
                <input type="text" name="comment" id='comment' class="form-control form-control-line">
            </div>
            <div class="form-group">
                <div class="col-md-12 text-center">
                    <button type="submit" class="btn btn-outline-info"><i class="fa fa-save"></i>&nbsp;บันทึก</button>
                    &nbsp;
                    <button type="button" class="btn btn-outline-danger" data-dismiss="modal" aria-hidden="true" ><i class="fa fa-close"></i>&nbsp;ยกเลิก</button>
                </div>
            </div>
        </form>
    </div>                    
</div>