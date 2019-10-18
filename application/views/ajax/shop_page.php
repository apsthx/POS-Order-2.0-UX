
<table class="table table-striped table-bordered table-datatable">
    <thead>
        <tr>
            <th>#</th>
            <th class="text-center">โลโก้</th>
            <th class="text-center">รหัสร้าน/ตัวแทน</th>
            <th class="text-center">ชื่อร้าน</th>
            <th class="text-center">สถานะ</th>
            <th class="text-center">ประเภท</th>
            <th class="text-center">ผู้จัดการ</th>
            <th class="text-center">username</th>
            <th class="text-center">วันที่สร้าง</th>
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
                    <td style="vertical-align: middle;"><?php echo $data->shop_id; ?></td>
                    <td style="vertical-align: middle;"><?php echo $data->shop_name; ?></td>
                    <td class="text-center" style="vertical-align: middle;">
                        <span class="badge badge-<?php echo ($data->status_shop_id == 1) ? 'success' : 'danger'; ?>"><i class="<?php echo ($data->status_shop_id == 1) ? 'fa fa-check-circle' : 'fa fa-times-circle'; ?>"></i>
                            <?php echo $data->status_shop_name; ?>
                        </span>
                    </td>
                    <td class="text-center" style="vertical-align: middle;"><?php echo $data->type_shop_name; ?></td>
                    <td class="text-center" style="vertical-align: middle;"><?php echo $data->fullname; ?></td>
                    <td class="text-center" style="vertical-align: middle;"><?php echo $data->username; ?></td>
                    <td class="text-center" style="vertical-align: middle;"><?php echo $this->mics->date2thai($data->date_create, '%d %m %y', 1); ?></td>
                    <td class="text-center" style="vertical-align: middle;">
                        <button type="button" class="btn btn-sm btn-outline-warning" onclick="modal_editpassword('<?php echo $data->user_id; ?>', '<?php echo $data->username; ?>')"><i class="fa fa-refresh"></i> ลืมรหัสผ่าน</button>
                        <button class="btn btn-outline-primary btn-sm" onclick="edit_modal('<?php echo $data->shop_id_pri; ?>');"><i class="fa fa-edit"></i> แก้ไข</button>
                    </td>
                </tr>
                <?php
                $i++;
            }
        } else {
            
        }
        ?>                    
    </tbody>
</table>

<script>
    $(document).ready(function () {
        $('.table-datatable').DataTable();
    });
</script>