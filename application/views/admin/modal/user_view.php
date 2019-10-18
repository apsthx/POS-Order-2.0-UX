<div id="on_modal" tabindex="-1" role="dialog" class="modal fade">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><i class="fa fa-eye"></i>&nbsp;สาขาย่อย/ตัวแทนจำหน่าย</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <div class="bootbox-body">
                    <div class="table-responsive">
                    <table class="table table-striped table-bordered">                
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>รหัสร้าน</th>
                                <th>ร้าน</th> 
                                <th>ผู้จัดการ</th>
                                <th>username</th>
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
                                        <td><?php echo $data->shop_id; ?></td>
                                        <td class=""><?php echo $data->shop_name; ?></td>
                                        <td><?php echo $data->fullname; ?></td>
                                        <td class=""><?php echo $data->username; ?></td>
                                    </tr>
                                    <?php
                                    $i++;
                                }
                            } else {
                                ?>
                                <tr>
                                    <td class="text-center" colspan="5"><?php echo 'ไม่มีข้อมูล'; ?></td>
                                </tr>
                                <?php
                            }
                            ?>          
                        </tbody>
                    </table>
                </div>
                </div>                    
            </div>
        </div>                    
    </div>
</div>                    
