<br/>
<table class="table table-striped table-bordered">  
    <thead>
        <tr>
            <th>#</th>
            <th>เลขที่ใบเสร็จ</th>
            <th>เลขที่ใบ order</th>
            <th>ลูกค้า</th>
            <th>เบอร์</th>
            <th>วันที่จัดส่ง</th>
            <th class="text-center">บริการจัดส่ง</th>
            <th class="text-center">สถานะ</th>    
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
                    <td><?php echo $data->refer; ?></td>
                    <td><?php echo $data->customer_name; ?></td>
                    <td><?php echo $data->customer_tel; ?></td>
                    <td><?php echo $this->mics->dateen2stringthMS($data->date_transfer); ?></td>
                    <td class="text-center"><?php echo $data->transport_service_name; ?></td>
                    <?php
                    if($data->transport_status_id == 1) {
                        $status_name = '<span class="badge badge-primary">'.$data->transport_status_name.'</span>';
                    }else if($data->transport_status_id == 2){
                        $status_name = '<span class="badge badge-info">'.$data->transport_status_name.'</span>';
                    }else if($data->transport_status_id == 3){
                        $status_name = '<span class="badge badge-warning">'.$data->transport_status_name.'</span>';
                    }else if($data->transport_status_id == 4){
                        $status_name = '<span class="badge badge-success">'.$data->transport_status_name.'</span>';
                    }else if($data->transport_status_id == 5){
                        $status_name = '<span class="badge badge-danger">'.$data->transport_status_name.'</span>';
                    }
                    ?>
                    <td class="text-center"><?php echo $status_name; ?></td>
                </tr>
                <?php
                $i++;
            }
        } else {
            ?>
            <tr>
                <td class="text-center" colspan="9"><?php echo 'ไม่มีข้อมูล'; ?></td>
            </tr>
            <?php
        }
        ?>      
    </tbody>
</table>