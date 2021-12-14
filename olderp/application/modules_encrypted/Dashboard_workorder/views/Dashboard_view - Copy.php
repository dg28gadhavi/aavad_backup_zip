<?php //echo "<pre>"; print_r($this->session->userdata['miconlogin']); die; //echo "Dashboard"; die;?>
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
                        <div class="row">
                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                <div class="dashboard-stat2 bordered">
                                    <div class="display">
                                        <div class="number">
                                            <h3 class="font-green-sharp">
                                                <span data-counter="counterup" data-value="<?php echo isset($inq_stats['totalinq']['count']) ? number_format($inq_stats['totalinq']['count']) : 0;?>"></span>
                                                <small class="font-green-sharp"></small>
                                            </h3>
                                            <a href="<?php echo base_url(); ?>Sales_enq/sales_inq_report"><small>TOTAL INQUIRIES</small></a>
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
                                            <a href="<?php echo base_url(); ?>Sale_quotation/sales_qoute_report"><small>TOTAL Quatation</small></a>
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
                                            <a href="<?php echo base_url(); ?>Oa"><small>TOTAL OA</small></a>
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
                                                <span data-counter="counterup" data-value="<?php echo isset($inq_stats['totalpi']['count']) ? number_format($inq_stats['totalpi']['count']) : 0;?>"></span>
                                                <small class="font-green-sharp"></small>
                                            </h3>
                                            <a href="<?php echo base_url(); ?>Pi"><small>TOTAL PI</small></a>
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
                                                <span data-counter="counterup" data-value="<?php echo isset($inq_stats['act_fol']['count']) ? number_format($inq_stats['act_fol']['count']) : 0;?>"></span>
                                                <small class="font-green-sharp"></small>
                                            </h3>
                                            <a href="<?php echo base_url(); ?>inq-followup?status=active"><small>TOTAL ACTIVE Inq. FOLLOWUPS</small></a>
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
                                                <span data-counter="counterup" data-value="<?php echo isset($inq_stats['dact_fol']['count']) ? number_format($inq_stats['dact_fol']['count']) : 0;?>"></span>
                                                <small class="font-green-sharp"></small>
                                            </h3>
                                            <a href="<?php echo base_url(); ?>inq-followup?status=deactive"><small>TOTAL DEACTIVE Inq. FOLLOWUPS</small></a>
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
                                                <span data-counter="counterup" data-value="<?php echo isset($inq_stats['qout_act_fol']['count']) ? number_format($inq_stats['qout_act_fol']['count']) : 0;?>"></span>
                                                <small class="font-green-sharp"></small>
                                            </h3>
                                            <a href="<?php echo base_url(); ?>qoutation-followup?status=active"><small>TOTAL Active Quotation FOLLOWUPS</small></a>
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
                                                <span data-counter="counterup" data-value="<?php echo isset($inq_stats['qout_dact_fol']['count']) ? number_format($inq_stats['qout_dact_fol']['count']) : 0;?>"></span>
                                                <small class="font-green-sharp"></small>
                                            </h3>
                                            <a href="<?php echo base_url(); ?>qoutation-followup?status=deactive"><small>TOTAL Deactive Quotation FOLLOWUPS</small></a>
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
                                                <span data-counter="counterup" data-value="<?php echo isset($inq_stats['totalamontinq']['count']) ? number_format($inq_stats['totalamontinq']['count']) : 0;?>"></span>
                                                <small class="font-green-sharp"></small>
                                            </h3>
                                            <a href="<?php echo base_url(); ?>Sales_enq/sales_inq_report"><small>TOTAL Inq. Amount</small></a>
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
                                                <span data-counter="counterup" data-value="<?php echo isset($inq_stats['totalamontqou']['count']) ? number_format($inq_stats['totalamontqou']['count']) : 0;?>"></span>
                                                <small class="font-green-sharp"></small>
                                            </h3>
                                            <a href="<?php echo base_url(); ?>Sale_quotation/sales_qoute_report"><small>TOTAL Qou. Amount</small></a>
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
                                                <span data-counter="counterup" data-value="<?php echo isset($inq_stats['totalamontoa']['count']) ? number_format($inq_stats['totalamontoa']['count']) : 0;?>"></span>
                                                <small class="font-green-sharp"></small>
                                            </h3>
                                            <a href="<?php echo base_url(); ?>Oa"><small>TOTAL Oa Amount</small>
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
                                                <span data-counter="counterup" data-value="<?php echo isset($inq_stats['totalamontpi']['count']) ? number_format($inq_stats['totalamontpi']['count']) : 0;?>"></span>
                                                <small class="font-green-sharp"></small>
                                            </h3>
                                            <a href="<?php echo base_url(); ?>Pi"><small>TOTAL Pi Amount</small>
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
                                            <span class="caption-subject font-green-sharp bold uppercase">Sales Inq. Status Stastics - total entry - <?php echo $inq_stats['inq_status_one']['count']; ?> - blank - <?php echo $inq_stats['inq_status_zero']['count']; ?></span>
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
                                                        array_push($newar, "Inquiry Status");
                                                        array_push($newar, "count");
                                                        $chartarray[] = $newar;
                                                    foreach ($inq_stats['inq_status'] as $sub) { 
                                                        //echo "<pre>"; print_r($sub); 
                                                        
                                                        //$chartarray[] = $newar;
                                                        if($sub['status'] == 1)
                                                        {
                                                            $sub['status'] = 'Active';
                                                        }
                                                        if($sub['status'] == 2)
                                                        {
                                                            $sub['status'] = 'Pending';
                                                        }
                                                        if($sub['status'] == 3)
                                                        {
                                                            $sub['status'] = 'Completed';
                                                        }
                                                        if($sub['status'] == 4)
                                                        {
                                                            $sub['status'] = 'Quote';
                                                        }

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
                                                                        <div class="desc" style="text-transformation:uppercase; font-weight:bold;"> <?php echo ''.$sub['status'].' - Total : <a href="'.base_url().'Sales_enq/sales_inq_report?status='.$sub['status'].'" class="btn" target="_blank">'.$sub['count'].' </a>'; ?></div>
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
                                                                        <div class="desc" style="text-transformation:uppercase; font-weight:bold;"> <?php echo ''.$sub['name'].' - Total : <a href="'.base_url().'Sales_enq/sales_inq_report?sq_brand='.$sub['status'].'" class="btn" target="_blank">'.$sub['count'].'</a>'; ?></div>
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
                                                                <div class="desc" style="text-transformation:uppercase; font-weight:bold;"> <?php echo ''.$sub['name'].' - Total : <a href="'.base_url().'Sales_enq/sales_inq_report?sq_source_cat='.$sub['status'].'" class="btn" target="_blank">'.$sub['count'].' </a>'; ?></div>
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
                                                                <div class="desc" style="text-transformation:uppercase; font-weight:bold;"> <?php echo ''.$sub['name'].' - Total : <a href="'.base_url().'Sales_enq/sales_inq_report?sq_subsource_cat='.$sub['status'].'" class="btn" target="_blank">'.$sub['count'].' </a>'; ?></div>
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
                <div class="row">
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
                                                                <div class="desc" style="text-transformation:uppercase; font-weight:bold;"> <?php echo ''.$sub['fname'].' - Total : <a href="'.base_url().'Sales_enq/sales_inq_report?sq_end_st='.$sub['status'].'" class="btn" target="_blank">'.$sub['count'].' </a>'; ?></div>
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

<!--[if lt IE 9]>
<script src="<?php echo base_url(); ?>assets/global/plugins/respond.min.js"></script>
<script src="<?php echo base_url(); ?>assets/global/plugins/excanvas.min.js"></script> 
<script src="<?php echo base_url(); ?>assets/global/plugins/ie8.fix.min.js"></script> 
<![endif]-->
        <!-- BEGIN CORE PLUGINS -->
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
        <!-- END PAGE LEVEL PLUGINS -->
        <!-- BEGIN THEME GLOBAL SCRIPTS -->
        <script src="<?php echo base_url(); ?>assets/global/scripts/app.min.js" type="text/javascript"></script>
        <!-- END THEME GLOBAL SCRIPTS -->
        <!-- BEGIN PAGE LEVEL SCRIPTS -->
        <script src="<?php echo base_url(); ?>assets/pages/scripts/dashboard.min.js" type="text/javascript"></script>
        <!-- END PAGE LEVEL SCRIPTS -->
        <!-- BEGIN THEME LAYOUT SCRIPTS -->
        <script src="<?php echo base_url(); ?>assets/layouts/layout5/scripts/layout.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>assets/layouts/global/scripts/quick-sidebar.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>assets/layouts/global/scripts/quick-nav.min.js" type="text/javascript"></script>
        <!-- END THEME LAYOUT SCRIPTS -->