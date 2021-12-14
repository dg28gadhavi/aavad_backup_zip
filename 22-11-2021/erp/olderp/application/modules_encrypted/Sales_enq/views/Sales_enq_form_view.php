<?php //echo '<pre>'; print_r($vendors); die;?>
<link href="<?php echo base_url(); ?>assets/global/plugins/bootstrap-select/css/bootstrap-select.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url(); ?>assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url(); ?>assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url(); ?>assets/global/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url(); ?>assets/global/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url(); ?>assets/global/plugins/clockface/css/clockface.css" rel="stylesheet" type="text/css" />
 <!-- BEGIN PAGE LEVEL PLUGINS -->
<link href="<?php echo base_url(); ?>assets/global/plugins/jquery-multi-select/css/multi-select.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url(); ?>assets/global/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url(); ?>assets/global/plugins/select2/css/select2-bootstrap.min.css" rel="stylesheet" type="text/css" />
<!-- BEGIN THEME GLOBAL STYLES -->
<link href="<?php echo base_url(); ?>assets/global/css/components.min.css" rel="stylesheet" id="style_components" type="text/css" />
<link href="<?php echo base_url(); ?>assets/global/css/plugins.min.css" rel="stylesheet" type="text/css" />
<!-- END THEME GLOBAL STYLES -->
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/search/css/jquery-ui.css">
<div class="container-fluid">
<div class="page-content">
<!-- BEGIN BREADCRUMBS -->
    <div class="breadcrumbs">
        <h1>Sales Inquiry Add</h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>Dashboard">Dashboard</a></li>
            <li class="active"><a href="<?php echo base_url(); ?>Sales_enq/sales_inq_report">Sales Inquiry Report</a></li>
            <li><a href="<?php echo base_url(); ?>Sales_enq/add">Sales Inquiry Add</a></li>
        </ol>
        <!-- Sidebar Toggle Button -->
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".page-sidebar">
            <span class="sr-only">Toggle navigation</span>
            <span class="toggle-icon">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </span>
        </button>
        <!-- Sidebar Toggle Button -->
        <?php if($this->input->post()){ ?>
        <div class="col-md-12 col-xs-6"><div class="alert alert-danger">
        <strong><?php echo $this->session->flashdata('error'); echo validation_errors();?></strong> 
        </div></div>
        </div>
        <?php } ?>
    </div>

