<?php //echo "<pre>";print_r($list);die; ?>
<link href="<?php echo base_url(); ?>assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url(); ?>assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url(); ?>assets/global/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url(); ?>assets/global/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url(); ?>assets/global/plugins/clockface/css/clockface.css" rel="stylesheet" type="text/css" />
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
<link href="<?php echo base_url(); ?>assets/global/plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url(); ?>assets/global/plugins/jquery-multi-select/css/multi-select.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url(); ?>assets/global/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url(); ?>assets/global/plugins/select2/css/select2-bootstrap.min.css" rel="stylesheet" type="text/css" />
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
<link href="<?php echo base_url(); ?>assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url(); ?>assets/global/plugins/bootstrap-select/css/bootstrap-select.min.css" rel="stylesheet" type="text/css" />
 
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
<link href="<?php echo base_url(); ?>assets/global/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url(); ?>assets/global/plugins/bootstrap-markdown/css/bootstrap-markdown.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url(); ?>assets/global/plugins/bootstrap-summernote/summernote.css" rel="stylesheet" type="text/css" />
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN THEME GLOBAL STYLES -->
<link href="<?php echo base_url(); ?>assets/global/css/components.min.css" rel="stylesheet" id="style_components" type="text/css" />
<link href="<?php echo base_url(); ?>assets/global/css/plugins.min.css" rel="stylesheet" type="text/css" />
<!-- BEGIN PAGE LEVEL PLUGINS -->
<link href="<?php echo base_url(); ?>assets/global/plugins/bootstrap-colorpicker/css/colorpicker.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url(); ?>assets/global/plugins/jquery-minicolors/jquery.minicolors.css" rel="stylesheet" type="text/css" />
<!-- END PAGE LEVEL PLUGINS -->
 <!-- BEGIN THEME LAYOUT STYLES -->
<link href="<?php echo base_url(); ?>assets/layouts/layout2/css/layout.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url(); ?>assets/layouts/layout2/css/custom.min.css" rel="stylesheet" type="text/css" />
<!-- END THEME LAYOUT STYLES -->
<style type="text/css">
  .salary_main {
    z-index: 1;
    position: relative;
}

.salary_main .salary_hidden {
    width: 100%;
    position: absolute;
    background-color: #000;
    z-index: 9999;
    height: 100%;
    opacity: 0.5;
    color: #000;
}
</style>
<div class="container-fluid">
                <div class="page-content">

<!-- BEGIN BREADCRUMBS -->
                    <div class="breadcrumbs">
                        <h1>Admin Users</h1>
                        <ol class="breadcrumb">
                            <li>
                                <a href="<?php echo base_url(); ?>dashboard">Home</a>
                            </li>
                            <li>
                                <a href="<?php echo base_url(); ?>Admin_users">Admin User List</a>
                            </li>
                            <?php
                                                    if($this->session->userdata('miconlogin') && is_array($this->session->userdata['miconlogin']) && !empty($this->session->userdata['miconlogin']) && isset($this->session->userdata['miconlogin']['typeid']) && (encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['typeid']) == 3))
                                                    { ?>
                            <li class="active">
                                <a href="<?php echo base_url(); ?>Admin_users/add">Admin User Add</a>
                            </li>
                            <?php } ?>
                        </ol>
                    </div>
                    <?php if($this->input->post()){ ?>
                    <div class="col-md-12 col-xs-6"><div class="alert alert-danger">
                    <strong><?php echo $this->session->flashdata('error'); echo validation_errors();?>
                    </strong> 
                    </div>
                    </div>
                    <?php } ?>
                    <!-- END BREADCRUMBS -->
                     <?php  $atr = array('class' => 'form-horizontal');
                        echo form_open_multipart($action,$atr); ?>
                    <div class="add-section-bg">
                    <div class="row">
                        <div class="pull-right"><input type="submit" class="btn btn-success btn-space" value="Save & Continue Edit" />
                        </div>
                    </div>    
                    </div>
<!-- BEGIN PAGE BASE CONTENT -->
<div class="page-content-col">
<!-- BEGIN PAGE BASE CONTENT -->
    <div class="row">
                      <div class="col-md-12">
                            <?php
                            if (!empty($success) || $this->session->flashdata('success') != '') {
                                $msg = !empty($success) ? $success : $this->session->flashdata('success');
                                echo '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button>' . $msg . '</div>';
                            }
                            if (!empty($error) || $this->session->flashdata('error') != '') {
                                $msg = !empty($error) ? $error : $this->session->flashdata('error');
                                echo '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button>' . $msg . '</div>';
                            }
                            if (!empty($warning) || $this->session->flashdata('warning') != '') {
                                $msg = !empty($warning) ? $warning : $this->session->flashdata('warning');
                                echo '<div class="alert alert-warning"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button>' . $msg . '</div>';
                            }
                            ?>
                            <div class="space-2"></div>
                        </div>
       <div class="col-md-12">
                  	  <div class="portlet-body form">
                      <!-- BEGIN FORM-->
                      <div class="tabbable-custom nav-justified">
                    	<ul class="nav nav-tabs nav-justified">
                        <li class="active">
                            <a href="#tab_1_1_1" data-toggle="tab"> <span class="badge badge-danger">1</span> <strong>Basic Details</strong> </a>
                        </li>
                        
                    <div class="tab-content">
