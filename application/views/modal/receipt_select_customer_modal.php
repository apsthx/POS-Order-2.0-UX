
<div class="modal-header">
    <h4 class="modal-title"><i class="fa fa-clipboard"></i>&nbsp;ลูกค้า</h4>
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
</div>
<div class="modal-body">

    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-4">
                    <select id="customer_group_id" class="form-control" onchange="ajax_modal_customer();">
                        <option value="">-- กลุ่มลูกค้าทั้งหมด --</option>
                        <?php
                        $customer_group = $this->db->select('customer_group_id,customer_group_name')
                                ->where('customer_group.shop_id_pri', $this->session->userdata('shop_id_pri'))
                                ->order_by('customer_group_id')
                                ->get('customer_group');
                        if ($customer_group->num_rows() > 0) {
                            foreach ($customer_group->result() as $row) {
                                ?>
                                <option value="<?php echo $row->customer_group_id; ?>"><?php echo $row->customer_group_name; ?></option>
                                <?php
                            }
                        } else {
                            ?>
                            <option value="">ยังไม่ได้เพิ่มกลุ่มลูกค้า</option>
                            <?php
                        }
                        ?>
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="control-label">กลุ่มลูกค้า</label>
                </div>
            </div>
        </div>
    </div>


    <div class="table-responsive" id="ajax-modal-customer"></div>

</div>

<script>

    $(function () {
        ajax_modal_customer();
    });

    function ajax_modal_customer() {
        customer_group_id = $('#customer_group_id').val();
        url = service_base_url + 'quotation/ajax_customer_modal';
        $('#ajax-modal-customer').html('<div style="text-align:center; padding:80px;"><i class="fa fa-refresh fa-spin fa-3x fa-fw"></i></div>');
        $.ajax({
            url: url,
            method: "POST",
            data: {
                customer_group_id: customer_group_id
            },
            success: function (res)
            {
                $('#ajax-modal-customer').html(res);
            }
        });
    }

    function select_customer_modal(customer_id, customer_name, customer_tel, customer_email, customer_address, customer_tax_id, customer_tax_shop, customer_tax_shop_sub, customer_tax_address, customer_group_save, type_save_id) {
        $('#customer_id').val(customer_id);
        $('#customer_name').val(customer_name);
        $('#customer_tel').val(customer_tel);
        $('#customer_email').val(customer_email);
        $('#customer_address').val(customer_address);
        $('#customer_tax_id').val(customer_tax_id);
        $('#customer_tax_shop').val(customer_tax_shop);
        $('#customer_tax_shop_sub').val(customer_tax_shop_sub);
        $('#customer_tax_address').val(customer_tax_address);
        $('#transport_customer').val(customer_name);
        $('#transport_customer_tel').val(customer_tel);
        $('#transport_customer_address').val(customer_address);

        if (type_save_id == 1) {
            save_txt = customer_group_save + '%';
        } else {
            save_txt = customer_group_save;
        }

        $('#save').val(save_txt);

        $('#open-modal').modal('hide');
        sum_price();
    }
</script>