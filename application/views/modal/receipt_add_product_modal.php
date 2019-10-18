<?php
if (sizeof($product_id_arr) > 0) {
    foreach ($product_id_arr as $product_id) {
        ?>
        <input type='hidden' name="product_ck[]" class="product_ck" value="<?php echo $product_id; ?>"/>
        <?php
    }
}
?>
<input type='hidden' id="type_receipt" value="<?php echo (isset($type_receipt)) ? $type_receipt : ''; ?>"/>


<div class="modal-header">
    <h4 class="modal-title"><i class="fa fa-plus"></i>&nbsp;เพิ่มสินค้า</h4>
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
</div>
<div class="modal-body">

    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-4">
                    <select id="category_id_add" class="form-control" onchange="ajax_modal_add();">
                        <option value="">หมวดหมู่ทั้งหมด</option>
                        <?php
                        $product_category = $this->db->select('product_category_id,product_category_name')
                                ->where('product_category.shop_id_pri', $this->session->userdata('shop_id_pri'))
                                ->order_by('product_category_name')
                                ->get('product_category');
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

</div>

<script>
    $(function () {
        ajax_modal_add();
    });

    function ajax_modal_add() {
        product_id_arr = [];
        $('.product_ck').map(function (i) {
            product_id_arr[i] = this.value;
        });
        type_receipt = $('#type_receipt').val();
        product_category_id = $('#category_id_add').val();
        url = service_base_url + 'quotation/ajax_product_modal';
        $('#page-add-product').html('<div style="text-align:center; padding:80px;"><i class="fa fa-refresh fa-spin fa-3x fa-fw"></i></div>');
        $.ajax({
            url: url,
            method: "POST",
            data: {
                type_receipt: type_receipt,
                product_id_arr: product_id_arr,
                product_category_id: product_category_id
            },
            success: function (res)
            {
                $('#page-add-product').html(res);
            }
        });
    }
</script>