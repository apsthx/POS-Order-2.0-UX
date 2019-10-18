<div class="table-responsive">
    <table class="table table-striped table-bordered table-datatable">                
        <thead>
            <tr>
                <th>#</th>
                <th>เลขที่ใบ</th>  
                <th class="text-right">ราคารวม</th>
                <th class="text-center">วันที่ออกใบ</th>
                <th class="text-center">สถานะใบเสร็จ</th>
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
                        <td class="text-center"><?php echo $this->mics->dateen2stringthMS($data->date_receipt); ?></td> 
                        <td class="text-center"><span class="<?php echo ($data->status_receipt_id == 1) ? 'badge badge-success' : 'badge badge-danger'; ?>"><i class="<?php echo ($data->status_receipt_id == 1) ? 'fa fa-check-circle' : 'fa fa-times-circle-o'; ?>"></i> <?php echo $this->receipt_model->ref_status_receipt($data->status_receipt_id)->row()->status_receipt_name; ?></span></td>                   
                        <td class="text-center">
                            <?php if ($data->type_receipt_id == 2) { ?>
                                <a href="<?php echo base_url() . 'receiptdetail/' . $data->receipt_master_id_pri; ?>" target="_blank" class="btn btn-sm btn-outline-warning"><i class="mdi mdi-file"></i> ออกใบเสร็จ</a>
                            <?php } ?>
                            <?php if ($data->type_receipt_id == 3) { ?>
                                <a href="<?php echo base_url() . 'receiptdetail/' . $data->receipt_master_id_pri; ?>" target="_blank" class="btn btn-sm btn-outline-info"><i class="fa fa-file-o"></i> ปรับสถานะ</a>
                            <?php } ?>
                            <a href="<?php echo base_url() . 'receipt/printbill/' . $data->receipt_master_id_pri; ?>" target="_blank" class="btn btn-sm btn-outline-success"><i class="fa fa-print"></i> ปริ้นแบบเต็ม</a>
                            <a href="<?php echo base_url() . 'receipt/billiv/' . $data->receipt_master_id_pri; ?>"  target="_blank" class="btn btn-sm btn-outline-success"><i class="fa fa-print"></i> ปริ้นแบบย่อ</a>
                            <a href="<?php echo base_url() . 'receiptdetail/' . $data->receipt_master_id_pri; ?>" target="_blank" class="btn btn-sm btn-outline-primary"><i class="fa fa-eye"></i> ดู</a>
                            <?php if ($data->status_receipt_id == 1) { ?>
                                <a href="javascript:void(0)" onclick="modal_edit(<?php echo $data->receipt_master_id_pri; ?>);" class="btn btn-sm btn-outline-danger"><i class="fa fa-close"></i> ยกเลิก</a>
                            <?php } else { ?>
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