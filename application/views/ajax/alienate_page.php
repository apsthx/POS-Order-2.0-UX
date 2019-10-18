<table class="table table-striped table-bordered table-datatable">
    <thead>
        <tr>
            <th>#</th>
            <th class="text-left">ธนาคารที่โอน</th>
            <th class="text-left">ชื่อลูกค้า</th>
            <th class="text-center">วันที่ชำระ</th>
            <th class="text-center">เวลาที่ชำระ</th>
            <th class="text-right">จำนวนเงินที่โอน</th>
            <th class="text-left">เลขที่อ้างอิง</th>
            <th class="text-center">สถานะ</th>
            <th class="text-left">ผู้ตรวจสอบ</th>
            <th class="text-center">ตัวเลือก</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $i = 1;
        if ($datas->num_rows() > 0) {
            foreach ($datas->result() as $data) {
                if ($data->status_inform_id == 1) {
                    $status = "badge badge-warning";
                } elseif ($data->status_inform_id == 2) {
                    $status = "badge badge-success";
                } elseif ($data->status_inform_id == 3) {
                    $status = "badge badge-danger";
                }
                ?>
                <tr>
                    <td class="text-center" style="vertical-align: middle;"><?php echo $i; ?></td>
                    <td class="text-left" style="vertical-align: middle;"><?php echo $data->bank_name.' '.$data->bank_number; ?></td>
                    <td class="text-left" style="vertical-align: middle;"><?php echo $data->customer_name; ?></td>
                    <td class="text-center" style="vertical-align: middle;"><?php echo $this->mics->date2thai($data->date_pay, '%d %m %y', 1); ?></td>
                    <td class="text-center" style="vertical-align: middle;"><?php echo $data->time_pay; ?></td>
                    <td class="text-right" style="vertical-align: middle;"><?php echo number_format($data->money, 2); ?></td>
                    <td class="text-left" style="vertical-align: middle;"><?php echo $data->invoice; ?></td>
                    <td class="text-center" style="vertical-align: middle;"><span class="<?php echo $status; ?>"><?php echo $data->status_inform_name; ?></span></td>   
                    <?php if($data->user_id != null){
                        $username = $this->alienate_model->get_user($data->user_id)->row()->fullname;
                    }else{
                        $username = '';
                    } ?>
                    <td class="text-left" style="vertical-align: middle;"><?php echo $username; ?></td>
                    <td class="text-center" style="vertical-align: middle;">
                        <button class="btn btn-outline-info btn-sm" onclick="modal_edit('<?php echo $data->inform_payment_id; ?>');"><i class="fa fa-edit"></i> จัดการ</button>
                    </td>
                </tr>
                <?php
                $i++;
            }
        }
        ?>                    
    </tbody>
</table>
<script>
    $(document).ready(function () {
        $('.table-datatable').DataTable();
        $('.form-parsley').parsley();
    });
</script>