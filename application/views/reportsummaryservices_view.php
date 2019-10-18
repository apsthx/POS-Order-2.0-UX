<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-block">
                <h4 class="card-title"><i class="<?php echo $icon; ?>"></i> <?php echo " " . $title; ?></h4>  
                <br/>
                <div class="demo-radio-button">
                    <div class="row">
                        <div class="col-sm-4">
                            <input name="group1" type="radio" id="radio_1" value="1" checked="">
                            <label for="radio_1">ยอดขายประจำวัน</label>
                            <input class="form-control form-control-sm col-sm-5 mydatepicker" type="text" value="<?php echo date('Y-m-d'); ?>" id="dateday" >
                        </div>
                        <div class="col-sm-4">
                            <input name="group1" type="radio" id="radio_2" value="2">
                            <label for="radio_2">ยอดขายประจำเดือน</label>
                            <select class="form-control form-control-sm col-sm-5" id="datemonth">
                                <?php foreach ($this->reportsummaryservices_model->services_year()->result() as $yearmonth) { ?>
                                    <option value="<?php echo $yearmonth->year_pay . '-01'; ?>" <?php echo (date('Y-m') == $yearmonth->year_pay . '-01') ? 'selected' : ''; ?>>มกราคม<?php echo ' ปี ' . ($yearmonth->year_pay + 543); ?></option>
                                    <option value="<?php echo $yearmonth->year_pay . '-02'; ?>" <?php echo (date('Y-m') == $yearmonth->year_pay . '-02') ? 'selected' : ''; ?>>กุมภาพันธ์<?php echo ' ปี ' . ($yearmonth->year_pay + 543); ?></option>
                                    <option value="<?php echo $yearmonth->year_pay . '-03'; ?>" <?php echo (date('Y-m') == $yearmonth->year_pay . '-03') ? 'selected' : ''; ?>>มีนาคม<?php echo ' ปี ' . ($yearmonth->year_pay + 543); ?></option>
                                    <option value="<?php echo $yearmonth->year_pay . '-04'; ?>" <?php echo (date('Y-m') == $yearmonth->year_pay . '-04') ? 'selected' : ''; ?>>เมษายน<?php echo ' ปี ' . ($yearmonth->year_pay + 543); ?></option>
                                    <option value="<?php echo $yearmonth->year_pay . '-05'; ?>" <?php echo (date('Y-m') == $yearmonth->year_pay . '-05') ? 'selected' : ''; ?>>พฤษภาคม<?php echo ' ปี ' . ($yearmonth->year_pay + 543); ?></option>
                                    <option value="<?php echo $yearmonth->year_pay . '-06'; ?>" <?php echo (date('Y-m') == $yearmonth->year_pay . '-06') ? 'selected' : ''; ?>>มิถุนายน<?php echo ' ปี ' . ($yearmonth->year_pay + 543); ?></option>
                                    <option value="<?php echo $yearmonth->year_pay . '-07'; ?>" <?php echo (date('Y-m') == $yearmonth->year_pay . '-07') ? 'selected' : ''; ?>>กรกฎาคม<?php echo ' ปี ' . ($yearmonth->year_pay + 543); ?></option>                       
                                    <option value="<?php echo $yearmonth->year_pay . '-08'; ?>" <?php echo (date('Y-m') == $yearmonth->year_pay . '-08') ? 'selected' : ''; ?>>สิงหาคม<?php echo ' ปี ' . ($yearmonth->year_pay + 543); ?></option>
                                    <option value="<?php echo $yearmonth->year_pay . '-09'; ?>" <?php echo (date('Y-m') == $yearmonth->year_pay . '-09') ? 'selected' : ''; ?>>กันยายน<?php echo ' ปี ' . ($yearmonth->year_pay + 543); ?></option>
                                    <option value="<?php echo $yearmonth->year_pay . '-10'; ?>" <?php echo (date('Y-m') == $yearmonth->year_pay . '-10') ? 'selected' : ''; ?>>ตุลาคม<?php echo ' ปี ' . ($yearmonth->year_pay + 543); ?></option>
                                    <option value="<?php echo $yearmonth->year_pay . '-11'; ?>" <?php echo (date('Y-m') == $yearmonth->year_pay . '-11') ? 'selected' : ''; ?>>พฤศจิกายน<?php echo ' ปี ' . ($yearmonth->year_pay + 543); ?></option>
                                    <option value="<?php echo $yearmonth->year_pay . '-12'; ?>" <?php echo (date('Y-m') == $yearmonth->year_pay . '-12') ? 'selected' : ''; ?>>ธันวาคม<?php echo ' ปี ' . ($yearmonth->year_pay + 543); ?></option>
                                <?php }
                                ?>
                            </select>
                        </div>
                        <div class="col-sm-4">
                            <input name="group1" type="radio" id="radio_3" value="3">
                            <label for="radio_3">ยอดขายประจำปี</label>
                            <select class="form-control form-control-sm col-sm-5" id="dateyear">
                                <?php foreach ($this->reportsummaryservices_model->services_year()->result() as $year) { ?>
                                    <option value="<?php echo $year->year_pay; ?>"><?php echo $year->year_pay + 543; ?></option>
                                <?php }
                                ?>
                            </select>
                        </div>
                    </div>
                    <input name="group1" type="radio" id="radio_4" value="4">
                    <label for="radio_4">ยอดขายตั้งแต่</label>
                    <input class="form-control form-control-sm col-sm-2 mydatepicker" type="text" value="<?php echo date('Y-m-d'); ?>" id="datedaystart" > ถึง <input class="form-control form-control-sm col-sm-2 mydatepicker" type="text"  value="<?php echo date('Y-m-d'); ?>" id="datedayend" >
                    <br/>
                    <div class="row">
                        <div class="col-sm-4">
                            <input name="group1" type="radio" id="radio_5" value="5">
                            <label for="radio_5">ยอดขายทั้งหมด</label>
                        </div>
                        กลุ่มลูกค้า
                        <div class="col-sm-3 text-left">                           
                            <select id="customer_group_id" class="form-control form-control-sm">
                                <option value="" >กลุ่มลูกค้าทั้งหมด</option>
                                <?php foreach ($this->reportsummaryservices_model->ref_customer_group()->result() as $customer_group) { ?>
                                    <option value="<?php echo $customer_group->customer_group_id; ?>"><?php echo $customer_group->customer_group_name; ?></option>
                                <?php }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="text-center">
                        <button type="button" class="btn btn-sm btn-outline-primary" onclick="data();"><i class="fa fa-check-circle"></i>&nbsp;เลือก</button>
                        <button type="button" class="btn btn-sm btn-outline-success" onclick="excel();"><i class="fa fa-file-excel-o"></i>&nbsp;ออกรายงาน</button>
                        <button type="button" class="btn btn-sm btn-outline-warning" onclick="data();"><i class="fa fa-refresh"></i>&nbsp;รีโหลด</button>
                    </div>
                </div>
                <div class="table-responsive" id="result-page">

                </div>
            </div>
        </div>
    </div>
</div>