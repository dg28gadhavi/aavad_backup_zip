<h2>Document Inward Mail Report</h2>
<?php //echo "<pre>";print_r($user);die; ?>
<table border="1">
<thead>
    <th>Party Name</th>
    <th>Doc No.</th>
    <th>Date</th>
    <th>Courier Name</th>
    <th>Parcel/Cover</th>
    <th>Description</th>
    <th>Remark</th>
</thead>
<tbody>
        
        <?php 
            foreach($user as $ml)
            {
        ?>
        <tr>
        <td><?php echo $ml['master_party_name']; ?></td>
        <td><?php echo $ml['doc_inward_docketno']; ?></td>
        <td><?php echo date('d-m-Y',strtotime($ml['doc_inward_created_date'])); ?></td>
        <td><?php echo $ml['doc_inward_courier_name']; ?></td>
        <td>
        <?php 
            if($ml['doc_inward_detail']==1)
            {
                echo 'Parcel';
            }
            else if($ml['doc_inward_detail']==2)
            {
                echo 'Cover';
            }?></td>
        <td><?php echo $ml['doc_inward_desc']; ?></td>
        <td><?php echo $ml['doc_inward_remark']; ?></td>
        </tr>
        <?php
            }
        ?>
</tbody>
</table>    

<?php //echo "table over ";die; ?>