var service_base_url = $('#service_base_url').val();
$(function () {
//    $(window).focus(function () {
//        ajax();
//    });
    $('#form-add').parsley();
});
function modaladd() {
    $('#add').modal('show', {backdrop: 'true'});
}

function check_stock_id(tag, stock_id_default) {
    stock_id = $(tag).val();
    $('#bt-submit').prop('disabled', true);
    url = service_base_url + 'stock/check_stock_id';
    if (stock_id !== stock_id_default) {
        $.ajax({
            url: url,
            method: "POST",
            data: {
                stock_id: stock_id
            },
            success: function (res)
            {
                if (res == '1') {
                    //ซ้ำ
                    $(tag).val('');
                    $('#stock_id_massage').html('รหัสนี้มีการใช้งานแล้ว');
                } else {
                    $('#stock_id_massage').html('');
                }
                $('#bt-submit').prop('disabled', false);
            }
        });
    }
}

function add_product_modal(stock_id) {
    url = service_base_url + 'stock/add_product_modal';
    $('#open-modal').modal('show', {backdrop: 'true'});
    $('#open-modal .modal-content').html('<div style="text-align:center; padding:80px;"><i class="fa fa-refresh fa-spin fa-3x fa-fw"></i></div>');
    $.ajax({
        url: url,
        method: "POST",
        data: {
            stock_id: stock_id
        },
        success: function (res)
        {
            $('#open-modal .modal-content').html(res);
        }
    });
}

function edit_modal(id) {
    url = service_base_url + 'stock/edit_modal';
    $('#open-modal').modal('show', {backdrop: 'true'});
    $('#open-modal .modal-content').html('<div style="text-align:center; padding:80px;"><i class="fa fa-refresh fa-spin fa-3x fa-fw"></i></div>');
    $.ajax({
        url: url,
        method: "POST",
        data: {
            id: id
        },
        success: function (res)
        {
            $('#open-modal .modal-content').html(res);
        }
    });
}

function modal_delete(id) {
    url = service_base_url + 'stock/checkdelete';
    $.ajax({
        url: url,
        method: 'POST',
        data: {
            id: id
        },
        success: function (flag)
        {
            if (flag == '1') {
                $('#delete_id').val(id);
                $('#modal-delete').modal('show', {backdrop: 'true'});
            } else {
                $('#modal-delete-no').modal('show', {backdrop: 'true'});
            }
        }
    });
}

function modal_delete_product(id) {
    $('#delete_id').val(id);
    $('#modal-delete').modal('show', {backdrop: 'true'});
}

function delete_product() {
    var delete_id = $('#delete_id').val();
    $('#modal-delete').modal('hide');
    $('body').loading();
    url = service_base_url + 'stock/delete_product';
    $.ajax({
        url: url,
        method: "POST",
        data: {
            map_product_stock_id: delete_id
        },
        success: function ()
        {
            ajax();
        }
    });
    return false;
}


function change_amounnt_product(product_id_pri, amount_can_add_p, map_product_amount_p, tag) {
    var stock_id_pri = $('#stock_id_pri').val();
    var value_add_txt = $(tag).val();
    var amount_can_add = parseInt(amount_can_add_p);
    var map_product_amount = parseInt(map_product_amount_p);
    if (value_add_txt !== "") {
        var value_add = parseInt(value_add_txt);
        if (value_add > amount_can_add) {
            $('#modal-alert').modal('show', {backdrop: 'true'});
            $('#massage-alert').html('ไม่สามารถเพิ่มจำนวนสินค้าในคลังได้ <br/> เนื่องจากจำนวนสินค้าที่กำหนดมีมากกว่าจำนวนสินค้าจริง');
            $(tag).val('');
        } else if (value_add < (map_product_amount * (-1))) {
            $('#modal-alert').modal('show', {backdrop: 'true'});
            $('#massage-alert').html('ไม่สามารถเพิ่มจำนวนสินค้าในคลังได้ <br/> เนื่องจากจำนวนสินค้าที่กำหนดมีน้อยกว่าจำนวนสินค้าในคลัง');
            $(tag).val('');
        } else {
            var value_last = map_product_amount + value_add;
            url = service_base_url + 'stock/change_amount_product';
            $('body').loading();
            $.ajax({
                url: url,
                method: "POST",
                data: {
                    stock_id_pri: stock_id_pri,
                    product_id_pri: product_id_pri,
                    value_add: value_last
                },
                success: function ()
                {
                    ajax();
                }
            });
        }
    }
}