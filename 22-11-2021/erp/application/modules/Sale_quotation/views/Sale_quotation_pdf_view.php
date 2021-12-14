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
    @page {
    @top-left {
        background-color: #FFF;
    }
    @top-center {
        background-color: #FFF;
    }
    @top-right {
        background-color: #FFF;
    }
}
</style>
</head>
<body>
<?php /* <div style="position:absolute; top:85px; right:10px; z-index:3;  "><img height="270" src="<?php echo base_url(); ?>assets/custom/images/aavad_side_line.png" /></div> */ ?>
<div class="page">
<div style="width:98%; margin:0 auto;font-family: 'Arial Black', Gadget, sans-serif; ">
    <table style="width:100%;border-collapse:collapse; position:relative; z-index:9999;">
        <tr nobr="true">
            <td colspan="2" style="width:98%; color:#1254A0; padding-top: 10px; padding-bottom:0.3cm; text-align:center;font-size:17px; text-transform: uppercase; font-weight:bold; letter-spacing: 1px;">Quotation</td>
        </tr>
        <tr>
            
            <td valign="top" style="width:6cm;border-top:1px solid #1254A0; border-left:1px solid #1254A0;border-bottom:1px solid #1254A0;border-right:1px solid #1254A0; padding-top:0.2cm; padding-bottom:0.2cm; padding-left:0.1cm; padding-right:0.1cm;">
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
                        <?php /* ?><tr>
                            <td valign="top" style="width:70px; font-size:11px; float:left; letter-spacing: 1px; text-align:left; padding-top:5px;"><strong>City</strong><span style="text-align:right !important;"></span></td>
                            <td valign="top" style="padding-top:5px; width:10px; font-size:11px; float:left; letter-spacing: 1px; text-align:center;">:</td>
                            <td valign="top" style="padding-top:5px; width:200px; font-size:11px; float:left; letter-spacing: 1px; text-align:left;"><?php echo isset($inv['city_name']) ? nl2br($inv['city_name']) : '' ; ?></td>
                        </tr>
                        <tr>
                            <td valign="top" style="width:70px; font-size:11px; float:left; letter-spacing: 1px; text-align:left; padding-top:5px;"><strong>State</strong><span style="text-align:right !important;"></span></td>
                            <td valign="top" style="padding-top:5px; width:10px; font-size:11px; float:left; letter-spacing: 1px; text-align:center;">:</td>
                            <td valign="top" style="padding-top:5px; width:200px; font-size:11px; float:left; letter-spacing: 1px; text-align:left;"><?php echo isset($inv['state_name']) ? nl2br($inv['state_name']) : '' ; ?></td>
                        </tr> */ ?>
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
            <td valign="top" style="width:6cm;border-top:1px solid #1254A0; border-left:1px solid #1254A0;border-bottom:1px solid #1254A0;border-right:1px solid #1254A0; padding-top:0.2cm; padding-bottom:0.2cm; padding-left:0.1cm; padding-right:0.1cm;">
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
                        <tr>
                            <td valign="top" style="width:90px; font-size:11px; float:left; letter-spacing: 1px; text-align:left; padding-top:5px;"><strong>Inq Reference No.</strong><span style="text-align:right !important;"></span></td>
                            <td valign="top" style="padding-top:5px; width:10px; font-size:11px; float:left; letter-spacing: 1px; text-align:center;">:</td>
                            <td valign="top" style="padding-top:5px; width:200px; font-size:11px; float:left; letter-spacing: 1px; text-align:left;"><?php echo $inv['sa_inq_ref_no']; ?></td>
                        </tr>
                        <tr>
                            <td valign="top" style="width:90px; font-size:11px; float:left; letter-spacing: 1px; text-align:left; padding-top:5px;"><strong>Inq Reference Date.</strong><span style="text-align:right !important;"></span></td>
                            <td valign="top" style="padding-top:5px; width:10px; font-size:11px; float:left; letter-spacing: 1px; text-align:center;">:</td>
                            <td valign="top" style="padding-top:5px; width:200px; font-size:11px; float:left; letter-spacing: 1px; text-align:left;"><?php echo date("d-m-Y", strtotime($inv['sa_inq_ref_date'])); ?></td>
                        </tr>
                        </table>
                </div>
            </td>
        </tr>
          <tr>
            <td valign="top" colspan="2" style="width:6cm; border-top:1px solid #1254A0; border-left:1px solid #1254A0; border-right:1px solid #1254A0; border-bottom:1px solid #1254A0; padding-top:0.2cm; padding-bottom:0.2cm; padding-left:0.1cm; padding-right:0.1cm;">
                <table style="width:100%;border-collapse:collapse;">
                    <tr>
                            <td valign="top" style="width:50px; font-size:11px; float:left; letter-spacing: 1px; text-align:left; padding-top:5px;"><strong>Kind attn</strong><span style="text-align:right !important;"></span></td>
                            <td valign="top" style="padding-top:5px; width:10px; font-size:11px; float:left; letter-spacing: 1px; text-align:center;">:</td>
                            <td valign="top" style="padding-top:5px; width:520px; font-size:11px; float:left; letter-spacing: 1px; text-align:left;"><?php if(isset($inv['sa_con_person']) && $inv['sa_con_person']!=''){echo $inv['sa_con_person'];}else{echo '';} ?></td>
                    </tr>
                    <tr>
                            <td valign="top" style="width:50px; font-size:11px; float:left; letter-spacing: 1px; text-align:left; padding-top:5px;"><strong> Subject</strong><span style="text-align:right !important;"></span></td>
                            <td valign="top" style="padding-top:5px; width:10px; font-size:11px; float:left; letter-spacing: 1px; text-align:center;">:</td>
                            <td valign="top" style="padding-top:5px; width:520px; font-size:11px; float:left; letter-spacing: 1px; text-align:left;"><?php if(isset($inv['sale_quotation_sub']) && $inv['sale_quotation_sub']!=''){echo $inv['sale_quotation_sub'];}else{echo '';} ?></td>
                    </tr>        
                </table>

            </td>
        </tr>
        
       </table>
    <table border="0" style="width:18cm; border-collapse:collapse; margin:0; padding:0; border-left:1px solid #1254A0;border-right:1px solid #1254A0; border-bottom:1px solid #1254A0;" autosize="0">
                 
                    <tr>
                        <td valign="middle" height="25" style="width: 1cm;border-left: 1px solid #1254A0; font-size:14px; letter-spacing: 1px; text-align:center; font-weight:bold;border-bottom:1px solid #1254A0;background-color:#1254A0; color:#FFF;">Sr.No</td>
                        <td colspan="3" height="25" valign="middle" style="width: 10cm;border-left: 1px solid #1254A0; font-size:14px; float:left; letter-spacing: 1px; text-align:center; font-weight:bold;border-bottom:1px solid #1254A0;background-color:#1254A0; color:#FFF;">Item Description</td>

                        
                        <td colspan="1" height="25" valign="middle" style="width: 1cm;border-left: 1px solid #1254A0; font-size:14px; float:left; letter-spacing: 1px; text-align:center; font-weight:bold;border-bottom:1px solid #1254A0;background-color:#1254A0; color:#FFF;">Qty</td>

                        <td  valign="middle" height="25" style="width:1cm; border-left: 1px solid #1254A0; font-size:14px; float:left; letter-spacing: 1px; text-align:center; font-weight:bold;border-bottom:1px solid #1254A0;background-color:#1254A0; color:#FFF;">PRICE</td>
                        <td  valign="middle" height="25" style="width: 2cm; border-left: 1px solid #1254A0; font-size:14px; float:left; letter-spacing: 1px; text-align:center; font-weight:bold;border-bottom:1px solid #1254A0;background-color:#1254A0; color:#FFF;">Total</td>


                        <?php if(isset($inv['sa_isdiscount']) && !empty($inv['sa_isdiscount']) && $inv['sa_isdiscount'] == 1) { ?>
                        <td  valign="middle" height="25" style="width: 1cm; border-left: 1px solid #1254A0; font-size:14px; float:left; letter-spacing: 1px; text-align:center; font-weight:bold;border-bottom:1px solid #1254A0;background-color:#1254A0; color:#FFF;">Dsc%</td>
                        <?php } ?>
                        <?php if(isset($inv['sa_isdiscount']) && !empty($inv['sa_isdiscount']) && $inv['sa_isdiscount'] == 2) { ?>
                        <td  colspan="2" height="25" valign="middle" style="width: 1cm; border-left: 1px solid #1254A0; border-right: 1px solid #1254A0; font-size:14px; float:left; letter-spacing: 1px; text-align:center; font-weight:bold;border-bottom:1px solid #1254A0;background-color:#1254A0; color:#FFF;"> Final Total</td>
                        <td valign="middle" height="25" style="width: 2cm;border-left: 1px solid #1254A0; border-right: 1px solid #1254A0; font-size:14px; float:left; letter-spacing: 1px; text-align:center; font-weight:bold;border-bottom:1px solid #1254A0;background-color:#1254A0; color:#FFF;"> DILIVERY  TIME</td>
                         <?php } else { ?> 
                        <td valign="middle" height="25" style="width: 2cm;border-left: 1px solid #1254A0; border-right: 1px solid #1254A0; font-size:14px; float:left; letter-spacing: 1px; text-align:center; font-weight:bold;border-bottom:1px solid #1254A0;background-color:#1254A0; color:#FFF;"> Final Total</td>
                        <td valign="middle" height="25" style="width: 2cm;border-left: 1px solid #1254A0; border-right: 1px solid #1254A0; font-size:14px; float:left; letter-spacing: 1px; text-align:center; font-weight:bold;border-bottom:1px solid #1254A0;background-color:#1254A0; color:#FFF;"> DILIVERY  TIME</td>
                         <?php } ?>


                    </tr>
