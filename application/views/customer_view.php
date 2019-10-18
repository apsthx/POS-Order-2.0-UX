<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-block">
                <h4 class="card-title"><i class="<?php echo $icon; ?>"></i> <?php echo " " . $title; ?> 
                    <button type="button" style="float: right" class="btn btn-sm btn-rounded btn-outline-success" onclick="modaladd();"><i class="fa fa-plus"></i> เพิ่มลูกค้า</button>
                    <span style="float: right">&nbsp;</span>
                    <button  type="file" style="float: right;" class="btn btn-sm btn-rounded btn-outline-primary" onclick="import_modal();"><i class="fa fa-file-excel-o"></i> นำเข้าไฟล์ (CSV)</button>
                    <span style="float: right">&nbsp;</span>
                    <button  type="button" style="float: right" value="0" onclick="open_filter(this);" class="btn btn-sm btn-rounded btn-outline-warning"><i class="fa fa-search"></i> ค้นหาขั้นสูง</button>
                </h4>  

                <div id="filter-group" style="display:none;">

                    <div class="row" style="padding-top: 5px;">
                        <div class="col-12">
                            <div class="card" style="border: 0px; ">
                                <div class="card-block" style="padding-bottom: 0px;">

                                    <div class="form-group row">
                                        <label class="col-sm-2 text-right control-label col-form-label"> กลุ่มลูกค้า : </label>
                                        <div class="col-sm-3">
                                            <select id="customergroup" class="form-control" onchange="data();">
                                                <option value="0"><?php echo 'ทั้งหมด'; ?></option>
                                                <?php foreach ($this->customer_model->get_groupcustomer()->result() as $data) { ?>
                                                    <option value="<?php echo $data->customer_group_id; ?>"><?php echo $data->customer_group_name; ?></option>
                                                <?php }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="col-sm-5 offset-sm-2" style="padding-top: 6px">
                                            <input type="checkbox" class="col-sm-4 offset-sm-2" name="" id="checkboxstatus" value="1" onchange="data();" >
                                            <label for="checkboxstatus"> แสดงลูกค้าที่ถูกระงับ</label>
                                        </div> 
                                    </div> 

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="text-center" id="flash_message4500">
                    <?php
                    if ($this->session->flashdata('flash_message') != '') {
                        ?>
                        <br/>
                        <?php
                        echo $this->session->flashdata('flash_message');
                        ?>
                        <br/>
                        <?php
                    }
                    ?>                                
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
                <h4 class="modal-title"><i class="fa fa-plus-circle"></i>&nbsp;เพิ่มลูกค้า</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <div class="bootbox-body">
                    <form class="form-horizontal" id="formadd" method="post" action="<?php echo base_url() . 'customer/add'; ?>" autocomplete="off">
                        <label id="customer_id_massage" class="col-sm-5 text-right" style="color: red;"></label> 
                        <label id="fullname_massage" class="col-sm-6 text-right" style="color: red;"></label> 
                        <div class="form-group row">
                            <label class="col-sm-2 text-right control-label col-form-label"> รหัสลูกค้า : <span class="text-danger">*</span></label>
                            <div class="col-sm-3">
                                <?php
                                // $maxcustomer = $this->customer_model->get_maxcustomer(); 
                                $document = $this->accesscontrol->get_document_setting();
                                $run_number = $document->customer_number_default;
                                $number_id = $document->customer_id_default . $run_number;
                                //$data_run_number = array('customer_number_default' => $document->customer_number_default + 1);
                                //$this->accesscontrol->update_document_setting($data_run_number);
                                ?>
                                <input type="text" name="customer_id" id="customer_id" value="<?php echo $number_id; ?>" class="form-control" disabled="" required="">
                            </div>
                            <label class="col-sm-2 text-right control-label col-form-label"> ชื่อลูกค้า : <span class="text-danger">*</span></label>
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
                                <textarea name="address" class="form-control" rows="1"></textarea>
                            </div>
                        </div>  
                        <div class="form-group row">
                            <label class="col-sm-2 text-right control-label col-form-label"> ตำบล : </label>
                            <div class="col-sm-3">
                                <input type="text" name="district" class="form-control" >
                            </div>
                            <label class="col-sm-2 text-right control-label col-form-label"> อำเภอ : </label>
                            <div class="col-sm-4">
                                <input type="text" name="amphoe" class="form-control" >
                            </div>
                        </div> 
                        <div class="form-group row">
                            <label class="col-sm-2 text-right control-label col-form-label"> จังหวัด : </label>
                            <div class="col-sm-3">
                                <input type="text" name="province" class="form-control" >
                            </div>
                            <label class="col-sm-2 text-right control-label col-form-label"> รหัสไปรษณีย์ : </label>
                            <div class="col-sm-4">
                                <input type="text" name="zipcode" class="form-control" >
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
                                <label for="basic_checkbox"> กำหนดเลขผู้เสียภาษี, บริษัท, สาขา, ที่อยู่</label>
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
                            <label class="col-sm-2 text-right control-label col-form-label"> กลุ่มลูกค้า : </label>
                            <div class="col-sm-6">
                                <select name="customer_group_id" id='customer_group_id' class="form-control">
                                    <?php foreach ($this->customer_model->get_groupcustomer()->result() as $data) { ?>
                                        <option value="<?php echo $data->customer_group_id; ?>"><?php echo $data->customer_group_name; ?></option>
                                    <?php }
                                    ?>
                                </select>
                            </div>
                            <div class="col-sm-3">
                                <a href="<?php echo base_url() . 'groupcustomer'; ?>" target="_blank" style="float: right" class="btn btn-outline-info"><i class="fa fa-plus"></i> เพิ่มกลุ่มลูกค้า</a>
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

