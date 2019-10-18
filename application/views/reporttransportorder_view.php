<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-block">
                <h4 class="card-title"><i class="<?php echo $icon; ?>"></i> <?php echo " " . $title; ?></h4>  
                <br/>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="text-center">
                            <span> บริการขนส่ง </span>
                            <select id="transport_service_id" class="form-control form-control-sm col-sm-2" onchange="data_report();">
                                <option value="1" >Dropoff EMS</option>
                                <option value="2" >Kerry Express</option>
                            </select>&nbsp;&nbsp;
                            <span> เลือกวันที่ </span>
                            <input class="form-control form-control-sm col-sm-2 mydatepicker" type="text" value="<?php echo date('Y-m-d'); ?>" id="date_start_report" onchange="date_start_report();">
                            <span> ถึง </span>
                            <input class="form-control form-control-sm col-sm-2 mydatepicker" type="text" value="<?php echo date('Y-m-d'); ?>" id="date_end_report" onchange="data_report();">
                            <button class="btn btn-sm btn-outline-primary"  onclick="dateall_report();"><i class="fa fa-calendar"></i> วันที่ทั้งหมด</button>
                            <button class="btn btn-sm btn-outline-success"  onclick="excel();"><i class="fa fa-file-excel-o"></i> ออกรายงาน</button>
                            <button type="button" class="btn btn-sm btn-outline-warning" onclick="dateall_report();"><i class="fa fa-refresh"></i>&nbsp;รีโหลด</button>
                        </div>
                    </div>
                </div>
                <div class="table-responsive" id="result-page">

                </div>
            </div>
        </div>
    </div>
</div>