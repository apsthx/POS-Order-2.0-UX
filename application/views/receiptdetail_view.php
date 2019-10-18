
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

                <div class="row">
                    <div class="col-lg-6">
                        <hr/>
                        <div class="form-group">
                            <div class="row">
                                <label class="col-lg-4 text-right">ประเภท</label>
                                <div class="col-lg-7">
                                    <input type="text" readonly="" value="<?php echo $receipt_master->type_receipt_name; ?>" class="form-control form-control-sm">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <label class="col-lg-4 text-right">เลขรายการ</label>
                                <div class="col-lg-7">
                                    <input type="text" readonly="" value="<?php echo $receipt_master->receipt_master_id; ?>" class="form-control form-control-sm">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <label class="col-lg-4 text-right">วันที่ทำรายการ</label>
                                <div class="col-lg-7">
                                    <input type="text" readonly="" value="<?php echo $this->mics->date2thai($receipt_master->date_receipt, '%d %m %y'); ?>" class="form-control form-control-sm">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <label class="col-lg-4 text-right">อ้างอิง</label>
                                <div class="col-lg-7">
                                    <input type="text" readonly="" value="<?php echo $receipt_master->refer; ?>"  class="form-control form-control-sm">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <label class="col-lg-4 text-right">ช่องทางขาย</label>
                                <div class="col-lg-7">
                                    <input type="text" readonly="" value="<?php echo $receipt_master->sale_from_name; ?>" class="form-control form-control-sm"/>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <label class="col-lg-4 text-right">ประเภทภาษี</label>
                                <div class="col-lg-7">
                                    <input type="text" readonly="" value="<?php echo $receipt_master->type_tax_name; ?>" class="form-control form-control-sm" />
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <label class="col-lg-4 text-right">หมายเหตุ</label>
                                <div class="col-lg-7">
                                    <textarea readonly="" class="form-control form-control-sm" rows="3"><?php echo $receipt_master->comment; ?></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <hr/>
                        <div class="form-group">
                            <div class="row">
                                <label class="col-lg-4 text-right">รหัส<?php echo ($receipt_master->type_receipt_id == 4) ? 'คู่ค้า' : 'ลูกค้า'; ?></label>
                                <div class="col-lg-5">
                                    <input type="text" readonly="" value="<?php echo $receipt_master->customer_id; ?>" class="form-control form-control-sm" />
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <label class="col-lg-4 text-right">ชื่อ<?php echo ($receipt_master->type_receipt_id == 4) ? 'คู่ค้า' : 'ลูกค้า'; ?></label>
                                <div class="col-lg-7">
                                    <input type="text" readonly="" value="<?php echo $receipt_master->customer_name; ?>" class="form-control form-control-sm" />
                                </div>
                            </div>
                        </div>
                        <?php
                        if ($receipt_master->type_receipt_id == 4) {
                            
                        } else {
                            ?>
                            <div class="form-group">
                                <div class="row">
                                    <label class="col-lg-4 text-right">กลุ่มลูกค้า</label>
                                    <div class="col-lg-7">
                                        <?php
                                        if ($this->receiptdetail_model->get_group_customer($receipt_master->customer_id)->num_rows() == 1) {
                                            $customer_group_name = $this->receiptdetail_model->get_group_customer($receipt_master->customer_id)->row()->customer_group_name;
                                        } else {
                                            $customer_group_name = '';
                                        }
                                        ?>
                                        <input type="text" readonly="" value="<?php echo $customer_group_name; ?>" class="form-control form-control-sm" />
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                        <!--                        <div class="form-group">
                                                        <div class="row">
                                                            <label class="col-lg-4 text-right"></label>
                                                            <div class="col-lg-8">
                                                                <input type="text" name="customer_group_name" id="customer_group_name" value="<?php echo ($receipt_edit != NULL) ? $this->quotation_model->get_group_customer($receipt_edit->customer_id)->row()->customer_group_name : ''; ?>" readonly="" class="form-control form-control-sm">
                                                            </div>
                                                        </div>
                                                    </div>  -->
                        <div class="form-group">
                            <div class="row">
                                <label class="col-lg-4 text-right">เบอร์โทร</label>
                                <div class="col-lg-7">
                                    <input type="text" readonly="" value="<?php echo $receipt_master->customer_tel; ?>" class="form-control form-control-sm" />
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <label class="col-lg-4 text-right">อีเมล <?php echo ($receipt_master->type_receipt_id == 4) ? 'คู่ค้า' : 'ลูกค้า'; ?></label>
                                <div class="col-lg-7">
                                    <input type="text" readonly="" value="<?php echo $receipt_master->customer_email; ?>" class="form-control form-control-sm" />
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <label class="col-lg-4 text-right">ที่อยู่<?php echo ($receipt_master->type_receipt_id == 4) ? 'คู่ค้า' : 'ลูกค้า'; ?></label>
                                <div class="col-lg-7">
                                    <textarea readonly="" class="form-control form-control-sm" rows="3" ><?php echo $receipt_master->customer_address; ?></textarea>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <label class="col-lg-4 text-right">ตำบล</label>
                                <div class="col-lg-8">
                                    <input type="text" readonly="" name="customer_district" id="customer_district" value="<?php echo $receipt_master->customer_district; ?>" class="form-control form-control-sm">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <label class="col-lg-4 text-right">อำเภอ</label>
                                <div class="col-lg-8">
                                    <input type="text" readonly="" name="customer_amphoe" id="customer_amphoe" value="<?php echo $receipt_master->customer_amphoe; ?>" class="form-control form-control-sm">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <label class="col-lg-4 text-right">จังหวัด</label>
                                <div class="col-lg-8">
                                    <input type="text" readonly="" name="customer_province" id="customer_province" value="<?php echo $receipt_master->customer_province; ?>" class="form-control form-control-sm">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <label class="col-lg-4 text-right">รหัสไปรษณีย์</label>
                                <div class="col-lg-8">
                                    <input type="text" readonly="" name="customer_zipcode" id="customer_zipcode" value="<?php echo $receipt_master->customer_zipcode; ?>" class="form-control form-control-sm">
                                </div>
                            </div>
                        </div>
                        <?php
                        if ($receipt_master->customer_tax_id != "") {
                            ?>
                            <div id="vat-group">
                                <div class="form-group">
                                    <div class="row">
                                        <label class="col-lg-4 text-right">เลขประจำตัวผู้เสียภาษี</label>
                                        <div class="col-lg-7">
                                            <input type="text" readonly="" value="<?php echo $receipt_master->customer_tax_id; ?>" class="form-control form-control-sm" />
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <label class="col-lg-4 text-right">ชื่อบริษัท</label>
                                        <div class="col-lg-7">
                                            <input type="text" readonly="" value="<?php echo $receipt_master->customer_tax_shop; ?>" class="form-control form-control-sm" />
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <label class="col-lg-4 text-right">ชื่อสาขา</label>
                                        <div class="col-lg-7">
                                            <input type="text" readonly="" value="<?php echo $receipt_master->customer_tax_shop_sub; ?>" class="form-control form-control-sm" />
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <label class="col-lg-4 text-right">ที่อยู่สาขา</label>
                                        <div class="col-lg-7">
                                            <input type="text" readonly="" value="<?php echo $receipt_master->customer_tax_address; ?>" class="form-control form-control-sm" />
                                        </div>
                                    </div>
                                </div>
                            </div> 
                            <?php
                        }
                        ?>
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
                                    <th width='25%'>ชื่อสินค้า</th>
                                    <th class="text-right" width='10%'>จำนวน</th>
                                    <th class="text-right" width='10%'>หน่วย</th>
                                    <th class="text-right" width='12%'>มูลค่าต่อหน่วย</th>
                                    <th class="text-right" width='10%'>ส่วนลดต่อหน่วย</th>
                                    <th class="text-right" width='13%'>รวม</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if ($receipt_detail->num_rows() > 0) {
                                    $i = 1;
                                    foreach ($receipt_detail->result() as $detail) {
                                        ?>
                                        <tr>
                                            <td class="text-right"><?php echo $i++; ?></td>
                                            <td><input type="text" name="product_id[]" value="<?php echo $detail->product_id; ?>" class="form-control form-control-sm product_id" readonly="" /></td>
                                            <td><input type="text" value="<?php echo $detail->product_name; ?>" class="form-control form-control-sm" readonly="" /></td>
                                            <td><input type="text" name="product_amount[]" value="<?php echo $detail->product_amount; ?>" class="form-control form-control-sm text-right product_amount" readonly="" /></td>
                                            <td><input type="text" value="<?php echo $detail->product_unit; ?>" class="form-control form-control-sm text-right" readonly="" /></td>
                                            <td><input type="text" value="<?php echo $detail->product_price; ?>" class="form-control form-control-sm text-right" readonly="" /></td>
                                            <td><input type="text" value="<?php echo $detail->product_save; ?>" class="form-control form-control-sm text-right" readonly="" /></td>
                                            <td><input type="text" value="<?php echo $detail->product_price_sum; ?>" class="form-control form-control-sm text-right" readonly="" /></td>
                                        </tr>
                                        <?php
                                    }
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
                                <?php echo number_format($receipt_master->price_product_sum, 2); ?>
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-lg-5 text-right">ส่วนลด</label>
                            <div class="col-lg-5">
                                <?php echo ($receipt_master->save != NULL) ? $receipt_master->save : '0.00'; ?>
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-lg-5 text-right">มูลค่ารวมหลังส่วนลด</label>
                            <div class="col-lg-4">
                                <?php echo number_format($receipt_master->price_befor_tax, 2); ?>
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-lg-5 text-right">ภาษีมูลค่าเพิ่ม (7%)</label>
                            <div class="col-lg-4">
                                <?php echo number_format($receipt_master->price_tax, 2); ?>
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-lg-5 text-right">มูลค่ารวม</label>
                            <div class="col-lg-4">
                                <?php echo number_format($receipt_master->price, 2); ?>
                            </div>
                        </div>
                        <?php
                        if ($receipt_master->withholding_tax > 0) {
                            ?>
                            <div class="row">
                                <label class="col-lg-5 text-right">ภาษีหัก ณ ที่จ่าย</label>
                                <div class="col-lg-4">
                                    <?php echo $receipt_master->withholding_tax; ?>
                                </div>
                            </div>
                            <?php
                        }
                        ?>
                        <?php
                        if ($receipt_master->transport_price > 0) {
                            ?>
                            <div class="row">
                                <label class="col-lg-5 text-right">ค่าบริการขนส่ง</label>
                                <div class="col-lg-4">
                                    <?php echo number_format($receipt_master->transport_price, 2); ?>
                                </div>
                            </div>
                            <?php
                        }
                        ?>
                        <div class="row">
                            <label class="col-lg-5 text-right">ชำระทั้งสิน</label>
                            <div class="col-lg-4">
                                <?php echo number_format($receipt_master->price_sum_pay, 2); ?>
                            </div>
                        </div>
                        <?php
                        if ($receipt_master->credit > 0) {
                            ?>
                            <div class="row">
                                <label class="col-lg-5 text-right">สิเชื่อเครดิต</label>
                                <div class="col-lg-4">
                                    <?php echo $receipt_master->credit; ?> วัน
                                </div>
                            </div>
                            <?php
                        }
                        ?>
                    </div>
                </div>

                <?php
                if ($receipt_master->transport_send_name != NULL) {
                    ?>
                    <hr/>

                    <div class="row">
                        <div class="col-lg-6">

                            <div class="form-group">
                                <div class="row">
                                    <label class="col-lg-5 text-right">วันที่ส่งสินค้า</label>
                                    <div class="col-lg-6">
                                        <input type="text" value="<?php echo $this->mics->date2thai($receipt_master->transport_date, '%d %m %y'); ?>" readonly="" class="form-control form-control-sm">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <label class="col-lg-5 text-right">ชื่อบริการขนส่ง</label>
                                    <div class="col-lg-6">
                                        <input type="text" value="<?php echo $receipt_master->transport_service_name; ?>" class="form-control form-control-sm" readonly="" />
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <label class="col-lg-5 text-right">ชื่อผู้ส่ง</label>
                                    <div class="col-lg-6">
                                        <input type="text" value="<?php echo $receipt_master->transport_send_name; ?>" class="form-control form-control-sm" readonly="" />
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <label class="col-lg-5 text-right">ที่อยู่ผู้ส่ง</label>
                                    <div class="col-lg-6">
                                        <textarea class="form-control form-control-sm" rows="3" readonly="" ><?php echo $receipt_master->transport_send_address; ?></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <label class="col-lg-5 text-right">เบอร์โทร</label>
                                    <div class="col-lg-6">
                                        <input type="text" value="<?php echo $receipt_master->transport_send_tel; ?>" class="form-control form-control-sm" readonly="" />
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <label class="col-lg-5 text-right">ค่าขนส่ง</label>
                                    <div class="col-lg-6">
                                        <input type="number" value="<?php echo $receipt_master->transport_price; ?>" class="form-control form-control-sm" readonly="" />
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <label class="col-lg-5 text-right">รหัสติดตามจัดส่ง (Tracking id.)</label>
                                    <div class="col-lg-5">
                                        <input type="text" id="transport_tracking_id" onkeyup="transport_tracking_change(this);" value="<?php echo $receipt_master->transport_tracking_id; ?>" class="form-control form-control-sm" readonly="" />
                                    </div>
                                </div>
                            </div>
                            <?php
                            if ($receipt_master->transport_price != NULL) {
                                ?>
                                <!--                                <div class="form-group">
                                                                    <div class="row">
                                                                        <label class="col-lg-5"></label>
                                                                        <div class="col-lg-5">
                                                                            <button type="button" onclick="save_tacking_id('<?php echo $receipt_master->receipt_master_id_pri; ?>')" class="btn btn-outline-primary btn-sm" >บันทึก Tacking id.</button>
                                                                            <button type="button" id="bt_tracking_id" onclick="sand_sms('<?php echo $receipt_master->receipt_master_id_pri; ?>')" class="btn btn-outline-warning btn-sm" <?php echo ($receipt_master->transport_tracking_id == NULL) ? 'disabled' : ''; ?> >ส่ง SMS</button>
                                                                        </div>
                                                                    </div>
                                                                </div>-->
                                <?php
                            }
                            ?>

                        </div>


                        <div class="col-lg-6">

                            <div class="form-group">
                                <div class="row">
                                    <label class="col-lg-4 text-right">ชื่อผู้รับ</label>
                                    <div class="col-lg-6">
                                        <input type="text" value="<?php echo $receipt_master->transport_customer; ?>" class="form-control form-control-sm" readonly="" />
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <label class="col-lg-4 text-right">ที่อยู่จัดส่ง</label>
                                    <div class="col-lg-6">
                                        <textarea class="form-control form-control-sm" rows="5" readonly="" ><?php echo $receipt_master->transport_customer_address.' '.$receipt_master->transport_customer_district.' '.$receipt_master->transport_customer_amphoe.' '.$receipt_master->transport_customer_province.' '.$receipt_master->transport_customer_zipcode; ?></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <label class="col-lg-4 text-right">เบอร์โทร</label>
                                    <div class="col-lg-6">
                                        <input type="text" value="<?php echo $receipt_master->transport_customer_tel; ?>" class="form-control form-control-sm" readonly="" />
                                    </div>
                                </div>
                            </div>
                            <?php
                            if ($receipt_master->type_receipt_id == 3) {
                                ?>
                                <div class="row">
                                    <label class="col-lg-4 text-right">สถานะการส่งสินค้า</label>
                                    <div class="col-lg-6">
                                        <input type="text" value="<?php echo $receipt_master->status_transfer_name; ?>" class="form-control form-control-sm" readonly="" />
                                    </div>
                                </div>
                                <?php
                            }
                            ?>

                        </div>
                    </div>
                    <?php
                }
                ?>

                <hr/>

                <div class="row">
                    <div class="col-lg-12 text-right">
                        <?php
                        if ($receipt_master->type_receipt_id == 1) {
                            ?>
                            <a href="<?php echo base_url() . 'sell'; ?>" class="btn btn-outline-info"><i class="fa fa-clipboard"></i> ทำรายการอื่นต่อ</a>
                            <a href="<?php echo base_url() . 'receipt/billiv/' . $receipt_master->receipt_master_id_pri; ?>"  target="_blank" class="btn btn-outline-success"><i class="fa fa-print"></i> ปริ้นแบบย่อ</a>
                            <?php
                        } elseif ($receipt_master->type_receipt_id == 3) {
                            ?>
                            <a href="<?php echo base_url() . 'receipt/billiv/' . $receipt_master->receipt_master_id_pri; ?>"  target="_blank" class="btn btn-outline-success"><i class="fa fa-print"></i> ปริ้นแบบย่อ</a>
                            <?php
                        } elseif ($receipt_master->type_receipt_id == 2) {
                            ?>
                            <a href="<?php echo base_url() . 'quotation'; ?>" class="btn btn-outline-primary"><i class="fa fa-clipboard"></i> สร้างใบเปิด order</a>
                            <a href="<?php echo base_url() . 'receipt'; ?>" class="btn btn-outline-info"><i class="fa fa-clipboard"></i> ออกใบเสร็จ</a>
                            <?php
                        }
                        ?>
                    </div>
                </div>

            </div>
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


<div class="modal fade in" id="modal-success">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">&nbsp;ข้อความแจ้งเตือน</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <div class="bootbox-body text-center" style="color: green;"><b><i class="fa fa-check-circle-o"></i> บันทึกสำเร็จ</b></div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-outline-inverse" data-dismiss="modal"><i class="fa fa-close"></i>&nbsp;ปิด</button>
            </div>
        </div>
    </div>
</div>