<div id="on_modal" tabindex="-1" role="dialog" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><i class="fa fa-plus-circle"></i>&nbsp;เพิ่มบัญชีธนาคาร</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <div class="bootbox-body">
                    <form id="form_modal" class="form-material m-t-10" method="post" action="<?php echo base_url() . 'admin/bank/add'; ?>" autocomplete="off">
                        <div class="form-group row">
                            <label class="col-sm-4 text-right control-label col-form-label"> ธนาคาร: <span class="text-danger">*</span></label>
                            <div class="col-sm-5">
                                <input type="text" name="income_bank_name" id="income_bank_name" class="form-control"  required="">
                            </div>
                        </div>  
                        <div class="form-group row">
                            <label class="col-sm-4 text-right control-label col-form-label"> สาขา <span class="text-danger">*</span></label>
                            <div class="col-sm-5">
                                <input type="text" name="income_bank_branch" id="income_bank_branch" class="form-control"  required="">
                            </div>
                        </div> 
                        <div class="form-group row">
                            <label class="col-sm-4 text-right control-label col-form-label"> เลขที่บัญชี <span class="text-danger">*</span></label>
                            <div class="col-sm-5">
                                <input type="text" name="income_bank_account_name" id="income_bank_account_name" class="form-control"  required="">
                            </div>
                        </div> 
                        <div class="form-group row">
                            <label class="col-sm-4 text-right control-label col-form-label"> ชื่อบัญชี <span class="text-danger">*</span></label>
                            <div class="col-sm-5">
                                <input type="text" name="income_bank_accoun_number" id="income_bank_accoun_number" class="form-control"  required="">
                            </div>
                        </div> 
                        <div class="form-group">
                            <div class="col-sm-12 text-center">
                                <button type="submit" value="add" class="btn btn-sm btn-outline-info"><i class="fa fa-save"></i>&nbsp;บันทึก</button>
                                &nbsp;
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
    $(document).ready(function () {
        $('#form_modal').parsley();
    });
</script>