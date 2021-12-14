<?php //echo "<pre>";print_r($items);die; ?>
<p><?php echo $inv['dis_vendor'];?></p>
<p>Dear Sir/Madam,</p>

<p>We have dispatched following List of material against your order, Kindly make a note, and also inform us by email or phone after receipt.<p>
  <div class="portlet-body">
    <table border="1" class="table table-striped table-bordered table-hover dt-responsive" width="100%" id="sample_1" style="border-collapse: collapse;">
        <thead>
            <tr>
                <th  width="2%">Sr.No</th>
                <th  width="2%">Description</th>
                 <th  width="2%">Qty</th>
                <th  width="2%">Docket.No.</th>
                <th  width="2%">Date</th>
                 <th  width="2%">Courier Name</th>
                 <th  width="2%">Your PO No.</th>
            </tr>
        </thead>
            <tbody>
        <?php $id = 0;
         if(isset($items)) { 
         foreach($items as $row){ $id++; ?>

        <tr>
            <td><?php echo $id;?></td>
            <td><?php echo $row['disi_partno'];?></td>
            <td><?php echo $row['disi_qty'];?></td>
            <td><?php echo $inv['dis_docket_no'];?></td>
            <td><?php echo $inv['dis_docket_date'];?></td>
            <td><?php echo $inv['dis_courier_name'];?></td>
            <td><?php echo $inv['dis_po_no'];?></td>
        </tr>
           <?php } } ?>
        </tbody>
    </table>
</div> 

<p>We hope you will reveive the material in good condition and will favour us with your bulk orders in future.</p>

<p>If you have any Query feel free contact or email us on.</p>

<p>Ankit Doshi</p>
<p>9723462390</p>
<p>wecon2@miconindia.com</p>

<p>Micon Automation Systems Pvt. Ltd.<p>
<p>Ahmedabad-Gujrat.</p>

<p>Note:</p>
<p>1) Kindly receive and acknowledge per return e-mail / Call within 1 week of dispatch otherwise we consider you have received the same.</p>
<p>2) This is an auto-generated reminder email, for your information only</p><br/><br/>
<p style="color:#F00;">Design and Developed By Micon Infotech ERP.</p>