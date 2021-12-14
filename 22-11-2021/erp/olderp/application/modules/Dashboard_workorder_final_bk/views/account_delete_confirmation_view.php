<?php //echo "<pre>";print_r($work_orders_count);die; ?>
<link rel="stylesheet" href="https://www.webnots.com/resources/font-awesome/css/font-awesome.min.css">
<link href="<?php echo base_url(); ?>assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url(); ?>assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url(); ?>assets/global/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url(); ?>assets/global/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url(); ?>assets/global/plugins/clockface/css/clockface.css" rel="stylesheet" type="text/css" />
<style type="text/css">
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
                        <h1 style="color:#F00;">Are you sure you want to delete below WO "<?php echo $outward_details['wo_wo_no']; ?>"?</h1>
                        <ol class="breadcrumb">
                            <li>
                                <a href="<?php echo base_url(); ?>Dashboard">Dashboard</a>
                            </li>
                            <li>
                                <a href="<?php echo base_url(); ?>Dashboard_workorder_final/account_approve_report">Account Approve Report</a>
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
                    
                            <div class="row">
                            
                        <div class="col-md-12">
                        <div class="portlet box">
                        <div class="portlet-body form portlet-bg">
                            <?php echo isset($error_msg) ? '<h3 class="form-section">'.$error_msg : "</h3>"; ?>

                            
                                <div id="outwardinv<?php echo $outward_details['otw_id']; ?>">
                                    <div style="border:5px dashed green;">
                                    <h3>Outward : <span style="color:#F00;"><?php echo isset($outward_details['wo_type_name']) ? " [ ".$outward_details['wo_type_name']." ] " : ''; ?></span></h3>
                                    <table class="table table-bordered" style="">
                                        <?php  // echo "<pre>";print_r($outward_data);die; ?>
                                        <tr>
                                            <th colspan="2" class="wotldark" style="text-align: center;width:58px;">W.O. No. :</th>
                                           <!--  <th colspan="2" style="text-align: center;">MASPL/MS</th> -->
                                            <td colspan="2" class="wotb"><?php echo $outward_details['wo_wo_no']; ?></td>
                                            <th colspan="2" class="wotldark" style="text-align: center;width: 50px;">Date :</th>
                                            <td colspan="2" class="wotb"><?php echo date("d-m-Y", strtotime($outward_details['wo_wo_date'])); ?></td>
                                        </tr>
                                        <tr>
                                            <th colspan="2" class="wotldark" style="text-align: center;width:58px;">P.O. No. :</th>
                                           <!--  <th colspan="2" style="text-align: center;">MASPL/MS</th> -->
                                            <td colspan="2" class="wotb"><?php echo $outward_details['wo_po_no']; ?></td>
                                            <th colspan="2" class="wotldark" style="text-align: center;width: 50px;">P.O.Date :</th>
                                            <td colspan="2" class="wotb"><?php echo date("d-m-Y", strtotime($outward_details['wo_po_date'])); ?></td>
                                        </tr>
                                        <tr>
                                            <td class="wotdark">Name:</td>
                                            <td class="wotc" colspan="7"><strong><?php echo $outward_details['wo_customer_name']; ?></strong></td>
                                        </tr>
                                        <tr>
                                            <td class="wotldark">GST No:</td>
                                            <td colspan="7"><?php echo $outward_details['wo_gstno']; ?></td>
                                        </tr>
                                        <tr>
                                            <td class="wotldark">Address:</td>
                                            <td colspan="7"><?php echo $outward_details['wo_address']; ?></td>
                                        </tr>
                                        <tr>
                                            <td class="wotldark">Billing Address:</td>
                                            <td colspan="3"><?php echo $outward_details['wo_billing_address']; ?></td>                                        
                                            <td class="wotldark">Shipping Address:</td>
                                            <td colspan="3"><?php echo $outward_details['wo_shipping_address']; ?></td>
                                        </tr>
                                        <tr>
                                            <td class="wotldark">Dilivery Time/Date:</td>
                                            <td colspan="3"><?php echo $outward_details['wo_deliverytime']; ?></td>                                       
                                            <td class="wotldark" width="200px">Dilivery By:</td>
                                            <td colspan="3"><?php echo $outward_details['wo_deliveryby']; ?></td>
                                        </tr>
                                        <tr>
                                            <td class="wotldark">Courier Name:</td>
                                            <td colspan="3"><?php echo $outward_details['wo_couriername']; ?></td>                                        
                                            <td class="wotldark" width="200px">Docket No:</td>
                                            <td colspan="3"><?php echo $outward_details['wo_docket_no']; ?></td>
                                        </tr>
                                        <tr>
                                            <td class="wotldark">Fright:</td>
                                            <td colspan="3"><?php echo $outward_details['wo_fright_grandtotal']; ?></td>

                                            <td class="wotldark" width="200px">P&f:</td>
                                            <td colspan="3"><?php echo $outward_details['wo_pf_grandtotal']; ?></td>
                                        </tr>
                                        <tr>
                                            <td class="wotldark">Remark:</td>
                                            <td colspan="3"><?php echo $outward_details['wo_remark']; ?></td>

                                            <td class="wotldark" width="200px">Weight:</td>
                                            <td colspan="3"><?php echo $outward_details['otw_weight']." KG"; ?></td>
                                        </tr>
                                        <tr>
                                            <td class="wotldark">Payment Info:</td>
                                            <td colspan="3"><?php echo $outward_details['otw_paymentinfo']; ?></td>

                                            <td class="wotldark">Payment Recive:</td>
                                            <td colspan="3"><?php echo $outward_details['otw_paymentrecive']; ?></td>
                                        </tr>

                                    </table>
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
                            <?php  $atr = array('class' => 'form-horizontal');
                                 echo form_open_multipart($action,$atr); ?>
                                        <div class="form-body" style="background-color:#92a8d1;">
                                            <?php echo isset($error_msg) ? '<h3 class="form-section">'.$error_msg : "</h3>"; ?>
                                            <br><br><br>
                                            <div class="row" style="background-color:#92a8d1;">
                                               <div class="col-md-6" style="background-color:#92a8d1;">
                                                    <div class="form-group" id="mcna_namegr">
                                                        <label class="control-label col-md-3" style="color:#F00;">Remark</label>
                                                        <div class="col-md-9">
                                                            <textarea class="form-control" id="otw_delete_remark" name="otw_delete_remark" rows="5" required="required"></textarea>
                                                            <input type="hidden" tabindex="1" class="form-control"  name="otw_id" maxlength="200" id="otw_id" value="<?php echo $this->input->get('otw_id'); ?>">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6" style="background-color:#92a8d1;">
                                                 <div class="form-actions" style="background-color:#92a8d1; border:3px solid #92a8d1;">
                                                    <div class="row" style="background-color:#92a8d1;">
                                                        <div class="col-md-6" style="background-color:#92a8d1;">
                                                            <div class="row" style="background-color:#92a8d1;">
                                                                <div class="col-md-offset-3 col-md-9" style="background-color:#92a8d1;">
                                                                    <button type="submit" class="btn red" >Click here to delete WO.</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6" style="background-color:#92a8d1;"> </div>
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
<script src="<?php echo base_url(); ?>assets/custom/js/admin_user_form.js" type="text/javascript"></script>
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