<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-block">
                <h4 class="card-title"><i class="<?php echo $icon; ?>"></i> <?php echo " " . $title; ?> 
                    <button type="button" style="float: right" class="btn btn-xs btn-rounded btn-outline-success" onclick="modalAdd();"><i class="fa fa-plus"></i> เพิ่มบัญชีธนาคาร</button>
                </h4>  
                <?php
                if ($this->session->flashdata('flash_message') != '') {
                    echo '<script> $(document).ready(function () {toastralerts();}); </script>';
                }
                ?>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered">                
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>ธนาคาร</th>
                                <th class="">สาขา</th>
                                <th class="">เลขที่บัญชี</th>
                                <th class="">ชื่อบัญชี</th>
                                <th class="text-center">สถานะ</th>
                                <th class="text-center">ตัวเลือก</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 1;
                            if ($datas->num_rows() > 0) {
                                foreach ($datas->result() as $data) {
                                    ?>
                                    <tr>
                                        <td><?php echo $i; ?></td>
                                        <td><?php echo $data->income_bank_name; ?></td>
                                        <td class=""><?php echo $data->income_bank_branch; ?></td>
                                        <td class=""><?php echo $data->income_bank_account_name; ?></td>
                                        <td class=""><?php echo $data->income_bank_accoun_number; ?></td>
                                        <td class="text-center">
                                            <?php echo ($data->income_bank_active == 1 ? '<span class="label label-success">ปกติ</span>' : '<span class="label label-danger">ระงับ</span>'); ?>                             
                                        </td>
                                        <td class="text-center">  
                                            <button type="button" class="btn btn-xs btn-outline-info" onclick="modalEdit(<?php echo $data->income_bank_id; ?>)"><i class="fa fa-edit"></i> แก้ไข</button>                                             
                                            <?php if ($data->income_bank_active == 1) { ?>
                                                <button type="button" class="btn btn-xs btn-outline-danger" onclick="modalEditstatus(<?php echo $data->income_bank_id; ?>)"><i class="fa fa-close"></i> ระงับ</button>
                                            <?php } else { ?>
                                                <button type="button" class="btn btn-xs btn-outline-success" onclick="modalEditchangestatus(<?php echo $data->income_bank_id; ?>)"><i class="fa fa-check"></i> ปกติ</button>
                                            <?php } ?>
                                        </td>
                                    </tr>
                                    <?php
                                    $i++;
                                }
                            } else {
                                ?>
                                <tr>
                                    <td class="text-center" colspan="7"><?php echo 'ไม่มีข้อมูล'; ?></td>
                                </tr>
                                <?php
                            }
                            ?>                    
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="for_modal"></div>
<script>
    var service_base_url = $('#service_base_url').val();
    //add
    function modalAdd() {
        $.ajax({
            url: service_base_url + 'admin/bank/bankadd',
            success: function (response) {
                $('#for_modal').html(response);
                $("#on_modal").modal('show', {backdrop: 'static'});
            }
        });
    }
    //edit
    function modalEdit(income_bank_id) {
        $.ajax({
            url: service_base_url + 'admin/bank/bankedit',
            type: 'post',
            data: {
                income_bank_id: income_bank_id
            },
            success: function (response) {
                $('#for_modal').html(response);
                $("#on_modal").modal('show', {backdrop: 'static'});
            }
        });
    }
    //edit
    function modalEditstatus(income_bank_id) {
        $.ajax({
            url: service_base_url + 'admin/bank/bankeditstatus',
            type: 'post',
            data: {
                income_bank_id: income_bank_id
            },
            success: function (response) {
                $('#for_modal').html(response);
                $("#on_modal").modal('show', {backdrop: 'static'});
            }
        });
    }
    //edit
    function modalEditchangestatus(income_bank_id) {
        $.ajax({
            url: service_base_url + 'admin/bank/editchangestatus',
            type: 'post',
            data: {
                income_bank_id: income_bank_id
            },
            success: function (response) {
                if (response == 1) {
                    location.reload();
                }
            }
        });
    }

</script>
