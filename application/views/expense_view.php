<input type="hidden" id="product_id"/>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-block" id="_loadding">
                <h4 class="card-title">
                    <i class="<?php echo $icon; ?>"></i> <?php echo " " . $title; ?>
                    <button  type="button" style="float: right" onclick="modal_add();" class="btn btn-sm btn-rounded btn-outline-success">
                        <i class="fa fa-plus"></i> สร้างค่าใช้จ่าย
                    </button>
                    <div style="float: right" >
                        &nbsp;&nbsp;&nbsp;
                    </div>
                    <div style="float: right" >
                        <input type="checkbox"  name="" id="checkboxstatus" value="1" onchange="ajax();">
                        <label for="checkboxstatus"> แสดงรายการที่ถูกยกเลิก</label>
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
