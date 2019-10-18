<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-block">
                <h4 class="card-title"><i class="<?php echo $icon; ?>"></i> <?php echo " " . $title; ?> 
                </h4>   
                <div class="table-responsive">
                    <form method="post" action="<?php echo base_url() . 'sticker/printsticker'; ?>" target="_blank" autocomplete="off">
                        <div class="text-right">
                            <button type="submit" class="btn btn-sm btn-outline-info"><i class="fa fa-print"></i>&nbsp;พิมม์สติ๊กเกอร์สินค้าที่เลือก</button>
                            <button type="reset" class="btn btn-sm btn-outline-danger" ><i class="fa fa-close"></i>&nbsp;ยกเลิก</button>
                        </div>
                        <table class="table table-striped table-bordered table-datatable">                
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>รหัสสินค้า</th>
                                    <th>ชื่อสินค้า</th>
                                    <th class="text-right">ราคา</th>
                                    <th class="text-center">รหัสบาร์โค้ด</th>
                                    <th class="text-center">เลือก</th>
                                    <th class="text-center">จำนวน</th>
                                    <th class="text-left">ต่อหน่วย</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i = 1;
                                if ($datas->num_rows() > 0) {
                                    ?>
                                <input type="hidden" name="max" id="max" value="<?php echo $datas->num_rows(); ?>">
                                <?php
                                foreach ($datas->result() as $data) {
                                    ?>
                                    <tr>
                                        <td><input type="hidden" name="<?php echo $i; ?>" id="<?php echo $i; ?>" value="<?php echo $data->product_id_pri; ?>"><?php echo $i; ?></td>
                                        <td><?php echo $data->product_id; ?></td>
                                        <td><?php echo $data->product_name; ?></td>
                                        <td class="text-right"><?php echo $data->product_sale_price; ?></td>
                                        <td class="text-center"><?php echo $data->product_id; ?></td>
                                        <td class="text-center" >
                                            <input type="checkbox"  name="<?php echo 'checkbox[' . $i . ']'; ?>" id="<?php echo 'checkbox_' . $i; ?>">
                                            <label style="margin-bottom: -5px" for="<?php echo 'checkbox_' . $i; ?>"></label>
                                        </td>
                                        <td class="text-center" width="8%">
                                            <input type="hidden" name="<?php echo 'product_id_pri[' . $i . ']'; ?>" value="<?php echo $data->product_id_pri; ?>">
                                            <input type="number" class="form-control form-control-sm" name="<?php echo 'amount[' . $i . ']'; ?>">
                                        </td>
                                        <td>แถว</td>
                                    </tr>
                                    <?php
                                    $i++;
                                }
                            }
                            ?>                    
                            </tbody>
                        </table>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>