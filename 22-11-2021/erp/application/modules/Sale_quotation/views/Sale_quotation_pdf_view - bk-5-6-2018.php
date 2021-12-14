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
                            <td valign="top" style="padding-top:5px; width:200px; font-size:11px; float:left; letter-spacing: 1px; text-align:left;"><?php echo isset($inv['city_name']) ? nl2br($inv['city_name']) : '' ; ?></td>
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
                            <td valign="top" style="width:35px; font-size:11px; float:left; letter-spacing: 1px; text-align:left; padding-top:5px;"><strong>Kind attn</strong><span style="text-align:right !important;"></span></td>
                            <td valign="top" style="padding-top:5px; width:10px; font-size:11px; float:left; letter-spacing: 1px; text-align:center;">:</td>
                            <td valign="top" style="padding-top:5px; width:560px; font-size:11px; float:left; letter-spacing: 1px; text-align:left;"><?php if(isset($inv['sa_cont_per']) && $inv['sa_cont_per']!=''){echo $inv['sa_cont_per'];}else{echo '';} ?></td>
                    </tr>
                    <tr>
                            <td valign="top" style="width:35px; font-size:11px; float:left; letter-spacing: 1px; text-align:left; padding-top:5px;"><strong> Sub</strong><span style="text-align:right !important;"></span></td>
                            <td valign="top" style="padding-top:5px; width:10px; font-size:11px; float:left; letter-spacing: 1px; text-align:center;">:</td>
                            <td valign="top" style="padding-top:5px; width:560px; font-size:11px; float:left; letter-spacing: 1px; text-align:left;"><?php if(isset($inv['sale_quotation_sub']) && $inv['sale_quotation_sub']!=''){echo $inv['sale_quotation_sub'];}else{echo '';} ?></td>
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
    <table border="0" style="width:100%; border-collapse:collapse; margin:0; padding:0; background-color:#fce8e9;border-left:1px solid #e41f26;border-right:1px solid #e41f26; border-bottom:1px solid #e41f26;" autosize="0">
                 
                    <tr>
                        <td valign="middle" height="25" style="border-left: 1px solid #e41f26; font-size:11px; letter-spacing: 1px; text-align:center; font-weight:bold;background-color:#f7bbbd;border-bottom:1px solid #e41f26;">Sr.No</td>
                        <td colspan="2" height="25" valign="middle" style="border-left: 1px solid #e41f26; font-size:11px; float:left; letter-spacing: 1px; text-align:center; font-weight:bold;background-color:#f7bbbd;border-bottom:1px solid #e41f26;">Item Description</td>
                        <td colspan="2" height="25" valign="middle" style="border-left: 1px solid #e41f26; font-size:11px; float:left; letter-spacing: 1px; text-align:center; font-weight:bold;border-bottom:1px solid #e41f26;background-color:#f7bbbd;">Qty</td>
                        <td  valign="middle" height="25" style="border-left: 1px solid #e41f26; font-size:11px; float:left; letter-spacing: 1px; text-align:center; font-weight:bold;background-color:#f7bbbd;border-bottom:1px solid #e41f26;">PRICE</td>
                        <td  valign="middle" height="25" style="border-left: 1px solid #e41f26; font-size:11px; float:left; letter-spacing: 1px; text-align:center; font-weight:bold;background-color:#f7bbbd;border-bottom:1px solid #e41f26;">Total</td>
                        <?php if(isset($inv['sa_isdiscount']) && !empty($inv['sa_isdiscount']) && $inv['sa_isdiscount'] == 1) { ?>
                        <td  valign="middle" height="25" style="border-left: 1px solid #e41f26; font-size:11px; float:left; letter-spacing: 1px; text-align:center; font-weight:bold;background-color:#f7bbbd;border-bottom:1px solid #e41f26;">Dsc%</td>
                        <?php } ?>
                        <?php if(isset($inv['sa_isdiscount']) && !empty($inv['sa_isdiscount']) && $inv['sa_isdiscount'] == 2) { ?>
                        <td  colspan="2" height="25" valign="middle" style="border-left: 1px solid #e41f26; border-right: 1px solid #e41f26; font-size:11px; float:left; letter-spacing: 1px; text-align:center; font-weight:bold;background-color:#f7bbbd;border-bottom:1px solid #e41f26;"> Final Total</td>
                         <?php } else { ?>
                         <td valign="middle" height="25" style="border-left: 1px solid #e41f26; border-right: 1px solid #e41f26; font-size:11px; float:left; letter-spacing: 1px; text-align:center; font-weight:bold;background-color:#f7bbbd;border-bottom:1px solid #e41f26;"> Final Total</td>
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
                        <td valign="top" style="border-left: 1px solid #e41f26;border-top:1px solid #e41f26;"></td>
                        <?php } ?>
                    </tr>
