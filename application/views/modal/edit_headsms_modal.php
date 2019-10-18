<div class="modal-header">
    <h4 class="modal-title"><i class="fa fa-edit"></i>&nbsp;แก้ไข</h4>
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
</div>
<div class="modal-body">
    <div class="bootbox-body">
        <form class="form-material m-t-10" method="post" action="<?php echo base_url() . 'headsms/editheadsms'; ?>" autocomplete="off">
            <input type="hidden" name="head_sms_id_edit" value="<?php echo $data->head_sms_id ;?>">
            <div class="form-group">
                <label> หัวข้อ SMS : <span class="text-danger">*</span></label>
                <input type="text" name="head_sms_name_edit" class="form-control form-control-line" value="<?php echo $data->head_sms_name ;?>" required>
            </div>    
            <div class="form-group">
                <div class="col-md-12 text-center">
                    <button type="submit" value="add" class="btn btn-outline-info"><i class="fa fa-save"></i>&nbsp;บันทึก</button>
                    &nbsp;
                    <button type="button" class="btn btn-outline-danger" data-dismiss="modal" aria-hidden="true" ><i class="fa fa-close"></i>&nbsp;ยกเลิก</button>
                </div>
            </div>
        </form>
    </div>                    
</div>