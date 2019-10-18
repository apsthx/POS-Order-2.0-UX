<div id="on_modal" tabindex="-1" role="dialog" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><i class="fa fa-edit"></i>&nbsp;แก้ไขผู้ใช้งาน</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <div class="bootbox-body">
                    <form id="form_modal" method="post" action="<?php echo base_url() . 'admin/user/edit'; ?>" autocomplete="off">
                        <input type="hidden" name="user_id" value="<?php echo $data->user_id; ?>">
                        <div class="form-group row">
                            <label class="col-sm-4 text-right control-label col-form-label"> ชื่อผู้ใช้งาน: <span class="text-danger">*</span></label>
                            <div class="col-sm-5">
                                <input type="text" name="fullname" value="<?php echo $data->fullname; ?>" class="form-control"  required="">
                            </div>
                        </div>  
                        <div class="form-group row">
                            <label class="col-sm-4 text-right control-label col-form-label"> อีเมล: <span class="text-danger">*</span></label>
                            <div class="col-sm-5">
                                <input type="text" name="email" value="<?php echo $data->email; ?>" class="form-control"  required="">
                            </div>  
                        </div> 
                        <div class="form-group row">
                            <label class="col-sm-4 text-right control-label col-form-label"> เบอร์โทร: <span class="text-danger">*</span></label>
                            <div class="col-sm-5">
                                <input type="text" name="tel" value="<?php echo $data->tel; ?>" class="form-control"  required="">
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
