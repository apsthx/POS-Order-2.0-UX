<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-block">
                <h4 class="card-title"><i class="<?php echo $icon; ?>"></i> <?php echo " " . $title; ?></h4>  
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
                                    <select id="customer_group_id" class="form-control form-control-sm" onchange="data1();">
                                        <option value="" >กลุ่มลูกค้าทั้งหมด</option>
                                        <?php foreach ($this->stickertransport_model->ref_customer_group()->result() as $customer_group) { ?>
                                            <option value="<?php echo $customer_group->customer_group_id; ?>"><?php echo $customer_group->customer_group_name; ?></option>
                                        <?php }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-8">
                                <div class="text-left">
                                    <span> เลือกวันที่ </span>
                                    <input class="form-control form-control-sm col-sm-3 mydatepicker" type="text" value="" id="dateunready_start" onchange="dateunready_start();">
                                    <span> ถึง </span>
                                    <input class="form-control form-control-sm col-sm-3 mydatepicker" type="text" value="" id="dateunready_end" onchange="data1();">
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
                                    <select id="transport_service_id" class="form-control form-control-sm" onchange="data2();">
                                        <option value="" >บริการขนส่งทั้งหมด</option>
                                        <option value="1" >Dropoff EMS</option>
                                        <option value="2" >Kerry Express</option>
                                        <option value="3" >จัดส่งเอง</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-8">
                                <div class="text-left">                                 
                                    <span> เลือกวันที่ </span>
                                    <input class="form-control form-control-sm col-sm-3 mydatepicker" type="text" value="" id="datesuccess_start" onchange="datesuccess_start();">
                                    <span> ถึง </span>
                                    <input class="form-control form-control-sm col-sm-3 mydatepicker" type="text" value="" id="datesuccess_end" onchange="data2();">
                                    <button class="btn btn-sm btn-outline-primary"  onclick="dateallsuccess();"><i class="fa fa-calendar"></i> วันที่ทั้งหมด</button>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive" id="result-page-success">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modelsuccess">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><i class="fa fa-save"></i>&nbsp;บันทึกการพิมพ์สติ๊กเกอร์เสร็จสิ้น</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button></div>
            <div class="modal-body">
                <div class="bootbox-body text-center text-success"><b>สถานะการพิมพ์สติ๊กเกอร์ บันทึกเสร็จสิ้น&nbsp;<i class="fa fa-check-circle-o"></i></b></div>                    
            </div>
            <div class="modal-footer">
                <a href="javascript:void(0)" class="btn btn-success" onclick="modalsuccessclose();"><i class="fa fa-check"></i>&nbsp;ตกลง</a>
            </div>
        </div>
    </div>
</div>

