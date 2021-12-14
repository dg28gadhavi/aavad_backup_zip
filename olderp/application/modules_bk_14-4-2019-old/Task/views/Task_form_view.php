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
                <li><a href="<?php echo base_url(); ?>Dashborad">Dashboard</a></li>
                <li class="active"><a href="<?php echo base_url(); ?>Task">Task Ticket List</a></li>
                <li><a href="<?php echo base_url(); ?>Task/add">Task Ticket Add</a></li>
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
                                                <input type="text" class="form-control" placeholder="Ticket No" name="task_ticketno" maxlength="200" tabindex="5" id="task_ticketno" value="<?php echo !$this->uri->segment(3) && isset($st_code) ? $st_code : ''; ?><?php echo isset($list[0]['task_ticketno']) ? $list[0]['task_ticketno'] : ""; ?>"readonly >
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group" id="mcna_namegr">
                                            <label class="control-label col-md-3">Subject</label>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control" placeholder="Subject" name="task_subject" maxlength="200" id="task_subject" tabindex="3" value="<?php echo isset($list[0]['task_subject']) ? $list[0]['task_subject'] : ""; ?>" >
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
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
                                            <textarea class="form-control" tabindex="7" name="task_details" placeholder="Details" id="task_details" rows="3"><?php echo isset($list[0]['task_details']) ? $list[0]['task_details'] : ""; ?></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
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
                                    <div class="col-md-6">
                                        <div class="form-group" id="mcna_namegr">
                                            <label class="control-label col-md-3">Alloted  To</label>
                                            <div class="col-md-9">
                                                <?php $uid = encrypt_decrypt('decrypt', $this->session->userdata['miconlogin']['userid']); ?>
                                                <select name="task_attendedby" tabindex="9" id="task_attendedby" class="bs-select form-control itmchange" data-live-search="true" data-size="8">
                                                    <option value="0">Select</option>
                                                    <?php  foreach($admins as $vendor) {?>  <option value="<?php echo $vendor['au_id'];?>" <?php if(isset($list[0]['task_attendedby']) && $list[0]['task_attendedby'] == $vendor['au_id']){ echo "selected";}else if($uid && $uid == $vendor['au_id']) { echo "selected";}?>><?php echo $vendor['au_fname']; ?></option><?php } ?> 
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>  
                                
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group" id="mcna_namegr">
                                            <label class="control-label col-md-3">Expense</label>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control" placeholder="Expense" name="task_expense" maxlength="200" id="task_expense" tabindex="3" value="<?php echo isset($list[0]['task_expense']) ? $list[0]['task_expense'] : ""; ?>" >
                                            </div>
                                        </div>
                                    </div>
                                    <?php if($this->uri->segment(2) != 'edit') { ?>
                                    <div class="col-md-6">
                                        <div class="form-group" id="mcna_namegr">
                                            <label class="control-label col-md-3">Ticket Status</label>
                                            <div class="col-md-9">
                                                <select name="task_status" tabindex="10" id="task_status" tabindex="22" class="form-control bs-select" <?php if($this->uri->segment(2) && ($this->uri->segment(2) == 'edit')){ echo ' enable '; } ?>>
                                                  <option value="1" <?php if(isset($list[0]['task_status']) && $list[0]['task_status'] == 1){ echo "selected";} ?> <?php if($this->uri->segment(2) && ($this->uri->segment(2) == 'add')){ echo ' selected '; } ?>>Active</option>
                                                  <option value="2" <?php if(isset($list[0]['task_status']) && $list[0]['task_status'] == 2){ echo "selected";}?>>Close</option>
                                                </select>
                                               <!--  <?php //if($this->uri->segment(2) && ($this->uri->segment(2) == 'edit')){ echo ' You can change status from solution section. '; } ?> -->
                                            </div>
                                        </div>
                                    </div>
                                    <?php } ?> 
                                </div>
                            
                            <div class="row">
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
                            <br/><br/>
                                <div class="row">
                                    <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label col-md-3"></label>
                                                    <div class="col-md-9">
                                                        <div class="input-group">
                                                            <div class="icheck-inline">
                                                              <label>
                                                                    <input type="radio" name="task_type" tabindex="17" class="icheck" value="1" <?php if(isset($list) && $list[0]['task_type'] == 1){ ?> checked="checked" <?php  } ?>> Single </label>
                                                              <label>
                                                                   <input type="radio" name="task_type" class="icheck" value="2" <?php if(isset($list) && $list[0]['task_type'] == 2){ ?>checked="checked" <?php  } ?>> Recursive </label>     
                                                            </div>
                                                        </div>
                                                    </div>
                                            </div>
                                    </div>
                                     <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="col-md-3">Select Months</label>
                                                    <div class="col-md-9">

                                                            <select name="task_recur_month" tabindex="10" id="task_recur_month" tabindex="22" class="form-control bs-select" <?php if($this->uri->segment(2) && ($this->uri->segment(2) == 'edit')){ echo ' enable '; } ?>>
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
                                                 <input type="text" tabindex="2" class="form-control form-control-inline input-medium date-picker" placeholder="Due Date" name="task_due_date" maxlength="200" id="task_due_date" value="<?php echo isset($list[0]['task_due_date']) ? date("d-m-Y", strtotime($list[0]['task_due_date'])) : date('d-m-Y'); ?>">
                                                
                                            </div>
                                        </div>
                                    </div>
                                    <?php  } ?>
                                    <?php if($this->uri->segment(2) == 'edit') { ?>
                                        <div class="col-md-6">
                                            <div class="form-group" id="mcna_namegr">
                                                <label class="control-label col-md-3">Completed Date</label>
                                                <div class="col-md-9">
                                                     <input type="text" tabindex="2" class="form-control form-control-inline input-medium date-picker" placeholder="Due Date" name="task_completed_date" maxlength="200" id="task_completed_date" value="<?php echo  date('d-m-Y'); ?>">
                                                    
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group" id="mcna_namegr">
                                                <label class="control-label col-md-3">Next Followup Date</label>
                                                <div class="col-md-9">
                                                     <input type="text" tabindex="2" class="form-control form-control-inline input-medium date-picker" placeholder="Next Followup Date" name="task_followup_date" maxlength="200" id="task_followup_date" value="<?php if(isset($list[0]['task_recur_month']) && $list[0]['task_recur_month'] != 0)
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
                                                <button type="submit" class="btn green" tabindex="12" onclick="return ValidateDetails()" ><?php echo $this->input->get('id')?'UPDATE':'SUBMIT'; ?></button>
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
});
</script>
<script>
  $( function() {
    $("#st_coname").autocomplete({
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
               $("#st_email").val(ui.item.email);
               $("#sq_phone").val(ui.item.phone);
               $("#sq_website").val(ui.item.webaddr);
               $('#sq_address').val(ui.item.address);
               $('.bs-select').selectpicker('refresh');
            },
            focus: function (a, b)
            {
                return false
            }
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