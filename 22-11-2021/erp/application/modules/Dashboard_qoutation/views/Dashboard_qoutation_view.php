<?php //echo "Dashboard"; die;?>
<link rel="stylesheet" href="https://www.webnots.com/resources/font-awesome/css/font-awesome.min.css">
<link href="<?php echo base_url(); ?>assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url(); ?>assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url(); ?>assets/global/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url(); ?>assets/global/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url(); ?>assets/global/plugins/clockface/css/clockface.css" rel="stylesheet" type="text/css" />
<div class="container-fluid">
<div class="page-content">
<!-- BEGIN BREADCRUMBS -->
<!-- END BREADCRUMBS -->
<!-- BEGIN PAGE BASE CONTENT -->
        <?php 
        $dashboard = array('class' => 'form-horizontal','method' => 'get');
        echo form_open($action_ds,$dashboard); ?> 
            <div class="row">
                <div class="col-lg-7 col-md-7 col-sm-7 col-xs-12">
                    
                </div>
                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12 text-right">
                    <div class="form-group" id="mcna_namegr">
                        <label class="control-label col-md-3">Start Date</label>
                        <div class="col-md-9">
                            <input class="form-control form-control-inline input-medium date-picker" tabindex="4" id="start_date" name="start_date" size="16" value="<?php echo ($this->input->get('start_date')) ? date("d-m-Y", strtotime(($this->input->get('start_date')))) : ""; ?>" type="text">
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12 text-right">
                    <div class="form-group" id="mcna_namegr">
                        <label class="control-label col-md-3">End Date</label>
                        <div class="col-md-9">
                            <input class="form-control form-control-inline input-medium date-picker" tabindex="4" id="end_date" name="end_date" size="16" value="<?php echo ($this->input->get('end_date')) ? date("d-m-Y", strtotime(($this->input->get('end_date')))) : ""; ?>" tend_dateype="text">
                        </div>
                    </div>
                </div>
                <div class="col-lg-1 col-md-1 col-sm-1 col-xs-12 text-left">
                    <div class="col-md-offset-3 col-md-9 text-left">
                        <button type="submit" tabindex="5" class="btn green text-left" onclick="return ValidateDetails()" ><?php echo $this->input->get('id')?'UPDATE':'SUBMIT'; ?></button>
                    </div>
                </div>
            </div> 
            <?php echo form_close(); ?>
                    <div class="row">
                        <?php if (!empty($rights_error) || $this->session->flashdata('rights_error') != '') {
            $msg = !empty($rights_error) ? $rights_error : $this->session->flashdata('rights_error');
            echo '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button>' . $msg . '</div>';}?>
                        <div class="row">
                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                <div class="dashboard-stat2 bordered">
                                    <div class="display">
                                        <div class="number">
                                            <h3 class="font-green-sharp">
                                                <span data-counter="counterup" data-value="<?php echo isset($inq_stats['totalinq']['count']) ? number_format($inq_stats['totalinq']['count']) : 0;?>"></span>
                                                <small class="font-green-sharp"></small>
                                            </h3>
                                            <a href="<?php echo base_url(); ?>Sales_enq/sales_inq_report?inq_start_date=<?php echo $_SESSION['start_date']; ?>&inq_end_date=<?php echo $_SESSION['end_date']; ?>"><small>TOTAL INQUIRIES</small></a>
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
                                                <span data-counter="counterup" data-value="<?php echo isset($inq_stats['totalquotation']['count']) ? number_format($inq_stats['totalquotation']['count']) : 0;?>"></span>
                                                <small class="font-green-sharp"></small>
                                            </h3>
                                            <a href="<?php echo base_url(); ?>Sale_quotation/sales_qoute_report?inq_start_date=<?php echo $_SESSION['start_date']; ?>&inq_end_date=<?php echo $_SESSION['end_date']; ?>"><small>TOTAL Quatation</small></a>
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
                                                <span data-counter="counterup" data-value="<?php echo isset($inq_stats['totaloa']['count']) ? number_format($inq_stats['totaloa']['count']) : 0;?>"></span>
                                                <small class="font-green-sharp"></small>
                                            </h3>
                                            <a href="<?php echo base_url(); ?>Oa?inq_start_date=<?php echo $_SESSION['start_date']; ?>&inq_end_date=<?php echo $_SESSION['end_date']; ?>"><small>TOTAL OA</small></a>
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
                                                <span data-counter="counterup" data-value="<?php echo isset($inq_stats['totalamontinq']['count']) ? number_format($inq_stats['totalamontinq']['count']) : 0;?>"></span>
                                                <small class="font-green-sharp"></small>
                                            </h3>
                                            <a href="<?php echo base_url(); ?>Sale_quotation/sales_qoute_report?inq_start_date=<?php echo $_SESSION['start_date']; ?>&inq_end_date=<?php echo $_SESSION['end_date']; ?>">
                                            <small>TOTAL Amount</small></a>
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
                                            <span class="caption-subject font-green-sharp bold uppercase">Qoutation Stastics - total entry - <?php echo $inq_stats['inq_quote_status_one']['count']; ?> - blank - <?php echo $inq_stats['inq_quote_status_zero']['count']; ?></span>
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
                                                        array_push($newar, "Qoutation Status");
                                                        array_push($newar, "count");
                                                        $chartarray[] = $newar;
                                                    foreach ($inq_stats['inq_quote_status'] as $sub) { 
                                                        //echo "<pre>"; print_r($sub); 
                                                        
                                                        //$chartarray[] = $newar;

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
                                                                        <div class="desc" style="text-transformation:uppercase; font-weight:bold;"> <?php echo ''.$sub['status'].' - Total : '.$sub['count'].' - Amount : '.round($sub['total_amt'],2).'<a href="'.base_url().'Sale_quotation/sales_qoute_report?status='.$sub['qs_id'].'&inq_start_date='.$_SESSION['start_date'].'&inq_end_date='.$_SESSION['end_date'].'" class="btn" target="_blank"> View Record File</a>'; ?></div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col2">
                                                                <div class="date">  </div>
                                                            </div>
                                                        </li>
                                                    <?php $newar = array();
                                                        array_push($newar, $sub['status']);
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
                                            <span class="caption-subject font-green-sharp bold uppercase">Brand Stastics - total entry - <?php echo $inq_stats['inq_brand_one']['count']; ?> - blank - <?php echo $inq_stats['inq_brand_zero']['count']; ?></span>
                                        </div>
                                    </div>
                                    <div class="portlet-body">
                                        <!--BEGIN TABS-->
                                        <div class="tab-content">
                                            <div class="tab-pane active" id="tab_1_1">
                                                <div class="scroller" style="height: 339px;" data-always-visible="1" data-rail-visible="0">
                                                    <ul class="feeds">
                                                    <?php 
                                                    $bchartarray = array(); 
                                                        $bnewar = array();
                                                        array_push($bnewar, "Brand");
                                                        array_push($bnewar, "count");
                                                        $bchartarray[] = $bnewar;
                                                    foreach ($inq_stats['inq_brand'] as $sub) { 
                                                        
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
                                                                        <div class="desc" style="text-transformation:uppercase; font-weight:bold;"> <?php echo ''.$sub['name'].' - Total : '.$sub['count'].' - Amount : '.round($sub['total_amt'],2).'<a href="'.base_url().'Sale_quotation/sales_qoute_report?sq_brand='.$sub['status'].'&inq_start_date='.$_SESSION['start_date'].'&inq_end_date='.$_SESSION['end_date'].'" class="btn" target="_blank"> View Record File</a>'; ?></div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col2">
                                                                <div class="date">  </div>
                                                            </div>
                                                        </li>
                                                    <?php $bnewar = array();
                                                        array_push($bnewar, $sub['name']);
                                                        array_push($bnewar, $sub['count']);
                                                        $bchartarray[] = $bnewar;
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
        var jsonchartar = <?php echo json_encode($bchartarray,JSON_NUMERIC_CHECK ); ?>;
        var data_inw = google.visualization.arrayToDataTable(jsonchartar);

        var options_inw = {
          title: 'Brand'
        };

        var chart_inw = new google.visualization.PieChart(document.getElementById('piechart_inw_b'));

        chart_inw.draw(data_inw, options_inw);
      }
    </script>
    <div id="piechart_inw_b" style="width: 500; height: 500px;"></div>
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
                                    <span class="caption-subject font-green-sharp bold uppercase">Source Stastics - total entry - <?php echo $inq_stats['inq_source_one']['count']; ?> - blank - <?php echo $inq_stats['inq_source_zero']['count']; ?></span>
                                </div>
                            </div>
                            <div class="portlet-body">
                                <!--BEGIN TABS-->
                                <div class="tab-content">
                                    <div class="tab-pane active" id="tab_1_1">
                                        <div class="scroller" style="height: 339px;" data-always-visible="1" data-rail-visible="0">
                                            <ul class="feeds">

                                            <?php $schartarray = array(); 
                                                        $snewar = array();
                                                        array_push($snewar, "Executive");
                                                        array_push($snewar, "count");
                                                        $schartarray[] = $snewar;
                                                        foreach ($inq_stats['inq_source'] as $sub) { 
                                                
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
                                                                <div class="desc" style="text-transformation:uppercase; font-weight:bold;"> <?php echo ''.$sub['name'].' - Total : '.$sub['count'].' - Amount : '.round($sub['total_amt'],2).'<a href="'.base_url().'Sale_quotation/sales_qoute_report?sq_source_cat='.$sub['status'].'&inq_start_date='.$_SESSION['start_date'].'&inq_end_date='.$_SESSION['end_date'].'" class="btn" target="_blank"> View Record File</a>'; ?></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col2">
                                                        <div class="date">  </div>
                                                    </div>
                                                </li>
                                            <?php $snewar = array();
                                                        array_push($snewar, $sub['name']);
                                                        array_push($snewar, $sub['count']);
                                                        $schartarray[] = $snewar;
                                                    } ?>
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
                        <script type="text/javascript">
                      google.charts.load('current', {'packages':['corechart']});
                      google.charts.setOnLoadCallback(drawChart_inw);

                      function drawChart_inw() {
                        <?php //$chartarray = array('Task' => 'Hours per Day','Work' => 11,'Eat' => 2,'Commute' => 2); ?>
                        var jsonchartar = <?php echo json_encode($schartarray,JSON_NUMERIC_CHECK ); ?>;
                        var data_inw = google.visualization.arrayToDataTable(jsonchartar);

                        var options_inw = {
                          title: 'Source'
                        };

                        var chart_inw = new google.visualization.PieChart(document.getElementById('piechart_inw1'));

                        chart_inw.draw(data_inw, options_inw);
                      }
                    </script>
                    <div id="piechart_inw1" style="width: 500; height: 500px;"></div>
                    </div>
                     <div class="col-md-3 col-sm-3">
                        <!-- BEGIN PORTLET-->
                     <div class="portlet light bordered">
                            <div class="portlet-title tabbable-line">
                                <div class="caption">
                                    <i class="icon-globe font-green-sharp"></i>
                                    <span class="caption-subject font-green-sharp bold uppercase">Sub Source Stastics - total entry - <?php echo $inq_stats['inq_subsource_one']['count']; ?> - blank - <?php echo $inq_stats['inq_subsource_zero']['count']; ?></span>
                                </div>
                            </div>
                            <div class="portlet-body">
                                <!--BEGIN TABS-->
                                <div class="tab-content">
                                    <div class="tab-pane active" id="tab_1_1">
                                        <div class="scroller" style="height: 339px;" data-always-visible="1" data-rail-visible="0">
                                            <ul class="feeds">
                                            <?php $sbchartarray = array(); 
                                                        $sbnewar = array();
                                                        array_push($sbnewar, "SubSource");
                                                        array_push($sbnewar, "count");
                                                        $sbchartarray[] = $sbnewar;
                                                        foreach ($inq_stats['inq_subsource'] as $sub) { 
                                                
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
                                                                <div class="desc" style="text-transformation:uppercase; font-weight:bold;"> <?php echo ''.$sub['name'].' - Total : '.$sub['count'].' - Amount : '.round($sub['total_amt'],2).'<a href="'.base_url().'Sale_quotation/sales_qoute_report?sq_subsource_cat='.$sub['status'].'&inq_start_date='.$_SESSION['start_date'].'&inq_end_date='.$_SESSION['end_date'].'" class="btn" target="_blank"> View Record File</a>'; ?></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col2">
                                                        <div class="date">  </div>
                                                    </div>
                                                </li>
                                            <?php $sbnewar = array();
                                                        array_push($sbnewar, $sub['name']);
                                                        array_push($sbnewar, $sub['count']);
                                                        $sbchartarray[] = $sbnewar;
                                                    } ?>
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
                        <script type="text/javascript">
                      google.charts.load('current', {'packages':['corechart']});
                      google.charts.setOnLoadCallback(drawChart_inw);

                      function drawChart_inw() {
                        <?php //$chartarray = array('Task' => 'Hours per Day','Work' => 11,'Eat' => 2,'Commute' => 2); ?>
                        var jsonchartar = <?php echo json_encode($sbchartarray,JSON_NUMERIC_CHECK ); ?>;
                        var data_inw = google.visualization.arrayToDataTable(jsonchartar);

                        var options_inw = {
                          title: 'Sub Source'
                        };

                        var chart_inw = new google.visualization.PieChart(document.getElementById('piechart_inw2'));

                        chart_inw.draw(data_inw, options_inw);
                      }
                    </script>
                    <div id="piechart_inw2" style="width: 500; height: 500px;"></div>
                    </div>
                </div>
                <?php /* ?><div class="row">
                    <div class="col-md-3 col-sm-3">
                        <!-- BEGIN PORTLET-->
                     <div class="portlet light bordered">
                            <div class="portlet-title tabbable-line">
                                <div class="caption">
                                    <i class="icon-globe font-green-sharp"></i>
                                    <span class="caption-subject font-green-sharp bold uppercase">Executive Stastics - total entry - <?php echo $inq_stats['inq_by_one']['count']; ?> - blank - <?php echo $inq_stats['inq_by_zero']['count']; ?></span>
                                </div>
                            </div>
                            <div class="portlet-body">
                                <!--BEGIN TABS-->
                                <div class="tab-content">
                                    <div class="tab-pane active" id="tab_1_1">
                                        <div class="scroller" style="height: 339px;" data-always-visible="1" data-rail-visible="0">
                                            <ul class="feeds">
                                            <?php $exechartarray = array(); 
                                                        $exenewar = array();
                                                        array_push($exenewar, "SubSource");
                                                        array_push($exenewar, "count");
                                                        $exechartarray[] = $exenewar;
                                                        foreach ($inq_stats['inq_by'] as $sub) { 
                                                
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
                                                                <div class="desc" style="text-transformation:uppercase; font-weight:bold;"> <?php echo ''.$sub['fname'].' - Total : '.$sub['count'].' - Amount : '.round($sub['total_amt'],2).'<a href="'.base_url().'Sale_quotation/sales_qoute_report?sq_end_st='.$sub['status'].'&inq_start_date='.$_SESSION['start_date'].'&inq_end_date='.$_SESSION['end_date'].'" class="btn" target="_blank"> View Record File</a>'; ?></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col2">
                                                        <div class="date">  </div>
                                                    </div>
                                                </li>
                                            <?php $exenewar = array();
                                                        array_push($exenewar, $sub['fname']);
                                                        array_push($exenewar, $sub['count']);
                                                        $exechartarray[] = $exenewar;
                                                    } ?>
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
                        <script type="text/javascript">
                      google.charts.load('current', {'packages':['corechart']});
                      google.charts.setOnLoadCallback(drawChart_inw);

                      function drawChart_inw() {
                        <?php //$chartarray = array('Task' => 'Hours per Day','Work' => 11,'Eat' => 2,'Commute' => 2); ?>
                        var jsonchartar = <?php echo json_encode($exechartarray,JSON_NUMERIC_CHECK ); ?>;
                        var data_inw = google.visualization.arrayToDataTable(jsonchartar);

                        var options_inw = {
                          title: 'Executive'
                        };

                        var chart_inw = new google.visualization.PieChart(document.getElementById('piechart_inw3'));

                        chart_inw.draw(data_inw, options_inw);
                      }
                    </script>
                    <div id="piechart_inw3" style="width: 500; height: 500px;"></div>
                    </div>
                </div><?php */ ?>
                <div class="row">
                    <div class="col-md-3 col-sm-3">
                        <!-- BEGIN PORTLET-->
                     <div class="portlet light bordered">
                            <div class="portlet-title tabbable-line">
                                <div class="caption">
                                    <i class="icon-globe font-green-sharp"></i>
                                    <span class="caption-subject font-green-sharp bold uppercase">Executive Stastics - total entry - <?php echo $inq_stats['inq_by_one']['count']; ?> - blank - <?php echo $inq_stats['inq_bysts_zero']['count']; ?></span>
                                </div>
                            </div>
                            <div class="portlet-body">
                                <!--BEGIN TABS-->
                                <div class="tab-content">
                                    <div class="tab-pane active" id="tab_1_1">
                                        <div class="scroller" style="height: 339px;" data-always-visible="1" data-rail-visible="0">
                                            <ul class="feeds">
                                            <?php $exechartarray = array(); 
                                                        $exenewar = array();
                                                        array_push($exenewar, "SubSource");
                                                        array_push($exenewar, "count");
                                                        $exechartarray[] = $exenewar;
                                                        foreach ($inq_stats['inq_bysts'] as $sub) { 
                                                
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
                                                                <div class="desc" style="text-transformation:uppercase; font-weight:bold;"> <?php echo ''.$sub['fname'].' - Total : '.$sub['count'].' - Amount : '.round($sub['total_amt'],2).'<a href="'.base_url().'Sale_quotation/sales_qoute_report?sq_end_st='.$sub['status'].'&inq_start_date='.$_SESSION['start_date'].'&inq_end_date='.$_SESSION['end_date'].'" class="btn" target="_blank"> View Record File</a>'; ?></div>

                                                                <?php foreach ($sub['stsdata'] as $substsdata) {  ?>
                                                                <div class="desc" style="text-transformation:uppercase; font-weight:bold;"> <?php echo ''.$substsdata['status'].' - Total : '.$substsdata['count'].' - Amount : '.round($substsdata['total_amt'],2).''; ?></div>
                                                                <?php } ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col2">
                                                        <div class="date">  </div>
                                                    </div>
                                                </li>
                                            <?php $exenewar = array();
                                                        array_push($exenewar, $sub['fname']);
                                                        array_push($exenewar, $sub['count']);
                                                        $exechartarray[] = $exenewar;
                                                    } ?>
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
                        <script type="text/javascript">
                      google.charts.load('current', {'packages':['corechart']});
                      google.charts.setOnLoadCallback(drawChart_inw);

                      function drawChart_inw() {
                        <?php //$chartarray = array('Task' => 'Hours per Day','Work' => 11,'Eat' => 2,'Commute' => 2); ?>
                        var jsonchartar = <?php echo json_encode($exechartarray,JSON_NUMERIC_CHECK ); ?>;
                        var data_inw = google.visualization.arrayToDataTable(jsonchartar);

                        var options_inw = {
                          title: 'Executive'
                        };

                        var chart_inw = new google.visualization.PieChart(document.getElementById('piechart_inw3'));

                        chart_inw.draw(data_inw, options_inw);
                      }
                    </script>
                    <div id="piechart_inw3" style="width: 500; height: 500px;"></div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-12">
                            <!-- BEGIN PORTLET-->
                         <div class="portlet light bordered">
                                <div class="portlet-title tabbable-line">
                                    <div class="caption">
                                        <i class="icon-globe font-green-sharp"></i>
                                        <span class="caption-subject font-green-sharp bold uppercase">Active Qua Follow Up</span>
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
                                                                                <th width="5%"> Qua No. </th>
                                                                                <th width="5%"> Vendor </th>
                                                                                <th width="5%"> Mobile No. </th>
                                                                                <th width="5%"> Date </th>
                                                                                <th width="5%"> Method </th>
                                                                                <th width="2%"> Inq By </th>
                                                                                <th width="2%"> Status </th>
                                                                                <th  width="2%">Action</th>
                                                                            </tr>
                                                                            </thead>
                                                                                <tbody>
                                                                                <?php $id = 0;
                                                                                        //echo '<pre>'; print_r($folups); die;

                                                                                 if(isset($folups_qua)) 
                                                                                 { 
                                                                                 foreach($folups_qua as $row){ $id++; ?>

                                                                        <tr>
                                                                            <td><?php echo $row['sa_no'];?></td>
                                                                            <td><?php echo $row['vendor'];?></td>
                                                                            <td><?php echo $row['sa_phone'];?></td>
                                                                            <td><?php echo date("d-m-Y", strtotime($row['fu_followdate']));?></td>
                                                                            <td><?php echo $row['fu_method_name'];?></td>
                                                                            <td><?php echo $row['au_fname'];?></td>
                                                                            <td><?php echo $row['inqfus_name'];?></td>
                                                                            <td>
                                                                                <?php  $aid = encrypt_decrypt('encrypt', $row['sa_id']);
                                                                             ?>
                                                                                <a href="<?php echo base_url(); ?>Sale_quotation/quatation_tab/<?php echo $aid; ?>" class="btn btn-sm btn-outline green" onclick="return confirm('Are you sure you want to Edit Status?');"><i class="fa fa-pencil">Edit</i></a>
                                                                            </td>
                                                                        </tr>
                                                                               <?php } } ?>
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
<script src="<?php echo base_url(); ?>assets/layouts/global/scripts/quick-sidebar.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/layouts/global/scripts/quick-nav.min.js" type="text/javascript"></script>
<!-- END THEME LAYOUT SCRIPTS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="assets/pages/scripts/form-samples.min.js" type="text/javascript"></script>
<!-- END PAGE LEVEL SCRIPTS -->