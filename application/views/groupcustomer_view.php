<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-block">
                <h4 class="card-title"><i class="<?php echo $icon; ?>"></i> <?php echo " " . $title; ?> 
                    <button type="button" style="float: right" class="btn btn-sm btn-rounded btn-outline-success" onclick="modaladd();"><i class="fa fa-plus"></i> เพิ่มกลุ่มลูกค้า</button>
                </h4>   
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-datatable">                
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>ชื่อกลุ่มลูกค้า</th>
                                <th class="text-right">ส่วนลดตั้งต้น</th>
                                <th>หน่วย</th>
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
                                        <td><?php echo $data->customer_group_name; ?></td>
                                        <td class="text-right"><?php echo $data->customer_group_save; ?></td>
                                        <td><?php echo $data->type_save_name; ?></td>
                                        <td class="text-center">
                                            <button type="button" class="btn btn-sm btn-outline-info" onclick="modaledit(<?php echo $data->customer_group_id; ?>)"><i class="fa fa-edit"></i> แก้ไข</button>
                                            <?php if ($this->groupcustomer_model->checkgroupcustomer($data->customer_group_id) > 0) { ?>
                                                <button type="button" class="btn btn-sm btn-outline-secondary"><i class="fa fa-trash"></i> ลบ</button>
                                            <?php } else {
                                                ?>
                                                <button type="button" class="btn btn-sm btn-outline-danger" onclick="modaldelete(<?php echo $data->customer_group_id; ?>);"><i class="fa fa-trash"></i> ลบ</button>
                                            <?php }
                                            ?>
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
                <h4 class="modal-title"><i class="fa fa-plus-circle"></i>&nbsp;เพิ่มกลุ่มลูกค้า</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <div class="bootbox-body">
                    <form class="form-material m-t-10" id="formadd" method="post" action="<?php echo base_url() . 'groupcustomer/add'; ?>" autocomplete="off">
                        <div class="form-group">
                            <label> ชื่อกลุ่มลูกค้า : <span class="text-danger">*</span></label>
                            <input type="text" name="customer_group_name" class="form-control form-control-line" data-parsley-error-message="กรุณากรอกข้อมูล"  required="">
                        </div>
                        <div class="form-group">
                            <label> ส่วนลดตั้งต้น : </label>
                            <input type="number" name="customer_group_save" value="0" class="form-control form-control-line">
                        </div>    
                        <div class="form-group">
                            <label> เลือก % หรือ บาท : </label>
                            <select name="type_save_id" class="form-control form-control-line">
                                <option value="1">%</option>
                                <option value="2">บาท</option>
                            </select>
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
