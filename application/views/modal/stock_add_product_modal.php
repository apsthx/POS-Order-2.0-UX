<div class="modal-header">
    <h4 class="modal-title"><i class="fa fa-plug"></i>&nbsp;เพิ่มสินค้า</h4>
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
</div>
<div class="modal-body">

    <form method="post" id="form-edit" action="<?php echo base_url() . 'stock/edit'; ?>" autocomplete="off">

        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-4">
                        <select id="category_id_add" class="form-control" onchange="ajax_modal_add();">
                            <?php
                            $product_category = $this->stock_model->get_product_category();
                            if ($product_category->num_rows() > 0) {
                                foreach ($product_category->result() as $row) {
                                    ?>
                                    <option value="<?php echo $row->product_category_id; ?>"><?php echo $row->product_category_name; ?></option>
                                    <?php
                                }
                            } else {
                                ?>
                                <option value="">ยังไม่ได้เพิ่มสินค้า</option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="control-label">หมวดหมู่สินค้า</label>
                    </div>
                </div>
            </div>
        </div>

        <div id="page-add-product"></div>

    </form>

</div>

<script>
    $(function () {
        ajax_modal_add();
    });

    function ajax_modal_add() {
        product_category_id = $('#category_id_add').val();
        url = service_base_url + 'stock/ajax_modal_add';
        $('#page-add-product').html('<div style="text-align:center; padding:80px;"><i class="fa fa-refresh fa-spin fa-3x fa-fw"></i></div>');
        $.ajax({
            url: url,
            method: "POST",
            data: {
                product_category_id: product_category_id
            },
            success: function (res)
            {
                $('#page-add-product').html(res);
            }
        });
    }
</script>