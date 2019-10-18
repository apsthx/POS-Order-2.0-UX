<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-block">
                <h4 class="card-title"><i class="<?php echo $icon; ?>"></i> <?php echo " " . $title; ?></h4>  
                <div class="row">
                    <div class="col-sm-12">
                        <div class="text-center">
                            <span> เลือกวันที่ </span>
                            <input class="form-control form-control-sm col-sm-2 mydatepicker" type="text" value="" id="date_start" onchange="date_start();">
                            <span> ถึง </span>
                            <input class="form-control form-control-sm col-sm-2 mydatepicker" type="text" value="" id="date_end" onchange="data();">
                            <button class="btn btn-sm btn-outline-primary"  onclick="dateall();"><i class="fa fa-calendar"></i> วันที่ทั้งหมด</button>
                        </div>
                    </div>
                </div>
                <div class="table-responsive" id="result-page">

                </div>
            </div>
        </div>
    </div>
</div>