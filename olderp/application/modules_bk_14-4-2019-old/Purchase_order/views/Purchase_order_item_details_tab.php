<?php //echo "<pre>"; print_r($autosearch_items); die;
$clsar = array('class' => 'form-horizontal','autocomplete' => 'off');
echo form_open_multipart($action_itm,$clsar); ?>
<!-- <h4>Some Input</h4> -->
        <?php if(isset($edit_items) && !empty($edit_items)){ ?>
            <div class="row">
            <div class="col-md-6"><h4>Edit Items for Part No : <?php echo $edit_items['poi_itm_part_no']; ?></h4></div>
            <div class="col-md-6" style="text-align:right;"><a class="btn green" style="text-align:right;" href="<?php echo base_url(); ?>Purchase_order/other_details/<?php echo $this->uri->segment(3); ?>" >New Product Add</a></div>
            </div>
        <?php }else{ ?>
            <h4>Add New Items</h4>
            <?php } ?>
            <hr/>
        <?php
if (!empty($success) || $this->session->flashdata('success_item') != '') {
    $msg = !empty($success) ? $success : $this->session->flashdata('success_item');
    echo '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button>' . $msg . '</div>';
}
if (!empty($error) || $this->session->flashdata('error_item') != '') {
    $msg = !empty($error) ? $error : $this->session->flashdata('error_item');
    echo '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button>' . $msg . '</div>';
}
if (!empty($warning) || $this->session->flashdata('warning_item') != '') {
    $msg = !empty($warning) ? $warning : $this->session->flashdata('warning_item');
    echo '<div class="alert alert-warning"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button>' . $msg . '</div>';
}
?>
        <div class="row">
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group" id="mcna_namegr">
                            <label class="control-label col-md-3">Item Part No</label>
                            <div class="col-md-9">
                                <input type="text" tabindex="11" class="form-control" placeholder="Part No" name="sqi_itm_pno" maxlength="200" id="sqi_itm_pno" value="<?php echo isset($edit_items['poi_itm_part_no']) ? $edit_items['poi_itm_part_no'] : ""; ?>" autofocus>
                                <input type="hidden" name="sqi_itm_pno_id" id="sqi_itm_pno_id" value="<?php echo isset($edit_items['poi_itm_name']) ? $edit_items['poi_itm_name'] : ""; ?>">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group" id="mcna_namegr">
                            <label class="control-label col-md-3">Item Title</label>
                            <div class="col-md-9">
                                <input type="text" tabindex="12" class="form-control" placeholder="Item Title" name="sqi_itm_title" maxlength="200" id="sqi_itm_title" value="<?php echo isset($edit_items['poi_itm_title']) ? $edit_items['poi_itm_title'] : ""; ?>">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12" style="display: none;">
                        <div class="form-group" id="mcna_namegr">
                            <label class="control-label col-md-3">Item Rating</label>
                            <div class="col-md-9">
                            <input type="text" tabindex="13" class="form-control" placeholder="Item Rating" name="poi_itm_rating" maxlength="200" id="poi_itm_rating" value="<?php echo isset($edit_items['poi_itm_rating']) ? $edit_items['poi_itm_rating'] : ""; ?>">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12" style="display: none;">
                        <div class="form-group" id="mcna_namegr">
                            <label class="control-label col-md-3">Item Code</label>
                            <div class="col-md-9">
                                <input type="text" tabindex="14" class="form-control" placeholder="Item Code" name="poi_itm_code" maxlength="200" id="poi_itm_code" value="<?php echo isset($edit_items['poi_itm_code']) ? $edit_items['poi_itm_code'] : ""; ?>">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group" id="mcna_namegr">
                            <label class="control-label col-md-3">Description</label>
                            <div class="col-md-9">
                                <textarea rows="10" cols="50" tabindex="15" class="form-control sqi_itm_desc" name="poi_itm_desc" id="poi_itm_desc"><?php echo isset($edit_items['poi_itm_desc']) ? $edit_items['poi_itm_desc'] : ""; ?></textarea>
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
                                <input type="text" tabindex="16" class="form-control" placeholder="Stock" name="poi_stock" maxlength="200" id="poi_stock" value="<?php echo isset($edit_items['poi_stock']) ? $edit_items['poi_stock'] : 0; ?>">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group" id="mcna_namegr">
                            <label class="control-label col-md-3">Quantity</label>
                            <div class="col-md-9">
                                <input type="text" tabindex="17" class="form-control poi_qty" placeholder="Quantity" name="poi_qty" maxlength="200" id="poi_qty" value="<?php echo isset($edit_items['poi_qty']) ? $edit_items['poi_qty'] : 0; ?>">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group" id="mcna_namegr">
                            <label class="control-label col-md-3">Unit</label>
                            <div class="col-md-9">
                                <input type="text" tabindex="18" class="form-control" placeholder="Unit" name="poi_unit" maxlength="200" id="poi_unit" value="<?php echo isset($edit_items['poi_unit']) ? $edit_items['poi_unit'] : 0; ?>">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group" id="mcna_namegr">
                            <label class="control-label col-md-3">Last Price</label>
                            <div class="col-md-9">
                                <input type="text" tabindex="19" class="form-control poi_last_price" placeholder="Price" name="poi_last_price" maxlength="200" id="poi_last_price" value="<?php echo isset($edit_items['poi_last_price']) ? $edit_items['poi_last_price'] : 0; ?>">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group" id="mcna_namegr">
                            <label class="control-label col-md-3">Price</label>
                            <div class="col-md-9">
                                <input type="text" tabindex="19" class="form-control poi_price" placeholder="Price" name="poi_price" maxlength="200" id="poi_price" value="<?php echo isset($edit_items['poi_price']) ? $edit_items['poi_price'] : 0; ?>">
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group" id="mcna_namegr">
                            <label class="control-label col-md-3">Total</label>
                            <div class="col-md-9">
                                <input type="text" tabindex="20" class="form-control" placeholder="Total" name="poi_total" maxlength="200" id="poi_total" value="<?php echo isset($edit_items['poi_total']) ? $edit_items['poi_total'] : 0; ?>">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group" id="mcna_namegr">
                            <label class="control-label col-md-3">Discount</label>
                            <div class="col-md-9">
                                <input type="text"  tabindex="21" class="form-control poi_discount" placeholder="Discount" name="poi_discount" maxlength="200" id="poi_discount" value="<?php echo isset($edit_items['poi_discount']) ? $edit_items['poi_discount'] : 0; ?>">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group" id="mcna_namegr">
                            <label class="control-label col-md-3">Final Total</label>
                            <div class="col-md-9">
                                <input type="text"  tabindex="22" class="form-control sqi_itm_ftotal" placeholder="Final Total" name="poi_ftotal" maxlength="200" id="poi_ftotal" value="<?php echo isset($edit_items['poi_ftotal']) ? $edit_items['poi_ftotal'] : 0; ?>">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div>               
        </div>
    </div>                         
