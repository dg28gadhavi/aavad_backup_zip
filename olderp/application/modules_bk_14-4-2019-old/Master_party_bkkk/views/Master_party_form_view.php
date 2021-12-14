<link href="<?php echo base_url(); ?>assets/global/plugins/bootstrap-select/css/bootstrap-select.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url(); ?>assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url(); ?>assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url(); ?>assets/global/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url(); ?>assets/global/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url(); ?>assets/global/plugins/clockface/css/clockface.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url(); ?>assets/global/plugins/bootstrap-select/css/bootstrap-select.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url(); ?>assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url(); ?>assets/global/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url(); ?>assets/global/plugins/clockface/css/clockface.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/search/css/jquery-ui.css">
 <!-- BEGIN PAGE LEVEL PLUGINS -->
<link href="<?php echo base_url(); ?>assets/global/plugins/bootstrap-select/css/bootstrap-select.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url(); ?>assets/global/plugins/jquery-multi-select/css/multi-select.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url(); ?>assets/global/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url(); ?>assets/global/plugins/select2/css/select2-bootstrap.min.css" rel="stylesheet" type="text/css" />
<div class="container-fluid">
<div class="page-content">
<!-- BEGIN BREADCRUMBS -->
<div class="breadcrumbs">
    <h1>Customer / Vendor Add</h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>Dashboard">Dashboard</a></li>
        <li class="active"><a href="<?php echo base_url(); ?>Master_party">Customer / Vendor List</a></li>
        <li><a href="<?php echo base_url(); ?>Master_party/add">Customer / Vendor Add</a></li>
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
                        <div class="portlet light bordered box">
                            <div class="portlet-body form">
                                <?php  $atr = array('class' => 'form-horizontal');
                                 echo form_open_multipart($action,$atr); ?>
                            <div class="form-body">
                                  <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group" id="master_party_namegr">
                                            <label class="control-label col-md-3">Party Code</label>
                                            <div class="col-md-9">
                                                <input type="text" tabindex="1" class="form-control" placeholder="Party Code" name="master_party_code" maxlength="70" id="master_party_code" value="<?php echo !$this->input->get('id') && isset($party_code) ? $party_code : ''; ?><?php echo isset($list[0]['master_party_code']) ? $list[0]['master_party_code'] : ""; ?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group" id="master_party_namegr">
                                            <label class="control-label col-md-3">Party Name</label>
                                            <div class="col-md-9">
                                                <input type="text" tabindex="2" class="form-control" placeholder="Party Name" name="master_party_name" maxlength="70" id="master_party_name" value="<?php echo isset($list[0]['master_party_name']) ? $list[0]['master_party_name'] : ""; ?>">
                                                <span class="help-block"> <?php echo form_error('master_party_name'); ?> </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group" id="mcna_namegr">
                                            <label class="control-label col-md-3">Customer Type:</label>
                                            <div class="col-md-8">
                                            <select name="master_party_cust_type" id="master_party_cust_type" tabindex="3" class="bs-select form-control itmchange" data-live-search="true" data-size="8" tabindex="4">
                                                    <option value="">Customer Type</option>
                                                    <?php  foreach($custometyps as $country) {?>  <option value="<?php echo $country['ctype_id'];?>" <?php if(isset($list[0]['master_party_cust_type']) && $list[0]['master_party_cust_type'] == $country['ctype_id']){ echo "selected";}?>><?php echo $country['ctype_name']; ?></option><?php } ?> 
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group" id="master_party_addressgr">
                                            <label class="control-label col-md-3">Address</label>
                                            <div class="col-md-9">
                                                <textarea tabindex="4" class="form-control" placeholder="Address" name="master_party_address" id="master_party_address" rows="5" cols="40"><?php echo isset($list[0]['master_party_address']) ? $list[0]['master_party_address'] : ""; ?></textarea>
                                                <span class="help-block"> <?php echo form_error('master_party_address'); ?> </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group" id="master_party_addressgr">
                                            <label class="control-label col-md-3">Billing Address</label>
                                            <div class="col-md-9">
                                                <textarea tabindex="4" class="form-control" placeholder="Address" name="master_party_billing_add" id="master_party_billing_add" rows="5" cols="40"><?php echo isset($list[0]['master_party_billing_add']) ? $list[0]['master_party_billing_add'] : ""; ?></textarea>
                                                <span class="help-block"> <?php echo form_error('master_party_billing_add'); ?> </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group" id="master_party_addressgr">
                                            <label class="control-label col-md-3">Shipping Address</label>
                                            <div class="col-md-9">
                                                <textarea tabindex="4" class="form-control" placeholder="Address" name="master_party_shipping_add" id="master_party_shipping_add" rows="5" cols="40"><?php echo isset($list[0]['master_party_shipping_add']) ? $list[0]['master_party_shipping_add'] : ""; ?></textarea>
                                                <span class="help-block"> <?php echo form_error('master_party_shipping_add'); ?> </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- <div class="row">
                                    <div class="col-md-12">                                     
                                        <div id="meadd_ajax_main"></div>
                                    </div>
                                </div> -->
                                
                                <div class="row">
                                     <div class="col-md-6">
                                        <div class="form-group" id="master_party_phonegr">
                                            <label class="control-label col-md-3">Country</label>
                                            <div class="col-md-9">
                                               <select name="master_party_country" id="country_change" tabindex="5" class="bs-select form-control country_change" data-live-search="true" data-size="8">
                                                    <option value="">Select Country</option>
                                                    <?php foreach($countries as $country)
                                                    { ?>
                                                        <option value="<?php echo $country['country_id']; ?>" <?php if(isset($list[0]['master_party_country']) && ($list[0]['master_party_country'] == $country['country_id'])){ echo "selected='selected'";} ?>><?php echo $country['country_name']; ?></option>
                                                    <?php }?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group" id="master_party_stategr">
                                            <label class="control-label col-md-3">State</label>
                                            <div class="col-md-8">
                                                <select name="master_party_state" tabindex="6" class="bs-select form-control state_change" data-live-search="true" data-size="8" id="state_change" onchange="get_area(this.value)" >
                                                    <option value="">Select State</option>
                                                    <?php foreach($states as $state)
                                                    { ?>
                                                        <option value="<?php echo $state['state_id']; ?>" <?php if(isset($list[0]['master_party_state']) && ($list[0]['master_party_state'] == $state['state_id'])){ echo "selected='selected'";} ?>><?php echo $state['state_name']; ?></option>
                                                    <?php }?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>
                                <div class="row">
                                   <div class="col-md-6">
                                        <div class="form-group" id="master_party_citygr">
                                            <label class="control-label col-md-3">City</label>
                                            <div class="col-md-9">
                                            <select name="master_party_city" tabindex="7" class="bs-select form-control" data-live-search="true" data-size="8" id="city_change" onchange="get_area(this.value)" >
                                                    <option value="">Select State</option>
                                                    <?php foreach($citys as $city)
                                                    { ?>
                                                        <option value="<?php echo $city['city_id']; ?>" <?php if(isset($list[0]['master_party_city']) && ($list[0]['master_party_city'] == $city['city_id'])){ echo "selected='selected'";} ?>><?php echo $city['city_name']; ?></option>
                                                    <?php }?>
                                                </select>
                                               
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group" id="master_party_phonegr">
                                            <label class="control-label col-md-3">Office Phone Number</label>
                                            <div class="col-md-8">
                                                <input type="text" tabindex="8" class="form-control" name="master_party_phone" maxlength="25" id="master_party_phone" value="<?php echo isset($list[0]['master_party_phone']) ? $list[0]['master_party_phone'] : ""; ?>"/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                     <div class="col-md-6">
                                        <div class="form-group" id="mcna_namegr">
                                            <label class="control-label col-md-3">Handled By</label>
                                            <div class="col-md-9">
                                                <select name="master_handled_by" id="master_handled_by" tabindex="9" class="bs-select form-control" data-live-search="true" data-size="8">
                                                    <option value="">Select Handled By</option>
                                                    <?php  foreach($admins as $admin) {?>  <option value="<?php echo $admin['au_id'];?>" <?php if(isset($list[0]['master_party_handled_by']) && $list[0]['master_party_handled_by'] == $admin['au_id']){ echo "selected";}?>><?php echo $admin['au_fname']; ?></option><?php } ?> 
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <h3 class="form-section">Contact Person Information</h3>
                                <!-- <div class="row">
                                    
                                        <div id="meadd_contact_info"></div>
                                    
                                </div> -->
                                <div class="row">
                                   <div class="col-md-6">
                                        <div class="form-group" id="master_party_citygr">
                                            <label class="control-label col-md-3">Contact Person</label>
                                            <div class="col-md-9">
                                           <input type="text" tabindex="10" class="form-control" name="conparty_name" maxlength="25" id="conparty_name" value="<?php echo isset($list[0]['conparty_name']) ? $list[0]['conparty_name'] : ""; ?>"/>                                               
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group" id="master_party_phonegr">
                                            <label class="control-label col-md-3">Mobile No</label>
                                            <div class="col-md-8">
                                                <input type="text" tabindex="11" class="form-control" name="conparty_mobile" maxlength="25" id="conparty_mobile" value="<?php echo isset($list[0]['conparty_mobile']) ? $list[0]['conparty_mobile'] : ""; ?>"/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                   <div class="col-md-6">
                                        <div class="form-group" id="master_party_citygr">
                                            <label class="control-label col-md-3">Email Id</label>
                                            <div class="col-md-9">
                                           <input type="text" tabindex="12" class="form-control" name="conparty_emailid" maxlength="70" id="conparty_emailid" value="<?php echo isset($list[0]['conparty_emailid']) ? $list[0]['conparty_emailid'] : ""; ?>"/>                                               
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group" id="master_party_phonegr">
                                            <label class="control-label col-md-3">Dapartment</label>
                                            <div class="col-md-8">
                                                <input type="text" tabindex="13" class="form-control" name="conparty_depart" maxlength="25" id="conparty_depart" value="<?php echo isset($list[0]['conparty_depart']) ? $list[0]['conparty_depart'] : ""; ?>"/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                   <div class="col-md-6">
                                        <div class="form-group" id="master_party_citygr">
                                            <label class="control-label col-md-3">Contact Person1</label>
                                            <div class="col-md-9">
                                           <input type="text" tabindex="10" class="form-control" name="conparty_name" maxlength="25" id="conparty_name" value="<?php echo isset($list[0]['master_party_contact_person']) ? $list[0]['master_party_contact_person'] : ""; ?>"/>                                               
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group" id="master_party_phonegr">
                                            <label class="control-label col-md-3">Mobile No1</label>
                                            <div class="col-md-8">
                                                <input type="text" tabindex="11" class="form-control" name="conparty_mobile" maxlength="25" id="conparty_mobile" value="<?php echo isset($list[0]['master_party_contact_no']) ? $list[0]['master_party_contact_no'] : ""; ?>"/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                   <div class="col-md-6">
                                        <div class="form-group" id="master_party_citygr">
                                            <label class="control-label col-md-3">Email Id1</label>
                                            <div class="col-md-9">
                                           <input type="text" tabindex="12" class="form-control" name="conparty_emailid" maxlength="70" id="conparty_emailid" value="<?php echo isset($list[0]['master_party_email_address']) ? $list[0]['master_party_email_address'] : ""; ?>"/>                                               
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group" id="master_party_phonegr">
                                            <label class="control-label col-md-3">Dapartment1</label>
                                            <div class="col-md-8">
                                                <input type="text" tabindex="13" class="form-control" name="conparty_depart" maxlength="25" id="conparty_depart" value="<?php echo isset($list[0]['conparty_depart']) ? $list[0]['conparty_depart'] : ""; ?>"/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <h3 class="form-section">TAX Nos. Details</h3>
                                <div class="row" style="display:none">
                                    <div class="col-md-6">
                                        <div class="form-group" id="master_party_local_tingr">
                                            <label class="control-label col-md-3">VAT Tin Nos.</label>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control"   name="master_party_local_tin" maxlength="50" id="master_party_local_tin" value="<?php echo isset($list[0]['master_party_local_tin']) ? $list[0]['master_party_local_tin'] : ""; ?>"/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group" id="master_party_state_tingr">
                                            <label class="control-label col-md-3">CST Tin Nos.</label>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control"   name="master_party_state_tin" maxlength="50" id="master_party_state_tin" value="<?php echo isset($list[0]['master_party_state_tin']) ? $list[0]['master_party_state_tin'] : ""; ?>"/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                 <div class="col-md-6">
                                        <div class="form-group" id="master_party_gst_tingr">
                                            <label class="control-label col-md-3">GST.</label>
                                            <div class="col-md-9">
                                                <input type="text" tabindex="14" class="form-control" name="master_party_gst" maxlength="50" id="master_party_gst" value="<?php echo isset($list[0]['master_party_gst']) ? $list[0]['master_party_gst'] : ""; ?>"/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                  <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group" id="master_party_taxgr">
                                            <label class="control-label col-md-3">Tax Category</label>
                                            <div class="col-md-9">
                                                <select name="master_party_tax" id="master_party_tax" tabindex="15" class="form-control"  required="required">
                                                    <option value="">Select Tax Category</option>
                                                    <?php foreach($tax_cats as $taxcat)
                                                    { ?>
                                                        <option value="<?php echo $taxcat['tax_cat_id']; ?>" <?php if(isset($list[0]['master_party_tax']) && ($list[0]['master_party_tax'] == $taxcat['tax_cat_id'])){ echo "selected='selected'";} ?>>
                                                            <?php
                                                                echo $taxcat['tax_cat_name']; 
                                                            ?></option>
                                                    <?php }?>                                                        
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <h3 class="form-section">Category (Customer / Vendor)</h3>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group" id="master_party_categorygr">
                                            <label class="control-label col-md-3">Category</label>
                                            <div class="col-md-9">
                                                <select name="master_party_category" tabindex="16" class="form-control" id="master_party_category" >
                                                    <option value="">Select Category</option>
                                                     <option value="1"<?php if(isset($list[0]['master_party_category']) && ($list[0]['master_party_category'] == 1)){ echo "selected='selected'";} ?>>Customer</option>
                                                      <option value="2" <?php if(isset($list[0]['master_party_category']) && ($list[0]['master_party_category'] == 2)){ echo "selected='selected'";}?>>Vendor</option>
                                                      <option value="3" <?php if(isset($list[0]['master_party_category']) && ($list[0]['master_party_category'] == 3)){ echo "selected='selected'";}?>>Both</option>                                                  
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                      <div class="col-md-6">
                                        <div class="form-group" id="master_party_categorygr">
                                            <label class="control-label col-md-3">Distributor:</label>
                                            <div class="col-md-9">
                                                  <input type="checkbox" tabindex="17" name="master_party_distributor" maxlength="50" id="master_party_distributor" value="1" <?php if(isset($list[0]['master_party_distributor']) && ($list[0]['master_party_distributor'] == 1)){ echo "selected='selected'";}?>/>
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
                                                <button type="submit" tabindex="18" class="btn green" onclick="return ValidateDetails()"><?php echo $this->input->get('id')?'UPDATE':'SUBMIT'; ?></button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6"> </div>
                                </div>
                            </div>
                        <?php echo form_close(); ?>
                        </div>
                        </div>
                        </div>
                    </div>
                </div>
                <!-- END CONTENT BODY -->
            </div>
            </div>
            </div>
            </div>
            <!-- END CONTENT -->
        <!-- END CONTAINER -->
