<div class="modal-header">
    <h4 class="modal-title"><i class="fa fa-edit"></i>&nbsp;แก้ไขผู้ใช้งาน</h4>
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
</div>
<div class="modal-body">
    <div class="bootbox-body">
        <form class="form-horizontal" id="formedit" method="post" action="<?php echo base_url() . 'user/edit'; ?>" autocomplete="off">
            <input type="hidden" name="user_id" value="<?php echo $data->user_id; ?>">
            <div class="form-group row">
                <label class="col-sm-2 text-right control-label col-form-label"> ชื่อผู้ใช้งาน : <span class="text-danger">*</span></label>
                <div class="col-sm-9">
                    <input type="text" name="fullname" value="<?php echo $data->fullname; ?>"  class="form-control" required>
                </div>
            </div>                   
            <div class="form-group row">
                <label class="col-sm-2 text-right control-label col-form-label"> เบอร์โทร : </label>
                <div class="col-sm-3">
                    <input <?php echo ($data->type_user_id == 1)? 'readonly':'' ?> type="text" name="tel" value="<?php echo $data->tel; ?>" onblur="check_phone_format(this);" class="form-control" >
                </div>
                <label class="col-sm-2 text-right control-label col-form-label"> อีเมล : </label>
                <div class="col-sm-4">
                    <input type="text" name="email" value="<?php echo $data->email; ?>" onblur="check_email_format(this);" class="form-control" >
                </div>
            </div>   
            <div class="form-group row">
                <label class="col-sm-2 text-right control-label col-form-label"> ที่อยู่ : </label>
                <div class="col-sm-9">
                    <textarea name="address" class="form-control" rows="2"><?php echo $data->address; ?></textarea>
                </div>
            </div>  
            <div class="form-group row">
                <label class="col-sm-2 text-right control-label col-form-label"> เพิ่มเติม : </label>
                <div class="col-sm-9">
                    <textarea name="comment" class="form-control" rows="2"><?php echo $data->comment; ?></textarea>
                </div>
            </div>  
            <?php
            if ($data->role_id == 1) {
                ?>
                <input type="hidden" name="role_id" value="1" />
                <?php
            } else {
                ?>
                <div class="form-group row">
                    <label class="col-sm-2 text-right control-label col-form-label"> สิทธิ์การใช้งานระบบ : </label>
                    <div class="col-sm-6">
                        <select name="role_id" class="form-control">
                            <?php
                            $type_shop_id = $this->accesscontrol->getMyShop()->type_shop_id;
                            foreach ($this->user_model->get_role_group($type_shop_id)->result() as $datarole) {
                                ?>
                                <option value="<?php echo $datarole->role_id; ?>" <?php echo ($datarole->role_id == $data->role_id) ? 'selected' : ''; ?>><?php echo $datarole->role_name; ?></option>
                            <?php }
                            ?>
                        </select>
                    </div>
                </div> 
                <?php
            }
            ?>
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
</script>
