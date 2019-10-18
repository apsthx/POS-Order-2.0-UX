<div class="modal-header">
    <h4 class="modal-title"><i class="fa fa-plus-square-o"></i>&nbsp;เพิ่มเครดิต SMS </h4>
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
</div>
<div class="modal-body">
    <div class="bootbox-body">
        <form id="form_modal" class="form-material m-t-10" method="post" action="<?php echo base_url() . 'admin/settingsms/smsadd'; ?>" autocomplete="off">

            <input type="hidden" name="setting_sms_id" value="<?php echo $data->setting_sms_id; ?>">
            <?php
            if ($data->credit_balance == null) {
                $credit_balance = 0;
            } else {
                $credit_balance = $data->credit_balance;
            }
            ?>
            <div class="form-group">
                <label> เครดิตคงเหลือ : </label>
                <input type="text" name="credit_balance" class="form-control form-control-line" value="<?php echo $credit_balance; ?>" data-parsley-error-message="กรุณากรอกข้อมูล"  required="" readonly="">
            </div>
            <div class="form-group">
                <label> เพิ่มเครดิต SMS : </label>
                <select name="sms_amount" class="form-control">
                    <?php
                    $smss = $this->settingsms_model->get_sms();
                    if ($smss->num_rows() > 0) {
                        foreach ($smss->result() as $sms) {
                            ?>
                            <option value="<?php echo $sms->sms_amount; ?>"><?php echo $sms->sms_name . ' ( '.$sms->sms_cost.' บาท '.$sms->sms_amount.' ข้อความ )'; ?></option>
                            <?php
                        }
                    }
                    ?>
                </select>
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
    $(function () {
        $('#form_modal').parsley();
    });
</script>