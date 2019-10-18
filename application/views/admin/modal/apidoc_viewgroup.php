<div id="on_modal" tabindex="-1" role="dialog" class="modal fade">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><i class="fa fa-eye"></i>&nbsp;ผู้ใช้งานแพ็กเกจ</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <div class="bootbox-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered">                
                            <thead>
                                <tr>
                                    <th >#</th>
                                    <th class="text-center">ID กลุ่มลูกค้า (customer_group_id)</th>
                                    <th>กลุ่มลูกค้า</th> 
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i = 1;
                                if ($datas->num_rows() > 0) {
                                    foreach ($datas->result() as $data) {
                                        ?>
                                        <tr>
                                            <td class="text-right"><?php echo $i; ?></td>
                                            <td class="text-center"><?php echo $data->customer_group_id; ?></td>
                                            <td><?php echo $data->customer_group_name; ?></td>
                                        </tr>
                                        <?php
                                        $i++;
                                    }
                                } else {
                                    ?>
                                    <tr>
                                        <td class="text-center" colspan="3"><?php echo 'ไม่มีข้อมูล'; ?></td>
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
