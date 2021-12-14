<?php 

$clsar = array('class' => 'form-horizontal','autocomplete' => 'off');
echo form_open($action_fup,$clsar); ?>
<!-- <h4>Some Input</h4> -->
        <div class="row">
             <div class="col-md-6">
                <div class="form-group">
                    <label class="control-label col-md-3">Follow Up Date</label>
                    <div class="col-md-9">
                          <input type="text" class="form-control form-control-inline input-medium date-picker" placeholder="Follow Up Date" name="fu_followdate" maxlength="100" id="fu_followdate" value="<?php echo isset($list[0]['sq_rem_be_date']) ? $list[0]['sq_rem_be_date'] : ""; ?>"required="required">
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group" id="master_party_taxgr">
                    <label class="control-label col-md-3">Follow Up Method</label>
                    <div class="col-md-9">
                       <select name="fu_followmethod" id="fu_followmethod" class="bs-select form-control itmchange" data-live-search="true" data-size="8">
                        <option value="">Select Follow Up Method</option>
                            <?php  foreach($fup_methd as $fup) {?>  <option value="<?php echo $fup['fu_method_id'];?>" <?php if(isset($list[0]['sq_city']) && $list[0]['sq_city'] == $fup['fu_method_id']){ echo "selected";}?>><?php echo $fup['fu_method_name']; ?></option><?php } ?> 
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
             <div class="col-md-6">
                <div class="form-group" id="master_party_taxgr">
                    <label class="control-label col-md-3">Follow Up By Executive</label>
                    <div class="col-md-9">
                       <select name="fu_followexe" id="fu_followexe" class="bs-select form-control itmchange" data-live-search="true" data-size="8">
                        <option value="">Select Executive</option>
                        <?php $uid = encrypt_decrypt('decrypt', $this->session->userdata['miconlogin']['userid']); ?>
                         <?php foreach($admins as $admin) {?>  
                            <option value="<?php echo $admin['au_id'];?>" <?php if(isset($uid) && $uid == $admin['au_id']){ echo "selected";}?>><?php echo $admin['au_fname'].' '.$admin['au_lname']; ?></option><?php } ?> 
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group" id="master_party_taxgr">
                    <label class="control-label col-md-3">Follow Up Status</label>
                    <div class="col-md-9">
                       <select name="fu_followupst" id="fu_followupst" class="bs-select form-control itmchange" data-live-search="true" data-size="8">
                        <option value="">Select Follow Up Status</option>
                            <?php  foreach($fup_status as $fup_stat) {?>  <option value="<?php echo $fup_stat['inqfus_id'];?>" <?php if(isset($list[0]['sq_city']) && $list[0]['sq_city'] == $fup_stat['inqfus_id']){ echo "selected";}?>><?php echo $fup_stat['inqfus_name']; ?></option><?php } ?> 
                        </select>
                    </div>
                </div>
            </div>
        </div>  
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label class="control-label col-md-3">Remark</label>
                    <div class="col-md-9">
                     <textarea class="form-control" placeholder="Remark" name="fu_remark" id="fu_remark" rows="3"><?php echo isset($list[0]['fu_remark']) ? $list[0]['fu_remark'] : ""; ?></textarea>   
                    </div>
                </div>
            </div>
        </div>     
                
<div class="modal-footer pull-left">
 <!-- <button type="button" data-dismiss="modal" class="btn dark btn-outline">Close</button> -->
  <input type="submit" class="btn btn-success btn-space" name="submit" value="Save" tabindex="10" />
</div>
<?php echo form_close(); ?> 
<div class="portlet-body">
            <table class="table table-striped table-bordered table-hover dt-responsive" width="100%" id="sample_2">
                        <thead>
                            <tr>
                                <th  width="2%">Sr.No</th>
                                <th  width="2%">Follow Up Date</th> 
                                <th  width="2%">Follow Up Method</th>
                                <th  width="2%">Follow Up By Executive</th>
                                <th  width="2%">Follow Up Status</th>
                                <th  width="2%">Remark</th>
                                <th  width="2%">Delete</th>
                                <th  width="2%">Active/Deactive</th>
                            </tr>
                        </thead>
                            <tbody>
                        <?php $id = 0;
                         if(isset($folups)) { 
                         foreach($folups as $row) { $id++; ?>
                        <tr>
                            <td><?php echo $id;?></td>
                            <td><?php echo date("d-m-Y", strtotime($row['fu_followdate']));?></td>
                            <td><?php echo $row['fu_method_name'];?></td>
                            <td><?php echo $row['au_fname'];?></td>
                            <td><?php echo $row['inqfus_name'];?></td>
                            <td><?php echo $row['fu_remark'];?></td>
                            <?php $aid = encrypt_decrypt('encrypt', $row['fu_id']); ?>
                            <td><a href="<?php echo base_url(); ?>Sales_enq/delete_fup/<?php echo $aid; ?>/<?php echo $this->uri->segment(3); ?>" class="btn btn-sm btn-outline delete" class="btn btn-sm btn-outline delete" onclick="return confirm('Are you sure you want to delete this item?');">Delete</a></td>
                            <td>
                                <?php if(isset($row['fu_followupst']) && $row['fu_followupst'] == 6) { ?>
                            <a href="<?php echo base_url(); ?>Sales_enq/change_fstatus_toact/<?php echo $aid; ?>/<?php echo $this->uri->segment(3); ?>" class="btn btn-sm btn-outline delete" class="btn btn-sm btn-outline delete" onclick="return confirm('Are you sure you want to Active Folloup Status ?');">Active</a>
                            <?php } ?>
                         <?php if(isset($row['fu_followupst']) && $row['fu_followupst'] == 5) { ?>
                            <a href="<?php echo base_url(); ?>Sales_enq/change_fstatus_todeact/<?php echo $aid; ?>/<?php echo $this->uri->segment(3); ?>" class="btn btn-sm btn-outline delete" class="btn btn-sm btn-outline delete" onclick="return confirm('Are you sure you want to Deactive Folloup Status?');">Deactive</a>
                            <?php } ?></td>
                           
                        </tr>
                           <?php } } ?>
                        </tbody>
                    </table>
        </div>     