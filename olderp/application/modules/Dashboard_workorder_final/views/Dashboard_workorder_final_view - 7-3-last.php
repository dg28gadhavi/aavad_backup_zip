<?php //echo "<pre>"; print_r($inq_stats); die;?>
<link rel="stylesheet" href="https://www.webnots.com/resources/font-awesome/css/font-awesome.min.css">
<link href="<?php echo base_url(); ?>assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url(); ?>assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url(); ?>assets/global/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url(); ?>assets/global/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url(); ?>assets/global/plugins/clockface/css/clockface.css" rel="stylesheet" type="text/css" />
<style type="text/css">
/*.portlet-body .table .ttext {display: inline-block; font-weight: 600;}*/
.portlet-body .table .headtb {background: #ffd7a1;}
.portlet-body .table .wotb {background: #c9d9e6; font-weight: 600; width: 150px; font-size: 15px;}
.portlet-body .table .wotdark {background: #1569b0; color: #fff;font-weight: 600; width: 150px; font-size: 15px;}
.portlet-body .table .wotldark {background: #06aab9; color: #fff;font-weight: 600; width: 150px; font-size: 15px;}
.portlet-body .table .wotc {background: #eaeaea; font-weight: 600; width: 150px; color: #000; font-weight: 600;}
/*.portlet-body .table .pretb {background: #fbd6a4;}*/
.portlet-body .table .headtb {background: #01a0dd; color: #fff; }
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
#accordion .panel-title a.collapsed{/*background: #f5fafc;*/ background: #cef1ff; /*color: #904656;*/ color: #1569b0; 
	transition: all 0.5s ease 0s;}
#accordion .panel-title a:after,
#accordion .panel-title a.collapsed:after{content: "\f106"; font-family: "Font Awesome 5 Free"; font-weight: 900; font-size: 20px;
    position: absolute; top: 10px; right: 20px;}
#accordion .panel-title a.collapsed:after{content: "\f107";}
#accordion .panel-body{font-size: 14px; /*color: #8b8b8c;*/background: #fff;line-height: 25px; padding: 20px 25px; border: none;
    border-left: 3px solid #1569b0; transition: all 0.5s ease 0s;}
.box-content {position: absolute;z-index: 1000; opacity:0; max-width: 100%; border-radius: 25px; padding: 0 10px; background: #06aab9;font-weight: 600;color: #fff;
     -webkit-transition:.5s;  -moz-transition:.5s; -o-transition:.5s; -ms-transition:.5s; transition:.5s;} 
.boxhover:hover .box-content { opacity: 1;}
.sales-bg{background: #fcecd6;}
.admin-bg{background: #cce6ff;}
.sm-bg{background: #efe9ab;}
.pm-bg{background: #c7eded;}
.production-bg{background: #fee2df;}
.account-bg{background: #ddd;}
.dispatch-bg{background: #e5dfff;}
</style>
<!-- END PAGE LEVEL PLUGINS -->
<div class="container-fluid">
<div class="page-content">
<!-- BEGIN BREADCRUMBS -->
<!-- END BREADCRUMBS -->
    <!-- BEGIN PAGE BASE CONTENT -->
            <?php foreach ($work_orders['completed_wo'] as $key => $work_order) { ?>
            <div class="row">
            	<div class="col-lg-12 col-md-12 col-sm-12">

            <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                <div class="panel panel-default">
                    <div class="panel-heading" role="tab" id="headingOne">
                        <h4 class="panel-title">
                            <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $work_order['wo_id']; ?>" aria-expanded="true" aria-controls="collapse<?php echo $work_order['wo_id']; ?>">
                                <?php echo $work_order['wo_wo_no']; ?>
                            </a>
                        </h4>
                    </div>
                    <div id="collapse<?php echo $work_order['wo_id']; ?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
                    	<div class="portlet-body">
                    		<div class="col-lg-8 col-md-8 col-sm-8">
                        		<div class="panel-body">
                            		<table class="table table-bordered">
										<tr>
										  	<th colspan="2" style="text-align: center;">MASPL/MS</th>
										  	<td colspan="4" class="wotb">W.O. No.: <?php echo $work_order['wo_wo_no']; ?></td>
										  	<td colspan="2" class="wotb">Date: <?php echo $work_order['wo_wo_date']; ?></td>
									 	</tr>
									 </table>
									 <table class="table table-bordered">
										<tr>
											<td class="wotdark">Name:</td>
										  	<td class="wotc" colspan="7"><strong><?php echo $work_order['wo_customer_name']; ?></strong></td>
										</tr>
										<tr>
											<td class="wotldark">Address:</td>
										  	<td colspan="7"></strong><?php echo $work_order['wo_address']; ?></td>
										</tr>
									</table>
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
											<th colspan=2" style="text-align: center;">Check</th>										 
										</tr>
									 	<?php $counter = 0; foreach ($work_order['items'] as $itemkey => $items) { $counter++; ?>
									 	<tr data-toggle="collapse" data-target="#idemo<?php echo $items['woi_id']; ?>">
											  <td><?php echo $counter; ?></td>
											  <td colspan="2"><?php echo $items['woi_part_no']." ".$items['woi_itm_title']." ".$items['woi_itm_desc']; ?></td>
											  <td><?php echo $items['woi_qty']; ?></td>
											  <?php if($type_id == 3 || $dep_id == 10 || $dep_id == 11 || $dep_id == 5)
													{ ?>
											  <td><?php echo $stock = $items['tcreditpoints'] - $items['tdebitpoints'];?></td>
											  <?php } ?>
											  <td><?php echo $items['woi_price']; ?></td>
											  <td colspan="2" style="text-align: center;">
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
														}else{ if(isset($items['woi_production_cid']) && ($items['woi_production_cid'] == 0)){ ?>
														<a href="<?php echo base_url(); ?>Dashboard_workorder_final/assign_user?wo_itemid=<?php echo $items['woi_id']; ?>&itemid=<?php echo $items['woi_item_id']; ?>&wo_id=<?php echo $items['woi_wo_id']; ?>" target="_BLANK" class="btn btn-warning" ><i class="fa fa-user"></i></a>
														
													<?php }else{ ?>
														Assign To <?php echo $items['production_fname'].' '.$items['production_lname']; ?>
													<?php } }
													}
												} ?>
												</td>
												<!-- <td><button id="ibutton<?php echo $items['woi_id']; ?>" type="button" class="btn btn-info" data-toggle="collapse" data-target="#idemo<?php echo $items['woi_id']; ?>"><i class="fa fa-plus"></i></button></td> -->
										</tr>
										<tr id="idemo<?php echo $items['woi_id']; ?>" class="collapse idemo<?php echo $items['woi_id']; ?> opennext">
										 	<td colspan="6">
										 		<span class="boxhover">
										 		<button class="rbutton rbutton5 rgreen">Sales</button>
										 		<div class="box-content"><h6>Jitendra Talpada <span class="badge badge-secondary">12:30</span></h6>
										 	</div></span>
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
									</table>
									<table class="table table-bordered">
									<tr>
										  <td class="wotdark">Deliv. Time / Date:</td>
										  <td colspan="2" class="wotc"><?php echo $work_order['wo_deliverytime']; ?></td>
										  <td class="wotdark">Delivery By:</td>
										  <td colspan="4" class="wotc"> Air / Surface / H.D <?php echo $work_order['wo_deliveryby']; ?></td>
									</tr>
									<tr>
										<!-- <td colspan="3"></td> -->
										<td class="wotldark">Courier Name:</td>
										<td colspan="2"><strong><?php echo $work_order['wo_couriername']; ?></strong></td>
										<td class="wotldark">Docket No.:</td>
										<td colspan="4"><strong><?php echo $work_order['wo_docket_no']; ?></strong></td>
									</tr>
									<tr>
										<td class="wotdark">Prepared By:</td>
										<td colspan="2" class="wotc"><strong> <?php echo $work_order['au_fname']." ".$work_order['au_lname']; ?></strong></td>
										<td class="wotdark">Remarks:</td>
										<td colspan="4" class="wotc"><strong><?php echo $work_order['wo_remark']; ?></strong></td>
									</tr>
								</table>
                        </div>
                    </div>                
					<div class="col-lg-4 col-md-4 col-sm-4">
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
						        </div>
						    </div>
						</div>
					</div>
					</div>
                </div>
            </div>
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
<script type="text/javascript">
	// Code goes here
$(function(){
  $('.opennext').on('hide.bs.collapse', function () {
  	//alert('hiii'+$(this).attr("id"));
  	var res = ($(this).attr("id")).split('idemo');
    $('#ibutton'+res[1]).html('<i class="fa fa-plus"></i>');
  })
  $('.opennext').on('show.bs.collapse', function () {
  	//alert('hiii'+$(this).attr("id"));
  	var res = ($(this).attr("id")).split('idemo');
    $('#ibutton'+res[1]).html('<i class="fa fa-minus"></i>');
  })
})
</script>
