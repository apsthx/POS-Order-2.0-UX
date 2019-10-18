<div class="modal-header">
    <h4 class="modal-title"><i class="fa fa-plus"></i>&nbsp;สร้าง</h4>
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
</div>
<div class="modal-body">

    <form method="post" id="form-add" action="<?php echo base_url() . 'expense/add'; ?>" autocomplete="off" enctype="multipart/form-data">

        <div class="row">
            <label class="col-md-3 control-label text-right">ธนาคารที่โอน<span class="text-danger">*</span></label>
            <div class="col-md-8">
                <select name="bank_id" class="form-control">
                    <?php
                    $bank = $this->expense_model->get_bank();
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
            <label class="col-md-3 control-label text-right">ชื่อรายการ<span class="text-danger">*</span></label>
            <div class="col-md-8">
                <input type="text" name="expense_name" class="form-control" data-parsley-error-message="กรุณากรอกข้อมูล"  required="">
            </div>
        </div>
        <p/>
        <div class="row">
            <label class="col-md-3 control-label text-right">รายละเอียด</label>
            <div class="col-md-8">
                <textarea name="expense_detail" class="form-control"></textarea>
            </div>
        </div>
        <p/>
        <div class="row">
            <label class="col-md-3 control-label text-right">จำนวนเงิน<span class="text-danger">*</span></label>
            <div class="col-md-8">
                <input type="number" name="expense_money" class="form-control" data-parsley-error-message="กรุณากรอกข้อมูล"  required="">
            </div>
        </div>
        <p/>
        <div class="row">
            <label class="col-md-3 control-label text-right">วันที่จ่าย<span class="text-danger">*</span></label>
            <div class="col-md-8">
                <?php $date = Date('Y-m-d'); ?>
                <input type="text" name="expense_date_pay" value="<?php echo $date; ?>" class="form-control mydatepicker" required="">
            </div>
        </div>
        <p/>
        <div class="row">
            <label class="col-md-3 control-label text-right">เลขที่อ้างอิง</label>
            <div class="col-md-8">
                <input type="text" name="expense_refer" class="form-control">
            </div>
        </div>
        <p/>
        <div class="row">
            <label class="col-md-3 control-label text-right">รูปภาพ<span class="text-danger">*</span></label>
            <div class="col-md-8">
                <label  for="upload-image" class="btn btn-info btn-xl">
                    <i class="fa fa-image"></i> อัพโหลดรูป
                    <input type="file" accept="image/*" name="image" id="upload-image" onchange="$('#upload-text').html($('#upload-image').val());" style="display: none">
                </label> <span id="upload-text"></span>
            </div>
        </div>
        <p/>
        <div class="row">
            <label class="col-md-3 control-label text-right">ชื่อร้านที่จ่าย<span class="text-danger">*</span></label>
            <div class="col-md-8">
                <input type="text" name="expense_shop" class="form-control" required="">
            </div>
        </div>
        <p/>
        <div class="row">
            <label class="col-md-3 control-label text-right">ที่อยู่ร้านที่จ่าย</label>
            <div class="col-md-8">
                <textarea name="expense_shop_address" class="form-control"></textarea>
            </div>
        </div>
        <p/>
        <div class="row">
            <label class="col-md-3 control-label text-right">อีเมลติดต่อ</label>
            <div class="col-md-8">
                <input type="text" name="expense_shop_email" class="form-control">
            </div>
        </div>
        <p/>
        <div class="row">
            <label class="col-md-3 control-label text-right">เบอร์โทรติดต่อ</label>
            <div class="col-md-8">
                <input type="text" name="expense_shop_tel" class="form-control">
            </div>
        </div>
        <p/>
        <div class="row">
            <label class="col-md-3 control-label text-right">สถานะ<span class="text-danger">*</span></label>
            <div class="col-md-8">
                <select name="status_expense_id" class="form-control">
                    <?php
                    $status_expense = $this->db->get('ref_status_expense');
                    foreach ($status_expense->result() as $row) {
                        ?>
                        <option value="<?php echo $row->status_expense_id; ?>"><?php echo $row->status_expense_name; ?></option>
                        <?php
                    }
                    ?>
                </select>
            </div>
        </div>

        <br/>

        <div class="row">
            <div class="col-md-12 text-center">
                <button type="submit" id="bt-submit" class="btn btn-outline-info"><i class="fa fa-save"></i>&nbsp;บันทึก</button>
                <button type="button" class="btn btn-outline-danger" data-dismiss="modal" aria-hidden="true" ><i class="fa fa-close"></i>&nbsp;ยกเลิก</button>
            </div>
        </div>
        <br/>
    </form>

</div>


<script>
    $(function () {
        $('#form-add').parsley();
    });
    $('.mydatepicker').datepicker({
        toggleActive: true, 
        format: 'yyyy-mm-dd'
    }).on('changeDate', function(e){
        $(this).datepicker('hide');
    });
</script>