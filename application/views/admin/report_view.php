<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-block">
                <h4 class="card-title"><i class="<?php echo $icon; ?>"></i> <?php echo " " . $title; ?> 
                </h4>  
                <table class="table browser m-t-30 no-border">
                    <tbody>
                        <tr>
                            <td style="width:40px"><div class="round round-lg align-self-center round-danger"><i class="fa fa-user-secret"></i></div></td>
                            <td class="text-primary"><a href="<?php echo base_url().'admin/reportlogincheck'; ?>" target="_blank">รายงานผู้ใช้งานระบบ</a></td>
                            <td style="width:40px"><div class="round round-lg align-self-center round-success"><i class="fa fa-envelope-open"></i></div></td>
                            <td class="text-primary"><a href="<?php echo base_url().'admin/reportlogsendsms'; ?>" target="_blank">รายงานการส่ง SMS</td>
                        </tr>
                         <tr>
                            <td style="width:40px"><div class="round round-lg align-self-center round-warning"><i class="fa fa-envelope-open-o"></i></div></td>
                            <td class="text-primary"><a href="<?php echo base_url().'admin/reportlogsendemail'; ?>" target="_blank">รายงานการส่ง Email</td>
                            <td style="width:40px"><div class="round round-lg align-self-center round-danger"><i class="fa fa-gift"></i></div></td>
                            <td class="text-primary"><a href="<?php echo base_url().'admin/reportlogpackage'; ?>" target="_blank">รายงานแพ็เกจ</td>
                        </tr>
                         <tr>
                            <td style="width:40px"><div class="round round-lg align-self-center round-success"><i class="fa fa-bell"></i></div></td>
                            <td class="text-primary"><a href="<?php echo base_url().'admin/reportlogcreditsms'; ?>" target="_blank">รายงานเครดิต SMS</td>
                            <td style="width:40px"><div class="round round-lg align-self-center round-warning"><i class="fa fa-money"></i></div></td>
                            <td class="text-primary"><a href="<?php echo base_url().'admin/reportlogreceipt'; ?>" target="_blank">รายงานแจ้งโอนเงิน</td>
                        </tr>
                        <tr>
                            <td style="width:40px"><div class="round round-lg align-self-center round-info"><i class="fa fa-handshake-o"></i></div></td>
                            <td class="text-purple"><a href="<?php echo base_url().'admin/apidoc'; ?>" target="_blank">API</td>                            
                        </tr>
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</div>