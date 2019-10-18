<div class="table-responsive">
    <table class="table table-striped table-bordered table-datatable">
        <thead>
            <tr>
                <th width="50">#</th>
                <th class="text-left">สินค้า</th>
                <th class="text-right">ราคาต่อหน่วย</th>
                <th class="text-center" width="15%">เลือก</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $i = 1;
            if ($datas->num_rows() > 0) {
                foreach ($datas->result() as $data) {
                    ?>
                    <tr>
                        <td class="text-center" style="vertical-align: middle;"><?php echo $i; ?></td>
                        <td style="vertical-align: middle;"><?php echo $data->services_name; ?></td>
                        <td class="text-right" style="vertical-align: middle;"><?php echo number_format($data->services_cost, 2); ?></td>
                        <td class="text-center" style="vertical-align: middle;">
                            <?php
                            if (sizeof($services_id_arr) > 0) {
                                if (!in_array($data->services_id, $services_id_arr)) {
                                    ?>
                                    <input type="hidden" name="services_id_modal['<?php echo $i; ?>']" class="services_id_modal" id="services_id_modal_<?php echo $i; ?>" >
                                    <input type="hidden" name="services_name_modal['<?php echo $i; ?>']" class="services_name_modal" id="services_name_modal_<?php echo $i; ?>" >
                                    <input type="hidden" name="services_cost_modal['<?php echo $i; ?>']" class="services_cost_modal" id="services_cost_modal_<?php echo $i; ?>" >
                                    <input type="checkbox" id="services_checkbox_modal_<?php echo $i; ?>" value="0" onclick="checkbox_services(this, '<?php echo $data->services_id; ?>', '<?php echo $data->services_name; ?>', '<?php echo $data->services_cost; ?>',<?php echo $i; ?>);" >
                                    <label for="services_checkbox_modal_<?php echo $i; ?>"></label>
                                    <?php
                                }
                            } else {
                                ?>
                                <input type="hidden" name="services_id_modal['<?php echo $i; ?>']" class="services_id_modal" id="services_id_modal_<?php echo $i; ?>" >
                                <input type="hidden" name="services_name_modal['<?php echo $i; ?>']" class="services_name_modal" id="services_name_modal_<?php echo $i; ?>" >
                                <input type="hidden" name="services_cost_modal['<?php echo $i; ?>']" class="services_cost_modal" id="services_cost_modal_<?php echo $i; ?>" >
                                <input type="checkbox" id="services_checkbox_modal_<?php echo $i; ?>" value="0" onclick="checkbox_services(this, '<?php echo $data->services_id; ?>', '<?php echo $data->services_name; ?>', '<?php echo $data->services_cost; ?>',<?php echo $i; ?>);" >
                                <label for="services_checkbox_modal_<?php echo $i; ?>"></label>
                                <?php
                            }
                            ?>
                        </td>
                    </tr>
                    <?php
                    $i++;
                }
            }
            ?>                    
        </tbody>
    </table>
</div>
<br/>
<div class="row">
    <div class="col-md-12 text-center">
        <button type="button" onclick="add_services();" class="btn btn-outline-info"><i class="fa fa-plus"></i>&nbsp;เพิ่ม</button>
        <button type="button" class="btn btn-outline-danger" data-dismiss="modal" aria-hidden="true"><i class="fa fa-close"></i>&nbsp;ยกเลิก</button>
    </div>
</div>
<br/>

<script>
    $(document).ready(function () {
        $('.table-datatable').DataTable();
    });

    function checkbox_services(tag, services_id, services_name, services_cost, i) {
        check = $(tag);
        if (check.val() == 0) {
            check.val(1);
            $('#services_id_modal_' + i).val(services_id);
            $('#services_name_modal_' + i).val(services_name);
            $('#services_cost_modal_' + i).val(services_cost);
        } else {
            check.val(0);
            $('#services_id_modal_' + i).val('');
            $('#services_name_modal_' + i).val('');
            $('#services_cost_modal_' + i).val('');
        }
    }
</script>