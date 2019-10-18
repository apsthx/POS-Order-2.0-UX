
<div class="table-responsive">
    <table class="table table-striped table-bordered table-datatable">                
        <thead>
            <tr>
                <th>#</th>
                <th>เลขที่ใบ</th>  
                <th>ประเภท</th>  
                <th>คู่ค้า</th>
                <th class="text-right">ราคารวม</th>
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
                        <td><?php echo $this->ordermain_model->ref_type_receipt($data->type_receipt_id)->row()->type_receipt_name; ?></td>
                        <td><?php echo $data->customer_name; ?></td>
                        <td class="text-right"><?php echo number_format($data->price_sum_pay,2); ?></td> 
                        <td><?php echo $this->mics->dateen2stringthMS($data->date_receipt); ?></td> 
                        <td class="text-center"><span class="<?php echo ($data->status_transfer_id == 3) ? 'badge badge-success' : 'badge badge-warning'; ?>"> <?php echo $data->status_pay_name . ' / ' . $data->status_transfer_name; ?></span></td>                   
                        <td class="text-center">
                            <form target="_blank" method="post" action="<?php echo base_url() . 'receipt/printbilla4'; ?>">
                                <input type="hidden" name="receipt_master_id_pri_arr[]" value="<?php echo $data->receipt_master_id_pri; ?>"/>
                                <?php if ($data->status_transfer_id != 3) { ?>
                                    <button type="button" class="btn btn-sm btn-outline-success" onclick="pay_modal(<?php echo $data->receipt_master_id_pri; ?>);"><i class="fa fa-money"></i> ชำระเงิน + รับของ</button>
                                <?php } else { ?>
                                    <a href="javascript:void(0)" class="btn btn-sm btn-outline-secondary"><i class="fa fa-money"></i> ชำระเงิน + รับของ</a>                            
                                <?php } ?>
                                <button type="submit" class="btn btn-sm btn-outline-success"><i class="fa fa-print"></i> ปริ้น</button>
                                <a href="<?php echo base_url() . 'receiptdetail/' . $data->receipt_master_id_pri; ?>" target="_blank" class="btn btn-sm btn-outline-primary"><i class="fa fa-eye"></i> ดู</a>
                                <?php if ($data->status_receipt_id == 1) { ?>
                                    <a href="javascript:void(0)" onclick="modal_cancel(<?php echo $data->receipt_master_id_pri; ?>,<?php echo $data->status_pay_id; ?>);" class="btn btn-sm btn-outline-danger"><i class="fa fa-close"></i> ยกเลิก</a>
                                <?php } else { ?>
                                    <a href="javascript:void(0)" class="btn btn-sm btn-outline-secondary"><i class="fa fa-close"></i> ยกเลิก</a>                            
                                <?php } ?>
                            </form>
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
                <h4 class="modal-title"><i class="fa fa-clipboard"></i>&nbsp; ชำระเงิน</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <form method="post" action="<?php echo base_url() . 'ordermain/payment'; ?>" onsubmit="return submit_pay();">
                <input type="hidden" id="pay_id_pri" name="receipt_master_id_pri"/>

                <div class="modal-body">

                    <div class="row">
                        <label class="col-md-12 text-center">ระบบตัดเงินในกระเป๋าเงิน และเพิ่มจำนวนสินค้าให้อัตโนมัติ</label>
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


<div class="modal fade" id="cancel_modal">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h4 class="modal-title"><i class="fa fa-edit"></i>&nbsp;ยกเลิกใบสั่งซื้อ</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <div class="bootbox-body">
                    <form class="form-material m-t-10" method="post" action="<?php echo base_url() . 'ordermain/cancel'; ?>" onsubmit="return submit_cancel();">
                        <input type="hidden" name="receipt_master_id_pri" id='cancel_id_pri'>
                        <input type="hidden" name="bank_ck" id='bank_ck'>

                        <div class="row" id="bank_cancel">
                            <label class="col-md-4 text-right">เงินคืนบัญชีเงิน</label>
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
                            <label class="col-md-4 text-right"> ยกเลิกเพราะ : </label>
                            <div class="col-md-6" >
                                <input type="text" name="comment" id='comment' class="form-control form-control-sm" required="">
                            </div>
                        </div>
                        <br/>
                        <div class="row">
                            <div class="col-md-12 text-center">
                                <button type="submit" class="btn btn-outline-info"><i class="fa fa-save"></i>&nbsp;บันทึก</button>
                                &nbsp;
                                <button type="button" class="btn btn-outline-danger" data-dismiss="modal" aria-hidden="true" ><i class="fa fa-close"></i>&nbsp;ยกเลิก</button>
                            </div>
                        </div>
                    </form>
                </div>                    
            </div>

        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        $('.table-datatable').DataTable();
    });

    function pay_modal(receipt_master_id_pri) {
        $('#pay_id_pri').val(receipt_master_id_pri);
        $('#pay_modal').modal('show', {backdrop: 'true'});
    }
    function submit_pay() {
        $('#pay_modal').modal('hide');
        $('body').loading();
        return true;
    }

    function modal_cancel(receipt_master_id_pri, status_pay_id) {
        if (status_pay_id == 1) {
            $('#bank_cancel').show();
            $('#bank_ck').val(1);
        } else {
            $('#bank_cancel').hide();
            $('#bank_ck').val(0);
        }
        $('#cancel_id_pri').val(receipt_master_id_pri);
        $('#cancel_modal').modal('show', {backdrop: 'true'});
    }

    function submit_cancel() {
        $('#cancel_modal').modal('hide');
        $('body').loading();
        return true;
    }
</script>