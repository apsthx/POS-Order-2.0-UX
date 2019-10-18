<?php
//$checkbox_arr = $this->input->post('checkbox');
//$product_id_pri_arr = $this->input->post('product_id_pri');
//$amount_arr = $this->input->post('amount');
?>
<html>
    <head>
        <META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=UTF-8">
        <style type="text/css">
            table{
                border: 0px solid black;
                width: 100%;
            } 
            td{
                border: 0px solid black;
                padding: 0mm 0mm 0mm 1mm;
                height: 2mm;   
                text-align: center;
                vertical-align: central;
                //font-weight: bold;
            }
            p{
                border: 0px solid black;
                font-size: 2.5mm;
            }
            .barcode {
                margin: 0;
                vertical-align: central;
                color: #000000;
            }
        </style>
    </head>
    <body>     
        <div>
            <table> 
                <tr>
                    <td><p style="font-size: 2.5mm;"><?php echo $product->product_name; ?></p></td>
                    <td><p style="font-size: 2.5mm;"><?php echo $product->product_name; ?></p></td>
                    <td><p style="font-size: 2.5mm;"><?php echo $product->product_name; ?></p></td>
                </tr>
                <tr>
                    <td><p><?php echo $product->product_sale_price . ' บาท'; ?></p></td>
                    <td><p><?php echo $product->product_sale_price . ' บาท'; ?></p></td>
                    <td><p><?php echo $product->product_sale_price . ' บาท'; ?></p></td>
                </tr>
                <tr >
                    <td><barcode code="<?php echo $product->product_id; ?>" type="C128A" class="barcode" height="1" /></td>
                    <td><barcode code="<?php echo $product->product_id; ?>" type="C128A" class="barcode" height="1" /></td>
                    <td><barcode code="<?php echo $product->product_id; ?>" type="C128A" class="barcode" height="1" /></td>
                </tr>
                <tr>
                    <td><p><?php echo $product->product_id; ?></p></td>
                    <td><p><?php echo $product->product_id; ?></p></td>
                    <td><p><?php echo $product->product_id; ?></p></td>
                </tr>
            </table>
        </div>
    </body>
</html>