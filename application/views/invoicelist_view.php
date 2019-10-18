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
                            <input type="checkbox" class="col-sm-4 offset-sm-2" name="" id="checkboxstatus" value="1" onchange="data();" >
                            <label for="checkboxstatus"> แสดงรายการที่ชำระเงินแล้ว</label>
                        </div>
                    </div>
                </h4>  

                <div class="table-responsive" id="result-page">

                </div>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="open-modal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content"></div>
    </div>
</div>


<div class="modal fade" id="confirm-modal">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h4 class="modal-title"><i class="fa fa-truck"></i>&nbsp;ยืนยันได้รับของ</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <div class="bootbox-body">
                    <form class="form-material m-t-10" action="<?php echo base_url() . 'invoicelist/confirm_transfer'; ?>" method="post" autocomplete="off">
                        <input type="hidden" name="id_pri_invoid" id='id_pri_invoid'>
                        <div class="row">
                            <label class="col-md-12 text-center">หากกดยืนยันจำนวนสินค้าจะเพิ่มให้อัตโนมัติ</label>
                        </div>
                        <br/>
                        <div class="row">
                            <div class="col-md-12 text-center">
                                <button type="submit" class="btn btn-outline-info" id="bt-confirm"><i class="fa fa-save"></i>&nbsp;บันทึก</button>
                                <button type="button" class="btn btn-outline-danger" data-dismiss="modal" aria-hidden="true" ><i class="fa fa-close"></i>&nbsp;ยกเลิก</button>
                            </div>
                        </div>
                    </form>
                </div>                    
            </div>

        </div>
    </div>
</div>