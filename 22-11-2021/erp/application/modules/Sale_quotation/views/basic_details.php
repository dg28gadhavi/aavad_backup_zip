<div class="row">
<div class="col-md-12">
    <?php echo validation_errors(); ?>
    <?php
    if (!empty($success) || $this->session->flashdata('inw_success') != '') {

        $msg = !empty($success) ? $success : $this->session->flashdata('inw_success');

        echo '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button>' . $msg . '</div>';
    }
    if (!empty($error) || $this->session->flashdata('inw_error') != '') {

        $msg = !empty($error) ? $error : $this->session->flashdata('inw_error');

        echo '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button>' . $msg . '</div>';
    }
    if (!empty($warning) || $this->session->flashdata('inw_warning') != '') {

        $msg = !empty($warning) ? $warning : $this->session->flashdata('inw_warning');

        echo '<div class="alert alert-warning"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button>' . $msg . '</div>';
    }
    ?>
    <div class="space-2"></div>
</div>
</div>
<?php 
$clsar = array('class' => 'form-horizontal', 'autocomplete' => 'off');
echo form_open($action_bd,$clsar); ?>
<div class="row">    
    <div class="col-md-12">
                <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group" id="mcna_namegr">
                                                        <label class="control-label col-md-3">Quotation No</label>
                                                        <div class="col-md-9">
                                                           <input type="text" tabindex="1" class="form-control"  name="sa_no" maxlength="200" id="sa_no" value="<?php echo !$this->uri->segment(3) && isset($sa_code) ? $sa_code : ''; ?><?php echo isset($list[0]['sa_no']) ? $list[0]['sa_no'] : ""; ?>" autofocus>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label col-md-3">Quotation Date</label>
                                                        <div class="col-md-9">
                                                             <input type="text" tabindex="2" class="form-control form-control-inline input-medium date-picker" placeholder="Quotation Date" name="sa_enq_date" maxlength="200" id="sa_enq_date" value="<?php echo isset($list[0]['sa_enq_date']) ? date("d-m-Y", strtotime($list[0]['sa_enq_date'])) : date('d-m-Y'); ?>">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label col-md-3">Inq Reference No.</label>
                                                        <div class="col-md-9">
                                                             <input type="text" tabindex="2" class="form-control" placeholder="Inq Reference No." name="sa_inq_ref_no" maxlength="200" id="sa_inq_ref_no" value="<?php echo isset($list[0]['sa_inq_ref_no']) ? $list[0]['sa_inq_ref_no'] : ""; ?>">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label col-md-3">Inq Reference Date</label>
                                                        <div class="col-md-9">
                                                             <input type="text" tabindex="2" class="form-control form-control-inline input-medium date-picker" placeholder="Reference Date" name="sa_inq_ref_date" maxlength="200" id="sa_inq_ref_date" value="<?php echo isset($list[0]['sa_inq_ref_date']) ? date("d-m-Y", strtotime($list[0]['sa_inq_ref_date'])) : date('d-m-Y'); ?>">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label col-md-3">Customer Name</label>
                            <div class="col-md-9">
                               <input type="text" class="form-control vendor" tabindex="3" placeholder="Customer Name" name="vendor" maxlength="100" id="vendor" value="<?php echo isset($list[0]['vendor']) ? $list[0]['vendor'] : ""; ?>" required="required">
                               <input type="hidden" name="vendor_id" id="vendor_id" value="<?php echo isset($list[0]['vendor_id']) ? $list[0]['vendor_id'] : ""; ?>">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group" id="mcna_namegr">
                            <label class="control-label col-md-3">Customer Address</label>
                            <div class="col-md-9">
                                <textarea class="form-control" name="sa_address" tabindex="4" placeholder="Customer Address" id="sa_address" rows="3"><?php echo isset($list[0]['sa_address']) ? $list[0]['sa_address'] : ""; ?></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label col-md-3">Contact Person:</label>
                            <div class="col-md-9">
                               <input type="text" class="form-control" tabindex="9" placeholder="Contact Person" name="sa_con_person" maxlength="100" id="sa_con_person" value="<?php echo isset($list[0]['sa_con_person']) ? $list[0]['sa_con_person'] : ""; ?>">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group" id="mcna_namegr">
                            <label class="control-label col-md-3">Mobile No</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" tabindex="10" placeholder="Mobile No" name="sa_mobile" maxlength="200" id="sa_mobile" value="<?php echo isset($list[0]['sa_mobile']) ? $list[0]['sa_mobile'] : ""; ?>">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label col-md-3">Email Id</label>
                            <div class="col-md-9">
                               <input type="text" class="form-control" tabindex="11" placeholder="Email Id" name="sa_email" maxlength="100" id="sa_email" value="<?php echo isset($list[0]['sa_email']) ? $list[0]['sa_email'] : ""; ?>">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label col-md-3">Phone No</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" tabindex="12" placeholder="Phone No" name="sa_phone" maxlength="100" id="sa_phone" value="<?php echo isset($list[0]['sa_phone']) ? $list[0]['sa_phone'] : ""; ?>" >
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group" id="mcna_namegr">
                            <label class="control-label col-md-3">Website Address</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" tabindex="13" placeholder="Website Address" name="sa_website" maxlength="200" id="sa_website" value="<?php echo isset($list[0]['sa_website']) ? $list[0]['sa_website'] : ""; ?>">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group" id="mcna_namegr">
                            <label class="control-label col-md-3">GST No.</label>
                            <div class="col-md-9">
                                <input type="text" tabindex="13" tabindex="14" class="form-control" placeholder="GST No." name="sa_gstno" maxlength="200" id="sa_gstno" value="<?php echo isset($list[0]['sa_gstno']) ? $list[0]['sa_gstno'] : ""; ?>">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row" style="display: none;">
                    <div class="col-md-6">
                        <div class="form-group" id="mcna_namegr">
                            <label class="control-label col-md-3">Country:</label>
                            <div class="col-md-9">
                                <select name="sa_country" id="country_change" tabindex="5" class="form-control country_change bs-select" data-live-search="true" data-size="8">
                                    <option value="">Select Country</option>
                                    <?php  foreach($countries as $country) {?>  <option value="<?php echo $country['country_id'];?>" <?php if(isset($list[0]['sa_country']) && $list[0]['sa_country'] == $country['country_id']){ echo "selected";}?>><?php echo $country['country_name']; ?></option><?php } ?> 
                                </select>
                            </div>
                        </div>
                    </div>
                     <div class="col-md-6">
                        <div class="form-group" id="mcna_namegr">
                            <label class="control-label col-md-3">State:</label>
                            <div class="col-md-9">
                                <select name="sa_state" id="state_change" tabindex="6" class="bs-select form-control state_change" data-live-search="true" data-size="8">
                                    <option value="">Select State</option>
                                    <?php  foreach($states as $state) {?>  <option value="<?php echo $state['state_id'];?>" <?php if(isset($list[0]['sa_state']) && $list[0]['sa_state'] == $state['state_id']){ echo "selected";}?>><?php echo $state['state_name']; ?></option><?php } ?> 
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group" id="master_party_taxgr">
                            <label class="control-label col-md-3">City:</label>
                            <div class="col-md-9">
                               <select name="sa_city" id="city_change" tabindex="7" class="bs-select form-control city_change" data-live-search="true" data-size="8">
                                <option value="">Select City</option>
                                    <?php  foreach($cities as $citie) {?>  <option value="<?php echo $citie['city_id'];?>" <?php if(isset($list[0]['sa_city']) && $list[0]['sa_city'] == $citie['city_id']){ echo "selected";}?>><?php echo $citie['city_name']; ?></option><?php } ?> 
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                     <div class="col-md-6">
                        <div class="form-group" id="mcna_namegr">
                            <label class="control-label col-md-3">Subject:</label>
                            <div class="col-md-9">
                            <textarea class="form-control" tabindex="24" id="sale_quotation_sub" name="sale_quotation_sub" rows="5"><?php echo isset($list[0]['sale_quotation_sub']) ? $list[0]['sale_quotation_sub'] : ''; ?><?php if(isset($list[0]['sale_quotation_sub']) && $list[0]['sale_quotation_sub'] == '') { ?><?php } ?></textarea>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="form-group" id="mcna_namegr">
                            <label class="control-label col-md-3">Brand:</label>
                            <div class="col-md-9">
                            <select multiple="multiple" tabindex="8" class="multi-select" id="my_multi_select1" name="sa_brand[]">
                                  <?php foreach ($brands as $brand) { 
                                ?>
                            <option value="<?php echo $brand['brand_id'];?>"<?php 
                            if(isset($list[0]['sa_brand']) && $list[0]['sa_brand'] != ''){
                            $re_homenames = json_decode($list[0]['sa_brand']);
                             if($re_homenames == ''){ echo '';}else{
                                //echo "<pre>"; print_r($brand['home_id']); 
                                foreach($re_homenames as $re_homename){
                                  if(isset($re_homename) && $re_homename == $brand['brand_id']){ echo "selected";} } } }?>><?php echo $brand['brand_name']; ?></option>
                            <?php } ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="row" style="display:none">
                     <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label col-md-3">Reminder Date</label>
                            <div class="col-md-9">
                                 <input type="text" class="form-control form-control-inline input-medium date-picker" tabindex="15" placeholder="Reminder Date" name="sa_rem_date" maxlength="200" id="sa_rem_date" value="<?php echo isset($list[0]['sa_rem_date']) ? date("d-m-Y", strtotime($list[0]['sa_rem_date'])) : ""; ?>">
                                
                            </div>
                        </div>
                    </div>
                     <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label col-md-3">Remind before (In days)</label>
                            <div class="col-md-9">
                                  <input type="text" class="form-control" tabindex="16" placeholder="Reminder Before Days" name="sa_rem_be_date" maxlength="100" id="sa_rem_be_date" value="<?php echo isset($list[0]['sa_rem_be_date']) ? $list[0]['sa_rem_be_date'] : ""; ?>">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group" id="mcna_namegr">
                            <label class="control-label col-md-3">Referred By</label>
                            <div class="col-md-9">
                                <input type="text" tabindex="23" class="form-control" placeholder="Referred By" name="sa_referred_by" maxlength="200" id="sa_referred_by" value="<?php echo isset($list[0]['sa_referred_by']) ? $list[0]['sa_referred_by'] : ""; ?>">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group" id="mcna_namegr">
                            <label class="control-label col-md-3">Prepared By </label>
                            <div class="col-md-9">
                                <?php $uid = encrypt_decrypt('decrypt', $this->session->userdata['miconlogin']['userid']); ?>
                                <select name="sa_inq_by" id="sa_inq_by" tabindex="17" class="bs-select form-control itmchange" data-live-search="true" data-size="8">
                                    <option value="0">Select Inquiry By</option>
                                    <?php  foreach($follow_exe as $vendor) {?>  <option value="<?php echo $vendor['au_id'];?>" <?php if(isset($list[0]['sa_inq_by']) && $list[0]['sa_inq_by'] == $vendor['au_id']){ echo "selected";}?>><?php echo $vendor['au_fname']; ?></option><?php } ?> 
                                </select>
                            </div>
                        </div>
                </div>
                <div class="col-md-6" style="display:none;">
                    <div class="form-group" id="mcna_namegr">
                        <label class="control-label col-md-3">Mode of Inquiry</label>
                        <div class="col-md-9">
                            <select name="sa_mode_inq" id="sa_mode_inq" tabindex="18" class="form-control">
                                <option value="0">Select Mode of Inquiry</option>
                                <?php  foreach($modeinquries as $modeinqurie) {?>  <option value="<?php echo $modeinqurie['mode_inquiry_id'];?>" <?php if(isset($list[0]['sa_mode_inq']) && $list[0]['sa_mode_inq'] == $modeinqurie['mode_inquiry_id']){ echo "selected";}?>><?php echo $modeinqurie['mode_inquiry_name']; ?></option>
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
                            <select name="sa_source_cat" id="sa_source_cat" tabindex="19" class="form-control bs-select" data-live-search="true" data-size="8"  onchange="sub_cat(this)">
                                <option value="0">Select Source category</option>
                                <?php foreach($sources as $source)
                                { ?>
                                        <option value="<?php echo $source['source_cat_id']; ?>" <?php if(isset($list[0]['sa_source_cat']) && $list[0]['sa_source_cat'] == $source['source_cat_id']){ echo "selected";} ?>> <?php echo $source['source_cat_name']; ?>
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
                        <select name="sa_subsource_cat" id="sa_subsource_cat" tabindex="20" class="form-control bs-select" data-live-search="true" data-size="8">
                            <option value="">Select sub category</option>
                              <?php  foreach($subsources as $subsource) {?>  
                              <option value="<?php echo $subsource['source_cat_id'];?>" <?php if(isset($list[0]['sa_subsource_cat']) && $list[0]['sa_subsource_cat'] == $subsource['source_cat_id']){ echo "selected";}?>><?php echo $subsource['source_cat_name']; ?></option>
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
                            <select name="sa_inq_st" id="sa_inq_st" tabindex="20" class="form-control bs-select" data-live-search="true" data-size="8">
                                                            <option value="">Select Status</option>
                                                              <?php  foreach($status as $sts) {?>  
                                                              <option value="<?php echo $sts['qs_id'];?>" <?php if(isset($list[0]['sa_inq_st']) && $list[0]['sa_inq_st'] == $sts['qs_id']){ echo "selected";}?>><?php echo $sts['qs_name']; ?></option>
                                                              <?php } ?> 
                                                            </select>
                       </div>
                    </div>
                </div>
                 <div class="col-md-6">
                    <div class="form-group" id="mcna_namegr">
                        <label class="control-label col-md-3">Priority :</label>
                        <div class="col-md-9">
                             <select name="sa_inq_priority" id="sa_inq_priority" tabindex="22" class="form-control bs-select" data-live-search="true" data-size="8">
                            <option value="0">Select Priority</option>
                              <option value="1" <?php if(isset($list[0]['sa_priority']) && $list[0]['sa_priority'] == 1){ echo "selected";}?>>High</option>
                              <option value="2" <?php if(isset($list[0]['sa_priority']) && $list[0]['sa_priority'] == 2){ echo "selected";}?>>Low</option>
                              <option value="3" <?php if(isset($list[0]['sa_priority']) && $list[0]['sa_priority'] == 3){ echo "selected";}?>>Medium</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                                             <div class="col-md-6">
                                                    <div class="form-group required" id="mcna_namegr">
                                                        <label class="control-label col-md-3">Admin Source</label>
                                                        <div class="col-md-9">
                                                             <?php $uid = encrypt_decrypt('decrypt', $this->session->userdata['miconlogin']['userid']); ?>
                                                            <select name="sa_admin_src" id="sa_admin_src" tabindex="17" class="form-control itmchange bs-select" data-live-search="true" data-size="8" required="required">
                                                                <option value="0">Select</option>
                                                                <?php  foreach($follow_exe as $vendor) {?>  <option value="<?php echo $vendor['au_id'];?>" <?php if(isset($list[0]['sa_admin_src']) && $list[0]['sa_admin_src'] == $vendor['au_id']){ echo "selected";}?>><?php echo $vendor['au_fname']; ?></option><?php } ?> 
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                           </div>
                                                                 
    <!-- <div class="modal-footer footer-button pull-left">
    <button type="submit" class="btn green" tabindex="36">Save</button>
    </div> -->
    <div class="form-actions">
        <div class="row">
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-offset-3 col-md-9">
                        <button type="submit" tabindex="25" class="btn green" onclick="return ValidateDetails()">SUBMIT</button>
                    </div>
                </div>
            </div>
            <div class="col-md-6"> </div>
        </div>
    </div>  
    </div>
</div>
<?php echo form_close(); ?>