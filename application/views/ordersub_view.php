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
                            <label for="checkboxstatus"> แสดงรายการที่เสร็จสิ้น</label>
                        </div>
                    </div>
                </h4>  

                <div class="table-responsive" id="result-page">

                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="confirm-modal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-header">
                <h4 class="modal-title"><i class="fa fa-clipboard"></i>&nbsp;ออกใบแจ้งหนี้</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <div class="bootbox-body">
                    <form class="form-material m-t-10" action="<?php echo base_url() . 'invoice'; ?>" method="post" autocomplete="off">
                        <input type="hidden" name="id_pri_invoid" id='id_pri_invoid'>
                        <div class="row">
                            <input type="hidden" name="confirm_order_id" id='confirm_order_id'>
                            <label class="col-md-5 text-right">สถานะสินค้า</label>
                            <label class="col-md-5" id="status_confirm">สถานะสินค้า</label>
                        </div>
                        <div class="row">
                            <label class="col-md-5 text-right">สินเชื่อเคดิต</label>
                            <div class="col-md-3">
                                <select name="credit" class="form-control" >
                                    <option value="0">ไม่มี</option>
                                    <option value="15">15</option>
                                    <option value="30">30</option>
                                    <option value="60">60</option>
                                </select>
                            </div>
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


<div class="modal fade" id="cancel-modal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><i class="fa fa-edit"></i>&nbsp;ยกเลิกใบสั่งซื้อ</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <div class="bootbox-body">
                    <form class="form-material m-t-10" action="<?php echo base_url() . 'ordersub/cancel'; ?>" method="post" onsubmit="return cancel();" autocomplete="off">
                        <input type="hidden" name="id_pri_cancel" id='id_pri_cancel'>
                        <div class="form-group">
                            <label> ยกเลิกเพราะ : </label>
                            <input type="text" name="comment" id='comment' class="form-control form-control-line" required="">
                        </div>  
                        <div class="form-group">
                            <div class="col-md-12 text-center">
                                <button type="submit" class="btn btn-outline-info"><i class="fa fa-save"></i>&nbsp;บันทึก</button>
                                &nbsp;
                                <button type="button" class="btn btn-outline-danger" data-dismiss="modal" aria-hidden="true" ><i class="fa fa-close"></i>&nbsp;ยกเลิก</button>
                            </div>
                        </div>
                    </form>
                </div>                    
            </div>
        </div>
    </div>
</div>