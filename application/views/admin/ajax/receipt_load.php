<table class="table table-striped table-bordered">                
    <thead>
        <tr>
            <th>#</th>
            <th class="">แพ็กเกจ / ค่า SMS</th>
            <th>โอนเข้าธนาคาร</th>
            <th class="">โอนโดย</th>
            <th class="">จำนวนเงิน</th>
            <th class="">วันที่โอน</th>
            <th class="">เวลาโอน</th>
            <th class="">เลขที่อ้างอิง</th>
            <th class="text-center">หลักฐานการโอน</th>
            <th class="text-center">วันที่แจ้งโอน</th>
            <th class="text-center" width="7%">สถานะ</th>
            <th class="text-center" width="6%">ตรวจสอบ</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if ($datas->num_rows() > 0) {
            $i = 1;
            foreach ($datas->result() AS $data) {
                ?>
                <tr>
                    <td><?php echo $i; ?></td>
                    <td><?php echo ($data->package_id != null)? $this->receipt_model->getPackage($data->package_id)->package_name : $this->receipt_model->getSMS($data->sms_id)->sms_name; ?></td>
                    <td><?php echo $data->income_bank_name . ' ' . $data->income_bank_branch . ' ' . $data->income_bank_account_name; ?></td>
                    <td class=""><?php echo $data->receipt_by; ?></td>
                    <td class=""><?php echo number_format($data->receipt_cost, 2); ?></td>
                    <td class=""><?php echo $this->mics->date2thai($data->receipt_datepay, '%d %m %y', 1); ?></td>
                    <td class=""><?php echo $this->mics->date2thai($data->receipt_timepay, '%h:%i'); ?></td>
                    <td class=""><?php echo $data->receipt_number; ?></td><td  style="vertical-align: middle;" class="text-center">
                        <a href="<?php echo base_url() . 'store/receipt/' . $data->receipt_evidence; ?>"  class="fancybox">
                            <image src="<?php echo base_url() . 'store/receipt/bank.png'; ?>" class="img-responsive" style="width: 35px; height: 40px;"/>
                        </a>
                    </td>
                    <td  style="vertical-align: middle;" class="text-center"><?php echo $this->mics->date2thai($data->receipt_create, '%d %m %y %h:%i', 1); ?></td>
                    <?php if ($data->receipt_check == 1) { ?>
                        <td  style="vertical-align: middle;" class="text-center" id="status-<?php echo $data->receipt_id; ?>">
                            <span class="label label-success">ผ่าน</span>
                        </td>
                        <td  style="vertical-align: middle;" class="switch text-center">
                            <label>
                                <input type="checkbox" id="sw-<?php echo $data->receipt_id; ?>" onclick="switchCheck('<?php echo $data->receipt_id; ?>');" value="1" checked="true">
                                <span class="lever"></span>
                            </label>
                        </td>
                    <?php } else if ($data->receipt_check == 0) { ?>
                        <td  style="vertical-align: middle;" class="text-center" id="status-<?php echo $data->receipt_id; ?>">
                            <span class="label label-inverse">รอตรวจ</span>
                        </td>
                        <td  style="vertical-align: middle;" class="switch text-center">
                            <label>
                                <input type="checkbox" id="sw-<?php echo $data->receipt_id; ?>" onclick="switchCheck('<?php echo $data->receipt_id; ?>');" value="0">
                                <span class="lever"></span>
                            </label>
                        </td>
                    <?php } else { ?>
                        <td  style="vertical-align: middle;" class="text-center" id="status-<?php echo $data->receipt_id; ?>">
                            <span class="label label-danger">ไม่ผ่าน</span>
                        </td>
                        <td  style="vertical-align: middle;" class="switch text-center">
                            <label>
                                <input type="checkbox" id="sw-<?php echo $data->receipt_id; ?>" onclick="switchCheck('<?php echo $data->receipt_id; ?>');" value="2">
                                <span class="lever"></span>
                            </label>
                        </td>
                    <?php } ?>
                </tr> 
                <?php
                $i++;
            }
        } else {
            ?>
            <tr>
                <td class="text-center" colspan="12"><?php echo 'ไม่มีข้อมูล'; ?></td>
            </tr>
            <?php
        }
        ?>
    </tbody>
</table>
<script>
    $(document).ready(function () {
        $('.fancybox').fancybox({
            padding: 0,
            helpers: {
                title: {
                    type: 'outside'
                }
            }
        });
    });
</script>