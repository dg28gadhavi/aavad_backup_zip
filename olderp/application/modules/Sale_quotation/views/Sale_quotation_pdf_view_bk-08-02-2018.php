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
    <table style="width:100%;border-collapse:collapse; margin-top:-110px;">
        <tr>
            <td colspan="2" style="width:98%; float:left;"><img src="<?php echo base_url(); ?>assets/custom/images/letterheadmyko.jpg"/></td>
        </tr>
    </table>
    <table style="width:100%;border-collapse:collapse;">
        <tr nobr="true">
            <td colspan="2" style="width:98%; color:#4e80bc; padding-top: 10px; padding-bottom:0.3cm; text-align:center;font-size:17px; text-transform: uppercase; font-weight:bold; letter-spacing: 2px;">Quotation</td>
        </tr>
        <tr>
            <td valign="top" style="width:6cm; border-top:2px solid #4e80bc; border-left:2px solid #4e80bc; border-bottom:2px solid #4e80bc; padding-top:0.2cm; padding-bottom:0.2cm; padding-left:0.1cm; padding-right:0.1cm;">
            <div style="width:98%;font-size:12px;"><strong>M/s. Customer name : </strong><?php echo $inv['vendor']; ?></div>
           
	<div style="width:98%; font-size:12px;"><strong>Address : </strong><?php echo nl2br($inv['sa_address']); ?></div>
	<div style="width:98%; font-size:12px;"><strong>Phone : </strong><?php echo $inv['sa_mobile']; ?></div>
	<div style="width:98%; font-size:12px;"><strong>Email : </strong><?php echo nl2br($inv['sa_email']); ?></div>
	<!-- <div style="width:100%;">CH A    :</div></td> -->
            <td valign="top" style="width:6cm;border-top:2px solid #4e80bc; border-left:2px solid #4e80bc;border-bottom:2px solid #4e80bc;border-right:2px solid #4e80bc; padding-top:0.2cm; padding-bottom:0.2cm; padding-left:0.1cm; padding-right:0.1cm;">
                <div style="width:98%; margin-top:0;">
                    <!-- <div style="width:100%; font-size:12px; float:left; letter-spacing: 2px;"> <span style="font-weight:bold;">Invoice No</span> : PI NV111310 </div> -->
                    <table style="width:100%;border-collapse:collapse;">
                        <tr>
                            <td valign="top" style=" width:35.5%; font-size:12px; float:left; letter-spacing: 2px; text-align:left;"><strong>Quotation No.</strong><span style="text-align:right !important;"></span></td>
                            <td valign="top" style=" width:5%; font-size:12px; float:left; letter-spacing: 2px; text-align:center;">:</td>
                            <td valign="top" style=" width:47.5%; font-size:12px; float:left; letter-spacing: 2px; text-align:left;"><?php echo $inv['sa_no'] ?></td>
                        </tr>
                        <tr>
                            <td valign="top" style="width:35.5%; font-size:12px; float:left; letter-spacing: 2px; text-align:left; padding-top:5px;"><strong>Date</strong><span style="text-align:right !important;"></span></td>
                            <td valign="top" style="padding-top:5px; width:5%; font-size:12px; float:left; letter-spacing: 2px; text-align:center;">:</td>
                            <td valign="top" style="padding-top:5px; width:47.5%; font-size:12px; float:left; letter-spacing: 2px; text-align:left;"><?php echo date("d-m-Y", strtotime($inv['sa_enq_date'])); ?></td>
                        </tr>
                        </table>
                </div>
            </td>
        </tr>
         <tr>
            <td colspan="2" valign="top" style="width:6cm;border-bottom:2px solid #4e80bc;border-left:2px solid #4e80bc;border-right:2px solid #4e80bc; padding-top:0.2cm; padding-bottom:0.2cm; padding-left:0.1cm; padding-right:0.1cm;" >
                <div style="width:100%; margin:0;">
                    <div style="width:100%; margin:0;">
                        <table style="width:100%;border-collapse:collapse;">
                                <tr>
                                <td valign="top" style="padding-top:5px;  font-size:12px; float:left; letter-spacing: 2px; text-align:left;"><strong>Kind attn:</strong><?php echo $inv['sa_referred_by'] ?></td>
                                <td valign="top" style=" padding-top:5px;  font-size:12px; float:left; letter-spacing: 2px; text-align:left;"></td>
                            </tr>
                                <tr>
                                <td valign="top" style="padding-top:5px;  font-size:12px; float:left; letter-spacing: 2px; text-align:left;"><strong> Sub :</strong><?php echo $inv['sa_subject'] ?></td>
                                <td valign="top" style=" padding-top:5px; font-size:12px; float:left; letter-spacing: 2px; text-align:left;"></td>
                            </tr>
                            <tr><td valign="top" style="padding-top:5px;  font-size:12px; float:left; letter-spacing: 2px; text-align:left;"></td>
                            </tr>
                            <tr>
                            	<td valign="top" style="padding-top:5px; width:129px; font-size:12px; float:left; letter-spacing: 2px; text-align:left;"><strong> Dear Sir/Madam,</strong></td>
                                </tr>
                            <tr>
                                <td valign="top" style="padding-top:10px;padding-bottom:10px; width:650px; font-size:12px; float:left; letter-spacing: 2px; text-align:left;">Thanks for your valued Enquiry in response we have pleasure in submitting our offer for the following items.</td>
                                
                            </tr>
                        </table>
                    </div>
                </div>
            </td>
        </tr>
       </table>
    <table border="0" style="width:100%; border-collapse:collapse; margin:0; padding:0; background-color:#edf2f8;border-left:2px solid #4e80bc;border-right:2px solid #4e80bc; border-bottom:2px solid #4e80bc;" autosize="0">
                 
                    <tr>
                        <td valign="middle" style="border-left: 2px solid #4e80bc; font-size:12px; letter-spacing: 2px; text-align:center; font-weight:bold;border-bottom:2px solid #4e80bc;background-color:#c8d7ea;">Sr.No</td>
                        <td colspan="2" valign="middle" style="border-left: 2px solid #4e80bc; font-size:12px; float:left; letter-spacing: 2px; text-align:center; font-weight:bold;border-bottom:2px solid #4e80bc;background-color:#c8d7ea;">Item Description</td>
                         <td valign="middle" style="border-bottom: 2px solid #4e80bc; border-left: 2px solid #4e80bc; font-size:12px; float:left; letter-spacing: 2px; text-align:center; font-weight:bold;background-color:#c8d7ea;">HSN Code</td>
                        <?php /*?><td valign="middle" style="width:1.5cm; border-bottom: 2px solid #4e80bc; border-left: 2px solid #4e80bc; font-size:12px; float:left; letter-spacing: 2px; text-align:center; font-weight:bold;background-color:#c8d7ea;">Unit</td><?php */?>
                       
                        <td colspan="2" valign="middle" style="border-left: 2px solid #4e80bc; font-size:12px; float:left; letter-spacing: 2px; text-align:center; font-weight:bold;border-bottom:2px solid #4e80bc;background-color:#c8d7ea;">Qty</td>
                        <td  valign="middle" style="border-left: 2px solid #4e80bc; font-size:12px; float:left; letter-spacing: 2px; text-align:center; font-weight:bold;border-bottom:2px solid #4e80bc;background-color:#c8d7ea;">PRICE</td>
                        <td  valign="middle" style="border-left: 2px solid #4e80bc; font-size:12px; float:left; letter-spacing: 2px; text-align:center; font-weight:bold;border-bottom:2px solid #4e80bc;background-color:#c8d7ea;">Total</td>
                        <td  valign="middle" style="border-left: 2px solid #4e80bc; font-size:12px; float:left; letter-spacing: 2px; text-align:center; font-weight:bold;border-bottom:2px solid #4e80bc;background-color:#c8d7ea;">Dsc%</td>
                        <td  valign="middle" style="border-left: 2px solid #4e80bc; border-right: 2px solid #4e80bc; font-size:12px; float:left; letter-spacing: 2px; text-align:center; font-weight:bold;border-bottom:2px solid #4e80bc;background-color:#c8d7ea;"> Final Total</td>
                    </tr>
