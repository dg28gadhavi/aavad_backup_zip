<?php //echo "<pre>";print_r($work_orders['outward_lists']);die; ?>
<link rel="stylesheet" href="https://www.webnots.com/resources/font-awesome/css/font-awesome.min.css">
<link href="<?php echo base_url(); ?>assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url(); ?>assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url(); ?>assets/global/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url(); ?>assets/global/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url(); ?>assets/global/plugins/clockface/css/clockface.css" rel="stylesheet" type="text/css" />
<style type="text/css">
.rbutton {border: none; color: white; padding: 10px; text-align: center; text-decoration: none; display: inline-block; 
    font-size: 12px; margin: 4px 2px; cursor: pointer; }
.rbutton5 {/*border-radius: 50% !important;*/ border: 1px solid #e1e1e1;  border-radius: 45px !important;
  box-shadow: 0px 8px 15px rgba(0, 0, 0, 0.1); transition: all 0.3s ease 0s;}
.rbutton5:hover { box-shadow: 0px 10px 15px rgba(111, 111, 111, 0.4); transform: translateY(-7px); }
.rred{ color: #F00; background-color: #F3F3F3; font-weight: bold; }
.rgreen{ color: #0ea835; background-color: #F3F3F3; font-weight: bold; }
.table-bordered > tbody > tr > td {font-weight: 600;}
/* panel */
#accordion .panel{border: none; border-radius: 0; box-shadow: none; margin-bottom: 15px;}
#accordion .panel-heading{padding: 0; border-radius: 0; border: none;}
#accordion .panel-title a{display: block; font-size: 16px; font-weight: bold;  /*color: #fff;*/ color: #dff6ff; /*background: 04656;*/ background: #1569b0; padding: 14px 40px 14px 30px; position: relative; transition: all 0.5s ease 0s;}
#accordion .panel-title a.collapsed{/*background: #f5fafc;*/ background: #1569b0; /*color: #904656;*/ /*color: #1569b0; */color: #dff6ff;
    transition: all 0.5s ease 0s;}
#accordion .panel-title a:after,
#accordion .panel-title a.collapsed:after, #accordion .panel-title a.collapsed:after{content: "\f106"; font-family: FontAwesome; font-weight: 900; font-size: 20px; position: absolute; top: 10px; right: 20px;}
#accordion .panel-title a.collapsed:after{content: "\f107";}
#accordion .panel-body{font-size: 14px; /*color: #8b8b8c;*/background: #fff;line-height: 25px; padding: 20px 25px; border: none;
    border-left: 3px solid #1569b0; transition: all 0.5s ease 0s;}
.box-content {position: absolute;z-index: 1000; opacity:0; max-width: 100%; border-radius: 25px; padding: 0 10px; background: #06aab9;font-weight: 600;color: #fff;
     -webkit-transition:.5s;  -moz-transition:.5s; -o-transition:.5s; -ms-transition:.5s; transition:.5s;} 
.boxhover:hover .box-content { opacity: 1;}

.sales-lbg{background: #EE3E34;}
.admin-lbg{background: #FDE92B;}
.sm-lbg{background: #F09243;}
.pm-lbg{background: #54B948;}
.production-lbg{background: #BDA0CC;}
.account-lbg{background: #BDA0CC;}
.dispatch-lbg{background: #9BABB6;}

.store-lbg{background: #FFE1BA; color:#000; font-weight: bold;}
.production-two-lbg{background: #772120; color: #fff;}

.sales-lbg{background: #fcecd6; color:#000; font-weight: bold;}
.admin-lbg{background: #cce6ff; color:#000; font-weight: bold;}
.sm-lbg{background: #efe9ab; color:#000; font-weight: bold;}
.pm-lbg{background: #c7eded; color:#000; font-weight: bold;}
.production-lbg{background: #fee2df; color:#000; font-weight: bold;}
.account-lbg{background: #ddd; color:#000; font-weight: bold;}
.dispatch-lbg{background: #e5dfff; color:#000; font-weight: bold;}

.sales-tbg{background: #d17b05 !important;}
.admin-tbg{background: #1d90ff !important;}
.sm-tbg{background: #998c01 !important;}
.pm-tbg{background: #006f6f !important;}
.production-tbg{background: #f04836 !important;}
.account-tbg{background: #483a3a !important;}
.dispatch-tbg{background: #5d4aad !important;}
/*tab*/
.tab .nav-tabs > li{ margin-right: 2px;}
.tab .nav-tabs > li > a{ border: none; padding: 8px 10px; color:#fff; background:#272e38; border-radius:0; font-size: 12px;}
.tab .nav-tabs > li > a > i{ font-size:12px; margin-right:8px;}
.tab .nav-tabs > li.active > a,
.tab .nav-tabs > li.active > a:focus,
.tab .nav-tabs > li.active > a:hover{ border: none; background: #e74c3c; color:#fff; transition:background 0.20s linear;}
.tab .nav-tabs li.active:after { content: ""; position: absolute; bottom: -20px; left: 33%; border: 10px solid transparent; 
border-top-color: #5c5c5c;}
.tab .tab-content{ background: #fdfdfd; line-height: 25px; border: 1px solid #ddd; border-top:2px solid #5c5c5c; border-bottom:2px solid #5c5c5c;    padding:20px 25px;}
@media only screen and (max-width: 480px){
.tab > .nav-tabs li{ width:100%;}
.tab .nav-tabs > li > a{padding: 20px;}
.tab .nav-tabs > li.active:after {border:none;}
}
.page-header .navbar .topbar-actions .btn-group-notification .dropdown-menu-list > li > a .details { color: #adadad;}
.page-header .navbar .topbar-actions .btn-group-notification .dropdown-menu-list > li > a .time { color: #e1bb8a;}
.portlet.light .portlet-body { padding-top: 8px; overflow-y: scroll; height: 450px;}
.badge-color { font-size: 14px !important;height: 30px;padding: 7px 18px;font-weight: 500; }
.dashboard-stat2 {padding: 10px 10px 0;}
/*.dashboard-stat2.bordered {border:none; background: none;}*/
.sales-dashbg{background: #fcecd6!important;}
.admin-dashbg{background: #cce6ff!important;}
.pm-dashbg{background: #c7eded!important;}
.production-dashbg{background: #fee2df!important;}
.store-dashbg{background: #FFE1BA!important;}
.dashboard-stat2 .display .number small {color: #1569B0;}
.wotb .fa { font-size: 18px; }
.wotb .btn { padding: 4px 10px !important; }
.text-left { padding-bottom: 5px;}
.portlet-body .table .wotb {background: #dbe8f3; font-weight: 600; font-size: 15px;}
.portlet-body .table .wotdark {background: #d2d2d2; color: #000;font-weight: 600; width: 150px; font-size: 15px;}
.portlet-body .table .wotldark {background: #c4c5d6; color: #000;font-weight: 600; width: 200px; font-size: 15px;}
.portlet-body .table .wotc {background: #f3f3f3; font-weight: 600; width: 150px; color: #000; font-weight: 600;}
/*.portlet-body .table .pretb {background: #fbd6a4;}*/
.portlet-body .table .headtb {background: #686868; color: #fff; }

.first-col { width: 400px; float: left;padding: 5px; }
.pre-col-left { float: left; font-weight: bold; }
.pre-col-right {padding-left: 10px; }
.test-col-left { float: left; font-weight: bold; }
.test-col-right {padding-left: 10px; }
.second-col { width: 400px; float: left;padding: 5px; }
.content-col-bg {background: #f2f2f2 !important;padding: 10px !important;}
.portlet-bg {background: #f8f8f8 !important;padding: 10px !important;}
.btn-left {margin-left: 10px;}
.portlet-body h3 { background: #e0e0e0;padding: 10px; }
.line-space {border-bottom: 3px solid #686868; margin:20px 0;}

.sales-lbg{background: #EE3E34;}
.admin-lbg{background: #FDE92B;}
.sm-lbg{background: #F09243;}
.pm-lbg{background: #54B948;}
.production-lbg{background: #BDA0CC;}
.account-lbg{background: #BDA0CC;}
.dispatch-lbg{background: #9BABB6;}

.store-lbg{background: #FFE1BA; color:#000; font-weight: bold;}
.production-two-lbg{background: #772120; color: #fff;}

.sales-lbg{background: #fcecd6; color:#000; font-weight: bold;}
.admin-lbg{background: #cce6ff; color:#000; font-weight: bold;}
.sm-lbg{background: #efe9ab; color:#000; font-weight: bold;}
.pm-lbg{background: #c7eded; color:#000; font-weight: bold;}
.production-lbg{background: #fee2df; color:#000; font-weight: bold;}
.account-lbg{background: #ddd; color:#000; font-weight: bold;}
.dispatch-lbg{background: #e5dfff; color:#000; font-weight: bold;}
</style>
<div class="container-fluid">
                <div class="page-content">
<!-- BEGIN BREADCRUMBS -->
                    <div class="breadcrumbs">
                        <h1>Account For WO</h1>
                        <ol class="breadcrumb">
                            <li>
                                <a href="<?php echo base_url(); ?>Dashboard">Dashboard</a>
                            </li>
                            <li>
                                <a href="<?php echo base_url(); ?>Dashboard_workorder_final/account_approve_report">Account Approve Report</a>
                            </li>
                            <li style="text-decoration:none; color:#F00;"><a style="text-decoration:none; color:#FFF;" href="<?php echo base_url(); ?>Dashboard_workorder_final/wo_report" class="btn btn-primary">Report</a></li>
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
                        <?php if($this->input->post()){ ?>
                        <div class="col-md-12 col-xs-6"><div class="alert alert-danger">
                        <strong><?php echo $this->session->flashdata('error'); echo validation_errors();?></strong> 
                        </div></div>
                        </div>
                        <?php } ?>
                    </div>

<!-- END BREADCRUMBS -->
<!-- BEGIN CONTENT -->
            <div class="page-content-container">
                <!-- BEGIN CONTENT BODY -->
                <div class="page-content-row">
                    <!-- BEGIN PAGE HEADER-->
                    <div class="page-content-col content-col-bg">
                    <?php 
                $dashboard = array('class' => 'form-horizontal','method' => 'get');
                echo form_open($action_ds,$dashboard); ?> 
                <?php if (!empty($rights_error) || $this->session->flashdata('rights_error') != '') {
            $msg = !empty($rights_error) ? $rights_error : $this->session->flashdata('rights_error');
            echo '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button>' . $msg . '</div>';}?>
            <div class="row">
                <div class="col-lg-1 col-md-1 col-sm-1 col-xs-12 text-right">
                    <div class="form-group" id="mcna_namegr">
                        <div class="col-md-12">
                            <input class="form-control form-control-inline date-picker" tabindex="4" id="inq_start_date" name="inq_start_date" size="16" value="<?php echo ($this->input->get('inq_start_date')) ? date("d-m-Y", strtotime(($this->input->get('inq_start_date')))) : ""; ?>" type="text" placeholder="Start Date">
                        </div>
                    </div>
                </div>
                <div class="col-lg-1 col-md-1 col-sm-1 col-xs-12 text-right">
                    <div class="form-group" id="mcna_namegr">
                        <div class="col-md-12">
                            <input class="form-control form-control-inline date-picker" tabindex="4" id="inq_end_date" name="inq_end_date" size="16" value="<?php echo ($this->input->get('inq_end_date')) ? date("d-m-Y", strtotime(($this->input->get('inq_end_date')))) : ""; ?>" type="text" placeholder="End Date">
                        </div>
                    </div>
                </div>
                <div class="col-lg-1 col-md-1 col-sm-1 col-xs-12 text-right">
                    <div class="form-group" id="mcna_namegr">
                        <div class="col-md-12">
                            <input class="form-control form-control-inline" tabindex="4" id="wo_no" name="wo_no" size="16" value="<?php echo ($this->input->get('wo_no')) ? $this->input->get('wo_no') : ""; ?>" type="text" placeholder="W. O. No.">
                        </div>
                    </div>
                </div>
                <div class="col-lg-1 col-md-1 col-sm-1 col-xs-12 text-right">
                    <div class="form-group" id="mcna_namegr">
                        <?php // echo "<pre>"; print_r($executive[0]['au_fname']); die;?>
                        <div class="col-md-12">
                            <select name="au_fname" id="au_fname" class="form-control itmchange" data-size="8" tabindex="4">
                                <option value="">Sales Executive</option>
                              <?php  foreach($executive as $exe) {

                                ?>  <option value="<?php echo $exe['au_id'];?>" <?php if($this->input->get('au_fname') && ($this->input->get('au_fname') != '') && ($this->input->get('au_fname') == $exe['au_id'])){ ?> selected <?php } ?>><?php echo $exe['au_fname'].' '.$exe['au_lname']; ?></option><?php } ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-lg-1 col-md-1 col-sm-1 col-xs-12 text-right">
                    <div class="form-group" id="mcna_namegr">
                        <?php // echo "<pre>"; print_r($executive[0]['au_fname']); die;?>
                        <div class="col-md-12">
                            <select name="customer" id="customer" class="form-control itmchange" data-size="8" tabindex="4">
                                <option value="">Customer</option>
                              <?php  foreach($work_orders['outward_lists'] as $wodetails) {

                                ?>  <option value="<?php echo $wodetails['wo_customer_name'];?>" <?php if($this->input->get('customer') && ($this->input->get('customer') != '') && ($this->input->get('customer') == $wodetails['wo_customer_name'])){ ?> selected <?php } ?>><?php echo $wodetails['wo_customer_name']; ?></option><?php } ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-lg-1 col-md-1 col-sm-1 col-xs-12 text-right">
                    <div class="form-group" id="mcna_namegr">
                        <?php // echo "<pre>"; print_r($executive[0]['au_fname']); die;?>
                        <div class="col-md-12">
                            <select name="vendor" id="vendor" class="form-control itmchange" data-size="8" tabindex="4">
                                <option value="">Vendor</option>
                              <?php  foreach($vendor as $vdata) {

                                ?>  <option value="<?php echo $vdata['master_party_id'];?>" <?php if($this->input->get('vendor') && ($this->input->get('vendor') != '') && ($this->input->get('vendor') == $vdata['master_party_id'])){ ?> selected <?php } ?>><?php echo $vdata['master_party_name']; ?></option><?php } ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-lg-1 col-md-1 col-sm-1 col-xs-12 text-left">
                        <button type="submit" tabindex="5" class="btn green text-left" ><i class="fa fa-check"></i></button>
                        <a href="<?php echo base_url().'Dashboard_workorder_final'; ?>" class="btn red text-left" ><i class="fa fa-refresh"></i></a>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 text-left">
                    
                        <button type="button" class="btn btn-primary">No of work order = <span class="badge"><?php echo count($work_orders['outward_lists']); ?></span></button>
                        <a href="<?php echo base_url(); ?>Dashboard_workorder_final/wo_report" class="btn btn-primary">Report</a>
                 
                </div>
            </div> 
            <?php echo form_close(); ?>
                    <div class="row">
                            <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
                                <div class="dashboard-stat2 bordered account-lbg">
                                    <div class="display">
                                        <div class="number">
                                            <h3 class="font-green-sharp">
                                                <span data-counter="counterup" data-value="<?php echo isset($work_orders_count['total_yesterday_sales']['count']) ? number_format($work_orders_count['total_yesterday_sales']['count']) : 0;?>"></span>
                                                <small class="font-green-sharp"></small>
                                            </h3>
                                            <a href="#"><small>Yesterday</small></a>
                                        </div>
                                        <div class="icon">
                                            <i class="icon-pie-chart"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
                                <div class="dashboard-stat2 bordered account-lbg">
                                    <div class="display">
                                        <div class="number">
                                            <h3 class="font-green-sharp">
                                                <span data-counter="counterup" data-value="<?php echo isset($work_orders_count['total_today_sales']['count']) ? number_format($work_orders_count['total_today_sales']['count']) : 0;?>"></span>
                                                <small class="font-green-sharp"></small>
                                            </h3>
                                            <a href="#"><small>Today</small></a>
                                        </div>
                                        <div class="icon">
                                            <i class="icon-pie-chart"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
                                <div class="dashboard-stat2 bordered account-lbg">
                                    <div class="display">
                                        <div class="number">
                                            <h3 class="font-green-sharp">
                                                <span data-counter="counterup" data-value="<?php echo isset($work_orders_count['total_month_sales']['count']) ? number_format($work_orders_count['total_month_sales']['count']) : 0;?>"></span>
                                                <small class="font-green-sharp"></small>
                                            </h3>
                                            <a href="#"><small>This Month</small></a>
                                        </div>
                                        <div class="icon">
                                            <i class="icon-pie-chart"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
                                <div class="dashboard-stat2 bordered account-lbg">
                                    <div class="display">
                                        <div class="number">
                                            <h3 class="font-green-sharp">
                                                <span data-counter="counterup" data-value="<?php echo isset($work_orders_count['total_year_sales']['count']) ? number_format($work_orders_count['total_year_sales']['count']) : 0;?>"></span>
                                                <small class="font-green-sharp"></small>
                                            </h3>
                                            <a href="#"><small>This Year</small></a>
                                        </div>
                                        <div class="icon">
                                            <i class="icon-pie-chart"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
                                <div class="dashboard-stat2 bordered store-dashbg">
                                    <div class="display">
                                        <div class="number">
                                            <h3 class="font-green-sharp">
                                                <span data-counter="counterup" data-value="<?php echo isset($work_orders_count['total_account_approve']['count']) ? number_format($work_orders_count['total_account_approve']['count']) : 0;?>"></span>
                                                <small class="font-green-sharp"></small>
                                            </h3>
                                            <a href="<?php echo base_url(); ?>Dashboard_workorder_final/account_approve_report"><small>Inv Approved</small></a>
                                        </div>
                                        <div class="icon">
                                            <i class="icon-pie-chart"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
                                <div class="dashboard-stat2 bordered store-dashbg">
                                    <div class="display">
                                        <div class="number">
                                            <h3 class="font-green-sharp">
                                                <span data-counter="counterup" data-value="<?php echo isset($work_orders_count['total_account_pending']['count']) ? number_format($work_orders_count['total_account_pending']['count']) : 0;?>"></span>
                                                <small class="font-green-sharp"></small>
                                            </h3>
                                            <a href="#"><small>Inv Pending</small></a>
                                        </div>
                                        <div class="icon">
                                            <i class="icon-pie-chart"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            </div>
                            <div class="row" style="display:none;">
                            <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
                                <div class="dashboard-stat2 bordered account-lbg">
                                    <div class="display">
                                        <div class="number">
                                            <h3 class="font-green-sharp">
                                                <span data-counter="counterup" data-value="<?php echo isset($account_count['today_account_approve']['count']) ? number_format($account_count['today_account_approve']['count']) : 0;?>"></span>
                                                <small class="font-green-sharp"></small>
                                            </h3>
                                            <a href="#"><small>Today Approve</small></a>
                                        </div>
                                        <div class="icon">
                                            <i class="icon-pie-chart"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
                                <div class="dashboard-stat2 bordered account-lbg">
                                    <div class="display">
                                        <div class="number">
                                            <h3 class="font-green-sharp">
                                                <span data-counter="counterup" data-value="<?php echo isset($account_count['yesterday_account_approve']['count']) ? number_format($account_count['yesterday_account_approve']['count']) : 0;?>"></span>
                                                <small class="font-green-sharp"></small>
                                            </h3>
                                            <a href="#"><small>Yesterday Approve</small></a>
                                        </div>
                                        <div class="icon">
                                            <i class="icon-pie-chart"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
                                <div class="dashboard-stat2 bordered account-lbg">
                                    <div class="display">
                                        <div class="number">
                                            <h3 class="font-green-sharp">
                                                <span data-counter="counterup" data-value="<?php echo isset($account_count['this_month_account_approve']['count']) ? number_format($account_count['this_month_account_approve']['count']) : 0;?>"></span>
                                                <small class="font-green-sharp"></small>
                                            </h3>
                                            <a href="#"><small>This Month Approve</small></a>
                                        </div>
                                        <div class="icon">
                                            <i class="icon-pie-chart"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
                                <div class="dashboard-stat2 bordered account-lbg">
                                    <div class="display">
                                        <div class="number">
                                            <h3 class="font-green-sharp">
                                                <span data-counter="counterup" data-value="<?php echo isset($account_count['last_month_account_approve']['count']) ? number_format($account_count['last_month_account_approve']['count']) : 0;?>"></span>
                                                <small class="font-green-sharp"></small>
                                            </h3>
                                            <a href="#"><small>Last Month</small></a>
                                        </div>
                                        <div class="icon">
                                            <i class="icon-pie-chart"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
                                <div class="dashboard-stat2 bordered account-lbg">
                                    <div class="display">
                                        <div class="number">
                                            <h3 class="font-green-sharp">
                                                <span data-counter="counterup" data-value="<?php echo isset($account_count['year_account_approve']['count']) ? number_format($account_count['year_account_approve']['count']) : 0;?>"></span>
                                                <small class="font-green-sharp"></small>
                                            </h3>
                                            <a href="#"><small>This Year</small></a>
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
                        <div class="portlet box">
                        <div class="portlet-body form portlet-bg">
                            <?php echo isset($error_msg) ? '<h3 class="form-section">'.$error_msg : "</h3>"; ?>

                            <?php //echo "<pre>";print_r($work_orders);die; 
                            $j = 0; foreach ($work_orders['outward_lists'] as $outkey => $outward_data) { $j++; ?>
                                
                                <div id="outwardinv<?php echo $outward_data['otw_id']; ?>">
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12">
                                            <div>
                                                <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                                                    <div class="panel panel-default">
                                                        <div class="panel-heading headingwo" role="tab" id="headingwo<?php echo $outward_data['wo_id']; ?>">
                                                    
                                                    <h4 class="panel-title">
                            <span><a class="<?php if(isset($outward_data['woopen_id']) && $outward_data['woopen_id'] != NULL){ echo "collapsed";
                            } ?>" role="button" 
                            <?php if(isset($outward_data['wogreen_view']) && ($outward_data['wogreen_view'] != NULL))
                                {  }else{ if(encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['typeid']) != 3){ ?> style="background-color:green;" <?php } } ?>
                            
                                 data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $outward_data['wo_id']; ?>" aria-expanded="true" aria-controls="collapse<?php echo $outward_data['wo_id']; ?>">
                                 [<?php echo $j; ?>] <span style="color:#FFF;"><?php $oldwono = isset($outward_data['wo_old_wo_no']) && ($outward_data['wo_old_wo_no'] != '') ? " [ OLD W.O.: ".$outward_data['wo_old_wo_no']." ] " : '';
                                echo $outward_data['wo_wo_no'].$oldwono." [ ".$outward_data['wo_type_name']." ] [ ".$outward_data['wo_customer_name']." ]"."  [PB : ".$outward_data['prepared_by_fname']." ] [CB : ".$outward_data['created_by_fname']." ]"." [ Dt.:".date("d-m-Y", strtotime($outward_data['wo_wo_date']))." ]"." [ PO :".$outward_data['wo_po_no']." ]".""; ?></span><span class="pull-right" style="color:#FFF;font-weight: 600;" id="countdown<?php echo $j; ?>"></span>
                            </a>
                        </h4>
                                                        </div>
                                                        <div id="collapse<?php echo $outward_data['wo_id']; ?>" class="panel-collapse collapse <?php echo (isset($outward_data['woopen_id']) && ($outward_data['woopen_id'] != NULL)) ? "in" : ""; ?>" role="tabpanel" aria-labelledby="headingOne">
                                                            <div class="portlet-body">
                                    <?php $date1 = strtotime($outward_data['otw_manager_confirm_date']);
                                    $date2 = strtotime(date("Y-m-d H:i:s"));
                                    $diff = abs($date2 - $date1);
                                    $years = floor($diff / (365*60*60*24));
                                    $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
                                    $days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
                                    $hours = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24 - $days*60*60*24) / (60*60));
                                    $minutes = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24 - $days*60*60*24 - $hours*60*60)/ 60);
                                    $seconds = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24 - $days*60*60*24  - $hours*60*60 - $minutes*60)); ?>
                                    <script type="text/javascript">
                                        var outid = "<?php echo $j; ?>";
                                        var input<?php echo $j; ?> = {
                                            year: "<?php echo $years; ?>",
                                            month: "<?php echo $months; ?>",
                                            day: "<?php echo $days; ?>",
                                            hours: "<?php echo $hours; ?>",
                                            minutes: "<?php echo $minutes; ?>",
                                            seconds: "<?php echo $seconds; ?>",
                                        };
                                        //console.log(input);
                                        var timestamp<?php echo $j; ?> = new Date(input<?php echo $j; ?>.year, input<?php echo $j; ?>.month, input<?php echo $j; ?>.day,
                                        input<?php echo $j; ?>.hours, input<?php echo $j; ?>.minutes, input<?php echo $j; ?>.seconds);
                                    </script>
                                    <table class="table table-bordered" style="">
                                        <?php // echo "<pre>";print_r($outward_data);die; ?>
                                        <tr>
                                            <th colspan="2" class="wotldark" style="text-align: center;width:58px;">W.O. No. :</th>
                                           <!--  <th colspan="2" style="text-align: center;">MASPL/MS</th> -->
                                            <td colspan="2" class="wotb"><?php 
                                            $oldwono = isset($work_order['wo_old_wo_no']) && ($work_order['wo_old_wo_no'] != '') ? " Old W.O. No. ".$work_order['wo_old_wo_no']."" : '';
                                            echo $outward_data['wo_wo_no'].$oldwono; ?></td>
                                            <th colspan="2" class="wotldark" style="text-align: center;width: 50px;">Date :</th>
                                            <td colspan="2" class="wotb"><?php echo date("d-m-Y", strtotime($outward_data['wo_wo_date'])); ?></td>
                                        </tr>
                                        <tr>
                                            <th colspan="2" class="wotldark" style="text-align: center;width:58px;">P.O. No. :</th>
                                           <!--  <th colspan="2" style="text-align: center;">MASPL/MS</th> -->
                                            <td colspan="2" class="wotb"><?php echo $outward_data['wo_po_no']; ?></td>
                                            <th colspan="2" class="wotldark" style="text-align: center;width: 50px;">P.O.Date :</th>
                                            <td colspan="2" class="wotb"><?php echo date("d-m-Y", strtotime($outward_data['wo_po_date'])); ?></td>
                                        </tr>
                                        <tr>
                                            <td class="wotdark">Name:</td>
                                            <td class="wotc" colspan="7"><strong><?php echo $outward_data['wo_customer_name']; ?></strong></td>
                                        </tr>
                                        <tr>
                                            <td class="wotldark">GST No:</td>
                                            <td colspan="7"><?php echo $outward_data['wo_gstno']; ?></td>
                                        </tr>
                                        <tr>
                                            <td class="wotldark">Address:</td>
                                            <td colspan="7"><?php echo $outward_data['wo_address']; ?></td>
                                        </tr>
                                        <tr>
                                            <td class="wotldark">Billing Address:</td>
                                            <td colspan="3"><?php echo $outward_data['wo_billing_address']; ?></td>                                        
                                            <td class="wotldark">Shipping Address:</td>
                                            <td colspan="3"><?php echo $outward_data['wo_shipping_address']; ?></td>
                                        </tr>
                                        <tr>
                                            <td class="wotldark">Dilivery Time/Date:</td>
                                            <td colspan="3"><?php echo $outward_data['wo_deliverytime']; ?></td>                                       
                                            <td class="wotldark" width="200px">Dilivery By:</td>
                                            <td colspan="3"><?php echo $outward_data['wo_deliveryby']; ?></td>
                                        </tr>
                                        <tr>
                                            <td class="wotldark">Courier Name:</td>
                                            <td colspan="3"><?php echo $outward_data['wo_couriername']; ?></td>                                        
                                            <td class="wotldark" width="200px">Docket No:</td>
                                            <td colspan="3"><?php echo $outward_data['wo_docket_no']; ?></td>
                                        </tr>
                                        <tr>
                                            <td class="wotldark">Fright:</td>
                                            <td colspan="3"><?php echo $outward_data['wo_fright_taxbleamount']; ?></td>

                                            <td class="wotldark" width="200px">P&f:</td>
                                            <td colspan="3"><?php echo $outward_data['wo_taxbleamount']; ?></td>
                                        </tr>
                                        <tr>
                                            <td class="wotldark">Remark:</td>
                                            <td colspan="3"><?php echo $outward_data['wo_remark']; ?></td>

                                            <td class="wotldark" width="200px">Weight:</td>
                                            <td colspan="3"><?php echo $outward_data['otw_weight']." KG"; ?></td>
                                        </tr>
                                        <tr>
                                            <td class="wotldark">Payment Info:</td>
                                            <td colspan="3"><?php echo $outward_data['otw_paymentinfo']; ?></td>

                                            <td class="wotldark">Payment Recive:</td>
                                            <td colspan="3"><?php echo $outward_data['otw_paymentrecive']; ?></td>
                                        </tr>

                                    </table>
                                    <table class="table table-bordered">
                                        <tr class="headtb">
                                            <th width="2%" style="text-align: center;">SR. No.</th>
                                            <th colspan="2" width="20%" style="text-align: center;">Item Description</th>
                                            <th width="2%" style="text-align: center;">Qty</th>
                                            <th width="10%" style="text-align: center;">Serial Key</th>
                                            <th width="2%" style="text-align: center;">Rate</th>
                                            <th width="2%" style="text-align: center;">Total</th>
                                            <th width="2%" style="text-align: center;">Discount</th>
                                            <th width="2%" style="text-align: center;">GST</th>
                                            <th width="2%" style="text-align: center;">Total</th>
                                        </tr>
                                        <?php $counter = 0; $qtyttl = 0; $ttl = 0; $fttl = 0; foreach ($outward_data['item_lists'] as $itemkey => $items) { $counter++; ?>
                                        <tr data-toggle="collapse" data-target="#idemo<?php echo $items['otwi_id']; ?>" <?php if(isset($items['otwi_account_cid']) && ($items['otwi_account_cid'] != 0)){ ?>style="background-color:#90EE90;" <?php }else{ if(isset($items['otwi_account_qty']) && ($items['otwi_account_qty'] != 0)){ ?> style="background-color:#eaff00;" <?php } } ?> >
                                              <td><?php echo $counter; ?>
                                                <?php if(isset($items['otwi_account_cid']) && ($items['otwi_account_cid'] == 0)){ ?>
                                              <br/><br/><a href="<?php echo base_url().'Dashboard_workorder_final/account_item_confirm_direct?wo_id='.$outward_data['wo_id'].'&outid='.$outward_data['otw_id'].'&outitemid='.$items['otwi_id'].'&outqty='.$items['otwi_qty']; ?>" class="btn green text-left"><i class="fa fa-facebook" onclick="return confirm('Are you sure you want to confirm this item?')"></i></a><br/><br/>
                                              <a href="<?php echo base_url().'Dashboard_workorder_final/account_item_confirm?wo_id='.$outward_data['wo_id'].'&outid='.$outward_data['otw_id'].'&outitemid='.$items['otwi_id'].'&outqty='.$items['otwi_qty']; ?>" class="btn green text-left"><i class="fa fa-pinterest-p" onclick="return confirm('Are you sure you want to confirm this item?')"></i></a>
                                                    <?php if($items['otwi_account_remark'] != ''){ ?>
                                                        <span style="color:#F00;"><br/><br/> Qty : <?php echo $items['otwi_account_qty']; ?><br/> Remark : <?php echo $items['otwi_account_remark']; ?><br/> Change @ = <?php echo $items['otwi_account_date']; ?></span>
                                                    <?php } ?>
                                              <?php }else{ ?>
                                                <span style="color:#F00;"><br/> Completed @ = <?php echo $items['otwi_account_date']; ?><br/> Remark : <?php echo $items['otwi_account_remark']; ?></span>
                                              <?php } ?>
                                              <div id="outitemstop<?php echo $items['otwi_id']; ?>"></div></td>
                                              <td colspan="2"><b><?php echo $items['otwi_part_no']."</b>".$items['otwi_itm_title']." <b>DESC:</b> ".nl2br($items['otwi_itm_desc'])."<br/><b>Comment:</b> ".nl2br($items['woi_comment']); ?></td>
                                              <td><?php echo $items['otwi_qty']; $qtyttl = $qtyttl + $items['otwi_qty']; ?></td>
                                              <td style="word-break: break-all"><textarea class="form-control" rows="12" cols="10"><?php echo $items['serialkey']; ?></textarea></td>
                                              <td><?php echo $items['otwi_price']; ?></td>
                                              <td><?php echo $items['otwi_total']; $ttl = $ttl + $items['otwi_total'];  ?></td>
                                              <td><?php echo $items['otwi_discount']; ?></td>
                                              <td><?php echo $items['woi_gst']; ?></td>
                                              <td><?php echo $items['otwi_ftotal']; $fttl = $fttl + $items['otwi_ftotal']; ?></td>
                                        </tr>
                                     <?php } ?>
                                     <?php if(isset($outward_data['wo_charges']) && ($outward_data['wo_charges'] != '')){
                                            //$charges = json_decode($outward_data['wo_charges']);
                                            $charges = json_decode(json_encode($outward_data['wo_charges']),true);
                                            if(is_array($charges) && !empty($charges))
                                            { $charge_ar=json_decode($charges);
                                                 $chargestr = '<tr><td colspan="10"><h4 style="color:#F00;"><b>Extra charges</b></h4></td></tr><tr>
                                                    <th style="text-align: left;" colspan="5">Title</th>
                                                    <th style="text-align: center;"></th>
                                                    <th style="text-align: center;">Amount</th>
                                                    <th style="text-align: center;"></th>
                                                    <th style="text-align: center;">GST</th>
                                                    <th style="text-align: center;">F.Total</th>
                                                </tr>';?>
                                                <?php $jc = -1;
                                            foreach ($charge_ar as $chargekey => $chargevalue) { if(isset($chargevalue->title) && ($chargevalue->title != '')){ $jc++; if($jc == 0){ echo $chargestr; } ?>
                                        <tr>
                                            <td style="text-align: left;" colspan="5"><?php echo $chargevalue->title; ?></td>
                                            <td style="text-align: center;"></td>
                                            <td style="text-align: center;"><?php echo $chargevalue->amount; $ttl = $ttl + $chargevalue->amount; ?></td>
                                            <td style="text-align: center;"></td>
                                            <td style="text-align: center;"><?php echo $chargevalue->gst; ?></td>
                                            <td style="text-align: center;"><?php echo $chargevalue->ftotal; $fttl = $fttl + $chargevalue->ftotal; ?></td>
                                        </tr>
                                        <?php } } } } ?>
                                        <tr data-toggle="collapse" data-target="#idemo<?php echo $items['otwi_id']; ?>">
                                              <td colspan="3" style="text-align:right; font-size:20px;"><b>Total :</b></td>
                                              <td style="text-align:center; font-size:20px;"><b><?php echo $qtyttl; ?></b></td>
                                              <td style="word-break: break-all"></td>
                                              <td></td>
                                              <td style="text-align:center; font-size:20px;"><b><?php echo $ttl;  ?></b></td>
                                              <td></td>
                                              <td></td>
                                              <td style="text-align:center; font-size:20px;"><b><?php echo $fttl; ?></b></td>
                                        </tr>
                                    </table>                                    
                                   <div class="row">
                                	<div class="col-md-2">
										<span class="pre-col-left"> Prepard By:</span><span class="pre-col-right"><?php echo $outward_data['preparedbyf'].$outward_data['preparedbyl']; ?></span>
									</div>
									<div class="col-md-2">
										<span class="test-col-left">Tested By:</span><span  class="test-col-right"><?php echo $outward_data['testedbyf'].$outward_data['testedbyl']; ?></span>
									</div>
                                    <div class="col-md-6">
                                        <a class="btn btn-primary green" target="_blank" href="<?php echo base_url(); ?>pdf/wo/wo<?php echo encrypt_decrypt('encrypt',$outward_data['wo_id']); ?>.pdf"><i class="fa fa-file-pdf-o"></i></a>
                                        <a href="<?php echo base_url(); ?>Dashboard_workorder_final/account_edit_otw?otw_id=<?php echo $outward_data['otw_id']; ?>" class="btn btn-sm btn-success btn-left"><i class="fa fa-pencil"></i></a>
                                         <a href="<?php echo base_url(); ?>Dashboard_workorder_final/view_wo_sticker?otw_id=<?php echo $outward_data['otw_id']; ?>" class="btn btn-sm btn-success btn-left"><i class="fa fa-file-pdf-o"></i> Cover</a>
                                         <a href="<?php echo base_url(); ?>Dashboard_workorder_final/view_coverwo_sticker?otw_id=<?php echo $outward_data['otw_id']; ?>" class="btn btn-sm btn-success btn-left"><i class="fa fa-file-powerpoint-o"></i> Sticker</a>
                                         
                                         <a href="<?php echo base_url(); ?>Dashboard_workorder_final/invnocheck?invoice_tupe=1&otw_id=<?php echo $outward_data['otw_id']; ?>" class="btn btn-sm btn-<?php echo isset($outward_data['otw_invoice_type']) && ($outward_data['otw_invoice_type'] == 1) ? "warning" : "success"; ?> btn-left">TI</a>
                                         <a href="<?php echo base_url(); ?>Dashboard_workorder_final/invnocheck?invoice_tupe=2&otw_id=<?php echo $outward_data['otw_id']; ?>" class="btn btn-sm btn-<?php echo isset($outward_data['otw_invoice_type']) && ($outward_data['otw_invoice_type'] == 2) ? "warning" : "success"; ?> btn-left">RT</a>
                                         <a href="<?php echo base_url(); ?>Dashboard_workorder_final/invnocheck?invoice_tupe=3&otw_id=<?php echo $outward_data['otw_id']; ?>" class="btn btn-sm btn-<?php echo isset($outward_data['otw_invoice_type']) && ($outward_data['otw_invoice_type'] == 3) ? "warning" : "success"; ?> btn-left">RP</a>
                                    </div>
                                    <div class="col-md-1">
                                    </div>
                                    <div class="col-md-1">
                                        <a href="<?php echo base_url(); ?>Dashboard_workorder_final/account_delete_otw?otw_id=<?php echo $outward_data['otw_id']; ?>" onclick="return confirm('Are you sure want to delete this?');" class="btn btn-sm btn-danger btn-left"><i class="fa fa-trash"></i></a>
                                    </div>
                                    </div>
  									<br>
                                    <?php /* <table class="table table-bordered">
                                    <tr>
                                        <td class="wotdark">Prepared By:</td>
                                        <td colspan="2" class="wotc"><strong> <?php echo $outward_data['au_fname']." ".$outward_data['au_lname']; ?></strong></td>
                                        <td class="wotdark">Remarks:</td>
                                        <td colspan="4" class="wotc"><strong><?php echo $outward_data['otw_remark']; ?></strong></td>
                                    </tr>
                                </table> */ ?>
                            </div>
                            <hr/>
                            </div>
                            </div></div></div></div></div></div>
                        <?php } ?>                     
                                    
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
<!-- BEGIN CORE PLUGINS -->
<script type="text/javascript">var base_url = '<?php echo base_url(); ?>';</script>
<script src="<?php echo base_url(); ?>assets/global/plugins/jquery.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
<!-- END CONTAINER -->
<!-- END CORE PLUGINS -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script src="<?php echo base_url(); ?>assets/global/plugins/moment.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/global/plugins/morris/morris.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/global/plugins/morris/raphael-min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/global/plugins/counterup/jquery.waypoints.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/global/plugins/counterup/jquery.counterup.min.js" type="text/javascript"></script>
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
<!-- <script src="<?php //echo base_url(); ?>assets/custom/js/admin_user_form.js" type="text/javascript"></script> -->
<!-- END PAGE LEVEL SCRIPTS -->
<!-- BEGIN THEME LAYOUT SCRIPTS -->
<script src="<?php echo base_url(); ?>assets/layouts/layout5/scripts/layout.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/layouts/global/scripts/quick-sidebar.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/layouts/global/scripts/quick-nav.min.js" type="text/javascript"></script>
<!-- END THEME LAYOUT SCRIPTS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="<?php echo base_url(); ?>assets/pages/scripts/form-samples.min.js" type="text/javascript"></script>
<!-- END PAGE LEVEL SCRIPTS -->
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<?php if(encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['typeid']) == 3){ ?>
<script type="text/javascript">
    //var j = "<php echo $j; ?>";
    var interval = 1;

    setInterval(function () {
        <?php for (; $j >= 1; $j--) { ?>
            timestamp<?php echo $j; ?> = new Date(timestamp<?php echo $j; ?>.getTime() + interval * 1000);
        document.getElementById('countdown<?php echo $j; ?>').innerHTML = timestamp<?php echo $j; ?>.getDay() + ' Days ' + timestamp<?php echo $j; ?>.getHours() + ' Hour ' + timestamp<?php echo $j; ?>.getMinutes() + ' Min ' + timestamp<?php echo $j; ?>.getSeconds() + ' Sec ';
        <?php } ?>
    }, Math.abs(interval) * 1000);

</script>
<?php }else{ ?>
    <script type="text/javascript">
    // Code goes here
$(function(){
  $('.opennext').on('hide.bs.collapse', function () {
    //alert('hiii'+$(this).attr("id"));
    var res = ($(this).attr("id")).split('idemo');
    $('#ibutton'+res[1]).html('<i class="fa fa-plus"></i>');
  });
  $('.opennext').on('show.bs.collapse', function () {
    //alert('hiii'+$(this).attr("id"));
    var res = ($(this).attr("id")).split('idemo');
    $('#ibutton'+res[1]).html('<i class="fa fa-minus"></i>');
  });

  $(document).on('click', '.headingwo', function(){
    var res = ($(this).attr("id")).split('headingwo');
    //alert(res[1]);

    var data = { 'id': res[1]};
     $.ajax({
        type: "POST",
        url: "<?php echo base_url(); ?>Dashboard_workorder_final/change_viewwo",
        data: data,
        dataType:"json",
          success: function(json)
          {
             
          },
          error: function( error )
         {
             //alert( error );
         }
        });

  });

})
</script>
<?php } ?>