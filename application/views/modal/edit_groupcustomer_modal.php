<div class="modal-header">
    <h4 class="modal-title"><i class="fa fa-edit"></i>&nbsp;แก้ไขกลุ่มลูกค้า</h4>
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
</div>
<div class="modal-body">
    <div class="bootbox-body">
        <form class="form-material m-t-10" method="post" action="<?php echo base_url() . 'groupcustomer/edit'; ?>" autocomplete="off">
             <input type="hidden" name="customer_group_id" value="<?php echo $data->customer_group_id ;?>">
            <div class="form-group">
                <label> ชื่อกลุ่มลูกค้า : <span class="text-danger">*</span></label>
                <input type="text" name="customer_group_name" value="<?php echo $data->customer_group_name; ?>" class="form-control form-control-line" required>
            </div>
            <div class="form-group">
                <label> ส่วนลดตั้งต้น : </label>
                <input type="number" name="customer_group_save" value="<?php echo $data->customer_group_save; ?>" class="form-control form-control-line">
            </div>    
            <div class="form-group">
                <label> เลือก % หรือ บาท : </label>
                <select name="type_save_id" class="form-control form-control-line">
                    <option value="1" <?php echo ($data->type_save_id == 1 ? 'selected' : ''); ?>>%</option>
                    <option value="2" <?php echo ($data->type_save_id == 2 ? 'selected' : ''); ?>>บาท</option>
                </select>
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