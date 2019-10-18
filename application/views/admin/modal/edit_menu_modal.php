<div class="modal-header">
    <h4 class="modal-title"><i class="fa fa-edit"></i>&nbsp;แก้ไขเมนู</h4>
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
</div>
<div class="modal-body">
    <div class="bootbox-body">
        <form id="form_modal" class="form-material m-t-10" method="post" action="<?php echo base_url() . 'admin/groupmenu/editmenu'; ?>" autocomplete="off">
            <input type="hidden" name="group_menu_id" value="<?php echo $data->group_menu_id; ?>">
            <input type="hidden" name="menu_id" value="<?php echo $data->menu_id; ?>">
            <div class="form-group">
                <label> เมนู : <span class="text-danger">*</span></label>
                <input type="text" name="menu_name" class="form-control form-control-line" value="<?php echo $data->menu_name; ?>" required>
            </div>
            <div class="form-group">
                <label> ลิ้งค์ : </label>
                <input type="text" name="menu_link" value="<?php echo $data->menu_link; ?>" class="form-control form-control-line">
            </div> 
            <div class="form-group">
                <label>สถานะ : </label>
                <input name="menu_status_id" type="radio" id="status_1" value="1" <?php echo ($data->menu_status_id == 1 ? 'checked' : ''); ?> >
                <label for="status_1">เปิดเมนู</label>                                                            
                <input name="menu_status_id" type="radio" id="status_2" value="2"  <?php echo ($data->menu_status_id == 2 ? 'checked' : ''); ?> >
                <label for="status_2">ปิดเมนู</label> 
                <input name="menu_status_id" type="radio" id="status_3" value="3"  <?php echo ($data->menu_status_id == 3 ? 'checked' : ''); ?> >
                <label for="status_3">ไม่แสดงในแถบเมนู</label> 
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
<script>
    $(function () {
        $('#form_modal').parsley();
    });
</script>