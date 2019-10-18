<div id="on_modal" tabindex="-1" role="dialog" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><i class="fa fa-edit"></i>&nbsp;แก้ไขการบริการ</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <div class="bootbox-body">
                    <form id="form_modal" class="form-material m-t-10" method="post" action="<?php echo base_url() . 'servicesadd/edit'; ?>" autocomplete="off">
                        <input type="hidden" name="services_id" id="services_id" value="<?php echo $data->services_id ?>">
                        <div class="form-group row">
                            <label class="col-sm-3 text-right control-label col-form-label"> ชื่อบริการ : <span class="text-danger">*</span></label>
                            <div class="col-sm-8">
                                <input type="text" name="services_name" id="services_name" value="<?php echo $data->services_name ?>" class="form-control" required="">
                            </div>
                        </div> 
                        <div class="form-group row">
                            <label class="col-sm-3 text-right control-label col-form-label"> ราคา : <span class="text-danger">*</span></label>
                            <div class="col-sm-8">
                                <input type="services_cost" name="services_cost" id="sms_cost" min="0" value="<?php echo $data->services_cost ?>" class="form-control" required="">
                            </div>
                        </div>                       
                        <div class="form-group">
                            <div class="col-sm-12 text-center">
                                <button type="submit" value="edit" class="btn btn-sm btn-outline-info"><i class="fa fa-save"></i>&nbsp;บันทึก</button>
                                <button type="button" class="btn btn-sm btn-outline-danger" data-dismiss="modal" aria-hidden="true" ><i class="fa fa-close"></i>&nbsp;ยกเลิก</button>
                            </div>
                        </div>
                    </form>
                </div>                    
            </div>
        </div>
    </div>
</div>