<div class="modal fade" id="view">
    <div class="modal-dialog modal-lg">
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



<div class="modal fade" id="import_modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">
                    นำเข้าไฟล์ (CSV)
                    <a href="<?php echo base_url() . 'assets/customer_form.csv'; ?>" class="btn btn-info btn-sm"><i class="fa fa-download"></i>&nbsp;ดาวน์โหลดแบบฟอร์ม</a>
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <div class="bootbox-body">

                    <form method="post" action="<?php echo base_url() . 'customer/import'; ?>" onsubmit="return submit_import();" enctype="multipart/form-data" autocomplete="off">

                        <div class="row">
                            <label class="col-sm-4 control-label text-right">กลุ่มลูกค้า</label>
                            <div class="col-sm-6">
                                <select name="customer_group_id" class="form-control form-control-sm" required="">
                                    <option value="">-- เลือกกลุ่มลูกค้า --</option>
                                    <?php
                                    $groups = $this->db->where('shop_id_pri', $this->session->userdata('shop_id_pri'))->get('customer_group');
                                    if ($groups->num_rows() > 0) {
                                        foreach ($groups->result() as $row) {
                                            ?>
                                            <option value="<?php echo $row->customer_group_id; ?>"><?php echo $row->customer_group_name; ?></option>
                                            <?php
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <br/>
                        <div class="row">
                            <div class="col-sm-2"></div>
                            <div class="col-sm-8">
                                <input type="file" name="file" accept=".csv" class="form-control form-control-sm" required=""/>
                            </div>
                        </div>
                        <br/>
                        <div class="row">
                            <div class="col-sm-12 text-center">
                                <button type="submit" class="btn btn-outline-info"><i class="fa fa-save"></i>&nbsp;บันทึก</button>
                                <button type="button" class="btn btn-outline-danger" data-dismiss="modal" aria-hidden="true" ><i class="fa fa-close"></i>&nbsp;ยกเลิก</button>
                            </div>
                        </div>

                    </form>

                </div>                    
            </div>
        </div>
    </div>
</div>

<script>


</script>