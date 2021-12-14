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
            <td colspan="2" style="width:98%; color:#e9494f; padding-top: 10px; padding-bottom:0.3cm; text-align:center;font-size:17px; text-transform: uppercase; font-weight:bold; letter-spacing: 1px;">PROFORMA INVOICE</td>
        </tr>
        <tr>
            <td valign="top" style="width:6cm; border-top:1px solid #e9494f; border-left:1px solid #e9494f; border-bottom:1px solid #e9494f; padding-top:0.2cm; padding-bottom:0.2cm; padding-left:0.1cm; padding-right:0.1cm;">
            <div style="width:98%;font-size:11px;"><strong>M/s. Customer name : </strong><?php echo $inv['vendor']; ?></div>
           
	<div style="width:98%; font-size:11px;"><strong>Address : </strong><?php echo nl2br($inv['pi_address']); ?></div>
	<div style="width:98%; font-size:11px;"><strong>Phone : </strong><?php echo $inv['pi_phone']; ?></div>
	<div style="width:98%; font-size:11px;"><strong>Email : </strong><?php echo nl2br($inv['pi_email']); ?></div>
	<!-- <div style="width:100%;">CH A    :</div></td> -->
            <td valign="top" style="width:6cm;border-top:1px solid #e9494f; border-left:1px solid #e9494f;border-bottom:1px solid #e9494f;border-right:1px solid #e9494f; padding-top:0.2cm; padding-bottom:0.2cm; padding-left:0.1cm; padding-right:0.1cm;">
                <div style="width:98%; margin-top:0;">
                    <!-- <div style="width:100%; font-size:11px; float:left; letter-spacing: 1px;"> <span style="font-weight:bold;">Invoice No</span> : PI NV111310 </div> -->
                    <table style="width:100%;border-collapse:collapse;">
                        <tr>
                            <td valign="top" style=" width:35.5%; font-size:11px; float:left; letter-spacing: 1px; text-align:left;"><strong>Your PO No.</strong><span style="text-align:right !important;"></span></td>
                            <td valign="top" style=" width:5%; font-size:11px; float:left; letter-spacing: 1px; text-align:center;">:</td>
                            <td valign="top" style=" width:47.5%; font-size:11px; float:left; letter-spacing: 1px; text-align:left;"><?php echo $inv['po_no'] ?></td>
                        </tr>
                        <tr>
                            <td valign="top" style="width:35.5%; font-size:11px; float:left; letter-spacing: 1px; text-align:left; padding-top:5px;"><strong>P.O. Date</strong><span style="text-align:right !important;"></span></td>
                            <td valign="top" style="padding-top:5px; width:5%; font-size:11px; float:left; letter-spacing: 1px; text-align:center;">:</td>
                            <td valign="top" style="padding-top:5px; width:47.5%; font-size:11px; float:left; letter-spacing: 1px; text-align:left;"><?php echo date("d-m-Y", strtotime($inv['po_enq_date'])); ?></td>
                        </tr>
                        <tr>
                            <td valign="top" style="width:35.5%; font-size:11px; float:left; letter-spacing: 1px; text-align:left; padding-top:5px;"><strong>P.I. No.</strong><span style="text-align:right !important;"></span></td>
                            <td valign="top" style="padding-top:5px; width:5%; font-size:11px; float:left; letter-spacing: 1px; text-align:center;">:</td>
                            <td valign="top" style="padding-top:5px; width:47.5%; font-size:11px; float:left; letter-spacing: 1px; text-align:left;"><?php echo $inv['pi_no']; ?></td>
                        </tr>
                        <tr>
                            <td valign="top" style="width:35.5%; font-size:11px; float:left; letter-spacing: 1px; text-align:left; padding-top:5px;"><strong>P.I. Date</strong><span style="text-align:right !important;"></span></td>
                            <td valign="top" style="padding-top:5px; width:5%; font-size:11px; float:left; letter-spacing: 1px; text-align:center;">:</td>
                            <td valign="top" style="padding-top:5px; width:47.5%; font-size:11px; float:left; letter-spacing: 1px; text-align:left;"><?php echo date("d-m-Y", strtotime($inv['pi_enq_date'])); ?></td>
                        </tr>
                        <tr>
                            <td valign="top" style="width:35.5%; font-size:11px; float:left; letter-spacing: 1px; text-align:left; padding-top:5px;"><strong>OUR GST NO.</strong><span style="text-align:right !important;"></span></td>
                            <td valign="top" style="padding-top:5px; width:5%; font-size:11px; float:left; letter-spacing: 1px; text-align:center;">:</td>
                            <td valign="top" style="padding-top:5px; width:47.5%; font-size:11px; float:left; letter-spacing: 1px; text-align:left;"><?php echo $inv['pi_gst']; ?></td>
                        </tr>
                        </table>
                </div>
            </td>
        </tr>
        <tr>
            <td valign="top" style="width:9cm; border-top:1px solid #e9494f; border-left:1px solid #e9494f; border-bottom:1px solid #e9494f; padding-top:0.2cm; padding-bottom:0.2cm; padding-left:0.1cm; padding-right:0.1cm;">
                        <div style="width:98%;font-size:11px;"><strong>GST NO. : </strong><?php echo $inv['pi_gst']; ?></div>   
                        <br>        
                        <div style="width:98%; font-size:11px;"><strong>Kind Atten : </strong><?php echo $inv['vendor']; ?></div>
        <!-- <div style="width:100%;">CH A    :</div></td> -->
            <td valign="top" style="width:3cm;border-top:1px solid #e9494f; border-left:1px solid #e9494f;border-bottom:1px solid #e9494f;border-right:1px solid #e9494f; padding-top:0.2cm; padding-bottom:0.2cm; padding-left:0.1cm; padding-right:0.1cm;">
                <div style="width:98%; margin-top:0; color:#e9494f;">
                    <!-- <div style="width:100%; font-size:11px; float:left; letter-spacing: 1px;"> <span style="font-weight:bold;">Invoice No</span> : PI NV111310 </div> -->
                   
                        <div style="width:98%;font-size:11px;"><strong>Bank Detail</strong></div>           
                        <div style="width:98%; font-size:11px;">Micon Automation Systems Pvt Ltd.</div>
                        <div style="width:98%; font-size:11px;">State Bank of India</div>
                        <div style="width:98%; font-size:11px;">A/C No. 30336333730</div>
                        <div style="width:98%; font-size:11px;">Branch : Corporate Road, Ahmedabad.</div>
                        <div style="width:98%; font-size:11px;">RTGS/NEFT/IFSC Code :SBIN0013925</div>
                        <br>
                </div>
            </td>
        </tr>
        
       </table>
    <table border="0" style="width:100%; border-collapse:collapse; margin:0; padding:0; background-color:#fce8e9; border-left:1px solid #e9494f;border-right:1px solid #e9494f; border-bottom:1px solid #e9494f;" autosize="0">
                 
                    <tr>
                        <td valign="middle" style="border-left: 1px solid #e9494f; font-size:11px; letter-spacing: 1px; text-align:center; font-weight:bold;border-bottom:1px solid #e9494f;background-color:#f7bbbd;">Sr.No</td>
                        <td colspan="2" valign="middle" style="border-left: 1px solid #e9494f; font-size:11px; float:left; letter-spacing: 1px; text-align:center; font-weight:bold;border-bottom:1px solid #e9494f;background-color:#f7bbbd;">Item Description</td>
                        <td valign="middle" style="border-left: 1px solid #e9494f; font-size:11px; float:left; letter-spacing: 1px; text-align:center; font-weight:bold;border-bottom:1px solid #e9494f;background-color:#f7bbbd;">HSN Code</td>
                        <td valign="middle" style="border-left: 1px solid #e9494f; font-size:11px; float:left; letter-spacing: 1px; text-align:center; font-weight:bold;border-bottom:1px solid #e9494f;background-color:#f7bbbd;">Qty</td>
                        <td valign="middle" style="border-left: 1px solid #e9494f; font-size:11px; float:left; letter-spacing: 1px; text-align:center; font-weight:bold;border-bottom:1px solid #e9494f;background-color:#f7bbbd;">UNIT PRICE</td>
                        <td colspan="2" valign="middle" style="border-left: 1px solid #e9494f; font-size:11px; float:left; letter-spacing: 1px; text-align:center; font-weight:bold;border-bottom:1px solid #e9494f;background-color:#f7bbbd;">Taxable Amount</td>
                       
                        <td  valign="middle" style="border-left: 1px solid #e9494f; font-size:11px; float:left; letter-spacing: 1px; text-align:center; font-weight:bold;border-bottom:1px solid #e9494f;background-color:#f7bbbd;">GST%</td>
                       
                        <td  valign="middle" style="border-left: 1px solid #e9494f; font-size:11px; float:left; letter-spacing: 1px; text-align:center; font-weight:bold;border-bottom:1px solid #e9494f;background-color:#f7bbbd;">Tax Amt</td>
                        <td colspan="2" valign="middle" style="border-left: 1px solid #e9494f; border-right: 1px solid #e9494f; font-size:11px; float:left; letter-spacing: 1px; text-align:center; font-weight:bold;border-bottom:1px solid #e9494f;background-color:#f7bbbd;"> Grand Total</td>
                       
                    </tr>
