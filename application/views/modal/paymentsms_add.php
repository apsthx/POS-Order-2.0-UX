<div id="on_modal" tabindex="-1" role="dialog" class="modal fade">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><i class="fa fa-plus-circle"></i>&nbsp;แจ้งโอนบัญชีธนาคาร</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <div class="bootbox-body">
                    <form id="form_modal" class="form-material m-t-10" method="post" action="<?php echo base_url() . 'payment/addsms'; ?>" autocomplete="off" enctype="multipart/form-data">
                        <input type="hidden" name="income_bank_id" value="<?php echo $income_bank_id; ?>">
                        <?php $income_bank = $this->payment_model->getBank($income_bank_id)->row() ?>
                        <div class="form-group row">
                            <label class="col-sm-4 text-right control-label col-form-label"> โอนเข้าธนาคาร : <span class="text-danger">*</span></label>
                            <div class="col-sm-5">
                                <input type="text" name="income_bank_name" id="income_bank_name" value="<?php echo $income_bank->income_bank_name . ' ' . $income_bank->income_bank_branch . ' ' . $income_bank->income_bank_account_name; ?>" class="form-control" readonly="">
                            </div>
                        </div> 
                        <div class="form-group row">
                            <label class="col-sm-4 text-right control-label col-form-label"> เลือกค่าบริการ SMS : <span class="text-danger">*</span></label>
                            <div class="col-sm-5">
                                <select name="sms_id" class="form-control">
                                    <?php
                                    $smss = $this->payment_model->getSMS();
                                    if ($smss->num_rows() > 0) {
                                        foreach ($smss->result() as $sms) {
                                            ?>
                                            <option value="<?php echo $sms->sms_id; ?>"><?php echo $sms->sms_name.' ( '.$sms->sms_cost.' บาท '.$sms->sms_amount.' ข้อความ )'; ?></option>
                                        <?php
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div> 
                        <div class="form-group row">
                            <label class="col-sm-4 text-right control-label col-form-label"> โอนโดย : <span class="text-danger">*</span></label>
                            <div class="col-sm-5">
                                <input type="text" name="receipt_by" id="receipt_by" class="form-control" required="">
                            </div>
                        </div> 
                        <div class="form-group row">
                            <label class="col-sm-4 text-right control-label col-form-label"> จำนวนเงิน : <span class="text-danger">*</span></label>
                            <div class="col-sm-5">
                                <input type="number" step="0.01" name="receipt_cost" id="receipt_cost" class="form-control" required="">
                            </div>
                        </div> 
                        <div class="form-group row">
                            <label class="col-sm-4 text-right control-label col-form-label"> วันที่โอน : <span class="text-danger">*</span></label>
                            <div class="col-sm-5">
                                <input type="text" name="receipt_datepay" id="receipt_datepay" class="form-control mydatepicker" required=""  />
                            </div>
                        </div> 
                        <div class="form-group row">
                            <label class="col-sm-4 text-right control-label col-form-label"> เวลาโอน : <span class="text-danger">*</span></label>
                            <div class="col-sm-5">
                                <input type="text" name="receipt_timepay" id="receipt_timepay" class="form-control" required=""  >
                            </div>
                        </div> 
                        <div class="form-group row">
                            <label class="col-sm-4 text-right control-label col-form-label"> เลขที่อ้างอิง : </label>
                            <div class="col-sm-5">
                                <input type="text" name="receipt_number" id="receipt_number" class="form-control">
                            </div>
                        </div> 
                        <div class="form-group row">
                            <label class="col-sm-4 text-right control-label col-form-label"> หลักฐานการโอน : <span class="text-danger">*</span></label>
                            <div class="col-md-2">
                                <label for="upload-image" class="btn btn-primary">
                                    <i class="fa fa-image"></i> อัพรูปหลักฐาน
                                    <input type="file" accept="image/*" name="receipt_evidence" onchange="$('#text-image').html($('#upload-image').val());" id="upload-image" style="display: none" data-parsley-id="4" required="">
                                </label>
                            </div>
                            <label class="col-md-3 control-label" id="text-image"></label>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-12 text-center">
                                <button type="submit" value="add" class="btn btn-outline-info"><i class="fa fa-save"></i>&nbsp;บันทึก</button>
                                &nbsp;
                                <button type="button" class="btn btn-outline-danger" data-dismiss="modal" aria-hidden="true" ><i class="fa fa-close"></i>&nbsp;ยกเลิก</button>
                            </div>
                        </div>
                    </form>
                </div>                    
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        $('#form_modal').parsley();
    });
    $('.mydatepicker').datepicker({
        toggleActive: true,
        format: 'yyyy-mm-dd'
    }).on('changeDate', function (e) {
        $(this).datepicker('hide');
    });
    $('#receipt_timepay').bootstrapMaterialDatePicker({
        format: 'HH:mm',
        time: true,
        date: false
    });
</script>