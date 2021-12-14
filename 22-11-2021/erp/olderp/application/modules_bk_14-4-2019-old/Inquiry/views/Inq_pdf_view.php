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
@font-face {
        font-family: 'Tahoma';
        src:url(<?php echo base_url(); ?>assets/custom/font/Tahoma.ttf) format('truetype');
}
    body {
        margin: 0;
        padding: 0;
        background-color: #FFF;
        line-height:1.2;
        font-family: 'Tahoma';
    }
    * {
        box-sizing: border-box;
        -moz-box-sizing: border-box;
        font-family: 'Tahoma';
    }
    .page {
        width: 100%;
        margin: 0 auto;
        background: white;
        font-family: 'Tahoma';
    }
    p
    {
        margin:0;
        padding:0;
    }
</style>
</head>
<body>
<div class="page">
<div style="width:18cm; margin:0 auto;padding-top:50px; font-family: 'Tahoma';">
    <table style="width:18cm;border-collapse:collapse; margin-top:-110px;">
        <tr>
            <td colspan="2" style="width:18cm; float:left;"><img src="<?php echo base_url(); ?>assets/custom/images/letterheadmyko.jpg"/></td>
        </tr>
    </table>
    <table style="width:18cm;border-collapse:collapse;">
        <tr nobr="true">
            <td colspan="2" style="width:18cm; color:#4e80bc; padding-top: 10px; padding-bottom:0.3cm; text-align:center;font-size:17px; text-transform: uppercase; font-weight:bold; letter-spacing: 2px;">Sales Inquiry1111</td>
        </tr>
        <tr>
            <td valign="top" style="width:6cm; border-top:2px solid #4e80bc; border-left:2px solid #4e80bc; border-right:2px solid #4e80bc; border-bottom:2px solid #4e80bc; padding-top:0.2cm; padding-bottom:0.2cm; padding-left:0.1cm; padding-right:0.1cm;">
            <div style="width:100%; font-size:12px; font-weight:bold;">To,</div>
            <div style="width:100%; font-size:12px; text-transform: uppercase;"><?php echo $inv['vendor']; ?></div>
