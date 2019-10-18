<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-block" id="_loadding">
                <h4 class="card-title">
                    <div class="row">
                        <div class="col-md-6">
                            <i class="<?php echo $icon; ?>"></i> <?php echo " " . $title; ?> 
                        </div>
                        <div class="col-md-6 text-right">
<!--                            <input type="checkbox" class="col-sm-4 offset-sm-2" name="" id="checkboxstatus" value="1" onchange="ajax();">
                            <label for="checkboxstatus"> แสดงรายการที่ไม่ถูกต้อง</label>-->
                            &nbsp;
                            <button  type="button" style="float: right" onclick="modal_add();" class="btn btn-sm btn-rounded btn-outline-success">
                                <i class="fa fa-plus"></i> แจ้งโอน
                            </button>
                        </div>
                    </div>
                </h4> 

                <div class="table-responsive" id="result-page"></div>

            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="open-modal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content"></div>
    </div>
</div>
