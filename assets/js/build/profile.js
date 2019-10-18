var service_base_url = $('#service_base_url').val();


function modaleditpassword() {
    url = service_base_url + 'profile/modaleditpassword';
    $('#editpassword').modal('show', {backdrop: 'true'});
    $.ajax({
        url: url,
        method: "POST",
        data: {
            user_id: $('#user_id').val(),
            username: $('#username').val(),
        },
        success: function (response)
        {
            $('#editpassword .modal-content').html(response);
        }
    });
}

function editpassword() {
    if ($("#oldpassword").val() != '') {
        if ($("#newpassword").val() != '') {
            if ($("#confirmpassword").val() != '') {

                url = service_base_url + 'profile/editpassword';
                $.ajax({
                    url: url,
                    method: "POST",
                    data: {
                        user_id: $('#user_id_password').val(),
                        username: $('#usernamepassword').val(),
                        oldpassword: $('#oldpassword').val(),
                        newpassword: $('#newpassword').val(),
                        confirmpassword: $('#confirmpassword').val(),
                    },
                    success: function (res)
                    {
                        if (res == 1) {
                            $('#editpassword').modal('hide');
                            window.location.replace(service_base_url + 'login/logout');
                        } else if (res == 2) {
                            $('#statuspassword').html('password เดิม ไม่ถูกต้อง');
                            $('#statusconfirmpassword').html('');
                            $("#newpassword").val('');
                            $("#confirmpassword").val('');
                        } else {
                            $('#statusconfirmpassword').html('ยืนยัน password ไม่ตรง');
                            $('#statuspassword').html('');
                            $("#newpassword").val('');
                            $("#confirmpassword").val('');
                        }
                    }
                });
            }
        }
    }
    return false;
}

function upload_image() {
        var myfiles = document.getElementById("upload-image");
        var files = myfiles.files;
        var data = new FormData();

        for (i = 0; i < files.length; i++) {
            data.append('file' + i, files[i]);
        }
        url = service_base_url + 'profile/upload_image';
        $('body').loading();
        $.ajax({
            url: url,
            dataType: "json",
            type: 'POST',
            contentType: false,
            data: data,
            processData: false,
            cache: false
        }).done(function (res) {
            if (res.error) {
                $('#upload-error').show();
            } else {
                $('#upload-error').hide();
                image_link = service_base_url + 'store/image/' + res.file_name;
                $('#image_a').attr("href", image_link);
                $('#image_show').attr("src", image_link);
            }
            $('body').loading('stop');
        });
    }