<!-- END BREADCRUMBS -->
<!-- BEGIN CONTENT -->
            <div class="page-content-container">
                <!-- BEGIN CONTENT BODY -->
                <div class="page-content-row">
                    <!-- BEGIN PAGE HEADER-->
                    <div class="page-content-col">
                    <div class="row">
                        <div class="col-md-12">
                        <div class="portlet box">
                            <div class="portlet-body form">
                                <?php  $atr = array('class' => 'form-horizontal','autocomplete' => 'off');
                                 echo form_open_multipart($action,$atr); ?>
                            <div class="form-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group" id="mcna_namegr">
                                            <label class="control-label col-md-3">Inquiry No</label>
                                            <div class="col-md-9">
                                               <input type="text" tabindex="1" class="form-control"  name="sq_no" maxlength="200" id="sq_no " value="<?php echo !$this->uri->segment(3) && isset($sq_code) ? $sq_code : ''; ?><?php echo isset($list[0]['sq_no']) ? $list[0]['sq_no'] : ""; ?>" autofocus>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label col-md-3">Inquiry Date</label>
                                            <div class="col-md-9">
                                                 <input type="text" tabindex="2" class="form-control form-control-inline input-medium date-picker" placeholder="Inquiry Date" name="sq_enq_date" maxlength="200" id="sq_enq_date" value="<?php echo isset($list[0]['sq_enq_date']) ? date("d-m-Y", strtotime($list[0]['sq_enq_date'])) : date('d-m-Y'); ?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group" id="mcna_namegr">
                                            <label class="control-label col-md-3">Reference No</label>
                                            <div class="col-md-9">
                                               <input type="text" tabindex="1" class="form-control"  name="sq_refno" maxlength="200" id="sq_refno " value="<?php echo isset($list[0]['sq_refno']) ? $list[0]['sq_refno'] : ""; ?>" autofocus>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label col-md-3">Reference Date</label>
                                            <div class="col-md-9">
                                                 <input type="text" tabindex="2" class="form-control form-control-inline input-medium date-picker" placeholder="Reference Date" name="sq_ref_date" maxlength="200" id="sq_ref_date" value="<?php echo isset($list[0]['sq_ref_date']) ? date("d-m-Y", strtotime($list[0]['sq_ref_date'])) : date('d-m-Y'); ?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group required">
                                            <label class="control-label col-md-3">Customer Name</label>
                                            <div class="col-md-7">
                                               <input type="text" tabindex="3" class="form-control vendor" placeholder="Customer Name" name="vendor" maxlength="100" id="vendor" value="<?php echo isset($list[0]['vendor']) ? $list[0]['vendor'] : ""; ?>" required="required">

                                               <input type="hidden" name="vendor_id" id="vendor_id" value="<?php echo isset($list[0]['vendor_id']) ? $list[0]['vendor_id'] : ""; ?>">
                                            </div>

                                            <div class="col-md-2">
                                                <a class="btn red" href="<?php echo base_url(); ?>Sales_enq/add">RESET</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group required" id="mcna_namegr">
                                            <label class="control-label col-md-3">Customer Type</label>
                                            <div class="col-md-9">
                                                <select name="sq_cust_type" id="sq_cust_type" class="bs-select form-control itmchange" data-live-search="true" data-size="8" tabindex="4" required="required">
                                                    <option value="">Customer Type</option>
                                                    <?php  foreach($custometyps as $country) {?>  <option value="<?php echo $country['ctype_id'];?>" <?php if(isset($list[0]['sq_cust_type']) && $list[0]['sq_cust_type'] == $country['ctype_id']){ echo "selected";}?>><?php echo $country['ctype_name']; ?></option><?php } ?> 
                                                </select>
                                            </div>
                                        </div>
                                    </div>                                    
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group required" id="mcna_namegr">
                                            <label class="control-label col-md-3">Customer Address</label>
                                            <div class="col-md-9">
                                            <textarea class="form-control" tabindex="5" name="sq_address" placeholder="Customer Address" id="sq_address" required="required" rows="3"><?php echo isset($list[0]['sq_address']) ? $list[0]['sq_address'] : ""; ?></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group" id="mcna_namegr">
                                            <label class="control-label col-md-3">Brand</label>
                                            <div class="col-md-9">
                                                <select multiple="multiple" class="multi-select" id="my_multi_select1" name="sq_brand[]" tabindex="9">
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

                                <div class="row" style="display: none;">
                                    <div class="col-md-6">
                                        <div class="form-group" id="mcna_namegr">
                                            <label class="control-label col-md-3">Country</label>
                                            <div class="col-md-9">
                                                <select name="sq_country" id="country_change" class="form-control country_change bs-select" data-live-search="true" data-size="8" tabindex="6">
                                                    <option value="">Select Country</option>
                                                    <?php  foreach($countries as $country) {?>  <option value="<?php echo $country['country_id'];?>" <?php if(isset($list[0]['sq_country']) && $list[0]['sq_country'] == $country['country_id']){ echo "selected";}?>><?php echo $country['country_name']; ?></option><?php } ?> 
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                     <div class="col-md-6">
                                        <div class="form-group" id="mcna_namegr">
                                            <label class="control-label col-md-3">State</label>
                                            <div class="col-md-9">
                                                <select name="sq_state" id="state_change" class="bs-select form-control state_change" data-live-search="true" data-size="8" tabindex="7">
                                                    <option value="">Select State</option>
                                                    <?php  foreach($states as $state) {?>  <option value="<?php echo $state['state_id'];?>" <?php if(isset($list[0]['sq_state']) && $list[0]['sq_state'] == $state['state_id']){ echo "selected";}?>><?php echo $state['state_name']; ?></option><?php } ?> 
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6"  style="display: none;">
                                        <div class="form-group" id="master_party_taxgr">
                                            <label class="control-label col-md-3">City</label>
                                            <div class="col-md-9">
                                               <select name="sq_city" id="city_change" class="bs-select form-control city_change" data-live-search="true" data-size="8" tabindex="8">
                                                <option value="" >Select City</option>
                                                    <?php  foreach($cities as $citie) {?>  <option value="<?php echo $citie['city_id'];?>" <?php if(isset($list[0]['sq_city']) && $list[0]['sq_city'] == $citie['city_id']){ echo "selected";}?>><?php echo $citie['city_name']; ?></option><?php } ?> 
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                      
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group required">
                                            <label class="control-label col-md-3">Contact Person</label>
                                            <div class="col-md-9">
                                               <input type="text" tabindex="10" class="form-control" placeholder="Contact Person" name="sq_con_person" maxlength="100" id="sq_con_person" required="required" value="<?php echo isset($list[0]['sq_con_person']) ? $list[0]['sq_con_person'] : ""; ?>">
                                            </div>
                                        </div>
                                    </div>
                                      <div class="col-md-6">
                                        <div class="form-group required" id="mcna_namegr">
                                            <label class="control-label col-md-3">Mobile No</label>
                                            <div class="col-md-9">
                                                <input type="text" tabindex="11" class="form-control" placeholder="Mobile No" name="sq_mobile" maxlength="200" id="sq_mobile" required="required" value="<?php echo isset($list[0]['sq_mobile']) ? $list[0]['sq_mobile'] : ""; ?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>                                    
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group required">
                                            <label class="control-label col-md-3">Email Id</label>
                                            <div class="col-md-9">
                                               <input type="text" tabindex="12" class="form-control" placeholder="Email Id" name="sq_email" maxlength="100" id="sq_email" required="required" value="<?php echo isset($list[0]['sq_email']) ? $list[0]['sq_email'] : ""; ?>" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label col-md-3">Phone No</label>
                                            <div class="col-md-9">
                                                <input type="text" tabindex="13" class="form-control" placeholder="Phone No" name="sq_phone" maxlength="100" id="sq_phone" value="<?php echo isset($list[0]['sq_phone']) ? $list[0]['sq_phone'] : ""; ?>" >
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group" id="mcna_namegr">
                                            <label class="control-label col-md-3">Website Address</label>
                                            <div class="col-md-9">
                                                <input type="text" tabindex="14" class="form-control" placeholder="Website Address" name="sq_website" maxlength="200" id="sq_website" value="<?php echo isset($list[0][' ']) ? $list[0]['sq_website'] : ""; ?>">
                                            </div>
                                        </div>
                                    </div>
                                     <div class="col-md-6">
                                        <div class="form-group" id="mcna_namegr">
                                            <label class="control-label col-md-3">GST No.</label>
                                            <div class="col-md-9">
                                                <input type="text" tabindex="15" class="form-control" placeholder="GST No." name="sq_gstno" maxlength="200" id="sq_gstno" value="<?php echo isset($list[0]['sq_gstno']) ? $list[0]['sq_gstno'] : ""; ?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row" style="display:none">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label col-md-3">Reminder Date:</label>
                                            <div class="col-md-9">
                                                 <input type="text" tabindex="16" class="form-control form-control-inline input-medium date-picker" placeholder="Reminder Date" name="sq_rem_date" maxlength="200" id="sq_rem_date" value="<?php echo isset($list[0]['sq_rem_date']) ? date("d-m-Y", strtotime($list[0]['sq_rem_date'])) : ""; ?>">
                                                
                                            </div>
                                        </div>
                                    </div>
                                     <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label col-md-3">Remind before (In days):</label>
                                            <div class="col-md-9">
                                                  <input type="text"  tabindex="17" class="form-control" placeholder="Reminder Before Days" name="sq_rem_be_date" maxlength="100" id="sq_rem_be_date" value="<?php echo isset($list[0]['sq_rem_be_date']) ? $list[0]['sq_rem_be_date'] : ""; ?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>    
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group required" id="mcna_namegr">
                                            <label class="control-label col-md-3">Inquiry By :</label>
                                            <div class="col-md-9">
                                                <?php $uid = encrypt_decrypt('decrypt', $this->session->userdata['miconlogin']['userid']); ?>
                                                <select name="sq_end_st" tabindex="18" id="sq_end_st" class="bs-select form-control itmchange" data-live-search="true" data-size="8" required="required">
                                                    <option value="0">Select Inquiry By</option>
                                                    <?php  foreach($admins as $vendor) {?>  <option value="<?php echo $vendor['au_id'];?>" <?php if(isset($list[0]['sq_end_st']) && $list[0]['sq_end_st'] == $vendor['au_id']){ echo "selected";}else if($uid && $uid == $vendor['au_id']) { echo "selected";}?>><?php echo $vendor['au_fname']; ?></option><?php } ?> 
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                     <div class="col-md-6" style="display:none;">
                                        <div class="form-group" id="mcna_namegr">
                                            <label class="control-label col-md-3">Mode of Inquiry :</label>
                                            <div class="col-md-9">
                                                <select name="sq_mode_inq" id="sq_mode_inq" tabindex="19" class="bs-select form-control itmchange" data-live-search="true" data-size="8">
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
                                                <select name="sq_source_cat" id="sq_source_cat" tabindex="20" class="form-control bs-select" data-live-search="true" data-size="8"  onchange="sub_cat(this)">
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
                                            <select name="sq_subsource_cat" id="sq_subsource_cat" tabindex="21" class="form-control bs-select" data-live-search="true" data-size="8">
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
                                        <div class="form-group required" id="mcna_namegr">
                                            <label class="control-label col-md-3">Status :</label>
                                            <div class="col-md-9">
                                                 <select name="sq_inq_sts" id="sq_inq_sts" tabindex="22" class="form-control bs-select" required="required">
                                                <option value="0">Select Status</option>
                                                  <option value="1" <?php if(isset($list[0]['sq_inq_sts']) && $list[0]['sq_inq_sts'] == 1){ echo "selected";}?>>Active</option>
                                                  <option value="2" <?php if(isset($list[0]['sq_inq_sts']) && $list[0]['sq_inq_sts'] == 2){ echo "selected";}?>>Pending</option>
                                                  <option value="3" <?php if(isset($list[0]['sq_inq_sts']) && $list[0]['sq_inq_sts'] == 3){ echo "selected";}?>>Completed</option>
                                                  <option value="4" <?php if(isset($list[0]['sq_inq_sts']) && $list[0]['sq_inq_sts'] == 4){ echo "selected";}?>>Quote</option>
                                                  <option value="5" <?php if(isset($list[0]['sq_inq_sts']) && $list[0]['sq_inq_sts'] == 5){ echo "selected";}?>>Drop</option>
                                                </select>
                                           </div>
                                        </div>
                                    </div>
                                     <div class="col-md-6">
                                        <div class="form-group required" id="mcna_namegr">
                                            <label class="control-label col-md-3">Priority :</label>
                                            <div class="col-md-9">
                                                <select name="sq_inq_priority" id="sq_inq_priority" tabindex="23" class="form-control bs-select" required="required">
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
                                                <input type="text" class="form-control" tabindex="24" placeholder="Referred By" name="sq_ref_by" maxlength="200" id="sq_ref_by" value="<?php echo isset($list[0]['sq_ref_by']) ? $list[0]['sq_ref_by'] : ""; ?>">
                                            </div>
                                        </div>
                                    </div>
                                     <div class="col-md-6">
                                        <div class="form-group required" id="mcna_namegr">
                                            <label class="control-label col-md-3">Admin Source :</label>
                                            <div class="col-md-9">
                                                <?php $uid = encrypt_decrypt('decrypt', $this->session->userdata['miconlogin']['userid']); ?>
                                                <select name="sq_admin_src" tabindex="26" id="sq_admin_src" class="bs-select form-control itmchange" data-live-search="true" data-size="8" required="required">
                                                    <option value="0">Select</option>
                                                    <?php  foreach($admins as $vendor) {?>  <option value="<?php echo $vendor['au_id'];?>" <?php if(isset($list[0]['sq_admin_src']) && $list[0]['sq_admin_src'] == $vendor['au_id']){ echo "selected";}else if($uid && $uid == $vendor['au_id']) { echo "selected";}?>><?php echo $vendor['au_fname']; ?></option><?php } ?> 
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6" style="display: none;">
                                        <div class="form-group" id="mcna_namegr">
                                            <label class="control-label col-md-3">Department Select:</label>
                                            <div class="col-md-9">
                                                <select name="sq_department" id="sq_department" tabindex="25" class="form-control bs-select">
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
                                        <div class="form-group required" id="mcna_namegr">
                                            <label class="control-label col-md-3">Alloted to :</label>
                                            <div class="col-md-9">
                                                <?php $uid = encrypt_decrypt('decrypt', $this->session->userdata['miconlogin']['userid']); ?>
                                                <select name="sq_allotedto" tabindex="26" id="sq_allotedto" class="bs-select form-control itmchange" data-live-search="true" data-size="8" required="required">
                                                    <option value="0">Select</option>
                                                    <?php  foreach($admins as $vendor) {?>  <option value="<?php echo $vendor['au_id'];?>" <?php if(isset($list[0]['sq_allotedto']) && $list[0]['sq_allotedto'] == $vendor['au_id']){ echo "selected";}else if($uid && $uid == $vendor['au_id']) { echo "selected";}?>><?php echo $vendor['au_fname']; ?></option><?php } ?> 
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label col-md-3">Product Details</label>
                                            <div class="col-md-9">
                                             <textarea class="form-control" tabindex="27" placeholder="Product Details" name="sq_prodetails" id="sq_prodetails" rows="3"><?php echo isset($list[0]['sq_prodetails']) ? $list[0]['sq_prodetails'] : ""; ?></textarea>   
                                            </div>
                                        </div>
                                    </div>
                                </div>                       
                                <div class="form-actions">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-md-offset-3 col-md-9">
                                                <button type="submit" tabindex="28" class="btn green" ><?php echo $this->input->get('id')?'UPDATE':'Start'; ?></button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6"> </div>
                                </div>
                                </div>
                        <?php echo form_close(); ?>
            <!-- /.modal -->
                <?php //echo $this->load->view('admin/master/ajaxview/party_ajax_view'); ?>
            <!-- /.modal -->
                        </div>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<script src="<?php echo base_url(); ?>js/icheck/icheck.min.js" type="text/javascript"></script>