<div style="width:100%; font-size:12px;"><?php echo nl2br($inv['sq_address']); ?></div>
<!-- <div style="width:100%;">CH A    :</div></td> -->
            <td valign="top" style="width:6cm; border-top:2px solid #4e80bc; border-right:2px solid #4e80bc; border-bottom:2px solid #4e80bc; padding-top:0.2cm; padding-bottom:0.2cm; padding-left:0.1cm; padding-right:0.1cm;">
                <div style="width:100%; margin-top:0;">
                    <!-- <div style="width:100%; font-size:12px; float:left; letter-spacing: 1px;"> <span style="font-weight:bold;">Invoice No</span> : PI NV111310 </div> -->
                    <table style="width:100%;border-collapse:collapse;">
                        <tr>
                            <td valign="top" style=" width:35.5%; font-size:12px; float:left; letter-spacing: 1px; text-align:left;"><strong>Inquiry No</strong><span style="text-align:right !important;"></span></td>
                            <td valign="top" style=" width:5%; font-size:12px; float:left; letter-spacing: 1px; text-align:center;">:</td>
                            <td valign="top" style=" width:47.5%; font-size:12px; float:left; letter-spacing: 1px; text-align:left;"><?php echo $inv['sq_no'] ?></td>
                        </tr>
                        <tr>
                            <td valign="top" style="width:35.5%; font-size:12px; float:left; letter-spacing: 1px; text-align:left; padding-top:5px;"><strong>Customer Name</strong><span style="text-align:right !important;"></span></td>
                            <td valign="top" style="padding-top:5px; width:5%; font-size:12px; float:left; letter-spacing: 1px; text-align:center;">:</td>
                            <td valign="top" style="padding-top:5px; width:47.5%; font-size:12px; float:left; letter-spacing: 1px; text-align:left;"><?php echo $inv['vendor']; ?></td>
                        </tr>
                        <tr>
                            <td valign="top" style="padding-top:5px; width:35.5%; font-size:12px; float:left; letter-spacing: 1px; text-align:left;"><strong>Inquiry Date</strong><span style="text-align:right !important;"></span></td>
                            <td valign="top" style=" padding-top:5px;width:3%; font-size:12px; float:left; letter-spacing: 1px; text-align:center;">:</td>
                            <td valign="top" style=" padding-top:5px;width:47.5%; font-size:12px; float:left; letter-spacing: 1px; text-align:left;"><?php echo date("d-m-Y", strtotime($inv['sq_enq_date'])) ?></td>
                        </tr>
                        <tr>
                            <td valign="top" style="padding-top:5px; width:37%; font-size:12px; float:left; letter-spacing: 1px; text-align:left;"><strong>Email Id</strong><span style="text-align:right !important;"></span></td>
                            <td valign="top" style=" padding-top:5px;width:4%; font-size:12px; float:left; letter-spacing: 1px; text-align:center;">:</td>
                            <td valign="top" style=" padding-top:5px;width:47.5%; font-size:12px; float:left; letter-spacing: 1px; text-align:left;"><?php echo $inv['sq_email']; ?></td>
                        </tr>
                         <tr>
                            <td valign="top" style="padding-top:5px; width:37%; font-size:12px; float:left; letter-spacing: 1px; text-align:left;"><strong>Mobile_No</strong><span style="text-align:right !important;"></span></td>
                            <td valign="top" style=" padding-top:5px;width:4%; font-size:12px; float:left; letter-spacing: 1px; text-align:center;">:</td>
                            <td valign="top" style=" padding-top:5px;width:47.5%; font-size:12px; float:left; letter-spacing: 1px; text-align:left;"><?php echo $inv['sq_mobile']; ?></td>
                        </tr>
                         <tr>
                            <td valign="top" style="padding-top:5px; width:37%; font-size:12px; float:left; letter-spacing: 1px; text-align:left;"><strong>Referred By</strong><span style="text-align:right !important;"></span></td>
                            <td valign="top" style=" padding-top:5px;width:4%; font-size:12px; float:left; letter-spacing: 1px; text-align:center;">:</td>
                            <td valign="top" style=" padding-top:5px;width:47.5%; font-size:12px; float:left; letter-spacing: 1px; text-align:left;"><?php echo $inv['sq_ref_by']; ?></td>
                        </tr>

                    </table>
                </div>
            </td>
        </tr>
        <tr>
            <td colspan="2" valign="top" style="width:6cm; border-right:2px solid #4e80bc; border-left:2px solid #4e80bc; border-bottom:2px solid #4e80bc; padding-top:0.2cm; padding-bottom:0.2cm; padding-left:0.1cm; padding-right:0.1cm;" >
                <div style="width:100%; margin:0;">
                    <div style="width:100%; margin:0;">
                        <table style="width:100%;border-collapse:collapse;">
                            <tr>
                                <td valign="top" style="padding-top:5px; width:129px; font-size:12px; float:left; letter-spacing: 1px; text-align:left;"><strong>Address </strong></td>
                                <td valign="top" style="padding-top:5px; width:10px;  font-size:12px; float:left; letter-spacing: 1px; text-align:center;">:</td>
                                <td valign="top" style=" padding-top:5px;  font-size:12px; float:left; letter-spacing: 1px; text-align:left;"><?php echo $inv['sq_address'] ?></td>
                            </tr>
                            <tr>
                                <td valign="top" style="padding-top:5px;  font-size:12px; float:left; letter-spacing: 1px; text-align:left;"><strong>Remarks</strong></td>
                                <td valign="top" style="padding-top:5px;  font-size:12px; float:left; letter-spacing: 1px; text-align:center;">:</td>
                                <td valign="top" style=" padding-top:5px;  font-size:12px; float:left; letter-spacing: 1px; text-align:left;"><?php echo $inv['sq_remarks'] ?></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </td>
        </tr>
        <tr>
            <td colspan="2" style="width:100.5%;border-collapse:collapse; margin:0; padding:0;">
             
                <table border="0" style="width:100.5%; border-collapse:collapse; margin:0; padding:0; background-color:#edf2f8;">
                    <tr>
                        <td valign="middle" style="width:1cm; border-left: 2px solid #4e80bc; font-size:12px; letter-spacing: 2px; text-align:center; font-weight:bold;border-bottom:2px solid #4e80bc;background-color:#a3bcdb;">Sr.No</td>
                        <td colspan="2" valign="middle" style="width:16cm;  border-left: 2px solid #4e80bc; font-size:12px; float:left; letter-spacing: 2px; text-align:center; font-weight:bold;border-bottom:2px solid #4e80bc;background-color:#a3bcdb;">Item Description</td>
                         <td valign="middle" style="width:1.5cm; border-bottom: 2px solid #4e80bc; border-left: 2px solid #4e80bc; font-size:12px; float:left; letter-spacing: 2px; text-align:center; font-weight:bold;background-color:#a3bcdb;">HSN Code</td>
                        <td valign="middle" style="width:1.5cm; border-bottom: 2px solid #4e80bc; border-left: 2px solid #4e80bc; font-size:12px; float:left; letter-spacing: 2px; text-align:center; font-weight:bold;background-color:#a3bcdb;">Unit</td>
                       
                        <td valign="middle" style="width:1.5cm; border-left: 2px solid #4e80bc; font-size:12px; float:left; letter-spacing: 2px; text-align:center; font-weight:bold;border-bottom:2px solid #4e80bc;background-color:#a3bcdb;">Qty</td>
                        <?php /*?><td  valign="middle" style="width:1cm;  border-left: 2px solid #4e80bc; font-size:12px; float:left; letter-spacing: 2px; text-align:center; font-weight:bold;border-bottom:2px solid #4e80bc;">Dsc%</td><?php */?>
                        <td  valign="middle" style="width:2.5cm; border-left: 2px solid #4e80bc; font-size:12px;  border-right: 2px solid #4e80bc; float:left; letter-spacing: 2px; text-align:center; font-weight:bold;border-bottom:2px solid #4e80bc;background-color:#a3bcdb;">UNIT PRICE</td>
                        <?php /*?><td  valign="middle" style="width:1cm; border-left: 2px solid #4e80bc; font-size:12px; float:left; letter-spacing: 2px; text-align:center; font-weight:bold;border-bottom:2px solid #4e80bc;">GST%</td><?php */?>
                        <?php /*?><td  valign="middle" style="width:1.5cm; border-left: 2px solid #4e80bc; border-right: 2px solid #4e80bc; font-size:12px; float:left; letter-spacing: 2px; text-align:center; font-weight:bold;border-bottom:2px solid #4e80bc;"> Total with Tax</td><?php */?>
                    </tr>
