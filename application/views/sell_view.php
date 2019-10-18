
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

                <form id="form-receipt" action="<?php echo base_url() . 'sell/save'; ?>" method="post">

                    <div class="row">
                        <div class="col-lg-6">
                            <hr/>
                            <div class="form-group">
                                <div class="row">
                                    <label class="col-lg-4 text-right">ประเภท</label>
                                    <div class="col-lg-7">
                                        <input type="hidden" name="type_receipt_id" value="1">
                                        <input type="text" readonly="" value="ขายหน้าร้าน" class="form-control form-control-sm">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <label class="col-lg-4 text-right">เลขรายการ <span class="text-danger">*</span></label>
                                    <div class="col-lg-7">
                                        <input type="text" readonly="" name="receipt_master_id" value="<?php echo $setting->sell_id_default . '-' . $setting->sell_number_default; ?>" class="form-control form-control-sm">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <hr/>
                            <div class="form-group">
                                <div class="row">
                                    <label class="col-lg-4 text-right">วันที่ทำรายการ <span class="text-danger">*</span></label>
                                    <div class="col-lg-7">
                                        <?php $date = Date('Y-m-d'); ?>
                                        <input type="text" name="date_receipt" readonly="" value="<?php echo $date; ?>" class="form-control form-control-sm">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <label class="col-lg-4 text-right">ประเภทภาษี</label>
                                    <div class="col-lg-7">
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
                                        <th class="text-right" width='2%'></th>
                                    </tr>
                                </thead>
                                <tbody id="detail_tr">
                                    <tr id='tr_id_1'>
                                        <td class="text-right">1</td>
                                        <td><input name="product_id[]" id="product_id_1" type="text" class="form-control form-control-sm product_id" onkeypress="if (event.keyCode === 13) {
                                                    get_product_by_id(this, '1');
                                                }" autofocus="" /></td>
                                        <td><input name="product_name[]" id="product_name_1" type="text" class="form-control form-control-sm" readonly="" /></td>
                                        <td><input name="product_amount[]" id="product_amount_1" type="number" onchange="change_number(this, '1')" readonly="" class="form-control form-control-sm text-right" /></td>
                                        <td><input name="product_unit[]" id="product_unit_1" type="text" class="form-control form-control-sm text-right" readonly="" /></td>
                                        <td><input name="product_price[]" id="product_price_1" type="number" onchange="change_number(this, '1')" readonly="" class="form-control form-control-sm text-right" /></td>
                                        <td><input name="product_save[]" id="product_save_1" type="number" onchange="change_number(this, '1')" readonly="" class="form-control form-control-sm text-right" /></td>
                                        <td><input name="product_price_sum[]" id="product_price_sum_1" type="text" class="form-control form-control-sm text-right" readonly="" /></td>
                                        <td class="text-left bg-white"></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-7">
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
                                    <input type="text" name="save" id="save" class="form-control form-control-sm" onkeydown="check_save_format(this);" onblur="check_save_format(this);" placeholder="จำนวนเงิน หรือ %" />
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
                                <label class="col-lg-5 text-right">ชำระทั้งสิน</label>
                                <div class="col-lg-4">
                                    <span id="price_sum_pay_text">0</span>
                                    <input type="hidden" name="price_sum_pay" id="price_sum_pay" />
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-lg-5 text-right">รับเงิน</label>
                               <div class="col-lg-4">
                                    <span id="get_paymoney_text">0</span>
                                    <input type="hidden" name="get_pay_money" id="get_pay_money" />
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-lg-5 text-right">ทอนเงิน</label>
                                <div class="col-lg-4">
                                    <span id="change_paymoney_text">0</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr/>

                    <div class="row">
                        <div class="col-lg-12 text-right">
                            <button type="button" onclick="checkbill();" class="btn btn-primary"><i class="fa fa-money"></i> ชำระเงิน</button>
                            <button disabled="" type="button" onclick="submit_receipt();" id="bt-submit" class="btn btn-success"><i class="fa fa-save"></i> บันทึก</button>
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

<div class="modal fade in" id="modal-getmoney">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><i class="mdi mdi-cash-multiple"></i>&nbsp;รับเงิน</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <label class="col-sm-4 text-right" style="font-size: 18px; color: black;">ยอดชำระทั้งสิน</label>
                    <label class="col-sm-5 text-right" style="font-size: 18px; color: black;" id='paymoney'></label>
                    <label class="col-sm-2 text-left" style="font-size: 18px; color: black;"> บาท</label>
                </div>
                <div class="row">
                    <label class="col-sm-4 text-right" style="font-size: 18px;">รับเงินจำนวน</label>
                    <div class="col-sm-5" style="font-size: 18px;">
                        <input type="number" step="0.01" name="getmoney" id="getmoney" class="form-control text-right" min='0' value="0"/>
                    </div>
                    <label class="col-sm-2 text-left" style="font-size: 18px;"> บาท</label>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-outline-inverse" data-dismiss="modal"><i class="fa fa-close"></i>&nbsp;ปิด</button>
                <button type="button" onclick="changecheckbill();" class="btn btn-success"><i class="mdi mdi-cash-multiple"></i> รับเงิน</button>
            </div>
        </div>
    </div>
</div>