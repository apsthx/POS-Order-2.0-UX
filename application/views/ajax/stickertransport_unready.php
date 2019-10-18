<form method="post" action="<?php echo base_url() . 'stickertransport/printtransportunready'; ?>" onsubmit="return submit_unready();" target="_blank" autocomplete="off">
    <div class="text-right">
        <button type="button" class="btn btn-sm btn-outline-info"  onclick="modal_unready_print();"><i class="fa fa-print"></i>&nbsp;พิมม์สติ๊กเกอร์ที่เลือก</button>
        <button type="reset" class="btn btn-sm btn-outline-danger" ><i class="fa fa-close"></i>&nbsp;ยกเลิก</button>
    </div>
    <table class="table table-striped table-bordered table-datatable">  
        <thead>
            <tr>
                <th class="text-center" style="padding: 0px;">
                    <input type="checkbox" class="" name="" id="select_unready_checkbox_all" onchange="select_unready_all();">
                    <label for="select_unready_checkbox_all">เลือก</label>
                </th>
                <th>#</th>
                <th>เลขที่ใบเสร็จ</th>
                <th>กลุ่มลูกค้า</th>
                <th>ลูกค้า</th>
                <th>พนักงาน</th>
                <th class="text-center">วันที่ออกใบเสร็จ</th>
                <th class="text-right">ค่าขนส่ง</th>
                <th class="text-center">สถานะ</th>  
                <th class="text-center">ตัวเลือก</th>   
            </tr>
        </thead>
        <tbody>
            <?php
            $i = 1;
            if ($datas->num_rows() > 0) {
                foreach ($datas->result() as $data) {
                    $customer_groups = $this->stickertransport_model->get_customer_group($data->customer_id, $customer_group_id);
                    if ($customer_groups->num_rows() > 0) {
                        $customer_group = $customer_groups->row()->customer_group_name;
                        ?>
                    <input type="text" style="display:none;" name="unready_master_id_pri_arr[<?php echo $i; ?>]" value="<?php echo $data->receipt_master_id_pri; ?>"/>
                    <tr>
                        <td class="text-center">
                            <input type="checkbox" name="select_unready_checkbox[<?php echo $i; ?>]" class="col-sm-4 offset-sm-2 select_unready_checkbox" id="select_unready_checkbox<?php echo $data->receipt_master_id; ?>">
                            <label style="margin-bottom: -5px"  for="select_unready_checkbox<?php echo $data->receipt_master_id; ?>"></label>
                        </td>
                        <td><?php echo $i; ?></td>
                        <td><?php echo $data->receipt_master_id; ?></td>
                        <td><?php echo $customer_group; ?></td>
                        <td><?php echo $data->customer_name; ?></td>
                        <td><?php echo $this->stickertransport_model->get_user($data->user_id)->row()->fullname; ?></td>
                        <td class="text-center"><?php echo ' ' . $this->mics->dateen2stringthMS($data->date_pay); ?></td>
                        <td class="text-right"><?php echo number_format($data->transport_price, 2, '.', ','); ?></td>
                        <?php
                        $deley = 0;
                        $datediff = date_diff(date_create(date('Y-m-d')), date_create($data->date_pay))->days;
                        $datedeley = $this->stickertransport_model->get_transport_setting()->row()->date_deley;
                        if ($datediff >= $datedeley) {
                            $deley = 1;
                        }
                        ?>
                        <td class="text-center"><span class="<?php echo ($deley == 0) ? 'badge badge-warning' : 'badge badge-danger'; ?>"><?php echo ($deley == 0) ? $this->stickertransport_model->ref_status_sticker_transport($data->status_sticker_transport_id)->row()->status_sticker_transport_name : 'ล่าช้า'; ?></span></td>    
                        <td class="text-center">
                            <a href="<?php echo base_url() . 'receiptdetail/' . $data->receipt_master_id_pri; ?>" target="_blank" class="btn btn-sm btn-outline-primary"><i class="fa fa-eye"></i> ดู</a>
                        </td>
                    </tr>
                    <?php
                    $i++;
                }
            }
        }
        ?>      
        </tbody>
    </table>

    <div class="modal fade" id="modal_unready_print">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"><i class="fa fa-truck"></i>&nbsp;เลือกบริการขนส่ง</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">

                    <div class="row">
                        <div class="col-md-12">
                            <input type="radio" id="radio_1" checked="" name="transport_service_id" value="1">
                            <label for="radio_1"><img width="200mm" src="<?php echo base_url() . 'store/image/EMS_logo.jpg'; ?>">&nbsp;&nbsp;Dropoff EMS</label>
                        </div>
                        <br/>
                        <br/>
                        <br/>
                        <div class="col-md-12">
                            <input type="radio" id="radio_2" name="transport_service_id" value="2">
                            <label for="radio_2"><img width="200mm" src="<?php echo base_url() . 'store/image/Kerry_logo.jpg'; ?>">&nbsp;&nbsp;Kerry Express</label>
                        </div>
                        <br/>
                        <br/>
                        <br/>
                        <div class="col-md-12">
                            <input type="radio" id="radio_3" name="transport_service_id" value="3">
                            <label for="radio_3"><img width="200mm" src="<?php echo base_url() . 'store/image/delivery_logo.jpg'; ?>">&nbsp;&nbsp;จัดส่งเอง</label>
                        </div>
                    </div>
                    <p/>
                    <br/>
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


<script>
    $(document).ready(function () {
        $('.table-datatable').DataTable();
    });

    function modal_unready_print() {
        $('#modal_unready_print').modal('show', {backdrop: 'true'});
    }

    function submit_unready() {
        $('#modal_unready_print').modal('hide');
        $('#modelsuccess').modal('show', {backdrop: 'true'});
        $('body').loading();
        return true;
    }
</script>