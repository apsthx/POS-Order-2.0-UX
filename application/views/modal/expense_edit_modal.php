<div class="modal-header">
    <h4 class="modal-title"><i class="fa fa-edit"></i>&nbsp;จัดการ</h4>
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
</div>
<div class="modal-body">

    <form method="post" id="form-edit" action="<?php echo base_url() . 'expense/edit'; ?>" autocomplete="off">

        <input type="hidden" name="expense_id" value="<?php echo $data->expense_id; ?>" >
        <input type="hidden" name="status_expense_id_befor" value="<?php echo $data->status_expense_id; ?>" >
        <input type="hidden" name="expense_money" value="<?php echo $data->expense_money; ?>" >
        <input type="hidden" name="bank_id" value="<?php echo $data->bank_id; ?>" >

        <?php
        if ($data->expense_image != NULL) {
            ?>
            <div class="row">
                <label class="col-md-3 control-label text-right">หลักฐานการโอนเงิน</label>
                <div class="col-md-8">
                    <a target="_blank" href="<?php echo base_url() . 'store/image/' . $data->expense_image; ?>">
                        <img src="<?php echo base_url() . 'store/image/' . $data->expense_image; ?>" with="120" height="100" />
                    </a>
                </div>
            </div>
            <p/>
            <?php
        }
        ?>
        <div class="row">
            <label class="col-md-3 control-label text-right">บัญชี</label>
            <div class="col-md-8">
                <input type="text" value="<?php echo $data->bank_name.' '.$data->bank_number; ?>" readonly="" class="form-control">
            </div>
        </div>
        <p/>
        <div class="row">
            <label class="col-md-3 control-label text-right">ชื่อรายการ<span class="text-danger">*</span></label>
            <div class="col-md-8">
                <input type="text" value="<?php echo $data->expense_name; ?>" readonly="" class="form-control" required="">
            </div>
        </div>
        <p/>
        <div class="row">
            <label class="col-md-3 control-label text-right">รายละเอียด</label>
            <div class="col-md-8">
                <textarea readonly="" class="form-control"><?php echo $data->expense_detail; ?></textarea>
            </div>
        </div>
        <p/>
        <div class="row">
            <label class="col-md-3 control-label text-right">จำนวนเงิน<span class="text-danger">*</span></label>
            <div class="col-md-8">
                <input type="number" value="<?php echo $data->expense_money; ?>" readonly="" class="form-control" required="">
            </div>
        </div>
        <p/>
        <div class="row">
            <label class="col-md-3 control-label text-right">วันที่จ่าย<span class="text-danger">*</span></label>
            <div class="col-md-8">
                <input type="text" value="<?php echo $data->expense_date_pay; ?>" readonly="" class="form-control">
            </div>
        </div>
        <p/>
        <div class="row">
            <label class="col-md-3 control-label text-right">เลขที่อ้างอิง</label>
            <div class="col-md-8">
                <input type="text" value="<?php echo $data->expense_refer; ?>" readonly="" class="form-control">
            </div>
        </div>
        <p/>
        <div class="row">
            <label class="col-md-3 control-label text-right">ชื่อร้านที่จ่าย<span class="text-danger">*</span></label>
            <div class="col-md-8">
                <input type="text" value="<?php echo $data->expense_shop; ?>" readonly="" class="form-control">
            </div>
        </div>
        <p/>
        <div class="row">
            <label class="col-md-3 control-label text-right">ที่อยู่ร้านที่จ่าย</label>
            <div class="col-md-8">
                <textarea readonly="" class="form-control"><?php echo $data->expense_shop_address; ?></textarea>
            </div>
        </div>
        <p/>
        <div class="row">
            <label class="col-md-3 control-label text-right">อีเมลติดต่อ</label>
            <div class="col-md-8">
                <input type="text" value="<?php echo $data->expense_shop_email; ?>" readonly="" class="form-control">
            </div>
        </div>
        <p/>
        <div class="row">
            <label class="col-md-3 control-label text-right">เบอร์โทรติดต่อ</label>
            <div class="col-md-8">
                <input type="text" value="<?php echo $data->expense_shop_tel; ?>" readonly="" class="form-control">
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
                        <option <?php echo ($data->status_expense_id == $row->status_expense_id) ? 'selected' : ''; ?> value="<?php echo $row->status_expense_id; ?>"><?php echo $row->status_expense_name; ?></option>
                        <?php
                    }
                    ?>
                </select>
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
</script>