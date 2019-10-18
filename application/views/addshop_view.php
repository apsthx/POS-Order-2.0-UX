<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-block">
                <h4 class="card-title"><i class="<?php echo $icon; ?>"></i> <?php echo " " . $title; ?></h4>

                <br/>

                <form method="post" id="form-create" action="<?php echo base_url() . 'addshop/add'; ?>" autocomplete="off">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-body">
                                <h5 class="card-title"><i class="fa fa-info-circle"></i> ข้อมูลร้านหรือตัวแทนจำหน่าย</h5>
                                <hr>
                                <div class="row">
                                    <div class="col-md-12 text-right">
                                        <span style="color: red; font-size: 12px">* คือต้องกรอกให้ครบ</span>
                                    </div>
                                </div>
                                <p/>
                                <div class="row">
                                    <div class="col-md-4"></div>
                                    <div class="col-md-4">
                                        <label class="control-label">ต้องการสร้าง <span style="color: red;">*</span></label>
                                        <select name="type_shop_id" id="type_shop_id" class="form-control" data-parsley-error-message="กรุณาเลือกประเภทที่ต้องการสร้าง" onchange="checkpackage();" required="">
                                            <option value="">- เลือกประเภทที่ต้องการสร้าง -</option>
                                            <?php
                                            $type_shop_list = $this->db->where($this->session->userdata('role_id') == 3 ? 'type_shop_id > 2 ' : 'type_shop_id > 1')->get('ref_type_shop');
                                            if ($type_shop_list->num_rows() > 0) {
                                                foreach ($type_shop_list->result() as $row) {
                                                    ?>
                                                    <option value="<?php echo $row->type_shop_id; ?>"><?php echo $row->type_shop_name; ?></option>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <br/>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">ชื่อร้าน หรือ นามแฝงตัวแทนจำหน่าย <span style="color: red;">*</span></label>
                                            <input type="text" name="shop_name" class="form-control" data-parsley-error-message="กรุณากรอกข้อมูล" required="">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">ID PormptPay </label>
                                            <input type="text" name="shop_promptpay_id" onblur="check_promptpay_format(this);" class="form-control" >
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">เลขผู้เสียภาษี</label>
                                            <input type="text" name="tax_id" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">เบอร์โทร</label>
                                            <input type="text" name="tel_shop" onblur="check_phone_format(this);" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">โทรสาร (Fax)</label>
                                            <input type="text" name="fax_shop" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">เว็บไซต์</label>
                                            <input type="text" name="website_shop" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Email</label>
                                            <input type="text" name="email_shop" onblur="check_email_format(this);" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">ที่อยู่</label>
                                            <textarea type="text" name="address_shop" rows="5" class="form-control"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-body">
                                <h5 class="card-title"><i class="fa fa-user-circle"></i> ข้อมูลผู้ใช้งานระบบ</h5>
                                <hr>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">ชื่อ-นามสกุล <span style="color: red;">*</span></label>
                                            <input type="text" name="fullname" class="form-control" data-parsley-error-message="กรุณากรอกข้อมูล" required="">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Username (Password = Username ใช้สำหรับ Login) <span style="color: red;">*</span> <span  id="username_massage" style="color: red;"></span> </label>
                                            <input type="text" name="username" class="form-control" onblur="check_username_format(this);
                                                    check_username(this);" data-parsley-error-message="Username ต้องมี 4-20 ตัวอักษร และสามารถกรอกได้ a-z A-Z 0-9" required="">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">เบอร์โทรติดต่อ <span style="color: red;">*</span></label>
                                            <input type="text" name="tel" class="form-control" onblur="check_phone_format(this);" data-parsley-error-message="สามารถกรอกได้ + - 0-9" required="">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Email <span style="color: red;">*</span></label>
                                            <input type="text" name="email" class="form-control" onblur="check_email_format(this);" data-parsley-error-message="กรุณากรอกข้อมูล" required="">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="control-label">ที่อยู่ <span style="color: red;">*</span></label>
                                            <textarea type="text" name="address" rows="5" class="form-control" data-parsley-error-message="กรุณากรอกข้อมูล" required=""></textarea>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-sm-12 text-center">
                            <button type="submit" id="bt-submit" class="btn btn-outline-success"><i class="fa fa-plus-circle"></i> สร้าง</button>
                            <button type="reset" class="btn btn-outline-danger"><i class="fa fa-refresh"></i> ล้างข้อมูล</button>
                        </div>
                    </div>

                </form>

            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="shop">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><i class="fa fa-plus-circle"></i>&nbsp;สร้างสาขา</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <div class="bootbox-body">
                    <br/>
                    <div class="text-center"><h2 class="text-danger"><i class="fa fa-info-circle"></i> ไม่สามารถสร้างสาขาได้ เนื่องจากถูกจำกัดแพ็กเกจ</h2>
                        <br/>
                        <a href="<?php echo base_url() . 'package'; ?>" class="btn btn-outline-primary" ><i class="fa fa-gift"></i>&nbsp;เลือกอัพเดทแพ็กเกจ</a>
                        <button type="button" class="btn btn-outline-danger" data-dismiss="modal" aria-hidden="true" ><i class="fa fa-close"></i>&nbsp;ยกเลิก</button>
                        <br/>
                        <br/>
                    </div>
                </div>                    
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="agent">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><i class="fa fa-plus-circle"></i>&nbsp;สร้างตัวแทนจำหน่าย</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <div class="bootbox-body">
                    <br/>
                    <div class="text-center"><h2 class="text-danger"><i class="fa fa-info-circle"></i> ไม่สามารถสร้างตัวแทนจำหน่ายได้ เนื่องจากถูกจำกัดแพ็กเกจ</h2>
                        <br/>
                        <a href="<?php echo base_url() . 'package'; ?>" class="btn btn-outline-primary" ><i class="fa fa-gift"></i>&nbsp;เลือกอัพเดทแพ็กเกจ</a>
                        <button type="button" class="btn btn-outline-danger" data-dismiss="modal" aria-hidden="true" ><i class="fa fa-close"></i>&nbsp;ยกเลิก</button>
                        <br/>
                        <br/>
                    </div>
                </div>                    
            </div>
        </div>
    </div>
</div>

<script>
    $(function () {
        $('#form-create').parsley();
    });

    function checkpackage() {
        var type_shop_id = $('#type_shop_id').val();
        if (type_shop_id != '') {
            //console.log(type_shop_id)
            url = service_base_url + 'addshop/checkpackage';
            $.ajax({
                url: url,
                method: "POST",
                data: {
                    type_shop_id: type_shop_id,
                },
                success: function (response)
                {
                    if (response == 2) {
                        $('#shop').modal('show', {backdrop: 'true'});
                    }
                    else if (response == 3) {
                        $('#agent').modal('show', {backdrop: 'true'});
                    }
                }
            });
        }
    }
</script>