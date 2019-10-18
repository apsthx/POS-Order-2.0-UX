<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-block">
                <h4 class="card-title"><i class="fa fa-gift"></i> <?php echo " " . $title; ?> 
                    <button type="button" style="float: right" class="btn btn-xs btn-rounded btn-outline-success" onclick="modalAdd();"><i class="fa fa-plus"></i> เพิ่มแพ็กเกจ</button>
                </h4>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered">                
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>ชื่อแพ็กเกจ</th>
                                <th >ราคา</th>
                                <th class="text-right">ผู้ใช้ระบบ</th>
                                <th class="text-right">สาขาย่อย</th>
                                <th class="text-right">ตัวแทนจำหน่าย</th>
                                <th class="text-right">Free SMS</th>   
                                <th class="text-right">จำกัดวัน</th>
                                <th class="text-right">ผู้ใช้งานแพ็กเกจ</th>
                                <th class="text-center" width="7%">สถานะ</th>
                                <th class="text-center" width="23%">ตัวเลือก</th>                               
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
                                        <td><?php echo $data->package_name; ?></td>
                                        <td ><?php echo $data->package_cost; ?></td>
                                        <td class="text-right"><?php echo number_format($data->package_useuser, 0); ?></td>
                                        <td class="text-right"><?php echo number_format($data->package_useshop, 0); ?></td>
                                        <td class="text-right"><?php echo number_format($data->package_useagent, 0); ?></td>
                                        <td class="text-right"><?php echo number_format($data->package_sms, 0); ?></td>
                                        <td class="text-right"><?php echo number_format($data->package_usedate, 0); ?></td>
                                        <td class="text-right"><?php echo $this->package_model->getUserPackage($data->package_id)->num_rows(); ?></td>
                                        <td class="text-center">
                                            <?php echo ($data->package_status == 1 ? '<span class="label label-success">ปกติ</span>' : '<span class="label label-danger">ระงับ</span>'); ?>                             
                                        </td>
                                        <td class="text-center"> 
                                            <button type="button" class="btn btn-xs btn-outline-warning" onclick="modalView(<?php echo $data->package_id; ?>)"><i class="fa fa-eye"></i> ผู้ใช้งาน</button>
                                            <button type="button" class="btn btn-xs btn-outline-primary" onclick="modalset(<?php echo $data->package_id; ?>)"><i class="fa fa-key"></i> จำกัดเมนู</button>
                                            <button type="button" class="btn btn-xs btn-outline-info" onclick="modalEdit(<?php echo $data->package_id; ?>)"><i class="fa fa-edit"></i> แก้ไข</button>                                             
                                            <?php if ($data->package_status == 1) { ?>
                                                <button type="button" class="btn btn-xs btn-outline-danger" onclick="modalEditstatus(<?php echo $data->package_id; ?>)"><i class="fa fa-close"></i> ระงับ</button>
                                            <?php } else { ?>
                                                <button type="button" class="btn btn-xs btn-outline-success" onclick="modalEditchangestatus(<?php echo $data->package_id; ?>)"><i class="fa fa-check"></i> ปกติ</button>
                                            <?php } ?>
                                        </td>
                                    </tr>
                                    <?php
                                    $i++;
                                }
                            } else {
                                ?>
                                <tr>
                                    <td class="text-center" colspan="11"><?php echo 'ไม่มีข้อมูล'; ?></td>
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
                <h4 class="card-title"><i class="fa fa-envelope"></i> <?php echo " อัตราค่าบริการ SMS"; ?> 
                    <button type="button" style="float: right" class="btn btn-xs btn-rounded btn-outline-success" onclick="modalAddSMS();"><i class="fa fa-plus"></i> เพิ่มบริการ SMS</button>
                </h4>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered">                
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>ชื่อ SMS</th>
                                <th class="text-right">ราคา</th>
                                <th class="text-right">จำนวนข้อความ</th>
                                <th class="text-center" width="7%">สถานะ</th>
                                <th class="text-center" width="23%">ตัวเลือก</th>                               
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 1;
                            if ($datassms->num_rows() > 0) {
                                foreach ($datassms->result() as $datasms) {
                                    ?>
                                    <tr>
                                        <td><?php echo $i; ?></td>
                                        <td><?php echo $datasms->sms_name; ?></td>
                                        <td class="text-right"><?php echo number_format($datasms->sms_cost, 0); ?></td>
                                        <td class="text-right"><?php echo number_format($datasms->sms_amount, 0); ?></td>
                                        <td class="text-center">
                                            <?php echo ($datasms->sms_status == 1 ? '<span class="label label-success">ปกติ</span>' : '<span class="label label-danger">ระงับ</span>'); ?>                             
                                        </td>
                                        <td class="text-center"> 
                                            <button type="button" class="btn btn-xs btn-outline-info" onclick="modalEditSMS(<?php echo $datasms->sms_id; ?>)"><i class="fa fa-edit"></i> แก้ไข</button>                                             
                                            <?php if ($datasms->sms_status == 1) { ?>
                                                <button type="button" class="btn btn-xs btn-outline-danger" onclick="modalEditstatusSMS(<?php echo $datasms->sms_id; ?>)"><i class="fa fa-close"></i> ระงับ</button>
                                            <?php } else { ?>
                                                <button type="button" class="btn btn-xs btn-outline-success" onclick="modalEditchangestatusSMS(<?php echo $datasms->sms_id; ?>)"><i class="fa fa-check"></i> ปกติ</button>
                                            <?php } ?>
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

<div id="for_modal"></div>

<div class="modal fade" id="set">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

        </div>
    </div>
</div>

<script>
    var service_base_url = $('#service_base_url').val();
    
    function modalset(package_id) {
        url = service_base_url + 'admin/package/set';
        $('#set').modal('show', {backdrop: 'true'});
        $.ajax({
            url: url,
            method: "POST",
            data: {
                package_id: package_id
            },
            success: function (response)
            {
                $('#set .modal-content').html(response);
            }
        });
    }

    function switchRole(package_id, menu_id, checkbox) {
        console.log(package_id, menu_id);
        if (checkbox.checked) {
            var url = $('#service_base_url').val() + 'admin/package/addpackage';
            $.post(url, {package_id: package_id, menu_id: menu_id}, function (response) {
                $('#package_show_checkbock' + menu_id).html('<span class="badge badge-success"><i class="fa fa-check-circle"></i>&nbsp;จำกัด</span>');
            });
        } else {
            var url = $('#service_base_url').val() + 'admin/package/delete';
            $.post(url, {package_id: package_id, menu_id: menu_id}, function (response) {
                $('#package_show_checkbock' + menu_id).html('<span class="badge badge-warning"><i class="fa fa-times-circle"></i>&nbsp;ไม่จำกัด</span>');
            });
        }
    }


    //add
    function modalAdd() {
        $.ajax({
            url: service_base_url + 'admin/package/packageadd',
            success: function (response) {
                $('#for_modal').html(response);
                $("#on_modal").modal('show', {backdrop: 'static'});
            }
        });
    }
    function modalAddSMS() {
        $.ajax({
            url: service_base_url + 'admin/package/smsadd',
            success: function (response) {
                $('#for_modal').html(response);
                $("#on_modal").modal('show', {backdrop: 'static'});
            }
        });
    }
    //edit
    function modalView(package_id) {
        $.ajax({
            url: service_base_url + 'admin/package/packageview',
            type: 'post',
            data: {
                package_id: package_id
            },
            success: function (response) {
                $('#for_modal').html(response);
                $("#on_modal").modal('show', {backdrop: 'static'});
            }
        });
    }
    //edit
    function modalEdit(package_id) {
        $.ajax({
            url: service_base_url + 'admin/package/packageedit',
            type: 'post',
            data: {
                package_id: package_id
            },
            success: function (response) {
                $('#for_modal').html(response);
                $("#on_modal").modal('show', {backdrop: 'static'});
            }
        });
    }
    //edit
    function modalEditstatus(package_id) {
        $.ajax({
            url: service_base_url + 'admin/package/packageeditstatus',
            type: 'post',
            data: {
                package_id: package_id
            },
            success: function (response) {
                $('#for_modal').html(response);
                $("#on_modal").modal('show', {backdrop: 'static'});
            }
        });
    }
    //edit
    function modalEditchangestatus(package_id) {
        $.ajax({
            url: service_base_url + 'admin/package/editchangestatus',
            type: 'post',
            data: {
                package_id: package_id
            },
            success: function (response) {
                if (response == 1) {
                    location.reload();
                }
            }
        });
    }
    function modalEditSMS(sms_id) {
        $.ajax({
            url: service_base_url + 'admin/package/smsedit',
            type: 'post',
            data: {
                sms_id: sms_id
            },
            success: function (response) {
                $('#for_modal').html(response);
                $("#on_modal").modal('show', {backdrop: 'static'});
            }
        });
    }
    //edit
    function modalEditstatusSMS(sms_id) {
        $.ajax({
            url: service_base_url + 'admin/package/smseditstatus',
            type: 'post',
            data: {
                sms_id: sms_id
            },
            success: function (response) {
                $('#for_modal').html(response);
                $("#on_modal").modal('show', {backdrop: 'static'});
            }
        });
    }
    //edit
    function modalEditchangestatusSMS(sms_id) {
        $.ajax({
            url: service_base_url + 'admin/package/smseditchangestatus',
            type: 'post',
            data: {
                sms_id: sms_id
            },
            success: function (response) {
                if (response == 1) {
                    location.reload();
                }
            }
        });
    }
</script>

