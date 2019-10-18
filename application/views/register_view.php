<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport" />       
        <title><?php echo 'Register | Stock & POS manager'; ?></title>    
        <link rel="icon" type="image/png" sizes="16x16" href="<?php echo base_url() . 'assets/img/favicon.png'; ?>">
        <meta name="robots" content="noindex, nofollow">

        <?php
        echo $this->assets->plugins_css('bootstrap/css/bootstrap.min.css');
        echo $this->assets->css('style_1.css');
        echo $this->assets->css('css/colors/blue.css');
        echo $this->assets->plugins_css('sweetalert/sweetalert.css');

        echo $this->assets->plugins_js('jquery/jquery.min.js');
        echo $this->assets->plugins_js('bootstrap/js/tether.min.js');
        echo $this->assets->plugins_js('bootstrap/js/bootstrap.min.js');
        ?>


        <style>
            * { box-sizing: border-box; }
            .video-background {
                background: #000;
                position: fixed;
                top: -1px; right: 450px; bottom: 0; left: -110px;
                z-index: -99;
            }
            .video-foreground,
            .video-background iframe {
                position: absolute;
                top: 0;
                left: 0;
                width: 107%;
                height: 100%;
                pointer-events: none;
            }
            #vidtop-content {
                top: 0;
                color: #fff;
            }
            .vid-info { position: absolute; top: 0; right: 0; width: 33%; background: rgba(0,0,0,0.3); color: #fff; padding: 1rem; font-family: Avenir, Helvetica, sans-serif; }
            .vid-info h1 { font-size: 2rem; font-weight: 700; margin-top: 0; line-height: 1.2; }
            .vid-info a { display: block; color: #fff; text-decoration: none; background: rgba(0,0,0,0.5); transition: .6s background; border-bottom: none; margin: 1rem auto; text-align: center; }
            @media (min-aspect-ratio: 16/9) {
                .video-foreground { height: 100%; top: 0%; }
            }
            @media (max-aspect-ratio: 16/9) {
                .video-foreground { width: 100%; left: 0%; }
            }
            @media all and (max-width: 600px) {
                .vid-info { width: 50%; padding: .5rem; }
                .vid-info h1 { margin-bottom: .2rem; }
            }
            @media all and (max-width: 500px) {
                .vid-info .acronym { display: none; }
            }
        </style> 

    </head>

    <body>

        <input type="hidden" id="service_base_url" value="<?php echo base_url(); ?>" >
        <div class="preloader">
            <svg class="circular" viewBox="25 25 50 50">
            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" /> </svg>
        </div>
        <section id="wrapper" class="login-register login-sidebar" style="background-color: black;">
            <div class="video-background">
                <div class="video-foreground">
                    <iframe src="https://www.youtube.com/embed/V9A26rdO6QE?controls=0&showinfo=0&rel=0&autoplay=1&loop=1" frameborder="0" allowfullscreen></iframe>
                </div>
            </div>
            <div class="login-box card" style="max-width: 345px;">
                <div class="card-block">
                    <form class="form-horizontal form-material" id="form-register" method="post" action="<?php echo base_url() . 'register/add'; ?>" autocomplete="off">
                        <div class="col-xs-12 text-right">
                            <a style="margin-top: -10px;" href="<?php echo base_url() . 'login'; ?>"><i class="fa fa-sign-in"></i> เข้าสู่ระบบ</a>      
                        </div>
                        <a href="javascript:void(0)" class="text-center db"><img src="<?php echo base_url() . 'assets/img/logo2.png'; ?>" width="100px" style="padding-top: 5px;" alt="Home" /></a> 
                        <h3 class="box-title m-t-10 m-b-15 text-center"><i class="fa fa-user"></i> สมัครสมาชิก</h3>
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
                        <div class="form-group m-b-10">
                            <div class="col-xs-12">
                                <input class="form-control" type="text" name="username" required="" placeholder="Username" > 
                            </div>
                        </div>
                        <div class="form-group m-b-10">
                            <div class="col-xs-12">
                                <input class="form-control" type="password" name="password" required="" placeholder="รหัสผ่าน" autocomplete="new-password"> 
                            </div>
                        </div>
                        <div class="form-group m-b-10">
                            <div class="col-xs-12">
                                <input class="form-control" type="password" name="password_confirm"  required="" placeholder="ยืนยันรหัสผ่าน"> 
                            </div>
                        </div>
                        <div class="form-group m-b-10">
                            <div class="col-xs-12">
                                <input class="form-control" type="text" name="fullname" required=""  placeholder="ชื่อ นามสกุล"> 
                            </div>
                        </div>
                        <div class="form-group m-b-10">
                            <div class="col-xs-12">
                                <input class="form-control" type="email" name="email" required=""  placeholder="Email"> 
                            </div>
                        </div>
                        <div class="form-group m-b-15">
                            <div class="col-xs-12">
                                <input type="text" name="telcheck" id='telcheck' class="form-control" placeholder="เบอร์โทร" required onblur="check_phone_format(this);">
                                <input type="hidden" id='refotp' class="form-control form-control-sm">
                                <input type="hidden" id='otp' class="form-control form-control-sm">
                            </div>
                        </div>
                        <div class="form-group m-t-10 m-b-20">
                            <div class="col-xs-12">
                                <select class="form-control" id="shop_business" name="shop_business" required="">
                                    <option value="">เลือกประเภทธุรกิจ</option>
                                    <option value="กระเป๋า/สัมภาระ">กระเป๋า/สัมภาระ</option>
                                    <option value="กล้อง/รูปภาพ">กล้อง/รูปภาพ</option>
                                    <option value="เกมกระดาน">เกมกระดาน</option>
                                    <option value="เกม/ของเล่น">เกม/ของเล่น</option>
                                    <option value="คอมพิวเตอร์ (แบรนด์)">คอมพิวเตอร์ (แบรนด์)</option> 
                                    <option value="เครื่องใช้ไฟฟ้า">เครื่องใช้ไฟฟ้า</option>
                                    <option value="เครื่องใช้สำนักงาน">เครื่องใช้สำนักงาน</option>
                                    <option value="เครื่องประดับ/นาฬิกา">เครื่องประดับ/นาฬิกา</option>
                                    <option value="เครื่องมือ/อุปกรณ์">เครื่องมือ/อุปกรณ์</option>
                                    <option value="ซอฟต์แวร์">ซอฟต์แวร์</option>
                                    <option value="แต่งบ้าน">แต่งบ้าน</option>
                                    <option value="แบรนด์">แบรนด์</option>
                                    <option value="เพจแอพ">เพจแอพ</option> 
                                    <option value="ฟอร์นิเจอร์">ฟอร์นิเจอร์</option> 
                                    <option value="เภสัชกรรม">เภสัชกรรม</option> 
                                    <option value="มือถือ/แท็บเล็ต">มือถือ/แท็บเล็ต</option>
                                    <option value="รถยนต์">รถยนต์</option> 
                                    <option value="ลานบ้าน/สวน">ลานบ้าน/สวน</option> 
                                    <option value="วัสดุก่อสร้าง">วัสดุก่อสร้าง</option> 
                                    <option value="วิดีโอเกม">วิดีโอเกม</option>
                                    <option value="วิตามิน/อาหารเสริม">วิตามิน/อาหารเสริม</option>
                                    <option value="เว็บไซต์">เว็บไซต์</option> 
                                    <option value="ไวน์/สุรา">ไวน์/สุรา</option> 
                                    <option value="สินค้า/บริการ">สินค้า/บริการ</option> 
                                    <option value="สุขภาพ/ความงาม">สุขภาพ/ความงาม</option>
                                    <option value="สุขภาพ/ความงาม">สุขภาพ/ความงาม</option> 
                                    <option value="เสื้อผ้า (แบรนด์)">เสื้อผ้า (แบรนด์)</option>
                                    <option value="ห้องครัว/การทำอาหา">ห้องครัว/การทำอาหา</option>
                                    <option value="อุปกรณ์เครื่องใช้ในครัวเรือน">อุปกรณ์เครื่องใช้ในครัวเรือน</option> 
                                    <option value="อุปกรณ์ทางพาณิชยกรรม">อุปกรณ์ทางพาณิชยกรรม</option> 
                                    <option value="อุปกรณ์สำหรับสัตว์เลี้ยง">อุปกรณ์สำหรับสัตว์เลี้ยง</option> 
                                    <option value="อุปกรณ์อิเล็กทรอนิกส์">อุปกรณ์อิเล็กทรอนิกส์</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group m-b-15">
                            <div class="col-xs-12">
                                <div class="checkbox checkbox-primary p-t-0">
                                    <input type="checkbox" name="accept" id="accept" class="filled-in chk-col-blue" disabled="" onchange="
                                            if ($(this).is(':checked')) {
                                                $('#bt-submit').prop('disabled', false);
                                            } else {
                                                $('#bt-submit').prop('disabled', true);
                                            }
                                           " data-parsley-multiple="accept" data-parsley-id="18">
                                    <label for="accept"> &nbsp;ยอมรับเงื่อนไขการสมัคร <a href="javascript:void(0);" onclick="modal_accept();">อ่านข้อตกลง</a></label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group text-center m-t-10">
                            <div class="col-xs-12">
                                <button type="button" id="bt-submit" disabled="" onclick="check();" class="btn btn-info"><i class="fa fa-user-circle-o"></i> สมัครสมาชิก</button>
                                <button type="reset" class="btn btn-info" style="background-color: #848484; border-color: #848484"><i class="fa fa-refresh"></i> ล้างข้อมูล</button>
                            </div>
                        </div>
                    </form>
                    <div class="form-group text-center m-t-5">
                        <div class="col-xs-12" style="font-size: 11px;">
                            Powered by © <a href="http://www.pos.apsth.com/" target="_blank">APS</a> 2017 - 2018, V.2.0-UX All right reserved. 
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <div id="for_modal"></div>

        <div class="modal fade" id="modal_accept">
            <div class="modal-dialog" style="max-width: 60vw;">
                <div class="modal-content">
                    <div class="modal-header" style="background: whitesmoke;">
                        <h4 class="modal-title text-primary" style="font-weight: bold;">
                            <i class="fa fa-handshake-o" ></i> ข้อตกลงกำหนดและเงื่อนไขการใช้งาน
                        </h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body">
                        <div class="bootbox-body" style="color: black">
                            <p>
                                <span style="font-weight: bold;">การสมัครใช้งาน / การใช้งาน</span><br/>
                                &nbsp;&nbsp;&nbsp;• ผู้ใช้งานที่จะใช้บริการต้องมีอายุ 18 ปี บริบูรณ์ขึ้นไป<br/>
                                &nbsp;&nbsp;&nbsp;• ผู้ใช้งานจะต้องไม่ทำการคัดลอกเนื้อหา, ดัดแปลงแก้ไข หรือนำไปจำหน่ายต่อบุคคลอื่น<br/>
                                &nbsp;&nbsp;&nbsp;• ผู้ใช้งานจะต้องรับผิดชอบดูแล username และรหัสผ่าน เพื่อความปลอดภัยของระบบ<br/>
                                &nbsp;&nbsp;&nbsp;• ผู้ใช้งานยอมรับให้บริษัทฯ สามารถแก้ไขรายการข้อมูลที่ส่งเข้าระบบได้<br/>
                                &nbsp;&nbsp;&nbsp;• ผู้ใช้งานจะไม่ทำการหรือพยายามเจาะระบบข้อมูล หรือเขียนรหัสที่เป็นภัยต่อระบบการทำงานของคอมพิวเตอร์<br/>
                                &nbsp;&nbsp;&nbsp;• หจก. เอพีเอส ทีเอช ไม่รับประกันว่าระบบ POS | Order | Stock Manager จะไม่ขาดช่วง, หยุดซ่อมบำรุง, หรือปราศจากข้อผิดพลาด<br/>
                                &nbsp;&nbsp;&nbsp;• บริษัทฯ จะไม่รับผิดชอบต่อการสูญหายของข้อมูล ไม่ว่าในกรณีใดๆ ก็ตาม<br/>
                                &nbsp;&nbsp;&nbsp;• บริษัทฯ สงวนสิทธิ์ในการลบ Account ของผู้ใช้งานบางรายที่ทำผิดกฎ หรือละเมิดสิทธิ์ทางปัญญา หรือทำให้เสียชื่อเสียง โดยไม่ต้องแจ้งล่วงหน้าให้ทราบ<p></p>
                            <span style="font-weight: bold;">นโยบายความเป็นส่วนตัว</span><br/>
                            &nbsp;&nbsp;&nbsp;• POS | Order | Stock Manager มีการปรับปรุงเนื้อหา, และทำการพัฒนาระบบอย่างต่อเนื่อง โดยทางบริษัทฯ จะมีการเก็บข้อมูล IP Address เวลา และสถานที่ในการเข้าใช้งาน รวมถึงข้อมูลอื่นๆ รวมถึงการเก็บข้อมูลผ่านระบบ Google Analytic.<br/>
                            &nbsp;&nbsp;&nbsp;• หจก. เอพีเอส ทีเอช จะมีการใช้ Cookie เพื่อเก็บข้อมูลและแลกเปลี่ยนข้อมูล เพื่อให้สามารถใช้งาน POS | Order | Stock Manager ได้<br/>
                            &nbsp;&nbsp;&nbsp;• ผู้ใช้งานยอมรับที่จะได้การแจ้งเตือนต่าง ผ่านทางโทรศัพท์, อีเมล์ หรือ sms และทางจดหมาย<br/>
                            &nbsp;&nbsp;&nbsp;• ในการกรณี บริษัทฯได้ทำการส่งข่าวสารถึงผู้ใช้งาน ไม่ว่าจะผ่านช่องทางใดก็ตาม หากไม่ได้รับการตอบกลับจากผู้ใช้งาน หรือ ต่อต่อกลับมาภายใน 5 วัน ทางเราจะถือว่าผู้ใช้งานได้รับทราบและยอมรับข่าวสารนั้น<p></p>
                            <span style="font-weight: bold;">การซื้อแพ็คเกจ</span><br/>
                            &nbsp;&nbsp;&nbsp;• ผู้ใช้งานที่สมัครใหม่จะได้ทดลองใช้งานฟรี ตามจำนวนวันที่บริษัทฯกำหนดให้ ก่อนการตัดสินใจใช้งานจริง โดยไม่สามารถเพื่มจำนวนวันได้อีก<br/>
                            &nbsp;&nbsp;&nbsp;• การชำระเงินจะเป็นการชำระเงินก่อนใช้งาน และเมื่อผู้ประกอบการชำระเงินตามจำนวนที่ต้องการแล้ว บริษัทฯ จะเพิ่มวันตามจำนวนเงินที่โอนโดยทาง บริษัทฯ จะไม่เปลี่ยนแปลงภายหลังจนกว่าจะหมดอายุ<br/>
                            &nbsp;&nbsp;&nbsp;• ผู้ใช้งานที่เคยสมัครแล้วจะไม่ได้รับโปรโมชั่นใหม่ที่ออกมาหลังจากวันที่สมัคร<br/>
                            &nbsp;&nbsp;&nbsp;• ผู้ใช้งานที่เคยสมัครแล้วจะไม่สามารถสมัครซํ้าได้อีก หรือ ไม่สามารถเปลี่ยนชื่อ username เพื่อรับการทดลองฟรี-โปรโมชั่นอื่นๆ<p></p>
                            <span style="font-weight: bold;">การคืนเงิน/การเปลี่ยนแปลงบริการ</span><br/>
                            &nbsp;&nbsp;&nbsp;• บริษัทฯ ไม่มีนโยบายในการคืนเงิน สำหรับค่าแพ็คเก็จที่ไดซื้อไปแล้ว<br/>
                            &nbsp;&nbsp;&nbsp;• บริษัทฯ ขอสงวนสิทธิ์ในการเปลี่ยนแปลงราคาโดยไม่ต้องแจ้งให้ทราบล่วงหน้า<br/>
                            &nbsp;&nbsp;&nbsp;• ในกรณีเปลี่ยนแปลงค่าบริการ จะมีการแจ้งเตือนให้ผู้ใช้งาน (ลูกค้าเก่า) ทราบล่วงหน้า 30 วันทุกครั้ง และ สำหรับผู้ใช้งานที่ซื้อแพ็คเก็จระยะยาวจะไม่มีผลกระทบกับจำนวนวันที่ได้ซื้อก่อนหน้านี้
                            </p>                           
                        </div>                    
                    </div>
                    <div class="modal-footer" style="background: whitesmoke;">
                        <div class="col-sm-12 text-center">
                            <button type="button" onclick="accept_confirm();" class="btn btn-info"><i class="fa fa-check"></i>&nbsp;ยอมรับข้อตกลง</button>
                            <button type="button" class="btn btn-default" data-dismiss="modal" aria-hidden="true" ><i class="fa fa-close"></i>&nbsp;ปิด</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php
        echo $this->assets->js('jquery.slimscroll.js');
        echo $this->assets->js('waves.js');
        echo $this->assets->js('sidebarmenu.js');
        echo $this->assets->plugins_js('sticky-kit-master/dist/sticky-kit.min.js');
        echo $this->assets->plugins_js('sparkline/jquery.sparkline.min.js');
        echo $this->assets->js('custom.min.js');
        echo $this->assets->plugins_js('styleswitcher/jQuery.style.switcher.js');
        echo $this->assets->plugins_js('sweetalert/sweetalert.min.js');
        echo $this->assets->plugins_js('parsley.min.js');
        echo $this->assets->plugins_js('input-valid.js');
        echo $this->assets->js('flash-message.js');
        ?>

        <script>
            var service_base_url = $('#service_base_url').val();
            $('#form-register').parsley();

            function accept_confirm() {
                $('#accept').prop('checked', true);
                $('#bt-submit').prop('disabled', false);
                $("#modal_accept").modal('hide');
            }

            function check() {
                var form = $("#form-register");
                form.parsley().validate();
                if (form.parsley().isValid() == true) {
                    //console.log('form-register');
                    var telcheck = $('#telcheck').val();
                    var refotp = makerefotp();
                    var otp = makeotp();
                    $('#refotp').val(refotp);
                    $('#otp').val(otp);

                    $.ajax({
                        url: service_base_url + 'register/modalsendsms',
                        type: 'post',
                        data: {
                            telcheck: telcheck,
                            refotp: refotp,
                            otp: otp,
                        },
                        success: function (response) {
                            if (response == 1) {
                                swal({
                                    title: "เบอร์โทรนี้ถูกใช้ไปแล้ว",
                                    text: "กรุณาระบุเบอร์โทรใหม่",
                                    type: "warning",
                                    confirmButtonColor: "#efbf87",
                                    confirmButtonText: "ตกลง",
                                    closeOnConfirm: false
                                });
                                $('#telcheck').val('');
                                setTimeout(function () {
                                    $('#telcheck').focus();
                                }, 2000);
                            } else {
                                $('#for_modal').html(response);
                                $("#on_modal").modal('show', {backdrop: 'static'});
                                //console.log($('#refotp').val() + '/' + $('#otp').val());
                                $.ajax({
                                    url: service_base_url + 'sms/sendSMSOTP',
                                    type: 'post',
                                    data: {
                                        telcheck: telcheck,
                                        refotp: refotp,
                                        otp: otp,
                                    },
                                    success: function (res) {
                                        //console.log(res);
                                        if (res == 0) {
                                            swal({
                                                title: "เกิดข้อผิดผลาดในการส่ง SMS",
                                                type: "error",
                                                confirmButtonColor: "#e98382",
                                                confirmButtonText: "ตกลง",
                                                closeOnConfirm: false
                                            }, function (isConfirm) {
                                                if (isConfirm) {
                                                    $('#on_modal').modal('hide');
                                                    swal({
                                                        title: "อาจไม่มีเบอร์โทรที่ระบุ  ",
                                                        text: "หรือ ระบบการส่งผิดผลาด",
                                                        type: "warning",
                                                        timer: 2000,
                                                        showConfirmButton: false
                                                    });
                                                }
                                            });
                                        }
                                    }
                                });
                            }
                        }
                    });
                }
                return false;
            }

            function makerefotp() {
                var text = "";
                var possible = "123456789";
                for (var i = 0; i < 4; i++)
                    text += possible.charAt(Math.floor(Math.random() * possible.length));
                return text;
            }

            function makeotp() {
                var text = "";
                var possible = "0123456789";
                for (var i = 0; i < 6; i++)
                    text += possible.charAt(Math.floor(Math.random() * possible.length));
                return text;
            }

            function againOTP() {
                $('#on_modal').modal('toggle');
                check();
            }

            function confirmOTP(telcheck) {
                $('#on_modal').modal('toggle');
                if ($('#checkotp').val() == $('#otp').val()) {
                    $('#form-register').submit();
                    //console.log('#form-register')
                } else {
                    swal({
                        title: "รหัส OTP ไม่ผ่าน",
                        text: "กรุณากดบันทึกเพื่อยืนยัน รหัส OTP ใหม่",
                        type: "warning",
                        confirmButtonColor: "#efbf87",
                        confirmButtonText: "ตกลง",
                        closeOnConfirm: false
                    });
                }
            }

            function modal_accept() {
                $("#modal_accept").modal('show', {backdrop: 'static'});
            }

        </script>
    </body>
</html>