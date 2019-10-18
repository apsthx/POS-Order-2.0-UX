<div class="row">
    <!-- Column -->
    <div class="col-lg-3 col-md-6">
        <div class="card">
            <div class="card-block">
                <a href="<?php echo base_url() . 'reportsummary'; ?>" target="_blank">
                    <div class="d-flex flex-row">
                        <div class="round round-lg align-self-center round-info"><i class="fa fa-money"></i></div>
                        <div class="m-l-10 align-self-center">
                            <?php $sum_receipt_today = $this->home_model->sum_receipt_today()->row()->price_sum_pay; ?>
                            <h3 class="m-b-0 font-light"><?php echo ($sum_receipt_today != null) ? number_format($sum_receipt_today, 2) . ' บาท' : '0.00' . ' บาท'; ?></h3>
                            <h5 class="text-muted m-b-0">ยอดขายวันนี้</h5></div>
                    </div>
                </a>
            </div>
        </div>
    </div>
    <!-- Column -->
    <!-- Column -->
    <div class="col-lg-3 col-md-6">
        <div class="card">
            <div class="card-block">
                <a href="<?php echo base_url() . 'reportsummary'; ?>" target="_blank">
                    <div class="d-flex flex-row">
                        <div class="round round-lg align-self-center round-warning"><i class="ti-wallet"></i></div>
                        <div class="m-l-10 align-self-center">
                            <?php $sum_receipt_month = $this->home_model->sum_receipt_month()->row()->price_sum_pay; ?>
                            <h3 class="m-b-0 font-light"><?php echo ($sum_receipt_month != null) ? number_format($sum_receipt_month, 2) . ' บาท' : '0.00' . ' บาท'; ?></h3>
                            <h5 class="text-muted m-b-0">ยอดขายเดือนนี้</h5></div>
                    </div>
                </a>
            </div>
        </div>
    </div>
    <!-- Column -->
    <!-- Column -->
    <div class="col-lg-3 col-md-6">
        <div class="card">
            <div class="card-block">
                <a href="<?php echo base_url() . 'reportsummary'; ?>" target="_blank">
                    <div class="d-flex flex-row">
                        <div class="round round-lg align-self-center round-primary"><i class="fa fa-bank"></i></div>
                        <div class="m-l-10 align-self-center">
                            <?php $sum_receipt_year = $this->home_model->sum_receipt_year()->row()->price_sum_pay; ?>
                            <h3 class="m-b-0 font-light"><?php echo ($sum_receipt_year != null) ? number_format($sum_receipt_year, 2) . ' บาท' : '0.00' . ' บาท'; ?></h3>                       
                            <h5 class="text-muted m-b-0">ยอดขายปีนี้</h5></div>
                    </div>
                </a>
            </div>
        </div>
    </div>
    <!-- Column -->
    <!-- Column -->
    <div class="col-lg-3 col-md-6">
        <div class="card">
            <div class="card-block">
                <a href="<?php echo base_url() . 'customer'; ?>" target="_blank">
                    <div class="d-flex flex-row">
                        <div class="round round-lg align-self-center round-danger"><i class="fa fa-users"></i></div>
                        <div class="m-l-10 align-self-center">
                            <?php $count_customer = $this->home_model->count_customer(); ?>
                            <h3 class="m-b-0 font-lgiht"><?php echo $count_customer . ' คน'; ?></h3>
                            <h5 class="text-muted m-b-0">จำนวนลูกค้า</h5></div>
                    </div>
                </a>
            </div>
        </div>
    </div>
    <!-- Column -->
</div>

