<br/>
<table class="table table-striped table-bordered">                
    <thead>
        <tr>
            <th>#</th>
            <th>พนักงาน</th>
            <th>ตำแหน่ง</th>      
            <th>กลุ่มลูกค้า</th>  
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
                    <td><?php echo $data->fullname; ?></td>
                    <td><?php echo $data->role_name; ?></td>
                    <td><?php echo $data->customer_group_name; ?></td>
                    <td class="text-right"><?php echo number_format($data->price_sum_pay, 2); ?></td>
                </tr>
                <?php
                $price_sum_pay += $data->price_sum_pay;
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
            <td class="text-right" style="font-weight: bold;"><?php echo number_format($price_sum_pay, 2); ?></td>
        </tr>
    </tbody>
</table>