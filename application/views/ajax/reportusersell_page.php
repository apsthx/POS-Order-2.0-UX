<br/>
<table class="table table-striped table-bordered">                
    <thead>
        <tr>
            <th>#</th>
            <th>พนักงาน</th>
            <th>ตำแหน่ง</th>        
            <th class="text-right">จำนวนเงินสุทธิ</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $i = 1;
        $price_sum_pay = 0;
        if ($datas->num_rows() > 0) {
            foreach ($datas->result() as $data) {
                $users = $this->reportusersell_model->get_receipt_master($date_start, $date_end, $data->user_id);
                if ($users->num_rows() > 0) {
                    ?>
                    <tr>
                        <td><?php echo $i; ?></td>
                        <?php $user = $users->row(); ?>
                        <td><?php echo $this->reportusersell_model->get_user($data->user_id)->row()->fullname.' ('.$data->user_id.')'; ?></td>
                        <td><?php echo $this->reportusersell_model->get_role($this->reportusersell_model->get_user($data->user_id)->row()->role_id)->row()->role_name; ?></td>
                        <td class="text-right"><?php echo number_format($user->price_sum_pay, 2); ?></td>
                    </tr>
                    <?php
                    $price_sum_pay += $user->price_sum_pay;
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