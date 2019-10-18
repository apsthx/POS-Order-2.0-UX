<table class="table table-striped table-bordered table-datatable">  
    <thead>
        <tr>
            <th>#</th>
            <th>เลขที่ใบเสร็จ</th>
            <th>เลขที่พัสดุ</th>
            <th>ลูกค้า</th>
            <th>เบอร์</th>
            <th>วันที่จัดส่ง</th>
            <th>บริการจัดส่ง</th>
            <th>สถานะ</th> 
            <th>วันที่ดำเนินการ</th>  
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
                    <td><?php echo $i; ?></td>
                    <td><?php echo $data->receipt_master_id; ?></td>
                    <td><?php echo $data->transport_tracking_id; ?></td>
                    <td><?php echo $data->customer_name; ?></td>
                    <td><?php echo $data->transport_customer_tel; ?></td>
                    <td><?php echo $this->mics->dateen2stringthMS($data->date_transfer); ?></td>
                    <td><?php echo $data->transport_service_name; ?></td>
                    <?php
                    if ($data->transport_status_id == 1) {
                        $status_name = '<span class="badge badge-warning">' . $data->transport_status_name . '</span>';
                    } else if ($data->transport_status_id == 3) {
                        $status_name = '<span class="badge badge-danger">' . $data->transport_status_name . '</span>';
                    } else if ($data->transport_status_id == 5) {
                        $status_name = '<span class="badge badge-danger">' . $data->transport_status_name . '</span>';
                    }
                    ?>
                    <td><?php echo $status_name; ?></td>
                    <td><?php echo $this->mics->dateen2stringthMS($data->date_to); ?></td>
                    <td class="text-center">
                        <button onclick="modal_detail(<?php echo $data->receipt_master_id_pri; ?>)" class="btn btn-sm btn-outline-primary"><i class="fa fa-eye"></i> ดู</button>
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