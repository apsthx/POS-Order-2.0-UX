<table class="table table-striped table-bordered table-datatable">  
    <thead>
        <tr>
            <th>#</th>
            <th>เลขที่ใบเสร็จ</th>
            <th>หมายเลขพัสดุ</th>
            <th>ลูกค้า</th>
            <th>พนักงาน</th>
            <th class="text-center">วันที่บรรจุสินค้า</th>
            <th class="">บริการขนส่ง</th>
            <th class="text-right">ค่าขนส่ง</th>
            <th class="text-center">สถานะ</th>
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
                    <td><?php echo $this->pack_model->get_user($data->user_id)->row()->fullname; ?></td>
                    <td class="text-center"><?php echo ' ' . $this->mics->dateen2stringthMS($data->date_pack); ?></td>
                    <td><?php echo $data->transport_service_name; ?></td>
                    <td class="text-right"><?php echo number_format($data->transport_price, 2, '.', ','); ?></td>
                    <td class="text-center"><span class="badge badge-success"><?php echo $this->pack_model->ref_status_pack($data->status_pack_id)->row()->status_pack_name; ?></span></td>                                           
                    <td class="text-center">
                        <a href="<?php echo base_url() . 'receiptdetail/' . $data->receipt_master_id_pri; ?>" target="_blank" class="btn btn-sm btn-outline-primary"><i class="fa fa-eye"></i> ดู</a>
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
