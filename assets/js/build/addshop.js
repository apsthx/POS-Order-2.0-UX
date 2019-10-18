var service_base_url = $('#service_base_url').val();

function check_shop_custom_id(tag) {
    $('#bt-submit').prop('disabled', true);
    url = service_base_url + 'addshop/check_shop_custom_id';
    $.ajax({
        url: url,
        method: "POST",
        data: {
            shop_custom_id: $(tag).val()
        },
        success: function (res)
        {
            if (res == '1') {
                //ซ้ำ
                $(tag).val('');
                $('#shop_custom_id_massage').html('รหัสนี้มีการใช้งานแล้ว');
            } else {
                $('#shop_custom_id_massage').html('');
            }
            $('#bt-submit').prop('disabled', false);
        }
    });
}

function check_username(tag) {
    $('#bt-submit').prop('disabled', true);
    url = service_base_url + 'addshop/check_username';
    $.ajax({
        url: url,
        method: "POST",
        data: {
            username: $(tag).val()
        },
        success: function (res)
        {
            if (res == '1') {
                //ซ้ำ
                $(tag).val('');
                $('#username_massage').html('Username นี้มีการใช้งานแล้ว');
            } else {
                $('#username_massage').html('');
            }
            $('#bt-submit').prop('disabled', false);
        }
    });
}