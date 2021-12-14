<?php // echo "<pre>"; print_r($value); die;?>
<link rel="stylesheet" href="<?php echo base_url(); ?>skin/css/style.css">
<link href="<?php echo base_url(); ?>assets/global/plugins/bootstrap-select/css/bootstrap-select.min.css" rel="stylesheet" type="text/css" />
<!-- BEGIN PAGE LEVEL PLUGINS -->
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/search/css/jquery-ui.css">
<!-- END PAGE LEVEL PLUGINS -->            

<div class="container-fluid">
                <div class="page-content">
<!-- BEGIN BREADCRUMBS -->
                    <div class="breadcrumbs bread-title">
                        <h1>Work Order Item Report</h1>

                        <ol class="breadcrumb">
                            <li><a href="<?php echo base_url(); ?>Dashboard">Dashboard</a></li>
                            <li class="active"><a href="<?php echo base_url(); ?>Work_order_item_list/Work_order_item_list_report">Work Order Item Report</a>
                            </li>
                            <li><a href="<?php echo base_url(); ?>Work_order_item_list/add">Work Order Add</a></li>
                        </ol>
                        <!-- Sidebar Toggle Button -->
                        <!-- <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".page-sidebar">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="toggle-icon">
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </span>
                        </button> -->
                        <!-- Sidebar Toggle Button -->
                    </div>
                    <div class="row">
                <div class="col-md-12 col-sm-12 text-right">
            </div>
        </div>
        <div class="page-content-container">
                <!-- BEGIN CONTENT -->
                <?php $search_task = array('class' => 'form-horizontal','method' => 'get');
                                    echo form_open(base_url().'Work_order_item_list/Work_order_item_list_report',$search_task); ?>
                <div class="page-content-container">
                    <!-- BEGIN CONTENT BODY -->
                    <div class="page-content-row">
                        <!-- BEGIN PAGE HEADER-->
                        <div class="page-content-col">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="portlet box portlet-quote">
                                        <div class="portlet-body form">
                                            <div class="form-body">  
                                        <div class="row">
                                            <div class="col-md-1 col-sm-12">
                                                <div class="form-group" id="mcna_namegr">
                                                    <div class="col-md-12">
                                                        <input type="text" class="form-control form-control-inline date-picker" placeholder="Start Date" name="inq_start_date" maxlength="200" id="inq_start_date" value="<?php echo ($this->input->get('inq_start_date')) ? $this->input->get('inq_start_date') : "";?>">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-1 col-sm-12 text-right">
                                                <div class="form-group" id="mcna_namegr">
                                                    <div class="col-md-12">
                                                        <input type="text" class="form-control form-control-inline date-picker" placeholder="End Date" name="inq_end_date" maxlength="200" id="inq_end_date" value="<?php echo $this->input->get('inq_end_date') ? $this->input->get('inq_end_date') : ''; ?>">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-1 col-sm-12">
                                                <div class="form-group" id="mcna_namegr">
                                                    <div class="col-md-12">
                                                        <input type="text" class="form-control form-control-inline date-picker" placeholder="Invoice Start Date" name="inv_start_date" maxlength="200" id="inv_start_date" value="<?php echo ($this->input->get('inv_start_date')) ? $this->input->get('inv_start_date') : "";?>">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-1 col-sm-12 text-right">
                                                <div class="form-group" id="mcna_namegr">
                                                    <div class="col-md-12">
                                                        <input type="text" class="form-control form-control-inline date-picker" placeholder="Invoice End Date" name="inv_end_date" maxlength="200" id="inv_end_date" value="<?php echo $this->input->get('inv_end_date') ? $this->input->get('inv_end_date') : ''; ?>">
                                                    </div>
                                                </div>
                                            </div>
                                             <div class="col-md-1">
                                                <div class="form-group" id="mcna_namegr">
                                                    <div class="col-md-12">

                                                        <select name="au_fname" id="au_fname" class="bs-select form-control itmchange" data-live-search="true" data-size="8" tabindex="4">

                                                        <option value="">Executive</option>
                                                      <?php  foreach($executive as $exe) {

                                                        ?>  <option value="<?php echo $exe['au_id'];?>" <?php if($this->input->get('au_fname') && ($this->input->get('au_fname') != '') && ($this->input->get('au_fname') == $exe['au_id'])){ ?> selected <?php } ?>><?php echo $exe['au_fname'].' '.$exe['au_lname']; ?></option><?php } ?>
                                                    </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-1 col-md-1 col-sm-1 col-xs-12 text-left">
                                                     <input type="text" class="form-control" placeholder="Customer Search" name="customer_search" maxlength="200" id="customer_search" value="<?php echo $this->input->get('customer_search') ? $this->input->get('customer_search') : ''; ?>">
                                            </div>
                                            <div class="col-lg-1 col-md-1 col-sm-1 col-xs-12 text-left">
                                                     <input type="text" class="form-control" placeholder="Part No. Wise Search" name="part_no_search" maxlength="200" id="part_no_search" value="<?php echo $this->input->get('part_no_search') ? $this->input->get('part_no_search') : ''; ?>">
                                            </div>
                                            <div class="col-lg-1 col-md-1 col-sm-1 col-xs-12 text-left">
                                                     <input type="text" class="form-control" placeholder="Vendor Wise Search" name="vendor_search" maxlength="200" id="vendor_search" value="<?php echo $this->input->get('vendor_search') ? $this->input->get('vendor_search') : ''; ?>">
                                            </div>
                                            <div class="col-lg-1 col-md-1 col-sm-1 col-xs-12 text-left">
                                                     <input type="text" class="form-control" placeholder="Address" name="address_search" maxlength="200" id="address_search" value="<?php echo $this->input->get('address_search') ? $this->input->get('address_search') : ''; ?>">
                                            </div>
                                            <div class="col-md-2">
                                                <button class="btn green" type="submit"><i class="fa fa-check"></i></button>
                                                <a href="<?php echo base_url(); ?>Work_order_item_list/Work_order_item_list_report" class="btn red text-left"><i class="fa fa-refresh"></i></a>
                                            </div>                                           
                                        </div>  
                                        <?php echo form_close(); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    <!-- END CONTENT BODY -->
                        </div>
                    </div>
                </div> 
