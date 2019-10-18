<div class="modal-header">
    <h4 class="modal-title"><i class="fa fa-edit"></i>&nbsp;ลืมรหัสผ่าน</h4>
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
</div>
<div class="modal-body">
    <div class="bootbox-body">
        <form class="form-material m-t-10" method="post" onsubmit="return editpassword();" autocomplete="off">
            <input type="hidden" name="user_id_editpassword" id='user_id_editpassword' value="<?php echo $user_id ;?>">
            <input type="hidden" name="username_editpassword" id='username_editpassword' value="<?php echo $username ;?>">
            <b><p class="text-danger text-center"><i class='fa fa-refresh'></i> ต้องการ เปลี่ยนรหัสผ่านเริ่มต้น เป็น 1234</p></b>
            <br/>
            <div class="form-group">
                <div class="col-md-12 text-center">
                    <button type="submit" class="btn btn-outline-info"><i class="fa fa-save"></i>&nbsp;ตกลง</button>
                    &nbsp;
                    <button type="button" class="btn btn-outline-danger" data-dismiss="modal" aria-hidden="true" ><i class="fa fa-close"></i>&nbsp;ยกเลิก</button>
                </div>
            </div>
        </form>
    </div>                    
</div>