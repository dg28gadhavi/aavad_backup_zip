<?php //<!-- ********************************* CSS Files ******************************** --> ?>
<?php //echo "<pre>";print_r($list);die; 
//$adminid= $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']);

?>
<link href="<?php echo base_url(); ?>assets/custom/bootstrap/css/bootstrap-theme.min.css" rel="stylesheet">
<link href="<?php echo base_url(); ?>assets/custom/bootstrap/css/bootstrap-timepicker.min.css" rel="stylesheet">
<link href="<?php echo base_url(); ?>assets/custom/bootstrap/css/bootstrap-select.min.css" rel="stylesheet" >
<link href="<?php echo base_url(); ?>assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url(); ?>assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url(); ?>assets/global/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url(); ?>assets/global/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url(); ?>assets/global/plugins/clockface/css/clockface.css" rel="stylesheet" type="text/css" />
<!-- BEGIN PAGE LEVEL PLUGINS -->
<link href="<?php echo base_url(); ?>assets/global/plugins/bootstrap-select/css/bootstrap-select.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url(); ?>assets/global/plugins/jquery-multi-select/css/multi-select.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url(); ?>assets/global/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url(); ?>assets/global/plugins/select2/css/select2-bootstrap.min.css" rel="stylesheet" type="text/css" />
<!-- END PAGE LEVEL PLUGINS -->
<link href='<?php echo base_url(); ?>assets/custom/css/fullcalendar/fullcalendar.print.css' rel='stylesheet' media='print' />
		<style type="text/css">
			.fc-time{
				display : none;
			}
		</style>
