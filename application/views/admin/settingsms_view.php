<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-block">
                <h4 class="card-title"><i class="<?php echo $icon; ?>"></i> <?php echo " " . $title; ?> 
                    <!--<button type="button" style="float: right" class="btn btn-sm btn-rounded btn-outline-success" onclick="modaladd();"><i class="fa fa-plus"></i> เพิ่ม SMS บริษัท/ร้านค้า</button>-->
                </h4>   
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-datatable">                
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>บริษัท/ร้านค้า</th>
                                <th>เบอร์ที่ใช้ส่ง</th>
                                <th>username</th>
                                <th class="text-right">เครดิตที่ส่งไป</th>
                                <th class="text-right">เครดิตคงเหลือ</th>
                                <th class="text-right">เครดิตที่เหลือจาก API</th>                               
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
                                        <td><?php echo $data->shop_name; ?></td>
                                        <td><?php echo $data->setting_sms_number; ?></td>
                                        <td><?php echo $data->setting_sms_username; ?></td>
                                        <td class="text-right"><?php echo $data->credit_sum; ?></td>
                                        <td class="text-right"><?php echo $data->credit_balance; ?></td>
                                        <td class="text-right"><?php echo $data->credit_all; ?></td>
                                        <td class="text-center">
                                            <button type="button" class="btn btn-xs btn-outline-info" onclick="modaledit(<?php echo $data->setting_sms_id; ?>)"><i class="fa fa-edit"></i> แก้ไข</button>                                         
                                            <button type="button" class="btn btn-xs btn-outline-primary" onclick="modaladdsms(<?php echo $data->setting_sms_id; ?>);"><i class="fa fa-plus-circle"></i> เพิ่มเครดิต</button>
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
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="add">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><i class="fa fa-plus-circle"></i>&nbsp;เพิ่ม SMS บริษัท/ร้านค้า</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <div class="bootbox-body">
                    <form class="form-material m-t-10" id="formadd" method="post" action="<?php echo base_url() . 'admin/settingsms/add'; ?>" autocomplete="off">
                        <div class="form-group">
                            <label> บริษัท/ร้านค้า : </label>
                            <select name="shop_id_pri" class="form-control">
                                <?php foreach ($this->settingsms_model->get_shop()->result() as $data) {
                                    if ($this->settingsms_model->check_settingsms($data->shop_id_pri)->num_rows() == 0) {
                                        ?>
                                        <option value="<?php echo $data->shop_id_pri; ?>"><?php echo $data->shop_name; ?></option>
                                    <?php }
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label> เบอร์ที่ใช้ส่ง : </label>
                            <input type="text" name="setting_sms_number" class="form-control form-control-line" data-parsley-error-message="กรุณากรอกข้อมูล"  required="">
                        </div>    
                        <div class="form-group">
                            <label> username : </label>
                            <input type="text" name="setting_sms_username" class="form-control form-control-line" data-parsley-error-message="กรุณากรอกข้อมูล"  required="">
                        </div>   
                        <div class="form-group">
                            <label> password : </label>
                            <input type="password" autocomplete="new-password" name="setting_sms_password" class="form-control form-control-line" data-parsley-error-message="กรุณากรอกข้อมูล"  required="">
                        </div>    
                        <div class="form-group">
                            <label> เครดิตเริ่มต้น : </label>
                            <input type="number" name="credit_balance" class="form-control form-control-line" data-parsley-error-message="กรุณากรอกข้อมูล"  required="">
                        </div> 
                        <div class="form-group">
                            <div class="col-md-12 text-center">
                                <button type="submit" value="add" class="btn btn-outline-info"><i class="fa fa-save"></i>&nbsp;บันทึก</button>
                                <button type="button" class="btn btn-outline-danger" data-dismiss="modal" aria-hidden="true" ><i class="fa fa-close"></i>&nbsp;ยกเลิก</button>
                            </div>
                        </div>
                    </form>
                </div>                    
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="edit">
    <div class="modal-dialog">
        <div class="modal-content">

        </div>
    </div>
</div>

<div class="modal fade" id="addsms">
    <div class="modal-dialog">
        <div class="modal-content">

        </div>
    </div>
</div>


<div class="modal fade" id="delete">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><i class="fa fa-plus-circle"></i>&nbsp;ยืนยันการลบข้อมูล</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button></div>
            <div class="modal-body">
                <div class="bootbox-body text-center text-danger"><b>ยืนยันการลบข้อมูลนี้ ใช่หรือไม่ &nbsp;<i class="fa fa-question-circle"></i></b></div>                    
            </div>
            <div class="modal-footer">
                <a href="#" class="btn btn-danger" id="delete_id"><i class="fa fa-trash"></i>&nbsp;ตกลง</a>
                <button type="button" class="btn btn-secondary" data-dismiss="modal" aria-hidden="true" ><i class="fa fa-close"></i>&nbsp;ยกเลิก</button>
            </div>
        </div>
    </div>
</div>

<script>
var service_base_url = $('#service_base_url').val();

function modaladd() {
    $('#add').modal('show', {backdrop: 'true'});
}

function modaledit(setting_sms_id) {
    url = service_base_url + 'admin/settingsms/settingsmsedit';
    $('#edit').modal('show', {backdrop: 'true'});
    $.ajax({
        url: url,
        method: "POST",
        data: {
            setting_sms_id: setting_sms_id
        },
        success: function (response)
        {
            $('#edit .modal-content').html(response);
        }
    });
}


function modaladdsms(setting_sms_id) {
    url = service_base_url + 'admin/settingsms/settingsmsadd';
    $('#edit').modal('show', {backdrop: 'true'});
    $.ajax({
        url: url,
        method: "POST",
        data: {
            setting_sms_id: setting_sms_id
        },
        success: function (response)
        {
            $('#edit .modal-content').html(response);
        }
    });
}


function modaldelete(setting_sms_id) {
    $('#delete').modal('show', {backdrop: 'true'});
    url = service_base_url + 'admin/settingsms/delete/' + setting_sms_id;
    $('#delete_id').attr("href", url);
}

$(function () {
    $('#formadd').parsley();
});
</script>