
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-block">
                <h4 class="card-title">
                    <i class="<?php echo $icon; ?>"></i> <?php echo " " . $title; ?>
                    <?php
                    if ($shop->type_shop_id == 1) {
                        ?>
                        <button type="button" style="float: right" class="btn btn-sm btn-rounded btn-outline-success" onclick="modaladd();"><i class="fa fa-plus"></i> เพิ่มหมวดหมู่สินค้า</button>
                        <span style="float: right">&nbsp;</span>
                        <?php
                    }
                    ?>
                </h4>

                <div class="table-responsive" id="result-page"></div>

            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="open-modal">
    <div class="modal-dialog">
        <div class="modal-content"></div>
    </div>
</div>



<div class="modal fade" id="add">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><i class="fa fa-plus-circle"></i>&nbsp;เพิ่มหมวดหมู่สินค้า</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <div class="bootbox-body">
                    <form class="form-horizontal" id="form-add" method="post" action="<?php echo base_url() . 'category/add'; ?>" autocomplete="off">

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label">ชื่อหมวดหมู่สินค้า</label>
                                    <input type="text" name="product_category_name" class="form-control" data-parsley-error-message="กรุณากรอกข้อมูล" required="">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-12 text-center">
                                <button type="submit" id="bt-submit" class="btn btn-outline-info"><i class="fa fa-plus"></i>&nbsp;เพิ่ม</button>
                                <button type="button" class="btn btn-outline-danger" data-dismiss="modal" aria-hidden="true" ><i class="fa fa-close"></i>&nbsp;ยกเลิก</button>
                            </div>
                        </div>
                    </form>
                </div>                    
            </div>
        </div>
    </div>
</div>


<div class="modal fade in" id="modal-delete">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="<?php echo base_url() . 'category/delete' ?>" method="post">
                <div class="modal-header">
                    <h4 class="modal-title"><i class="fa fa-trash"></i>&nbsp;ยืนยันการลบข้อมูล</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <div class="bootbox-body text-center"><b>ยืนยันการลบข้อมูลนี้ ใช่หรือไม่ &nbsp;<i class="fa fa-question-circle"></i></b></div>
                    <input type="hidden" name="delete_id" id="delete_id">
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-outline-danger" id="delete_bt_modal" value="1"><i class="fa fa-trash"></i>&nbsp;ตกลง</button>
                    <button class="btn btn-outline-inverse" data-dismiss="modal"><i class="fa fa-close"></i>&nbsp;ยกเลิก</button>
                </div>
            </form>
        </div>
    </div>
</div>


<div class="modal fade in" id="modal-delete-no">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><i class="fa fa-trash"></i>&nbsp;ยืนยันการลบข้อมูล</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <div class="bootbox-body text-center"><b style="color: #F89A14;">ไม่สามารถลบข้อมูลนี้ได้ เนื่องจากข้อมูลมีการถูกใช้งาน &nbsp;<i class="fa fa-warning"></i></b></div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-outline-inverse" data-dismiss="modal"><i class="fa fa-close"></i>&nbsp;ปิด</button>
            </div>
        </div>
    </div>
</div>
