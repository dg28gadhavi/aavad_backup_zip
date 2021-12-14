<?php //echo "<pre>"; print_r($autosearch_items); die;
$clsar = array('class' => 'form-horizontal','autocomplete' => 'off');
echo form_open_multipart($action_itm,$clsar); ?>
<!-- <h4>Some Input</h4> -->
    <?php if(isset($edit_items) && !empty($edit_items)){ ?>
    <div class="row">
        <div class="col-md-6"><h4>Edit Items for Part No : <?php echo $edit_items['disi_partno']; ?></h4></div>
            <div class="col-md-6" style="text-align:right;"><a class="btn green" style="text-align:right;" href="<?php echo base_url(); ?>Dispatch/other_details/<?php echo $this->uri->segment(3); ?>" >New Product Add</a></div>
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
                            <label class="control-label col-md-3">Item Part No</label>
                            <div class="col-md-9">
                                <input type="text" tabindex="21" class="form-control" placeholder="Part No" name="sqi_itm_pno" maxlength="200" id="sqi_itm_pno" value="<?php echo isset($edit_items['disi_partno']) ? $edit_items['disi_partno'] : ""; ?>" autofocus>
                                <input type="hidden" name="sqi_itm_pno_id" id="sqi_itm_pno_id" value="<?php echo isset($edit_items['disi_partno']) ? $edit_items['disi_partno'] : ""; ?>">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group" id="mcna_namegr">
                            <label class="control-label col-md-3">Item Title</label>
                            <div class="col-md-9">
                                <input type="text" tabindex="22" class="form-control" placeholder="Item Title" name="sqi_itm_title" maxlength="200" id="sqi_itm_title" value="<?php echo isset($edit_items['disi_itm_title']) ? $edit_items['disi_itm_title'] : ""; ?>">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group" id="mcna_namegr">
                            <label class="control-label col-md-3">Item Code</label>
                            <div class="col-md-9">
                                <input type="text" tabindex="23" class="form-control" placeholder="Item Code" name="disi_itm_code" maxlength="200" id="disi_itm_code" value="<?php echo isset($edit_items['disi_itm_code']) ? $edit_items['disi_itm_code'] : ""; ?>">
                            </div>
                        </div>
                    </div>
                     <div class="col-md-12">
                        <div class="form-group" id="mcna_namegr">
                            <label class="control-label col-md-3">HSN Code</label>
                            <div class="col-md-9">
                                <?php /* ?><input type="text" tabindex="16" class="form-control sqi_itm_hsncode" placeholder="HSN Code" name="sqi_itm_hsncode" maxlength="200" id="sqi_itm_hsncode" value="<?php echo isset($list[0]['sqi_itm_hsncode']) ? $list[0]['sqi_itm_hsncode'] : ""; ?>" autofocus><?php */ ?>
                                <select tabindex="24" class="form-control sqi_itm_hsncode" name="sqi_itm_hsncode" id="sqi_itm_hsncode">
                                    <option value="">Select HSN Code</option>
                                    <?php foreach ($all_hsns as $all_hsn) {
                                        ?><option value="<?php echo $all_hsn['hsn_id']; ?>" <?php if(isset($edit_items) && isset($edit_items['sqi_itm_hsncode']) && ($edit_items['sqi_itm_hsncode'] == $all_hsn['hsn_id'])){ echo 'selected'; } ?> ><?php echo $all_hsn['hsn_hcode']; ?></option><?php
                                    } ?>
                                </select>                               
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12" style="display: none;">
                        <div class="form-group" id="mcna_namegr">
                            <label class="control-label col-md-3">Description</label>
                            <div class="col-md-9">
                                <textarea rows="10" cols="50" tabindex="17" class="form-control sqi_itm_desc" name="sqi_itm_desc" id="sqi_itm_desc"><?php echo isset($edit_items['sqi_itm_desc']) ? $edit_items['sqi_itm_desc'] : ""; ?></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12" style="display: none;">
                        <div class="form-group" id="master_party_namegr">
                            <label class="control-label col-md-3">Item Image</label>
                            <div class="col-md-6">
                                <div class="fileinput fileinput-new" data-provides="fileinput">
                            <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;" id="img">
                                
                                 </div>
                            <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"> </div>
                            <div>
                                <span class="btn default btn-file">
                                    <span class="fileinput-new"> Select image </span>
                                    <span class="fileinput-exists"> Change </span>
                                   <input type="file"  name="master_item_img" />
                                <a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput"> Remove </a>
                            </div>
                            </div>
                            </div>
                            <div class="col-md-3">
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
                                <input type="text" tabindex="25" class="form-control disi_qty" placeholder="Quantity" name="disi_qty" maxlength="200" id="disi_qty" value="<?php echo isset($edit_items['disi_qty']) ? $edit_items['disi_qty'] : 0; ?>">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group" id="mcna_namegr">
                            <label class="control-label col-md-3">Unit</label>
                            <div class="col-md-9">
                                <input type="text" tabindex="26" class="form-control" placeholder="Unit" name="disi_unit" maxlength="200" id="disi_unit" value="<?php echo isset($edit_items['disi_unit']) ? $edit_items['disi_unit'] : 0; ?>">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group" id="mcna_namegr">
                            <label class="control-label col-md-3">Price</label>
                            <div class="col-md-9">
                                <input type="text" tabindex="27" class="form-control disi_itm_price" placeholder="Price" name="disi_itm_price" maxlength="200" id="disi_itm_price" value="<?php echo isset($edit_items['disi_itm_price']) ? $edit_items['disi_itm_price'] : 0; ?>">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group" id="mcna_namegr">
                            <label class="control-label col-md-3">Total</label>
                            <div class="col-md-9">
                                <input type="text" tabindex="28" class="form-control" placeholder="Total" name="disi_itm_total" maxlength="200" id="disi_itm_total" value="<?php echo isset($edit_items['disi_itm_total']) ? $edit_items['disi_itm_total'] : 0; ?>">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group" id="mcna_namegr">
                            <label class="control-label col-md-3">Discount</label>
                            <div class="col-md-9">
                                <input type="text"  tabindex="29" class="form-control disi_itm_discount" placeholder="Discount" name="disi_itm_discount" maxlength="200" id="disi_itm_discount" value="<?php echo isset($edit_items['disi_itm_discount']) ? $edit_items['disi_itm_discount'] : 0; ?>">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group" id="mcna_namegr">
                            <label class="control-label col-md-3">Final Total</label>
                            <div class="col-md-9">
                                <input type="text"  tabindex="30" class="form-control sqi_itm_ftotal" placeholder="Final Total" name="disi_ftotal" maxlength="200" id="disi_ftotal" value="<?php echo isset($edit_items['disi_ftotal']) ? $edit_items['disi_ftotal'] : 0; ?>">
                            </div>
                        </div>
                    </div>
                </div>
            </div>            
        </div>                         
<div class="modal-footer pull-left">
 <!-- <button type="button" data-dismiss="modal" class="btn dark btn-outline">Close</button> -->
    <input type="submit" tabindex="32" class="btn btn-success btn-space" name="submit" value="Save" />
</div>
<?php echo form_close(); ?>
<div class="portlet-body">
    <table class="table table-striped table-bordered table-hover dt-responsive" width="100%" id="sample_1">
        <thead>
            <tr>
                <th  width="2%">Sr.No</th>
                <th  width="2%">Detail of item</th>
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
            <td><?php echo $row['disi_itm_title'];?></td>
            <td><?php echo $row['disi_partno'];?></td>
            <td><?php echo $row['disi_qty'];?></td>
            <td><?php echo $row['disi_itm_price'];?></td>
            <td><?php echo $row['disi_itm_total'];?></td>
            <td><?php echo $row['disi_itm_discount'];?></td>
            <td><?php echo $row['disi_ftotal'];?></td>
            <?php $aid = encrypt_decrypt('encrypt', $row['disi_id']); ?>
            <td><a href="<?php echo base_url(); ?>Dispatch/delete_dispatch_item/<?php echo $aid; ?>/<?php echo $this->uri->segment(3); ?>" class="btn btn-sm btn-outline delete" onclick="return confirm('Are you sure you want to delete this item?');">Delete</a>
                <a href="<?php echo base_url(); ?>Dispatch/other_details/<?php echo $this->uri->segment(3); ?>?itemid=<?php echo $row['disi_id']; ?>&acttype=edit" class="btn btn-sm btn-outline delete" onclick="return confirm('Are you sure you want to edit this item?');">Edit</a>
            </td>
           
        </tr>
           <?php } } ?>
        </tbody>
    </table>
</div>   
