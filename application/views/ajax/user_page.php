<table class="table table-striped table-bordered table-datatable">                
    <thead>
        <tr>
            <th>#</th>
            <th>username</th>
            <th>ชื่อผู้ใช้งาน</th>
            <th>เบอร์โทรศัพท์</th>
            <th>อีเมล</th>
            <th>สิทธิ์ผู้ใช้งาน</th>
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
                    <td><?php echo $data->username; ?></td>
                    <td><?php echo $data->fullname; ?></td>
                    <td><?php echo $data->tel; ?></td>
                    <td><?php echo $data->email; ?></td>
                    <td><?php echo $data->role_name; ?></td>
                    <td class="text-center"><span class="<?php echo ($data->status_id == 1) ? 'badge badge-success' : 'badge badge-danger'; ?>"><i class="<?php echo ($data->status_id == 1) ? 'fa fa-check-circle' : 'fa fa-times-circle-o'; ?>"></i> <?php echo $this->user_model->ref_status($data->status_id)->row()->status_name; ?></span></td>                                           
                    <td class="text-center">  
                        <?php if ($data->status_id == 1 && $this->session->userdata('role_id') <= $data->role_id) { ?>
                            <button type="button" class="btn btn-sm btn-outline-info" onclick="modaledit(<?php echo $data->user_id; ?>)"><i class="fa fa-edit"></i> แก้ไข</button>
                            <button type="button" class="btn btn-sm btn-outline-warning" onclick="modal_editpassword('<?php echo $data->user_id; ?>', '<?php echo $data->username; ?>')"><i class="fa fa-refresh"></i> ลืมรหัสผ่าน</button>
                            <button type="button" class="btn btn-sm btn-outline-danger" onclick="modal_editstatus(<?php echo $data->user_id; ?>)"><i class="fa fa-close"></i> ระงับ</button>
                        <?php } else { ?>
                            <button type="button" class="btn btn-sm btn-outline-secondary"><i class="fa fa-edit"></i> แก้ไข</button>
                            <button type="button" class="btn btn-sm btn-outline-secondary"><i class="fa fa-refresh"></i> ลืมรหัสผ่าน</button>
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