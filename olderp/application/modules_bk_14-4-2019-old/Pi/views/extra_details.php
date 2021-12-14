<?php
$clsar = array('class' => 'form-horizontal');
echo form_open($action_extra,$clsar); ?>
<h4>Extra Charges</h4>
 <hr/>
            <div class="row">            
                <div class="col-md-6">
                    <div class="form-group" id="mcna_namegr">
                        <label class="control-label col-md-3">Description</label>
                        <div class="col-md-9">
                            <textarea class="form-control" tabindex="71" placeholder="Remark" name="pi_extra_descriptio" id="pi_extra_descriptio" rows="3"><?php echo isset($edit_extra['pi_extra_descriptio']) ? $edit_extra['pi_extra_descriptio'] : ""; ?></textarea> 
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group" id="mcna_namegr">
                        <label class="control-label col-md-3">Qty</label>
                        <div class="col-md-9">
                            <input type="text" tabindex="72" class="form-control" placeholder="Qty" name="pi_extra_qty" maxlength="200" id="pi_extra_qty" value="<?php echo isset($edit_extra['pi_extra_qty']) ? $edit_extra['pi_extra_qty'] : ""; ?>">
                        </div>
                    </div>
                </div>
             </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group" id="mcna_namegr">
                        <label class="control-label col-md-3">Price</label>
                        <div class="col-md-9">
                            <input type="text" tabindex="73" class="form-control" placeholder="Price" name="pi_extra_price" maxlength="200" id="pi_extra_price" value="<?php echo isset($edit_extra['pi_extra_price']) ? $edit_extra['pi_extra_price'] : ""; ?>">
                        </div>
                    </div>
                </div>
             </div>
            <div class="row">
                 <div class="col-md-6">
                    <div class="form-group" id="mcna_namegr">
                        <label class="control-label col-md-3">Total</label>
                        <div class="col-md-9">
                            <input type="text" tabindex="74" class="form-control" placeholder="Total" name="pi_extra_total" maxlength="200" id="pi_extra_total" value="<?php echo isset($edit_extra['pi_extra_total']) ? $edit_extra['pi_extra_total'] : ""; ?>">
                        </div>
                    </div>
                </div>
            </div>
<div class="modal-footer pull-left">
    <input type="submit" class="btn btn-success btn-space" name="submit" value="save" tabindex="75" />
</div>
<div class="portlet-body">
    <table class="table table-striped table-bordered table-hover dt-responsive" width="100%" id="sample_1">
            <thead>
                <tr>
                    <th  width="2%">Sr.No</th>
                    <th  width="2%">Description</th> 
                    <th  width="2%">Qty</th> 
                    <th  width="2%">Price</th>
                    <th  width="2%">Total</th>
                    <th  width="2%">Delete</th>
                </tr>
            </thead>
            <tbody>
            <?php $i = 0;  foreach($extra_data as $row){ $i++;?>
            <tr>
                <td><?php echo $i;?></td>
                <td><?php echo $row['pi_extra_descriptio'];?></td>
                <td><?php echo $row['pi_extra_qty'];?></td>
                <td><?php echo $row['pi_extra_price'];?></td>
                <td><?php echo $row['pi_extra_total'];?></td>
                <?php $aid = encrypt_decrypt('encrypt', $row['pi_extra_id']); ?>
                <td><a href="<?php echo base_url(); ?>Pi/delete_extra/<?php echo $aid; ?>/<?php echo $this->uri->segment(3); ?>" class="btn btn-sm btn-outline delete" class="btn btn-sm btn-outline delete" onclick="return confirm('Are you sure you want to delete this item?');">Delete</a>

                    <a href="<?php echo base_url(); ?>Pi/quatation_tab/<?php echo $this->uri->segment(3); ?>?extraid=<?php echo $row['pi_extra_id']; ?>&acttype=edit" class="btn btn-sm btn-outline delete" onclick="return confirm('Are you sure you want to edit this item?');">Edit</a> 
                </td>
            </tr>        
               <?php } //echo '<pre>';print_r($chartarray);die; ?>
            </tbody>
    </table>
</div>
<?php echo form_close(); ?>      