<?php //echo "<pre>";print_r($work_orders_count);die; ?>
<link rel="stylesheet" href="https://www.webnots.com/resources/font-awesome/css/font-awesome.min.css">
<link href="<?php echo base_url(); ?>assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url(); ?>assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url(); ?>assets/global/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url(); ?>assets/global/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url(); ?>assets/global/plugins/clockface/css/clockface.css" rel="stylesheet" type="text/css" />
 <!-- BEGIN PAGE LEVEL PLUGINS -->
<link href="<?php echo base_url(); ?>assets/global/plugins/bootstrap-select/css/bootstrap-select.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url(); ?>assets/global/plugins/jquery-multi-select/css/multi-select.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url(); ?>assets/global/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url(); ?>assets/global/plugins/select2/css/select2-bootstrap.min.css" rel="stylesheet" type="text/css" />
<style type="text/css">
.portlet-body .table .wotb {background: #dbe8f3; font-weight: 600; font-size: 14px; width: 200px;}
.portlet-body .table .wotdark {background: #d2d2d2; color: #000;font-weight: 600; width: 150px; font-size: 14px;}
.portlet-body .table .wotldark {background: #c4c5d6; color: #000;font-weight: 600; width: 160px; font-size: 14px;}
.portlet-body .table .wotc {background: #f3f3f3; font-weight: 600; width: 150px; color: #000; font-weight: 600;}
/*.portlet-body .table .pretb {background: #fbd6a4;}*/
.portlet-body .table .headtb {background: #686868; color: #fff; }
.portlet-body .table .t-scroll { height: 200px; display: inline-block; width: 100%; overflow: auto;}
.first-col { width: 400px; float: left; padding: 5px; }
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
.portlet-body .nav-right {text-align:right; padding-right: 15px;}
.portlet-body .badge { font-size: 17px !important; font-weight: 600; height: 23px;}
.m-t-10 { margin-top: 10px; }
</style>
<div class="container-fluid">
                <div class="page-content">
<!-- BEGIN BREADCRUMBS -->
                    <div class="breadcrumbs">
                        <h1>WORK ORDER REPORT</h1>
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
                            <?php 
                $dashboard = array('class' => 'form-horizontal','method' => 'get');
                echo form_open($action_ds,$dashboard); ?> 
                        <div class="row">
                            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12 text-right">
                                <div class="form-group" id="mcna_namegr">
                                    <div class="col-md-7">
                                        <input class="form-control form-control-inline input-medium date-picker" tabindex="4" id="inq_start_date" name="inq_start_date" size="16" value="<?php echo ($this->input->get('inq_start_date')) ? date("d-m-Y", strtotime(($this->input->get('inq_start_date')))) : ""; ?>" type="text" placeholder="Start Date">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12 text-right">
                                <div class="form-group" id="mcna_namegr">
                                    <div class="col-md-7">
                                        <input class="form-control form-control-inline input-medium date-picker" tabindex="4" id="inq_end_date" name="inq_end_date" size="16" value="<?php echo ($this->input->get('inq_end_date')) ? date("d-m-Y", strtotime(($this->input->get('inq_end_date')))) : ""; ?>" tend_dateype="text" placeholder="End Date">
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
                                    <div class="col-md-12">
                                        <input class="form-control form-control-inline" tabindex="4" id="otw_invno" name="otw_invno" size="16" value="<?php echo ($this->input->get('otw_invno')) ? $this->input->get('otw_invno') : ""; ?>" type="text" placeholder="Invoice No.">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12 text-right btn-left">
                                <div class="form-group" id="mcna_namegr">
                                    <?php // echo "<pre>"; print_r($executive[0]['au_fname']); die;?>
                                    <div class="col-md-12">
                                        <select name="au_fname" id="au_fname" class="bs-select form-control itmchange" data-live-search="true" data-size="8" tabindex="4">
                                            <option value="">Executive</option>
                                          <?php  foreach($executive as $exe) {

                                            ?>  <option value="<?php echo $exe['au_id'];?>" <?php if($this->input->get('au_fname') && ($this->input->get('au_fname') != '') && ($this->input->get('au_fname') == $exe['au_id'])){ ?> selected <?php } ?>><?php echo $exe['au_fname'].' '.$exe['au_lname']; ?></option><?php } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12 text-right">
                                <div class="form-group" id="mcna_namegr">
                                    <?php // echo "<pre>"; print_r($executive[0]['au_fname']); die;?>
                                    <div class="col-md-12">
                                        <select name="customer" id="customer" class="bs-select form-control itmchange" data-live-search="true" data-size="8" tabindex="4">
                                            <option value="">Customer</option>
                                          <?php  foreach($customer as $custo) {

                                            ?>  <option value="<?php echo $custo['master_party_id'];?>" <?php if($this->input->get('customer') && ($this->input->get('customer') != '') && ($this->input->get('customer') == $custo['master_party_id'])){ ?> selected <?php } ?>><?php echo $custo['master_party_name']; ?></option><?php } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12 text-right">
                                <div class="form-group" id="mcna_namegr">
                                    <?php // echo "<pre>"; print_r($executive[0]['au_fname']); die;?>
                                    <div class="col-md-12">
                                        <select name="product" id="product" class="bs-select form-control itmchange" data-live-search="true" data-size="8" tabindex="4">
                                            <option value="">Items</option>
                                          <?php  foreach($product as $pro) {

                                            ?>  <option value="<?php echo $pro['master_item_id'];?>" <?php if($this->input->get('product') && ($this->input->get('product') != '') && ($this->input->get('product') == $pro['master_item_id'])){ ?> selected <?php } ?>><?php echo $pro['master_item_part_no']; ?></option><?php } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                           
                            <div class="col-md-1 col-sm-2 text-left">
                                    <button type="submit" tabindex="5" class="btn green text-left" ><i class="fa fa-check"></i></button>
                                    <a href="<?php echo base_url().'Dashboard_workorder_final/wo_report'; ?>" class="btn red text-left" ><i class="fa fa-refresh"></i></a>
                            </div>                
                        </div>
                         <?php echo form_close(); ?>
                        <div class="row m-t-10">
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 text-left">
                                <div class="text-left">
                                    <button type="button" class="btn btn-primary">No of work order = <span class="badge"><?php echo $total_record; ?></span></button>
                                    <button type="button" class="btn btn-primary">Records / Page <span class="badge">10</span></button>
                                </div>
                            </div>
                                <nav aria-label="Page navigation" class="nav-right">
                                  <?php echo $pagi_links; ?>
                                </nav>
                        </div>
                                    
                            <?php echo isset($error_msg) ? '<h3 class="form-section">'.$error_msg : "</h3>"; ?>
                           
                            <?php //echo "<pre>";print_r($work_orders);die; 
                            $j = 0; foreach ($work_orders['outward_lists'] as $outkey => $outward_data) { $j++; ?>
                                <div id="outwardinv<?php echo $outward_data['otw_id']; ?>">
                                     <div style="border:2px dotted green;">
                                    <!--<h3>Outward : <?php echo $j; ?><span style="color:#F00;"><?php echo isset($outward_data['wo_type_name']) ? " [ ".$outward_data['wo_type_name']." ] " : ''; ?></span></h3> -->
                                    <table class="table table-bordered" style="">
                                        <?php  // echo "<pre>";print_r($outward_data);die;
                                        $type_id =  encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['typeid']); ?>
                                        <tr style="background:green; color:white;">
                                            <td ><b><?php echo $outward_data['wo_wo_no']; ?></b></td>
                                            <td><b><?php echo $outward_data['wo_customer_name'].' '; ?></b></td>                                       
                                            <td  width="200px"><b><?php echo $outward_data['preparedbyf'].$outward_data['preparedbyl']; ?></b></td>
                                            <?php if($type_id == 3){ ?>
                                            <td><b><?php echo $outward_data['otw_invno']; ?></b></td>
                                            <td><b><?php echo $outward_data['otw_invdate']; ?></b></td>
                                            <td><b><?php echo $outward_data['otw_invftotal']; ?></b></td>
                                            <?php }else{ ?>
                                            <td colspan="3"></td>
                                            <?php } ?>
                                            <td></td>
                                            <td><a href="javascript::void(0);" class="btn btn-primary red outwardhead" id="outwardhead<?php echo $outward_data['otw_id']; ?>"><i class="fa fa-plus"></i></a></td>
                                        </tr>
                                        <tr style="display:none;" class="displayhead<?php echo $outward_data['otw_id']; ?>">
                                            <td class="wotldark" style="width:58px;">W.O. No. : <span class="badge badge-mod badge-danger pull-right"><?php echo $j; ?> </span></td>
                                            <td class="wotb" colspan="2"><?php echo $outward_data['wo_wo_no']." [".$outward_data['wo_type_name']."]"; ?> <a class="btn btn-primary green" href="<?php echo base_url(); ?>pdf/wo/wo<?php echo encrypt_decrypt('encrypt',$outward_data['wo_id']); ?>.pdf"><i class="fa fa-file-pdf-o"></i></a></td>
                                            <td class="wotb"><?php echo date("d-m-Y", strtotime($outward_data['wo_wo_date'])); ?></td>
                                            <td class="wotldark" style="width:100px;">P.O. No. :</td>
                                            <td class="wotb"><?php echo $outward_data['wo_po_no']; ?></td>
                                            <td class="wotldark" style="width: 100px;">P.O.Date :</td>
                                            <td class="wotb"><?php echo date("d-m-Y", strtotime($outward_data['wo_po_date'])); ?></td>
                                        </tr> 
                                        <?php $type_id = encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['typeid']);
                                        $dep_id =  encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['dep_id']);
                                        if($type_id == 3 || $dep_id == 10 || $dep_id == 11 || $dep_id == 1 || $dep_id == 2 || $dep_id == 5)
                                        { ?>
                                        <tr style="display:none;" class="displayhead<?php echo $outward_data['otw_id']; ?>">
                                            <td class="wotdark">Name:</td>
                                            <td class="wotc" colspan="2"><strong><?php echo $outward_data['wo_customer_name'].' '; ?></strong></td>
                                            <td class="wotdark">Address:</td>
                                            <td colspan="4"><?php echo isset($dep_id) && ($dep_id != 5) ? $outward_data['wo_address'] : ''; ?></td>
                                            
                                        </tr>
                                        <?php 
                                        }
                                        if($type_id == 3 || $dep_id == 10 || $dep_id == 11 || $dep_id == 1 || $dep_id == 2)
                                        { ?>
                                        <tr style="display:none;" class="displayhead<?php echo $outward_data['otw_id']; ?>">
                                            <td class="wotldark">Dilivery Time/Date:</td>
                                            <td><?php echo $outward_data['wo_deliverytime']; ?></td>                                       
                                            <td class="wotldark" width="200px">Dilivery By:</td>
                                            <td><?php echo $outward_data['wo_deliveryby']; ?></td>
                                            <td class="wotldark">Courier Name:</td>
                                            <td><?php echo $outward_data['wo_couriername']; ?></td>                                        
                                            <td class="wotldark" width="200px">Docket No:</td>
                                            <td><?php echo $outward_data['wo_docket_no']; ?></td>
                                        </tr>                                        
                                        <tr style="display:none;" class="displayhead<?php echo $outward_data['otw_id']; ?>">
                                            <td class="wotldark">Fright:</td>
                                            <td><?php echo $outward_data['wo_fright_grandtotal']; ?></td>
                                            <td class="wotldark" width="200px">P&f:</td>
                                            <td><?php echo $outward_data['wo_pf_grandtotal']; ?></td>
                                            <td class="wotldark">Remark:</td>
                                            <td><?php echo $outward_data['wo_remark']; ?></td>
                                            <td class="wotldark" width="200px">Weight:</td>
                                            <td><?php echo $outward_data['otw_weight']." KG"; ?></td>
                                        </tr>                                        
                                        <tr style="display:none;" class="displayhead<?php echo $outward_data['otw_id']; ?>">
                                            <td class="wotldark">Payment Info:</td>
                                            <td><?php echo $outward_data['otw_paymentinfo']; ?></td>
                                            <td class="wotldark">Payment Recive:</td>
                                            <td><?php echo $outward_data['otw_paymentrecive']; ?></td>
                                            <td class="wotldark">GST No:</td>
                                            <td><?php echo $outward_data['wo_gstno']; ?></td>
                                            <td class="wotldark">Prepared By:</td>
                                            <td><?php echo $outward_data['preparedbyf'].$outward_data['preparedbyl']; ?></td>
                                        </tr>
                                        <tr style="display:none;" class="displayhead<?php echo $outward_data['otw_id']; ?>">
                                            <td class="wotldark">Invoice No.</td>
                                            <td><?php echo $outward_data['otw_invno']; ?></td>
                                            <td class="wotldark">Invoice Date:</td>
                                            <td><?php echo $outward_data['otw_invdate']; ?></td>
                                            <td class="wotldark">Invoice Amount:</td>
                                            <td><?php echo $outward_data['otw_invftotal']; ?></td>
                                            <td class="wotldark">Challan No:</td>
                                            <td><?php echo $outward_data['otw_challan_no']; ?></td>
                                        </tr>
                                        <?php } ?>
                                    </table>
                                    <?php if(isset($outward_data['item_lists']) && !empty($outward_data['item_lists'])){ ?>
                                    <table class="table table-bordered opentab<?php echo $outward_data['otw_id']; ?> displayhead<?php echo $outward_data['otw_id']; ?>" style="display:none;">
                                        <tbody class="t-scroll">
                                        <tr class="headtb">
                                            <th width="2%" style="text-align: center;">SR. No.</th>
                                            <th colspan="2" width="20%" style="text-align: center;">Item Description</th>
                                            <th width="2%" style="text-align: center;">Qty</th>
                                            <?php if($type_id == 3 || $dep_id == 10 || $dep_id == 11 || $dep_id == 1 || $dep_id == 2)
                                            { ?>
                                            <th width="10%" style="text-align: center;">Serial Key</th>
                                            <th width="2%" style="text-align: center;">Rate</th>
                                            <th width="2%" style="text-align: center;">Total</th>
                                            <th width="2%" style="text-align: center;">Discount</th>
                                            <th width="2%" style="text-align: center;">GST</th>
                                            <th width="2%" style="text-align: center;">Total</th>
                                            <?php }else{ ?>
                                            <th width="10%" colspan="6" style="text-align: center;">Serial Key</th>
                                            <?php } ?>
                                        </tr>
                                        <?php $counter = 0; $qtyttl = 0; $ttl = 0; $fttl = 0;  foreach ($outward_data['item_lists'] as $itemkey => $items) { $counter++; ?>
                                        <tr data-toggle="collapse" data-target="#idemo<?php echo $items['otwi_id']; ?>">
                                              <td><?php echo $counter; ?></td>
                                              <td colspan="2"><b><?php echo $items['otwi_part_no']."</b>".$items['otwi_itm_title']." <b>DESC:</b> ".nl2br($items['otwi_itm_desc'])."<br/><b>Comment:</b> ".nl2br($items['woi_comment']).'<br/>Production : '.$items['au_fname']; ?></td>
                                              <td><?php echo $items['otwi_qty']; $qtyttl = $qtyttl + $items['otwi_qty']; ?></td>
                                              <?php if($type_id == 3 || $dep_id == 10 || $dep_id == 11 || $dep_id == 1 || $dep_id == 2)
                                            { ?>
                                              <td style="word-break: break-all"><textarea class="form-control" rows="2" cols="10"><?php echo $items['serialkey']; ?></textarea></td>
                                              <td><?php echo $items['otwi_price']; ?></td>
                                              <td><?php echo $items['otwi_total']; $ttl = $ttl + $items['otwi_total'];  ?></td>
                                              <td><?php echo $items['otwi_discount']; ?></td>
                                              <td><?php echo $items['woi_gst']; ?></td>
                                              <td><?php echo $items['otwi_ftotal']; $fttl = $fttl + $items['otwi_ftotal']; ?></td>
                                              <?php }else{ ?>
                                                <td style="word-break: break-all" colspan="6"><textarea class="form-control" rows="2" cols="10"><?php echo $items['serialkey']; ?></textarea></td>
                                                <?php } ?>
                                        </tr>
                                     <?php } ?>
                                     <?php
                                     if($type_id == 3 || $dep_id == 10 || $dep_id == 11 || $dep_id == 1 || $dep_id == 2)
                                     {
                                      if(isset($outward_data['wo_charges']) && ($outward_data['wo_charges'] != '')){
                                            $charges = $outward_data['wo_charges'];
                                            if(is_array(json_decode($charges)) && !empty(json_decode($charges)))
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
                                        <tr>
                                              <td colspan="3" style="text-align:right; font-size:20px;"><b>Total :</b></td>
                                              <td style="text-align:center; font-size:18px;"><b><?php echo $qtyttl; ?></b></td>
                                              <td style="word-break: break-all"></td>
                                              <td></td>
                                              <td style="text-align:center; font-size:18px;"><b><?php echo $ttl;  ?></b></td>
                                              <td></td>
                                              <td></td>
                                              <td style="text-align:center; font-size:18px;"><b><?php echo $fttl; ?></b></td>
                                        </tr>
                                        <?php } ?>
                                        </tbody>
                                    </table> 
                                    <?php } ?>                                   
                                  
                            </div>
                            <hr/>
                            </div>
                        <?php } ?>                     
                                <nav aria-label="Page navigation" class="nav-right">
                                  <?php echo $pagi_links; ?>
                                </nav>       
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
<script src="<?php echo base_url(); ?>assets/pages/scripts/components-multi-select.min.js" type="text/javascript"></script>
<!-- END THEME LAYOUT SCRIPTS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="<?php echo base_url(); ?>assets/pages/scripts/form-samples.min.js" type="text/javascript"></script>
<!-- END PAGE LEVEL SCRIPTS -->
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
    $( document ).ready(function() {
        $(document).on('click', '.outwardhead', function () {
            var res = $(this).attr('id');
            //alert(res);
            res = res.split('outwardhead');
            //alert(res[1]);
            if($(".displayhead"+res[1]).hasClass('active')) {
                $(".displayhead"+res[1]).hide();  
                $(".displayhead"+res[1]).removeClass("active"); 
            }else{
                $(".displayhead"+res[1]).show();  
                $(".displayhead"+res[1]).addClass("active"); 
            }
        });
    });
</script>