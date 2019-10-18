<p/>
<div class="row">
    <div class="col-sm-12 text-right">
        <button type="button" class="btn btn-sm btn-outline-success" onclick="modal_receipt_print();"><i class="fa fa-print"></i> ปริ้นใบเปิด Order ที่เลือก</button>
        <button type="button" class="btn btn-sm btn-outline-warning" onclick="modal_receipt_process();"><i class="fa fa-clipboard"></i> ยืนยันการชำระเงิน</button>
    </div>
</div>

<form id="form-receipt" action="<?php echo base_url() . 'receipt/receipt_process'; ?>" onsubmit="return submit_receipt();" method="post">

    <input type="hidden" id="print_ck" value=""/>
    <input type="hidden" name="print_order" id="print_order" value=""/>

    <div class="table-responsive">

        <table class="table table-striped table-bordered table-datatable">                
            <thead>
                <tr>
                    <th class="text-center" style="padding: 0px;">
                        <input type="checkbox" class="col-sm-4 offset-sm-2" name="" id="select_receipt_checkbox_all" onchange="select_all();">
                        <label for="select_receipt_checkbox_all">เลือก</label>
                    </th>
                    <th>#</th>
                    <th>เลขที่ใบเปิด Order</th>  
                    <th class="text-center">กลุ่มลูกค้า</th>
                    <th class="text-right">ราคารวม</th>
                    <th class="text-center">วันที่ออกใบ</th>
                    <th class="text-center">สถานะ</th>
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
                    <input type="text" style="display:none;" class="receipt_master_id_pri_arr" name="receipt_master_id_pri_arr[<?php echo $i; ?>]" value="<?php echo $data->receipt_master_id_pri; ?>"/>
                    <input type="text" style="display:none;" class="status_receipt_id_arr" name="status_receipt_id_arr[<?php echo $i; ?>]" value="<?php echo $data->status_receipt_id; ?>"/>
                    <input type="text" style="display:none;" class="status_receipt_order_id_arr" name="status_receipt_order_id_arr[<?php echo $i; ?>]" value="<?php echo $data->status_receipt_order_id; ?>"/>
                    <tr>
                        <td class="text-center" style="padding: 0px;">
                            <?php if ($data->status_receipt_id == 1 && $data->status_receipt_order_id == 1) { ?>
                                <input type="checkbox" name="select_receipt_checkbox[<?php echo $i; ?>]" class="col-sm-4 offset-sm-2 select_receipt_checkbox" id="select_receipt_checkbox<?php echo $data->receipt_master_id; ?>">
                                <label for="select_receipt_checkbox<?php echo $data->receipt_master_id; ?>"  style="margin-top: 10px;"></label>
                            <?php } ?>
                        </td>
                        <td><?php echo $i; ?></td>
                        <td><?php echo $data->receipt_master_id; ?></td>
                        <td><?php echo $this->receipt_model->getCustomer($data->customer_id); ?></td>
                        <td class="text-right"><?php echo number_format($data->price_sum_pay, 2); ?></td> 
                        <td class="text-center"><?php echo $this->mics->dateen2stringthMS($data->date_receipt); ?></td> 
                        <td class="text-center"><span class="<?php echo ($data->status_receipt_id == 1) ? 'badge badge-success' : 'badge badge-danger'; ?>"><i class="<?php echo ($data->status_receipt_id == 1) ? 'fa fa-check-circle' : 'fa fa-times-circle-o'; ?>"></i> <?php echo $this->receipt_model->ref_status_receipt($data->status_receipt_id)->row()->status_receipt_name; ?></span></td>      
                        <td class="text-center"><span class="<?php echo ($data->status_receipt_order_id == 1) ? 'badge badge-warning' : 'badge badge-success'; ?>"><i class="<?php echo ($data->status_receipt_order_id == 1) ? 'fa fa-info-circle' : 'fa fa-check-circle'; ?>"></i> <?php echo $this->receipt_model->ref_status_receipt_order($data->status_receipt_order_id)->row()->status_receipt_order_name; ?></span></td>                  
                        <td class="text-center">
                            <a href="<?php echo base_url() . 'receiptdetail/' . $data->receipt_master_id_pri; ?>" target="_blank" class="btn btn-sm btn-outline-primary"><i class="fa fa-eye"></i> ดู</a>
                            <?php
                            if ($data->status_receipt_id == 1 && $data->status_receipt_order_id == 1) {
                                ?>
                                <a href="<?php echo base_url() . 'quotation?receipt_edit=' . $data->receipt_master_id_pri; ?>" class="btn btn-sm btn-outline-info"><i class="fa fa-edit"></i> แก้ไข</a>
                                <a href="javascript:void(0)" onclick="modal_cancel(<?php echo $data->receipt_master_id_pri; ?>);" class="btn btn-sm btn-outline-danger"><i class="fa fa-close"></i> ยกเลิก</a>
                            <?php } else { ?>
                                <a href="javascript:void(0)" class="btn btn-sm btn-outline-secondary"><i class="fa fa-edit"></i> แก้ไข</a>
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


    <div class="modal fade" id="modal_receipt_process">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <h4 class="modal-title"><i class="fa fa-clipboard"></i>&nbsp;ยืนยันการชำระเงิน / ออกใบเสร็จ</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>

                <div class="modal-body">

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
                        <div class="col-md-12 text-center" >
                            <input type="radio" id="radio_1" checked="" onclick="print_ck_select('')" name="print" value="none">
                            <label for="radio_1">ไม่ปริ้น</label>
                            &nbsp;
                            <input type="radio" id="radio_2" onclick="print_ck_select('a4')"  name="print" value="a4">
                            <label for="radio_2">A4</label>
                            &nbsp;
                            <input type="radio" id="radio_3" onclick="print_ck_select('a5')"  name="print" value="a5">
                            <label for="radio_3">1/2 A4</label>
                        </div>
                    </div>
                    <p/>
                    <div class="row">
                        <div class="col-md-12 text-center" >
                            <input type="checkbox" name="send_sms" id="send_sms">
                            <label for="send_sms">ส่ง SMS แจ้งการชำระเงิน</label>
                            <br/>
                            <?php $credit_balance = $this->accesscontrol->checksms()->credit_balance; ?>
                            <input type="hidden" id="send_sms_credit_balance" value="<?php echo $credit_balance; ?>" >
                            <label class="text-warning" id="send_sms_text" style="display: none;"><?php echo '( SMS คงเหลือ ' . number_format($credit_balance, 0) . ' เครดิต )'; ?> </label>
                            <label class="text-danger" id="send_sms_text_not" style="display: none;"><?php echo '**เครดิต SMS ไม่พอส่ง ( คงเหลือ ' . number_format($credit_balance, 0) . ' เครดิต )'; ?>
                                <a href="<?php echo base_url().'package'; ?>" class="btn btn-xs btn-outline-primary"><i class="fa fa-envelope" ></i> เลือกเติมเครดิต SMS</a>
                            </label>
                        </div>
                    </div>
                    <p/>
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <button type="submit" id="bt-submit-receipt" class="btn btn-outline-success"><i class="fa fa-save"></i> บันทึก</button>
                            <button type="button" class="btn btn-outline-inverse" data-dismiss="modal" aria-hidden="true" ><i class="fa fa-close"></i>&nbsp;ยกเลิก</button>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="modal_receipt_print">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <h4 class="modal-title"><i class="fa fa-print"></i>&nbsp;ปริ้นใบเสร็จ</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>

                <div class="modal-body">

                    <div class="row">
                        <div class="col-md-12 text-center" >
                            <input type="radio" id="print_modal_2" onclick="change_receipt_print('ac');" name="print_modal" checked="">
                            <label for="print_modal_2">A4</label>
                            &nbsp;
                            <input type="radio" id="print_modal_3" onclick="change_receipt_print('a5');" name="print_modal">
                            <label for="print_modal_3">1/2 A4</label>
                        </div>
                    </div>
                    <p/>
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <button type="submit" id="bt-submit-receipt" class="btn btn-outline-success"><i class="fa fa-print"></i> ปริ้น</button>
                            <button type="button" class="btn btn-outline-inverse" data-dismiss="modal" onclick="cancel_print();" aria-hidden="true" ><i class="fa fa-close"></i>&nbsp;ยกเลิก</button>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

</form>



<div class="modal fade" id="modal_receipt_cancel">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h4 class="modal-title"><i class="fa fa-trash"></i>&nbsp;ยกเลิกใบเปิด Order</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>

            <form action="<?php echo base_url() . 'receipt/cancel'; ?>" onsubmit="return submit_cencel_receipt();" method="post" >
                <input type="hidden" name="id_pri_cancel" id="id_pri_cancel" class="form-control">

                <div class="modal-body">
                    <p/>
                    <div class="row">
                        <div class="col-md-12 text-center" >
                            <label for="comment">เหตุผลที่ยกเลิก</label>
                            <input type="text" name="comment" class="form-control" required="">
                        </div>
                    </div>
                    <br/>
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <button type="submit" id="bt-submit-receipt" class="btn btn-outline-danger"><i class="fa fa-trash"></i> ยกเลิก</button>
                            <button type="button" class="btn btn-outline-inverse" data-dismiss="modal" aria-hidden="true" ><i class="fa fa-close"></i>&nbsp;ปิด</button>
                        </div>
                    </div>
                </div>

            </form>

        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        $('.table-datatable').DataTable({
            'aoColumnDefs': [{
                    'bSortable': false,
                    'aTargets': [0]
                }]
        });
    });

    function print_ck_select(ck) {
        $('#print_ck').val(ck);
    }

    function modal_cancel(receipt_master_id_pri) {
        $('#modal_receipt_cancel').modal('show', {backdrop: 'true'});
        $('#id_pri_cancel').val(receipt_master_id_pri);
    }

    function modal_receipt_process() {
        var countreceiptcheckbox = $('.select_receipt_checkbox').filter(':checked').length;
        var creditbalance = $('#send_sms_credit_balance').val();
        //console.log(countreceiptcheckbox+'/'+ creditbalance);
        if(countreceiptcheckbox > creditbalance){
            $('#send_sms').prop('disabled', true);
            $('#send_sms_text_not').show();
            $('#send_sms_text').hide();
        }else{
            $('#send_sms').prop('disabled', false);
            $('#send_sms_text').show();
            $('#send_sms_text_not').hide();
        }
        $('#modal_receipt_process').modal('show', {backdrop: 'true'});

    }

    function modal_receipt_print() {
        $("#print_order").val('a4');
        $('#modal_receipt_print').modal('show', {backdrop: 'true'});
    }

    function change_receipt_print(print) {
        $("#print_order").val(print);
    }

    function cancel_print() {
        $("#print_order").val('');
    }

    function select_all() {
        if ($('#select_receipt_checkbox_all').is(':checked')) {
            $('.select_receipt_checkbox').prop('checked', true)
        } else {
            $('#modal_receipt_cancel').modal('hide');
            $('.select_receipt_checkbox').prop('checked', false)
        }
    }

    function submit_receipt() {

        if ($('#print_order').val() != '' || $('#print_ck').val() != '') {
            $('#form-receipt').attr('target', '_blank');
        }

        $('#modal_receipt_process').modal('hide');
        $('#modal_receipt_print').modal('hide');
        if ($('#print_order').val() != '' || $('#print_ck').val() != '') {
            $('#modelsuccess').modal('show', {backdrop: 'true'});
        }
        $('body').loading();
        return true;
    }

    function submit_cencel_receipt() {
        $('#modal_receipt_cancel').modal('hide');
        $('body').loading();
        return true;
    }
</script>