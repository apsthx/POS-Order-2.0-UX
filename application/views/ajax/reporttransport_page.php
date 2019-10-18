<br/>
<table class="table table-striped table-bordered">                
    <thead>
        <tr>
            <th>#</th>
            <th>เลขที่ใบอ้างอิง</th>
            <th>สาขา/ตัวแทน</th>
            <th class="text-center">วันที่ขนส่ง</th>  
            <th class="text-right">จำนวนสินค้า(ชิ้น)</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $i = 1;$price_sum_pay = 0;
        if ($datas->num_rows() > 0) {
            foreach ($datas->result() as $data) {
                ?>
                <tr>
                    <td><?php echo $i; ?></td>
                    <td><?php echo $data->receipt_master_id; ?></td>
                    <td><?php echo $data->customer_name; ?></td>
                    <td class="text-center"><?php echo $this->mics->dateen2stringthMS($data->date_transfer); ?></td>
                    <?php $product_amount = $this->reporttransport_model->get_product_amount($data->receipt_master_id_pri)->row()->product_amount; ?>
                    <td class="text-right"><?php echo number_format($product_amount, 0); ?></td>
                </tr>
                <?php
                $price_sum_pay += $product_amount;
                $i++;
            }
        } else {
            ?>
            <tr>
                <td class="text-center" colspan="5"><?php echo 'ไม่มีข้อมูล'; ?></td>
            </tr>
            <?php
        }
        ?>    
        <tr>
            <td class="text-right" colspan="4" style="font-weight: bold;"><?php echo 'รวม'; ?></td>
            <td class="text-right" style="font-weight: bold;"><?php echo number_format($price_sum_pay,0); ?></td>
        </tr>
    </tbody>
</table>