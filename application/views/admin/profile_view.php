<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-block">
                <h4 class="card-title"><i class="<?php echo $icon; ?>"></i> <?php echo " " . $title; ?></h4>  
                <form class="form-horizontal" id="formedit" method="post" action="<?php echo base_url() . 'admin/profile/edit'; ?>" autocomplete="off">
                    <input type="hidden" name="admin_id" id="admin_id"  value="<?php echo $data->admin_id; ?>">
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <a  id="image_a" href="<?php echo base_url() . 'store/image/' . $data->image_name; ?>" target="_blank">
                                <img id="image_show" src="<?php echo base_url() . 'store/image/' . $data->image_name; ?>" style="cursor:pointer; height: 90px;">
                            </a>
                        </div>
                    </div>
                    <p/>
                    <div class="row">
                        <div class="col-md-12 text-center">
                            แนะนำรูป 45x45 pixel 
                        </div>
                    </div>
                    <p/>
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <label  for="upload-image" class="btn btn-info btn-xl">
                                <i class="fa fa-image"></i> อัพโหลดรูป
                                <input type="file" accept="image/*" name="image" onchange="upload_image();" id="upload-image" style="display: none">
                            </label>
                        </div>
                    </div>
                    <p></p>
                    <br/>
                    <div class="form-group row">
                        <label class="col-sm-2 text-right control-label col-form-label"> username : </label>
                        <div class="col-sm-3">
                            <input type="text" value="<?php echo $data->username; ?>" name="username" id="username" class="form-control" required >
                            <input type="hidden" value="<?php echo $data->password; ?>"  id="password" class="form-control" required readonly="">
                        </div>
                        <div class="col-sm-2 text-center">
                            <button type="button" class="btn btn-outline-warning" onclick="modaleditpassword();"><i class="fa fa-refresh"></i>&nbsp;เปลี่ยนรหัสผ่าน</button>
                        </div>
                        <label class="col-sm-1 text-right control-label col-form-label"> ชื่อผู้ใช้งาน : </label>
                        <div class="col-sm-3">
                            <input type="text" name="name" value="<?php echo $data->name; ?>"  class="form-control" required>
                        </div>
                    </div>                                             
                    <div class="form-group">
                        <div class="col-md-12 text-center">
                            <button type="submit" class="btn btn-outline-info"><i class="fa fa-save"></i>&nbsp;บันทึก</button>
                            &nbsp;
                            <button type="reset" class="btn btn-outline-danger" ><i class="fa fa-close"></i>&nbsp;ยกเลิก</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="editpassword">
    <div class="modal-dialog">
        <div class="modal-content">

        </div>
    </div>
</div>

<script>
    $(function () {
        $('#formedit').parsley();
    });
    var service_base_url = $('#service_base_url').val();


    function modaleditpassword() {
        url = service_base_url + 'admin/profile/modaleditpassword';
        $('#editpassword').modal('show', {backdrop: 'true'});
        $.ajax({
            url: url,
            method: "POST",
            data: {
                admin_id: $('#admin_id').val(),
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

                    url = service_base_url + 'admin/profile/editpassword';
                    $.ajax({
                        url: url,
                        method: "POST",
                        data: {
                            admin_id: $('#admin_id_password').val(),
                            oldpassword: $('#oldpassword').val(),
                            newpassword: $('#newpassword').val(),
                            confirmpassword: $('#confirmpassword').val(),
                        },
                        success: function (res)
                        {
                            if (res == 1) {
                                $('#editpassword').modal('hide');
                                window.location.replace(service_base_url + 'admin/login/logout');
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
        url = service_base_url + 'admin/profile/upload_image';
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
</script>