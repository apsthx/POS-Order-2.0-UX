<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-block">
                <h4 class="card-title"><i class="<?php echo $icon; ?>"></i> <?php echo " " . $title; ?></h4>  
                <form class="form-horizontal" id="formedit" method="post" action="<?php echo base_url() . 'profile/edit'; ?>" autocomplete="off">
                    <input type="hidden" name="user_id" id="user_id"  value="<?php echo $data->user_id; ?>">
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <a  id="image_a" href="<?php echo base_url() . 'store/image/' . $this->profile_model->get_image($data->image_id)->image_name; ?>" target="_blank">
                                <img id="image_show" src="<?php echo base_url() . 'store/image/' . $this->profile_model->get_image($data->image_id)->image_name; ?>" width="100" height="100" style="cursor:pointer;">
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
                                <i class="fa fa-image"></i> อัพโหลดรูป
                                <input type="file" accept="image/*" name="image" onchange="upload_image();" id="upload-image" style="display: none">
                            </label>
                        </div>
                    </div>
                    <p></p>
                    <div class="form-group row">
                        <label class="col-sm-2 text-right control-label col-form-label"> สีที่เหมาะกับคุณ : </label>
                        <div class="col-sm-3">
                            <select name="style" class="form-control">
                                <option value="blue" style="background-color: dodgerblue;color: dodgerblue;">dodgerblue</option>
                                <option value="default" style="background-color: darkslategray;color: darkslategray;">darkslategray</option>
                                <option value="green" style="background-color: turquoise;color: turquoise;">turquoise</option>
                                <option value="megna" style="background-color: teal;color: teal;">teal</option>
                                <option value="purple" style="background-color: mediumslateblue;color: mediumslateblue;">mediumslateblue</option>
                                <option value="red" style="background-color: red;color: red;">red</option>
                            </select>
                        </div>
                    </div> 
                    <div class="form-group row">
                        <label class="col-sm-2 text-right control-label col-form-label"> username : </label>
                        <div class="col-sm-7">
                            <input type="text" value="<?php echo $data->username; ?>"  id="username" class="form-control" required readonly="">
                            <input type="hidden" value="<?php echo $data->password; ?>"  id="password" class="form-control" required readonly="">
                        </div>
                        <div class="col-sm-2 text-right">
                            <button type="button" class="btn btn-outline-warning" onclick="modaleditpassword();"><i class="fa fa-refresh"></i>&nbsp;เปลี่ยนรหัสผ่าน</button>
                        </div>
                    </div>  
                    <div class="form-group row">
                        <label class="col-sm-2 text-right control-label col-form-label"> ชื่อผู้ใช้งาน : </label>
                        <div class="col-sm-9">
                            <input type="text" name="fullname" value="<?php echo $data->fullname; ?>"  class="form-control" required>
                        </div>
                    </div>                   
                    <div class="form-group row">
                        <label class="col-sm-2 text-right control-label col-form-label"> เบอร์โทร : </label>
                        <div class="col-sm-3">
                            <input <?php echo ($data->type_user_id == 1)? 'readonly':'' ?> type="text" name="tel" value="<?php echo $data->tel; ?>" onblur="check_phone_format(this);" class="form-control" >
                        </div>
                        <label class="col-sm-2 text-right control-label col-form-label"> อีเมล : </label>
                        <div class="col-sm-4">
                            <input type="text" name="email" value="<?php echo $data->email; ?>" onblur="check_email_format(this);" class="form-control" >
                        </div>
                    </div>   
                    <div class="form-group row">
                        <label class="col-sm-2 text-right control-label col-form-label"> ที่อยู่ : </label>
                        <div class="col-sm-9">
                            <textarea name="address" class="form-control" rows="2"><?php echo $data->address; ?></textarea>
                        </div>
                    </div>  
                    <div class="form-group row">
                        <label class="col-sm-2 text-right control-label col-form-label"> เพิ่มเติม : </label>
                        <div class="col-sm-9">
                            <textarea name="comment" class="form-control" rows="2"><?php echo $data->comment; ?></textarea>
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
</script>