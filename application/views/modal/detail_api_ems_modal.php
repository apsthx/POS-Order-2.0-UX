<div class="modal-header">
    <h4 class="modal-title"><i class="fa fa-bars"></i>&nbsp;รายละเอียด</h4>
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
</div>
<div class="modal-body">
    <?php
    $authen_encode = "";
    $authenEMS = $this->checktransport_model->get_ems_api();
    if ($authenEMS->num_rows() > 0) {
        $authen = $authenEMS->row();
        $authen_encode = base64_encode($authen->username . ':' . $authen->password);
    }
    $context = stream_context_create(array(
        'http' => array(
            'method' => 'GET',
            'header' => "Authorization: Basic $authen_encode",
            'ignore_errors' => true
        )
    ));
    $response = file_get_contents("http://r_dservice.thailandpost.com:8080/webservice/getOrderByBarcode?barcode=" . $receipt->transport_tracking_id, false, $context);
    $object = json_decode($response);

    if (!is_array($object) && sizeof($object) > 0) {
        ?>
        <span class="<?php echo ($object->status == 4) ? 'text-success' : 'text-warning' ?>">
            <div class="row">
                <div class="col-sm-4 text-right">เลขพัสดุ</div>
                <div class="col-sm-6"> <?php echo $object->barcode; ?></div>
            </div>
            <div class="row">
                <div class="col-sm-4 text-right">ชื่อลูกค้า</div>
                <div class="col-sm-6"> <?php echo $object->customerName; ?></div>
            </div>
            <div class="row">
                <div class="col-sm-4 text-right">ที่อยู่</div>
                <div class="col-sm-6"> <?php echo $object->customerAddress . ' ' . $object->customerAmphur . ' ' . $object->customerProvince . ' ' . $object->customerZipcode; ?></div>
            </div>
            <div class="row">
                <div class="col-sm-4 text-right">น้ำหนัก</div>
                <div class="col-sm-6"> <?php echo $object->productWeight . ' กรัม'; ?></div>
            </div>
            <div class="row">
                <div class="col-sm-4 text-right">สถานะ</div>
                <div class="col-sm-6"> <?php echo $object->statusDescription; ?></div>
            </div>
            <div class="row">
                <div class="col-sm-4 text-right">ชื่อผูรับ</div>
                <div class="col-sm-6"> <?php echo ($object->signature != '') ? $object->signature : 'ไม่แสดง'; ?></div>
            </div>
            <div class="row">
                <div class="col-sm-4 text-right">วันที่รับของ</div>
                <div class="col-sm-6"> <?php echo $object->deliverdDate; ?></div>
            </div>
        </span>

        <?php
    } else {
        ?>
        <div class="row">
            <div class="col-sm-12 text-center">เกิดข้อผิดพลาด !</div>
        </div>
        <?php
    }
    ?>

</div>

<div class="modal-footer">
    <button type="button" class="btn" data-dismiss="modal" aria-hidden="true" ><i class="fa fa-close"></i>&nbsp;ปิด</button>
</div>