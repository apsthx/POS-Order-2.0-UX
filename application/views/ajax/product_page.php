

<table class="table table-striped table-bordered table-datatable">
    <thead>
        <tr>
            <th>#</th>
            <th class="text-center">รูป</th>
            <th class="text-center">รหัสสินค้า</th>
            <th class="text-center">ชื่อสินค้า</th>
            <th class="text-center">หมวดหมู่</th>
            <th class="text-center">ราคาซื้อ</th>
            <th class="text-center">ราคาขาย</th>
            <th class="text-center">น้ำหนัก</th>
            <th class="text-center">จำนวนคงเหลือ</th>
            <th class="text-center">หน่วย</th>
            <th class="text-center">สถานะ</th>
            <th class="text-center">ตัวเลือก</th>
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
                    <td class="text-center" style="vertical-align: middle;">
                        <a href="<?php echo base_url() . 'store/image/' . $data->image_name; ?>" target="_blank">
                            <img src="<?php echo base_url() . 'store/image/' . $data->image_name; ?>" width="40" height="40" />
                        </a>
                    </td>
                    <td style="vertical-align: middle;"><?php echo $data->product_id; ?></td>
                    <td style="vertical-align: middle;"><?php echo $data->product_name; ?></td>
                    <td style="vertical-align: middle;"><?php echo $data->product_category_name; ?></td>
                    <td style="vertical-align: middle;" class="text-right">
                        <a href="javascript:void(0);" onclick="modal_buy_price_edit('<?php echo $data->product_id; ?>', '<?php echo $data->product_buy_price; ?>');">
                            <?php echo number_format($data->product_buy_price, 2); ?>
                        </a>
                    </td>
                    <td style="vertical-align: middle;" class="text-right">
                        <a href="javascript:void(0);" onclick="modal_sale_price_edit('<?php echo $data->product_id; ?>', '<?php echo $data->product_sale_price; ?>');">
                            <?php echo number_format($data->product_sale_price, 2); ?>
                        </a>
                    </td>
                    <td style="vertical-align: middle;" class="text-right"><?php echo ($data->product_weight != NULL) ? $data->product_weight . ' kg.' : ''; ?></td>
                    <td style="vertical-align: middle;" class="text-right">
                            <?php echo number_format($data->product_amount, 0); ?>
                    </td>
                    <td style="vertical-align: middle;"><?php echo $data->product_unit; ?></td>
                    <td class="text-center" style="vertical-align: middle;">
                        <span class="badge badge-<?php echo ($data->status_product_id == 1) ? 'success' : 'danger'; ?>"><i class="<?php echo ($data->status_product_id == 1) ? 'fa fa-check-circle' : 'fa fa-times-circle'; ?>"></i>
                            <?php echo $data->status_product_name; ?>
                        </span>
                    </td>
                    <td class="text-center" style="vertical-align: middle;">
                        <button class="btn btn-outline-info btn-sm" onclick="modal_props('<?php echo $data->product_id_pri; ?>');"><i class="fa fa-list"></i> คุณสมบัติสินค้า</button>
                        <?php
                        if ($shop->type_shop_id == 1) {
                            ?>
                            <a href="<?php echo base_url() . 'product/change/' . $data->product_id_pri; ?>" class="btn btn-outline-primary btn-sm" ><i class="fa fa-edit"></i> แก้ไข</a>
                            <button class="btn btn-outline-danger btn-sm" onclick="modal_delete('<?php echo $data->product_id_pri; ?>');"><i class="fa fa-trash"></i> ลบ</button>
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



<div class="modal fade" id="open-modal-buy_price_edit">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><i class="fa fa-edit"></i>&nbsp;แก้ไข</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <div class="bootbox-body">
                    <form class="form-parsley" onsubmit="return edit_buy_price();">

                        <div class="row">
                            <label class="col-md-4 text-right"> ราคาซื้อ : </label>
                            <div class="col-md-8">
                                <input class="text-right" type="text"  onblur="check_price_format(this);" id="buy_price_edit" class="form-control">
                            </div>
                        </div> 
                        <br/>
                        <div class="row">
                            <label class="col-md-4"></label>
                            <div class="col-md-8">
                                <button type="submit" class="btn btn-outline-info"><i class="fa fa-save"></i>&nbsp;บันทึก</button>
                                &nbsp;
                                <button type="button" class="btn btn-outline-danger" data-dismiss="modal" aria-hidden="true" ><i class="fa fa-close"></i>&nbsp;ยกเลิก</button>
                            </div>
                        </div>
                    </form>
                </div>                    
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="open-modal-sale_price_edit">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><i class="fa fa-edit"></i>&nbsp;แก้ไข</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <div class="bootbox-body">
                    <form class="form-parsley" onsubmit="return edit_sale_price();">

                        <div class="row">
                            <label class="col-md-4 text-right"> ราคาขาย : </label>
                            <div class="col-md-8">
                                <input class="text-right" type="text"  onblur="check_price_format(this);" id="sale_price_edit" class="form-control">
                            </div>
                        </div> 
                        <br/>
                        <div class="row">
                            <label class="col-md-4"></label>
                            <div class="col-md-8">
                                <button type="submit" class="btn btn-outline-info"><i class="fa fa-save"></i>&nbsp;บันทึก</button>
                                &nbsp;
                                <button type="button" class="btn btn-outline-danger" data-dismiss="modal" aria-hidden="true" ><i class="fa fa-close"></i>&nbsp;ยกเลิก</button>
                            </div>
                        </div>
                    </form>
                </div>                    
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="open-modal-product_amount_edit">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><i class="fa fa-edit"></i>&nbsp;แก้ไข</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <div class="bootbox-body">
                    <form class="form-parsley" onsubmit="return edit_product_amount();">

                        <div class="row">
                            <label class="col-md-4 text-right"> จำนวนสินค้า : </label>
                            <div class="col-md-8">
                                <input class="text-right" type="text"  onblur="check_price_format(this);" id="product_amount_edit" class="form-control">
                            </div>
                        </div> 
                        <br/>
                        <div class="row">
                            <label class="col-md-4"></label>
                            <div class="col-md-8">
                                <button type="submit" class="btn btn-outline-info"><i class="fa fa-save"></i>&nbsp;บันทึก</button>
                                &nbsp;
                                <button type="button" class="btn btn-outline-danger" data-dismiss="modal" aria-hidden="true" ><i class="fa fa-close"></i>&nbsp;ยกเลิก</button>
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
        $('.table-datatable').DataTable();
        $('.form-parsley').parsley();
    });



    function modal_buy_price_edit(id, value) {
        $('#product_id').val(id);
        $('#buy_price_edit').val(value);
        $('#open-modal-buy_price_edit').modal('show', {backdrop: 'true'});
    }
    function edit_buy_price() {
        $('#open-modal-buy_price_edit').modal('hide');
        url = service_base_url + 'product/buy_price_edit';
        $('body').loading();
        $.ajax({
            url: url,
            method: "POST",
            data: {
                product_id: $('#product_id').val(),
                buy_price_edit: $('#buy_price_edit').val()
            },
            success: function ()
            {
                ajax();
            }
        });
        return false;
    }

    function modal_sale_price_edit(id, value) {
        $('#product_id').val(id);
        $('#sale_price_edit').val(value);
        $('#open-modal-sale_price_edit').modal('show', {backdrop: 'true'});
    }
    function edit_sale_price() {
        $('#open-modal-sale_price_edit').modal('hide');
        url = service_base_url + 'product/sale_price_edit';
        $('body').loading();
        $.ajax({
            url: url,
            method: "POST",
            data: {
                product_id: $('#product_id').val(),
                sale_price_edit: $('#sale_price_edit').val()
            },
            success: function ()
            {
                ajax();
            }
        });
        return false;
    }

    function modal_product_amount_edit(id, value) {
        $('#product_id').val(id);
        $('#product_amount_edit').val(value);
        $('#open-modal-product_amount_edit').modal('show', {backdrop: 'true'});
    }
    function edit_product_amount() {
        $('#open-modal-product_amount_edit').modal('hide');
        url = service_base_url + 'product/product_amount_edit';
        $('body').loading();
        $.ajax({
            url: url,
            method: "POST",
            data: {
                product_id: $('#product_id').val(),
                product_amount_edit: $('#product_amount_edit').val()
            },
            success: function ()
            {
                ajax();
            }
        });
        return false;
    }

</script>