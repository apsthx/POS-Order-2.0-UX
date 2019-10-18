<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-block">
                <h4 class="card-title"><i class="fa fa-users"></i> <?php echo " " . $title; ?> 

                </h4>            
                <div class="row">
                    <div class="col-sm-3">
                        <div class="text-right">
                            <select id="package" class="form-control form-control-sm" onchange="load();">
                                <option value="" >แพ็กเกจทั้งหมด</option>
                                <?php
                                $packages = $this->user_model->package();
                                if ($packages->num_rows() > 0) {
                                    foreach ($packages->result() as $package) {
                                        ?>
                                        <option value="<?php echo $package->package_id; ?>" ><?php echo $package->package_name; ?></option>
                                        <?php
                                    }
                                }
                                ?>
                            </select>
                        </div>
                    </div>                    
                    <div class="col-sm-6">
                        <div class="input-group">
                            <input type="text" id="search" onkeypress="if (event.keyCode === 13) {
                                        load();
                                    }"  class="form-control form-control-sm" placeholder="ค้นหาข้อมูล..">
                            <span class="input-group-btn">
                                <button class="btn btn-outline-primary" type="button" onclick="load();"><i class="fa fa-search"></i></button>
                            </span>
                        </div>
                    </div>
                </div>
                <p></p>
                <div id="for_table">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered">                
                            <thead>
                                <tr>
                                    <th class="text-center" width="5%">No.</th>
                                    <th class="text-center">Username</th>
                                    <th class="text-center">ชื่อ - สกุล</th>  
                                    <th class="text-center">โทร</th>
                                    <th class="text-center">อีเมล</th>
                                    <th class="text-center">ชื่อร้าน</th>
                                    <th class="text-center">ธุรกิจ</th>
                                    <th class="text-center">แพ็คเกจ</th>    
                                    <th class="text-center">อัพเดทแพ็กเกจ</th>
                                    <th class="text-center">สถานะ</th>    
                                    <th class="text-center" width="15%">ตัวเลือก</th>
                                </tr>
                            </thead>
                            <tbody id="for_load">

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="for_modal"></div>
<script>
    var service_base_url = $('#service_base_url').val();

    function modalEdit(user_id) {
        $.ajax({
            url: service_base_url + 'admin/user/useredit',
            type: 'post',
            data: {
                user_id: user_id
            },
            success: function (response) {
                $('#for_modal').html(response);
                $("#on_modal").modal('show', {backdrop: 'static'});
            }
        });
    }
    function modalEditPackage(user_id) {
        $.ajax({
            url: service_base_url + 'admin/user/usereditpackage',
            type: 'post',
            data: {
                user_id: user_id
            },
            success: function (response) {
                $('#for_modal').html(response);
                $("#on_modal").modal('show', {backdrop: 'static'});
            }
        });
    }
    function modalEditpassword(user_id, username) {
        $.ajax({
            url: service_base_url + 'admin/user/usereditpassword',
            type: 'post',
            data: {
                user_id: user_id,
                username: username
            },
            success: function (response) {
                $('#for_modal').html(response);
                $("#on_modal").modal('show', {backdrop: 'static'});
            }
        });
    }
    function modalEditstatus(user_id) {
        $.ajax({
            url: service_base_url + 'admin/user/usereditstatus',
            type: 'post',
            data: {
                user_id: user_id
            },
            success: function (response) {
                $('#for_modal').html(response);
                $("#on_modal").modal('show', {backdrop: 'static'});
            }
        });
    }
    function modalEditchangestatus(user_id) {
        $.ajax({
            url: service_base_url + 'admin/user/editchangestatus',
            type: 'post',
            data: {
                user_id: user_id
            },
            success: function (response) {
                if (response == 1) {
                    location.reload();
                }
            }
        });
    }
    function load() {
        $('body').loading();
        $.ajax({
            url: service_base_url + 'admin/user/loadtable',
            type: 'post',
            data: {
                package: $('#package').val(),
                search: $('#search').val()
            },
            success: function (response) {
                $('#for_table').html(response);
                $('body').loading('stop');
            }
        });
    }
    function modalView(shop_id_pri) {
        $.ajax({
            url: service_base_url + 'admin/user/shopview',
            type: 'post',
            data: {
                shop_id_pri: shop_id_pri
            },
            success: function (response) {
                $('#for_modal').html(response);
                $("#on_modal").modal('show', {backdrop: 'static'});
            }
        });
    }
    $(function () {
        load();
    });
</script>