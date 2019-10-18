
<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport" />       
        <title><?php echo 'Document API | Stock & POS manager'; ?></title>    
        <link rel="icon" type="image/png" sizes="16x16" href="<?php echo base_url() . 'assets/img/favicon.png'; ?>">
        <meta name="robots" content="noindex, nofollow">

        <?php
        echo $this->assets->plugins_css('bootstrap/css/bootstrap.min.css');
        echo $this->assets->css('style.css');
        ?>

    </head>

    <body>
        <header class="topbar" style="background-color: #1565C0;">
            <nav class="navbar top-navbar navbar-toggleable-sm navbar-light">
                <div class="navbar-header text-center" style="width: 100%">     
                    <span><img src="../assets/img/logo1.png" class="light-logo" alt="homepage" width="120"></span>
                </div>
            </nav>
        </header>
        <section id="wrapper">
            <div class="page-wrapper">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-block">
                                    <h4 class="card-title"><?php echo "API สินค้า + E-Commerce"; ?></h4>  
                                    <p class="text-primary">
                                        สินค้า
                                    </p>
                                    <img src="<?php echo base_url() . 'store/image/apiproduct.png'; ?>" class="img-responsive"/>
                                    <p>
                                        URL POST : <?php echo base_url() . 'service/api/product'; ?> 
                                    </p>
                                    <table class="table table-bordered table-sm" style="font-size: 14px;">
                                        <thead>
                                            <tr>
                                                <th>ตัวแปร</th>
                                                <th>อธิบาย</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>token</td>
                                                <td>token ที่ได้จากร้าน</td>
                                            </tr>
                                            <tr>
                                                <td>customer_group_id</td>
                                                <td>รหัสกลุ่มลูกค้า</td>
                                            </tr>
                                            <tr>
                                                <td>user_id</td>
                                                <td>รหัสผู้ใช้งานหลัก</td>
                                            </tr>
                                            <tr>
                                                <td>limit</td>
                                                <td>จำนวนแสดงสินค้า</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <p>
                                        ค่าที่ได้ 
                                    </p>
                                    <img src="<?php echo base_url() . 'store/image/apiproductres.png'; ?>" class="img-responsive"/>                                        
                                    <p></p>
                                    <table class="table table-bordered table-sm" style="font-size: 14px;">
                                        <thead>
                                            <tr>
                                                <th>ตัวแปร</th>
                                                <th>อธิบาย</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>data</td>
                                                <td>สถานะ token</td>
                                            </tr>
                                            <tr>
                                                <td>product</td>
                                                <td>ข้อมูลสินค้า</td>
                                            </tr>
                                            <tr>
                                                <td>product_id_pri</td>
                                                <td>รหัสสินค้า(คีย์หลัก)</td>
                                            </tr>
                                            <tr>
                                                <td>product_id</td>
                                                <td>รหัสสินค้า</td>
                                            </tr>
                                            <tr>
                                                <td>product_name</td>
                                                <td>ชื่อสินค้า</td>
                                            </tr>
                                            <tr>
                                                <td>product_sale_price</td>
                                                <td>ราคาสินค้า</td>
                                            </tr>
                                            <tr>
                                                <td>image_name</td>
                                                <td>รูปภาพ</td>
                                            </tr>
                                            <tr>
                                                <td>category_name</td>
                                                <td>กลุ่มสินค้า</td>
                                            </tr>
                                            <tr>
                                                <td>count</td>
                                                <td>จำนวนสินค้าทั้งหมด</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <br>
                                    <p class="text-primary">
                                        กลุ่มสินค้า
                                    </p>
                                    <img src="<?php echo base_url() . 'store/image/apiproductcategory.png'; ?>" class="img-responsive"/>
                                    <p>
                                        URL POST : <?php echo base_url() . 'service/api/productcategory'; ?> 
                                    </p>
                                    <table class="table table-bordered table-sm" style="font-size: 14px;">
                                        <thead>
                                            <tr>
                                                <th>ตัวแปร</th>
                                                <th>อธิบาย</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>token</td>
                                                <td>token ที่ได้จากร้าน</td>
                                            </tr>
                                            <tr>
                                                <td>customer_group_id</td>
                                                <td>รหัสกลุ่มลูกค้า</td>
                                            </tr>
                                            <tr>
                                                <td>user_id</td>
                                                <td>รหัสผู้ใช้งานหลัก</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <p>
                                        ค่าที่ได้ 
                                    </p>
                                    <img src="<?php echo base_url() . 'store/image/apiproductcategoryres.png'; ?>" class="img-responsive"/>                                        
                                    <p></p>
                                    <table class="table table-bordered table-sm" style="font-size: 14px;">
                                        <thead>
                                            <tr>
                                                <th>ตัวแปร</th>
                                                <th>อธิบาย</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>data</td>
                                                <td>สถานะ token</td>
                                            </tr>
                                            <tr>
                                                <td>category</td>
                                                <td>ข้อมูลกลุ่มสินค้า</td>
                                            </tr>
                                            <tr>
                                                <td>category_id</td>
                                                <td>รหัสกลุ่มสินค้า</td>
                                            </tr>
                                            <tr>
                                                <td>category_name</td>
                                                <td>ชื่อกลุ่มสินค้า</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <br/>
                                    <p class="text-primary">
                                        คุณสมบัติสินค้า
                                    </p>
                                    <img src="<?php echo base_url() . 'store/image/apiproductproperties.png'; ?>" class="img-responsive"/>
                                    <p>
                                        URL POST : <?php echo base_url() . 'service/api/productproperties'; ?> 
                                    </p>
                                    <table class="table table-bordered table-sm" style="font-size: 14px;">
                                        <thead>
                                            <tr>
                                                <th>ตัวแปร</th>
                                                <th>อธิบาย</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>token</td>
                                                <td>token ที่ได้จากร้าน</td>
                                            </tr>
                                            <tr>
                                                <td>customer_group_id</td>
                                                <td>รหัสกลุ่มลูกค้า</td>
                                            </tr>
                                            <tr>
                                                <td>user_id</td>
                                                <td>รหัสผู้ใช้งานหลัก</td>
                                            </tr>
                                            <tr>
                                                <td>product_id_pri</td>
                                                <td>รหัสสินค้า (คีย์หลัก)</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <p>
                                        ค่าที่ได้ 
                                    </p>
                                    <img src="<?php echo base_url() . 'store/image/apiproductpropertiesres.png'; ?>" class="img-responsive"/>                                        
                                    <p></p>
                                    <table class="table table-bordered table-sm" style="font-size: 14px;">
                                        <thead>
                                            <tr>
                                                <th>ตัวแปร</th>
                                                <th>อธิบาย</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>data</td>
                                                <td>สถานะ token</td>
                                            </tr>
                                            <tr>
                                                <td>productpropertie</td>
                                                <td>ข้อมูลคุณสมบัติสินค้า</td>
                                            </tr>
                                            <tr>
                                                <td>product_id_pri</td>
                                                <td>รหัสสินค้า (คีย์หลัก)</td>
                                            </tr>
                                            <tr>
                                                <td>product_id</td>
                                                <td>รหัสสินค้า</td>
                                            </tr>
                                            <tr>
                                                <td>product_name</td>
                                                <td>ชื่อสินค้า</td>
                                            </tr>
                                            <tr>
                                                <td>product_brand</td>
                                                <td>แบรนด์สินค้า</td>
                                            </tr>
                                            <tr>
                                                <td>product_gen</td>
                                                <td>รุ่นสินค้า</td>
                                            </tr>
                                            <tr>
                                                <td>product_unit</td>
                                                <td>หน่วยนับสินค้า</td>
                                            </tr>
                                            <tr>
                                                <td>product_sale_price</td>
                                                <td>ราคาสินค้า</td>
                                            </tr>
                                            <tr>
                                                <td>product_weight</td>
                                                <td>น้ำหนัก</td>
                                            </tr>
                                            <tr>
                                                <td>image_name</td>
                                                <td>รูปภาพ</td>
                                            </tr>
                                            <tr>
                                                <td>category_name</td>
                                                <td>กลุ่มสินค้า</td>
                                            </tr>
                                            <tr>
                                                <td>properties_name</td>
                                                <td>คุณสมบัติ</td>
                                            </tr>
                                            <tr>
                                                <td>properties_value</td>
                                                <td>ค่าคุณสมบัติ</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <br>
                                    <p class="text-primary">
                                        ตัวกรองข้อมูลสินค้า
                                    </p>
                                    <img src="<?php echo base_url() . 'store/image/apiproduct.png'; ?>" class="img-responsive"/>
                                    <p>
                                        URL POST : <?php echo base_url() . 'service/api/product'; ?> 
                                    </p>
                                    <table class="table table-bordered table-sm" style="font-size: 14px;">
                                        <thead>
                                            <tr>
                                                <th>ตัวแปร</th>
                                                <th>อธิบาย</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>token</td>
                                                <td>token ที่ได้จากร้าน</td>
                                            </tr>
                                            <tr>
                                                <td>customer_group_id</td>
                                                <td>รหัสกลุ่มลูกค้า</td>
                                            </tr>
                                            <tr>
                                                <td>user_id</td>
                                                <td>รหัสผู้ใช้งานหลัก</td>
                                            </tr>
                                            <tr>
                                                <td>search</td>
                                                <td>คำค้นหาชื่อสิค้า</td>
                                            </tr>
                                            <tr>
                                                <td>category_id</td>
                                                <td>รหัสกลุ่มสินค้า</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <p>
                                        ค่าที่ได้ 
                                    </p>
                                    <img src="<?php echo base_url() . 'store/image/apiproductres.png'; ?>" class="img-responsive"/>                                        
                                    <p></p>
                                    <table class="table table-bordered table-sm" style="font-size: 14px;">
                                        <thead>
                                            <tr>
                                                <th>ตัวแปร</th>
                                                <th>อธิบาย</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>data</td>
                                                <td>สถานะ token</td>
                                            </tr>
                                            <tr>
                                                <td>product</td>
                                                <td>ข้อมูลสินค้า</td>
                                            </tr>
                                            <tr>
                                                <td>product_id_pri</td>
                                                <td>รหัสสินค้า (คีย์หลัก)</td>
                                            </tr>
                                            <tr>
                                                <td>product_id</td>
                                                <td>รหัสสินค้า</td>
                                            </tr>
                                            <tr>
                                                <td>product_name</td>
                                                <td>ชื่อสินค้า</td>
                                            </tr>
                                            <tr>
                                                <td>product_sale_price</td>
                                                <td>ราคาสินค้า</td>
                                            </tr>
                                            <tr>
                                                <td>image_name</td>
                                                <td>รูปภาพ</td>
                                            </tr>
                                            <tr>
                                                <td>category_name</td>
                                                <td>กลุ่มสินค้า</td>
                                            </tr>
                                            <tr>
                                                <td>category_id</td>
                                                <td>รหัสกลุ่มสินค้า</td>
                                            </tr>
                                            <tr>
                                                <td>count</td>
                                                <td>จำนวนสินค้าทั้งหมด</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <br>
                                    <p class="text-primary">
                                        เปิดใบ Order
                                    </p>                                   
                                    <p>
                                        URL POST : <?php echo base_url() . 'service/api/save'; ?> 
                                    </p>
                                    <p>
                                        ฟังก์ชั่นเปิดใบ Order (ตัวอย่าง)
                                    </p> 
                                    <img src="<?php echo base_url() . 'store/image/apisave.png'; ?>" class="img-responsive"/>
                                    <p></p>
                                    <p>ส่งค่า</p>
                                    <table class="table table-bordered table-sm" style="font-size: 14px;">
                                        <thead>
                                            <tr>
                                                <th>ตัวแปร</th>
                                                <th>อธิบาย</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>$("#form-shop-cart")</td>
                                                <td>(ตัวอย่าง) ID ฟอร์มสำหรับส่งค่า เปิดใบ Order</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <p>ค่าในฟอร์ม</p>
                                    <table class="table table-bordered table-sm" style="font-size: 14px;">
                                        <thead>
                                            <tr>
                                                <th>ตัวแปร</th>
                                                <th>อธิบาย</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>token</td>
                                                <td>token ที่ได้จากร้าน</td>
                                            </tr>
                                            <tr>
                                                <td>customer_group_id</td>
                                                <td>รหัสกลุ่มลูกค้า</td>
                                            </tr>
                                            <tr>
                                                <td>user_id</td>
                                                <td>รหัสผู้ใช้งานหลัก</td>
                                            </tr>
                                            <tr>
                                                <td>product_id</td>
                                                <td>รหัสสินค้า</td>
                                            </tr>
                                            <tr>
                                                <td>product_name</td>
                                                <td>ชื่อสินค้า</td>
                                            </tr>
                                            <tr>
                                                <td>product_amount</td>
                                                <td>จำนวนสินค้า</td>
                                            </tr>
                                            <tr>
                                                <td>product_unit</td>
                                                <td>หน่วยนับสินค้า</td>
                                            </tr>
                                            <tr>
                                                <td>product_price</td>
                                                <td>ราคาสินค้าต่อหน่วย</td>
                                            </tr>
                                            <tr>
                                                <td>product_save</td>
                                                <td>ส่วนลดสินค้า</td>
                                            </tr>
                                            <tr>
                                                <td>product_price_sum</td>
                                                <td>ราคารวมสินค้า</td>
                                            </tr>
                                            <tr>
                                                <td>price_sum_pay</td>
                                                <td>ยอดรวมทั้งสิ้น</td>
                                            </tr>
                                            <tr>
                                                <td>fullname</td>
                                                <td>ชื่อ-สกุลลูกค้า</td>
                                            </tr>
                                            <tr>
                                                <td>tel</td>
                                                <td>เบอร์โทรลูกค้า</td>
                                            </tr>
                                            <tr>
                                                <td>email</td>
                                                <td>อีเมลลูกค้า</td>
                                            </tr>
                                            <tr>
                                                <td>address</td>
                                                <td>ที่อยู่ลูกค้า</td>
                                            </tr>
                                            <tr>
                                                <td>district</td>
                                                <td>ตำบลลูกค้า</td>
                                            </tr>
                                            <tr>
                                                <td>amphoe</td>
                                                <td>อำเภอลูกค้า</td>
                                            </tr>
                                            <tr>
                                                <td>province</td>
                                                <td>จังหวัดลูกค้า</td>
                                            </tr>
                                            <tr>
                                                <td>zipcode</td>
                                                <td>รหัสไปรษณีย์ลูกค้า</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <p>คืนค่า</p>
                                    <table class="table table-bordered table-sm" style="font-size: 14px;">
                                        <thead>
                                            <tr>
                                                <th>ตัวแปร</th>
                                                <th>อธิบาย</th>
                                            </tr>
                                        </thead>
                                        <tbody>                                           
                                            <tr>
                                                <td>res = 1</td>
                                                <td>เปิด Order สำเร็จ</td>
                                            </tr>
                                            <tr>
                                                <td>res = 0</td>
                                                <td>ไม่สำเร็จ</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <p></p>
                                    <p class="text-danger">โค้ด ตัวอย่าง : <a target="_blank" href="https://github.com/prasan2533/APSTH-FONT-POS">https://github.com/prasan2533/APSTH-FONT-POS</a></p>
                                    <a href="https://github.com/prasan2533/APSTH-FONT-POS/blob/master/apsth/index.html" target="_blank">ไฟล์ index.html</a>
                                    
                                    <p>ส่วนสำคัญ ส่วนที่ 1 (ส่วนแสดงหน้า html)</p>
                                    <p></p>
                                    <img src="<?php echo base_url() . 'store/image/api1.png'; ?>" class="img-responsive"/>
                                    <p></p>
                                    <img src="<?php echo base_url() . 'store/image/api2.png'; ?>" class="img-responsive"/>
                                    <p></p>
                                    <p>ส่วนสำคัญ ส่วนที่ 2 (ส่วนแสดง ค่า และติดต่อ API)</p>
                                    <p></p>
                                    <img src="<?php echo base_url() . 'store/image/api3.png'; ?>" class="img-responsive"/>
                                    <p></p>
                                    <img src="<?php echo base_url() . 'store/image/api4.png'; ?>" class="img-responsive"/>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <footer class="footer"> Powered by © <a href="https://www.gm-thai.com/" target="_blank">APS</a>  2017 - 2018, V.2.0-UX All right reserved. </footer>
    </body>
</html>