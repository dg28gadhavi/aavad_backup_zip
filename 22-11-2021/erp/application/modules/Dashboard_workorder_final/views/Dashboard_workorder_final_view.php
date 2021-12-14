<?php //echo "<pre>"; print_r($work_orders_count['total_woitm']); die;?>
<link rel="stylesheet" href="https://www.webnots.com/resources/font-awesome/css/font-awesome.min.css">
<link href="<?php echo base_url(); ?>assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url(); ?>assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url(); ?>assets/global/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url(); ?>assets/global/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url(); ?>assets/global/plugins/clockface/css/clockface.css" rel="stylesheet" type="text/css" />

<style type="text/css">
/*.portlet-body .table .ttext {display: inline-block; font-weight: 600;}*/
/*.portlet-body .table .headtb {background: #686868;}*/
.portlet-body .table .wotb {background: #dbe8f3; font-weight: 600; width: 150px; font-size: 15px;}
.portlet-body .table .wotdark {background: #d2d2d2; color: #000;font-weight: 600; width: 150px; font-size: 15px;}
.portlet-body .table .wotldark {background: #c4c5d6; color: #000;font-weight: 600; width: 150px; font-size: 15px;}
.portlet-body .table .wotc {background: #f3f3f3; font-weight: 600; width: 150px; color: #000; font-weight: 600;}
/*.portlet-body .table .pretb {background: #fbd6a4;}*/
.portlet-body .table .headtb {background: #686868; color: #fff; }
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
</style>
<!-- END PAGE LEVEL PLUGINS -->
<div class="container-fluid">
<div class="page-content">
<!-- BEGIN BREADCRUMBS -->
	<!-- <h4>Total Wo Item : <?php //echo $work_orders_count['total_woitm']['count']; ?> Total Wo Item Approve bu admin : <?php //echo $work_orders_count['total_approve_woitm']['count']; ?></h4> -->
<!-- END BREADCRUMBS -->
    <!-- BEGIN PAGE BASE CONTENT -->
            <?php 
                $dashboard = array('class' => 'form-horizontal','method' => 'get');
                echo form_open($action_ds,$dashboard); ?> 
                <?php if (!empty($rights_error) || $this->session->flashdata('rights_error') != '') {
            $msg = !empty($rights_error) ? $rights_error : $this->session->flashdata('rights_error');
            echo '<div class="row"><div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button>' . $msg . '</div></div>';}?>
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
                            <select name="production" id="production" class="form-control itmchange" data-size="8" tabindex="4">
                                <option value="">Production Executive</option>
                              <?php  foreach($production_user as $exe) { ?>
                                <option value="<?php echo $exe['au_id'];?>" <?php if($this->input->get('production') && ($this->input->get('production') != '') && ($this->input->get('production') == $exe['au_id'])){ ?> selected <?php } ?>><?php echo $exe['au_fname'].' '.$exe['au_lname']; ?></option><?php  } ?>
                            </select>
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
                              <?php  foreach($work_orders['completed_wo'] as $wodetails) {

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

                                ?>  <option value="<?php echo $vdata['master_party_id'];?>" <?php if($this->input->get('vendor') && ($this->input->get('vendor') != '') && ($this->input->get('vendor') == $vdata['master_party_id'])){ ?> selected <?php } ?>><?php echo $vdata['master_party_com_name']; ?></option><?php } ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-lg-1 col-md-1 col-sm-1 col-xs-12 text-left">
                        <button type="submit" tabindex="5" class="btn green text-left" ><i class="fa fa-check"></i></button>
                        <a href="<?php echo base_url().'Dashboard_workorder_final'; ?>" class="btn red text-left" ><i class="fa fa-refresh"></i></a>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 text-left">
                    
                        <button type="button" class="btn btn-primary">No of work order = <span class="badge"><?php echo count($work_orders['completed_wo']); ?></span></button>
                        <a href="<?php echo base_url(); ?>Dashboard_workorder_final/wo_report" class="btn btn-primary">Report</a>
                 
                </div>
            </div> 
            <?php echo form_close(); ?>
    		<div class="row">
                            <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
                                <div class="dashboard-stat2 bordered sales-dashbg">
                                    <div class="display">
                                        <div class="number">
                                            <h3 class="font-green-sharp">
                                                <span data-counter="counterup" data-value="<?php echo isset($work_orders_count['total_sm_pending']['count']) ? number_format($work_orders_count['total_sm_pending']['count']) : 0;?>"></span>
                                                <small class="font-green-sharp"></small>
                                            </h3>
                                            <a href="<?php echo base_url(); ?>Work_order_item_list/Work_order_item_list_report?smapproved=2"><small>SM PENDING</small></a>
                                        </div>
                                        <div class="icon">
                                            <i class="icon-pie-chart"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
                                <div class="dashboard-stat2 bordered sales-dashbg">
                                    <div class="display">
                                        <div class="number">
                                            <h3 class="font-green-sharp">
                                                <span data-counter="counterup" data-value="<?php echo isset($work_orders_count['total_sm_approve']['count']) ? number_format($work_orders_count['total_sm_approve']['count']) : 0;?>"></span>
                                                <small class="font-green-sharp"></small>
                                            </h3>
                                            <a href="<?php echo base_url(); ?>Work_order_item_list/Work_order_item_list_report?smapproved=1"><small>SM Approved</small></a>
                                        </div>
                                        <div class="icon">
                                            <i class="icon-pie-chart"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
                                <div class="dashboard-stat2 bordered admin-dashbg">
                                    <div class="display">
                                        <div class="number">
                                            <h3 class="font-green-sharp">
                                                <span data-counter="counterup" data-value="<?php echo isset($work_orders_count['pending_woitm']['count']) ? number_format($work_orders_count['pending_woitm']['count']) : 0;?>"></span>
                                                <small class="font-green-sharp"></small>
                                            </h3>
                                            <a href="<?php echo base_url(); ?>Work_order_item_list/Work_order_item_list_report?adminapproved=2"><small>A Pending</small></a>
                                        </div>
                                        <div class="icon">
                                            <i class="icon-pie-chart"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
                                <div class="dashboard-stat2 bordered admin-dashbg">
                                    <div class="display">
                                        <div class="number">
                                            <h3 class="font-green-sharp">
                                                <span data-counter="counterup" data-value="<?php echo isset($work_orders_count['total_approve_woitm']['count']) ? number_format($work_orders_count['total_approve_woitm']['count']) : 0;?>"></span>
                                                <small class="font-green-sharp"></small>
                                            </h3>
                                            <a href="<?php echo base_url(); ?>Work_order_item_list/Work_order_item_list_report?adminapproved=1"><small>A Approved</small></a>
                                        </div>
                                        <div class="icon">
                                            <i class="icon-pie-chart"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>                            
                            <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
                                <div class="dashboard-stat2 bordered pm-dashbg">
                                    <div class="display">
                                        <div class="number">
                                            <h3 class="font-green-sharp">
                                                <span data-counter="counterup" data-value="<?php echo isset($work_orders_count['total_pm_pending']['count']) ? number_format($work_orders_count['total_pm_pending']['count']) : 0;?>"></span>
                                                <small class="font-green-sharp"></small>
                                            </h3>
                                            <a href="<?php echo base_url(); ?>Work_order_item_list/Work_order_item_list_report?pmapproved=2"><small>PM Pending</small></a>
                                        </div>
                                        <div class="icon">
                                            <i class="icon-pie-chart"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
                                <div class="dashboard-stat2 bordered pm-dashbg">
                                    <div class="display">
                                        <div class="number">
                                            <h3 class="font-green-sharp">
                                                <span data-counter="counterup" data-value="<?php echo isset($work_orders_count['total_pm_approve']['count']) ? number_format($work_orders_count['total_pm_approve']['count']) : 0;?>"></span>
                                                <small class="font-green-sharp"></small>
                                            </h3>
                                            <a href="<?php echo base_url(); ?>Work_order_item_list/Work_order_item_list_report?pmapproved=1"><small>PM Approved</small></a>
                                        </div>
                                        <div class="icon">
                                            <i class="icon-pie-chart"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
                                <div class="dashboard-stat2 bordered production-dashbg">
                                    <div class="display">
                                        <div class="number">
                                            <h3 class="font-green-sharp">
                                                <span data-counter="counterup" data-value="<?php echo isset($work_orders_count['total_production_pending']['count']) ? number_format($work_orders_count['total_production_pending']['count']) : 0;?>"></span>
                                                <small class="font-green-sharp"></small>
                                            </h3>
                                            <a href=""><small>Pro1 Pending</small></a>
                                        </div>
                                        <div class="icon">
                                            <i class="icon-pie-chart"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
                                <div class="dashboard-stat2 bordered production-dashbg">
                                    <div class="display">
                                        <div class="number">
                                            <h3 class="font-green-sharp">
                                                <span data-counter="counterup" data-value="<?php echo isset($work_orders_count['total_production_approve']['count']) ? number_format($work_orders_count['total_production_approve']['count']) : 0;?>"></span>
                                                <small class="font-green-sharp"></small>
                                            </h3>
                                            <a href="#"><small>Pro1 Approved</small></a>
                                        </div>
                                        <div class="icon">
                                            <i class="icon-pie-chart"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
                                <div class="dashboard-stat2 bordered production-dashbg">
                                    <div class="display">
                                        <div class="number">
                                            <h3 class="font-green-sharp">
                                                <span data-counter="counterup" data-value="<?php echo isset($work_orders_count['total_pro_sec_pending']['count']) ? number_format($work_orders_count['total_pro_sec_pending']['count']) : 0;?>"></span>
                                                <small class="font-green-sharp"></small>
                                            </h3>
                                            <a href="#"><small>Pro2 Pending</small></a>
                                        </div>
                                        <div class="icon">
                                            <i class="icon-pie-chart"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
                                <div class="dashboard-stat2 bordered production-dashbg">
                                    <div class="display">
                                        <div class="number">
                                            <h3 class="font-green-sharp">
                                                <span data-counter="counterup" data-value="<?php echo isset($work_orders_count['total_pro_sec_approve']['count']) ? number_format($work_orders_count['total_pro_sec_approve']['count']) : 0;?>"></span>
                                                <small class="font-green-sharp"></small>
                                            </h3>
                                            <a href="#"><small>Pro2 Approved</small></a>
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
                                                <span data-counter="counterup" data-value="<?php echo isset($work_orders_count['total_store_pending']['count']) ? number_format($work_orders_count['total_store_pending']['count']) : 0;?>"></span>
                                                <small class="font-green-sharp"></small>
                                            </h3>
                                            <a href=""><small>Store Pending</small></a>
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
                                                <span data-counter="counterup" data-value="<?php echo isset($work_orders_count['total_store_approve']['count']) ? number_format($work_orders_count['total_store_approve']['count']) : 0;?>"></span>
                                                <small class="font-green-sharp"></small>
                                            </h3>
                                            <a href="#"><small>Store Approved</small></a>
                                        </div>
                                        <div class="icon">
                                            <i class="icon-pie-chart"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
                                <div class="dashboard-stat2 bordered">
                                    <div class="display">
                                        <div class="number">
                                            <h3 class="font-green-sharp">
                                                <span data-counter="counterup" data-value="<?php echo isset($work_orders_count['total_stock']['final_points']) ? number_format($work_orders_count['total_stock']['final_points']) : 0;?>"></span>
                                                <small class="font-green-sharp"></small>
                                            </h3>
                                            <a href="#"><small>T.Stock</small></a>
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
                                <div class="dashboard-stat2 bordered account-lbg">
                                    <div class="display">
                                        <div class="number">
                                            <h3 class="font-green-sharp">
                                                <span data-counter="counterup" data-value="<?php echo isset($work_orders_count['total_account_pending']['count']) ? number_format($work_orders_count['total_account_pending']['count']) : 0;?>"></span>
                                                <small class="font-green-sharp"></small>
                                            </h3>
                                            <a href="<?php echo base_url().'Dashboard_workorder_final?show_account=1'; ?>"><small>Inv Pending</small></a>
                                        </div>
                                        <div class="icon">
                                            <i class="icon-pie-chart"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php if(encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['typeid']) == 3){ ?>
                            </div>
                            <div class="row">
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
                                                <span data-counter="counterup" data-value="<?php echo isset($work_orders_count['total_lastmonth_sales']['count']) ? number_format($work_orders_count['total_lastmonth_sales']['count']) : 0;?>"></span>
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
                            <?php } ?>
                        </div>

        <?php $woisrno = 0; foreach ($work_orders['completed_wo'] as $key => $work_order) { $woisrno++; ?>
            <?php //if(isset($work_order['items']) && is_array($work_order['items']) && !empty($work_order['items'])){ ?>
        <div id="wonoids<?php echo $work_order['wo_id']; ?>">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">

            <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                <div class="panel panel-default">
                    <div class="panel-heading headingwo" role="tab" id="headingwo<?php echo $work_order['wo_id']; ?>">
                        <h4 class="panel-title">
                            <span><a class="<?php if(isset($work_order['woopen_id']) && $work_order['woopen_id'] != NULL){ echo "collapsed";
                            } ?>" role="button" 
                            <?php if(isset($work_order['spending']) && ($work_order['spending'] > 0))
                                { ?> style="background-color:green;" <?php } ?>
                            <?php if(isset($work_order['smpending']) && ($work_order['smpending'] > 0))
                                { ?> style="background-color:green;" <?php } ?>
                            <?php if(isset($work_order['prompending']) && ($work_order['prompending'] > 0))
                                { ?> style="background-color:green;" <?php } ?>
                            <?php if(isset($work_order['prom_outwardpending']) && ($work_order['prom_outwardpending'] > 0))
                                { ?> style="background-color:#333;" <?php } ?>
                                 data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $work_order['wo_id']; ?>" aria-expanded="true" aria-controls="collapse<?php echo $work_order['wo_id']; ?>">
                                <?php 
                                $oldwono = isset($work_order['wo_old_wo_no']) && ($work_order['wo_old_wo_no'] != '') ? " [ OLD W.O.: ".$work_order['wo_old_wo_no']." ] " : '';
                                echo $work_order['wo_wo_no'].$oldwono." [ ".$work_order['type_name']." ] [ ".$work_order['wo_customer_name']." ]"."  [PB : ".$work_order['prepared_by_fname']." ] [CB : ".$work_order['created_by_fname']." ]"." [ Dt.:".date("d-m-Y", strtotime($work_order['wo_wo_date']))." ]"." [ PO :".$work_order['wo_po_no']." ]"." <span class='badge'>".$woisrno."</span> ";
                                if(isset($work_order['spending']) && ($work_order['spending'] > 0))
                                {
                                    echo " <span class='badge' style='color:#000; background-color:#F1C40F;'> pennding approval : ".$work_order['spending']."</span>";
                                }
                                if(isset($work_order['smpending']) && ($work_order['smpending'] > 0))
                                {
                                    echo " <span class='badge' style='color:#000; background-color:#F1C40F;'> pennding approval : ".$work_order['smpending']."</span>";
                                }
                                if(isset($work_order['prompending']) && ($work_order['prompending'] > 0))
                                {
                                    echo " <span class='badge' style='color:#000; background-color:#F1C40F;'> pennding work order : ".$work_order['prompending']."</span>";
                                }
                                if(isset($work_order['prom_outwardpending']) && ($work_order['prom_outwardpending'] > 0))
                                {
                                    echo " <span class='badge badge-success' style='color:#000; background-color:#36c6d3;'> pennding outward : ".$work_order['prompending']."</span>";
                                } ?>
                            </a>
                        </h4>
                    </div>
                    <div id="collapse<?php echo $work_order['wo_id']; ?>" class="panel-collapse collapse <?php echo (isset($work_order['woopen_id']) && ($work_order['woopen_id'] != NULL)) ? "in" : ""; ?>" role="tabpanel" aria-labelledby="headingOne">
                    	<div class="portlet-body">
                    		<?php $dep_id =  encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['dep_id']);
                    if($dep_id == 11){ ?>
                    		<div class="col-lg-6 col-md-6 col-sm-6">
                    		<?php }else{ ?>
                    			<div class="col-lg-9 col-md-9 col-sm-9">
                    			<?php } ?>
                        		<hr/>
                                <div class="table-responsive">
                            		<table class="table table-bordered">
										<tr>
										  	<th colspan="2" class="wotb" style="text-align: center;width:110px;">W.O. No. :</th>
										  	<td colspan="2" class="wotb" style="width:250px;"><?php echo $work_order['wo_wo_no']; ?></td>
                                            <th class="wotb" style="text-align: center;"><a href="<?php echo base_url(); ?>Work_order/load_pdf/<?php echo encrypt_decrypt('encrypt',$work_order['wo_id']); ?>" target="_blank" class="btn btn-success"><i class="fa fa-file-pdf-o" aria-hidden="true"></i></a> 
                                            <a href="<?php echo base_url(); ?>Work_order/other_details/<?php echo encrypt_decrypt('encrypt',$work_order['wo_id']); ?>?fromwofinal=1" target="_blank" class="btn btn-danger"><i class="fa fa-plus" aria-hidden="true"></i></a>
                                            <?php if($dep_id == 11){ ?>
                                            <a href="<?php echo base_url(); ?>Dashboard_workorder_final/complate_workorder_fainal/<?php echo encrypt_decrypt('encrypt',$work_order['wo_id']); ?>?fromwofinal=1" onclick="return confirm('Are you sure you want to complate this records?')" class="btn btn-danger"><i class="fa fa-check" aria-hidden="true"></i></a>

                                            <a href="<?php echo base_url(); ?>Dashboard_workorder_final/delete_workorder_fainal/<?php echo encrypt_decrypt('encrypt',$work_order['wo_id']); ?>?fromwofinal=1" onclick="return confirm('Are you sure you want to delete this records?')" class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                        <?php } ?>

                                        </th>
										  	<th class="wotb" style="text-align: center;width:110px;">Date :</th>
										  	<td colspan="2" class="wotb"><?php echo $work_order['wo_wo_date']; ?></td>
									 	</tr>
									 </table>
									 <table class="table table-bordered">
										<tr>
											<td class="wotdark">Name:</td>
										  	<td class="wotc" colspan="3"><strong><?php echo $work_order['wo_customer_name']; ?> <span style=color:#F00000;>[ Master Name: <?php echo $work_order['master_party_com_name']; ?> ] </span> </strong></td>
                                            <td class="wotdark">GST No.</td>
                                            <td class="wotc" colspan="2"><?php echo $work_order['wo_gstno']; ?></td>
										</tr>
										<tr>
											<td class="wotldark">Address:</td>
										  	<td colspan="7"></strong><?php echo $work_order['wo_address']; ?></td>
										</tr>
									</table>
								<h4><span class="badge badge-color sales-lbg">Sales</span> <span class="badge badge-color sm-lbg">Sales Manager</span> <span class="badge badge-color admin-lbg">Admin</span> <span class="badge badge-color pm-lbg">Production Manager</span> <span class="badge badge-color production-lbg">Production</span> <span class="badge badge-color store-lbg">Store</span> <span class="badge badge-color production-two-lbg">Production</span> <span class="badge badge-color account-lbg">Account</span> <span class="badge badge-color dispatch-lbg">dispatch</span></h4>
									<table class="table table-bordered">
										<tr class="headtb">
											<th style="text-align: center;">SR. No.</th>
											<th colspan="2" style="text-align: center;">Item Description</th>
											<th style="text-align: center;">Qty</th>
											<?php $type_id = encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['typeid']);
											  $dep_id = encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['dep_id']);
												if($type_id == 3 || $dep_id == 10 || $dep_id == 11 || $dep_id == 5)
												{ ?>
													<th style="text-align: center;">Stock</th>
												<?php } ?>
                                            <th style="text-align: center;">Rate</th>
                                            <th style="text-align: center;">Discount</th>											
											<th colspan="2" style="text-align: center;">Check</th>										 
										</tr>
									 	<?php $counter = 0; $j = 0; $final_total = 0;  foreach ($work_order['items'] as $itemkey => $items) { $counter++; $j++;
									 		$step = 0;
									 		if($items['woi_manager_approve'] == '1')
									 		{
									 			$step = 1;
									 		}
									 		if($items['woi_admin_approve'] == '1'){
									 			$step = 2;
									 		}
									 		if($items['woi_promanager_approve'] == '1'){
									 			$step = 3;
									 		}
									 		if($items['woi_production_approve'] == '1'){
									 			$step = 4;
									 		}
									 		if($items['woi_store_approve'] == '1'){
									 			$step = 5;
									 		}
									 		if($items['woi_production_approve'] == '3'){
									 			$step = 6;
									 		}
									 		$classclr = '';
									 		/* 
											.sales-lbg{background: #fcecd6;}
.admin-lbg{background: #cce6ff;}
.sm-lbg{background: #efe9ab;}
.pm-lbg{background: #c7eded;}
.production-lbg{background: #fee2df;}
.account-lbg{background: #ddd;}
.dispatch-lbg{background: #e5dfff;}

.store-lbg{background: #FFE1BA;}
.production-two-lbg{background: #772120; color: #F00000;}
									 		*/
									 		if($step==0)
									 		{
									 			$classclr = 'sales-lbg';
									 		}else if($step==1){
									 			$classclr = 'sm-lbg';
									 		}else if($step==2){
									 			$classclr = 'admin-lbg';
									 		}else if($step==3){
									 			$classclr = 'pm-lbg';
									 		}else if($step==4){
									 			$classclr = 'production-lbg';
									 		}else if($step==5){
									 			$classclr = 'store-lbg';
									 		}else if($step==6){
									 			$classclr = 'production-two-lbg';
									 		}
									 		//echo "<pre>";print_r($items);die;
									 		?>
									 	<tr class="<?php echo $classclr; ?>" <?php /* data-toggle="collapse" data-target="#idemo<?php echo $items['woi_id']; ?>" */ ?> >
											  <td><?php echo $counter; ?></td>
											  <td colspan="2"><?php echo $items['woi_part_no']." <span style=".'"color:#F00000;"'.">[ Master Name: ".$items['master_item_part_no']." ]</span> ".$items['woi_itm_title']."</br>Desc: ".nl2br($items['woi_itm_desc'])."</br>Comment: ".nl2br($items['woi_comment']); ?>
                                              <a href="<?php echo base_url(); ?>Dashboard_workorder_final/change_desciption?wo_itemid=<?php echo $items['woi_id']; ?>&itemid=<?php echo $items['woi_item_id']; ?>&wo_id=<?php echo $items['woi_wo_id']; ?>" target="_BLANK" class="btn btn-danger"><i class="fa fa-pencil"></i> Change Comment</a>
                                              <?php if($items['woi_store_approve'] == '0'){ ?>
                                              <a href="<?php echo base_url(); ?>Work_order/other_details/<?php echo encrypt_decrypt("encrypt",$items['woi_wo_id']); ?>?itemid=<?php echo $items['woi_id']; ?>&acttype=edit&fromwofinal=1" target="_BLANK" class="btn btn-primary"><i class="fa fa-pencil"></i> Edit</a>
                                              <?php } ?>
                                              </td>
											  <td><?php echo $items['woi_qty']; ?></td>
											  <?php if($type_id == 3 || $dep_id == 10 || $dep_id == 11 || $dep_id == 5)
													{ ?>
											  <td><?php echo $stock = $items['tcreditpoints'] - $items['tdebitpoints'];?></td>
											  <?php } ?>
											  <td><?php echo $items['woi_price']; $final_total = $final_total + ($items['woi_qty']*$items['woi_price']); ?></td>
                                              <td><?php echo $items['woi_discount']; ?></td>
											  <td colspan="2" style="text-align: center;">
											  <?php 
												if($type_id == 3)
												{
													//echo $items['woi_admin_approve'];die;
												  if($items['woi_admin_approve'] == '0')
												   {
                                                    $date1 = strtotime($items['woi_manager_approve_date']);
                                                    $date2 = strtotime(date("Y-m-d H:i:s"));
                                    $diff = abs($date2 - $date1);
                                    $years = floor($diff / (365*60*60*24));
                                    $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
                                    $days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
                                    $hours = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24 - $days*60*60*24) / (60*60));
                                    $minutes = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24 - $days*60*60*24 - $hours*60*60)/ 60);
                                    $seconds = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24 - $days*60*60*24  - $hours*60*60 - $minutes*60));
                                    $work_orders['completed_wo'][$key]['jkey'] = $j;
											?>
                                            <script type="text/javascript">
                                        var outid = "<?php echo $j; ?>";
                                        var new<?php echo $work_order['wo_id']; ?>input<?php echo $j; ?> = {
                                            year: "<?php echo $years; ?>",
                                            month: "<?php echo $months; ?>",
                                            day: "<?php echo $days; ?>",
                                            hours: "<?php echo $hours; ?>",
                                            minutes: "<?php echo $minutes; ?>",
                                            seconds: "<?php echo $seconds; ?>",
                                        };
                                        //console.log(input);
                                        var new<?php echo $work_order['wo_id']; ?>timestamp<?php echo $j; ?> = new Date(new<?php echo $work_order['wo_id']; ?>input<?php echo $j; ?>.year, new<?php echo $work_order['wo_id']; ?>input<?php echo $j; ?>.month, new<?php echo $work_order['wo_id']; ?>input<?php echo $j; ?>.day,
                                        new<?php echo $work_order['wo_id']; ?>input<?php echo $j; ?>.hours, new<?php echo $work_order['wo_id']; ?>input<?php echo $j; ?>.minutes, new<?php echo $work_order['wo_id']; ?>input<?php echo $j; ?>.seconds);
                                    </script>
											  <a href="<?php echo base_url(); ?>Dashboard_workorder_final/check_qty?wo_itemid=<?php echo $items['woi_id']; ?>&itemid=<?php echo $items['woi_item_id']; ?>&wo_id=<?php echo $items['woi_wo_id']; ?>" class="btn btn-success"><i class="fa fa-check"></i></a>
											  <a href="<?php echo base_url(); ?>Dashboard_workorder_final/edit_qty?wo_itemid=<?php echo $items['woi_id']; ?>&itemid=<?php echo $items['woi_item_id']; ?>&wo_id=<?php echo $items['woi_wo_id']; ?>" target="_BLANK" class="btn btn-danger"><i class="fa fa-pencil"></i></a>
											  <a href="<?php echo base_url(); ?>Dashboard_workorder_final/delete_itm?wo_itemid=<?php echo $items['woi_id']; ?>&itemid=<?php echo $items['woi_item_id']; ?>&wo_id=<?php echo $items['woi_wo_id']; ?>"  onclick="return confirm('Are you sure you want to delete this records?')" class="btn btn-success"><i class="fa fa-close"></i></a>
                                              <br/><span style="color:#F00;font-weight: 600;" id="<?php echo $work_order['wo_id']; ?>countdown<?php echo $j; ?>"></span>
											  <?php 	
													}else{ ?>
														<a href="#" class="btn btn-success">A</a>
													<?php } 
												}else{
													if($dep_id == 10)
													{
														if($items['woi_manager_approve'] == '0'){ ?>
														<a href="<?php echo base_url(); ?>Dashboard_workorder_final/check_qty?wo_itemid=<?php echo $items['woi_id']; ?>&itemid=<?php echo $items['woi_item_id']; ?>&wo_id=<?php echo $items['woi_wo_id']; ?>" <?php if($stock <= 0 && $stock <= $items['woi_qty']){ ?> onclick="alert('Not Enough Stock'); return false;" <?php } ?> class="btn btn-success"><i class="fa fa-check"></i></a>
														<a href="<?php echo base_url(); ?>Dashboard_workorder_final/edit_qty?wo_itemid=<?php echo $items['woi_id']; ?>&itemid=<?php echo $items['woi_item_id']; ?>&wo_id=<?php echo $items['woi_wo_id']; ?>" target="_BLANK" class="btn btn-danger" <?php if($stock <= 0){ ?> onclick="alert('Not Enough Stock'); return false;" <?php } ?>><i class="fa fa-pencil"></i></a>
														<a href="<?php echo base_url(); ?>Dashboard_workorder_final/delete_itm?wo_itemid=<?php echo $items['woi_id']; ?>&itemid=<?php echo $items['woi_item_id']; ?>&wo_id=<?php echo $items['woi_wo_id']; ?>" onclick="return confirm('Are you sure you want to delete this records?')" class="btn btn-success"><i class="fa fa-close"></i></a>
															<?php 
														}else{ ?>
														<a href="#" class="btn btn-success">A</a>
													<?php }
													}else if($dep_id == 11)
													{
														if($items['woi_promanager_approve'] == '0'){ $date1 = strtotime($items['woi_manager_approve_date']);
                                                    $date2 = strtotime(date("Y-m-d H:i:s"));
                                    $diff = abs($date2 - $date1);
                                    $years = floor($diff / (365*60*60*24));
                                    $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
                                    $days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
                                    $hours = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24 - $days*60*60*24) / (60*60));
                                    $minutes = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24 - $days*60*60*24 - $hours*60*60)/ 60);
                                    $seconds = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24 - $days*60*60*24  - $hours*60*60 - $minutes*60));
                                    $work_orders['completed_wo'][$key]['jkey'] = $j;
                                            ?>
                                            <script type="text/javascript">
                                        var outid = "<?php echo $j; ?>";
                                        var new<?php echo $work_order['wo_id']; ?>input<?php echo $j; ?> = {
                                            year: "<?php echo $years; ?>",
                                            month: "<?php echo $months; ?>",
                                            day: "<?php echo $days; ?>",
                                            hours: "<?php echo $hours; ?>",
                                            minutes: "<?php echo $minutes; ?>",
                                            seconds: "<?php echo $seconds; ?>",
                                        };
                                        //console.log(input);
                                        var new<?php echo $work_order['wo_id']; ?>timestamp<?php echo $j; ?> = new Date(new<?php echo $work_order['wo_id']; ?>input<?php echo $j; ?>.year, new<?php echo $work_order['wo_id']; ?>input<?php echo $j; ?>.month, new<?php echo $work_order['wo_id']; ?>input<?php echo $j; ?>.day,
                                        new<?php echo $work_order['wo_id']; ?>input<?php echo $j; ?>.hours, new<?php echo $work_order['wo_id']; ?>input<?php echo $j; ?>.minutes, new<?php echo $work_order['wo_id']; ?>input<?php echo $j; ?>.seconds);
                                    </script>
														<a href="<?php echo base_url(); ?>Dashboard_workorder_final/check_qty?wo_itemid=<?php echo $items['woi_id']; ?>&itemid=<?php echo $items['woi_item_id']; ?>&wo_id=<?php echo $items['woi_wo_id']; ?>" <?php if($stock <= 0 && $stock <= $items['woi_qty']){ ?> onclick="alert('Not Enough Stock'); return false;" <?php } ?> class="btn btn-success"><i class="fa fa-check"></i></a>

                                                        <?php if($stock == 0 || $stock <= $items['woi_qty']){  ?>
                                                             <a href="<?php echo base_url(); ?>Dashboard_workorder_final/mf_approve?wo_itemid=<?php echo $items['woi_id']; ?>&itemid=<?php echo $items['woi_item_id']; ?>&wo_id=<?php echo $items['woi_wo_id']; ?>" class="btn btn-success">MF</i></a>
                                                        <?php } ?>

                                                        

                                                        <a href="<?php echo base_url(); ?>Dashboard_workorder_final/production_bypass?wo_itemid=<?php echo $items['woi_id']; ?>&itemid=<?php echo $items['woi_item_id']; ?>&wo_id=<?php echo $items['woi_wo_id']; ?>" onclick="return confirm('Are you sure you want to Bypass Production?')" class="btn btn-success">Bypass</a>
                                                        
                                                        


														<a href="<?php echo base_url(); ?>Dashboard_workorder_final/edit_qty?wo_itemid=<?php echo $items['woi_id']; ?>&itemid=<?php echo $items['woi_item_id']; ?>&wo_id=<?php echo $items['woi_wo_id']; ?>" target="_BLANK" class="btn btn-danger" <?php if($stock <= 0){ ?> onclick="alert('Not Enough Stock'); return false;" <?php } ?>><i class="fa fa-pencil"></i></a>
														<a href="<?php echo base_url(); ?>Dashboard_workorder_final/delete_itm?wo_itemid=<?php echo $items['woi_id']; ?>&itemid=<?php echo $items['woi_item_id']; ?>&wo_id=<?php echo $items['woi_wo_id']; ?>" onclick="return confirm('Are you sure you want to delete this records?')" class="btn btn-success"><i class="fa fa-close"></i></a>
                                                        <br/><span style="color:#F00;font-weight: 600;" id="<?php echo $work_order['wo_id']; ?>countdown<?php echo $j; ?>"></span>
															<?php 
														}else{ if(isset($items['woi_production_cid']) && ($items['woi_production_cid'] == 0)){ ?>
														<a href="<?php echo base_url(); ?>Dashboard_workorder_final/assign_user?wo_itemid=<?php echo $items['woi_id']; ?>&itemid=<?php echo $items['woi_item_id']; ?>&wo_id=<?php echo $items['woi_wo_id']; ?>" target="_BLANK" class="btn btn-warning" ><i class="fa fa-user"></i></a>
														
													<?php }else{ ?>
                                                        <a href="<?php echo base_url(); ?>Dashboard_workorder_final/assign_user?wo_itemid=<?php echo $items['woi_id']; ?>&itemid=<?php echo $items['woi_item_id']; ?>&wo_id=<?php echo $items['woi_wo_id']; ?>" target="_BLANK" class="btn btn-warning" ><i class="fa fa-user"></i></a>
														Assign To <?php echo $items['production_fname'].' '.$items['production_lname']; ?>
													<?php }

                                                            if($items['woi_store_approve'] == '0'){ ?>
                                                                
                                                                <a href="<?php echo base_url(); ?>Dashboard_workorder_final/delete_itm?wo_itemid=<?php echo $items['woi_id']; ?>&itemid=<?php echo $items['woi_item_id']; ?>&wo_id=<?php echo $items['woi_wo_id']; ?>" onclick="return confirm('Are you sure you want to delete this records?')" class="btn btn-success"><i class="fa fa-close"></i></a>
                                                            <?php }
                                                     }
													}
												} ?>
												</td>
												<?php /* <td><button id="ibutton<?php echo $items['woi_id']; ?>" type="button" class="btn btn-info" data-toggle="collapse" data-target="#idemo<?php echo $items['woi_id']; ?>"><i class="fa fa-plus"></i></button></td> */ ?>
										</tr>
										<?php /* <tr id="idemo<?php echo $items['woi_id']; ?>" ">
										 	<td colspan="8">
										 		<!-- <span class="boxhover">
										 		<button class="rbutton rbutton5 rgreen">Sales</button>
										 		<div class="box-content"><h6>Jitendra Talpada <span class="badge badge-secondary">12:30</span></h6>
										 		</div></span>
										 		<button class="rbutton rbutton5 <?php echo isset($items['woi_admin_approve']) && ($items['woi_admin_approve'] == '1') ? "rgreen" : "rred"; ?> ">Admin</button>
										 		<button class="rbutton rbutton5 <?php echo isset($items['woi_manager_approve']) && ($items['woi_manager_approve'] == '1') ? "rgreen" : "rred"; ?>">Sales Manager</button>
										 		<button class="rbutton rbutton5 <?php echo isset($items['woi_promanager_approve']) && ($items['woi_promanager_approve'] == '1') ? "rgreen" : "rred"; ?>">Production Manager</button> -->
										 		<?php /* <button class="rbutton rbutton5 rgreen">Production</button>
										 		<button class="rbutton rbutton5 rgreen">Account</button>
										 		<button class="rbutton rbutton5 rgreen">Production</button>
										 		<button class="rbutton rbutton5 rgreen">Dispatch</button> */ ?><?php /*
										 	</td>
										</tr> */ ?>
									 <?php } ?>
                                     <?php if(isset($work_order['wo_charges']) && ($work_order['wo_charges'] != '')){
                                            $charges = $work_order['wo_charges'];
                                            $charges_arrray = json_decode($work_order['wo_charges']);
                                            if(is_array($charges_arrray) && !empty($charges_arrray))
                                            { $charge_ar=json_decode($charges);
                                                 $chargestr = '<tr><td colspan="10"><h4 style="color:#F00;"><b>Extra charges</b></h4></td></tr><tr>
                                                    <th style="text-align: center;">Title</th>
                                                    <th colspan="2" style="text-align: center;"></th>
                                                    <th style="text-align: center;">Amount</th>
                                                    <th style="text-align: center;">GST</th>
                                                    <th style="text-align: center;">Tax amt.</th>
                                                    <th style="text-align: center;">F.Total</th>
                                                    <th colspan="2" style="text-align: center;"></th>
                                                </tr>';?>
                                                <?php $jc = -1;
                                            foreach ($charge_ar as $chargekey => $chargevalue) { if(isset($chargevalue->title) && ($chargevalue->title != '')){ $jc++; if($jc == 0){ echo $chargestr; } ?>
                                        <tr>
                                            <td style="text-align: center;"><?php echo $chargevalue->title ?></td>
                                            <td colspan="2" style="text-align: center;"></td>
                                            <td style="text-align: center;"><?php echo $chargevalue->amount ?></td>
                                            <td style="text-align: center;"><?php echo $chargevalue->gst ?></td>
                                            <td style="text-align: center;"><?php echo $chargevalue->taxamt ?></td>
                                            <td style="text-align: center;"><?php echo $chargevalue->ftotal; $final_total = $final_total + $chargevalue->ftotal; ?></td>
                                            <td colspan="2" style="text-align: center;"></td>
                                        </tr>
                                        <?php } } } } ?>
                                        <tr>
                                            <td style="text-align: center;"></td>
                                            <td colspan="2" style="text-align: center;"></td>
                                            <td style="text-align: center;"></td>
                                            <td style="text-align: center; font-weight:bold;">Total:</td>
                                            <td style="text-align: center;"><?php echo $final_total; ?></td>
                                            <td style="text-align: center;"></td>
                                            <td colspan="2" style="text-align: center;"></td>
                                        </tr>
									</table>
									<table class="table table-bordered">
									<tr>
										  <td class="wotdark">Deliv. Time / Date:</td>
										  <td colspan="2" class="wotc"><?php echo $work_order['wo_deliverytime']; ?></td>
										  <td class="wotdark">Delivery By:</td>
										  <td colspan="2" class="wotc"><?php echo $work_order['wo_deliveryby']; ?></td>
                                          <td class="wotdark">Prepared By:</td>
                                          <td class="wotc"><strong> <?php echo $work_order['prepared_by_fname']." ".$work_order['prepared_by_lname']; ?></strong></td>
									</tr>
									<tr>
										<!-- <td colspan="3"></td> -->
										<td class="wotldark">Courier Name:</td>
										<td colspan="2"><strong><?php echo $work_order['wo_couriername']; ?></strong></td>
										<td class="wotldark">Docket No.:</td>
										<td colspan="4"><strong><?php echo $work_order['wo_docket_no']; ?></strong></td>
									</tr>
									<tr>
										<td class="wotdark">Payment Terms:</td>
										<td colspan="2" class="wotc"><strong> <?php echo $work_order['wo_paymentterms']; ?></strong></td>
										<td class="wotdark">Remarks:</td>
										<td colspan="4" class="wotc"><strong><?php echo $work_order['wo_remark']; ?></strong></td>
									</tr>
								</table>
                        </div>
                    </div>
                    <?php $dep_id =  encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['dep_id']);
                    if($dep_id == 11){ ?>
                    	<div class="col-lg-6 col-md-6 col-sm-6">
							<hr/>
							<?php
							$abc['work_order'] = $work_order;
							 echo $this->load->view('Production_outward_view',$abc,false); ?>
						</div>
                    <?php }

                    if($dep_id == 11){ ?>
                    	<div class="row">
                    	<div class="col-lg-12 col-md-12 col-sm-12">

                    	<?php }else{ ?>
						<div class="col-lg-3 col-md-3 col-sm-3">
                    	<?php } ?>
                    		<hr/>
							<div class="row">
								<div class="panel-body">
								    <div class="portlet light bordered">
								    	<div class="portlet-title tabbable-line">
								            <div class="caption">
								                <i class=" icon-magnet font-green-sharp"></i>
								                <span class="caption-subject font-green-sharp bold uppercase">Notifications</span>
								            </div>						            
								        </div>
								        <div class="portlet-body">
								        	<table class="table table-bordered">
                                        <tr class="headtb">
                                            <th colspan="2" style="text-align: center;">message</th>
                                            <th style="text-align: center;">Date</th>
                                        </tr>
                                        <?php $counter = 0; foreach ($work_order['noti_lists'] as $noti_list) { $counter++; ?>
                                        <tr data-toggle="collapse" data-target="#idemo<?php echo $noti_list['wo_noti_woid']; ?>">
                                             
                                              <td colspan="2"><?php echo $noti_list['wo_noti_msg']; ?></td>
                                              <td><?php echo $noti_list['wo_noti_date']; ?></td>
                                        </tr>
                                     <?php } ?>
                                    </table>
								        </div>
								    </div>
								</div>
							</div>
							<?php if($dep_id == 11){ ?>
								</div>
							<?php } ?>
						</div>
                    
                </div>
            </div>
        </div>
    </div>	                
