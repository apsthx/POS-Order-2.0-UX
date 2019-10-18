
<div class="table-responsive">
    <table class="table table-striped table-bordered table-datatable">                
        <thead>
            <tr>
                <th>#</th>
                <th>เลขที่ใบ</th>  
                <th>ประเภท</th>
                <th class="text-right">ราคารวม</th>
                <th>สถานะการจ่ายเงิน</th>
                <th>สถานะสินค้า</th>
                <th>วันที่ออกใบ</th>
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
                        <td><?php echo $this->purchase_model->ref_type_receipt($data->type_receipt_id)->row()->type_receipt_name; ?></td>
                        <td class="text-right"><?php echo $data->price_sum_pay; ?></td> 
                        <td><?php echo $this->purchase_model->ref_status_pay($data->status_pay_id)->row()->status_pay_name . '  ' . $this->mics->getThaiDate($data->date_pay); ?></td>
                        <td><?php echo $this->purchase_model->ref_status_transfer($data->status_transfer_id)->row()->status_transfer_name . '  ' . $this->mics->dateen2stringthMS($data->transport_date); ?></td>                                             
                        <td><?php echo $this->mics->dateen2stringthMS($data->date_receipt); ?></td> 
                        <td class="text-center"><span class="<?php echo ($data->confirm_order_id == 2) ? 'badge badge-success' : 'badge badge-warning'; ?>"><i class="<?php echo ($data->confirm_order_id == 2) ? 'fa fa-check-circle' : ''; ?>"></i> <?php echo $this->purchase_model->ref_confirm_order($data->confirm_order_id)->row()->confirm_order_name; ?></span></td>                   
                        <td class="text-center">
                            <form style="float: left;" target="_blank" method="post" action="<?php echo base_url() . 'receipt/printbilla4'; ?>">
                                <input type="hidden" name="receipt_master_id_pri_arr[]" value="<?php echo $data->receipt_master_id_pri; ?>"/>
                                <button type="submit" class="btn btn-sm btn-outline-success"><i class="fa fa-print"></i> ปริ้น</button>
                            </form>
                            <a href="<?php echo base_url() . 'receiptdetail/' . $data->receipt_master_id_pri; ?>" target="_blank" class="btn btn-sm btn-outline-primary"><i class="fa fa-eye"></i> ดู</a>
                            <?php if ($data->status_receipt_id == 1 && $data->confirm_order_id == 1) { ?>
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