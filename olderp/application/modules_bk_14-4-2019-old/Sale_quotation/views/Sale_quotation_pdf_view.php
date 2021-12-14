<?php //echo '<pre>'; print_r($inv);die;
//echo '<pre>'; print_r($taxs);die;
//echo '<pre>'; print_r($items);die;
//echo '<pre>'; print_r($taxar);die;
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
*/    body {
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
<div style="width:98%; margin:0 auto;padding-top:50px; font-family: 'Arial Black', Gadget, sans-serif">
    <table style="width:100%;border-collapse:collapse; margin-top:-112px;">
        <tr>
            <td colspan="2" style="width:98%; float:left;"><img src="<?php echo base_url(); ?>assets/custom/images/miconindia-header-new.jpg"/></td>
        </tr>
    </table>
    <table style="width:100%;border-collapse:collapse;">
        <tr nobr="true">
            <td colspan="2" style="width:98%; color:#e41f26; padding-top: 10px; padding-bottom:0.3cm; text-align:center;font-size:17px; text-transform: uppercase; font-weight:bold; letter-spacing: 1px;">Quotation</td>
        </tr>
        <tr>
            
            <td valign="top" style="width:6cm;border-top:1px solid #e41f26; border-left:1px solid #e41f26;border-bottom:1px solid #e41f26;border-right:1px solid #e41f26; padding-top:0.2cm; padding-bottom:0.2cm; padding-left:0.1cm; padding-right:0.1cm;">
                <div style="width:98%; margin-top:0;">
                    <!-- <div style="width:100%; font-size:11px; float:left; letter-spacing: 1px;"> <span style="font-weight:bold;">Invoice No</span> : PI NV111310 </div> -->
                    <table style="width:100%;border-collapse:collapse;">
                        <tr>
                            <td valign="top" style=" width:70px; font-size:11px; float:left; letter-spacing: 1px; text-align:left;"><strong>M/s.</strong><span style="text-align:right !important;"></span></td>
                            <td valign="top" style=" width:10px; font-size:11px; float:left; letter-spacing: 1px; text-align:center;">:</td>
                            <td valign="top" style=" width:200px; font-size:11px; float:left; letter-spacing: 1px; text-align:left;"><?php echo $inv['vendor']; ?></td>
                        </tr>
                        <tr>
                            <td valign="top" style="width:70px; font-size:11px; float:left; letter-spacing: 1px; text-align:left; padding-top:5px;"><strong>Address</strong><span style="text-align:right !important;"></span></td>
                            <td valign="top" style="padding-top:5px; width:10px; font-size:11px; float:left; letter-spacing: 1px; text-align:center;">:</td>
                            <td valign="top" style="padding-top:5px; width:200px; font-size:11px; float:left; letter-spacing: 1px; text-align:left;"><?php echo isset($inv['sa_address']) ? nl2br($inv['sa_address']) : '' ; ?></td>
                        </tr>
                        <tr>
                            <td valign="top" style="width:70px; font-size:11px; float:left; letter-spacing: 1px; text-align:left; padding-top:5px;"><strong>City</strong><span style="text-align:right !important;"></span></td>
                            <td valign="top" style="padding-top:5px; width:10px; font-size:11px; float:left; letter-spacing: 1px; text-align:center;">:</td>
                            <td valign="top" style="padding-top:5px; width:200px; font-size:11px; float:left; letter-spacing: 1px; text-align:left;"><?php echo isset($inv['city_name']) ? nl2br($inv['city_name']) : '' ; ?></td>
                        </tr>
                        <tr>
                            <td valign="top" style="width:70px; font-size:11px; float:left; letter-spacing: 1px; text-align:left; padding-top:5px;"><strong>State</strong><span style="text-align:right !important;"></span></td>
                            <td valign="top" style="padding-top:5px; width:10px; font-size:11px; float:left; letter-spacing: 1px; text-align:center;">:</td>
                            <td valign="top" style="padding-top:5px; width:200px; font-size:11px; float:left; letter-spacing: 1px; text-align:left;"><?php echo isset($inv['state_name']) ? nl2br($inv['state_name']) : '' ; ?></td>
                        </tr>
                        <tr>
                            <td valign="top" style="width:70px; font-size:11px; float:left; letter-spacing: 1px; text-align:left; padding-top:5px;"><strong>Phone</strong><span style="text-align:right !important;"></span></td>
                            <td valign="top" style="padding-top:5px; width:10px; font-size:11px; float:left; letter-spacing: 1px; text-align:center;">:</td>
                            <td valign="top" style="padding-top:5px; width:200px; font-size:11px; float:left; letter-spacing: 1px; text-align:left;"><?php echo $inv['sa_mobile']; ?></td>
                        </tr>
                        <tr>
                            <td valign="top" style="width:70px; font-size:11px; float:left; letter-spacing: 1px; text-align:left; padding-top:5px;"><strong>Email</strong><span style="text-align:right !important;"></span></td>
                            <td valign="top" style="padding-top:5px; width:10px; font-size:11px; float:left; letter-spacing: 1px; text-align:center;">:</td>
                            <td valign="top" style="padding-top:5px; width:200px; font-size:11px; float:left; letter-spacing: 1px; text-align:left;"><?php echo nl2br($inv['sa_email']); ?></td>
                        </tr>
                         
                        </table>
                </div>
            </td>
	<!-- <div style="width:100%;">CH A    :</div></td> -->
            <td valign="top" style="width:6cm;border-top:1px solid #e41f26; border-left:1px solid #e41f26;border-bottom:1px solid #e41f26;border-right:1px solid #e41f26; padding-top:0.2cm; padding-bottom:0.2cm; padding-left:0.1cm; padding-right:0.1cm;">
                <div style="width:98%; margin-top:0;">
                    <!-- <div style="width:100%; font-size:11px; float:left; letter-spacing: 1px;"> <span style="font-weight:bold;">Invoice No</span> : PI NV111310 </div> -->
                    <table style="width:100%;border-collapse:collapse;">
                        <tr>
                            <td valign="top" style="width:90px; font-size:11px; float:left; letter-spacing: 1px; text-align:left;"><strong>Quotation No.</strong><span style="text-align:right !important;"></span></td>
                            <td valign="top" style="width:10px; font-size:11px; float:left; letter-spacing: 1px; text-align:center;">:</td>
                            <td valign="top" style="width:200px; font-size:11px; float:left; letter-spacing: 1px; text-align:left;"><?php echo $inv['sa_no'] ?></td>
                        </tr>
                        <tr>
                            <td valign="top" style="width:90px; font-size:11px; float:left; letter-spacing: 1px; text-align:left; padding-top:5px;"><strong>Date</strong><span style="text-align:right !important;"></span></td>
                            <td valign="top" style="padding-top:5px; width:10px; font-size:11px; float:left; letter-spacing: 1px; text-align:center;">:</td>
                            <td valign="top" style="padding-top:5px; width:200px; font-size:11px; float:left; letter-spacing: 1px; text-align:left;"><?php echo date("d-m-Y", strtotime($inv['sa_enq_date'])); ?></td>
                        </tr>
                        </table>
                </div>
            </td>
        </tr>
          <tr>
            <td valign="top" colspan="2" style="width:6cm; border-top:1px solid #e9494f; border-left:1px solid #e41f26; border-right:1px solid #e41f26; border-bottom:1px solid #e41f26; padding-top:0.2cm; padding-bottom:0.2cm; padding-left:0.1cm; padding-right:0.1cm;">
                <table style="width:100%;border-collapse:collapse;">
                    <tr>
                            <td valign="top" style="width:50px; font-size:11px; float:left; letter-spacing: 1px; text-align:left; padding-top:5px;"><strong>Kind attn</strong><span style="text-align:right !important;"></span></td>
                            <td valign="top" style="padding-top:5px; width:10px; font-size:11px; float:left; letter-spacing: 1px; text-align:center;">:</td>
                            <td valign="top" style="padding-top:5px; width:520px; font-size:11px; float:left; letter-spacing: 1px; text-align:left;"><?php if(isset($inv['sa_con_person']) && $inv['sa_con_person']!=''){echo $inv['sa_con_person'];}else{echo '';} ?></td>
                    </tr>
                    <tr>
                            <td valign="top" style="width:50px; font-size:11px; float:left; letter-spacing: 1px; text-align:left; padding-top:5px;"><strong> Sub</strong><span style="text-align:right !important;"></span></td>
                            <td valign="top" style="padding-top:5px; width:10px; font-size:11px; float:left; letter-spacing: 1px; text-align:center;">:</td>
                            <td valign="top" style="padding-top:5px; width:520px; font-size:11px; float:left; letter-spacing: 1px; text-align:left;"><?php if(isset($inv['sale_quotation_sub']) && $inv['sale_quotation_sub']!=''){echo $inv['sale_quotation_sub'];}else{echo '';} ?></td>
                    </tr>        
                </table>

            </td>
        </tr>
        <tr>
            <td valign="top" colspan="2" style="width:6cm; border-top:1px solid #e9494f; border-left:1px solid #e41f26; border-right:1px solid #e41f26; border-bottom:1px solid #e41f26; padding-top:0.2cm; padding-bottom:0.2cm; padding-left:0.1cm; padding-right:0.1cm;">
                <table style="width:100%;border-collapse:collapse;">
                <tr>
                    <td valign="top" style="padding-top:5px; width:129px; font-size:11px; float:left; letter-spacing: 1px; text-align:left;"><strong> Dear Sir/Madam,</strong></td>
                    </tr>
                <tr>
                    <td valign="top" style="padding-top:10px;padding-bottom:10px; width:650px; font-size:11px; float:left; letter-spacing: 1px; text-align:left;">Thanks for your valued Enquiry in response we have pleasure in submitting our offer for the following items.</td>
                    
                </tr>
            </table>

            </td>
        </tr>
       </table>
    <table border="0" style="width:18cm; border-collapse:collapse; margin:0; padding:0; border-left:1px solid #e41f26;border-right:1px solid #e41f26; border-bottom:1px solid #e41f26;" autosize="0">
                 
                    <tr>
                        <td valign="middle" height="25" style="width: 1cm;border-left: 1px solid #e41f26; font-size:14px; letter-spacing: 1px; text-align:center; font-weight:bold;border-bottom:1px solid #e41f26;background-color:#f7bbbd;">Sr.No</td>
                        <td colspan="2" height="25" valign="middle" style="width: 10cm;border-left: 1px solid #e41f26; font-size:14px; float:left; letter-spacing: 1px; text-align:center; font-weight:bold;border-bottom:1px solid #e41f26;background-color:#f7bbbd;">Item Description</td>
                        <td colspan="2" height="25" valign="middle" style="width: 1cm;border-left: 1px solid #e41f26; font-size:14px; float:left; letter-spacing: 1px; text-align:center; font-weight:bold;border-bottom:1px solid #e41f26;background-color:#f7bbbd;">Qty</td>
                        <td  valign="middle" height="25" style="width:1cm; border-left: 1px solid #e41f26; font-size:14px; float:left; letter-spacing: 1px; text-align:center; font-weight:bold;border-bottom:1px solid #e41f26;background-color:#f7bbbd;">PRICE</td>
                        <td  valign="middle" height="25" style="width: 2cm; border-left: 1px solid #e41f26; font-size:14px; float:left; letter-spacing: 1px; text-align:center; font-weight:bold;border-bottom:1px solid #e41f26;background-color:#f7bbbd;">Total</td>
                        <?php if(isset($inv['sa_isdiscount']) && !empty($inv['sa_isdiscount']) && $inv['sa_isdiscount'] == 1) { ?>
                        <td  valign="middle" height="25" style="width: 1cm; border-left: 1px solid #e41f26; font-size:14px; float:left; letter-spacing: 1px; text-align:center; font-weight:bold;border-bottom:1px solid #e41f26;background-color:#f7bbbd;">Dsc%</td>
                        <?php } ?>
                        <?php if(isset($inv['sa_isdiscount']) && !empty($inv['sa_isdiscount']) && $inv['sa_isdiscount'] == 2) { ?>
                        <td  colspan="2" height="25" valign="middle" style="width: 1cm; border-left: 1px solid #e41f26; border-right: 1px solid #e41f26; font-size:14px; float:left; letter-spacing: 1px; text-align:center; font-weight:bold;border-bottom:1px solid #e41f26;background-color:#f7bbbd;"> Final Total</td>
                         <?php } else { ?>
                        <td valign="middle" height="25" style="width: 2cm;border-left: 1px solid #e41f26; border-right: 1px solid #e41f26; font-size:14px; float:left; letter-spacing: 1px; text-align:center; font-weight:bold;border-bottom:1px solid #e41f26;background-color:#f7bbbd;"> Final Total</td>
                         <?php } ?>
                    </tr>
<?php //************************** top start *********************************
                    $itm_discount = 0;
					$srno = 0; $finaltotal = 0; foreach ($items as $key => $item) { $srno++; ?>
<?php //******************not in use start *********** ?>
                    <tr>
                        <td valign="top" style="border-left: 1px solid #e41f26;border-top:1px solid #e41f26;"></td>
                        <td valign="top" colspan="2" style="border-left: 1px solid #e41f26;border-top:1px solid #e41f26;"></td>
                        <td valign="top" colspan="2" style="border-left: 1px solid #e41f26;border-top:1px solid #e41f26;"></td>
                        <td valign="top" style="border-left: 1px solid #e41f26;border-right: 1px solid #e41f26;border-top:1px solid #e41f26;"></td>
                        <td valign="top" style="border-left: 1px solid #e41f26;border-top:1px solid #e41f26;"></td>
                        <?php if(isset($inv['sa_isdiscount']) && !empty($inv['sa_isdiscount']) && $inv['sa_isdiscount'] == 1) { ?>
                        <td valign="top" style="border-left: 1px solid #e41f26;border-top:1px solid #e41f26;"></td>
                        <?php } ?>
                        <?php if(isset($inv['sa_isdiscount']) && !empty($inv['sa_isdiscount']) && $inv['sa_isdiscount'] == 2) { ?>
                        <td colspan="2" valign="top" style="border-left: 1px solid #e41f26;border-top:1px solid #e41f26;"></td>
                        <?php } else { ?>
                        <td valign="top" style="border-left: 1px solid #e41f26;border-top:1px solid #e41f26; border-right:1px solid #e41f26;"></td>
                        <?php } ?>
                    </tr>
<?php //******************not in use end *********** ?>
                    <tr>
                        <td valign="top" style="border-left: 1px solid #e41f26;font-size:13px; letter-spacing: 1px; text-align:center;"><?php echo $srno; ?></td>
                        <td valign="top" colspan="2" style="border-left: 1px solid #e41f26;font-size:13px; float:left; letter-spacing: 1px; text-align:left;padding-left: 5px;"><?php //echo $item['master_item_name']; ?><?php //echo $item['master_item_part_no']; ?><?php //echo nl2br($item['sai_itm_desc']); ?>
                        <table style="width:18cm;border-collapse:collapse;">
                                <tr>
                                    <td valign="top" style="width:9cm; font-size:13px; float:left; letter-spacing: 1px; text-align:left;"><strong><?php if(isset($item['sai_item_title']) && $item['sai_item_title']!=''){echo wordwrap($item['sai_item_title'], 50, "<br/>\n");} ?></strong><br><strong>Part NO:&nbsp;<?php if(isset($item['sai_itm']) && $item['sai_itm']!=''){echo wordwrap($item['sai_itm'], 50, "<br />\n");} ?></strong><br><?php if(isset($item['sai_itm_desc']) && $item['sai_itm_desc']!=''){echo nl2br($item['sai_itm_desc']);} ?></td>
                                    <td valign="top" style="padding: 2px; width:3cm; float: left;"> <?php if(isset($item['master_item_img']) && !empty($item['master_item_img'])) { ?><img src="<?php echo base_url(); ?>uploads/master_item_img/<?php echo $item['master_item_img'] ?>" width="100" height="70" alt=""/><?php } ?></td>
                                </tr>
                            </table>
                        </td>
                        <td valign="top" colspan="2" style="width:1cm;border-left: 1px solid #e41f26;font-size:13px; float:left; letter-spacing: 1px; text-align:center;"><?php echo $item['sai_itm_qty']; ?></td>
                        <td valign="top" style="width:2cm;border-left: 1px solid #e41f26;font-size:13px; letter-spacing: 1px; text-align:center;"><?php echo number_format($item['sai_itm_price']); ?></td>
                        <td valign="top" style="border-left: 1px solid #e41f26;font-size:13px; float:left; letter-spacing: 1px; text-align:center;"><?php $subttl = $item['sai_itm_qty'] * number_format($item['sai_itm_price'], 2, '.', '');
                         echo $subttl; ?></td>
                         <?php if(isset($inv['sa_isdiscount']) && !empty($inv['sa_isdiscount']) && $inv['sa_isdiscount'] == 1) { ?>
						<td valign="top" style="border-left: 1px solid #e41f26;font-size:13px; float:left; letter-spacing: 1px; text-align:center;"><?php echo number_format($item['sai_itm_discount']); ?></td>
                        <?php } ?>
                        <?php if(isset($inv['sa_isdiscount']) && !empty($inv['sa_isdiscount']) && $inv['sa_isdiscount'] == 2) { ?>
                        <td colspan="2" valign="top" style="border-left: 1px solid #e41f26;border-right: 1px solid #e41f26;font-size:13px; letter-spacing: 1px; text-align:right;"><?php $subtotal =  ($subttl - (($subttl*$item['sai_itm_discount'])/100));
                        echo number_format($subtotal);
                         $finaltotal = $finaltotal + number_format($subtotal, 2, '.', ''); ?></td>
                        <?php $itm_discount = $itm_discount + $item['sai_itm_discount']; ?>
                        <?php } else { ?>
                        <td valign="top" style="border-left: 1px solid #e41f26;border-right: 1px solid #e41f26;font-size:13px; letter-spacing: 1px; text-align:right;"><?php $subtotal =  ($subttl - (($subttl*$item['sai_itm_discount'])/100));
                        echo number_format($subtotal, 2, '.', '');
                         $finaltotal = $finaltotal + number_format($subtotal, 2, '.', ''); ?></td>
                        <?php $itm_discount = $itm_discount + $item['sai_itm_discount']; ?>
                        <?php } ?>                            
                    </tr>
                    <?php /*?><?php foreach($item['taxar'] as $taxd)
					{ ?>
                   
					<?php }?><?php */?>
<?php //******************not in use start *********** ?>
                    <tr>
                        <td style="border-left: 1px solid #e41f26;border-bottom:1px solid #e41f26;"></td>
                        <td colspan="2" style="border-left: 1px solid #e41f26;border-bottom:1px solid #e41f26;"></td>
                        <td colspan="2" style="border-left: 1px solid #e41f26;border-bottom:1px solid #e41f26;"></td>
                        <td style="border-left: 1px solid #e41f26;border-bottom:1px solid #e41f26;"></td>
                        <td style="border-left: 1px solid #e41f26;border-bottom:1px solid #e41f26;"></td>
                        <?php if(isset($inv['sa_isdiscount']) && !empty($inv['sa_isdiscount']) && $inv['sa_isdiscount'] == 1) { ?>
                        <td style="border-left: 1px solid #e41f26;border-bottom:1px solid #e41f26;"></td>
                        <?php } ?>
                        <?php if(isset($inv['sa_isdiscount']) && !empty($inv['sa_isdiscount']) && $inv['sa_isdiscount'] == 2) { ?>
                        <td colspan="2"  style="border-left: 1px solid #e41f26;border-right: 1px solid #e41f26;border-bottom:1px solid #e41f26;"></td>
                        <?php } else { ?>
                        <td style="border-left: 1px solid #e41f26;border-right: 1px solid #e41f26;border-bottom:1px solid #e41f26;"></td>
                        <?php } ?>
                    </tr>
<?php //******************not in use end *********** ?>
                    <?php } //************************** top stop**************  ?>
<?php //***************************************** BOM start ********************** ?>
					
        
                    <?php /*if($srno < 3){
                        for ($i=$srno; $i < 12 ; $i++) {  ?>
                            <tr>
                                <td valign="top" style=" border-left: 1px solid #e41f26; font-size:11px; float:left; letter-spacing: 1px; text-align:center; color:#edf2f8;">1</td>
                                <td colspan="2" valign="top" style=" border-left: 1px solid #e41f26; font-size:11px; float:left; letter-spacing: 1px; text-align:left; color:#edf2f8;">TERMINAL</td>
                                <td colspan="2"  valign="top" style=" border-left: 1px solid #e41f26; font-size:11px; float:left; letter-spacing: 1px; text-align:right; color:#edf2f8;">1.642</td>
                                <td valign="top" style=" border-left: 1px solid #e41f26; font-size:11px; float:left; letter-spacing: 1px; text-align:right; color:#edf2f8;">8.21</td>
                                <td valign="top" style=" border-left: 1px solid #e41f26; font-size:11px; float:left; letter-spacing: 1px; text-align:right; color:#edf2f8;">8.21</td>
                                <td valign="top" style=" border-left: 1px solid #e41f26; font-size:11px; float:left; letter-spacing: 1px; text-align:right; color:#edf2f8;">8.21</td>
                                <td valign="top" style="font-size:11px; float:left; letter-spacing: 1px; text-align:right; color:#edf2f8;border-right: 1px solid #e41f26;">64.500000</td>
                            </tr>  
                       <?php }
                        } */ ?>
                        <?php /*	<!-- <tr>
                            <td valign="top" style="border-bottom: 1px solid #e41f26; border-left: 1px solid #e41f26; font-size:11px; float:left; letter-spacing: 1px; text-align:center; color:#edf2f8;">1</td>
                            <td colspan="2" valign="top" style="border-bottom: 1px solid #e41f26; border-left: 1px solid #e41f26; font-size:11px; float:left; letter-spacing: 1px; text-align:left; color:#edf2f8;">TERMINAL</td>
                            <td colspan="2" valign="top" style="border-bottom: 1px solid #e41f26; border-left: 1px solid #e41f26; font-size:11px; float:left; letter-spacing: 1px; text-align:right; color:#edf2f8;">1.642</td>
                            <td  valign="top" style="border-bottom: 1px solid #e41f26; border-left: 1px solid #e41f26; font-size:11px; float:left; letter-spacing: 1px; text-align:right; color:#edf2f8;">8.21</td>
                            <td  valign="top" style="border-bottom: 1px solid #e41f26; border-left: 1px solid #e41f26; font-size:11px; float:left; letter-spacing: 1px; text-align:right; color:#edf2f8;">8.21</td>
                            <td  valign="top" style="border-bottom: 1px solid #e41f26; border-left: 1px solid #e41f26; font-size:11px; float:left; letter-spacing: 1px; text-align:right; color:#edf2f8;">8.21</td>
                            <td  valign="top" style="border-bottom: 1px solid #e41f26; border-right: 1px solid #e41f26; font-size:11px; float:left; letter-spacing: 1px; text-align:right; color:#edf2f8;">64.500000</td>
                        </tr> -->
                        */ ?>
                   
                   <tr>
                        <td colspan="5" height="25" style="border-bottom: 1px solid #e41f26;border-top:1px solid #e41f26;border-right:1px solid #e41f26;border-left:1px solid #e41f26;font-family: 'Arial Black', Gadget, sans-serif;font-size:14px; text-align:left;"><?php //echo $inv['sa_grd_ttl_words'] ?></td>
                        <td colspan="2" height="25" style="border-top:1px solid #e41f26;border-right:1px solid #e41f26;border-left:1px solid #e41f26;border-bottom:1px solid #e41f26;font-family: 'Arial Black', Gadget, sans-serif;font-size:14px; text-align:right;background-color:#fad1d3;"><strong>GRAND TOTAL:</strong></td>
                        <td colspan="2" height="25" style="border-top:1px solid #e41f26;border-right:1px solid #e41f26;border-left:1px solid #e41f26;border-bottom:1px solid #e41f26;font-family: 'Arial Black', Gadget, sans-serif;font-size:14px; text-align:right;background-color:#fad1d3;"><strong><?php echo number_format($finaltotal, 2, '.', ''); ?></strong></td>
                        <?php /*?><td style="border-right:1px solid #e41f26;border-left:1px solid #e41f26;border-bottom:1px solid #e41f26;"></td><?php */?>
                    </tr>
                    <?php if(isset($inv['sa_isdiscount']) && !empty($inv['sa_isdiscount']) && $inv['sa_isdiscount'] == 1) { ?>
                    <!-- <tr>
                        <?php $totaldisc = (($itm_discount * $finaltotal)/100); ?>
                        <td colspan="5" height="25" style="border-right:1px solid #e41f26;border-left:1px solid #e41f26;font-family: 'Arial Black', Gadget, sans-serif;font-size:14px; text-align:left;"><?php //echo $inv['sa_grd_ttl_words'] ?></td>
                        <td colspan="2" height="25" style="border-right:1px solid #e41f26;border-left:1px solid #e41f26;border-bottom:1px solid #e41f26;font-family: 'Arial Black', Gadget, sans-serif;font-size:14px; text-align:right;background-color:#fad1d3;"><strong>TOTAL Discount</strong></td>
                        <td colspan="2" height="25" style="border-right:1px solid #e41f26;border-left:1px solid #e41f26;border-bottom:1px solid #e41f26;font-family: 'Arial Black', Gadget, sans-serif;font-size:14px; text-align:right;background-color:#fad1d3;"><strong><?php echo number_format($totaldisc); ?></strong></td>
                        <?php /*?><td style="border-right:1px solid #e41f26;border-left:1px solid #e41f26;border-bottom:1px solid #e41f26;"></td><?php */?>
                    </tr> -->
                    <?php  $disc = $finaltotal - (($itm_discount * $finaltotal)/100); } else { $disc = $finaltotal; } ?>
                    <?php /* <!-- <tr>
                        <?php// $disc = $finaltotal - (($itm_discount * $finaltotal)/100); ?>
                        <td colspan="5" height="25" style="border-right:1px solid #e41f26;border-left:1px solid #e41f26;border-bottom:1px solid #e41f26;font-family: 'Arial Black', Gadget, sans-serif;font-size:14px; text-align:left;"><?php //echo $inv['sa_grd_ttl_words'] ?></td>
                        <td colspan="2" height="25" style="border-right:1px solid #e41f26;border-left:1px solid #e41f26;border-bottom:1px solid #e41f26;font-family: 'Arial Black', Gadget, sans-serif;font-size:14px; text-align:right;background-color:#fad1d3;"><strong>TOTAL</strong></td>
                        <td colspan="2" height="25" style="border-right:1px solid #e41f26;border-left:1px solid #e41f26;border-bottom:1px solid #e41f26;font-family: 'Arial Black', Gadget, sans-serif;font-size:14px; text-align:right;background-color:#fad1d3;"><strong><?php echo number_format($disc); ?></strong></td>
                        <?php /*?><td style="border-right:1px solid #e41f26;border-left:1px solid #e41f26;border-bottom:1px solid #e41f26;"></td><?php */?><?php /*
                    </tr> -->
                    
                    <!-- <tr>
                        <td colspan="7" style="text-align:top; font-size:14px;font-family:'Tahoma'; border-left:1px solid #e41f26;padding-top: 6px; padding-right: 1%; padding-left: 1%; ">
                            
                        </td>
                        <td colspan="2" style="height:15px;border-right:1px solid #e41f26;"></td>
                    </tr>
                    <tr>
                        <td valign="top" colspan="7" rowspan="<?php echo $rowspan; ?>" style="border-left:1px solid #e41f26;text-align:top; font-size:14px;font-family: 'Arial Black', Gadget, sans-serif; padding-right: 1%; padding-left: 1%;border-bottom:1px solid #e41f26; ">
                            
                        </td>
                        <td colspan="2" style="height:15px;border-bottom:1px solid #e41f26;border-right:1px solid #e41f26;"></td>
                   
                    </tr> --> */ ?>
        </table>
    	<?php /* <!-- <table style="width:100%;border-collapse:collapse; margin:0; padding:0;">
        
                    <tr>
                        <td valign="top" style="text-align:left; border-left:1px solid #e41f26;border-bottom:1px solid #e41f26;border-right:1px solid #e41f26; font-size:11.5px;font-family: 'Tahoma'; height: 30px; width: 100%; padding-right: 1%; padding-left: 1%; padding-top: 1%; padding-bottom: 1%; ">
                            
                        </td>
                        
                    </tr>
        </table> -->
        <!-- table style="width:100%;border-collapse:collapse; margin:0; padding:0;">
                    <tr>
                        
                        <td valign="top" style="border-left:1px solid #e41f26;border-bottom:1px solid #e41f26; border-right: 1px solid #e41f26;font-size:12.5px;font-family: 'Tahoma';  width: 100%; padding-right: 1%;  padding-top: 1%; padding-left: 1%; padding-bottom: 1%; text-align:LEFT;">
                                <strong>Feel Free to Contact Us On wecon2@miconindia.com For Any Query.
                                    Ankit Doshi - 9723462390 MICON AUTOMATION SYSTEMS PVT. LTD.</strong><br/><br/>
                                    <strong>Inquiry By : <?php echo isset($inv['au_fname']) ? $inv['au_fname'] : '' ; ?></strong><br/><br/>
                               <strong>FOR MICON AUTOMATION SYSTEMS PVT.LTD.</strong><br/>
                            <strong>Auth. Signatory</strong>
                        </td>
                    </tr>
                    
        </table> --> */ ?>
        <table style="width:100%;border-collapse:collapse; margin:0; padding:0;">
        
                    <tr>
                        <td valign="top" style="text-align:left; border-left:1px solid #e9494f;border-bottom:1px solid #e9494f; font-size:12px;font-family: 'Tahoma'; height: 25px; width: 65%; padding-right: 1%; padding-left: 1%; padding-top: 1%; padding-bottom: 1%; ">
                            <?php /*<!-- <strong style="text-transform: uppercase;">Terms & Conditions:</strong><br>
                            <span style="font-size: 11px;"><strong>PRICES:&nbsp;</strong><?php echo nl2br($inv['sa_tc_price']); ?></span><br>
                            <span style="font-size: 11px;"><strong>WARRANTY:&nbsp;</strong><?php echo nl2br($inv['sa_tc_wrnty']); ?></span><br>
                            <span style="font-size: 11px;"><strong>P&F:&nbsp;</strong><?php echo nl2br($inv['sa_tc_pf']); ?></span><br>
                            <span style="font-size: 11px;"><strong>DELIVERY:&nbsp;</strong><?php echo nl2br($inv['sa_tc_deli']); ?></span><br>
                            <span style="font-size: 11px;"><strong>PAYMET:&nbsp;</strong><?php echo nl2br($inv['sa_tc_paynt']); ?></span><br>
                            <span style="font-size: 11px;"><strong>OFFER VALIDITY:&nbsp;</strong><?php echo nl2br($inv['sa_tc_ovali']); ?></span><br>
                            <span style="font-size: 11px;"><strong>FREIGHT:&nbsp;</strong><?php echo nl2br($inv['sa_tc_frght']); ?></span><br> -->
                            <!-- <span style="font-size: 11px;"><strong>PRICES</strong><?php echo nl2br($inv['sa_tc_gst']); ?></span><br> --> */ ?>
                            
                    <div style="width:100%; margin-top:0;">
                    <?php /*<!-- <div style="width:100%; font-size:11px; float:left; letter-spacing: 1px;"> <span style="font-weight:bold;">Invoice No</span> : PI NV111310 </div> --> */ ?>
                    <table style="width:100%;border-collapse:collapse;">
                        <tr><strong style="text-transform: uppercase;">Terms & Conditions:</strong></tr>
                        <tr>
                            <td valign="top" style=" width:5px; font-size:10px; float:left; letter-spacing: 1px; text-align:left;"><strong>PRICES</strong><span style="text-align:right !important;"></span></td>
                            <td valign="top" style=" width:10px; font-size:10px; float:left; letter-spacing: 1px; text-align:center;">:</td>
                            <td valign="top" style=" width:300px; font-size:10px; float:left; letter-spacing: 1px; text-align:left;"><?php echo nl2br($inv['sa_tc_price']); ?></td>
                        </tr>
                        <tr>
                            <td valign="top" style="width:5px; font-size:10px; float:left; letter-spacing: 1px; text-align:left; padding-top:5px;"><strong>WARRANTY</strong><span style="text-align:right !important;"></span></td>
                            <td valign="top" style="padding-top:5px; width:10px; font-size:10px; float:left; letter-spacing: 1px; text-align:center;">:</td>
                            <td valign="top" style="padding-top:5px; width:300px; font-size:10px; float:left; letter-spacing: 1px; text-align:left;"><?php echo nl2br($inv['sa_tc_wrnty']); ?></td>
                        </tr>
                        <tr>
                            <td valign="top" style="width:5px; font-size:10px; float:left; letter-spacing: 1px; text-align:left; padding-top:5px;"><strong>P&F</strong><span style="text-align:right !important;"></span></td>
                            <td valign="top" style="padding-top:5px; width:10px; font-size:10px; float:left; letter-spacing: 1px; text-align:center;">:</td>
                            <td valign="top" style="padding-top:5px; width:300px; font-size:10px; float:left; letter-spacing: 1px; text-align:left;"><?php echo nl2br($inv['sa_tc_pf']); ?></td>
                        </tr>
                        <tr>
                            <td valign="top" style="width:5px; font-size:10px; float:left; letter-spacing: 1px; text-align:left; padding-top:5px;"><strong>DELIVERY</strong><span style="text-align:right !important;"></span></td>
                            <td valign="top" style="padding-top:5px; width:10px; font-size:10px; float:left; letter-spacing: 1px; text-align:center;">:</td>
                            <td valign="top" style="padding-top:5px; width:300px; font-size:10px; float:left; letter-spacing: 1px; text-align:left;"><?php echo nl2br($inv['sa_tc_deli']); ?></td>
                        </tr>
                        <tr>
                            <td valign="top" style="width:5px; font-size:10px; float:left; letter-spacing: 1px; text-align:left; padding-top:5px;"><strong>PAYMET</strong><span style="text-align:right !important;"></span></td>
                            <td valign="top" style="padding-top:5px; width:10px; font-size:10px; float:left; letter-spacing: 1px; text-align:center;">:</td>
                            <td valign="top" style="padding-top:5px; width:300px; font-size:10px; float:left; letter-spacing: 1px; text-align:left;"><?php echo nl2br($inv['sa_tc_paynt']); ?></td>
                        </tr>
                        <tr>
                            <td valign="top" style="width:5px; font-size:10px; float:left; letter-spacing: 1px; text-align:left; padding-top:5px;"><strong>OFFER VALIDITY</strong><span style="text-align:right !important;"></span></td>
                            <td valign="top" style="padding-top:5px; width:10px; font-size:10px; float:left; letter-spacing: 1px; text-align:center;">:</td>
                            <td valign="top" style="padding-top:5px; width:300px; font-size:10px; float:left; letter-spacing: 1px; text-align:left;"><?php echo nl2br($inv['sa_tc_ovali']); ?></td>
                        </tr>
                        <tr>
                            <td valign="top" style="width:5px; font-size:10px; float:left; letter-spacing: 1px; text-align:left; padding-top:5px;"><strong>FREIGHT</strong><span style="text-align:right !important;"></span></td>
                            <td valign="top" style="padding-top:5px; width:10px; font-size:10px; float:left; letter-spacing: 1px; text-align:center;">:</td>
                            <td valign="top" style="padding-top:5px; width:300px; font-size:10px; float:left; letter-spacing: 1px; text-align:left;"><?php echo nl2br($inv['sa_tc_frght']); ?></td>
                        </tr>
                        <tr>
                            <td valign="top" style="width:5px; font-size:10px; float:left; letter-spacing: 1px; text-align:left; padding-top:5px;"><strong>GST</strong><span style="text-align:right !important;"></span></td>
                            <td valign="top" style="padding-top:5px; width:10px; font-size:10px; float:left; letter-spacing: 1px; text-align:center;">:</td>
                            <td valign="top" style="padding-top:5px; width:300px; font-size:10px; float:left; letter-spacing: 1px; text-align:left;"><?php echo nl2br($inv['sa_tc_gst']); ?></td>
                        </tr>
                         
                        </table>
                </div>

                        </td>
                        <td valign="top" style="border-left:1px solid #e9494f;border-bottom:1px solid #e9494f; border-right: 1px solid #e9494f;font-size:12px;font-family: 'Tahoma'; height: 70px; width: 33.2%;padding-left: 1%; padding-right: 1%;  padding-top: 1%; padding-bottom: 1%; text-align:LEFT;">
                            <div style="text-transform: uppercase;">GST TIN : 24AAECM7879C1ZB</div><br><br><br><br>
                            <strong>For Any Query.</strong>
                            <div  style="">Feel Free to Contact Us On:<!-- <span style="color: #3333ff;"><strong><?php echo $inv['au_email']; ?>. --></strong></span></div>
                            <div  style="color:#e41f26;font-size:13px;"><strong><?php echo $inv['au_fname']; ?> <?php echo $inv['au_lname']; ?></strong></div>
                            <div style="color:#e41f26;font-size:13px;">M : <?php echo $inv['au_mo_no']; ?></div>
                            <div style="color:#e41f26;font-size:13px;">Email : <?php echo $inv['au_gmail_email']; ?></div>
                            <div style="color:#e41f26;font-size:13px;">Office No : 9723462390</div>
                        </td>
                    </tr>
        </table>
        <table style="width:100%;border-collapse:collapse; margin:0; padding:0;">
                    
                    <tr>
                        <td valign="top" style="padding-top:5px;text-align:left; font-size:9.5px;font-family: 'Tahoma'; width: 98%; padding-right: 1%; padding-left: 1%; text-align:center; ">
                        <p>THIS IS A COMPUTER GENERATED DOCUMENT AND DOES NOT REQUIRE A SIGNATURE.</p>
                        </td>
                    </tr>
        </table>
</div>
</body>
</html>