<?php // <!-- ********************************* CSS Files ******************************** --> ?>
<div class="container-fluid">
   	<div class="page-content">

			<div class="breadcrumbs">
                        <h1>Task</h1>
                        <ol class="breadcrumb">
                            <li>
                                <a href="<?php echo base_url(); ?>Dashboard">Dashboard</a>
                            </li>
                            <li>
                               <a href="<?php echo base_url(); ?>Calendar/tour">Task</a>
                            </li>
                        </ol>
                    </div>
                    <!-- END BREADCRUMBS -->
                    <!-- BEGIN PAGE BASE CONTENT -->
                    <div class="portlet light portlet-fit portlet-space bordered">
                    <div class="row">
                            <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
                                <div class="dashboard-stat2 dashboard-stat3 bordered">
                                    <div class="display">
                                        <div class="number">
                                            <h3 class="font-green-sharp">
                                            <span data-counter="counterup" data-value="<?php echo isset($total_count['completed']['count']) ? number_format($total_count['completed']['count']) : 0;?>"></span>
                                                <small class="font-green-sharp"></small>
                                            </h3>
                                            <a href=""><small>Completed</small></a>
                                        </div>
                                        <div class="icon">
                                            <i class="icon-pie-chart"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
                                <div class="dashboard-stat2 dashboard-stat3 bordered">
                                    <div class="display">
                                        <div class="number">
                                            <h3 class="font-green-sharp">
                                        <span data-counter="counterup" data-value="<?php echo isset($total_count['pending']['count']) ? number_format($total_count['pending']['count']) : 0;?>"></span>
                                                <small class="font-green-sharp"></small>
                                            </h3>
                                            <a href=""><small>Pending</small></a>
                                        </div>
                                        <div class="icon">
                                            <i class="icon-pie-chart"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php $search_task = array('class' => 'form-horizontal','method' => 'get');
                                    echo form_open(base_url().'Calendar/tour',$search_task); ?>
                            <div class="col-lg-8 col-md-8 col-sm-6 col-xs-12">
                                        <?php $typeid = encrypt_decrypt('decrypt', $this->session->userdata['miconlogin']['typeid']);
                                        if(isset($typeid) && ($typeid == 3)){ ?>
                                        <div class="col-md-4" style="display:none;">
                                            <div class="form-group" id="mcna_namegr">
                                                <label class="control-label col-md-4">Assign By</label>
                                                <div class="col-md-8">
                                              <select name="assignby" id="assignby" class="bs-select form-control itmchange" data-live-search="true" data-size="8">
                                                <option value="">Select Executive</option>
                                                <?php $uid = encrypt_decrypt('decrypt', $this->session->userdata['miconlogin']['userid']); ?>
                                                 <?php foreach($assign as $admin) {?>  
                                                    <option value="<?php echo $admin['au_id'];?>" <?php if($this->input->get('assignby') && ($this->input->get('assignby') != '') && ($this->input->get('assignby') == $admin['au_id'])){ ?> selected <?php } ?> ><?php echo $admin['au_fname'].' '.$admin['au_lname']; ?></option><?php } ?> 
                                                </select>
                                                </div>
                                            </div>
                                        </div>
                                        <?php } ?>
                                        <div class="col-md-4">
                                            <div class="form-group" id="mcna_namegr">
                                                <label class="control-label col-md-4">Assign to</label>
                                                <div class="col-md-8">
                                                    <select name="assignto" id="assignto" class="bs-select form-control itmchange" data-live-search="true" data-size="8" tabindex="4">
                                                    <option value="">Assign To</option>
                                                  <?php  foreach($assign as $ass) {?>  <option value="<?php echo $ass['au_id'];?>" <?php if($this->input->get('assignto') && ($this->input->get('assignto') != '') && ($this->input->get('assignto') == $ass['au_id'])){ ?> selected <?php } ?>><?php echo $ass['au_fname'].' '.$ass['au_lname'];; ?></option><?php } ?>
                                                </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group" id="mcna_namegr">
                                                <label class="control-label col-md-4">Priority</label>
                                                <div class="col-md-8"> 
                                                    <select name="priority" id="priority" class="bs-select form-control itmchange" data-live-search="true" data-size="8" tabindex="4">
                                                    <option value="">Priority</option>
                                                    <option value="1" <?php if($this->input->get('priority') && ($this->input->get('priority') != '') && ($this->input->get('priority') == 1)){ echo "selected";}?>>High</option>
                                                    <option value="2" <?php if($this->input->get('priority') && ($this->input->get('priority') != '') && ($this->input->get('priority') == 2)){ echo "selected";}?>>Medium</option>
                                                    <option value="3" <?php if($this->input->get('priority') && ($this->input->get('priority') != '') && ($this->input->get('priority') == 3)){ echo "selected";}?>>Low</option>
                                                </select>
                                                
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group" id="mcna_namegr">
                                                <label class="control-label col-md-4">Completed</label>
                                                <div class="col-md-8"> 
                                                    <select name="completed" id="completed" class="bs-select form-control itmchange" data-live-search="true" data-size="8" tabindex="4">
                                                    <option value="">All</option>
                                                    <option value="2" <?php if($this->input->get('completed') && ($this->input->get('completed') != '') && ($this->input->get('completed') == 2)){ echo "selected";}?>>No</option>
                                                    <option value="1" <?php if($this->input->get('completed') && ($this->input->get('completed') != '') && ($this->input->get('completed') == 1)){ echo "selected";}?>>Yes</option>
                                                </select>
                                                
                                                </div>
                                            </div>
                                        </div>
                                        <br></br>
                                        
                                        <div class="col-md-4">
                                            <div class="form-group" id="mcna_namegr">
                                                <label class="control-label col-md-4">Task Type</label>
                                                <div class="col-md-8">
                                                    <select name="task_type" id="task_type" class="bs-select form-control itmchange" data-live-search="true" data-size="8" tabindex="4">
                                                    <option value="">Task Type</option>
                                                  <?php  foreach($task_type as $t_type) {?>  <option value="<?php echo $t_type['task_id'];?>" <?php if($this->input->get('task_type') && $this->input->get('task_type') == $t_type['task_id']){ echo "selected";}?>><?php echo $t_type['task_name']; ?></option><?php } ?>
                                                </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group" id="mcna_namegr">
                                                <label class="control-label col-md-4">State</label>
                                                <div class="col-md-8">
                                                    <input class="form-control" placeholder="State" name="place" maxlength="200" id="place" value="<?php echo $this->input->get('place') ? $this->input->get('place') : ''; ?>" type="text">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group" id="mcna_namegr">
                                                <label class="control-label col-md-4">City</label>
                                                <div class="col-md-8">
                                                    <input class="form-control" placeholder="City" name="city" maxlength="200" id="city" value="<?php echo $this->input->get('city') ? $this->input->get('city') : ''; ?>" type="text">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group" id="mcna_namegr">
                                                <label class="control-label col-md-4">Customer Name</label>
                                                <div class="col-md-8">
                                                    <input class="form-control" placeholder="Customer Name" name="customer_name" maxlength="200" id="customer_name" value="<?php echo $this->input->get('customer_name') ? $this->input->get('customer_name') : ''; ?>" type="text">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group" id="mcna_namegr">
                                                <label class="control-label col-md-4">Task Desc</label>
                                                <div class="col-md-8">
                                                    <input class="form-control" placeholder="Task Desc" name="text_desc" maxlength="200" id="text_desc" value="<?php echo $this->input->get('text_desc') ? $this->input->get('text_desc') : ''; ?>" type="text">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group" id="mcna_namegr">
                                                <label class="control-label col-md-4">Remark</label>
                                                <div class="col-md-8">
                                                    <input class="form-control" placeholder="Remark" name="remark" maxlength="200" id="remark" value="<?php echo $this->input->get('remark') ? $this->input->get('remark') : ''; ?>" type="text">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group" id="mcna_namegr">
                                                <label class="control-label col-md-4">Follow Date</label>
                                                <div class="col-md-8">
                                                    <input class="form-control form-control-inline input-medium date-picker" placeholder="Follow Date" name="follow_date" maxlength="200" id="follow_date" value="<?php echo $this->input->get('follow_date') ? $this->input->get('follow_date') : ''; ?>" type="text">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">                                            
                                                <button class="btn green" type="submit" >Submit</button>                                            
                                        </div>
                                        <div class="col-md-4">     

                                        <a class="btn red" href="<?php echo base_url(); ?>Calendar/tour">RESET</a>                                  
                                        </div>
                                        
                            </div>
                            <?php echo form_close(); ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="portlet light portlet-fit bordered calendar">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class=" icon-layers font-green"></i>
                                        <span class="caption-subject font-green sbold uppercase">Task Management</span>
                                    </div>
                                </div>
                                
                                <div class="portlet-body">
                                    <div class="row">
                                        <div class="col-md-3 col-sm-12">
                                            <!-- BEGIN DRAGGABLE EVENTS PORTLET-->
                                            <h3 class="margin-bottom-20" id="sidebarheading">Today Task </h3>
                                            <div id="external-events">
                                                <form class="inline-form">
                                                   <a href="javascript:;" id="event_add" style="display:none;" class="btn green"> Add Event </a>
                                                </form>
                                                <hr/>
                                                <div id="event_box" class="margin-bottom-10">
                                                <?php //echo date('Y-m-d'); //echo '<pre>'; print_r($list);date("NOW") ?>
                                                <?php $i = 1; foreach($list as $ls) { echo "("."$i".")"; $i++;//echo '<pre>'; print_r($ls); ?>
                                                <div> Customer Name : <?php echo $ls['wt_customer']; ?></div>
                                                <div> City : <?php echo $ls['wt_city']; ?></div>
                                                <div> Remark : <?php echo $ls['wt_remark']; ?></div>
                                                <div> Start date : <?php echo date("d-m-Y s:i:h", strtotime($ls['wt_startdate'])); ?></div>
                                                <div> End date : <?php echo date("d-m-Y s:i:h", strtotime($ls['wt_enddate'])); ?></div> <hr/>
                                                <?php } ?>  
                                                </div>
                                                <label for="drop-remove"></label>
                                                    <!-- <input type="checkbox" id="drop-remove" />remove after drop </label> -->
                                                <hr class="visible-xs" /> </div>
                                            <!-- END DRAGGABLE EVENTS PORTLET-->
                                        </div>
                                        <div class="col-md-9 col-sm-12">
                                            <div id="calendar" class="has-toolbar"> </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

					<div id="createEventModal" class="modal fade">
						<div class="modal-dialog modal-dialog-box">
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
									<h4 class="modal-title"><strong>Visit Planning Schedule</strong></h4>
									
								</div>

							<div class="modal-body model-body-box">
								<form id="createAppointmentForm" class="form-horizontal">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label class="control-label col-md-3">Start Time</label>
                                                <div class="col-md-9">
        			                        <div class="controls" >
        			                            <div class="bootstrap-timepicker input-append">
        			                                <input id="timepicker4" type="text" value="11:00 AM" class="form-control input-small">
        			                                <span class="add-on"><i class="icon-time"></i></span>
        			                                <input type="hidden" id="apptDay"/>
        			                                <input type="hidden" id="apptTime" value="11:21 AM" />
        			                                <input type="hidden" id="apptId"/>
        			                            </div>
        			                        </div>
                                        </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="control-label col-md-3">End Time</label>
                                                <div class="col-md-9">
        			                        <div class="controls" >
        			                            <div class="bootstrap-timepicker input-append">
        			                                <input id="end_time" type="text" value="12:00 PM" class="form-control input-small">
        			                                <span class="add-on"><i class="icon-time"></i></span>
        			                                <input type="hidden" id="apptEDay"/>
        			                                <input type="hidden" id="apptETime" value="12:00 PM" />
        			                                <input type="hidden" id="apptEId"/>
        			                            </div>
        			                        </div>
                                        </div>
                                    </div>
                                    </div>
								    <div class="row">
								    	<div class="col-md-6"style="display:none;">
	                                        <div class="form-group" id="mcna_namegr">
	                                            <label class="control-label col-md-3">Assign By</label>
	                                            <div class="col-md-9">
	                                          <select name="wt_assignby" id="wt_assignby" class="bs-select form-control itmchange" data-live-search="true" data-size="8">
						                        <option value="">Select Executive</option>
						                        <?php $uid = encrypt_decrypt('decrypt', $this->session->userdata['miconlogin']['userid']); ?>
						                         <?php foreach($assign as $admin) {?>  
						                            <option value="<?php echo $admin['au_id'];?>" <?php if(isset($uid) && $uid == $admin['au_id']){ echo "selected";}?>><?php echo $admin['au_fname'].' '.$admin['au_lname']; ?></option><?php } ?> 
						                        </select>
	                                            </div>
	                                        </div>
	                                    </div>
	                                    <div class="col-md-6"style="display:none;">
	                                        <div class="form-group" id="mcna_namegr">
	                                            <label class="control-label col-md-3">Assign Date</label>
	                                            <div class="col-md-9">
	                                                <input class="form-control form-control-inline input-medium date-picker" placeholder="Assign Date" name="wt_assigndate" maxlength="200" id="wt_assigndate" value="" type="text">
	                                            </div>
	                                        </div>
	                                    </div>
	                                    <div class="col-md-6">
	                                        <div class="form-group" id="mcna_namegr">
	                                            <label class="control-label col-md-3">Assign to</label>
	                                            <div class="col-md-9">
	                                            	<select name="wt_assignto" id="wt_assignto" class="bs-select form-control itmchange" data-live-search="true" data-size="8" tabindex="4">
                                                    <option value="">Assign To</option>
                                                  <?php  foreach($assign as $ass) {?>  <option value="<?php echo $ass['au_id'];?>" <?php if(isset($list[0]['wt_assignto']) && $list[0]['wt_assignto'] == $ass['au_id']){ echo "selected";}?>><?php echo $ass['au_fname'].' '.$ass['au_lname'];; ?></option><?php } ?>
                                                </select>
	                                            </div>
	                                        </div>
	                                    </div>
	                                    <div class="col-md-6">
	                                        <div class="form-group" id="mcna_namegr">
	                                            <label class="control-label col-md-3">Priority</label>
	                                            <div class="col-md-9"> 
	                                            	<select name="wt_priority" id="wt_priority" class="bs-select form-control itmchange" data-live-search="true" data-size="8" tabindex="4">
                                                    <option value="">Priority</option>
                                                    <option value="1" >High</option>
                                                    <option value="2" >Medium</option>
                                                    <option value="3" >Low</option>
                                                </select>
                                                
	                                            </div>
	                                        </div>
	                                    </div>
	                                    <div class="col-md-6">
	                                        <div class="form-group" id="mcna_namegr">
	                                            <label class="control-label col-md-3">Task Type</label>
	                                            <div class="col-md-9">
	                                                <select name="wt_task_type" id="wt_task_type" class="bs-select form-control itmchange" data-live-search="true" data-size="8" tabindex="4">
                                                    <option value="">Customer Type</option>
                                                  <?php  foreach($task_type as $country) {?>  <option value="<?php echo $country['task_id'];?>" <?php if(isset($list[0]['wt_task_type']) && $list[0]['wt_task_type'] == $country['task_id']){ echo "selected";}?>><?php echo $country['task_name']; ?></option><?php } ?>
                                                </select>
	                                            </div>
	                                        </div>
	                                    </div>
	                                    <div class="col-md-6">
	                                        <div class="form-group" id="mcna_namegr">
	                                            <label class="control-label col-md-3">State</label>
	                                            <div class="col-md-9">
	                                                <input class="form-control" placeholder="State" name="wt_place" maxlength="200" id="wt_place" value="" type="text">
	                                            </div>
	                                        </div>
	                                    </div>
	                                    <div class="col-md-6">
	                                        <div class="form-group" id="mcna_namegr">
	                                            <label class="control-label col-md-3">Accomplished By Date</label>
	                                            <div class="col-md-9">
	                                                <input class="form-control form-control-inline input-medium date-picker" placeholder="Accomplished By Date" name="wt_acc_date" maxlength="200" id="wt_acc_date" value="" type="text">
	                                            </div>
	                                        </div>
	                                    </div>	                                    
	                                    <div class="col-md-6">
	                                        <div class="form-group" id="mcna_namegr">
	                                            <label class="control-label col-md-3">City</label>
	                                            <div class="col-md-9">
	                                                <input class="form-control" placeholder="City" name="wt_city" maxlength="200" id="wt_city" value="" type="text">
	                                            </div>
	                                        </div>
	                                    </div>
	                                    <div class="col-md-6">
	                                        <div class="form-group" id="mcna_namegr">
	                                            <label class="control-label col-md-3">Customer Name</label>
	                                            <div class="col-md-9">
	                                                <input class="form-control" placeholder="Customer" name="wt_customer" maxlength="200" id="wt_customer" value="" type="text">
	                                            </div>
	                                        </div>
	                                    </div>
	                                    <div class="col-md-6">
	                                        <div class="form-group" id="mcna_namegr">
	                                            <label class="control-label col-md-3">Task Description</label>
	                                            <div class="col-md-9">
	                                                <textarea name="wt_description" id="wt_description" class="form-control"></textarea>
	                                            </div>
	                                        </div>
	                                    </div>
	                                    <div class="col-md-6">
	                                        <div class="form-group" id="mcna_namegr">
	                                            <label class="control-label col-md-3">Remark</label>
	                                            <div class="col-md-9">
	                                                <textarea name="wt_remark" id="wt_remark" class="form-control"></textarea>
	                                            </div>
	                                        </div>
	                                    </div>
	                                    <div class="col-md-6">
	                                        <div class="form-group" id="mcna_namegr">
	                                            <label class="control-label col-md-3">Expense</label>
	                                            <div class="col-md-9">
	                                                <input class="form-control" placeholder="Expense" name="wt_expense" maxlength="200" id="wt_expense" value="" type="text">
	                                            </div>
	                                        </div>
	                                    </div>
	                                    <div class="col-md-6">
	                                        <div class="form-group" id="mcna_namegr">
	                                            <label class="control-label col-md-3">Followup Date</label>
	                                            <div class="col-md-9">
	                                                <input class="form-control form-control-inline input-medium date-picker" placeholder="Followup Date" name="wt_follow_date" maxlength="200" id="wt_follow_date" value="" type="text">
	                                            </div>
	                                        </div>
	                                    </div>
	                                    <div class="col-md-6">
	                                        <div class="form-group" id="mcna_namegr">
	                                            <label class="control-label col-md-3">Completed</label>
	                                            <div class="col-md-9"> 
	                                            	<select name="wt_completed" id="wt_completed" class="bs-select form-control itmchange" data-live-search="true" data-size="8" tabindex="4">
                                                    <option value="2">No</option>
                                                    <option value="1">Yes</option>
                                                </select>
                                                
	                                            </div>
	                                        </div>
	                                    </div>
                                        <div class="col-md-6">
                                            <div class="form-group" id="mcna_namegr">
                                                <label class="control-label col-md-3">Attachment</label>
                                                <div class="col-md-9">
                                                   <input type="file" class="form-control-file"  name="files[]" maxlength="200" id="wt_attch" multiple="multiple">

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div id="attachement_show"></div>
                                        </div>
                                    </div>								    
								</form>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
								<button type="submit" class="btn btn-primary" id="submitButton">Save Availability</button>
							</div>
							</div>
						</div>
					</div>


					<div id="DelEventModal" class="modal fade delModel">
					<div class="modal-dialog">
					<div class="modal-content">
					<div class="modal-header">
					<h4 class="modal-title">Are you sure want to delete this Appoitment Availability?</h4>
					</div>
					<div class="modal-footer">
					<button type="button" class="btn btn-primary" data-dismiss="modal">No</button>
					<button type="submit" class="btn btn-danger" id="submitDelYes">Yes</button>
					</div>
					</div>
					</div>
					</div>

					<input type="hidden" id="evt_id">
					<input type="hidden" id="evt_date">
					<input type="hidden" id="evt_Edate">
					<input type="hidden" id="practice_id">

					<div id="ConfirmEventModal" class="modal fade delModel">
					<div class="modal-dialog">
					<div class="modal-content">
					<div class="modal-header">
					<h4 class="modal-title">Choose Action</h4>
					</div>
					<div class="modal-footer">
					<button type="button" class="btn btn-primary" id="open_edit_submit">Edit</button>
					<button type="button" class="btn btn-danger" id="open_del_submit">Delete</button>
					<button type="submit" class="btn btn-default" data-dismiss="modal">Cancel</button>
					</div>
					</div>
					</div>
					</div>

					<div id="AlertEventModal" class="modal fade delModel">
					<div class="modal-dialog">
					<div class="modal-content">
					<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title">Appointment has been already assinged for this Timeslot.</h4>
					</div>
					<div class="modal-footer">
					<button type="submit" class="btn btn-default" data-dismiss="modal">Close</button>
					</div>
					</div>
					</div>
					</div>
                    <!-- END PAGE BASE CONTENT -->

