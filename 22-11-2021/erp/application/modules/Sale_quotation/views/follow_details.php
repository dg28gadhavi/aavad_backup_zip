<?php 
$clsar = array('class' => 'form-horizontal');
echo form_open($action_follow,$clsar); ?>
<!-- <h4>Some Input</h4> -->        
        <div class="row">
            <div class="col-md-6">
                <div class="form-group" id="mcna_namegr">
                    <label class="control-label col-md-3">Start MM/YY</label>
                    <div class="col-md-9">                        
                        <input type="text" tabindex="51" class="form-control form-control-inline input-medium date-picker" placeholder="Start MM/YY" name="fu_followdate" maxlength="200" id="fu_followdate" value="">
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group" id="mcna_namegr">
                    <label class="control-label col-md-3">Follow Up Method</label>
                    <div class="col-md-9">
                        <select name="fu_followmethod" id="fu_followmethod" tabindex="52" class="bs-select form-control itmchange" data-live-search="true" data-size="8">
                            <option value="0">Select Follow Up Method</option>
                                <?php  foreach($follow_method as $methods) {?>  <option value="<?php echo $methods['fu_method_id'];?>" <?php if(isset($list[0]['fu_followmethod']) && $list[0]['fu_followmethod'] == $methods['fu_method_id']){ echo "selected";}?>><?php echo $methods['fu_method_name']; ?></option><?php } ?> 
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group" id="mcna_namegr">
                    <label class="control-label col-md-3">Follow Up By Executive</label>
                    <div class="col-md-9">
                        <?php $uid = encrypt_decrypt('decrypt', $this->session->userdata['miconlogin']['userid']); ?>
                        <select name="fu_followexe" id="fu_followexe" tabindex="53" class="bs-select form-control itmchange" data-live-search="true" data-size="8">
                             <option value="0">Select Follow Up By Executive</option>
                                <?php  foreach($follow_exe as $methods) {?>  <option value="<?php echo $methods['au_id'];?>" <?php if(isset($uid) && $uid == $methods['au_id']){ echo "selected";}?>><?php echo $methods['au_fname']; ?></option><?php } ?> 
                            </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group" id="mcna_namegr">
                        <label class="control-label col-md-3">Follow Up Status</label>
                        <div class="col-md-9">
                            <select name="fu_followupst" id="fu_followupst" tabindex="54" class="bs-select form-control itmchange" data-live-search="true" data-size="8">
                                <option value="0">Select Follow Up Status</option>
                                <?php  foreach($follow_status as $sts) {?>  <option value="<?php echo $sts['inqfus_id'];?>" <?php if(isset($list[0]['fu_followupst']) && $list[0]['fu_followupst'] == $sts['inqfus_id']){ echo "selected";}?>><?php echo $sts['inqfus_name']; ?></option><?php } ?> 
                            </select>
                        </div>
                    </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group" id="mcna_namegr">
                    <label class="control-label col-md-3">Remark</label>
                    <div class="col-md-9">
                        <textarea class="form-control" tabindex="55" placeholder="Remark" name="fu_remark" id="fu_remark" rows="3"></textarea>
                    </div>
                </div>
            </div>
        </div>
<!-- <div class="modal-footer pull-left">
  <input type="submit" class="btn btn-success btn-space" name="submit" value="Save" tabindex="10" />
</div> -->
    <div class="form-actions">
        <div class="row">
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-offset-3 col-md-9">
                        <button type="submit" tabindex="56" class="btn green" onclick="return ValidateDetails()">SUBMIT</button>
                    </div>
                </div>
            </div>
            <div class="col-md-6"> </div>
        </div>
    </div>
<?php echo form_close(); ?>   
<br> 
<div class="portlet-body">
<table class="table table-striped table-bordered table-hover dt-responsive" width="100%" id="sample_1">
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

            <?php $i = 0;  foreach($folups as $row){ $i++;?>
            <tr>
                <td><?php echo $i;?></td>
                <td><?php echo date("d-m-Y", strtotime($row['fu_followdate']));?></td>
                <td><?php echo $row['fu_method_name'];?></td>
                <td><?php echo $row['au_fname'];?></td>
                <td><?php echo $row['inqfus_name'];?></td>
                <td><?php echo $row['fu_remark'];?></td>
                <?php $aid = encrypt_decrypt('encrypt', $row['fu_id']); ?>
                <td><a href="<?php echo base_url(); ?>Sale_quotation/delete_folup/<?php echo $aid; ?>/<?php echo $this->uri->segment(3); ?>" class="btn btn-sm btn-outline delete" class="btn btn-sm btn-outline delete" onclick="return confirm('Are you sure you want to delete this item?');">Delete</a>
                    </td>
                <td>
                    <?php if(isset($row['fu_followupst']) && $row['fu_followupst'] == 6) { ?>
                <a href="<?php echo base_url(); ?>Sale_quotation/change_fstatus_toact/<?php echo $aid; ?>/<?php echo $this->uri->segment(3); ?>" class="btn btn-sm btn-outline delete" class="btn btn-sm btn-outline delete" onclick="return confirm('Are you sure you want to Active Folloup Status ?');">Active</a>
                <?php } ?>
             <?php if(isset($row['fu_followupst']) && $row['fu_followupst'] == 5) { ?>
                <a href="<?php echo base_url(); ?>Sale_quotation/change_fstatus_todeact/<?php echo $aid; ?>/<?php echo $this->uri->segment(3); ?>" class="btn btn-sm btn-outline delete" class="btn btn-sm btn-outline delete" onclick="return confirm('Are you sure you want to Deactive Folloup Status?');">Deactive</a>
                <?php } ?></td>
            </tr>
        
               <?php } //echo '<pre>';print_r($chartarray);die; ?>
            </tbody>
        </table>
</div>  