<?php //************************** top start *********************************
                    $itm_discount = 0; $ftotal = 0;
					$srno = 0; $finaltotal = 0; foreach ($items as $key => $item) { $srno++; ?>
<?php //******************not in use start *********** ?>
                    <tr>
                        <td valign="top" style="border-left: 1px solid #e9494f;border-top:1px solid #e9494f;"></td>
                        <td colspan="2" valign="top" colspan="2" style="border-left: 1px solid #e9494f;border-top:1px solid #e9494f;"></td>
                        <td valign="top" style="border-left: 1px solid #e9494f;border-top:1px solid #e9494f;"></td>
                        <td valign="top" style="border-left: 1px solid #e9494f;border-top:1px solid #e9494f;"></td>
                        <td valign="top" style="border-left: 1px solid #e9494f;border-right: 1px solid #e9494f;border-top:1px solid #e9494f;"></td>
                        <td colspan="2" valign="top" style="border-left: 1px solid #e9494f;border-top:1px solid #e9494f;"></td>                        
                        <td valign="top" style="border-left: 1px solid #e9494f;border-top:1px solid #e9494f;"></td>  
                        <!-- <td colspan="2" valign="top" style="border-left: 1px solid #e9494f;border-top:1px solid #e9494f;"></td> -->                        
                        <td valign="top" style="border-left: 1px solid #e9494f;border-top:1px solid #e9494f;"></td>
                        <td colspan="2"valign="top" style="border-left: 1px solid #e9494f;border-top:1px solid #e9494f;"></td>
                       
                    </tr>
<?php //******************not in use end *********** ?>
                    <tr>
                        <td valign="top" style="border-left: 1px solid #e9494f;font-size:11px; letter-spacing: 1px; text-align:center;"><?php echo $srno; ?></td>
                        <td valign="top" colspan="2" style="border-left: 1px solid #e9494f;font-size:11px; float:left; letter-spacing: 1px; text-align:left;"><strong><?php echo $item['master_item_name']; ?><?php echo $item['master_item_part_no']; ?></strong><br/><?php echo nl2br($item['pii_itm_desc']); ?></td>
                        <td valign="top" style="border-left: 1px solid #e9494f;font-size:11px; float:left; letter-spacing: 1px; text-align:center;"><?php echo $item['hsn_hcode']; ?></td>
                        <td valign="top" style="border-left: 1px solid #e9494f;font-size:11px; float:left; letter-spacing: 1px; text-align:center;"><?php echo $item['pii_itm_qty']; ?></td>
                        <td valign="top" style="border-left: 1px solid #e9494f;font-size:11px; letter-spacing: 1px; text-align:center;"><?php echo number_format($item['pii_itm_price'], 2, '.', ''); ?></td>
                        <td colspan="2" valign="top" style="border-left: 1px solid #e9494f;font-size:11px; float:left; letter-spacing: 1px; text-align:center;"><?php $subttl = $item['pii_itm_qty'] * number_format($item['pii_itm_price'], 2, '.', '');
                         echo $subttl; ?></td>                         
						<td valign="top" style="border-left: 1px solid #e9494f;font-size:11px; float:left; letter-spacing: 1px; text-align:center;"><?php echo number_format($item['pii_itm_gst_per'], 2, '.', ''); ?></td>                      
                       
                        <td valign="top" style="border-left: 1px solid #e9494f;font-size:11px; letter-spacing: 1px; text-align:center;"><?php $disc = (($subttl*$item['pii_itm_discount'])/100);
                                $totwithdisc = $subttl - $disc;
                                $gstrate = ($totwithdisc * $item['pii_itm_gst_per'])/100;
                                $ftotal = $totwithdisc + $gstrate;
                        echo number_format($gstrate, 2, '.', ''); ?></td>
                        <td colspan="2" valign="top" style="border-left: 1px solid #e9494f;border-right: 1px solid #e9494f;font-size:11px; letter-spacing: 1px; text-align:right;"><?php 
                        echo number_format($ftotal, 2, '.', '');
                         //$finaltotal = $finaltotal + number_format($$ftotal, 2, '.', ''); ?></td>
                        <?php  
                        $ftotal = $ftotal + $ftotal;
                        //echo $ftotal; 
                        ?>
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
                        <td colspan="2" style="border-left: 1px solid #e9494f;border-bottom:1px solid #e9494f;"></td>
                        
                        <td style="border-left: 1px solid #e9494f;border-bottom:1px solid #e9494f;"></td>
                        <td style="border-left: 1px solid #e9494f;border-bottom:1px solid #e9494f;"></td>
                        <td colspan="2" style="border-left: 1px solid #e9494f;border-right: 1px solid #e9494f;border-bottom:1px solid #e9494f;"></td>
                        
                    </tr>
<?php //******************not in use end *********** ?>
                    <?php } //die;//************************** top stop**************  ?>
