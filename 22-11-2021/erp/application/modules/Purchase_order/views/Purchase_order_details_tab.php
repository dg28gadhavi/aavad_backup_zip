
<div class="portlet-body">
<table class="table table-striped table-bordered table-hover dt-responsive" width="100%" id="sample_1">
            <thead>
                <tr role="row" class="heading">
                <th width="5%"> No.</th>
                <th width="2%"> Item Name </th>
                <th width="2%"> Item Part_no </th>
                <th width="2%"> Quantity </th>
                <th width="2%"></th>
            </tr>
            </thead>
                <tbody>
            <?php $id = 0;
             if(isset($wo_items)) { 
             foreach($wo_items as $row){ $id++; ?>

            <tr>
                <td><?php echo $id;?></td>
                <td><?php echo $row['master_item_name'];?></td>
                <td><?php echo $row['master_item_part_no'];?></td>
                <td><?php echo $row['woi_open_qty'];?></td>
                <?php $aid = encrypt_decrypt('encrypt', $row['master_item_id']); ?>
                <td>
                    <a href="<?php echo base_url(); ?>Purchase_order/woitemtopo/<?php echo $this->uri->segment(3); ?>?itemid=<?php echo $row['master_item_id']; ?>&qty=<?php echo $row['woi_open_qty']; ?>&woitmid=<?php echo $row['woi_id']; ?>" class="btn btn-sm btn-outline delete" onclick="return confirm('Are you sure you want to edit this item?');">Approve</a>
                </td>
               
            </tr>
            
               <?php } } ?>
            </tbody>
    </table>
 </div>   