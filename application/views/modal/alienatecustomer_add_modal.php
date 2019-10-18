<div class="modal-header">
    <h4 class="modal-title"><i class="fa fa-plus"></i>&nbsp;สร้าง</h4>
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
</div>
<div class="modal-body">

    <form method="post" action="<?php echo base_url() . 'alienatecustomer/add'; ?>" enctype="multipart/form-data" autocomplete="off">

        <div class="row">
            <label class="col-md-3 control-label text-right">ธนาคารที่โอน<span class="text-danger">*</span></label>
            <div class="col-md-8">
                <select name="bank_id" class="form-control">
                    <?php
                    $bank = $this->alienatecustomer_model->get_bank();
                    foreach ($bank->result() as $row) {
                        ?>
                        <option value="<?php echo $row->bank_id; ?>"><?php echo $row->bank_name.' '.$row->bank_number; ?></option>
                        <?php
                    }
                    ?>
                </select>
            </div>
        </div>
        <p/>
        <div class="row">
            <label class="col-md-3 control-label text-right">วันที่ชำระ<span class="text-danger">*</span></label>
            <div class="col-md-8">
                <?php $date = Date('Y-m-d'); ?>
                <input type="text" name="date_pay" value="<?php echo $date; ?>" class="form-control mydatepicker" required="">
            </div>
        </div>
        <p/>
        <div class="row">
            <label class="col-md-3 control-label text-right">เวลาที่ชำระ<span class="text-danger">*</span></label>
            <div class="col-md-8">
                <input type="text" name="time_pay" class="form-control" required="" placeholder="เช่น 23:50">
            </div>
        </div>
        <p/>
        <div class="row">
            <label class="col-md-3 control-label text-right">จำนวนเงินที่โอน<span class="text-danger">*</span></label>
            <div class="col-md-8">
                <input type="number" name="money" class="form-control" required="">
            </div>
        </div>
        <p/>
        <div class="row">
            <label class="col-md-3 control-label text-right">หลักฐาน</label>
            <div class="col-md-2">
                <label for="upload-image" class="btn btn-info btn-xl">
                    <i class="fa fa-image"></i> อัพรูปหลักฐาน
                    <input type="file" accept="image/*" name="image" onchange="$('#text-image').html($('#upload-image').val());" id="upload-image" style="display: none" data-parsley-id="4">
                </label>
            </div>
            <label class="col-md-3 control-label" id="text-image"></label>
        </div>
        <p/>
        <?php $customer = $this->alienatecustomer_model->get_customer()->row(); ?>
        <div class="row">
            <label class="col-md-3 control-label text-right">รหัสลูกค้า</label>
            <div class="col-md-8">
                <input type="text" name="customer_id" value="<?php echo $customer->customer_id ?>" class="form-control" readonly="">
            </div>
        </div>
        <p/>
        <div class="row">
            <label class="col-md-3 control-label text-right">ชื่อลูกค้า<span class="text-danger">*</span></label>
            <div class="col-md-8">
                <input type="text" name="customer_name" value="<?php echo $customer->fullname ?>"  class="form-control" required="" readonly="">
            </div>
        </div>
        <p/>
        <div class="row">
            <label class="col-md-3 control-label text-right">อีเมลลูกค้า</label>
            <div class="col-md-8">
                <input type="text" name="customer_email" value="<?php echo $customer->email ?>"  class="form-control">
            </div>
        </div>
        <p/>
        <div class="row">
            <label class="col-md-3 control-label text-right">เบอร์โทรลูกค้า</label>
            <div class="col-md-8">
                <input type="text" name="customer_tel" value="<?php echo $customer->tel ?>" class="form-control">
            </div>
        </div>
        <p/>
        <div class="row">
            <div class="col-md-12 text-center">
                <button type="submit" id="bt-submit" class="btn btn-outline-info"><i class="fa fa-save"></i>&nbsp;บันทึก</button>
                <button type="button" class="btn btn-outline-danger" data-dismiss="modal" aria-hidden="true" ><i class="fa fa-close"></i>&nbsp;ยกเลิก</button>
            </div>
        </div>
    </form>

</div>


<script>
    $(function () {
        $('#form-edit').parsley();
    });
    $('.mydatepicker').datepicker({
        toggleActive: true, 
        format: 'yyyy-mm-dd'
    }).on('changeDate', function(e){
        $(this).datepicker('hide');
    });
</script>