<div id="on_modal" tabindex="-1" role="dialog" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><i class="fa fa-plus-circle"></i>&nbsp;เพิ่มแพ็กเกจ</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <div class="bootbox-body">
                    <form id="form_modal" class="form-material m-t-10" method="post" action="<?php echo base_url() . 'admin/package/add'; ?>" autocomplete="off">
                        <div class="form-group row">
                            <label class="col-sm-4 text-right control-label col-form-label"> ชื่อแพ็กเกจ : <span class="text-danger">*</span></label>
                            <div class="col-sm-5">
                                <input type="text" name="package_name" id="package_name" class="form-control"  required="">
                            </div>
                        </div> 
                        <div class="form-group row">
                            <label class="col-sm-4 text-right control-label col-form-label"> ราคา : <span class="text-danger">*</span></label>
                            <div class="col-sm-5">
                                <input type="text" name="package_cost" id="package_cost" class="form-control"  required="">
                            </div>
                        </div> 
                        <div class="form-group row">
                            <label class="col-sm-4 text-right control-label col-form-label"> ผู้ใช้ระบบ : <span class="text-danger">*</span></label>
                            <div class="col-sm-5">
                                <input type="number" name="package_useuser" id="package_useuser" class="form-control"  required="">
                            </div>
                        </div> 
                        <div class="form-group row">
                            <label class="col-sm-4 text-right control-label col-form-label"> สาขาย่อย : <span class="text-danger">*</span></label>
                            <div class="col-sm-5">
                                <input type="number" name="package_useshop" id="package_useshop" class="form-control"  required="">
                            </div>
                        </div> 
                        <div class="form-group row">
                            <label class="col-sm-4 text-right control-label col-form-label"> ตัวแทนจำหน่าย : <span class="text-danger">*</span></label>
                            <div class="col-sm-5">
                                <input type="number" name="package_useagent" id="package_useagent" class="form-control"  required="">
                            </div>
                        </div> 
                        <div class="form-group row">
                            <label class="col-sm-4 text-right control-label col-form-label"> Free SMS : <span class="text-danger">*</span></label>
                            <div class="col-sm-5">
                                <input type="number" name="package_sms" id="package_sms" class="form-control"  required="">
                            </div>
                        </div> 
                        <div class="form-group row">
                            <label class="col-sm-4 text-right control-label col-form-label"> จำกัดวัน : <span class="text-danger">*</span></label>
                            <div class="col-sm-5">
                                <input type="number" name="package_usedate" id="package_usedate" class="form-control"  required="">
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