</div>
</div>
                
<!-- END CONTENT -->
<!--[if lt IE 9]>
<script src="<?php echo base_url(); ?>assets/global/plugins/respond.min.js"></script>
<script src="<?php echo base_url(); ?>assets/global/plugins/excanvas.min.js"></script> 
<![endif]-->
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
        <script src="<?php echo base_url(); ?>assets/global/plugins/moment.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>assets/global/plugins/fullcalendar/fullcalendar.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>assets/global/plugins/jquery-ui/jquery-ui.min.js" type="text/javascript"></script>
        <!-- END PAGE LEVEL PLUGINS -->
        <!-- BEGIN THEME GLOBAL SCRIPTS -->
        <script src="<?php echo base_url(); ?>assets/global/scripts/app.min.js" type="text/javascript"></script>

        <script src="<?php echo base_url(); ?>assets/global/plugins/morris/morris.min.js" type="text/javascript"></script>

        <script src="<?php echo base_url(); ?>assets/global/plugins/morris/raphael-min.js" type="text/javascript"></script>

        <script src="<?php echo base_url(); ?>assets/global/plugins/counterup/jquery.waypoints.min.js" type="text/javascript"></script>

        <script src="<?php echo base_url(); ?>assets/global/plugins/counterup/jquery.counterup.min.js" type="text/javascript"></script>

        
        <!-- END THEME GLOBAL SCRIPTS -->
        <!-- BEGIN PAGE LEVEL SCRIPTS -->
        <script src="<?php echo base_url(); ?>assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>assets/global/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>assets/global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>assets/pages/scripts/components-date-time-pickers.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>assets/custom/js/admin_user_form.js" type="text/javascript"></script>
  <!-- BEGIN PAGE LEVEL PLUGINS -->
