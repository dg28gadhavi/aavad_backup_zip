
<div class="portlet-body">
            <table class="table table-striped table-bordered table-hover dt-responsive" width="100%" id="sample_1">
                        <thead>
                            <tr role="row" class="heading">
                            <th width="2%">
                            <input type="checkbox" class="group-checkable"> </th>
                            <th width="5%"> No.</th>
                            <th width="2%"> Item NAme </th>
                            <th width="2%"> Item Part_no </th>
                            <th width="2%"> Po Quantity </th>
                            <th width="2%"></th>
                        </tr>
                        </thead>
                            <tbody>
                        <?php $id = 0;
                         if(isset($po_items)) { 
                         foreach($po_items as $row){ $id++; ?>

                        <tr>
                            <td><?php echo $id;?></td>
                            <td><?php echo $row['master_item_name'];?></td>
                            <td><?php echo $row['master_item_part_no'];?></td>
                            <td><?php echo $row['poi_qty'];?></td>
                            <?php $aid = encrypt_decrypt('encrypt', $row['master_item_id']); ?>
                            <td>
                                <a href="<?php echo base_url(); ?>Inward/potoinward/<?php echo $this->uri->segment(3); ?>?itemid=<?php echo $row['master_item_id']; ?>&qty=<?php echo $row['poi_qty']; ?>&poid=<?php echo $row['po_id']; ?>&po_itmid=<?php echo $row['poi_id']; ?>" class="btn btn-sm btn-outline delete" onclick="return confirm('Are you sure you want to edit this item?');">Approve</a>
                            </td>
                           
                        </tr>
                        
                           <?php } } ?>
                        </tbody>
                    </table>
 </div>   