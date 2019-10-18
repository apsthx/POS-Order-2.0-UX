
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

    <body class="fix-header card-no-border logo-center">
        <!-- ============================================================== -->
        <!-- Main wrapper - style you can find in pages.scss -->
        <!-- ============================================================== -->
        <section id="wrapper" class="error-page">
            <div class="error-box">
                <div class="error-body text-center">
                    <h1>404</h1>
                    <h3 class="text-uppercase">Page Not Found !</h3>
                    <p class="text-muted m-t-30 m-b-30">YOU SEEM TO BE TRYING TO FIND HIS WAY HOME</p>
                    <a href="<?php echo base_url(); ?>" class="btn btn-info btn-rounded waves-effect waves-light m-b-40">Back to home</a> </div>
                <footer class="footer text-center">Powered by © <a href="https://www.gm-thai.com/" target="_blank">APS</a>  2017, V.2.0-UX All right reserved.</footer>
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