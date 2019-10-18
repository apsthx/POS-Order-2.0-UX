
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

                <form action="<?php echo base_url() . ($Myshop->type_shop_id == 1) ? 'order/save_main' : 'order/save'; ?>" method="post" onsubmit="return submit_receipt();">

                    <div class="row">
                        <div class="col-lg-6">
                            <hr/>
                            <div class="form-group">
                                <div class="row">
                                    <label class="col-lg-4 text-right">ประเภท</label>
                                    <div class="col-lg-8">
                                        <input type="hidden" name="type_receipt_id" value="4">
                                        <input type="text" readonly="" value="ใบสั่งซื้อ" class="form-control form-control-sm">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <label class="col-lg-4 text-right">เลขรายการ <span class="text-danger">*</span></label>
                                    <div class="col-lg-8">
                                        <input type="text" readonly="" name="receipt_master_id" value="<?php echo $setting->order_id_default . '-' . $setting->order_number_default; ?>" class="form-control form-control-sm">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <label class="col-lg-4 text-right">วันที่ทำรายการ <span class="text-danger">*</span></label>
                                    <div class="col-lg-8">
                                        <?php $date = Date('Y-m-d'); ?>
                                        <input type="text" name="date_receipt" value="<?php echo $date; ?>" class="form-control form-control-sm mydatepicker">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <label class="col-lg-4 text-right">ประเภทภาษี</label>
                                    <div class="col-lg-8">
                                        <select name="type_tax_id" id="type_tax_id" class="form-control form-control-sm" onchange="sum_price();">
                                            <?php
                                            $type_tax = $this->db->get('ref_type_tax');
                                            if ($type_tax->num_rows() > 0) {
                                                foreach ($type_tax->result() as $row) {
                                                    ?>
                                                    <option <?php echo ($setting->type_tax_id == $row->type_tax_id) ? 'selected' : ''; ?> value="<?php echo $row->type_tax_id; ?>"><?php echo $row->type_tax_name; ?></option>
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
                                        <textarea name="comment" class="form-control form-control-sm" rows="3"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <hr/>
                            <div class="form-group">
                                <div class="row">
                                    <label class="col-lg-4 text-right">รหัสคู่ค้า</label>
                                    <div class="col-lg-5">
                                        <input type="text" name="customer_id" id="customer_id" value="<?php echo ($partners != NULL) ? $partners->shop_id : ''; ?>" readonly="" class="form-control form-control-sm">
                                    </div>
                                    <?php
                                    if ($partners == NULL) {
                                        ?>
                                        <div class="col-lg-3">
                                            <a href="javascript:void(0);" onclick="customer_modal();">เลือก</a> |
                                            <a href="javascript:void(0);" onclick="customer_clear();">ล้าง</a>
                                        </div>
                                        <?php
                                    }
                                    ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <label class="col-lg-4 text-right">ชื่อคู่ค้า</label>
                                    <div class="col-lg-8">
                                        <input type="text" name="customer_name" id="customer_name" value="<?php echo ($partners != NULL) ? $partners->shop_name : ''; ?>" <?php echo ($partners != NULL) ? 'readonly' : ''; ?> required="" class="form-control form-control-sm">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <label class="col-lg-4 text-right">เบอร์โทร</label>
                                    <div class="col-lg-8">
                                        <input type="text" name="customer_tel" id="customer_tel" value="<?php echo ($partners != NULL) ? $partners->tel_shop : ''; ?>" <?php echo ($partners != NULL) ? 'readonly' : ''; ?> required="" class="form-control form-control-sm">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <label class="col-lg-4 text-right">อีเมล คู่ค้า</label>
                                    <div class="col-lg-8">
                                        <input type="text" name="customer_email" id="customer_email" value="<?php echo ($partners != NULL) ? $partners->email_shop : ''; ?>" <?php echo ($partners != NULL) ? 'readonly' : ''; ?> class="form-control form-control-sm">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <label class="col-lg-4 text-right">ที่อยู่คู่ค้า</label>
                                    <div class="col-lg-8">
                                        <textarea name="customer_address" id="customer_address" <?php echo ($partners != NULL) ? 'readonly' : ''; ?> class="form-control form-control-sm" rows="3"><?php echo ($partners != NULL) ? $partners->address_shop : ''; ?></textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <label class="col-lg-4 text-right"></label>
                                    <div class="col-lg-8">
                                        <input type="checkbox" name="tax_customer_checkbox" id="basic_checkbox" value="0" onclick="open_vat(this);" >
                                        <label for="basic_checkbox"> กำหนดเลขผู้เสียภาษี</label>
                                    </div>
                                </div>
                            </div>
                            <div id="vat-group" style="display: none;">
                                <div class="form-group">
                                    <div class="row">
                                        <label class="col-lg-4 text-right">เลขประจำตัวผู้เสียภาษี</label>
                                        <div class="col-lg-8">
                                            <input type="text" name="customer_tax_id" id="customer_tax_id" value="<?php echo ($partners != NULL) ? $partners->tax_id : ''; ?>" <?php echo ($partners != NULL) ? 'readonly' : ''; ?> class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <label class="col-lg-4 text-right">ชื่อบริษัท</label>
                                        <div class="col-lg-8">
                                            <input type="text" name="customer_tax_shop" id="customer_tax_shop" value="<?php echo ($partners != NULL) ? $partners->shop_name : ''; ?>" <?php echo ($partners != NULL) ? 'readonly' : ''; ?> class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <label class="col-lg-4 text-right">ชื่อสาขา</label>
                                        <div class="col-lg-8">
                                            <input type="text" name="customer_tax_shop_sub" id="customer_tax_shop_sub" value="<?php echo ($partners != NULL) ? $partners->shop_name : ''; ?>" <?php echo ($partners != NULL) ? 'readonly' : ''; ?> class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <label class="col-lg-4 text-right">ที่อยู่สาขา</label>
                                        <div class="col-lg-8">
                                            <textarea name="customer_tax_address" id="customer_tax_address" <?php echo ($partners != NULL) ? 'readonly' : ''; ?> class="form-control form-control-sm" rows="3"><?php echo ($partners != NULL) ? $partners->address_shop : ''; ?></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div> 
                        </div>
                    </div>

                    <!--add product-->
                    <div class="row">
                        <div class="col-lg-12 table-responsive">
                            <hr/>
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th class="text-right" width='5%'>#</th>
                                        <th width='15%'>รหัส</th>
                                        <th width='15%'>ชื่อสินค้า</th>
                                        <th class="text-right" width='10%'>จำนวน</th>
                                        <th class="text-right" width='10%'>หน่วย</th>
                                        <th class="text-right" width='12%'>มูลค่าต่อหน่วย</th>
                                        <th class="text-right" width='13%'>รวม</th>
                                        <th class="text-right" width='2%'></th>
                                    </tr>
                                </thead>
                                <tbody id="detail_tr">
                                    <tr id='tr_id_1'>
                                        <td class="text-right">1</td>
                                        <td><input name="product_id[]" id="product_id_1" onchange="get_product_by_id(this, '1')" type="text" class="form-control form-control-sm product_id" /></td>
                                        <td><input name="product_name[]" id="product_name_1" type="text" class="form-control form-control-sm" readonly="" /></td>
                                        <td><input name="product_amount[]" id="product_amount_1" type="number" onchange="change_number(this, '1')" readonly="" class="form-control form-control-sm text-right" /></td>
                                        <td><input name="product_unit[]" id="product_unit_1" type="text" class="form-control form-control-sm text-right" readonly="" /></td>
                                        <td><input name="product_price[]" id="product_price_1" type="number" onchange="change_number(this, '1')" readonly="" class="form-control form-control-sm text-right" /></td>
                                        <td><input name="product_price_sum[]" id="product_price_sum_1" type="text" class="form-control form-control-sm text-right" readonly="" /></td>
                                        <td class="text-left bg-white">
                                            <button type="button" class="bt-open-modal-product btn btn-link" onclick="delete_detail(1);">
                                                <i class="fa fa-times"></i>
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-8">
                            <button type='button' class="bt-open-modal-product btn btn-link" onclick="add_detail();">
                                <i class="fa fa-plus-square-o"></i> เพิ่มแถว
                            </button>
                            <button type='button' class="bt-open-modal-product btn btn-link" onclick="product_modal();">
                                <i class="fa fa-plus-square-o"></i> เพิ่มรายการสินค้า
                            </button>
                        </div>
                        <div class="col-lg-4">
                            <div class="row">
                                <label class="col-lg-5 text-right">รวมราคาสินค้า</label>
                                <div class="col-lg-5">
                                    <span id="price_product_sum_text">0</span>
                                    <input type="hidden" name="price_product_sum" id="price_product_sum" />           
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-lg-5 text-right">ส่วนลด</label>
                                <div class="col-lg-5">
                                    <input type="text" name="save" id="save" class="form-control form-control-sm" onblur="check_save_format(this);" placeholder="จำนวนเงิน หรือ %" />
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
                                    <input type="checkbox" name="withholding_tax_checkbox" id="withholding_tax_checkbox" value="0" onclick="open_withholding_tag(this);" >
                                    <label for="withholding_tax_checkbox">ภาษีหัก ณ ที่จ่าย</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-5"></div>
                                <div class="col-lg-5" id="withholding-tax-group" style="display: none;">
                                    <select name="withholding_tax" id="withholding_tax" class="form-control form-control-sm" onchange="sum_price();">
                                        <?php
                                        $withholding_tax = $this->db->get('ref_withholding_tax');
                                        if ($withholding_tax->num_rows() > 0) {
                                            foreach ($withholding_tax->result() as $row) {
                                                ?>
                                                <option value="<?php echo $row->withholding_tax; ?>"><?php echo $row->withholding_tax_name; ?></option>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>

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
                        <div class="col-lg-12 text-right">
                            <button disabled="" type="submit" id="bt-submit" class="btn btn-success"><i class="fa fa-save"></i> บันทึก</button>
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