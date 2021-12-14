<?php //echo base_url(); ?>
<?php //echo '<pre>'; print_r($roll_data);die;
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
        text-transform: uppercase;
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
        text-transform: uppercase;
    }
    tr{
        text-transform: uppercase;
    }
    td{
        text-transform: uppercase;
    }
    div{
        text-transform: uppercase;
    }
    

</style>
</head>
<body>
<div class="page">
<div style="width:100%;; margin:0 auto;padding-top:5px; font-family: 'Tahoma';">
    <table style="width:100%;;border-collapse:collapse;">
        <tr>
        </tr>
    </table>
     <table style="width:100%;border-collapse:collapse; margin-top:20px;">
     <tr>
      <td colspan="4" style="width:8cm;border-bottom:1px solid #000000; border-right:1px solid #000000;border-top:1px solid #000000;border-left:1px solid #000000;text-align:center; color:#232f81; padding: 10px;font-size:25px"><img src="<?php echo base_url(); ?>skin/images/miconindia-small.jpg"/></td>
     </tr>
     <?php $i=0; foreach ($datas as $key => $value) 
     { $i++; ?>
        <tr <?php if($value['wt_completed']=='1'){ echo 'style="background-color:#009900;color:#fff;"'; } if($value['wt_completed']=='2'){ echo 'style="background-color:#e50000;color:#fff;"'; }?> >
        <td colspan="4" style="width:16cm;border-bottom:1px solid #000000;border-top:1px solid #000000;border-left:1px solid #000000;font-size:18px;text-align:center;padding: 10px;border-right:1px solid #000000; <?php if($value['wt_completed']=='1'){ echo 'background-color:#009900;color:#fff;'; } if($value['wt_completed']=='2'){ echo 'background-color:#e50000;color:#fff;'; }?>"><b>Task <?php echo $i; ?></b></td>
     </tr>
     <tr>
        <td  style="width: 8cm; border-bottom:1px solid #000000;border-top:1px solid #000000;border-left:1px solid #000000;font-size:12px; text-align:left;padding: 10px;"><b>Start Date:</b></td>
        <td  style="width: 8cm;border-bottom:1px solid #000000;border-top:1px solid #000000;border-left:1px solid #000000;border-right:1px solid #000000; font-size:12px; text-align:left;padding: 10px;border-right:1px solid #000000;"><?php echo $value['wt_startdate']; ?></td>
        <td  style="width: 8cm; border-bottom:1px solid #000000;border-top:1px solid #000000;border-left:1px solid #000000;font-size:12px; text-align:left;padding: 10px;"><b>End Date:</b></td>
        <td  style="width: 8cm;border-bottom:1px solid #000000;border-top:1px solid #000000;border-left:1px solid #000000;border-right:1px solid #000000; font-size:12px; text-align:left;padding: 10px;border-right:1px solid #000000;"><?php echo $value['wt_enddate']; ?></td>
      </tr> 
       <tr>
        <td  style="width: 8cm; border-bottom:1px solid #000000;border-top:1px solid #000000;border-left:1px solid #000000;font-size:12px; text-align:left;padding: 10px;"><b>Assign To:</b></td>
        <td  style="width: 8cm;border-bottom:1px solid #000000;border-top:1px solid #000000;border-left:1px solid #000000;border-right:1px solid #000000; font-size:12px; text-align:left;padding: 10px;border-right:1px solid #000000;"><?php echo $value['assigntoname']; ?></td>
        <td  style="width: 8cm; border-bottom:1px solid #000000;border-top:1px solid #000000;border-left:1px solid #000000;font-size:12px; text-align:left;padding: 10px;"><b>Assign By:</b></td>
        <td  style="width: 8cm;border-bottom:1px solid #000000;border-top:1px solid #000000;border-left:1px solid #000000;border-right:1px solid #000000; font-size:12px; text-align:left;padding: 10px;border-right:1px solid #000000;"><?php echo $value['assignfromname']; ?></td>
      </tr> 
      <tr>
        <td  style="width: 8cm; border-bottom:1px solid #000000;border-top:1px solid #000000;border-left:1px solid #000000;font-size:12px; text-align:left;padding: 10px;"><b>Priority:</b></td>
        <td  style="width: 8cm;border-bottom:1px solid #000000;border-top:1px solid #000000;border-left:1px solid #000000;border-right:1px solid #000000; font-size:12px; text-align:left;padding: 10px;border-right:1px solid #000000;"><?php if($value['wt_priority']=='1'){ echo 'High'; } if($value['wt_priority']=='2'){ echo 'Medium'; } if($value['wt_priority']=='3'){ echo 'Low'; }   ?></td>
        <td  style="width: 8cm; border-bottom:1px solid #000000;border-top:1px solid #000000;border-left:1px solid #000000;font-size:12px; text-align:left;padding: 10px;"><b>Task Type:</b></td>
        <td  style="width: 8cm;border-bottom:1px solid #000000;border-top:1px solid #000000;border-left:1px solid #000000;border-right:1px solid #000000; font-size:12px; text-align:left;padding: 10px;border-right:1px solid #000000;"><?php echo $value['wt_task_type']; ?></td>
      </tr> 
      <tr>
        <td  style="width: 8cm; border-bottom:1px solid #000000;border-top:1px solid #000000;border-left:1px solid #000000;font-size:12px; text-align:left;padding: 10px;"><b>State:</b></td>
        <td  style="width: 8cm;border-bottom:1px solid #000000;border-top:1px solid #000000;border-left:1px solid #000000;border-right:1px solid #000000; font-size:12px; text-align:left;padding: 10px;border-right:1px solid #000000;"><?php echo $value['wt_place']; ?></td>
        <td  style="width: 8cm; border-bottom:1px solid #000000;border-top:1px solid #000000;border-left:1px solid #000000;font-size:12px; text-align:left;padding: 10px;"><b>City:</b></td>
        <td  style="width: 8cm;border-bottom:1px solid #000000;border-top:1px solid #000000;border-left:1px solid #000000;border-right:1px solid #000000; font-size:12px; text-align:left;padding: 10px;border-right:1px solid #000000;"><?php echo $value['wt_city']; ?></td>
      </tr> 
      <tr>
        <td  style="width: 8cm; border-bottom:1px solid #000000;border-top:1px solid #000000;border-left:1px solid #000000;font-size:12px; text-align:left;padding: 10px;"><b>Accomplished By Date:</b></td>
        <td  style="width: 8cm;border-bottom:1px solid #000000;border-top:1px solid #000000;border-left:1px solid #000000;border-right:1px solid #000000; font-size:12px; text-align:left;padding: 10px;border-right:1px solid #000000;"><?php echo $value['wt_acc_date']; ?></td>
        <td  style="width: 8cm; border-bottom:1px solid #000000;border-top:1px solid #000000;border-left:1px solid #000000;font-size:12px; text-align:left;padding: 10px;"><b>Customer Name:</b></td>
        <td  style="width: 8cm;border-bottom:1px solid #000000;border-top:1px solid #000000;border-left:1px solid #000000;border-right:1px solid #000000; font-size:12px; text-align:left;padding: 10px;border-right:1px solid #000000;"><?php echo $value['wt_customer']; ?></td>
      </tr> 
      <tr>
        <td  style="width: 8cm; border-bottom:1px solid #000000;border-top:1px solid #000000;border-left:1px solid #000000;font-size:12px; text-align:left;padding: 10px;"><b>Task Description:</b></td>
        <td  style="width: 8cm;border-bottom:1px solid #000000;border-top:1px solid #000000;border-left:1px solid #000000;border-right:1px solid #000000; font-size:12px; text-align:left;padding: 10px;border-right:1px solid #000000;"><?php echo $value['wt_description']; ?></td>
        <td  style="width: 8cm; border-bottom:1px solid #000000;border-top:1px solid #000000;border-left:1px solid #000000;font-size:12px; text-align:left;padding: 10px;"><b>Remark:</b></td>
        <td  style="width: 8cm;border-bottom:1px solid #000000;border-top:1px solid #000000;border-left:1px solid #000000;border-right:1px solid #000000; font-size:12px; text-align:left;padding: 10px;border-right:1px solid #000000;"><?php echo $value['wt_remark']; ?></td>
      </tr>
        <tr>
        <td  style="width: 8cm; border-bottom:1px solid #000000;border-top:1px solid #000000;border-left:1px solid #000000;font-size:12px; text-align:left;padding: 10px;"><b>Expense:</b></td>
        <td  style="width: 8cm;border-bottom:1px solid #000000;border-top:1px solid #000000;border-left:1px solid #000000;border-right:1px solid #000000; font-size:12px; text-align:left;padding: 10px;border-right:1px solid #000000;"><?php echo $value['wt_expense']; ?></td>
        <td  style="width: 8cm; border-bottom:1px solid #000000;border-top:1px solid #000000;border-left:1px solid #000000;font-size:12px; text-align:left;padding: 10px;"><b>Followup Date:</b></td>
        <td  style="width: 8cm;border-bottom:1px solid #000000;border-top:1px solid #000000;border-left:1px solid #000000;border-right:1px solid #000000; font-size:12px; text-align:left;padding: 10px;border-right:1px solid #000000;"><?php echo $value['wt_follow_date']; ?></td>
      </tr>
     <?php } ?>
     

     </table>
     <br>   
</div>
</div>
  </body>
</html>