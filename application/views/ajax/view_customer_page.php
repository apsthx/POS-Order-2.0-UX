<ul class="nav nav-tabs customtab" role="tablist">
    <li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#transport" role="tab" aria-expanded="false"><span class="hidden-sm-up"><i class="ti-check-box"></i></span> <span class="hidden-xs-down">จัดส่งสินค้า</span></a> </li>
    <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#bill" role="tab" aria-expanded="false"><span class="hidden-sm-up"><i class="ti-check-box"></i></span> <span class="hidden-xs-down">ใบเสร็จ</span></a> </li>
    <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#order" role="tab" aria-expanded="true"><span class="hidden-sm-up"><i class="ti-list"></i></span> <span class="hidden-xs-down">ใบเปิด order</span></a> </li>   
</ul>
<div class="tab-content">

    <div class="tab-pane active" id="transport" role="tabpanel" aria-expanded="false">
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-datatable">      
                <thead>
                    <tr>
                        <th>#</th>
                        <th>เลขที่ใบเสร็จ</th>  
                        <th class="">หมายเลข EMS</th>
                        <th class="text-right">ค่าขนส่ง</th>
                        <th class="text-center">วันที่ส่งสินค้า</th>
                        <th class="text-center">ตัวเลือก</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $datatransports = $this->customer_model->transport($customer_id,$datestart,$dateend);
                    $i = 1;
                    foreach ($datatransports->result() as $datatransport) {
                        ?>
                        <tr>
                            <td><?php echo $i; ?></td>
                            <td><?php echo $datatransport->receipt_master_id; ?></td>
                            <td><?php echo $datatransport->transport_tracking_id; ?></td>
                            <td class="text-right"><?php echo number_format($datatransport->transport_price, 2); ?></td>
                            <td class="text-center"><?php echo $this->mics->dateen2stringthMS($datatransport->date_transfer); ?></td>
                            <td class="text-center"><a href="<?php echo base_url() . 'receiptdetail/' . $datatransport->receipt_master_id_pri; ?>" target="_blank" class="btn btn-sm btn-outline-primary"><i class="fa fa-eye"></i> ดู</a></td>
                        </tr>
                        <?php
                        $i++;
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="tab-pane" id="bill" role="tabpanel" aria-expanded="false">
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-datatable">      
                <thead>
                    <tr>
                        <th>#</th>
                        <th>เลขที่ใบเสร็จ</th>  
                        <th>เลขที่อ้างอิง</th>
                        <th class="text-right">ราคารวม</th>
                        <th class="text-center">วันที่ออกใบเสร็จ</th>
                        <th class="text-center">ตัวเลือก</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $databills = $this->customer_model->bill($customer_id,$datestart,$dateend);
                    $i = 1;
                    foreach ($databills->result() as $databill) {
                        ?>
                        <tr>
                            <td><?php echo $i; ?></td>
                            <td><?php echo $databill->receipt_master_id; ?></td>
                            <td><?php echo $databill->refer; ?></td>
                            <td class="text-right"><?php echo number_format($databill->price_sum_pay, 2); ?></td>
                            <td class="text-center"><?php echo $this->mics->dateen2stringthMS($databill->date_pay); ?></td>
                            <td class="text-center"><a href="<?php echo base_url() . 'receiptdetail/' . $databill->receipt_master_id_pri; ?>" target="_blank" class="btn btn-sm btn-outline-primary"><i class="fa fa-eye"></i> ดู</a></td>
                        </tr>
                        <?php
                        $i++;
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="tab-pane " id="order" role="tabpanel" aria-expanded="true">
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-datatable">      
                <thead>
                    <tr>
                        <th>#</th>
                        <th>เลขที่ใบเปิด Order</th>  
                        <th class="text-right">ราคารวม</th>
                        <th class="text-center">วันที่ออกใบ</th>
                        <th class="text-center">ตัวเลือก</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $dataorders = $this->customer_model->order($customer_id,$datestart,$dateend);
                    $i = 1;
                    foreach ($dataorders->result() as $dataorder) {
                        ?>
                        <tr>
                            <td><?php echo $i; ?></td>
                            <td><?php echo $dataorder->receipt_master_id; ?></td>
                            <td class="text-right"><?php echo number_format($dataorder->price_sum_pay, 2); ?></td>
                            <td class="text-center"><?php echo $this->mics->dateen2stringthMS($dataorder->date_receipt); ?></td>
                            <td class="text-center"><a href="<?php echo base_url() . 'receiptdetail/' . $dataorder->receipt_master_id_pri; ?>" target="_blank" class="btn btn-sm btn-outline-primary"><i class="fa fa-eye"></i> ดู</a></td>
                        </tr>
                        <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>    
</div>

<script>
    $(document).ready(function () {
        $('.table-datatable').DataTable();
    });
</script>

