<div class="modal-header">
    <h4 class="modal-title"><i class="fa fa-eye"></i>&nbsp;หลักฐานใบบริการเลขที่ &nbsp;<?php echo $this->services_model->get_servicesmaster($services_master_id_pri)->row()->services_master_id; ?></h4>
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
</div>
<div class="modal-body">
    <div class="bootbox-body">
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover">
                <thead style="background-color: whitesmoke;">
                    <tr>
                        <th class="text-center">#</th> 
                        <th class="text-center">ชื่อไฟล์</th> 
                        <th class="text-center">ส่งหลักฐานโดย</th> 
                        <th class="text-center">วันที่ส่ง</th>
                        <th class="text-center">ตัวเลือก</th> 
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 1;
                    if ($data->num_rows() > 0) {
                        foreach ($data->result() as $datas) {
                            ?>
                            <tr>
                                <td class="text-center"><?php echo $i; ?></td>
                                <td class="text-center">
                                    <a  id="image_a" href="<?php echo base_url() . 'store/files/' . $datas->files_name; ?>" target="_blank">
                                        <img id="image_show" src="<?php echo base_url() . 'store/files/' . $datas->files_name; ?>" width="50" height="50" style="cursor:pointer;">
                                    </a>
                                </td>
                                <td class="text-left"><?php echo $datas->fullname; ?></td>
                                <td class="text-left"><?php echo $this->mics->date2thai($datas->files_create, '%d %m %y', 1); ?></td>
                                <td class="text-center">
                                    <!--<a class="btn btn-outline-primary btn-sm" href="<?php //echo base_url() . 'store/files/' . $datas->files_name; ?>" target="_blank"><i class="fa fa-download"></i> ดาวน์โหลดเอกสาร</a>-->
                                    <button class="btn btn-outline-danger btn-sm" onclick="delete_file('<?php echo $datas->files_id; ?>');" data-toggle="tooltip" data-original-title="ลบ"><i class="fa fa-trash"></i></button>
                                </td>
                            </tr>
                            <?php
                            $i++;
                        }
                    } else {
                        ?>
                        <tr>
                            <td class="text-center" colspan="5"><i class="fa fa-info-circle text-danger"></i>&nbsp;<span class="fa text-danger">ไม่มีข้อมูล</span></td>                                        
                        </tr>
                        <?php
                    }
                    ?>                                    
                </tbody>
            </table>   
        </div>
    </div>                    
</div>