</div>				
</div>
</div>
<?php }  ?>
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
<script src="<?php echo base_url(); ?>assets/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/global/plugins/uniform/jquery.uniform.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
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
<script src="<?php echo base_url(); ?>assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/global/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/global/plugins/clockface/js/clockface.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/global/plugins/jquery-multi-select/js/jquery.multi-select.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/global/plugins/select2/js/select2.full.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js" type="text/javascript"></script>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="<?php echo base_url(); ?>assets/global/plugins/bootstrap-select/js/bootstrap-select.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/pages/scripts/components-bootstrap-select.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/pages/scripts/dashboard.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/pages/scripts/components-date-time-pickers.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/custom/js/admin_user_form.js" type="text/javascript"></script>
<!-- END PAGE LEVEL SCRIPTS -->
<!-- BEGIN THEME GLOBAL SCRIPTS -->
<script src="<?php echo base_url(); ?>assets/global/scripts/app.min.js" type="text/javascript"></script>
<!-- END THEME GLOBAL SCRIPTS -->
<!-- BEGIN THEME LAYOUT SCRIPTS -->
<!-- <script src="<?php echo base_url(); ?>assets/layouts/layout5/scripts/layout.min.js" type="text/javascript"></script> -->
<script src="<?php echo base_url(); ?>assets/layouts/layout4/scripts/demo.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/layouts/global/scripts/quick-sidebar.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/layouts/global/scripts/quick-nav.min.js" type="text/javascript"></script>
<!-- END THEME LAYOUT SCRIPTS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="<?php echo base_url(); ?>assets/pages/scripts/form-samples.min.js" type="text/javascript"></script>
<!-- END PAGE LEVEL SCRIPTS -->
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
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
<?php /* <script type="text/javascript">
    var interval = 1;

    setInterval(function () {
        //alert('hiii');
        <?php foreach ($work_orders['completed_wo'] as $key => $work_order) { ?>
        <?php $j = isset($work_order['jkey']) ? $work_order['jkey'] : 0; for (; $j >= 1; $j--) { ?>
            new<?php echo $work_order['wo_id']; ?>timestamp<?php echo $j; ?> = new Date(new<?php echo $work_order['wo_id']; ?>timestamp<?php echo $j; ?>.getTime() + interval * 1000);
        document.getElementById('<?php echo $work_order['wo_id']; ?>countdown<?php echo $j; ?>').innerHTML = new<?php echo $work_order['wo_id']; ?>timestamp<?php echo $j; ?>.getDay() + ' Days ' + new<?php echo $work_order['wo_id']; ?>timestamp<?php echo $j; ?>.getHours() + ' Hour ' + new<?php echo $work_order['wo_id']; ?>timestamp<?php echo $j; ?>.getMinutes() + ' Min ' + new<?php echo $work_order['wo_id']; ?>timestamp<?php echo $j; ?>.getSeconds() + ' Sec ';
        <?php } } ?>
    }, Math.abs(interval) * 1000);

</script> */ ?>