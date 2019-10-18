<div class="table-responsive">
    <table class="table table-striped table-bordered table-datatable">                
        <thead>
            <tr>
                <th>#</th>
                <th>เลขที่ใบ</th>  
                <th class="text-right">ราคารวม</th>
                <th>ชื่อร้าน</th>
                <th>วันที่สั่ง</th>
                <th class="text-center">สถานะ</th>
                <th class="text-center">ตัวเลือก</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $i = 1;
            if ($datas->num_rows() > 0) {
                foreach ($datas->result() as $data) {
                    ?>
                    <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo $data->receipt_master_id; ?></td>
                        <td class="text-right"><?php echo $data->price_sum_pay; ?></td> 
                        <td><?php echo $data->shop_name; ?></td>                                             
                        <td><?php echo $this->mics->dateen2stringthMS($data->date_receipt); ?></td> 
                        <td class="text-center"><span class="<?php echo ($data->confirm_order_id == 2) ? 'badge badge-success' : 'badge badge-warning'; ?>"><i class="<?php echo ($data->confirm_order_id == 2) ? 'fa fa-check-circle-o' : ''; ?>"></i> <?php echo $data->confirm_order_name; ?></span></td>                   
                        <td class="text-center">
                            <a href="<?php echo base_url() . 'receiptdetail/' . $data->receipt_master_id_pri; ?>" target="_blank" class="btn btn-sm btn-outline-primary"><i class="fa fa-eye"></i> ดู</a>
                            <?php if ($data->confirm_order_id == 1) { ?>
                                <a href="javascript:void(0)" onclick="modal_confirm(<?php echo $data->receipt_master_id_pri; ?>);" class="btn btn-sm btn-outline-success"><i class="fa fa-check-circle"></i> ออกใบแจ้งหนี้</a>
                                <a href="javascript:void(0)" onclick="modal_cancel(<?php echo $data->receipt_master_id_pri; ?>);" class="btn btn-sm btn-outline-danger"><i class="fa fa-close"></i> ยกเลิก</a>
                            <?php } else { ?>
                                <a href="javascript:void(0)" class="btn btn-sm btn-outline-secondary"><i class="fa fa-check-circle"></i> ออกใบแจ้งหนี้</a>
                                <a href="javascript:void(0)" class="btn btn-sm btn-outline-secondary"><i class="fa fa-close"></i> ยกเลิก</a>                            
                            <?php } ?>
                        </td>
                    </tr>
                    <?php
                    $i++;
                }
            }
            ?>                    
        </tbody>
    </table>
</div>

<script>
    $(document).ready(function () {
        $('.table-datatable').DataTable();
    });
</script>