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
            <td colspan="2" style="width:98%; color:#e9494f; padding-top: 10px; padding-bottom:0.3cm; text-align:center;font-size:17px; text-transform: uppercase; font-weight:bold; letter-spacing: 2px;">Order Acceptance</td>
        </tr>
        <tr>
            <td valign="top" style="width:7cm;border-top:1px solid #e41f26; border-left:1px solid #e41f26;border-bottom:1px solid #e41f26; padding-top:0.2cm; padding-bottom:0.2cm; padding-left:0.1cm; padding-right:0.1cm;">
                <div style="width:98%; margin-top:0;">
                    <!-- <div style="width:100%; font-size:11px; float:left; letter-spacing: 1px;"> <span style="font-weight:bold;">Invoice No</span> : PI NV111310 </div> -->
                    <table style="width:100%;border-collapse:collapse;">
                        <tr>
                            <td valign="top" style=" width:70px; font-size:12px; float:left; letter-spacing: 1px; text-align:left;"><strong>M/s.</strong><span style="text-align:right !important;"></span></td>
                            <td valign="top" style=" width:10px; font-size:12px; float:left; letter-spacing: 1px; text-align:center;">:</td>
                            <td valign="top" style=" width:200px; font-size:12px; float:left; letter-spacing: 1px; text-align:left;"><?php echo $inv['vendor']; ?></td>
                        </tr>
                        <tr>
                            <td valign="top" style="width:70px; font-size:12px; float:left; letter-spacing: 1px; text-align:left; padding-top:5px;"><strong>Address</strong><span style="text-align:right !important;"></span></td>
                            <td valign="top" style="padding-top:5px; width:10px; font-size:12px; float:left; letter-spacing: 1px; text-align:center;">:</td>
                            <td valign="top" style="padding-top:5px; width:200px; font-size:12px; float:left; letter-spacing: 1px; text-align:left;"><?php //echo nl2br($inv['oa_address']); ?><?php echo isset($inv['oa_address']) ? nl2br($inv['oa_address']) : '' ; ?></td>
                        </tr>
                         <tr>
                            <td valign="top" style="width:70px; font-size:12px; float:left; letter-spacing: 1px; text-align:left; padding-top:5px;"><strong>City</strong><span style="text-align:right !important;"></span></td>
                            <td valign="top" style="padding-top:5px; width:10px; font-size:12px; float:left; letter-spacing: 1px; text-align:center;">:</td>
                            <td valign="top" style="padding-top:5px; width:200px; font-size:12px; float:left; letter-spacing: 1px; text-align:left;"><?php //echo nl2br($inv['oa_address']); ?><?php echo isset($inv['city_name']) ? nl2br($inv['city_name']) : '' ; ?></td>
                        </tr>
                         <tr>
                            <td valign="top" style="width:70px; font-size:12px; float:left; letter-spacing: 1px; text-align:left; padding-top:5px;"><strong>State</strong><span style="text-align:right !important;"></span></td>
                            <td valign="top" style="padding-top:5px; width:10px; font-size:12px; float:left; letter-spacing: 1px; text-align:center;">:</td>
                            <td valign="top" style="padding-top:5px; width:200px; font-size:12px; float:left; letter-spacing: 1px; text-align:left;"><?php //echo nl2br($inv['oa_address']); ?><?php echo isset($inv['state_name']) ? nl2br($inv['state_name']) : '' ; ?></td>
                        </tr>
                        <tr>
                            <td valign="top" style="width:70px; font-size:12px; float:left; letter-spacing: 1px; text-align:left; padding-top:5px;"><strong>Phone</strong><span style="text-align:right !important;"></span></td>
                            <td valign="top" style="padding-top:5px; width:10px; font-size:12px; float:left; letter-spacing: 1px; text-align:center;">:</td>
                            <td valign="top" style="padding-top:5px; width:200px; font-size:12px; float:left; letter-spacing: 1px; text-align:left;"><?php echo $inv['oa_mobile']; ?></td>
                        </tr>
                        <tr>
                            <td valign="top" style="width:70px; font-size:12px; float:left; letter-spacing: 1px; text-align:left; padding-top:5px;"><strong>Email</strong><span style="text-align:right !important;"></span></td>
                            <td valign="top" style="padding-top:5px; width:10px; font-size:12px; float:left; letter-spacing: 1px; text-align:center;">:</td>
                            <td valign="top" style="padding-top:5px; width:200px; font-size:12px; float:left; letter-spacing: 1px; text-align:left;"><?php echo nl2br($inv['oa_email']); ?></td>
                        </tr>
                         
                        </table>
                </div>
            </td>
	   <!-- <div style="width:100%;">CH A    :</div></td> -->
            <td valign="top" style="width:5cm;border-top:1px solid #e9494f; border-left:1px solid #e9494f;border-bottom:1px solid #e9494f;border-right:1px solid #e9494f; padding-top:0.2cm; padding-bottom:0.2cm; padding-left:0.1cm; padding-right:0.1cm;">
                <div style="width:100%; margin-top:0;">
                    <!-- <div style="width:100%; font-size:12px; float:left; letter-spacing: 2px;"> <span style="font-weight:bold;">Invoice No</span> : PI NV111310 </div> -->
                    <table style="width:100%;border-collapse:collapse;">
                        <tr>
                            <td valign="top" style=" width:90px; font-size:12px; float:left; letter-spacing: 1px; text-align:left;"><strong>PO No.</strong><span style="text-align:right !important;"></span></td>
                            <td valign="top" style=" width:10px; font-size:12px; float:left; letter-spacing: 1px; text-align:center;">:</td>
                            <td valign="top" style=" width:200px; font-size:12px; float:left; letter-spacing: 1px; text-align:left;"><?php echo $inv['oa_no'] ?></td>
                        </tr>
                        <tr>
                            <td valign="top" style="width:90px; font-size:12px; float:left; letter-spacing: 1px; text-align:left; padding-top:5px;"><strong>Date</strong><span style="text-align:right !important;"></span></td>
                            <td valign="top" style="padding-top:5px; width:10px; font-size:12px; float:left; letter-spacing: 1px; text-align:center;">:</td>
                            <td valign="top" style="padding-top:5px; width:200px; font-size:12px; float:left; letter-spacing: 1px; text-align:left;"><?php echo date("d-m-Y", strtotime($inv['oa_enq_date'])); ?></td>
                        </tr>
                        </table>
                </div>
            </td>
        </tr>
          <tr>
            <td valign="top" colspan="2" style="width:6cm; border-left:1px solid #e41f26; border-right:1px solid #e41f26; border-bottom:1px solid #e41f26; padding-top:0.2cm; padding-bottom:0.2cm; padding-left:0.1cm; padding-right:0.1cm;">
                <table style="width:100%;border-collapse:collapse;">
                    <tr>
                            <td valign="top" style="width:60px; font-size:12px; float:left; letter-spacing: 1px; text-align:left; padding-top:5px;"><strong>Kind attn</strong><span style="text-align:right !important;"></span></td>
                            <td valign="top" style="padding-top:5px; width:10px; font-size:12px; float:left; letter-spacing: 1px; text-align:center;">:</td>
                            <td valign="top" style="padding-top:5px; width:540px; font-size:12px; float:left; letter-spacing: 1px; text-align:left;"><?php if(isset($inv['oa_con_person']) && $inv['oa_con_person']!=''){echo $inv['oa_con_person'];}else{echo '';} ?></td>
                    </tr>
                    <tr>
                            <td valign="top" style="width:60px; font-size:12px; float:left; letter-spacing: 1px; text-align:left; padding-top:5px;"><strong> Sub</strong><span style="text-align:right !important;"></span></td>
                            <td valign="top" style="padding-top:5px; width:10px; font-size:12px; float:left; letter-spacing: 1px; text-align:center;">:</td>
                            <td valign="top" style="padding-top:5px; width:540px; font-size:12px; float:left; letter-spacing: 1px; text-align:left;"><?php if(isset($inv['oa_subject']) && $inv['oa_subject']!=''){echo $inv['oa_subject'];}else{echo '';} ?></td>
                    </tr>        
                </table>

            </td>
        </tr>
        <tr>
            <td valign="top" colspan="2" style="width:18cm; border-left:1px solid #e41f26; border-right:1px solid #e41f26; border-bottom:1px solid #e41f26; padding-top:0.2cm; padding-bottom:0.2cm; padding-left:0.1cm; padding-right:0.1cm;">
                <table style="width:100%;border-collapse:collapse;">
                <tr>
                    <td valign="top" style="padding-top:5px; font-size:12px; float:left; letter-spacing: 1px; text-align:left;"><strong> Dear Sir/Madam,</strong></td>
                    </tr>
                <tr>
                    <td valign="top" style="padding-top:10px;padding-bottom:10px;font-size:11.5px; float:left;letter-spacing: 1px;text-align:left;">Thanks for your valued Order in response we have pleasure to submitting our acknowledgement for the following item with detailed and description.<br/><br/>
                        <b style="font-size:12.5px; float:left;letter-spacing: 1px;text-align:left;">If you find any deviations pl. revert us or we will process your order as below.</b></td>
                    
                </tr>
            </table>

            </td>
        </tr>
       </table>
    <table border="0" style="width:18cm; border-collapse:collapse; margin:0; padding:0; border-left:1px solid #e9494f;border-right:1px solid #e9494f; border-bottom:1px solid #e9494f;" autosize="0">
                 
                    <tr>
                        <td valign="middle" style="width: 1cm;border-left: 1px solid #e9494f; font-size:12px; letter-spacing: 2px; text-align:center; font-weight:bold;border-bottom:1px solid #e9494f;background-color:#f7bbbd;height: 25px;">Sr.No</td>
                        <td colspan="2" valign="middle" style="width: 10cm;border-left: 1px solid #e9494f; font-size:12px; float:left; letter-spacing: 2px; text-align:center; font-weight:bold;border-bottom:1px solid #e9494f;background-color:#f7bbbd;height: 25px;">Item Description</td>
                        <td valign="middle" style="width: 1cm;border-left: 1px solid #e9494f; font-size:12px; float:left; letter-spacing: 2px; text-align:center; font-weight:bold;border-bottom:1px solid #e9494f;background-color:#f7bbbd;height: 25px;">Qty</td>
                        <td  valign="middle" style="width: 1cm;border-left: 1px solid #e9494f; font-size:12px; float:left; letter-spacing: 2px; text-align:center; font-weight:bold;border-bottom:1px solid #e9494f;background-color:#f7bbbd;height: 25px;">Price</td>
                        <td  valign="middle" style="width: 2cm;border-left: 1px solid #e9494f; font-size:12px; float:left; letter-spacing: 2px; text-align:center; font-weight:bold;border-bottom:1px solid #e9494f;background-color:#f7bbbd;height: 25px;">Total</td>
                       
                        <td  valign="middle" style="width: 1cm;border-left: 1px solid #e9494f; font-size:12px; float:left; letter-spacing: 2px; text-align:center; font-weight:bold;border-bottom:1px solid #e9494f;background-color:#f7bbbd;height: 25px;">Dsc%</td>
                       
                        <td colspan="2" valign="middle" style="width: 2cm;border-left: 1px solid #e9494f; border-right: 1px solid #e9494f; font-size:12px; float:left; letter-spacing: 2px; text-align:center; font-weight:bold;border-bottom:1px solid #e9494f;background-color:#f7bbbd;height: 25px;"> Final Total</td>
                         
                    </tr>
