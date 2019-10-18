<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-block">
                <h4 class="card-title"><i class="<?php echo $icon; ?>"></i> <?php echo " " . $title; ?></h4>


                <ul class="nav nav-tabs customtab" role="tablist">
                    <li class="nav-item"> <a onclick="data(1);" class="nav-link active" data-toggle="tab" href="#unready" role="tab" aria-expanded="true"><span class="hidden-sm-up"><i class="ti-list"></i></span> <span class="hidden-xs-down">รอดำเนินการ</span></a> </li>
                    <li class="nav-item"> <a onclick="data(2);" class="nav-link" data-toggle="tab" href="#success" role="tab" aria-expanded="false"><span class="hidden-sm-up"><i class="ti-check-box"></i></span> <span class="hidden-xs-down">เสร็จสิ้น</span></a> </li>
                </ul>


                <div class="tab-content">
                    <div class="tab-pane active" id="unready" role="tabpanel" aria-expanded="true">
                        <br/>
                        <div class="row">
                            <div class="col-sm-3">
                                <select id="transport_service_id" class="form-control form-control-sm" onchange="data();">
                                    <option value="" >บริการขนส่งทั้งหมด</option>
                                    <option value="1" >Dropoff EMS</option>
                                    <option value="2" >Kerry Express</option>
                                    <option value="3" >จัดส่งเอง</option>
                                </select>
                            </div>
                            <div class="col-sm-7">
                                <span> เลือกวันที่ </span>
                                <input class="form-control form-control-sm col-sm-4 mydatepicker" type="text" value="" id="dateunready_start" onchange="dateunready_start();">
                                <span> ถึง </span>
                                <input class="form-control form-control-sm col-sm-4 mydatepicker" type="text" value="" id="dateunready_end" onchange="data();">
                                <button class="btn btn-sm btn-outline-primary"  onclick="dateallunready();"><i class="fa fa-calendar"></i> วันที่ทั้งหมด</button>
                            </div>
                            <div class="col-sm-2 text-right">
                                <button type="button" class="btn btn-sm btn-outline-warning" onclick="modal_receipt_transfer();"><i class="fa fa-truck"></i> ยืนยันการจัดส่งที่เลือก</button>
                            </div>
                        </div>
<!--                        <br/>
                        <div class="text-left col-12 text-right">
                            <button type="button" class="btn btn-sm btn-outline-warning" onclick="modal_receipt_transfer();"><i class="fa fa-truck"></i> ยืนยันการจัดส่งที่เลือก</button>
                        </div>-->
                    </div>
                </div>
                <br/>

                <div class="text-center" id="flash_message4500">
                    <?php
                    if ($this->session->flashdata('flash_message') != '') {
                        ?>
                        <br/>
                        <?php
                        echo $this->session->flashdata('flash_message');
                        ?>
                        <br/>
                        <?php
                    }
                    ?>                                
                </div>

                <div id="result-page"></div>

            </div>
        </div>
    </div>
</div>
