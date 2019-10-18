<form action="<?php echo $link; ?>" method="post">
    <div class="modal-header">
        <h4 class="modal-title"><i class="fa fa-trash"></i>&nbsp;ยืนยันการลบข้อมูล</h4>
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    </div>
    <div class="modal-body">
        <div class="bootbox-body text-center"><b>ยืนยันการลบข้อมูลนี้ ใช่หรือไม่ &nbsp;<i class="fa fa-question-circle"></i></b></div>
        <input type="hidden" name="id" value="<?php echo $id; ?>">
    </div>
    <div class="modal-footer">
        <button type="submit" class="btn btn-outline-danger" id="delete_bt_modal" value="1"><i class="fa fa-trash"></i>&nbsp;ตกลง</button>
        <button class="btn btn-outline-inverse" data-dismiss="modal"><i class="fa fa-close"></i>&nbsp;ยกเลิก</button>
    </div>
</form>