<?php //************************** top start *********************************
                    $itm_discount = 0;
					$srno = 0; $finaltotal = 0; foreach ($items as $key => $item) { $srno++; ?>
<?php //******************not in use start *********** ?>
                    <tr>
                        <td valign="top" style="border-left: 1px solid #e9494f;border-top:1px solid #e9494f;"></td>
                        <td colspan="2" valign="top" style="border-left: 1px solid #e9494f;border-top:1px solid #e9494f;"></td>
                        <td valign="top" style="border-left: 1px solid #e9494f;border-top:1px solid #e9494f;"></td>
                        <td valign="top" style="border-left: 1px solid #e9494f;border-right: 1px solid #e9494f;border-top:1px solid #e9494f;"></td>
                        <td valign="top" style="border-left: 1px solid #e9494f;border-top:1px solid #e9494f;"></td>
                        
                        <td valign="top" style="border-left: 1px solid #e9494f;border-top:1px solid #e9494f;"></td>
                       
                        <td colspan="2" valign="top" style="border-left: 1px solid #e9494f;border-top:1px solid #e9494f;"></td>
                        
                    </tr>
<?php //******************not in use end *********** ?>
                    <tr>
                        <td valign="top" style="border-left: 1px solid #e9494f;font-size:11.5px; letter-spacing: 1px; text-align:center;"><?php echo $srno; ?></td>
                        <td colspan="2" valign="top" style="border-left: 1px solid #e9494f;font-size:11.5px; float:left; letter-spacing: 1px; text-align:left;padding-left: 5px;"><strong><?php echo $item['oai_itm_title']; ?></strong><br>Part NO:<?php echo $item['oai_itm']; ?><br/><?php echo nl2br($item['oai_itm_desc']); ?></td>
                        <td valign="top" style="border-left: 1px solid #e9494f;font-size:11.5px; float:left; letter-spacing: 1px; text-align:center;"><?php echo $item['oai_itm_qty']; ?></td>
                        <td valign="top" style="border-left: 1px solid #e9494f;font-size:11.5px; letter-spacing: 2px; text-align:center;"><?php echo number_format($item['oai_itm_price']); ?></td>
                        <td valign="top" style="border-left: 1px solid #e9494f;font-size:11.5px; float:left; letter-spacing: 1px; text-align:center;"><?php $subttl = $item['oai_itm_qty'] * (($item['oai_itm_price']));
                         echo $subttl; ?></td>                         
						<td valign="top" style="border-left: 1px solid #e9494f;font-size:11.5px; float:left; letter-spacing: 1px; text-align:center;"><?php echo number_format($item['oai_itm_discount']); ?></td>                        
                        <td colspan="2" valign="top" style="border-left: 1px solid #e9494f;border-right: 1px solid #e9494f;font-size:11.5px; letter-spacing: 1px; text-align:right;"><?php $subtotal =  ($subttl - (($subttl*$item['oai_itm_discount'])/100));
                        echo number_format($subtotal);
                         $finaltotal = $finaltotal + ($subtotal); ?></td>                                                
                    </tr>
                    <?php /*?><?php foreach($item['taxar'] as $taxd)
					{ ?>
                   
					<?php }?><?php */?>
<?php //******************not in use start *********** ?>
                    <tr>
                        <td style="border-left: 1px solid #e9494f;border-bottom:1px solid #e9494f;"></td>
                        <td colspan="2" style="border-left: 1px solid #e9494f;border-bottom:1px solid #e9494f;"></td>
                        <td style="border-left: 1px solid #e9494f;border-bottom:1px solid #e9494f;"></td>
                        <td style="border-left: 1px solid #e9494f;border-bottom:1px solid #e9494f;"></td>
                        <td style="border-left: 1px solid #e9494f;border-bottom:1px solid #e9494f;"></td>
                        <?php if(isset($inv['oa_isdiscount']) && !empty($inv['oa_isdiscount']) && $inv['oa_isdiscount'] == 1) { ?>
                        <td style="border-left: 1px solid #e9494f;border-bottom:1px solid #e9494f;"></td>
                        <?php } ?>
                        <?php if(isset($inv['oa_isdiscount']) && !empty($inv['oa_isdiscount']) && $inv['oa_isdiscount'] == 2) { ?>
                        <td style="border-left: 1px solid #e9494f;border-right: 1px solid #e9494f;border-bottom:1px solid #e9494f;"></td>
                        <?php } else { ?>
                        <td colspan="2" style="border-left: 1px solid #e9494f;border-right: 1px solid #e9494f;border-bottom:1px solid #e9494f;"></td>
                        <?php } ?>
                    </tr>
<?php //******************not in use end *********** ?>
                    <?php } //echo "<pre>"; print_r($finaltotal); die;
                    //************************** top stop**************  ?>
