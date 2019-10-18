<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-block">
                <h4 class="card-title"><i class="<?php echo $icon; ?>"></i> <?php echo " " . $title; ?></h4>  
                <br/>
                <div class="row">
                    <div class="col-3">
                        <div class="card">
                            <div class="card-block">
                                <p style="color: black;"><i class="mdi mdi-barcode-scan"></i> สแกนเลขที่ใบเสร็จ</p>
                                <input type="text" class="form-control" id='receipt_master_id' autofocus onkeypress="if (event.keyCode === 13) {
                                            datadetail();
                                        }">
                                <p></p>
                                <p style="color: black;"><i class="mdi mdi-barcode-scan"></i> สแกนเลขหมายเลขพัสดุ</p>
                                <input type="text" class="form-control" id='transport_tracking_id' onkeypress="if (event.keyCode === 13) {
                                            edit();
                                        }" disabled="">
                            </div>
                        </div>
                        <div class="alert alert-danger text-center">
                            <i class="mdi mdi-package-variant"></i> รอบรรจุทั้งทั้งหมด <div id="num-unready" style="font-weight: bold"></div>
                        </div>
                        <p></p>
                        <div class="alert alert-success text-center">
                            <i class="mdi mdi-package-variant-closed"></i> บรรจุแล้วทั้งหมด <div id="num-success" style="font-weight: bold"></div>
                        </div>
                    </div>
                    <div class="col-9">
                        <div class="card">
                            <div class="card-block">
                                <div class="table-responsive" id="result-page">
                                    <h4 class="text-center"><i class="mdi mdi-barcode"></i> สแกนเลขที่ใบเสร็จ</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <ul class="nav nav-tabs customtab" role="tablist">
                    <li class="nav-item"> <a onclick="data1();" class="nav-link active" data-toggle="tab" href="#unready" role="tab" aria-expanded="true"><span class="hidden-sm-up"><i class="ti-list"></i></span> <span class="hidden-xs-down">รอบรรจุ</span></a> </li>
                    <li class="nav-item"> <a onclick="data2();" class="nav-link" data-toggle="tab" href="#success" role="tab" aria-expanded="false"><span class="hidden-sm-up"><i class="ti-check-box"></i></span> <span class="hidden-xs-down">บรรจุแล้ว</span></a> </li>
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
                            <div class="col-sm-8">
                                <div class="text-center">
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
                                    <select id="successtransport_service_id" class="form-control form-control-sm" onchange="data2();">
                                        <option value="" >บริการขนส่งทั้งหมด</option>
                                        <option value="1" >Dropoff EMS</option>
                                        <option value="2" >Kerry Express</option>
                                        <option value="3" >จัดส่งเอง</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-8">
                                <div class="text-center">
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
