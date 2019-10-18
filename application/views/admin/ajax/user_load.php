<div class="table-responsive">
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th class="text-center" width="5%">No.</th>
                <th >Username</th>
                <th >ชื่อ - สกุล</th>  
                <th >โทร</th>
                <th >อีเมล</th>
                <th >ชื่อร้าน</th>
                <th >ธุรกิจ</th>
                <th >แพ็คเกจ</th>    
                <th class="text-center">อัพเดทแพ็กเกจ</th>
                <th class="text-center">สถานะ</th>    
                <th class="text-center" width="25%">ตัวเลือก</th>
            </tr>
        </thead>
        <tbody id="for_load">
            <?php
            if ($datas->num_rows() > 0) {
                $i = $segment + 1;
                foreach ($datas->result() as $data) {
                    ?>
                    <tr>
                        <td class="text-right"><?php echo $i; ?></td>
                        <td><?php echo $data->username; ?></td>
                        <td><?php echo $data->fullname; ?></td>
                        <td><?php echo $data->tel; ?></td>
                        <td><?php echo $data->email; ?></td>
                        <td><?php echo $data->shop_name; ?></td>
                        <td><?php echo $data->shop_business; ?></td>
                        <td><?php echo $data->package_name; ?></td>
                        <td class="text-center"><?php echo $this->mics->date2thai($data->user_package_modify, '%d %m %y', 1); ?></td>
                        <td class="text-center">
                            <?php echo ($data->status_id == 1 ? '<span class="label label-success"><i class="fa fa-check-circle"></i> ปกติ</span>' : '<span class="label label-danger"><i class="fa fa-times-circle"></i> ระงับ</span>'); ?>                             
                        </td>
                        <td class="text-center">
                            <div class="btn-group">
                                <button class="btn btn btn-outline-primary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fa fa-list"> ตัวเลือก</i> 
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="javascript:void(0);" onclick="modalView(<?php echo $data->shop_id_pri; ?>)"><i class="fa fa-eye"></i> ดู</a>
                                    <a class="dropdown-item" href="javascript:void(0);" onclick="modalEdit(<?php echo $data->user_id; ?>)"><i class="fa fa-edit"></i> แก้ไข</a>
                                    <a class="dropdown-item" href="javascript:void(0);" onclick="modalEditPackage(<?php echo $data->user_id; ?>)"><i class="fa fa-gift"></i> อัพเดทแพ็กเกจ</a>
                                    <a class="dropdown-item" href="javascript:void(0);" onclick="modalEditpassword('<?php echo $data->user_id; ?>', '<?php echo $data->username; ?>')"><i class="fa fa-refresh"></i> ลืมรหัสผ่าน</a>                        
                                    <div class="dropdown-divider"></div>
                                        <?php if ($data->status_id == 1) { ?>
                                        <a class="dropdown-item" href="javascript:void(0);" onclick="modalEditstatus(<?php echo $data->user_id; ?>)"><i class="fa fa-close"></i> ระงับ</a>
                                    <?php } else { ?>
                                        <a class="dropdown-item" href="javascript:void(0);" onclick="modalEditchangestatus(<?php echo $data->user_id; ?>)"><i class="fa fa-check"></i> ปกติ</a>                                
                                    <?php } ?>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <?php
                    $i++;
                }
            } else {
                ?>
                <tr>
                    <td class="text-center" colspan="11"><?php echo 'ไม่มีข้อมูล'; ?></td>
                </tr>
            <?php }
            ?>
        </tbody>
    </table>
</div>
<?php
if ($search != "") {
    ?>
    <div class="col-sm-12 text-center">
        <span class="text-success"><b><i class="ico-search"></i> ค้นพบทั้งหมด <?php echo $count; ?> แถว</b></span> | <span onclick="location.reload();" style="text-decoration:none; cursor: pointer;"><b class="text-danger"><i class="fa fa-remove"></i> ยกเลิกการค้นหา</b></span>
    </div>
    <?php
} else if ($count != 0) {
    ?>
    <div class="row">
        <div class="col-sm-6 text-left">
            แสดง <?php echo $segment + 1; ?> ถึง <?php echo $i - 1; ?> ทั้งหมด <?php echo ($count); ?>                                                 
        </div>
        <div class="col-sm-6 text-right">
            <?php echo $links; ?>
        </div>
    </div>
<?php } ?>
