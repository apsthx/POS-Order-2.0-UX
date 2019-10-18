<br/>
<table class="table table-striped table-bordered">                
    <thead>
        <tr>
            <th>#</th>
            <th>เลขที่ใบเสร็จ</th>
            <th class="text-center">วันที่บริการ</th>
            <th>บริการ</th>
            <th>จำนวน</th>
            <th>กลุ่มลูกค้า</th>
            <th>ลูกค้า</th>
            <th class="text-center">วันที่ออกใบเสร็จ</th>
            <th class="text-right">จำนวนเงิน</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $i = 1;
        $price_sum_pay = 0;
        if ($datas->num_rows() > 0) {
            foreach ($datas->result() as $data) {
                $customer_groups = $this->reportservices_model->get_customer_group($data->customer_id, $customer_group_id);
                if ($customer_groups->num_rows() > 0) {
                    ?>
                    <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo $data->services_master_id; ?></td>
                        <td class="text-center"><?php echo $this->mics->dateen2stringthMS($data->date_services); ?></td>                
                        <td><?php echo $data->services_name; ?></td>
                        <td><?php echo $data->services_amount; ?></td>
                        <td><?php echo $customer_groups->row()->customer_group_name; ?></td>
                        <td><?php echo $data->customer_name; ?></td>
                        <td class="text-center"><?php echo $this->mics->dateen2stringthMS($data->date_pay); ?></td>
                        <td class="text-right"><?php echo number_format($data->services_price_sum, 2); ?></td>
                    </tr>
                    <?php
                    $price_sum_pay += $data->services_price_sum;
                    $i++;
                }
            }
        } else {
            ?>
            <tr>
                <td class="text-center" colspan="9"><?php echo 'ไม่มีข้อมูล'; ?></td>
            </tr>
            <?php
        }
        ?>    
        <tr>
            <td class="text-right" colspan="8" style="font-weight: bold;"><?php echo 'รวม'; ?></td>
            <td class="text-right" style="font-weight: bold;"><?php echo number_format($price_sum_pay, 2); ?></td>
        </tr>
    </tbody>
</table>