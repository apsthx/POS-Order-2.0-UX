
<form id="form-services" action="<?php echo base_url() . 'serviceslist/services'; ?>" method="post">
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
                    <th class="text-center">สถานะการส่งมอบ</th>  
                    <th class="text-center"><?php echo ($services_status == 3) ? 'วันที่ยกเลิก' : 'วันที่บริการ'; ?></th>
                    <th class="text-center">ตัวเลือก</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 1;
                if ($datas->num_rows() > 0) {
                    foreach ($datas->result() as $data) {
                        ?>
                                                                                                                            <!--<input type="text" style="display:none;" name="services_master_id_pri_arr[<?php //echo $i;              ?>]" value="<?php //echo $data->services_master_id_pri;              ?>"/>-->
                                                                                                                            <!--<input type="text" style="display:none;" name="services_status_arr[<?php //echo $i;              ?>]" value="<?php //echo $data->services_status;              ?>"/>-->

                        <tr>
                            <td class="text-center">
                                <input type="checkbox" name="select_services_checkbox[]" value="<?php echo $data->services_master_id_pri ?>" class="col-sm-4 offset-sm-2 select_services_checkbox" id="select_services_checkbox<?php echo $data->services_master_id_pri; ?>">
                                <label for="select_services_checkbox<?php echo $data->services_master_id_pri; ?>"  style="margin-bottom: -5px;"></label>
                            </td>
                            <td class="text-right"><?php echo $i; ?></td>
                            <td><?php echo $data->services_master_id; ?></td>
                            <td><?php echo $data->customer_name; ?></td>  
                            <?php if ($data->services_status == 3) { ?>
                                <td class="text-center"><?php echo ($data->services_pay == 1) ? '<label class="label label-success">ส่งมอบงานแล้ว</label>' : '<label class="label label-primary">รอส่งมอบงาน (ยกเลิก)</label>'; ?></td>  
                            <?php } else { ?>
                                <td class="text-center"><?php echo ($data->services_pay == 1) ? '<label class="label label-success">ส่งมอบงานแล้ว</label>' : '<label class="label label-primary">รอส่งมอบงาน</label>'; ?></td>                              
                            <?php } ?>
                            <td class="text-center"><?php echo $this->mics->date2thai(($services_status == 1 ? $data->services_day : $data->date_services), '%d %m %y', 1); ?></td> 
                            <td class="text-center">
                                <a href="<?php echo base_url() . 'services/detail/' . $data->services_master_id_pri . '/1'; ?>" target="_blank" class="btn btn-sm btn-outline-primary"><i class="fa fa-eye"></i> ดู</a>
                                <?php if ($services_status == 1) { ?>
                                    <a href="<?php echo base_url() . 'services/detail/' . $data->services_master_id_pri; ?>" target="_blank" class="btn btn-sm btn-outline-info button_services_edit"><i class="fa fa-edit"></i> แก้ไข</a>
                                <?php } ?>
                                <?php if ($services_status == 2) { ?>
                                    <label for="upload<?php echo $data->services_master_id_pri; ?>"> 
                                        <span class="btn btn-sm btn-outline-info button_services_file"><i class="fa fa-file-image-o"></i> รูปภาพ</span>
                                    </label>
                                    <input type="file" name="upload[]" id="upload<?php echo $data->services_master_id_pri; ?>" multiple="multiple" onchange="upload('<?php echo $data->services_master_id_pri; ?>');" style="display: none"/>                                    
                                    <button type="button" class="btn btn-sm btn-outline-inverse" onclick="modal_file('<?php echo $data->services_master_id_pri; ?>');"><i class="fa fa-eye-slash"></i> ดูรูปภาพ</button>
                                    <div id="uploadsuccess<?php echo $data->services_master_id_pri; ?>" style="font-size: 14px; display: none;" class="text-success"><i class="fa fa-check-circle" style="color: green; font-size: 14px"></i><b> ส่งรูปภาพสำเร็จ</b></div>
                                    <div id="uploadfail<?php echo $data->services_master_id_pri; ?>" style="font-size: 14px; display: none;" class="text-danger"><i class="fa fa-times-circle" style="color: red; font-size: 14px"></i><b> ส่งรูปภาพล้มเหลว <span id="numuploadfail<?php echo $data->services_master_id_pri; ?>"></span></b></div>
                                <?php } ?>
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
    <div class="modal fade" id="modal_services_status1">
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

    <div class="modal fade" id="modal_services_status2">
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
                            <select name="services_status2" class="form-control form-control-sm col-sm-7">
                                <option value="3"><?php echo 'ยกเลิก'; ?></option>
                            </select>
                        </div>
                    </div>
                    <br/>
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <button type="button" onclick="submit_services2();" class="btn btn-outline-warning"><i class="fa fa-check-circle"></i> ยืนยัน</button>
                            <button type="button" class="btn btn-outline-inverse" data-dismiss="modal" aria-hidden="true" ><i class="fa fa-close"></i>&nbsp;ยกเลิก</button>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="modal fade" id="modal_services_pay1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"><i class="fa fa-truck"></i>&nbsp;ยืนยันการปรับสถานะรอส่งมอบงาน</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>

                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12 text-center" >
                            <label class="col-md-12 text-danger">ระบบจะหักเงินตามบัญชีเงินได้ของใบเปิดบริการ</label>   
                        </div>
                    </div>
                    <br/>
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <button type="button" onclick="submit_services_pay1()" id="bt-submit-services" class="btn btn-outline-warning"><i class="fa fa-check-circle"></i> ยืนยัน</button>
                            <button type="button" class="btn btn-outline-inverse" data-dismiss="modal" aria-hidden="true" ><i class="fa fa-close"></i>&nbsp;ยกเลิก</button>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="modal fade" id="modal_services_pay2">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"><i class="fa fa-truck"></i>&nbsp;ยืนยันการปรับสถานะส่งมอบงาน</h4>
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
                        <div class="col-md-12 text-center">
                            <button type="button" onclick="submit_services_pay2()" id="bt-submit-services" class="btn btn-outline-warning"><i class="fa fa-check-circle"></i> ยืนยัน</button>
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
                    <button class="btn btn-success" onclick="modal_all_hide();" data-dismiss="modal"><i class="fa fa-check"></i>&nbsp;โหลดใหม่</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal_file">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">

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
        $('#modal_services_status1').modal('hide');
        $('#modal_services_status2').modal('hide');
        $('#event').val(2);
        $('body').loading();
        $('#form-services').submit();
    }

    function submit_services2() {
        $('#modal_services_status1').modal('hide');
        $('#modal_services_status2').modal('hide');
        $('#event').val(3);
        $('body').loading();
        $('#form-services').submit();
    }

    function submit_services_pay1() {
        $('#form-services').attr('target', '_blank');
        $('#modal_services_status1').modal('hide');
        $('#event').val(4);
        $('#modelsuccess').modal('show', {backdrop: 'true'});
        $('body').loading();
        $('#form-services').submit();
    }

    function submit_services_pay2() {
        $('#form-services').attr('target', '_blank');
        $('#modal_services_status2').modal('hide');
        $('#event').val(5);
        $('#modelsuccess').modal('show', {backdrop: 'true'});
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

    function modal_all_hide() {
        location.reload();
    }

    function upload(services_master_id_pri) {
        console.log(services_master_id_pri);
        var myfiles = document.getElementById("upload" + services_master_id_pri);
        var files = myfiles.files;
        var data = new FormData();
        for (i = 0; i < files.length; i++) {
            data.append('file' + i, files[i]);
        }
        data.append('services_master_id_pri', services_master_id_pri);
        url = service_base_url + 'serviceslist/upload';
        $.ajax({
            url: url,
            type: 'POST',
            contentType: false,
            data: data,
            processData: false,
            cache: false
        }).done(function (msg) {
            console.log(msg);
            if (msg == 0) {
                $('#uploadsuccess' + services_master_id_pri).show(0).delay(3000).hide(0);
                //setTimeout(function () {
                //    data(1);
                //}, 3000);
            }
            else {
                $('#numuploadfail' + services_master_id_pri).text(' ' + msg + ' ไฟล์');
                $('#uploadfail' + services_master_id_pri).show(0).delay(3000).hide(0);
                //setTimeout(function () {
                //    data(1);
                //}, 3000);
            }
        });
    }

    function modal_file(services_master_id_pri) {
        url = service_base_url + 'serviceslist/modal_file';
        $('#modal_file .modal-content').html('<div style="text-align:center; padding:80px;"><i class="fa fa-refresh fa-spin fa-3x fa-fw"></i></div>');
        $('#modal_file').modal('show', {backdrop: 'true'});
        $.ajax({
            url: url,
            method: "POST",
            data: {services_master_id_pri: services_master_id_pri},
            success: function (response)
            {
                $('#modal_file .modal-content').html(response);
            }
        });
    }


    function delete_file(file_id) {
        $('#modal_file .modal-content').html('');
        url = service_base_url + 'serviceslist/deletefile';
        $('#modal_file .modal-content').html('<div style="text-align:center; padding:80px;"><i class="fa fa-refresh fa-spin fa-3x fa-fw"></i></div>');       
        $.ajax({
            url: url,
            method: "POST",
            data: {
                id: file_id
            },
            success: function (response)
            {
                $('#modal_file .modal-content').html(response);
            }
        });
    }


</script>