<div class="row"> 
    <div class="col-3">
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
                <hr/>
                <form id="form-receipt" onsubmit="return selleasysave();" method="post">
                    <div class="row">
                        <div class="col-sm-12" style="margin-bottom: -10px">
                            <div class="form-group">
                                <div class="row">
                                    <hr/>
                                    <label class="col-sm-5" style="font-size: 14px;">เลขรายการ</label>
                                    <div class="col-sm-7">
                                        <input type="hidden" name="type_receipt_id" value="1">
                                        <input type="text" readonly="" name="receipt_master_id" value="<?php echo $setting->sell_id_default . '-' . $setting->sell_number_default; ?>" class="form-control form-control-sm">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12" style="margin-bottom: -10px">
                            <div class="form-group">
                                <div class="row">
                                    <label class="col-sm-5" style="font-size: 14px;">วันที่ทำรายการ</label>
                                    <div class="col-sm-7">
                                        <?php $date = Date('Y-m-d'); ?>
                                        <input type="text" name="date_receipt" readonly="" value="<?php echo $date; ?>" class="form-control form-control-sm">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12" style="margin-bottom: -10px">
                            <div class="form-group">
                                <div class="row">
                                    <label class="col-sm-5" style="font-size: 14px;">ประเภทภาษี</label>
                                    <div class="col-sm-7">
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
                    <div class="row" style="margin-bottom: -5px;">
                        <div class="col-sm-12 table-responsive">
                            <table class="table">
                                <input name="number_ID" id="number_ID" type="hidden" class="form-control form-control-sm" value="1"/>
                                <tbody id="detail_tr">
                                    <tr id='tr_id_1' style="">
                                        <td class="text-right" width="3%" style="padding-left: 1px;padding-bottom: 1px">1</td>
                                <input name="product_id[]" id="product_id_1" type="hidden" class="form-control form-control-sm product_id"/>
                                <input name="product_name[]" id="product_name_1" type="hidden" class="form-control form-control-sm" readonly="" />
                                <td style="padding-left: 1px;padding-bottom: 1px"><input style="font-size: 12px;" name="product_name_text[]" id="product_name_text_1" type="text" class="form-control form-control-sm" readonly="" /></td>
                                <input name="product_amount[]" id="product_amount_1" type="hidden" onchange="change_number(this, '1')" readonly="" class="form-control form-control-sm text-right" />
                                <input name="product_unit[]" id="product_unit_1" type="hidden" class="form-control form-control-sm text-right" readonly="" />
                                <input name="product_price[]" id="product_price_1" type="hidden" onchange="change_number(this, '1')" readonly="" class="form-control form-control-sm text-right" />
                                <input name="product_save[]" id="product_save_1" type="hidden" onchange="change_number(this, '1')" readonly="" class="form-control form-control-sm text-right" />
                                <td width="33%" style="padding-left: 1px;padding-bottom: 1px"><input style="font-size: 12px;" name="product_price_sum[]" id="product_price_sum_1" type="text" class="form-control form-control-sm text-right" readonly="" /></td>
                                <td class='text-left bg-white' width='3%' style='padding-left: 1px;padding-right: 1px;padding-bottom: 1px;' id="delete_detail_id_1"></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <hr style="margin-top: -5px;"/>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="row">
                                <label class="col-sm-7 text-right" style="font-size: 14px;">รวมราคาสินค้า</label>
                                <div class="col-sm-5 text-right" style="font-size: 14px;">
                                    <span id="price_product_sum_text">0</span>
                                    <input type="hidden" name="price_product_sum" id="price_product_sum" />           
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-sm-7 text-right" style="font-size: 14px;">ส่วนลด</label>
                                <div class="col-sm-5 text-right" style="font-size: 14px;">
                                    <input type="text" name="save" id="save" class="form-control form-control-sm" onkeydown="check_save_format(this);" onblur="check_save_format(this);"/>
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-sm-7 text-right" style="font-size: 14px;">มูลค่ารวมหลังส่วนลด</label>
                                <div class="col-sm-5 text-right" style="font-size: 14px;">
                                    <span id="price_befor_tax_text">0</span>
                                    <input type="hidden" name="price_befor_tax" id="price_befor_tax" />
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-sm-7 text-right" style="font-size: 14px;">ภาษีมูลค่าเพิ่ม (7%)</label>
                                <div class="col-sm-5 text-right" style="font-size: 14px;">
                                    <span id="price_tax_text">0</span>
                                    <input type="hidden" name="price_tax" id="price_tax" />
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-sm-7 text-right" style="font-size: 14px;">มูลค่ารวม</label>
                                <div class="col-sm-5 text-right" style="font-size: 14px;">
                                    <span id="price_text">0</span>
                                    <input type="hidden" name="price" id="price" />
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-sm-7 text-right" style="font-size: 14px;">ชำระทั้งสิน</label>
                                <div class="col-sm-5 text-right" style="font-size: 14px;">
                                    <span id="price_sum_pay_text">0</span>
                                    <input type="hidden" name="price_sum_pay" id="price_sum_pay" />
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-sm-7 text-right" style="font-size: 14px;">รับเงิน</label>
                                <div class="col-sm-5 text-right" style="font-size: 14px;">
                                    <span id="get_paymoney_text">0</span>
                                    <input type="hidden" name="get_pay_money" id="get_pay_money" />
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-sm-7 text-right" style="font-size: 14px;">ทอนเงิน</label>
                                <div class="col-sm-5 text-right" style="font-size: 14px;">
                                    <span id="change_paymoney_text">0</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr/>

                    <div class="row">
                        <div class="col-sm-12 text-right">
                            <button type="button" onclick="opencheckbill();" class="btn btn-outline-info"><i class="fa fa-desktop"></i></button>
                            <button type="button" onclick="checkbill();" class="btn btn-primary"><i class="fa fa-money"></i> ชำระเงิน</button>
                            <button disabled="" type="button" onclick="submit_receipt();" id="bt-submit" class="btn btn-success"><i class="fa fa-save"></i> บันทึก</button>
                        </div>
                    </div>

                </form>

            </div>
        </div>
    </div>
    <div class="col-9">
        <div class="card">
            <div class="card-block">
                <div class="row">
                    <div class="col-sm-4">
                        <select name="product_category_id" id="product_category_id" class="form-control form-control-sm" onchange="loadtable();">
                            <option value="">ทั้งหมด</option>
                            <?php
                            $getproductcategory = $this->selleasy_model->getproductcategory();
                            if ($getproductcategory->num_rows() > 0) {
                                foreach ($getproductcategory->result() as $productcategory) {
                                    ?>
                                    <option value="<?php echo $productcategory->product_category_id; ?>"><?php echo $productcategory->product_category_name; ?></option>
                                    <?php
                                }
                            }
                            ?>
                        </select>
                    </div>                  
                    <div class="col-sm-8">
                        <input type="text" style="padding: 5px;" id="search" onkeypress="if (event.keyCode === 13) {
                                    loadtable();
                                }"  class="form-control form-control-sm" placeholder="ค้นหาสินค้า..">
                    </div>
                </div>
                <br/>
                <div class="row">
                    <div class="col-sm-12" id="for_table">

                    </div>
                </div>
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