<?php //******************not in use end *********** ?>
                    <tr>
                        <td valign="top" style="border-left: 1px solid #e41f26;font-size:11px; letter-spacing: 1px; text-align:center;"><?php echo $srno; ?></td>
                        <td valign="top" colspan="2" style="border-left: 1px solid #e41f26;font-size:11px; float:left; letter-spacing: 1px; text-align:left;"><strong><?php echo $item['master_item_name']; ?><?php echo $item['master_item_part_no']; ?></strong><br/><?php echo nl2br($item['sai_itm_desc']); ?></td>
                        <td valign="top" colspan="2" style="border-left: 1px solid #e41f26;font-size:11px; float:left; letter-spacing: 1px; text-align:center;"><?php echo $item['sai_itm_qty']; ?></td>
                        <td valign="top" style="border-left: 1px solid #e41f26;font-size:11px; letter-spacing: 1px; text-align:center;"><?php echo number_format($item['sai_itm_price'], 2, '.', ''); ?></td>
                        <td valign="top" style="border-left: 1px solid #e41f26;font-size:11px; float:left; letter-spacing: 1px; text-align:center;"><?php $subttl = $item['sai_itm_qty'] * number_format($item['sai_itm_price'], 2, '.', '');
                         echo $subttl; ?></td>
                         <?php if(isset($inv['sa_isdiscount']) && !empty($inv['sa_isdiscount']) && $inv['sa_isdiscount'] == 1) { ?>
						<td valign="top" style="border-left: 1px solid #e41f26;font-size:11px; float:left; letter-spacing: 1px; text-align:center;"><?php echo number_format($item['sai_itm_discount'], 2, '.', ''); ?></td>
                        <?php } ?>
                        <?php if(isset($inv['sa_isdiscount']) && !empty($inv['sa_isdiscount']) && $inv['sa_isdiscount'] == 2) { ?>
                        <td colspan="2" valign="top" style="border-left: 1px solid #e41f26;border-right: 1px solid #e41f26;font-size:11px; letter-spacing: 1px; text-align:right;"><?php $subtotal =  ($subttl - (($subttl*$item['sai_itm_discount'])/100));
                        echo number_format($subtotal, 2, '.', '');
                         $finaltotal = $finaltotal + number_format($subtotal, 2, '.', ''); ?></td>
                        <?php $itm_discount = $itm_discount + $item['sai_itm_discount']; ?>
                        <?php } else { ?>
                        <td valign="top" style="border-left: 1px solid #e41f26;border-right: 1px solid #e41f26;font-size:11px; letter-spacing: 1px; text-align:right;"><?php $subtotal =  ($subttl - (($subttl*$item['sai_itm_discount'])/100));
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
					
        
                    <?php if($srno < 6){
                        for ($i=$srno; $i < 6 ; $i++) {  ?>
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
                        } ?>
                        	<tr>
                            <td valign="top" style="border-bottom: 1px solid #e41f26; border-left: 1px solid #e41f26; font-size:11px; float:left; letter-spacing: 1px; text-align:center; color:#edf2f8;">1</td>
                            <td colspan="2" valign="top" style="border-bottom: 1px solid #e41f26; border-left: 1px solid #e41f26; font-size:11px; float:left; letter-spacing: 1px; text-align:left; color:#edf2f8;">TERMINAL</td>
                            <td colspan="2" valign="top" style="border-bottom: 1px solid #e41f26; border-left: 1px solid #e41f26; font-size:11px; float:left; letter-spacing: 1px; text-align:right; color:#edf2f8;">1.642</td>
                            <td  valign="top" style="border-bottom: 1px solid #e41f26; border-left: 1px solid #e41f26; font-size:11px; float:left; letter-spacing: 1px; text-align:right; color:#edf2f8;">8.21</td>
                            <td  valign="top" style="border-bottom: 1px solid #e41f26; border-left: 1px solid #e41f26; font-size:11px; float:left; letter-spacing: 1px; text-align:right; color:#edf2f8;">8.21</td>
                            <td  valign="top" style="border-bottom: 1px solid #e41f26; border-left: 1px solid #e41f26; font-size:11px; float:left; letter-spacing: 1px; text-align:right; color:#edf2f8;">8.21</td>
                            <td  valign="top" style="border-bottom: 1px solid #e41f26; border-right: 1px solid #e41f26; font-size:11px; float:left; letter-spacing: 1px; text-align:right; color:#edf2f8;">64.500000</td>
                        </tr>
                   
                   <tr>
                        <td colspan="5" style="border-right:1px solid #e41f26;border-left:1px solid #e41f26;font-family: 'Arial Black', Gadget, sans-serif;font-size:14px; text-align:left;"><?php //echo $inv['sa_grd_ttl_words'] ?></td>
                        <td colspan="2" style="border-right:1px solid #e41f26;border-left:1px solid #e41f26;border-bottom:1px solid #e41f26;font-family: 'Arial Black', Gadget, sans-serif;font-size:14px; text-align:right;"><strong>SUBTOTAL</strong></td>
                        <td colspan="2" style="border-right:1px solid #e41f26;border-left:1px solid #e41f26;border-bottom:1px solid #e41f26;font-family: 'Arial Black', Gadget, sans-serif;font-size:14px; text-align:right;"><strong><?php echo number_format($finaltotal, 2, '.', ''); ?></strong></td>
                        <?php /*?><td style="border-right:1px solid #e41f26;border-left:1px solid #e41f26;border-bottom:1px solid #e41f26;"></td><?php */?>
                    </tr>
                    <?php if(isset($inv['sa_isdiscount']) && !empty($inv['sa_isdiscount']) && $inv['sa_isdiscount'] == 1) { ?>
                    <tr>
                        <?php $totaldisc = (($itm_discount * $finaltotal)/100); ?>
                        <td colspan="5" style="border-right:1px solid #e41f26;border-left:1px solid #e41f26;font-family: 'Arial Black', Gadget, sans-serif;font-size:14px; text-align:left;"><?php //echo $inv['sa_grd_ttl_words'] ?></td>
                        <td colspan="2" style="border-right:1px solid #e41f26;border-left:1px solid #e41f26;border-bottom:1px solid #e41f26;font-family: 'Arial Black', Gadget, sans-serif;font-size:14px; text-align:right;"><strong>TOTAL Discount</strong></td>
                        <td colspan="2" style="border-right:1px solid #e41f26;border-left:1px solid #e41f26;border-bottom:1px solid #e41f26;font-family: 'Arial Black', Gadget, sans-serif;font-size:14px; text-align:right;"><strong><?php echo number_format($totaldisc, 2, '.', ''); ?></strong></td>
                        <?php /*?><td style="border-right:1px solid #e41f26;border-left:1px solid #e41f26;border-bottom:1px solid #e41f26;"></td><?php */?>
                    </tr>
                    <?php  $disc = $finaltotal - (($itm_discount * $finaltotal)/100); } else { $disc = $finaltotal; } ?>
                     <tr>
                        <?php// $disc = $finaltotal - (($itm_discount * $finaltotal)/100); ?>
                        <td colspan="5" style="border-right:1px solid #e41f26;border-left:1px solid #e41f26;border-bottom:1px solid #e41f26;font-family: 'Arial Black', Gadget, sans-serif;font-size:14px; text-align:left;"><?php //echo $inv['sa_grd_ttl_words'] ?></td>
                        <td colspan="2" style="border-right:1px solid #e41f26;border-left:1px solid #e41f26;border-bottom:1px solid #e41f26;font-family: 'Arial Black', Gadget, sans-serif;font-size:14px; text-align:right;"><strong>TOTAL</strong></td>
                        <td colspan="2" style="border-right:1px solid #e41f26;border-left:1px solid #e41f26;border-bottom:1px solid #e41f26;font-family: 'Arial Black', Gadget, sans-serif;font-size:14px; text-align:right;"><strong><?php echo number_format($disc, 2, '.', ''); ?></strong></td>
                        <?php /*?><td style="border-right:1px solid #e41f26;border-left:1px solid #e41f26;border-bottom:1px solid #e41f26;"></td><?php */?>
                    </tr>
                    
                    <tr>
                        <td colspan="5" style="text-align:top; font-size:11px;font-family:'Tahoma'; padding-top: 6px; padding-right: 1%; padding-left: 1%; ">
                            <strong style="text-transform: uppercase;">Terms & Conditions:</strong>
                        </td>
                        <td colspan="4" style="height:15px;"></td>
                    </tr>
                    <tr>
                        <td valign="top" colspan="5" rowspan="<?php echo $rowspan; ?>" style="text-align:top; font-size:11.8px;font-family: 'Arial Black', Gadget, sans-serif; padding-right: 1%; padding-left: 1%;border-bottom:1px solid #e41f26; ">
                            <?php echo nl2br($inv['sale_quotation_term']); ?>
                        </td>
                        <td colspan="4" style="height:15px;border-bottom:1px solid #e41f26;"></td>
                   
                    </tr>
        </table>
    	<table style="width:100%;border-collapse:collapse; margin:0; padding:0;">
        
                    <tr>
                        <td valign="top" style="text-align:left; border-left:1px solid #e41f26;border-bottom:1px solid #e41f26;border-right:1px solid #e41f26; font-size:12.5px;font-family: 'Tahoma'; height: 30px; width: 100%; padding-right: 1%; padding-left: 1%; padding-top: 1%; padding-bottom: 1%; ">
                            <strong style="text-transform: uppercase;">GST TIN : 24AAECM7879C1ZB</strong>
                        </td>
                        
                    </tr>
        </table>
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
                    
        </table> -->
        <table style="width:100%;border-collapse:collapse; margin:0; padding:0;">
        
                    <tr>
                        <td valign="top" style="text-align:left; border-left:1px solid #e9494f;border-bottom:1px solid #e9494f; font-size:11px;font-family: 'Tahoma'; height: 25px; width: 46.2%; padding-right: 1%; padding-left: 1%; padding-top: 1%; padding-bottom: 1%; ">
                            <strong style="color:#e41f26;">For Any Query.</strong>
                            <div  style="">Feel Free to Contact Us On <?php echo $inv['au_email']; ?>.</div>
                            <div  style=""><?php echo $inv['au_fname']; ?> <?php echo $inv['au_lname']; ?></div>
                            <div  style="">M : <?php echo $inv['au_mo_no']; ?></div>
                            <div  style="">Email : <?php echo $inv['au_email']; ?></div>
                            <div style="">Office No : 9723430290</div>
                        </td>
                        <td valign="top" style="border-left:1px solid #e9494f;border-bottom:1px solid #e9494f; border-right: 1px solid #e9494f;font-size:13.5px;font-family: 'Tahoma'; height: 70px; width: 45%; padding-right: 1%;  padding-top: 1%; padding-bottom: 1%; text-align:LEFT;">
                               <strong>FOR MICON AUTOMATION SYSTEMS PVT.LTD.</strong><br/><br/><br/>
                            <strong>Auth. Signatory</strong>
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