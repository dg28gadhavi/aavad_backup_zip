<?php //echo '<pre>';print_r($item_data); die;?>
<?php 
$clsar = array('class' => 'form-horizontal');
echo form_open_multipart($action_item,$clsar); ?>
<!-- <h4>Some Input</h4> -->
        <?php if(isset($edit_items) && !empty($edit_items)){ ?>
            <div class="row">
            <div class="col-md-6"><h4>Edit Items for Part No : <?php echo $edit_items['sai_itm']; ?></h4></div>
            <div class="col-md-6" style="text-align:right;"><a class="btn green" style="text-align:right;" href="<?php echo base_url(); ?>Sale_quotation/quatation_tab/<?php echo $this->uri->segment(3); ?>" >New Product Add</a></div>
            </div>
        <?php }else{ ?>
            <h4>Add New Items</h4>
            <?php } ?>
            <hr/>
        <div class="row">
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group" id="mcna_namegr">
                            <label class="control-label col-md-3">Part No.</label>
                            <div class="col-md-9">
                                <input type="text" tabindex="31" class="form-control" placeholder="Part No." name="sa_itm_pno" maxlength="200" id="sa_itm_pno" value="<?php echo isset($edit_items['sai_itm']) ? $edit_items['sai_itm'] : ""; ?>" autofocus>
                                <input type="hidden" name="sai_itm" maxlength="200" id="sai_itm" value="<?php echo isset($edit_items['sai_itm_name']) ? $edit_items['sai_itm_name'] : ""; ?>" autofocus>
                            </div>
                        </div>
                     </div>
                     <div class="col-md-12">
                        <div class="form-group" id="mcna_namegr">
                            <label class="control-label col-md-3">Item Title</label>
                            <div class="col-md-9">
                                <input type="text" tabindex="32" class="form-control" placeholder="Item Title" name="sai_item_title" maxlength="200" id="sai_item_title" value="<?php echo isset($edit_items['sai_item_title']) ? $edit_items['sai_item_title'] : ""; ?>">
                            </div>
                        </div>
                     </div>
                     <div class="col-md-12">
                        <div class="form-group" id="mcna_namegr">
                            <label class="control-label col-md-3">HSN Code</label>
                            <div class="col-md-9">
                                <?php /* ?><input type="text" tabindex="16" class="form-control sqi_itm_hsncode" placeholder="HSN Code" name="sqi_itm_hsncode" maxlength="200" id="sqi_itm_hsncode" value="<?php echo isset($list[0]['sqi_itm_hsncode']) ? $list[0]['sqi_itm_hsncode'] : ""; ?>" autofocus><?php */ ?>
                                <select tabindex="33" class="form-control sqi_itm_hsncode" name="sai_itm_hsncode" id="sqi_itm_hsncode">
                                    <option value="">Select HSN Code</option>
                                    <?php foreach ($all_hsns as $all_hsn) {
                                        ?><option value="<?php echo $all_hsn['hsn_id']; ?>"<?php if(isset($edit_items) && isset($edit_items['sai_itm_hsncode']) && ($edit_items['sai_itm_hsncode'] == $all_hsn['hsn_id'])){ echo 'selected'; } ?> ><?php echo $all_hsn['hsn_hcode']; ?></option><?php
                                    } ?>
                                </select>
                               
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group" id="mcna_namegr">
                            <label class="control-label col-md-3">Description</label>
                            <div class="col-md-9">
                               <textarea rows="10" cols="50" tabindex="34" class="form-control sa_itm_desc" name="sa_itm_desc" id="sa_itm_desc"><?php echo isset($edit_items['sai_itm_desc']) ? $edit_items['sai_itm_desc'] : ""; ?></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group" id="master_party_namegr">
                            <label class="control-label col-md-3">Item Image</label>
                            <div class="col-md-9">
                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                    <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;" id="img">                                
                                    </div>
                                    <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"> </div>
                                    <div>
                                        <span class="btn default btn-file">
                                            <span class="fileinput-new" tabindex="35"> Select image </span>
                                            <span class="fileinput-exists" tabindex="36"> Change </span>
                                           <input type="file"  name="master_item_img" />
                                        <a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput"> Remove </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group" id="mcna_namegr">
                            <label class="control-label col-md-3">Quantity</label>
                            <div class="col-md-9">
                                <input type="text" tabindex="37" class="form-control" placeholder="Quantity" name="sa_itm_qty" maxlength="200" id="sa_itm_qty" value="<?php echo isset($edit_items['sai_itm_qty']) ? $edit_items['sai_itm_qty'] : ""; ?>">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12"  style="display: none;">
                        <div class="form-group" id="mcna_namegr">
                            <label class="control-label col-md-3">Stock</label>
                            <div class="col-md-9">
                                <input type="text" tabindex="38" class="form-control" placeholder="Stock" name="sai_itm_stock" maxlength="200" id="sai_itm_stock" value="<?php echo isset($edit_items['sai_itm_stock']) ? $edit_items['sai_itm_stock'] : ""; ?>">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group" id="mcna_namegr">
                            <label class="control-label col-md-3">Open Quantity</label>
                            <div class="col-md-9">
                                <input type="text" tabindex="39" class="form-control" placeholder="Open Quantity" name="sai_itm_opn_qty" maxlength="200" id="sai_itm_opn_qty" value="<?php echo isset($edit_items['sai_itm_opn_qty']) ? $edit_items['sai_itm_opn_qty'] : ""; ?>">
                            </div>
                        </div>
                    </div>
                     <div class="col-md-12">
                        <div class="form-group" id="mcna_namegr">
                            <label class="control-label col-md-3">Rate</label>
                            <div class="col-md-9">
                                <input type="text"  tabindex="40" class="form-control" placeholder="Rate" name="sqi_itm_price" maxlength="200" id="sa_itm_price" value="<?php echo isset($edit_items['sai_itm_price']) ? $edit_items['sai_itm_price'] : ""; ?>">
                            </div>
                        </div>
                    </div>
                     <div class="col-md-12">
                        <div class="form-group" id="mcna_namegr">
                            <label class="control-label col-md-3">Discount</label>
                            <div class="col-md-9">
                                <input type="text"  tabindex="41" class="form-control" placeholder="Discount" name="sai_itm_discount" maxlength="200" id="sai_itm_discount" value="<?php echo isset($edit_items['sai_itm_discount']) ? $edit_items['sai_itm_discount'] : ""; ?>">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group" id="mcna_namegr">
                            <label class="control-label col-md-3">Final Total</label>
                            <div class="col-md-9">
                                <input type="text"  tabindex="42" class="form-control" placeholder="Final Total" name="sai_itm_ftotal" maxlength="200" id="sai_itm_ftotal" value="<?php echo isset($edit_items['sai_itm_total']) ? $edit_items['sai_itm_total'] : ""; ?>">
                            </div>
                        </div>
                    </div>
                </div>
        </div>
    </div>      
        
