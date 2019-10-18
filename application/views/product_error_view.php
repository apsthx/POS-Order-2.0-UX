<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-block" id="_loadding">
                <h4 class="card-title"><i class="<?php echo $icon; ?>"></i> <?php echo " " . $title . " (Import Error)"; ?></h4> 

                <br/>
                <div class="table-responsive">
                    <table class="table table-bordered table-hover table-striped">
                        <thead>
                            <tr>
                                <th width="80">#</th>
                                <th>ข้อความ Error</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (sizeof($error) > 0) {
                                $i = 1;
                                foreach ($error as $row) {
                                    ?>
                                    <tr>
                                        <td><?php echo $i++; ?></td>
                                        <td><?php echo $row['massage']; ?></td>
                                    </tr>
                                    <?php
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

<div class="modal fade" id="open-modal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content"></div>
    </div>
</div>

<div class="modal fade in" id="modal-delete">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="<?php echo base_url() . 'product/delete' ?>" method="post">
                <div class="modal-header">
                    <h4 class="modal-title"><i class="fa fa-trash"></i>&nbsp;ยืนยันการลบข้อมูล</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <div class="bootbox-body text-center"><b>ยืนยันการลบข้อมูลนี้ ใช่หรือไม่ &nbsp;<i class="fa fa-question-circle"></i></b></div>
                    <input type="hidden" name="delete_id" id="delete_id">
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-outline-danger" id="delete_bt_modal" value="1"><i class="fa fa-trash"></i>&nbsp;ตกลง</button>
                    <button class="btn btn-outline-inverse" data-dismiss="modal"><i class="fa fa-close"></i>&nbsp;ยกเลิก</button>
                </div>
            </form>
        </div>
    </div>
</div>


<div class="modal fade in" id="modal-delete-no">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><i class="fa fa-trash"></i>&nbsp;ยืนยันการลบข้อมูล</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <div class="bootbox-body text-center"><b style="color: #F89A14;">ไม่สามารถลบข้อมูลนี้ได้ เนื่องจากข้อมูลมีการถูกใช้งาน &nbsp;<i class="fa fa-warning"></i></b></div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-outline-inverse" data-dismiss="modal"><i class="fa fa-close"></i>&nbsp;ปิด</button>
            </div>
        </div>
    </div>
</div>


<div class="modal fade in" id="modal-pull-product">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="<?php echo base_url() . 'product/pull'; ?>" onsubmit="return pull_product();" method="post">
                <div class="modal-header">
                    <h4 class="modal-title"><i class="fa fa-database"></i>&nbsp;ดึงรายการสินค้า</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <div class="bootbox-body text-center"><b>ต้องการดึงรายการสินค้าจากร้านหลัก ใช่หรือไม่ &nbsp;<i class="fa fa-question-circle"></i></b></div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-outline-success" ><i class="fa fa-plus"></i>&nbsp;ตกลง</button>
                    <button type="button" class="btn btn-outline-inverse" data-dismiss="modal"><i class="fa fa-close"></i>&nbsp;ปิด</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="import_modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">
                    นำเข้าไฟล์ (CSV)
                    <a href="<?php echo base_url() . 'assets/product_form.csv'; ?>" class="btn btn-info btn-sm"><i class="fa fa-download"></i>&nbsp;ดาวน์โหลดแบบฟอร์ม</a>
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <div class="bootbox-body">

                    <form method="post" action="<?php echo base_url() . 'product/import'; ?>" onsubmit="return submit_import();" enctype="multipart/form-data" autocomplete="off">

                        <div class="row">
                            <label class="col-sm-4 control-label text-right">หมวดหมู่สินค้า</label>
                            <div class="col-sm-6">
                                <select name="customer_group_id" class="form-control form-control-sm" required="">
                                    <option value="">-- เลือกหมวดหมู่ --</option>
                                    <?php
                                    $groups = $this->db->where('shop_id_pri', $this->session->userdata('shop_id_pri'))->get('product_category');
                                    if ($groups->num_rows() > 0) {
                                        foreach ($groups->result() as $row) {
                                            ?>
                                            <option value="<?php echo $row->product_category_id; ?>"><?php echo $row->product_category_name; ?></option>
                                            <?php
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <br/>
                        <div class="row">
                            <div class="col-sm-2"></div>
                            <div class="col-sm-8">
                                <input type="file" name="file" accept=".csv" class="form-control form-control-sm" required=""/>
                            </div>
                        </div>
                        <br/>
                        <div class="row">
                            <div class="col-sm-12 text-center">
                                <button type="submit" class="btn btn-outline-info"><i class="fa fa-save"></i>&nbsp;บันทึก</button>
                                <button type="button" class="btn btn-outline-danger" data-dismiss="modal" aria-hidden="true" ><i class="fa fa-close"></i>&nbsp;ยกเลิก</button>
                            </div>
                        </div>

                    </form>

                </div>                    
            </div>
        </div>
    </div>
</div>