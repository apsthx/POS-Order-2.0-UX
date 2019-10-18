<form onsubmit="return add_product();">

    <div class="table-responsive">

        <table class="table table-striped table-bordered table-datatable">
            <thead>
                <tr>
                    <th width="50">#</th>
                    <th class="text-center">สินค้า</th>
                    <th class="text-center">จำนวนทั้งหมด</th>
                    <th class="text-center">สามารถเพิ่มได้</th>
                    <th class="text-center">จำนวนที่จะเพิ่ม</th>
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
                            <td><?php echo $data->product_name; ?></td>
                            <td class="text-right"><?php echo number_format($data->product_amount); ?></td>
                            <?php
                            $amount_can_add = $this->stock_model->amount_can_add($data->product_id_pri, $data->product_amount);
                            ?>
                            <td class="text-right"><?php echo number_format($amount_can_add); ?></td>
                            <td class="text-center">
                                <input type="hidden" name="product_id_pri[]" class="product_id_pri" value="<?php echo $data->product_id_pri; ?>">
                                <input type="number" name="amount_add[]" class="amount_add form-control text-right" min="1" max="<?php echo $amount_can_add; ?>" <?php echo ($amount_can_add < 1) ? 'disabled' : ''; ?> style="width: 80px;">
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
    <br/>
    <div class="row">
        <div class="col-md-12 text-center">
            <button type="submit" id="bt-submit" class="btn btn-outline-info"><i class="fa fa-plus"></i>&nbsp;เพิ่ม</button>
            <button type="button" class="btn btn-outline-danger" data-dismiss="modal" aria-hidden="true"><i class="fa fa-close"></i>&nbsp;ยกเลิก</button>
        </div>
    </div>
    <br/>

</form>

<script>
    $(document).ready(function () {
        $('.table-datatable').DataTable();
    });

    function add_product() {
        var stock_id_pri = $('#stock_id_pri').val();
        var product_id_pri = $("input.product_id_pri");
        var amount_add = $("input.amount_add");

        var product_id_pri_arr = $.map(product_id_pri, function (element) {
            return element.value;
        });
        var amount_add_arr = $.map(amount_add, function (element) {
            return element.value;
        });

        url = service_base_url + 'stock/add_product';
        $('#page-add-product').html('<div style="text-align:center; padding:80px;"><i class="fa fa-refresh fa-spin fa-3x fa-fw"></i></div>');
        $.ajax({
            url: url,
            method: "POST",
            data: {
                stock_id_pri: stock_id_pri,
                product_id_pri_arr: product_id_pri_arr,
                amount_add_arr: amount_add_arr
            },
            success: function (res)
            {
                $('#open-modal').modal('hide');
                ajax();
            }
        });

        return false;
    }
</script>