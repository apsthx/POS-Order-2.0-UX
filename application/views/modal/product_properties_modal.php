<div class="modal-header">
    <h4 class="modal-title"><i class="fa fa-list"></i>&nbsp;คุณสมบัติสินค้า</h4>
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
</div>
<div class="modal-body">
    <div class="bootbox-body">
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th width="50">#</th>
                    <th>ชื่อ</th>
                    <th>ค่า</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 1;
                $get_product = $this->product_model->get_product_by_id($id)->row();
                if ($get_product->product_brand != null || $get_product->product_brand != '') {
                    ?>
                    <tr>
                        <td class="text-center" style="vertical-align: middle;"><?php echo $i; ?></td>
                        <td><?php echo 'แบรนด์'; ?></td>
                        <td><?php echo $get_product->product_brand; ?></td>
                    </tr>
                    <?php
                    $i++;
                } if ($get_product->product_gen != null || $get_product->product_gen != '') {
                    ?>
                    <tr>
                        <td class="text-center" style="vertical-align: middle;"><?php echo $i; ?></td>
                        <td><?php echo 'รุ่น'; ?></td>
                        <td><?php echo $get_product->product_gen; ?></td>
                    </tr>
                    <?php
                    $i++;
                }
                if ($datas->num_rows() > 0) {
                    foreach ($datas->result() as $data) {
                        ?>
                        <tr>
                            <td class="text-center" style="vertical-align: middle;"><?php echo $i; ?></td>
                            <td><?php echo $data->product_properties_name; ?></td>
                            <td><?php echo $data->product_properties_value; ?></td>
                        </tr>
                        <?php
                        $i++;
                    }
                } else if ($get_product->product_brand == null && $get_product->product_gen == null) {
                    ?>
                    <tr>
                        <td colspan="20" class="text-center" style="color: #900;"><i class="fa fa-info-circle"></i> ไม่มีข้อมูล</td>
                    </tr>
                    <?php
                }
                ?>                    
            </tbody>
        </table>
    </div>                    
</div>