<?php //************************** top start *********************************
                    $itm_discount = 0;
					$srno = 0; $finaltotal = 0; foreach ($items as $key => $item) { $srno++; ?>
<?php //******************not in use start *********** ?>
                    <tr>
                        <td valign="top" style="border-left: 1px solid #1254A0;border-top:1px solid #1254A0;"></td>
                        <td valign="top" colspan="3" style="border-left: 1px solid #1254A0;border-top:1px solid #1254A0;"></td>

                        <td valign="top" colspan="1" style="border-left: 1px solid #1254A0;border-top:1px solid #1254A0;"></td>
                        
                        
                        <td valign="top" style="border-left: 1px solid #1254A0;border-right: 1px solid #1254A0;border-top:1px solid #1254A0;"></td>
                        <td valign="top" style="border-left: 1px solid #1254A0;border-top:1px solid #1254A0;"></td>
                        <?php if(isset($inv['sa_isdiscount']) && !empty($inv['sa_isdiscount']) && $inv['sa_isdiscount'] == 1) { ?>
                        <td valign="top" style="border-left: 1px solid #1254A0;border-top:1px solid #1254A0;"></td>
                        <?php } ?>
                        <?php if(isset($inv['sa_isdiscount']) && !empty($inv['sa_isdiscount']) && $inv['sa_isdiscount'] == 2) { ?>
                        <td colspan="2" valign="top" style="border-left: 1px solid #1254A0;border-top:1px solid #1254A0;"></td>
                        <td colspan="2" valign="top" style="border-left: 1px solid #1254A0;border-top:1px solid #1254A0;"></td>
                       
                        <?php } else { ?>
                        <td valign="top" style="border-left: 1px solid #1254A0;border-top:1px solid #1254A0; border-right:1px solid #1254A0;"></td>
                       
                        <td valign="top" style="border-left: 1px solid #1254A0;border-top:1px solid #1254A0; border-right:1px solid #1254A0;"></td>

                        <?php } ?>
                    </tr>
<?php //******************not in use end *********** ?>
                    <tr>
                        <td valign="top" style="border-left: 1px solid #1254A0;font-size:13px; letter-spacing: 1px; text-align:center;"><?php echo $srno; ?></td>
                        <td valign="top" colspan="3" style="border-left: 1px solid #1254A0;font-size:13px; float:left; letter-spacing: 1px; text-align:left;padding-left: 5px;"><?php //echo $item['master_item_name']; ?><?php //echo $item['master_item_part_no']; ?><?php //echo nl2br($item['sai_itm_desc']); ?>
                        <table style="width:18cm;border-collapse:collapse;">
                                <tr>
                                    <td valign="top" style="width:9cm; font-size:13px; float:left; letter-spacing: 1px; text-align:left;"><strong><?php if(isset($item['sai_item_title']) && $item['sai_item_title']!=''){echo wordwrap($item['sai_item_title'], 50, "<br/>\n");} ?></strong>
                                        <br/><strong>HSN CODE:&nbsp;<?php if(isset($item['hsn_hcode']) && $item['hsn_hcode']!=''){echo wordwrap($item['hsn_hcode'], 50, "<br />\n");} ?></strong>
                                        <br><strong>Part NO:&nbsp;<?php if(isset($item['sai_itm']) && $item['sai_itm']!=''){echo wordwrap($item['sai_itm'], 50, "<br />\n");} ?></strong><br><?php if(isset($item['sai_itm_desc']) && $item['sai_itm_desc']!=''){echo ($item['sai_itm_desc']);} ?></td>
                                    <td valign="top" style="padding: 2px; width:3cm; float: left;"> <?php if(isset($item['master_item_img']) && !empty($item['master_item_img'])) { ?><img src="<?php echo base_url(); ?>uploads/master_item_img/<?php echo $item['master_item_img'] ?>" width="100" height="70" alt=""/><?php } ?></td>
                                </tr>
                            </table>
                        </td>

                        
                        <td valign="top" colspan="1" style="width:1cm;border-left: 1px solid #1254A0;font-size:13px; float:left; letter-spacing: 1px; text-align:center;"><?php echo $item['sai_itm_qty']; ?><?php echo $item['master_item_unit_name']; ?></td>

                        <td valign="top" style="width:2cm;border-left: 1px solid #1254A0;font-size:13px; letter-spacing: 1px; text-align:center;"><?php echo number_format($item['sai_itm_price'], 2, '.', '') ?></td>
                        <td valign="top" style="border-left: 1px solid #1254A0;font-size:13px; float:left; letter-spacing: 1px; text-align:center;"><?php $subttl = $item['sai_itm_qty'] * number_format($item['sai_itm_price'], 2, '.', '');
                          echo number_format($subttl, 2, '.', '') ?></td>
                         <?php if(isset($inv['sa_isdiscount']) && !empty($inv['sa_isdiscount']) && $inv['sa_isdiscount'] == 1) { ?>
						<td valign="top" style="border-left: 1px solid #1254A0;font-size:13px; float:left; letter-spacing: 1px; text-align:center;"><?php echo number_format($item['sai_itm_discount']); ?></td>
                        <?php } ?>
                        <?php if(isset($inv['sa_isdiscount']) && !empty($inv['sa_isdiscount']) && $inv['sa_isdiscount'] == 2) { ?>
                        <td colspan="2" valign="top" style="border-left: 1px solid #1254A0;border-right: 1px solid #1254A0;font-size:13px; letter-spacing: 1px; text-align:right;"><?php $subtotal =  ($subttl - (($subttl*$item['sai_itm_discount'])/100));
                        echo number_format($subtotal);
                         $finaltotal = $finaltotal + number_format($subtotal, 2, '.', ''); ?></td>
                         <td colspan="2" valign="top" style="border-left: 1px solid #1254A0;border-right: 1px solid #1254A0;font-size:13px; letter-spacing: 1px; text-align:right;"><?php echo $item['sai_itm_diliverytime']; ?></td>
                        <?php } else { ?>
                        <td valign="top" style="border-left: 1px solid #1254A0;border-right: 1px solid #1254A0;font-size:13px; letter-spacing: 1px; text-align:right;"><?php $subtotal =  ($subttl - (($subttl*$item['sai_itm_discount'])/100));
                        echo number_format($subtotal, 2, '.', '');
                         $finaltotal = $finaltotal + number_format($subtotal, 2, '.', ''); ?></td>
                         <td valign="top" style="border-left: 1px solid #1254A0;border-right: 1px solid #1254A0;font-size:13px; letter-spacing: 1px; text-align:right;"><?php echo $item['sai_itm_diliverytime']; ?></td>
                        <?php $itm_discount = $itm_discount + $item['sai_itm_discount']; ?>
                        <?php } ?>                            
                    </tr>
                    <?php /*?><?php foreach($item['taxar'] as $taxd)
					{ ?>
                   
					<?php }?><?php */?>
<?php //******************not in use start *********** ?>
                    <tr>
                        <td style="border-left: 1px solid #1254A0;border-bottom:1px solid #1254A0;"></td>
                        <td colspan="3" style="border-left: 1px solid #1254A0;border-bottom:1px solid #1254A0;"></td>

                        
                        <td colspan="1" style="border-left: 1px solid #1254A0;border-bottom:1px solid #1254A0;"></td>

                        <td style="border-left: 1px solid #1254A0;border-bottom:1px solid #1254A0;"></td>
                        <td style="border-left: 1px solid #1254A0;border-bottom:1px solid #1254A0;"></td>
                        <?php if(isset($inv['sa_isdiscount']) && !empty($inv['sa_isdiscount']) && $inv['sa_isdiscount'] == 1) { ?>
                        <td style="border-left: 1px solid #1254A0;border-bottom:1px solid #1254A0;"></td>
                        <?php } ?>
                        <?php if(isset($inv['sa_isdiscount']) && !empty($inv['sa_isdiscount']) && $inv['sa_isdiscount'] == 2) { ?>
                        <td colspan="2"  style="border-left: 1px solid #1254A0;border-right: 1px solid #1254A0;border-bottom:1px solid #1254A0;"></td>
                        <td colspan="2"  style="border-left: 1px solid #1254A0;border-right: 1px solid #1254A0;border-bottom:1px solid #1254A0;"></td>
                        <td colspan="2"  style="border-left: 1px solid #1254A0;border-right: 1px solid #1254A0;border-bottom:1px solid #1254A0;"></td>
                        <?php } else { ?>
                        <td style="border-left: 1px solid #1254A0;border-right: 1px solid #1254A0;border-bottom:1px solid #1254A0;"></td>
                        <?php /* ?><td style="border-left: 1px solid #1254A0;border-right: 1px solid #1254A0;border-bottom:1px solid #1254A0;"></td><?php */ ?>
                        <td style="border-left: 1px solid #1254A0;border-right: 1px solid #1254A0;border-bottom:1px solid #1254A0;"></td>
                        <?php } ?>
                    </tr>
<?php //******************not in use end *********** ?>
                    <?php } //************************** top stop**************  ?>
