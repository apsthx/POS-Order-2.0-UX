
<form id="form-receipt" action="<?php echo base_url() . 'transport/transfer_confirme'; ?>" onsubmit="return submit_receipt();" method="post">
    <div class="table-responsive">
        <table class="table table-striped table-bordered table-datatable">                
            <thead>
                <tr>
                    <?php if ($status_transfer_id == 1) { ?>
                        <th class="text-center" style="padding: 0px;">
                            <input type="checkbox" class="col-sm-4 offset-sm-2" name="" id="select_receipt_checkbox_all" onchange="select_all();">
                            <label for="select_receipt_checkbox_all">เลือก</label>
                        </th>
                    <?php } ?>
                    <th>#</th>
                    <th>เลขที่ใบเสร็จ</th>  
                    <th>ลูกค้า</th>  
                    <th>พนักงาน</th>  
                    <th class="text-center"><?php echo ($status_transfer_id == 1) ? 'วันที่บรรจุสินค้า' : 'วันที่ส่งสินค้า'; ?></th>
                    <th class="">บริการขนส่ง</th>
                    <th class="text-right">ค่าขนส่ง</th>
                    <th class="text-center">สถานะส่งสินค้า</th>
                    <th class="text-center">ตัวเลือก</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 1;
                if ($datas->num_rows() > 0) {
                    foreach ($datas->result() as $data) {
                        ?>
                    <input type="text" style="display:none;" name="receipt_master_id_pri_arr[<?php echo $i; ?>]" value="<?php echo $data->receipt_master_id_pri; ?>"/>
                    <input type="text" style="display:none;" name="status_transfer_id_arr[<?php echo $i; ?>]" value="<?php echo $data->status_transfer_id; ?>"/>

                    <tr>
                        <?php if ($data->status_receipt_id == 1 && $data->status_transfer_id == 1) { ?>
                            <th class="text-center">
                                <input type="checkbox" name="select_receipt_checkbox[<?php echo $i; ?>]" class="col-sm-4 offset-sm-2 select_receipt_checkbox" id="select_receipt_checkbox<?php echo $data->receipt_master_id; ?>">
                                <label for="select_receipt_checkbox<?php echo $data->receipt_master_id; ?>"  style="margin-bottom: -5px;"></label>
                            </th>
                        <?php } ?>
                        <td class="text-center" <?php echo $i; ?></td>
                        <td><?php echo $data->receipt_master_id; ?></td>
                        <td><?php echo $data->customer_name; ?></td>
                        <td><?php echo $data->fullname; ?></td>
                        <td class="text-center"><?php echo $this->mics->date2thai(($status_transfer_id == 1 ? $data->date_pack : $data->date_transfer), '%d %m %y', 1); ?></td> 
                        <td><?php echo $data->transport_service_name; ?></td>
                        <td class="text-right"><?php echo number_format($data->transport_price, 2); ?></td> 
                        <?php
                        $deley = 0;
                        $datediff = date_diff(date_create(date('Y-m-d')), date_create($data->date_pay))->days;
                        $datedeley = $this->transport_model->get_transport_setting()->row()->date_deley;
                        if ($datediff >= $datedeley) {
                            $deley = 1;
                        }
                        if ($status_transfer_id == 1) {
                            ?>
                            <td class="text-center"><span class="<?php echo ($deley == 0) ? 'badge badge-warning' : 'badge badge-danger'; ?>"><?php echo ($deley == 0) ? $this->transport_model->ref_status_transfer($data->status_transfer_id)->row()->status_transfer_name : 'ล่าช้า'; ?></span></td>    
                            <?php
                        } else {
                            ?>
                            <td class="text-center"><span class="badge badge-success"><?php echo $this->transport_model->ref_status_transfer($data->status_transfer_id)->row()->status_transfer_name; ?></span></td>    
                            <?php
                        }
                        ?>
                        <td class="text-center">
                            <a href="<?php echo base_url() . 'receiptdetail/' . $data->receipt_master_id_pri; ?>" target="_blank" class="btn btn-sm btn-outline-primary"><i class="fa fa-eye"></i> ดู</a>
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

    <div class="modal fade" id="modal_receipt_transfer">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <h4 class="modal-title"><i class="fa fa-truck"></i>&nbsp;ยืนยันการจัดส่ง</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>

                <div class="modal-body">

                    <div class="row">
                        <div class="col-md-12 text-center" >
                            ยืนยันการจัดส่ง ที่เลือกใช่หรือไม่ <i class="fa fa-question-circle"></i>
                        </div>
                    </div>
                    <p/>
                    <div class="row">
                        <div class="col-md-12 text-center" >
                            เลือกหัวข้อ SMS : 
                            <select id="head_sms_id" name="head_sms_id" class="form-control form-control-sm col-sm-8">
                                <option value="null"><?php echo 'เลขใบเสร็จ..'; ?></option>
                                <?php foreach ($this->transport_model->get_head_sms()->result() as $head_sms) { ?>
                                    <option value="<?php echo $head_sms->head_sms_id; ?>"><?php echo $head_sms->head_sms_name; ?></option>
                                <?php }
                                ?>
                            </select>
                        </div>
                    </div>
                    <p/>
                    <div class="row">
                        <div class="col-md-12 text-center" >
                            <input type="checkbox" name="send_sms" id="send_sms">
                            <label for="send_sms">ส่ง SMS Tacking id.</label>
                            <br/>
                            <?php $credit_balance = $this->accesscontrol->checksms()->credit_balance; ?>
                            <input type="hidden" id="send_sms_credit_balance" value="<?php echo $credit_balance; ?>" >
                            <label class="text-warning" id="send_sms_text" style="display: none;"><?php echo '( SMS คงเหลือ ' . number_format($credit_balance, 0) . ' เครดิต )'; ?> </label>
                            <label class="text-danger" id="send_sms_text_not" style="display: none;"><?php echo '**เครดิต SMS ไม่พอส่ง ( คงเหลือ ' . number_format($credit_balance, 0) . ' เครดิต )'; ?>
                                <a href="<?php echo base_url() . 'package'; ?>" class="btn btn-xs btn-outline-primary"><i class="fa fa-envelope" ></i> เลือกเติมเครดิต SMS</a>
                            </label>
                        </div>
                    </div>
                    <p/>
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <button type="submit" id="bt-submit-receipt" class="btn btn-outline-warning"><i class="fa fa-check-circle"></i> ยืนยัน</button>
                            <button type="button" class="btn btn-outline-inverse" data-dismiss="modal" aria-hidden="true" ><i class="fa fa-close"></i>&nbsp;ยกเลิก</button>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

</form>

<script>
    $(document).ready(function () {
        $('.table-datatable').DataTable({
            'aoColumnDefs': [{
                    'bSortable': false,
                    'aTargets': [0]
                }]
        });
    });

    function modal_receipt_transfer() {
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
        $('#modal_receipt_transfer').modal('show', {backdrop: 'true'});
    }

    function submit_receipt() {
        $('#modal_receipt_transfer').modal('hide');
        $('body').loading();
        return true;
    }

    function select_all() {
        if ($('#select_receipt_checkbox_all').is(':checked')) {
            $('.select_receipt_checkbox').prop('checked', true)
        } else {
            $('.select_receipt_checkbox').prop('checked', false)
        }
    }
</script>