<!-- BEGIN CORE PLUGINS -->
<script src="<?php echo base_url(); ?>assets/global/plugins/jquery.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/global/plugins/js.cookie.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/global/plugins/uniform/jquery.uniform.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
<!-- END CORE PLUGINS -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script src="<?php echo base_url(); ?>assets/global/scripts/datatable.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/global/plugins/datatables/datatables.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/global/plugins/bootstrap-select/js/bootstrap-select.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/global/plugins/jquery-multi-select/js/jquery.multi-select.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/global/plugins/select2/js/select2.full.min.js" type="text/javascript"></script>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script src="<?php echo base_url(); ?>assets/global/plugins/jquery-ui/jquery-ui.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/global/plugins/moment.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/global/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/global/plugins/clockface/js/clockface.js" type="text/javascript"></script>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN THEME GLOBAL SCRIPTS -->
<script src="<?php echo base_url(); ?>assets/global/scripts/app.min.js" type="text/javascript"></script>
<!-- END THEME GLOBAL SCRIPTS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="<?php echo base_url(); ?>assets/pages/scripts/components-bootstrap-select.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/pages/scripts/ui-modals.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/pages/scripts/components-date-time-pickers.min.js" type="text/javascript"></script>
 <!-- BEGIN THEME LAYOUT SCRIPTS -->
