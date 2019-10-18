<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-block">
                <h4 class="card-title"><i class="<?php echo $icon; ?>"></i> <?php echo " " . $title; ?> 

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
                                    <th >ข้อความ</th>
                                    <th >ร้าน</th>
                                    <th >ผู้ใช้งาน</th>  
                                    <th class="text-center">วัน-เวลาที่บันทึก</th>
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
<script>
    var service_base_url = $('#service_base_url').val();

    function load() {
        $('body').loading();
        $.ajax({
            url: service_base_url + 'admin/reportlogreceipt/loadtable',
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