
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-block">
                <h4 class="card-title">
                    <i class="<?php echo $icon; ?>"></i> <?php echo " " . $title; ?>
                    <a href="<?php echo base_url() . 'addshop'; ?>" target="_blank" style="float: right" class="btn btn-sm btn-rounded btn-outline-success" onclick="modaladd();">
                        <i class="fa fa-plus"></i> สร้าง
                    </a>
                </h4>

                <div class="table-responsive" id="result-page"></div>

            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="open-modal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content"></div>
    </div>
</div>

<div class="modal fade" id="editpassword">
    <div class="modal-dialog">
        <div class="modal-content">

        </div>
    </div>
</div>