</div>
<!-- END BREADCRUMBS -->
            <!-- BEGIN CONTENT -->
        <div class="row">
            <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
                <div class="dashboard-stat2 bordered sales-dashbg">
                    <div class="display">
                        <div class="number">
                            <h3 class="font-green-sharp">
                                <span data-counter="counterup" data-value="<?php echo isset($total_counts['ttl']['sumqty']) ? number_format($total_counts['ttl']['sumqty']) : 0;?>"></span>
                                <small class="font-green-sharp"><?php echo isset($total_counts['ttl']['sumqty']) ? number_format($total_counts['ttl']['sumqty']) : 0;?></small>
                            </h3>
                            <a href=""><small>Total Qty</small></a>
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
                                <span data-counter="counterup" data-value="<?php echo isset($total_counts['ttl']['ttl_wo']) ? number_format($total_counts['ttl']['ttl_wo']) : 0;?>"></span>
                                <small class="font-green-sharp"><?php echo isset($total_counts['ttl']['ttl_wo']) ? number_format($total_counts['ttl']['ttl_wo']) : 0;?></small>
                            </h3>
                            <a href=""><small>Total Amount</small></a>
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
                                <span data-counter="counterup" data-value="<?php echo isset($total_counts['ttl']['ttl_wo']) ? number_format($total_counts['ttl']['ttl_wo']) : 0;?>"></span>
                                <small class="font-green-sharp"><?php echo isset($total_counts['ttl']['ttl_wo']) && isset($total_counts['ttl']['sumqty']) && ($total_counts['ttl']['sumqty'] != 0) ? number_format($total_counts['ttl']['ttl_wo']/$total_counts['ttl']['sumqty']) : 0;?></small>
                            </h3>
                            <a href=""><small>Avg. Price</small></a>
                        </div>
                        <div class="icon">
                            <i class="icon-pie-chart"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
            <div class="page-content-container">
                <div class="row" style="display:none">
                        <div class="col-md-6 col-sm-12">
                           <!--  <h3 class="page-title">Country Master </h3> -->
                        </div>
                        <div class="col-md-6 col-sm-12 text-right">
                        <a class="btn btn-default green" id="add_more_brand" data-toggle="modal" href="#inquiryselect"></i>Setting</a>
                           
                        </div>
                    </div>
                <!-- BEGIN CONTENT BODY -->
                <div class="page-content-row">
                    <!-- BEGIN PAGE HEADER-->
                    <div class="page-content-col">
                    <?php //echo '<pre>';print_r($emails);//die; ?>
                    <div class="row">
                    	<div class="col-md-12">
                            <?php
                            if (!empty($success) || $this->session->flashdata('success') != '') {
                                $msg = !empty($success) ? $success : $this->session->flashdata('success');
                                echo '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button>' . $msg . '</div>';
                            }
                            if (!empty($error) || $this->session->flashdata('error') != '') {
                                $msg = !empty($error) ? $error : $this->session->flashdata('error');
                                echo '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button>' . $msg . '</div>';
                            }
                            if (!empty($warning) || $this->session->flashdata('warning') != '') {
                                $msg = !empty($warning) ? $warning : $this->session->flashdata('warning');
                                echo '<div class="alert alert-warning"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button>' . $msg . '</div>';
                            }
                            ?>
                            <div class="space-2"></div>
                        </div>
                        <div class="col-md-12">
                            <!-- Begin: life time stats -->
                            <div class="portlet light portlet-fit portlet-datatable bordered">
                                <div class="portlet-title">
                                    <div class="actions" style="display:none">
                                        <div class="btn-group">
                                            <a class="btn red btn-outline btn-circle" href="javascript:;" data-toggle="dropdown">
                                                <i class="fa fa-share"></i>
                                                <span class="hidden-xs"> Tools </span>
                                                <i class="fa fa-angle-down"></i>
                                            </a>
                                            <ul class="dropdown-menu pull-right" id="datatable_ajax_tools">
                                                <li>
                                                    <a href="javascript:;" data-action="0" class="tool-action">
                                                        <i class="icon-printer"></i> Print</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:;" data-action="1" class="tool-action">
                                                        <i class="icon-check"></i> Copy</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:;" data-action="2" class="tool-action">
                                                        <i class="icon-doc"></i> PDF</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:;" data-action="3" class="tool-action">
                                                        <i class="icon-paper-clip"></i> Excel</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:;" data-action="4" class="tool-action">
                                                        <i class="icon-cloud-upload"></i> CSV</a>
                                                </li>
                                                <li class="divider"> </li>
                                                <li>
                                                    <a href="javascript:;" data-action="5" class="tool-action">
                                                        <i class="icon-refresh"></i> Reload</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="portlet-body">
                                <form method="get" accept-charset="utf-8" action="">
                                    <div class="table-container">
                                <table class="table table-striped table-bordered table-hover table-checkable" id="datatable_ajax">
                                            <thead>
                                                <tr role="row" class="heading">
                                                    <th width="5%"> No.</th>
                                                    <th width="2%"> W.O Date </th>                                                    
                                                    <th width="2%"> Customer Name </th>                                                    
                                                    <th width="2%"> Part No.</th>
                                                    <th width="2%"> Vendor</th>
                                                    <th width="2%"> Quantity </th>
                                                    <th width="2%"> Price</th>
                                                    <th width="2%"> Discount </th>
                                                    <th width="2%"> Final Price </th>
                                                    <th width="2%"> Prepared By </th>

                                                    <th width="2%"> Productweight </th>
                                                    <th width="2%">Product Desc </th>
                                                    <th width="2%"> Comment Production </th>
                                                     <th width="2%"> Remark </th>
                                                    <th width="2%"> Updated Date </th>
                                                    <th width="2%"></th>
                                                </tr>
                                                <tr role="row" class="filter">
                                                    <td><input type="text" class="form-control form-filter input-sm" name="wo_wo_no"> </td>
                                                    <td><input type="text" class="form-control form-filter input-sm" name="wo_wo_date"> </td>
                                                    <td><input type="text" class="form-control form-filter input-sm" name="wo_customer_name"></td>
                                                    <td><input type="text" class="form-control form-filter input-sm" name="woi_part_no"> </td>
                                                    <td><input type="text" class="form-control form-filter input-sm" name="vendor"> </td>
                                                    <td><input type="text" class="form-control form-filter input-sm" name="woi_qty"> </td>
                                                    <td><input type="text" class="form-control form-filter input-sm" name="woi_price"> </td>
                                                    <td><input type="text" class="form-control form-filter input-sm" name="woi_discount"> </td>
                                                    <td><input type="text" class="form-control form-filter input-sm" name="woi_final_price"> </td>
                                                    <td><input type="text" class="form-control form-filter input-sm" name="wo_preparedby"> </td>

                                                    <td><input type="text" class="form-control form-filter input-sm" name="woi_productweight"> </td>
                                                    <td><input type="text" class="form-control form-filter input-sm" name="woi_itm_desc"> </td>
                                                    <td><input type="text" class="form-control form-filter input-sm" name="woi_comment"> </td>
                                                    <td><input type="text" class="form-control form-filter input-sm" name="wo_remark"> </td>
                                                    <td><input type="text" class="form-control form-filter input-sm" name="wo_udate"> </td>
                                                    <td>
                                                        <div class="margin-bottom-5">
                                                            <button class="btn btn-sm green btn-outline filter-submit margin-bottom">
                                                                <i class="fa fa-search"></i> Search</button>
                                                        </div>
                                                        <button class="btn btn-sm red btn-outline filter-cancel">
                                                            <i class="fa fa-times"></i> Reset</button>
                                                    </td>
                                                </tr>
                                            </thead>
                                            <tbody> </tbody>
                                        </table>
                                    </div>
                                   </form>
                                    <?php //echo $this->load->view('Inquiry_setting_popup'); ?>
                                </div>
                            </div>
                            <!-- End: life time stats -->
                        </div>
                    </div>
                </div>
                <!-- END CONTENT BODY -->
            </div>
            </div>
            </div>
            </div>

            <!-- END CONTENT -->