<script src="<?php echo base_url(); ?>assets/layouts/layout/scripts/demo.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/layouts/global/scripts/quick-sidebar.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/pages/scripts/components-multi-select.min.js" type="text/javascript"></script>
<!-- END PAGE LEVEL SCRIPTS -->
<script src="<?php echo base_url(); ?>assets/global/plugins/bootstrap-tagsinput/bootstrap-tagsinput.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/global/plugins/typeahead/handlebars.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/global/plugins/typeahead/typeahead.bundle.min.js" type="text/javascript"></script>
<!-- START add more SCRIPTS -->

<!-- END add more SCRIPTS -->
<script type="text/javascript"> var base_url = '<?php echo base_url(); ?>';</script>
<script type="text/javascript">
// American Numbering System
var th = ['', 'Thousand', 'Million', 'Billion', 'Trillion'];

var dg = ['Zero', 'One', 'Two', 'Three', 'Four', 'Five', 'Six', 'Seven', 'Eight', 'Nine'];

var tn = ['Ten', 'Eleven', 'Twelve', 'Thirteen', 'Fourteen', 'Fifteen', 'Sixteen', 'Seventeen', 'Eighteen', 'Nineteen'];

var tw = ['Twenty', 'Thirty', 'Forty', 'Fifty', 'Sixty', 'Seventy', 'Eighty', 'Ninety'];

