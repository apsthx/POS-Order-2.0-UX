var service_base_url = $('#service_base_url').val();
var detail_index = 2;

$(function () {
    select_transport_servic();
    sum_price();
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

function change_check_box(tag) {
    var sms = $(tag);
    if (sms.val() == 0) {
        sms.val(1);
    } else {
        sms.val(0);
    }
}

function open_vat(bt_vat) {
    var vat = $(bt_vat);
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
    var withholding = $(bt_vat);
    if (withholding.val() == 0) {
        $('#withholding-tax-group').css('opacity', 0)
                .slideDown('fast')
                .animate(
                        {opacity: 1},
                        {queue: false, duration: 'slow'}
                );
        withholding.val(1);
    } else {
        $('#withholding-tax-group')
                .slideUp('fast')
                .animate(
                        {opacity: 0},
                        {queue: false, duration: 'slow'}
                );
        withholding.val(0);
    }
    sum_price();
}

function open_transport(bt_vat) {
    var transport = $(bt_vat);
    if (transport.val() == 0) {
        $('#transport-group').css('opacity', 0)
                .slideDown('fast')
                .animate(
                        {opacity: 1},
                        {queue: false, duration: 'slow'}
                );
        transport.val(1);
        $('#price_transport_show').show();
        $('#transport_send_name').prop('required', true);
        $('#transport_send_tel').prop('required', true);
        $('#transport_send_address').prop('required', true);
        $('#transport_price').prop('required', true);
        $('#transport_customer').prop('required', true);
        $('#transport_customer_tel').prop('required', true);
        $('#transport_customer_address').prop('required', true);
    } else {
        $('#transport-group')
                .slideUp('fast')
                .animate(
                        {opacity: 0},
                        {queue: false, duration: 'slow'}
                );
        transport.val(0);
        $('#price_transport_show').hide();
        $('#transport_send_name').prop('required', false);
        $('#transport_send_tel').prop('required', false);
        $('#transport_send_address').prop('required', false);
        $('#transport_price').prop('required', false);
        $('#transport_customer').prop('required', false);
        $('#transport_customer_tel').prop('required', false);
        $('#transport_customer_address').prop('required', false);
    }
    sum_price();
}

function getAutocomplete(textbox) {
    $(textbox).autocomplete({
        source: service_base_url + 'invoice/get_product_autocomplete',
        minLength: 1,
        select: function (event, ui) {
//            alert(ui.item.id);
//            $(textbox).val(ui.item.id);
        }
    });
}

function customer_modal() {
    url = service_base_url + 'invoice/customer_modal';
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
    $('#transport_customer_tel').val('');
    $('#transport_customer_address').val('');
}

function product_modal() {
    product_id_arr = [];
    $('.product_id').map(function (i) {
        product_id_arr[i] = this.value;
    });
    url = service_base_url + 'invoice/product_modal';
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

function get_product_by_id(tag, number_ID) {
    product_id = $(tag).val();
    url = service_base_url + 'invoice/get_product_by_id';
    if (product_id !== "") {
        $('.bt-open-modal-product').prop('disabled', true);
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

                    $(tag).val('');
                    $('#product_name_' + number_ID).val('');
                    $('#product_amount_' + number_ID).val('');
                    $('#product_unit_' + number_ID).val('');
                    $('#product_price_' + number_ID).val('');
                    $('#product_save_' + number_ID).val('');
                    $('#product_price_sum_' + number_ID).val('');

                    $('#product_amount_' + number_ID).prop('readonly', true);
                    $('#product_price_' + number_ID).prop('readonly', true);
                    $('#product_save_' + number_ID).prop('readonly', true);
                } else {
                    $(tag).val(res.product.product_id);
                    $('#product_name_' + number_ID).val(res.product.product_name);
                    $('#product_amount_' + number_ID).val(1);
                    $('#product_unit_' + number_ID).val(res.product.product_unit);
                    $('#product_price_' + number_ID).val(res.product.product_sale_price);
                    $('#product_save_' + number_ID).val(0);
                    $('#product_price_sum_' + number_ID).val(res.product.product_sale_price);

                    $('#product_amount_' + number_ID).prop('readonly', false);
                    $('#product_price_' + number_ID).prop('readonly', false);
                    $('#product_save_' + number_ID).prop('readonly', false);
                }
                $('.bt-open-modal-product').prop('disabled', false);
                sum_price();
            }
        });
    } else {
        $(tag).val('');
        $('#product_name_' + number_ID).val('');
        $('#product_amount_' + number_ID).val('');
        $('#product_unit_' + number_ID).val('');
        $('#product_price_' + number_ID).val('');
        $('#product_save_' + number_ID).val('');
        $('#product_price_sum_' + number_ID).val('');

        $('#product_amount_' + number_ID).prop('readonly', true);
        $('#product_price_' + number_ID).prop('readonly', true);
        $('#product_save_' + number_ID).prop('readonly', true);
    }
    sum_price();
}

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