<?php //********************** Inquiry start ***************************** ?>
                          <div class="tab-pane active tab-space" id="tab_1_1_1">
                      
                        <div class="form-body form-space">
                         <h3 class="form-section">Person Info</h3>
                           <div class="row">
                                <div class="col-md-4">
                                 <div class="form-group">
                                   <label class="control-label col-md-3">First Name<span class="required" aria-required="true"> * </span></label>
                                     <div class="col-md-9">
                                        <input type="text" class="form-control" id="au_fname" name="au_fname" tabindex="1" maxlength="40" required="required" value="<?php echo isset($list['users'][0]['au_fname']) ? $list['users'][0]['au_fname'] : ""; ?>">
                                     </div>
                                 </div>
                                </div>
                           	<!--/span-->
                            <div class="col-md-4">
                                <div class="form-group">
                                  <label class="control-label col-md-3">Middle Name:</label>
                                    <div class="col-md-9">
                                     <input type="text" class="form-control" id="au_mname" name="au_mname" tabindex="2" maxlength="40"  value="<?php echo isset($list['users'][0]['au_mname']) ? $list['users'][0]['au_mname'] : ""; ?>">
                                    </div>
                                </div>
                                </div>
                                <!--/span-->
                                <div class="col-md-4">
                                <div class="form-group">
                                  <label class="control-label col-md-3">Last Name:</label>
                                    <div class="col-md-9">
                                     <input type="text" class="form-control" id="au_lname" name="au_lname" tabindex="3" maxlength="40"  value="<?php echo isset($list['users'][0]['au_lname']) ? $list['users'][0]['au_lname'] : ""; ?>">
                                    </div>
                                </div>
                                </div>
                                <!--/span-->
                           </div>
                           <!--/row-->
                           <div class="row">
                              <div class="col-md-4">
                              <div class="form-group">
                                 <label class="control-label col-md-3">Address:</label>
                                   <div class="col-md-9">
                                     <textarea class="form-control" rows="3" id="au_address" name="au_address" tabindex="4"><?php echo isset($list['users'][0]['au_address']) ? $list['users'][0]['au_address'] : ""; ?></textarea>
                                   </div>
                              </div>
                              </div>
                              <div class="col-md-4">
                              <div class="form-group">
                                 <label class="control-label col-md-3">Personal Email Id:</label>
                                   <div class="col-md-9">
                                    <input type="text" tabindex="5" class="form-control" id="au_per_email_id" name="au_per_email_id"  value="<?php echo isset($list['users'][0]['au_per_email_id']) ? $list['users'][0]['au_per_email_id'] : ""; ?>">
                                   </div>
                              </div>
                           </div>
                           <div class="col-md-4">
                              <div class="form-group">
                                 <label class="control-label col-md-3">Date of Birth:</label>
                                   <div class="col-md-9">
                                    <input type="text" tabindex="6" class="form-control form-control-inline input-medium date-picker" id="au_dob" name="au_dob"  value="<?php echo isset($list['users'][0]['au_dob']) ? $list['users'][0]['au_dob'] : ""; ?>">
                                   </div>
                              </div>
                           </div>
                            </div>
                             <div class="row">
                              <div class="col-md-4">
                              <div class="form-group">
                                 <label class="control-label col-md-3">Com Mobile No.</label>
                                   <div class="col-md-9">
                                    <input type="text" class="form-control" id="au_mo_no" name="au_mo_no" tabindex="7" maxlength="15" value="<?php echo isset($list['users'][0]['au_mo_no']) ? $list['users'][0]['au_mo_no'] : ""; ?>">
                                   </div>
                              </div>
                           </div>
                           <div class="col-md-4">
                              <div class="form-group">
                                 <label class="control-label col-md-3">Personal Mobile No.</label>
                                   <div class="col-md-9">
                                    <input type="text" class="form-control" id="au_per_mobil_no" name="au_per_mobil_no" tabindex="8" maxlength="15" value="<?php echo isset($list['users'][0]['au_per_mobil_no']) ? $list['users'][0]['au_per_mobil_no'] : ""; ?>">
                                   </div>
                              </div>
                           </div>
                           <div class="col-md-4">
                              <div class="form-group">
                                 <label class="control-label col-md-3">Extra Mobile No.</label>
                                   <div class="col-md-9">
                                    <input type="text" class="form-control" id="au_extra_no" name="au_extra_no" tabindex="9" maxlength="15" value="<?php echo isset($list['users'][0]['au_extra_no']) ? $list['users'][0]['au_extra_no'] : ""; ?>">
                                   </div>
                              </div>
                           </div>
                           </div>
                           <div class="row">
                           		<div class="col-md-3">
                                  <div class="form-group">
                                     <label class="control-label col-md-4">Country</label>
                                       <div class="col-md-8">
                                        <select id="au_country" name="au_country" class="bs-select form-control" data-placeholder="Choose a Category" tabindex="10" data-live-search="true" data-size="8">
                                          <option value="0">Select Country</option>
                                           <?php foreach ($countries as $country) { ?>
                                                	<option value="<?php echo $country['country_id']; ?>" <?php if(isset($list['users'][0]['au_country']) && ($list['users'][0]['au_country'] == $country['country_id'])){ ?> selected="selected" <?php } ?> ><?php echo $country['country_name']; ?></option>
                                             <?php } ?>
                                        </select>
                                       </div>
                                  </div>
                              <!--/span-->
                           		</div>
                              <div class="col-md-3">
                              <div class="form-group">
                                 <label class="control-label col-md-3">State</label>
                                   <div class="col-md-9">
                                    <select id="au_state" name="au_state"  class="bs-select form-control" data-placeholder="Choose a Category" tabindex="11" data-live-search="true" data-size="8">
                                       <option value="0">Select State</option>
                                       <?php if($this->uri->segment(2) == 'edit') { ?>
                                       <option value="<?php echo $list['states'][0]['state_id'];?>" selected><?php echo $list['states'][0]['state_name'];?></option>
                                       <?php } ?>
                                    </select>
                                   </div>
                             </div>
                             </div>
                             <!--/span-->
                             <div class="col-md-3">
                              <div class="form-group">
                                 <label class="control-label col-md-3">City</label>
                                   <div class="col-md-9">
                                    <select id="au_city" name="au_city"  class="bs-select form-control" data-placeholder="Choose a Category" tabindex="12" data-live-search="true" data-size="8">
                                     <option value="0">Select City</option>
                                     <?php if($this->uri->segment(2) == 'edit') { ?>
                                       <option value="<?php echo $list['cities'][0]['city_id'];?>" selected><?php echo $list['cities'][0]['city_name'];?></option>
                                       <?php } ?>
                                    </select>
                                   </div>
                             </div>
                             </div>
                             <!--/span-->
                             <div class="col-md-3">
                              <div class="form-group">
                                 <label class="control-label col-md-3">Area</label>
                                   <div class="col-md-9">
                                    <select id="au_area" name="au_area"  class="bs-select form-control" data-placeholder="Choose a Category" tabindex="13" data-live-search="true" data-size="8">
                                       <option value="0">Select Area</option>
                                       <?php if($this->uri->segment(2) == 'edit') { ?>
                                       
                                       <?php } ?>
                                    </select>
                                   </div>
                             </div>
                             </div>
                             <!--/span-->
                             <!--/span-->
                             </div>
                             <?php if($this->uri->segment(2) && $this->uri->segment(2) == "edit" && isset($list) && $list['users'][0]['au_adt_id'] == 3){ echo '<div class="row"><div class="col-md-12" style="font-size:24px;"><b>Super Admin</b></div></div>'; } ?>
                           <div class="row">
                              <div class="col-md-4" <?php
                                                    if($this->session->userdata('miconlogin') && is_array($this->session->userdata['miconlogin']) && !empty($this->session->userdata['miconlogin']) && isset($this->session->userdata['miconlogin']['typeid']) && ((encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['typeid']) == 3) || (encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['dep_id']) == 6)))
                                                    { 
                                                      if($this->uri->segment(2) && $this->uri->segment(2) == "edit" && isset($list) && $list['users'][0]['au_adt_id'] == 3){
                                                        ?> style="display:none;" <?php 
                                                      }
                                                      ?>  <?php }else{ ?> style="display:none;" <?php } ?>>
                              <div class="form-group">
                                 <label class="control-label col-md-3">Department</label>
                                   <div class="col-md-9">
                                      <select id="au_dep_id" name="au_dep_id" class="form-control" data-placeholder="Choose a Category" tabindex="14" required="required">
                                        <option value="">Select Department</option>
                                        <?php foreach($master['departments'] as $department) { ?>
                                       <option value="<?php echo $department['dep_id'];?>"<?php if(isset($list) && $list['users'][0]['au_dep_id'] == $department['dep_id']){ ?> selected="selected" <?php } ?>><?php echo $department['dep_name'];?></option>
                                       <?php } ?>
                                    </select>
                                   </div>
                              </div>
                              </div>
                              <!--/span-->

                              <div class="col-md-4" <?php
                                                    if($this->session->userdata('miconlogin') && is_array($this->session->userdata['miconlogin']) && !empty($this->session->userdata['miconlogin']) && isset($this->session->userdata['miconlogin']['typeid']) && (encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['typeid']) == 3 || (encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['dep_id']) == 6)))
                                                    { 
                                                      if($this->uri->segment(2) && $this->uri->segment(2) == "edit" && isset($list) && $list['users'][0]['au_adt_id'] == 3){
                                                        ?> style="display:none;" <?php 
                                                      }
                                                      ?>  <?php }else{ ?> style="display:none;" <?php } ?>> 
                              <div class="form-group">
                                 <label class="control-label col-md-3">Select Rights<span class="required" aria-required="true"> * </span></label>
                                   <div class="col-md-9">
                                    <select id="au_rights_id" name="au_rights_id" class="form-control" data-placeholder="Choose a Category" tabindex="15" required="required">
                                      <option value="">Select Rights</option>
                                      <?php foreach($master['roles'] as $role) { ?>
                                       <option value="<?php echo $role['rights_id'];?>"<?php if(isset($list) && $list['users'][0]['au_rights_id'] == $role['rights_id']){ ?> selected="selected" <?php } ?>><?php echo $role['rights_name'];?></option>
                                       <?php } ?>
                                    </select>
                                   </div>
                              </div>
                              <!--/span-->
                           </div>
                           <div class="col-md-4" <?php
                                                    if($this->session->userdata('miconlogin') && is_array($this->session->userdata['miconlogin']) && !empty($this->session->userdata['miconlogin']) && isset($this->session->userdata['miconlogin']['typeid']) && (encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['typeid']) == 3 || (encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['dep_id']) == 6)))
                                                    { 
                                                      if($this->uri->segment(2) && $this->uri->segment(2) == "edit" && isset($list) && $list['users'][0]['au_adt_id'] == 3){
                                                        ?> style="display:none;" <?php 
                                                      }
                                                      ?>  <?php }else{ ?> style="display:none;" <?php } ?>>
                              <div class="form-group">
                                 <label class="control-label col-md-3">Admin Type<span class="required" aria-required="true"> * </span></label>
                                   <div class="col-md-9">
                                     <select id="au_adt_id" name="au_adt_id" class="form-control" data-placeholder="Select Admin type" tabindex="16" required="required">
                                      <option value="">Select Admin Type</option>
                                      <?php foreach($admin_types as $admin_type) { if($admin_type['adt_id'] != 3){ ?>
                                       <option value="<?php echo $admin_type['adt_id'];?>"<?php if(isset($list) && $list['users'][0]['au_adt_id'] == $admin_type['adt_id']){ ?> selected="selected" <?php } ?>><?php echo $admin_type['adt_name'];?></option>
                                       <?php }else{ if($this->uri->segment(2) && $this->uri->segment(2) == "edit" && isset($list) && $list['users'][0]['au_adt_id'] == 3){ ?>
                                        <option value="<?php echo $admin_type['adt_id'];?>"<?php if(isset($list) && $list['users'][0]['au_adt_id'] == $admin_type['adt_id']){ ?> selected="selected" <?php } ?>><?php echo $admin_type['adt_name'];?></option>
                                       <?php } }
                                       } ?>
                                    </select>
                                   </div>
                              </div>
                              <!--/span-->
                           </div>
                           </div>
                           
                           <div class="row">
                           <div class="col-md-3">
                                  <div class="form-group">
                                    <label class="control-label col-md-4">Photo Upload</label>
                                    <div class="col-md-8">
                                        <div class="fileinput fileinput-new" data-provides="fileinput">
                                          <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
                                          <?php if($this->uri->segment(2) == 'edit'){?>
                                                <img src="<?php echo base_url();?>uploads/au_photo/<?php echo $list['users'][0]['au_photo']; ?>"/>
                                           <?php } ?> </div>
                                            <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;">  
                                                </div>
                                            <div>
                                                <span class="btn default btn-file">
                                                    <span class="fileinput-new" tabindex="17"> Select Image </span>
                                                    <span class="fileinput-exists"> Change </span>
                                                    <input type="file" name="au_photo" id="au_photo"> 
                                                  
                                                    </span>
                                                <a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput"> Remove </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                </div>
                        		<div class="col-md-5">
                                    <div class="form-group">
                                        <label class="control-label col-md-4">Remark</label>
                                        <div class="col-md-8">
                                        	<textarea class="form-control" rows="7" id="au_remark" name="au_remark" tabindex="18"><?php echo isset($list['users'][0]['au_remark']) ? $list['users'][0]['au_remark'] : ""; ?></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                              <div class="form-group">
                                 <label class="control-label col-md-3">Your Admin<span class="required" aria-required="true"> * </span></label>
                                   <div class="col-md-9">
                                   <?php
                                                    if($this->session->userdata('miconlogin') && is_array($this->session->userdata['miconlogin']) && !empty($this->session->userdata['miconlogin']) && isset($this->session->userdata['miconlogin']['typeid']) && (encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['typeid']) == 3))
                                                    { ?> <select id="au_parent_id" name="au_parent_id" class="form-control" data-placeholder="Select Admin type" tabindex="19">
                                      <option value="0">No Parent</option>
                                      <?php foreach($admin as $admin_user) { ?>
                                       <option value="<?php echo $admin_user['au_id'];?>"<?php if(isset($list) && $list['users'][0]['au_parent_id'] == $admin_user['au_id']){ ?> selected="selected" <?php } ?>><?php echo $admin_user['au_fname'].''.$admin_user['au_lname'];?></option>
                                       <?php } ?>
                                    </select> <?php }else{ ?> 
                                      <select id="dfhdfhdfh" name="dfdfhdfh" class="form-control" disabled tabindex="19">
                                      <option value="0">No Parent</option>
                                      <?php foreach($admin as $admin_user) { ?>
                                       <option value="<?php echo $admin_user['au_id'];?>"<?php if(isset($list) && $list['users'][0]['au_parent_id'] == $admin_user['au_id']){ ?> selected="selected" <?php } ?>><?php echo $admin_user['au_fname'].''.$admin_user['au_lname'];?></option>
                                       <?php } ?>
                                    </select>
                                      <select id="au_parent_id" name="au_parent_id" class="form-control" style="display:none;" tabindex="19">
                                      <option value="0">No Parent</option>
                                      <?php foreach($admin as $admin_user) { ?>
                                       <option value="<?php echo $admin_user['au_id'];?>"<?php if(isset($list) && $list['users'][0]['au_parent_id'] == $admin_user['au_id']){ ?> selected="selected" <?php } ?>><?php echo $admin_user['au_fname'].''.$admin_user['au_lname'];?></option>
                                       <?php } ?>
                                    </select> <?php } ?>
                                   </div>
                              </div>
                              <!--/span-->
                           </div>

                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group" id="mcna_namegr">
                                    <label class="control-label col-md-1">Signature</label>
                                    <div class="col-md-11">
                                    <textarea class="form-control" tabindex="20" name="au_signature" placeholder="Body" id="summernote_1" rows="3"><?php
                                    if(isset($list['users'][0]['au_signature']) && $list['users'][0]['au_signature'] !='') {echo $list['users'][0]['au_signature']; }?></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                              <div class="col-md-6">
                                    <div class="form-group" id="mcna_namegr">
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Select Color for header</label>
                                            <div class="col-md-3">
                                              <input type="text" id="hue-demo" name="aus_color" tabindex="21" class="form-control demo" data-control="hue" value="<?php echo isset($list['users'][0]['au_colorcode']) ? $list['users'][0]['au_colorcode'] : '#d2b68e'; ?>"> </div>
                                            </div>
                                        </div>
                                    </div>
                              </div>
                        </div>
                        <h3 class="form-section">Event Date :</h3>
                        <div class="row">
                              <div class="col-md-4">
                              <div class="form-group">
                                 <label class="control-label col-md-3">Birth Date:</label>
                                   <div class="col-md-9">
                                     <input class="form-control form-control-inline date-picker" size="16" type="text"  id="au_birth_date" name="au_birth_date" value="<?php echo isset($list['users'][0]['au_birth_date']) ? date("d-m-Y", strtotime($list['users'][0]['au_birth_date'])) : ""; ?>" tabindex="22">
                                   </div>
                              </div>
                           </div>
                           <div class="col-md-4">
                              <div class="form-group">
                                 <label class="control-label col-md-3">Anniversary Date: </label>
                                   <div class="col-md-9">
                                     <input class="form-control form-control-inline date-picker" size="16" type="text"  id="au_anni_date" name="au_anni_date" value="<?php echo isset($list['users'][0]['au_anni_date']) ? date("d-m-Y", strtotime($list['users'][0]['au_anni_date'])) : ""; ?>" tabindex="23">
                                   </div>
                              </div>
                           </div>
                           <div class="col-md-4">
                              <div class="form-group">
                                 <label class="control-label col-md-3">Joining Date:</label>
                                   <div class="col-md-9">
                                    <input class="form-control form-control-inline date-picker" size="16" type="text"  id="au_join_date" name="au_join_date" value="<?php echo isset($list['users'][0]['au_join_date']) ? date("d-m-Y", strtotime($list['users'][0]['au_join_date'])) : ""; ?>" tabindex="24">
                                   </div>
                              </div>
                           </div>
                           </div>
                          <h3 class="form-section">Salary Details :</h3>
                          <div class="salary_main">
                            <?php 
                            $typeid = encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['typeid']);
                            $dep_id =  encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['dep_id']);
                                        if($dep_id != 6 && $typeid != 3) { ?>
                                            <div class="salary_hidden"></div>
                                          <?php } ?>
                          <div class="salary_data">
                          <div class="row">
                            <div class="col-md-4" >
                              <div class="form-group">
                                 <label class="control-label col-md-6">Salary Calculate Yes ? no</label>
                                   <div class="col-md-6">
                                      <label>
                                        <input type="radio" name="au_eligible_sal" tabindex="25" class="icheck" value="1" <?php if(isset($list['users'][0]['au_eligible_sal']) && $list['users'][0]['au_eligible_sal'] == 1){ echo "checked"; } ?>> Yes </label>
                                         <label>
                                           <input type="radio" name="au_eligible_sal" tabindex="26" class="icheck" value="0" <?php if(isset($list['users'][0]['au_eligible_sal']) && $list['users'][0]['au_eligible_sal'] == 0){ echo "checked"; } if($this->uri->segment(2) == "add") { echo "checked"; } ?>> No </label>
                                   </div>
                              </div>
                           </div>
                         </div>
                           <div class="row">
                          <div class="col-md-4">
                              <div class="form-group">
                                 <label class="control-label col-md-3">Basic Salary </label>
                                   <div class="col-md-9">
                                    <input type="text" class="form-control" id="au_basic_sal" name="au_basic_sal" tabindex="27" maxlength="15" value="<?php echo isset($list['users'][0]['au_basic_sal']) ? $list['users'][0]['au_basic_sal'] : ""; ?>">
                                   </div>
                              </div>
                           </div>
                           <div class="col-md-4" >
                              <div class="form-group">
                                 <label class="control-label col-md-3">Salary Breakup </label>
                                   <div class="col-md-9">
                                    <input type="text" class="form-control" id="au_sal_brkup_main" name="au_sal_brkup_main" tabindex="28" maxlength="15" value="<?php echo isset($list['users'][0]['au_sal_brkup_main']) ? $list['users'][0]['au_sal_brkup_main'] : ""; ?>">
                                   </div>
                              </div>
                           </div>
                         </div>
                         <div class="row">
                           <div class="col-md-4" >
                              <div class="form-group">
                                 <label class="control-label col-md-3">Basic</label>
                                   <div class="col-md-4">
                                    <input type="text" class="form-control" id="au_sal_basic_percent" name="au_sal_basic_percent" tabindex="29" maxlength="15" value="<?php echo isset($list['users'][0]['au_sal_basic_percent']) ? $list['users'][0]['au_sal_basic_percent'] : ""; ?>">
                                   </div>
                                   <div class="col-md-4">
                                    <input type="text" class="form-control" id="au_sal_basic_res" name="au_sal_basic_res" tabindex="30" maxlength="15" value="<?php   
                                    echo isset($list['users'][0]['au_sal_basic_res']) ? $list['users'][0]['au_sal_basic_res'] : ""; ?>">
                                   </div>
                              </div>
                           </div>
                         </div>
                         <div class="row">
                           <div class="col-md-4" >
                              <div class="form-group">
                                 <label class="control-label col-md-3">HRA</label>
                                   <div class="col-md-4">
                                    <input type="text" class="form-control" id="au_sal_hra_percent" name="au_sal_hra_percent" tabindex="31" maxlength="15" value="<?php echo isset($list['users'][0]['au_sal_hra_percent']) ? $list['users'][0]['au_sal_hra_percent'] : ""; ?>">
                                   </div>
                                   <div class="col-md-4">
                                    <input type="text" class="form-control" id="au_sal_hra_res" name="au_sal_hra_res" tabindex="32" maxlength="15" value="<?php echo isset($list['users'][0]['au_sal_hra_res']) ? $list['users'][0]['au_sal_hra_res'] : ""; ?>">
                                   </div>
                              </div>
                           </div>
                         </div>
                         <div class="row">
                           <div class="col-md-4" >
                              <div class="form-group">
                                 <label class="control-label col-md-3">Wash</label>
                                   <div class="col-md-4">
                                    <input type="text" class="form-control" id="au_sal_wash_percent" name="au_sal_wash_percent" tabindex="33" maxlength="15" value="<?php echo isset($list['users'][0]['au_sal_wash_percent']) ? $list['users'][0]['au_sal_wash_percent'] : ""; ?>">
                                   </div>
                                   <div class="col-md-4">
                                    <input type="text" class="form-control" id="au_sal_wash_res" name="au_sal_wash_res" tabindex="34" maxlength="15" value="<?php echo isset($list['users'][0]['au_sal_wash_res']) ? $list['users'][0]['au_sal_wash_res'] : ""; ?>">
                                   </div>
                              </div>
                           </div>
                         </div>
                         <div class="row">
                           <div class="col-md-4" >
                              <div class="form-group">
                                 <label class="control-label col-md-3">Bonus</label>
                                   <div class="col-md-4">
                                    <input type="text" class="form-control" id="au_sal_bonus_percent" name="au_sal_bonus_percent" tabindex="35" maxlength="15" value="<?php echo isset($list['users'][0]['au_sal_bonus_percent']) ? $list['users'][0]['au_sal_bonus_percent'] : ""; ?>">
                                   </div>
                                   <div class="col-md-4">
                                    <input type="text" class="form-control" id="au_sal_bonus_res" name="au_sal_bonus_res" tabindex="36" maxlength="15" value="<?php echo isset($list['users'][0]['au_sal_bonus_res']) ? $list['users'][0]['au_sal_bonus_res'] : ""; ?>">
                                   </div>
                              </div>
                           </div>
                         </div>
                           <div class="row">
                           <div class="col-md-4" >
                              <div class="form-group">
                                 <label class="control-label col-md-3">ESIC</label>
                                   <div class="col-md-9">
                                    <input type="text" class="form-control" id="au_sal_esic" name="au_sal_esic" tabindex="37" maxlength="15" value="<?php echo isset($list['users'][0]['au_sal_esic']) ? $list['users'][0]['au_sal_esic'] : ""; ?>">
                                   </div>
                              </div>
                           </div>
                         </div>
                         <div class="row">
                           <div class="col-md-4" >
                              <div class="form-group">
                                 <label class="control-label col-md-3">PF</label>
                                   <div class="col-md-9">
                                    <input type="text" class="form-control" id="au_sal_pf" name="au_sal_pf" tabindex="38" maxlength="15" value="<?php echo isset($list['users'][0]['au_sal_pf']) ? $list['users'][0]['au_sal_pf'] : ""; ?>">
                                   </div>
                              </div>
                           </div>
                         </div>
                         <div class="row">
                           <div class="col-md-4" >
                              <div class="form-group">
                                 <label class="control-label col-md-3">Professional Tax Standard</label>
                                   <div class="col-md-9">
                                    <input type="text" class="form-control" id="au_sal_proffesional_tax" name="au_sal_proffesional_tax" tabindex="39" maxlength="15" value="<?php echo isset($list['users'][0]['au_sal_proffesional_tax']) ? $list['users'][0]['au_sal_proffesional_tax'] : ""; ?>">
                                   </div>
                              </div>
                           </div>
                           </div>
                           <div class="row">
                           <div class="col-md-4" >
                              <div class="form-group">
                                 <label class="control-label col-md-3">Add Performance Bonus</label>
                                   <div class="col-md-9">
                                    <input type="text" class="form-control" id="au_sal_add_perform" name="au_sal_add_perform" tabindex="40" maxlength="15" value="<?php echo isset($list['users'][0]['au_sal_add_perform']) ? $list['users'][0]['au_sal_add_perform'] : ""; ?>">
                                   </div>
                              </div>
                           </div>
                         </div>
                         <div class="row">
                           <div class="col-md-4" >
                              <div class="form-group">
                                 <label class="control-label col-md-3">12 Leaves</label>
                                   <div class="col-md-9">
                                    <input type="text" class="form-control" id="au_sal_12_leaves" name="au_sal_12_leaves" tabindex="41" maxlength="15" value="<?php echo isset($list['users'][0]['au_sal_12_leaves']) ? $list['users'][0]['au_sal_12_leaves'] : ""; ?>">
                                   </div>
                              </div>
                           </div>
                         </div>
                         <div class="row">
                           <div class="col-md-4" >
                              <div class="form-group">
                                 <label class="control-label col-md-3"><b>CTC PM</b></label>
                                   <div class="col-md-9">
                                    <input type="text" class="form-control" id="au_sal_ctc_pm" name="au_sal_ctc_pm" tabindex="42" maxlength="15" value="<?php echo isset($list['users'][0]['au_sal_ctc_pm']) ? $list['users'][0]['au_sal_ctc_pm'] : ""; ?>">
                                   </div>
                              </div>
                           </div>
                           <div class="col-md-4" >
                              <div class="form-group">
                                 <label class="control-label col-md-3"><b>CTC PY</b></label>
                                   <div class="col-md-9">
                                    <input type="text" class="form-control" id="au_sal_ctc_py" name="au_sal_ctc_py" tabindex="43" maxlength="15" value="<?php echo isset($list['users'][0]['au_sal_ctc_py']) ? $list['users'][0]['au_sal_ctc_py'] : ""; ?>">
                                   </div>
                              </div>
                           </div>
                           </div>

                            <div class="col-md-4" style="display: none;">
                              <div class="form-group">
                                 <label class="control-label col-md-3">Total Leave</label>
                                   <div class="col-md-9">
                                    <input type="text" class="form-control" id="au_total_leave" name="au_total_leave" tabindex="44" maxlength="15" value="<?php echo isset($list['users'][0]['au_total_leave']) ? $list['users'][0]['au_total_leave'] : ""; ?>">
                                   </div>
                              </div>
                           </div>
                         </div>
                         </div></div>
                         <h3 class="form-section">Mailing Details :</h3>
                         <div class="row">
                             <div class="col-md-4">
                                <div class="form-group">
                                    <label class="col-md-4 control-label">Email ID<span class="required" aria-required="true"> * </span></label>
                                        <div class="col-md-8">
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                <i class="fa fa-envelope"></i>
                                                </span>
                                          <input id="au_gmail_email" name="au_gmail_email" value="<?php echo isset($list['users'][0]['au_gmail_email']) ? $list['users'][0]['au_gmail_email'] : ""; ?>" type="email" class="form-control" placeholder="Email Address" required="required" tabindex="45" maxlength="100"> </div>
                                        </div>
                                </div>
                             </div>
                              <div class="col-md-4">
                                <div class="form-group">
                                  <label class="col-md-4 control-label">Password<span class="required" aria-required="true">  </span></label>
                                        <div class="col-md-8">
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                <i class="fa fa-user"></i>
                                                </span>
                                              <input id="au_gmail_password" name="au_gmail_password"  value="<?php echo isset($list['users'][0]['au_gmail_password']) ? $list['users'][0]['au_gmail_password'] : ""; ?>" type="password" class="form-control" placeholder="Password" tabindex="46" maxlength="50">
                                            </div>
                                        </div>
                                </div>
                              </div>
                             </div>
                        <h3 class="form-section">Login :</h3>
                           <!--/row-->
                           <div class="row">
                             <div class="col-md-4">
                                <div class="form-group">
                                    <label class="col-md-4 control-label">Email ID<span class="required" aria-required="true"> * </span></label>
                                        <div class="col-md-8">
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                <i class="fa fa-envelope"></i>
                                                </span>
                                          <input id="au_email" name="au_email" value="<?php echo isset($list['users'][0]['au_email']) ? $list['users'][0]['au_email'] : ""; ?>" type="email" class="form-control" placeholder="Email Address" required="required" tabindex="47"> </div>
                                        </div>
                                </div>
                             </div>
                             </div>
                             <?php if(!$this->uri->segment(3)) { ?>
                           <div class="row">
                             <div class="col-md-4">
                                <div class="form-group">
                                	<label class="col-md-4 control-label">Password<span class="required" aria-required="true">  </span></label>
                                        <div class="col-md-8">
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                <i class="fa fa-user"></i>
                                                </span>
                                            	<input id="au_password" name="au_password" type="password" class="form-control" placeholder="Password" tabindex="48">
                                            </div>
                                        </div>
                                </div>
                              </div>
                            </div>
                           <!--/row-->
                           <div class="row">
                             <div class="col-md-4">
                                <div class="form-group">
                                	<label class="col-md-4 control-label">Confirm Password<span class="required" aria-required="true">  </span></label>
                                        <div class="col-md-8">
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                <i class="fa fa-user"></i>
                                                </span>
                                            	<input id="confirmpwd" name="confirmpwd" type="password" class="form-control" placeholder="Confirm Password" tabindex="49">
                                            </div>
                                        </div>
                                </div>
                              </div>
                            </div>
                            <?php } ?>
                           <!--/row-->
                          </div>
                         
                          <div class="form-actions" style="display:none">
                                <div class="row">
                                    <div class="col-md-offset-5 col-md-7">
                                        <a href="javascript:;" class="btn default button-previous" style="display: none;" tabindex="50">
                                            <i class="fa fa-angle-left"></i> Back </a>
                                        <a href="javascript:;" class="btn btn-outline green button-next" id="btn_continues"> Continue
                                            <i class="fa fa-angle-right"></i>
                                        </a>
                                        <a href="javascript:;" class="btn green button-submit" style="display: none;"> Submit
                                            <i class="fa fa-check"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                          </div>
                          <?php //********************** Basic Detail start ***************************** ?>
                        <?php //********************** Basic Detail end ***************************** ?>
                                  
                        </div>
                      </div>
                   </div>
                 <?php echo form_close(); ?>
             <!-- END FORM-->
            <!-- END PORTLET-->
            </div>
         <!-- END PAGE BASE CONTENT -->