<script>
    var service_base_url = $('#service_base_url').val();
    var detail_index = 2;

    $(function () {
        select_transport_servic();
        sum_price();
        loadtable();
    });

    function setDatePicker2text(select) {
        $(select).datetimepicker({
            lang: 'th',
            timepicker: false,
            format: 'Y-m-d',
            scrollMonth: false,
            scrollTime: false,
            scrollInput: false,
//        minDate: new Date(),
//        maxDate: new Date(date_finish)
        });
    }

    function loadtable() {
        product_category_id = $('#product_category_id').val();
        search = $('#search').val();
        url = service_base_url + 'selleasy/loadtable';
        $.ajax({
            url: url,
            method: 'post',
            data: {
                search: search,
                product_category_id: product_category_id
            },
            success: function (res)
            {
                $('#for_table').html(res);
            }
        });
    }

    function loadtablecencal() {
        product_category_id = $('#product_category_id').val();
        $('#search').val('');
        search = ''
        url = service_base_url + 'selleasy/loadtable';
        $.ajax({
            url: url,
            method: 'post',
            data: {
                search: search,
                product_category_id: product_category_id
            },
            success: function (res)
            {
                $('#for_table').html(res);
            }
        });
    }

    function change_check_box(tag) {
        vat = $(tag);
        if (vat.val() == 0) {
            vat.val(1);
        } else {
            vat.val(0);
        }
    }

    function open_vat(bt_vat) {
        vat = $(bt_vat);
        if (vat.val() == 0) {
            $('#vat-group').css('opacity', 0)
                    .slideDown('fast')
                    .animate(
                            {opacity: 1},
                    {queue: false, duration: 'slow'}
                    );
            vat.val(1);
            $('#customer_tax_id').prop('required', true);
            $('#customer_tax_shop').prop('required', true);
            $('#customer_tax_shop_sub').prop('required', true);
            $('#customer_tax_address').prop('required', true);
        } else {
            $('#vat-group')
                    .slideUp('fast')
                    .animate(
                            {opacity: 0},
                    {queue: false, duration: 'slow'}
                    );
            vat.val(0);
            $('#customer_tax_id').prop('required', false);
            $('#customer_tax_shop').prop('required', false);
            $('#customer_tax_shop_sub').prop('required', false);
            $('#customer_tax_address').prop('required', false);
        }
    }

    function open_withholding_tag(bt_vat) {
        vat = $(bt_vat);
        if (vat.val() == 0) {
            $('#withholding-tax-group').css('opacity', 0)
                    .slideDown('fast')
                    .animate(
                            {opacity: 1},
                    {queue: false, duration: 'slow'}
                    );
            vat.val(1);
        } else {
            $('#withholding-tax-group')
                    .slideUp('fast')
                    .animate(
                            {opacity: 0},
                    {queue: false, duration: 'slow'}
                    );
            vat.val(0);
        }
        sum_price();
    }

    function open_transport(bt_vat) {
        vat = $(bt_vat);
        if (vat.val() == 0) {
            $('#transport-group').css('opacity', 0)
                    .slideDown('fast')
                    .animate(
                            {opacity: 1},
                    {queue: false, duration: 'slow'}
                    );
            vat.val(1);
            $('#price_transport_show').show();
            $('#transport_send_name').prop('required', true);
            $('#transport_send_address').prop('required', true);
            $('#transport_price').prop('required', true);
            $('#transport_customer').prop('required', true);
            $('#transport_customer_address').prop('required', true);
        } else {
            $('#transport-group')
                    .slideUp('fast')
                    .animate(
                            {opacity: 0},
                    {queue: false, duration: 'slow'}
                    );
            vat.val(0);
            $('#price_transport_show').hide();
            $('#transport_send_name').prop('required', false);
            $('#transport_send_address').prop('required', false);
            $('#transport_price').prop('required', false);
            $('#transport_customer').prop('required', false);
            $('#transport_customer_address').prop('required', false);
        }
        sum_price();
    }

    function getAutocomplete(textbox) {
        $(textbox).autocomplete({
            source: service_base_url + 'sell/get_product_autocomplete',
            minLength: 1,
            select: function (event, ui) {
//            alert(ui.item.id);
//            $(textbox).val(ui.item.id);
            }
        });
    }

    function customer_modal() {
        url = service_base_url + 'sell/customer_modal';
        $('#open-modal').modal('show', {backdrop: 'true'});
        $('#open-modal .modal-content').html('<div style="text-align:center; padding:80px;"><i class="fa fa-refresh fa-spin fa-3x fa-fw"></i></div>');
        $.ajax({
            url: url,
            success: function (res)
            {
                $('#open-modal .modal-content').html(res);
            }
        });
    }

    function customer_clear() {
        $('#customer_id').val('');
        $('#customer_name').val('');
        $('#customer_tel').val('');
        $('#customer_email').val('');
        $('#customer_address').val('');
        $('#customer_tax_id').val('');
        $('#customer_tax_shop').val('');
        $('#customer_tax_shop_sub').val('');
        $('#customer_tax_address').val('');
        $('#transport_customer').val('');
        $('#transport_customer_address').val('');
    }

    function product_modal() {
        product_id_arr = [];
        $('.product_id').map(function (i) {
            product_id_arr[i] = this.value;
        });
        url = service_base_url + 'sell/product_modal';
        $('#open-modal').modal('show', {backdrop: 'true'});
        $('#open-modal .modal-content').html('<div style="text-align:center; padding:80px;"><i class="fa fa-refresh fa-spin fa-3x fa-fw"></i></div>');
        $.ajax({
            url: url,
            method: 'post',
            data: {
                product_id_arr: product_id_arr
            },
            success: function (res)
            {
                $('#open-modal .modal-content').html(res);
            }
        });
    }

    function get_product_by_id(product_id) {
        number_ID = $('#number_ID').val();
        //console.log(product_id + '/' + number_ID);
        $('#number_ID').val(parseInt(number_ID) + 1);
        number_ID_next = $('#number_ID').val();
        url = service_base_url + 'selleasy/get_product_by_id';
        $.ajax({
            url: url,
            dataType: "JSON",
            method: "POST",
            data: {
                product_id: product_id
            },
            success: function (res)
            {
                if (res.error !== "") {
                    $('#modal-error').modal('show', {backdrop: 'true'});
                    $('#modal-error-massage').html(res.error);

                    $('#product_id_' + number_ID).val('');
                    $('#product_name_' + number_ID).val('');
                    $('#product_name_text_' + number_ID).val('');
                    $('#product_amount_' + number_ID).val('');
                    $('#product_unit_' + number_ID).val('');
                    $('#product_price_' + number_ID).val('');
                    $('#product_save_' + number_ID).val('');
                    $('#product_price_sum_' + number_ID).val('');

                    $('#product_amount_' + number_ID).prop('readonly', true);
                    $('#product_price_' + number_ID).prop('readonly', true);
                    $('#product_save_' + number_ID).prop('readonly', true);
                } else {
                    $('#product_id_' + number_ID).val(res.product.product_id);
                    $('#product_name_' + number_ID).val(res.product.product_name);
                    $('#product_name_text_' + number_ID).val(res.product.product_id + ' ' + res.product.product_name);
                    $('#product_amount_' + number_ID).val(1);
                    $('#product_unit_' + number_ID).val(res.product.product_unit);
                    $('#product_price_' + number_ID).val(res.product.product_sale_price);
                    $('#product_save_' + number_ID).val(0);
                    $('#product_price_sum_' + number_ID).val(res.product.product_sale_price);

                    $('#product_amount_' + number_ID).prop('readonly', false);
                    $('#product_price_' + number_ID).prop('readonly', false);
                    $('#product_save_' + number_ID).prop('readonly', false);
                }
                add_detail(number_ID_next);
                sum_price();
                $('#bt-submit').prop('disabled', false);
            }
        });
    }

    function add_detail(detail_index) {
        html = "<tr id='tr_id_" + detail_index + "'>";
        html += "<td class='text-right' width='3%' style='padding-left: 1px;padding-bottom: 1px'>" + detail_index + "</td>";
        html += "<input name='product_id[]' id='product_id_" + detail_index + "' type='hidden' class='form-control form-control-sm product_id' />";
        html += "<input name='product_name[]' id='product_name_" + detail_index + "' type='hidden' class='form-control form-control-sm' readonly='' />";
        html += "<td style='padding-left: 1px;padding-bottom: 1px'><input style='font-size: 12px;' name='product_name_text[]' id='product_name_text_" + detail_index + "' type='text' class='form-control form-control-sm' readonly='' /></td>";
        html += "<input name='product_amount[]' id='product_amount_" + detail_index + "' type='hidden' onchange='change_number(this,  " + detail_index + ")' readonly='' class='form-control form-control-sm text-right' />";
        html += "<input name='product_unit[]' id='product_unit_" + detail_index + "' type='hidden' class='form-control form-control-sm text-right' readonly='' />"
        html += "<input name='product_price[]' id='product_price_" + detail_index + "' type='hidden' onchange='change_number(this, " + detail_index + ")' readonly='' class='form-control form-control-sm text-right' />";
        html += "<input name='product_save[]' id='product_save_" + detail_index + "' type='hidden' onchange='change_number(this, " + detail_index + ")' readonly='' class='form-control form-control-sm text-right' />";
        html += "<td width='33%' style='padding-left: 1px;padding-bottom: 1px'><input style='font-size: 12px;' name='product_price_sum[]' id='product_price_sum_" + detail_index + "' type='text' class='form-control form-control-sm text-right' readonly='' /></td>";
        html += "<td class='text-left bg-white' width='3%' style='padding-left: 1px;padding-right: 1px;padding-bottom: 1px' id='delete_detail_id_" + detail_index + "'></td>";
        html += "</tr>";
        $('#delete_detail_id_' + (detail_index - 1)).html("<button style='padding-left: 1px;padding-right: 1px;' type='button' class='bt-open-modal-product btn btn-link' onclick='delete_detail(" + (detail_index - 1) + ");'><i class='fa fa-times'></i></button>")
        $('#detail_tr').append(html);
    }

    function selleasysave() {
//        console.log($("#form-receipt").serialize())
//        var product_id = array();
//        product_id = $('input[name="product_id[]"]').val();
//        console.log(product_id)
        $.ajax({
            url: service_base_url + 'selleasy/save',
            method: "POST",
            data: $("#form-receipt").serialize(),
            success: function (res)
            {
                window.open(service_base_url + 'receipt/billiv/' + res, 'print_popup', 'top=50,left=50,width=1000,height=600');
                //window.open("https://www.w3schools.com", "_blank", "toolbar=yes,scrollbars=yes,resizable=yes,top=500,left=500,width=400,height=400");
            }
        });
        //return false;
    }

