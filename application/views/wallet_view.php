<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-block">
                <h4 class="card-title">
                    <i class="<?php echo $icon; ?>"></i> <?php echo " " . $title; ?>
                    <button style="float: right" class="btn btn-sm btn-rounded btn-outline-success" onclick="modal_add();">
                        <i class="fa fa-plus"></i> เพิ่มบัญชีธนาคาร
                    </button>
                </h4>                
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-datatable">                  
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>เลขที่บัญชี</th>
                                <th>ธนาคาร</th>
                                <th>ชื่อเจ้าของบัญชี</th>
                                <th class="text-right">เงินในบัญชี (บาท)</th>
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
                                        <td><?php echo $i++; ?></td>
                                        <td><?php echo $data->bank_number; ?></td>
                                        <td><?php echo $data->bank_name; ?></td>
                                        <td><?php echo $data->bank_fullname; ?></td>
                                        <td class="text-right">
                                            <a href="javascript:void(0);" onclick="modal_edit_money(<?php echo $data->bank_id; ?>);">
                                                <?php echo number_format($data->bank_money, 2); ?>
                                            </a>
                                        </td>
                                        <td class="text-center">
                                            <?php
                                            if ($data->type_bank_id == 2) {
                                                ?>
                                                <button type="button" onclick="modal_edit(<?php echo $data->bank_id; ?>);" class="btn btn-sm btn-outline-info">
                                                    <i class="fa fa-edit"></i> แก้ไข
                                                </button>
                                                <button type="button" onclick="modal_delete(<?php echo $data->bank_id; ?>);" class="btn btn-sm btn-outline-danger">
                                                    <i class="fa fa-trash"></i> ลบ
                                                </button>
                                                <?php
                                            }
                                            ?>
                                        </td>
                                    </tr>
                                    <?php
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

<div class="modal fade" id="modal-open">
    <div class="modal-dialog">
        <div class="modal-content"></div>
    </div>
</div>