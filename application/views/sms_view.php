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
                                <th>บริษัท/ร้านค้า</th>
                                <th>เบอร์ที่ใช้ส่ง</th>
                                <th>ยอด SMS ทั้งหมด</th>
                                <th>เครดิตคงเหลือ</th>
                                <th>เครดิตทั้งหมด</th>                               
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
                                        <td><?php echo $data->shop_name; ?></td>
                                        <td><?php echo $data->setting_sms_number; ?></td>
                                        <td><?php echo $data->credit_sum; ?></td>
                                        <td><?php echo $data->credit_balance; ?></td>
                                        <td><?php echo $data->credit_all; ?></td>
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

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-block">
                <h4 class="card-title"><i class="fa fa-envelope"></i> <?php echo " " . $title . ' - Email'; ?>
                    <button type="button" style="float: right" class="btn btn-sm btn-rounded btn-outline-success" onclick="modalsend();"><i class="fa fa-send"></i> ส่งข้อความ</button>
                </h4>
                <div class="table-responsive" id="result-page" >

                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="send">
    <div class="modal-dialog" style="max-width: 90vw !important;">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><i class="fa fa-edit"></i>&nbsp;ส่งข้อความ</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <div class="bootbox-body">
                    <form class="form-horizontal" id="formsend" method="post" onsubmit="return send();" autocomplete="off" enctype="multipart/form-data">
                        <div class="form-group row">
                            <label class="col-sm-2 text-right control-label col-form-label">ประเภทการส่ง :</label>
                            <div class="col-sm-8" style="padding-top: 6px">
                                <span class="radio custom-radio custom-radio-success">  
                                    <input type="radio" name="advt_type"  id="advt_type1" value="1" checked="">  
                                    <label for="advt_type1">&nbsp;&nbsp;SMS</label>   
                                    <?php $credit_balance = $this->accesscontrol->checksms()->credit_balance; ?>
                                    <label class="text-warning" id="send_sms_text" style=""><?php echo '( เครดิต SMS คงเหลือ ' . number_format($credit_balance, 0) . ' เครดิต )'; ?> </label>
                                </span>
                                <span class="radio custom-radio custom-radio-danger">  
                                    <input type="radio" name="advt_type"  id="advt_type2" value="2">  
                                    <label for="advt_type2">&nbsp;&nbsp;Email</label>   
                                </span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-2 text-right" style="padding-top: 6px">
                                <span class="radio custom-radio custom-radio-success">  
                                    <input type="radio" name="sends"  id="sends1" value="1" checked="">  
                                    <label for="sends1">&nbsp;&nbsp;ชื่อ - สกุล :</label> 
                                </span>                   
                            </div>
                            <div class="col-sm-9">
                                <input type="hidden" name="customer_id_pri"  id="customer_id_pri" class="form-control">  
                                <input type="text" name="customer_name" id="customer_name" onkeydown="getAutocomplete('#customer_name');" class="form-control">  
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-2 text-right" style="padding-top: 6px">
                                <span class="radio custom-radio custom-radio-success">  
                                    <input type="radio" name="sends"  id="sends2" value="2">  
                                    <label for="sends2">&nbsp;&nbsp;กลุ่มลูกค้า :</label>   
                                </span>
                            </div>
                            <div class="col-sm-3">
                                <select name="customer_group_id" id='customer_group_id' class="form-control">
                                    <option value="0"><?php echo 'ทั้งหมด'; ?></option>
                                    <?php foreach ($this->sms_model->get_groupcustomer()->result() as $data) { ?>
                                        <option value="<?php echo $data->customer_group_id; ?>"><?php echo $data->customer_group_name; ?></option>
                                    <?php }
                                    ?>
                                </select>
                            </div>
                            <label class="col-sm-1 text-right control-label col-form-label">เลือกวันที่ :</label>
                            <div class="col-sm-2">
                                <input name="start_customer_id" id="start_customer_id" class="form-control mydatepicker" readonly="" type="text" onchange="date_start();">  
                            </div>
                            <div class="col-sm-1 text-center" style="padding-top: 6px">&nbsp;ถึง&nbsp;</div>
                            <div class="col-sm-2">
                                <input name="end_customer_id" id="end_customer_id" class="form-control mydatepicker" readonly="" type="text">   
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 text-right control-label col-form-label">เรื่อง :</label>
                            <div class="col-sm-9">
                                <input type="text" name="advt_header" id="advt_header" class="form-control">  
                            </div>
                        </div>
                        <div id='input_advt_message' class="form-group row" style="display: none;">
                            <label class="col-sm-2 text-right control-label col-form-label">ข้อความ :</label>
                            <div class="col-sm-9">
                                <textarea name="advt_message" id="advt_message" class="form-control"></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-12 text-center">
                                <button type="submit" value="save" class="btn btn-outline-info"><i class="fa fa-send-o"></i>&nbsp;ส่งข้อความ</button>
                                &nbsp;
                                <button type="button" class="btn btn-outline-danger" data-dismiss="modal" aria-hidden="true" ><i class="fa fa-close"></i>&nbsp;ยกเลิก</button>
                            </div>
                        </div>
                    </form>
                </div>                    
            </div>
        </div>
    </div>
</div>
