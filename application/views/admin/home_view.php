<div class="row">
    <!-- Column -->
    <div class="col-lg-3 col-md-6">
        <div class="card">
            <div class="card-block">
                <div class="d-flex flex-row">
                    <div class="round round-lg align-self-center round-info"><i class="mdi mdi-home-map-marker"></i></div>
                    <div class="m-l-10 align-self-center">
                        <h3 class="m-b-0 font-light"><?php echo number_format($this->home_model->getshop(), 0); ?></h3>
                        <h5 class="text-muted m-b-0">จำนวน ร้านค้า</h5></div>
                </div>
            </div>
        </div>
    </div>
    <!-- Column -->
    <!-- Column -->
    <div class="col-lg-3 col-md-6">
        <div class="card">
            <div class="card-block">
                <div class="d-flex flex-row">
                    <div class="round round-lg align-self-center round-warning"><i class="mdi mdi-cellphone-link"></i></div>
                    <div class="m-l-10 align-self-center">
                        <?php 
                        $branch = 0;
                        $getshopbranch = $this->home_model->getshopbranch();
                        if($getshopbranch->num_rows() > 0){
                            foreach ($getshopbranch->result() as $shopbranch) {
                                if( $this->home_model->checkShop($shopbranch->shop_create_id) == 1){
                                    $branch++;
                                }
                            }
                        }
                        ?>                     
                        <h3 class="m-b-0 font-lgiht"><?php echo number_format($branch, 0); ?></h3>
                        <h5 class="text-muted m-b-0">จำนวน สาขา</h5></div>
                </div>
            </div>
        </div>
    </div>
    <!-- Column -->
    <!-- Column -->
    <div class="col-lg-3 col-md-6">
        <div class="card">
            <div class="card-block">
                <div class="d-flex flex-row">
                    <div class="round round-lg align-self-center round-primary"><i class="mdi mdi-home-variant"></i></div>
                    <div class="m-l-10 align-self-center">
                        <?php 
                        $agent = 0;
                        $getshopagent = $this->home_model->getshopagent();
                        if($getshopagent->num_rows() > 0){
                            foreach ($getshopagent->result() as $shopagent) {
                                if( $this->home_model->checkShop($shopagent->shop_create_id) == 1){
                                    $agent++;
                                }
                            }
                        }
                        ?>  
                        <h3 class="m-b-0 font-lgiht"><?php echo number_format($agent, 0); ?></h3>
                        <h5 class="text-muted m-b-0">จำนวน ตัวแทนจำหน่าย</h5></div>
                </div>
            </div>
        </div>
    </div>
    <!-- Column -->
    <!-- Column -->
    <div class="col-lg-3 col-md-6">
        <div class="card">
            <div class="card-block">
                <div class="d-flex flex-row">
                    <div class="round round-lg align-self-center round-danger"><i class="icon-envelope-open"></i></div>
                    <div class="m-l-10 align-self-center">
                        <?php
                        $sms = $this->home_model->getshopsms()->credit_all;
                        if ($sms == null) {
                            $sms = 0;
                        }
                        ?>
                        <h3 class="m-b-0 font-lgiht"><?php echo number_format($sms, 0); ?></h3>
                        <h5 class="text-muted m-b-0">จำนวน SMS คงเหลือ</h5></div>
                </div>
            </div>
        </div>
    </div>
    <!-- Column -->
</div>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-block">
                <h4 class="card-title"><a href="<?php echo base_url().'admin/receipt' ?>" target="_blank"><i class="fa fa-money"></i><?php echo " รายการแจ้งโอนเงิน"; ?></a> (รอตรวจ)
                </h4>                 
                <br/>
                <div class="table-responsive">
                    <div id="for_table">
                        <table class="table table-striped table-bordered">                
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th class="">แพ็กเกจ</th>
                                    <th>โอนเข้าธนาคาร</th>
                                    <th class="">โอนโดย</th>
                                    <th class="">จำนวนเงิน</th>
                                    <th class="">วันที่โอน</th>
                                    <th class="">เวลาโอน</th>
                                    <th class="">เลขที่อ้างอิง</th>
                                    <th class="text-center">หลักฐานการโอน</th>
                                    <th class="text-center">วันที่แจ้งโอน</th>
                                    <th class="text-center" width="7%">สถานะ</th>
                                </tr>
                            </thead>
                            <tbody id="for_load">
                                <?php
                                if ($datas->num_rows() > 0) {
                                    $i = 1;
                                    foreach ($datas->result() AS $data) {
                                        ?>
                                        <tr>
                                            <td><?php echo $i; ?></td>
                                            <td><?php echo ($data->package_id != null) ? $this->home_model->getPackage($data->package_id)->package_name : $this->home_model->getSMS($data->sms_id)->sms_name; ?></td>
                                            <td><?php echo $data->income_bank_name . ' ' . $data->income_bank_branch . ' ' . $data->income_bank_account_name; ?></td>
                                            <td class=""><?php echo $data->receipt_by; ?></td>
                                            <td class=""><?php echo number_format($data->receipt_cost, 2); ?></td>
                                            <td class=""><?php echo $this->mics->date2thai($data->receipt_datepay, '%d %m %y', 1); ?></td>
                                            <td class=""><?php echo $this->mics->date2thai($data->receipt_timepay, '%h:%i'); ?></td>
                                            <td class=""><?php echo $data->receipt_number; ?></td><td  style="vertical-align: middle;" class="text-center">
                                                <a href="<?php echo base_url() . 'store/receipt/' . $data->receipt_evidence; ?>"  class="fancybox">
                                                    <image src="<?php echo base_url() . 'store/receipt/bank.png'; ?>" class="img-responsive" style="width: 35px; height: 40px;"/>
                                                </a>
                                            </td>
                                            <td  style="vertical-align: middle;" class="text-center"><?php echo $this->mics->date2thai($data->receipt_create, '%d %m %y %h:%i', 1); ?></td>
                                            <td  style="vertical-align: middle;" class="text-center" id="status-<?php echo $data->receipt_id; ?>">
                                                <span class="label label-inverse">รอตรวจ</span>
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
</div>