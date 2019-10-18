<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-block">
                <h4 class="card-title"><i class="fa fa-handshake-o"></i> <?php echo " " . $title; ?>
                    <a style="float: right" class="btn btn-xs btn-rounded btn-outline-success" href="<?php echo base_url().'admin/docapi' ?>" target="_blank"><i class="fa fa-file-text"></i> เอกสาร API</a>
                </h4>            
                <p></p>
                <div id="for_table">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered">                
                            <thead>
                                <tr>
                                    <th class="text-center" width="5%">No.</th>
                                    <th class="text-center">ID ร้าน</th>
                                    <th class="text-center">ชื่อร้าน</th>
                                    <th class="text-center">Token</th>
                                    <th class="text-center">Id ผู้ใช้ (user_id)</th>
                                    <th class="text-center">ชื่อ - สกุล</th>  
                                    <th class="text-center">สถานะ</th>    
                                    <th class="text-center" width="15%">ตัวเลือก</th>
                                </tr>
                            </thead>
                            <tbody id="for_load">
                                <?php
                                $datas = $this->apidoc_model->shop();
                                if ($datas->num_rows() > 0) {
                                    $i = 1;
                                    foreach ($datas->result() as $data) {
                                        ?>
                                        <tr>
                                            <td class="text-right"><?php echo $i; ?></td>
                                            <td class="text-center"><?php echo $data->shop_id; ?></td>
                                            <td><?php echo $data->shop_name; ?></td>
                                            <td ><?php echo $data->token; ?></td>
                                            <td class="text-center"><?php echo $data->user_id; ?></td>
                                            <td><?php echo $data->fullname; ?></td>
                                            <td class="text-center">
                                                <?php echo ($data->token_status == 1 ? '<span class="label label-success"><i class="fa fa-check-circle"></i> ปกติ</span>' : '<span class="label label-danger"><i class="fa fa-times-circle"></i> ระงับ</span>'); ?>                             
                                            </td>
                                            <td class="text-center">
                                                <button type="button" class="btn btn-xs btn-outline-info" onclick="modalviewgroup(<?php echo $data->shop_id_pri; ?>)"><i class="fa fa-eye"></i> กลุ่มลูกค้า</button>
                                                <?php if ($data->token_status == 1) { ?>
                                                    <button type="button" class="btn btn-xs btn-outline-danger" onclick="modalEditstatus(<?php echo $data->shop_id_pri; ?>)"><i class="fa fa-close"></i> ระงับ Token</button>
                                                <?php } else { ?>
                                                    <button type="button" class="btn btn-xs btn-outline-success " onclick="modalEditchangestatus(<?php echo $data->shop_id_pri; ?>)"><i class="fa fa-check"></i> ปกติ</button>                                
                                                <?php } ?>
                                            </td>
                                        </tr>
                                        <?php
                                        $i++;
                                    }
                                } else {
                                    ?>
                                    <tr>
                                        <td class="text-center" colspan="8"><?php echo 'ไม่มีข้อมูล'; ?></td>
                                    </tr>
                                <?php }
                                ?>
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
    function modalviewgroup(shop_id_pri) {
        $.ajax({
            url: service_base_url + 'admin/apidoc/viewgroup',
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
    function modalEditstatus(shop_id_pri) {
        $.ajax({
            url: service_base_url + 'admin/apidoc/apieditstatus',
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
    function modalEditchangestatus(shop_id_pri) {
        $.ajax({
            url: service_base_url + 'admin/apidoc/editchangestatus',
            type: 'post',
            data: {
                shop_id_pri: shop_id_pri
            },
            success: function (response) {
                if (response == 1) {
                    location.reload();
                }
            }
        });
    }
</script>