
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

                <form id="form-receipt" action="<?php echo base_url() . 'invoice/save'; ?>" method="post">
                    <input type="hidden" name="receipt_master_id_pri"  value="<?php echo $receipt->receipt_master_id_pri; ?>">

                    <div class="row">
                        <div class="col-lg-6">
                            <hr/>

                            <div class="form-group">
                                <div class="row">
                                    <label class="col-lg-4 text-right">ประเภท</label>
                                    <div class="col-lg-8">
                                        <input type="hidden" name="type_receipt_id" value="5">
                                        <input type="text" readonly="" value="ใบแจ้งหนี้" class="form-control form-control-sm">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <label class="col-lg-4 text-right">เลขรายการ <span class="text-danger">*</span></label>
                                    <div class="col-lg-8">
                                        <input type="text" readonly="" name="receipt_master_id" value="<?php echo $setting->invoice_id_default . '-' . $setting->invoice_number_default; ?>" class="form-control form-control-sm">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <label class="col-lg-4 text-right">วันที่ทำรายการ <span class="text-danger">*</span></label>
                                    <div class="col-lg-8">
                                        <?php $date = Date('Y-m-d'); ?>
                                        <input type="text" name="date_receipt" value="<?php echo $receipt->date_receipt; ?>" readonly="" class="form-control form-control-sm">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <label class="col-lg-4 text-right">อ้างอิง</label>
                                    <div class="col-lg-8">
                                        <input type="text" name="refer" value="<?php echo $receipt->receipt_master_id; ?>" readonly="" class="form-control form-control-sm">
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
                                        <textarea name="comment" class="form-control form-control-sm" rows="3"><?php echo $receipt->comment; ?></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <hr/>
                            <div class="form-group">
                                <div class="row">
                                    <label class="col-lg-4 text-right">รหัสร้าน</label>
                                    <div class="col-lg-5">
                                        <input type="text" name="customer_id" value="<?php echo $shop_sub->shop_id; ?>" readonly="" class="form-control form-control-sm">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <label class="col-lg-4 text-right">ชื่อร้าน</label>
                                    <div class="col-lg-8">
                                        <input type="text" name="customer_name" value="<?php echo $shop_sub->shop_name; ?>" readonly="" required="" class="form-control form-control-sm">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <label class="col-lg-4 text-right">เบอร์โทร</label>
                                    <div class="col-lg-8">
                                        <input type="text" name="customer_tel" value="<?php echo $shop_sub->tel_shop; ?>" required="" class="form-control form-control-sm">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <label class="col-lg-4 text-right">อีเมลติดต่อ</label>
                                    <div class="col-lg-8">
                                        <input type="text" name="customer_email" value="<?php echo $shop_sub->email_shop; ?>" class="form-control form-control-sm">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <label class="col-lg-4 text-right">ที่อยู่ร้าน</label>
                                    <div class="col-lg-8">
                                        <textarea name="customer_address" class="form-control form-control-sm" rows="3"><?php echo $shop_sub->address_shop; ?></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <label class="col-lg-4 text-right"></label>
                                    <div class="col-lg-8">
                                        <input type="checkbox" name="tax_customer_checkbox" id="basic_checkbox" <?php echo ($receipt->customer_tax_id != "") ? 'checked' : '0'; ?> value="<?php echo ($receipt->customer_tax_id != "") ? '1' : '0'; ?>" onclick="open_vat(this);" >
                                        <label for="basic_checkbox"> กำหนดเลขผู้เสียภาษี</label>
                                    </div>
                                </div>
                            </div>
                            <div id="vat-group" style="display: <?php echo ($receipt->customer_tax_id != "") ? 'block' : 'none'; ?>;">
                                <div class="form-group">
                                    <div class="row">
                                        <label class="col-lg-4 text-right">เลขประจำตัวผู้เสียภาษี</label>
                                        <div class="col-lg-8">
                                            <input type="text" name="customer_tax_id" value="<?php echo $shop_sub->tax_id; ?>" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <label class="col-lg-4 text-right">ชื่อบริษัท</label>
                                        <div class="col-lg-8">
                                            <input type="text" name="customer_tax_shop" value="<?php echo $shop_sub->tel_shop; ?>" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <label class="col-lg-4 text-right">ชื่อสาขา</label>
                                        <div class="col-lg-8">
                                            <input type="text" name="customer_tax_shop_sub" value="<?php echo $shop_sub->shop_name; ?>" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <label class="col-lg-4 text-right">ที่อยู่สาขา</label>
                                        <div class="col-lg-8">
                                            <textarea name="customer_tax_address" class="form-control form-control-sm" rows="3"><?php echo $shop_sub->address_shop; ?></textarea>
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
                                        <th class="text-right" width='10%'>ส่วนลดต่อหน่วย</th>
                                        <th class="text-right" width='13%'>รวม</th>
                                    </tr>
                                </thead>
                                <tbody id="detail_tr">

                                    <?php
                                    $receipt_detail = $this->invoice_model->get_detail($receipt->receipt_master_id_pri);
                                    if ($receipt_detail->num_rows() > 0) {
                                        $i = 1;
                                        foreach ($receipt_detail->result() as $detail) {
                                            ?>
                                            <tr id='tr_id_<?php echo $i; ?>'>
                                                <td class="text-right">1</td>
                                                <td><input name="product_id[]" id="product_id_<?php echo $i; ?>" value="<?php echo $detail->product_id; ?>" onchange="get_product_by_id(this, '<?php echo $i; ?>')" type="text" class="form-control form-control-sm" readonly="" /></td>
                                                <td><input name="product_name[]" id="product_name_<?php echo $i; ?>" value="<?php echo $detail->product_name; ?>" type="text" class="form-control form-control-sm" readonly="" /></td>
                                                <td><input name="product_amount[]" id="product_amount_<?php echo $i; ?>" value="<?php echo $detail->product_amount; ?>" type="number" onchange="change_number(this, '<?php echo $i; ?>')" class="form-control form-control-sm text-right" /></td>
                                                <td><input name="product_unit[]" id="product_unit_<?php echo $i; ?>" value="<?php echo $detail->product_unit; ?>" type="text" class="form-control form-control-sm text-right" readonly="" /></td>
                                                <td><input name="product_price[]" id="product_price_<?php echo $i; ?>" value="<?php echo $detail->product_price; ?>" type="number" onchange="change_number(this, '<?php echo $i; ?>')" class="form-control form-control-sm text-right" /></td>
                                                <td><input name="product_save[]" id="product_save_<?php echo $i; ?>" value="<?php echo $detail->product_save; ?>" type="number" onchange="change_number(this, '<?php echo $i; ?>')" class="form-control form-control-sm text-right" /></td>
                                                <td><input name="product_price_sum[]" id="product_price_sum_<?php echo $i; ?>" value="<?php echo $detail->product_price_sum; ?>" type="text" class="form-control form-control-sm text-right" readonly="" /></td>
                                            </tr>
                                            <?php
                                            $i++;
                                        }
                                        $i++;
                                    }
                                    ?>

                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-8"></div>
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
                                    <input type="checkbox" name="withholding_tax_checkbox" id="withholding_tax_checkbox" <?php echo ($receipt->withholding_tax != "") ? 'checked' : '0'; ?> value="<?php echo ($receipt->withholding_tax != "") ? '1' : '0'; ?>" onclick="open_withholding_tag(this);" >
                                    <label for="withholding_tax_checkbox">ภาษีหัก ณ ที่จ่าย</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-5"></div>
                                <div class="col-lg-5" id="withholding-tax-group" style="display: <?php echo ($receipt->withholding_tax != "") ? 'block' : 'none'; ?>;">
                                    <select name="withholding_tax" id="withholding_tax" class="form-control form-control-sm" onchange="sum_price();">
                                        <?php
                                        $withholding_tax = $this->db->get('ref_withholding_tax');
                                        if ($withholding_tax->num_rows() > 0) {
                                            foreach ($withholding_tax->result() as $row) {
                                                ?>
                                                <option <?php echo ($receipt->withholding_tax == $row->withholding_tax_name) ? 'selected' : ''; ?> value="<?php echo $row->withholding_tax; ?>"><?php echo $row->withholding_tax_name; ?></option>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <p/>
                            <div class="row">
                                <label class="col-lg-5 text-right">ค่าขนส่งสินค้า</label>
                                <div class="col-lg-5">
                                    <input type="number" name="transport_price" id="transport_price" value="<?php echo $transport->transport_price; ?>" class="form-control form-control-sm" onblur="sum_price();" />
                                </div>
                            </div>

                            <div class="row">
                                <label class="col-lg-5 text-right">ชำระทั้งสิน</label>
                                <div class="col-lg-4">
                                    <span id="price_sum_pay_text">0</span>
                                    <input type="hidden" name="price_sum_pay" id="price_sum_pay" />
                                </div>
                            </div>

                            <div class="row">
                                <label class="col-lg-5 text-right">สินเชื่อเครดิต</label>
                                <div class="col-lg-4">
                                    <?php $credit_list = array(0, 15, 30, 60); ?>
                                    <select name="credit" class="form-control form-control-sm" >
                                        <?php
                                        foreach ($credit_list as $val) {
                                            ?>
                                            <option <?php echo ($credit == $val) ? 'selected' : ''; ?> value="<?php echo $val; ?>"><?php echo ($val == 0) ? 'ไม่มี' : $val; ?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr/>

                    <div class="row">
                        <div class="col-lg-12 text-right">
                            <button disabled="" type="button" onclick="submit_receipt();" id="bt-submit" class="btn btn-success"><i class="fa fa-save"></i> ออกใบแจ้งหนี้</button>
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