<!--[if lt IE 9]>
<script src="<?php echo base_url(); ?>assets/global/plugins/respond.min.js"></script>
<script src="<?php echo base_url(); ?>assets/global/plugins/excanvas.min.js"></script> 
<![endif]-->
<!-- BEGIN CORE PLUGINS -->
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
<script src="<?php echo base_url(); ?>assets/global/plugins/bootstrap-select/js/bootstrap-select.min.js" type="text/javascript"></script>
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
<script src="<?php echo base_url(); ?>assets/layouts/layout/scripts/layout.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/layouts/layout/scripts/demo.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/layouts/global/scripts/quick-sidebar.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/pages/scripts/components-multi-select.min.js" type="text/javascript"></script>
<!-- END PAGE LEVEL PLUGINS -->
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN THEME GLOBAL SCRIPTS -->
<script src="<?php echo base_url(); ?>assets/global/scripts/app.min.js" type="text/javascript"></script>
<!-- END THEME GLOBAL SCRIPTS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script type="text/javascript"> var suffix = '<?php echo json_encode(array("me")); ?>'; var paction ='<?php echo $this->uri->segment(2) ? $this->uri->segment(2) : ''; ?>'; 
 <?php  if($this->uri->segment(3) && $this->uri->segment(3) != ''){ ?>
  var encid = "<?php echo $this->uri->segment(3); ?>"; 
  <?php }else{ ?>
    var encid = 0; 
    <?php } ?>
 var enc ='<?php echo $this->uri->segment(2) ? $this->uri->segment(2) : ''; ?>' </script>
<script src="<?php echo base_url(); ?>assets/custom/js/inquiry_form_vendor.js" type="text/javascript"></script>
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

function ValidateDetails()
{
    var fields;
    fields = "";
    document.getElementById('country_name').className = 'form-control';
    $('#country_name').parent().parent().removeClass('has-error');
    
    if (DoTrim(document.getElementById('country_name').value).length == 0) {
        if(fields != 1){
        document.getElementById("country_name").focus();
        }
        fields = '1';
        document.getElementById('country_name').className = 'form-control error';
        if($('#country_name').parent().parent().attr('class') == 'form-group')
        {
            $('#country_name').parent().parent().addClass('has-error');
        }
        //return false;
    }
    
    
    if (fields != "") {
        fields = "Please fill in the following details:\n--------------------------------\n" + fields;
        
        return false;
    }
    else {
        return true;
    }    
}
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
        <!-- END PAGE LEVEL SCRIPTS -->
        <?php //theme layout scripts ?>