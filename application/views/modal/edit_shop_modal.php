<div class="modal-header">
    <h4 class="modal-title"><i class="fa fa-edit"></i>&nbsp;แก้ไข</h4>
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
</div>
<div class="modal-body">

    <form method="post" id="form-create" onsubmit="return edit_submit();" autocomplete="off">

        <input type="hidden" id="shop_id_pri" class="form-control" value="<?php echo $data->shop_id_pri; ?>">

        <div class="form-body">
            <div class="row">
                <div class="col-md-12 text-left">
                    <span style="color: red; font-size: 12px">* คือต้องกรอกให้ครบ</span>
                </div>
            </div>
            <p/>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label">รหัสร้าน</label>
                        <input type="text" disabled="" class="form-control" value="<?php echo $data->shop_id; ?>">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label">ชื่อร้าน หรือ นามแฝงตัวแทนจำหน่าย <span style="color: red;">*</span></label>
                        <input type="text" id="shop_name" class="form-control" value="<?php echo $data->shop_name; ?>" data-parsley-error-message="กรุณากรอกข้อมูล" required="">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label">เลขผู้เสียภาษี</label>
                        <input type="text" id="tax_id" value="<?php echo $data->tax_id; ?>" class="form-control">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label">เบอร์โทร</label>
                        <input type="text" id="tel_shop" value="<?php echo $data->tel_shop; ?>" onblur="check_phone_format(this);" class="form-control">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label">โทรสาร (Fax)</label>
                        <input type="text" id="fax_shop" value="<?php echo $data->fax_shop; ?>" class="form-control">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label">เว็บไซต์</label>
                        <input type="text" id="website_shop" value="<?php echo $data->website_shop; ?>" class="form-control">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label">Email</label>
                        <input type="text" id="email_shop" value="<?php echo $data->email_shop; ?>" onblur="check_email_format(this);" class="form-control">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label">ที่อยู่</label>
                        <textarea type="text" id="address_shop" rows="5" class="form-control"><?php echo $data->address_shop; ?></textarea>
                    </div>
                </div>
            </div>

            <input type="hidden" id="status_shop_id" id="status_shop_id" value="<?php echo $data->status_shop_id; ?>"/>
            <div class="row" style="margin-top:-15px;">
                <div id="i_status_1" class="col-sm-6 text-right" onclick="ChangeStatus('1');" style="cursor: pointer; color: <?php echo ($data->status_shop_id == 1) ? 'green' : 'gray' ?>;">
                    <i class="fa fa-check-circle-o fa-2x"></i>&nbsp;<b>เปิดใช้งานปกติ</b>
                </div>
                <div id="i_status_2" class="col-sm-6 text-left" onclick="ChangeStatus('2');" style="cursor: pointer; color:  <?php echo ($data->status_shop_id == 2) ? 'red' : 'gray' ?>;">
                    <i class="fa fa-ban fa-2x"></i>&nbsp;<b>ระงับการใช้งาน</b>
                </div>
            </div>
            <br/>

        </div>

        <div class="row">
            <div class="col-sm-12 text-center">
                <button type="submit" class="btn btn-outline-primary"><i class="fa fa-save"></i> บันทึก</button>
                <button type="button" class="btn btn-outline-danger" data-dismiss="modal" ><i class="fa fa-times"></i> ยกเลิก</button>
            </div>
        </div>
    </form>

</div>


<script>
    $(function () {
        $('#form-create').parsley();
    });
</script>