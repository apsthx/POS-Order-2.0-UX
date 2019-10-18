<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-block">
                <h4 class="card-title"><i class="<?php echo $icon; ?>"></i> <?php echo " " . $title; ?></h4>  
                <br/>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="text-right">
                            <input type="text" class="form-control form-control-sm col-sm-3" value="" id="search" style="float: left" placeholder="เลือกชื่อสินค้า แบรนด์ รุ่น" onkeyup="dateall_report();"/>                           
                            <span> เลือกวันที่ </span>
                            <input class="form-control form-control-sm col-sm-2 mydatepicker" type="text" value="" id="date_start_report" onchange="date_start_report();">
                            <span> ถึง </span>
                            <input class="form-control form-control-sm col-sm-2 mydatepicker" type="text" value="" id="date_end_report" onchange="data_report();">
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


<div class="modal fade" id="view">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

        </div>
    </div>
</div>