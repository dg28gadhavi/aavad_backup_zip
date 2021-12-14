<?php //echo '<pre>'; print_r($inv);die;
//echo '<pre>'; print_r($extra);die;
//echo '<pre>'; print_r($items);die;
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
            
            <td valign="top" style="width:7cm;border-top:1px solid #e41f26; border-left:1px solid #e41f26;border-right:1px solid #e41f26; padding-top:0.2cm; padding-bottom:0.2cm; padding-left:0.1cm; padding-right:0.1cm;">
                <div style="width:98%; margin-top:0;">
                    <!-- <div style="width:100%; font-size:11px; float:left; letter-spacing: 1px;"> <span style="font-weight:bold;">Invoice No</span> : PI NV111310 </div> -->
                    <table style="width:100%;border-collapse:collapse;">
                        <tr>
                            <td valign="top" style=" width:45px; font-size:11px; float:left; letter-spacing: 1px; text-align:left;"><strong>M/s.</strong><span style="text-align:right !important;"></span></td>
                            <td valign="top" style=" width:10px; font-size:11px; float:left; letter-spacing: 1px; text-align:center;">:</td>
                            <td valign="top" style=" width:240px; font-size:11px; float:left; letter-spacing: 1px; text-align:left;"></strong><?php echo $inv['vendor']; ?></td>
                        </tr>
                        <tr>
                            <td valign="top" style="width:45px; font-size:11px; float:left; letter-spacing: 1px; text-align:left; padding-top:5px;"><strong>Address</strong><span style="text-align:right !important;"></span></td>
                            <td valign="top" style="padding-top:5px; width:10px; font-size:11px; float:left; letter-spacing: 1px; text-align:center;">:</td>
                            <td valign="top" style="padding-top:5px; width:240px; font-size:11px; float:left; letter-spacing: 1px; text-align:left;"><?php echo nl2br($inv['pi_address']); ?></td>
                        </tr>
                        <tr>
                            <td valign="top" style="width:45px; font-size:11px; float:left; letter-spacing: 1px; text-align:left; padding-top:5px;"><strong>City</strong><span style="text-align:right !important;"></span></td>
                            <td valign="top" style="padding-top:5px; width:10px; font-size:11px; float:left; letter-spacing: 1px; text-align:center;">:</td>
                            <td valign="top" style="padding-top:5px; width:240px; font-size:11px; float:left; letter-spacing: 1px; text-align:left;"><?php echo nl2br($inv['city_name']); ?></td>
                        </tr>
                        <tr>
                            <td valign="top" style="width:45px; font-size:11px; float:left; letter-spacing: 1px; text-align:left; padding-top:5px;"><strong>State</strong><span style="text-align:right !important;"></span></td>
                            <td valign="top" style="padding-top:5px; width:10px; font-size:11px; float:left; letter-spacing: 1px; text-align:center;">:</td>
                            <td valign="top" style="padding-top:5px; width:240px; font-size:11px; float:left; letter-spacing: 1px; text-align:left;"><?php echo nl2br($inv['state_name']); ?></td>
                        </tr>
                        <tr>
                            <td valign="top" style="width:45px; font-size:11px; float:left; letter-spacing: 1px; text-align:left; padding-top:5px;"><strong>Phone</strong><span style="text-align:right !important;"></span></td>
                            <td valign="top" style="padding-top:5px; width:10px; font-size:11px; float:left; letter-spacing: 1px; text-align:center;">:</td>
                            <td valign="top" style="padding-top:5px; width:240px; font-size:11px; float:left; letter-spacing: 1px; text-align:left;"><?php echo $inv['pi_phone']; ?></td>
                        </tr>
                        <tr>
                            <td valign="top" style="width:45px; font-size:11px; float:left; letter-spacing: 1px; text-align:left; padding-top:5px;"><strong>Email</strong><span style="text-align:right !important;"></span></td>
                            <td valign="top" style="padding-top:5px; width:10px; font-size:11px; float:left; letter-spacing: 1px; text-align:center;">:</td>
                            <td valign="top" style="padding-top:5px; width:240px; font-size:11px; float:left; letter-spacing: 1px; text-align:left;"><?php echo nl2br($inv['pi_email']); ?></td>
                        </tr>
                         
                        </table>
                </div>
            </td>
	<!-- <div style="width:100%;">CH A    :</div></td> -->
            <td valign="top" style="width:5cm;border-top:1px solid #e9494f; border-right:1px solid #e9494f; padding-top:0.2cm; padding-bottom:0.2cm; padding-left:0.1cm; padding-right:0.1cm;">
                <div style="width:98%; margin-top:0;">
                    <!-- <div style="width:100%; font-size:11px; float:left; letter-spacing: 1px;"> <span style="font-weight:bold;">Invoice No</span> : PI NV111310 </div> -->
                    <table style="width:100%;border-collapse:collapse;">
                        <tr>
                            <td valign="top" style="width:100px; padding-top:5px;font-size:11px; float:left; letter-spacing: 1px; text-align:left;"><strong>Your PO No.</strong><span style="text-align:right !important;"></span></td>
                            <td valign="top" style="padding-top:5px;width:10px; font-size:11px; float:left; letter-spacing: 1px; text-align:center;">:</td>
                            <td valign="top" style="padding-top:5px; width:140px; font-size:11px; float:left; letter-spacing: 1px; text-align:left;"><?php echo $inv['po_no'] ?></td>
                        </tr>
                        <tr>
                            <td valign="top" style="width:100px; font-size:11px; float:left; letter-spacing: 1px; text-align:left; padding-top:5px;"><strong>P.O. Date</strong><span style="text-align:right !important;"></span></td>
                            <td valign="top" style="padding-top:5px; width:10px; font-size:11px; float:left; letter-spacing: 1px; text-align:center;">:</td>
                            <td valign="top" style="padding-top:5px; width:140px; font-size:11px; float:left; letter-spacing: 1px; text-align:left;"><?php echo date("d-m-Y", strtotime($inv['po_enq_date'])); ?></td>
                        </tr>
                        <tr>
                            <td valign="top" style="width:100px; font-size:11px; float:left; letter-spacing: 1px; text-align:left; padding-top:5px;"><strong>P.I. No.</strong><span style="text-align:right !important;"></span></td>
                            <td valign="top" style="padding-top:5px; width:10px; font-size:11px; float:left; letter-spacing: 1px; text-align:center;">:</td>
                            <td valign="top" style="padding-top:5px; width:140px; font-size:11px; float:left; letter-spacing: 1px; text-align:left;"><?php echo $inv['pi_no']; ?></td>
                        </tr>
                        <tr>
                            <td valign="top" style="width:100px; font-size:11px; float:left; letter-spacing: 1px; text-align:left; padding-top:5px;"><strong>P.I. Date</strong><span style="text-align:right !important;"></span></td>
                            <td valign="top" style="padding-top:5px; width:10px; font-size:11px; float:left; letter-spacing: 1px; text-align:center;">:</td>
                            <td valign="top" style="padding-top:5px; width:140px; font-size:11px; float:left; letter-spacing: 1px; text-align:left;"><?php echo date("d-m-Y", strtotime($inv['pi_enq_date'])); ?></td>
                        </tr>
                        <tr>
                            <td valign="top" style="width:100px; font-size:11px; float:left; letter-spacing: 1px; text-align:left; padding-top:5px;"><strong>OUR GST NO.</strong><span style="text-align:right !important;"></span></td>
                            <td valign="top" style="padding-top:5px; width:10px; font-size:11px; float:left; letter-spacing: 1px; text-align:center;">:</td>
                            <td valign="top" style="padding-top:5px; width:140px; font-size:11px; float:left; letter-spacing: 1px; text-align:left;">24AAECM7879C1ZB</td>
                        </tr>
                        </table>
                </div>
            </td>
        </tr>
        <tr>
            <td valign="top" style="width:9cm; border-top:1px solid #e9494f; border-left:1px solid #e9494f; border-bottom:1px solid #e9494f; padding-top:0.2cm; padding-bottom:0.2cm; padding-left:0.1cm; padding-right:0.1cm;">
                    <div style="width:100%; margin-top:0;">
                        <table style="width:100%;border-collapse:collapse;">
                        <tr>
                            <td valign="top" style=" width:60px; font-size:11px; float:left; letter-spacing: 1px; text-align:left;"><strong>GST NO.</strong><span style="text-align:right !important;"></span></td>
                            <td valign="top" style=" width:10px; font-size:11px; float:left; letter-spacing: 1px; text-align:center;">:</td>
                            <td valign="top" style=" width:280px; font-size:11px; float:left; letter-spacing: 1px; text-align:left;"></strong><?php echo $inv['pi_gst']; ?></td>
                        </tr>
                        <tr>
                            <td valign="top" style="width:60px; font-size:11px; float:left; letter-spacing: 1px; text-align:left; padding-top:5px;"><strong>Kind Att.</strong><span style="text-align:right !important;"></span></td>
                            <td valign="top" style="padding-top:5px; width:10px; font-size:11px; float:left; letter-spacing: 1px; text-align:center;">:</td>
                            <td valign="top" style="padding-top:5px; width:280px; font-size:11px; float:left; letter-spacing: 1px; text-align:left;"><?php echo $inv['pi_con_person']; ?></td>
                        </tr>
                    </table>
                </div>
                        <!-- <div style="width:98%;font-size:11px;"><strong>GST NO. &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </strong><?php echo $inv['pi_gst']; ?></div>   
                        <br>        
                        <div style="width:98%; font-size:11px;"><strong>Kind Atten &nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </strong><?php echo $inv['pi_con_person']; ?></div> -->
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
    <table style="width:18cm; border-collapse:collapse; margin:0; padding:0; border-left:1px solid #e9494f;border-right:1px solid #e9494f; border-bottom:1px solid #e9494f;" autosize="0">
                 
                    <tr>
                        <td valign="middle" style="width: 1cm; border-left: 1px solid #e9494f; font-size:12px; letter-spacing: 1px; text-align:center; font-weight:bold;border-bottom:1px solid #e9494f;background-color:#f7bbbd;">Sr.No</td>
                        <td colspan="2" valign="middle" style="width: 6cm;border-left: 1px solid #e9494f; font-size:12px; float:left; letter-spacing: 1px; text-align:center; font-weight:bold;border-bottom:1px solid #e9494f;background-color:#f7bbbd;">Item Description</td>
                        <td valign="middle" style="width: 2cm; border-left: 1px solid #e9494f; font-size:12px; float:left; letter-spacing: 1px; text-align:center; font-weight:bold;border-bottom:1px solid #e9494f;background-color:#f7bbbd;">HSN Code</td>
                        <td valign="middle" style="width: 1cm; border-left: 1px solid #e9494f; font-size:12px; float:left; letter-spacing: 1px; text-align:center; font-weight:bold;border-bottom:1px solid #e9494f;background-color:#f7bbbd;">Qty</td>
                        <td valign="middle" style="width: 1cm; border-left: 1px solid #e9494f; font-size:12px; float:left; letter-spacing: 1px; text-align:center; font-weight:bold;border-bottom:1px solid #e9494f;background-color:#f7bbbd;">UNIT PRICE</td>
                        <?php if(isset($inv['pi_isdiscount']) && !empty($inv['pi_isdiscount']) && $inv['pi_isdiscount'] == 1) { ?>
                        <td valign="middle" style="width: 1cm; border-left: 1px solid #e9494f; font-size:12px; float:left; letter-spacing: 1px; text-align:center; font-weight:bold;border-bottom:1px solid #e9494f;background-color:#f7bbbd;">Disc.</td>
                        <?php } ?>
                        <?php if(isset($inv['pi_isdiscount']) && !empty($inv['pi_isdiscount']) && $inv['pi_isdiscount'] == 2) { ?>
                        <td colspan="3" valign="middle" style="width: 2cm; border-right: 1px solid #e9494f;border-left: 1px solid #e9494f; font-size:12px; float:left; letter-spacing: 1px; text-align:center; font-weight:bold;border-bottom:1px solid #e9494f;background-color:#f7bbbd;">Taxable Amount</td>
                       <?php } else { ?>
                       <td colspan="2" valign="middle" style="width: 2cm; border-right: 1px solid #e9494f;border-left: 1px solid #e9494f; font-size:12px; float:left; letter-spacing: 1px; text-align:center; font-weight:bold;border-bottom:1px solid #e9494f;background-color:#f7bbbd;">Taxable Amount</td>
                       <?php } ?>
                        <td  valign="middle" style="width: 1cm; border-left: 1px solid #e9494f; font-size:12px; float:left; letter-spacing: 1px; text-align:center; font-weight:bold;border-bottom:1px solid #e9494f;background-color:#f7bbbd;">GST%</td>
                       
                        <td  valign="middle" style="width: 1cm; border-left: 1px solid #e9494f; font-size:12px; float:left; letter-spacing: 1px; text-align:center; font-weight:bold;border-bottom:1px solid #e9494f;background-color:#f7bbbd;">Tax Amt</td>
                        <td colspan="2" valign="middle" style="width: 1cm; border-left: 1px solid #e9494f; font-size:12px; float:left; letter-spacing: 1px; text-align:center; font-weight:bold;border-bottom:1px solid #e9494f;background-color:#f7bbbd;">Total</td>
                       
                    </tr>
