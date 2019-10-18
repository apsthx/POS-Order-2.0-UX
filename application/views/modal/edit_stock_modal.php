<div class="modal-header">
    <h4 class="modal-title"><i class="fa fa-edit"></i>&nbsp;แก้ไข</h4>
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
</div>
<div class="modal-body">

    <form method="post" id="form-edit" action="<?php echo base_url() . 'stock/edit'; ?>" autocomplete="off">

        <input type="hidden" name="stock_id_pri" value="<?php echo $data->stock_id_pri; ?>" >

        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label class="control-label">ชื่อคลัง</label>
                    <input type="text" name="stock_name" value="<?php echo $data->stock_name; ?>" class="form-control" data-parsley-error-message="กรุณากรอกข้อมูล" required="">
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 text-center">
                <button type="submit" id="bt-submit" class="btn btn-outline-info"><i class="fa fa-save"></i>&nbsp;บันทึก</button>
                <button type="button" class="btn btn-outline-danger" data-dismiss="modal" aria-hidden="true" ><i class="fa fa-close"></i>&nbsp;ยกเลิก</button>
            </div>
        </div>
    </form>

</div>


<script>
    $(function () {
        $('#form-edit').parsley();
    });
</script>