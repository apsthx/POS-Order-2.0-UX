
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-block" id="_loadding">
                <h4 class="card-title">
                    <i class="<?php echo $icon; ?>"></i> <?php echo " " . $title; ?>
                    <button style="float: right" class="btn btn-sm btn-circle btn-danger" onclick="window.history.back();"><i class="fa fa-times"></i></button>
                </h4> 

                <form method="post" id="form-edit" enctype="multipart/form-data" action="<?php echo base_url() . 'product/edit'; ?>" autocomplete="off">

                    <input type="hidden" name="product_id_pri" value="<?php echo $data->product_id_pri; ?>"/>

                    <div class="form-body">
                        <div class="row">
                            <div class="col-md-12 text-left">
                                <span style="color: red; font-size: 12px">* คือต้องกรอกให้ครบ</span>
                            </div>
                        </div>
                        <p/>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">หมวดหมู่สินค้า <span style="color: red;">*</span></label>
                                    <select name="product_category_id" class="form-control" required="">
                                        <?php
                                        $product_category = $this->db->where('shop_id_pri', $this->session->userdata('shop_id_pri'))->get('product_category');
                                        if ($product_category->num_rows() > 0) {
                                            ?>
                                            <option value="">--เลือกหมวดหมู่--</option>
                                            <?php
                                            foreach ($product_category->result() as $row) {
                                                ?>
                                                <option <?php echo ($data->product_category_id == $row->product_category_id) ? 'selected' : ''; ?> value="<?php echo $row->product_category_id; ?>"><?php echo $row->product_category_name; ?></option>
                                                <?php
                                            }
                                        } else {
                                            ?>
                                            <option value="">--ยังไม่มีหมวดหมู่--</option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <a style="margin-top:32px;" href="<?php echo base_url() . 'category'; ?>" class="btn btn-outline-success" >
                                    <i class="fa fa-plus" ></i> เพิ่มหมวดหมู่
                                </a>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">รหัสสินค้า <span style="color: red;">*</span> <span id="product_id_massage" style="color: red;"></span></label>
                                    <input type="text" name="product_id" value="<?php echo $data->product_id; ?>" readonly="" class="form-control" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">ชื่อสินค้า <span style="color: red;">*</span></label>
                                    <input type="text" name="product_name" value="<?php echo $data->product_name; ?>" class="form-control" data-parsley-error-message="กรุณากรอกข้อมูล" required="">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">แบรนด์ </label>
                                    <input type="text" name="product_brand" value="<?php echo $data->product_brand; ?>" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">รุ่น </label>
                                    <input type="text" name="product_gen" value="<?php echo $data->product_gen; ?>" class="form-control">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">ราคาซื้อ <span style="color: red;">*</span></label>
                                    <input type="text" name="product_buy_price" value="<?php echo $data->product_buy_price; ?>" onblur="check_price_format(this);" class="form-control" data-parsley-error-message="กรุณากรอกข้อมูล" required="">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">ราคาขาย <span style="color: red;">*</span></label>
                                    <input type="text" name="product_sale_price" value="<?php echo $data->product_sale_price; ?>" onblur="check_price_format(this);" class="form-control" data-parsley-error-message="กรุณากรอกข้อมูล" required="">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">จำนวน</label>
                                    <input type="number" name="product_amount" value="<?php echo $data->product_amount; ?>" class="form-control" data-parsley-error-message="กรุณากรอกข้อมูล" readonly="" required="" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">หน่วย <span style="color: red;">*</span></label>
                                    <input type="text" name="product_unit" value="<?php echo $data->product_unit; ?>" class="form-control" placeholder="ขวด, เม็ด, ชิ้น" data-parsley-error-message="กรุณากรอกข้อมูล" required=""/>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">น้ำหนัก</label>
                                    <input type="text" name="product_weight" value="<?php echo $data->product_weight; ?>" onblur="check_price_format(this);" placeholder="หน่วยเป็น kg." class="form-control" />
                                </div>
                            </div>
                            <!--                            <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="control-label">บาร์โค้ด</label>
                                                                <input type="text" name="product_barcode" value="<?php echo $data->product_barcode; ?>" class="form-control"/>
                                                            </div>
                                                        </div>-->
                        </div>

                        <h4>คุณสมบัติสินค้า (เช่น สี ความกว้าง ความสูง) <i class="fa fa-plus-square" style="color: #1e88e5; cursor: pointer;" onclick="add_properties();" ></i></h4>
                        <hr/>

                        <div id="add_properties">
                            <?php
                            if ($properties->num_rows() > 0) {
                                foreach ($properties->result() as $prop) {
                                    ?>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <input type="hidden" name="product_properties_id[]" value="<?php echo $prop->product_properties_id; ?>" />
                                            <input type="text" name="product_properties_name[]" value="<?php echo $prop->product_properties_name; ?>" placeholder="ชื่อ" class="form-control" />
                                        </div>
                                        <div class="col-md-6">
                                            <input type="text" name="product_properties_value[]" value="<?php echo $prop->product_properties_value; ?>" placeholder="ค่า" class="form-control" />
                                        </div>
                                    </div>
                                    <p/>
                                    <?php
                                }
                            }
                            ?>
                            <div class="row">
                                <div class="col-md-6">
                                    <input type="hidden" name="product_properties_id[]"/>
                                    <input type="text" name="product_properties_name[]" placeholder="ชื่อ" class="form-control" />
                                </div>
                                <div class="col-md-6">
                                    <input type="text" name="product_properties_value[]" placeholder="ค่า" class="form-control" />
                                </div>
                            </div>
                            <p/>
                            <div class="row">
                                <div class="col-md-6">
                                    <input type="hidden" name="product_properties_id[]"  />
                                    <input type="text" name="product_properties_name[]" placeholder="ชื่อ" class="form-control" />
                                </div>
                                <div class="col-md-6">
                                    <input type="text" name="product_properties_value[]" placeholder="ค่า" class="form-control" />
                                </div>
                            </div>
                            <p/>
                        </div>
                        <br/>

                        <div class="row">
                            <div class="col-md-12 text-center">
                                <img src="<?php echo base_url() . 'store/image/' . $data->image_name; ?>" width="120" height="100" />
                                <p/>
                                <div id="file_path"></div>
                                <label style="width: 100%" for="upload-image" class="btn btn-info btn-xl">
                                    <i class="fa fa-image"></i> อัพโหลดรูปสินค้า
                                    <input type="file" accept="image/*" name="image" onchange="$('#file_path').html($(this).val());" id="upload-image" style="display: none">
                                </label>
                            </div>
                        </div>
                        <p/>

                        <input type="hidden" name="status_product_id" id="status_product_id" value="<?php echo $data->status_product_id; ?>"/>
                        <div class="row">
                            <div id="i_status_1" class="col-sm-6 text-right" onclick="ChangeStatus('1');" style="cursor: pointer; color: <?php echo ($data->status_product_id == 1) ? 'green' : 'gray' ?>;">
                                <i class="fa fa-check-circle-o fa-2x"></i>&nbsp;<b>ใช้งาน</b>
                            </div>
                            <div id="i_status_2" class="col-sm-6 text-left" onclick="ChangeStatus('2');" style="cursor: pointer; color:  <?php echo ($data->status_product_id == 2) ? 'red' : 'gray' ?>;">
                                <i class="fa fa-ban fa-2x"></i>&nbsp;<b>ปิดการใช้งาน</b>
                            </div>
                        </div>
                        <br/>

                        <div class="form-group">
                            <div class="col-md-12 text-center">
                                <button type="submit" id="bt-submit" class="btn btn-outline-info"><i class="fa fa-save"></i>&nbsp;บันทึก</button>
                                <button type="button" class="btn btn-outline-danger" data-dismiss="modal" aria-hidden="true" ><i class="fa fa-close"></i>&nbsp;ยกเลิก</button>
                            </div>
                        </div>

                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

<script>
    $(function () {
        $('#form-edit').parsley();
    });

    function add_properties() {
        $("#add_properties").append("<div class='row'><div class='col-md-6'><input type='hidden' name='product_properties_id[]' value='' /><input type='text' name='product_properties_name[]' placeholder='ชื่อ' class='form-control' /></div><div class='col-md-6'><input type='text' name='product_properties_value[]' placeholder='ค่า' class='form-control' /></div></div><p/>");
    }

    function ChangeStatus(click) {
        if (click == 1) {
            $('#i_status_1').css("color", "green");
            $('#i_status_2').css("color", "gray");

        } else {
            $('#i_status_1').css("color", "gray");
            $('#i_status_2').css("color", "red");
        }
        $('#status_product_id').val(click);
    }
</script>