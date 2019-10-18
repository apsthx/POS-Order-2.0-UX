<table class="table table-striped table-bordered table-datatable">  
    <thead>
        <tr>
            <th>#</th>
            <th>เลขที่ใบเสร็จ</th>
            <th class="text-right">วันที่ออกใบเสร็จ</th>
            <th class="text-right">จำนวนเงินทั้งหมด</th>
            <th class="text-right">ค่าขนส่ง</th>
            <th class="text-center">สถานะการจัดส่ง</th> 
            <th class="">วันที่ทำการจัดส่ง</th>
            <th class="">บริการจัดส่ง</th>  
            <th class="">หมายเลขพัสดุ</th>  
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
                    <td class="text-right"><?php echo $this->mics->dateen2stringthMS($data->date_pay); ?></td>
                    <td class="text-right"><?php echo number_format($data->price_sum_pay, 2, '.', ','); ?></td>
                    <td class="text-right"><?php echo number_format($data->transport_price, 2, '.', ','); ?></td>
                    <td class="text-center"><span class="<?php echo ($data->status_transfer_id == 1) ? 'badge badge-warning' : 'badge badge-success'; ?>"><?php echo $this->transportcustomer_model->ref_status_transfer($data->status_transfer_id)->row()->status_transfer_name; ?></span></td>
                    <td class=""><?php echo $this->mics->dateen2stringthMS($data->date_transfer); ?></td>
                    <?php if ($data->status_transfer_id == 2) { ?>
                        <td class=""><?php echo $data->transport_service_name; ?></td>
                        <td class=""><?php echo $data->transport_tracking_id; ?></td>
                    <?php } else { ?>
                        <td class=""><?php echo ''; ?></td>
                        <td class=""><?php echo ''; ?></td>
                    <?php } ?>
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