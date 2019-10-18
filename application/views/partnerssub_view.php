<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-block">
                <h4 class="card-title"><i class="<?php echo $icon; ?>"></i> <?php echo " " . $title; ?>  </h4>  

                <div class="table-responsive">
                    <table class="table table-striped table-bordered" style="font-size: 14px;">                
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>ชื่อคู่ค้า</th>
                                <th>เลขประจำตัวผู้เสียภาษี</th>
                                <th>เบอร์โทรศัพท์</th>
                                <th>โทรสาร (Fax)</th>
                                <th>เว็บไซต์</th>
                                <th>อีเมล</th>
                                <th>ที่อยู่</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($datas->num_rows() > 0) {
                                $i = 1;
                                foreach ($datas->result() AS $data) {
                                    ?>
                                    <tr>
                                        <td><?php echo $i; ?></td>
                                        <td><?php echo $data->shop_name; ?></td>
                                        <td><?php echo $data->tax_id; ?></td>
                                        <td><?php echo $data->tel_shop; ?></td>
                                        <td><?php echo $data->fax_shop; ?></td>
                                        <td><?php echo $data->website_shop; ?></td>
                                        <td><?php echo $data->email_shop; ?></td>
                                        <td><?php echo $data->address_shop; ?></td>
                                    </tr> 
                                    <?php
                                    $i++;
                                }
                            }
                            ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
