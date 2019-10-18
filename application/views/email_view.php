<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-block">
                <h4 class="card-title"><i class="<?php echo $icon; ?>"></i> <?php echo " " . $title; ?></h4>  
                <form class="form-material m-t-10" id="formedit" method="post" action="<?php echo base_url() . 'email/edit'; ?>" autocomplete="off">
                    <?php $data = $this->email_model->get_setting_email(); ?>
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label> อีเมลที่ส่งจากที่อยู่ : <span class="text-danger">*</span></label>
                            <input type="text" name="fromaddress" value="<?php echo $data->fromaddress ;?>" class="form-control form-control-line" data-parsley-error-message="กรุณากรอกข้อมูล"  required="">
                        </div>
                        <div class="form-group col-sm-6">
                            <label> ชื่อแสดง : <span class="text-danger">*</span></label>
                            <input type="text" name="from" value="<?php echo $data->from ;?>" class="form-control form-control-line" data-parsley-error-message="กรุณากรอกข้อมูล"  required="">
                        </div> 
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label> SMTP Host : <span class="text-danger">*</span></label>
                            <input type="text" name="smtp_host" value="<?php echo $data->smtp_host ;?>" class="form-control form-control-line" data-parsley-error-message="กรุณากรอกข้อมูล"  required="">
                        </div>
                        <div class="form-group col-sm-6">
                            <label> SMTP Port : <span class="text-danger">*</span></label>
                            <input type="text" name="smtp_port" value="<?php echo $data->smtp_port ;?>" class="form-control form-control-line" data-parsley-error-message="กรุณากรอกข้อมูล"  required="">
                        </div> 
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label> SMTP User : <span class="text-danger">*</span></label>
                            <input type="text" name="smtp_user" value="<?php echo $data->smtp_user ;?>" class="form-control form-control-line" data-parsley-error-message="กรุณากรอกข้อมูล"  required="">
                        </div>

                        <div class="form-group col-sm-6">
                            <label> SMPT Password : <span class="text-danger">*</span></label>
                            <input type="password" name="smtp_password" value="<?php echo $data->smtp_password ;?>" autocomplete="new-password" class="form-control form-control-line" data-parsley-error-message="กรุณากรอกข้อมูล"  required="">
                        </div> 
                    </div> 
                    <div class="form-group">
                        <div class="col-md-12 text-center">
                            <button type="submit" class="btn btn-outline-info"><i class="fa fa-save"></i>&nbsp;บันทึก</button>
                            &nbsp;
                            <button type="reset" class="btn btn-outline-danger" ><i class="fa fa-close"></i>&nbsp;ยกเลิก</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
$(function () {
    $('#formedit').parsley();
});
</script>