<script src="<?php echo base_url(); ?>assets/global/scripts/datatable.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/global/plugins/datatables/datatables.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/global/plugins/bootstrap-select/js/bootstrap-select.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/global/plugins/jquery-multi-select/js/jquery.multi-select.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/global/plugins/select2/js/select2.full.min.js" type="text/javascript"></script>
<!-- END PAGE LEVEL PLUGINS -->
        <?php //******************************************************************************** ?>
		<?php //<!-- ********************************* JS Files ******************************** --> ?>
		<!-- Bootstrap files  -->
    <script src="<?php echo base_url(); ?>assets/custom/bootstrap/js/bootstrap-timepicker.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/custom/bootstrap/js/bootstrap-select.min.js"></script>
    <!-- Bootstrap files -->
    	<?php //<!-- ********************************* JS Files ******************************** --> ?>
    	<script>var user_doc_sess = 1;
    var base_url = "<?php echo base_url(); ?>";
    var cityid = '2';
    var proid = '60';</script>
    
        <?php //******************************************************************************** ?>
        <script type="text/javascript">
            var assignby="<?php echo $this->input->get('assignby') ? $this->input->get('assignby') : ''; ?>";
            var assignto="<?php echo $this->input->get('assignto') ? $this->input->get('assignto') : ''; ?>";
            var priority="<?php echo $this->input->get('priority') ? $this->input->get('priority') : ''; ?>";
            var completed="<?php echo $this->input->get('completed') ? $this->input->get('completed') : ''; ?>";
            var task_type="<?php echo $this->input->get('task_type') ? $this->input->get('task_type') : ''; ?>";
            var place="<?php echo $this->input->get('place') ? $this->input->get('place') : ''; ?>";
            var city="<?php echo $this->input->get('city') ? $this->input->get('city') : ''; ?>";
            var customer_name="<?php echo $this->input->get('customer_name') ? $this->input->get('customer_name') : ''; ?>";
            var text_desc="<?php echo $this->input->get('text_desc') ? $this->input->get('text_desc') : ''; ?>";
            var remark="<?php echo $this->input->get('remark') ? $this->input->get('remark') : ''; ?>";
            var follow_date="<?php echo $this->input->get('follow_date') ? $this->input->get('follow_date') : ''; ?>";
        </script>
        <script src="<?php echo base_url(); ?>assets/custom/js/fullcalendar/fullcal_php.js"></script>
        <?php //<script src="<?php echo base_url(); assets/apps/scripts/calendar.min.js" type="text/javascript"></script> ?>
        <!-- END PAGE LEVEL SCRIPTS -->
        <!-- BEGIN THEME LAYOUT SCRIPTS -->
        <script src="<?php echo base_url(); ?>assets/layouts/layout5/scripts/layout.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>assets/layouts/global/scripts/quick-sidebar.min.js" type="text/javascript"></script>
        <!-- END THEME LAYOUT SCRIPTS -->