<?php //************************** top start *********************************
					$srno = 0; foreach ($items as $key => $item) { $srno++; ?>
<?php //******************not in use start *********** ?>
                    <tr>
                        <td valign="top" style="border-left: 2px solid #4e80bc;border-top:2px solid #4e80bc;"></td>
                        <td valign="top" colspan="2" style="border-left: 2px solid #4e80bc;border-top:2px solid #4e80bc;"></td>
                        <td valign="top" style="border-left: 2px solid #4e80bc;border-top:2px solid #4e80bc;"></td>
                        <?php /*?> <td style="border-left: 2px solid #4e80bc;border-top:2px solid #4e80bc;"></td><?php */?>
                        <td valign="top" colspan="2" style="border-left: 2px solid #4e80bc;border-top:2px solid #4e80bc;"></td>
                        <td valign="top" style="border-left: 2px solid #4e80bc;border-right: 2px solid #4e80bc;border-top:2px solid #4e80bc;"></td>
                        <td valign="top" style="border-left: 2px solid #4e80bc;border-top:2px solid #4e80bc;"></td>
                        <td valign="top" style="border-left: 2px solid #4e80bc;border-top:2px solid #4e80bc;"></td>
                        <td valign="top" style="border-left: 2px solid #4e80bc;border-top:2px solid #4e80bc;"></td>
                    </tr>
<?php //******************not in use end *********** ?>
                    <tr>
                        <td valign="top" style="border-left: 2px solid #4e80bc;font-size:12px; letter-spacing: 1px; text-align:center;"><?php echo $srno; ?></td>
                        <td valign="top" colspan="2" style="border-left: 2px solid #4e80bc;font-size:12px; float:left; letter-spacing: 1px; text-align:left;"><strong><?php echo $item['master_item_name']; ?><?php echo $item['master_item_part_no']; ?></strong><br/><?php echo nl2br($item['sai_itm_desc']); ?></td>
                        <td valign="top" style="border-left: 2px solid #4e80bc;font-size:12px; float:left; letter-spacing: 1px; text-align:center;"><?php echo $item['master_item_hsncode'] ?></td>
                        <?php /*?><td style="border-left: 2px solid #4e80bc;font-size:12px; float:left; letter-spacing: 2px; text-align:center;"><?php echo $item['master_item_unit_name'] ?></td><?php */?>
                        <td valign="top" colspan="2" style="border-left: 2px solid #4e80bc;font-size:12px; float:left; letter-spacing: 1px; text-align:center;"><?php echo $item['sai_itm_qty']; ?></td>
                        <td valign="top" style="border-left: 2px solid #4e80bc;font-size:12px; letter-spacing: 2px; text-align:center;"><?php echo number_format($item['sai_itm_price'], 2, '.', ''); ?></td>
                        <td valign="top" style="border-left: 2px solid #4e80bc;font-size:12px; float:left; letter-spacing: 1px; text-align:center;"><?php echo number_format($item['sai_itm_total'], 2, '.', ''); ?></td>
						<td valign="top" style="border-left: 2px solid #4e80bc;font-size:12px; float:left; letter-spacing: 1px; text-align:center;"><?php echo number_format($item['sai_itm_discount'], 2, '.', ''); ?></td>
                        <td valign="top" style="border-left: 2px solid #4e80bc;border-right: 2px solid #4e80bc;font-size:12px; letter-spacing: 1px; text-align:center;"><?php echo number_format($item['sai_itm_total'], 2, '.', ''); ?></td>

                                                    
                    </tr>
                    <?php /*?><?php foreach($item['taxar'] as $taxd)
					{ ?>
                   
					<?php }?><?php */?>
<?php //******************not in use start *********** ?>
                    <tr>
                        <td style="border-left: 2px solid #4e80bc;border-bottom:2px solid #4e80bc;"></td>
                        <td colspan="2" style="border-left: 2px solid #4e80bc;border-bottom:2px solid #4e80bc;"></td>
                        <td style="border-left: 2px solid #4e80bc;border-bottom:2px solid #4e80bc;"></td>
                       
                        <td colspan="2" style="border-left: 2px solid #4e80bc;border-bottom:2px solid #4e80bc;"></td>
                        <td style="border-left: 2px solid #4e80bc;border-bottom:2px solid #4e80bc;"></td>
                        <td style="border-left: 2px solid #4e80bc;border-bottom:2px solid #4e80bc;"></td>
                        <td style="border-left: 2px solid #4e80bc;border-bottom:2px solid #4e80bc;"></td>
                        <td style="border-left: 2px solid #4e80bc;border-right: 2px solid #4e80bc;border-bottom:2px solid #4e80bc;"></td>
                    </tr>
<?php //******************not in use end *********** ?>
                    <?php } //************************** top stop**************  ?>
