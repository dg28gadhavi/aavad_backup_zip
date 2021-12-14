<?php //echo "<pre>";print_r($work_orders);die; ?>
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

                            <?php //echo "<pre>";print_r($work_orders);die; 
                            $j = 0; foreach ($work_orders['outward_lists'] as $outkey => $outward_data) { $j++; ?>

                            <h3>Outward : <?php echo $j; ?><a href="<?php echo base_url(); ?>Dashboard_workorder_final/account_edit_otw?otw_id=<?php echo $outward_data['otw_id']; ?>" class="btn btn-sm btn-success btn-left"><i class="fa fa-pencil"></i></a>

                            <a href="<?php echo base_url(); ?>Dashboard_workorder_final/view_wo_sticker?otw_id=<?php echo $outward_data['otw_id']; ?>" class="btn btn-sm btn-success btn-left"><i class="fa fa-file-pdf-o"></i></a>
                             <a href="<?php echo base_url(); ?>Dashboard_workorder_final/view_coverwo_sticker?otw_id=<?php echo $outward_data['otw_id']; ?>" class="btn btn-sm btn-success btn-left"><i class="fa fa-file-powerpoint-o"></i></a>
                        </h3>

                                    <table class="table table-bordered">
                                        <?php   //echo "<pre>";print_r($outward_data);die; ?>
                                        <tr>
                                            <th colspan="2" class="wotldark" style="text-align: center;width:58px;">W.O. No. :</th>
                                           <!--  <th colspan="2" style="text-align: center;">MASPL/MS</th> -->
                                            <td colspan="2" class="wotb"><?php echo $outward_data['wo_wo_no']; ?></td>
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
                                            <td class="wotc" colspan="7"><strong><?php echo $outward_data['otw_customer_name']; ?></strong></td>
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
                                            <td colspan="3"><?php echo $outward_data['wo_fright_grandtotal']; ?></td>

                                            <td class="wotldark" width="200px">P&f:</td>
                                            <td colspan="3"><?php echo $outward_data['wo_pf_grandtotal']; ?></td>
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
                                        <?php $counter = 0; foreach ($outward_data['item_lists'] as $itemkey => $items) { $counter++; ?>
                                        <tr data-toggle="collapse" data-target="#idemo<?php echo $items['otwi_id']; ?>">
                                              <td><?php echo $counter; ?></td>
                                              <td colspan="2"><?php echo $items['otwi_part_no']." ".$items['otwi_itm_title']." ".$items['otwi_itm_desc']; ?></td>
                                              <td><?php echo $items['otwi_qty']; ?></td>
                                              <td style="word-break: break-all"><?php echo $items['serialkey']; ?></td>
                                              <td><?php echo $items['otwi_price']; ?></td>
                                              <td><?php echo $items['otwi_total']; ?></td>
                                              <td><?php echo $items['otwi_discount']; ?></td>
                                              <td><?php echo $items['woi_gst']; ?></td>
                                              <td><?php echo $items['otwi_ftotal']; ?></td>
                                        </tr>
                                     <?php } ?>
                                    </table>                                    
                                   
                                	<div class="first-col">
										<span class="pre-col-left">Prepard By:</span><span class="pre-col-right"><?php echo $outward_data['preparedbyf'].$outward_data['preparedbyl']; ?></span>
									</div>
									<div class="second-col">
										<span class="test-col-left">Tested By:</span><span  class="test-col-right"><?php echo $outward_data['testedbyf'].$outward_data['testedbyl']; ?></span>
									</div>
  									<br>
                                    <br>
                                    <?php /* <table class="table table-bordered">
                                    <tr>
                                        <td class="wotdark">Prepared By:</td>
                                        <td colspan="2" class="wotc"><strong> <?php echo $outward_data['au_fname']." ".$outward_data['au_lname']; ?></strong></td>
                                        <td class="wotdark">Remarks:</td>
                                        <td colspan="4" class="wotc"><strong><?php echo $outward_data['otw_remark']; ?></strong></td>
                                    </tr>
                                </table> */ ?>
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