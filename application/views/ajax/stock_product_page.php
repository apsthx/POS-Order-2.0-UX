

<table class="table table-striped table-bordered table-datatable">
    <thead>
        <tr>
            <th width="50">#</th>
            <th class="text-center">รหัสสินค้า</th>
            <th class="text-center">หมวดหมู่สินค้า</th>
            <th class="text-center">ชื่อสินค้า</th>
            <th class="text-center">จำนวนคงเหลือ</th>
            <th class="text-center">สามารถเพิ่มได้อีก</th>
            <th class="text-center">ต้องการเพิ่ม</th>
            <th class="text-center" width="150">ตัวเลือก</th>
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
                    <td style="vertical-align: middle;"><?php echo $data->product_category_name; ?></td>
                    <td style="vertical-align: middle;"><?php echo $data->product_name; ?></td>
                    <td class="text-right"><?php echo $data->map_product_amount; ?></td>
                    <?php
                    $amount_can_add = $this->stock_model->amount_can_add($data->product_id_pri, $data->product_amount);
                    ?>
                    <td class="text-right"><?php echo number_format($amount_can_add); ?></td>
                    <td style="vertical-align: middle;" class="text-center">
                        <input type="number" onblur="change_amounnt_product('<?php echo $data->product_id_pri; ?>', '<?php echo $amount_can_add; ?>', '<?php echo $data->map_product_amount; ?>', this);" class="form-control text-right" style="width: 100px;" />
                    </td>
                    <td class="text-center" style="vertical-align: middle;">
                        <button class="btn btn-outline-danger btn-sm" onclick="modal_delete_product('<?php echo $data->map_product_stock_id; ?>');"><i class="fa fa-trash"></i> ลบ</button>
                    </td>
                </tr>
                <?php
                $i++;
            }
        }
        ?>                    
    </tbody>
</table>

<script>
    $(document).ready(function () {
        $('.table-datatable').DataTable();
    });

</script>