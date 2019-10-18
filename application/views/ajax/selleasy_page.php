<div id="for_load">
    <div class="row">
        <?php
        if ($datas->num_rows() > 0) {
            $i = $segment + 1;
            foreach ($datas->result() as $data) {
                ?>                    
                <div class="col-sm-2">
                    <a href="javascript:void(0);" onclick="get_product_by_id('<?php echo $data->product_id ?>')">
                    <img class="card-img-top" width="120px" height="120px" src="<?php echo base_url() . 'store/image/' . $data->image_name; ?>" alt="<?php echo $data->product_name; ?>">
                    </a>
                    <div class="card-body">
                        <ul class="list-inline font-14 text-center">
                            <li><?php echo 'เหลือ ' . number_format($data->product_amount, 0); ?></li>
                            <li class="text-inverse" ><?php echo $data->product_id; ?></li>
                            <li class="text-inverse" ><?php echo $data->product_name; ?></li>
                            <li class="text-primary" style="font-weight: bold;"><?php echo number_format($data->product_sale_price, 2); ?></li>
                        </ul>                                              
                    </div>
                </div>
                <?php
                $i++;
            }
        } else {
            ?>
        <div class="col-sm-12 text-center text-danger">
            <i class='fa fa-info-circle'></i> ไม่มีสินค้า
        </div>
        <?php }
        ?>
    </div>
</div>
<br/>
<?php
if ($search != "") {
    ?>
    <div class="col-sm-12 text-center">
        <span class="text-success"><b><i class="ico-search"></i> ค้นพบทั้งหมด <?php echo $count; ?></b></span> | <span onclick="loadtablecencal();" style="text-decoration:none; cursor: pointer;"><b class="text-danger"><i class="fa fa-remove"></i> ยกเลิกการค้นหา</b></span>
    </div>
    <?php
} else if ($count != 0) {
    ?>
    <div class="row">
        <div class="col-sm-6 text-left">
            แสดง <?php echo $segment + 1; ?> ถึง <?php echo $i - 1; ?> ทั้งหมด <?php echo ($count); ?>                                                 
        </div>
        <div class="col-sm-6 text-right">
            <?php echo $links; ?>
        </div>
    </div>
<?php } ?>
