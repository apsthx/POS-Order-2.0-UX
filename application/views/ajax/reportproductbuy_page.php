<br/>
<table class="table table-striped table-bordered">                
    <thead>
        <tr>
            <th>#</th>
            <th>รหัสสินค้า</th>
            <th>สินค้า</th> 
            <th>แบรนด์</th> 
            <th>รุ่น</th>   
            <th class="text-right" width="10%">จำนวนขาย</th>
            <th class="" width="8%">หน่วยนับ</th>
            <th class="text-right" width="12%">ราคาขายทั้งหมด</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $i = 1;
        $product_price_sum = 0;
        $datas = $this->reportproductbuy_model->hit_product($date_start, $date_end, $search);
        if ($datas->num_rows() > 0) {
            foreach ($datas->result() as $data) {
                ?>
                <tr>
                    <td><?php echo $i; ?></td>
                    <td><?php echo $data->product_id; ?></td>
                    <td><?php echo $data->product_name ?></td>
                    <td><?php echo $data->product_brand; ?></td>
                    <td><?php echo $data->product_gen; ?></td>
                    <td class="text-right"><?php echo number_format($data->product_amount, 0); ?></td>
                    <td><?php echo $data->product_unit; ?></td>
                    <td class="text-right"><?php echo number_format($data->product_price_sum, 2); ?></td>
                </tr>
                <?php
                $product_price_sum += $data->product_price_sum;
                $i++;
            }
        } else {
            ?>
            <tr>
                <td class="text-center" colspan="8"><?php echo 'ไม่มีข้อมูล'; ?></td>
            </tr>
    <?php
}
?>    
        <tr>
            <td class="text-right" colspan="7" style="font-weight: bold;"><?php echo 'รวม'; ?></td>
            <td class="text-right" style="font-weight: bold;"><?php echo number_format($product_price_sum, 2); ?></td>
        </tr>
    </tbody>
</table>