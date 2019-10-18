<div id="on_modal" tabindex="-1" role="dialog" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><i class="fa fa-edit"></i>&nbsp;ลืมรหัสผ่าน</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <div class="bootbox-body">
                    <form id="form_modal" class="form-material m-t-10" method="post" action="<?php echo base_url() . 'admin/user/editpassword'; ?>" autocomplete="off">
                        <input type="hidden" name="user_id" id='user_id' value="<?php echo $user_id; ?>">
                        <input type="hidden" name="username" id='username' value="<?php echo $username; ?>">
                        <b><p class="text-danger text-center"><i class='fa fa-refresh'></i> ต้องการ เปลี่ยนรหัสผ่านเริ่มต้น เป็น 1234</p></b>
                        <br/>
                        <div class="form-group">
                            <div class="col-md-12 text-center">
                                <button type="submit" class="btn btn-sm btn-outline-info"><i class="fa fa-save"></i>&nbsp;ตกลง</button>
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