var service_base_url = $('#service_base_url').val();

$(function () {
    ajax();
});

function ajax() {
    url = service_base_url + 'shop/ajax';
    $('body').loading();
    $.ajax({
        url: url,
        success: function (res)
        {
            $('#result-page').html(res);
            $('body').loading('stop');
        }
    });
}

function edit_modal(id) {
    url = service_base_url + 'shop/edit_modal';
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

function edit_submit() {

    shop_id_pri = $('#shop_id_pri').val();
    shop_name = $('#shop_name').val();
    tax_id = $('#tax_id').val();
    tel_shop = $('#tel_shop').val();
    fax_shop = $('#fax_shop').val();
    website_shop = $('#website_shop').val();
    email_shop = $('#email_shop').val();
    address_shop = $('#address_shop').val();
    status_shop_id = $('#status_shop_id').val();

    url = service_base_url + 'shop/edit';
    $('#open-modal .modal-content').html('<div style="text-align:center; padding:80px;"><i class="fa fa-refresh fa-spin fa-3x fa-fw"></i></div>');
    $.ajax({
        url: url,
        method: "POST",
        data: {
            shop_id_pri: shop_id_pri,
            shop_name: shop_name,
            tax_id: tax_id,
            tel_shop: tel_shop,
            fax_shop: fax_shop,
            website_shop: website_shop,
            email_shop: email_shop,
            address_shop: address_shop,
            status_shop_id: status_shop_id
        },
        success: function ()
        {
            $('#open-modal').modal('hide');
            ajax();
        }
    });
    return false;
}

function ChangeStatus(click) {
    if (click == 1) {
        $('#i_status_1').css("color", "green");
        $('#i_status_2').css("color", "gray");

    } else {
        $('#i_status_1').css("color", "gray");
        $('#i_status_2').css("color", "red");
    }
    $('#status_shop_id').val(click);
}

function modal_editpassword(user_id,username) {
    console.log(user_id+'/'+username)
    url = service_base_url + 'user/modaleditpassword';
    $('#editpassword').modal('show', {backdrop: 'true'});
    $.ajax({
        url: url,
        method: "POST",
        data: {
            user_id: user_id,
            username: username,
        },
        success: function (response)
        {
            $('#editpassword .modal-content').html(response);
        }
    });
}

function editpassword() {
    url = service_base_url + 'shop/editpassword';
    $('#editpassword').modal('hide');
    $('body').loading();
    $.ajax({
        url: url,
        method: "POST",
        data: {
            user_id: $('#user_id_editpassword').val(),
            username: $('#username_editpassword').val(),
        },
        success: function (res)
        {
            $('body').loading('stop');
            $('#result-page').html(res);
        }
    });
    
    return false;
}