</div>
</div>
</div>
</div>
</div>
<!--[if lt IE 9]>
<script src="<?php echo base_url(); ?>assets/global/plugins/respond.min.js"></script>
<script src="<?php echo base_url(); ?>assets/global/plugins/excanvas.min.js"></script> 
<script src="<?php echo base_url(); ?>assets/global/plugins/ie8.fix.min.js"></script> 
<![endif]-->
        <!-- BEGIN CORE PLUGINS -->
<script type="text/javascript">var base_url = '<?php echo base_url(); ?>';</script>
<script src="<?php echo base_url(); ?>assets/global/plugins/jquery.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/global/plugins/js.cookie.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
<!-- END CORE PLUGINS -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
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
<script src="<?php echo base_url(); ?>assets/pages/scripts/components-date-time-pickers.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/global/plugins/morris/morris.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/global/plugins/morris/raphael-min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/global/plugins/counterup/jquery.waypoints.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/global/plugins/counterup/jquery.counterup.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/global/plugins/amcharts/amcharts/amcharts.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/global/plugins/amcharts/amcharts/serial.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/global/plugins/amcharts/amcharts/pie.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/global/plugins/amcharts/amcharts/radar.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/global/plugins/amcharts/amcharts/themes/light.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/global/plugins/amcharts/amcharts/themes/patterns.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/global/plugins/amcharts/amcharts/themes/chalk.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/global/plugins/amcharts/ammap/ammap.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/global/plugins/amcharts/ammap/maps/js/worldLow.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/global/plugins/amcharts/amstockcharts/amstock.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/global/plugins/fullcalendar/fullcalendar.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/global/plugins/horizontal-timeline/horizontal-timeline.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/global/plugins/flot/jquery.flot.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/global/plugins/flot/jquery.flot.resize.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/global/plugins/flot/jquery.flot.categories.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/global/plugins/jquery-easypiechart/jquery.easypiechart.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/global/plugins/jquery.sparkline.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/global/plugins/jqvmap/jqvmap/jquery.vmap.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.russia.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.world.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.europe.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.germany.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.usa.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/global/plugins/jqvmap/jqvmap/data/jquery.vmap.sampledata.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/global/plugins/bootstrap-select/js/bootstrap-select.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/global/plugins/jquery-multi-select/js/jquery.multi-select.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/global/plugins/select2/js/select2.full.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js" type="text/javascript"></script>
<!-- <script src="<?php echo base_url(); ?>assets/global/plugins/jquery-ui/jquery-ui.min.js" type="text/javascript"></script> -->
<script src="<?php echo base_url(); ?>assets/global/scripts/app.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/global/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/global/plugins/jquery-minicolors/jquery.minicolors.min.js" type="text/javascript"></script>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="<?php echo base_url(); ?>assets/global/plugins/bootstrap-select/js/bootstrap-select.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/pages/scripts/components-bootstrap-select.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/pages/scripts/dashboard.min.js" type="text/javascript"></script>

