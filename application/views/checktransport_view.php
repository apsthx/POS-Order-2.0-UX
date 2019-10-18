<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-block">
                <h4 class="card-title"><i class="<?php echo $icon; ?>"></i> <?php echo " " . $title; ?>
                    <button type="button" style="float: right"  onclick="modelprocessopen();" class="btn btn-sm btn-rounded btn-outline-danger"><i class="fa fa-refresh"></i> ประมวลผลข้อมูลตรวจสอบการจัดส่ง</button>
                </h4>  
                <ul class="nav nav-tabs customtab" role="tablist">
                    <li class="nav-item"> <a onclick="data1();" class="nav-link active" data-toggle="tab" href="#unready" role="tab" aria-expanded="true"><span class="hidden-sm-up"><i class="ti-list"></i></span> <span class="hidden-xs-down">รอดำเนินการ</span></a> </li>
                    <li class="nav-item"> <a onclick="data2();" class="nav-link" data-toggle="tab" href="#success" role="tab" aria-expanded="false"><span class="hidden-sm-up"><i class="ti-check-box"></i></span> <span class="hidden-xs-down">เสร็จสิ้น</span></a> </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="unready" role="tabpanel" aria-expanded="true">
                        <br/>
                        <div class="row">
                            <div class="col-sm-3">
                                <div class="text-left">
                                    <select id="unreadytransport_service_id" class="form-control form-control-sm" onchange="data1();">
                                        <option value="" >บริการขนส่งทั้งหมด</option>
                                        <option value="1" >Dropoff EMS</option>
                                        <option value="2" >Kerry Express</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="text-center">
                                    <select id="unreadytransport_status_id" class="form-control form-control-sm" onchange="data1();">
                                        <option value="1" >กำลังส่งสินค้า</option>
                                        <option value="3" >รายการส่งกลับ</option>
                                        <option value="5" >เกิดข้อผิดพลาด</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-7">
                                <div class="text-right">
                                    <span> เลือกวันที่ </span>
                                    <input class="form-control form-control-sm col-sm-4 mydatepicker" type="text" value="" id="dateunready_start" onchange="dateunready_start();">
                                    <span> ถึง </span>
                                    <input class="form-control form-control-sm col-sm-4 mydatepicker" type="text" value="" id="dateunready_end" onchange="data1();">
                                    <button class="btn btn-sm btn-outline-primary"  onclick="dateallunready();"><i class="fa fa-calendar"></i> วันที่ทั้งหมด</button>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive" id="result-page-unready">

                        </div>
                    </div>
                    <div class="tab-pane" id="success" role="tabpanel" aria-expanded="false">
                        <br/>
                        <div class="row">
                            <div class="col-sm-3">
                                <div class="text-left">
                                    <select id="successtransport_service_id" class="form-control form-control-sm" onchange="data2();">
                                        <option value="" >บริการขนส่งทั้งหมด</option>
                                        <option value="1" >Dropoff EMS</option>
                                        <option value="2" >Kerry Express</option>
                                        <option value="3" >จัดส่งเอง</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="text-center">

                                </div>
                            </div>
                            <div class="col-sm-7">
                                <div class="text-right">                                 
                                    <span> เลือกวันที่ </span>
                                    <input class="form-control form-control-sm col-sm-4 mydatepicker" type="text" value="" id="datesuccess_start" onchange="datesuccess_start();">
                                    <span> ถึง </span>
                                    <input class="form-control form-control-sm col-sm-4 mydatepicker" type="text" value="" id="datesuccess_end" onchange="data2();">
                                    <button class="btn btn-sm btn-outline-primary"  onclick="dateallsuccess();"><i class="fa fa-calendar"></i> วันที่ทั้งหมด</button>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive" id="result-page-success">

                        </div>                        
                    </div>
                    <div class="text-center text-danger">
                        <?php
                        $process = $this->checktransport_model->get_process_transport();
                        if ($process->num_rows() > 0) {
                            echo '* ประมวลผลข้อมูล ณ วันที่ ' . $this->mics->date2thai($process->row()->date_modify, '%d %m %y %h:%i:%s') . ' นาฬิกา โดย ' . $process->row()->fullname;
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="modelprocess">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="<?php echo base_url() . 'transportprocess/process' ?>" onsubmit="return submit_process();" method="post" >
                <div class="modal-header">
                    <h4 class="modal-title"><i class="fa fa-save"></i>&nbsp;ยืนยันการประมวลผลข้อมูล</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button></div>
                <div class="modal-body">
                    <div class="bootbox-body text-center text-success"><b><i class="fa fa-refresh"></i>&nbsp;ประมวลผลข้อมูลตรวจสอบการจัดส่ง</b></div>                    
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success"><i class="fa fa-check"></i>&nbsp;ตกลง</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal" aria-hidden="true"><i class="fa fa-close"></i>&nbsp;ยกเลิก</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="open-modal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

        </div>
    </div>
</div>