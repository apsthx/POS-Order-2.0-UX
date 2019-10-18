<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-block">
                <h4 class="card-title"><i class="<?php echo $icon; ?>"></i> <?php echo " " . $title; ?> 
                    <button type="button" style="float: right" class="btn btn-sm btn-rounded btn-outline-success" onclick="modalAdd();"><i class="fa fa-plus"></i> เพิ่มการบริการ</button>
                </h4>            
                <div class="row">                                     
                    <div class="col-sm-6">
                        <div class="input-group">
                            <input type="text" id="search" onkeypress="if (event.keyCode === 13) {
                                        load();
                                    }"  class="form-control form-control-sm" placeholder="ค้นหาข้อมูล..">
                            <span class="input-group-btn">
                                <button class="btn btn-outline-primary" type="button" onclick="load();"><i class="fa fa-search"></i></button>
                            </span>
                        </div>
                    </div>
                </div>
                <p></p>
                <div id="for_table">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered">                
                            <thead>
                                <tr>
                                    <th class="text-center" width="5%">No.</th>
                                    <th class="text-center">ชื่อบริการ</th>
                                    <th class="text-right">ราคา</th>    
                                    <th class="text-center" width="15%">ตัวเลือก</th>
                                </tr>
                            </thead>
                            <tbody id="for_load">

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="for_modal"></div>
<div class="modal fade in" id="modal-delete">
    <div class="modal-dialog">
        <div class="modal-content">
            
        </div>
    </div>
</div>
<script>
    var service_base_url = $('#service_base_url').val();
    
    function modalDelete(services_id) {
        $.ajax({
            url: service_base_url + 'servicesadd/modaldelete',
            type: 'post',
            data: {
                services_id: services_id
            },
            success: function (response) {
                $('.modal-content').html(response);
                $("#modal-delete").modal('show', {backdrop: 'static'});
            }
        });
    }
    
    function modalAdd() {
        $.ajax({
            url: service_base_url + 'servicesadd/modaladd',
            success: function (response) {
                $('#for_modal').html(response);
                $("#on_modal").modal('show', {backdrop: 'static'});
            }
        });
    }

    function modalEdit(services_id) {
        $.ajax({
            url: service_base_url + 'servicesadd/modaledit',
            type: 'post',
            data: {
                services_id: services_id
            },
            success: function (response) {
                $('#for_modal').html(response);
                $("#on_modal").modal('show', {backdrop: 'static'});
            }
        });
    }
    
    function load() {
        $('body').loading();
        $.ajax({
            url: service_base_url + 'servicesadd/loadtable',
            type: 'post',
            data: {
                search: $('#search').val()
            },
            success: function (response) {
                $('#for_table').html(response);
                $('body').loading('stop');
            }
        });
    }
    $(function () {
        load();
    });
</script>