//    function get_product_by_id(tag, number_ID) {
//        add_detail();
//        $('#bt-submit').prop('disabled', true);
//        product_id = $(tag).val();
//        url = service_base_url + 'sell/get_product_by_id';
//        if (product_id !== "") {
//            $('.bt-open-modal-product').prop('disabled', true);
//            $.ajax({
//                url: url,
//                dataType: "JSON",
//                method: "POST",
//                data: {
//                    product_id: product_id
//                },
//                success: function (res)
//                {
//                    if (res.error !== "") {
//                        $('#modal-error').modal('show', {backdrop: 'true'});
//                        $('#modal-error-massage').html(res.error);
//
//                        $(tag).val('');
//                        $('#product_name_' + number_ID).val('');
//                        $('#product_amount_' + number_ID).val('');
//                        $('#product_unit_' + number_ID).val('');
//                        $('#product_price_' + number_ID).val('');
//                        $('#product_save_' + number_ID).val('');
//                        $('#product_price_sum_' + number_ID).val('');
//
//                        $('#product_amount_' + number_ID).prop('readonly', true);
//                        $('#product_price_' + number_ID).prop('readonly', true);
//                        $('#product_save_' + number_ID).prop('readonly', true);
//                    } else {
//                        $(tag).val(res.product.product_id);
//                        $('#product_name_' + number_ID).val(res.product.product_name);
//                        $('#product_amount_' + number_ID).val(1);
//                        $('#product_unit_' + number_ID).val(res.product.product_unit);
//                        $('#product_price_' + number_ID).val(res.product.product_sale_price);
//                        $('#product_save_' + number_ID).val(0);
//                        $('#product_price_sum_' + number_ID).val(res.product.product_sale_price);
//
//                        $('#product_amount_' + number_ID).prop('readonly', false);
//                        $('#product_price_' + number_ID).prop('readonly', false);
//                        $('#product_save_' + number_ID).prop('readonly', false);
//                    }
//                    $('.bt-open-modal-product').prop('disabled', false);
//                    sum_price();
//                    $('#bt-submit').prop('disabled', false);
//                }
//            });
//        } else {
//            $(tag).val('');
//            $('#product_name_' + number_ID).val('');
//            $('#product_amount_' + number_ID).val('');
//            $('#product_unit_' + number_ID).val('');
//            $('#product_price_' + number_ID).val('');
//            $('#product_save_' + number_ID).val('');
//            $('#product_price_sum_' + number_ID).val('');
//
//            $('#product_amount_' + number_ID).prop('readonly', true);
//            $('#product_price_' + number_ID).prop('readonly', true);
//            $('#product_save_' + number_ID).prop('readonly', true);
//            $('#bt-submit').prop('disabled', false);
//        }
//        sum_price();
//    }

    function change_number(tag, number_ID) {
        if ($(tag).val() >= 0) {
            amount = parseInt($('#product_amount_' + number_ID).val());
            price = parseFloat($('#product_price_' + number_ID).val());
            save = parseFloat($('#product_save_' + number_ID).val());
            price_sum = (amount * price) - (save * amount);
            if (price_sum < 0) {
                $('#product_save_' + number_ID).val(0);
                save = parseFloat($('#product_save_' + number_ID).val());
                price_sum = (amount * price) - (save * amount);
                $('#modal-error').modal('show', {backdrop: 'true'});
                $('#modal-error-massage').html('ราคาสินค้ารวมไม่สามารถติดลบได้');
            }
            $('#product_price_sum_' + number_ID).val(price_sum);
            $(tag).val(parseInt($(tag).val()));
        } else {
            $(tag).val(0);
            amount = parseInt($('#product_amount_' + number_ID).val());
            price = parseFloat($('#product_price_' + number_ID).val());
            save = parseFloat($('#product_save_' + number_ID).val());
            price_sum = (amount * price) - (save * amount);
            if (price_sum < 0) {
                $('#product_save_' + number_ID).val(0);
                save = parseFloat($('#product_save_' + number_ID).val());
                price_sum = (amount * price) - (save * amount);
                $('#modal-error').modal('show', {backdrop: 'true'});
                $('#modal-error-massage').html('ราคาสินค้ารวมไม่สามารถติดลบได้');
            }

            $('#product_price_sum_' + number_ID).val(price_sum);
        }
        sum_price();
    }

