<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-block">
                <h4 class="card-title"><i class="<?php echo $icon; ?>"></i> <?php echo " " . $title; ?></h4>  
                <br/>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="text-center">
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