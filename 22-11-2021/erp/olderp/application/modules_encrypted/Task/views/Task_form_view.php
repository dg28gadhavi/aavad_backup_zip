<!-- BEGIN PAGE LEVEL PLUGINS -->
<link href="<?php echo base_url(); ?>assets/global/plugins/bootstrap-select/css/bootstrap-select.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url(); ?>assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url(); ?>assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url(); ?>assets/global/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url(); ?>assets/global/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url(); ?>assets/global/plugins/clockface/css/clockface.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/search/css/jquery-ui.css">
 <!-- BEGIN PAGE LEVEL PLUGINS -->
<link href="<?php echo base_url(); ?>assets/global/plugins/jquery-multi-select/css/multi-select.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url(); ?>assets/global/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url(); ?>assets/global/plugins/select2/css/select2-bootstrap.min.css" rel="stylesheet" type="text/css" />
<!-- BEGIN THEME GLOBAL STYLES -->
<link href="<?php echo base_url(); ?>assets/global/css/components.min.css" rel="stylesheet" id="style_components" type="text/css" />
<link href="<?php echo base_url(); ?>assets/global/css/plugins.min.css" rel="stylesheet" type="text/css" />
<!-- END THEME GLOBAL STYLES -->
<!-- END PAGE LEVEL PLUGINS -->
<div class="container-fluid">
    <div class="page-content">
