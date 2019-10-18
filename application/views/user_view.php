<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-block">
                <h4 class="card-title"><i class="<?php echo $icon; ?>"></i> <?php echo " " . $title; ?> 
                    <button type="button" style="float: right" class="btn btn-sm btn-rounded btn-outline-success" onclick="modaladd();"><i class="fa fa-plus"></i> เพิ่มผู้ใช้งานระบบ</button>
                    <div style="float: right" >
                        &nbsp;&nbsp;&nbsp;
                    </div>
                    <div style="float: right" >
                        <input type="checkbox" class="col-sm-4 offset-sm-2" name="" id="checkboxstatus" value="1" onchange="data();" >
                        <label for="checkboxstatus"> แสดงผู้ใช้งานที่ถูกระงับ</label>
                    </div>
                </h4>                 
                <div class="table-responsive" id="result-page">

                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="add">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><i class="fa fa-plus-circle"></i>&nbsp;เพิ่มผู้ใช้งานระบบ</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <div class="bootbox-body">
                    <?php
                    $package_shop = $this->accesscontrol->getUserPackage($this->session->userdata('user_id'))->row();
                    //echo $this->accesscontrol->checkuseuser($package_shop->package_shop_id_pri);
                    //echo $this->accesscontrol->getPackage($this->session->userdata('package_id'))->row()->package_useuser + 1;
                    if ($this->accesscontrol->checkuseuser($package_shop->package_shop_id_pri) >= ($this->accesscontrol->getPackage($this->session->userdata('package_id'))->row()->package_useuser + 1)) {
                        ?>
                        <br/>
                        <div class="text-center"><h2 class="text-danger"><i class="fa fa-info-circle"></i> ไม่สามารถเพิ่มผู้ใช้งานระบบได้ เนื่องจากถูกจำกัดแพ็กเกจ</h2>
                            <br/>
                            <a href="<?php echo base_url().'package' ; ?>" class="btn btn-outline-primary" ><i class="fa fa-gift"></i>&nbsp;เลือกอัพเดทแพ็กเกจ</a>
                            <button type="button" class="btn btn-outline-danger" data-dismiss="modal" aria-hidden="true" ><i class="fa fa-close"></i>&nbsp;ยกเลิก</button>
                            <br/>
                            <br/>
                        </div>
                    <?php } else {
                        ?>                   
                        <form class="form-horizontal" id="formadd" method="post" action="<?php echo base_url() . 'user/add'; ?>" autocomplete="off">
                            <label id="username_massage" class="col-sm-5 text-right" style="color: red;"></label> 
                            <div class="form-group row">
                                <label class="col-sm-2 text-right control-label col-form-label"> username : <span class="text-danger">*</span></label>
                                <div class="col-sm-3">
                                    <input type="text" name="username" id="username" onblur="check_username();" onkeypress="if (event.keyCode === 13) {
                                                    check_id();
                                                }" class="form-control" data-parsley-error-message="กรุณากรอกข้อมูล" required="">
                                </div>
                                <label class="col-sm-2 text-right control-label col-form-label"> password : <span class="text-danger">*</span></label>
                                <div class="col-sm-4">
                                    <input autocomplete="new-password" type="password" name="password" id="fullname" class="form-control" data-parsley-error-message="กรุณากรอกข้อมูล" required="">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 text-right control-label col-form-label"> ชื่อผู้ใช้งาน : </label>
                                <div class="col-sm-9">
                                    <input type="text" name="fullname" id="fullname" class="form-control">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 text-right control-label col-form-label"> เบอร์โทร : </label>
                                <div class="col-sm-3">
                                    <input type="text" name="tel" onblur="check_phone_format(this);" class="form-control" >
                                </div>
                                <label class="col-sm-2 text-right control-label col-form-label"> อีเมล : </label>
                                <div class="col-sm-4">
                                    <input type="text" name="email" onblur="check_email_format(this);" class="form-control" >
                                </div>
                            </div>   
                            <div class="form-group row">
                                <label class="col-sm-2 text-right control-label col-form-label"> ที่อยู่ : </label>
                                <div class="col-sm-9">
                                    <textarea name="address" class="form-control" rows="2"></textarea>
                                </div>
                            </div>     
                            <div class="form-group row">
                                <label class="col-sm-2 text-right control-label col-form-label"> เพิ่มเติม : </label>
                                <div class="col-sm-9">
                                    <textarea name="comment" class="form-control" rows="2"></textarea>
                                </div>
                            </div>    
                            <div class="form-group row">
                                <label class="col-sm-2 text-right control-label col-form-label"> สิทธิ์ผู้ใช้งาน : </label>
                                <div class="col-sm-6">
                                    <select name="role_id" class="form-control">
                                        <?php
                                        $type_shop_id = $this->accesscontrol->getMyShop()->type_shop_id;
                                        foreach ($this->user_model->get_role_group($type_shop_id)->result() as $data) {
                                            ?>
                                            <option value="<?php echo $data->role_id; ?>"><?php echo $data->role_name; ?></option>
                                        <?php }
                                        ?>
                                    </select>
                                </div>
                            </div> 
                            <div class="form-group">
                                <div class="col-md-12 text-center">
                                    <button type="submit" id="bt-submit" value="add" class="btn btn-outline-info"><i class="fa fa-save"></i>&nbsp;บันทึก</button>
                                    <button type="button" class="btn btn-outline-danger" data-dismiss="modal" aria-hidden="true" ><i class="fa fa-close"></i>&nbsp;ยกเลิก</button>
                                </div>
                            </div>
                        </form>
                    <?php } ?>
                </div>                    
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="edit">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

        </div>
    </div>
</div>

<div class="modal fade" id="editstatus">
    <div class="modal-dialog">
        <div class="modal-content">

        </div>
    </div>
</div>

<div class="modal fade" id="editpassword">
    <div class="modal-dialog">
        <div class="modal-content">

        </div>
    </div>
</div>