<div id="on_modal" tabindex="-1" role="dialog" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><i class="fa fa-plus-circle"></i>&nbsp;เพิ่มบริการ SMS</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <div class="bootbox-body">
                    <form id="form_modal" class="form-material m-t-10" method="post" action="<?php echo base_url() . 'admin/package/addsms'; ?>" autocomplete="off">
                        <div class="form-group row">
                            <label class="col-sm-4 text-right control-label col-form-label"> ชื่อ SMS : <span class="text-danger">*</span></label>
                            <div class="col-sm-5">
                                <input type="text" name="sms_name" id="sms_name" class="form-control" required="">
                            </div>
                        </div> 
                        <div class="form-group row">
                            <label class="col-sm-4 text-right control-label col-form-label"> ราคา : <span class="text-danger">*</span></label>
                            <div class="col-sm-5">
                                <input type="number" name="sms_cost" id="sms_cost" class="form-control" required="">
                            </div>
                        </div> 
                        <div class="form-group row">
                            <label class="col-sm-4 text-right control-label col-form-label"> จำนวนข้อความ	 : <span class="text-danger">*</span></label>
                            <div class="col-sm-5">
                                <input type="number" name="sms_amount" id="sms_amount" class="form-control" required="">
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