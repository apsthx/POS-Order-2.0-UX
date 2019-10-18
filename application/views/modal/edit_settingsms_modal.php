<div class="modal-header">
    <h4 class="modal-title"><i class="fa fa-edit"></i>&nbsp;แก้ไข SMS บริษัท/ร้านค้า</h4>
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
</div>
<div class="modal-body">
    <div class="bootbox-body">
        <form class="form-material m-t-10" method="post" action="<?php echo base_url() . 'settingsms/edit'; ?>" autocomplete="off">
            <input type="hidden" name="setting_sms_id" value="<?php echo $data->setting_sms_id; ?>">
            <div class="form-group">
                <label> เบอร์ที่ใช้ส่ง : </label>
                <input type="text" name="setting_sms_number" class="form-control form-control-line" value="<?php echo $data->setting_sms_number; ?>" data-parsley-error-message="กรุณากรอกข้อมูล"  required="">
            </div>
            <div class="form-group">
                <label> username : </label>
                <input type="text" name="setting_sms_username" class="form-control form-control-line" value="<?php echo $data->setting_sms_username; ?>" data-parsley-error-message="กรุณากรอกข้อมูล"  required="">
            </div>
            <div class="form-group">
                <label> password : </label>
                <input type="password" autocomplete="new-password" name="setting_sms_password" class="form-control form-control-line" value="<?php echo $data->setting_sms_password; ?>" data-parsley-error-message="กรุณากรอกข้อมูล"  required="">
            </div>
            <div class="form-group">
                <label> เครดิตทั้งหมด : </label>
                <input type="text" name="credit_all" class="form-control form-control-line" value="<?php echo $data->credit_all; ?>" data-parsley-error-message="กรุณากรอกข้อมูล"  required="">
            </div>
            <div class="form-group">
                <label> เครดิตคงเหลือ : </label>
                <input type="text" name="credit_balance" class="form-control form-control-line" value="<?php echo $data->credit_balance; ?>" data-parsley-error-message="กรุณากรอกข้อมูล"  required="">
            </div>
            <div class="form-group">
                <label> ยอดส่ง SMS ทั้งหมด : </label>
                <input type="text" name="credit_sum" class="form-control form-control-line" value="<?php echo $data->credit_sum; ?>" data-parsley-error-message="กรุณากรอกข้อมูล"  required="">
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