<div class="modal-header">
    <h4 class="modal-title"><i class="fa fa-edit"></i>&nbsp;จัดการ</h4>
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
</div>
<div class="modal-body">

    <form method="post" action="<?php echo base_url() . 'alienatecustomer/edit'; ?>" autocomplete="off">

        <input type="hidden" name="inform_payment_id" value="<?php echo $data->inform_payment_id; ?>" >
        <input type="hidden" name="status_inform_id_befor" value="<?php echo $data->status_inform_id; ?>" >
        <input type="hidden" name="money" value="<?php echo $data->money; ?>" >
        <input type="hidden" name="bank_id" value="<?php echo $data->bank_id; ?>" >

        <div class="row">
            <label class="col-md-3 control-label text-right">หลักฐานการโอนเงิน</label>
            <div class="col-md-8">
                <a target="_blank" href="<?php echo base_url() . 'store/image/' . $data->image_name; ?>">
                    <img src="<?php echo base_url() . 'store/image/' . $data->image_name; ?>" with="120" height="100" />
                </a>
            </div>
        </div>
        <p/>
        
        <div class="row">
            <label class="col-md-3 control-label text-right">ธนาคารที่โอน</label>
            <div class="col-md-8">
                <input type="text" value="<?php echo $data->bank_name.' '.$data->bank_number; ?>" class="form-control" readonly="">
            </div>
        </div>
        <p/>
        <div class="row">
            <label class="col-md-3 control-label text-right">วันที่ชำระ</label>
            <div class="col-md-8">
                <input type="text" value="<?php echo $this->mics->date2thai($data->date_pay, '%d %m %y', 1); ?>" class="form-control" readonly="">
            </div>
        </div>
        <p/>
        <div class="row">
            <label class="col-md-3 control-label text-right">เวลาที่ชำระ</label>
            <div class="col-md-8">
                <input type="text" value="<?php echo $data->time_pay; ?>" class="form-control" readonly="">
            </div>
        </div>
        <p/>
        <div class="row">
            <label class="col-md-3 control-label text-right">จำนวนเงินที่โอน</label>
            <div class="col-md-8">
                <input type="text" value="<?php echo number_format($data->money, 2); ?>" class="form-control" readonly="">
            </div>
        </div>
        <p/>
        <div class="row">
            <label class="col-md-3 control-label text-right">รหัสลูกค้า</label>
            <div class="col-md-8">
                <input type="text" value="<?php echo $data->customer_id; ?>" class="form-control" readonly="">
            </div>
        </div>
        <p/>
        <div class="row">
            <label class="col-md-3 control-label text-right">ชื่อลูกค้า</label>
            <div class="col-md-8">
                <input type="text" value="<?php echo $data->customer_name; ?>" class="form-control" readonly="">
            </div>
        </div>
        <p/>
        <div class="row">
            <label class="col-md-3 control-label text-right">อีเมลลูกค้า</label>
            <div class="col-md-8">
                <input type="text" value="<?php echo $data->customer_email; ?>" class="form-control" readonly="">
            </div>
        </div>
        <p/>
        <div class="row">
            <label class="col-md-3 control-label text-right">เบอร์โทรลูกค้า</label>
            <div class="col-md-8">
                <input type="text" value="<?php echo $data->customer_tel; ?>" class="form-control" readonly="">
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