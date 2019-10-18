<br/>
<table class="table table-striped table-bordered">                
    <thead>
        <tr>
            <th>#</th>
            <th>รหัสลูกค้า</th>
            <th>ลูกค้า</th>        
            <th class="text-right">จำนวนเงินสุทธิ</th>
            <th class="text-center" width="5%">ตัวเลือก</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $i = 1;
        $price_sum_pay = 0;
        if ($datas->num_rows() > 0) {
            foreach ($datas->result() as $data) {
                $customers = $this->reportcustomerbuy_model->get_receipt_master($date_start, $date_end, $data->customer_id);
                if ($customers->num_rows() > 0) {
                    ?>
                    <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo $data->customer_id; ?></td>
                        <?php $customer = $customers->row(); ?>
                        <td><?php echo $customer->customer_name; ?></td>
                        <td class="text-right"><?php echo number_format($customer->price_sum_pay, 2); ?></td>
                        <td class="text-center"><button type="button" class="btn btn-sm btn-outline-primary" onclick="modalview(<?php echo $this->reportcustomerbuy_model->get_customer($data->customer_id)->row()->customer_id_pri; ?>)"><i class="fa fa-eye"></i> ดูรายการ</button></td>
                    </tr>
                    <?php
                    $price_sum_pay += $customer->price_sum_pay;
                    $i++;
                }
            }
        } else {
            ?>
            <tr>
                <td class="text-center" colspan="6"><?php echo 'ไม่มีข้อมูล'; ?></td>
            </tr>
            <?php
        }
        ?>    
        <tr>
            <td class="text-right" colspan="3" style="font-weight: bold;"><?php echo 'รวม'; ?></td>
            <td class="text-right" style="font-weight: bold;"><?php echo number_format($price_sum_pay, 2); ?></td>
        </tr>
    </tbody>
</table>