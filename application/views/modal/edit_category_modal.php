<div class="modal-header">
    <h4 class="modal-title"><i class="fa fa-edit"></i>&nbsp;แก้ไข</h4>
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
</div>
<div class="modal-body">

    <form method="post" id="form-edit" action="<?php echo base_url() . 'category/edit'; ?>" autocomplete="off">

        <input type="hidden" name="product_category_id" value="<?php echo $data->product_category_id; ?>" >

        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label class="control-label">ชื่อหมวดหมู่สินค้า</label>
                    <input type="text" name="product_category_name" value="<?php echo $data->product_category_name; ?>" class="form-control" data-parsley-error-message="กรุณากรอกข้อมูล" required="">
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