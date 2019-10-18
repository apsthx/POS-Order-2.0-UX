<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-block">
                <h4 class="card-title">
                    <div class="row">
                        <div class="col-md-6">
                            <i class="<?php echo $icon; ?>"></i> <?php echo " " . $title; ?> 
                        </div>
                        <div class="col-md-6 text-right">
                            <input type="checkbox" id="checkboxstatus" value="1" onchange="data();">
                            <label for="checkboxstatus"> แสดงรายการที่ถูกระงับ</label>
                        </div>
                    </div>
                </h4> 

                <div class="table-responsive" id="result-page">

                </div>               
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="edit">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

        </div>
    </div>
</div>