<!-- BEGIN BREADCRUMBS -->
        <div class="breadcrumbs">
            <h1>Task Ticket Add</h1>
            <ol class="breadcrumb">
                <li>
                    <a href="<?php echo base_url(); ?>Dashboard">Dashboard</a>
                </li>
                <li class="active">
                    <a href="<?php echo base_url(); ?>Task/Task_report">Task Report</a>
                </li>
                <li class="active">
                    <a href="<?php echo base_url(); ?>Task/add">Task Add</a>
                </li>
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
        </div>
         <?php if($this->input->post()){ ?>
            <div class="col-md-12 col-xs-6"><div class="alert alert-danger">
            <strong><?php echo $this->session->flashdata('error'); echo validation_errors();?></strong> 
            </div></div>
            </div>
            <?php } ?>
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
                        <?php $Tasks = array('class' => 'form-horizontal','autocomplete' => 'off');
                        echo form_open_multipart($action,$Tasks); ?>
                            <div class="form-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group" id="mcna_namegr">
                                            <label class="control-label col-md-3">Ticket No</label>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control" placeholder="Ticket No" name="task_ticketno" maxlength="200" tabindex="1" id="task_ticketno" value="<?php echo !$this->uri->segment(3) && isset($st_code) ? $st_code : ''; ?><?php echo isset($list[0]['task_ticketno']) ? $list[0]['task_ticketno'] : ""; ?>"readonly >
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group" id="mcna_namegr">
                                            <label class="control-label col-md-3">Alloted  To</label>
                                            <div class="col-md-9">
                                                <?php $uid = encrypt_decrypt('decrypt', $this->session->userdata['miconlogin']['userid']); ?>
                                                <select name="task_attendedby" tabindex="2" id="task_attendedby" class="bs-select form-control itmchange" data-live-search="true" data-size="8">
                                                    <option value="0">Select</option>
                                                    <?php  foreach($admins as $vendor) {?>  <option value="<?php echo $vendor['au_id'];?>" <?php if(isset($list[0]['task_attendedby']) && $list[0]['task_attendedby'] == $vendor['au_id']){ echo "selected";}else if($uid && $uid == $vendor['au_id']) { echo "selected";}?>><?php echo $vendor['au_fname']; ?></option><?php } ?> 
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>
                                <h3 class="form-section">Customer Details</h3>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group required">
                                            <label class="control-label col-md-3">Company Name</label>
                                            <div class="col-md-7">
                                               <input type="text" tabindex="3" class="form-control vendor" placeholder="Customer Name" name="vendor" maxlength="100" id="vendor" value="<?php echo isset($list[0]['vendor']) ? $list[0]['vendor'] : ""; ?>" required="required">

                                               <input type="hidden" name="vendor_id" id="vendor_id" value="<?php echo isset($list[0]['vendor_id']) ? $list[0]['vendor_id'] : ""; ?>">
                                            </div>

                                            <div class="col-md-2">
                                                <a class="btn red" href="<?php echo base_url(); ?>Task/add">RESET</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label col-md-3">Customer Type</label>
                                            <div class="col-md-9">
                                               <select class="form-control" name="task_customer_type" id="task_customer_type">
                                                   <option value="">Select Customer Type</option>
                                                   <?php  foreach($custometyps as $country) {?>  <option value="<?php echo $country['ctype_id'];?>" <?php if(isset($list[0]['task_customer_type']) && $list[0]['task_customer_type'] == $country['ctype_id']){ echo "selected";}?>><?php echo $country['ctype_name']; ?></option><?php } ?> 
                                               </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label col-md-3">Address</label>
                                            <div class="col-md-9">
                                               <textarea name="task_address" id="task_address" class="form-control"><?php echo isset($list[0]['task_address']) ? $list[0]['task_address'] : ""; ?></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group required">
                                            <label class="control-label col-md-3">C/O AAVAD INSTRUMENT</label>
                                            <div class="col-md-9">
                                               <input type="text" tabindex="3" class="form-control vendor" placeholder="C/O AAVAD INSTRUMENT" name="task_co_aavad_ins" maxlength="100" id="task_co_aavad_ins" value="<?php echo isset($list[0]['task_co_aavad_ins']) ? $list[0]['task_co_aavad_ins'] : ""; ?>" required="required">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="control-label col-md-3">Contact Person</label>
                                            <div class="col-md-9">
                                               <input type="text" tabindex="3" class="form-control vendor task_contactperson" placeholder="Contact Person Name" name="task_contactperson[]" maxlength="100" id="task_contactperson1" value="<?php echo isset($list[0]['task_contactperson']) ? $list[0]['task_contactperson'] : ""; ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="control-label col-md-3">Email</label>
                                            <div class="col-md-9">
                                               <input type="text" tabindex="3" class="form-control vendor" placeholder="Email" name="task_email[]" maxlength="100" id="task_email1" value="<?php echo isset($list[0]['task_email']) ? $list[0]['task_email'] : ""; ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="control-label col-md-3">Mobile No</label>
                                            <div class="col-md-9">
                                               <input type="text" tabindex="3" class="form-control vendor" placeholder="Mobile No" name="task_mobile[]" maxlength="100" id="task_mobile1" value="<?php echo isset($list[0]['task_mobile']) ? $list[0]['task_mobile'] : ""; ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="control-label col-md-3">Designation</label>
                                            <div class="col-md-9">
                                               <input type="text" tabindex="3" class="form-control vendor" placeholder="Designation" name="task_designation[]" maxlength="100" id="task_designation1" value="<?php echo isset($list[0]['task_designation']) ? $list[0]['task_designation'] : ""; ?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="contact_addmore">
                                    
                                </div>
                                <div class="row">
                                    <div class="form-group">
                                    <div class="col-md-4 col-md-offset-1">
                                        <input type="hidden" name="hidden_counter" id="hidden_counter"  value="1">
                                        <button type="button" id="add_more_contact" class="btn red">Add More Contact Person <i class="fa fa-plus"></i></button>
                                    </div>
                                    <div class="col-md-6"></div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label col-md-3">Remark</label>
                                            <div class="col-md-9">
                                               <textarea name="task_pastcomment" id="task_pastcomment" class="form-control"><?php echo isset($list[0]['task_pastcomment']) ? $list[0]['task_pastcomment'] : ""; ?></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php if($this->uri->segment(2) == 'add'){ ?>
                                <div class="row" id="add_new_div">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label col-md-3">Add New Customer</label>
                                            <div class="col-md-9">
                                               <input type="radio" name="add_new" value="1"> Yes
                                               <br/>
                                               <input type="radio" name="add_new" value="2" checked="checked"> No
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php } ?>
                                <hr/>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group" id="mcna_namegr">
                                            <label class="control-label col-md-3">Task Type</label>
                                            <div class="col-md-9">
                                                <select name="task_worktype" tabindex="2" id="task_worktype" class="bs-select form-control itmchange" data-live-search="true" data-size="8">
                                                    <option value="0">Select</option>
                                                    <?php  foreach($tasks as $task) {?>  <option value="<?php echo $task['type_of_work_id'];?>" <?php if(isset($list[0]['task_worktype']) && $list[0]['task_worktype'] == $task['type_of_work_id']){ echo "selected";}?>><?php echo $task['type_of_work_name']; ?></option><?php } ?> 
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group" id="mcna_namegr">
                                            <label class="control-label col-md-3">Subject</label>
                                            <div class="col-md-9">
                                                <textarea class="form-control" tabindex="3" name="task_subject" placeholder="Subject" id="task_subject" rows="3"><?php echo isset($list[0]['task_subject']) ? $list[0]['task_subject'] : ""; ?></textarea>
                                                
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group" id="mcna_namegr">
                                            <label class="control-label col-md-3">Location</label>
                                            <div class="col-md-9">
                                                <textarea class="form-control" tabindex="4" name="task_location" placeholder="Location" id="task_location" rows="3"><?php echo isset($list[0]['task_location']) ? $list[0]['task_location'] : ""; ?></textarea>
                                            </div>
                                            </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group" id="mcna_namegr">
                                            <label class="control-label col-md-3">Details</label>
                                            <div class="col-md-9">
                                            <textarea class="form-control" tabindex="5" name="task_details" placeholder="Details" id="task_details" rows="3"><?php echo isset($list[0]['task_details']) ? $list[0]['task_details'] : ""; ?></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row" style="display: none;">
                                    <div class="col-md-6">
                                        <div class="form-group" id="mcna_namegr">
                                            <label class="control-label col-md-3">Task Given By</label>
                                            <div class="col-md-9">
                                                <?php $uid = encrypt_decrypt('decrypt', $this->session->userdata['miconlogin']['userid']); ?>
                                                <select name="task_tackenby" tabindex="6" id="task_tackenby" class="bs-select form-control itmchange" data-live-search="true" data-size="8">
                                                    <option value="0">Select</option>
                                                    <?php  foreach($admins as $vendor) {?>  <option value="<?php echo $vendor['au_id'];?>" <?php if(isset($list[0]['task_tackenby']) && $list[0]['task_tackenby'] == $vendor['au_id']){ echo "selected";}else if($uid && $uid == $vendor['au_id']) { echo "selected";}?>><?php echo $vendor['au_fname']; ?></option><?php } ?> 
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>  
                                
                                <div class="row" style="display: none;">
                                    <div class="col-md-6">
                                        <div class="form-group" id="mcna_namegr">
                                            <label class="control-label col-md-3">Expense</label>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control" placeholder="Expense" name="task_expense" maxlength="200" id="task_expense" tabindex="7" value="<?php echo isset($list[0]['task_expense']) ? $list[0]['task_expense'] : ""; ?>" >
                                            </div>
                                        </div>
                                    </div>
                                    <?php if($this->uri->segment(2) != 'edit') { ?>
                                    <div class="col-md-6">
                                        <div class="form-group" id="mcna_namegr">
                                            <label class="control-label col-md-3">Ticket Status</label>
                                            <div class="col-md-9">
                                                <select name="task_status" tabindex="8" id="task_status" tabindex="22" class="form-control bs-select" <?php if($this->uri->segment(2) && ($this->uri->segment(2) == 'edit')){ echo ' enable '; } ?>>
                                                  <option value="1" <?php if(isset($list[0]['task_status']) && $list[0]['task_status'] == 1){ echo "selected";} ?> <?php if($this->uri->segment(2) && ($this->uri->segment(2) == 'add')){ echo ' selected '; } ?>>Active</option>
                                                  <option value="2" <?php if(isset($list[0]['task_status']) && $list[0]['task_status'] == 2){ echo "selected";}?>>Close</option>
                                                </select>
                                               <!--  <?php //if($this->uri->segment(2) && ($this->uri->segment(2) == 'edit')){ echo ' You can change status from solution section. '; } ?> -->
                                            </div>
                                        </div>
                                    </div>
                                    <?php } ?> 
                                </div>
                            
                            <div class="row" style="display: none;">
                                    <div class="col-md-6">
                                        <div class="col-md-6 col-md-offset-2">
                                            <div class="form-group" id="mcna_namegr">
                                                <label class="control-label col-md-3">Attachment File1</label>
                                                <div class="col-md-9">
                                                   <input type="file" class="form-control-file"  name="task_fileone" maxlength="200" id="task_fileone" multiple="multiple">
                                                   <?php if($this->uri->segment(2) == 'edit') { ?>
                                                     <a class="btn green" href="<?php echo base_url(); ?>uploads/task_fileone/<?php echo $list[0]['task_fileone']; ?>" target="_blank">View File</a>
                                                   <?php } ?>
                                                </div>
                                            </div>
                                        </div>
                                  </div>
                                  <div class="col-md-6">
                                        <div class="col-md-6 col-md-offset-2">
                                            <div class="form-group" id="mcna_namegr">
                                                <label class="control-label col-md-3">Attachment File2</label>
                                                <div class="col-md-9">
                                                   <input type="file" class="form-control-file"  name="task_filetwo" maxlength="200" id="task_filetwo" multiple="multiple">
                                                    <?php if($this->uri->segment(2) == 'edit') { ?>
                                                   <a class="btn green" href="<?php echo base_url(); ?>uploads/task_filetwo/<?php echo $list[0]['task_filetwo']; ?>" target="_blank">View File</a>
                                                    <?php } ?>
                                                </div>
                                            </div>
                                        </div>
                                  </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label col-md-3"></label>
                                                    <div class="col-md-9">
                                                        <div class="input-group">
                                                            <div class="icheck-inline">
                                                              <label>
                                                                    <input type="radio" name="task_type" tabindex="9" class="icheck" value="1" <?php if(isset($list) && $list[0]['task_type'] == 1){ ?> checked="checked" <?php  } if($this->uri->segment(2) && $this->uri->segment(2) == 'add'){ ?> checked="checked" <?php } ?>> Single </label>
                                                              <label>
                                                                   <input type="radio" name="task_type" class="icheck" value="2" <?php if(isset($list) && $list[0]['task_type'] == 2){ ?>checked="checked" <?php  } ?>> Recursive </label>     
                                                            </div>
                                                        </div>
                                                    </div>
                                            </div>
                                    </div>
                                     <div class="col-md-6 monthshow" <?php if($this->uri->segment(2) && $this->uri->segment(2) == 'add'){ ?> style="display:none; <?php }else{ if(isset($list) && $list[0]['task_type'] == 1){ ?> style="display:none; <?php } } ?>">
                                            <div class="form-group">
                                                <label class="col-md-3">Select Months</label>
                                                    <div class="col-md-9">

                                                            <select name="task_recur_month" tabindex="10" id="task_recur_month" class="form-control bs-select" <?php if($this->uri->segment(2) && ($this->uri->segment(2) == 'edit')){ echo ' enable '; } ?>>
                                                              <option value="0">Select Months</option>
                                                              <option value="3" <?php if(isset($list[0]['task_recur_month']) && $list[0]['task_recur_month'] == 3){ echo "selected";} ?> >3</option>
                                                              <option value="6" <?php if(isset($list[0]['task_recur_month']) && $list[0]['task_recur_month'] == 6){ echo "selected";}?>>6</option>
                                                               <option value="9" <?php if(isset($list[0]['task_recur_month']) && $list[0]['task_recur_month'] == 9){ echo "selected";}?>>9</option>
                                                               <option value="12" <?php if(isset($list[0]['task_recur_month']) && $list[0]['task_recur_month'] == 12){ echo "selected";}?>>12</option>
                                                            </select>
                                               
                                                    </div>
                                            </div>
                                    </div>
                                </div>
                                
                                
                                <div class="row">
                                     <?php if($this->uri->segment(2) != 'edit') { ?>
                                    <div class="col-md-6">
                                        <div class="form-group" id="mcna_namegr">
                                            <label class="control-label col-md-3">Task Reminder Date</label>
                                            <div class="col-md-9">
                                                 <input type="text" tabindex="11" class="form-control form-control-inline input-medium date-picker" placeholder="Due Date" name="task_due_date" maxlength="200" id="task_due_date" value="<?php echo isset($list[0]['task_due_date']) ? date("d-m-Y", strtotime($list[0]['task_due_date'])) : date('d-m-Y'); ?>">
                                                
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group" id="mcna_namegr">
                                            <label class="control-label col-md-3">Task Reminder Details</label>
                                            <div class="col-md-9">
                                                <textarea class="form-control" tabindex="12" name="task_rdetails" placeholder="Task Reminder Details" id="task_rdetails" rows="3"><?php echo isset($list[0]['task_rdetails']) ? $list[0]['task_rdetails'] : ""; ?></textarea>
                                                
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label col-md-3">Task Completed</label>
                                            <div class="col-md-9">
                                               <input type="radio" name="task_iscompleted" value="1"> Yes
                                               <br/>
                                               <input type="radio" name="task_iscompleted" value="2" checked="checked"> No
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label col-md-3">Email Send?</label>
                                            <div class="col-md-9">
                                               <input type="radio" name="task_ismailsend" value="1"> Yes
                                               <br/>
                                               <input type="radio" name="task_ismailsend" value="2" checked="checked"> No
                                            </div>
                                        </div>
                                    </div>
                                    <?php  } ?>
                                    <?php if($this->uri->segment(2) == 'edit') { ?>
                                        <div class="col-md-6">
                                            <div class="form-group" id="mcna_namegr">
                                                <label class="control-label col-md-3">Completed Date</label>
                                                <div class="col-md-9">
                                                     <input type="text" tabindex="13" class="form-control form-control-inline input-medium date-picker" placeholder="Due Date" name="task_completed_date" maxlength="200" id="task_completed_date" value="<?php echo  date('d-m-Y'); ?>">
                                                    
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group" id="mcna_namegr">
                                                <label class="control-label col-md-3">Next Followup Date</label>
                                                <div class="col-md-9">
                                                     <input type="text" tabindex="14" class="form-control form-control-inline input-medium date-picker" placeholder="Next Followup Date" name="task_followup_date" maxlength="200" id="task_followup_date" value="<?php if(isset($list[0]['task_recur_month']) && $list[0]['task_recur_month'] != 0)
                                                    {
                                                        $month = $list[0]['task_recur_month'];
                                                      $newdate = strtotime(date("Y-m-d", strtotime($list[0]['task_due_date'])) . "+".$month." months");
                                                         echo isset($list[0]['task_due_date']) ?  date("d-m-Y",$newdate): date('d-m-Y'); } ?>">
                                                     <?php /*
                                                    if(isset($list[0]['task_status']) && $list[0]['task_status'] == 2)
                                                    {
                                                          
                                                    */ ?>                                                    
                                                </div>
                                            </div>
                                        </div>
                                    <?php  } ?>
                                </div>
                            </div>
                            <div class="form-actions">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-md-offset-3 col-md-9">
                                                <button type="submit" class="btn green" tabindex="15" onclick="return ValidateDetails()" ><?php echo $this->input->get('id')?'UPDATE':'SUBMIT'; ?></button>
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
<script src="<?php echo base_url(); ?>assets/layouts/layout/scripts/layout.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/layouts/layout/scripts/demo.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/layouts/global/scripts/quick-sidebar.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/pages/scripts/components-multi-select.min.js" type="text/javascript"></script>
<!-- END PAGE LEVEL SCRIPTS -->
<script src="<?php echo base_url(); ?>assets/global/plugins/bootstrap-tagsinput/bootstrap-tagsinput.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/global/plugins/typeahead/handlebars.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/global/plugins/typeahead/typeahead.bundle.min.js" type="text/javascript"></script>
<!-- START add more SCRIPTS -->

