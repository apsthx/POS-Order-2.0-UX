<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport" />       
        <title>ไฟล์รูปภาพ</title>       
        <link rel="shortcut icon" href="<?php echo base_url() . 'assets/img/logo.png'; ?>" /> 
        <meta name="robots" content="noindex, nofollow">

        <?php
        echo $this->assets->css('bootstrap.min.css');
        echo $this->assets->css('font-awesome.min.css');
        echo $this->assets->css('black.css');
        echo $this->assets->css('panel.css');
        echo $this->assets->css('metisMenu.css');
        ?>

    </head>    

    <body class="skin-josh" style="background-color: #fff;">
        <br/>
        <form action="<?php echo base_url('uploadimage/upload'); ?>" method="post" enctype="multipart/form-data">

            <div class="row">
                <div class="col-lg-offset-1 col-lg-9">
                    <div class="form-horizontal">
                        <label class="control-label col-lg-2">อัพโหลดรูป</label>
                        <div class="col-lg-8">
                            <input type="file" accept="image/*" name="image" class="form-control" />
                        </div>
                        <div class="col-lg-2">
                            <button type="submit" class="btn btn-warning btn-sm"><i class="fa fa-upload"></i> อัพโหลด</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <hr/>

        <?php
        $images = $this->db->order_by('image_id', 'desc')->get('image');
        ?>

        <div class="row">
            <div class="col-lg-offset-2 col-lg-8">
                <div class="row">
                    <?php
                    if ($images->num_rows() > 0) {
                        foreach ($images->result() as $row) {
                            ?>
                            <div class="col-lg-2">
                                <div>
                                    <input type="text" style="width:100%" value="<?php echo base_url().'store/image/'.$row->image_name; ?>" class="form-control" />
                                </div>
                                <p></p>
                                <div style="height: 150px; width: 100%;">
                                    <img src="<?php echo base_url().'store/image/'.$row->image_name; ?>" width="100%"/>
                                </div>
                            </div>
                            <?php
                        }
                    }
                    ?>
                </div>
            </div>
        </div>


    </body>
</html>