<?php //***************************************** BOM start ********************** ?>
                   <tr>
                        <td colspan="5" height="25" style="border-bottom: 1px solid #1254A0;border-top:1px solid #1254A0;border-right:1px solid #1254A0;border-left:1px solid #1254A0;font-family: 'Arial Black', Gadget, sans-serif;font-size:14px; text-align:left;"><?php //echo $inv['sa_grd_ttl_words'] ?></td>
                        <td colspan="3" height="25" style="border-top:1px solid #1254A0;border-right:1px solid #FFF;border-left:1px solid #FFF;border-bottom:1px solid #1254A0;font-family: 'Arial Black', Gadget, sans-serif;font-size:14px; text-align:right;background-color:#1254A0; color:#FFF;"><strong>GRAND TOTAL:</strong></td>


                        <td colspan="1" height="25" style="border-top:1px solid #1254A0;border-right:1px solid #FFF;border-left:1px solid #FFF;border-bottom:1px solid #1254A0;font-family: 'Arial Black', Gadget, sans-serif;font-size:14px; text-align:right;background-color:#1254A0; color:#FFF;"><strong><?php echo number_format($finaltotal, 2, '.', ''); ?></strong></td>
                        <td colspan="2" height="25" style="border-top:1px solid #1254A0;border-right:1px solid #FFF;border-left:1px solid #FFF;border-bottom:1px solid #1254A0;font-family: 'Arial Black', Gadget, sans-serif;font-size:14px; text-align:right;background-color:#1254A0; color:#FFF;"></td>


                        <?php /*?><td style="border-right:1px solid #1254A0;border-left:1px solid #1254A0;border-bottom:1px solid #1254A0;"></td><?php */?>
                    </tr>
                    <?php if(isset($inv['sa_isdiscount']) && !empty($inv['sa_isdiscount']) && $inv['sa_isdiscount'] == 1) { ?>
                    
                    <?php  $disc = $finaltotal - (($itm_discount * $finaltotal)/100); } else { $disc = $finaltotal; } ?>
        </table>
        <table style="width:100%;border-collapse:collapse; margin:0; padding:0;">
        
                    <tr>
                        <td valign="top" style="text-align:left; border-left:1px solid #1254A0; border-top:1px solid #1254A0; border-right:1px solid #1254A0;border-bottom:1px solid #1254A0; font-size:12px;font-family: 'Tahoma'; height: 25px; width: 65%; padding-right: 1%; padding-left: 1%; padding-top: 1%; padding-bottom: 1%; ">
                           
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
                            <td valign="top" style=" width:5px; font-size:10px; float:left; letter-spacing: 1px; text-align:left;"><strong>PACKAGING & FORWARDING</strong><span style="text-align:right !important;"></span></td>
                            <td valign="top" style=" width:10px; font-size:10px; float:left; letter-spacing: 1px; text-align:center;">:</td>
                            <td valign="top" style=" width:300px; font-size:10px; float:left; letter-spacing: 1px; text-align:left;"><?php echo nl2br($inv['sa_tc_pf']); ?></td>
                        </tr>
                       <tr>
                            <td valign="top" style="width:5px; font-size:10px; float:left; letter-spacing: 1px; text-align:left; padding-top:5px;"><strong>GST</strong><span style="text-align:right !important;"></span></td>
                            <td valign="top" style="padding-top:5px; width:10px; font-size:10px; float:left; letter-spacing: 1px; text-align:center;">:</td>
                            <td valign="top" style="padding-top:5px; width:300px; font-size:10px; float:left; letter-spacing: 1px; text-align:left;"><?php echo nl2br($inv['sa_tc_gst']); ?></td>
                        </tr>
                         <tr>
                            <td valign="top" style="width:5px; font-size:10px; float:left; letter-spacing: 1px; text-align:left; padding-top:5px;"><strong>FREIGHT</strong><span style="text-align:right !important;"></span></td>
                            <td valign="top" style="padding-top:5px; width:10px; font-size:10px; float:left; letter-spacing: 1px; text-align:center;">:</td>
                            <td valign="top" style="padding-top:5px; width:300px; font-size:10px; float:left; letter-spacing: 1px; text-align:left;"><?php echo nl2br($inv['sa_tc_frght']); ?></td>
                        </tr>
                         <tr>
                            <td valign="top" style="width:5px; font-size:10px; float:left; letter-spacing: 1px; text-align:left; padding-top:5px;"><strong>INSURANCE</strong><span style="text-align:right !important;"></span></td>
                            <td valign="top" style="padding-top:5px; width:10px; font-size:10px; float:left; letter-spacing: 1px; text-align:center;">:</td>
                            <td valign="top" style="padding-top:5px; width:300px; font-size:10px; float:left; letter-spacing: 1px; text-align:left;"><?php echo nl2br($inv['sa_tc_insu']); ?></td>
                        </tr>
                        <tr>
                            <td valign="top" style="width:5px; font-size:10px; float:left; letter-spacing: 1px; text-align:left; padding-top:5px;"><strong>INSPECTION</strong><span style="text-align:right !important;"></span></td>
                            <td valign="top" style="padding-top:5px; width:10px; font-size:10px; float:left; letter-spacing: 1px; text-align:center;">:</td>
                            <td valign="top" style="padding-top:5px; width:300px; font-size:10px; float:left; letter-spacing: 1px; text-align:left;"><?php echo nl2br($inv['sa_tc_inspection']); ?></td>
                        </tr>
                        
                       
                        <tr>
                            <td valign="top" style="width:5px; font-size:10px; float:left; letter-spacing: 1px; text-align:left; padding-top:5px;"><strong>PAYMENT TERMS</strong><span style="text-align:right !important;"></span></td>
                            <td valign="top" style="padding-top:5px; width:10px; font-size:10px; float:left; letter-spacing: 1px; text-align:center;">:</td>
                            <td valign="top" style="padding-top:5px; width:300px; font-size:10px; float:left; letter-spacing: 1px; text-align:left;"><?php echo nl2br($inv['sa_tc_paynt']); ?></td>
                        </tr>
                        <tr>
                            <td valign="top" style="width:5px; font-size:10px; float:left; letter-spacing: 1px; text-align:left; padding-top:5px;"><strong>VALIDITY</strong><span style="text-align:right !important;"></span></td>
                            <td valign="top" style="padding-top:5px; width:10px; font-size:10px; float:left; letter-spacing: 1px; text-align:center;">:</td>
                            <td valign="top" style="padding-top:5px; width:300px; font-size:10px; float:left; letter-spacing: 1px; text-align:left;"><?php echo nl2br($inv['sa_tc_ovali']); ?></td>
                        </tr>

                        <tr>
                            <td valign="top" style="width:5px; font-size:10px; float:left; letter-spacing: 1px; text-align:left; padding-top:5px;"><strong>WARRANTY</strong><span style="text-align:right !important;"></span></td>
                            <td valign="top" style="padding-top:5px; width:10px; font-size:10px; float:left; letter-spacing: 1px; text-align:center;">:</td>
                            <td valign="top" style="padding-top:5px; width:300px; font-size:10px; float:left; letter-spacing: 1px; text-align:left;"><?php echo nl2br($inv['sa_tc_wrnty']); ?></td>
                        </tr>
                       
                        <tr>
                            <td valign="top" style="width:5px; font-size:10px; float:left; letter-spacing: 1px; text-align:left; padding-top:5px;"><strong>JURISDICTION</strong><span style="text-align:right !important;"></span></td>
                            <td valign="top" style="padding-top:5px; width:10px; font-size:10px; float:left; letter-spacing: 1px; text-align:center;">:</td>
                            <td valign="top" style="padding-top:5px; width:300px; font-size:10px; float:left; letter-spacing: 1px; text-align:left;"><?php echo nl2br($inv['sa_tc_jurisdiction']); ?></td>
                        </tr>
                        <tr>
                            <td valign="top" style="width:5px; font-size:10px; float:left; letter-spacing: 1px; text-align:left; padding-top:5px;"><strong>COMMISSIONING &  FIELD SERVICES CHARGES</strong><span style="text-align:right !important;"></span></td>
                            <td valign="top" style="padding-top:5px; width:10px; font-size:10px; float:left; letter-spacing: 1px; text-align:center;">:</td>
                            <td valign="top" style="padding-top:5px; width:300px; font-size:10px; float:left; letter-spacing: 1px; text-align:left;"><?php echo nl2br($inv['sa_tc_cfsc']); ?></td>
                        </tr>
                         <tr>
                            <td valign="top" style="width:5px; font-size:10px; float:left; letter-spacing: 1px; text-align:left; padding-top:5px;"><br/><br/>
With regards <br/><strong><?php echo $inv['au_fname']." ".$inv['au_lname']; ?></strong>
<br/><strong><?php echo $inv['au_mo_no']; ?></strong><br/><strong><?php echo $inv['au_email']; ?></strong><span style="text-align:right !important;"></span></td>
                             
                        </tr>

                       
                         
                        </table>
                </div>

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