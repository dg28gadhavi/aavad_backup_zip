<?php //echo '<pre>'; print_r($inv);die;
//echo '<pre>'; print_r($items);die;
//echo '<pre>'; print_r($follow);die;
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
            <td colspan="2" style="width:98%; float:left;"><img src="<?php echo base_url(); ?>assets/custom/images/miconindia-header-new.jpg"/></td>
        </tr>
    </table>
    <table style="width:100%;border-collapse:collapse;">
        <tr nobr="true">
            <td colspan="2" style="width:98%; color:#e41f26; padding-top: 10px; padding-bottom:0.3cm; text-align:center;font-size:17px; text-transform: uppercase; font-weight:bold; letter-spacing: 1px;">Enquiry</td>
        </tr>
        <tr>
            
             <td valign="top" style="width:7cm;border-top:1px solid #e41f26; border-left:1px solid #e41f26;border-bottom:1px solid #e41f26;border-right:1px solid #e41f26; padding-top:0.2cm; padding-bottom:0.2cm; padding-left:0.1cm; padding-right:0.1cm;">
                <div style="width:98%; margin-top:0;">
                    <!-- <div style="width:100%; font-size:11px; float:left; letter-spacing: 1px;"> <span style="font-weight:bold;">Invoice No</span> : PI NV111310 </div> -->
                    <table style="width:100%;border-collapse:collapse;">
                        <tr>
                            <td valign="top" style=" width:25%; font-size:11px; float:left; letter-spacing: 1px; text-align:left;"><strong>M/s.</strong><span style="text-align:right !important;"></span></td>
                            <td valign="top" style=" width:5%; font-size:11px; float:left; letter-spacing: 1px; text-align:center;">:</td>
                            <td valign="top" style=" width:45.5%; font-size:11px; float:left; letter-spacing: 1px; text-align:left;"><?php if(isset($inv['vendor']) && $inv['vendor']!=''){echo $inv['vendor'];}else{echo '';} ?></td>
                        </tr>
                        <tr>
                            <td valign="top" style="width:25%; font-size:11px; float:left; letter-spacing: 1px; text-align:left; padding-top:5px;"><strong>Address</strong><span style="text-align:right !important;"></span></td>
                            <td valign="top" style="padding-top:5px; width:5%; font-size:11px; float:left; letter-spacing: 1px; text-align:center;">:</td>
                            <td valign="top" style="padding-top:5px; width:45.5%; font-size:11px; float:left; letter-spacing: 1px; text-align:left;"><?php if(isset($inv['sq_address']) && $inv['sq_address']!=''){echo $inv['sq_address'];}else{echo '';} ?></td>
                        </tr>
                        <tr>
                            <td valign="top" style="width:25%; font-size:11px; float:left; letter-spacing: 1px; text-align:left; padding-top:5px;"><strong>City</strong><span style="text-align:right !important;"></span></td>
                            <td valign="top" style="padding-top:5px; width:5%; font-size:11px; float:left; letter-spacing: 1px; text-align:center;">:</td>
                            <td valign="top" style="padding-top:5px; width:45.5%; font-size:11px; float:left; letter-spacing: 1px; text-align:left;"><?php if(isset($inv['city_name']) && $inv['city_name']!=''){echo $inv['city_name'];}else{echo '';} ?></td>
                        </tr>
                        <tr>
                            <td valign="top" style="width:25%; font-size:11px; float:left; letter-spacing: 1px; text-align:left; padding-top:5px;"><strong>State</strong><span style="text-align:right !important;"></span></td>
                            <td valign="top" style="padding-top:5px; width:5%; font-size:11px; float:left; letter-spacing: 1px; text-align:center;">:</td>
                            <td valign="top" style="padding-top:5px; width:45.5%; font-size:11px; float:left; letter-spacing: 1px; text-align:left;"><?php if(isset($inv['state_name']) && $inv['state_name']!=''){echo $inv['state_name'];}else{echo '';} ?></td>
                        </tr>
                        <tr>
                            <td valign="top" style="width:25%; font-size:11px; float:left; letter-spacing: 1px; text-align:left; padding-top:5px;"><strong>Phone</strong><span style="text-align:right !important;"></span></td>
                            <td valign="top" style="padding-top:5px; width:5%; font-size:11px; float:left; letter-spacing: 1px; text-align:center;">:</td>
                            <td valign="top" style="padding-top:5px; width:45.5%; font-size:11px; float:left; letter-spacing: 1px; text-align:left;"><?php if(isset($inv['sq_phone']) && $inv['sq_phone']!=''){echo $inv['sq_phone'];}else{echo '';} ?></td>
                        </tr>
                        <tr>
                            <td valign="top" style="width:25%; font-size:11px; float:left; letter-spacing: 1px; text-align:left; padding-top:5px;"><strong>Mobile</strong><span style="text-align:right !important;"></span></td>
                            <td valign="top" style="padding-top:5px; width:5%; font-size:11px; float:left; letter-spacing: 1px; text-align:center;">:</td>
                            <td valign="top" style="padding-top:5px; width:45.5%; font-size:11px; float:left; letter-spacing: 1px; text-align:left;"><?php if(isset($inv['sq_mobile']) && $inv['sq_mobile']!=''){echo $inv['sq_mobile'];}else{echo '';} ?></td>
                        </tr>
                        <tr>
                            <td valign="top" style="width:25%; font-size:11px; float:left; letter-spacing: 1px; text-align:left; padding-top:5px;"><strong>Email</strong><span style="text-align:right !important;"></span></td>
                            <td valign="top" style="padding-top:5px; width:5%; font-size:11px; float:left; letter-spacing: 1px; text-align:center;">:</td>
                            <td valign="top" style="padding-top:5px; width:45.5%; font-size:11px; float:left; letter-spacing: 1px; text-align:left;"><?php if(isset($inv['sq_email']) && $inv['sq_email']!=''){echo $inv['sq_email'];}else{echo '';} ?></td>
                        </tr>
                         <tr>
                            <td valign="top" style="width:25%; font-size:11px; float:left; letter-spacing: 1px; text-align:left; padding-top:5px;"><strong>Mode of Inquiry</strong><span style="text-align:right !important;"></span></td>
                            <td valign="top" style="padding-top:5px; width:5%; font-size:11px; float:left; letter-spacing: 1px; text-align:center;">:</td>
                            <td valign="top" style="padding-top:5px; width:45.5%; font-size:11px; float:left; letter-spacing: 1px; text-align:left;"><?php if(isset($inv['mode_inquiry_name']) && $inv['mode_inquiry_name']!=''){echo $inv['mode_inquiry_name'];}else{echo '';} ?></td>
                        </tr>
                         <tr>
                            <td valign="top" style="width:25%; font-size:11px; float:left; letter-spacing: 1px; text-align:left; padding-top:5px;"><strong>Source category</strong><span style="text-align:right !important;"></span></td>
                            <td valign="top" style="padding-top:5px; width:5%; font-size:11px; float:left; letter-spacing: 1px; text-align:center;">:</td>
                            <td valign="top" style="padding-top:5px; width:45.5%; font-size:11px; float:left; letter-spacing: 1px; text-align:left;"><?php if(isset($inv['source_cat_name']) && $inv['source_cat_name']!=''){echo $inv['source_cat_name'];}else{echo '';} ?></td>
                        </tr>
                        </table>
                </div>
            </td>

            <td valign="top" style="width:5cm;border-top:1px solid #e41f26; border-left:1px solid #e41f26;border-bottom:1px solid #e41f26;border-right:1px solid #e41f26; padding-top:0.2cm; padding-bottom:0.2cm; padding-left:0.1cm; padding-right:0.1cm;">
                <div style="width:98%; margin-top:0;">
                    <!-- <div style="width:100%; font-size:11px; float:left; letter-spacing: 1px;"> <span style="font-weight:bold;">Invoice No</span> : PI NV111310 </div> -->
                    <table style="width:100%;border-collapse:collapse;">
                        <tr>
                            <td valign="top" style=" width:25%; font-size:11px; float:left; letter-spacing: 1px; text-align:left;"><strong>Enquiry No.</strong><span style="text-align:right !important;"></span></td>
                            <td valign="top" style=" width:5%; font-size:11px; float:left; letter-spacing: 1px; text-align:center;">:</td>
                            <td valign="top" style=" width:47.5%; font-size:11px; float:left; letter-spacing: 1px; text-align:left;"><?php if(isset($inv['sq_no']) && $inv['sq_no']!=''){echo $inv['sq_no'];}else{echo '';} ?></td>
                        </tr>
                        <tr>
                            <td valign="top" style="width:25%; font-size:11px; float:left; letter-spacing: 1px; text-align:left; padding-top:5px;"><strong>Date</strong><span style="text-align:right !important;"></span></td>
                            <td valign="top" style="padding-top:5px; width:5%; font-size:11px; float:left; letter-spacing: 1px; text-align:center;">:</td>
                            <td valign="top" style="padding-top:5px; width:47.5%; font-size:11px; float:left; letter-spacing: 1px; text-align:left;"><?php if(isset($inv['sq_enq_date']) && $inv['sq_enq_date']!=''){echo date("d/m/Y", strtotime($inv['sq_enq_date']));}else{echo '';} ?></td>
                        </tr>
                         <tr>
                            <td valign="top" style="width:25%; font-size:11px; float:left; letter-spacing: 1px; text-align:left; padding-top:5px;"><strong>Prepared By</strong><span style="text-align:right !important;"></span></td>
                            <td valign="top" style="padding-top:5px; width:5%; font-size:11px; float:left; letter-spacing: 1px; text-align:center;">:</td>
                            <td valign="top" style="padding-top:5px; width:47.5%; font-size:11px; float:left; letter-spacing: 1px; text-align:left;"><?php echo $inv['au_fname']; ?> <?php echo $inv['au_lname']; ?></td>
                        </tr>
                        <tr>
                            <td valign="top" style="width:25%; font-size:11px; float:left; letter-spacing: 1px; text-align:left; padding-top:5px;"><strong></strong><span style="text-align:right !important;"></span></td>
                            <td valign="top" style="padding-top:5px; width:5%; font-size:11px; float:left; letter-spacing: 1px; text-align:center;"></td>
                            <td valign="top" style="padding-top:5px; width:47.5%; font-size:11px; float:left; letter-spacing: 1px; text-align:left;"><?php echo $inv['au_mo_no']; ?></td>
                        </tr>
                        <tr>
                            <td valign="top" style="width:25%; font-size:11px; float:left; letter-spacing: 1px; text-align:left; padding-top:5px;"><strong></strong><span style="text-align:right !important;"></span></td>
                            <td valign="top" style="padding-top:5px; width:5%; font-size:11px; float:left; letter-spacing: 1px; text-align:center;"></td>
                            <td valign="top" style="padding-top:5px; width:47.5%; font-size:11px; float:left; letter-spacing: 1px; text-align:left;"><?php echo $inv['au_gmail_email']; ?></td>
                        </tr>                        
                        </table>
                </div>
            </td>
        </tr>

        <tr>
            <td valign="top" colspan="2" style="width:6cm;border-top:1px solid #e9494f; border-left:1px solid #e41f26; border-right:1px solid #e41f26; border-bottom:1px solid #e41f26; padding-top:0.2cm; padding-bottom:0.2cm; padding-left:0.1cm; padding-right:0.1cm;">
                <table style="width:100%;border-collapse:collapse;">
                    <tr>
                            <td valign="top" style="width:50px; font-size:11px; float:left; letter-spacing: 1px; text-align:left; padding-top:5px;"><strong>Kind attn</strong><span style="text-align:right !important;"></span></td>
                            <td valign="top" style="padding-top:5px; width:10px; font-size:11px; float:left; letter-spacing: 1px; text-align:center;">:</td>
                            <td valign="top" style="padding-top:5px; width:520px; font-size:11px; float:left; letter-spacing: 1px; text-align:left;"><?php if(isset($inv['sq_con_person']) && $inv['sq_con_person']!=''){echo $inv['sq_con_person'];}else{echo '';} ?></td>
                    </tr>
                    <tr>
                            <td valign="top" style="width:50px; font-size:11px; float:left; letter-spacing: 1px; text-align:left; padding-top:5px;"><strong> Sub</strong><span style="text-align:right !important;"></span></td>
                            <td valign="top" style="padding-top:5px; width:10px; font-size:11px; float:left; letter-spacing: 1px; text-align:center;">:</td>
                            <td valign="top" style="padding-top:5px; width:520px; font-size:11px; float:left; letter-spacing: 1px; text-align:left;"><?php if(isset($inv['sales_enq_sub']) && $inv['sales_enq_sub']!=''){echo $inv['sales_enq_sub'];}else{echo '';} ?></td>
                    </tr>   
                    <tr>
                            <td valign="top" style="width:50px; font-size:11px; float:left; letter-spacing: 1px; text-align:left; padding-top:5px;"><strong> Remark</strong><span style="text-align:right !important;"></span></td>
                            <td valign="top" style="padding-top:5px; width:10px; font-size:11px; float:left; letter-spacing: 1px; text-align:center;">:</td>
                            <td valign="top" style="padding-top:5px; width:520px; font-size:11px; float:left; letter-spacing: 1px; text-align:left;"><?php if(isset($inv['sq_remarks']) && $inv['sq_remarks']!=''){echo $inv['sq_remarks'];}else{echo '';} ?></td>
                    </tr> 
                    <tr>
                            <td valign="top" style="width:50px; font-size:11px; float:left; letter-spacing: 1px; text-align:left; padding-top:5px;"><strong> Product Details</strong><span style="text-align:right !important;"></span></td>
                            <td valign="top" style="padding-top:5px; width:10px; font-size:11px; float:left; letter-spacing: 1px; text-align:center;">:</td>
                            <td valign="top" style="padding-top:5px; width:520px; font-size:11px; float:left; letter-spacing: 1px; text-align:left;"><?php if(isset($inv['sq_prodetails']) && $inv['sq_prodetails']!=''){echo $inv['sq_prodetails'];}else{echo '';} ?></td>
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
        <table style="width: 18cm; border-collapse:collapse;background: #f8f8f8;" autosize="0">
                 
                    <tr>
                        <td valign="middle" height="25" style="width: 1cm;font-size:18px; letter-spacing: 1px; text-align:center; font-weight:bold;background-color:#f7bbbd;border-bottom:1px solid #e41f26;border-left:1px solid #e41f26;">Sr.No</td>
                        <td colspan="2" height="25" valign="middle" style="width: 4cm; border-left: 1px solid #e41f26; font-size:18px; float:left; letter-spacing: 1px; text-align:center; font-weight:bold; background-color:#f7bbbd;border-bottom:1px solid #e41f26;">Item name</td>
                        <td colspan="2" height="25" valign="middle" style="width: 8cm; border-left: 1px solid #e41f26; font-size:18px; float:left; letter-spacing: 1px; text-align:center; font-weight:bold;background-color:#f7bbbd;border-bottom:1px solid #e41f26;">Item Description</td>
                        <td  valign="middle" height="25" style="width: 2cm; border-left: 1px solid #e41f26; font-size:18px; float:left; letter-spacing: 1px; text-align:center; font-weight:bold;border-bottom:1px solid #e41f26;background-color:#f7bbbd;">Qty</td>
                        <td  colspan="2" height="25" valign="middle" style="width: 3cm;border-left: 1px solid #e41f26; font-size:18px; float:left; letter-spacing: 1px; text-align:center; font-weight:bold;background-color:#f7bbbd;border-bottom:1px solid #e41f26;border-right:1px solid #e41f26;">PRICE</td>      
                    </tr>

                   <?php  $itm_discount = 0;
                    $srno = 0; $finaltotal = 0; foreach ($items as $key => $item) { $srno++; ?>

                    <tr>
                        <td valign="top" style="border-left:1px solid #e41f26;border-top:1px solid #e41f26;"></td>
                        <td valign="top" colspan="2" style="border-left: 1px solid #e41f26;border-top:1px solid #e41f26;"></td>
                        <td valign="top" colspan="2" style="border-left: 1px solid #e41f26;border-top:1px solid #e41f26;"></td>
                      	<td valign="top" style="border-left: 1px solid #e41f26;border-top:1px solid #e41f26;"></td>
                       <td valign="top" colspan="2" style="border-left: 1px solid #e41f26;border-top:1px solid #e41f26;border-right:1px solid #e41f26;"></td>

                    </tr>
                    <tr>
                        <td valign="top" style="border-left:1px solid #e41f26;border-bottom:1px solid #e41f26;font-size:18px; letter-spacing: 1px; text-align:center;"><?php echo $srno; ?></td>                   
                        <td valign="top" colspan="2" style="border-left: 1px solid #e41f26;border-bottom:1px solid #e41f26;font-size:18px; float:left; letter-spacing: 1px; text-align:center;"><?php if(isset($item['sqi_itm_pnoname']) && $item['sqi_itm_pnoname']!=''){echo $item['sqi_itm_pnoname'];} ?></td>
                        <td valign="top" colspan="2" style="border-left: 1px solid #e41f26;border-bottom:1px solid #e41f26;font-size:18; letter-spacing: 1px; text-align:center;">
                            <table style="width:100%;border-collapse:collapse;">
                                <tr>
                                    <td valign="top" style="width:14cm; font-size:18px; float:left; letter-spacing: 1px; text-align:left;"><strong><?php if(isset($item['sqi_itm_title']) && $item['sqi_itm_title']!=''){echo $item['sqi_itm_title'];} ?></strong><br><?php if(isset($item['sqi_itm_desc']) && $item['sqi_itm_desc']!=''){echo wordwrap($item['sqi_itm_desc'], 60, "<br />\n");} ?></td>
                                    <td valign="top" style="padding: 5px;font-size:18px; width:4cm;vertical-align: middle; float: left;"><?php if(isset($item['master_item_img']) && !empty($item['master_item_img'])) { ?> <img src="<?php echo base_url(); ?>uploads/master_item_img/<?php echo $item['master_item_img']; ?>" width="100" height="70" alt=""/><?php } ?></td>
                                </tr>
                            </table>

                           </td>
                        <td valign="top" style="border-left: 1px solid #e41f26;border-bottom:1px solid #e41f26;font-size:18px; float:left; letter-spacing: 1px; text-align:center;"><?php if(isset($item['sqi_itm_qty']) && $item['sqi_itm_qty']!=''){echo $item['sqi_itm_qty'];} ?></td>
                        <td valign="top" colspan="2" style="border-left: 1px solid #e41f26;border-bottom:1px solid #e41f26;font-size:18px; float:left; letter-spacing: 1px; text-align:center;border-right:1px solid #e41f26;"><?php if(isset($item['sqi_itm_price']) && $item['sqi_itm_price']!=''){echo number_format($item['sqi_itm_price']);} ?></td>
                     
                     
                        <?php } ?>                            
                    </tr>   
        </table>
        
        <table style="width:100%;border-collapse:collapse;">
                    <tr>
                    <td valign="middle" style="border-left:1px solid #e41f26;border-right:1px solid #e41f26;"></td>
                	</tr>
        </table>

        <table border="0" style="width:18cm; border-collapse:collapse; margin:0; padding:0; background-color:#f8f8f8;" autosize="0">
                 
                    <tr>
                        <td valign="middle" height="25" style="width: 1cm; border-left:1px solid #e41f26;border-top: 1px solid #e41f26; font-size:11px; letter-spacing: 1px; text-align:center; font-weight:bold;background-color:#f7bbbd;border-bottom:1px solid #e41f26;">Sr.No</td>
                        <td colspan="2" height="25" valign="middle" style=" width: 4cm;border-left: 1px solid #e41f26;border-top: 1px solid #e41f26; font-size:11px; float:left; letter-spacing: 1px; text-align:center; font-weight:bold;background-color:#f7bbbd;border-bottom:1px solid #e41f26;">Follow Up Date</td>
                        <td colspan="2" height="25" valign="middle" style="width: 4cm;border-left: 1px solid #e41f26;border-top: 1px solid #e41f26; font-size:11px; float:left; letter-spacing: 1px; text-align:center; font-weight:bold;background-color:#f7bbbd;border-bottom:1px solid #e41f26;">Follow Up Method</td>
                        <td colspan="2" height="25" valign="middle" style="width: 5cm;border-left: 1px solid #e41f26;border-top: 1px solid #e41f26; font-size:11px; float:left; letter-spacing: 1px; text-align:center; font-weight:bold;border-bottom:1px solid #e41f26;background-color:#f7bbbd;">Follow Up By Executive</td>
                        <td  valign="middle" height="25" style="width: 4cm; border-left: 1px solid #e41f26;border-right:1px solid #e41f26; font-size:11px; float:left;border-top: 1px solid #e41f26; letter-spacing: 1px; text-align:center; font-weight:bold;background-color:#f7bbbd;border-bottom:1px solid #e41f26;">Follow Up Status</td>
                    </tr>

                   <?php  $itm_discount = 0;
                    $srno = 0; $finaltotal = 0; foreach ($follow as $key => $fol) { $srno++; ?>

                    <tr>
                        <td valign="top" style="border-left: 1px solid #e41f26;border-top:1px solid #e41f26;"></td>
                        <td valign="top" colspan="2" style="border-left: 1px solid #e41f26;border-top:1px solid #e41f26;"></td>
                        <td valign="top" colspan="2" style="border-left: 1px solid #e41f26;border-top:1px solid #e41f26;"></td>
                      	<td valign="top" colspan="2" style="border-left: 1px solid #e41f26;border-top:1px solid #e41f26;"></td>
                       	<td valign="top"  style="border-left: 1px solid #e41f26;border-top:1px solid #e41f26;border-right: 1px solid #e41f26;"></td>

                    </tr>
                    <tr>
                        <td valign="middle" style="font-size:11px; letter-spacing: 1px;border-bottom: 1px solid #e41f26; text-align:center;border-left: 1px solid #e41f26;"><?php echo $srno; ?></td>
                   
                        <td valign="middle" colspan="2" style="border-left: 1px solid #e41f26;border-bottom: 1px solid #e41f26;font-size:11px; float:left; letter-spacing: 1px; text-align:center;"><?php if(isset($fol['fu_followdate']) && $fol['fu_followdate']!=''){echo $fol['fu_followdate'];} ?></td>
                        <td valign="middle" colspan="2" style="border-left: 1px solid #e41f26;border-bottom: 1px solid #e41f26;font-size:11px; letter-spacing: 1px; text-align:center;"><?php if(isset($fol['fu_method_name']) && $fol['fu_method_name']!=''){echo $fol['fu_method_name'];} ?></td>
                        <td valign="middle" colspan="2" style="border-left: 1px solid #e41f26;border-bottom: 1px solid #e41f26;font-size:11px; float:left; letter-spacing: 1px; text-align:center;"><?php if(isset($fol['au_fname']) && $fol['au_fname']!=''){echo $fol['au_fname'];} ?></td>
                        <td valign="middle" style="border-left: 1px solid #e41f26;border-right: 1px solid #e41f26;border-bottom: 1px solid #e41f26;font-size:11px; float:left; letter-spacing: 1px; text-align:center;"><?php if(isset($fol['inqfus_name']) && $fol['inqfus_name']!=''){echo $fol['inqfus_name'];} ?></td>                     
                     
                        <?php } ?>                            
                    </tr>                                   
        </table>

        <table style="width:100%;border-collapse:collapse; margin:0; padding:0;">
        
                    <tr>
                        <td valign="top" style="text-align:left; border-left:1px solid #e9494f;border-bottom:1px solid #e9494f; font-size:12px; height: 70px; width: 50%; padding-right: 1%; padding-left: 1%; padding-top: 1%; padding-bottom: 1%; ">
                            
                            <div style="width:100%; margin-top:0;">
                    <!-- <div style="width:100%; font-size:11px; float:left; letter-spacing: 1px;"> <span style="font-weight:bold;">Invoice No</span> : PI NV111310 </div> -->
                    <table style="width:100%;border-collapse:collapse;">
                        <tr><strong style="text-transform: uppercase;">Terms & Conditions:</strong></tr>
                        <tr>
                            <td valign="top" style=" width:50px; font-size:11px; float:left; letter-spacing: 1px; text-align:left;"><strong>PRICES</strong><span style="text-align:right !important;"></span></td>
                            <td valign="top" style=" width:10px; font-size:11px; float:left; letter-spacing: 1px; text-align:center;">:</td>
                            <td valign="top" style=" width:200px; font-size:11px; float:left; letter-spacing: 1px; text-align:left;"><?php echo nl2br($inv['sales_enq_tc_price']); ?></td>
                        </tr>
                        <tr>
                            <td valign="top" style="width:50px; font-size:11px; float:left; letter-spacing: 1px; text-align:left; padding-top:5px;"><strong>WARRANTY</strong><span style="text-align:right !important;"></span></td>
                            <td valign="top" style="padding-top:5px; width:10px; font-size:11px; float:left; letter-spacing: 1px; text-align:center;">:</td>
                            <td valign="top" style="padding-top:5px; width:200px; font-size:11px; float:left; letter-spacing: 1px; text-align:left;"><?php echo nl2br($inv['sales_enq_tc_wrnty']); ?></td>
                        </tr>
                        <tr>
                            <td valign="top" style="width:50px; font-size:11px; float:left; letter-spacing: 1px; text-align:left; padding-top:5px;"><strong>P&F</strong><span style="text-align:right !important;"></span></td>
                            <td valign="top" style="padding-top:5px; width:10px; font-size:11px; float:left; letter-spacing: 1px; text-align:center;">:</td>
                            <td valign="top" style="padding-top:5px; width:200px; font-size:11px; float:left; letter-spacing: 1px; text-align:left;"><?php echo nl2br($inv['sales_enq_tc_pf']); ?></td>
                        </tr>
                        <tr>
                            <td valign="top" style="width:50px; font-size:11px; float:left; letter-spacing: 1px; text-align:left; padding-top:5px;"><strong>DELIVERY</strong><span style="text-align:right !important;"></span></td>
                            <td valign="top" style="padding-top:5px; width:10px; font-size:11px; float:left; letter-spacing: 1px; text-align:center;">:</td>
                            <td valign="top" style="padding-top:5px; width:200px; font-size:11px; float:left; letter-spacing: 1px; text-align:left;"><?php echo nl2br($inv['sales_enq_tc_deli']); ?></td>
                        </tr>
                        <tr>
                            <td valign="top" style="width:50px; font-size:11px; float:left; letter-spacing: 1px; text-align:left; padding-top:5px;"><strong>PAYMET</strong><span style="text-align:right !important;"></span></td>
                            <td valign="top" style="padding-top:5px; width:10px; font-size:11px; float:left; letter-spacing: 1px; text-align:center;">:</td>
                            <td valign="top" style="padding-top:5px; width:200px; font-size:11px; float:left; letter-spacing: 1px; text-align:left;"><?php echo nl2br($inv['sales_enq_tc_paynt']); ?></td>
                        </tr>
                        <tr>
                            <td valign="top" style="width:50px; font-size:11px; float:left; letter-spacing: 1px; text-align:left; padding-top:5px;"><strong>OFFER VALIDITY</strong><span style="text-align:right !important;"></span></td>
                            <td valign="top" style="padding-top:5px; width:10px; font-size:11px; float:left; letter-spacing: 1px; text-align:center;">:</td>
                            <td valign="top" style="padding-top:5px; width:200px; font-size:11px; float:left; letter-spacing: 1px; text-align:left;"><?php echo nl2br($inv['sales_enq_tc_ovali']); ?></td>
                        </tr>
                        <tr>
                            <td valign="top" style="width:50px; font-size:11px; float:left; letter-spacing: 1px; text-align:left; padding-top:5px;"><strong>FREIGHT</strong><span style="text-align:right !important;"></span></td>
                            <td valign="top" style="padding-top:5px; width:10px; font-size:11px; float:left; letter-spacing: 1px; text-align:center;">:</td>
                            <td valign="top" style="padding-top:5px; width:200px; font-size:11px; float:left; letter-spacing: 1px; text-align:left;"><?php echo nl2br($inv['sales_enq_tc_frght']); ?></td>
                        </tr>
                         
                        </table>
                </div>
                        </td>
                        <td valign="top" style="border-left:1px solid #e9494f;border-bottom:1px solid #e9494f; border-right: 1px solid #e9494f;font-size:12px;font-family: 'Tahoma'; height: 70px; width: 50%; padding-right: 1%; padding-left: 1%; padding-top: 1%; padding-bottom: 1%; text-align:LEFT;">
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