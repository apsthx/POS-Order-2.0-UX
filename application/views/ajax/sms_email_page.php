<table class="table table-striped table-bordered table-datatable">                
    <thead>
        <tr>
            <th>#</th>
            <th>รหัสลูกค้า</th>
            <th>ชื่อลูกค้า</th>
            <th>ประเภทการส่ง</th>
            <th>เบอร์โทร</th>
            <th>อีเมล</th> 
            <th>กลุ่มลูกค้า</th>
            <th>สถานะ</th>
            <th>หัวข้อ</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $i = 1;
        if ($datas->num_rows() > 0) {
            foreach ($datas->result() as $data) {
                ?>
                <tr>
                    <td><?php echo $i; ?></td>
                    <td><?php echo $data->customer_id; ?></td>
                    <td><?php echo $data->fullname; ?></td>                
                    <td><?php echo ($data->advt_type == 1)? 'SMS':'Email'; ?></td>
                    <td><?php echo $data->tel; ?></td>
                    <td><?php echo $data->email; ?></td>
                    <td><?php echo $data->customer_group_name; ?></td>
                    <td class="text-center"><?php echo ($data->advt_status == 1)? '<span class="badge badge-success"><i class="fa fa-check-circle"></i> ปกติ</span>':'<span class="badge badge-danger"><i class="fa fa-close"></i> ผิดผลาด</span>'; ?></td>           
                    <td><?php echo $data->advt_header; ?></td>
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