<?php //************************** top start *********************************
                    $itm_discount = 0; $gtotal = 0;
					$srno = 0; $finaltotal = 0; $withouttax = 0; $onlytax = 0; foreach ($items as $key => $item) { $srno++; ?>
<?php //******************not in use start *********** ?>

<?php //******************not in use end *********** ?>
                    <tr>
                        <td valign="middle" style="border-left: 1px solid #e9494f;border-bottom: 1px solid #e9494f;font-size:12px; letter-spacing: 1px; text-align:center;"><?php echo $srno; ?></td>
                        <td valign="middle" colspan="2" style="border-left: 1px solid #e9494f;border-bottom: 1px solid #e9494f;font-size:12px; float:left; letter-spacing: 1px; text-align:left;padding-left: 5px;"><strong><?php echo $item['pii_itm_title']; ?></strong><br>Part No:<?php echo $item['pii_itm']; ?><br/><?php echo nl2br($item['pii_itm_desc']); ?></td>
                        <td valign="middle" style="border-left: 1px solid #e9494f;border-bottom: 1px solid #e9494f;font-size:12px; float:left; letter-spacing: 1px; text-align:center;"><?php echo $item['hsn_hcode']; ?></td>
                        <td valign="middle" style="border-left: 1px solid #e9494f;border-bottom: 1px solid #e9494f;font-size:12px; float:left; letter-spacing: 1px; text-align:center;"><?php echo $item['pii_itm_qty']; ?></td>
                        <td valign="middle" style="border-left: 1px solid #e9494f;border-bottom: 1px solid #e9494f;font-size:12px; letter-spacing: 1px; text-align:center;"><?php echo number_format($item['pii_itm_price']); ?></td>
                        <?php if(isset($inv['pi_isdiscount']) && !empty($inv['pi_isdiscount']) && $inv['pi_isdiscount'] == 1) { ?>
                        <td valign="middle" style="border-left: 1px solid #e9494f;border-bottom: 1px solid #e9494f;font-size:12px; letter-spacing: 1px; text-align:center;"><?php echo number_format($item['pii_itm_discount']).'%'; ?></td>
                        <?php } ?>
                        <?php if(isset($inv['pi_isdiscount']) && !empty($inv['pi_isdiscount']) && $inv['pi_isdiscount'] == 2) { ?>
                        <td colspan="3" valign="middle" style="border-left: 1px solid #e9494f;border-bottom: 1px solid #e9494f;font-size:12px; float:left; letter-spacing: 1px; text-align:center;"><?php $subttl = $item['pii_itm_qty'] * number_format($item['pii_itm_price'], 2, '.', '');
                         echo ($subttl); ?></td> 
                         <?php $withouttax = $withouttax + number_format($subttl, 2, '.', '');  ?> 
                         <?php } else { ?>   
                         <td colspan="2" valign="middle" style="border-left: 1px solid #e9494f;border-bottom: 1px solid #e9494f;font-size:12px; float:left; letter-spacing: 1px; text-align:center;"><?php $subttl = $item['pii_itm_qty'] * number_format($item['pii_itm_price'], 2, '.', '');
                         echo ($subttl) - (($subttl) * $item['pii_itm_discount'] / 100); ?></td> 
                         <?php $withouttax = $withouttax + number_format($subttl, 2, '.', '');  ?> 
                         <?php } ?>                    
						<td valign="middle" style="border-left: 1px solid #e9494f;border-bottom: 1px solid #e9494f;font-size:12px; float:left; letter-spacing: 1px; text-align:center;"><?php echo number_format($item['pii_itm_gst_per']); ?></td>
                        <td valign="middle" style="border-left: 1px solid #e9494f;border-bottom: 1px solid #e9494f;font-size:12px; letter-spacing: 1px; text-align:center;">
                            <?php $gstrate = 0;
                                $ftotal = 0;
                            if(isset($inv['pi_isdiscount']) && !empty($inv['pi_isdiscount']) && $inv['pi_isdiscount'] == 1) {
                            $disc = (($subttl*$item['pii_itm_discount'])/100);
                                $totwithdisc = $subttl - $disc;
                                $gstrate = ($totwithdisc * $item['pii_itm_gst_per'])/100;
                                $ftotal = $totwithdisc + $gstrate;
                            }
                            if(isset($inv['pi_isdiscount']) && !empty($inv['pi_isdiscount']) && $inv['pi_isdiscount'] == 2) {
                                $gstrate = ($subttl * $item['pii_itm_gst_per'])/100;
                                $ftotal = $subttl + $gstrate;
                            }
                        echo number_format($gstrate); ?>
                        <?php $onlytax = $onlytax + number_format($gstrate, 2, '.', '');  ?></td>
                        <td colspan="2" valign="middle" style="border-left: 1px solid #e9494f;border-bottom: 1px solid #e9494f;font-size:12px; letter-spacing: 1px; text-align:right;"><?php 
                        echo number_format($ftotal, 2, '.', '');
                         //$finaltotal = $finaltotal + number_format($$ftotal, 2, '.', ''); ?></td>
                        <?php  
                        $gtotal = $gtotal + number_format($ftotal, 2, '.', '');
                        //echo $ftotal; 
                        ?> 
                    </tr>
                    <?php /*?><?php foreach($item['taxar'] as $taxd)
					{ ?>
                   
					<?php }?><?php */?>
<?php //******************not in use start *********** ?>
<?php //******************not in use end *********** ?>
                    <?php } //die;//************************** top stop**************  ?>
