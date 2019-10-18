<form method="post" action="<?php echo base_url() . 'stickertransport/printtransportsuccess'; ?>" onsubmit="data2();" target="_blank" autocomplete="off">
    <table class="table table-striped table-bordered table-datatable">  
        <div class="text-right">
            <button type="submit" class="btn btn-sm btn-outline-info"><i class="fa fa-print"></i>&nbsp;พิมม์สติ๊กเกอร์เสร็จสิ้นที่เลือก</button>
            <button type="reset" class="btn btn-sm btn-outline-danger" ><i class="fa fa-close"></i>&nbsp;ยกเลิก</button>
        </div>
        <thead>
            <tr>
                <th class="text-center" style="padding: 0px;">
                    <input type="checkbox" class="col-sm-4 offset-sm-2" name="" id="select_success_checkbox_all" onchange="select_success_all();">
                    <label for="select_success_checkbox_all">เลือก</label>
                </th>
                <th>#</th>
                <th>เลขที่ใบเสร็จ</th>
                <th>ลูกค้า</th>
                <th>พนักงาน</th>
                <th class="text-center">วันที่พิมพ์สติกเกอร์</th>
                <th>บริการขนส่ง</th>
                <th class="text-right">ค่าขนส่ง</th>
                <th class="text-center">สถานะ</th>
                <th class="text-center">ตัวเลือก</th>   
            </tr>
        </thead>
        <tbody>
            <?php
            $i = 1;
            if ($datas->num_rows() > 0) {
                foreach ($datas->result() as $data) {
                    ?>
                <input type="text" style="display:none;" name="success_master_id_pri_arr[<?php echo $i; ?>]" value="<?php echo $data->receipt_master_id_pri; ?>"/>
                <tr>
                    <td class="text-center">
                        <input type="checkbox" name="select_success_checkbox[<?php echo $i; ?>]" class="col-sm-4 offset-sm-2 select_success_checkbox" id="select_success_checkbox<?php echo $data->receipt_master_id; ?>">
                        <label style="margin-bottom: -5px" for="select_success_checkbox<?php echo $data->receipt_master_id; ?>"></label>
                    </td>
                    <td><?php echo $i; ?></td>
                    <td><?php echo $data->receipt_master_id; ?></td>
                    <td><?php echo $data->customer_name; ?></td>
                    <td><?php echo $this->stickertransport_model->get_user($data->user_id)->row()->fullname; ?></td>
                    <td class="text-center"><?php echo ' ' . $this->mics->dateen2stringthMS($data->date_sticker); ?></td>
                    <td><?php echo $data->transport_service_name; ?></td>
                    <td class="text-right"><?php echo number_format($data->transport_price, 2, '.', ','); ?></td>
                    <td class="text-center"><span class="badge badge-success"></i> <?php echo $this->stickertransport_model->ref_status_sticker_transport($data->status_sticker_transport_id)->row()->status_sticker_transport_name; ?></span></td>                        
                    <td class="text-center">
                        <a href="<?php echo base_url() . 'receiptdetail/' . $data->receipt_master_id_pri; ?>" target="_blank" class="btn btn-sm btn-outline-primary"><i class="fa fa-eye"></i> ดู</a>
                    </td>
                </tr>
                <?php
                $i++;
            }
        }
        ?>      
        </tbody>
    </table>
</form>


<script>
    $(document).ready(function () {
        $('.table-datatable').DataTable();
    });
</script>