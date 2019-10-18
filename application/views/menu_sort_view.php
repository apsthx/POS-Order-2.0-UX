<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-block">
                <h4 class="card-title"><i class="<?php echo $icon; ?>"></i> <?php echo " " . $title; ?>
                    <button style="float: right" class="btn btn-sm btn-circle btn-danger" onclick="window.close();"><i class="fa fa-times"></i></button>
                </h4>               
                <div class="row">
                    <div class="col-md-4" style="cursor: move; margin-left: auto; margin-right: auto;">
                        <?php
                        $results = $this->groupmenu_model->get_menu_group_menu($group_menu_id);
                        ?>
                        <ul class="list-group ui-sortable" id="sortable-menu-list">
                            <?php
                            foreach ($results->result() as $res) {
                                ?>
                                <li id="array_<?php echo $res->menu_id; ?>" class="list-group-item btn btn-block btn-social btn-default" >
                                    <i class="fa fa-sort"></i>&nbsp;<span style="margin-left: auto; margin-right: auto;"><?php echo $res->menu_name; ?></span> 
                                </li>
                                <?php
                            }
                            ?>
                        </ul>
                    </div>
                </div>   
            </div>
        </div>
    </div>
</div>