<?php //***************************************** BOM start ********************** ?>
					<?php foreach ($extra as $key => $extra) { $srno++  ?>
                    <tr>
                            <td valign="top" style="border-bottom: 1px solid #e9494f; border-left: 1px solid #e9494f; font-size:12px; float:left; letter-spacing: 1px; text-align:center; color:#000; "><?php echo $srno; ?></td>
                            <td colspan="2" valign="top" style="border-bottom: 1px solid #e9494f; border-left: 1px solid #e9494f; font-size:12px; float:left; letter-spacing: 1px; text-align:left; color:#000;"><strong><?php echo $extra['pi_extra_descriptio']; ?></strong></td>
                            <td valign="top" style="border-bottom: 1px solid #e9494f; border-left: 1px solid #e9494f; font-size:12px; float:left; letter-spacing: 1px; text-align:center; color:#000;"></td>
                            <td valign="top" style="border-bottom: 1px solid #e9494f; border-left: 1px solid #e9494f; font-size:12px; float:left; letter-spacing: 1px; text-align:right; color:#000;text-align:center;"><?php echo $extra['pi_extra_qty']; ?></td>
                            <td valign="top" style="border-bottom: 1px solid #e9494f; border-left: 1px solid #e9494f; font-size:12px; float:left; letter-spacing: 1px; text-align:right; color:#000;text-align:center;"><?php echo $extra['pi_extra_price']; ?></td>
                            <?php if(isset($inv['pi_isdiscount']) && !empty($inv['pi_isdiscount']) && $inv['pi_isdiscount'] == 1) { ?>
                            <td valign="top" style="border-bottom: 1px solid #e9494f; border-left: 1px solid #e9494f; font-size:12px; float:left; letter-spacing: 1px; text-align:right; color:#000;"></td>
                            <?php } ?>
                            <?php if(isset($inv['pi_isdiscount']) && !empty($inv['pi_isdiscount']) && $inv['pi_isdiscount'] == 2) { ?>
                            <td valign="top" colspan="3" style="border-bottom: 1px solid #e9494f; border-left: 1px solid #e9494f; font-size:12px; float:left; letter-spacing: 1px; text-align:center; color:#000;"></td>
                           <?php } else { ?>
                           <td valign="top" colspan="2" style="border-bottom: 1px solid #e9494f; border-left: 1px solid #e9494f; font-size:12px; float:left; letter-spacing: 1px; text-align:center; color:#000;"></td>
                           <?php } ?>
                            <?php $withouttax = $withouttax + $inv['pi_taxbleamount']; ?>     
                            <td valign="top" style="border-bottom: 1px solid #e9494f; border-left: 1px solid #e9494f; font-size:12px; float:left; letter-spacing: 1px; text-align:center; color:#000;"></td>
                            <td valign="top" style="border-bottom: 1px solid #e9494f; border-left: 1px solid #e9494f; font-size:12px; float:left; letter-spacing: 1px; text-align:center; color:#000;"></td>
                            <?php $onlytax = $onlytax + $inv['pi_taxamount']; ?>
                            <td colspan="2" valign="top" style="border-bottom: 1px solid #e9494f; border-left: 1px solid #e9494f; font-size:12px; float:left; letter-spacing: 1px; text-align:right; color:#000;text-align:center;"><?php echo $extra['pi_extra_total']; ?></td>
                            <?php $gtotal = $gtotal + number_format($extra['pi_extra_total'], 2, '.', ''); ?>
                    </tr>
                    <?php } ?>
        
                    <?php if($srno < 6){
                        for ($i=$srno; $i < 10 ; $i++) {  ?>
                            <tr>
                                <td valign="top" style="border-left: 1px solid #e9494f; font-size:12px; float:left; letter-spacing: 1px; text-align:center; color:#ffffff;">1</td>
                                <td colspan="2" valign="top" style="border-left: 1px solid #e9494f; font-size:12px; float:left; letter-spacing: 1px; text-align:left; color:#ffffff;">TERMINAL</td>
                                <td valign="top" style="border-left: 1px solid #e9494f; font-size:12px; float:left; letter-spacing: 1px; text-align:right; color:#ffffff;">8.21</td>
                                <td valign="top" style="border-left: 1px solid #e9494f; font-size:12px; float:left; letter-spacing: 1px; text-align:right; color:#ffffff;">1.642</td>
                                <td valign="top" style="border-left: 1px solid #e9494f; font-size:12px; float:left; letter-spacing: 1px; text-align:right; color:#ffffff;">8.21</td>
                                <?php if(isset($inv['pi_isdiscount']) && !empty($inv['pi_isdiscount']) && $inv['pi_isdiscount'] == 1) { ?>
                                <td valign="top" style="border-left: 1px solid #e9494f; font-size:12px; float:left; letter-spacing: 1px; text-align:right; color:#ffffff;">8.21</td>
                                <?php } ?>
                                <?php if(isset($inv['pi_isdiscount']) && !empty($inv['pi_isdiscount']) && $inv['pi_isdiscount'] == 2) { ?>
                                <td colspan="3" valign="top" style="border-left: 1px solid #e9494f; font-size:12px; float:left; letter-spacing: 1px; text-align:right; color:#ffffff;">8.21</td>
                                <?php } else { ?>
                                <td colspan="2" valign="top" style="border-left: 1px solid #e9494f; font-size:12px; float:left; letter-spacing: 1px; text-align:right; color:#ffffff;">8.21</td>
                                <?php } ?>
                                <td valign="top" style="border-left: 1px solid #e9494f; font-size:12px; float:left; letter-spacing: 1px; text-align:right; color:#ffffff;">8.21</td>                                
                                <td valign="top" style=" border-left: 1px solid #e9494f; font-size:12px; float:left; letter-spacing: 1px; text-align:right; color:#ffffff;">8.21</td>
                                <td colspan="2" valign="top" style="border-left: 1px solid #e9494f; font-size:12px; float:left; letter-spacing:1px; text-align:right; color:#ffffff;">64.500000</td>
                            </tr> 
                       <?php }
                        } ?>
                        <!-- <tr>
                            <td valign="top" style="border-bottom: 1px solid #e9494f; border-left: 1px solid #e9494f; font-size:12px; float:left; letter-spacing: 1px; text-align:center; color:#fffffff;">1</td>
                            <td colspan="2" valign="top" style="border-bottom: 1px solid #e9494f; border-left: 1px solid #e9494f; font-size:12px; float:left; letter-spacing: 1px; text-align:left; color:#fffffff;">TERMINAL</td>
                            <td valign="top" style="border-bottom: 1px solid #e9494f; border-left: 1px solid #e9494f; font-size:12px; float:left; letter-spacing: 1px; text-align:right; color:#fffffff;">8.21</td>
                            <td valign="top" style="border-bottom: 1px solid #e9494f; border-left: 1px solid #e9494f; font-size:12px; float:left; letter-spacing: 1px; text-align:right; color:#fffffff;">1.642</td>
                            <td  valign="top" style="border-bottom: 1px solid #e9494f; border-left: 1px solid #e9494f; font-size:12px; float:left; letter-spacing: 1px; text-align:right; color:#fffffff;">8.21</td>
                            <td  valign="top" style="border-bottom: 1px solid #e9494f; border-left: 1px solid #e9494f; font-size:12px; float:left; letter-spacing: 1px; text-align:right; color:#fffffff;">8.21</td>
                            <td  colspan="2" valign="top" style="border-bottom: 1px solid #e9494f; border-left: 1px solid #e9494f; font-size:12px; float:left; letter-spacing: 1px; text-align:right; color:#fffffff;">8.21</td>
                            <td valign="top" style="border-bottom: 1px solid #e9494f; border-left: 1px solid #e9494f; font-size:12px; float:left; letter-spacing: 1px; text-align:right; color:#fffffff;">8.21</td>                            
                            <td valign="top" style="border-bottom: 1px solid #e9494f; border-left: 1px solid #e9494f; font-size:12px; float:left; letter-spacing: 1px; text-align:right; color:#fffffff;">8.21</td>
                            <td colspan="2" valign="top" style="border-bottom: 1px solid #e9494f; border-left: 1px solid #e9494f; font-size:12px; float:left; letter-spacing: 1px; text-align:right; color:#fffffff;">64.500000</td>
                        </tr> -->
                        
                    
                    <tr>
                            <td valign="top" style="border-bottom: 1px solid #e9494f; border-top: 1px solid #e9494f; border-left: 1px solid #e9494f; font-size:12px; float:left; letter-spacing: 1px; text-align:center; color:#000; "></td>
                            <td colspan="2" valign="top" style="border-bottom: 1px solid #e9494f; border-top: 1px solid #e9494f; border-left: 1px solid #e9494f; font-size:12px; float:left; letter-spacing: 1px; text-align:left; color:#000;"><strong>P & F</strong></td>
                            <td valign="top" style="border-bottom: 1px solid #e9494f; border-top: 1px solid #e9494f; border-left: 1px solid #e9494f; font-size:12px; float:left; letter-spacing: 1px; text-align:center; color:#000;"><?php echo $inv['pi_hsncode'] ?></td>
                            <td valign="top" style="border-bottom: 1px solid #e9494f; border-top: 1px solid #e9494f; border-left: 1px solid #e9494f; font-size:12px; float:left; letter-spacing: 1px; text-align:right; color:#000;"></td>
                            <td valign="top" style="border-bottom: 1px solid #e9494f; border-top: 1px solid #e9494f; border-left: 1px solid #e9494f; font-size:12px; float:left; letter-spacing: 1px; text-align:right; color:#000;"></td>
                            <?php if(isset($inv['pi_isdiscount']) && !empty($inv['pi_isdiscount']) && $inv['pi_isdiscount'] == 1) { ?>
                            <td valign="top" style="border-bottom: 1px solid #e9494f; border-top: 1px solid #e9494f; border-left: 1px solid #e9494f; font-size:12px; float:left; letter-spacing: 1px; text-align:right; color:#000;"></td>
                            <?php } ?>
                            <?php if(isset($inv['pi_isdiscount']) && !empty($inv['pi_isdiscount']) && $inv['pi_isdiscount'] == 2) { ?>
                            <td valign="top" colspan="3" style="border-bottom: 1px solid #e9494f; border-top: 1px solid #e9494f; border-left: 1px solid #e9494f; font-size:12px; float:left; letter-spacing: 1px; text-align:center; color:#000;"><?php echo number_format($inv['pi_taxbleamount'], 2, '.', ''); ?></td>
                           <?php } else { ?>
                           <td valign="top" colspan="2" style="border-bottom: 1px solid #e9494f; border-top: 1px solid #e9494f; border-left: 1px solid #e9494f; font-size:12px; float:left; letter-spacing: 1px; text-align:center; color:#000;"><?php echo number_format($inv['pi_taxbleamount'], 2, '.', ''); ?></td>
                           <?php } ?>
                            <?php $withouttax = $withouttax + $inv['pi_taxbleamount']; ?>     
                            <td valign="top" style="border-bottom: 1px solid #e9494f; border-top: 1px solid #e9494f; border-left: 1px solid #e9494f; font-size:12px; float:left; letter-spacing: 1px; text-align:center; color:#000;"><?php echo number_format($inv['pi_pfgst'], 2, '.', ''); ?></td>
                            <td valign="top" style="border-bottom: 1px solid #e9494f; border-top: 1px solid #e9494f; border-left: 1px solid #e9494f; font-size:12px; float:left; letter-spacing: 1px; text-align:center; color:#000;"><?php echo number_format($inv['pi_taxamount'], 2, '.', ''); ?></td>
                            <?php $onlytax = $onlytax + $inv['pi_taxamount']; ?>
                            <td colspan="2" valign="top" style="border-bottom: 1px solid #e9494f; border-top: 1px solid #e9494f; border-left: 1px solid #e9494f; font-size:12px; float:left; letter-spacing: 1px; text-align:right; color:#000;"><?php echo number_format($inv['pi_grandtotal'], 2, '.', ''); ?></td>
                            <?php $gtotal = $gtotal + number_format($inv['pi_grandtotal'], 2, '.', ''); ?>
                    </tr>
                     <tr>
                            <td valign="top" style="border-bottom: 1px solid #e9494f; border-left: 1px solid #e9494f; font-size:12px; float:left; letter-spacing: 1px; text-align:center; color:#000;"></td>
                            <td colspan="2" valign="top" style="border-bottom: 1px solid #e9494f; border-left: 1px solid #e9494f; font-size:12px; float:left; letter-spacing: 1px; text-align:left; color:#000;"><strong>Freight</strong></td>
                            <td valign="top" style="border-bottom: 1px solid #e9494f; border-left: 1px solid #e9494f; font-size:12px; float:left; letter-spacing: 1px; text-align:center; color:#000;"><?php echo $inv['pi_fright_hsncode'] ?></td>
                            <td valign="top" style="border-bottom: 1px solid #e9494f; border-left: 1px solid #e9494f; font-size:12px; float:left; letter-spacing: 1px; text-align:center; color:#000;"></td> 
                             <td valign="top" style="border-bottom: 1px solid #e9494f; border-left: 1px solid #e9494f; font-size:12px; float:left; letter-spacing: 1px; text-align:center; color:#000;"></td> 
                            <?php if(isset($inv['pi_isdiscount']) && !empty($inv['pi_isdiscount']) && $inv['pi_isdiscount'] == 1) { ?>
                            <td valign="top" style="border-bottom: 1px solid #e9494f; border-left: 1px solid #e9494f; font-size:12px; float:left; letter-spacing: 1px; text-align:center; color:#000;"></td> 
                            <?php } ?>
                            <?php if(isset($inv['pi_isdiscount']) && !empty($inv['pi_isdiscount']) && $inv['pi_isdiscount'] == 2) { ?>
                            <td valign="top" colspan="3" style="border-bottom: 1px solid #e9494f; border-left: 1px solid #e9494f; font-size:12px; float:left; letter-spacing: 1px; text-align:center; color:#000;"><?php echo number_format($inv['pi_fright_taxbleamount'], 2, '.', ''); ?></td> 
                           <?php } else { ?>
                           <td valign="top" colspan="2" style="border-bottom: 1px solid #e9494f; border-left: 1px solid #e9494f; font-size:12px; float:left; letter-spacing: 1px; text-align:center; color:#000;"><?php echo number_format($inv['pi_fright_taxbleamount'], 2, '.', ''); ?></td> 
                           <?php } ?>                           
                            <?php $withouttax = $withouttax + $inv['pi_fright_taxbleamount']; ?>                            
                            <td valign="top" style="border-bottom: 1px solid #e9494f; border-left: 1px solid #e9494f; font-size:12px; float:left; letter-spacing: 1px; text-align:center; color:#000;"><?php echo number_format($inv['pi_fright_pfgst'], 2, '.', ''); ?></td>
                            <td valign="top" style="border-bottom: 1px solid #e9494f; border-left: 1px solid #e9494f; font-size:12px; float:left; letter-spacing: 1px; text-align:center; color:#000;"><?php echo number_format($inv['pi_fright_taxamount'], 2, '.', ''); ?></td>
                            <?php $onlytax = $onlytax + $inv['pi_fright_taxamount']; ?>
                            <td colspan="2" valign="top" style="border-bottom: 1px solid #e9494f; border-left: 1px solid #e9494f;font-size:12px; float:left; letter-spacing: 1px; text-align:right; color:#000;"><?php echo number_format($inv['pi_fright_grandtotal'], 2, '.', ''); ?></td>
                            <?php $gtotal = $gtotal + number_format($inv['pi_fright_grandtotal'], 2, '.', ''); ?>
                    </tr>
                  
                   
                   <!--  <tr>
                        <td colspan="8" style="border-right:1px solid #e9494f;border-left:1px solid #e9494f;border-bottom:1px solid #e9494f;font-family: 'Arial Black', Gadget, sans-serif;font-size:14px; text-align:left;"><?php //echo $inv['pi_grd_ttl_words'] ?></td>
                        <td colspan="2" style="border-right:1px solid #e9494f;border-left:1px solid #e9494f;border-bottom:1px solid #e9494f;font-family: 'Arial Black', Gadget, sans-serif;font-size:14px; text-align:right;"><strong>SUBTOTAL</strong></td>
                        <td style="border-right:1px solid #e9494f;border-left:1px solid #e9494f;border-bottom:1px solid #e9494f;font-family: 'Arial Black', Gadget, sans-serif;font-size:14px; text-align:right;"><strong><?php echo number_format($finaltotal, 2, '.', ''); ?></strong></td>
                    </tr> -->
                    <?php /* if(isset($inv['pi_isdiscount']) && !empty($inv['pi_isdiscount']) && $inv['pi_isdiscount'] == 1) { ?>
                    <tr>
                        <?php $totaldisc = (($itm_discount * $finaltotal)/100); ?>
                        <td colspan="6" style="border-right:1px solid #e9494f;border-left:1px solid #e9494f;border-bottom:1px solid #e9494f;font-family: 'Arial Black', Gadget, sans-serif;font-size:14px; text-align:left;"><?php //echo $inv['pi_grd_ttl_words'] ?></td>
                        <td colspan="2" valign="top" style="border-bottom: 1px solid #e9494f; border-left: 1px solid #e9494f; font-size:11px; float:left; letter-spacing: 1px; text-align:right; color:#edf2f8;"><strong><?php echo number_format($disc, 2, '.', ''); ?></strong></td>
                        <td style="border-right:1px solid #e9494f;border-left:1px solid #e9494f;border-bottom:1px solid #e9494f;font-family: 'Arial Black', Gadget, sans-serif;font-size:14px; text-align:right;"><strong></strong></td>
                        <td style="border-right:1px solid #e9494f;border-left:1px solid #e9494f;border-bottom:1px solid #e9494f;font-family: 'Arial Black', Gadget, sans-serif;font-size:14px; text-align:right;"><strong><?php echo number_format($disc, 2, '.', ''); ?></strong></td>
                        <td colspan="3" style="border-right:1px solid #e9494f;border-left:1px solid #e9494f;border-bottom:1px solid #e9494f;font-family: 'Arial Black', Gadget, sans-serif;font-size:14px; text-align:right;"><strong><?php echo number_format($totaldisc, 2, '.', ''); ?></strong></td>
                        <?php */ /*?><td style="border-right:1px solid #e9494f;border-left:1px solid #e9494f;border-bottom:1px solid #e9494f;"></td><?php */ /*?>
                    </tr>
                    <?php  $disc = $finaltotal - (($itm_discount * $finaltotal)/100); } else { $disc = $finaltotal; } */ ?>
                     <tr>
                        <?php// $disc = $finaltotal - (($itm_discount * $finaltotal)/100); ?>
                        <td colspan="7" height="25" style="border-left:1px solid #e9494f;border-bottom:1px solid #e9494f;font-family: 'Arial Black', Gadget, sans-serif;font-size:13px; text-align:right;background-color:#fad1d3;"><strong>Total:</strong></td>
                        <td colspan="2" height="25" style="border-left:1px solid #e9494f;border-bottom:1px solid #e9494f;font-family: 'Arial Black', Gadget, sans-serif;font-size:13px; text-align:center;background-color:#fad1d3;"><strong><?php echo number_format($withouttax, 2, '.', ''); ?></strong></td>
                        <td height="25" style="border-left:1px solid #e9494f;border-bottom:1px solid #e9494f;font-family: 'Arial Black', Gadget, sans-serif;font-size:13px; text-align:center;background-color:#fad1d3;"></td>
                        <td height="25" style="border-left:1px solid #e9494f;border-bottom:1px solid #e9494f;font-family: 'Arial Black', Gadget, sans-serif;font-size:13px; text-align:center;background-color:#fad1d3;"><strong><?php echo number_format($onlytax, 2, '.', ''); ?></strong></td>
                        <td height="25" colspan="2" style="border-left:1px solid #e9494f;border-bottom:1px solid #e9494f;font-family: 'Arial Black', Gadget, sans-serif;font-size:13px; text-align:right;background-color:#fad1d3;"><strong><?php echo number_format($gtotal, 2, '.', ''); ?></strong></td>
                        <?php /*?><td style="border-right:1px solid #e9494f;border-left:1px solid #e9494f;border-bottom:1px solid #e9494f;"></td><?php */?>
                    </tr>
                    <tr>
                        <?php// $disc = $finaltotal - (($itm_discount * $finaltotal)/100); ?>
                        <td colspan="7" height="25" style="border-right:1px solid #e9494f;border-left:1px solid #e9494f;border-bottom:1px solid #e9494f;font-family: 'Arial Black', Gadget, sans-serif;font-size:12px; text-align:left;background-color:#fad1d3;"><strong><?php 
                        //$ffgtotal = float $gtotal;

                        echo getIndianCurrency(round($gtotal)); ?></strong></td>
                        <!-- <td style="border-right:1px solid #e9494f;border-left:1px solid #e9494f;border-bottom:1px solid #e9494f;font-family: 'Arial Black', Gadget, sans-serif;font-size:14px; text-align:right;"></td> -->
                        <td colspan="3" height="25" valign="middle" style="border-bottom: 1px solid #e9494f; border-left: 1px solid #e9494f; font-size:13px; float:left; letter-spacing: 1px; text-align:right;background-color:#fad1d3;"><strong>Grand Total:</strong></td>
                        
                        
                        <td colspan="3" height="25" style="border-left:1px solid #e9494f;border-bottom:1px solid #e9494f;font-family: 'Arial Black', Gadget, sans-serif;font-size:13px; text-align:right;background-color:#fad1d3;"><strong><?php echo number_format(round($gtotal), 2, '.', ''); ?></strong></td>
                        <?php /*?><td style="border-right:1px solid #e9494f;border-left:1px solid #e9494f;border-bottom:1px solid #e9494f;"></td><?php */?>
                    </tr>
                    <tr>
                        <td colspan="9" style="height:15px;border-bottom:1px solid #e9494f;"></td>
                        <td colspan="2" style="height:15px;border-bottom:1px solid #e9494f;"></td>
                    </tr>
        </table>
    	<table style="width:18cm;border-collapse:collapse; margin:0; padding:0;">
        
                    <tr>
                        <td valign="top" style="text-align:left; border-left:1px solid #e9494f;border-bottom:1px solid #e9494f; font-size:12.5px; height: 70px; width: 63%; padding-right: 1%; padding-left: 1%; padding-top: 1%; padding-bottom: 1%;">
                            <div style="height:70px; color:#e41f26; font-size:13px;"><?php echo $inv['pi_payment_term']; ?></div>
                            <div style="font-size:13px;"><strong>Delivery : <?php echo $inv['pi_delivery']; ?></strong></div>
                            <div style="font-size:12px;">Subject to ahmedabad jurisdiction only.</div>           
                            <div style="font-size:12px;">No allowance for shortage, mistake in any way or</div>
                            <div style="font-size:12px;">loss in transit will be entertaine unless notice is</div>
                            <div style="font-size:12px;">given within seven days on receipt of goods.</div>
                        </td>                        
                        <td valign="top" style="border-left:1px solid #e9494f;border-bottom:1px solid #e9494f; border-right: 1px solid #e9494f;font-size:13.5px;height: 70px; width: 40%; padding-right: 1%; padding-left: 1%; padding-top: 1%; padding-bottom: 1%; text-align:left;">
                            <div style="font-size:13px;"><strong>Prepared By</strong></div>
                            <div style="font-size:12px;color:#e41f26;"><strong><?php echo $inv['au_fname']; ?> <?php echo $inv['au_lname']; ?></strong></div>
                            <div style="font-size:12px;color:#e41f26;">M : <?php echo $inv['au_mo_no']; ?></div>
                            <div style="font-size:12px;color:#e41f26;">Email : <?php echo $inv['au_gmail_email']; ?></div>
                            <br>
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