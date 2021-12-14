<?php if(isset($edit_items) && !empty($edit_items)){ ?>
            <div class="row">
            <div class="col-md-6"><h4>Edit Items for Part No : <?php echo $edit_items['woi_part_no']; ?></h4></div>
            <div class="col-md-6" style="text-align:right;"><a class="btn green" style="text-align:right;" href="<?php echo base_url(); ?>Work_order/other_details/<?php echo $this->uri->segment(3); ?>" >New Product Add</a></div>
            </div>
        <?php }else{ ?>
            <div class="row">
            <div class="col-md-6"><h4>Add New Items</h4></div>
            <div class="col-md-6" style="text-align:right;">
                <?php  if(isset($list[0]['wo_confirm_or_not']) && $list[0]['wo_confirm_or_not'] == 1){ ?>
                    <a class="btn green" style="text-align:right;" href="#" >Alredy Confirmed</a> 
                <?php }else{?>
                <a class="btn green" style="text-align:right;" href="<?php echo base_url(); ?>Work_order/confirm_wo/<?php echo $this->uri->segment(3); ?>" >Confirm</a><?php } ?></div>
            </div>
            <?php } ?>
<?php
if($confirm_or_not['wo_confirm_or_not'] == 0 || ($this->input->get('fromwofinal') && ($this->input->get('fromwofinal') == 1)))
{
    $clsar = array('class' => 'form-horizontal','autocomplete' => 'off');
echo form_open_multipart($action_itm,$clsar); ?>
<!-- <h4>Some Input</h4> -->        
        <hr/>
        <div class="row">
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group" id="mcna_namegr">
                            <label class="control-label col-md-3">Item Part No</label>
                            <div class="col-md-9">
                                <input type="text" tabindex="16" class="form-control" placeholder="Part No" name="sqi_itm_pno" maxlength="200" id="sqi_itm_pno" value="<?php echo isset($edit_items['woi_part_no']) ? $edit_items['woi_part_no'] : ""; ?>" required autofocus>
                                <input type="hidden" name="sqi_itm_pno_id" id="sqi_itm_pno_id" value="<?php echo isset($edit_items['woi_item_id']) ? $edit_items['woi_item_id'] : ""; ?>" required>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group" id="mcna_namegr">
                            <label class="control-label col-md-3">Item Title</label>
                            <div class="col-md-9">
                                <input type="text" tabindex="16" class="form-control" placeholder="Item Title" name="sqi_itm_title" maxlength="200" id="sqi_itm_title" value="<?php echo isset($edit_items['woi_itm_title']) ? $edit_items['woi_itm_title'] : ""; ?>">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group" id="mcna_namegr">
                            <label class="control-label col-md-3">Item Description</label>
                            <div class="col-md-9">
                                 <textarea rows="10" cols="50" tabindex="17" class="form-control sqi_itm_desc" name="sqi_itm_desc" id="sqi_itm_desc"><?php echo isset($edit_items['woi_itm_desc']) ? $edit_items['woi_itm_desc'] : ""; ?></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group" id="mcna_namegr">
                            <label class="control-label col-md-3">Comment</label>
                            <div class="col-md-9">
                                 <textarea rows="10" cols="50" tabindex="17" class="form-control woi_comment" name="woi_comment" id="woi_comment"><?php echo isset($edit_items['woi_comment']) ? $edit_items['woi_comment'] : ""; ?></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="row">
                    
                    <div class="col-md-12">
                        <div class="form-group" id="mcna_namegr">
                            <label class="control-label col-md-3">Stock</label>
                            <div class="col-md-9">
                                <input type="text" tabindex="15" class="form-control" placeholder="Stock" name="sqi_itm_stock" maxlength="200" id="sqi_itm_stock" value="<?php echo isset($edit_items['woi_stock']) ? $edit_items['woi_stock'] : ""; ?>" readonly>
                            </div>
                        </div>
                    </div>
                
                    <div class="col-md-12">
                        <div class="form-group" id="mcna_namegr">
                            <label class="control-label col-md-3">Quantity</label>
                            <div class="col-md-9">
                                <input type="text" tabindex="18" class="form-control woi_qty" placeholder="Quantity" name="woi_qty" maxlength="200" id="woi_qty" value="<?php echo isset($edit_items['woi_qty']) ? $edit_items['woi_qty'] : 0; ?>">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group" id="mcna_namegr">
                            <label class="control-label col-md-3">Open Quantity</label>
                            <div class="col-md-9">
                                <input type="text" tabindex="18" class="form-control" placeholder="Open Quantity" name="woi_open_qty" maxlength="200" id="woi_open_qty" value="<?php echo isset($edit_items['woi_open_qty']) ? $edit_items['woi_open_qty'] : 0; ?>" readonly>
                            </div>
                        </div>
                    </div>                    
                    <div class="col-md-12">
                        <div class="form-group" id="mcna_namegr">
                            <label class="control-label col-md-3">Price</label>
                            <div class="col-md-9">
                                <input type="text" tabindex="18" class="form-control woi_price" placeholder="Price" name="woi_price" maxlength="200" id="woi_price" value="<?php echo isset($edit_items['woi_price']) ? $edit_items['woi_price'] : 0; ?>">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group" id="mcna_namegr">
                            <label class="control-label col-md-3">Total</label>
                            <div class="col-md-9">
                                <input type="text" tabindex="18" class="form-control" placeholder="Total" name="woi_total" maxlength="200" id="woi_total" value="<?php echo isset($edit_items['woi_total']) ? $edit_items['woi_total'] : 0; ?>">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group" id="mcna_namegr">
                            <label class="control-label col-md-3">Discount</label>
                            <div class="col-md-9">
                                <input type="text"  tabindex="21" class="form-control woi_discount" placeholder="Discount" name="woi_discount" maxlength="200" id="woi_discount" value="<?php echo isset($edit_items['woi_discount']) ? $edit_items['woi_discount'] : 0; ?>">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group" id="mcna_namegr">
                            <label class="control-label col-md-3">GST</label>
                            <div class="col-md-9">
                                <input type="text"  tabindex="21" class="form-control woi_gst" placeholder="GST" name="woi_gst" maxlength="200" id="woi_gst" value="<?php echo isset($edit_items['woi_gst']) ? $edit_items['woi_gst'] : 18; ?>">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group" id="mcna_namegr">
                            <label class="control-label col-md-3">Final Total</label>
                            <div class="col-md-9">
                                <input type="text"  tabindex="22" class="form-control woi_final_price" placeholder="Final Total" name="woi_final_price" maxlength="200" id="woi_final_price" value="<?php echo isset($edit_items['woi_final_price']) ? $edit_items['woi_final_price'] : 0; ?>">
                            </div>
                        </div>
                    </div>
                </div>
            </div>            
        </div>                         
<div class="modal-footer pull-left">
 <!-- <button type="button" data-dismiss="modal" class="btn dark btn-outline">Close</button> -->
  <input type="submit" tabindex="23" class="btn btn-success btn-space" name="submit" value="Save" tabindex="10" onclick="return item_validation();" />
</div>
<?php echo form_close(); } ?>
<div class="portlet-body">
            <table class="table table-striped table-bordered table-hover dt-responsive" width="100%" id="sample_1">
                        <thead>
                            <tr>
                                <th  width="2%">Sr.No</th>
                                <th  width="2%">Part No</th>
                                <th  width="2%">Qty</th>
                                <th  width="2%">Price</th>
                                 <th  width="2%">Total</th>
                                 <th  width="2%">Discount</th>
                                 <th  width="2%">Final Total</th>
                                <th  width="2%">Delete</th>
                            </tr>
                        </thead>
                            <tbody>
                        <?php $id = 0;
                         if(isset($items['itm'])) { 
                         foreach($items['itm'] as $row){ $id++; ?>
                        <tr>
                            <td><?php echo $id;?></td>
                            <td><?php echo $row['woi_part_no'];?></td>
                            <td><?php echo $row['woi_qty'];?></td>
                            <td><?php echo $row['woi_price'];?></td>
                            <td><?php echo $row['woi_total'];?></td>
                            <td><?php echo $row['woi_discount'];?></td>
                            <td><?php echo $row['woi_final_price'];?></td>
                            <?php $aid = encrypt_decrypt('encrypt', $row['woi_id']); ?>

                             <?php if($confirm_or_not['wo_confirm_or_not'] == 0) { ?>
                            <td><a href="<?php echo base_url(); ?>Work_order/delete_Work_order_item/<?php echo $aid; ?>/<?php echo $this->uri->segment(3); ?>" class="btn btn-sm btn-outline delete" onclick="return confirm('Are you sure you want to delete this item?');">Delete</a>
                                <a href="<?php echo base_url(); ?>Work_order/other_details/<?php echo $this->uri->segment(3); ?>?itemid=<?php echo $row['woi_id']; ?>&acttype=edit" class="btn btn-sm btn-outline delete" onclick="return confirm('Are you sure you want to edit this item?');">Edit</a>
                            </td>
                        <?php } else{ ?>
                            <td></td>
                        <?php } ?>                           
                        </tr>
                           <?php } } ?>
                        </tbody>
                    </table>
        </div>   
<script type="text/javascript">
    function item_validation()
    {
        //alert("Hiiiiiiiiiii");
        if($('#sqi_itm_pno_id').val() == '')
        {
            alert('Pl. select any one item from master. No Ref. Found From Master');
            return false;
        }else{
            return true;
        }
    }
</script>