<?php //echo '<pre>';print_r($item_data); die;?>
<?php 
$clsar = array('class' => 'form-horizontal');
echo form_open_multipart($action_item,$clsar); ?>
<!-- <h4>Some Input</h4> -->
        <?php if(isset($edit_items) && !empty($edit_items)){ ?>
            <div class="row">
            <div class="col-md-6"><h4>Edit Details No : <?php echo $edit_items['contact_id']; ?></h4></div>
            <div class="col-md-6" style="text-align:right;"><a class="btn green" style="text-align:right;" href="<?php echo base_url(); ?>Master_party/quatation_tab/<?php echo $this->uri->segment(3); ?>" >New Details Add</a></div>
            </div>
        <?php }else{ ?>
            <h4>Add New Details</h4>
            <?php } ?>
            <hr/>
            <div class="row">
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group" id="mcna_namegr">
                                <label class="control-label col-md-3">Name</label>
                                <div class="col-md-9">
                                    <input type="text" tabindex="17" class="form-control" placeholder="Name" name="contact_pname" maxlength="200" id="contact_pname" value="<?php echo isset($edit_items['contact_pname']) ? $edit_items['contact_pname'] : ""; ?>" autofocus>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group" id="mcna_namegr">
                                <label class="control-label col-md-3">Mobile</label>
                                <div class="col-md-9">
                                    <input type="text" tabindex="17" class="form-control" placeholder="Mobile" name="contact_mobile" maxlength="200" id="contact_mobile" value="<?php echo isset($edit_items['contact_mobile']) ? $edit_items['contact_mobile'] : ""; ?>" autofocus>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group" id="mcna_namegr">
                                <label class="control-label col-md-3">Email</label>
                                <div class="col-md-9">
                                    <input type="text" tabindex="17" class="form-control" placeholder="Email" name="contact_email" maxlength="200" id="contact_email" value="<?php echo isset($edit_items['contact_email']) ? $edit_items['contact_email'] : ""; ?>" autofocus>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group" id="mcna_namegr">
                                <label class="control-label col-md-3">Designation </label>
                                <div class="col-md-9">
                                    <input type="text" tabindex="17" class="form-control" placeholder="Designation" name="contact_designation" maxlength="200" id="contact_designation" value="<?php echo isset($edit_items['contact_designation']) ? $edit_items['contact_designation'] : ""; ?>" autofocus>
                                </div>
                            </div>
                         </div>
                    </div>
                </div>
            </div>
            <div class="form-actions">
                <div class="row">
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-offset-3 col-md-9">
                                <button type="submit" tabindex="26" class="btn green" onclick="return ValidateDetails()">SUBMIT</button>
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
                        <th  width="2%">Name</th> 
                        <th  width="2%">Mobile</th>
                        <th  width="2%">Email</th>
                        <th  width="2%">Designation</th> 
                        <th  width="2%">Delete</th>
                    </tr>
                </thead>
                    <tbody>

                <?php $i = 0; foreach($items as $row){ $i++;?>
                <tr>
                    <td><?php echo $i;?></td>
                    <td><?php echo $row['contact_pname'];?></td>
                    <td><?php echo $row['contact_mobile'];?></td>
                    <td><?php echo $row['contact_email'];?></td>
                    <td><?php echo $row['contact_designation'];?></td>
                    <?php $aid = encrypt_decrypt('encrypt', $row['contact_id']); ?>
                    <td><a href="<?php echo base_url(); ?>Master_party/delete_itms/<?php echo $aid; ?>/<?php echo $this->uri->segment(3); ?>" class="btn btn-sm btn-outline delete" class="btn btn-sm btn-outline delete" onclick="return confirm('Are you sure you want to delete this item?');">Delete</a>

                    <a href="<?php echo base_url(); ?>Master_party/quatation_tab/<?php echo $this->uri->segment(3); ?>?itemid=<?php echo $row['contact_id']; ?>&acttype=edit" class="btn btn-sm btn-outline delete" onclick="return confirm('Are you sure you want to edit this item?');">Edit</a>
                    </td>
                </tr>
            
                   <?php } //echo '<pre>';print_r($chartarray);die; ?>
                </tbody>
            </table>
        </div>
<?php echo form_close(); ?>  
 