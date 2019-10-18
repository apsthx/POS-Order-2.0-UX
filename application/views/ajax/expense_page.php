

<table class="table table-striped table-bordered table-datatable">
    <thead>
        <tr>
            <th>#</th>
            <th class="text-left">บัญชี</th>
            <th class="text-left">ชื่อรายการ</th>
            <th class="text-left">ชื่อร้านที่จ่าย</th>
            <th class="text-right">จำนวนเงิน</th>
            <th class="text-center">วันที่ชำระ</th>
            <th class="text-center">สถานะ</th>
            <th class="text-center">ตัวเลือก</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $i = 1;
        if ($datas->num_rows() > 0) {
            foreach ($datas->result() as $data) {
                if ($data->status_expense_id == 1) {
                    $status = "badge badge-warning";
                } elseif ($data->status_expense_id == 2) {
                    $status = "badge badge-success";
                } elseif ($data->status_expense_id == 3) {
                    $status = "badge badge-danger";
                }
                ?>
                <tr>
                    <td class="text-center" style="vertical-align: middle;"><?php echo $i; ?></td>
                    <td class="text-left" style="vertical-align: middle;"><?php echo $data->bank_name.' '.$data->bank_number; ?></td>
                    <td class="text-left" style="vertical-align: middle;"><?php echo $data->expense_name; ?></td>
                    <td class="text-center" style="vertical-align: middle;"><?php echo $data->expense_shop; ?></td>
                    <td class="text-right" style="vertical-align: middle;"><?php echo number_format($data->expense_money, 2); ?></td>
                    <td class="text-center" style="vertical-align: middle;"><?php echo $this->mics->date2thai($data->expense_date_pay, '%d %m %y', 1); ?></td>
                    <td class="text-center" style="vertical-align: middle;"><span class="<?php echo $status; ?>"><?php echo $data->status_expense_name; ?></span></td>
                    <td class="text-center" style="vertical-align: middle;">
                        <button class="btn btn-outline-info btn-sm" onclick="modal_edit('<?php echo $data->expense_id; ?>');"><i class="fa fa-edit"></i> จัดการ</button>
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
                $('#open-modal-buy_price_edit').modal('hide');
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
                $('#open-modal-sale_price_edit').modal('hide');
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
                $('#open-modal-product_amount_edit').modal('hide');
                ajax();
            }
        });
        return false;
    }

</script>