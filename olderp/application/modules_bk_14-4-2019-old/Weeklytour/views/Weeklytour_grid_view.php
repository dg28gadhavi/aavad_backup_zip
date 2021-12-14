<link rel="stylesheet" href="<?php echo base_url(); ?>assets/custom/bootstrap/css/bootstrap-theme.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/custom/bootstrap/css/bootstrap-timepicker.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/custom/bootstrap/css/bootstrap-select.min.css">
        <link href='<?php echo base_url(); ?>assets/custom/css/fullcalendar/fullcalendar.print.css' rel='stylesheet' media='print' />
        <style type="text/css">
            .fc-time{
                display : none;
            }
        </style>
        <?php // <!-- ********************************* CSS Files ******************************** --> ?>
<div class="container-fluid">
                <div class="page-content">
<!-- BEGIN BREADCRUMBS -->
                    <div class="breadcrumbs">
                        <h1>Weekly tour List</h1>
                        <ol class="breadcrumb">
                            <li>
                                <a href="<?php echo base_url(); ?>Dashboard">Dashboard</a>
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
                    <div class="row">
                
        </div>
<!-- END BREADCRUMBS -->
            <!-- BEGIN CONTENT -->
            <div class="page-content-container">
                <!-- BEGIN CONTENT BODY -->
                <div class="page-content-row">
                    <!-- BEGIN PAGE HEADER-->
                    <div class="page-content-col">
                    <?php //echo '<pre>';print_r($emails);//die; ?>
                    <div class="row">
                    	<div class="col-md-12">
                            <?php echo validation_errors(); ?>
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
                            <!-- Begin: life time stats -->
                            
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
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    <h4 class="modal-title">Set Appointment Availability</h4>
                                </div>
                            <div class="modal-body">
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
                                        <div class="col-md-12">
                                            <div class="form-group" id="mcna_namegr">
                                                <label class="control-label col-md-3">District</label>
                                                <div class="col-md-9">
                                                    <input class="form-control" placeholder="District" name="district" maxlength="200" id="district" value="" type="text">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group" id="mcna_namegr">
                                                <label class="control-label col-md-3">City</label>
                                                <div class="col-md-9">
                                                    <input class="form-control" placeholder="City" name="city" maxlength="200" id="city" value="" type="text">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group" id="mcna_namegr">
                                                <label class="control-label col-md-3">Customer</label>
                                                <div class="col-md-9">
                                                    <input class="form-control" placeholder="Customer" name="customer" maxlength="200" id="customer" value="" type="text">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group" id="mcna_namegr">
                                                <label class="control-label col-md-3">Remark</label>
                                                <div class="col-md-9">
                                                    <textarea name="remark" id="remark" class="form-control"></textarea>
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

        <?php //******************************************************************************** ?>
        <?php //<!-- ********************************* JS Files ******************************** --> ?>
        <!-- Bootstrap files  -->
    <script src="<?php echo base_url(); ?>assets/custom/bootstrap/js/bootstrap-timepicker.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/custom/bootstrap/js/bootstrap-select.min.js"></script>
    <!-- Bootstrap files -->
        <?php //<!-- ********************************* JS Files ******************************** --> ?>
        <script>
            var user_doc_sess = 1;
            var base_url = "<?php echo base_url(); ?>";
            var cityid = '2';
            var proid = '60';
        </script>
    
        <?php //******************************************************************************** ?>
        <script src="<?php echo base_url(); ?>assets/custom/js/fullcalendar/fullcal_php.js"></script>
        <?php //<script src="<?php echo base_url(); assets/apps/scripts/calendar.min.js" type="text/javascript"></script> ?>
        <!-- END PAGE LEVEL SCRIPTS -->
        <!-- BEGIN THEME LAYOUT SCRIPTS -->
        <script src="<?php echo base_url(); ?>assets/layouts/layout5/scripts/layout.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>assets/layouts/global/scripts/quick-sidebar.min.js" type="text/javascript"></script>
        <!-- END THEME LAYOUT SCRIPTS -->