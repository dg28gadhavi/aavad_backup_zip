<?php //echo '<pre>'; print_r($states); die;?>
<link href="<?php echo base_url(); ?>assets/global/plugins/bootstrap-select/css/bootstrap-select.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url(); ?>assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url(); ?>assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url(); ?>assets/global/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url(); ?>assets/global/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url(); ?>assets/global/plugins/clockface/css/clockface.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url(); ?>assets/search/css/jquery-ui.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url(); ?>assets/layouts/layout5/css/custom.min.css" rel="stylesheet" type="text/css" />
<!-- BEGIN PAGE LEVEL PLUGINS -->
<link href="<?php echo base_url(); ?>assets/global/plugins/jquery-multi-select/css/multi-select.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url(); ?>assets/global/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url(); ?>assets/global/plugins/select2/css/select2-bootstrap.min.css" rel="stylesheet" type="text/css" />
<style type="text/css">
    .page-content-row .page-content-col {padding-left: 0px;}
</style>
<div class="container-fluid">
    <div class="page-content">
    <!-- BEGIN BREADCRUMBS -->
        <div class="breadcrumbs">
            <h1>Master Party Add</h1>
            <ol class="breadcrumb">
                <li>
                    <a href="<?php echo base_url(); ?>Dashboard">Dashboard</a>
                </li>
                <li class="active">
                    <a href="<?php echo base_url(); ?>Master_party">Master Party Report</a>
                </li>
                <li>
                    <a href="<?php echo base_url(); ?>Master_party/add">Master Party Add</a>
                </li>
            </ol>
            <!-- Sidebar Toggle Button -->
            <!-- Sidebar Toggle Button -->
            <?php if($this->input->post()){ ?>
            <div class="col-md-12 col-xs-6">
                <div class="alert alert-danger">
                    <strong><?php echo $this->session->flashdata('error'); echo validation_errors();?></strong> 
                </div>
            </div>
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
                    <?php  $atr = array('class' => 'form-horizontal');
                     echo form_open_multipart($action,$atr); ?>
                                               
                        <div class="portlet light portlet-fit portlet-datatable bordered">
                            <div class="portlet-title">
                                <div class="row">
                                    <div class="col-md-12"> 
                                        <div class="portlet-title">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group required" id="mcna_namegr">
                                                        <label class="control-label col-md-4">Company name</label>
                                                        <div class="col-md-8">
                                                           <input type="text"  class="form-control master_party_com_name" placeholder="Company name" name="master_party_com_name" tabindex="1" maxlength="200" id="master_party_com_name" required="required" value="<?php echo isset($list[0]['master_party_com_name']) ? $list[0]['master_party_com_name'] : ""; ?>">
                                                        </div>
                                                    </div>
                                                </div>                                                
                                                <div class="col-md-4">
                                                    <div class="form-group required" id="mcna_namegr">
                                                        <label class="control-label col-md-4">Customer Type</label>
                                                        <div class="col-md-8">
                                                            <select name="master_party_cust_type" id="master_party_cust_type" required="required" class="bs-select form-control itmchange" data-live-search="true" data-size="8" tabindex="2">
                                                                <option value="">Customer Type</option>
                                                                <?php  foreach($custometyps as $country) {?>  <option value="<?php echo $country['ctype_id'];?>" <?php if(isset($list[0]['master_party_cust_type']) && $list[0]['master_party_cust_type'] == $country['ctype_id']){ echo "selected";}?>><?php echo $country['ctype_name']; ?></option><?php } ?> 
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group" id="master_party_namegr">
                                                        <label class="control-label col-md-4">Contact Name</label>
                                                        <div class="col-md-8">
                                                            <input type="text" tabindex="3" class="form-control" placeholder="Contact Name" name="master_party_contact" maxlength="70" id="master_party_contact" value="<?php echo isset($list[0]['master_party_contact']) ? $list[0]['master_party_contact'] : ""; ?>">
                                                            <span class="help-block"> <?php echo form_error('master_party_contact'); ?> </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group required">
                                                        <label class="control-label col-md-4">Email Id</label>
                                                        <div class="col-md-8">
                                                           <input type="text" tabindex="4" class="form-control" placeholder="Email Id" name="master_party_email_address" maxlength="100" id="master_party_email_address" required="required" value="<?php echo isset($list[0]['master_party_email_address']) ? $list[0]['master_party_email_address'] : ""; ?>">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group required">
                                                        <label class="control-label col-md-4">Mobile No.</label>
                                                        <div class="col-md-8">
                                                           <input type="text" tabindex="5" class="form-control" placeholder="Mobile No" name="master_party_mobile_no" maxlength="100" id="master_party_mobile_no" required="required" value="<?php echo isset($list[0]['master_party_mobile_no']) ? $list[0]['master_party_mobile_no'] : ""; ?>">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group" id="mcna_namegr">
                                                        <label class="control-label col-md-4">Office No.</label>
                                                        <div class="col-md-8">
                                                            <input type="text" tabindex="6" class="form-control" placeholder="Contact" name="master_party_office_no" maxlength="200" id="master_party_office_no" value="<?php echo isset($list[0]['master_party_office_no']) ? $list[0]['master_party_office_no'] : ""; ?>">
                                                        </div>
                                                    </div>
                                                </div>            
                                            </div>                        
                                            <div class="row">
                                            	<div class="col-md-4">
                                                    <div class="form-group" id="master_party_phonegr">
                                                        <label class="control-label col-md-4">Country</label>
                                                        <div class="col-md-8">
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
                                                 <div class="col-md-4">
                                                    <div class="form-group" id="master_party_stategr">
                                                        <label class="control-label col-md-4">State</label>
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
                                                <div class="col-md-4">
                                                    <div class="form-group" id="master_party_citygr">
                                                        <label class="control-label col-md-4">City</label>
                                                        <div class="col-md-8">
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
                                                                                                        
                                            </div>
                                            <div class="row">
                                            	<div class="col-md-4">
                                                    <div class="form-group" id="mcna_namegr">
                                                        <label class="control-label col-md-4">Location</label>
                                                        <div class="col-md-8">
                                                            <input type="text" tabindex="7" class="form-control" placeholder="Area" name="master_party_location" maxlength="70" id="master_party_location" value="<?php echo isset($list[0]['master_party_location']) ? $list[0]['master_party_location'] : ""; ?>">
                                                        </div>
                                                    </div>
                                                </div>      
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="control-label col-md-4">Fax no</label>
                                                        <div class="col-md-8">
                                                            <input type="text" tabindex="11" class="form-control" placeholder="Fax No" name="master_party_fax_no" maxlength="100" id="master_party_fax_no" value="<?php echo isset($list[0]['master_party_fax_no']) ? $list[0]['master_party_fax_no'] : ""; ?>" >
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group" id="mcna_namegr">
                                                        <label class="control-label col-md-4">Pin Code</label>
                                                        <div class="col-md-8">
                                                            <input type="text" tabindex="12" class="form-control" placeholder="Pin Code" name="master_party_pincode" maxlength="200" id="master_party_pincode" value="<?php echo isset($list[0]['master_party_pincode']) ? $list[0]['master_party_pincode'] : ""; ?>">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group" id="mcna_namegr">
                                                        <label class="control-label col-md-4">Shipping Address</label>
                                                        <div class="col-md-8">
                                                            <textarea class="form-control" tabindex="13" name="master_party_shipping_address" placeholder="Customer Address" id="master_party_shipping_address" rows="3"><?php echo isset($list[0]['master_party_shipping_address']) ? $list[0]['master_party_shipping_address'] : ""; ?></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group" id="mcna_namegr">
                                                        <label class="control-label col-md-4">Office Address</label>
                                                        <div class="col-md-8">
                                                            <textarea class="form-control" tabindex="14" name="master_party_office_address" placeholder="Customer Address" id="master_party_office_address" rows="3"><?php echo isset($list[0]['master_party_office_address']) ? $list[0]['master_party_office_address'] : ""; ?></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group" id="mcna_namegr">
                                                        <label class="control-label col-md-4">Billing Address</label>
                                                        <div class="col-md-8">
                                                            <textarea class="form-control" tabindex="15" name="master_party_billing_address" placeholder="Customer Address" id="master_party_billing_address" rows="3"><?php echo isset($list[0]['master_party_billing_address']) ? $list[0]['master_party_billing_address'] : ""; ?></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group" id="mcna_namegr">
                                                        <label class="control-label col-md-4">Website Address</label>
                                                        <div class="col-md-8">
                                                            <input type="text" tabindex="16" class="form-control" placeholder="Website Address" name="master_party_website" maxlength="200" id="master_party_website" value="<?php echo isset($list[0]['master_party_website']) ? $list[0]['master_party_website'] : ""; ?>">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group" id="master_party_gst_tingr">
                                                        <label class="control-label col-md-4">GST</label>
                                                        <div class="col-md-8">
                                                            <input type="text" tabindex="17" class="form-control" name="master_party_gst" maxlength="50" id="master_party_gst" value="<?php echo isset($list[0]['master_party_gst']) ? $list[0]['master_party_gst'] : ""; ?>"/>
                                                        </div>
                                                    </div>
                                                </div>                            
                                                <div class="col-md-4">
                                                    <div class="form-group required" id="master_party_taxgr">
                                                        <label class="control-label col-md-4">Tax Category</label>
                                                        <div class="col-md-8">
                                                            <select name="master_party_tax" tabindex="18" id="master_party_tax" class="form-control"  required="required">
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
                                                <br>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group" id="mcna_namegr">
                                                        <label class="control-label col-md-4">Select Currency</label>
                                                        <div class="col-md-8">
                                                            <select name="master_party_currency" id="master_party_currency" class="bs-select form-control itmchange" data-live-search="true" data-size="8" tabindex="2">
                                                                <option value="">Select Currency</option>
                                                                <?php  foreach($currencys as $currency) {?>  <option value="<?php echo $currency['currency_id'];?>" <?php if(isset($list[0]['master_party_currency']) && $list[0]['master_party_currency'] == $currency['currency_id']){ echo "selected";}?>><?php echo $currency['currency_name']; ?></option><?php } ?> 
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div> 
                                                <div class="col-md-4">
                                        <div class="form-group" id="master_party_gst_tingr">
                                            <label class="control-label col-md-4">C/O AAVAD INSTRUMENT</label>
                                            <div class="col-md-8">
                                                <input type="text" tabindex="17" class="form-control" name="master_party_co_ai" maxlength="50" id="master_party_co_ai" value="<?php echo isset($list[0]['master_party_co_ai']) ? $list[0]['master_party_co_ai'] : ""; ?>"/>
                                            </div>
                                        </div>
                                    </div>    
                                        <div class="col-md-4">
                                            <div class="form-group" id="mcna_namegr">
                                                <label class="control-label col-md-4">Remark</label>
                                                <div class="col-md-8">
                                                    <textarea class="form-control" tabindex="13" name="master_party_remark" placeholder="Remark" id="master_party_remark" rows="3"><?php echo isset($list[0]['master_party_remark']) ? $list[0]['master_party_remark'] : ""; ?></textarea>
                                                </div>
                                            </div>
                                            </div>  
                                             <div class="col-md-4" style="display: none;">
                                            <div class="form-group" id="mcna_namegr">
                                                <label class="control-label col-md-4">Past Comment</label>
                                                <div class="col-md-8">
                                                    <textarea class="form-control" tabindex="13" name="master_party_pastcomment" placeholder="Past Comment" id="master_party_pastcomment" rows="3"><?php echo isset($list[0]['master_party_pastcomment']) ? $list[0]['master_party_pastcomment'] : ""; ?></textarea>
                                                </div>
                                            </div>
                                            </div>
                                            <div class="col-md-4">
                                            <div class="form-group" id="mcna_namegr">
                                                <label class="control-label col-md-4">DOCUMENTATION DONE </label>
                                                <div class="col-md-8">
                                                    <textarea class="form-control" tabindex="13" name="master_party_docdone" placeholder="DOCUMENTATION DONE " id="master_party_docdone" rows="3"><?php echo isset($list[0]['master_party_docdone']) ? $list[0]['master_party_docdone'] : ""; ?></textarea>
                                                </div>
                                            </div>
                                            </div>  
                                            <div class="col-md-4">
                                            <div class="form-group" id="mcna_namegr">
                                                <label class="control-label col-md-4">Product Usage </label>
                                                <div class="col-md-8">
                                                    <textarea class="form-control" tabindex="13" name="master_party_typeindustries" placeholder="Product Usage" id="master_party_typeindustries" rows="3"><?php echo isset($list[0]['master_party_typeindustries']) ? $list[0]['master_party_typeindustries'] : ""; ?></textarea>
                                                </div>
                                            </div>
                                            </div>  
                                            </div>                                            
                                            <div class="form-actions">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="row">
                                                            <div class="col-md-offset-3 col-md-9">
                                                              <input type="submit" tabindex="19" class="btn btn-success btn-space" name="start" value="Start"/>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>                              
                                    </div>
                                </div>
                            </div>
                <?php echo form_close(); ?>
                </div>
            </div>
        </div>  
    </div>
</div>            
</div>
</div>
</div>
</div>               
<script src="<?php echo base_url(); ?>assets/global/plugins/js/icheck/icheck.min.js" type="text/javascript"></script>

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
<script src="<?php echo base_url(); ?>assets/layouts/layout/scripts/layout.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/layouts/layout/scripts/demo.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/layouts/global/scripts/quick-sidebar.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/pages/scripts/components-multi-select.min.js" type="text/javascript"></script>
<!-- END PAGE LEVEL SCRIPTS -->
<!-- START add more SCRIPTS -->
<script type="text/javascript"> var suffix = '<?php echo json_encode(array("me")); ?>'; var paction ='<?php echo $this->uri->segment(2) ? $this->uri->segment(2) : ''; ?>'; 
         <?php  if($this->uri->segment(3) && $this->uri->segment(3) != ''){ ?>
          var encid = "<?php echo $this->uri->segment(3); ?>"; 
          <?php }else{ ?>
            var encid = 0; 
            <?php } ?>
         var enc ='<?php echo $this->uri->segment(2) ? $this->uri->segment(2) : ''; ?>' </script>
<script src="<?php echo base_url(); ?>assets/custom/js/quotation_ajax_form.js" type="text/javascript"></script>
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

function ValidateDetails()
{
    var fields;
    fields = "";
    var itemArray = [];
    var itemcountr = -1;
    var isdupli = 0;
    $('.itmchange').each(function() { itemcountr++;
        if($('#'+$(this).attr('id')).val() != undefined && $('#'+$(this).attr('id')).val() != '')
        {
            //alert($(this).val());
            if ($.inArray($(this).val(), itemArray) == -1) { //check if id value not exits than add it
            itemArray.push($(this).val());
                //alert('add index');
                if(isdupli != 3)
                {
                    isdupli = 1;    
                }
            }else{
                //alert('duplicate');
                isdupli = 3;
            }
        }
    });
    //alert(isdupli);
    if(isdupli == 3)
    {
        alert('You can not select single item multiple times. single item selected more than one time.');
        $('.rederror').css('background-color','#F00');
        $('.rederror').css('color','#FFF');
        $('#kind_name').focus();
        fields = '1';
    }
    
    var bomArray = [];
    var bomcountr = -1;
    var bisdupli = 0;
    $('.bomchange').each(function() { bomcountr++;
        if($('#'+$(this).attr('id')).val() != undefined && $('#'+$(this).attr('id')).val() != '')
        {
            //alert($(this).val());
            if ($.inArray($(this).val(), bomArray) == -1) { //check if id value not exits than add it
            bomArray.push($(this).val());
                //alert('add index');
                if(bisdupli != 3)
                {
                    bisdupli = 1;   
                }
            }else{
                //alert('duplicate');
                bisdupli = 3;
            }
        }
    });
    //alert(isdupli);
    if(bisdupli == 3)
    {
        alert('You can not select single BOM multiple times. single BOM selected more than one time.');
        $('.rederror').css('background-color','#F00');
        $('.rederror').css('color','#FFF');
        $('#kind_name').focus();
        fields = '1';
    }
 
    if (fields != "") {
        fields = "Please fill in the following details:\n--------------------------------\n" + fields;
        
        return false;
    }
    else {
        return true;
    }    
}

$('.date-picker').datepicker({
    format: 'dd-mm-yyyy',
});
</script>

<script type="text/javascript">
    var base_url = "<?php echo base_url(); ?>";
</script>
<!--<script>
$( function() {
  $("#vendor").autocomplete({
    minLength: 1,
    source: function(req, add){ 
        $.ajax({
            url: '<?php echo base_url(); ?>Sales_enq/get_customer_information',
            dataType: 'json',
            type: 'GET',
            data: req,
            success: function(data){
                if(data.response =='true'){
                   add(data.message);
                }
            }
        });
    }
});
});
</script> -->
<script type="text/javascript">
function sub_cat(i)
{
	var data = { 'id': i.value};
		$.ajax({
		type: "POST",
		url: "<?php echo base_url(); ?>Sale_quotation/getsub_category",
		data: data,
		dataType:"json",
		  success: function(json)
		  {
			 var data = '<option value="0">Select Subsource</option>';
			 for(var i = 0; i < json.sub_catlists.length; i++)
			 {
			 	data += '<option value="' + json.sub_catlists[i].source_cat_id + '">' + json.sub_catlists[i].source_cat_name + '</option>';
			 }
			 $('#sa_subsource_cat').empty();
			 $('#sa_subsource_cat').append(data);
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
$(document).on('blur', '.qty,.rate,.discount,.quot_ftotl', function() {
        var idd = $(this).attr('id');
        //alert(idd);

        idd = idd.replace('rate', ',');
        //alert(idd);
        idd = idd.replace('qty', ',');
        idd = idd.replace('discount', ',');
        var res = idd.split(',');
        //alert(res[0]);mewo_qty1
        //alert(res[1]);
        //alert($('#wo_qty'+res[1]).val());
        var qty = $('#'+res[0]+'qty'+res[1]).val();
        var rate = $('#'+res[0]+'rate'+res[1]).val();
        var disc = $('#'+res[0]+'discount'+res[1]).val();

        //var seltax = $('#'+res[0]+'itax_amt'+res[1]).val();
        var totaldisc = (((parseFloat(qty) * parseFloat(rate)) * disc) / 100);
        var total = ((parseFloat(qty) * parseFloat(rate)) - totaldisc);
        //alert(totaldisc);
        if(totaldisc != '' && total != '')
        {
          //$('#'+res[0]+'wo_disprice'+res[1]).val(parseFloat(totaldisc).toFixed(2));
          $('#'+res[0]+'quot_ftotl'+res[1]).val(parseFloat(total).toFixed(2));
        }
        });

</script>
<script src="<?php echo base_url(); ?>assets/search/js/jquery-ui.js"></script>
<script type="text/javascript">
    var base_url = "<?php echo base_url(); ?>";
</script>
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
<script>
  $( function() {
    $("#master_party_com_name").autocomplete({
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