<!--[if lt IE 9]>
<script src="<?php echo base_url(); ?>assets/global/plugins/respond.min.js"></script>
<script src="<?php echo base_url(); ?>assets/global/plugins/excanvas.min.js"></script> 
<![endif]-->
<!-- BEGIN CORE PLUGINS -->
<script type="text/javascript"> var base_url = '<?php echo base_url(); ?>';</script>
<script src="<?php echo base_url(); ?>assets/global/plugins/jquery.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/global/plugins/js.cookie.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/global/plugins/uniform/jquery.uniform.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
<!-- END CORE PLUGINS -->
<script type="text/javascript">
    var inq_start_date = "<?php echo $this->input->get('inq_start_date') ? $this->input->get('inq_start_date') : '';?>";
    var inq_end_date = "<?php echo $this->input->get('inq_end_date') ? $this->input->get('inq_end_date') : '';?>";
    var au_fname = "<?php echo  $this->input->get('au_fname') ? $this->input->get('au_fname') : '';?>";
    var country = "<?php echo $this->input->get('country') ? $this->input->get('country') : '';?>";
    var state = "<?php echo $this->input->get('state') ? $this->input->get('state') : '';?>";
    var city = "<?php echo $this->input->get('city') ? $this->input->get('city') : '';?>";
    var mobile = "<?php echo $this->input->get('mobile') ? $this->input->get('mobile') : '';?>";
    var status = "<?php echo $this->input->get('status') ? $this->input->get('status') : '';?>";
    var sq_cust_type = "<?php echo $this->input->get('sq_cust_type') ? $this->input->get('sq_cust_type') : '';?>";
    var sq_source_cat = "<?php echo $this->input->get('sq_source_cat') ? $this->input->get('sq_source_cat') : '';?>";
    var sq_subsource_cat = "<?php echo $this->input->get('sq_subsource_cat') ? $this->input->get('sq_subsource_cat') : '';?>";
    var sq_end_st = "<?php echo $this->input->get('sq_end_st') ? $this->input->get('sq_end_st') : '';?>";
    var sq_brand = "<?php echo $this->input->get('sq_brand') ? $this->input->get('sq_brand') : '';?>";
    var conper = "<?php echo $this->input->get('conper') ? $this->input->get('conper') : '';?>";
    var adminapproved = "<?php echo $this->input->get('adminapproved') ? $this->input->get('adminapproved') : '';?>";
    var smapproved = "<?php echo $this->input->get('smapproved') ? $this->input->get('smapproved') : '';?>";
    var pmapproved = "<?php echo $this->input->get('pmapproved') ? $this->input->get('pmapproved') : '';?>";
    <?php $qury_data = isset($_SERVER["QUERY_STRING"]) && ($_SERVER["QUERY_STRING"] != '') ? '?'.$_SERVER["QUERY_STRING"] : ''; ?>
    var qury_data = "<?php echo $qury_data;?>";
    </script>
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script src="<?php echo base_url(); ?>assets/global/plugins/bootstrap-select/js/bootstrap-select.min.js" type="text/javascript"></script>
 <script src="<?php echo base_url(); ?>assets/pages/scripts/components-bootstrap-select.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/global/scripts/datatable.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/global/plugins/datatables/datatables.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js" type="text/javascript"></script>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN THEME GLOBAL SCRIPTS -->
<script src="<?php echo base_url(); ?>assets/global/scripts/app.min.js" type="text/javascript"></script>
<!-- END THEME GLOBAL SCRIPTS -->
<script type="text/javascript">
    $('.date-picker').datepicker({
        format: 'dd-mm-yyyy',
    });
</script>
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="<?php echo base_url(); ?>assets/custom/js/Work_order_item_list_report.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/custom/js/Inquiry_form.js" type="text/javascript"></script>
<!-- END PAGE LEVEL SCRIPTS -->
<?php //theme layout scripts ?>