<?php //************************** top start *********************************
					$srno = 0; foreach ($items as $key => $item) { $srno++; ?>
<?php //******************not in use start *********** ?>
                    <tr>
                        <td style="border-left: 2px solid #4e80bc; border-right: 2px solid #4e80bc;border-top:2px solid #4e80bc;"></td>
                        <td colspan="2" style="border-left: 2px solid #4e80bc;border-top:2px solid #4e80bc;"></td>
                        <td style="border-left: 2px solid #4e80bc; border-top:2px solid #4e80bc;"></td>
                        <td style="border-left: 2px solid #4e80bc;border-top:2px solid #4e80bc;"></td>
                        <td style="border-left: 2px solid #4e80bc;border-top:2px solid #4e80bc; border-right: 2px solid #4e80bc;"></td>
                        <td style="border-left: 2px solid #4e80bc;border-right: 2px solid #4e80bc;border-top:2px solid #4e80bc;"></td>
                    </tr>
<?php //******************not in use end *********** ?>
                    <tr>
                        <td style="border-left: 2px solid #4e80bc;font-size:12px; letter-spacing: 2px; text-align:center;"><?php echo $srno; ?></td>
                        <td colspan="2" style="border-left: 2px solid #4e80bc;font-size:12px; float:left; letter-spacing: 2px; text-align:left;"><strong><?php echo $item['master_item_name'] ?>-<strong><?php echo $item['master_item_pno'] ?></strong><br/><?php //echo nl2br($item['sai_itm_desc']); ?></td>
                        <td style="border-left: 2px solid #4e80bc;font-size:12px; float:left; letter-spacing: 2px; text-align:center;"><?php echo $item['master_item_hsncode'] ?></td>
                        <td style="border-left: 2px solid #4e80bc;font-size:12px; float:left; letter-spacing: 2px; text-align:center;"><?php echo $item['master_item_unit_name'] ?></td>
                        <td style="border-left: 2px solid #4e80bc;font-size:12px; float:left; letter-spacing: 2px; text-align:center;"><?php echo $item['sqi_itm_qty'] ?></td>
                        <?php /*?><td style="border-left: 2px solid #4e80bc;font-size:12px; float:left; letter-spacing: 2px; text-align:center;"><?php echo number_format($item['sai_itm_price'], 2, '.', ''); ?></td><?php */?>
                        <td style="border-left: 2px solid #4e80bc; border-right: 2px solid #4e80bc;font-size:12px; letter-spacing: 2px; text-align:center;"><?php echo number_format($item['sqi_itm_price'], 2, '.', ''); ?>/-Each</td>
                        <?php /*?><td style="border-left: 2px solid #4e80bc;font-size:12px; float:left; letter-spacing: 2px; text-align:center;"><?php echo $item['sai_itm_qty'] ?></td>
                        <td style="border-left: 2px solid #4e80bc;border-right: 2px solid #4e80bc;font-size:12px; letter-spacing: 2px; text-align:center;"><?php if(isset($item['sai_itm_tax']) && ($item['sai_itm_tax'] == 'Yes')){ ?><img src="<?php echo base_url().'assets/custom/images/right.png'; ?>"/><?php }if(isset($item['sai_itm_tax']) && ($item['sai_itm_tax'] == 'No')){ ?><img src="<?php echo base_url().'assets/custom/images/cancel.png'; ?>"/><?php } ?></td><?php */?>
                    </tr>
                   <?php /*?> <?php foreach($item['taxar'] as $taxd)
					{ ?>
                    <tr>
                        <td style="border-left: 2px solid #4e80bc;font-size:12px; letter-spacing: 1px; text-align:center;"></td>
                        <td colspan="2" style="border-left: 2px solid #4e80bc;font-size:12px; float:left; letter-spacing: 1px; text-align:left;"><?php echo $taxd['sqit_tax_name'] ?></td>
                        <td style="border-left: 2px solid #4e80bc;font-size:12px; float:left; letter-spacing: 1px; text-align:center;"></td>
                        <td style="border-left: 2px solid #4e80bc;font-size:12px; float:left; letter-spacing: 1px; text-align:center;"><?php echo number_format($taxd['sqit_tax_per'], 2, '.', '').'%'; ?></td>
                        <td style="border-left: 2px solid #4e80bc;font-size:12px; letter-spacing: 1px; text-align:center;"><?php echo number_format($taxd['sqit_tax_amount'], 2, '.', ''); ?></td>
                        <td style="border-left: 2px solid #4e80bc;border-right: 2px solid #4e80bc;font-size:12px; letter-spacing: 1px; text-align:center;"></td>
                    </tr>
					<?php }?><?php */?>
<?php //******************not in use start *********** ?>
                    <tr>
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
					
  
                    <?php //************************** top start *********************************
					 foreach ($boms as $key => $bom) { $srno++; ?>
<?php //******************not in use start *********** ?>
                    <tr>
                        <td style="border-left: 2px solid #4e80bc;border-top:2px solid #4e80bc;"></td>
                        <td colspan="2" style="border-left: 2px solid #4e80bc;border-top:2px solid #4e80bc;"></td>
                        <td style="border-left: 2px solid #4e80bc;border-top:2px solid #4e80bc;"></td>
                        <td style="border-left: 2px solid #4e80bc;border-top:2px solid #4e80bc;"></td>
                        <td style="border-left: 2px solid #4e80bc;border-top:2px solid #4e80bc;"></td>
                        <td style="border-left: 2px solid #4e80bc;border-right: 2px solid #4e80bc;border-top:2px solid #4e80bc;"></td>
                    </tr>
<?php //******************not in use end *********** ?>
                    <tr>
                        <td style="border-left: 2px solid #4e80bc;font-size:12px; letter-spacing: 1px; text-align:center;"><?php echo $srno; ?></td>
                        <td colspan="2" style="border-left: 2px solid #4e80bc;font-size:12px; float:left; letter-spacing: 1px; text-align:left;"><strong><?php echo $bom['bom_name'] ?></strong></td>
                        <td style="border-left: 2px solid #4e80bc;font-size:12px; float:left; letter-spacing: 1px; text-align:center;"><?php echo $bom['sqb_qty'] ?></td>
                        <td style="border-left: 2px solid #4e80bc;font-size:12px; float:left; letter-spacing: 1px; text-align:center;"><?php echo number_format($bom['sqb_price'], 2, '.', ''); ?></td>
                        <td style="border-left: 2px solid #4e80bc;font-size:12px; letter-spacing: 1px; text-align:center;"><?php echo number_format($bom['sqb_total'], 2, '.', ''); ?></td>
                        <td style="border-left: 2px solid #4e80bc;border-right: 2px solid #4e80bc;font-size:12px; letter-spacing: 1px; text-align:center;"><?php if(isset($bom['pb_tax']) && ($bom['sqb_tax'] == 'Yes')){ ?><img src="<?php echo base_url().'assets/custom/images/right.png'; ?>"/><?php }if(isset($bom['pb_tax']) && ($bom['sqb_tax'] == 'No')){ ?><img src="<?php echo base_url().'assets/custom/images/cancel.png'; ?>"/><?php } ?></td>
                    </tr>
                    <?php foreach($bom['taxar'] as $taxd)
					{ ?>
                    <tr>
                        <td style="border-left: 2px solid #4e80bc;font-size:12px; letter-spacing: 1px; text-align:center;"></td>
                        <td colspan="2" style="border-left: 2px solid #4e80bc;font-size:12px; float:left; letter-spacing: 1px; text-align:left;"><?php echo $taxd['sqbt_tax_name'] ?></td>
                        <td style="border-left: 2px solid #4e80bc;font-size:12px; float:left; letter-spacing: 1px; text-align:center;"></td>
                        <td style="border-left: 2px solid #4e80bc;font-size:12px; float:left; letter-spacing: 1px; text-align:center;"><?php echo number_format($taxd['sqbt_tax_per'], 2, '.', '').'%'; ?></td>
                        <td style="border-left: 2px solid #4e80bc;font-size:12px; letter-spacing: 1px; text-align:center;"><?php echo number_format($taxd['sqbt_tax_amount'], 2, '.', ''); ?></td>
                        <td style="border-left: 2px solid #4e80bc;border-right: 2px solid #4e80bc;font-size:12px; letter-spacing: 1px; text-align:center;"></td>
                    </tr>
					<?php }?>
<?php //******************not in use start *********** ?>
                    <tr>
                        <td style="border-left: 2px solid #4e80bc;border-bottom:2px solid #4e80bc;"></td>
                        <td colspan="2" style="border-left: 2px solid #4e80bc;border-bottom:2px solid #4e80bc;"></td>
                        <td style="border-left: 2px solid #4e80bc;border-bottom:2px solid #4e80bc;"></td>
                        <td style="border-left: 2px solid #4e80bc;border-bottom:2px solid #4e80bc;"></td>
                        <td style="border-left: 2px solid #4e80bc;border-bottom:2px solid #4e80bc;"></td>
                        <td style="border-left: 2px solid #4e80bc;border-right: 2px solid #4e80bc;border-bottom:2px solid #4e80bc;"></td>
                    </tr>
<?php //******************not in use end *********** ?>
                    <?php } //************************** top stop**************  ?>
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
<?php //***************************************** BOM End ************************ ?>
                    <?php /*?><tr>
                        <td valign="top" style="width:3cm; border-left: 2px solid #4e80bc; font-size:12px; float:left; letter-spacing: 1px; text-align:left; ">Sr.No</td>
                        <td colspan="2" valign="top" style="width:10cm;  border-left: 2px solid #4e80bc; font-size:12px; float:left; letter-spacing: 1px; text-align:left; ">Item Description
                        </td>
                        <!--<td valign="top" style="width:13%; border-bottom: 2px solid #4e80bc; border-left: 2px solid #4e80bc; font-size:12px; float:left; letter-spacing: 1px; text-align:center; font-weight:bold;">CURR.</td>-->
                        <td valign="top" style="width:2cm; border-left: 2px solid #4e80bc; font-size:12px; float:left; letter-spacing: 1px; text-align:left; ">Qty</td>
                        <td  valign="top" style="width:2cm;  border-left: 2px solid #4e80bc; font-size:12px; float:left; letter-spacing: 1px; text-align:left; ">Rate</td>
                        <td  valign="top" style="width:2cm; border-left: 2px solid #4e80bc; font-size:12px; float:left; letter-spacing: 1px; text-align:left; ">Amount in INR</td>
                        <td  valign="top" style="width:2cm; border-left: 2px solid #4e80bc; border-right: 2px solid #4e80bc; font-size:12px; float:left; letter-spacing: 1px; text-align:left; ">TAX</td>
                    </tr><?php */?>
                     <?php /*?><tr>
                    <td></td>
                    <td colspan="2"></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    </tr><?php */?>
                    <?php /* $srno++; ?>
                        <tr>
                            <td valign="top" style="border-bottom: 2px solid #4e80bc; border-left: 2px solid #4e80bc; font-size:12px; float:left; letter-spacing: 1px; text-align:center;"><?php echo $srno; ?></td>
                            <td valign="top" style="border-bottom: 2px solid #4e80bc; border-left: 2px solid #4e80bc; font-size:12px; float:left; letter-spacing: 1px; text-align:left;"><?php echo $item['master_item_name'] ?><br>
                          <table>
                                <tr>
                                	<td valign="top" style="font-size:12px;"><?php echo $item['master_item_description'] ?></td>
                                <tr>
                                <tr>
                                		<td valign="top" style="font-size:12px;">Seal Charges</td>
                                <tr>
                                <tr>
                                <td valign="top" style="font-size:12px;">S.Tax for Seal Charges</td>
                                <tr>
                                <tr>
                                	<td valign="top" style="font-size:12px;">SBC for Seal Charges</td>
                                <tr>
                                <tr>
                                	<td valign="top" style="font-size:12px;">KKC for Seal Charges</td>
                                <tr>
                        </table>
                            </td>
                            <td valign="top" style="border-bottom: 2px solid #4e80bc; border-left: 2px solid #4e80bc; font-size:12px; float:left; letter-spacing: 1px; text-align:center;"><?php echo "10";  //echo $item['currency_name'] ?></td>
                            <td valign="top" style="border-bottom: 2px solid #4e80bc; border-left: 2px solid #4e80bc; font-size:12px; float:left; letter-spacing: 1px; text-align:right;"><?php echo "10";//echo $item['invi_itm_qty'] ?>
                            </td>
                      
                         <table>
                           
                             <tr>
                                <td valign="top" style="font-size:12px;height:20px;"></td>
                            <tr>
                             
                            <tr>
                                <td valign="top" style="font-size:12px;">12</td>
                            <tr>
                             
                            <tr>
                                <td valign="top" style="font-size:12px;">14</td>
                            <tr>
                            <tr>
                                <td valign="top" style="font-size:12px;">15</td>
                            
                            <tr>
                            <tr>
                                <td valign="top" style="font-size:12px;">14</td>
                            <tr>
                        </table>
                            </td>
                           
                            <td  valign="top" style="border-bottom: 2px solid #4e80bc; border-left: 2px solid #4e80bc; font-size:12px; float:left; letter-spacing: 1px; text-align:right;"><?php echo "10"; //echo number_format($item['invi_itm_price'], 2, '.', ''); ?></td>
                            <td  valign="top" style="border-bottom: 2px solid #4e80bc; border-left: 2px solid #4e80bc; font-size:12px; float:left; letter-spacing: 1px; text-align:right;"><?php echo "10"; //echo number_format($item['invi_itm_total'], 2, '.', ''); ?></td>
                            <td style="border-bottom: 2px solid #4e80bc; border-left: 2px solid #4e80bc; border-right: 2px solid #4e80bc; font-size:12px; float:left; letter-spacing: 1px; text-align:center;"><?php if(isset($item['sqi_itm_tax']) && ($item['sqi_itm_tax'] == 'Yes')){ ?><img src="<?php echo base_url().'assets/custom/images/right.png'; ?>"/><?php }if(isset($item['sqi_itm_tax']) && ($item['sqi_itm_tax'] == 'No')){ ?><img src="<?php echo base_url().'assets/custom/images/cancel.png'; ?>"/><?php } ?></td>
                        </tr>
                    <?php */ ?>
                    <?php //if($srno < 6){
                        //for ($i=$srno; $i < 6 ; $i++) {  ?>
                            <?php /*?><tr>
                                <td valign="top" style=" border-left: 2px solid #4e80bc; font-size:12px; float:left; letter-spacing: 1px; text-align:center; color:#ffffff;">1</td>
                                <td valign="top" style=" border-left: 2px solid #4e80bc; font-size:12px; float:left; letter-spacing: 1px; text-align:left; color:#ffffff;">TERMINAL</td>
                                <td valign="top" style=" border-left: 2px solid #4e80bc; font-size:12px; float:left; letter-spacing: 1px; text-align:left; color:#ffffff;">USD</td>
                                <td valign="top" style=" border-left: 2px solid #4e80bc; font-size:12px; float:left; letter-spacing: 1px; text-align:right; color:#ffffff;">5.00</td>
                                <td  valign="top" style=" border-left: 2px solid #4e80bc; font-size:12px; float:left; letter-spacing: 1px; text-align:right; color:#ffffff;">1.642</td>
                                <td  valign="top" style=" border-left: 2px solid #4e80bc; font-size:12px; float:left; letter-spacing: 1px; text-align:right; color:#ffffff;">8.21</td>
                                <td  valign="top" style="border-left: 2px solid #4e80bc; font-size:12px; float:left; letter-spacing: 1px; text-align:right; color:#ffffff;border-right: 2px solid #4e80bc;">64.500000</td>
                            </tr><?php */?> 
                       <?php //}
                        //} ?>
                        <?php /*?><tr>
                            <td valign="top" style="border-bottom: 2px solid #4e80bc; border-left: 2px solid #4e80bc; font-size:12px; float:left; letter-spacing: 1px; text-align:center; color:#ffffff;">1</td>
                            <td valign="top" style="border-bottom: 2px solid #4e80bc; border-left: 2px solid #4e80bc; font-size:12px; float:left; letter-spacing: 1px; text-align:left; color:#ffffff;">TERMINAL</td>
                            <td valign="top" style="border-bottom: 2px solid #4e80bc; border-left: 2px solid #4e80bc; font-size:12px; float:left; letter-spacing: 1px; text-align:left; color:#ffffff;">USD</td>
                            <td valign="top" style="border-bottom: 2px solid #4e80bc; border-left: 2px solid #4e80bc; font-size:12px; float:left; letter-spacing: 1px; text-align:right; color:#ffffff;">5.00</td>
                            <td  valign="top" style="border-bottom: 2px solid #4e80bc; border-left: 2px solid #4e80bc; font-size:12px; float:left; letter-spacing: 1px; text-align:right; color:#ffffff;">1.642</td>
                            <td  valign="top" style="border-bottom: 2px solid #4e80bc; border-left: 2px solid #4e80bc; font-size:12px; float:left; letter-spacing: 1px; text-align:right; color:#ffffff;">8.21</td>
                            <td  valign="top" style="border-bottom: 2px solid #4e80bc; border-left: 2px solid #4e80bc;border-right: 2px solid #4e80bc; font-size:12px; float:left; letter-spacing: 1px; text-align:right; color:#ffffff;">64.500000</td>
                        </tr><?php */?>
                   
                    <?php /*?><tr>
                        <td colspan="3" style="border-right:2px solid #4e80bc;border-left:2px solid #4e80bc;border-bottom:2px solid #4e80bc;font-family: 'Tahoma';font-size:14px; text-align:left;"><?php echo $inv['sq_grd_ttl_words'] ?></td>
                        <td colspan="2" style="border-right:2px solid #4e80bc;border-left:2px solid #4e80bc;border-bottom:2px solid #4e80bc;font-family: 'Tahoma';font-size:14px; text-align:right;"><strong>TOTAL</strong></td>
                        <td style="border-right:2px solid #4e80bc;border-left:2px solid #4e80bc;border-bottom:2px solid #4e80bc;font-family: 'Tahoma';font-size:14px; text-align:right;"><strong><?php echo number_format($inv['sq_sub_ttl'], 2, '.', ''); $ttf = 0; $ttf = $ttf + $inv['sq_sub_ttl']; ?></strong></td>
                        <td style="border-right:2px solid #4e80bc;border-left:2px solid #4e80bc;border-bottom:2px solid #4e80bc;"></td>
                    </tr><?php */?>
                      <tr>
                        <td colspan="6" style="height:15px;border-left:2px solid #4e80bc;border-bottom:2px solid #4e80bc;"></td>
                        <td colspan="1" style="height:15px;border-right:2px solid #4e80bc;border-bottom:2px solid #4e80bc;"></td>
                    </tr>
                    <tr>
                        <td colspan="6" style="text-align:top; font-size:12px;font-family:'Tahoma'; padding-top: 6px; padding-right: 1%; padding-left: 1%;border-left:2px solid #4e80bc;">
                            <strong style="text-transform: uppercase;">Terms & Conditions:</strong>
                        </td>
                        <td colspan="1" style="height:15px;border-right:2px solid #4e80bc;"></td>
                    </tr>
                    <tr>
                        <td valign="top" colspan="6" rowspan="<?php echo $rowspan; ?>" style="text-align:top; font-size:11.8px;font-family: 'Tahoma'; padding-right: 1%; padding-left: 1%;border-bottom:2px solid #4e80bc;border-left:2px solid #4e80bc;">
                            <?php echo nl2br($inv['sales_enq_desc']); ?>
                        </td>
                        <td colspan="1" style="height:15px;border-bottom:2px solid #4e80bc;border-right:2px solid #4e80bc;"></td>
                     <tr>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td valign="top" colspan="2" style="width:100%;border-collapse:collapse; margin:0; padding-top:10px;">
                <table style="width:100%;border-collapse:collapse; margin:0; padding:0;">
                    <tr>
                        <td valign="top" style="text-align:left; border:2px solid #4e80bc; font-size:12.5px;font-family: 'Tahoma'; height: 70px; width: 38%; padding-right: 1%; padding-left: 1%; padding-top: 1%; padding-bottom: 1%; ">
                            <strong style="text-transform: uppercase;">GST TIN : 12312312312</strong>
                        </td>
                        <td valign="top" style="text-align:left; border:2px solid #4e80bc; font-size:11.9px;font-family: 'Tahoma'; height: 70px; width: 37%; padding-right: 1%; padding-left: 1%; padding-top: 1%; padding-bottom: 1%; ">
                          
                            <strong>CST TIN : AAAAPPPAPAP</strong><br/>
                        </td>
                        <td valign="top" style="border:2px solid #4e80bc; font-size:13.5px;font-family: 'Tahoma'; height: 70px; width: 50%; padding-right: 1%;  padding-top: 1%; padding-bottom: 1%; text-align:LEFT;">
                               <strong>FOR MYKO ELECTRONICS PVT.LTD.</strong><br/><br/><br/>
                            <strong>Auth. Signatory</strong>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
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
        <tr>
            <td valign="top" colspan="2" style="width:100%;border-collapse:collapse; margin:0; padding-top:1px; padding-left: 0px; padding-right: 0px; ">
                <table style="width:100%;border-collapse:collapse; margin:0; padding:0;">
                    <tr>
                        <td valign="top" style="text-align:left; font-size:10px;font-family: 'Tahoma'; width: 98%; padding-right: 1%; padding-left: 1%; ">
                        <p><strong>Mumbai Office :</strong>Unit No.207,Bldg A-1,Solaris Industries Estate,Opp. L&T gate-6, Saki Vihar Road Mumbai-400072.</p>
                         <p><strong> E-Mail :</strong>admin@mykoelectronic.com</p>
                        </td>
                    </tr>
                    <tr>
                        <td valign="top" style="padding-top:5px;text-align:left; font-size:9.5px;font-family: 'Tahoma'; width: 98%; padding-right: 1%; padding-left: 1%; text-align:center; ">
                        <p>THIS IS A COMPUTER GENERATED DOCUMENT AND DOES NOT REQUIRE A SIGNATURE.</p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</div>
</div>
  </body>
</html>