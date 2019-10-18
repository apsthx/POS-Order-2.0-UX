
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-block" id="_loadding">
                <h4 class="card-title">
                    <i class="<?php echo $icon; ?>"></i> <?php echo " " . $title; ?>
                    <button style="float: right" class="btn btn-sm btn-circle btn-danger" onclick="window.history.back();"><i class="fa fa-times"></i></button>
                </h4> 

                <form class="form-horizontal" id="form-add" enctype="multipart/form-data" method="post" action="<?php echo base_url() . 'product/add'; ?>" autocomplete="off">

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
                                            <option value="<?php echo $row->product_category_id; ?>"><?php echo $row->product_category_name; ?></option>
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
                            <a style="margin-top:25px;" href="<?php echo base_url() . 'category'; ?>" class="btn btn-outline-success" >
                                <i class="fa fa-plus" ></i> เพิ่มหมวดหมู่
                            </a>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">รหัสสินค้า <span style="color: red;">*</span> <span id="product_id_massage" style="color: red;"></span></label>
                                <?php
                                $document = $this->accesscontrol->get_document_setting();
                                $run_number = $document->product_number_default;
                                $number_id = $document->product_id_default . $run_number;
                                ?>
                                <input type="text" name="product_id" value="<?php echo $number_id; ?>" class="form-control" disabled="" required="">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">ชื่อสินค้า <span style="color: red;">*</span></label>
                                <input type="text" name="product_name" class="form-control" data-parsley-error-message="กรุณากรอกข้อมูล" required="">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">แบรนด์ </label>
                                <input type="text" name="product_brand" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">รุ่น </label>
                                <input type="text" name="product_gen" class="form-control">
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">ราคาซื้อ <span style="color: red;">*</span></label>
                                <input type="text" name="product_buy_price" onblur="check_price_format(this);" class="form-control" data-parsley-error-message="กรุณากรอกข้อมูล" required="">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">ราคาขาย <span style="color: red;">*</span></label>
                                <input type="text" name="product_sale_price" onblur="check_price_format(this);" class="form-control" data-parsley-error-message="กรุณากรอกข้อมูล" required="">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">จำนวน</label>
                                <input type="number" name="product_amount" class="form-control" value="0" data-parsley-error-message="กรุณากรอกข้อมูล" readonly="" required="" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">หน่วย <span style="color: red;">*</span></label>
                                <input type="text" name="product_unit" class="form-control" placeholder="ขวด, เม็ด, ชิ้น" data-parsley-error-message="กรุณากรอกข้อมูล" required=""/>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">น้ำหนัก</label>
                                <input type="text" name="product_weight" onblur="check_price_format(this);" placeholder="หน่วยเป็น kg." class="form-control" />
                            </div>
                        </div>
                        <!--                        <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label">บาร์โค้ด</label>
                                                        <input type="text" name="product_barcode" class="form-control"/>
                                                    </div>
                                                </div>-->
                    </div>

                    <h4>คุณสมบัติสินค้า (เช่น สี ความกว้าง ความสูง) <i class="fa fa-plus-square" style="color: #1e88e5; cursor: pointer;" onclick="add_properties();" ></i></h4>
                    <hr/>

                    <div id="add_properties">
                        <div class="row">
                            <div class="col-md-6">
                                <input type="text" name="product_properties_name[]" placeholder="ชื่อ" class="form-control" />
                            </div>
                            <div class="col-md-6">
                                <input type="text" name="product_properties_value[]" placeholder="ค่า" class="form-control" />
                            </div>
                        </div>
                        <p/>
                        <div class="row">
                            <div class="col-md-6">
                                <input type="text" name="product_properties_name[]" placeholder="ชื่อ" class="form-control" />
                            </div>
                            <div class="col-md-6">
                                <input type="text" name="product_properties_value[]" placeholder="ค่า" class="form-control" />
                            </div>
                        </div>
                        <p/>
                    </div>

                    <hr/>

                    <div class="row">
                        <div class="col-md-12">
                            <div id="file_path"></div>
                            <label style="width: 100%" for="upload-image" class="btn btn-info btn-xl">
                                <i class="fa fa-image"></i> อัพโหลดรูปสินค้า
                                <input type="file" accept="image/*" name="image" onchange="$('#file_path').html($(this).val());" id="upload-image" style="display: none">
                            </label>
                        </div>
                    </div>

                    <br/>

                    <div class="form-group">
                        <div class="col-md-12 text-center">
                            <button type="submit" id="bt-submit" class="btn btn-outline-info"><i class="fa fa-plus"></i>&nbsp;เพิ่ม</button>
                            <button type="button" class="btn btn-outline-danger" data-dismiss="modal" aria-hidden="true" ><i class="fa fa-close"></i>&nbsp;ยกเลิก</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

<script>
    var service_base_url = $('#service_base_url').val();

    $(function () {
        $('#form-add').parsley();
    });

    function add_properties() {
        $("#add_properties").append("<div class='row'><div class='col-md-6'><input type='text' name='product_properties_name[]' placeholder='ชื่อ' class='form-control' /></div><div class='col-md-6'><input type='text' name='product_properties_value[]' placeholder='ค่า' class='form-control' /></div></div><p/>");
    }

    function check_product_id(tag, product_id_default) {
        product_id = $(tag).val();
        $('#bt-submit').prop('disabled', true);
        url = service_base_url + 'product/check_product_id';
        if (product_id !== product_id_default) {
            $.ajax({
                url: url,
                method: "POST",
                data: {
                    product_id: product_id
                },
                success: function (res)
                {
                    if (res == '1') {
                        //ซ้ำ
                        $(tag).val('');
                        $('#product_id_massage').html('รหัสนี้มีการใช้งานแล้ว');
                    } else {
                        $('#product_id_massage').html('');
                    }
                    $('#bt-submit').prop('disabled', false);
                }
            });
        }
    }
</script>