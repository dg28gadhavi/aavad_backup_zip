<?php 
//echo '<pre>'; print_r($basic);
//echo '<pre>'; print_r($items);die;
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
<style type="text/css">
/*@font-face {
        font-family: 'Arial Black', Gadget, sans-serif;
        src:url(<?php echo base_url(); ?>assets/custom/font/Tahoma.ttf) format('truetype');
}
*/  body {
        margin: 0;
        padding: 0;
        background-color: #FFF;
        line-height:1.2;
       font-family: 'Arial Black', Gadget, sans-serif;
       letter-spacing:normal;
    }
    * {
        box-sizing: border-box;
        -moz-box-sizing: border-box;
        font-family: 'Arial Black', Gadget, sans-serif
    }
    .page {
        width: 100%;
        margin: 0 auto;
        background: white;
        font-family: 'Arial Black', Gadget, sans-serif
    }
    p
    {
        margin:0;
        padding:0;
        font-family: 'Arial Black', Gadget, sans-serif
    }
</style>
</head>
<body>
<div class="page">
<div style="width:100%; margin:0 auto;padding-top:50px; font-family: 'Arial Black', Gadget, sans-serif">
    <table style="width:100%;border-collapse:collapse; margin-top:-112px;">
        <tr>
            <td colspan="2" style="width:98%; float:left;">
            
			<?php /*?><img src="<?php echo base_url(); ?>assets/custom/images/miconindia-header-new.jpg"/><?php */?></td>
        </tr>
    </table>
    <table style="width:100%;border-collapse:collapse;">
        <tr nobr="true">
            <td colspan="2" style="width:98%; color:#e41f26; padding-top: 10px; padding-bottom:0.3cm; text-align:center;font-size:17px; text-transform: uppercase; font-weight:bold; letter-spacing: 1px;">Inward</td>
        </tr>
        <tr>
            
             <td valign="top" style="width:7cm;border-top:1px solid #e41f26; border-left:1px solid #e41f26;border-bottom:1px solid #e41f26;border-right:1px solid #e41f26; padding-top:0.2cm; padding-bottom:0.2cm; padding-left:0.1cm; padding-right:0.1cm;">
                <div style="width:98%; margin-top:0;">
                    <!-- <div style="width:100%; font-size:11px; float:left; letter-spacing: 1px;"> <span style="font-weight:bold;">Invoice No</span> : PI NV111310 </div> -->
                    <table style="width:100%;border-collapse:collapse;">
                        <tr>
                            <td valign="top" style=" width:25%; font-size:11px; float:left; letter-spacing: 1px; text-align:left;"><strong>Inward Code</strong><span style="text-align:right !important;"></span></td>
                            <td valign="top" style=" width:5%; font-size:11px; float:left; letter-spacing: 1px; text-align:center;">:</td>
                            <td valign="top" style=" width:45.5%; font-size:11px; float:left; letter-spacing: 1px; text-align:left;"><?php echo isset($basic['inw_no']) ? $basic['inw_no'] : '';  ?></td>
                        </tr>
                        <tr>
                            <td valign="top" style="width:25%; font-size:11px; float:left; letter-spacing: 1px; text-align:left; padding-top:5px;"><strong>Supplier</strong><span style="text-align:right !important;"></span></td>
                            <td valign="top" style="padding-top:5px; width:5%; font-size:11px; float:left; letter-spacing: 1px; text-align:center;">:</td>
                            <td valign="top" style="padding-top:5px; width:45.5%; font-size:11px; float:left; letter-spacing: 1px; text-align:left;"><?php echo isset($basic['inw_suppiler']) ? $basic['inw_suppiler'] : '';  ?></td>
                        </tr>
                        <tr>
                            <td valign="top" style="width:25%; font-size:11px; float:left; letter-spacing: 1px; text-align:left; padding-top:5px;"><strong>Bill No</strong><span style="text-align:right !important;"></span></td>
                            <td valign="top" style="padding-top:5px; width:5%; font-size:11px; float:left; letter-spacing: 1px; text-align:center;">:</td>
                            <td valign="top" style="padding-top:5px; width:45.5%; font-size:11px; float:left; letter-spacing: 1px; text-align:left;"><?php echo isset($basic['inw_billno']) ? $basic['inw_billno'] : '';  ?></td>
                        </tr>
                        <tr>
                            <td valign="top" style="width:25%; font-size:11px; float:left; letter-spacing: 1px; text-align:left; padding-top:5px;"><strong>Bill Date</strong><span style="text-align:right !important;"></span></td>
                            <td valign="top" style="padding-top:5px; width:5%; font-size:11px; float:left; letter-spacing: 1px; text-align:center;">:</td>
                            <td valign="top" style="padding-top:5px; width:45.5%; font-size:11px; float:left; letter-spacing: 1px; text-align:left;"><?php echo isset($basic['inw_billdate']) ? date("d/m/Y", strtotime($basic['inw_billdate'])) : '';  ?></td>
                        </tr>
                        <tr>
                            <td valign="top" style="width:25%; font-size:11px; float:left; letter-spacing: 1px; text-align:left; padding-top:5px;"><strong>Challan No</strong><span style="text-align:right !important;"></span></td>
                            <td valign="top" style="padding-top:5px; width:5%; font-size:11px; float:left; letter-spacing: 1px; text-align:center;">:</td>
                            <td valign="top" style="padding-top:5px; width:45.5%; font-size:11px; float:left; letter-spacing: 1px; text-align:left;"><?php echo isset($basic['inw_challan_no']) ? $basic['inw_challan_no'] : '';  ?></td>
                        </tr>
                        <tr>
                            <td valign="top" style="width:25%; font-size:11px; float:left; letter-spacing: 1px; text-align:left; padding-top:5px;"><strong>Challan Date</strong><span style="text-align:right !important;"></span></td>
                            <td valign="top" style="padding-top:5px; width:5%; font-size:11px; float:left; letter-spacing: 1px; text-align:center;">:</td>
                            <td valign="top" style="padding-top:5px; width:45.5%; font-size:11px; float:left; letter-spacing: 1px; text-align:left;"><?php echo isset($basic['inw_challan_date']) ? date("d/m/Y", strtotime($basic['inw_challan_date'])) : '';  ?></td>
                        </tr>
                        
                        </table>
                </div>
            </td>

            <td valign="top" style="width:5cm;border-top:1px solid #e41f26; border-left:1px solid #e41f26;border-bottom:1px solid #e41f26;border-right:1px solid #e41f26; padding-top:0.2cm; padding-bottom:0.2cm; padding-left:0.1cm; padding-right:0.1cm;">
                <div style="width:98%; margin-top:0;">
                    <!-- <div style="width:100%; font-size:11px; float:left; letter-spacing: 1px;"> <span style="font-weight:bold;">Invoice No</span> : PI NV111310 </div> -->
                    <table style="width:100%;border-collapse:collapse;">
                    <tr>
                            <td valign="top" style=" width:25%; font-size:11px; float:left; letter-spacing: 1px; text-align:left;"><strong>LR No</strong><span style="text-align:right !important;"></span></td>
                            <td valign="top" style=" width:5%; font-size:11px; float:left; letter-spacing: 1px; text-align:center;">:</td>
                            <td valign="top" style=" width:47.5%; font-size:11px; float:left; letter-spacing: 1px; text-align:left;"><?php echo isset($basic['inw_lr_no']) ? $basic['inw_lr_no'] : '';  ?></td>
                        </tr>
                        <tr>
                            <td valign="top" style=" width:25%; font-size:11px; float:left; letter-spacing: 1px; text-align:left;"><strong>LR Date</strong><span style="text-align:right !important;"></span></td>
                            <td valign="top" style=" width:5%; font-size:11px; float:left; letter-spacing: 1px; text-align:center;">:</td>
                            <td valign="top" style=" width:47.5%; font-size:11px; float:left; letter-spacing: 1px; text-align:left;"><?php echo isset($basic['inw_lr_date']) ? date("d/m/Y", strtotime($basic['inw_lr_date'])) : '';  ?></td>
                        </tr>
                        <tr>
                            <td valign="top" style=" width:25%; font-size:11px; float:left; letter-spacing: 1px; text-align:left;"><strong>INSP No</strong><span style="text-align:right !important;"></span></td>
                            <td valign="top" style=" width:5%; font-size:11px; float:left; letter-spacing: 1px; text-align:center;">:</td>
                            <td valign="top" style=" width:47.5%; font-size:11px; float:left; letter-spacing: 1px; text-align:left;"><?php echo isset($basic['inw_insp_no']) ? $basic['inw_insp_no'] : '';  ?></td>
                        </tr>
                        <tr>
                            <td valign="top" style="width:25%; font-size:11px; float:left; letter-spacing: 1px; text-align:left; padding-top:5px;"><strong>INSP Date</strong><span style="text-align:right !important;"></span></td>
                            <td valign="top" style="padding-top:5px; width:5%; font-size:11px; float:left; letter-spacing: 1px; text-align:center;">:</td>
                            <td valign="top" style="padding-top:5px; width:47.5%; font-size:11px; float:left; letter-spacing: 1px; text-align:left;"><?php echo isset($basic['inw_insp_date']) ? date("d/m/Y", strtotime($basic['inw_insp_date'])) : '';  ?>
							<?php //if(isset($inv['sq_enq_date']) && $inv['sq_enq_date']!=''){echo date("d/m/Y", strtotime($inv['sq_enq_date']));}else{echo '';} ?></td>
                        </tr>
                         <tr>
                            <td valign="top" style="width:25%; font-size:11px; float:left; letter-spacing: 1px; text-align:left; padding-top:5px;"><strong>Transporter Name</strong><span style="text-align:right !important;"></span></td>
                            <td valign="top" style="padding-top:5px; width:5%; font-size:11px; float:left; letter-spacing: 1px; text-align:center;">:</td>
                            <td valign="top" style="padding-top:5px; width:47.5%; font-size:11px; float:left; letter-spacing: 1px; text-align:left;"><?php echo isset($basic['inw_transport_name']) ? $basic['inw_transport_name'] : '';  ?></td>
                        </tr>
                        <tr>
                            <td valign="top" style="width:25%; font-size:11px; float:left; letter-spacing: 1px; text-align:left; padding-top:5px;"><strong>Material Return</strong><span style="text-align:right !important;"></span></td>
                            <td valign="top" style="padding-top:5px; width:5%; font-size:11px; float:left; letter-spacing: 1px; text-align:center;">:</td>
                            <td valign="top" style="padding-top:5px; width:47.5%; font-size:11px; float:left; letter-spacing: 1px; text-align:left;"><?php echo isset($basic['inw_material_return']) ? $basic['inw_material_return'] : '';  ?></td>
                        </tr>
                        
                        
                        
                        </table>
                </div>
            </td>
        </tr>

        <?php /*?><tr>
            <td valign="top" colspan="2" style="width:6cm;border-top:1px solid #e9494f; border-left:1px solid #e41f26; border-right:1px solid #e41f26; border-bottom:1px solid #e41f26; padding-top:0.2cm; padding-bottom:0.2cm; padding-left:0.1cm; padding-right:0.1cm;">
                <table style="width:100%;border-collapse:collapse;">
                    <tr>
                            <td valign="top" style="width:50px; font-size:11px; float:left; letter-spacing: 1px; text-align:left; padding-top:5px;"><strong>Kind attn</strong><span style="text-align:right !important;"></span></td>
                            <td valign="top" style="padding-top:5px; width:10px; font-size:11px; float:left; letter-spacing: 1px; text-align:center;">:</td>
                            <td valign="top" style="padding-top:5px; width:520px; font-size:11px; float:left; letter-spacing: 1px; text-align:left;"><?php //if(isset($inv['sq_con_person']) && $inv['sq_con_person']!=''){echo $inv['sq_con_person'];}else{echo '';} ?></td>
                    </tr>
                    <tr>
                            <td valign="top" style="width:50px; font-size:11px; float:left; letter-spacing: 1px; text-align:left; padding-top:5px;"><strong> Sub</strong><span style="text-align:right !important;"></span></td>
                            <td valign="top" style="padding-top:5px; width:10px; font-size:11px; float:left; letter-spacing: 1px; text-align:center;">:</td>
                            <td valign="top" style="padding-top:5px; width:520px; font-size:11px; float:left; letter-spacing: 1px; text-align:left;"><?php //if(isset($inv['sales_enq_sub']) && $inv['sales_enq_sub']!=''){echo $inv['sales_enq_sub'];}else{echo '';} ?></td>
                    </tr>        
                </table>

            </td>
        </tr><?php */?>
        <tr>
            <td valign="top" colspan="2" style="width:6cm; border-top:1px solid #e9494f; border-left:1px solid #e41f26; border-right:1px solid #e41f26; border-bottom:1px solid #e41f26; padding-top:0.2cm; padding-bottom:0.2cm; padding-left:0.1cm; padding-right:0.1cm;">
                <table style="width:100%;border-collapse:collapse;">
                <tr>
                    <td valign="top" style="padding-top:5px; width:129px; font-size:11px; float:left; letter-spacing: 1px; text-align:left;"><strong> Remark ,</strong></td>
                    </tr>
                <tr>
                    <td valign="top" style="padding-top:10px;padding-bottom:10px; width:650px; font-size:11px; float:left; letter-spacing: 1px; text-align:left;"><?php echo isset($basic['inw_remark']) ? $basic['inw_remark'] : '';  ?></td>                 
                </tr>
            </table>

            </td>
        </tr>
        </table>      
        <table style="width: 18cm; border-collapse:collapse;background: #f8f8f8;" autosize="0">
                 
                    <tr>
                        <td valign="middle" height="25" style="width: 1cm;font-size:18px; letter-spacing: 1px; text-align:center; font-weight:bold;background-color:#f7bbbd;border-bottom:1px solid #e41f26;border-left:1px solid #e41f26;">Sr.No</td>
                        <td colspan="2" height="25" valign="middle" style="width: 4cm; border-left: 1px solid #e41f26; font-size:18px; float:left; letter-spacing: 1px; text-align:center; font-weight:bold; background-color:#f7bbbd;border-bottom:1px solid #e41f26;">Item name</td>
                        <td colspan="2" height="25" valign="middle" style="width: 8cm; border-left: 1px solid #e41f26; font-size:18px; float:left; letter-spacing: 1px; text-align:center; font-weight:bold;background-color:#f7bbbd;border-bottom:1px solid #e41f26;">Part No</td>
                        <td  valign="middle" height="25" style="width: 2cm; border-left: 1px solid #e41f26; font-size:18px; float:left; letter-spacing: 1px; text-align:center; font-weight:bold;border-bottom:1px solid #e41f26;background-color:#f7bbbd;">Qty</td>
                        <td  colspan="2" height="25" valign="middle" style="width: 3cm;border-left: 1px solid #e41f26; font-size:18px; float:left; letter-spacing: 1px; text-align:center; font-weight:bold;background-color:#f7bbbd;border-bottom:1px solid #e41f26;border-right:1px solid #e41f26;">PRICE</td>
                         <td  colspan="2" height="25" valign="middle" style="width: 3cm;border-left: 1px solid #e41f26; font-size:18px; float:left; letter-spacing: 1px; text-align:center; font-weight:bold;background-color:#f7bbbd;border-bottom:1px solid #e41f26;border-right:1px solid #e41f26;">Total</td>
                          <td  colspan="2" height="25" valign="middle" style="width: 3cm;border-left: 1px solid #e41f26; font-size:18px; float:left; letter-spacing: 1px; text-align:center; font-weight:bold;background-color:#f7bbbd;border-bottom:1px solid #e41f26;border-right:1px solid #e41f26;">Discount</td>   
                          <td  colspan="2" height="25" valign="middle" style="width: 3cm;border-left: 1px solid #e41f26; font-size:18px; float:left; letter-spacing: 1px; text-align:center; font-weight:bold;background-color:#f7bbbd;border-bottom:1px solid #e41f26;border-right:1px solid #e41f26;">Final Total</td>       
                    </tr>

                   <?php  //$itm_discount = 0;
                    $srno = 0; $finaltotal = 0; foreach ($items as $item) { $srno++; ?>

                    <tr>
                        <td valign="middle" height="25" style="width: 1cm;font-size:18px; letter-spacing: 1px; text-align:center; border-bottom:1px solid #e41f26;border-left:1px solid #e41f26;"><?php echo $srno?></td>
                        <td colspan="2" height="25" valign="middle" style="width: 4cm; border-left: 1px solid #e41f26; font-size:18px; float:left; letter-spacing: 1px; text-align:center;  border-bottom:1px solid #e41f26;"><?php echo isset($item['inwi_itm_title']) ? $item['inwi_itm_title'] : ''; ?></td>
                        <td colspan="2" height="25" valign="middle" style="width: 8cm; border-left: 1px solid #e41f26; font-size:18px; float:left; letter-spacing: 1px; text-align:center; border-bottom:1px solid #e41f26;"><?php echo isset($item['inwi_part_no']) ? $item['inwi_part_no'] : ''; ?></td>
                        <td  valign="middle" height="25" style="width: 2cm; border-left: 1px solid #e41f26; font-size:18px; float:left; letter-spacing: 1px; text-align:center; border-bottom:1px solid #e41f26;"><?php echo isset($item['inwi_qty']) ? $item['inwi_qty'] : ''; ?></td>
                        <td  colspan="2" height="25" valign="middle" style="width: 3cm;border-left: 1px solid #e41f26; font-size:18px; float:left; letter-spacing: 1px; text-align:center; border-bottom:1px solid #e41f26;border-right:1px solid #e41f26;"><?php echo isset($item['inwi_price']) ? $item['inwi_price'] : ''; ?></td>
                         <td  colspan="2" height="25" valign="middle" style="width: 3cm;border-left: 1px solid #e41f26; font-size:18px; float:left; letter-spacing: 1px; text-align:center; border-bottom:1px solid #e41f26;border-right:1px solid #e41f26;"><?php echo isset($item['inwi_total']) ? $item['inwi_total'] : ''; ?></td>
                          <td  colspan="2" height="25" valign="middle" style="width: 3cm;border-left: 1px solid #e41f26; font-size:18px; float:left; letter-spacing: 1px; text-align:center; border-bottom:1px solid #e41f26;border-right:1px solid #e41f26;"><?php echo isset($item['inwi_discount']) ? $item['inwi_discount'] : ''; ?></td>   
                          <td  colspan="2" height="25" valign="middle" style="width: 3cm;border-left: 1px solid #e41f26; font-size:18px; float:left; letter-spacing: 1px; text-align:center;border-bottom:1px solid #e41f26;border-right:1px solid #e41f26;"><?php echo isset($item['inwi_ftotal']) ? $item['inwi_ftotal'] : ''; ?></td>       
                    </tr>  
                    <?php } ?> 
        </table>
        
        <table style="width:100%;border-collapse:collapse;">
                    <tr>
                    <td valign="middle" style="border-left:1px solid #e41f26;border-right:1px solid #e41f26;"></td>
                	</tr>
        </table>
             
</div>
</body>
</html>