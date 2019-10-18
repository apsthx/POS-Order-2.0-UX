<div class="modal-header">
    <h4 class="modal-title"><i class="fa fa-plus"></i>&nbsp;เพิ่ม</h4>
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
</div>
<div class="modal-body">
    <div class="bootbox-body">
        <form class="form-material m-t-10 form-parsley" method="post" action="<?php echo base_url() . 'wallet/add'; ?>" autocomplete="off">
            <div class="form-group">
                <label>เลขที่บัญชี</label>
                <input type="text" name="bank_number" class="form-control">
            </div>
            <div class="form-group">
                <label>ธนาคาร</label>
                <input type="text" name="bank_name" class="form-control" required>
            </div>
            <div class="form-group">
                <label>ชื่อเจ้าของบัญชี</label>
                <input type="text" name="bank_fullname" class="form-control" >
            </div>     
            <div class="form-group">
                <div class="col-md-12 text-center">
                    <button type="submit" class="btn btn-outline-info"><i class="fa fa-plus"></i>&nbsp;เพิ่ม</button>
                    <button type="button" class="btn btn-outline-danger" data-dismiss="modal" aria-hidden="true" ><i class="fa fa-close"></i>&nbsp;ยกเลิก</button>
                </div>
            </div>
        </form>
    </div>                    
</div>


<script>
    $(document).ready(function () {
        $('.form-parsley').parsley();
    });
</script>