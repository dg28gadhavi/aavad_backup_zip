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
            <td colspan="4" style="color:#e41f26; padding-top: 10px; padding-bottom:0.3cm; text-align:center;font-size:17px; text-transform: uppercase; font-weight:bold; letter-spacing: 1px;">Delivery Challan</td>
        </tr>
        <tr>
            <td valign="top" colspan="2" rowspan="4" style="width:60%;border-top:1px solid #e9494f; border-left:1px solid #e41f26; border-right:1px solid #e41f26; padding-top:0.2cm; padding-bottom:0.2cm; padding-left:0.1cm; padding-right:0.1cm;">
                <table style="width:100%;border-collapse:collapse;">
                    <tr>
                        <td valign="top" style=" width:20%; font-size:11px; float:left; letter-spacing: 1px; text-align:left;"><strong>Name:</strong><span style="text-align:right !important;"></span></td>
                            <td valign="top" style=" width:5%; font-size:11px; float:left; letter-spacing: 1px; text-align:center;">:</td>
                            <td valign="top" style=" width:57.5%; font-size:11px; float:left; letter-spacing: 1px; text-align:left;"><?php echo isset($inv['dis_vendor']) ? $inv['dis_vendor'] : '' ; ?></td>
                    </tr> 
                    <tr>
                            <td valign="top" style=" width:20%; font-size:11px; float:left; letter-spacing: 1px; text-align:left;"><strong>Address:</strong><span style="text-align:right !important;"></span></td>
                            <td valign="top" style=" width:5%; font-size:11px; float:left; letter-spacing: 1px; text-align:center;">:</td>
                            <td valign="top" style=" width:57.5%; font-size:11px; float:left; letter-spacing: 1px; text-align:left;"><?php echo isset($inv['wo_address']) ? $inv['wo_address'] : '' ; ?></td>
                        </tr>                        
                </table>

            </td>
            <td valign="top" style="width:20%;border-top:1px solid #e9494f; border-right:1px solid #e41f26; padding-top:0.2cm; padding-bottom:0.2cm; padding-left:0.1cm; padding-right:0.1cm;">
                <table style="width:100%;border-collapse:collapse;">  
                    <tr>
                        <td valign="top" style="font-size:11px; float:left; letter-spacing: 1px; text-align:left;"><strong>Challan NO.</strong><span style="text-align:right !important;"></span>
                        </td>   
                    </tr>                       
                </table>
            </td>
            <td valign="top" style="width:25%;border-top:1px solid #e9494f; border-right:1px solid #e41f26; padding-top:0.2cm; padding-bottom:0.2cm; padding-left:0.1cm; padding-right:0.1cm;">
                <table style="width:100%;border-collapse:collapse;">
                    <tr>
                        <td valign="top" style="font-size:11px; float:left; letter-spacing: 1px; text-align:left;"><strong><?php echo isset($inv['dis_challan_no']) ? $inv['dis_challan_no'] : '' ; ?></strong><span style="text-align:right !important;"></span>
                        </td>   
                    </tr>                             
                </table>
            </td>
        </tr>
        <tr>
            <td valign="top" style="border-top:1px solid #e9494f; border-right:1px solid #e41f26; padding-top:0.2cm; padding-bottom:0.2cm; padding-left:0.1cm; padding-right:0.1cm;">
                <table style="width:100%;border-collapse:collapse;">    
                <tr>
                     <td valign="top" style="font-size:11px; float:left; letter-spacing: 1px; text-align:left; padding-top:5px;"><strong>Date</strong><span style="text-align:right !important;"></span></td>
                </tr>                        
                </table>
            </td>
            <td valign="top" style="border-top:1px solid #e9494f; border-right:1px solid #e41f26; padding-top:0.2cm; padding-bottom:0.2cm; padding-left:0.1cm; padding-right:0.1cm;">
                <table style="width:100%;border-collapse:collapse;">   
                <tr>
                    <td valign="top" style="font-size:11px; float:left; letter-spacing: 1px; text-align:left; padding-top:5px;"><strong><?php echo date("d-m-Y", strtotime($inv['dis_challan_date'])); ?></strong><span style="text-align:right !important;"></span></td>
                </tr>                         
                </table>
            </td>
        </tr>
        <tr>
            <td valign="top" style="border-top:1px solid #e9494f; border-right:1px solid #e41f26; padding-top:0.2cm; padding-bottom:0.2cm; padding-left:0.1cm; padding-right:0.1cm;">
                <table style="width:100%;border-collapse:collapse;">  
                <tr>
                    <td valign="top" style="font-size:11px; float:left; letter-spacing: 1px; text-align:left;"><strong>W.O / Job Card No.</strong></td>
                </tr>                          
                </table>
            </td>
            <td valign="top" style="border-top:1px solid #e9494f; border-right:1px solid #e41f26; padding-top:0.2cm; padding-bottom:0.2cm; padding-left:0.1cm; padding-right:0.1cm;">
                <table style="width:100%;border-collapse:collapse;">     
                <tr>
                    <td valign="top" style="font-size:11px; float:left; letter-spacing: 1px; text-align:left;"><strong><?php echo isset($inv['dis_wo_no']) ? $inv['dis_wo_no'] : '' ; ?></strong></td>
                </tr>                       
                </table>
            </td>
        </tr>
        
        <tr>
            <td valign="top" style="border-top:1px solid #e9494f; border-right:1px solid #e41f26; padding-top:0.2cm; padding-bottom:0.2cm; padding-left:0.1cm; padding-right:0.1cm;">
                <table style="width:100%;border-collapse:collapse;">  
                <tr>
                    <td valign="top" style="font-size:11px; float:left; letter-spacing: 1px; text-align:left;"><strong>GSTIN</strong></td>
                </tr>                          
                </table>
            </td>
            <td valign="top" style="border-top:1px solid #e9494f; border-right:1px solid #e41f26; padding-top:0.2cm; padding-bottom:0.2cm; padding-left:0.1cm; padding-right:0.1cm;">
                <table style="width:100%;border-collapse:collapse;">     
                <tr>
                    <td valign="top" style="font-size:11px; float:left; letter-spacing: 1px; text-align:left;"><strong>24AAECM7879C1ZB</strong></td>
                </tr>                       
                </table>
            </td>
        </tr>

        <tr>
            <td valign="top" colspan="2" rowspan="2" style="border-top:1px solid #e9494f; border-left:1px solid #e41f26; border-right:1px solid #e41f26; padding-top:0.2cm; padding-bottom:0.2cm; padding-left:0.1cm; padding-right:0.1cm;">
                <table style="width:100%;border-collapse:collapse;">
                    <tr>
                        <td valign="top" style="font-size:11px; float:left; letter-spacing: 1px; text-align:left;"><strong>Dispatched / Collected By :</strong><span style="text-align:right !important;"></span></td>
                            
                    </tr> 
                    <tr>
                            <td valign="top" style="font-size:11px; float:left; letter-spacing: 1px; text-align:left;"><strong><?php echo isset($inv['po_refno']) ? $inv['po_refno'] : 'N.A.' ; ?></strong><span style="text-align:right !important;"></span></td>  
                                                 
                        </tr>                        
                </table>

            </td>
            <td valign="top" style="border-top:1px solid #e9494f; border-right:1px solid #e41f26; padding-top:0.2cm; padding-bottom:0.2cm; padding-left:0.1cm; padding-right:0.1cm;">
                <table style="width:100%;border-collapse:collapse;">  
                    <tr>
                        <td valign="top" style="font-size:11px; float:left; letter-spacing: 1px; text-align:left;"><strong>Your Ref. No.</strong></span>
                        </td>   
                    </tr>                       
                </table>
            </td>
            <td valign="top" style="border-top:1px solid #e9494f; border-right:1px solid #e41f26; padding-top:0.2cm; padding-bottom:0.2cm; padding-left:0.1cm; padding-right:0.1cm;">
                <table style="width:100%;border-collapse:collapse;">
                    <tr>
                        <td valign="top" style="font-size:11px; float:left; letter-spacing: 1px; text-align:left;"><strong><?php echo isset($inv['mode_delivery_name']) ? $inv['mode_delivery_name'] : '' ; ?></strong></span>
                        </td>   
                    </tr>                             
                </table>
            </td>
        </tr>
        <tr>
            <td valign="top" style="border-top:1px solid #e9494f; border-right:1px solid #e41f26; padding-top:0.2cm; padding-bottom:0.2cm; padding-left:0.1cm; padding-right:0.1cm;">
                <table style="width:100%;border-collapse:collapse;">    
                <tr>
                     <td valign="top" style="font-size:11px; float:left; letter-spacing: 1px; text-align:left; padding-top:5px;"><strong>Date:</strong><span style="text-align:right !important;"></span></td>
                </tr>                        
                </table>
            </td>
            <td valign="top" style="border-top:1px solid #e9494f; border-right:1px solid #e41f26; padding-top:0.2cm; padding-bottom:0.2cm; padding-left:0.1cm; padding-right:0.1cm;">
                <table style="width:100%;border-collapse:collapse;">   
                <tr>
                    <td valign="top" style="font-size:11px; float:left; letter-spacing: 1px; text-align:left; padding-top:5px;"><strong><?php echo isset($inv['po_place_delivary']) ? $inv['po_place_delivary'] : '' ; ?></strong><span style="text-align:right !important;"></span></td>
                </tr>                         
                </table>
            </td>
        </tr>
    </table> 

    <table style="width: 18cm; border-collapse:collapse;background: #f8f8f8;" autosize="0">                 
                    <tr>
                        <td valign="middle" height="35" style="width: 1cm;font-size:12px; letter-spacing: 1px; text-align:center; font-weight:bold;background-color:#f7bbbd;border-bottom:1px solid #e41f26;border-top:1px solid #e41f26;border-left:1px solid #e41f26;">Sr.No</td>                       
                        <td colspan="2" height="35" valign="middle" style="width: 8cm; border-left: 1px solid #e41f26; font-size:12px; float:left; letter-spacing: 1px; text-align:center; font-weight:bold;background-color:#f7bbbd;border-bottom:1px solid #e41f26;border-top:1px solid #e41f26;">Description Of Goods</td>
                        <td  valign="middle" height="35" style="width: 2cm; border-left: 1px solid #e41f26; font-size:12px; float:left; letter-spacing: 1px; text-align:center; font-weight:bold;border-bottom:1px solid #e41f26;background-color:#f7bbbd;border-top:1px solid #e41f26;">Qty</td>
                        <td  valign="middle" height="35" style="width: 3cm; border-left: 1px solid #e41f26; font-size:12px; float:left; letter-spacing: 1px; text-align:center; font-weight:bold;border-bottom:1px solid #e41f26;background-color:#f7bbbd;border-right:1px solid #e41f26;border-top:1px solid #e41f26;">Remarks</td>
                        <!-- <td  valign="middle" height="35" style="width: 1cm; border-left: 1px solid #e41f26; font-size:12px; float:left; letter-spacing: 1px; text-align:center; font-weight:bold;border-bottom:1px solid #e41f26;background-color:#f7bbbd;border-top:1px solid #e41f26;">Discount</td>
                        
                        <td  valign="middle" height="35" style="width: 1cm; border-left: 1px solid #e41f26; font-size:12px; float:left; letter-spacing: 1px; text-align:center; font-weight:bold;border-bottom:1px solid #e41f26;background-color:#f7bbbd;border-top:1px solid #e41f26;">GST</td> -->
                    
                        <!-- <td  colspan="2" height="35" valign="middle" style="width: 2.3cm;border-left: 1px solid #e41f26; font-size:12px; float:left; letter-spacing: 1px; text-align:center; font-weight:bold;background-color:#f7bbbd;border-bottom:1px solid #e41f26;border-top:1px solid #e41f26;border-right:1px solid #e41f26;">Checked</td> -->      
                    </tr>

                   <?php  $itm_discount = 0;
                    $srno = 0; $finaltotal = 0; foreach ($items as $key => $item) { $srno++; ?> 

                    
                    <tr>
                        <td valign="top" style="border-left:1px solid #e41f26;border-bottom:1px solid #e41f26;font-size:12px; letter-spacing: 1px; text-align:center;"><?php echo $srno; ?></td>
                        <td valign="top" colspan="2" style="border-left: 1px solid #e41f26;border-bottom:1px solid #e41f26;font-size:12; letter-spacing: 1px; text-align:center;">
                            <table style="width:100%;border-collapse:collapse;">
                                <tr>
                                    <td valign="top" style=" font-size:12px; float:left; letter-spacing: 1px; text-align:left;"><strong><?php if(isset($item['master_item_name']) && $item['master_item_name']!=''){echo $item['master_item_name'];} ?></strong><br>Part No:<?php if(isset($item['master_item_part_no']) && $item['master_item_part_no']!=''){echo $item['master_item_part_no'];} ?><br></td>
                                    
                                </tr>
                            </table>
                        </td>
                        <td valign="top" style="border-left: 1px solid #e41f26;border-bottom:1px solid #e41f26;font-size:12px; float:left; letter-spacing: 1px; text-align:center;"><?php if(isset($item['disi_qty']) && $item['disi_qty']!=''){echo $item['disi_qty'];} ?></td>
                        <td valign="top" style="border-left: 1px solid #e41f26;border-bottom:1px solid #e41f26;font-size:12px; float:left; letter-spacing: 1px; text-align:center;border-right:1px solid #e41f26;"><?php if(isset($item['poi_price']) && $item['poi_price']!=''){echo number_format($item['poi_price']);} ?></td>
                        <?php $finaltotal = $finaltotal + number_format($item['poi_ftotal'], 2, '.', ''); } ?>                            
                    </tr>
                     <tr>
                        <td valign="middle" height="35" style="border-left:1px solid #e41f26;border-top:1px solid #e41f26;border-bottom:1px solid #e41f26;font-size:11px;"></td>
                        <td valign="middle" height="35" colspan="2" style="border-left: 1px solid #e41f26;border-bottom:1px solid #e41f26; border-top:1px solid #e41f26;font-size:12px;"></td>
                        <td valign="middle" height="35" style="border-left: 1px solid #e41f26; border-bottom:1px solid #e41f26; border-top:1px solid #e41f26;font-size:11px;"></td>
                        <td valign="middle" height="35" style="border-right:1px solid #e41f26;border-left: 1px solid #e41f26; border-bottom:1px solid #e41f26; border-top:1px solid #e41f26;font-size:11px;text-align: center;"></td>                       
                        <!-- <td valign="middle" height="35" colspan="2" style="border-left: 1px solid #e41f26; border-bottom:1px solid #e41f26; border-top:1px solid #e41f26;border-right:1px solid #e41f26;text-align: center;font-size:12px;"></td> -->
                    </tr>
                    
        </table>
   
       <table style="width:100%;border-collapse:collapse; margin:0; padding:0;">
        <tr>
            <td valign="top" style="border-left:1px solid #e41f26; border-right:1px solid #e41f26; border-bottom:1px solid #e41f26; padding-top:0.2cm; padding-bottom:0.2cm; padding-left:0.1cm; padding-right:0.1cm;">
                <table style="width:100%;border-collapse:collapse;">   
                <tr>
                    <td valign="top" style="font-size:11px; float:left; letter-spacing: 1px; text-align:left;"><strong><input type="checkbox" name="" value="" checked>&nbsp;To Be Billed</strong></td>
                </tr>                         
                </table>
            </td>  
             <td valign="top" style="border-right:1px solid #e41f26; border-bottom:1px solid #e41f26; padding-top:0.2cm; padding-bottom:0.2cm; padding-left:0.1cm; padding-right:0.1cm;">
                <table style="width:100%;border-collapse:collapse;">   
                <tr>
                    <td valign="top" style="font-size:11px; float:left; letter-spacing: 1px; text-align:left; text-transform: uppercase;"><strong><input type="checkbox" name="" value="" checked>&nbsp;Demo / Trial</strong></td>
                </tr>                         
                </table>
            </td>         
            <td valign="top" style="border-right:1px solid #e41f26; border-bottom:1px solid #e41f26; padding-top:0.2cm; padding-bottom:0.2cm; padding-left:0.1cm; padding-right:0.1cm;">
                <table style="width:100%;border-collapse:collapse;">   
                <tr>
                    <td valign="top" style="font-size:11px; float:left; letter-spacing: 1px; text-align:left; text-transform: uppercase;"><strong><input type="checkbox" name="" value="" checked>&nbsp;Replacement</strong></td>
                </tr>                         
                </table>
            </td>
            <td valign="top" style="border-right:1px solid #e41f26; border-bottom:1px solid #e41f26; padding-top:0.2cm; padding-bottom:0.2cm; padding-left:0.1cm; padding-right:0.1cm;">
                <table style="width:100%;border-collapse:collapse;">   
                <tr>
                    <td valign="top" style="font-size:11px; float:left; letter-spacing: 1px; text-align:left;"><strong><input type="checkbox" name="" value="" checked>&nbsp;Reparied / Tested</strong></td>
                </tr>                                       
                </table>
            </td>
            <td valign="top" style="border-right:1px solid #e41f26; border-bottom:1px solid #e41f26; padding-top:0.2cm; padding-bottom:0.2cm; padding-left:0.1cm; padding-right:0.1cm;">
                <table style="width:100%;border-collapse:collapse;">   
                <tr>
                    <td valign="top" style="font-size:11px; float:left; letter-spacing: 1px; text-align:left;"><strong><input type="checkbox" name="" value="" checked>&nbsp;Returnable</strong></td>
                </tr>                                       
                </table>
            </td>
        </tr>
       
        <tr>
            <td valign="top" style="border-left:1px solid #e41f26; border-bottom:1px solid #e41f26; border-right:1px solid #e41f26; padding-top:0.2cm; padding-bottom:0.2cm; padding-left:0.1cm; padding-right:0.1cm;">
                <table style="width:100%;border-collapse:collapse;">   
                <tr>
                    <td valign="top" style="font-size:11px; float:left; letter-spacing: 1px; text-align:left;"><strong><input type="checkbox" name="" value="" checked>&nbsp;Non-Returnable</strong></td>
                </tr>                         
                </table>
            </td>            
            <td valign="top" style="border-right:1px solid #e41f26; border-bottom:1px solid #e41f26; padding-top:0.2cm; padding-bottom:0.2cm; padding-left:0.1cm; padding-right:0.1cm;">
                <table style="width:100%;border-collapse:collapse;">   
                <tr>
                    <td valign="top" style="font-size:11px; float:left; letter-spacing: 1px; text-align:left;"><strong><input type="checkbox" name="" value="" checked>&nbsp;Party Returns</strong></td>
                </tr>                         
                </table>
            </td>
            <td valign="top" style="border-right:1px solid #e41f26; border-bottom:1px solid #e41f26; padding-top:0.2cm; padding-bottom:0.2cm; padding-left:0.1cm; padding-right:0.1cm;">
                <table style="width:100%;border-collapse:collapse;">   
                <tr>
                    <td valign="top" style="font-size:11px; float:left; letter-spacing: 1px; text-align:left;"><strong><input type="checkbox" name="" value="" checked>&nbsp;Sample</strong></td>
                </tr>                         
                </table>
            </td>
            <td valign="top" style="border-right:1px solid #e41f26; border-bottom:1px solid #e41f26; padding-top:0.2cm; padding-bottom:0.2cm; padding-left:0.1cm; padding-right:0.1cm;">
                <table style="width:100%;border-collapse:collapse;">   
                <tr>
                    <td valign="top" style="font-size:11px; float:left; letter-spacing: 1px; text-align:left;"><strong><input type="checkbox" name="" value="" checked>&nbsp;Others</strong></td>
                </tr>                         
                </table>
            </td>
            <td valign="top" style="border-right:1px solid #e41f26; border-bottom:1px solid #e41f26; padding-top:0.2cm; padding-bottom:0.2cm; padding-left:0.1cm; padding-right:0.1cm;">
                <table style="width:100%;border-collapse:collapse;">   
                <tr>
                    <td valign="top" style="font-size:11px; float:left; letter-spacing: 1px; text-align:left;"><strong></strong></td>
                </tr>                                       
                </table>
            </td>
        </tr>        
        </table>
        <table style="width:100%;border-collapse:collapse; margin:0; padding:0;">
        
                    <tr>
                        <td valign="top" style="text-align:left; border-left:1px solid #e9494f;border-right:1px solid #e9494f;border-bottom:1px solid #e9494f; font-size:13px; height: 70px; padding-right: 1%; padding-left: 1%; padding-top: 1%; padding-bottom: 1%;">
                            <div style="font-size:13px;">Note: <?php echo isset($inv['dis_wodemo_note']) ? $inv['dis_wodemo_note'] : '' ; ?></div>
                            <br>                            
                        </td>                       
                        
                    </tr>
        </table>
        <table style="width:100%;border-collapse:collapse; margin:0; padding:0;">
        
                    <tr>
                        <td valign="top" style="text-align:left; border-left:1px solid #e9494f;border-right:1px solid #e9494f;border-bottom:1px solid #e9494f; font-size:13px; height: 70px; padding-right: 1%; padding-left: 1%; padding-top: 1%; padding-bottom: 1%;">
                            <div style="font-size:13px;">*Subject to Ahmedabad Jurisdiction only.*No allowance for shortage, mistake in any way or loss in transit will be entertained unless notice is given within Seven Days on receipt of goods.*Our responsibility ceases on delivery of material to the Transporter/Customer representative at our premises.</div>
                            <br>                            
                        </td>                       
                        
                    </tr>
        </table>
        <table style="width:100%;border-collapse:collapse; margin:0; padding:0;">
        
                    <tr>
                        <td valign="top" style="text-align:left; border-left:1px solid #e9494f;border-bottom:1px solid #e9494f; font-size:12.5px; height: 70px; width: 50%; padding-right: 1%; padding-left: 1%; padding-top: 1%; padding-bottom: 1%;">
                            <div style="height:70px; color:#e41f26; font-size:13px;"></div>
                            
                            <div style="font-size:13px;">Material Recieved in Good Condition.</div>
                            <br>
                            <br>  
                            <br>                        
                            <div style="font-size:13px;">Receiver's Signature</div>
                            <br>                            
                        </td>                        
                        <td valign="top" style="border-left:1px solid #e9494f;border-bottom:1px solid #e9494f; border-right: 1px solid #e9494f;font-size:13.5px;height: 70px; width: 50%; padding-right: 1%; padding-left: 1%; padding-top: 1%; padding-bottom: 1%; text-align:right;">
                            <div style="font-size:13px;"><strong>For, Micon Automation System Pvt. Ltd.</strong></div>                            
                            <br>
                            <br>
                            <br>
                            <div style="font-size:13px;">Authorised Signatory</div>
                        </td>
                    </tr>
        </table>
                     
</div>
</body>
</html>