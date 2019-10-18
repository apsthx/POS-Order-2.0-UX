


<table class="table table-striped table-bordered table-datatable">
    <thead>
        <tr>
            <th width="50">#</th>
            <th class="text-left">รหัสคู่ค้า</th>
            <th class="text-left">ชื่อ-นามสกุล</th>
            <th class="text-left">เบอร์โทรศัพท์</th>
            <th class="text-center" width="15%">ตัวเลือก</th>
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
                    <td style="vertical-align: middle;"><?php echo $data->partners_id; ?></td>
                    <td style="vertical-align: middle;"><?php echo $data->fullname; ?></td>
                    <td style="vertical-align: middle;"><?php echo $data->tel; ?></td>
                    <td class="text-center">
                        <button class="btn btn-success btn-sm" 
                                onclick="select_customer_modal(
                                                '<?php echo $data->partners_id; ?>',
                                                '<?php echo $data->fullname; ?>',
                                                '<?php echo $data->tel; ?>',
                                                '<?php echo $data->email; ?>',
                                                '<?php echo $data->address; ?>',
                                                '<?php echo $data->tax_id; ?>',
                                                '<?php echo $data->tax_shop; ?>',
                                                '<?php echo $data->tax_shop_sub; ?>',
                                                '<?php echo $data->tax_address; ?>'
                                                );"
                                >
                            เลือก
                        </button>
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