<div class="modal-header">
    <h4 class="modal-title"><i class="fa fa-bars"></i>&nbsp;รายละเอียด</h4>
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
</div>
<div class="modal-body">

    <div class="row text-success">
        <?php
        $html = file_get_html('https://th.kerryexpress.com/th/track/?track=' . $receipt->transport_tracking_id);
        foreach ($html->find('div .piority-success') as $element) {
            ?>
            <div class="col-sm-4 text-right">
                <?php
                foreach ($element->find('.date div') as $date) {
                    echo $date;
                }
                ?>
            </div>
            <div class="col-sm-2 text-center" style="font-size: 30px;"><i class="fa fa-check-circle-o"></i></div>
            <div class="col-sm-6">
                <span>
                    <?php
                    foreach ($element->find('div .d1') as $desc) {
                        echo $desc;
                    }
                    ?>
                </span>
                <span style="color: #888;">
                    <?php
                    foreach ($element->find('div .d2') as $desc) {
                        echo $desc;
                    }
                    ?>
                </span>
            </div>
            <?php
        }
        ?>
    </div>
    <div class="row text-warning">
        <?php
        foreach ($html->find('div .piority-waiting') as $element) {
            ?>
            <div class="col-sm-4 text-right">
                <?php
                foreach ($element->find('.date div') as $date) {
                    echo $date;
                }
                ?>
            </div>
            <div class="col-sm-2 text-center" style="font-size: 30px;"><i class="fa fa-clock-o"></i></div>
            <div class="col-sm-6">
                <span>
                    <?php
                    foreach ($element->find('div .d1') as $desc) {
                        echo $desc;
                    }
                    ?>
                </span>
                <span style="color: #888;">
                    <?php
                    foreach ($element->find('div .d2') as $desc) {
                        echo $desc;
                    }
                    ?>
                </span>
            </div>
            <?php
        }
        ?>
    </div>
    <div class="row text-warning">
        <?php
        foreach ($html->find('div .normaly-waiting') as $element) {
            ?>
            <div class="col-sm-4 text-right">
                <?php
                foreach ($element->find('.date div') as $date) {
                    echo $date;
                }
                ?>
            </div>
            <div class="col-sm-2 text-center" style="font-size: 30px;"><i class="fa fa-clock-o"></i></div>
            <div class="col-sm-6">
                <span>
                    <?php
                    foreach ($element->find('div .d1') as $desc) {
                        echo $desc;
                    }
                    ?>
                </span>
                <span style="color: #888;">
                    <?php
                    foreach ($element->find('div .d2') as $desc) {
                        echo $desc;
                    }
                    ?>
                </span>
            </div>
            <?php
        }
        ?>
    </div>

</div>

<div class="modal-footer">
    <button type="button" class="btn" data-dismiss="modal" aria-hidden="true" ><i class="fa fa-close"></i>&nbsp;ปิด</button>
</div>