<!-- <div class="modal-footer pull-left">
  <input type="submit"  tabindex="25" class="btn btn-success btn-space" name="submit" value="Save" tabindex="10" />
</div> -->
<div class="form-actions">
        <div class="row">
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-offset-3 col-md-9">
                        <button type="submit" tabindex="43" class="btn green" onclick="return ValidateDetails()">SUBMIT</button>
                    </div>
                </div>
            </div>
            <div class="col-md-6"> </div>
        </div>
</div>
<br>
<div class="portlet-body">
<table class="table table-striped table-bordered table-hover dt-responsive" width="100%" id="sample_1">
            <thead>
                <tr>
                    <th  width="2%">Sr.No</th>
                    <th  width="2%">Detail of item</th> 
                    <th  width="2%">Item Image</th>
                    <th  width="2%">HSN Code</th>
                    <th  width="2%">Detail of item Description</th> 
                    <th  width="2%">Qty</th>
                    <th  width="2%">Rate</th>
                    <th  width="2%">Discount</th>
                    <th  width="2%">Final Total</th>
                    <th  width="2%">Delete</th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 0; foreach($item_data as $row){ $i++;?>
                <tr>
                    <td><?php echo $i;?></td>
                    <td><?php echo $row['sai_itm'];?></td>
                    <td><?php if(isset($row['master_item_img']) && !empty($row['master_item_img'])) { ?>
                    <img src="<?php echo base_url(); ?>uploads/master_item_img/<?php echo htmlentities(stripslashes($row['master_item_img'])); ?> " height="50" width="50"><?php } ?></td>
                    <td><?php echo $row['hsn_hcode'];?></td>
                    <td><?php echo $row['sai_itm_desc'];?></td>
                    <td><?php echo $row['sai_itm_qty'];?></td>
                    <td><?php echo $row['sai_itm_price'];?></td>
                    <td><?php echo $row['sai_itm_discount'];?></td>
                    <td><?php echo $row['sai_itm_total'];?></td>
                    <?php $aid = encrypt_decrypt('encrypt', $row['sai_id']); ?>
                    <td><a href="<?php echo base_url(); ?>Sale_quotation/delete_itms/<?php echo $aid; ?>/<?php echo $this->uri->segment(3); ?>" class="btn btn-sm btn-outline delete" class="btn btn-sm btn-outline delete" onclick="return confirm('Are you sure you want to delete this item?');">Delete</a>

                    <a href="<?php echo base_url(); ?>Sale_quotation/quatation_tab/<?php echo $this->uri->segment(3); ?>?itemid=<?php echo $row['sai_id']; ?>&acttype=edit" class="btn btn-sm btn-outline delete" onclick="return confirm('Are you sure you want to edit this item?');">Edit</a>
                    </td>
                </tr>            
                   <?php } //echo '<pre>';print_r($chartarray);die; ?>
            </tbody>
        </table>
    </div>
<?php echo form_close(); ?>  
 