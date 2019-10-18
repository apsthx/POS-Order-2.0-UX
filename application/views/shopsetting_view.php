
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-block">
                <h4 class="card-title">
                    <i class="<?php echo $icon; ?>"></i> <?php echo " " . $title; ?>
                </h4>

                <form method="post" id="form-shop" action="<?php echo base_url() . 'shopsetting/edit'; ?>" autocomplete="off">

                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-body">
                                <hr>
                                <div class="row">
                                    <div class="col-md-12 text-right">
                                        <span style="color: red; font-size: 12px">* คือต้องกรอกให้ครบ</span>
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="col-md-12 text-center">
                                        <span id="upload-error" style="color: red; display: none;">มีข้อผิดพลาดในการอัพโหลด</span>
                                    </div>
                                </div>
                                <p/>
                                <div class="row">
                                    <div class="col-md-12 text-center">
                                        <a  id="image_a" href="<?php echo base_url() . 'store/image/' . $data->image_name; ?>" target="_blank">
                                            <img id="image_show" src="<?php echo base_url() . 'store/image/' . $data->image_name; ?>" width="100" height="100" style="cursor:pointer;">
                                        </a>
                                    </div>
                                </div>
                                <p/>
                                <div class="row">
                                    <div class="col-md-12 text-center">
                                        แนะนำรูป 400x400 pixel 
                                    </div>
                                </div>
                                <p/>
                                <div class="row">
                                    <div class="col-md-12 text-center">
                                        <label  for="upload-image" class="btn btn-info btn-xl">
                                            <i class="fa fa-image"></i> อัพโหลดโลโก้
                                            <input type="file" accept="image/*" name="image" onchange="upload_image();" id="upload-image" style="display: none">
                                        </label>
                                    </div>
                                </div>

                                <br>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">รหัสร้าน</label>
                                            <input type="text" class="form-control" value="<?php echo $data->shop_id; ?>" readonly="">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">ชื่อร้าน หรือ นามแฝงตัวแทนจำหน่าย <span style="color: red;">*</span></label>
                                            <input type="text" name="shop_name" class="form-control" value="<?php echo $data->shop_name; ?>" data-parsley-error-message="กรุณากรอกข้อมูล" required="">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">เลขผู้เสียภาษี</label>
                                            <input type="text" name="tax_id" class="form-control" value="<?php echo $data->tax_id; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">เบอร์โทร</label>
                                            <input type="text" name="tel_shop" onblur="check_phone_format(this);" value="<?php echo $data->tel_shop; ?>" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">โทรสาร (Fax)</label>
                                            <input type="text" name="fax_shop" class="form-control" value="<?php echo $data->fax_shop; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">เว็บไซต์</label>
                                            <input type="text" name="website_shop" class="form-control" value="<?php echo $data->website_shop; ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="control-label">Email</label>
                                                    <input type="text" name="email_shop" onblur="check_email_format(this);" class="form-control" value="<?php echo $data->email_shop; ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="control-label">QR Code ID Promptpay</label>
                                                    <?php if($data->shop_promptpay_id != null || $data->shop_promptpay_id != ''){ ?>
                                                    <div class="text-center">
                                                        <a href="<?php echo 'https://promptpay.io/'.$data->shop_promptpay_id.'/'.number_format(0,2,'.',''); ?>"  class="fancybox">
                                                            <image src="<?php echo 'https://promptpay.io/'.$data->shop_promptpay_id.'/'.number_format(0,2,'.',''); ?>" class="img-responsive img-thumbnail" style="width: 160px;"/>
                                                        </a>
                                                    </div>
                                                    <?php } ?> 
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="control-label">ที่อยู่</label>
                                                    <textarea type="text" name="address_shop" rows="2" class="form-control"><?php echo $data->address_shop; ?></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label">ID Promptpay</label>
                                                    <input type="text" name="shop_promptpay_id" onblur="check_promptpay_format(this);" class="form-control" value="<?php echo $data->shop_promptpay_id; ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label">ชื่อ Promptpay</label>
                                                    <input type="text" name="shop_promptpay_name"  class="form-control" value="<?php echo $data->shop_promptpay_name; ?>">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-12 text-center">
                            <button type="submit" id="bt-submit" class="btn btn-outline-info"><i class="fa fa-save"></i> บันทึก</button>
                            <button type="reset" class="btn btn-outline-danger"><i class="fa fa-refresh"></i> ล้างข้อมูล</button>
                        </div>
                    </div>

                </form>

            </div>
        </div>
    </div>
</div>

<script>
    var service_base_url = $('#service_base_url').val();

    $(function () {
        $('#form-shop').parsley();
    });

    function upload_image() {
        var myfiles = document.getElementById("upload-image");
        var files = myfiles.files;
        var data = new FormData();

        for (i = 0; i < files.length; i++) {
            data.append('file' + i, files[i]);
        }
        url = service_base_url + 'shopsetting/upload_image';
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