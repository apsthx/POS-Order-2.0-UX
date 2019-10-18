<?php
if (sizeof($services_id_arr) > 0) {
    foreach ($services_id_arr as $services_id) {
        ?>
        <input type='hidden' name="services_ck[]" class="services_ck" value="<?php echo $services_id; ?>"/>
        <?php
    }
}
?>
<div class="modal-header">
    <h4 class="modal-title"><i class="fa fa-plus"></i>&nbsp;เพิ่มบริการ</h4>
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
</div>
<div class="modal-body">
    <div id="page-add-services">
        
    </div>
</div>

<script>
    $(function () {
        ajax_modal_add();
    });

    function ajax_modal_add() {
        services_id_arr = [];
        $('.services_ck').map(function (i) {
            services_id_arr[i] = this.value;
        });
        url = service_base_url + 'services/ajax_services_modal';
        $('#page-add-services').html('<div style="text-align:center; padding:80px;"><i class="fa fa-refresh fa-spin fa-3x fa-fw"></i></div>');
        $.ajax({
            url: url,
            method: "POST",
            data: {
                services_id_arr: services_id_arr,
            },
            success: function (res)
            {
                $('#page-add-services').html(res);
            }
        });
    }
</script>