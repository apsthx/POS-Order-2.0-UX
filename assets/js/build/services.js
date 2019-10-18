var service_base_url = $('#service_base_url').val();

var CustomerList = [];

$.Thailand({
    database: service_base_url + 'assets/js/thailand-db/db.json',
    $district: $('#form-services [name="customer_district"]'),
    $amphoe: $('#form-services [name="customer_amphoe"]'),
    $province: $('#form-services [name="customer_province"]'),
    $zipcode: $('#form-services [name="customer_zipcode"]')
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

//ลูกค้า

function customer_add_modal() {
    url = service_base_url + 'services/customer_add_modal';
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
    $('#customer_group_name').val('');
    $('#customer_tel').val('');
    $('#customer_email').val('');
    $('#customer_address').val('');
    $('#customer_district').val('');
    $('#customer_amphoe').val('');
    $('#customer_province').val('');
    $('#customer_zipcode').val('');
    $('#customer_tax_id').val('');
    $('#customer_tax_shop').val('');
    $('#customer_tax_shop_sub').val('');
    $('#customer_tax_address').val('');
}

$(function () {
    get_custome_autocomplete();
    sum_price();
    $("#customer_name").autocomplete({
        source: CustomerList,
        minLength: 2,
        suggestions: CustomerList,
        select: function (event, ui) {
            select_customer_autocomplete(
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

function get_custome_autocomplete() {
    url = service_base_url + 'services/get_custome_autocomplete';
    $.ajax({
        url: url,
        dataType: 'JSON',
        success: function (res)
        {
            for (i = 0; i < res.length; i++) {
                if (res[i].fullname != null && res[i].fullname != "") {
                    CustomerList.push(
                            {
                                label: res[i].fullname,
                                customer_id: res[i].customer_id,
                                customer_group_name: res[i].customer_group_name,
                                customer_tel: res[i].tel,
                                customer_email: res[i].email,
                                customer_address: res[i].address,
                                
                                customer_district: res[i].district,
                                customer_amphoe: res[i].amphoe,
                                customer_province: res[i].province,
                                customer_zipcode: res[i].zipcode,
                                
                                customer_tax_id: res[i].tax_id,
                                customer_tax_shop: res[i].tax_shop,
                                customer_tax_shop_sub: res[i].tax_shop_sub,
                                customer_tax_address: res[i].tax_address,
                                customer_group_save: res[i].customer_group_save,
                                type_save_id: res[i].type_save_id
                            }
                    );
                }
            }
        }
    });
}

function select_customer_autocomplete(customer_id, customer_name, customer_group_name, customer_tel, customer_email, customer_address, customer_district, customer_amphoe, customer_province, customer_zipcode, customer_tax_id, customer_tax_shop, customer_tax_shop_sub, customer_tax_address, customer_group_save, type_save_id) {
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
    sum_price();
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

function check_save_format(input) {
    var text = $(input).val();
    var regex = /^([0-9\.]+)(%)$/;
    var regex_p = /^[0-9\.]{1,10}$/;
    if (regex.test(text) == false && regex_p.test(text) == false) {
        $(input).val('');
    }
    sum_price();
}

function check_email_format(input) {
    var text = $(input).val();
    var regex = /^(([a-zA-Z0-9_\-\.]+)@([a-zA-Z0-9_\-\.]+)\.([a-zA-Z]{2,5}){1,25})+([;.](([a-zA-Z0-9_\-\.]+)@{[a-zA-Z0-9_\-\.]+0\.([a-zA-Z]{2,5}){1,25})+)*$/;
    if (regex.test(text) == false) {
        $(input).val('');
    }
}

function check_phone_format(input) {
    var text = $(input).val();
    var regex = /^[0-9]{10}$/;
    if (regex.test(text) == false) {
        $(input).val('');
    }
}

function servicesday(tag) {
    var date = new Date($('#date_create').val());
    date.setDate(date.getDate() + parseInt($(tag).val()));
    var dd = date.getDate();
    var mm = date.getMonth() + 1;
    var yyyy = date.getFullYear();
    date = yyyy + '-' + mm + '-'+ dd;
    $('#services_day').val(date);
    if($(tag).val() != 0){
        $('#services_alertday_num').prop('readonly', false);
    }else{
        $('#services_alertday_num').prop('readonly', true);
    }
    servicesalertday();
}

function servicesalertday() {
    var date = new Date($('#services_day').val());
    date.setDate(date.getDate() - parseInt($('#services_alertday_num').val()));
    var dd = date.getDate();
    var mm = date.getMonth() + 1;
    var yyyy = date.getFullYear();
    date = yyyy + '-' + mm + '-'+ dd;
    $('#services_alertday').val(date);
}


//services
function services_modal() {
    services_id_arr = [];
    $('.services_id').map(function (i) {
        services_id_arr[i] = this.value;
    });
    url = service_base_url + 'services/services_modal';
    $('#open-modal').modal('show', {backdrop: 'true'});
    $('#open-modal .modal-content').html('<div style="text-align:center; padding:80px;"><i class="fa fa-refresh fa-spin fa-3x fa-fw"></i></div>');
    $.ajax({
        url: url,
        method: 'post',
        data: {
            services_id_arr: services_id_arr
        },
        success: function (res)
        {
            $('#open-modal .modal-content').html(res);
        }
    });
}

function add_services() {
    services_id_arr = [];
    services_name_arr = [];
    services_cost_arr = [];
    i = 0;
    $('.services_id_modal').map(function () {
        if (this.value !== "") {
            services_id_arr[i++] = this.value;
        }
    });
    i = 0;
    $('.services_name_modal').map(function () {
        if (this.value !== "") {
            services_name_arr[i++] = this.value;
        }
    });
    i = 0;
    $('.services_cost_modal').map(function () {
        if (this.value !== "") {
            services_cost_arr[i++] = this.value;
        }
    });
    $('#open-modal').modal('hide');
    add_detail_from_modal(services_id_arr.length, services_id_arr, services_name_arr, services_cost_arr);
}

function add_detail_from_modal(n, services_id_arr, services_name_arr, services_cost_arr) {
    for (i = 0; i < n; i++) {
        $('#services_id_' + (detail_index - 1)).val(services_id_arr[i]);
        $('#services_name_' + (detail_index - 1)).val(services_name_arr[i]);
        $('#services_amount_' + (detail_index - 1)).val(1);
        $('#services_cost_' + (detail_index - 1)).val(services_cost_arr[i]);
        $('#services_save_' + (detail_index - 1)).val(0);
        $('#services_price_sum_' + (detail_index - 1)).val(services_cost_arr[i]);

        $('#services_amount_' + (detail_index - 1)).prop('readonly', false);
        $('#services_price_' + (detail_index - 1)).prop('readonly', false);
        $('#services_save_' + (detail_index - 1)).prop('readonly', false);

        $('#add_services_detail_' + (detail_index - 1)).show();

        add_detail();
    }
    sum_price();
}

function add_detail() {
    html = "<tr id='tr_id_" + detail_index + "'>";
    html += "<td class='text-right'>" + detail_index + "</td>";
    html += "<input name='services_id[]' id='services_id_" + detail_index + "' type='hidden' class='form-control form-control-sm services_id' />";
    html += "<td><input name='services_name[]' id='services_name_" + detail_index + "' type='text' class='form-control form-control-sm' readonly='' /></td>";
    html += "<td><input name='services_detail_number[]' id='services_detail_number_" + detail_index + "' type='text' class='form-control form-control-sm' readonly='' style='display: none;' /></td>";
    html += "<td><input name='services_amount[]' id='services_amount_" + detail_index + "' type='number' onchange='change_number(this,  " + detail_index + ")' readonly='' class='form-control form-control-sm text-right' /></td>";
    html += "<td><input name='services_cost[]' id='services_cost_" + detail_index + "' type='number' onchange='change_number(this, " + detail_index + ")' readonly='' class='form-control form-control-sm text-right' /></td>";
    html += "<td><input name='services_save[]' id='services_save_" + detail_index + "' type='number' onchange='change_number(this, " + detail_index + ")' readonly='' class='form-control form-control-sm text-right' /></td>";
    html += "<td><input name='services_price_sum[]' id='services_price_sum_" + detail_index + "' type='text' class='form-control form-control-sm text-right' readonly='' /></td>";
    html += "<td class='text-left bg-white'><button type='button' id='add_services_detail_" + detail_index + "' class='btn btn-link' onclick='add_services_detail(" + detail_index + ");' style='display: none;'><i class='fa fa-plus-square'> เพิ่มรายละเอียด</i><button type='button' class='btn btn-link' onclick='delete_detail(" + detail_index + ");' style='margin-left: 1px;'><i class='fa fa-times'> </i></button></td>";
    html += "</tr>";
    detail_index++;
    $('#detail_tr').append(html);
}

function add_services_detail(detail) {
//    console.log(detail);
//    console.log($('#services_id_' + detail).val());
//    console.log($('#services_name_' + detail).val());
    $('#services_id_' + (detail_index - 1)).val($('#services_id_' + detail).val());
    $('#services_name_' + (detail_index - 1)).val();
    $('#services_detail_number_' + (detail_index - 1)).val('#' + detail);
    $('#services_amount_' + (detail_index - 1)).val('');
    $('#services_cost_' + (detail_index - 1)).val('');
    $('#services_save_' + (detail_index - 1)).val('');
    $('#services_price_sum_' + (detail_index - 1)).val(0);

    $('#services_name_' + (detail_index - 1)).prop('readonly', false);
    $('#services_detail_number_' + (detail_index - 1)).show();
    $('#services_amount_' + (detail_index - 1)).hide();
    $('#services_cost_' + (detail_index - 1)).hide();
    $('#services_save_' + (detail_index - 1)).hide();
    $('#services_price_sum_' + (detail_index - 1)).hide();

    add_detail();
}

function delete_detail(i) {
    $('#tr_id_' + i).html('');
    sum_price();
}

function change_number(tag, number_ID) {
    if ($(tag).val() >= 0) {
        amount = parseInt($('#services_amount_' + number_ID).val());
        price = parseFloat($('#services_cost_' + number_ID).val());
        save = parseFloat($('#services_save_' + number_ID).val());

        price_sum = (amount * price) - (save * amount);

        if (price_sum < 0) {
            $('#services_save_' + number_ID).val(0);
            save = parseFloat($('#services_save_' + number_ID).val());
            price_sum = (amount * price) - (save * amount);

            $('#modal-error').modal('show', {backdrop: 'true'});
            $('#modal-error-massage').html('ราคาสินค้ารวมไม่สามารถติดลบได้');
        }
        $('#services_price_sum_' + number_ID).val(price_sum);
        $(tag).val(parseInt($(tag).val()));
    } else {
        $(tag).val(0);

        amount = parseInt($('#services_amount_' + number_ID).val());
        price = parseFloat($('#services_cost_' + number_ID).val());
        save = parseFloat($('#services_save_' + number_ID).val());

        price_sum = (amount * price) - (save * amount);

        if (price_sum < 0) {
            $('#services_save_' + number_ID).val(0);
            save = parseFloat($('#services_save_' + number_ID).val());
            price_sum = (amount * price) - (save * amount);

            $('#modal-error').modal('show', {backdrop: 'true'});
            $('#modal-error-massage').html('ราคาสินค้ารวมไม่สามารถติดลบได้');
        }

        $('#services_price_sum_' + number_ID).val(price_sum);
    }
    sum_price();
}


function sum_price() {

    type_tax_id = $('#type_tax_id').val();
    save_text = $('#save').val();

    save_arr = save_text.split("%");

    sum_price_services = 0;
    sum_price_services_all = 0;

    price_befor_tax = 0.00;
    price_tax = 0.00;
    price = 0.00;
    price_sum_pay = 0.00;

    $('#bt-submit').prop('disabled', true);
    $('input[name^="services_price_sum"]').each(function (i) {
        if ($(this).val() !== "") {
            sum_price_services += parseFloat($(this).val());
            $('#bt-submit').prop('disabled', false);
        }
    });
    sum_price_services_all = sum_price_services;
    if (save_arr.length > 1) {
        sum_price_services = sum_price_services - (parseFloat(save_arr[0] / 100 * sum_price_services));
    } else {
        if (save_text != "") {
            sum_price_services = sum_price_services - parseFloat(save_arr[0]);
        }
    }

    if (type_tax_id == '1') {
        price_befor_tax = sum_price_services;
        price = sum_price_services;
    } else if (type_tax_id == '2') {
        price_befor_tax = sum_price_services;
        price_tax = parseFloat((7 / 100 * sum_price_services)).toFixed(2);
        price = sum_price_services + parseFloat(price_tax);
    } else if (type_tax_id == '3') {
        price_befor_tax = parseFloat((sum_price_services / 1.07)).toFixed(2);
        price_tax = parseFloat(sum_price_services - parseFloat(price_befor_tax)).toFixed(2);
        price = sum_price_services;
    }

//    if ($('#transport_price').val() != "") {
//        price = price + parseFloat($('#transport_price').val());
//    }

    if ($('#withholding_tax_checkbox').val() == 1) {
        withholding_tax = $('#withholding_tax').val();
        price_sum_pay = parseFloat(price - (withholding_tax / 100 * price)).toFixed(2);
    } else {
        price_sum_pay = price;
    }

    $('#price_services_sum').val(sum_price_services_all);
    $('#price_services_sum_text').html(sum_price_services_all);
    $('#price_befor_tax').val(price_befor_tax);
    $('#price_befor_tax_text').html(price_befor_tax);
    $('#price_tax').val(price_tax);
    $('#price_tax_text').html(price_tax);
    $('#price').val(parseFloat(price).toFixed(2));
    $('#price_text').html(parseFloat(price).toFixed(2));
    $('#price_sum_pay').val(parseFloat(price_sum_pay).toFixed(2));
    $('#price_sum_pay_text').html(parseFloat(price_sum_pay).toFixed(2));

}

function submit_services() {

    ck = 1;
    customer_tel = $('#customer_tel').val();
    var regex = /^[0-9]{10}$/;
    if (regex.test(customer_tel) == false) {
        ck = 2;
        $('#customer_tel').val('');
    }

    if ($('#customer_id').val() == "") {
        ck = 2;
    } else if ($('#customer_name').val() == "") {
        ck = 2;
    } else if ($('#customer_tel').val() == "") {
        ck = 2;
    }
    if ($('#basic_checkbox').val() == 1) {
        if ($('#customer_tax_id').val() == "") {
            ck = 2;
        } else if ($('#customer_tax_shop').val() == "") {
            ck = 2;
        } else if ($('#customer_tax_shop_sub').val() == "") {
            ck = 2;
        } else if ($('#customer_tax_address').val() == "") {
            ck = 2;
        }
    }
    if (ck == 1) {
        $('body').loading();
        $('#form-services').submit();
    } else {
        $('#modal-error').modal('show', {backdrop: 'true'});
        $('#modal-error-massage').html('กรอกข้อมูลไม่ครบ');
    }

}