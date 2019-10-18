<br/>
<table class="table table-striped table-bordered">                
    <thead>
        <tr>
            <th>#</th>
            <th>รหัสสินค้า</th>
            <th>สินค้า</th> 
            <th>แบรนด์</th> 
            <th>รุ่น</th>  
            <th class="" width="8%">หน่วยนับ</th>
            <th class="text-right" width="10%">ยอดยกมา</th>
            <th class="text-right" width="10%">ยอดเข้า</th>
            <th class="text-right" width="10%">ยอดออก</th>
            <th class="text-right" width="10%">ยอดยกไป</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $i = 1;
        $in_out_product_sum = 0;
        $product_in_sum = 0;
        $product_out_sum = 0;
        $product_out_in_sum = 0;
        if ($datas->num_rows() > 0) {
            foreach ($datas->result() as $data) {
                ?>
                <tr>
                    <td><?php echo $i; ?></td>
                    <td><?php echo $data->product_id; ?></td>
                    <td><?php echo $data->product_name; ?></td>
                    <td><?php echo $data->product_brand; ?></td>
                    <td><?php echo $data->product_gen; ?></td>
                    <td><?php echo $data->product_unit; ?></td>
                    <?php
                    $in_out_product = 0;
                    $product_out_in = 0;
                    if ($date_start != null) {
                        $in_product_check = $this->reportproductmovement_model->in_product($data->product_id, $date_start);
                        if ($in_product_check->num_rows() > 0) {
                            $in_product = $in_product_check->row()->product_amount;
                        } else {
                            $in_product = 0;
                        }
                        $out_product_check = $this->reportproductmovement_model->out_product($data->product_id, $date_start);
                        if ($out_product_check->num_rows() > 0) {
                            $out_product = $out_product_check->row()->product_amount;
                        } else {
                            $out_product = 0;
                        }
                    } else {
                        $in_product = 0;
                        $out_product = 0;
                    }
                    $product_in_check = $this->reportproductmovement_model->product_in($data->product_id, $date_start, $date_end);
                    if ($product_in_check->num_rows() > 0) {
                        $product_in = $product_in_check->row()->product_amount;
                    } else {
                        $product_in = 0;
                    }
                    $product_out_check = $this->reportproductmovement_model->product_out($data->product_id, $date_start, $date_end);
                    if ($product_out_check->num_rows() > 0) {
                        $product_out = $product_out_check->row()->product_amount;
                    } else {
                        $product_out = 0;
                    }
                    $in_out_product = $in_product + $out_product;
                    $product_out_in = ($in_out_product + $product_in) - $product_out;
                    $in_out_product_sum += $in_out_product;
                    $product_in_sum += $product_in;
                    $product_out_sum += $product_out;
                    $product_out_in_sum += $product_out_in;
                    ?>
                    <td class="text-right"><?php echo number_format($in_out_product, 0); ?></td>
                    <td class="text-right"><?php echo number_format($product_in, 0); ?></td>
                    <td class="text-right"><?php echo number_format($product_out, 0); ?></td>
                    <td class="text-right"><?php echo number_format($product_out_in, 0); ?></td>
                </tr>
                <?php
                $i++;
            }
        } else {
            ?>
            <tr>
                <td class="text-center" colspan="10"><?php echo 'ไม่มีข้อมูล'; ?></td>
            </tr>
            <?php
        }
        ?>    
        <tr>
            <td class="text-right" colspan="6" style="font-weight: bold;"><?php echo 'รวม สินค้า ' . ($i - 1) . ' รายการ'; ?></td>
            <td class="text-right" style="font-weight: bold;"><?php echo number_format($in_out_product_sum, 0); ?></td>
            <td class="text-right" style="font-weight: bold;"><?php echo number_format($product_in_sum, 0); ?></td>
            <td class="text-right" style="font-weight: bold;"><?php echo number_format($product_out_sum, 0); ?></td>
            <td class="text-right" style="font-weight: bold;"><?php echo number_format($product_out_in_sum, 0); ?></td>
        </tr>
    </tbody>
</table>