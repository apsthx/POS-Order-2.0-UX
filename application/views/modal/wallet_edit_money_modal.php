<div class="modal-header">
    <h4 class="modal-title"><i class="fa fa-edit"></i>&nbsp;แก้ไข</h4>
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
</div>
<div class="modal-body">
    <div class="bootbox-body">
        <form class="form-material m-t-10 form-parsley" method="post" action="<?php echo base_url() . 'wallet/edit_money'; ?>" autocomplete="off">

            <input type="hidden" name="bank_id" value="<?php echo $row->bank_id; ?>">

            <div class="form-group">
                <label>จำนวนเงิน</label>
                <input type="text" name="bank_money" value="<?php echo $row->bank_money; ?>"
                       onkeypress="if (event.keyCode === 13) {
                                   check_price_format(this);
                               }" 
                       onblur="check_price_format(this);" class="form-control"  data-parsley-error-message="กรุณากรอกจำนวนเงิน หรือกรอก 0" required >
            </div>
            <div class="form-group">
                <div class="col-md-12 text-center">
                    <button type="submit" class="btn btn-outline-info"><i class="fa fa-save"></i>&nbsp;บันทึก</button>
                    <button type="button" class="btn btn-outline-danger" data-dismiss="modal" aria-hidden="true" ><i class="fa fa-close"></i>&nbsp;ยกเลิก</button>
                </div>
            </div>
        </form>
    </div>                    
</div>


<script>
    $(document).ready(function () {
        $('.form-parsley').parsley();
    });
</script>