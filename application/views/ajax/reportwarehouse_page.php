<br/>
<table class="table table-striped table-bordered">                
    <thead>
        <tr>
            <th>รหัส</th>
            <th>คลังสินค้า / สินค้า</th>        
            <th class="text-right">สินค้าคงคลัง / จำนวนคงเหลือ</th>
            <th width="10%">หน่วยนับ</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $i = 1;
        if ($datas->num_rows() > 0) {
            foreach ($datas->result() as $data) {
                $stock = $this->reportwarehouse_model->get_stock_amount($data->stock_id_pri)->row();
                ?>
                <tr>
                    <td><?php echo $data->stock_id; ?></td>
                    <td><?php echo $data->stock_name; ?></td>
                    <?php
                    $stock_amount = $this->reportwarehouse_model->get_stock_amount($data->stock_id_pri);
                    if ($stock_amount->num_rows() > 0) {
                        $stockamount = $stock_amount->row()->stock_amount;
                    } else {
                        $stockamount = 0;
                    }
                    ?>   
                    <td class="text-right"><?php echo $stockamount; ?></td>
                    <td><?php echo ''; ?></td>
                </tr>
                <?php
                $map_products = $this->reportwarehouse_model->get_map_product_stock($data->stock_id_pri);
                if ($map_products->num_rows() > 0) {
                    foreach ($map_products->result() as $map_product) {
                        $product = $this->reportwarehouse_model->get_product($map_product->product_id_pri)->row();
                        ?>
                        <tr>
                            <td>&nbsp;&nbsp;<?php echo $product->product_id; ?></td>
                            <td>&nbsp;&nbsp;<?php echo $product->product_name; ?></td>
                            <?php
                            $stock_amount = $this->reportwarehouse_model->get_stock_amount($data->stock_id_pri, $map_product->product_id_pri);
                            if ($stock_amount->num_rows() > 0) {
                                $stockamount = $stock_amount->row()->stock_amount;
                            } else {
                                $stockamount = 0;
                            }
                            ?>                                       
                            <td class="text-right"><?php echo number_format($stockamount); ?></td>
                            <td><?php echo $product->product_unit; ?></td>
                        </tr>
                        <?php
                    }
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
    </tbody>
</table>