function toWords(s) {
    s = s.toString();
    s = s.replace(/[\, ]/g, '');
    if (s != parseFloat(s)) return 'not a number';
    var x = s.indexOf('.');
    if (x == -1) x = s.length;
    if (x > 15) return 'too big';
    var n = s.split('');
    var str = '';
    var sk = 0;
    for (var i = 0; i < x; i++) {
        if ((x - i) % 3 == 2) {
            if (n[i] == '1') {
                str += tn[Number(n[i + 1])] + ' ';
                i++;
                sk = 1;
            } else if (n[i] != 0) {
                str += tw[n[i] - 2] + ' ';
                sk = 1;
            }
        } else if (n[i] != 0) {
            str += dg[n[i]] + ' ';
            if ((x - i) % 3 == 0) str += 'Hundred ';
            sk = 1;
        }
        if ((x - i) % 3 == 1) {
            if (sk) str += th[(x - i - 1) / 3] + ' ';
            sk = 0;
        }
    }
    if (x != s.length) {
        var y = s.length;
        str += 'Point ';
        for (var i = x + 1; i < y; i++) str += dg[n[i]] + ' ';
    }
    return str.replace(/\s+/g, ' ');

}
    </script>
        <script type="text/javascript">
    function fsl(val)
    {
        if(val==1)
        {
            document.getElementById('stock_limit').style.display='block';
            document.getElementById('master_item_stock_limit').value="";

        }
        if(val==0)
        {
            document.getElementById('stock_limit').style.display="none";
        }
    }
