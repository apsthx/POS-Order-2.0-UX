<div class="table-responsive">
    <table class="table table-striped table-bordered table-datatable" style="font-size: 14px;">                
        <thead>
            <tr>
                <th>#</th>
                <th>เลขที่ใบ</th>  
                <th class="text-right">ราคารวม</th>
                <th>ชื่อร้าน</th>
                <th>วันที่ออกใบ</th>
                <th class="text-center">สินเชื่อเครดิต (วัน)</th>
                <th class="text-center">สถานะขนส่ง</th>
                <th class="text-center">สถานะ</th>
                <th class="text-center">สถานะออกใบเสร็จ</th>
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
                        <td class="text-center"><?php echo ($data->credit == 0) ? 'ไม่มี' : $data->credit; ?></td>     
                        <td class="text-center"><span class="<?php echo ($data->status_transfer_id == 3) ? 'badge badge-success' : 'badge badge-warning'; ?>"><i class="<?php echo ($data->status_transfer_id == 3) ? 'fa fa-check-circle-o' : ''; ?>"></i> <?php echo $data->status_transfer_name; ?></span></td>                   
                        <td class="text-center"><span class="<?php echo ($data->status_pay_id == 1) ? 'badge badge-success' : 'badge badge-warning'; ?>"><i class="<?php echo ($data->status_pay_id == 1) ? 'fa fa-check-circle-o' : ''; ?>"></i> <?php echo $data->status_pay_name; ?></span></td>                   
                        <td class="text-center"><span class="<?php echo ($data->status_receipt_order_id == 2) ? 'badge badge-success' : 'badge badge-warning'; ?>"><i class="<?php echo ($data->status_receipt_order_id == 1) ? 'fa fa-check-circle-o' : ''; ?>"></i> <?php echo $data->status_receipt_order_name; ?></span></td>                   
                        <td class="text-center">
                            <a href="<?php echo base_url() . 'receiptdetail/' . $data->receipt_master_id_pri; ?>" target="_blank" class="btn btn-sm btn-outline-primary"><i class="fa fa-eye"></i> ดู</a>
                            <?php if ($data->status_transfer_id == 2) { ?>
                                <button onclick="modal_transfer(<?php echo $data->receipt_master_id_pri; ?>);" class="btn btn-sm btn-outline-success"><i class="fa fa-check-circle"></i> ยืนยันได้รับของ</button>
                            <?php } else { ?>
                                <button class="btn btn-sm btn-outline-secondary"><i class="fa fa-check-circle"></i> ยืนยันได้รับของ</button>               
                            <?php } ?>
                            <br/>
                            <?php if ($data->status_pay_id == 2) { ?>
                                <button onclick="modal_alienate(<?php echo $data->receipt_master_id_pri; ?>);" class="btn btn-sm btn-outline-success"><i class="fa fa-check-circle"></i> แจ้งโอน</button>
                            <?php } else { ?>
                                <button class="btn btn-sm btn-outline-secondary"><i class="fa fa-check-circle"></i> แจ้งโอน</button>                          
                            <?php } ?>
                            <?php if ($data->status_receipt_order_id == 2 && $data->status_pay_id != 1) { ?>
                                <button onclick="pay_modal(<?php echo $data->receipt_master_id_pri; ?>);" class="btn btn-sm btn-outline-success"><i class="fa fa-money"></i> ตัดเงินในกระเป๋า</button>
                            <?php } else { ?>
                                <button class="btn btn-sm btn-outline-secondary"><i class="fa fa-money"></i> ตัดเงินในกระเป๋า</button>                          
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


<div class="modal fade" id="pay_modal">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h4 class="modal-title"><i class="fa fa-clipboard"></i>&nbsp; ตัดเงินในกระเป๋า</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <form method="post" action="<?php echo base_url() . 'invoicelist/payment'; ?>" onsubmit="return submit_pay();">
                <input type="hidden" id="pay_id_pri" name="receipt_master_id_pri"/>

                <div class="modal-body">

                    <div class="row">
                        <label class="col-md-12 text-center">ระบบตัดเงินในกระเป๋าเงินให้อัตโนมัติ</label>
                    </div>
                    <br/>

                    <div class="row">
                        <label class="col-md-4 text-right">บัญชีเงิน</label>
                        <div class="col-md-6" >
                            <select name="bank_id" class="form-control form-control-sm">
                                <?php
                                $bank = $this->db->where('bank.shop_id_pri', $this->session->userdata('shop_id_pri'))->get('bank');
                                if ($bank->num_rows() > 0) {
                                    foreach ($bank->result() as $row) {
                                        ?>
                                        <option value="<?php echo $row->bank_id; ?>"><?php echo $row->bank_name; ?></option>
                                        <?php
                                    }
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <br/>
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <button type="submit" id="bt-submit-receipt" class="btn btn-outline-success"><i class="fa fa-save"></i> บันทึก</button>
                            <button type="button" class="btn btn-outline-inverse" data-dismiss="modal" aria-hidden="true" ><i class="fa fa-close"></i>&nbsp;ยกเลิก</button>
                        </div>
                    </div>

                </div>

            </form>
        </div>
    </div>
</div>


<script>
    $(document).ready(function () {
        $('.table-datatable').DataTable();
    });

    function modal_transfer(id) {
        $('#id_pri_invoid').val(id);
        $('#confirm-modal').modal('show', {backdrop: 'true'});
    }

    function modal_alienate(receipt_master_id_pri) {
        url = service_base_url + 'invoicelist/modal_alienate';
        $('#open-modal').modal('show', {backdrop: 'true'});
        $('#open-modal .modal-content').html('<div style="text-align:center; padding:80px;"><i class="fa fa-refresh fa-spin fa-3x fa-fw"></i></div>');
        $.ajax({
            url: url,
            method: "POST",
            data: {
                receipt_master_id_pri: receipt_master_id_pri
            },
            success: function (res)
            {
                $('#open-modal .modal-content').html(res);
            }
        });
    }

    function pay_modal(receipt_master_id_pri) {
        $('#pay_id_pri').val(receipt_master_id_pri);
        $('#pay_modal').modal('show', {backdrop: 'true'});
    }
    function submit_pay() {
        $('#pay_modal').modal('hide');
        $('body').loading();
        return true;
    }
</script>