<div class="modal-footer pull-left">
<!-- <button type="button" data-dismiss="modal" class="btn dark btn-outline">Close</button> -->
<input type="submit" tabindex="24" class="btn btn-success btn-space" name="submit" value="Save" tabindex="10" onclick="return item_submit();"/>
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
                <td><?php echo $row['poi_itm_title'];?></td>
                <td><?php echo $row['poi_itm_part_no'];?></td>
                <td><?php echo $row['poi_qty'];?></td>
                <td><?php echo $row['poi_price'];?></td>
                <td><?php echo $row['poi_total'];?></td>
                <td><?php echo $row['poi_discount'];?></td>
                <td><?php echo $row['poi_ftotal'];?></td>
                <?php $aid = encrypt_decrypt('encrypt', $row['poi_id']); ?>
                <td><?php if($row['poi_complete'] == '0') {
                     ?>
                    <a href="<?php echo base_url(); ?>Purchase_order/delete_Purchase_order_item/<?php echo $aid; ?>/<?php echo $this->uri->segment(3); ?>" class="btn btn-sm btn-outline delete" onclick="return confirm('Are you sure you want to delete this item?');">Delete</a>
                    <a href="<?php echo base_url(); ?>Purchase_order/other_details/<?php echo $this->uri->segment(3); ?>?itemid=<?php echo $row['poi_id']; ?>&acttype=edit" class="btn btn-sm btn-outline delete" onclick="return confirm('Are you sure you want to edit this item?');">Edit</a>
                <?php } ?>
                </td>
               
            </tr>
               <?php } } ?>
        </tbody>
</table>
</div>   