function add_detail() {
    html = "<tr id='tr_id_" + detail_index + "'>";
    html += "<td class='text-right'>" + detail_index + "</td>";
    html += "<td><input name='product_id[]' id='product_id_" + detail_index + "' onchange='get_product_by_id(this, " + detail_index + ")' type='text' class='form-control form-control-sm product_id' /></td>";
    html += "<td><input name='product_name[]' id='product_name_" + detail_index + "' type='text' class='form-control form-control-sm' readonly='' /></td>";
    html += "<td><input name='product_amount[]' id='product_amount_" + detail_index + "' type='number' onchange='change_number(this,  " + detail_index + ")' readonly='' class='form-control form-control-sm text-right' /></td>";
    html += "<td><input name='product_unit[]' id='product_unit_" + detail_index + "' type='text' class='form-control form-control-sm text-right' readonly='' /></td>"
    html += "<td><input name='product_price[]' id='product_price_" + detail_index + "' type='number' onchange='change_number(this, " + detail_index + ")' readonly='' class='form-control form-control-sm text-right' /></td>";
    html += "<td><input name='product_save[]' id='product_save_" + detail_index + "' type='number' onchange='change_number(this, " + detail_index + ")' readonly='' class='form-control form-control-sm text-right' /></td>";
    html += "<td><input name='product_price_sum[]' id='product_price_sum_" + detail_index + "' type='text' class='form-control form-control-sm text-right' readonly='' /></td>";
    html += "<td class='text-left bg-white'><button type='button' class='bt-open-modal-product btn btn-link' onclick='delete_detail(" + detail_index + ");'><i class='fa fa-times'></i></button></td>";
    html += "</tr>";
    detail_index++;
    $('#detail_tr').append(html);
}

function add_detail_from_modal(n, product_id_arr, product_name_arr, product_price_arr, product_unit_arr) {
    for (i = 0; i < n; i++) {
        html = "<tr id='tr_id_" + detail_index + "'>";
        html += "<td class='text-right'>" + detail_index + "</td>";
        html += "<td><input name='product_id[]' id='product_id_" + detail_index + "' onchange='get_product_by_id(this, " + detail_index + ")' value='" + product_id_arr[i] + "' type='text' class='form-control form-control-sm product_id' /></td>";
        html += "<td><input name='product_name[]' id='product_name_" + detail_index + "' value='" + product_name_arr[i] + "' type='text' class='form-control form-control-sm' readonly='' /></td>";
        html += "<td><input name='product_amount[]' id='product_amount_" + detail_index + "' value='1' type='number' onchange='change_number(this,  " + detail_index + ")' class='form-control form-control-sm text-right' /></td>";
        html += "<td><input name='product_unit[]' id='product_unit_" + detail_index + "' value='" + product_unit_arr[i] + "' type='text' class='form-control form-control-sm text-right' readonly='' /></td>"
        html += "<td><input name='product_price[]' id='product_price_" + detail_index + "' value='" + product_price_arr[i] + "' type='number' onchange='change_number(this, " + detail_index + ")' class='form-control form-control-sm text-right' /></td>";
        html += "<td><input name='product_save[]' id='product_save_" + detail_index + "' value='0' type='number' onchange='change_number(this, " + detail_index + ")' class='form-control form-control-sm text-right' /></td>";
        html += "<td><input name='product_price_sum[]' id='product_price_sum_" + detail_index + "' value='" + product_price_arr[i] + "' type='text' class='form-control form-control-sm text-right' readonly='' /></td>";
        html += "<td class='text-left bg-white'><button type='button' class='bt-open-modal-product btn btn-link' onclick='delete_detail(" + detail_index + ");'><i class='fa fa-times'></i></button></td>";
        html += "</tr>";
        detail_index++;
        $('#detail_tr').append(html);
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

    $('#bt-submit').prop('disabled', true);
    $('input[name^="product_price_sum"]').each(function (i) {
        if ($(this).val() !== "") {
            sum_price_product += parseFloat($(this).val());
            $('#bt-submit').prop('disabled', false);
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
        price_befor_tax = parseFloat((sum_price_product/1.07)).toFixed(2);
        price_tax = parseFloat(sum_price_product - parseFloat(price_befor_tax)).toFixed(2);
        price = sum_price_product;
    }

    if ($('#transport_price').val() != "") {
        price = price + parseFloat($('#transport_price').val());
    }

    if ($('#withholding_tax_checkbox').val() == 1) {
        withholding_tax = $('#withholding_tax').val();
        price_sum_pay = parseFloat(price - (withholding_tax / 100 * price)).toFixed(2);
    } else {
        price_sum_pay = price;
    }

    $('#price_product_sum').val(sum_price_product_all);
    $('#price_product_sum_text').html(sum_price_product_all);
    $('#price_befor_tax').val(price_befor_tax);
    $('#price_befor_tax_text').html(price_befor_tax);
    $('#price_tax').val(price_tax);
    $('#price_tax_text').html(price_tax);
    $('#price').val(parseFloat(price).toFixed(2));
    $('#price_text').html(parseFloat(price).toFixed(2));
    $('#price_sum_pay').val(parseFloat(price_sum_pay).toFixed(2));
    $('#price_sum_pay_text').html(parseFloat(price_sum_pay).toFixed(2));

}

function check_phone_format(input) {
    var text = $(input).val();
    var regex = /^[0-9\+\-]{8,15}$/;
    if (regex.test(text) == false) {
        $(input).val('');
    }
}

function submit_receipt() {
    $('body').loading();
    $('#form-receipt').submit();
}