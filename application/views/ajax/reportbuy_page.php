<br/>
<table class="table table-striped table-bordered">                
    <thead>
        <tr>
            <th>#</th>
            <th>เลขที่ใบสั่งซื้อ</th>
            <th>คู่ค้า</th>
            <th class="text-center">วันที่ออกใบสั่งซื้อ</th>  
            <th class="text-center">สถานะการจ่ายเงิน</th>
            <th class="text-center">สถานะสินค้า</th>
            <th class="text-right">จำนวนเงินสุทธิ</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $i = 1;
        $price_sum_pay = 0;
        if ($datas->num_rows() > 0) {
            foreach ($datas->result() as $data) {
                ?>
                <tr>
                    <td><?php echo $i; ?></td>
                    <td><?php echo $data->receipt_master_id; ?></td>
                    <td><?php echo $data->customer_name; ?></td>
                    <td class="text-center"><?php echo $this->mics->dateen2stringthMS($data->date_receipt); ?></td>
                    <td class="text-center"><?php echo $this->reportbuy_model->ref_status_pay($data->status_pay_id)->row()->status_pay_name; ?></td>
                    <td class="text-center"><?php echo $this->reportbuy_model->ref_status_transfer($data->status_transfer_id)->row()->status_transfer_name; ?></td>
                    <td class="text-right"><?php echo number_format($data->price_sum_pay, 2); ?></td>
                </tr>
                <?php
                $price_sum_pay += $data->price_sum_pay;
                $i++;
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