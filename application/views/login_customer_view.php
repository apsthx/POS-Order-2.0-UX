
<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport" />       
        <title><?php echo isset($title) ? $title . ' | Stock & POS manager' : 'Stock & POS manager'; ?></title>    
        <link rel="icon" type="image/png" sizes="16x16" href="<?php echo base_url() . 'assets/img/favicon.png'; ?>">
        <meta name="robots" content="noindex, nofollow">

        <?php
        echo $this->assets->plugins_css('bootstrap/css/bootstrap.min.css');
        echo $this->assets->css('style.css');
        ?>

    </head>

    <body>

        <div class="preloader">
            <svg class="circular" viewBox="25 25 50 50">
            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" /> </svg>
        </div>

        <section id="wrapper">
            <div class="login-register" style="background-color: #888;">        
                <div class="login-box card">
                    <div class="card-block">
                        <form class="form-horizontal form-material" id="loginform" method="post" action="<?php echo base_url() . 'login/dologin_customer'; ?>">
                            <h3 class="box-title m-b-20">เข้าสู่ระบบสำหรับลูกค้า</h3>

                            <div class="text-center" id="flash_message4500">
                                <?php
                                if ($this->session->flashdata('flash_message') != '') {
                                    ?>
                                    <?php
                                    echo $this->session->flashdata('flash_message');
                                    ?>
                                    <br>
                                    <?php
                                }
                                ?>                                
                            </div>
                            <div class="form-group ">
                                <div class="col-xs-12">
                                    <input class="form-control" type="text" name="username" required="" placeholder="Username"> 
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-xs-12">
                                    <input class="form-control" type="password" name="password" required="" placeholder="Password"> 
                                </div>
                            </div>
                            <div class="form-group text-center m-t-20">
                                <div class="col-xs-12">
                                    <button class="btn btn-info btn-lg btn-block text-uppercase waves-effect waves-light" type="submit">Log In</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </section>

        <?php
        echo $this->assets->plugins_js('jquery/jquery.min.js');
        echo $this->assets->plugins_js('bootstrap/js/bootstrap.min.js');
        echo $this->assets->js('custom.min.js');
        echo $this->assets->js('flash-message.js');
        ?>

    </body>

</html>