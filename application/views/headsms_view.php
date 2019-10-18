<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-block">
                <h4 class="card-title"><i class="<?php echo $icon; ?>"></i> <?php echo " " . $title; ?> 
                    <button type="button" style="float: right" class="btn btn-sm btn-rounded btn-outline-success" onclick="modaladd();"><i class="fa fa-plus"></i> เพิ่มหัวข้อ SMS</button>
                </h4>   
                <div class="table-responsive">
                    <table class="table table-striped table-bordered">                
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>หัวข้อ SMS</th>
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
                                        <td><?php echo $data->head_sms_name; ?></td>
                                        <td class="text-center">
                                            <button type="button" class="btn btn-sm btn-outline-info" onclick="modaledit(<?php echo $data->head_sms_id; ?>)"><i class="fa fa-edit"></i> แก้ไข</button>
                                            <button type="button" class="btn btn-sm btn-outline-danger" onclick="modaldelete(<?php echo $data->head_sms_id; ?>);"><i class="fa fa-trash"></i> ลบ</button>
                                        </td>
                                    </tr>
                                    <?php
                                    $i++;
                                }
                            } else {
                                ?>
                                <tr>
                                    <td class="text-center" colspan="3"><?php echo 'ไม่มีข้อมูล'; ?></td>
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

<div class="modal fade" id="add">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><i class="fa fa-plus-circle"></i>&nbsp;เพิ่มหัวข้อ SMS</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <div class="bootbox-body">
                    <form class="form-material m-t-10" id='form-add' method="post" action="<?php echo base_url() . 'headsms/addheadsms'; ?>" autocomplete="off">
                        <div class="form-group">
                            <label> หัวข้อ SMS : <span class="text-danger">*</span></label>
                            <input type="text" name="head_sms_name" class="form-control form-control-line" data-parsley-error-message="กรุณากรอกข้อมูล" required>
                        </div>  
                        <div class="form-group">
                            <div class="col-md-12 text-center">
                                <button type="submit" value="add" class="btn btn-outline-info"><i class="fa fa-save"></i>&nbsp;บันทึก</button>
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

<div class="modal fade" id="edit">
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
