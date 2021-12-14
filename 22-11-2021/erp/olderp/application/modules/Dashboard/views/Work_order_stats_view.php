<?php //echo "<pre>"; print_r($this->input->get('wo_type')); die;?>
<link rel="stylesheet" href="https://www.webnots.com/resources/font-awesome/css/font-awesome.min.css">
<link href="<?php echo base_url(); ?>

assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.css" rel="stylesheet" type="text/css" />

        <link href="<?php echo base_url(); ?>assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css" rel="stylesheet" type="text/css" />

        <link href="<?php echo base_url(); ?>assets/global/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css" rel="stylesheet" type="text/css" />

        <link href="<?php echo base_url(); ?>assets/global/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css" rel="stylesheet" type="text/css" />

        <link href="<?php echo base_url(); ?>assets/global/plugins/clockface/css/clockface.css" rel="stylesheet" type="text/css" />

        <!-- END PAGE LEVEL PLUGINS -->
<div class="container-fluid">
                <div class="page-content">
<!-- BEGIN BREADCRUMBS -->
                    <!-- END BREADCRUMBS -->
                    <!-- BEGIN PAGE BASE CONTENT -->
                    <div class="row">
                        <?php if (!empty($rights_error) || $this->session->flashdata('rights_error') != '') {
            $msg = !empty($rights_error) ? $rights_error : $this->session->flashdata('rights_error');
            echo '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button>' . $msg . '</div>';}?>

            <?php $dob = explode("-", $this->session->userdata['miconlogin']['dob']);
            //echo "<pre>"; print_r($dob); die;
            if(($dob[1]."-".$dob[2]) == date("m-d")) { ?>
            <MARQUEE  HEIGHT=50>
            Happy Birthday!
            </MARQUEE>
            <?php } ?>
            <?php 
                $dashboard = array('class' => 'form-horizontal','method' => 'get');
                echo form_open($action_ds,$dashboard); ?> 
            <div class="row">
                <div class="col-lg-7 col-md-7 col-sm-7 col-xs-12">
                    
                </div>
                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12 text-right" style="display: none;">
                    <div class="form-group" id="mcna_namegr">
                        <label class="control-label col-md-3">Start Date</label>
                        <div class="col-md-9">
                            <input class="form-control form-control-inline input-medium date-picker" tabindex="4" id="start_date" name="start_date" size="16" value="<?php echo ($this->input->get('start_date')) ? date("d-m-Y", strtotime(($this->input->get('start_date')))) : ""; ?>" type="text">
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12 text-right" style="display: none;">
                    <div class="form-group" id="mcna_namegr">
                        <label class="control-label col-md-3">End Date</label>
                        <div class="col-md-9">
                            <input class="form-control form-control-inline input-medium date-picker" tabindex="4" id="end_date" name="end_date" size="16" value="<?php echo ($this->input->get('end_date')) ? date("d-m-Y", strtotime(($this->input->get('end_date')))) : ""; ?>" tend_dateype="text">
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12 text-right">
                        <div class="form-group" id="mcna_namegr">
                            <label class="control-label col-md-5">Work Order Type</label>
                            <div class="col-md-7">
                                <?php $wotype = $this->input->get('wo_type'); ?>
                                <select name="wo_type" tabindex="14" id="wo_type" class="form-control itmchange" data-size="8">
                                    <option value="0">Select</option>
                                             <?php  foreach($wo_type as $wo_types) { ?>  <option value="<?php echo $wo_types['wo_type_id'];?>" <?php if(isset($wotype) && $wotype == $wo_types['wo_type_id']){ echo "selected";}?>><?php echo $wo_types['wo_type_name']; ?></option><?php } ?> 
                                </select>
                            </div>
                        </div>
                </div>
                                
                <div class="col-lg-1 col-md-1 col-sm-1 col-xs-12 text-left">
                    <div class="col-md-offset-1 col-md-9 text-left">
                        <button type="submit" tabindex="5" class="btn green text-left" onclick="return ValidateDetails()" ><?php echo $this->input->get('id')?'UPDATE':'SUBMIT'; ?></button>
                    </div>
                </div>
            </div> 
            <?php echo form_close(); ?>
                        <div class="row">
                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                <div class="dashboard-stat2 bordered">
                                    <div class="display">
                                        <div class="number">
                                            <h3 class="font-green-sharp">
                                                <span data-counter="counterup" data-value="<?php echo isset($inq_stats['total_today_sales']['count']) ? number_format($inq_stats['total_today_sales']['count']) : 0;?>"></span>
                                                <small class="font-green-sharp"></small>
                                            </h3>
                                            <a href="<?php echo base_url(); ?>Dashboard_workorder_final?inq_start_date=<?php echo $_SESSION['start_date']; ?>&inq_end_date=<?php echo $_SESSION['end_date']; ?>"><small>Today Sales</small></a>
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
                                                <span data-counter="counterup" data-value="<?php echo isset($inq_stats['total_yesterday_sales']['count']) ? number_format($inq_stats['total_yesterday_sales']['count']) : 0;?>"></span>
                                                <small class="font-green-sharp"></small>
                                            </h3>
                                            <a href="<?php echo base_url(); ?>Dashboard_workorder_final?inq_start_date=<?php echo $_SESSION['start_date']; ?>&inq_end_date=<?php echo $_SESSION['end_date']; ?>"><small>Yesterday Sales</small></a>
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
                                                <span data-counter="counterup" data-value="<?php echo isset($inq_stats['total_month_sales']['count']) ? number_format($inq_stats['total_month_sales']['count']) : 0;?>"></span>
                                                <small class="font-green-sharp"></small>
                                            </h3>
                                            <a href="<?php echo base_url(); ?>Dashboard_workorder_final?inq_start_date=<?php echo $_SESSION['start_date']; ?>&inq_end_date=<?php echo $_SESSION['end_date']; ?>"><small>This Month Sales</small></a>
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
                                                <span data-counter="counterup" data-value="<?php echo isset($inq_stats['total_lastmonth_sales']['count']) ? number_format($inq_stats['total_lastmonth_sales']['count']) : 0;?>"></span>
                                                <small class="font-green-sharp"></small>
                                            </h3>
                                            <a href="<?php echo base_url(); ?>Dashboard_workorder_final?inq_start_date=<?php echo $_SESSION['start_date']; ?>&inq_end_date=<?php echo $_SESSION['end_date']; ?>"><small>Last Month Sales</small></a>
                                        </div>
                                        <div class="icon">
                                            <i class="icon-pie-chart"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                <div class="dashboard-stat2 bordered">
                                    <div class="display">
                                        <div class="number">
                                            <h3 class="font-green-sharp">
                                                <span data-counter="counterup" data-value="<?php echo isset($inq_stats['total_year_sales']['count']) ? number_format($inq_stats['total_year_sales']['count']) : 0;?>"></span>
                                                <small class="font-green-sharp"></small>
                                            </h3>
                                            <a href="<?php echo base_url(); ?>Dashboard_workorder_final?inq_start_date=<?php echo $_SESSION['start_date']; ?>&inq_end_date=<?php echo $_SESSION['end_date']; ?>"><small>This Year Sales</small></a>
                                        </div>
                                        <div class="icon">
                                            <i class="icon-pie-chart"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                <div class="row">
                    <div class="col-md-3 col-sm-3">
                                <!-- BEGIN PORTLET-->
                             <div class="portlet light bordered">
                                    <div class="portlet-title tabbable-line">
                                        <div class="caption">
                                            <i class="icon-globe font-green-sharp"></i>
                                            <span class="caption-subject font-green-sharp bold uppercase">Today Sales</span>
                                        </div>
                                    </div>
                                    <div class="portlet-body">
                                        <!--BEGIN TABS-->
                                        <div class="tab-content">
                                            <div class="tab-pane active" id="tab_1_1">
                                                <div class="scroller" style="height: 339px;" data-always-visible="1" data-rail-visible="0">
                                                    <ul class="feeds">
                                                    <?php 
                                                    $chartarray = array(); 
                                                        $newar = array();
                                                        array_push($newar, "Today Sales");
                                                        array_push($newar, "count");
                                                        $chartarray[] = $newar;
                                                    foreach ($inq_stats['today_sale_lists'] as $sub) {
                                                        ?>
                                                        <li>
                                                            <div class="col1">
                                                                <div class="cont">
                                                                    <div class="cont-col1">
                                                                        <div class="label label-sm label-danger">
                                                                            <i class="fa fa-bolt"></i>
                                                                        </div>
                                                                    </div>
                                                                    <div class="cont-col2">
                                                                        <div class="desc" style="text-transformation:uppercase; font-weight:bold;"> <?php echo ''.$sub['preparedby_fname'].' - Total : <a href="#" class="btn" target="_blank">'.$sub['count'].' </a>'; ?></div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col2">
                                                                <div class="date">  </div>
                                                            </div>
                                                        </li>
                                                    <?php $newar = array();
                                                        array_push($newar, $sub['preparedby_fname']);
                                                        array_push($newar, $sub['count']);
                                                        $chartarray[] = $newar;
                                                     } //die; ?>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <!--END TABS-->
                                    </div>

                                </div>
                                <!-- END PORTLET-->
                                
                    </div>
    <div class="col-md-3 col-sm-3">
        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
        <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart_inw);

      function drawChart_inw() {
        <?php //$chartarray = array('Task' => 'Hours per Day','Work' => 11,'Eat' => 2,'Commute' => 2); ?>
        var jsonchartar = <?php echo json_encode($chartarray,JSON_NUMERIC_CHECK ); ?>;
        var data_inw = google.visualization.arrayToDataTable(jsonchartar);

        var options_inw = {
          title: 'Inquiry Status'
        };

        var chart_inw = new google.visualization.PieChart(document.getElementById('piechart_inw'));

        chart_inw.draw(data_inw, options_inw);
      }
    </script>
    <div id="piechart_inw" style="width: 500; height: 500px;"></div>
    </div>

        <div class="col-md-3 col-sm-3">
                                <!-- BEGIN PORTLET-->
                             <div class="portlet light bordered">
                                    <div class="portlet-title tabbable-line">
                                        <div class="caption">
                                            <i class="icon-globe font-green-sharp"></i>
                                            <span class="caption-subject font-green-sharp bold uppercase">Yesterday Sales</span>
                                        </div>
                                    </div>
                                    <div class="portlet-body">
                                        <!--BEGIN TABS-->
                                        <div class="tab-content">
                                            <div class="tab-pane active" id="tab_1_1">
                                                <div class="scroller" style="height: 339px;" data-always-visible="1" data-rail-visible="0">
                                                    <ul class="feeds">
                                                    <?php 
                                                    $chartarray = array(); 
                                                        $newar = array();
                                                        array_push($newar, "Yesterday Sales");
                                                        array_push($newar, "count");
                                                        $chartarray[] = $newar;
                                                    foreach ($inq_stats['yesterday_sale_lists'] as $sub) {
                                                        ?>
                                                        <li>
                                                            <div class="col1">
                                                                <div class="cont">
                                                                    <div class="cont-col1">
                                                                        <div class="label label-sm label-danger">
                                                                            <i class="fa fa-bolt"></i>
                                                                        </div>
                                                                    </div>
                                                                    <div class="cont-col2">
                                                                        <div class="desc" style="text-transformation:uppercase; font-weight:bold;"> <?php echo ''.$sub['preparedby_fname'].' - Total : <a href="#" class="btn" target="_blank">'.$sub['count'].' </a>'; ?></div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col2">
                                                                <div class="date">  </div>
                                                            </div>
                                                        </li>
                                                    <?php $newar = array();
                                                        array_push($newar, $sub['preparedby_fname']);
                                                        array_push($newar, $sub['count']);
                                                        $chartarray[] = $newar;
                                                     } //die; ?>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <!--END TABS-->
                                    </div>

                                </div>
                                <!-- END PORTLET-->
                                
                    </div>
    <div class="col-md-3 col-sm-3">
        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
        <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart_inw);

      function drawChart_inw() {
        <?php //$chartarray = array('Task' => 'Hours per Day','Work' => 11,'Eat' => 2,'Commute' => 2); ?>
        var jsonchartar = <?php echo json_encode($chartarray,JSON_NUMERIC_CHECK ); ?>;
        var data_inw = google.visualization.arrayToDataTable(jsonchartar);

        var options_inw = {
          title: 'Inquiry Status'
        };

        var chart_inw = new google.visualization.PieChart(document.getElementById('piechart_yesterday'));

        chart_inw.draw(data_inw, options_inw);
      }
    </script>
    <div id="piechart_yesterday" style="width: 500; height: 500px;"></div>
    </div>
    
                    
                    </div>


                    <div class="row">
                    <div class="col-md-3 col-sm-3">
                                <!-- BEGIN PORTLET-->
                             <div class="portlet light bordered">
                                    <div class="portlet-title tabbable-line">
                                        <div class="caption">
                                            <i class="icon-globe font-green-sharp"></i>
                                            <span class="caption-subject font-green-sharp bold uppercase">This Month Sales</span>
                                        </div>
                                    </div>
                                    <div class="portlet-body">
                                        <!--BEGIN TABS-->
                                        <div class="tab-content">
                                            <div class="tab-pane active" id="tab_1_1">
                                                <div class="scroller" style="height: 339px;" data-always-visible="1" data-rail-visible="0">
                                                    <ul class="feeds">
                                                    <?php 
                                                    $chartarray = array(); 
                                                        $newar = array();
                                                        array_push($newar, "This Month Sales");
                                                        array_push($newar, "count");
                                                        $chartarray[] = $newar;
                                                    foreach ($inq_stats['this_month_sale_lists'] as $sub) {
                                                        ?>
                                                        <li>
                                                            <div class="col1">
                                                                <div class="cont">
                                                                    <div class="cont-col1">
                                                                        <div class="label label-sm label-danger">
                                                                            <i class="fa fa-bolt"></i>
                                                                        </div>
                                                                    </div>
                                                                    <div class="cont-col2">
                                                                        <div class="desc" style="text-transformation:uppercase; font-weight:bold;"> <?php echo ''.$sub['preparedby_fname'].' - Total : <a href="#" class="btn" target="_blank">'.$sub['count'].' </a>'; ?></div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col2">
                                                                <div class="date">  </div>
                                                            </div>
                                                        </li>
                                                    <?php $newar = array();
                                                        array_push($newar, $sub['preparedby_fname']);
                                                        array_push($newar, $sub['count']);
                                                        $chartarray[] = $newar;
                                                     } //die; ?>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <!--END TABS-->
                                    </div>

                                </div>
                                <!-- END PORTLET-->
                                
                    </div>
    <div class="col-md-3 col-sm-3">
        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
        <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart_inw);

      function drawChart_inw() {
        <?php //$chartarray = array('Task' => 'Hours per Day','Work' => 11,'Eat' => 2,'Commute' => 2); ?>
        var jsonchartar = <?php echo json_encode($chartarray,JSON_NUMERIC_CHECK ); ?>;
        var data_inw = google.visualization.arrayToDataTable(jsonchartar);

        var options_inw = {
          title: 'Inquiry Status'
        };

        var chart_inw = new google.visualization.PieChart(document.getElementById('piechart_this_month'));

        chart_inw.draw(data_inw, options_inw);
      }
    </script>
    <div id="piechart_this_month" style="width: 500; height: 500px;"></div>
    </div>

        <div class="col-md-3 col-sm-3">
                                <!-- BEGIN PORTLET-->
                             <div class="portlet light bordered">
                                    <div class="portlet-title tabbable-line">
                                        <div class="caption">
                                            <i class="icon-globe font-green-sharp"></i>
                                            <span class="caption-subject font-green-sharp bold uppercase">Last Month</span>
                                        </div>
                                    </div>
                                    <div class="portlet-body">
                                        <!--BEGIN TABS-->
                                        <div class="tab-content">
                                            <div class="tab-pane active" id="tab_1_1">
                                                <div class="scroller" style="height: 339px;" data-always-visible="1" data-rail-visible="0">
                                                    <ul class="feeds">
                                                    <?php 
                                                    $chartarray = array(); 
                                                        $newar = array();
                                                        array_push($newar, "Last Month");
                                                        array_push($newar, "count");
                                                        $chartarray[] = $newar;
                                                    foreach ($inq_stats['last_month_sale_lists'] as $sub) {
                                                        ?>
                                                        <li>
                                                            <div class="col1">
                                                                <div class="cont">
                                                                    <div class="cont-col1">
                                                                        <div class="label label-sm label-danger">
                                                                            <i class="fa fa-bolt"></i>
                                                                        </div>
                                                                    </div>
                                                                    <div class="cont-col2">
                                                                        <div class="desc" style="text-transformation:uppercase; font-weight:bold;"> <?php echo ''.$sub['preparedby_fname'].' - Total : <a href="#" class="btn" target="_blank">'.$sub['count'].' </a>'; ?></div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col2">
                                                                <div class="date">  </div>
                                                            </div>
                                                        </li>
                                                    <?php $newar = array();
                                                        array_push($newar, $sub['preparedby_fname']);
                                                        array_push($newar, $sub['count']);
                                                        $chartarray[] = $newar;
                                                     } //die; ?>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <!--END TABS-->
                                    </div>

                                </div>
                                <!-- END PORTLET-->
                                
                    </div>
    <div class="col-md-3 col-sm-3">
        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
        <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart_inw);

      function drawChart_inw() {
        <?php //$chartarray = array('Task' => 'Hours per Day','Work' => 11,'Eat' => 2,'Commute' => 2); ?>
        var jsonchartar = <?php echo json_encode($chartarray,JSON_NUMERIC_CHECK ); ?>;
        var data_inw = google.visualization.arrayToDataTable(jsonchartar);

        var options_inw = {
          title: 'Inquiry Status'
        };

        var chart_inw = new google.visualization.PieChart(document.getElementById('piechart_last_month'));

        chart_inw.draw(data_inw, options_inw);
      }
    </script>
    <div id="piechart_last_month" style="width: 500; height: 500px;"></div>
    </div>
    
                    
                    </div>

                    <div class="row">
                        <div class="col-md-3 col-sm-3">
                                <!-- BEGIN PORTLET-->
                             <div class="portlet light bordered">
                                    <div class="portlet-title tabbable-line">
                                        <div class="caption">
                                            <i class="icon-globe font-green-sharp"></i>
                                            <span class="caption-subject font-green-sharp bold uppercase">This Year</span>
                                        </div>
                                    </div>
                                    <div class="portlet-body">
                                        <!--BEGIN TABS-->
                                        <div class="tab-content">
                                            <div class="tab-pane active" id="tab_1_1">
                                                <div class="scroller" style="height: 339px;" data-always-visible="1" data-rail-visible="0">
                                                    <ul class="feeds">
                                                    <?php 
                                                    $chartarray = array(); 
                                                        $newar = array();
                                                        array_push($newar, "Last Month");
                                                        array_push($newar, "count");
                                                        $chartarray[] = $newar;
                                                    foreach ($inq_stats['this_year_sale_lists'] as $sub) {
                                                        ?>
                                                        <li>
                                                            <div class="col1">
                                                                <div class="cont">
                                                                    <div class="cont-col1">
                                                                        <div class="label label-sm label-danger">
                                                                            <i class="fa fa-bolt"></i>
                                                                        </div>
                                                                    </div>
                                                                    <div class="cont-col2">
                                                                        <div class="desc" style="text-transformation:uppercase; font-weight:bold;"> <?php echo ''.$sub['preparedby_fname'].' - Total : <a href="#" class="btn" target="_blank">'.$sub['count'].' </a>'; ?></div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col2">
                                                                <div class="date">  </div>
                                                            </div>
                                                        </li>
                                                    <?php $newar = array();
                                                        array_push($newar, $sub['preparedby_fname']);
                                                        array_push($newar, $sub['count']);
                                                        $chartarray[] = $newar;
                                                     } //die; ?>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <!--END TABS-->
                                    </div>

                                </div>
                                <!-- END PORTLET-->
                                
                    </div>
    <div class="col-md-3 col-sm-3">
        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
        <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart_inw);

      function drawChart_inw() {
        <?php //$chartarray = array('Task' => 'Hours per Day','Work' => 11,'Eat' => 2,'Commute' => 2); ?>
        var jsonchartar = <?php echo json_encode($chartarray,JSON_NUMERIC_CHECK ); ?>;
        var data_inw = google.visualization.arrayToDataTable(jsonchartar);

        var options_inw = {
          title: 'Inquiry Status'
        };

        var chart_inw = new google.visualization.PieChart(document.getElementById('piechart_this_year'));

        chart_inw.draw(data_inw, options_inw);
      }
    </script>
    <div id="piechart_this_year" style="width: 500; height: 500px;"></div>
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

        <script src="<?php echo base_url(); ?>assets/global/plugins/bootstrap-select/js/bootstrap-select.min.js" type="text/javascript"></script>

         <script src="<?php echo base_url(); ?>assets/pages/scripts/components-bootstrap-select.min.js" type="text/javascript"></script>

        <script src="<?php echo base_url(); ?>assets/pages/scripts/dashboard.min.js" type="text/javascript"></script>

        <script src="<?php echo base_url(); ?>assets/pages/scripts/components-date-time-pickers.min.js" type="text/javascript"></script>

        <script src="<?php echo base_url(); ?>assets/custom/js/admin_user_form.js" type="text/javascript"></script>

        <!-- END PAGE LEVEL SCRIPTS -->

        <!-- BEGIN THEME LAYOUT SCRIPTS -->

        <script src="<?php echo base_url(); ?>assets/layouts/layout5/scripts/layout.min.js" type="text/javascript"></script>

        <script src="<?php echo base_url(); ?>assets/layouts/global/scripts/quick-sidebar.min.js" type="text/javascript"></script>

        <script src="<?php echo base_url(); ?>assets/layouts/global/scripts/quick-nav.min.js" type="text/javascript"></script>

        <!-- END THEME LAYOUT SCRIPTS -->

        <!-- BEGIN PAGE LEVEL SCRIPTS -->

        <script src="assets/pages/scripts/form-samples.min.js" type="text/javascript"></script>

                

        <!-- END PAGE LEVEL SCRIPTS -->