<div class="row">
    <!-- Column -->
    <div class="col-lg-4">
        <div class="card">
            <div class="card-block">
                <h4 class="card-title">รายการ</h4>
                <h6 class="card-subtitle">รอดำเนินการ</h6>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="card card-primary">
                            <div class="card-block">
                                <a href="<?php echo base_url() . 'receipt'; ?>" target="_blank">
                                    <div class="m-l-12 text-center">
                                        <h3 class="m-b-0 font-light" style="color: white"><?php echo $this->home_model->count_order(); ?></h3>
                                        <h5 class="m-b-0" style="color: white">รอชำระเงิน</h5>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="card card-success">
                            <div class="card-block">
                                <a href="<?php echo base_url() . 'stickertransport'; ?>" target="_blank">
                                    <div class="m-l-12 text-center">
                                        <h3 class="m-b-0 font-lgiht" style="color: white"><?php echo $this->home_model->count_sticker_transport(); ?></h3>
                                        <h5 class="m-b-0" style="color: white">รอติดสติ๊กเกอร์</h5>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <div class="card card-info">
                        <div class="card-block">
                            <a href="<?php echo base_url() . 'pack'; ?>" target="_blank">
                                <div class="m-l-12 text-center">
                                    <h3 class="m-b-0 font-lgiht" style="color: white"><?php echo $this->home_model->count_pack(); ?></h3>
                                    <h5 class="m-b-0" style="color: white">รอบรรจุ</h5>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card card-warning">
                        <div class="card-block">
                            <a href="<?php echo base_url() . 'transport'; ?>" target="_blank">
                                <div class="m-l-12 text-center">
                                    <h3 class="m-b-0 font-lgiht" style="color: white"><?php echo $this->home_model->count_transfer(); ?></h3>
                                    <h5 class="m-b-0" style="color: white">รอจัดส่งสินค้า</h5>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Column -->
<div class="col-lg-8">
    <div class="card">
        <div class="card-block">
            <div class="row">
                <div class="col-12">
                    <div class="d-flex flex-wrap">
                        <div>
                            <h4 class="card-title">รายการ</h4>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div id="container" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

<div class="row">
    <div class="col-lg-4">
        <div class="card">
            <div class="card-block">
                <h4 class="card-title">รายการ</h4>
                <a href="<?php echo base_url() . 'reportproductbuy'; ?>" target="_blank"><h6 class="card-subtitle">สินค้าขายดี</h6></a>
                <ul class="feeds">
                    <?php
                    $hit_products = $this->home_model->hit_product();
                    if ($hit_products->num_rows() > 0) {
                        foreach ($hit_products->result() as $hit_product) {
                            ?>
                            <li>
                                <i class="fa fa-star text-warning"></i><?php echo ' ' . $hit_product->product_name . ' (' . $hit_product->product_id . ')'; ?><span class="text-inverse" style="font-size: 18px"><?php echo $hit_product->product_amount; ?></span>
                            </li>
                            <?php
                        }
                    }
                    ?> 
                </ul>
            </div>
        </div>
    </div>
    <div class="col-lg-8">
        <div class="card">
            <div class="card-block">
                <h4 class="card-title">รายการ</h4>
                <a href="<?php echo base_url() . 'receipt'; ?>" target="_blank"><h6 class="card-subtitle">ใบเปิด order</h6></a>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered">                
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>เลขที่</th>
                                <th class="text-right">ราคารวม</th>
                                <th>วันที่ออกใบ</th>
                                <th class="text-center">ตัวเลือก</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $orders = $this->home_model->order();
                            $i = 1;
                            if ($orders->num_rows() > 0) {
                                foreach ($orders->result() as $order) {
                                    ?>
                                    <tr>
                                        <td><?php echo $i; ?></td>
                                        <td><?php echo $order->receipt_master_id; ?></td>
                                        <td class="text-right"><?php echo number_format($order->price_sum_pay, 2); ?></td>
                                        <td class="text-center"><?php echo $this->mics->dateen2stringthMS($order->date_receipt); ?></td>
                                        <td class="text-center"><a href="<?php echo base_url() . 'receiptdetail/' . $order->receipt_master_id_pri; ?>" target="_blank" class="btn btn-sm btn-outline-primary"><i class="fa fa-eye"></i> ดู</a></td>
                                    </tr>
                                    <?php
                                }
                            } else {
                                ?>
                                <tr>
                                    <td class="text-center" colspan="5"><?php echo 'ไม่มีข้อมูล'; ?></td>
                                </tr>
                                <?php
                            }
                            if ($orders->num_rows() > 10) {
                                ?>
                                <tr>
                                    <td class="" colspan="4"><?php echo 'อื่นจำนวน ' . (10 - $this->home_model->count_order()) . ' รายการ'; ?></td>
                                    <td class="text-center"><a href="<?php echo base_url() . 'receipt'; ?>" target="_blank" class="btn btn-sm btn-outline-primary"><i class="fa fa-eye"></i> ดู</a></td>
                                </tr>
                            <?php }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>