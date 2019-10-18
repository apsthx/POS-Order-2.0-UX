<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-block">
                <h4 class="card-title"><i class="fa fa-plus-circle"></i> <?php echo 'แจ้งชำระเงิน - ผ่านบัญชีธนาคาร'; ?></h4>  
                <div class="table-responsive">
                    <table class="table table-striped table-bordered">                
                        <thead>
                            <tr>
                                <th class="text-right" width="3%">#</th>
                                <th>ธนาคาร</th>
                                <th class="">สาขา</th>
                                <th class="">เลขที่บัญชี</th>
                                <th class="">ชื่อบัญชี</th>
                                <th class="text-center" width="26%">ตัวเลือก</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 1;
                            if ($datas->num_rows() > 0) {
                                foreach ($datas->result() as $data) {
                                    ?>
                                    <tr>
                                        <td class="text-right"><?php echo $i; ?></td>
                                        <td><?php echo $data->income_bank_name; ?></td>
                                        <td class=""><?php echo $data->income_bank_branch; ?></td>
                                        <td class=""><?php echo $data->income_bank_account_name; ?></td>
                                        <td class=""><?php echo $data->income_bank_accoun_number; ?></td>
                                        <td class="text-center">  
                                            <?php if ($this->accesscontrol->getMyShop($this->session->userdata('shop_id_pri'))->type_shop_id == 1) { ?>
                                                <button type="button" class="btn btn-sm btn-outline-info" onclick="modalAdd(<?php echo $data->income_bank_id; ?>)"><i class="fa fa-gift"></i> แจ้งชำระ ค่าแพ็กเกจ</button> 
                                            <?php } ?>
                                            <button type="button" class="btn btn-sm btn-outline-primary" onclick="modalAddSMS(<?php echo $data->income_bank_id; ?>)"><i class="fa fa-envelope"></i> แจ้งชำระ ค่าบริการ SMS</button> 
                                        </td>
                                    </tr>
                                    <?php
                                    $i++;
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
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-block">
                <h4 class="card-title"><i class="fa fa-history"></i> <?php echo 'ประวัติการชำระเงิน'; ?></h4>  
                <div class="table-responsive">
                    <table class="table table-striped table-bordered">                
                        <thead>
                            <tr>
                                <th class="text-right" width="3%">#</th>
                                <th class="">แพ็กเกจ / SMS</th>
                                <th>โอนเข้าธนาคาร</th>
                                <th class="">โอนโดย</th>
                                <th class="">จำนวนเงิน</th>
                                <th class="">วันที่โอน</th>
                                <th class="">เวลาโอน</th>
                                <th class="">เลขที่อ้างอิง</th>
                                <th class="text-center">หลักฐานการโอน</th>
                                <th class="text-center" width="12%">สถานะ</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 1;
                            if ($receipts->num_rows() > 0) {
                                foreach ($receipts->result() as $receipt) {
                                    ?>
                                    <tr>
                                        <td class="text-right"><?php echo $i; ?></td>
                                        <td><?php echo ($receipt->package_id != null) ? $this->payment_model->getPackage($receipt->package_id)->row()->package_name : $this->payment_model->getSMS($receipt->sms_id)->row()->sms_name; ?></td>
                                        <td><?php echo $receipt->income_bank_name . ' ' . $receipt->income_bank_branch . ' ' . $receipt->income_bank_account_name; ?></td>
                                        <td class=""><?php echo $receipt->receipt_by; ?></td>
                                        <td class=""><?php echo number_format($receipt->receipt_cost, 2); ?></td>
                                        <td class=""><?php echo $this->mics->date2thai($receipt->receipt_datepay, '%d %m %y', 1); ?></td>
                                        <td class=""><?php echo $this->mics->date2thai($receipt->receipt_timepay, '%h:%i'); ?></td>
                                        <td class=""><?php echo $receipt->receipt_number; ?></td>
                                        <td class="text-center">
                                            <a href="<?php echo base_url() . 'store/receipt/' . $receipt->receipt_evidence; ?>"  class="fancybox">
                                                <image src="<?php echo base_url() . 'store/receipt/bank.png'; ?>" class="img-responsive" style="width: 35px; height: 40px;"/>
                                            </a>
                                        </td>
                                        <?php if ($receipt->receipt_check == 0) { ?>
                                            <td class="text-center"><span class="label label-warning"><i class="fa fa-warning"></i> รอตรวจสอบ</span></td>
                                        <?php } else if ($receipt->receipt_check == 1) { ?>
                                            <td class="text-center"><span class="label label-success"><i class="fa fa-check-circle"></i> ตรวจสอบผ่าน</span></td>                                      
                                        <?php } else { ?>
                                            <td class="text-center"><span class="label label-danger"><i class="fa fa-times-circle"></i> ตรวจสอบไม่ผ่าน</span></td>                         
                                        <?php } ?>
                                    </tr>
                                    <?php
                                    $i++;
                                }
                            } else {
                                ?>
                                <tr>
                                    <td class="text-center" colspan="10"><?php echo 'ไม่มีข้อมูล'; ?></td>
                                </tr>
                                <?php
                            }
                            ?>                   
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="for_modal"></div>
<script>
    var service_base_url = $('#service_base_url').val();

    function modalAdd(income_bank_id) {
        $.ajax({
            url: service_base_url + 'payment/receiptadd',
            type: 'post',
            data: {
                income_bank_id: income_bank_id
            },
            success: function (response) {
                $('#for_modal').html(response);
                $("#on_modal").modal('show', {backdrop: 'static'});
            }
        });
    }
    function modalAddSMS(income_bank_id) {
        $.ajax({
            url: service_base_url + 'payment/receiptaddsms',
            type: 'post',
            data: {
                income_bank_id: income_bank_id
            },
            success: function (response) {
                $('#for_modal').html(response);
                $("#on_modal").modal('show', {backdrop: 'static'});
            }
        });
    }
</script>
