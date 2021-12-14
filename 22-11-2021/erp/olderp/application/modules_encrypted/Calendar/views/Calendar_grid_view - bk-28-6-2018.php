<?php //<!-- ********************************* CSS Files ******************************** --> ?>
<?php //echo "<pre>";print_r($assign);die; 
//$adminid= $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']);



?>

<link rel="stylesheet" href="<?php echo base_url(); ?>assets/custom/bootstrap/css/bootstrap-theme.min.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/custom/bootstrap/css/bootstrap-timepicker.min.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/custom/bootstrap/css/bootstrap-select.min.css">
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
<div class="breadcrumbs">
                        <h1>Calendar</h1>
                        <ol class="breadcrumb">
                            <li>
                                <a href="#">Home</a>
                            </li>
                            <li>
                                <a href="#">Pages</a>
                            </li>
                            <li class="active">Apps</li>
                        </ol>
                    </div>
                    <!-- END BREADCRUMBS -->
                    <!-- BEGIN PAGE BASE CONTENT -->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="portlet light portlet-fit bordered calendar">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class=" icon-layers font-green"></i>
                                        <span class="caption-subject font-green sbold uppercase">Calendar</span>
                                    </div>
                                </div>
                                
                                <div class="portlet-body">
                                    <div class="row">
                                        <div class="col-md-3 col-sm-12">
                                            <!-- BEGIN DRAGGABLE EVENTS PORTLET-->
                                            <h3 class="event-form-title margin-bottom-20">Today Weekly Tour </h3>
                                            <div id="external-events">
                                                <form class="inline-form">
                                                   <!-- <a href="javascript:;" id="event_add" class="btn green"> Add Event </a> -->
                                                </form>
                                                <hr/>
                                                <div id="event_box" class="margin-bottom-10">
                                                <?php //echo date('Y-m-d'); //echo '<pre>'; print_r($list);date("NOW") ?>
                                                <?php $i = 1; foreach($list as $ls) { echo "("."$i".")"; $i++;//echo '<pre>'; print_r($ls); ?>
                                                <div> Customer Name : <?php echo $ls['wt_customer']; ?></div>
                                                <div> District : <?php echo $ls['wt_district']; ?></div>
                                                <div> City : <?php echo $ls['wt_city']; ?></div>
                                                <div> Remark : <?php echo $ls['wt_remark']; ?></div>
                                                <div> Start date : <?php echo date("d-m-Y s:i:h", strtotime($ls['wt_startdate'])); ?></div>
                                                <div> End date : <?php echo date("d-m-Y s:i:h", strtotime($ls['wt_enddate'])); ?></div> <hr/>
                                                <?php } ?>  
                                                </div>
                                                <label for="drop-remove">
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
			                        <div class="controls" style="display:none;">
			                            <div class="bootstrap-timepicker input-append">
			                                <input id="timepicker4" type="hidden" value="11:00 AM" class="input-small">
			                                <span class="add-on"><i class="icon-time"></i></span>
			                                <input type="hidden" id="apptDay"/>
			                                <input type="hidden" id="apptTime" value="11:21 AM" />
			                                <input type="hidden" id="apptId"/>
			                            </div>
			                        </div>
			                        <div class="controls" style="display:none;">
			                            <div class="bootstrap-timepicker input-append">
			                                <input id="end_time" type="hidden" value="12:00 PM" class="input-small">
			                                <span class="add-on"><i class="icon-time"></i></span>
			                                <input type="hidden" id="apptEDay"/>
			                                <input type="hidden" id="apptETime" value="12:00 PM" />
			                                <input type="hidden" id="apptEId"/>
			                            </div>
			                        </div>
								    <div class="row">
								    	<div class="col-md-6">
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
	                                    <div class="col-md-6">
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
                                                    <option value="0"<?php if(isset($list[0]['wt_priority'])){ echo "selected";}?>>High</option>
                                                    <option value="1"<?php if(isset($list[0]['wt_priority'])){ echo "selected";}?>>Medium</option>
                                                    <option value="2"<?php if(isset($list[0]['wt_priority'])){ echo "selected";}?>>Low</option>
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
	                                            <label class="control-label col-md-3">Place</label>
	                                            <div class="col-md-9">
	                                                <input class="form-control" placeholder="Place" name="wt_place" maxlength="200" id="wt_place" value="" type="text">
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
                                                    <option value="">Completed</option>
                                                    <option value="0"<?php if(isset($list[0]['wt_completed'])){ echo "selected";}?>>Yes</option>
                                                    <option value="1"<?php if(isset($list[0]['wt_completed'])){ echo "selected";}?>>No</option>
                                                </select>
                                                
	                                            </div>
	                                        </div>
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
        <!-- END THEME GLOBAL SCRIPTS -->
        <!-- BEGIN PAGE LEVEL SCRIPTS -->
        <script src="<?php echo base_url(); ?>assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>assets/global/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>assets/global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>assets/pages/scripts/components-date-time-pickers.min.js" type="text/javascript"></script>
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
        <script src="<?php echo base_url(); ?>assets/custom/js/fullcalendar/fullcal_php.js"></script>
        <?php //<script src="<?php echo base_url(); assets/apps/scripts/calendar.min.js" type="text/javascript"></script> ?>
        <!-- END PAGE LEVEL SCRIPTS -->
        <!-- BEGIN THEME LAYOUT SCRIPTS -->
        <script src="<?php echo base_url(); ?>assets/layouts/layout5/scripts/layout.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>assets/layouts/global/scripts/quick-sidebar.min.js" type="text/javascript"></script>
        <!-- END THEME LAYOUT SCRIPTS -->