<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-block">
                <h4 class="card-title"><i class="<?php echo $icon; ?>"></i> <?php echo " " . $title; ?></h4>
                <div class="row">
                    <div class="col-sm-12 text-right">
                        <button type="button" class="btn btn-sm btn-outline-warning" onclick="modal_services_status();"><i class="fa fa-wrench"></i> ปรับสถานะดำเนินงาน</button>
                        <button type="button" class="btn btn-sm btn-outline-success" onclick="services_print();"><i class="fa fa-print"></i> ปริ้นที่เลือก</button>
                    </div>
                </div>

                <div class="text-center" id="flash_message4500">
                    <?php
                    if ($this->session->flashdata('flash_message') != '') {
                        ?>
                        <br/>
                        <?php
                        echo $this->session->flashdata('flash_message');
                        ?>
                        <br/>
                        <?php
                    }
                    ?>                                
                </div>
                <div id="result-page"></div>
            </div>
        </div>
    </div>
</div>
