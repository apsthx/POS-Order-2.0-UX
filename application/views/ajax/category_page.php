
<table class="table table-striped table-bordered table-datatable">
    <thead>
        <tr>
            <th width="50">#</th>
            <th class="text-left">ชื่อหมวดหมู่</th>
            <?php
            if ($shop->type_shop_id == 1) {
                ?>
                <th class="text-center" width="250">ตัวเลือก</th>
                <?php
            }
            ?>
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
                    <td style="vertical-align: middle;">
                        <a href="<?php echo base_url() . 'product?category=' . $data->product_category_id; ?>">
                            <?php echo $data->product_category_name; ?>
                        </a>
                    </td>
                    <?php
                    if ($shop->type_shop_id == 1) {
                        ?>
                        <td class="text-center" style="vertical-align: middle;">
                            <button class="btn btn-outline-primary btn-sm" onclick="edit_modal('<?php echo $data->product_category_id; ?>');"><i class="fa fa-edit"></i> แก้ไข</button>
                            <button class="btn btn-outline-danger btn-sm" onclick="modal_delete('<?php echo $data->product_category_id; ?>');"><i class="fa fa-trash"></i> ลบ</button>
                        </td>
                        <?php
                    }
                    ?>
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