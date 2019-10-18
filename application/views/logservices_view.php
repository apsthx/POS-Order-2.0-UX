<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-block">
                <h4 class="card-title"><i class="<?php echo $icon; ?>"></i> <?php echo " " . $title; ?> 

                </h4>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-datatable">                
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>พฤติกรรม</th>  
                                <th>เลขที่เอกสาร</th> 
                                <th>วัน - เวลา</th> 
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
                                        <td><?php echo $data->action_text; ?></td>   
                                        <td><?php echo $data->services_master_id; ?></td>  
                                        <td><?php echo 'วันที่ '.$this->mics->date2thai($data->date_modify,'%d %m %y', '1').' เวลา '.$this->mics->date2thai($data->date_modify,'%h:%i:%s'); ?></td> 
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