<script type="text/javascript"> var suffix = '<?php echo json_encode(array("me","spouse")); ?>'; var paction ='<?php echo $this->uri->segment(2) ? $this->uri->segment(2) : ''; ?>'; 
 <?php  if($this->uri->segment(3) && $this->uri->segment(3) != ''){ ?>
  var encid = "<?php echo $this->uri->segment(3); ?>"; 
  <?php }else{ ?>
    var encid = 0; 
    <?php } ?>
 var enc ='<?php echo $this->uri->segment(2) ? $this->uri->segment(2) : ''; ?>' </script>
<script src="<?php echo base_url(); ?>assets/custom/js/admin_user_form.js" type="text/javascript"></script>

<script src="<?php echo base_url(); ?>assets/pages/scripts/components-color-pickers.min.js" type="text/javascript"></script>
<!-- END PAGE LEVEL SCRIPTS -->
<!-- BEGIN THEME LAYOUT SCRIPTS -->
<script src="<?php echo base_url(); ?>assets/layouts/layout5/scripts/layout.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/layouts/global/scripts/quick-sidebar.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/layouts/global/scripts/quick-nav.min.js" type="text/javascript"></script>
<!-- END THEME LAYOUT SCRIPTS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="assets/pages/scripts/form-samples.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/custom/js/role_management.js" type="text/javascript"></script>
        
