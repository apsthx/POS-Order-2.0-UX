<div class="modal-header">
    <h4 class="modal-title"><i class="fa fa-edit"></i>&nbsp;ระงับลูกค้า</h4>
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
</div>
<div class="modal-body">
    <div class="bootbox-body">
        <form class="form-material m-t-10" method="post" onsubmit="return editstatus();" autocomplete="off">
            <input type="hidden" name="customer_id_pri" id='customer_id_pri' value="<?php echo $customer_id_pri ;?>">
            <b><p class="text-danger text-center"><i class='fa fa-close'></i> ต้องการระงับลูกค้า</p></b>
            <br/>
            <div class="form-group">
                <div class="col-md-12 text-center">
                    <button type="submit" class="btn btn-outline-info"><i class="fa fa-save"></i>&nbsp;ตกลง</button>
                    &nbsp;
                    <button type="button" class="btn btn-outline-danger" data-dismiss="modal" aria-hidden="true" ><i class="fa fa-close"></i>&nbsp;ยกเลิก</button>
                </div>
            </div>
        </form>
    </div>                    
</div>