<?php //***************************************** BOM start ********************** ?>
					
        
                    <?php if($srno < 6){
                        for ($i=$srno; $i < 6 ; $i++) {  ?>
                            <tr>
                                <td valign="top" style=" border-left: 1px solid #e9494f; font-size:11px; float:left; letter-spacing: 1px; text-align:center; color:#edf2f8;">1</td>
                                <td colspan="2" valign="top" style=" border-left: 1px solid #e9494f; font-size:11px; float:left; letter-spacing: 1px; text-align:left; color:#edf2f8;">TERMINAL</td>
                                <td valign="top" style=" border-left: 1px solid #e9494f; font-size:11px; float:left; letter-spacing: 1px; text-align:right; color:#edf2f8;">8.21</td>
                                <td valign="top" style=" border-left: 1px solid #e9494f; font-size:11px; float:left; letter-spacing: 1px; text-align:right; color:#edf2f8;">1.642</td>
                                <td valign="top" style=" border-left: 1px solid #e9494f; font-size:11px; float:left; letter-spacing: 1px; text-align:right; color:#edf2f8;">8.21</td>
                                <td colspan="2" valign="top" style=" border-left: 1px solid #e9494f; font-size:11px; float:left; letter-spacing: 1px; text-align:right; color:#edf2f8;">8.21</td>
                                <td valign="top" style=" border-left: 1px solid #e9494f; font-size:11px; float:left; letter-spacing: 1px; text-align:right; color:#edf2f8;">8.21</td>
                                <!-- <td colspan="2" valign="top" style=" border-left: 1px solid #e9494f; font-size:11px; float:left; letter-spacing: 1px; text-align:right; color:#edf2f8;">8.21</td> -->
                                <td valign="top" style=" border-left: 1px solid #e9494f; font-size:11px; float:left; letter-spacing: 1px; text-align:right; color:#edf2f8;">8.21</td>
                                <td colspan="2" valign="top" style="border-left: 1px solid #e9494f; font-size:11px; float:left; letter-spacing: 1px; text-align:right; color:#edf2f8;border-right: 1px solid #e9494f;">64.500000</td>
                            </tr> 
                       <?php }
                        } ?>
                        	<tr>
                            <td valign="top" style="border-bottom: 1px solid #e9494f; border-left: 1px solid #e9494f; font-size:11px; float:left; letter-spacing: 1px; text-align:center; color:#edf2f8;">1</td>
                            <td colspan="2" valign="top" style="border-bottom: 1px solid #e9494f; border-left: 1px solid #e9494f; font-size:11px; float:left; letter-spacing: 1px; text-align:left; color:#edf2f8;">TERMINAL</td>
                            <td valign="top" style="border-bottom: 1px solid #e9494f; border-left: 1px solid #e9494f; font-size:11px; float:left; letter-spacing: 1px; text-align:right; color:#edf2f8;">8.21</td>
                            <td valign="top" style="border-bottom: 1px solid #e9494f; border-left: 1px solid #e9494f; font-size:11px; float:left; letter-spacing: 1px; text-align:right; color:#edf2f8;">1.642</td>
                            <td  valign="top" style="border-bottom: 1px solid #e9494f; border-left: 1px solid #e9494f; font-size:11px; float:left; letter-spacing: 1px; text-align:right; color:#edf2f8;">8.21</td>
                            <td  colspan="2" valign="top" style="border-bottom: 1px solid #e9494f; border-left: 1px solid #e9494f; font-size:11px; float:left; letter-spacing: 1px; text-align:right; color:#edf2f8;">8.21</td>
                            <td valign="top" style="border-bottom: 1px solid #e9494f; border-left: 1px solid #e9494f; font-size:11px; float:left; letter-spacing: 1px; text-align:right; color:#edf2f8;">8.21</td>
                            <!-- <td colspan="2" valign="top" style="border-bottom: 1px solid #e9494f; border-left: 1px solid #e9494f; font-size:11px; float:left; letter-spacing: 1px; text-align:right; color:#edf2f8;">8.21</td> -->
                            <td valign="top" style="border-bottom: 1px solid #e9494f; border-left: 1px solid #e9494f; font-size:11px; float:left; letter-spacing: 1px; text-align:right; color:#edf2f8;">8.21</td>
                            <td colspan="2" valign="top" style="border-bottom: 1px solid #e9494f; border-left: 1px solid #e9494f;border-right: 1px solid #e9494f; font-size:11px; float:left; letter-spacing: 1px; text-align:right; color:#edf2f8;">64.500000</td>
                    </tr>
                    <tr>
                            <td valign="top" style="border-bottom: 1px solid #e9494f; border-left: 1px solid #e9494f; font-size:11px; float:left; letter-spacing: 1px; text-align:center; color:#edf2f8;">1</td>
                            <td colspan="2" valign="top" style="border-bottom: 1px solid #e9494f; border-left: 1px solid #e9494f; font-size:11px; float:left; letter-spacing: 1px; text-align:left; color:#edf2f8;">TERMINAL</td>
                            <td valign="top" style="border-bottom: 1px solid #e9494f; border-left: 1px solid #e9494f; font-size:11px; float:left; letter-spacing: 1px; text-align:right; color:#edf2f8;">8.21</td>
                            <td colspan="3" valign="top" style="border-bottom: 1px solid #e9494f; border-left: 1px solid #e9494f; font-size:11px; float:left; letter-spacing: 1px; text-align:right; color:#edf2f8;">1.642</td>
                            
                            <td valign="top" style="border-bottom: 1px solid #e9494f; border-left: 1px solid #e9494f; font-size:11px; float:left; letter-spacing: 1px; text-align:right; color:#edf2f8;">8.21</td>                            
                            <td valign="top" style="border-bottom: 1px solid #e9494f; border-left: 1px solid #e9494f; font-size:11px; float:left; letter-spacing: 1px; text-align:right; color:#edf2f8;">8.21</td>
                            <td valign="top" style="border-bottom: 1px solid #e9494f; border-left: 1px solid #e9494f; font-size:11px; float:left; letter-spacing: 1px; text-align:right; color:#edf2f8;">8.21</td>
                            <td colspan="2" valign="top" style="border-bottom: 1px solid #e9494f; border-left: 1px solid #e9494f;border-right: 1px solid #e9494f; font-size:11px; float:left; letter-spacing: 1px; text-align:right; color:#edf2f8;">64.500000</td>
                    </tr>
                    <tr>
                            <td valign="top" style="border-bottom: 1px solid #e9494f; border-left: 1px solid #e9494f; font-size:11px; float:left; letter-spacing: 1px; text-align:center; color:#edf2f8;">1</td>
                            <td colspan="2" valign="top" style="border-bottom: 1px solid #e9494f; border-left: 1px solid #e9494f; font-size:11px; float:left; letter-spacing: 1px; text-align:left; color:#edf2f8;">TERMINAL</td>
                            <td valign="top" style="border-bottom: 1px solid #e9494f; border-left: 1px solid #e9494f; font-size:11px; float:left; letter-spacing: 1px; text-align:right; color:#edf2f8;">8.21</td>
                            <td colspan="3" valign="top" style="border-bottom: 1px solid #e9494f; border-left: 1px solid #e9494f; font-size:11px; float:left; letter-spacing: 1px; text-align:right; color:#edf2f8;">1.642</td>
                            
                            <td valign="top" style="border-bottom: 1px solid #e9494f; border-left: 1px solid #e9494f; font-size:11px; float:left; letter-spacing: 1px; text-align:right; color:#edf2f8;">8.21</td>                            
                            <td valign="top" style="border-bottom: 1px solid #e9494f; border-left: 1px solid #e9494f; font-size:11px; float:left; letter-spacing: 1px; text-align:right; color:#edf2f8;">8.21</td>
                            <td valign="top" style="border-bottom: 1px solid #e9494f; border-left: 1px solid #e9494f; font-size:11px; float:left; letter-spacing: 1px; text-align:right; color:#edf2f8;">8.21</td>
                            <td colspan="2" valign="top" style="border-bottom: 1px solid #e9494f; border-left: 1px solid #e9494f;border-right: 1px solid #e9494f; font-size:11px; float:left; letter-spacing: 1px; text-align:right; color:#edf2f8;">64.500000</td>
                    </tr>
                  
                   
                   <!--  <tr>
                        <td colspan="8" style="border-right:1px solid #e9494f;border-left:1px solid #e9494f;border-bottom:1px solid #e9494f;font-family: 'Arial Black', Gadget, sans-serif;font-size:14px; text-align:left;"><?php //echo $inv['pi_grd_ttl_words'] ?></td>
                        <td colspan="2" style="border-right:1px solid #e9494f;border-left:1px solid #e9494f;border-bottom:1px solid #e9494f;font-family: 'Arial Black', Gadget, sans-serif;font-size:14px; text-align:right;"><strong>SUBTOTAL</strong></td>
                        <td style="border-right:1px solid #e9494f;border-left:1px solid #e9494f;border-bottom:1px solid #e9494f;font-family: 'Arial Black', Gadget, sans-serif;font-size:14px; text-align:right;"><strong><?php echo number_format($finaltotal, 2, '.', ''); ?></strong></td>
                    </tr> -->
                    <?php if(isset($inv['pi_isdiscount']) && !empty($inv['pi_isdiscount']) && $inv['pi_isdiscount'] == 1) { ?>
                    <tr>
                        <?php $totaldisc = (($itm_discount * $finaltotal)/100); ?>
                        <td colspan="7" style="border-right:1px solid #e9494f;border-left:1px solid #e9494f;border-bottom:1px solid #e9494f;font-family: 'Arial Black', Gadget, sans-serif;font-size:14px; text-align:left;"><?php //echo $inv['pi_grd_ttl_words'] ?></td>
                        <td valign="top" style="border-bottom: 1px solid #e9494f; border-left: 1px solid #e9494f; font-size:11px; float:left; letter-spacing: 1px; text-align:right; color:#edf2f8;"><strong><?php echo number_format($disc, 2, '.', ''); ?></strong></td>
                        <td style="border-right:1px solid #e9494f;border-left:1px solid #e9494f;border-bottom:1px solid #e9494f;font-family: 'Arial Black', Gadget, sans-serif;font-size:14px; text-align:right;"><strong></strong></td>
                        <td style="border-right:1px solid #e9494f;border-left:1px solid #e9494f;border-bottom:1px solid #e9494f;font-family: 'Arial Black', Gadget, sans-serif;font-size:14px; text-align:right;"><strong><strong><?php echo number_format($disc, 2, '.', ''); ?></strong></strong></td>
                        <td colspan="2" style="border-right:1px solid #e9494f;border-left:1px solid #e9494f;border-bottom:1px solid #e9494f;font-family: 'Arial Black', Gadget, sans-serif;font-size:14px; text-align:right;"><strong><?php echo number_format($totaldisc, 2, '.', ''); ?></strong></td>
                        <?php /*?><td style="border-right:1px solid #e9494f;border-left:1px solid #e9494f;border-bottom:1px solid #e9494f;"></td><?php */?>
                    </tr>
                    <?php  $disc = $finaltotal - (($itm_discount * $finaltotal)/100); } else { $disc = $finaltotal; } ?>
                     <tr>
                        <?php// $disc = $finaltotal - (($itm_discount * $finaltotal)/100); ?>
                        <td colspan="7" style="border-right:1px solid #e9494f;border-left:1px solid #e9494f;border-bottom:1px solid #e9494f;font-family: 'Arial Black', Gadget, sans-serif;font-size:14px; text-align:left;"><?php //echo $inv['pi_grd_ttl_words'] ?></td>
                        <td valign="middle" style="border-bottom: 1px solid #e9494f; border-left: 1px solid #e9494f; font-size:11px; float:left; letter-spacing: 1px; text-align:right;"><strong><?php echo number_format($disc, 2, '.', ''); ?></strong></td>
                        <td style="border-right:1px solid #e9494f;border-left:1px solid #e9494f;border-bottom:1px solid #e9494f;font-family: 'Arial Black', Gadget, sans-serif;font-size:14px; text-align:right;"></td>
                        <td style="border-right:1px solid #e9494f;border-left:1px solid #e9494f;border-bottom:1px solid #e9494f;font-family: 'Arial Black', Gadget, sans-serif;font-size:14px; text-align:right;"><strong><?php echo number_format($disc, 2, '.', ''); ?></strong></td>
                        <td colspan="2" style="border-right:1px solid #e9494f;border-left:1px solid #e9494f;border-bottom:1px solid #e9494f;font-family: 'Arial Black', Gadget, sans-serif;font-size:14px; text-align:right;"><strong><?php echo number_format($disc, 2, '.', ''); ?></strong></td>
                        <?php /*?><td style="border-right:1px solid #e9494f;border-left:1px solid #e9494f;border-bottom:1px solid #e9494f;"></td><?php */?>
                    </tr>
                    <tr>
                        <?php// $disc = $finaltotal - (($itm_discount * $finaltotal)/100); ?>
                        <td colspan="7" style="border-right:1px solid #e9494f;border-left:1px solid #e9494f;border-bottom:1px solid #e9494f;font-family: 'Arial Black', Gadget, sans-serif;font-size:14px; text-align:left;">Only twelve thousand, six hundred and sixty-seven</td>
                        <td colspan="2" valign="middle" style="border-bottom: 1px solid #e9494f; border-left: 1px solid #e9494f; font-size:11px; float:left; letter-spacing: 1px; text-align:right;"><strong>Grand Total</strong></td>
                        <!-- <td style="border-right:1px solid #e9494f;border-left:1px solid #e9494f;border-bottom:1px solid #e9494f;font-family: 'Arial Black', Gadget, sans-serif;font-size:14px; text-align:right;"></td> -->
                        <!-- <td style="border-right:1px solid #e9494f;border-left:1px solid #e9494f;border-bottom:1px solid #e9494f;font-family: 'Arial Black', Gadget, sans-serif;font-size:14px; text-align:right;"><strong><?php echo number_format($disc, 2, '.', ''); ?></strong></td> -->
                        
                        <td colspan="3" style="border-right:1px solid #e9494f;border-left:1px solid #e9494f;border-bottom:1px solid #e9494f;font-family: 'Arial Black', Gadget, sans-serif;font-size:14px; text-align:right;"><strong><?php echo number_format($ftotal, 2, '.', ''); ?></strong></td>
                        <?php /*?><td style="border-right:1px solid #e9494f;border-left:1px solid #e9494f;border-bottom:1px solid #e9494f;"></td><?php */?>
                    </tr>
                    <tr>
                        <td colspan="8" style="height:15px;border-bottom:1px solid #e9494f;"></td>
                        <td colspan="2" style="height:15px;border-bottom:1px solid #e9494f;"></td>
                    </tr>
                    <!-- <tr>
                        <td colspan="8" style="text-align:top; font-size:11px;font-family:'Tahoma'; padding-top: 6px; padding-right: 1%; padding-left: 1%; ">
                            <strong style="text-transform: uppercase;">Terms & Conditions:</strong>
                        </td>
                        <td colspan="2" style="height:15px;"></td>
                    </tr> -->
                   <!--  <tr>
                        <td valign="top" colspan="8" rowspan="<?php echo $rowspan; ?>" style="text-align:top; font-size:11.8px;font-family: 'Arial Black', Gadget, sans-serif; padding-right: 1%; padding-left: 1%;border-bottom:1px solid #e9494f; ">
                            <?php echo nl2br($inv['pi_term']); ?>
                        </td>
                        <td colspan="2" style="height:15px;border-bottom:1px solid #e9494f;"></td>
                   
                    </tr> -->
        </table>
    	  <table style="width:100%;border-collapse:collapse; margin:0; padding:0;">
        
                    <tr>
                        <td valign="top" style="text-align:left; border-left:1px solid #e9494f;border-bottom:1px solid #e9494f; font-size:12.5px;font-family: 'Tahoma'; height: 70px; width: 60%; padding-right: 1%; padding-left: 1%; padding-top: 1%; padding-bottom: 1%; ">
                            <div style="height: 70px; color: #e9494f;font-size:12.5px;">Payment 100% advance by cheque OR RTGS</div>
                            <div style="width:98%;font-size:11px;"><strong>Delivery : Ex Stock</strong></div>
                            <div style="width:98%;font-size:11px;">Subject to ahmedabad jurisdiction only.</div>           
                            <div style="width:98%; font-size:11px;">No allowance for shortage, mistake in any way or</div>
                            <div style="width:98%; font-size:11px;">loss in transit will be entertaine unless notice is</div>
                            <div style="width:98%; font-size:11px;">given within seven days on receipt of goods.</div>
                        </td>
                        
                        <td valign="top" style="border-left:1px solid #e9494f;border-bottom:1px solid #e9494f; border-right: 1px solid #e9494f;font-size:13.5px;font-family: 'Tahoma'; height: 70px; width: 40%; padding-right: 1%; padding-left: 1%; padding-top: 1%; padding-bottom: 1%; text-align:LEFT;">
                            <div style="width:98%;font-size:12.5px;"><strong>Prepared By</strong></div>
                            <br/><br/><br/>
                            <strong>Auth. Signatory</strong>
                        </td>
                    </tr>
                </table>
                <!-- <table style="width:100%;border-collapse:collapse; margin:0; padding:0;">
                    
                    <tr>
                        <td valign="top" style="padding-top:5px;text-align:left; font-size:9.5px;font-family: 'Tahoma'; width: 98%; padding-right: 1%; padding-left: 1%; text-align:center; ">
                        <p>THIS IS A COMPUTER GENERATED DOCUMENT AND DOES NOT REQUIRE A SIGNATURE.</p>
                        </td>
                    </tr>
                </table> -->
</div>
</body>
</html>