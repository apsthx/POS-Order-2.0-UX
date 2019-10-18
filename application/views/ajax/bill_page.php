<p/>
<div class="row">
    <div class="col-sm-12 text-right">
        <button type="button" class="btn btn-sm btn-outline-success" onclick="modal_receipt_print();"><i class="fa fa-print"></i> ปริ้นที่เลือก</button>
    </div>
</div>

<form id="form-receipt" action="<?php echo base_url() . 'bill/print_receipt'; ?>" target="_blank" onsubmit="return submit_receipt();" method="post">
    <div class="table-responsive">

        <table class="table table-striped table-bordered table-datatable">                
            <thead>
                <tr>
                    <th class="text-center" style="padding: 0px;">
                        <input type="checkbox" class="col-sm-4 offset-sm-2" name="" id="select_receipt_checkbox_all" onchange="select_all();">
                        <label for="select_receipt_checkbox_all">เลือก</label>
                    </th>
                    <th>#</th>
                    <th>เลขที่ใบเสร็จ</th>  
                    <th>เลขที่อ้างอิง</th>  
                    <th class="text-right">ราคารวม</th>
                    <th class="text-center">วันที่ออกใบเสร็จ</th>
                    <th class="text-center">สถานะใบเสร็จ</th>
                    <th class="text-center">สถานะปริ้น</th>
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
                    <input type="text" style="display:none;" name="status_receipt_print_id_arr[<?php echo $i; ?>]" value="<?php echo $data->status_receipt_print_id; ?>"/>

                    <tr>
                        <th class="text-center" style="padding: 0px;">
                            <?php if ($data->status_receipt_id == 1) { ?>
                                <input type="checkbox" name="select_receipt_checkbox[<?php echo $i; ?>]" class="col-sm-4 offset-sm-2 select_receipt_checkbox" id="select_receipt_checkbox<?php echo $data->receipt_master_id; ?>">
                                <label for="select_receipt_checkbox<?php echo $data->receipt_master_id; ?>"  style="margin-top: 10px;"></label>
                            <?php } ?>
                        </th>
                        <td><?php echo $i; ?></td>
                        <td><?php echo $data->receipt_master_id; ?></td>
                        <td><?php echo $data->refer; ?></td>
                        <td class="text-right"><?php echo number_format($data->price_sum_pay, 2); ?></td> 
                        <td class="text-center"><?php echo $this->mics->dateen2stringthMS($data->date_receipt); ?></td> 
                        <td class="text-center"><span class="<?php echo ($data->status_receipt_id == 1) ? 'badge badge-success' : 'badge badge-danger'; ?>"><i class="<?php echo ($data->status_receipt_id == 1) ? 'fa fa-check-circle' : 'fa fa-times-circle-o'; ?>"></i> <?php echo $this->bill_model->ref_status_receipt($data->status_receipt_id)->row()->status_receipt_name; ?></span></td>   
                        <td class="text-center"><span class="<?php echo ($data->status_receipt_print_id == 1) ? 'badge badge-warning' : 'badge badge-success'; ?>"><i class="<?php echo ($data->status_receipt_print_id == 1) ? 'fa fa-info-circle' : 'fa fa-check-circle'; ?>"></i> <?php echo $this->bill_model->ref_status_receipt_print($data->status_receipt_print_id)->row()->status_receipt_print_name; ?></span></td>    
                        <td class="text-center">
                            <a href="<?php echo base_url() . 'receiptdetail/' . $data->receipt_master_id_pri; ?>" target="_blank" class="btn btn-sm btn-outline-primary"><i class="fa fa-eye"></i> ดู</a>
                            <?php
                            if ($data->status_receipt_id == 1) {
                                ?>
                                <a target="_blank" href="<?php echo base_url() . 'receipt/billiv/' . $data->receipt_master_id_pri; ?>" class="btn btn-sm btn-outline-success"><i class="fa fa-print"></i> ปรินแบบย่อ</a>
                                <?php
                            } else {
                                ?>
                                <a href = "javascript:void(0)" class = "btn btn-sm btn-outline-secondary"><i class = "fa fa-print"></i> ปรินแบบย่อ</a>
                                <?php
                            }
                            if ($data->status_receipt_id == 1) {
                                ?>
                                <a href="javascript:void(0)" onclick="modal_cancel(<?php echo $data->receipt_master_id_pri; ?>);" class="btn btn-sm btn-outline-danger"><i class="fa fa-close"></i> ยกเลิก</a>
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
                            <input type="radio" id="radio_2" checked="" name="print" value="a4">
                            <label for="radio_2">A4</label>
                            &nbsp;
                            <input type="radio" id="radio_3" name="print" value="a5">
                            <label for="radio_3">1/2 A4</label>
                        </div>
                    </div>
                    <p/>
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <button type="submit" id="bt-submit-receipt" class="btn btn-outline-success"><i class="fa fa-print"></i> ปริ้น</button>
                            <button type="button" class="btn btn-outline-inverse" data-dismiss="modal" aria-hidden="true" ><i class="fa fa-close"></i>&nbsp;ยกเลิก</button>
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

            <form action="<?php echo base_url() . 'bill/cancel'; ?>" onsubmit="return submit_cencel_receipt();" method="post" >
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

    function modal_receipt_print() {
        $('#modal_receipt_print').modal('show', {backdrop: 'true'});
    }

    function submit_receipt() {
        $('#modal_receipt_print').modal('hide');
        $('#modelsuccess').modal('show', {backdrop: 'true'});
        $('body').loading();
        return true;
    }

    function modal_cancel(receipt_master_id_pri) {
        $('#modal_receipt_cancel').modal('show', {backdrop: 'true'});
        $('#id_pri_cancel').val(receipt_master_id_pri);
    }

    function submit_cencel_receipt() {
        $('#modal_receipt_cancel').modal('hide');
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