<?php //***************************************** BOM start ********************** ?>
					
        
                    <?php if($srno < 6){
                        for ($i=$srno; $i < 6 ; $i++) {  ?>
                            <tr>
                                <td valign="top" style=" border-left: 2px solid #4e80bc; font-size:12px; float:left; letter-spacing: 2px; text-align:center; color:#edf2f8;">1</td>
                                <td colspan="2" valign="top" style=" border-left: 2px solid #4e80bc; font-size:12px; float:left; letter-spacing: 2px; text-align:left; color:#edf2f8;">TERMINAL</td>
                                <td valign="top" style=" border-left: 2px solid #4e80bc; font-size:12px; float:left; letter-spacing: 2px; text-align:right; color:#edf2f8;">5.00</td>
                                <td colspan="2"  valign="top" style=" border-left: 2px solid #4e80bc; font-size:12px; float:left; letter-spacing: 2px; text-align:right; color:#edf2f8;">1.642</td>
                                <td valign="top" style=" border-left: 2px solid #4e80bc; font-size:12px; float:left; letter-spacing: 2px; text-align:right; color:#edf2f8;">8.21</td>
                                <td valign="top" style=" border-left: 2px solid #4e80bc; font-size:12px; float:left; letter-spacing: 2px; text-align:right; color:#edf2f8;">8.21</td>
                                <td valign="top" style=" border-left: 2px solid #4e80bc; font-size:12px; float:left; letter-spacing: 2px; text-align:right; color:#edf2f8;">8.21</td>
                                <td valign="top" style="border-left: 2px solid #4e80bc; font-size:12px; float:left; letter-spacing: 2px; text-align:right; color:#edf2f8;border-right: 2px solid #4e80bc;">64.500000</td>
                            </tr> 
                       <?php }
                        } ?>
                        	<tr>
                            <td valign="top" style="border-bottom: 2px solid #4e80bc; border-left: 2px solid #4e80bc; font-size:12px; float:left; letter-spacing: 2px; text-align:center; color:#edf2f8;">1</td>
                            <td colspan="2" valign="top" style="border-bottom: 2px solid #4e80bc; border-left: 2px solid #4e80bc; font-size:12px; float:left; letter-spacing: 2px; text-align:left; color:#edf2f8;">TERMINAL</td>
                            <td valign="top" style="border-bottom: 2px solid #4e80bc; border-left: 2px solid #4e80bc; font-size:12px; float:left; letter-spacing: 2px; text-align:right; color:#edf2f8;">5.00</td>
                            <td colspan="2" valign="top" style="border-bottom: 2px solid #4e80bc; border-left: 2px solid #4e80bc; font-size:12px; float:left; letter-spacing: 2px; text-align:right; color:#edf2f8;">1.642</td>
                            <td  valign="top" style="border-bottom: 2px solid #4e80bc; border-left: 2px solid #4e80bc; font-size:12px; float:left; letter-spacing: 2px; text-align:right; color:#edf2f8;">8.21</td>
                            <td  valign="top" style="border-bottom: 2px solid #4e80bc; border-left: 2px solid #4e80bc; font-size:12px; float:left; letter-spacing: 2px; text-align:right; color:#edf2f8;">8.21</td>
                            <td  valign="top" style="border-bottom: 2px solid #4e80bc; border-left: 2px solid #4e80bc; font-size:12px; float:left; letter-spacing: 2px; text-align:right; color:#edf2f8;">8.21</td>
                            <td  valign="top" style="border-bottom: 2px solid #4e80bc; border-left: 2px solid #4e80bc;border-right: 2px solid #4e80bc; font-size:12px; float:left; letter-spacing: 2px; text-align:right; color:#edf2f8;">64.500000</td>
                        </tr>
                   
                   <tr>
                        <td colspan="7" style="border-right:2px solid #4e80bc;border-left:2px solid #4e80bc;border-bottom:2px solid #4e80bc;font-family: 'Arial Black', Gadget, sans-serif;font-size:14px; text-align:left;"><?php //echo $inv['sa_grd_ttl_words'] ?></td>
                        <td colspan="2" style="border-right:2px solid #4e80bc;border-left:2px solid #4e80bc;border-bottom:2px solid #4e80bc;font-family: 'Arial Black', Gadget, sans-serif;font-size:14px; text-align:right;"><strong>TOTAL</strong></td>
                        <td style="border-right:2px solid #4e80bc;border-left:2px solid #4e80bc;border-bottom:2px solid #4e80bc;font-family: 'Arial Black', Gadget, sans-serif;font-size:14px; text-align:right;"><strong><?php echo number_format($inv['sa_sub_ttl'], 2, '.', ''); $ttf = 0; $ttf = $ttf + $inv['sa_sub_ttl']; ?></strong></td>
                        <?php /*?><td style="border-right:2px solid #4e80bc;border-left:2px solid #4e80bc;border-bottom:2px solid #4e80bc;"></td><?php */?>
                    </tr>
                    <tr>
                        <td colspan="6" style="height:15px;border-bottom:2px solid #4e80bc;"></td>
                        <td colspan="4" style="height:15px;border-bottom:2px solid #4e80bc;"></td>
                    </tr>
                    <tr>
                        <td colspan="6" style="text-align:top; font-size:12px;font-family:'Tahoma'; padding-top: 6px; padding-right: 1%; padding-left: 1%; ">
                            <strong style="text-transform: uppercase;">Terms & Conditions:</strong>
                        </td>
                        <td colspan="4" style="height:15px;"></td>
                    </tr>
                    <tr>
                        <td valign="top" colspan="6" rowspan="<?php echo $rowspan; ?>" style="text-align:top; font-size:11.8px;font-family: 'Arial Black', Gadget, sans-serif; padding-right: 1%; padding-left: 1%;border-bottom:2px solid #4e80bc; ">
                            <?php echo nl2br($inv['sale_quotation_term']); ?>
                        </td>
                        <td colspan="4" style="height:15px;border-bottom:2px solid #4e80bc;"></td>
                   
                    </tr>
        </table>
    	<table style="width:100%;border-collapse:collapse; margin:0; padding:0;">
                    <tr>
                        <td valign="top" style="text-align:left; border:2px solid #4e80bc; font-size:12.5px;font-family: 'Tahoma'; height: 70px; width: 38%; padding-right: 1%; padding-left: 1%; padding-top: 1%; padding-bottom: 1%; ">
                            <strong style="text-transform: uppercase;">GST TIN : 24AAECM7879C1ZB</strong>
                        </td>
                        <td valign="top" style="border:2px solid #4e80bc; font-size:13.5px;font-family: 'Tahoma'; height: 70px; width: 50%; padding-right: 1%;  padding-top: 1%; padding-bottom: 1%; text-align:LEFT;">
                               <strong>FOR MICON AUTOMATION SYSTEMS PVT.LTD.</strong><br/><br/><br/>
                            <strong>Auth. Signatory</strong>
                        </td>
                    </tr>
          </table>
           

        <!-- <tr>
            <td valign="top" colspan="2" style="width:100%;border-collapse:collapse; margin:0; padding-top:2px;">
                <table style="width:100%;border-collapse:collapse; margin:0; padding:0;">
                    <tr>
                        <td valign="top" style="text-align:right; border:2px solid #4e80bc; font-size:12.5px;font-family: 'Tahoma'; height: 10px; width: 76%; padding-right: 1%; padding-left: 1%; padding-top: 1px; padding-bottom: 1px; ">
                        <strong>Prepared By : </strong>
                        </td>
                        <td valign="top" style="border:2px solid #4e80bc; font-size:12.5px;font-family: 'Tahoma'; height: 10px; width: 16%; padding-right: 1%; padding-left: 1%; padding-top: 1px; padding-bottom: 1px; text-align:left;">
                            <strong><span style="font-size:13.5px;"><?php //echo $inv['pur_prepareby'] ?></span></strong>
                        </td>
                    </tr>
                </table>
            </td>
        </tr> -->
        
    	<table style="width:100%;border-collapse:collapse; margin:0; padding:0;">
                    <tr>
                        <td valign="top" style="text-align:left; font-size:10px;font-family: 'Tahoma'; width: 98%; padding-right: 1%; padding-left: 1%; ">
                        <p><strong>Address :</strong>A-814, Siddhi Vinayak Towers, Off S.G. Road, Behind Adani CNG Pump, Makarba, Ahmedabad, Gujarat 380051</p>
                         <p><strong> E-Mail :</strong>sales@miconindia | info@miconindia.com</p>
                        </td>
                    </tr>
                    <tr>
                        <td valign="top" style="padding-top:5px;text-align:left; font-size:9.5px;font-family: 'Tahoma'; width: 98%; padding-right: 1%; padding-left: 1%; text-align:center; ">
                        <p>THIS IS A COMPUTER GENERATED DOCUMENT AND DOES NOT REQUIRE A SIGNATURE.</p>
                        </td>
                    </tr>
        </table>
</div>
</body>
</html>