<!-- END PAGE LEVEL SCRIPTS -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script src="<?php echo base_url(); ?>assets/global/plugins/bootstrap-wysihtml5/wysihtml5-0.3.0.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/global/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/global/plugins/bootstrap-markdown/lib/markdown.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/global/plugins/bootstrap-markdown/js/bootstrap-markdown.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/global/plugins/bootstrap-summernote/summernote.min.js" type="text/javascript"></script>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="<?php echo base_url(); ?>assets/pages/scripts/components-editors.min.js" type="text/javascript"></script>
<!-- END PAGE LEVEL SCRIPTS -->



  <script>
$(document).ready(function(){
  $("#au_basic_sal,#au_sal_basic_percent,#au_sal_bonus_res,#au_sal_basic_res,#au_sal_hra_res,#au_sal_hra_percent,#au_sal_wash_percent,#au_sal_bonus_percent,#au_sal_esic,#au_sal_pf,#au_sal_add_perform,#au_sal_12_leaves,#au_sal_ctc_pm,#au_sal_ctc_py").blur(function(){
    var au_basic_sal=$('#au_basic_sal').val();
    var au_sal_basic_percent=$('#au_sal_basic_percent').val();
    var basic_value = au_basic_sal*(au_sal_basic_percent/100);    
    $('#au_sal_basic_res').val(basic_value);
    var basic_result =$('#au_sal_basic_res').val();

    var au_sal_hra_percent=$('#au_sal_hra_percent').val();    
    $('#au_sal_hra_res').val(au_basic_sal*(au_sal_hra_percent/100));
    var au_sal_wash_percent=$('#au_sal_wash_percent').val();
    $('#au_sal_wash_res').val(au_basic_sal*(au_sal_wash_percent/100));
    var au_sal_bonus_percent=$('#au_sal_bonus_percent').val();    
    $('#au_sal_bonus_res').val(au_basic_sal*(au_sal_bonus_percent/100));

    if(au_basic_sal <= 21000){
      var au_sal_esic=$('#au_sal_esic').val(); 
      $('#au_sal_esic').val(au_basic_sal*(6.5/100));
    }else{
      $('#au_sal_esic').val(0);
    }
    if(basic_result <= 15000){
      var au_sal_pf=$('#au_sal_pf').val();    
    $('#au_sal_pf').val(basic_result*(25/100));
    }else{
      $('#au_sal_pf').val(0);
    }

     var au_sal_add_perform=$('#au_sal_add_perform').val();    
    $('#au_sal_add_perform').val(au_basic_sal/12);

     var au_sal_12_leaves=$('#au_sal_12_leaves').val();    
    $('#au_sal_12_leaves').val(au_basic_sal/30);

    var au_sal_ctc_pm=$('#au_sal_ctc_pm').val();    
  $('#au_sal_ctc_pm').val(parseInt(au_basic_sal)+parseInt(au_sal_add_perform)+parseInt(au_sal_12_leaves));

    var au_sal_ctc_py=$('#au_sal_ctc_py').val();    
    $('#au_sal_ctc_py').val(au_sal_ctc_pm*12);
  });    

});
</script>
