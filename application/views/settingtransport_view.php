<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-block">
                <h4 class="card-title"><i class="<?php echo $icon; ?>"></i> <?php echo " " . $title; ?>
                    <a href="<?php echo base_url() . 'settingtransport/printtransportfrom'; ?>" target="_blank" style="float: right" class="btn btn-sm btn-rounded btn-outline-primary"><i class="fa fa-print"></i> พิมพ์สติ๊กเกอร์ผู้ส่ง</a>
                </h4>  
                <br/>
                <form class="form-material m-t-10" id="formedit" method="post" action="<?php echo base_url() . 'settingtransport/edit'; ?>" autocomplete="off">
                    <?php $data = $this->settingtransport_model->get_transport_setting()->row(); ?>
                    <div class="form-group row">
                        <label class="col-sm-2 text-right control-label col-form-label"> ผู้ส่ง : <span class="text-danger">*</span></label>
                        <div class="form-group col-sm-4">
                            <input type="text" name="send_name" value="<?php echo $data->send_name; ?>" class="form-control form-control-line" data-parsley-error-message="กรุณากรอกข้อมูล"  required="">
                        </div>     
                        <label class="col-sm-2 text-right control-label col-form-label"> โทร : <span class="text-danger">*</span></label>
                        <div class="form-group col-sm-3">
                            <input type="text" name="transport_tel" value="<?php echo $data->transport_tel; ?>" class="form-control form-control-line" data-parsley-error-message="กรุณากรอกข้อมูล"  required="">
                        </div>   
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 text-right control-label col-form-label"> ที่อยู่ผู้ส่ง : <span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <textarea name="send_address" class="form-control" rows="2"><?php echo $data->send_address; ?></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 text-right control-label col-form-label"> ค่าขนส่ง : <span class="text-danger">*</span></label>
                        <div class="form-group col-sm-2">
                            <input type="text" name="transport_price" value="<?php echo $data->transport_price; ?>" class="form-control form-control-line" data-parsley-error-message="กรุณากรอกข้อมูล"  required="">
                        </div>   
                        <label class="col-sm-1 control-label col-form-label"> บาท</label>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 text-right control-label col-form-label"> วันจัดส่งล่าช้า : <span class="text-danger">*</span></label>
                        <div class="col-sm-1">
                            <input type="number" name="date_deley" value="<?php echo $data->date_deley; ?>" class="form-control form-control-line" data-parsley-error-message="กรุณากรอกข้อมูล"  required="">
                        </div>
                        <label class="col-sm-1 control-label col-form-label">วัน</label>
                        <label class="col-sm-4 control-label col-form-label text-danger">&nbsp;(เริ่มนับวันจัดส่งล่าช้าจากวันที่ ออกใบเสร็จ)</label>                        
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 text-right control-label col-form-label"> สติ๊กเกอร์ผู้รับ : <span class="text-danger">*</span></label>
                        <div class="col-sm-6" style="padding-top: 6px">
                            <input type="checkbox" name="show_product" id="checkboxstatus0" value="0"  >    
                            <input type="checkbox" name="show_product" id="checkboxstatus1" value="1"  <?php echo ($data->show_product == 1) ? 'checked' : ''; ?>>
                            <label for="checkboxstatus1"> แสดงสินค้าในสติ๊กเกอร์</label>
                        </div> 
                        <div class="col-sm-4" style="padding-top: 6px">
                            <input type="checkbox" name="show_price" id="checkboxstatus2" value="0"  >    
                            <input type="checkbox" name="show_price" id="checkboxstatus3" value="1"  <?php echo ($data->show_price == 1) ? 'checked' : ''; ?>>
                            <label for="checkboxstatus3"> แสดงจำนวนเงิน Kerry</label>
                        </div> 
                    </div>

                    <hr/>
                    <h4><i class="fa fa-cog"></i> ตั้งค่า API</h4>
                    <?php $Kerry = $this->settingtransport_model->get_transport_setting_api($data->transport_setting_id, 2)->row(); ?>
                    <div class="row">
                        <input type="hidden" name="kerry_id" value="<?php echo $Kerry->transport_api_setting_id; ?>" readonly="" />
                        <div class="col-sm-2"></div>
                        <div class="col-sm-2">
                            <input type="text" class="form-control" value="Kerry Express" readonly="" />
                        </div>
                        <div class="col-sm-3">
                            <input type="text" class="form-control" name="Username_kerry" value="<?php echo $Kerry->username; ?>" placeholder="Username"/>
                        </div>
                        <div class="col-sm-3">
                            <input type="text" class="form-control" name="Password_kerry" value="<?php echo $Kerry->password; ?>" placeholder="Password"/>
                        </div>
                    </div>
                    <br/>
                    <?php $Ems = $this->settingtransport_model->get_transport_setting_api($data->transport_setting_id, 1)->row(); ?>
                    <div class="row">
                        <input type="hidden" name="ems_id" value="<?php echo $Ems->transport_api_setting_id; ?>" readonly="" />
                        <div class="col-sm-2"></div>
                        <div class="col-sm-2">
                            <input type="text" class="form-control" value="Dropoff EMS" readonly="" />
                        </div>
                        <div class="col-sm-3">
                            <input type="text" class="form-control" name="Username_ems" value="<?php echo $Ems->username; ?>" placeholder="Username"/>
                        </div>
                        <div class="col-sm-3">
                            <input type="text" class="form-control" name="Password_ems" value="<?php echo $Ems->password; ?>" placeholder="Password"/>
                        </div>
                    </div>

                    <hr/>
                    <div class="form-group">
                        <div class="col-md-12 text-center">
                            <button type="submit" class="btn btn-outline-info"><i class="fa fa-save"></i>&nbsp;บันทึก</button>
                            &nbsp;
                            <button type="reset" class="btn btn-outline-danger" ><i class="fa fa-close"></i>&nbsp;ยกเลิก</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $(function () {
        $('#formedit').parsley();
    });
</script>