<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-block">
                <h4 class="card-title"><i class="<?php echo $icon; ?>"></i> <?php echo " " . $title; ?></h4>  
                <br/>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="text-center">
                            <select id="user_id" class="form-control form-control-sm col-sm-2" onchange="data_report();">
                                <option value="" >พนักงานทั้งหมด</option>
                                <?php foreach ($this->reportsummarygroup_model->get_user()->result() as $user) { ?>
                                    <option value="<?php echo $user->user_id; ?>"><?php echo $user->fullname; ?></option>
                                <?php }
                                ?>
                            </select>
                            &nbsp;
                            <select id="customer_group_id" class="form-control form-control-sm col-sm-2" onchange="data_report();">
                                <option value="" >กลุ่มลูกค้าทั้งหมด</option>
                                <?php foreach ($this->reportsummarygroup_model->get_customer_group()->result() as $customer_group) { ?>
                                    <option value="<?php echo $customer_group->customer_group_id; ?>"><?php echo $customer_group->customer_group_name; ?></option>
                                <?php }
                                ?>
                            </select>
                            &nbsp;
                            <span> เลือกวันที่ </span>
                            <input class="form-control form-control-sm col-sm-2 mydatepicker" type="text" value="" id="date_start_report" onchange="date_start_report();">
                            <span> ถึง </span>
                            <input class="form-control form-control-sm col-sm-2 mydatepicker" type="text" value="" id="date_end_report" onchange="data_report();">
                            &nbsp;
                            <button class="btn btn-sm btn-outline-primary"  onclick="dateall_report();"><i class="fa fa-calendar"></i> วันที่ทั้งหมด</button>
                            <button class="btn btn-sm btn-outline-success"  onclick="excel();"><i class="fa fa-file-excel-o"></i> ออกรายงาน</button>
                            <button type="button" class="btn btn-sm btn-outline-warning" onclick="dateall_report();"><i class="fa fa-refresh"></i>&nbsp;รีโหลด</button>
                        </div>
                    </div>
                </div>
                <div class="table-responsive" id="result-page">

                </div>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="view">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

        </div>
    </div>
</div>