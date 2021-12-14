<?php //echo "<pre>"; print_r($inq_list); die;?>
<link href="<?php echo base_url(); ?>assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.css" rel="stylesheet" type="text/css" />

<link href="<?php echo base_url(); ?>assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css" rel="stylesheet" type="text/css" />

<link href="<?php echo base_url(); ?>assets/global/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css" rel="stylesheet" type="text/css" />

<link href="<?php echo base_url(); ?>assets/global/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css" rel="stylesheet" type="text/css" />

<link href="<?php echo base_url(); ?>assets/global/plugins/clockface/css/clockface.css" rel="stylesheet" type="text/css" />

        <!-- END PAGE LEVEL PLUGINS -->
<div class="container-fluid">
                <div class="page-content">
                     <div class="breadcrumbs">
                        <h1>Task Dashboard</h1>
                        <ol class="breadcrumb">
                            <li>
                                <a href="<?php echo base_url(); ?>Dashboard">Dashboard</a>
                            </li>
                             <li>
                                <a href="<?php echo base_url(); ?>Task/task_dashboard">Task Dashboard</a>
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
<!-- BEGIN BREADCRUMBS -->
                    <!-- END BREADCRUMBS -->
                    <!-- BEGIN PAGE BASE CONTENT -->
                         <div class="row">
                             <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                <div class="dashboard-stat2 bordered">
                                    <div class="display">
                                        <div class="number">
                                            <h3 class="font-green-sharp">
                                                <span data-counter="counterup" data-value="<?php echo isset($inq_stats['today_taskpending']['count']) ? number_format($inq_stats['today_taskpending']['count']) : 0;?>"></span>
                                                <small class="font-green-sharp"></small>
                                            </h3>
                                            <small>TOTAL TASK PENDING TODAY</small></a>
                                        </div>
                                        <div class="icon">
                                            <i class="icon-pie-chart"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                <div class="dashboard-stat2 bordered">
                                    <div class="display">
                                        <div class="number">
                                            <h3 class="font-green-sharp">
                                                <span data-counter="counterup" data-value="<?php echo isset($inq_stats['today_task']['count']) ? number_format($inq_stats['today_task']['count']) : 0;?>"></span>
                                                <small class="font-green-sharp"></small>
                                            </h3>
                                            <small>TOTAL TASK COMPLETED TODAY</small></a>
                                        </div>
                                        <div class="icon">
                                            <i class="icon-pie-chart"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                             <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                <div class="dashboard-stat2 bordered">
                                    <div class="display">
                                        <div class="number">
                                            <h3 class="font-green-sharp">
                                                <span data-counter="counterup" data-value="<?php echo isset($inq_stats['yesterday_task']['count']) ? number_format($inq_stats['yesterday_task']['count']) : 0;?>"></span>
                                                <small class="font-green-sharp"></small>
                                            </h3>
                                            <small>TOTAL TASK COMPLETED YESTERDAY</small></a>
                                        </div>
                                        <div class="icon">
                                            <i class="icon-pie-chart"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                <div class="dashboard-stat2 bordered">
                                    <div class="display">
                                        <div class="number">
                                            <h3 class="font-green-sharp">
                                                <span data-counter="counterup" data-value="<?php echo isset($inq_stats['weekly_task']['count']) ? number_format($inq_stats['weekly_task']['count']) : 0;?>"></span>
                                                <small class="font-green-sharp"></small>
                                            </h3>
                                           <small>TOTAL TASK COMPLETED</small></a>
                                        </div>
                                        <div class="icon">
                                            <i class="icon-pie-chart"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> 


                        <div class="row">

                            <div class="col-md-12">
                            <!-- BEGIN PORTLET-->
                         <div class="portlet light bordered">
                                 <div id="task_div">
                                <div class="portlet-title tabbable-line">
                                    <div class="caption">
                                        <i class="icon-globe font-green-sharp"></i>
                                        <span class="caption-subject font-green-sharp bold uppercase"> TASK TO DO </span>
                                    </div>
                                </div>
                            </div>
                                <div class="portlet-body">
                                    <!--BEGIN TABS-->
                                    <div class="tab-content">
                                        <div class="tab-pane active" id="tab_1_1">
                                            <div class="scroller" style="height: 339px;" data-always-visible="1" data-rail-visible="0">
                                                <ul class="feeds">
                                                    <div class="portlet-body">
                                                                <table class="table table-striped table-bordered table-hover dt-responsive" width="100%" id="sample_1">
                                                                            <thead>
                                                                                <tr role="row" class="heading">
                                                                                   
                                                                                     <th width="1%"> Task No.</th>
                                                                                    <th width="3%"> Subject </th>
                                                                                    <th width="3%"> Company Name </th>
                                                                                    <th width="2%"> Contact Person </th>
                                                                                    <th width="1%"> Mobile </th>
                                                                                    <th width="1%"> Email </th>
                                                                                    <th width="2%"> Task Type</th>
                                                                                    <th width="2%"> Location</th>
                                                                                    <th width="3%"> Details</th>
                                                                                    <th width="1%"> Alloted To</th>
                                                                                    <th width="1%"> Given By</th>
                                                                                     <th width="1%"> Reminder Date</th>
                                                                                    <th width="1%">View</th>
                                                                                    
                                                                                    
                                                                                    
                                                                                </tr>
                                                                            </thead>
                                                                                <tbody>
                                                                                <?php
                                                                                 foreach($get_reminder_task as $row){
                                                                                  ?>
                                                                        <tr <?php if(strtotime($row['due_date']) < strtotime(date("Y-m-d"))){ ?>style="color:#F00;" <?php } ?> >
                                                                            
                                                                            <td><?php echo $row['task_ticketno'];?></td>
                                                                            <td><?php echo $row['task_subject'];?></td>
                                                                            <td><?php echo $row['customer_name'];?></td>
                                                                            <td><?php echo $row['conact_person'];?></td>
                                                                            <td><?php echo $row['customer_mobile'];?></td>
                                                                            <td><?php echo str_replace(',', ', ', $row['customer_email']);?></td>
                                                                            <td><?php echo $row['type_of_work_name'];?></td>
                                                                            <td><?php echo $row['task_location'];?></td>
                                                                            <td><?php echo $row['details'];?></td>
                                                                            <td><?php echo $row['allot_first_name']. ' '.$row['allot_last_name'] ;?></td>
                                                                            <td><?php echo $row['given_by_first_name']. ' '.$row['given_by_last_name'];?></td>
                                                                            <td><?php echo $row['due_date'];?></td>
                                                                             <td>
                                                                                
                                                                                <a class="btn btn-sm btn-outline green" href="<?php echo base_url()."Task/task_start/".encrypt_decrypt('encrypt',$row['task_id']); ?>" title="Click To here to Start task"><i class="fa fa-play" ></i></a>


                                                                            </td>
                                                                        </tr>
                                                                               <?php } ?>
                                                                            </tbody>
                                                                        </table>
                                                     </div>   
                                                
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <!--END TABS-->
                                </div>
                            </div>
                            <!-- END PORTLET-->
                        </div>
                        </div>
                        <div class="row">
                        <div class="col-md-12">
                            <!-- BEGIN PORTLET-->
                         <div class="portlet light bordered">
                                 <div id="task_div">
                                <div class="portlet-title tabbable-line">
                                    <div class="caption">
                                        <i class="icon-globe font-green-sharp"></i>
                                        <span class="caption-subject font-green-sharp bold uppercase"> TASK DONE </span>
                                    </div>
                                </div>
                            </div>
                                <div class="portlet-body">
                                    <!--BEGIN TABS-->
                                    <div class="tab-content">
                                        <div class="tab-pane active" id="tab_1_1">
                                            <div class="scroller" style="height: 339px;" data-always-visible="1" data-rail-visible="0">
                                                <ul class="feeds">
                                                    <div class="portlet-body">
                                                                <table class="table table-striped table-bordered table-hover dt-responsive" width="100%" id="sample_1">
                                                                            <thead>
                                                                                <tr role="row" class="heading">
                                                                                   
                                                                                     <th width="2%"> Task No.</th>
                                                                                    <th width="3%"> Subject </th>
                                                                                    <th width="3%"> Company Name </th>
                                                                                    <th width="2%"> Contact Person </th>
                                                                                    <th width="1%"> Mobile </th>
                                                                                    <th width="1%"> Email </th>
                                                                                    <th width="2%"> Task Type</th>
                                                                                    <th width="2%"> Location</th>
                                                                                    <th width="3%"> Details</th>
                                                                                    <th width="2%"> Alloted To</th>
                                                                                    <th width="2%"> Given By</th>
                                                                                     <th width="2%"> Completed Date</th>
                                                                                     <th width="2%"> Completed Remark</th>
                                                                                     <th width="2%"> Expense</th>
                                                                                    <th width="1%">View</th>
                                                                                    
                                                                                    
                                                                                    
                                                                                </tr>
                                                                            </thead>
                                                                                <tbody>
                                                                                <?php
                                                                                 foreach($get_task_done as $row){
                                                                                  ?>
                                                                        <tr>
                                                                            
                                                                            <td><?php echo $row['task_ticketno'];?></td>
                                                                            <td><?php echo $row['task_subject'];?></td>
                                                                            <td><?php echo $row['customer_name'];?></td>
                                                                            <td><?php echo $row['conact_person'];?></td>
                                                                            <td><?php echo $row['customer_mobile'];?></td>
                                                                            <td><?php echo $row['customer_email'];?></td>
                                                                            <td><?php echo $row['type_of_work_name'];?></td>
                                                                            <td><?php echo $row['task_location'];?></td>
                                                                            <td><?php echo $row['details'];?></td>
                                                                            
                                                                            <td><?php echo $row['allot_first_name']. ' '.$row['allot_last_name'] ;?></td>
                                                                            <td><?php echo $row['given_by_first_name']. ' '.$row['given_by_last_name'];?></td>
                                                                            <td><?php echo $row['complete_date'];?></td>
                                                                            <td><?php echo $row['complete_remark'];?></td>
                                                                            <td><?php echo $row['expense'];?></td>
                                                                            <td></td>
                                                                        </tr>
                                                                               <?php } ?>
                                                                            </tbody>
                                                                        </table>
                                                     </div>   
                                                
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <!--END TABS-->
                                </div>
                            </div>
                            <!-- END PORTLET-->
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
<script src="<?php echo base_url(); ?>assets/global/plugins/moment.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/global/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/global/plugins/clockface/js/clockface.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/global/plugins/bootstrap-select/js/bootstrap-select.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/global/plugins/jquery-multi-select/js/jquery.multi-select.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/global/plugins/select2/js/select2.full.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js" type="text/javascript"></script>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN THEME GLOBAL SCRIPTS -->
<script src="<?php echo base_url(); ?>assets/global/scripts/app.min.js" type="text/javascript"></script>
<!-- END THEME GLOBAL SCRIPTS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="<?php echo base_url(); ?>assets/pages/scripts/components-bootstrap-select.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/pages/scripts/dashboard.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/pages/scripts/components-date-time-pickers.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/custom/js/admin_user_form.js" type="text/javascript"></script>
<!-- END PAGE LEVEL SCRIPTS -->
<!-- BEGIN THEME LAYOUT SCRIPTS -->
<!-- <script src="<?php echo base_url(); ?>assets/layouts/layout5/scripts/layout.min.js" type="text/javascript"></script> -->
<script src="<?php echo base_url(); ?>assets/layouts/global/scripts/quick-sidebar.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/layouts/global/scripts/quick-nav.min.js" type="text/javascript"></script>
<!-- END THEME LAYOUT SCRIPTS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="assets/pages/scripts/form-samples.min.js" type="text/javascript"></script>       

<!-- END PAGE LEVEL SCRIPTS -->