<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-block">
                <h4 class="card-title"><i class="<?php echo $icon; ?>"></i> <?php echo " " . $title; ?></h4>                
                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                    <!--<table class="table table-striped table-bordered table-datatable">-->                  
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>ชื่อสิทธิ์การใช้งาน</th>
                                <th class="text-center">ตัวเลือก</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 1;
                            if ($datas->num_rows() > 0) {
                                foreach ($datas->result() as $data) {
                                    ?>
                                    <tr>
                                        <td><?php echo $i; ?></td>
                                        <td><?php echo $data->role_name; ?></td>
                                        <td class="text-center"><button type="button" onclick="modalset(<?php echo $data->role_id; ?>);" class="btn btn-sm btn-outline-info"><i class="fa fa-tags"></i> กำหนดสิทธิ์การใช้เมนู</button></td>
                                    </tr>
                                    <?php
                                    $i++;
                                }
                            } else {
                                
                            }
                            ?>                    
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="set">
    <div class="modal-dialog modal-lg">
        <div class="modal-content"></div>
    </div>
</div>