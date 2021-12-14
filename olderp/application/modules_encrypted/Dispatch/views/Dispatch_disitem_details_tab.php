
<div class="portlet-body">
            <table class="table table-striped table-bordered table-hover dt-responsive" width="100%" id="sample_1">
                        <thead>
                            <tr role="row" class="heading">
                            <th width="5%"> No.</th>
                            <th width="2%"> Wo No </th>
                            <th width="2%"> Customer Name </th>
                            <th width="2%"> Item NAme </th>
                            <th width="2%"> Item Part_no </th>
                            <th width="2%"> WO Quantity </th>
                            <th width="2%"></th>
                        </tr>
                        </thead>
                            <tbody>
                        <?php $id = 0;
                         if(isset($dis_items)) { 
                         foreach($dis_items as $row){ $id++; ?>

                        <tr>
                            <td><?php echo $id;?></td>
                            <td><?php echo $row['wo_wo_no'];?></td>
                            <td><?php echo $row['wo_customer_name'];?></td>
                            <td><?php echo $row['master_item_name'];?></td>
                            <td><?php echo $row['wom_partno'];?></td>
                            <td><?php echo $row['wom_qty'];?></td>
                            <?php $aid = encrypt_decrypt('encrypt', $row['wom_itm_id']); ?>
                            <td>
                                <a href="<?php echo base_url(); ?>Dispatch/itmtodis/<?php echo $this->uri->segment(3); ?>?itemid=<?php echo $row['wom_itm_id']; ?>&qty=<?php echo $row['wom_qty']; ?>&woitemid=<?php echo $row['wom_woi_id']; ?>&woid=<?php echo $row['wom_woid']; ?>&womid=<?php echo $row['wom_id']; ?>" class="btn btn-sm btn-outline delete" onclick="return confirm('Are you sure you want to edit this item?');">Approve</a>
                            </td>
                           
                        </tr>
                        
                           <?php } } ?>
                        </tbody>
                    </table>
 </div>   