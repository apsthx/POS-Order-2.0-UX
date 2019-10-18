<table class="table table-striped table-bordered table-datatable">                
    <thead>
        <tr>
            <th>#</th>
            <th>รหัสคู่ค้า</th>
            <th>ชื่อคู่ค้า</th>
            <th>เลขประจำตัวผู้เสียภาษี</th>
            <th>เบอร์โทรศัพท์</th>
            <th>อีเมล</th>
            <th>กลุ่มคู่ค้า</th>
            <th>สถานะ</th>
            <th class="text-center">ตัวเลือก</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if ($datas->num_rows() > 0) {
            $i = 1;
            foreach ($datas->result() AS $data) {
                ?>
                <tr>
                    <td><?php echo $i; ?></td>
                    <td><?php echo $data->partners_id; ?></td>
                    <td><?php echo $data->fullname; ?></td>
                    <td><?php echo $data->tax_id; ?></td>
                    <td><?php echo $data->tel; ?></td>
                    <td><?php echo $data->email; ?></td>
                    <td><?php echo $data->partners_group_name; ?></td>
                    <td><span class="<?php echo ($data->status_id == 1)? 'badge badge-success':'badge badge-danger'; ?>"><i class="<?php echo ($data->status_id == 1)? 'fa fa-check-circle':'fa fa-times-circle-o'; ?>"></i> <?php echo $data->status_name; ?></span></td>
                    <td class="text-center">
                        <?php if($data->status_id == 1){ ?>
                        <button type="button" class="btn btn-sm btn-outline-info" onclick="modaledit(<?php echo $data->partners_id_pri; ?>)"><i class="fa fa-edit"></i> แก้ไข</button>
                        <button type="button" class="btn btn-sm btn-outline-danger" onclick="modal_editstatus(<?php echo $data->partners_id_pri; ?>)"><i class="fa fa-close"></i> ระงับ</button>
                        <?php } else{ ?>             
                        <button type="button" class="btn btn-sm btn-outline-secondary"><i class="fa fa-edit"></i> แก้ไข</button>
                        <button type="button" class="btn btn-sm btn-outline-secondary"><i class="fa fa-close"></i> ระงับ</button>                      
                        <?php } ?>
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