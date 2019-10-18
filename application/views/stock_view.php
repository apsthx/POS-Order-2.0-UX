
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-block">
                <h4 class="card-title">
                    <i class="<?php echo $icon; ?>"></i> <?php echo " " . $title; ?>
                    <?php
                    if ($shop->type_shop_id == 1) {
                        ?>
                        <button type="button" style="float: right" class="btn btn-sm btn-rounded btn-outline-success" onclick="modaladd();"><i class="fa fa-plus"></i> เพิ่มคลังสินค้า</button>
                        <?php
                    }
                    ?>
                    <span style="float: right">&nbsp;</span>
                </h4>


                <table class="table table-striped table-bordered table-datatable">
                    <thead>
                        <tr>
                            <th width="50">#</th>
                            <th class="text-left">รหัส</th>
                            <th class="text-left">ชื่อคลัง</th>
                            <th class="text-right" width="200">สินค้าคงคลัง</th>
                            <th class="text-center" width="300">ตัวเลือก</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 1;
                        if ($datas->num_rows() > 0) {
                            foreach ($datas->result() as $data) {
                                ?>
                                <tr>
                                    <td class="text-center" style="vertical-align: middle;"><?php echo $i; ?></td>
                                    <td style="vertical-align: middle;"><?php echo $data->stock_id; ?></td>
                                    <td style="vertical-align: middle;"><?php echo $data->stock_name; ?></td>
                                    <?php
                                    $sum_product = $this->stock_model->sum_product_in_stock($data->stock_id_pri);
                                    ?>
                                    <td class="text-right" style="vertical-align: middle;"><?php echo number_format($sum_product); ?></td>
                                    <td class="text-center" style="vertical-align: middle;">
                                        <a class="btn btn-outline-warning btn-sm" href="<?php echo base_url() . 'stock/manage/' . $data->stock_id_pri; ?>"><i class="fa fa-list"></i> สินค้าในคลัง</a>
                                        <?php
                                        if ($shop->type_shop_id == 1) {
                                            ?>
                                            <button class="btn btn-outline-primary btn-sm" onclick="edit_modal('<?php echo $data->stock_id_pri; ?>');"><i class="fa fa-edit"></i> แก้ไข</button>
                                            <button class="btn btn-outline-danger btn-sm" onclick="modal_delete('<?php echo $data->stock_id_pri; ?>');"><i class="fa fa-trash"></i> ลบ</button>
                                            <?php
                                        }
                                        ?>       
                                    </td>
                                </tr>
                                <?php
                                $i++;
                            }
                        }
                        ?>                    
                    </tbody>
                </table>

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
                <h4 class="modal-title"><i class="fa fa-plus-circle"></i>&nbsp;เพิ่มคลังสินค้า</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <div class="bootbox-body">
                    <form class="form-horizontal" id="form-add" method="post" action="<?php echo base_url() . 'stock/add'; ?>" autocomplete="off">

                        <div class="row">
<!--                            <div class="col-md-12">
                                <label class="control-label">รหัสคลัง <span id="stock_id_massage" style="color: red;"></span></label>
                                <input type="text" name="stock_id" class="form-control" value="<?php //echo $setting->stock_id_default; ?>" onkeypress="if (event.keyCode === 13) {
                                            check_stock_id(this, '<?php //echo $setting->stock_id_default; ?>');
                                        }" onblur="check_stock_id(this, '<?php //echo $setting->stock_id_default; ?>');" data-parsley-error-message="กรุณากรอกข้อมูล" required="">
                            </div>-->
                        </div>
                        <p/>
                        <div class="row">
                            <div class="col-md-12">
                                <label class="control-label">ชื่อคลัง</label>
                                <input type="text" name="stock_name" class="form-control" data-parsley-error-message="กรุณากรอกข้อมูล" required="">
                            </div>
                        </div>
                        <br/>
                        <div class="row">
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
            <form action="<?php echo base_url() . 'stock/delete' ?>" method="post">
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
