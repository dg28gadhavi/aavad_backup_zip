<?php //echo "<pre>"; print_r($inq_stats); die;?>
<link rel="stylesheet" href="https://www.webnots.com/resources/font-awesome/css/font-awesome.min.css">
<link href="<?php echo base_url(); ?>assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url(); ?>assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url(); ?>assets/global/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url(); ?>assets/global/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url(); ?>assets/global/plugins/clockface/css/clockface.css" rel="stylesheet" type="text/css" />
<style type="text/css">
/*.portlet-body .table .ttext {display: inline-block; font-weight: 600;}*/
.portlet-body .table .headtb {background: #fbd6a4;}
.portlet-body .table .wotb {background: #fbd6a4; font-weight: 600; width: 150px;}
.portlet-body .table .pretb {background: #fbd6a4;}
.rbutton {
  border: none;
  color: white;
  padding: 10px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 12px;
  margin: 4px 2px;
  cursor: pointer;
}
.rbutton5 {border-radius: 50% !important; border: 1px solid #e1e1e1;}
.rred{ color: #F00; background-color: #FFF; font-weight: bold; }
.rgreen{ color: #008000; background-color: #FFF; font-weight: bold; }
</style>
<!-- END PAGE LEVEL PLUGINS -->
<div class="container-fluid">
<div class="page-content">
<!-- BEGIN BREADCRUMBS -->
<!-- END BREADCRUMBS -->
    <!-- BEGIN PAGE BASE CONTENT -->
            <?php foreach ($work_orders['completed_wo'] as $key => $work_order) { ?>
            <div class="row">
            	<div class="col-lg-8 col-md-8 col-sm-8">
	                <div class="portlet light bordered">
	                    <div class="portlet-title tabbable-line">
	                        <div class="caption">
	                            <i class=" icon-magnet font-green-sharp"></i>
	                            <span class="caption-subject font-green-sharp bold uppercase"><?php echo $work_order['wo_wo_no']; ?></span>
	                        </div>
	                        
	                    </div>
	                    <div class="portlet-body">
	                        <div class="tab-content">
	                            <div class="tab-pane active" id="tab_actions_pending">
	                                <!-- BEGIN: Actions -->
	                               <table class="table table-bordered">
									 <tr>
										  <th colspan="2" style="text-align: center;">MASPL/MS</th>
										  <td colspan="2" class="wotb">W.O. No.: <?php echo $work_order['wo_wo_no']; ?></td>
										  <td colspan="2" class="wotb">Date: <?php echo $work_order['wo_wo_date']; ?></td>
									 </tr>
									 <tr>
									  	<td colspan="5"><strong>Name:  <?php echo $work_order['wo_customer_name']; ?></strong><br><strong>Address: </strong><?php echo $work_order['wo_address']; ?></td>
									  
									 </tr>
									 <tr class="headtb">
										  <th style="text-align: center;">SR. No.</th>
										  <th style="text-align: center;">Item Description</th>
										  <th style="text-align: center;">Qty</th>
										  <?php $type_id = encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['typeid']);
										  $dep_id = encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['dep_id']);
											if($type_id == 3 || $dep_id == 10 || $dep_id == 11 || $dep_id == 5)
											{ ?>
												<th style="text-align: center;">Stock</th>
											<?php } ?>
										  <th style="text-align: center;">Rate</th>
										  <th style="text-align: center;">Check</th>
									 </tr>
									 <?php $counter = 0; foreach ($work_order['items'] as $itemkey => $items) { $counter++; ?>
									 	<tr>
											  <td><?php echo $counter; ?></td>
											  <td><?php echo $items['woi_part_no']." ".$items['woi_itm_title']." ".$items['woi_itm_desc']; ?></td>
											  <td><?php echo $items['woi_qty']; ?></td>
											  <?php if($type_id == 3 || $dep_id == 10 || $dep_id == 11 || $dep_id == 5)
													{ ?>
											  <td><?php echo $stock = $items['tcreditpoints'] - $items['tdebitpoints'];?></td>
											  <?php } ?>
											  <td><?php echo $items['woi_price']; ?></td>
											  <td style="text-align: center;">
											  <?php 
												if($type_id == 3)
												{
													//echo $items['woi_admin_approve'];die;
												  if($items['woi_admin_approve'] == '0')
												   {
											?>
											  <a href="<?php echo base_url(); ?>Dashboard_workorder_final/check_qty?wo_itemid=<?php echo $items['woi_id']; ?>&itemid=<?php echo $items['woi_item_id']; ?>&wo_id=<?php echo $items['woi_wo_id']; ?>" class="btn btn-success"><i class="fa fa-check"></i></a>
											  <a href="<?php echo base_url(); ?>Dashboard_workorder_final/edit_qty?wo_itemid=<?php echo $items['woi_id']; ?>&itemid=<?php echo $items['woi_item_id']; ?>&wo_id=<?php echo $items['woi_wo_id']; ?>" target="_BLANK" class="btn btn-danger"><i class="fa fa-pencil"></i></a>
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
															<?php 
														}else{ ?>
														<a href="#" class="btn btn-success">A</a>
													<?php }
													}else if($dep_id == 11)
													{
														if($items['woi_promanager_approve'] == '0'){ ?>
														<a href="<?php echo base_url(); ?>Dashboard_workorder_final/check_qty?wo_itemid=<?php echo $items['woi_id']; ?>&itemid=<?php echo $items['woi_item_id']; ?>&wo_id=<?php echo $items['woi_wo_id']; ?>" <?php if($stock <= 0 && $stock <= $items['woi_qty']){ ?> onclick="alert('Not Enough Stock'); return false;" <?php } ?> class="btn btn-success"><i class="fa fa-check"></i></a>
														<a href="<?php echo base_url(); ?>Dashboard_workorder_final/edit_qty?wo_itemid=<?php echo $items['woi_id']; ?>&itemid=<?php echo $items['woi_item_id']; ?>&wo_id=<?php echo $items['woi_wo_id']; ?>" target="_BLANK" class="btn btn-danger" <?php if($stock <= 0){ ?> onclick="alert('Not Enough Stock'); return false;" <?php } ?>><i class="fa fa-pencil"></i></a>
															<?php 
														}else{ ?>
														<a href="#" class="btn btn-success">A</a>
													<?php }
													}
												} ?>
												</td>
										 </tr>
										 <tr>
										 	<td colspan="6">
										 		<button class="rbutton rbutton5 rgreen">Sales</button>
										 		<button class="rbutton rbutton5 <?php echo isset($items['woi_admin_approve']) && ($items['woi_admin_approve'] == '1') ? "rgreen" : "rred"; ?> ">Admin</button>
										 		<button class="rbutton rbutton5 <?php echo isset($items['woi_manager_approve']) && ($items['woi_manager_approve'] == '1') ? "rgreen" : "rred"; ?>">Sales Manager</button>
										 		<button class="rbutton rbutton5 <?php echo isset($items['woi_promanager_approve']) && ($items['woi_promanager_approve'] == '1') ? "rgreen" : "rred"; ?>">Production Manager</button>
										 		<?php /* <button class="rbutton rbutton5 rgreen">Production</button>
										 		<button class="rbutton rbutton5 rgreen">Account</button>
										 		<button class="rbutton rbutton5 rgreen">Production</button>
										 		<button class="rbutton rbutton5 rgreen">Dispatch</button> */ ?>
										 	</td>
										 </tr>
									 <?php } ?>
									 <tr>
										  <td colspan="2" class="wotb">Delivery Time / Date: <?php echo $work_order['wo_deliverytime']; ?></td>
										  <td colspan="3" class="wotb">Delivery by: Air / Surface / H.D <?php echo $work_order['wo_deliveryby']; ?></td>
									 </tr>
									 <tr>
										  <td colspan="2"></td>
										  <td colspan="2">Courier Name: <?php echo $work_order['wo_couriername']; ?></td>
										  <td>Docket No.: <?php echo $work_order['wo_docket_no']; ?></td>
									 </tr>
									 <tr>
										  <td colspan="2" class="wotb"><strong>Prepared by: <?php echo $work_order['au_fname']." ".$work_order['au_lname']; ?></strong></td>
										  <td colspan="3" class="wotb"><strong>Remarks: <?php echo $work_order['wo_remark']; ?></strong></td>
									 </tr>
									</table>
	                       </div>
	                        </div>
	                    </div>
	                </div>
				</div>
				<div class="col-lg-4 col-md-4 col-sm-4">
	                <div class="portlet light bordered">
	                	<div class="portlet-title tabbable-line">
	                        <div class="caption">
	                            <i class=" icon-magnet font-green-sharp"></i>
	                            <span class="caption-subject font-green-sharp bold uppercase">Notifications</span>
	                        </div>
	                        
	                    </div>
	                    <div class="portlet-body">
	                    </div>
	                </div>
	            </div>
				</div>
            <?php } ?>
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
