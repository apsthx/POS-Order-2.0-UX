
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-block">
                <h4 class="card-title">
                    <i class="<?php echo $icon; ?>"></i> <?php echo " " . $title; ?>
                </h4>

                <div class="form-group">
                    <div class="row">
                        <label class="col-sm-5 text-right">ตราประทับ</label>

                        <input type="hidden" id="image_id" value="<?php echo $data->image_id; ?>" />

                        <div class="col-sm-2" id="upload-div">
                            <label style="width: 100%" for="upload-image" class="btn btn-info btn-xl">
                                <i class="fa fa-image"></i> อัพโหลดรูป
                                <input type="file" accept="image/*" name="image" onchange="if ($(this).val() !== '') {
                                            upload_image();
                                        }" id="upload-image" style="display: none" data-parsley-id="30">
                            </label>
                        </div>

                        <div class="col-sm-4" id="show-image-div">
                            <a  id="image_a" href="<?php echo base_url() . 'store/image/' . $data->image_name; ?>" target="_blank">
                                <img id="image_show" src="<?php echo base_url() . 'store/image/' . $data->image_name; ?>" width="100" style="cursor:pointer;">
                            </a>
                            <button class="btn btn-outline-danger btn-sm" onclick="delete_image();"><i class="fa fa-trash"></i> ลบรูปภาพ</button>
                        </div>

                    </div>
                </div>

                <!--////////////////////////////////-->

                <form method="post" action="<?php echo base_url() . 'documentsetting/edit'; ?>" autocomplete="off">

                    <div class="form-group">
                        <div class="row">
                            <label class="col-sm-5 text-right">ประเภทภาษี<br>(ตั้งค่าเริ่มต้นในรายการขาย)</label>
                            <div class="col-sm-3 col-md-3">
                                <select name="type_tax_id" class="form-control">
                                    <?php
                                    $tax_ref = $this->db->get('ref_type_tax');
                                    if ($tax_ref->num_rows() > 0) {
                                        foreach ($tax_ref->result() as $row) {
                                            ?>
                                            <option <?php echo ($data->type_tax_id == $row->type_tax_id) ? 'selected' : ''; ?> value="<?php echo $row->type_tax_id; ?>"><?php echo $row->type_tax_name; ?></option>
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
                            <label class="col-sm-5 text-right">ขนาดบิลเล็ก<br>(ตั้งค่าเริ่มต้นในการปริ้นบิลเล็ก)</label>
                            <div class="col-sm-3 col-md-3">
                                <select name="receipt_print_small" class="form-control">
                                    <option <?php echo ($data->receipt_print_small == '80') ? 'selected' : ''; ?> value="80">80 mm</option>
                                    <option <?php echo ($data->receipt_print_small == '76') ? 'selected' : ''; ?> value="76">76 mm</option>
                                </select>
                            </div>
                        </div>
                    </div>           
                    <div class="form-group">
                        <div class="row">
                            <!--<label for="" class="col-sm-12 text-center"></label>-->
                            <div class="col-sm-12 text-center">
                                <button type="submit" class="btn btn-outline-info"><i class="fa fa-save"></i>&nbsp;บันทึก</button>
                                <!--<button type="reset" class="btn btn-outline-danger" data-dismiss="modal" aria-hidden="true"><i class="fa fa-refresh"></i>&nbsp;รีเซ็ต</button>-->
                            </div>
                        </div>
                    </div>

                </form>

                <hr/>
                <div class="row">
                    <div class="col-sm-12 text-center"><h4>คำนำหน้ารายการ</h4></div>
                </div>
                <br/>
                <!--                    <div class="form-group">
                                        <div class="row">
                                            <label for="" class="col-sm-5 text-right">คำเตือน</label>
                                            <label for="" class="col-sm-4 text-left text-danger">การแก้ไขเลขรันใบเสร็จ อาจทำให้ระบบผิดกระบวนการในการทำงาน ควรตั้งค่าเฉพาะครั้งแรกที่เริ่มต้นระบบเท่านั้น</label>
                                        </div>
                                    </div>-->

                <div class="form-group">
                    <div class="row">
                        <label for="" class="col-sm-5 text-right">คำนำหน้ารายการขายหน้าร้าน</label>
                        <div class="col-sm-1">
                            <input type="text" disabled="" name="sell_id_default" value="<?php echo $data->sell_id_default; ?>" class="form-control" required="">
                        </div>
                        <div class="col-sm-2">
                            <input type="text" disabled="" name="sell_number_default" value="<?php echo $data->sell_number_default; ?>" onblur="//check_number_format(this);" class="form-control" required="">
                        </div>

                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <label for="" class="col-sm-5 text-right">คำนำหน้ารายการใบเสนอราคา</label>
                        <div class="col-sm-1">
                            <input type="text" disabled="" name="buy_id_default" value="<?php echo $data->buy_id_default; ?>" class="form-control" required="">
                        </div>
                        <div class="col-sm-2">
                            <input type="text" disabled="" name="buy_number_default" value="<?php echo $data->buy_number_default; ?>" onblur="//check_number_format(this);" class="form-control" required="">
                        </div>

                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <label for="" class="col-sm-5 text-right">คำนำหน้ารายการขาย</label>
                        <div class="col-sm-1">
                            <input type="text" disabled="" name="sale_id_default" value="<?php echo $data->sale_id_default; ?>" class="form-control" required="">
                        </div>
                        <div class="col-sm-2">
                            <input type="text" disabled="" name="sale_number_default" value="<?php echo $data->sale_number_default; ?>" onblur="//check_number_format(this);" class="form-control" required="">
                        </div>

                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <label for="" class="col-sm-5 text-right">คำนำหน้ารายการสั่งซื้อ</label>
                        <div class="col-sm-1">
                            <input type="text" disabled="" name="order_id_default" value="<?php echo $data->order_id_default; ?>" class="form-control" required="">
                        </div>
                        <div class="col-sm-2">
                            <input type="text" disabled="" name="order_number_default" value="<?php echo $data->order_number_default; ?>" onblur="//check_number_format(this);" class="form-control" required="">
                        </div>

                    </div>
                </div>

                <div class="form-group">
                    <div class="row">
                        <label for="" class="col-sm-5 text-right">คำนำหน้าใบแจ้งหนี้</label>
                        <div class="col-sm-1">
                            <input type="text" disabled="" name="invoice_id_default" value="<?php echo $data->invoice_id_default; ?>" class="form-control" required="">
                        </div>
                        <div class="col-sm-2">
                            <input type="text" disabled="" name="invoice_number_default" value="<?php echo $data->invoice_number_default; ?>" onblur="//check_number_format(this);" class="form-control" required="">
                        </div>

                    </div>
                </div>

                <div class="form-group">
                    <div class="row">
                        <label for="" class="col-sm-5 text-right">คำนำหน้าใบบริการ</label>
                        <div class="col-sm-1">
                            <input type="text" disabled="" name="services_id_default" value="<?php echo $data->services_id_default; ?>" class="form-control" required="">
                        </div>
                        <div class="col-sm-2">
                            <input type="text" disabled="" name="services_number_default" value="<?php echo $data->services_number_default; ?>" onblur="//check_number_format(this);" class="form-control" required="">
                        </div>

                    </div>
                </div>
                <!--                    <div class="form-group">
                                        <div class="row">
                                            <label for="" class="col-sm-5 text-right">คำนำหน้ารายการโอน</label>
                                            <div class="col-sm-1">
                                                <input type="text" name="tranfer_id_default" value="<?php echo $data->tranfer_id_default; ?>" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <label for="" class="col-sm-5 text-right">คำนำหน้ารายการรับคืน</label>
                                            <div class="col-sm-1">
                                                <input type="text" name="get_return_id_default" value="<?php echo $data->get_return_id_default; ?>" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <label for="" class="col-sm-5 text-right">คำนำหน้ารายการคืน</label>
                                            <div class="col-sm-1">
                                                <input type="text" name="return_id_default" value="<?php echo $data->return_id_default; ?>" class="form-control">
                                            </div>
                                        </div>
                                    </div>-->


                <hr/>
                <div class="row">
                    <div class="col-sm-12 text-center"><h4>คำนำหน้าอื่นๆ</h4></div>
                </div>
                <br/>
                <div class="form-group">
                    <div class="row">
                        <label for="" class="col-sm-5 text-right">คำนำหน้าคลังสินค้า</label>
                        <div class="col-sm-1">
                            <input type="text" disabled=""  name="stock_id_default" value="<?php echo $data->stock_id_default; ?>" class="form-control">
                        </div>
                        <div class="col-sm-2">
                            <input type="text" disabled="" name="stock_number_default" value="<?php echo $data->stock_number_default; ?>" onblur="//check_number_format(this);" class="form-control" required="">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <label for="" class="col-sm-5 text-right">คำนำหน้าสินค้า</label>
                        <div class="col-sm-1">
                            <input type="text" disabled="" name="product_id_default" value="<?php echo $data->product_id_default; ?>" class="form-control">
                        </div>
                        <div class="col-sm-2">
                            <input type="text" disabled="" name="product_number_default" value="<?php echo $data->product_number_default; ?>" onblur="//check_number_format(this);" class="form-control" required="">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <label for="" class="col-sm-5 text-right">คำนำหน้า ลูกค้า</label>
                        <div class="col-sm-1">
                            <input type="text" disabled="" name="customer_id_default" value="<?php echo $data->customer_id_default; ?>" class="form-control">
                        </div>
                        <div class="col-sm-2">
                            <input type="text" disabled="" name="customer_number_default" value="<?php echo $data->customer_number_default; ?>" onblur="//check_number_format(this);" class="form-control" required="">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <label for="" class="col-sm-5 text-right">คำนำหน้า คู่ค้า</label>
                        <div class="col-sm-1">
                            <input type="text" disabled="" name="partners_id_default" value="<?php echo $data->partners_id_default; ?>" class="form-control">
                        </div>
                        <div class="col-sm-2">
                            <input type="text" disabled="" name="partners_number_default" value="<?php echo $data->partners_number_default; ?>" onblur="//check_number_format(this);" class="form-control" required="">
                        </div>
                    </div>
                </div>


                <!--                    <div class="row">
                                        <div class="col-sm-12 text-center"><h4>ตั่งค่าใบเสร็จ</h4></div>
                                    </div>
                                    <hr/>
                                    <div class="form-group">
                                        <div class="row">
                                            <label class="col-sm-5 text-right">ขนาดใบเสร็จที่ปริ้น</label>
                                            <div class="col-sm-4 col-md-4">
                                                <select name="receipt_print_id" class="form-control">
                <?php
                $print_ref = $this->db->get('ref_receipt_print');
                if ($print_ref->num_rows() > 0) {
                    foreach ($print_ref->result() as $row) {
                        ?>
                                                                                    <option <?php echo ($data->receipt_print_id == $row->receipt_print_id) ? 'selected' : ''; ?> value="<?php echo $row->receipt_print_id; ?>"><?php echo $row->receipt_print_name; ?></option>
                        <?php
                    }
                }
                ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>-->



            </div>
        </div>
    </div>
</div>

<script>
    function check_number_format(input) {
        var text = $(input).val();
        var regex = /^[0-9]{6,6}$/;
        if (regex.test(text) == false) {
            $(input).val('');
            alert('เลขรัน ต้องมี 6 หลักเท่านั้น')
        }
    }
</script>