<div class="modal-header">
    <h4 class="modal-title"><i class="fa fa-edit"></i>&nbsp;แก้ไขลูกค้า</h4>
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
</div>
<div class="modal-body">
    <div class="bootbox-body">
        <form class="form-horizontal" id="formedit" method="post" action="<?php echo base_url() . 'customer/edit'; ?>" autocomplete="off">
            <input type="hidden" name="customer_id_pri" value="<?php echo $data->customer_id_pri; ?>">
            <div class="form-group row">
                <label class="col-sm-2 text-right control-label col-form-label"> รหัสลูกค้า : <span class="text-danger">*</span></label>
                <div class="col-sm-3">
                    <input type="text" name="customer_id" value="<?php echo $data->customer_id; ?>" class="form-control" readonly="">
                </div>
                <label class="col-sm-2 text-right control-label col-form-label"> ชื่อลูกค้า : <span class="text-danger">*</span></label>
                <div class="col-sm-4">
                    <input type="text" name="fullname" value="<?php echo $data->fullname; ?>"  class="form-control" required>
                </div>
            </div>                   
            <div class="form-group row">
                <label class="col-sm-2 text-right control-label col-form-label"> เบอร์โทร : </label>
                <div class="col-sm-3">
                    <input type="text" name="tel" value="<?php echo $data->tel; ?>" onblur="check_phone_format(this);" class="form-control" >
                </div>
                <label class="col-sm-2 text-right control-label col-form-label"> อีเมล : </label>
                <div class="col-sm-4">
                    <input type="text" name="email" value="<?php echo $data->email; ?>" onblur="check_email_format(this);" class="form-control" >
                </div>
            </div>   
            <div class="form-group row">
                <label class="col-sm-2 text-right control-label col-form-label"> ที่อยู่ : </label>
                <div class="col-sm-9">
                    <textarea name="address" class="form-control" rows="1"><?php echo $data->address; ?></textarea>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 text-right control-label col-form-label"> ตำบล : </label>
                <div class="col-sm-3">
                    <input type="text" name="district" class="form-control" value="<?php echo $data->district; ?>">
                </div>
                <label class="col-sm-2 text-right control-label col-form-label"> อำเภอ : </label>
                <div class="col-sm-4">
                    <input type="text" name="amphoe" class="form-control" value="<?php echo $data->amphoe; ?>">
                </div>
            </div> 
            <div class="form-group row">
                <label class="col-sm-2 text-right control-label col-form-label"> จังหวัด : </label>
                <div class="col-sm-3">
                    <input type="text" name="province" class="form-control" value="<?php echo $data->province; ?>">
                </div>
                <label class="col-sm-2 text-right control-label col-form-label"> รหัสไปรษณีย์ : </label>
                <div class="col-sm-4">
                    <input type="text" name="zipcode" class="form-control" value="<?php echo $data->zipcode; ?>">
                </div>
            </div> 
            <div class="form-group row">
                <label class="col-sm-2 text-right control-label col-form-label"><i class="mdi mdi-facebook-box"></i></label>
                <div class="col-sm-3">
                    <input type="text" name="facebook" value="<?php echo $data->facebook; ?>" class="form-control" >
                </div>
                <label class="col-sm-2 text-right control-label col-form-label">LINE</label>
                <div class="col-sm-4">
                    <input type="text" name="line" value="<?php echo $data->line; ?>" class="form-control" >
                </div>
            </div> 
            <div class="form-group row">
                <label class="col-sm-2 text-right control-label col-form-label"><i class="fa fa-instagram"></i></label>
                <div class="col-sm-3">
                    <input type="text" name="instagram" value="<?php echo $data->instagram; ?>" class="form-control" >
                </div> 
            </div>   
            <div class="form-group row">
                <label class="col-sm-2 text-right control-label col-form-label"> เลขผู้เสียภาษี : </label>
                <div class="col-sm-9">
                    <input type="text" name="tax_id" value="<?php echo $data->tax_id; ?>" class="form-control">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 text-right control-label col-form-label"> บริษัท : </label>
                <div class="col-sm-4">
                    <input type="text" name="tax_shop" value="<?php echo $data->tax_shop; ?>" class="form-control">
                </div>
                <label class="col-sm-2 text-right control-label col-form-label"> สาขา : </label>
                <div class="col-sm-3">
                    <input type="text" name="tax_shop_sub" value="<?php echo $data->tax_shop_sub; ?>" class="form-control">
                </div>
            </div>
            <div class="form-group row">                
                <label class="col-sm-2 text-right control-label col-form-label"> ที่อยู่ : </label>
                <div class="col-sm-9">
                    <textarea name="tax_address" class="form-control" rows="2"><?php echo $data->tax_address; ?></textarea>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 text-right control-label col-form-label"> กลุ่มลูกค้า : </label>
                <div class="col-sm-6">
                    <select name="customer_group_id" class="form-control">
                        <?php foreach ($this->customer_model->get_groupcustomer()->result() as $datagroupcustomer) { ?>
                            <option value="<?php echo $datagroupcustomer->customer_group_id; ?>" <?php echo ($datagroupcustomer->customer_group_id == $data->customer_group_id) ? 'selected' : ''; ?>><?php echo $datagroupcustomer->customer_group_name; ?></option>
                        <?php }
                        ?>
                    </select>
                </div>
                <div class="col-sm-3">
                    <a href="<?php echo base_url() . 'groupcustomer'; ?>" target="_blank" style="float: right" class="btn btn-outline-info"><i class="fa fa-plus"></i> เพิ่มกลุ่มลูกค้า</a>
                </div>
            </div> 
            <div class="form-group">
                <div class="col-md-12 text-center">
                    <button type="submit" value="add" class="btn btn-outline-info"><i class="fa fa-save"></i>&nbsp;บันทึก</button>
                    &nbsp;
                    <button type="button" class="btn btn-outline-danger" data-dismiss="modal" aria-hidden="true" ><i class="fa fa-close"></i>&nbsp;ยกเลิก</button>
                </div>
            </div>
        </form>
    </div>                    
</div>

<script>
    $(function () {
        $('#formedit').parsley();
    });

    $.Thailand({
        database: service_base_url + 'assets/js/thailand-db/db.json',
        $district: $('#formedit [name="district"]'),
        $amphoe: $('#formedit [name="amphoe"]'),
        $province: $('#formedit [name="province"]'),
        $zipcode: $('#formedit [name="zipcode"]')
    });

</script>
