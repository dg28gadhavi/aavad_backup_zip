<?php //echo "<pre>";print_r($data);die; ?>
<table border="1" style="min-width:100%;" width="100%" cellspacing="0" cellpadding="0">
    <tr>
        <th  width="2%">Sr.No</th>
        <th  width="2%">Vendor</th>
        <th  width="2%">Email</th> 
        <th  width="2%">Counrty</th> 
        <th  width="2%">State</th>
        <th  width="2%">City</th> 
        <th  width="2%">Phone no</th>
        <th  width="2%">Mobile no</th>
        <th  width="2%">Product Details</th>
    </tr>
    
        <?php $id = 0; foreach ($data as $key => $row) 
        { $id++;
            //echo "<pre>";print_r($row);die;
         ?>
         <tr>
            <td style="text-align: center;"><?php echo $id; ?></td>
            <td style="text-align: center;"><?php echo $row['vendor']; ?></td>
            <td style="text-align: center;"><?php echo $row['sq_email']; ?></td>
            <td style="text-align: center;"><?php echo $row['country_name']; ?></td>
            <td style="text-align: center;"><?php echo $row['state_name']; ?></td>
            <td style="text-align: center;"><?php echo $row['city_name']; ?></td>
            <td style="text-align: center;"><?php echo $row['sq_phone']; ?></td>
            <td style="text-align: center;"><?php echo $row['sq_mobile']; ?></td>
            <td style="text-align: center;"><?php echo $row['sq_prodetails']; ?></td>
        </tr>
        <?php  } ?>
        
    
</table>