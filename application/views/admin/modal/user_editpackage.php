<div id="on_modal" tabindex="-1" role="dialog" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><i class="fa fa-gift"></i>&nbsp;อัพเดทแพ็กเกจ</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <div class="bootbox-body">
                    <form id="form_modal" method="post" action="<?php echo base_url() . 'admin/user/editpackage'; ?>" autocomplete="off">
                        <input type="hidden" name="user_id" value="<?php echo $data->user_id; ?>">
                        <div class="form-group row">
                            <label class="col-sm-4 text-right control-label col-form-label"> ชื่อผู้ใช้งาน: <span class="text-danger">*</span></label>
                            <div class="col-sm-5">
                                <input type="text" value="<?php echo $data->fullname; ?>" class="form-control" disabled="">
                            </div>
                        </div>  
                        <div class="form-group row">
                            <label class="col-sm-4 text-right control-label col-form-label"> แพ็กเกจ: <span class="text-danger">*</span></label>
                            <div class="col-sm-5">
                                <select name="package_id" class="form-control">
                                    <?php
                                    $packages = $this->user_model->package();
                                    if ($packages->num_rows() > 0) {
                                        foreach ($packages->result() as $package) {
                                            ?>
                                    <option value="<?php echo $package->package_id; ?>" <?php echo ($data->package_id == $package->package_id)? 'selected' : '' ; ?>><?php echo $package->package_name; ?></option>
                                        <?php
                                        }
                                    }
                                    ?>                                   
                                </select>
                            </div>  
                        </div> 
                        <div class="form-group">
                            <div class="col-sm-12 text-center">
                                <button type="submit" value="add" class="btn btn-sm btn-outline-info"><i class="fa fa-save"></i>&nbsp;บันทึก</button>
                                <button type="button" class="btn btn-sm btn-outline-danger" data-dismiss="modal" aria-hidden="true" ><i class="fa fa-close"></i>&nbsp;ยกเลิก</button>
                            </div>
                        </div>
                    </form>
                </div>                    
            </div>
        </div>
    </div>
</div>
<script>
    $(function () {
        $('#form_modal').parsley();
    });
</script>