<!-- END add more SCRIPTS -->

<script type="text/javascript">
$(document).ready(function(){
    $('#Task_state').on('change',function(){
        //alert('hiiii');
        var countryID = $(this).val();
      //alert(countryID);
        if(countryID){
            $.ajax({
                type:'POST',
                datatype:'JSON',
                url:base_url+"Task/get_country_from_country",
                data:'state_id='+countryID,
                success:function(data)
                {
                    //alert(response);
                    var opts = $.parseJSON(data);
                    $('#Task_country').empty();
                     $('#Task_country').append('<option value="0" selected>Select State</option>');
                    $.each(opts, function(i, d) {
                    $('#Task_country').append('<option value="' + d.state_id + '">' + d.state_name + '</option>');
                    
                });
                    $('#Task_country').selectpicker('refresh');
                }
            }); 
        }
        else{
            $('#Task_country').html('<option value="">Select country1 first</option>');
        }
    });

    $(document).on('click', '#add_more_contact', function(){
        var str = '';
        var hidden_counter = $('#hidden_counter').val();
        hidden_counter = parseInt(hidden_counter) + 1;
        str += '<div class="row"> <div class="col-md-3"> <div class="form-group"> <label class="control-label col-md-3">Contact Person</label> <div class="col-md-9"> <input type="text" tabindex="3" class="form-control vendor task_contactperson" placeholder="Contact Person Name" name="task_contactperson[]" maxlength="100" id="task_contactperson'+hidden_counter+'" value="" > </div></div></div><div class="col-md-3"> <div class="form-group"> <label class="control-label col-md-3">Email</label> <div class="col-md-9"> <input type="text" tabindex="3" class="form-control vendor" placeholder="Email" name="task_email[]" maxlength="100" id="task_email'+hidden_counter+'" value="" > </div></div></div><div class="col-md-3"> <div class="form-group"> <label class="control-label col-md-3">Mobile No</label> <div class="col-md-9"> <input type="text" tabindex="3" class="form-control vendor" placeholder="Mobile No" name="task_mobile[]" maxlength="100" id="task_mobile'+hidden_counter+'" value="" > </div></div></div><div class="col-md-3"> <div class="form-group"> <label class="control-label col-md-3">Designation</label> <div class="col-md-9"> <input type="text" tabindex="3" class="form-control vendor" placeholder="Designation" name="task_designation[]" maxlength="100" id="task_designation'+hidden_counter+'" value=""> </div></div></div></div>';
        $('#contact_addmore').append(str);
        $('#hidden_counter').val(hidden_counter);
        return false;
    });
});

