<?php
//echo "hiii";
//echo '<pre>'; print_r($inv);die;
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
	input[type="checkbox"]{
  		width: 60px; /*Desired width*/
  		height: 60px; /*Desired height*/
	}
</style>
</head>
<body>
<div class="page">
<div style="width:18cm; margin:0 auto;padding-top:50px; font-family: 'Tahoma';">
    <table style="width:18cm;border-collapse:collapse; margin-top:-110px;">
        <tr>
            <td colspan="2" style="width:18cm; float:left;"><img src="<?php echo base_url(); ?>assets/custom/images/letterhead-tea3.jpg"/></td>
        </tr>
    </table>
    <table style="width:18cm;border-collapse:collapse;">
        <tr nobr="true">
            <td colspan="2" style="width:18cm; color:#999999; padding-top: 10px; padding-bottom:0.3cm; text-align:center;font-size:17px; text-transform: uppercase; font-weight:bold; letter-spacing: 2px;"></td>
        </tr>
        <tr>
            <td valign="top" style="width:6cm; border-top:1px solid #333333; border-left:1px solid #333333; border-right:1px solid #333333; border-bottom:1px solid #333333; padding-top:0.2cm; padding-bottom:0.2cm; padding-left:0.1cm; padding-right:0.1cm;">
            <table style="width:100%;border-collapse:collapse;">
                        <tr>
                            <td valign="top" style=" width:25%; font-size:14px; float:left; letter-spacing: 1px; text-align:left;"><strong>Name</strong><span style="text-align:right !important;"></span></td>
                            <td valign="top" style=" width:5%; font-size:14px; float:left; letter-spacing: 1px; text-align:center;">:</td>
                            <td valign="top" style=" width:65%; font-size:14px; float:left; letter-spacing: 1px; text-align:left;"><?php echo $inv['ord_name'];?></td>
                        </tr>
                        </table>
            
            <td valign="top" style="width:6cm; border-top:1px solid #333333; border-right:1px solid #333333; border-bottom:1px solid #333333; padding-top:0.2cm; padding-bottom:0.2cm; padding-left:0.1cm; padding-right:0.1cm;">
                <div style="width:100%; margin-top:0;">
                    <!-- <div style="width:100%; font-size:12px; float:left; letter-spacing: 1px;"> <span style="font-weight:bold;">Invoice No</span> : PI NV111310 </div> -->
                    <table style="width:100%;border-collapse:collapse;">
                        <tr>
                            <td valign="top" style=" width:20%; font-size:14px; float:left; letter-spacing: 1px; text-align:left;"><strong>Date</strong><span style="text-align:right !important;"></span></td>
                            <td valign="top" style=" width:5%; font-size:14px; float:left; letter-spacing: 1px; text-align:center;">:</td>
                            <td valign="top" style=" width:70%; font-size:14px; float:left; letter-spacing: 1px; text-align:left;"><?php echo date("d-m-Y", strtotime($inv['ord_date']));?></td>
                        </tr>
                        
                    </table>
                </div>
            </td>
        </tr>
        <tr>
            <td colspan="2" valign="top" style="width:6cm; border-right:1px solid #333333; border-left:1px solid #333333; border-bottom:1px solid #333333; padding-top:0.2cm; padding-bottom:0.2cm; padding-left:0.1cm; padding-right:0.1cm;" >
                <div style="width:100%; margin:0;">
                    <div style="width:100%; margin:0;">
                         <?php foreach($product as $products){ //echo "hii"?>
                        <table style="width:100%;border-collapse:collapse;">
                            <tr>
                                <td valign="top" style="padding-top:5px;font-size:18px; float:left; letter-spacing: 1px; text-align:center;"><strong><?php echo $products['name'];?></strong>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </td>
        </tr>
        <tr>
            <td colspan="2" style="width:100%;border-collapse:collapse; margin:0; padding:0;">
             
                <table border="0" style="width:100%; border-collapse:collapse; margin:0; padding:0;">
                    <tr>
                        <td valign="middle" style="width:1cm; border-left: 1px solid #333333; font-size:14px; letter-spacing: 1px; text-align:center; border-bottom:1px solid #333333;background-color:#f9f4eb; padding:0 18px;border-top:1px solid #333333;">Sr.No</td>
                        <td valign="middle" style="width:6cm;  border-left: 1px solid #333333; font-size:14px; float:left; letter-spacing:1px; text-align:center; border-bottom:1px solid #333333; background-color:#f9f4eb; padding:5px;border-top:1px solid #333333;">Product in Weight</td>
                         <td valign="middle" style="width:4cm; border-bottom: 1px solid #333333; border-left: 1px solid #333333; font-size:14px; float:left; letter-spacing: 2px; text-align:center; background-color:#f9f4eb;padding:5px;border-top:1px solid #333333;">Product Quantity</td>
                        <td colspan="2" valign="middle" style="width:8cm; border-bottom: 1px solid #333333; border-left: 1px solid #333333; border-right: 1px solid #333333; font-size:14px; float:left;padding:5px; letter-spacing: 1px; text-align:center; background-color:#f9f4eb;border-top:1px solid #333333;">Total</td>
                    </tr>
<?php //************************** top start *********************************
//echo '<pre>';print_r($items);die;
					//$srno = 0; foreach ($items as $key => $item) { $srno++; ?>
<?php //******************not in use start *********** ?>
                    <tr>
                        <td style="border-left: 1px solid #333333; border-right: 1px solid #333333;"></td>
                        <td style="border-left: 1px solid #333333;"></td>
                        <td style="border-left: 1px solid #333333;"></td>
                        <td colspan="2" style="border-left: 1px solid #333333;border-right: 1px solid #333333;"></td>
                    </tr>
<?php //******************not in use end *********** ?>
 <?php $srno = 0; foreach($products['sub_values'] as $subvalue){ $srno++; ?>
                    <tr>
                        <td style="border-left: 1px solid #333333;font-size:14px; letter-spacing: 1px; text-align:center;"><?php echo $srno;?></td>
                        <td style="border-left: 1px solid #333333;font-size:14px; float:left; letter-spacing: 1px; text-align:center;"><strong><?php echo $subvalue['weight'];  ?></td>
                        <td style="border-left: 1px solid #333333;font-size:14px; float:left; letter-spacing: 1px; text-align:center;"><?php echo $subvalue['orderqty'];  ?></td>
                        <td colspan="2" style="border-left: 1px solid #333333;border-right: 1px solid #333333;font-size:14px; float:left; letter-spacing: 1px; text-align:center;"><?php $total = $subvalue['weight'] * $subvalue['orderqty'];
						echo $total;
						?>(in kg)
                        </td>
                       
                    </tr>
         <?php } ?>
                   
<?php //******************not in use start *********** ?>
                    <tr>
                        <td style="border-left: 1px solid #333333;border-bottom:1px solid #333333;"></td>
                        <td style="border-left: 1px solid #333333;border-bottom:1px solid #333333;"></td>
                        <td style="border-left: 1px solid #333333;border-bottom:1px solid #333333;"></td>
                        <td colspan="2" style="border-left: 1px solid #333333;border-right: 1px solid #333333;border-bottom:1px solid #333333;"></td>
                    </tr>

                     
                    </tr>
                </table>
            </td>
        </tr>
        
      <?php } ?>
        <tr>
            <td valign="top" colspan="2" style="width:100%;border-collapse:collapse; margin:0; padding-top:10px;">
                <table style="width:100%;border-collapse:collapse; margin:0; padding:0;">
                    <tr>
                        <td valign="top" style="text-align:left; border:1px solid #333333; font-size:14px;font-family: 'Tahoma'; height: 40px; width:3%; padding-right: 1%; padding-left: 1%; padding-top: 1%; padding-bottom: 1%; ">
                             <?php /*?><input class="checkbox" type="checkbox" id="inlineCheckbox1" value="option1"><?php */?>              				<?php if($inv['ord_market_dangle'] == 'yes'){ ?> 
                             <img src="<?php echo base_url(); ?>assets/custom/images/checked_checkbox32.png"/>
							 <?php  } else { ?>
                              <img src="<?php echo base_url(); ?>assets/custom/images/unchecked_checkbox32.png"/>
                             <?php } ?>
                        </td>
                        <td colspan="2" valign="top" style="border:1px solid #333333; font-size:14px;font-family: 'Tahoma'; height: 40px; width: 12%; padding-right: 1%; padding-left: 1%; padding-top: 1%; padding-bottom: 1%; text-align:left;">
                               Marketing Dangles<br/>(3 piece/20 kg)<br/><br/>
                        </td>
                        <td valign="top" style="text-align:left; border:1px solid #333333; font-size:14px;font-family: 'Tahoma'; height: 40px; width: 8%; padding-right: 1%; padding-left: 1%; padding-top: 1%; padding-bottom: 1%; ">
                            Discount
                        </td>
                        <td colspan="2"  valign="top" style="border:1px solid #333333; font-size:14px;font-family: 'Tahoma'; height: 40px; width: 65%; padding-right: 1%;padding-left: 1%; padding-top: 1%; padding-bottom: 1%; text-align:left;">
                               - (If order more than 30kg per field then give discount 30rs)<br/><br/><br/>
                        </td>
                    </tr>
                    <tr>
                        <td valign="top" style="text-align:left; border:1px solid #333333; font-size:14px;font-family: 'Tahoma'; height: 50px; width:3%; padding-right: 1%; padding-left: 1%; padding-top: 1%; padding-bottom: 1%; ">
                             <?php if($inv['ord_rate_list'] == 'yes'){ ?> 
                             <img src="<?php echo base_url(); ?>assets/custom/images/checked_checkbox32.png"/>
							 <?php  } else { ?>
                              <img src="<?php echo base_url(); ?>assets/custom/images/unchecked_checkbox32.png"/>
                             <?php } ?>                        </td>
                        <td colspan="2" valign="top" style="border:1px solid #333333; font-size:14px;font-family: 'Tahoma'; height: 50px; width: 12%; padding-right: 1%; padding-left: 1%; padding-top: 1%; padding-bottom: 1%; text-align:left;">
                               Rate List<br/><br/><br/>
                        </td>
                        <td valign="top" style="text-align:left; border:1px solid #333333; font-size:14px;font-family: 'Tahoma'; height: 50px; width: 8%; padding-right: 1%; padding-left: 1%; padding-top: 1%; padding-bottom: 1%; ">
                            Delivery Charge
                        </td>
                        <td colspan="2" valign="top" style="border:1px solid #333333; font-size:14px;font-family: 'Tahoma'; height: 50px; width: 65%; padding-right: 1%;  padding-top: 1%; padding-bottom: 1%; text-align:left;">
                               <strong>+</strong><br/><br/><br/>
                        </td>
                    </tr>
                    <tr>
                        <td valign="top" style="text-align:left; border:1px solid #333333; font-size:14px;font-family: 'Tahoma'; height: 50px; width:3%; padding-right: 1%; padding-left: 1%; padding-top: 1%; padding-bottom: 1%; ">
                             <?php if($inv['ord_bag'] == 'yes'){ ?> 
                             <img src="<?php echo base_url(); ?>assets/custom/images/checked_checkbox32.png"/>
							 <?php  } else { ?>
                              <img src="<?php echo base_url(); ?>assets/custom/images/unchecked_checkbox32.png"/>
                             <?php } ?>                               </td>
                        <td valign="bottom" style="border:1px solid #333333; font-size:14px;font-family: 'Tahoma'; height: 50px; width: 9%; padding-right: 1%; padding-left: 1%; padding-top: 1%; padding-bottom: 1%; text-align:left;">
                               <span style="border:1px solid #000;padding:5px;">Bag Quantity</span><br/><br/><br/>
                        </td>     
                        <td valign="top" style="border:1px solid #333333; font-size:14px;font-family: 'Tahoma'; height: 50px; width: 5%; padding-right: 1%; padding-left: 1%; padding-top: 1%; padding-bottom: 1%; text-align:left;">
                               Bag 50rs/bag<br/><br/><br/>
                        </td>
                        <td valign="top" style="text-align:left; border:1px solid #333333; font-size:14px;font-family: 'Tahoma'; height: 50px; width: 8%; padding-right: 1%; padding-left: 1%; padding-top: 1%; padding-bottom: 1%; ">
                            <strong style="text-transform: uppercase;">Total</strong>
                        </td>
                        <td colspan="2" valign="top" style="border:1px solid #333333; font-size:14px;font-family: 'Tahoma'; height: 50px; width: 65%; padding-right: 1%;  padding-top: 1%; padding-bottom: 1%; text-align:left;">
                               - (Final charge dealer has to pay)<br/><br/><br/>
                        </td>
                    </tr>
                    <tr>
                        <td valign="top" style="text-align:left; border:1px solid #333333; font-size:14px;font-family: 'Tahoma'; height: 50px; width:3%; padding-right: 1%; padding-left: 1%; padding-top: 1%; padding-bottom: 1%; ">
                              <?php if($inv['ord_ifany'] == 'yes'){ ?> 
                             <img src="<?php echo base_url(); ?>assets/custom/images/checked_checkbox32.png"/>
							 <?php  } else { ?>
                              <img src="<?php echo base_url(); ?>assets/custom/images/unchecked_checkbox32.png"/>
                             <?php } ?>                           </td>
                        <td colspan="2" valign="top" style="border:1px solid #333333; font-size:14px;font-family: 'Tahoma'; height: 50px; width: 12%; padding-left: 1%; padding-right: 1%; padding-top: 1%; padding-bottom: 1%; text-align:LEFT;">
                              Other If Any<br/><br/><br/>
                        </td>
                        <td colspan="3" valign="top" style="text-align:left; border:1px solid #333333; font-size:14px;font-family: 'Tahoma'; height: 50px; width: 75%; padding-right: 1%; padding-left: 1%; padding-top: 1%; padding-bottom: 1%; ">
                        <?php echo $inv['ord_other'];?>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="6" valign="top" style="text-align:left; border:1px solid #333333; font-size:14px;font-family: 'Tahoma'; height: 50px;  padding-right: 1%; padding-left: 1%; padding-top: 1%; padding-bottom: 1%; ">
                           Note : (Free write space to) :  <?php echo $inv['order_note'];?>
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