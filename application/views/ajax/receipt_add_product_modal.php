<div class="table-responsive">

    <table class="table table-striped table-bordered table-datatable">
        <thead>
            <tr>
                <th width="50">#</th>
                <th class="text-left">รหัสสินค้า</th>
                <th class="text-left">สินค้า</th>
                <th class="text-right">ราคาต่อหน่วย</th>
                <th class="text-left">หน่วย</th>
                <th class="text-center" width="15%">เลือก</th>
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
                        <td style="vertical-align: middle;"><?php echo $data->product_id; ?></td>
                        <td style="vertical-align: middle;"><?php echo $data->product_name; ?></td>
                        <td class="text-right" style="vertical-align: middle;"><?php echo number_format($data->product_sale_price, 2); ?></td>
                        <td style="vertical-align: middle;"><?php echo $data->product_unit; ?></td>
                        <td class="text-center" style="vertical-align: middle;">
                            <?php
                            if (sizeof($product_id_arr) > 0) {
                                if (!in_array($data->product_id, $product_id_arr)) {
                                    ?>
                                    <input type="hidden" name="product_id_modal['<?php echo $i; ?>']" class="product_id_modal" id="product_id_modal_<?php echo $i; ?>" >
                                    <input type="hidden" name="product_name_modal['<?php echo $i; ?>']" class="product_name_modal" id="product_name_modal_<?php echo $i; ?>" >
                                    <input type="hidden" name="product_price_modal['<?php echo $i; ?>']" class="product_price_modal" id="product_price_modal_<?php echo $i; ?>" >
                                    <input type="hidden" name="product_unit_modal['<?php echo $i; ?>']" class="product_unit_modal" id="product_unit_modal_<?php echo $i; ?>" >
                                    <input type="checkbox" id="product_checkbox_modal_<?php echo $i; ?>" value="0" onclick="checkbox_product(this, '<?php echo $data->product_id; ?>', '<?php echo $data->product_name; ?>', '<?php echo $data->product_sale_price; ?>', '<?php echo $data->product_unit; ?>',<?php echo $i; ?>);" >
                                    <label for="product_checkbox_modal_<?php echo $i; ?>"></label>
                                    <?php
                                }
                            } else {
                                ?>
                                <input type="hidden" name="product_id_modal['<?php echo $i; ?>']" class="product_id_modal" id="product_id_modal_<?php echo $i; ?>" >
                                <input type="hidden" name="product_name_modal['<?php echo $i; ?>']" class="product_name_modal" id="product_name_modal_<?php echo $i; ?>" >
                                <input type="hidden" name="product_price_modal['<?php echo $i; ?>']" class="product_price_modal" id="product_price_modal_<?php echo $i; ?>" >
                                <input type="hidden" name="product_unit_modal['<?php echo $i; ?>']" class="product_unit_modal" id="product_unit_modal_<?php echo $i; ?>" >
                                <input type="checkbox" id="product_checkbox_modal_<?php echo $i; ?>" value="0" onclick="checkbox_product(this, '<?php echo $data->product_id; ?>', '<?php echo $data->product_name; ?>', '<?php echo $data->product_sale_price; ?>', '<?php echo $data->product_unit; ?>',<?php echo $i; ?>);" >
                                <label for="product_checkbox_modal_<?php echo $i; ?>"></label>
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
<br/>
<div class="row">
    <div class="col-md-12 text-center">
        <button type="button" onclick="add_product();" class="btn btn-outline-info"><i class="fa fa-plus"></i>&nbsp;เพิ่ม</button>
        <button type="button" class="btn btn-outline-danger" data-dismiss="modal" aria-hidden="true"><i class="fa fa-close"></i>&nbsp;ยกเลิก</button>
    </div>
</div>
<br/>

<script>
    $(document).ready(function () {
        $('.table-datatable').DataTable();
    });

    function checkbox_product(tag, product_id, product_name, product_price, product_unit, i) {
        check = $(tag);
        if (check.val() == 0) {
            check.val(1);
            $('#product_id_modal_' + i).val(product_id);
            $('#product_name_modal_' + i).val(product_name);
            $('#product_price_modal_' + i).val(product_price);
            $('#product_unit_modal_' + i).val(product_unit);
        } else {
            check.val(0);
            $('#product_id_modal_' + i).val('');
            $('#product_name_modal_' + i).val('');
            $('#product_price_modal_' + i).val('');
            $('#product_unit_modal_' + i).val('');
        }
    }
</script>