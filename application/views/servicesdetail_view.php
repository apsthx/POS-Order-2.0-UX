<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-block">
                <h4 class="card-title">
                    <i class="<?php echo $icon; ?>"></i> <?php echo $title; ?>
                </h4>
                <div class="text-center" id="flash_message4500">
                    <?php
                    if ($this->session->flashdata('flash_message') != '') {
                        ?>
                        <?php
                        echo $this->session->flashdata('flash_message');
                        ?>
                        <br>
                        <?php
                    }
                    ?>                                
                </div>
                <?php $services_master = $this->services_model->get_servicesmaster($services_master_id_pri)->row(); ?>
                <form id="form-services" action="<?php echo base_url() . 'services/edit'; ?>" method="post">

                    <input type="hidden" name="services_master_id_pri" value="<?php echo $services_master->services_master_id_pri ?>">
                    <input type="hidden" name="services_status" value="<?php echo $services_master->services_status ?>">
                    <input type="hidden" name="services_pay" value="<?php echo $services_master->services_pay ?>">
                    <input type="hidden" name="date_services" value="<?php echo $services_master->date_services ?>">
                    <input type="hidden" name="date_pay" value="<?php echo $services_master->date_pay ?>">
                    <input type="hidden" name="bank_id" value="<?php echo $services_master->bank_id ?>">

                    <div class="row">
                        <div class="col-lg-6">
                            <hr/>

                            <div class="form-group">
                                <div class="row">
                                    <label class="col-lg-4 text-right">ประเภท</label>
                                    <div class="col-lg-8">
                                        <input type="text" readonly="" value="บริการ" class="form-control form-control-sm">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <label class="col-lg-4 text-right">เลขรายการ <span class="text-danger">*</span></label>
                                    <div class="col-lg-8">
                                        <input type="text" readonly="" name="services_master_id" value="<?php echo $services_master->services_master_id ?>" class="form-control form-control-sm">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <label class="col-lg-4 text-right">วันที่ทำรายการ <span class="text-danger">*</span></label>
                                    <div class="col-lg-8">
                                        <?php $date = Date('Y-m-d'); ?>
                                        <input type="text" name="date_create" id="date_create" <?php echo 'disabled'; ?> value="<?php echo $services_master->date_create; ?>" class="form-control form-control-sm">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <label class="col-lg-4 text-right">ประเภทภาษี</label>
                                    <div class="col-lg-8">
                                        <select name="type_tax_id" id="type_tax_id" class="form-control form-control-sm" onchange="sum_price();" <?php echo ($active == 1) ? 'disabled' : '' ?>>
                                            <?php
                                            $type_tax = $this->db->get('ref_type_tax');
                                            if ($type_tax->num_rows() > 0) {
                                                foreach ($type_tax->result() as $row) {
                                                    ?>
                                                    <option <?php echo ($services_master->date_create == $row->type_tax_id) ? 'selected' : ''; ?> value="<?php echo $row->type_tax_id; ?>"><?php echo $row->type_tax_name; ?></option>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <label class="col-lg-4 text-right">หมายเหตุ</label>
                                    <div class="col-lg-8">
                                        <textarea name="comment" class="form-control form-control-sm" rows="2" <?php echo ($active == 1) ? 'readonly' : '' ?> ><?php echo $services_master->comment; ?></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <label class="col-lg-4 text-right">วันที่เริ่มต้นประกัน</label>
                                    <div class="col-lg-8">
                                        <input type="text" name="services_start" value="<?php echo $services_master->services_start ?>" class="form-control form-control-sm mydatepicker" <?php echo ($active == 1) ? 'readonly' : '' ?> >
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <label class="col-lg-4 text-right">วันที่สิ้นสุดประกัน</label>
                                    <div class="col-lg-8">
                                        <input type="text" name="services_end" value="<?php echo $services_master->services_end ?>" class="form-control form-control-sm mydatepicker" <?php echo ($active == 1) ? 'readonly' : '' ?> >
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <label class="col-lg-4 text-right">บริการหลังการทำรายการ <span class="text-danger">*</span></label>
                                    <div class="col-lg-7">
                                        <input type="number" min="0"  value="<?php echo $services_master->services_day_num ?>" name="services_day_num" id="services_day_num" onchange="servicesday(this)" placeholder="จำนวนวันบริการหลังการทำรายการ" class="form-control form-control-sm" required="" <?php echo ($active == 1) ? 'readonly' : '' ?> >
                                    </div>
                                    <label class="col-lg-1 text-right">วัน</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <label class="col-lg-4 text-right">วันที่บริการ</label>
                                    <div class="col-lg-8">
                                        <input type="text" value="<?php echo $date; ?>" name="services_day" id="services_day" value="<?php echo $services_master->services_day ?>" placeholder="คำนวนจากจำนวน วันบริการหลังการทำรายการ" class="form-control form-control-sm" readonly="">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <label class="col-lg-4 text-right">แจ้งเตือนก่อนวันที่บริการ <span class="text-danger">*</span></label>
                                    <div class="col-lg-7">
                                        <input type="number" min="0" value="0" name="services_alertday_num" id="services_alertday_num" value="<?php echo $services_master->services_alertday_num ?>"  onchange="servicesalertday()"  placeholder="จำนวนวันแจ้งเตือนก่อนถึงวันบริการ" class="form-control form-control-sm" readonly="" required="">
                                    </div>
                                    <label class="col-lg-1 text-right">วัน</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <label class="col-lg-4 text-right">เริ่มแจ้งเตือนวันที่</label>
                                    <div class="col-lg-8">
                                        <input type="text" value="<?php echo $date; ?>"  name="services_alertday" id="services_alertday" value="<?php echo $services_master->services_alertday ?>" placeholder="คำนวนจากจำนวน วันแจ้งเตือนบริการก่อนวันที่บริการ" class="form-control form-control-sm" readonly="">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <hr/>
                            <div class="form-group">
                                <div class="row">
                                    <label class="col-lg-4 text-right">รหัสลูกค้า</label>
                                    <div class="col-lg-5">
                                        <input type="text" name="customer_id" id="customer_id" value="<?php echo $services_master->customer_id ?>" readonly="" class="form-control form-control-sm">
                                    </div>
                                    <div class="col-lg-3"  <?php echo ($active == 1) ? "style='display: none'" : '' ?>>
                                        <a href="javascript:void(0);" onclick="customer_add_modal();" >เพิ่ม</a> |
                                        <a href="javascript:void(0);" onclick="customer_clear();" >ล้าง</a>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <label class="col-lg-4 text-right">กลุ่มลูกค้า</label>
                                    <div class="col-lg-8">
                                        <input type="text" name="customer_group_name" value="<?php echo $this->services_model->get_group_customer($services_master->customer_id)->row()->customer_group_name; ?>" id="customer_group_name" readonly="" class="form-control form-control-sm">
                                    </div>
                                </div>
                            </div>  
                            <div class="form-group">
                                <div class="row">
                                    <label class="col-lg-4 text-right">ชื่อลูกค้า</label>
                                    <div class="col-lg-8">
                                        <input type="text" name="customer_name" id="customer_name" value="<?php echo $services_master->customer_name; ?>" required="" class="form-control form-control-sm" <?php echo ($active == 1) ? 'readonly' : '' ?>>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <label class="col-lg-4 text-right">เบอร์โทร</label>
                                    <div class="col-lg-8">
                                        <input type="text" name="customer_tel" id="customer_tel" value="<?php echo $services_master->customer_tel; ?>" required="" placeholder="ต้องกรอกเบอร์มือถือ 10 ตัวอักษรเท่านั้น เช่น 0981845123" class="form-control form-control-sm" <?php echo ($active == 1) ? 'readonly' : '' ?>>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <label class="col-lg-4 text-right">อีเมลลูกค้า</label>
                                    <div class="col-lg-8">
                                        <input type="text" name="customer_email" id="customer_email" value="<?php echo $services_master->customer_email; ?>" class="form-control form-control-sm" <?php echo ($active == 1) ? 'readonly' : '' ?>>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <label class="col-lg-4 text-right">ที่อยู่ลูกค้า</label>
                                    <div class="col-lg-8">
                                        <textarea name="customer_address" id="customer_address" class="form-control form-control-sm" rows="1" <?php echo ($active == 1) ? 'readonly' : '' ?>><?php echo $services_master->customer_address; ?></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <label class="col-lg-4 text-right">ตำบล</label>
                                    <div class="col-lg-8">
                                        <input type="text" name="customer_district" id="customer_district" value="<?php echo $services_master->customer_district; ?>" class="form-control form-control-sm" <?php echo ($active == 1) ? 'readonly' : '' ?>>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <label class="col-lg-4 text-right">อำเภอ</label>
                                    <div class="col-lg-8">
                                        <input type="text" name="customer_amphoe" id="customer_amphoe" value="<?php echo $services_master->customer_amphoe; ?>" class="form-control form-control-sm" <?php echo ($active == 1) ? 'readonly' : '' ?>>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <label class="col-lg-4 text-right">จังหวัด</label>
                                    <div class="col-lg-8">
                                        <input type="text" name="customer_province" id="customer_province" value="<?php echo $services_master->customer_province; ?>" class="form-control form-control-sm" <?php echo ($active == 1) ? 'readonly' : '' ?>>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <label class="col-lg-4 text-right">รหัสไปรษณีย์</label>
                                    <div class="col-lg-8">
                                        <input type="text" name="customer_zipcode" id="customer_zipcode" value="<?php echo $services_master->customer_zipcode; ?>" class="form-control form-control-sm" <?php echo ($active == 1) ? 'readonly' : '' ?>>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <label class="col-lg-4 text-right"></label>
                                    <div class="col-lg-8">
                                        <input type="checkbox" name="tax_customer_checkbox" id="basic_checkbox" value="0" onclick="open_vat(this);" <?php echo ($active == 1) ? 'disabled' : '' ?>>
                                        <label for="basic_checkbox"> กำหนดเลขผู้เสียภาษี</label>
                                    </div>
                                </div>
                            </div>
                            <div id="vat-group" style="display: <?php echo ($services_master->customer_tax_id != "") ? 'block' : 'none'; ?>;">
                                <div class="form-group">
                                    <div class="row">
                                        <label class="col-lg-4 text-right">เลขประจำตัวผู้เสียภาษี</label>
                                        <div class="col-lg-8">
                                            <input type="text" name="customer_tax_id" id="customer_tax_id" value="<?php echo $services_master->customer_tax_id; ?>" class="form-control form-control-sm" <?php echo ($active == 1) ? 'readonly' : '' ?>>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <label class="col-lg-4 text-right">ชื่อบริษัท</label>
                                        <div class="col-lg-8">
                                            <input type="text" name="customer_tax_shop" id="customer_tax_shop" value="<?php echo $services_master->customer_tax_shop; ?>" class="form-control form-control-sm" <?php echo ($active == 1) ? 'readonly' : '' ?>>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <label class="col-lg-4 text-right">ชื่อสาขา</label>
                                        <div class="col-lg-8">
                                            <input type="text" name="customer_tax_shop_sub" id="customer_tax_shop_sub" value="<?php echo $services_master->customer_tax_shop_sub; ?>" class="form-control form-control-sm" <?php echo ($active == 1) ? 'readonly' : '' ?>>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <label class="col-lg-4 text-right">ที่อยู่สาขา</label>
                                        <div class="col-lg-8">
                                            <textarea name="customer_tax_address" id="customer_tax_address" class="form-control form-control-sm" rows="3" <?php echo ($active == 1) ? 'readonly' : '' ?>><?php echo $services_master->customer_tax_address; ?></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div> 
                        </div>
                    </div>

                    <!--add services-->
                    <div class="row">
                        <div class="col-lg-12 table-responsive">
                            <hr/>
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th class="text-right" width='5%'>#</th>
                                        <th width='25%'>ชื่อบริการ</th>
                                        <th width='5%'></th>
                                        <th class="text-right" width='10%'>จำนวน</th>
                                        <th class="text-right" width='10%'>มูลค่าต่อหน่วย</th>
                                        <th class="text-right" width='10%'>ส่วนลดต่อหน่วย</th>
                                        <th class="text-right" width='10%'>รวม</th>
                                        <th class="text-right" width='15%'></th>
                                    </tr>
                                </thead>
                                <tbody id="detail_tr">
                                    <?php
                                    if ($services_master_id_pri != NULL) {
                                        $services_detail = $this->services_model->get_detail($services_master->services_master_id_pri);
                                        if ($services_detail->num_rows() > 0) {
                                            $i = 1;
                                            foreach ($services_detail->result() as $detail) {
                                                ?>
                                                <tr id='tr_id_<?php echo $i; ?>'>
                                                    <td class="text-right"><?php echo $i; ?></td>
                                            <input name="services_id[]" id="services_id_<?php echo $i; ?>" value="<?php echo $detail->services_id; ?>" type="hidden" class="form-control form-control-sm services_id"/>
                                            <td><input name="services_name[]" id="services_name_<?php echo $i; ?>" value="<?php echo $detail->services_name; ?>" type="text" class="form-control form-control-sm" readonly=""/></td>
                                            <?php if ($detail->services_detail_number != null && $detail->services_amount == 0 && $detail->services_price == 0 && $detail->services_price_sum == 0) { ?>
                                                <td><input name="services_detail_number[]" id="services_detail_number_<?php echo $i; ?>" value="<?php echo $detail->services_detail_number; ?>" type="text" class="form-control form-control-sm" readonly=""></td>
                                                <td><input style="display: none;" name="services_amount[]" id="services_amount_<?php echo $i; ?>" value="<?php echo $detail->services_amount; ?>" type="number" onchange="change_number(this, '<?php echo $i; ?>')" readonly="" class="form-control form-control-sm text-right" /></td>
                                                <td><input style="display: none;" name="services_cost[]" id="services_cost_<?php echo $i; ?>" value="<?php echo $detail->services_price; ?>" type="number" onchange="change_number(this, '<?php echo $i; ?>')" readonly="" class="form-control form-control-sm text-right" /></td>
                                                <td><input style="display: none;" name="services_save[]" id="services_save_<?php echo $i; ?>" value="<?php echo $detail->services_save; ?>" type="number" onchange="change_number(this, '<?php echo $i; ?>')" readonly="" class="form-control form-control-sm text-right" /></td>
                                                <td><input style="display: none;" name="services_price_sum[]" id="services_price_sum_<?php echo $i; ?>" value="<?php echo $detail->services_price_sum; ?>" type="text" class="form-control form-control-sm text-right" readonly="" /></td>                                                  
                                                <td class="text-left bg-white" <?php echo ($active == 1) ? "style='display: none'" : '' ?>>
                                                    <button type="button" class="btn btn-link" id="add_services_detail_<?php echo $i; ?>" onclick="add_services_detail('<?php echo $i; ?>');" style="display: none;">
                                                        <i class="fa fa-plus-square"> เพิ่มรายละเอียด</i>
                                                    </button>
                                                    <button type="button" class="btn btn-link" onclick="delete_detail('<?php echo $i; ?>');" style="margin-left: -5px;">
                                                        <i class="fa fa-times"></i>
                                                    </button>                      
                                                </td>
                                            <?php } else { ?>
                                                <td><input name="services_detail_number[]" id="services_detail_number_<?php echo $i; ?>" value="<?php echo $detail->services_detail_number; ?>" type="text" class="form-control form-control-sm" readonly="" style="display: none;" ></td>   
                                                <td><input name="services_amount[]" id="services_amount_<?php echo $i; ?>" value="<?php echo $detail->services_amount; ?>" type="number" onchange="change_number(this, '<?php echo $i; ?>')" readonly="" class="form-control form-control-sm text-right" /></td>
                                                <td><input name="services_cost[]" id="services_cost_<?php echo $i; ?>" value="<?php echo $detail->services_price; ?>" type="number" onchange="change_number(this, '<?php echo $i; ?>')" readonly="" class="form-control form-control-sm text-right" /></td>
                                                <td><input name="services_save[]" id="services_save_<?php echo $i; ?>" value="<?php echo $detail->services_save; ?>" type="number" onchange="change_number(this, '<?php echo $i; ?>')" readonly="" class="form-control form-control-sm text-right" /></td>
                                                <td><input name="services_price_sum[]" id="services_price_sum_<?php echo $i; ?>" value="<?php echo $detail->services_price_sum; ?>" type="text" class="form-control form-control-sm text-right" readonly="" /></td>                                                    
                                                <td class="text-left bg-white" <?php echo ($active == 1) ? "style='display: none'" : '' ?>>
                                                    <button type="button" class="btn btn-link" id="add_services_detail_<?php echo $i; ?>" onclick="add_services_detail('<?php echo $i; ?>');">
                                                        <i class="fa fa-plus-square"> เพิ่มรายละเอียด</i>
                                                    </button>
                                                    <button type="button" class="btn btn-link" onclick="delete_detail('<?php echo $i; ?>');" style="margin-left: -5px;">
                                                        <i class="fa fa-times"></i>
                                                    </button>                      
                                                </td>
                                            <?php } ?>                                                    
                                            </tr>                                   
                                            <?php
                                            $i++;
                                        }
                                        if ($active == 1) {
                                            
                                        } else {
                                            ?>
                                            <tr id='tr_id_<?php echo $i; ?>'>
                                                <td class="text-right"><?php echo $i; ?></td>
                                            <input name="services_id[]" id="services_id_<?php echo $i; ?>" type="hidden" class="form-control form-control-sm services_id"/>
                                            <td><input name="services_name[]" id="services_name_<?php echo $i; ?>" type="text" class="form-control form-control-sm" readonly="" /></td>
                                            <td><input name="services_detail_number[]" id="services_detail_number_<?php echo $i; ?>" type="text" class="form-control form-control-sm" readonly="" style="display: none;" ></td>
                                            <td><input name="services_amount[]" id="services_amount_<?php echo $i; ?>" type="number" onchange="change_number(this, '<?php echo $i; ?>')" readonly="" class="form-control form-control-sm text-right" /></td>
                                            <td><input name="services_cost[]" id="services_cost_<?php echo $i; ?>" type="number" onchange="change_number(this, '<?php echo $i; ?>')" readonly="" class="form-control form-control-sm text-right" /></td>
                                            <td><input name="services_save[]" id="services_save_<?php echo $i; ?>" type="number" onchange="change_number(this, '<?php echo $i; ?>')" readonly="" class="form-control form-control-sm text-right" /></td>
                                            <td><input name="services_price_sum[]" id="services_price_sum_<?php echo $i; ?>" type="text" class="form-control form-control-sm text-right" readonly="" /></td>
                                            <td class="text-left bg-white" <?php echo ($active == 1) ? "style='display: none'" : '' ?>>
                                                <button type="button" class="btn btn-link" id="add_services_detail_<?php echo $i; ?>" onclick="add_services_detail('<?php echo $i; ?>');" style="display: none;">
                                                    <i class="fa fa-plus-square"> เพิ่มรายละเอียด</i>
                                                </button>
                                                <button type="button" class="btn btn-link" onclick="delete_detail('<?php echo $i; ?>');" style="margin-left: -5px;">
                                                    <i class="fa fa-times"></i>
                                                </button>                      
                                            </td>
                                            </tr>   
                                            <?php
                                            $i++;
                                            ?>
                                            <script>
                                                var detail_index = <?php echo $i; ?>;
                                            </script>
                                            <?php
                                        }
                                    }
                                } else {
                                    if ($active == 1) {
                                        
                                    } else {
                                        ?>
                                        <tr id='tr_id_1'>
                                            <td class="text-right">1</td>
                                        <input name="services_id[]" id="services_id_1" type="hidden" class="form-control form-control-sm services_id"/>
                                        <td><input name="services_name[]" id="services_name_1" type="text" class="form-control form-control-sm" readonly="" /></td>
                                        <td><input name="services_detail_number[]" id="services_detail_number_1" type="text" class="form-control form-control-sm text-right" readonly="" style="display: none;" ></td>                                              
                                        <td><input name="services_amount[]" id="services_amount_1" type="number" onchange="change_number(this, '1')" readonly="" class="form-control form-control-sm text-right" /></td>
                                        <td><input name="services_cost[]" id="services_cost_1" type="number" onchange="change_number(this, '1')" readonly="" class="form-control form-control-sm text-right" /></td>
                                        <td><input name="services_save[]" id="services_save_1" type="number" onchange="change_number(this, '1')" readonly="" class="form-control form-control-sm text-right" /></td>
                                        <td><input name="services_price_sum[]" id="services_price_sum_1" type="text" class="form-control form-control-sm text-right" readonly="" /></td>
                                        <td class="text-left bg-white">
                                            <button type="button" class="btn btn-link" id="add_services_detail_1" onclick="add_services_detail(1);" style="display: none;">
                                                <i class="fa fa-plus-square"> เพิ่มรายละเอียด</i>
                                            </button>
                                            <button type="button" class="btn btn-link" onclick="delete_detail(1);" style="margin-left: -5px;">
                                                <i class="fa fa-times"></i>
                                            </button>                      
                                        </td>
                                        </tr>
                                        <script>
                                            var detail_index = 2;
                                        </script>
                                        <?php
                                    }
                                }
                                ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-8">
                            <button type='button' class="bt-open-modal-services btn btn-link" onclick="services_modal();">
                                <i class="fa fa-plus-square-o"></i> เพิ่มรายการบริการ
                            </button>
                        </div>
                        <div class="col-lg-4">
                            <div class="row">
                                <label class="col-lg-5 text-right">รวมราคาสินค้า</label>
                                <div class="col-lg-5">
                                    <span id="price_services_sum_text">0</span>
                                    <input type="hidden" name="price_services_sum" id="price_services_sum" />           
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-lg-5 text-right">ส่วนลด</label>
                                <div class="col-lg-5">
                                    <input type="text" name="save" id="save" value="<?php echo $services_master->save; ?>" class="form-control form-control-sm" onblur="check_save_format(this);" placeholder="จำนวนเงิน หรือ %"  <?php echo ($active == 1) ? 'readonly' : '' ?> />
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-lg-5 text-right">มูลค่ารวมหลังส่วนลด</label>
                                <div class="col-lg-4">
                                    <span id="price_befor_tax_text">0</span>
                                    <input type="hidden" name="price_befor_tax" id="price_befor_tax" />
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-lg-5 text-right">ภาษีมูลค่าเพิ่ม (7%)</label>
                                <div class="col-lg-4">
                                    <span id="price_tax_text">0</span>
                                    <input type="hidden" name="price_tax" id="price_tax" />
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-lg-5 text-right">มูลค่ารวม</label>
                                <div class="col-lg-4">
                                    <span id="price_text">0</span>
                                    <input type="hidden" name="price" id="price" />
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-5"></div>
                                <div class="col-lg-7">
                                    <input type="checkbox" name="withholding_tax_checkbox" id="withholding_tax_checkbox" <?php echo ($services_master->withholding_tax != "") ? 'checked' : '0'; ?> value="<?php echo ($services_master->withholding_tax != "") ? '1' : '0'; ?>" onclick="open_withholding_tag(this);" <?php echo ($active == 1) ? 'disabled' : '' ?>>
                                    <label for="withholding_tax_checkbox">ภาษีหัก ณ ที่จ่าย</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-5"></div>
                                <div class="col-lg-5" id="withholding-tax-group" style="display: none;">
                                    <select name="withholding_tax" id="withholding_tax" class="form-control form-control-sm" onchange="sum_price();" <?php echo ($active == 1) ? 'disabled' : '' ?>>
                                        <?php
                                        $withholding_tax = $this->db->get('ref_withholding_tax');
                                        if ($withholding_tax->num_rows() > 0) {
                                            foreach ($withholding_tax->result() as $row) {
                                                ?>
                                                <option <?php echo ($services_master->withholding_tax == $row->withholding_tax_name) ? 'selected' : ''; ?> value="<?php echo $row->withholding_tax; ?>"><?php echo $row->withholding_tax_name; ?></option>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>

                            <!--<div class="row">
                                <label class="col-lg-5 text-right">ค่าขนส่งสินค้า</label>
                                <div class="col-lg-5">
                                    <input type="number" name="transport_price" id="transport_price" value="<?php //echo $transport->transport_price;      ?>" class="form-control form-control-sm" onblur="sum_price();" />
                                </div>
                            </div>-->

                            <div class="row">
                                <label class="col-lg-5 text-right">ชำระทั้งสิน</label>
                                <div class="col-lg-4">
                                    <span id="price_sum_pay_text">0</span>
                                    <input type="hidden" name="price_sum_pay" id="price_sum_pay" />
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr/>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="row">
                                <label class="col-lg-4 text-right">สถานะบริการ </label>
                                <div class="col-lg-7">
                                    <?php if ($services_master->services_status == 1) { ?>
                                        <input type="text" value="รอดำเนินการ" class="form-control form-control-sm"  <?php echo 'readonly' ?> />
                                    <?php } else if ($services_master->services_status == 2) { ?>
                                        <input type="text" value="ดำเนินการเสร็จสิน" class="form-control form-control-sm"  <?php echo 'readonly' ?> />
                                    <?php } else { ?>
                                        <input type="text" value="ยกเลิก" class="form-control form-control-sm"  <?php echo 'readonly' ?> />
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-lg-4 text-right">วันที่อัพเดทสถานะบริการ </label>
                                <div class="col-lg-7">
                                    <input type="text" <?php echo 'disabled'; ?> value="<?php echo $services_master->date_services; ?>" class="form-control form-control-sm">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="row">
                                <label class="col-lg-4 text-right">สถานะส่งมอบ </label>
                                <div class="col-lg-7">
                                    <?php if ($services_master->services_pay == 1) { ?>
                                        <input type="text" value="ส่งมอบเสร็จสิ้น" class="form-control form-control-sm"  <?php echo 'readonly' ?> />
                                    <?php } else { ?>
                                        <input type="text" value="รอการส่งมอบ" class="form-control form-control-sm"  <?php echo 'readonly' ?> />
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-lg-4 text-right">วันที่อัพเดทสถานะส่งมอบ </label>
                                <div class="col-lg-7">
                                    <input type="text" <?php echo 'disabled'; ?> value="<?php echo $services_master->date_services; ?>" class="form-control form-control-sm">
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr/>

                    <div class="row">
                        <div class="col-lg-12 text-right">
                            <?php if ($services_master->services_pay == 1) { ?>
                                <a href="<?php echo base_url() . 'services/receipt/' . $services_master_id_pri; ?>" class="btn btn-outline-info"><i class="fa fa-clipboard"></i> ออกใบเสร็จ</a>
                            <?php } ?>
                            <?php if ($active == 1) { ?>
                                <a href="<?php echo base_url() . 'services/printservicesA4/' . $services_master_id_pri; ?>" target="_blank" class="btn btn-outline-success"><i class="fa fa-print"></i> ปริ้น</a>
                            <?php } else { ?>
                                <button disabled="" type="button" onclick="submit_services();" id="bt-submit" class="btn btn-success"><i class="fa fa-save"></i> บันทึก</button>
                            <?php } ?>
                        </div>
                    </div>

                </form>

            </div>
        </div>
    </div>
</div>

<div class="modal fade in" id="open-modal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
        </div>
    </div>
</div>

<div class="modal fade in" id="modal-error">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" style="color:#f1c40f;"><i class="fa fa-warning"></i>&nbsp;ข้อความแจ้งเตือน</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <div class="bootbox-body text-center"><b><span id="modal-error-massage" style="color:#333;"></span></b></div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-outline-inverse" data-dismiss="modal"><i class="fa fa-close"></i>&nbsp;ปิด</button>
            </div>
        </div>
    </div>
</div>