//    function add_detail() {
//        html = "<tr id='tr_id_" + detail_index + "'>";
//        html += "<td class='text-right'>" + detail_index + "</td>";
//        html += "<td><input name='product_id[]' id='product_id_" + detail_index + "' type='text' class='form-control form-control-sm product_id' onkeypress='if (event.keyCode === 13) {get_product_by_id(this, " + detail_index + ");}' /></td>";
//        html += "<td><input name='product_name[]' id='product_name_" + detail_index + "' type='text' class='form-control form-control-sm' readonly='' /></td>";
//        html += "<td><input name='product_amount[]' id='product_amount_" + detail_index + "' type='number' onchange='change_number(this,  " + detail_index + ")' readonly='' class='form-control form-control-sm text-right' /></td>";
//        html += "<td><input name='product_unit[]' id='product_unit_" + detail_index + "' type='text' class='form-control form-control-sm text-right' readonly='' /></td>"
//        html += "<td><input name='product_price[]' id='product_price_" + detail_index + "' type='number' onchange='change_number(this, " + detail_index + ")' readonly='' class='form-control form-control-sm text-right' /></td>";
//        html += "<td><input name='product_save[]' id='product_save_" + detail_index + "' type='number' onchange='change_number(this, " + detail_index + ")' readonly='' class='form-control form-control-sm text-right' /></td>";
//        html += "<td><input name='product_price_sum[]' id='product_price_sum_" + detail_index + "' type='text' class='form-control form-control-sm text-right' readonly='' /></td>";
//        html += "<td class='text-left bg-white'><button type='button' class='bt-open-modal-product btn btn-link' onclick='delete_detail(" + detail_index + ");'><i class='fa fa-times'></i></button></td>";
//        html += "</tr>";
//        detail_index++;
//        $('#detail_tr').append(html);
//        $('#product_id_' + (detail_index - 1)).focus();
//    }

    function add_detail_from_modal(n, product_id_arr, product_name_arr, product_price_arr, product_unit_arr) {
        for (i = 0; i < n; i++) {
            $('#product_id_' + (detail_index - 1)).val(product_id_arr[i]);
            $('#product_name_' + (detail_index - 1)).val(product_name_arr[i]);
            $('#product_amount_' + (detail_index - 1)).val(1);
            $('#product_unit_' + (detail_index - 1)).val(product_unit_arr[i]);
            $('#product_price_' + (detail_index - 1)).val(product_price_arr[i]);
            $('#product_save_' + (detail_index - 1)).val(0);
            $('#product_price_sum_' + (detail_index - 1)).val(product_price_arr[i]);
            $('#product_amount_' + (detail_index - 1)).prop('readonly', false);
            $('#product_price_' + (detail_index - 1)).prop('readonly', false);
            $('#product_save_' + (detail_index - 1)).prop('readonly', false);
            add_detail();
        }
        sum_price();
    }

    function delete_detail(i) {
        $('#tr_id_' + i).html('');
        sum_price();
    }

    function select_transport_servic() {
        transport_service_id = $('#transport_service_id').val();
        if (transport_service_id == '99') {
            $('#transport_service_name').val('');
            $('#transport_service_name').prop('readonly', false);
        } else {
            transport_service_name = $("#transport_service_id option:selected").text();
            $('#transport_service_name').val(transport_service_name);
            $('#transport_service_name').prop('readonly', true);
        }
    }

    function add_product() {
        product_id_arr = [];
        product_name_arr = [];
        product_price_arr = [];
        product_unit_arr = [];
        i = 0;
        $('.product_id_modal').map(function () {
            if (this.value !== "") {
                product_id_arr[i++] = this.value;
            }
        });
        i = 0;
        $('.product_name_modal').map(function () {
            if (this.value !== "") {
                product_name_arr[i++] = this.value;
            }
        });
        i = 0;
        $('.product_price_modal').map(function () {
            if (this.value !== "") {
                product_price_arr[i++] = this.value;
            }
        });
        i = 0;
        $('.product_unit_modal').map(function () {
            if (this.value !== "") {
                product_unit_arr[i++] = this.value;
            }
        });
        $('#open-modal').modal('hide');
        if (product_id_arr.length > 0) {
            $('#bt-submit').prop('disabled', false);
        }
        add_detail_from_modal(product_id_arr.length, product_id_arr, product_name_arr, product_price_arr, product_unit_arr);
    }

    function check_save_format(input) {
        var text = $(input).val();
        var regex = /^([0-9\.]+)(%)$/;
        var regex_p = /^[0-9\.]{1,10}$/;
        if (regex.test(text) == false && regex_p.test(text) == false) {
            $(input).val('');
        }
        sum_price();
    }

    function sum_price() {

        type_tax_id = $('#type_tax_id').val();
        save_text = $('#save').val();
        save_arr = save_text.split("%");
        sum_price_product = 0;
        sum_price_product_all = 0;
        price_befor_tax = 0.00;
        price_tax = 0.00;
        price = 0.00;
        price_sum_pay = 0.00;
        transport_price = 0.00;
        $('input[name^="product_price_sum"]').each(function (i) {
            if ($(this).val() !== "") {
                sum_price_product += parseFloat($(this).val());
            }
        });
        sum_price_product_all = sum_price_product;
        if (save_arr.length > 1) {
            sum_price_product = sum_price_product - (parseFloat(save_arr[0] / 100 * sum_price_product));
        } else {
            if (save_text != "") {
                sum_price_product = sum_price_product - parseFloat(save_arr[0]);
            }
        }

        if (type_tax_id == '1') {
            price_befor_tax = sum_price_product;
            price = sum_price_product;
        } else if (type_tax_id == '2') {
            price_befor_tax = sum_price_product;
            price_tax = parseFloat((7 / 100 * sum_price_product)).toFixed(2);
            price = sum_price_product + parseFloat(price_tax);
        } else if (type_tax_id == '3') {
            price_befor_tax = parseFloat((sum_price_product / 1.07)).toFixed(2);
            price_tax = parseFloat(sum_price_product - parseFloat(price_befor_tax)).toFixed(2);
            price = sum_price_product;
        }

        if ($('#withholding_tax_checkbox').val() == 1) {
            withholding_tax = $('#withholding_tax').val();
            price_sum_pay = parseFloat(price - (withholding_tax / 100 * price)).toFixed(2);
        } else {
            price_sum_pay = price;
        }

        if ($('#transport_checkbox').val() == 1) {
            if ($('#transport_price').val() != "") {
                transport_price = parseFloat($('#transport_price').val());
            } else {
                transport_price = 0.00;
            }
            price_sum_pay = price_sum_pay + transport_price;
        }

        $('#price_product_sum').val(sum_price_product_all);
        $('#price_product_sum_text').html(sum_price_product_all);
        $('#price_befor_tax').val(price_befor_tax);
        $('#price_befor_tax_text').html(price_befor_tax);
        $('#price_tax').val(price_tax);
        $('#price_tax_text').html(price_tax);
        $('#price').val(parseFloat(price).toFixed(2));
        $('#price_text').html(parseFloat(price).toFixed(2));
        $('#transport_price_text').html(parseFloat(transport_price).toFixed(2));
        $('#price_sum_pay').val(parseFloat(price_sum_pay).toFixed(2));
        $('#price_sum_pay_text').html(parseFloat(price_sum_pay).toFixed(2));
    }

    function submit_receipt() {
        $('body').loading();
        opencheckbill();
        $('#form-receipt').submit();
    }

    function checkbill() {
        $('#modal-getmoney').modal('show', {backdrop: 'true'});
        $.ajax({
            url: service_base_url + 'selleasy/checkbill',
            method: "POST",
            data: $("#form-receipt").serialize(),
            success: function (res)
            {
                //console.log(res);
                price_sum_pay = $('#price_sum_pay').val();
                $('#paymoney').html(price_sum_pay);
                window.open(service_base_url + 'selleasy/showcheckbill/' + price_sum_pay + '/0/0', "checkbillWindow", "width=600,height=600");
            }
        });
    }
    function opencheckbill() {
        $.ajax({
            url: service_base_url + 'selleasy/deletecheckbill',
            success: function (res)
            {
                price_sum_pay = 0;
                window.open(service_base_url + 'selleasy/showcheckbill/' + price_sum_pay + '/0/0', "checkbillWindow", "width=600,height=600");
            }
        });
    }
    function changecheckbill() {
        
        if($("#getmoney").val() == ''){
            $("#getmoney").val('0');
        }
        $.ajax({
            url: service_base_url + 'selleasy/checkbill',
            method: "POST",
            data: $("#form-receipt").serialize(),
            success: function (res)
            {
                price_sum_pay = parseFloat($('#price_sum_pay').val()).toFixed(2);
                get_pay_money = parseFloat($('#getmoney').val()).toFixed(2);
                change_paymoney_text = parseFloat(get_pay_money) - parseFloat(price_sum_pay);

                $('#get_paymoney_text').html(get_pay_money);
                $('#get_pay_money').val($('#getmoney').val());

                $('#change_paymoney_text').html(parseFloat(change_paymoney_text).toFixed(2));
                $('#paymoney').html('');
                $('#modal-getmoney').modal('hide');

                window.open(service_base_url + 'selleasy/showcheckbill/' + price_sum_pay + '/' + get_pay_money + '/1', "checkbillWindow", "width=600,height=600");
            }
        });
    }
</script>