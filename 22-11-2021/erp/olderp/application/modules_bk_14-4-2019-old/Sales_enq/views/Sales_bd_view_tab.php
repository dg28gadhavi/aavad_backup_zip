
<?php 
$clsar = array('class' => 'form-horizontal','autocomplete' => 'off');
echo form_open($action_bd,$clsar); ?>
<!-- <h4>Some Input</h4> -->
        <div class="row">
            <div class="col-md-6">
                <div class="form-group" id="mcna_namegr">
                    <label class="control-label col-md-3">Inquiry No</label>
                    <div class="col-md-9">
                       <input type="text"  class="form-control"  name="sq_no" maxlength="200" id="sq_no " value="<?php echo !$this->uri->segment(3) && isset($sq_code) ? $sq_code : ''; ?><?php echo isset($list[0]['sq_no']) ? $list[0]['sq_no'] : ""; ?>">
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label class="control-label col-md-3">Inquiry Date</label>
                    <div class="col-md-9">
                         <input type="text" class="form-control form-control-inline input-medium date-picker" placeholder="Inquiry Date" name="sq_enq_date" maxlength="200" id="sq_enq_date" value="<?php echo isset($list[0]['sq_enq_date']) ? date("d-m-Y", strtotime($list[0]['sq_enq_date'])) : ""; ?>">
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
                                      <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label col-md-3">Customer Name</label>
                                            <div class="col-md-9">
                                               <input type="text" class="form-control vendor" placeholder="Customer Name" name="vendor" maxlength="100" id="vendor" value="<?php echo isset($list[0]['vendor']) ? $list[0]['vendor'] : ""; ?>" required="required">
                                               <input type="hidden" name="vendor_id" id="vendor_id" value="<?php echo isset($list[0]['vendor_id']) ? $list[0]['vendor_id'] : ""; ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group" id="mcna_namegr">
                                            <label class="control-label col-md-3">Customer Type:</label>
                                            <div class="col-md-9">
                                                <select name="sq_cust_type" id="sq_cust_type" class="bs-select form-control itmchange" data-live-search="true" data-size="8">
                                                    <option value="0">Customer Type</option>
                                                    <?php  foreach($custometyps as $country) {?>  <option value="<?php echo $country['ctype_id'];?>" <?php if(isset($list[0]['sq_cust_type']) && $list[0]['sq_cust_type'] == $country['ctype_id']){ echo "selected";}?>><?php echo $country['ctype_name']; ?></option><?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    </div>
                                    <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group" id="mcna_namegr">
                                            <label class="control-label col-md-3">Customer Address</label>
                                            <div class="col-md-9">
                                            <textarea class="form-control" name="sq_address" placeholder="Customer Address" id="sq_address" rows="3"><?php echo isset($list[0]['sq_address']) ? $list[0]['sq_address'] : ""; ?></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    </div>
                                    <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group" id="mcna_namegr">
                                            <label class="control-label col-md-3">Country:</label>
                                            <div class="col-md-9">
                                                <select name="sq_country" id="country_change" class="bs-select form-control country_change" data-live-search="true" data-size="8">
                                                    <option value="">Select Country</option>
                                                    <?php  foreach($countries as $country) {?>  <option value="<?php echo $country['country_id'];?>" <?php if(isset($list[0]['sq_country']) && $list[0]['sq_country'] == $country['country_id']){ echo "selected";}?>><?php echo $country['country_name']; ?></option><?php } ?> 
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                     <div class="col-md-6">
                                        <div class="form-group" id="mcna_namegr">
                                            <label class="control-label col-md-3">State:</label>
                                            <div class="col-md-9">
                                                <select name="sq_state" id="state_change" class="bs-select form-control state_change" data-live-search="true" data-size="8">
                                                    <option value="">Select State</option>
                                                    <?php  foreach($states as $state) {?>  <option value="<?php echo $state['state_id'];?>" <?php if(isset($list[0]['sq_state']) && $list[0]['sq_state'] == $state['state_id']){ echo "selected";}?>><?php echo $state['state_name']; ?></option><?php } ?> 
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group" id="master_party_taxgr">
                                            <label class="control-label col-md-3">City:</label>
                                            <div class="col-md-9">
                                               <select name="sq_city" id="city_change" class="form-control city_change bs-select" data-live-search="true" data-size="8">
                                                <option value="">Select City</option>
                                                    <?php  foreach($cities as $citie) {?>  <option value="<?php echo $citie['city_id'];?>" <?php if(isset($list[0]['sq_city']) && $list[0]['sq_city'] == $citie['city_id']){ echo "selected";}?>><?php echo $citie['city_name']; ?></option><?php } ?> 
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                      <div class="col-md-6">
                                        <div class="form-group" id="mcna_namegr">
                                            <label class="control-label col-md-3">Brand:</label>
                                            <div class="col-md-9">
                                            <select multiple="multiple" class="multi-select" id="my_multi_select1" name="sq_brand[]">
                                                  <?php foreach ($brands as $brand) { 
                                                ?>
                                            <option value="<?php echo $brand['brand_id'];?>"<?php 
                                            if(isset($list[0]['sq_brand']) && $list[0]['sq_brand'] != ''){ 
                                            $re_homenames = json_decode($list[0]['sq_brand']);
                                                if($re_homenames == ''){ echo '';}else{
                                                foreach($re_homenames as $re_homename){
                                                  if(isset($re_homename) && $re_homename == $brand['brand_id']){ echo "selected";} } } }?>><?php echo $brand['brand_name']; ?></option>
                                            <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label col-md-3">Contact Person:</label>
                                            <div class="col-md-9">
                                               <input type="text" class="form-control" placeholder="Contact Person" name="sq_con_person" maxlength="100" id="sq_con_person" value="<?php echo isset($list[0]['sq_con_person']) ? $list[0]['sq_con_person'] : ""; ?>">
                                            </div>
                                        </div>
                                    </div>
                                      <div class="col-md-6">
                                        <div class="form-group" id="mcna_namegr">
                                            <label class="control-label col-md-3">Mobile No</label>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control" placeholder="Mobile No" name="sq_mobile" maxlength="200" id="sq_mobile" value="<?php echo isset($list[0]['sq_mobile']) ? $list[0]['sq_mobile'] : ""; ?>">
                                            </div>
                                        </div>
                                    </div>
                                    </div>
                                    <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label col-md-3">Email Id</label>
                                            <div class="col-md-9">
                                               <input type="text" class="form-control" placeholder="Email Id" name="sq_email" maxlength="100" id="sq_email" value="<?php echo isset($list[0]['sq_email']) ? $list[0]['sq_email'] : ""; ?>" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label col-md-3">Phone No</label>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control" placeholder="Phone No" name="sq_phone" maxlength="100" id="sq_phone" value="<?php echo isset($list[0]['sq_phone']) ? $list[0]['sq_phone'] : ""; ?>" >
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group" id="mcna_namegr">
                                            <label class="control-label col-md-3">Website Address</label>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control" placeholder="Website Address" name="sq_website" maxlength="200" id="sq_website" value="<?php echo isset($list[0]['sq_website']) ? $list[0]['sq_website'] : ""; ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group" id="mcna_namegr">
                                            <label class="control-label col-md-3">GST No.</label>
                                            <div class="col-md-9">
                                                <input type="text" tabindex="13" class="form-control" placeholder="GST No." name="sq_gstno" maxlength="200" id="sq_gstno" value="<?php echo isset($list[0]['sq_gstno']) ? $list[0]['sq_gstno'] : ""; ?>">
                                            </div>
                                        </div>
                                    </div>
                                     </div>
                                     <div class="row" style="display:none">
                                     <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label col-md-3">Reminder Date:</label>
                                            <div class="col-md-9">
                                                 <input type="text" class="form-control form-control-inline input-medium date-picker" placeholder="Reminder Date" name="sq_rem_date" maxlength="200" id="sq_rem_date" value="<?php echo isset($list[0]['sq_rem_date']) ? date("d-m-Y", strtotime($list[0]['sq_rem_date'])) : ""; ?>">
                                                
                                            </div>
                                        </div>
                                    </div>
                                     <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label col-md-3">Remind before (In days):</label>
                                            <div class="col-md-9">
                                                  <input type="text" class="form-control" placeholder="Reminder Before Days" name="sq_rem_be_date" maxlength="100" id="sq_rem_be_date" value="<?php echo isset($list[0]['sq_rem_be_date']) ? $list[0]['sq_rem_be_date'] : ""; ?>">
                                            </div>
                                        </div>
                                    </div>
                                    </div>
                                    <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group" id="mcna_namegr">
                                            <label class="control-label col-md-3">Inquiry By :</label>
                                            <div class="col-md-9">
                                                <?php $uid = encrypt_decrypt('decrypt', $this->session->userdata['miconlogin']['userid']); ?>
                                                <select name="sq_end_st" id="sq_end_st" class="bs-select form-control itmchange" data-live-search="true" data-size="8">
                                                    <option value="0">Select Inquiry By</option>
                                                    <?php  foreach($admins as $vendor) {?>  <option value="<?php echo $vendor['au_id'];?>" <?php if(isset($list[0]['sq_end_st']) && $list[0]['sq_end_st'] == $vendor['au_id']){ echo "selected";}else{  }?>><?php echo $vendor['au_fname']; ?></option><?php } ?> 
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                     <div class="col-md-6" style="display:none;">
                                        <div class="form-group" id="mcna_namegr">
                                            <label class="control-label col-md-3">Mode of Inquiry :</label>
                                            <div class="col-md-9">
                                                <select name="sq_mode_inq" id="sq_mode_inq" class="bs-select form-control itmchange" data-live-search="true" data-size="8">
                                                    <option value="0">Select Mode of Inquiry</option>
 <?php  foreach($modeinquries as $modeinqurie) {?>  <option value="<?php echo $modeinqurie['mode_inquiry_id'];?>" <?php if(isset($list[0]['sq_mode_inq']) && $list[0]['sq_mode_inq'] == $modeinqurie['mode_inquiry_id']){ echo "selected";}?>><?php echo $modeinqurie['mode_inquiry_name']; ?></option>
                                                  <?php } ?> 
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                   <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group" id="master_party_taxgr">
                                            <label class="control-label col-md-3">Source category</label>
                                            <div class="col-md-9">
                                                <select name="sq_source_cat" id="sq_source_cat" class="form-control bs-select" data-live-search="true" data-size="8"  onchange="sub_cat(this)">
                                                <option value="0">Select Source category</option>
                                                    <?php foreach($sources as $source)
                                                    { ?>
                                                            <option value="<?php echo $source['source_cat_id']; ?>" <?php if(isset($list[0]['sq_source_cat']) && $list[0]['sq_source_cat'] == $source['source_cat_id']){ echo "selected";} ?>> <?php echo $source['source_cat_name']; ?>
                                                            </option>                                                    
                                                    <?php }?>
                                                        
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                     <div class="col-md-6">
                                        <div class="form-group" id="mcna_namegr">
                                            <label class="control-label col-md-3">Sub Source category</label>
                                            <div class="col-md-9">
                                            <select name="sq_subsource_cat" id="sq_subsource_cat" class="form-control bs-select" data-live-search="true" data-size="8">
                                                <option value="0">Select sub category</option>
                                                  <?php  foreach($subsources as $subsource) {?>  
                                                  <option value="<?php echo $subsource['source_cat_id'];?>" <?php if(isset($list[0]['sq_subsource_cat']) && $list[0]['sq_subsource_cat'] == $subsource['source_cat_id']){ echo "selected";}?>><?php echo $subsource['source_cat_name']; ?></option>
                                                  <?php } ?> 
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                 <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group" id="mcna_namegr">
                                            <label class="control-label col-md-3">Status :</label>
                                            <div class="col-md-9">
                                                 <select name="sq_inq_sts" id="sq_inq_sts" class="form-control bs-select" data-live-search="true" data-size="8">
                                                <option value="0">Select Status</option>
                                                  <option value="1" <?php if(isset($list[0]['sq_inq_sts']) && $list[0]['sq_inq_sts'] == 1){ echo "selected";}?>>Active</option>
                                                  <option value="2" <?php if(isset($list[0]['sq_inq_sts']) && $list[0]['sq_inq_sts'] == 2){ echo "selected";}?>>Pending</option>
                                                  <option value="3" <?php if(isset($list[0]['sq_inq_sts']) && $list[0]['sq_inq_sts'] == 3){ echo "selected";}?>>Completed</option>
                                                  <option value="4" <?php if(isset($list[0]['sq_inq_sts']) && $list[0]['sq_inq_sts'] == 4){ echo "selected";}?>>Quote</option>
                                                  <option value="5" <?php if(isset($list[0]['sq_inq_sts']) && $list[0]['sq_inq_sts'] == 5){ echo "selected";}?>>Drop</option>
                                                  <option value="6" <?php if(isset($list[0]['sq_inq_sts']) && $list[0]['sq_inq_sts'] == 6){ echo "selected";}?>>Order</option>
                                                </select>
                                           </div>
                                        </div>
                                    </div>
                                     <div class="col-md-6">
                                        <div class="form-group" id="mcna_namegr">
                                            <label class="control-label col-md-3">Priority :</label>
                                            <div class="col-md-9">
                                                <select name="sq_inq_priority" id="sq_inq_priority" class="form-control bs-select" data-live-search="true" data-size="8">
                                                <option value="0">Select Priority</option>
                                                  <option value="1" <?php if(isset($list[0]['sq_inq_priority']) && $list[0]['sq_inq_priority'] == 1){ echo "selected";}?>>High</option>
                                                  <option value="2" <?php if(isset($list[0]['sq_inq_priority']) && $list[0]['sq_inq_priority'] == 2){ echo "selected";}?>>Low</option>
                                                  <option value="3" <?php if(isset($list[0]['sq_inq_priority']) && $list[0]['sq_inq_priority'] == 3){ echo "selected";}?>>Medium</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                    <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group" id="mcna_namegr">
                                            <label class="control-label col-md-3">Referred By</label>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control" tabindex="23" placeholder="Referred By" name="sq_ref_by" maxlength="200" id="sq_ref_by" value="<?php echo isset($list[0]['sq_ref_by']) ? $list[0]['sq_ref_by'] : ""; ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group" id="mcna_namegr">
                                            <label class="control-label col-md-3">Department Select:</label>
                                            <div class="col-md-9">
                                                <select name="sq_department" id="sq_department" tabindex="22" class="form-control bs-select">
                                                <option value="0">Select</option>
                                                  <option value="1" <?php if(isset($list[0]['sq_department']) && $list[0]['sq_department'] == 1){ echo "selected";}?>>Automation</option>
                                                  <option value="2" <?php if(isset($list[0]['sq_department']) && $list[0]['sq_department'] == 2){ echo "selected";}?>>Instrumentation</option>
                                                  <option value="3" <?php if(isset($list[0]['sq_department']) && $list[0]['sq_department'] == 3){ echo "selected";}?>>Communication</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>    
                                <div class="row">
                                     <div class="col-md-6">
                                        <div class="form-group" id="mcna_namegr">
                                            <label class="control-label col-md-3">Alloted to :</label>
                                            <div class="col-md-9">
                                                <?php $uid = encrypt_decrypt('decrypt', $this->session->userdata['miconlogin']['userid']); ?>
                                                <select name="sq_allotedto" tabindex="17" id="sq_allotedto" class="bs-select form-control itmchange" data-live-search="true" data-size="8">
                                                    <option value="0">Select</option>
                                                    <?php  foreach($admins as $vendor) {?>  <option value="<?php echo $vendor['au_id'];?>" <?php if(isset($list[0]['sq_allotedto']) && $list[0]['sq_allotedto'] == $vendor['au_id']){ echo "selected";}else{ /* if($uid && $uid == $vendor['au_id']) { echo "selected";} */ }?>><?php echo $vendor['au_fname']; ?></option><?php } ?> 
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label col-md-3">Remark</label>
                                            <div class="col-md-9">
                                             <textarea class="form-control" placeholder="Remark" name="sq_remarks" id="sq_remarks" rows="3"><?php echo isset($list[0]['sq_remarks']) ? $list[0]['sq_remarks'] : ""; ?></textarea>   
                                            </div>
                                        </div>
                                    </div>
                                </div> 
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label col-md-3">Product Details</label>
                                            <div class="col-md-9">
                                             <textarea class="form-control" placeholder="Product Details" name="sq_prodetails" id="sq_prodetails" rows="3"><?php echo isset($list[0]['sq_prodetails']) ? $list[0]['sq_prodetails'] : ""; ?></textarea>   
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                

<div class="modal-footer pull-left">
 <!-- <button type="button" data-dismiss="modal" class="btn dark btn-outline">Close</button> -->
  <input type="submit" class="btn btn-success btn-space" name="submit" value="Save" tabindex="10" />
</div>
<?php echo form_close(); ?> 
 
<!-- END PAGE LEVEL SCRIPTS -->
<!-- START add more SCRIPTS -->


<!-- END add more SCRIPTS -->