</script>

<script type="text/javascript">

function DoTrim(strComp) {
            ltrim = /^\s+/
            rtrim = /\s+$/
            strComp = strComp.replace(ltrim, '');
            strComp = strComp.replace(rtrim, '');
            return strComp;
}

function isPositiveInteger(n) {
    return n >>> 0 === parseFloat(n);
}


   

$('.date-picker').datepicker({
    format: 'dd-mm-yyyy',
});
</script>


<script type="text/javascript">
    $(document).ready(function () {
        //
        $('#country_change').change(function () {
            //alert($(this).val()+'aaaaaaaaaaaaaaaaaaaaaaa');
                var countryID = $(this).val();
                if(countryID != '' && countryID != undefined)
                {
                $.ajax({
                type:'POST',
                datatype: 'JSON',
                url:'<?php echo base_url(); ?>Sales_enq/get_country_to_state',
                data:'countryID='+countryID,
                success: function(data) {
                    var data = jQuery.parseJSON( data );
                    //console.log(data);
                    var str = '';
                    str += '<option value="">Select State</option>';
                    jQuery.each( data, function( i, val ) {
                      str += '<option value="'+val.state_id+'">'+val.state_name+'</option>';
                    });
                    $('#state_change').empty();
                    $('#city_change').empty();
                    $('#state_change').append(str);
                    $('#state_change').selectpicker('refresh');
                    var str = '';
                    str += '<option value="">Select City</option>';
                    $('#city_change').append(str);
                    $('#city_change').selectpicker('refresh');
                }
                });
            }
        });

        $('#state_change').change(function () {
            //alert($(this).val()+'aaaaaaaaaaaaaaaaaaaaaaa');
                var stateID = $(this).val();
                if(stateID != '' && stateID != undefined)
                {
                $.ajax({
                type:'POST',
                datatype: 'JSON',
                url:'<?php echo base_url(); ?>Sales_enq/get_state_to_city',
                data:'stateID='+stateID,
                success: function(data) {
                    var data = jQuery.parseJSON( data );
                    //console.log(data);
                    var str = '';
                    str += '<option value="">Select City</option>';
                    jQuery.each( data, function( i, val ) {
                      str += '<option value="'+val.city_id+'">'+val.city_name+'</option>';
                    });
                    $('#city_change').empty();
                    $('#city_change').append(str);
                    $('#city_change').selectpicker('refresh');
                }
                });
            }
        });
    });
</script>

