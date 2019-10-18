<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-block">
                <h4 class="card-title"><i class="<?php echo $icon; ?>"></i> <?php echo " " . $title; ?> 
                    <button type="button" style="float: right" class="btn btn-sm btn-rounded btn-outline-success" onclick="modaladd();"><i class="fa fa-plus"></i> เพิ่มคู่ค้า</button>
                    <span style="float: right">&nbsp;</span>
                    <button  type="button" style="float: right" value="0" onclick="open_filter(this);" class="btn btn-sm btn-rounded btn-outline-warning"><i class="fa fa-search"></i> ค้นหาขั้นสูง</button>
                </h4>  

                <div id="filter-group" style="display:none;">

                    <div class="row" style="padding-top: 5px;">
                        <div class="col-12">
                            <div class="card" style="border: 0px; ">
                                <div class="card-block" style="padding-bottom: 0px;">

                                    <div class="form-group row">
                                        <label class="col-sm-2 text-right control-label col-form-label"> กลุ่มคู่ค้า : </label>
                                        <div class="col-sm-3">
                                            <select id="partnersgroup" class="form-control" onchange="data();">
                                                <option value="0"><?php echo 'ทั้งหมด'; ?></option>
                                                <?php foreach ($this->partners_model->get_grouppartners()->result() as $data) { ?>
                                                    <option value="<?php echo $data->partners_group_id; ?>"><?php echo $data->partners_group_name; ?></option>
                                                <?php }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="col-sm-5 offset-sm-2" style="padding-top: 6px" >
                                            <input type="checkbox" class="col-sm-4 offset-sm-2" name="" id="checkboxstatus" value="1" onchange="data();" >
                                            <label for="checkboxstatus"> แสดงคู่ค้าที่ถูกระงับ</label>
                                        </div> 
                                    </div> 

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

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
                <h4 class="modal-title"><i class="fa fa-plus-circle"></i>&nbsp;เพิ่มคู่ค้า</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <div class="bootbox-body">
                    <form class="form-horizontal" id="formadd" method="post" action="<?php echo base_url() . 'partners/add'; ?>" autocomplete="off">
                        <label id="partners_id_massage" class="col-sm-5 text-right" style="color: red;"></label> 
                        <label id="fullname_massage" class="col-sm-6 text-right" style="color: red;"></label> 
                        <div class="form-group row">
                            <label class="col-sm-2 text-right control-label col-form-label"> รหัสคู่ค้า : <span class="text-danger">*</span></label>
                            <div class="col-sm-3">
                                <?php
                                $document = $this->accesscontrol->get_document_setting();
                                $run_number = $document->partners_number_default;
                                $number_id = $document->partners_id_default . $run_number;
                                ?>
                                <input type="text" name="partners_id" id="partners_id" value="<?php echo $number_id; ?>" disabled="" class="form-control" required="">
                            </div>
                            <label class="col-sm-2 text-right control-label col-form-label"> ชื่อคู่ค้า : <span class="text-danger">*</span></label>
                            <div class="col-sm-4">
                                <input type="text" name="fullname" id="fullname" class="form-control" data-parsley-error-message="กรุณากรอกข้อมูล" required="">
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
                            <label class="col-sm-2 text-right control-label col-form-label"><i class="mdi mdi-facebook-box"></i></label>
                            <div class="col-sm-3">
                                <input type="text" name="facebook" class="form-control" >
                            </div>
                            <label class="col-sm-2 text-right control-label col-form-label">LINE</label>
                            <div class="col-sm-4">
                                <input type="text" name="line" class="form-control" >
                            </div>
                        </div> 
                        <div class="form-group row">
                            <label class="col-sm-2 text-right control-label col-form-label"><i class="fa fa-instagram"></i></label>
                            <div class="col-sm-3">
                                <input type="text" name="instagram" class="form-control" >
                            </div>
                            <div class="col-sm-5 offset-sm-1" style="padding-top: 6px">
                                <input type="checkbox" class="col-sm-4 offset-sm-2" name="" id="basic_checkbox" value="0" onclick="open_vat(this);" >
                                <label for="basic_checkbox"> กำหนดเลขผู้เสียภาษี, ชื่อสาขา, เลขที่สาขา</label>
                            </div>  
                        </div>   
                        <div id="vat-group" style="display: none;">
                            <div class="form-group row">
                                <label class="col-sm-2 text-right control-label col-form-label"> เลขผู้เสียภาษี : </label>
                                <div class="col-sm-9">
                                    <input type="text" name="tax_id" class="form-control">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 text-right control-label col-form-label"> บริษัท : </label>
                                <div class="col-sm-4">
                                    <input type="text" name="tax_shop"  class="form-control">
                                </div>
                                <label class="col-sm-2 text-right control-label col-form-label"> สาขา : </label>
                                <div class="col-sm-3">
                                    <input type="text" name="tax_shop_sub"  class="form-control">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 text-right control-label col-form-label"> ที่อยู่ : </label>
                                <div class="col-sm-9">
                                    <textarea name="tax_address" class="form-control" rows="2"></textarea>
                                </div>
                            </div>
                        </div> 
                        <div class="form-group row">
                            <label class="col-sm-2 text-right control-label col-form-label"> กลุ่มคู่ค้า : </label>
                            <div class="col-sm-6">
                                <select name="partners_group_id" class="form-control">
                                    <?php foreach ($this->partners_model->get_grouppartners()->result() as $data) { ?>
                                        <option value="<?php echo $data->partners_group_id; ?>"><?php echo $data->partners_group_name; ?></option>
                                    <?php }
                                    ?>
                                </select>
                            </div>
                            <div class="col-sm-3">
                                <a href="<?php echo base_url() . 'grouppartners'; ?>" target="_blank" style="float: right" class="btn btn-outline-info"><i class="fa fa-plus"></i> เพิ่มกลุ่มคู่ค้า</a>
                            </div>
                        </div> 
                        <div class="form-group">
                            <div class="col-md-12 text-center">
                                <button type="submit" id="bt-submit" value="add" class="btn btn-outline-info"><i class="fa fa-save"></i>&nbsp;บันทึก</button>
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