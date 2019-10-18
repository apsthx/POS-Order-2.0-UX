<form id="form-services" action="<?php echo base_url() . 'servicescheck/services'; ?>" method="post">
    <div class="table-responsive">
        <table class="table table-striped table-bordered table-datatable">                
            <thead>
                <tr>
                    <th class="text-center" style="padding: 0px;" width="6%">
                        <input type="checkbox" class="col-sm-4 offset-sm-2" name="" id="select_services_checkbox_all" onchange="select_all();">
                        <label for="select_services_checkbox_all">เลือก</label>
                    </th>
                    <th class="text-right" width="5%">#</th>
                    <th>เลขที่ใบบริการ</th>  
                    <th>ลูกค้า</th>  
                    <th class="text-center">เริ่มเตื่อนเมื่อ</th>  
                    <th class="text-center">สถานะ</th>  
                    <th class="text-center">วันที่ต้องบริการ</th>
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
                            <td class="text-center">
                                <input type="checkbox" name="select_services_checkbox[]" value="<?php echo $data->services_master_id_pri ?>" class="col-sm-4 offset-sm-2 select_services_checkbox" id="select_services_checkbox<?php echo $data->services_master_id_pri; ?>">
                                <label for="select_services_checkbox<?php echo $data->services_master_id_pri; ?>"  style="margin-bottom: -5px;"></label>
                            </td>
                            <td class="text-right"><?php echo $i; ?></td>
                            <td><?php echo $data->services_master_id; ?></td>
                            <td><?php echo $data->customer_name; ?></td>  
                            <td class="text-center"><?php echo $this->mics->date2thai($data->services_alertday, '%d %m %y', 1); ?></td> 
                            <?php
                            $date = Date('Y-m-d');
                            $dStart = new DateTime($date);
                            $dEnd = new DateTime($data->services_day);
                            $dDiff = $dStart->diff($dEnd);
                            //echo $dDiff->format('%R') . $dDiff->days;
                            if ($dDiff->format('%R') == '-') {
                                $servicesdaystatus = '<label class="label label-danger"> เกินวันที่ต้องบริการ ' . $dDiff->days . ' วัน </label>';
                            } else {
                                if ($dDiff->days == 0) {
                                    $servicesdaystatus = '<label class="label label-warning">ครบกำหนดบริการวันนี้</label>';
                                } else {
                                    $servicesdaystatus = '<label class="label label-primary"> จะครบกำหนดอีก ' . $dDiff->days . ' วัน </label>';
                                }
                            }
                            ?>
                            <td class="text-center"><?php echo $servicesdaystatus; ?></td>                              
                            <td class="text-center"><?php echo $this->mics->date2thai($data->services_day, '%d %m %y', 1); ?></td> 
                            <td class="text-center">
                                <a href="<?php echo base_url() . 'services/detail/' . $data->services_master_id_pri . '/1'; ?>" target="_blank" class="btn btn-sm btn-outline-primary"><i class="fa fa-eye"></i> ดู</a>
                                <a href="<?php echo base_url() . 'services/detail/' . $data->services_master_id_pri; ?>" target="_blank" class="btn btn-sm btn-outline-info button_services_edit"><i class="fa fa-edit"></i> แก้ไข</a>
                                <a href="<?php echo base_url() . 'services/printservicesA4/' . $data->services_master_id_pri; ?>" target="_blank" class="btn btn-sm btn-outline-success"><i class="fa fa-print"></i> ปริ้น</a>                   
                            </td>
                        </tr>
                        <?php
                        $i++;
                    }
                } else {
                    ?>
                    
                <?php }
                ?>                    
            </tbody>
        </table>
    </div>

    <input type="hidden" name="event" id="event" />
    <div class="modal fade" id="modal_services_status">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"><i class="fa fa-wrench"></i>&nbsp;ยืนยันการปรับสถานะใบบริการ</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>

                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12 text-center" >
                            ปรับสถานะใบบริการ : 
                            <select name="services_status" class="form-control form-control-sm col-sm-7">
                                <option value="2"><?php echo 'ดำเนินการเสร็จสิ้น'; ?></option>
                                <option value="3"><?php echo 'ยกเลิก'; ?></option>
                            </select>
                        </div>
                    </div>
                    <br/>
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <button type="button" onclick="submit_services()" id="bt-submit-services" class="btn btn-outline-warning"><i class="fa fa-check-circle"></i> ยืนยัน</button>
                            <button type="button" class="btn btn-outline-inverse" data-dismiss="modal" aria-hidden="true" ><i class="fa fa-close"></i>&nbsp;ยกเลิก</button>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="modal fade" id="modelsuccess">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"><i class="fa fa-save"></i>&nbsp;ทำรายการเสร็จสิ้น</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button></div>
                <div class="modal-body">
                    <div class="bootbox-body text-center text-success"><b>สถานะการทำรายการเสร็จสิ้น&nbsp;<i class="fa fa-check-circle-o"></i></b></div>                    
                </div>
                <div class="modal-footer">
                    <button class="btn btn-success" onclick="data();" data-dismiss="modal"><i class="fa fa-check"></i>&nbsp;โหลดใหม่</button>
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

    function services_print() {
        $('#event').val(1);
        $('#form-services').attr('target', '_blank');
        $('#modelsuccess').modal('show', {backdrop: 'true'});
        $('body').loading();
        $('#form-services').submit();
    }

    function submit_services() {
        $('#modal_services_status').modal('hide');
        $('#event').val(2);
        $('body').loading();
        $('#form-services').submit();
    }

    function select_all() {
        if ($('#select_services_checkbox_all').is(':checked')) {
            $('.select_services_checkbox').prop('checked', true)
        } else {
            $('.select_services_checkbox').prop('checked', false)
        }
    }

</script>