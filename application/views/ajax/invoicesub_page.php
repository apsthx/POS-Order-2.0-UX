<p/>
<div class="row">
    <div class="col-sm-12 text-right">
        <button type="button" class="btn btn-sm btn-outline-warning" onclick="modal_sand();"><i class="fa fa-clipboard"></i> ส่งของที่เลือก</button>
        <button type="button" class="btn btn-sm btn-outline-success" onclick="modal_receipt_process();"><i class="fa fa-clipboard"></i> ออกใบเสร็จที่เลือก</button>
    </div>
</div>

<form id="form-receipt" action="<?php echo base_url() . 'invoicesub/receipt_sand'; ?>" onsubmit="return submit_receipt();" method="post">

    <input type="hidden" name="print_ck" id="print_ck" value=""/>

    <div class="table-responsive">
        <table class="table table-striped table-bordered table-datatable" style="font-size: 14px;">                
            <thead>
                <tr>
                    <th class="text-center" style="padding: 0px;">
                        <input type="checkbox" class="col-sm-4 offset-sm-2" name="" id="select_receipt_checkbox_all" onchange="select_all();">
                        <label for="select_receipt_checkbox_all">จัดส่ง</label>
                    </th>
                    <th class="text-center" style="padding: 0px;">
                        <input type="checkbox" class="col-sm-4 offset-sm-2" name="" id="select_receipt_checkbox_all_receipt" onchange="select_all_receipt();">
                        <label for="select_receipt_checkbox_all_receipt">ใบเสร็จ</label>
                    </th>
                    <th>#</th>
                    <th>เลขที่ใบ</th>
                    <th class="text-right">ราคารวม</th>
                    <th>ชื่อร้าน</th>
                    <th>วันที่ออกใบ</th>
                    <th class="text-center">สินเชื่อเครดิต (วัน)</th>
                    <th class="text-center">สถานะขนส่ง</th>
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
                        <tr>
                            <td class="text-center" style="padding: 0px;">
                                <input type="hidden" class="status_receipt_id_arr" name="status_receipt_id_arr[<?php echo $i; ?>]" value="<?php echo $data->status_receipt_id; ?>"/>
                                <input type="hidden" class="status_receipt_order_id_arr" name="status_receipt_order_id_arr[<?php echo $i; ?>]" value="<?php echo $data->status_receipt_order_id; ?>"/>

                                <input type="hidden" class="receipt_master_id_pri_arr" name="receipt_master_id_pri_arr[<?php echo $i; ?>]" value="<?php echo $data->receipt_master_id_pri; ?>"/>

                                <?php if ($data->status_transfer_id == 1) { ?>
                                    <input type="checkbox" name="select_receipt_checkbox_send[<?php echo $i; ?>]" class="col-sm-4 offset-sm-2 select_receipt_checkbox" id="select_receipt_checkbox<?php echo $data->receipt_master_id; ?>">
                                    <label for="select_receipt_checkbox<?php echo $data->receipt_master_id; ?>" style="margin-top: 10px;"></label>
                                <?php } ?>
                            </td>
                            <td class="text-center" style="padding: 0px;">
                                <?php if ($data->status_receipt_order_id == 1) { ?>
                                    <input type="checkbox" name="select_receipt_checkbox[<?php echo $i; ?>]" class="col-sm-4 offset-sm-2 select_receipt_checkbox_receipt" id="select_receipt_checkbox_receipt<?php echo $data->receipt_master_id; ?>">
                                    <label for="select_receipt_checkbox_receipt<?php echo $data->receipt_master_id; ?>"  style="margin-top: 10px;"></label>
                                <?php } ?>
                            </td>
                            <td><?php echo $i; ?></td>
                            <td><?php echo $data->receipt_master_id; ?></td>
                            <td class="text-right"><?php echo $data->price_sum_pay; ?></td> 
                            <td><?php echo $data->customer_name; ?></td>                                             
                            <td><?php echo $this->mics->dateen2stringthMS($data->date_receipt); ?></td> 
                            <td class="text-center"><?php echo ($data->credit == 0) ? 'ไม่มี' : $data->credit; ?></td>     
                            <td class="text-center"><span class="<?php echo ($data->status_transfer_id == 3) ? 'badge badge-success' : 'badge badge-warning'; ?>"><i class="<?php echo ($data->status_transfer_id == 3) ? 'fa fa-check-circle-o' : ''; ?>"></i> <?php echo $data->status_transfer_name; ?></span></td>                   
                            <td class="text-center"><span class="<?php echo ($data->status_pay_id == 1) ? 'badge badge-success' : 'badge badge-warning'; ?>"><i class="<?php echo ($data->status_pay_id == 1) ? 'fa fa-check-circle-o' : 'fa fa-info-circle'; ?>"></i> <?php echo $data->status_pay_name; ?></span></td>                   
                            <td class="text-center"><span class="<?php echo ($data->status_receipt_order_id == 2) ? 'badge badge-success' : 'badge badge-warning'; ?>"><i class="<?php echo ($data->status_receipt_order_id == 2) ? 'fa fa-check-circle-o' : 'fa fa-info-circle'; ?>"></i> <?php echo $data->status_receipt_order_name; ?></span></td>                   
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


    <div class="modal fade" id="modal_sand">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <h4 class="modal-title"><i class="fa fa-truck"></i>&nbsp;ยืนยันการจัดส่ง</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>

                <div class="modal-body">
                    <div class="row">
                        <label class="col-md-12 text-center">จัดส่งที่เลือก ใช่หรือไม่ <i class="fa fa-question-circle"></i></label>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12 text-center">
                        <button type="submit" id="bt-submit-receipt" class="btn btn-outline-success"><i class="fa fa-save"></i> บันทึก</button>
                        <button type="button" class="btn btn-outline-inverse" data-dismiss="modal" aria-hidden="true" ><i class="fa fa-close"></i>&nbsp;ยกเลิก</button>
                    </div>
                </div>
                <br/>

            </div>
        </div>
    </div>

    <div class="modal fade" id="modal_receipt_process">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <h4 class="modal-title"><i class="fa fa-clipboard"></i>&nbsp;ออกใบเสร็จ</h4>
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
                        <div class="col-md-12 text-center">
                            <button type="submit" id="bt-submit-receipt" class="btn btn-outline-success"><i class="fa fa-save"></i> บันทึก</button>
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

    function select_all() {
        if ($('#select_receipt_checkbox_all').is(':checked')) {
            $('.select_receipt_checkbox').prop('checked', true)
        } else {
            $('#modal_receipt_cancel').modal('hide');
            $('.select_receipt_checkbox').prop('checked', false)
        }
    }

    function print_ck_select(ck) {
        $('#print_ck').val(ck);
    }

    function select_all_receipt() {
        if ($('#select_receipt_checkbox_all_receipt').is(':checked')) {
            $('.select_receipt_checkbox_receipt').prop('checked', true)
        } else {
            $('#modal_receipt_cancel').modal('hide');
            $('.select_receipt_checkbox_receipt').prop('checked', false)
        }
    }

    function modal_receipt_process() {
        $('#modal_receipt_process').modal('show', {backdrop: 'true'});
        $('#form-receipt').prop('action', service_base_url + 'invoicesub/receipt_process');
    }

    function modal_sand() {
        $('#modal_sand').modal('show', {backdrop: 'true'});
        $('#form-receipt').prop('action', service_base_url + 'invoicesub/receipt_sand');
    }

    function modal_alienate(receipt_master_id_pri) {
        $('#alienate_id_pri').val(receipt_master_id_pri);
        $('#modal_alienate').modal('show', {backdrop: 'true'});
    }

    function submit_alienate() {
        $('#modal_alienate').modal('hide');
        $('body').loading();
        return true;
    }

    function submit_receipt() {

        if ($('#print_ck').val() != '') {
            $('#form-receipt').attr('target', '_blank');
        }

        if ($('#print_ck').val() != '') {
            $('#modelsuccess').modal('show', {backdrop: 'true'});
        }

        $('#modal_receipt_process').modal('hide');
        $('#modal_sand').modal('hide');
        $('body').loading();
        return true;
    }
</script>