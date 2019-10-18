<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-block">
                <h4 class="card-title"><i class="<?php echo $icon; ?>"></i> <?php echo " " . $title; ?></h4>


                <ul class="nav nav-tabs customtab" role="tablist">
                    <li class="nav-item"> <a onclick="data(1);" class="nav-link active" data-toggle="tab" href="#unready" role="tab" aria-expanded="true"><span class="hidden-sm-up"><i class="ti-list"></i></span> <span class="hidden-xs-down">รอดำเนินการ</span></a> </li>
                    <li class="nav-item"> <a onclick="data(2);" class="nav-link" data-toggle="tab" href="#success" role="tab" aria-expanded="false"><span class="hidden-sm-up"><i class="ti-check-box"></i></span> <span class="hidden-xs-down">เสร็จสิ้น</span></a> </li>
                    <li class="nav-item"> <a onclick="data(3);" class="nav-link" data-toggle="tab" href="#cancel" role="tab" aria-expanded="false"><span class="hidden-sm-up"><i class="ti-check-box"></i></span> <span class="hidden-xs-down">ยกเลิก</span></a> </li>
                </ul>


                <div class="tab-content">
                    <div class="tab-pane active" id="unready" role="tabpanel" aria-expanded="true">
                        <br/>
                        <div class="row">
                            
                            <div class="col-sm-6">
                                <span> เลือกวันที่ </span>
                                <input class="form-control form-control-sm col-sm-4 mydatepicker" type="text" value="" id="services_day_start" onchange="dateservices_day_start();">
                                <span> ถึง </span>
                                <input class="form-control form-control-sm col-sm-4 mydatepicker" type="text" value="" id="services_day_end" onchange="data();">
                                <button class="btn btn-sm btn-outline-primary"  onclick="dateallservices();"><i class="fa fa-calendar"></i> วันที่ทั้งหมด</button>
                            </div>
                            <div class="col-sm-2">
                                <select id="services_pay" class="form-control form-control-sm" onchange="services_pay();">
                                    <option value="" >สถานะส่งมอบทั้งหมด</option>
                                    <option value="2" >รอส่งมอบงาน</option>
                                    <option value="1" >ส่งมอบงานแล้ว</option>                                   
                                </select>
                            </div>
                            <div class="col-sm-4 text-right">
                                <button type="button" class="btn btn-sm btn-outline-info button_services_pay1" onclick="modal_services_pay1();"><i class="fa fa-truck"></i> ปรับสถานะรอส่งมอบ</button>
                                <button type="button" class="btn btn-sm btn-outline-info button_services_pay2" onclick="modal_services_pay2();"><i class="fa fa-truck"></i> ปรับสถานะส่งมอบงาน</button>
                                <button type="button" class="btn btn-sm btn-outline-warning button_services_status1" onclick="modal_services_status1();"><i class="fa fa-wrench"></i> ปรับสถานะดำเนินงาน</button>
                                <button type="button" class="btn btn-sm btn-outline-warning button_services_status2" onclick="modal_services_status2();"><i class="fa fa-wrench"></i> ปรับสถานะดำเนินงาน</button>
                                <button type="button" class="btn btn-sm btn-outline-success button_services_print" onclick="services_print();"><i class="fa fa-print"></i> ปริ้นที่เลือก</button>
                            </div>
                            
                        </div>
                    </div>
                </div>
                
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
