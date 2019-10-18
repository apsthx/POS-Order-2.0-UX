<?php
$receipt_master_id_pri = $this->pack_model->get_receipt_master_id($receipt_master_id);
if ($receipt_master_id_pri->num_rows() > 0) {
    if ($receipt_master_id_pri->row()->status_pack_id == 1) {
        $datas = $this->pack_model->get_receipt_detail($receipt_master_id_pri->row()->receipt_master_id_pri);
        if ($datas->num_rows() > 0) {
            if ($receipt_master_id_pri->row()->transport_service_id == 2) {
                ?>
                <div class="text-right"><img width="100mm" src="<?php echo base_url() . 'store/image/Kerry_logo.jpg'; ?>"></div>
            <?php } else { ?>
                <div class="text-right"><img width="100mm" src="<?php echo base_url() . 'store/image/EMS_logo.jpg'; ?>"></div>
            <?php } ?>
            <table class="table table-striped table-bordered table-datatable">  
                <thead>
                    <tr>
                        <th>#</th>
                        <th>รหัส</th>
                        <th>ชื่อสินค้า</th>
                        <th>จำนวน</th>
                        <th>หน่วย</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 1;
                    foreach ($datas->result() as $data) {
                        ?>
                        <tr>
                            <td><?php echo $i; ?></td>
                            <td><?php echo $data->product_id; ?></td>
                            <td><?php echo $data->product_name; ?></td>
                            <td><?php echo $data->product_amount; ?></td>
                            <td><?php echo $data->product_unit; ?></td>
                        </tr>
                        <?php
                        $i++;
                    }
                    ?>      
                </tbody>
            </table>
            <?php
        }
    } else {
        ?>
        <h4 class="text-center text-warning"><i class="mdi mdi-package-variant-closed"></i> สินค้าในเลขที่ใบเสร็จถูกบรรจุแล้ว</h4>
    <?php
    }
} else {
    ?>
    <h4 class="text-center text-danger"><i class="fa fa-times-circle-o"></i> ไม่พบเลขที่ใบเสร็จ</h4>
<?php }
?>
<script>
    $(document).ready(function () {
        $('.table-datatable').DataTable();
    });
</script>