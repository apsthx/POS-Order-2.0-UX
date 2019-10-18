<br/>
<table class="table table-striped table-bordered">                
    <thead>
        <tr>
            <th>#</th>
            <th>เลขที่ใบเสร็จ</th>
            <th>เลขที่อ้างอิง</th>
            <th>กลุ่มลูกค้า</th>
            <th>ลูกค้า</th>
            <th class="text-center">วันที่ออกใบเสร็จ</th>           
            <th class="text-right">จำนวนเงินสุทธิ</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $i = 1;
        $price_sum_pay = 0;
        if ($datas->num_rows() > 0) {
            foreach ($datas->result() as $data) {
                $customer_groups = $this->reportsummary_model->get_customer_group($data->customer_id, $customer_group_id);
                if ($customer_groups->num_rows() > 0) {
                    ?>
                    <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo $data->receipt_master_id; ?></td>
                        <td><?php echo $data->refer; ?></td>
                        <td><?php echo $customer_groups->row()->customer_group_name; ?></td>
                        <td><?php echo $data->customer_name; ?></td>
                        <td class="text-center"><?php echo $this->mics->dateen2stringthMS($data->date_pay); ?></td>
                        <td class="text-right"><?php echo number_format($data->price_sum_pay, 2); ?></td>
                    </tr>
                    <?php
                    $price_sum_pay += $data->price_sum_pay;
                    $i++;
                } else if ($customer_group_id == null) {
                    if ($data->type_receipt_id == 1) {
                        ?>
                        <tr>
                            <td><?php echo $i; ?></td>
                            <td><?php echo $data->receipt_master_id; ?></td>
                            <td><?php echo $data->refer; ?></td>
                            <td><?php echo 'ขายหน้าร้าน'; ?></td>
                            <td><?php echo ''; ?></td>
                            <td class="text-center"><?php echo $this->mics->dateen2stringthMS($data->date_pay); ?></td>
                            <td class="text-right"><?php echo number_format($data->price_sum_pay, 2); ?></td>
                        </tr>
                        <?php
                        $price_sum_pay += $data->price_sum_pay;
                        $i++;
                    } else {
                        ?>
                        <tr>
                            <td><?php echo $i; ?></td>
                            <td><?php echo $data->receipt_master_id; ?></td>
                            <td><?php echo $data->refer; ?></td>
                            <td><?php echo 'สาขา/ตัวแทนจำหน่าย'; ?></td>
                            <td><?php echo $data->customer_name; ?></td>
                            <td class="text-center"><?php echo $this->mics->dateen2stringthMS($data->date_pay); ?></td>
                            <td class="text-right"><?php echo number_format($data->price_sum_pay, 2); ?></td>
                        </tr>
                        <?php
                        $price_sum_pay += $data->price_sum_pay;
                        $i++;
                    }
                }
            }
        } else {
            ?>
            <tr>
                <td class="text-center" colspan="7"><?php echo 'ไม่มีข้อมูล'; ?></td>
            </tr>
            <?php
        }
        ?>    
        <tr>
            <td class="text-right" colspan="6" style="font-weight: bold;"><?php echo 'รวม'; ?></td>
            <td class="text-right" style="font-weight: bold;"><?php echo number_format($price_sum_pay, 2); ?></td>
        </tr>
    </tbody>
</table>