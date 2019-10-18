
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-block">
                <h4 class="card-title">
                    <i class="<?php echo $icon; ?>"></i> <?php echo " " . $title; ?>
                    <button type="button" style="float: right" class="btn btn-sm btn-rounded btn-outline-success" onclick="add_product_modal('<?php echo $stock->stock_id; ?>');"><i class="fa fa-plus"></i> เพิ่มสินค้าเข้าคลัง</button>
                </h4>

                <input type="hidden" id="stock_id_pri" value="<?php echo $stock_id_pri; ?>" />
                <div id="result-page" class="table-responsive"></div>


            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="open-modal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content"></div>
    </div>
</div>


<div class="modal fade in" id="modal-delete">
    <div class="modal-dialog">
        <div class="modal-content">
            <form onsubmit="return delete_product();">
                <div class="modal-header">
                    <h4 class="modal-title"><i class="fa fa-trash"></i>&nbsp;ยืนยันการลบข้อมูล</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <div class="bootbox-body text-center"><b>ยืนยันการลบข้อมูลนี้ ใช่หรือไม่ &nbsp;<i class="fa fa-question-circle"></i></b></div>
                    <input type="hidden" name="delete_id" id="delete_id">
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-outline-danger" id="delete_bt_modal" value="1"><i class="fa fa-trash"></i>&nbsp;ตกลง</button>
                    <button class="btn btn-outline-inverse" data-dismiss="modal"><i class="fa fa-close"></i>&nbsp;ยกเลิก</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade in" id="modal-alert">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><i class="fa fa-warning"></i>&nbsp;ข้อความแจ้งเตือน</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <div class="bootbox-body text-center"><b style="color:orange;" id="massage-alert"></b></div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-outline-inverse" data-dismiss="modal"><i class="fa fa-close"></i>&nbsp;ปิด</button>
            </div>
        </div>
    </div>
</div>

<script>
    var service_base_url = $('#service_base_url').val();
    $(function () {
        ajax();
    });

    function ajax() {
        var stock_id_pri = $('#stock_id_pri').val();
        $('body').loading();
        url = service_base_url + 'stock/ajax';
        $.ajax({
            url: url,
            method: "POST",
            data: {
                stock_id_pri: stock_id_pri
            },
            success: function (res)
            {
                $('#result-page').html(res);
                $('body').loading('stop');
            }
        });
    }
</script>

