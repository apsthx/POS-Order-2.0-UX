<?php if ($this->accesscontrol->getMyShop($this->session->userdata('shop_id_pri'))->type_shop_id == 1) { ?>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-block">
                    <h4 class="card-title"><i class="fa fa-gift"></i> <?php echo " " . $title; ?> 
                        <a href="<?php echo base_url() . 'payment'; ?>" style="float: right" class="btn btn-sm btn-rounded btn-outline-info" target="_blank" ><i class="fa fa-edit"></i>&nbsp;แจ้งชำระเงิน</a>
                    </h4>
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered">                
                            <thead>
                                <tr>
                                    <th class="text-right" width="3%">#</th>
                                    <th>ชื่อแพ็กเกจ</th>
                                    <th >ราคา</th>
                                    <th class="text-right">ผู้ใช้ระบบ</th>
                                    <th class="text-right">สาขาย่อย</th>
                                    <th class="text-right">ตัวแทนจำหน่าย</th>
                                    <th class="text-right">Free SMS</th>   
                                    <th class="text-right">จำกัดวัน</th>                  
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i = 1;
                                if ($datas->num_rows() > 0) {
                                    foreach ($datas->result() as $data) {
                                        ?>
                                        <tr>
                                            <td class="text-right"><?php echo $i; ?></td>
                                            <td><?php echo $data->package_name; ?></td>
                                            <td ><?php echo $data->package_cost; ?></td>
                                            <td class="text-right"><?php echo number_format($data->package_useuser, 0); ?></td>
                                            <td class="text-right"><?php echo number_format($data->package_useshop, 0); ?></td>
                                            <td class="text-right"><?php echo number_format($data->package_useagent, 0); ?></td>
                                            <td class="text-right"><?php echo number_format($data->package_sms, 0); ?></td>
                                            <td class="text-right"><?php echo number_format($data->package_usedate, 0); ?></td>
                                        </tr>
                                        <?php
                                        $i++;
                                    }
                                } else {
                                    ?>
                                    <tr>
                                        <td class="text-center" colspan="8"><?php echo 'ไม่มีข้อมูล'; ?></td>
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
<?php } ?>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-block">
                <h4 class="card-title"><i class="fa fa-envelope"></i> <?php echo " อัตราค่าบริการเครดิต SMS"; ?> 
                    <a href="<?php echo base_url() . 'payment'; ?>" style="float: right" class="btn btn-sm btn-rounded btn-outline-primary" target="_blank" ><i class="fa fa-edit"></i>&nbsp;แจ้งชำระเงิน</a>
                </h4>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered">                
                        <thead>
                            <tr>
                                <th class="text-right" width="3%">#</th>
                                <th>ชื่อ SMS</th>
                                <th class="text-right">ราคา</th>
                                <th class="text-right">จำนวนข้อความ</th>                           
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 1;
                            if ($datassms->num_rows() > 0) {
                                foreach ($datassms->result() as $datasms) {
                                    ?>
                                    <tr>
                                        <td class="text-right"><?php echo $i; ?></td>
                                        <td><?php echo $datasms->sms_name; ?></td>
                                        <td class="text-right"><?php echo number_format($datasms->sms_cost, 0); ?></td>
                                        <td class="text-right"><?php echo number_format($datasms->sms_amount, 0); ?></td>
                                    </tr>
                                    <?php
                                    $i++;
                                }
                            } else {
                                ?>
                                <tr>
                                    <td class="text-center" colspan="4"><?php echo 'ไม่มีข้อมูล'; ?></td>
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

</script>

