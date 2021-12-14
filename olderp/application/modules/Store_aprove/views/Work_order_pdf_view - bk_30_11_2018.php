<?php //echo '<pre>'; print_r($inv);die;
//echo '<pre>'; print_r($items);die;
//echo '<pre>'; print_r($follow);die;
//echo '<pre>'; print_r($taxar);die;
?>
<?php 

function getIndianCurrency($number)
{
    $decimal = round($number - ($no = floor($number)), 2) * 100;
    $hundred = null;
    $digits_length = strlen($no);
    $i = 0;
    $str = array();
    $words = array(0 => '', 1 => 'One', 2 => 'Two',
        3 => 'Three', 4 => 'Four', 5 => 'Five', 6 => 'Six',
        7 => 'Seven', 8 => 'Eight', 9 => 'Nine',
        10 => 'Ten', 11 => 'Eleven', 12 => 'Twelve',
        13 => 'Thirteen', 14 => 'Fourteen', 15 => 'Fifteen',
        16 => 'Sixteen', 17 => 'Seventeen', 18 => 'Eighteen',
        19 => 'Nineteen', 20 => 'Twenty', 30 => 'Thirty',
        40 => 'Forty', 50 => 'Fifty', 60 => 'Sixty',
        70 => 'Seventy', 80 => 'Eighty', 90 => 'Ninety');
    $digits = array('', 'Hundred','Thousand','Lakh', 'Crore');

    while( $i < $digits_length ) {
        $divider = ($i == 2) ? 10 : 100;
        $number = floor($no % $divider);
        $no = floor($no / $divider);
        $i += $divider == 10 ? 1 : 2;
        if ($number) {
            $plural = (($counter = count($str)) && $number > 9) ? 's' : null;
            $hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
            $str [] = ($number < 21) ? $words[$number].' '. $digits[$counter]. $plural.' '.$hundred:$words[floor($number / 10) * 10].' '.$words[$number % 10]. ' '.$digits[$counter].$plural.' '.$hundred;
        } else $str[] = null;
    }

    $rupees = implode('', array_reverse($str));
    $paise = '';

    if ($decimal) {
        $paise = 'and ';
        $decimal_length = strlen($decimal);

        if ($decimal_length == 2) {
            if ($decimal >= 20) {
                $dc = $decimal % 10;
                $td = $decimal - $dc;
                $ps = ($dc == 0) ? '' : '-' . $words[$dc];

                $paise .= $words[$td] . $ps;
            } else {
                $paise .= $words[$decimal];
            }
        } else {
            $paise .= $words[$decimal % 10];
        }

        $paise .= ' paise';
    }

    return ($rupees ? ''.$rupees . 'Rupees Only' : '') . $paise ;
}
    
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
            <td colspan="3" style="width:98%; color:#e41f26; padding-top: 10px; padding-bottom:0.3cm; text-align:center;font-size:17px; text-transform: uppercase; font-weight:bold; letter-spacing: 1px;">Work Order</td>
        </tr>
        <tr>
            <td valign="top" colspan="2" style="border-top:1px solid #e9494f; border-left:1px solid #e41f26; border-right:1px solid #e41f26; padding-top:0.2cm; padding-bottom:0.2cm; padding-left:0.1cm; padding-right:0.1cm;">
                <table style="width:100%;border-collapse:collapse;">
                    <tr>
                        <td valign="top" style="font-size:11px; float:left; letter-spacing: 1px; text-align:center; padding-top:5px;"><strong>MASPL</strong></td>
                    </tr>                         
                </table>

            </td>
            <td valign="top" style="border-top:1px solid #e9494f; border-right:1px solid #e41f26; padding-top:0.2cm; padding-bottom:0.2cm; padding-left:0.1cm; padding-right:0.1cm;">
                <table style="width:100%;border-collapse:collapse;">                            
                </table>
            </td>
        </tr>
        <tr>            
             <td valign="top" style="border-top:1px solid #e41f26; border-left:1px solid #e41f26;border-bottom:1px solid #e41f26;border-right:1px solid #e41f26; padding-top:0.2cm; padding-bottom:0.2cm; padding-left:0.1cm; padding-right:0.1cm;">
                <div style="width:98%; margin-top:0;">
                    <!-- <div style="width:100%; font-size:11px; float:left; letter-spacing: 1px;"> <span style="font-weight:bold;">Invoice No</span> : PI NV111310 </div> -->
                    <table style="width:100%;border-collapse:collapse;">
                        <tr>
                            <td valign="top" style=" width:25%; font-size:11px; float:left; letter-spacing: 1px; text-align:left;"><strong>Name:</strong><span style="text-align:right !important;"></span></td>
                            <td valign="top" style=" width:5%; font-size:11px; float:left; letter-spacing: 1px; text-align:center;">:</td>
                            <td valign="top" style=" width:57.5%; font-size:11px; float:left; letter-spacing: 1px; text-align:left;"><?php if(isset($inv['wo_customer_name']) && $inv['wo_customer_name']!=''){echo $inv['wo_customer_name'].",".$inv['wo_address'];}else{echo '';} ?></td>
                        </tr>
                        <tr>
                            <td valign="top" style=" width:25%; font-size:11px; float:left; letter-spacing: 1px; text-align:left;"><strong>Billing Address:</strong><span style="text-align:right !important;"></span></td>
                            <td valign="top" style=" width:5%; font-size:11px; float:left; letter-spacing: 1px; text-align:center;">:</td>
                            <td valign="top" style=" width:57.5%; font-size:11px; float:left; letter-spacing: 1px; text-align:left;"><?php if(isset($inv['wo_billing_address']) && $inv['wo_billing_address']!=''){echo $inv['wo_billing_address'];}else{echo '';} ?></td>
                        </tr>
                        <tr>
                            <td valign="top" style=" width:25%; font-size:11px; float:left; letter-spacing: 1px; text-align:left;"><strong>Shipping Address:</strong><span style="text-align:right !important;"></span></td>
                            <td valign="top" style=" width:5%; font-size:11px; float:left; letter-spacing: 1px; text-align:center;">:</td>
                            <td valign="top" style=" width:57.5%; font-size:11px; float:left; letter-spacing: 1px; text-align:left;"><?php if(isset($inv['wo_shipping_address']) && $inv['wo_shipping_address']!=''){echo $inv['wo_shipping_address'];}else{echo '';} ?></td>
                        </tr>
                        
                    </table>
                </div>
            </td>
            <td valign="top" style="border-top:1px solid #e41f26; border-bottom:1px solid #e41f26;border-right:1px solid #e41f26; padding-top:0.2cm; padding-bottom:0.2cm; padding-left:0.1cm; padding-right:0.1cm;">
                <div style="width:98%; margin-top:0;">
                    <!-- <div style="width:100%; font-size:11px; float:left; letter-spacing: 1px;"> <span style="font-weight:bold;">Invoice No</span> : PI NV111310 </div> -->
                    <table style="width:100%;border-collapse:collapse;">
                        <tr>
                            <td valign="top" style=" width:23%; font-size:11px; float:left; letter-spacing: 1px; text-align:left;"><strong>P.O No.</strong><span style="text-align:right !important;"></span></td>
                            <td valign="top" style=" width:5%; font-size:11px; float:left; letter-spacing: 1px; text-align:center;">:</td>
                            <td valign="top" style=" width:47.5%; font-size:11px; float:left; letter-spacing: 1px; text-align:left;"><?php if(isset($inv['wo_po_no']) && $inv['wo_po_no']!=''){echo $inv['wo_po_no'];}else{echo '';} ?></td>
                        </tr>
                        <tr>
                            <td valign="top" style="width:23%; font-size:11px; float:left; letter-spacing: 1px; text-align:left; padding-top:5px;"><strong>Date</strong><span style="text-align:right !important;"></span></td>
                            <td valign="top" style="padding-top:5px; width:5%; font-size:11px; float:left; letter-spacing: 1px; text-align:center;">:</td>
                            <td valign="top" style="padding-top:5px; width:47.5%; font-size:11px; float:left; letter-spacing: 1px; text-align:left;"><?php if(isset($inv['wo_po_date']) && $inv['wo_po_date']!=''){echo date("d/m/Y", strtotime($inv['wo_po_date']));}else{echo '';} ?></td>
                        </tr> 
                        </table>
                </div>
            </td>

            <td valign="top" style="border-top:1px solid #e41f26; border-bottom:1px solid #e41f26;border-right:1px solid #e41f26; padding-top:0.2cm; padding-bottom:0.2cm; padding-left:0.1cm; padding-right:0.1cm;">
                <div style="width:98%; margin-top:0;">
                    <!-- <div style="width:100%; font-size:11px; float:left; letter-spacing: 1px;"> <span style="font-weight:bold;">Invoice No</span> : PI NV111310 </div> -->
                    <table style="width:100%;border-collapse:collapse;">
                        <tr>
                            <td valign="top" style="width:25%; font-size:11px; float:left; letter-spacing: 1px; text-align:left;"><strong>W.O No.</strong><span style="text-align:right !important;"></span></td>
                            <td valign="top" style=" width:5%; font-size:11px; float:left; letter-spacing: 1px; text-align:center;">:</td>
                            <td valign="top" style="width:65.5%; font-size:11px; float:left; letter-spacing: 1px; text-align:left;"><?php if(isset($inv['wo_wo_no']) && $inv['wo_wo_no']!=''){echo $inv['wo_wo_no'];}else{echo '';} ?></td>
                        </tr>
                        <tr>
                            <td valign="top" style="width:25%; font-size:11px; float:left; letter-spacing: 1px; text-align:left; padding-top:5px;"><strong>Date</strong><span style="text-align:right !important;"></span></td>
                            <td valign="top" style="padding-top:5px; width:5%; font-size:11px; float:left; letter-spacing: 1px; text-align:center;">:</td>
                            <td valign="top" style="padding-top:5px; width:65.5%; font-size:11px; float:left; letter-spacing: 1px; text-align:left;"><?php if(isset($inv['wo_wo_date']) && $inv['wo_wo_date']!=''){echo date("d/m/Y", strtotime($inv['wo_wo_date']));}else{echo '';} ?></td>
                        </tr>
                    </table>
                </div>
            </td>
        </tr>
    </table> 

    <table style="width: 18cm; border-collapse:collapse;background: #f8f8f8;" autosize="0">                 
                    <tr>
                        <td valign="middle" height="35" style="width: 1cm;font-size:12px; letter-spacing: 1px; text-align:center; font-weight:bold;background-color:#f7bbbd;border-bottom:1px solid #e41f26;border-left:1px solid #e41f26;">Sr.No</td>                       
                        <td colspan="2" height="35" valign="middle" style="width: 10cm; border-left: 1px solid #e41f26; font-size:12px; float:left; letter-spacing: 1px; text-align:center; font-weight:bold;background-color:#f7bbbd;border-bottom:1px solid #e41f26;">Item Description</td>
                        <td  valign="middle" height="35" style="width: 2cm; border-left: 1px solid #e41f26; font-size:12px; float:left; letter-spacing: 1px; text-align:center; font-weight:bold;border-bottom:1px solid #e41f26;background-color:#f7bbbd;">Qty</td>
                        <td  valign="middle" height="35" style="width: 3.48cm; border-left: 1px solid #e41f26; font-size:12px; float:left; letter-spacing: 1px; text-align:center; font-weight:bold;border-bottom:1px solid #e41f26;background-color:#f7bbbd;">Module Details / Rate</td>
                        <td  colspan="2" height="35" valign="middle" style="width: 3cm;border-left: 1px solid #e41f26; font-size:12px; float:left; letter-spacing: 1px; text-align:center; font-weight:bold;background-color:#f7bbbd;border-bottom:1px solid #e41f26;border-right:1px solid #e41f26;">Total</td>      
                    </tr>

                   <?php  $itm_discount = 0;
                    $srno = 0; $finaltotal = 0; foreach ($items as $key => $item) { $srno++; ?> 

                    <tr>
                        <td valign="top" style="border-left:1px solid #e41f26;border-top:1px solid #e41f26;"></td>
                        <td valign="top" colspan="2" style="border-left: 1px solid #e41f26;border-top:1px solid #e41f26;"></td>
                      	<td valign="top" style="border-left: 1px solid #e41f26;border-top:1px solid #e41f26;"></td>
                        <td valign="top" style="border-left: 1px solid #e41f26;border-top:1px solid #e41f26;"></td>
                        <td valign="top" colspan="2" style="border-left: 1px solid #e41f26;border-top:1px solid #e41f26;border-right:1px solid #e41f26;"></td>

                    </tr>
                    <tr>
                        <td valign="top" style="border-left:1px solid #e41f26;border-bottom:1px solid #e41f26;font-size:12px; letter-spacing: 1px; text-align:center;"><?php echo $srno; ?></td>
                        <td valign="top" colspan="2" style="border-left: 1px solid #e41f26;border-bottom:1px solid #e41f26;font-size:12; letter-spacing: 1px; text-align:center;">
                            <table style="width:100%;border-collapse:collapse;">
                                <tr>
                                    <td valign="top" style=" font-size:12px; float:left; letter-spacing: 1px; text-align:left;"><strong><?php if(isset($item['master_item_name']) && $item['master_item_name']!=''){echo $item['master_item_name'];} ?></strong><br>Part No:<?php if(isset($item['woi_part_no']) && $item['woi_part_no']!=''){echo $item['woi_part_no'];} ?><br><?php if(isset($item['woi_itm_desc']) && $item['woi_itm_desc']!=''){echo wordwrap($item['woi_itm_desc'], 60, "<br />\n");} ?></td>
                                    <td valign="top" style="padding: 5px;font-size:12px; vertical-align: middle; float: left;"><?php if(isset($item['master_item_img']) && !empty($item['master_item_img'])) { ?> <img src="<?php echo base_url(); ?>uploads/master_item_img/<?php echo $item['master_item_img']; ?>" width="100" height="70" alt=""/><?php } ?></td>
                                </tr>
                            </table>
                           </td>
                        <td valign="top" style="border-left: 1px solid #e41f26;border-bottom:1px solid #e41f26;font-size:12px; float:left; letter-spacing: 1px; text-align:center;"><?php if(isset($item['woi_qty']) && $item['woi_qty']!=''){echo $item['woi_qty'];} ?></td>
                        <td valign="top" style="border-left: 1px solid #e41f26;border-bottom:1px solid #e41f26;font-size:12px; float:left; letter-spacing: 1px; text-align:center;border-right:1px solid #e41f26;"><?php if(isset($item['woi_price']) && $item['woi_final_price']!=''){echo number_format($item['woi_price']);} ?></td>
                        <td valign="top" colspan="2" style="border-left: 1px solid #e41f26;border-bottom:1px solid #e41f26;font-size:12px; float:left; letter-spacing: 1px; text-align:center;border-right:1px solid #e41f26;"><?php if(isset($item['woi_final_price']) && $item['woi_final_price']!=''){echo number_format($item['woi_final_price']);} ?></td>
                     
                        <?php $finaltotal = $finaltotal + number_format($item['woi_final_price'], 2, '.', ''); } ?>                            
                    </tr>
                     <tr>
                        <td valign="middle" height="35" style="border-left:1px solid #e41f26;border-top:1px solid #e41f26;border-bottom:1px solid #e41f26;font-size:11px;"></td>
                        <td valign="middle" height="35" colspan="3" style="border-left: 1px solid #e41f26;border-bottom:1px solid #e41f26; border-top:1px solid #e41f26;font-size:12px;"><strong>P & F</strong></td>
                        <td valign="middle" height="35" style="border-left: 1px solid #e41f26; border-bottom:1px solid #e41f26; border-top:1px solid #e41f26;font-size:11px;"></td>                        
                        <td valign="middle" height="35" colspan="2" style="border-left: 1px solid #e41f26; border-bottom:1px solid #e41f26; border-top:1px solid #e41f26;border-right:1px solid #e41f26;text-align: center;font-size:11px;"><?php if(isset($inv['wo_pf_grandtotal']) && $inv['wo_pf_grandtotal']!=''){echo number_format($inv['wo_pf_grandtotal']);} ?></td>

                    </tr>
                     <tr>
                        <td valign="middle" height="35" style="border-left:1px solid #e41f26;border-top:1px solid #e41f26;border-bottom:1px solid #e41f26;font-size:11px;"></td>
                        <td valign="middle" height="35" colspan="3" style="border-left: 1px solid #e41f26;border-bottom:1px solid #e41f26; border-top:1px solid #e41f26;font-size:12px;"><strong>Freight</strong></td>
                        <td valign="middle" height="35" style="border-left: 1px solid #e41f26; border-bottom:1px solid #e41f26; border-top:1px solid #e41f26;font-size:11px;"><strong></strong></td>                        
                        <td valign="middle" height="35" colspan="2" style="border-left: 1px solid #e41f26; border-bottom:1px solid #e41f26; border-top:1px solid #e41f26;border-right:1px solid #e41f26;text-align: center;font-size:11px; "><?php if(isset($inv['wo_fright_grandtotal']) && $inv['wo_fright_grandtotal']!=''){echo number_format($inv['wo_fright_grandtotal']);} ?></td>
                    </tr>
                    <tr>
                        <td valign="middle" height="35" style="border-left:1px solid #e41f26;border-top:1px solid #e41f26;border-bottom:1px solid #e41f26;font-size:11px;"></td>
                        <td valign="middle" height="35" colspan="3" style="border-left: 1px solid #e41f26;border-bottom:1px solid #e41f26; border-top:1px solid #e41f26;font-size:11px;"></td>
                        <td valign="middle" height="35" style="border-left: 1px solid #e41f26; border-bottom:1px solid #e41f26; border-top:1px solid #e41f26; text-align: right;font-size:12px;"><strong>Total:</strong></td>
                        <td valign="middle" height="35" colspan="2" style="border-left: 1px solid #e41f26; border-bottom:1px solid #e41f26; border-top:1px solid #e41f26;border-right:1px solid #e41f26;text-align: center;font-size:11px;"><?php echo $finaltotal = $finaltotal + $inv['wo_pf_grandtotal'] + $inv['wo_fright_grandtotal']; ?></td>

                    </tr>
                    <tr>
                        <td valign="middle" height="35" style="border-left:1px solid #e41f26;border-top:1px solid #e41f26;border-bottom:1px solid #e41f26;font-size:11px;"></td>
                        <td valign="middle" height="35" colspan="3" style="border-left: 1px solid #e41f26;border-bottom:1px solid #e41f26; border-top:1px solid #e41f26;font-size:12px;"><strong><?php
                        echo getIndianCurrency(round($finaltotal)); ?></strong></td>
                        <td valign="middle" height="35" style="border-left: 1px solid #e41f26; border-bottom:1px solid #e41f26; border-top:1px solid #e41f26;font-size:12px;text-align: right;"><strong>Grand Total:</strong></td>                         
                        <td valign="middle" height="35" colspan="2" style="border-left: 1px solid #e41f26; border-bottom:1px solid #e41f26; border-top:1px solid #e41f26;border-right:1px solid #e41f26;text-align: center;font-size:11px;"><?php echo $finaltotal; ?></td>
                    </tr>
        </table>
        
        <table style="width:100%;border-collapse:collapse;">
            <tr>            
             <td valign="top" style="border-left:1px solid #e41f26;border-right:1px solid #e41f26; padding-top:0.2cm; padding-bottom:0.2cm; padding-left:0.1cm; padding-right:0.1cm;">
                <div style="width:98%; margin-top:0;">
                    <!-- <div style="width:100%; font-size:11px; float:left; letter-spacing: 1px;"> <span style="font-weight:bold;">Invoice No</span> : PI NV111310 </div> -->
                    <table style="width:100%;border-collapse:collapse;">
                        <tr>
                            <td valign="top" style=" width:50%; font-size:11px; float:left; letter-spacing: 1px; text-align:left;"><strong>Delivery Time / Date</strong><span style="text-align:right !important;"></span></td>
                            <td valign="top" style=" width:5%; font-size:11px; float:left; letter-spacing: 1px; text-align:center;">:</td>
                            <td valign="top" style=" width:47.5%; font-size:11px; float:left; letter-spacing: 1px; text-align:left;"><?php if(isset($inv['wo_deliverytime']) && $inv['wo_deliverytime']!=''){echo $inv['wo_deliverytime'];}else{echo '';} ?></td>
                        </tr>
                    </table>
                </div>
            </td>
            <td colspan="2" valign="top" style="border-bottom:1px solid #e41f26;border-right:1px solid #e41f26; padding-top:0.2cm; padding-bottom:0.2cm; padding-left:0.1cm; padding-right:0.1cm;">
                <div style="width:98%; margin-top:0;">
                    <!-- <div style="width:100%; font-size:11px; float:left; letter-spacing: 1px;"> <span style="font-weight:bold;">Invoice No</span> : PI NV111310 </div> -->
                    <table style="width:100%;border-collapse:collapse;">
                        <tr>
                            <td valign="top" style=" width:25%; font-size:11px; float:left; letter-spacing: 1px; text-align:left;"><strong>Delivery by</strong><span style="text-align:right !important;"></span></td>
                            <td valign="top" style=" width:5%; font-size:11px; float:left; letter-spacing: 1px; text-align:center;">:</td>
                            <td valign="top" style=" width:47.5%; font-size:11px; float:left; letter-spacing: 1px; text-align:left;"><?php if(isset($inv['wo_deliveryby']) && $inv['wo_deliveryby']!=''){echo $inv['wo_deliveryby'];}else{echo '';} ?></td>
                        </tr>                        
                        </table>
                </div>
            </td>
        </tr>

        <tr>
            <td valign="top" style="width:6cm;border-left:1px solid #e41f26;border-bottom:1px solid #e41f26; padding-top:0.2cm; padding-bottom:0.2cm; padding-left:0.1cm; padding-right:0.1cm;">
                <div style="width:98%; margin-top:0;">
                    <!-- <div style="width:100%; font-size:11px; float:left; letter-spacing: 1px;"> <span style="font-weight:bold;">Invoice No</span> : PI NV111310 </div> -->
                    <table style="width:100%;border-collapse:collapse;">                        
                        
                    </table>
                </div>
            </td>
            <td valign="top" style="width:5cm;border-left:1px solid #e41f26;border-bottom:1px solid #e41f26;padding-top:0.2cm; padding-bottom:0.2cm; padding-left:0.1cm; padding-right:0.1cm;">
                <div style="width:98%; margin-top:0;">
                    <!-- <div style="width:100%; font-size:11px; float:left; letter-spacing: 1px;"> <span style="font-weight:bold;">Invoice No</span> : PI NV111310 </div> -->
                    <table style="width:100%;border-collapse:collapse;">
                        <tr>
                            <td valign="top" style=" width:50%; font-size:11px; float:left; letter-spacing: 1px; text-align:left;"><strong>Courier Name</strong><span style="text-align:right !important;"></span></td>
                            <td valign="top" style=" width:5%; font-size:11px; float:left; letter-spacing: 1px; text-align:center;">:</td>
                            <td valign="top" style=" width:47.5%; font-size:11px; float:left; letter-spacing: 1px; text-align:left;"><?php if(isset($inv['wo_couriername']) && $inv['wo_couriername']!=''){echo $inv['wo_couriername'];}else{echo '';} ?></td>
                        </tr>
                    </table>
                </div>
            </td>
            <td valign="top" style="width:4cm; border-left:1px solid #e41f26;border-bottom:1px solid #e41f26;border-right:1px solid #e41f26; padding-top:0.2cm; padding-bottom:0.2cm; padding-left:0.1cm; padding-right:0.1cm;">
                <div style="width:98%; margin-top:0;">
                    <!-- <div style="width:100%; font-size:11px; float:left; letter-spacing: 1px;"> <span style="font-weight:bold;">Invoice No</span> : PI NV111310 </div> -->
                    <table style="width:100%;border-collapse:collapse;">
                        <tr>
                            <td valign="top" style=" width:25%; font-size:11px; float:left; letter-spacing: 1px; text-align:left;"><strong>Docket No.</strong><span style="text-align:right !important;"></span></td>
                            <td valign="top" style=" width:5%; font-size:11px; float:left; letter-spacing: 1px; text-align:center;">:</td>
                            <td valign="top" style=" width:47.5%; font-size:11px; float:left; letter-spacing: 1px; text-align:left;"><?php if(isset($inv['wo_docket_no']) && $inv['wo_docket_no']!=''){echo $inv['wo_docket_no'];}else{echo '';} ?></td>
                        </tr>                        
                        </table>
                </div>
            </td>
        </tr>
    </table> 
    <table style="width:100%;border-collapse:collapse; margin:0; padding:0;">
        <tr>
            <td valign="top" style="width:5cm;border-left:1px solid #e41f26;border-bottom:1px solid #e41f26;border-right:1px solid #e41f26; padding-top:0.2cm; padding-bottom:0.2cm; padding-left:0.1cm; padding-right:0.1cm;">
                <div style="width:98%; margin-top:0;">
                    <!-- <div style="width:100%; font-size:11px; float:left; letter-spacing: 1px;"> <span style="font-weight:bold;">Invoice No</span> : PI NV111310 </div> -->
                    <table style="width:100%;border-collapse:collapse;">                        
                        <tr>
                            <td valign="top" style=" width:50%; font-size:11px; float:left; letter-spacing: 1px; text-align:left;"><strong>Prepared by</strong><span style="text-align:right !important;"></span></td>
                            <td valign="top" style=" width:5%; font-size:11px; float:left; letter-spacing: 1px; text-align:center;">:</td>
                            <td valign="top" style=" width:47.5%; font-size:11px; float:left; letter-spacing: 1px; text-align:left;"><?php if(isset($inv['preparedbyf']) && $inv['preparedbyf']!=''){echo $inv['preparedbyf'].$inv['preparedbyl'];}else{echo '';} ?></td>
                        </tr>
                    </table>
                </div>
            </td>
            <td valign="top" style="width:5cm;border-left:1px solid #e41f26;border-bottom:1px solid #e41f26;border-right:1px solid #e41f26; padding-top:0.2cm; padding-bottom:0.2cm; padding-left:0.1cm; padding-right:0.1cm;">
                <div style="width:98%; margin-top:0;">
                    <!-- <div style="width:100%; font-size:11px; float:left; letter-spacing: 1px;"> <span style="font-weight:bold;">Invoice No</span> : PI NV111310 </div> -->
                    <table style="width:100%;border-collapse:collapse;">
                        <tr>
                            <td valign="top" style=" width:50%; font-size:11px; float:left; letter-spacing: 1px; text-align:left;"><strong>Tested by</strong><span style="text-align:right !important;"></span></td>
                            <td valign="top" style=" width:5%; font-size:11px; float:left; letter-spacing: 1px; text-align:center;">:</td>
                            <td valign="top" style=" width:47.5%; font-size:11px; float:left; letter-spacing: 1px; text-align:left;"><?php if(isset($inv['testedbyf']) && $inv['testedbyf']!=''){echo $inv['testedbyf'].$inv['testedbyl'];}else{echo '';} ?></td>
                        </tr>
                    </table>
                </div>
            </td>
            <td colspan="2" valign="top" style="width:5cm;border-left:1px solid #e41f26;border-bottom:1px solid #e41f26;border-right:1px solid #e41f26; padding-top:0.2cm; padding-bottom:0.2cm; padding-left:0.1cm; padding-right:0.1cm;">
                <div style="width:98%; margin-top:0;">
                    <!-- <div style="width:100%; font-size:11px; float:left; letter-spacing: 1px;"> <span style="font-weight:bold;">Invoice No</span> : PI NV111310 </div> -->
                    <table style="width:100%;border-collapse:collapse;">
                        <tr>
                            <td valign="top" style=" width:25%; font-size:11px; float:left; letter-spacing: 1px; text-align:left;"><strong>Remarks</strong><span style="text-align:right !important;"></span></td>
                            <td valign="top" style=" width:5%; font-size:11px; float:left; letter-spacing: 1px; text-align:center;">:</td>
                            <td valign="top" style=" width:47.5%; font-size:11px; float:left; letter-spacing: 1px; text-align:left;"><?php if(isset($inv['wo_remark']) && $inv['wo_remark']!=''){echo $inv['wo_remark'];}else{echo '';} ?></td>
                        </tr>                        
                        </table>
                </div>
            </td>
        </tr>
        </table>
       
        <table style="width:100%;border-collapse:collapse; margin:0; padding:0;">
            <tr>
            <td valign="top" style="padding-top:0.2cm; padding-bottom:0.2cm; padding-left:0.1cm; padding-right:0.1cm;">
                <div style="width:98%; margin-top:0;">
                    <!-- <div style="width:100%; font-size:11px; float:left; letter-spacing: 1px;"> <span style="font-weight:bold;">Invoice No</span> : PI NV111310 </div> -->
                    <table style="width:100%;border-collapse:collapse;">                        
                        <tr>
                            <td valign="top" style="width:50px; font-size:11px; float:left; letter-spacing: 1px; text-align:center; padding-top:5px;"><strong>NG</strong></td>
                        </tr>
                    </table>
                </div>
            </td>
            <td valign="top" style="padding-top:0.2cm; padding-bottom:0.2cm; padding-left:0.1cm; padding-right:0.1cm;">
                <div style="width:98%; margin-top:0;">
                    <!-- <div style="width:100%; font-size:11px; float:left; letter-spacing: 1px;"> <span style="font-weight:bold;">Invoice No</span> : PI NV111310 </div> -->
                    <table style="width:100%;border-collapse:collapse;">
                        <tr>
                            <td valign="top" style="width:50px; font-size:11px; float:left; letter-spacing: 1px; text-align:center; padding-top:5px;"><strong>PS</strong></td>
                        </tr>
                    </table>
                </div>
            </td>
            <td valign="top" style="padding-top:0.2cm; padding-bottom:0.2cm; padding-left:0.1cm; padding-right:0.1cm;">
                <div style="width:98%; margin-top:0;">
                    <!-- <div style="width:100%; font-size:11px; float:left; letter-spacing: 1px;"> <span style="font-weight:bold;">Invoice No</span> : PI NV111310 </div> -->
                    <table style="width:100%;border-collapse:collapse;">
                        <tr>
                           <td valign="top" style="width:50px; font-size:11px; float:left; letter-spacing: 1px; text-align:center; padding-top:5px;"><strong>Account</strong></td>
                        </tr>                        
                        </table>
                </div>
            </td>
            <td valign="top" style="padding-top:0.2cm; padding-bottom:0.2cm; padding-left:0.1cm; padding-right:0.1cm;">
                <div style="width:98%; margin-top:0;">
                    <!-- <div style="width:100%; font-size:11px; float:left; letter-spacing: 1px;"> <span style="font-weight:bold;">Invoice No</span> : PI NV111310 </div> -->
                    <table style="width:100%;border-collapse:collapse;">
                        <tr>
                           <td valign="top" style="width:50px; font-size:11px; float:left; letter-spacing: 1px; text-align:center; padding-top:5px;"><strong>Store</strong></td>
                        </tr>                        
                        </table>
                </div>
            </td>
            <td valign="top" style="padding-top:0.2cm; padding-bottom:0.2cm; padding-left:0.1cm; padding-right:0.1cm;">
                <div style="width:98%; margin-top:0;">
                    <!-- <div style="width:100%; font-size:11px; float:left; letter-spacing: 1px;"> <span style="font-weight:bold;">Invoice No</span> : PI NV111310 </div> -->
                    <table style="width:100%;border-collapse:collapse;">
                        <tr>
                           <td valign="top" style="width:50px; font-size:11px; float:left; letter-spacing: 1px; text-align:center; padding-top:5px;"><strong>Prodution</strong></td>
                        </tr>                        
                        </table>
                </div>
            </td>
        </tr>
        </table>                
</div>
</body>
</html>