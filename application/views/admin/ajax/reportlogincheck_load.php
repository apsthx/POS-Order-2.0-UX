<div class="table-responsive">
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th class="text-center" width="5%">No.</th>
                <th >ร้าน</th>
                <th >ผู้ใช้งาน</th>  
                <th >IP Address</th>   
                <th >Browser</th>   
                <th class="text-center">วันที่ เวลาเข้าสู่ระบบ</th>
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
                        <td><?php echo $data->shop_name; ?></td>
                        <td><?php echo $data->fullname; ?></td>
                        <td><?php echo $data->log_ip_address; ?></td>
                        <td><?php echo $data->log_browser; ?></td>
                        <td class="text-center"><?php echo $this->mics->date2thai($data->log_time, '%d %m %y %h:%i:%s', 1); ?></td>
                    </tr>
                    <?php
                    $i++;
                }
            } else {
                ?>
                <tr>
                    <td class="text-center" colspan="6"><?php echo 'ไม่มีข้อมูล'; ?></td>
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