<?php //***************************************** BOM start ********************** ?>
					
        
                    <?php if($srno < 6){
                        for ($i=$srno; $i < 6 ; $i++) {  ?>
                            <!-- <tr>
                                <td valign="top" style=" border-left: 1px solid #e9494f; font-size:12px; float:left; letter-spacing: 2px; text-align:center; color:#edf2f8;">1</td>
                                <td colspan="2" valign="top" style=" border-left: 1px solid #e9494f; font-size:12px; float:left; letter-spacing: 2px; text-align:left; color:#edf2f8;">TERMINAL</td>
                                <td  valign="top" style=" border-left: 1px solid #e9494f; font-size:12px; float:left; letter-spacing: 2px; text-align:right; color:#edf2f8;">1.642</td>
                                <td valign="top" style=" border-left: 1px solid #e9494f; font-size:12px; float:left; letter-spacing: 2px; text-align:right; color:#edf2f8;">8.21</td>
                                <td valign="top" style=" border-left: 1px solid #e9494f; font-size:12px; float:left; letter-spacing: 2px; text-align:right; color:#edf2f8;">8.21</td>
                                <td valign="top" style=" border-left: 1px solid #e9494f; font-size:12px; float:left; letter-spacing: 2px; text-align:right; color:#edf2f8;">8.21</td>
                                <td colspan="2" valign="top" style="border-left: 1px solid #e9494f; font-size:12px; float:left; letter-spacing: 2px; text-align:right; color:#edf2f8;border-right: 1px solid #e9494f;border-top: 1px solid #e9494f;">64.500000</td>
                            </tr>  -->
                       <?php }
                        } ?>
                        	<!-- <tr>
                            <td valign="top" style="border-bottom: 1px solid #e9494f; border-left: 1px solid #e9494f; font-size:12px; float:left; letter-spacing: 2px; text-align:center; color:#edf2f8;">1</td>
                            <td colspan="2" valign="top" style="border-bottom: 1px solid #e9494f; border-left: 1px solid #e9494f; font-size:12px; float:left; letter-spacing: 2px; text-align:left; color:#edf2f8;">TERMINAL</td>
                            <td valign="top" style="border-bottom: 1px solid #e9494f; border-left: 1px solid #e9494f; font-size:12px; float:left; letter-spacing: 2px; text-align:right; color:#edf2f8;">1.642</td>
                            <td  valign="top" style="border-bottom: 1px solid #e9494f; border-left: 1px solid #e9494f; font-size:12px; float:left; letter-spacing: 2px; text-align:right; color:#edf2f8;">8.21</td>
                            <td  valign="top" style="border-bottom: 1px solid #e9494f; border-left: 1px solid #e9494f; font-size:12px; float:left; letter-spacing: 2px; text-align:right; color:#edf2f8;">8.21</td>
                            <td  valign="top" style="border-bottom: 1px solid #e9494f; border-left: 1px solid #e9494f; font-size:12px; float:left; letter-spacing: 2px; text-align:right; color:#edf2f8;">8.21</td>
                            <td colspan="2" valign="top" style="border-bottom: 1px solid #e9494f; border-left: 1px solid #e9494f;border-right: 1px solid #e9494f; font-size:12px; float:left; letter-spacing: 2px; text-align:right; color:#edf2f8;">64.500000</td>
                        </tr> -->
                   
                   <!-- <tr>
                        <td colspan="5" style="border-right:1px solid #e9494f;border-left:1px solid #e9494f;border-top:1px solid #e9494f;font-family: 'Arial Black', Gadget, sans-serif;font-size:13px; text-align:left;"><?php //echo $inv['oa_grd_ttl_words'] ?></td>
                        <td colspan="2" style="border-right:1px solid #e9494f;border-left:1px solid #e9494f;border-top:1px solid #e9494f;border-bottom:1px solid #e9494f;font-family: 'Arial Black', Gadget, sans-serif;font-size:13px; text-align:right;background-color:#fad1d3;"><strong>SUBTOTAL</strong></td>
                        <td colspan="2" style="border-right:1px solid #e9494f;border-left:1px solid #e9494f;border-top:1px solid #e9494f;border-bottom:1px solid #e9494f;font-family: 'Arial Black', Gadget, sans-serif;font-size:13px; text-align:right;background-color:#fad1d3;"><strong><?php echo number_format($finaltotal); ?></strong></td>
                        <?php /*?><td style="border-right:1px solid #e9494f;border-left:1px solid #e9494f;border-bottom:1px solid #e9494f;"></td><?php */?>
                    </tr> -->
                    <?php if(isset($inv['oa_isdiscount']) && !empty($inv['oa_isdiscount']) && $inv['oa_isdiscount'] == 1) { ?>
                    <!-- <tr>
                        <?php $totaldisc = (($itm_discount * $finaltotal)/100); ?>
                        <td colspan="5" style="border-right:1px solid #e9494f;height: 25px;border-left:1px solid #e9494f;font-family: 'Arial Black', Gadget, sans-serif;font-size:13px; text-align:left;"><?php //echo $inv['oa_grd_ttl_words'] ?></td>
                        <td colspan="2" style="border-right:1px solid #e9494f;border-left:1px solid #e9494f;border-bottom:1px solid #e9494f;font-family: 'Arial Black', Gadget, sans-serif;height: 25px; font-size:13px; text-align:right;background-color:#fad1d3;"><strong>TOTAL Discount</strong></td>
                        <td colspan="2" style="border-right:1px solid #e9494f;border-top:1px solid #e9494f; border-left:1px solid #e9494f;border-bottom:1px solid #e9494f;font-family: 'Arial Black', Gadget, sans-serif;height: 25px;font-size:13px; text-align:right;background-color:#fad1d3;"><strong><?php echo number_format($totaldisc); ?></strong></td>
                        <?php /*?><td style="border-right:1px solid #e9494f;border-left:1px solid #e9494f;border-bottom:1px solid #e9494f;"></td><?php */?>
                    </tr> -->
                    <?php  $disc = $finaltotal - (($itm_discount * $finaltotal)/100); } else { $disc = $finaltotal; } ?>
                     <tr>
                        <?php// $disc = $finaltotal - (($itm_discount * $finaltotal)/100); ?>
                        <td colspan="5" style="height: 25px;border-right:1px solid #e9494f;border-left:1px solid #e9494f;border-bottom:1px solid #e9494f;font-family: 'Arial Black', Gadget, sans-serif;font-size:13px; text-align:left;"><?php //echo $inv['oa_grd_ttl_words'] ?></td>
                        <td colspan="2" style="height: 25px;border-right:1px solid #e9494f;border-left:1px solid #e9494f;border-bottom:1px solid #e9494f;font-family: 'Arial Black', Gadget, sans-serif;font-size:13px; text-align:right;background-color:#fad1d3;"><strong>GRAND TOTAL</strong></td>
                        <td colspan="2" style="height: 25px;border-right:1px solid #e9494f;border-top:1px solid #e9494f;border-left:1px solid #e9494f;border-bottom:1px solid #e9494f;font-family: 'Arial Black', Gadget, sans-serif;font-size:13px; text-align:right;background-color:#fad1d3;"><strong><?php echo number_format($finaltotal); ?></strong></td>
                        <?php /*?><td style="border-right:1px solid #e9494f;border-left:1px solid #e9494f;border-bottom:1px solid #e9494f;"></td><?php */?>
                    </tr>
                    <!-- <tr>
                        <td colspan="5" style="height:15px;border-bottom:1px solid #e9494f;"></td>
                        <td colspan="4" style="height:15px;border-bottom:1px solid #e9494f;"></td>
                    </tr> -->
                    <!-- <tr>
                        <td colspan="7" style="text-align:top; font-size:12px;font-family:'Tahoma'; padding-top: 1%; padding-right: 1%; padding-left: 1%;border-left: 1px solid #e9494f;border-right: 1px solid #e9494f; ">
                            <strong style="text-transform: uppercase;">Terms & Conditions:</strong>
                        </td>
                        <td colspan="2" style="height:15px;"></td>
                    </tr> -->
                    <!-- <tr>
                        <td valign="top" colspan="7" rowspan="<?php echo $rowspan; ?>" style="padding-bottom: 1%;text-align:top; font-size:11.8px;font-family: 'Arial Black', Gadget, sans-serif; padding-right: 1%; padding-left: 1%;border-bottom:1px solid #e9494f;border-left: 1px solid #e9494f;border-right: 1px solid #e9494f; ">
                
                        </td>
                        <td colspan="2" style="height:15px;border-bottom:1px solid #e9494f;padding-bottom: 1%;"></td>
                   
                    </tr> -->
        </table>
    	<table style="width:18cm;border-collapse:collapse; margin:0; padding:0;">
        
                    <tr>
                        <td valign="top" style="text-align:left; border-left:1px solid #e9494f;border-bottom:1px solid #e9494f; font-size:12px;font-family: 'Tahoma'; height: 70px; width: 9cm; padding-right: 1%; padding-left: 1%; padding-top: 1%; padding-bottom: 1%; ">
                            <div style="text-transform: uppercase;font-size:12px;"><strong>GST TIN : 24AAECM7879C1ZB</strong></div><br>
                            <div style="font-size:12.5px;"><strong>Prepared By</strong></div>
                            <div style="font-size:13px;color:#e41f26;"><strong><?php echo $inv['au_fname']; ?> <?php echo $inv['au_lname']; ?></strong></div>
                            <div style="font-size:12px;color:#e41f26;">M : <?php echo $inv['au_mo_no']; ?></div>
                            <div style="font-size:12px;color:#e41f26;">Email : <?php echo $inv['au_gmail_email']; ?></div>
                          
                        </td>
                        <td valign="top" style="border-left:1px solid #e9494f;border-bottom:1px solid #e9494f; border-right: 1px solid #e9494f;font-size:12px;font-family: 'Tahoma'; height: 70px; width: 9cm; padding-right: 1%;  padding-left: 1%;padding-top: 1%; padding-bottom: 1%; text-align:left;">
                                <strong>FOR MICON AUTOMATION SYSTEMS PVT.LTD.</strong><br/><br/><br/>
                                <strong>Auth. Signatory</strong>
                        </td>
                    </tr>
        </table>
        <table style="width:18cm;border-collapse:collapse; margin:0; padding:0;">
            
            <tr>
                <td valign="top" style="padding-top:5px;text-align:left; font-size:9.5px;font-family: 'Tahoma'; width: 98%; padding-right: 1%; padding-left: 1%; text-align:center; ">
                <p>THIS IS A COMPUTER GENERATED DOCUMENT AND DOES NOT REQUIRE A SIGNATURE.</p>
                </td>
            </tr>
        </table>
</div>
</body> 
</html>