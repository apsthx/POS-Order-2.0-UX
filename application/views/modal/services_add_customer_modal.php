
<div class="modal-header">
    <h4 class="modal-title"><i class="fa fa-clipboard"></i>&nbsp;ลูกค้า</h4>
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
</div>
<div class="modal-body">

    <label id="customer_id_massage" class="col-sm-5 text-right" style="color: red;"></label> 
    <label id="fullname_massage" class="col-sm-6 text-right" style="color: red;"></label> 
    <div class="form-group row">
        <label class="col-sm-2 text-right control-label col-form-label"> รหัสลูกค้า : <span class="text-danger">*</span></label>
        <div class="col-sm-3">
            <?php
            $document = $this->accesscontrol->get_document_setting();
            $run_number = $document->customer_number_default;
            $number_id = $document->customer_id_default . $run_number;
            ?>
            <input type="text" id="customer_id_add" value="<?php echo $number_id; ?>" disabled="" class="form-control" required="">
        </div>
        <label class="col-sm-2 text-right control-label col-form-label"> ชื่อลูกค้า : <span class="text-danger">*</span></label>
        <div class="col-sm-4">
            <input type="text" id="fullname_add" class="form-control" data-parsley-error-message="กรุณากรอกข้อมูล" required="">
        </div>
    </div>
    <div class="form-group row">
        <label class="col-sm-2 text-right control-label col-form-label"> เบอร์โทร : </label>
        <div class="col-sm-3">
            <input type="text" id="tel_add" onblur="check_phone_format(this);" class="form-control" >
        </div>
        <label class="col-sm-2 text-right control-label col-form-label"> อีเมล : </label>
        <div class="col-sm-4">
            <input type="text" id="email_add" onblur="check_email_format(this);" class="form-control" >
        </div>
    </div>   
    <div class="form-group row">
        <label class="col-sm-2 text-right control-label col-form-label"> ที่อยู่ : </label>
        <div class="col-sm-9">
            <textarea id="address_add" class="form-control" rows="2"></textarea>
        </div>
    </div>  
    <div class="form-group row">
        <label class="col-sm-2 text-right control-label col-form-label"> ตำบล : </label>
        <div class="col-sm-3">
            <input type="text" id="district_add" class="form-control" >
        </div>
        <label class="col-sm-2 text-right control-label col-form-label"> อำเภอ : </label>
        <div class="col-sm-4">
            <input type="text" id="amphoe_add" class="form-control" >
        </div>
    </div> 
    <div class="form-group row">
        <label class="col-sm-2 text-right control-label col-form-label"> จังหวัด : </label>
        <div class="col-sm-3">
            <input type="text" id="province_add" class="form-control" >
        </div>
        <label class="col-sm-2 text-right control-label col-form-label"> รหัสไปรษณีย์ : </label>
        <div class="col-sm-4">
            <input type="text" id="zipcode_add" class="form-control" >
        </div>
    </div>
    <div class="form-group row">
        <label class="col-sm-2 text-right control-label col-form-label"><i class="mdi mdi-facebook-box"></i></label>
        <div class="col-sm-3">
            <input type="text" id="facebook_add" class="form-control" >
        </div>
        <label class="col-sm-2 text-right control-label col-form-label">LINE</label>
        <div class="col-sm-4">
            <input type="text" id="line_add" class="form-control" >
        </div>
    </div> 
    <div class="form-group row">
        <label class="col-sm-2 text-right control-label col-form-label"><i class="fa fa-instagram"></i></label>
        <div class="col-sm-3">
            <input type="text" id="instagram_add" class="form-control" >
        </div>
        <div class="col-sm-5 offset-sm-1" style="padding-top: 6px">
            <input type="checkbox" class="col-sm-4 offset-sm-2" name="" id="customer_add_checkbox" value="0" onclick="open_vat_add_customer(this);" >
            <label for="customer_add_checkbox"> กำหนดเลขผู้เสียภาษี, บริษัท, สาขา, ที่อยู่</label>
        </div>  
    </div>   
    <div id="vat-group-add" style="display: none;">
        <div class="form-group row">
            <label class="col-sm-2 text-right control-label col-form-label"> เลขผู้เสียภาษี : </label>
            <div class="col-sm-9">
                <input type="text" id="tax_id_add" class="form-control">
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 text-right control-label col-form-label"> บริษัท : </label>
            <div class="col-sm-4">
                <input type="text" id="tax_shop_add"  class="form-control">
            </div>
            <label class="col-sm-2 text-right control-label col-form-label"> สาขา : </label>
            <div class="col-sm-3">
                <input type="text" id="tax_shop_sub_add"  class="form-control">
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 text-right control-label col-form-label"> ที่อยู่ : </label>
            <div class="col-sm-9">
                <textarea id="tax_address_add" class="form-control" rows="2"></textarea>
            </div>
        </div>
    </div> 
    <div class="form-group row">
        <label class="col-sm-2 text-right control-label col-form-label"> กลุ่มลูกค้า : </label>
        <div class="col-sm-6">
            <select id="customer_group_id_add" class="form-control">
                <?php foreach ($this->services_model->get_groupcustomer()->result() as $data) { ?>
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
            <button type="button" id="bt-submit-customer" onclick="add_customer_submit();" class="btn btn-outline-info"><i class="fa fa-save"></i>&nbsp;บันทึก</button>
            &nbsp;
            <button type="button" class="btn btn-outline-danger" data-dismiss="modal" aria-hidden="true" ><i class="fa fa-close"></i>&nbsp;ยกเลิก</button>
        </div>
    </div>
</div>

<script>

    $.Thailand({
        database: service_base_url + 'assets/js/thailand-db/db.json',
        $district: $('#district_add'),
        $amphoe: $('#amphoe_add'),
        $province: $('#province_add'),
        $zipcode: $('#zipcode_add')
    });


    $(function () {
        $("#fullname_add").autocomplete({
            source: CustomerList,
            minLength: 2,
            suggestions: CustomerList,
            select: function (event, ui) {
                select_customer_modal_from_add(
                        ui.item.customer_id,
                        ui.item.label,
                        ui.item.customer_group_name,
                        ui.item.customer_tel,
                        ui.item.customer_email,
                        ui.item.customer_address,
                        ui.item.customer_district,
                        ui.item.customer_amphoe,
                        ui.item.customer_province,
                        ui.item.customer_zipcode,
                        ui.item.customer_tax_id,
                        ui.item.customer_tax_shop,
                        ui.item.customer_tax_shop_sub,
                        ui.item.customer_tax_address,
                        ui.item.customer_group_save,
                        ui.item.type_save_id);
            }
        });
    });

    function select_customer_modal_from_add(customer_id, customer_name, customer_group_name, customer_tel, customer_email, customer_address, customer_district, customer_amphoe, customer_province, customer_zipcode, customer_tax_id, customer_tax_shop, customer_tax_shop_sub, customer_tax_address, customer_group_save, type_save_id) {
        $('#customer_id').val(customer_id);
        $('#customer_name').val(customer_name);
        $('#customer_group_name').val(customer_group_name);
        $('#customer_tel').val(customer_tel);
        $('#customer_email').val(customer_email);
        $('#customer_address').val(customer_address);

        $('#customer_district').val(customer_district);
        $('#customer_amphoe').val(customer_amphoe);
        $('#customer_province').val(customer_province);
        $('#customer_zipcode').val(customer_zipcode);

        $('#customer_tax_id').val(customer_tax_id);
        $('#customer_tax_shop').val(customer_tax_shop);
        $('#customer_tax_shop_sub').val(customer_tax_shop_sub);
        $('#customer_tax_address').val(customer_tax_address);

        if (type_save_id == 1) {
            save_txt = customer_group_save + '%';
        } else {
            save_txt = customer_group_save;
        }

        $('#save').val(save_txt);

        $('#open-modal').modal('hide');
        sum_price();
    }

    function add_customer_submit() {
        var tax_id = '';
        var tax_shop = '';
        var tax_shop_sub = '';
        var tax_address = '';
        var customer_id = $('#customer_id_add').val();
        var fullname = $('#fullname_add').val();
        var tel = $('#tel_add').val();
        var email = $('#email_add').val();
        var address = $('#address_add').val();

        var district = $('#district_add').val();
        var amphoe = $('#amphoe_add').val();
        var province = $('#province_add').val();
        var zipcode = $('#zipcode_add').val();


        var facebook = $('#facebook_add').val();
        var line = $('#line_add').val();
        var instagram = $('#instagram_add').val();
        if ($('#customer_add_checkbox').val() == '1') {
            tax_id = $('#tax_id_add').val();
            tax_shop = $('#tax_shop_add').val();
            tax_shop_sub = $('#tax_shop_sub_add').val();
            tax_address = $('#tax_address_add').val();
        }
        var customer_group_id = $('#customer_group_id_add').val();
        var customer_group_name = $('#customer_group_id_add option:selected').text();

        if (fullname != "") {

            $('#bt-submit-customer').prop('disabled', true);
            var url = service_base_url + 'customer/add';
            $.ajax({
                url: url,
                method: "POST",
                data: {
                    customer_id: customer_id,
                    fullname: fullname,
                    tel: tel,
                    email: email,
                    address: address,
                    district: district,
                    amphoe: amphoe,
                    province: province,
                    zipcode: zipcode,
                    facebook: facebook,
                    line: line,
                    instagram: instagram,
                    tax_id: tax_id,
                    tax_shop: tax_shop,
                    tax_shop_sub: tax_shop_sub,
                    tax_address: tax_address,
                    customer_group_id: customer_group_id
                },
                success: function ()
                {
                    var url_cat = service_base_url + 'services/get_customer_group_json';
                    $.ajax({
                        url: url_cat,
                        dataType: "JSON",
                        method: "POST",
                        data: {
                            customer_group_id: customer_group_id
                        },
                        success: function (res)
                        {
                            var customer_group_save = res.customer_group_save;
                            if (res.type_save_id == '1') {
                                customer_group_save += '%';
                            }
                            select_customer_modal_from_add(customer_id, fullname, customer_group_name, tel, email, address, district, amphoe, province, zipcode, tax_id, tax_shop, tax_shop_sub, tax_address, customer_group_save, customer_group_id)
                            //$('#open-modal').modal('hide');
                        }
                    });
                }
            });
        } else {
            $('#fullname_add').css('border', 'solid #f80400 1px');
        }
    }

    function check_id() {
        $('#bt-submit-customer').prop('disabled', true);
        url = service_base_url + 'customer/check_id';
        if ($('#customer_id_add').val() != '') {
            $.ajax({
                url: url,
                method: "POST",
                data: {
                    customer_id: $('#customer_id_add').val(),
                },
                success: function (res)
                {
                    if (res == 1) {
                        $('#customer_id_massage').html('รหัสนี้มีการใช้งานแล้ว');
                        $('#customer_id_add').val("")
                    } else {
                        $('#customer_id_massage').html('');
                    }
                    $('#bt-submit-customer').prop('disabled', false);
                }
            });
        }
    }

    function open_vat_add_customer(bt_vat) {
        vat = $(bt_vat);
        if (vat.val() == 0) {
            $('#vat-group-add').css('opacity', 0)
                    .slideDown('fast')
                    .animate(
                            {opacity: 1},
                    {queue: false, duration: 'slow'}
                    );
            vat.val(1);
            $('#tax_id_add').prop('required', true);
            $('#tax_shop_add').prop('required', true);
            $('#tax_shop_sub_add').prop('required', true);
            $('#tax_address_add').prop('required', true);
        } else {
            $('#vat-group-add')
                    .slideUp('fast')
                    .animate(
                            {opacity: 0},
                    {queue: false, duration: 'slow'}
                    );
            vat.val(0);
            $('#tax_id_add').prop('required', false);
            $('#tax_shop_add').prop('required', false);
            $('#tax_shop_sub_add').prop('required', false);
            $('#tax_address_add').prop('required', false);
        }
    }
</script>