$("input[name='task_type']").change(function(){
    //alert('hiiii');
    // Do something interesting here
    if($(this).val() == 2){
        $(".monthshow").show();
    }else{
        $(".monthshow").hide();
    }
});
</script>
<script>
  $( function() {
    $("#vendor").autocomplete({
            source: base_url+"Task/get_customer_information",
            minLength: 1,
            html: true,
            select: function( event, ui )
            {
                var itemname = ui.item.label;
                var itemid = ui.item.value;
                //state_lists
               // alert(ui.item.cno);
                $("#task_customer_type ").val(ui.item.ctype);
               $("#task_contactperson").val(ui.item.cperson);
               $("#task_mobile").val(ui.item.cno);
               $("#task_email").val(ui.item.email);
               $('#vendor_id').val(ui.item.vendor_id);
               if(ui.item.vendor_id != '' && ui.item.vendor_id != 0){
                    $('#add_new_div').html('');
               }
                $('#task_contactperson').val(ui.item.contact_person);
               $('#task_address').val(ui.item.address);
               $('#task_pastcomment').val(ui.item.comments);
               $('#task_co_aavad_ins').val(ui.item.aavad_co);
               $('.bs-select').selectpicker('refresh');
            },
            focus: function (a, b)
            {
                return false
            }
    });
    $(document).on("keydown.autocomplete",".task_contactperson",function(e){
        //alert($(this).attr("id"));
    $(this).autocomplete({
            source: function(request, response) {
                //alert($(this.element).prop("id"));
                $.getJSON(base_url+"Sales_enq/get_contactperson_information", { vendor_id : $('#vendor_id').val() , autohid : $(this.element).prop("id") }, 
                          response);
              },
            //source: base_url+"Sales_enq/get_contactperson_information?id="+$('#vendor_id').val(),
            minLength: 1,
            html: true,
            select: function( event, ui )
            {
                //alert(ui.item.autohid);
                var itemname = ui.item.label;
                var itemid = ui.item.value;
                var autohid = ui.item.autohid;
                var str = '';
               $("#task_contactperson"+autohid).val(ui.item.cperson);
               $("#task_mobile"+autohid).val(ui.item.contact_mobile);
               $("#task_email"+autohid).val(ui.item.contact_email);
               //$("#sq_phone").val(ui.item.contact_phone);
               $('#task_address').val(ui.item.contact_address);
               $("#task_designation"+autohid).val(ui.item.contact_designation);
               $('.bs-select').selectpicker('refresh');
            },
            focus: function (a, b)
            {
                return false
            }
    });
    });
    });
  </script>
<!-- END PAGE LEVEL SCRIPTS -->
<?php //theme layout scripts ?>

<script type="text/javascript">
    $('.date-picker').datepicker({
    format: 'dd-mm-yyyy',
});
</script>