<script type="text/javascript">
function sub_cat(i)
{
    var data = { 'id': i.value};
        $.ajax({
        type: "POST",
        url: "<?php echo base_url(); ?>Sales_enq/getsub_category",
        data: data,
        dataType:"json",
          success: function(json)
          {
             var data = '<option value="0">Select Subsource</option>';
             for(var i = 0; i < json.sub_catlists.length; i++)
             {
                data += '<option value="' + json.sub_catlists[i].source_cat_id + '">' + json.sub_catlists[i].source_cat_name + '</option>';
             }
             $('#sq_subsource_cat').empty();
             $('#sq_subsource_cat').append(data);
             $('.bs-select').selectpicker('refresh');
          },
          error: function( error )
         {
             alert( error );
         }
        });
}
</script>

<script type="text/javascript">
    var base_url = "<?php echo base_url(); ?>";
</script>
<script>
  $( function() {
    $("#vendor").autocomplete({
            source: base_url+"Sales_enq/get_customer_information",
            minLength: 1,
            html: true,
            select: function( event, ui )
            {
                var itemname = ui.item.label;
                var itemid = ui.item.value;
                //state_lists
                var str = '';
                str += '<option value="">Select State</option>';
                jQuery.each( ui.item.state_lists, function( i, val ) {
                  str += '<option value="'+val.state_id+'">'+val.state_name+'</option>';
                });
                $('#state_change').empty();
                $('#city_change').empty();
                $('#state_change').append(str);
                $('#state_change').selectpicker('refresh');
                var str = '';
                str += '<option value="">Select City</option>';
                jQuery.each( ui.item.city_lists, function( i, val ) {
                  str += '<option value="'+val.city_id+'">'+val.city_name+'</option>';
                });
                $('#city_change').append(str);
                $('#city_change').selectpicker('refresh');
                $('#itemid').val(ui.item.value);
                $("#sq_cust_type").val(ui.item.ctype);
               $("#country_change").val(ui.item.country);
               $("#state_change").val(ui.item.state);
               $("#city_change").val(ui.item.city);
               $("#sq_con_person").val(ui.item.cperson);
               $("#sq_mobile").val(ui.item.cno);
               $("#sq_email").val(ui.item.email);
               $("#sq_phone").val(ui.item.phone);
               $("#sq_website").val(ui.item.webaddr);
               $('#sq_address').val(ui.item.address);
               $('#vendor_id').val(ui.item.vendor_id);
               $('.bs-select').selectpicker('refresh');
            },
            focus: function (a, b)
            {
                return false
            }
    });

    $("#sq_con_person").autocomplete({

            //var id = $('#vendor_id').val();

            source: function(request, response) {
                $.getJSON(base_url+"Sales_enq/get_contactperson_information", { vendor_id : $('#vendor_id').val() }, 
                          response);
              },

            //source: base_url+"Sales_enq/get_contactperson_information?id="+$('#vendor_id').val(),
            minLength: 1,
            html: true,
            select: function( event, ui )
            {
                var itemname = ui.item.label;
                var itemid = ui.item.value;
                var str = '';
               $("#sq_con_person").val(ui.item.cperson);
               $("#sq_mobile").val(ui.item.contact_mobile);
               $("#sq_email").val(ui.item.contact_email);
               $("#sq_phone").val(ui.item.contact_phone);
               $('#sq_address').val(ui.item.contact_address);
               $('.bs-select').selectpicker('refresh');
            },
            focus: function (a, b)
            {
                return false
            }
    });

    });

  
  function ValidateDetails()
{
    var fields;
    fields = "";
    document.getElementById('vendor_id').className = 'form-control';
    $('#vendor_id').parent().parent().removeClass('has-error');
    
    if (DoTrim(document.getElementById('vendor_id').value).length == 0) 
    {
        if(fields != 1){
        document.getElementById("vendor_id").focus();
        }
        fields = '1';
        document.getElementById('vendor_id').className = 'form-control error';
        if($('#vendor_id').parent().parent().attr('class') == 'form-group')
        {
            $('#vendor_id').parent().parent().addClass('has-error');
        }
        //return false;
    }

    
    if (fields != "") {
        fields = "Please fill in the following details:\n--------------------------------\n" + fields;
        alert("Pl. Select Customers")
        return false;
    }
    else {
        return true;
    }
    
}
  </script>
        <!-- END PAGE LEVEL SCRIPTS -->
        <?php //theme layout scripts ?>
        