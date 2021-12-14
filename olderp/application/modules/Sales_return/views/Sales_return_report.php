<?php //echo "hiiiiiiiii" ; die;?>
<link rel="stylesheet" href="<?php echo base_url(); ?>skin/css/style.css">
<link href="<?php echo base_url(); ?>assets/global/plugins/bootstrap-select/css/bootstrap-select.min.css" rel="stylesheet" type="text/css" />
<!-- BEGIN PAGE LEVEL PLUGINS -->
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/search/css/jquery-ui.css">
<!-- END PAGE LEVEL PLUGINS -->            

<div class="container-fluid">
                <div class="page-content">
<!-- BEGIN BREADCRUMBS -->
                    <div class="breadcrumbs bread-title">
                        <h1>Sales Return Report</h1>
                        <ol class="breadcrumb">
                            <li>
                                <a href="<?php echo base_url(); ?>Dashboard">Dashboard</a>
                            </li>
                            <li class="active">
                                <a href="<?php echo base_url(); ?>Sales_return/Sales_return_report">Sales Return Report</a>
                            </li>
                            <li>
                                <a href="<?php echo base_url(); ?>Sales_return/add">Sales Return Add</a>
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
                    </div>
                    <div class="row">
                <div class="col-md-12 col-sm-12 text-right">

            </div>
        </div>

        <div class="page-content-container">
                <!-- BEGIN CONTENT -->
                <?php echo form_open(base_url().'Outward/Outward_report', array('method'=>'get', 'class' => 'form-horizontal')); ?>
            
                
</div>
<!-- END BREADCRUMBS -->
            <!-- BEGIN CONTENT -->
              <div class="row">
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
                             <!-- form start-->
                            <div class="row">
                                <div class="col-md-6 col-sm-12">
                                    <div class="form-group" id="mcna_namegr">
                                        <h4 class="col-md-3 text-right">Start Date</h4>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control form-control-inline date-picker" placeholder="Start Date" name="created_start_date" maxlength="200" id="created_start_date" value="<?php echo $this->input->get('created_start_date') ? $this->input->get('created_start_date') : ""; ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12 text-right">
                                    <div class="form-group" id="mcna_namegr">
                                        <h4 class="col-md-3 text-right">End Date</h4>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control form-control-inline date-picker" placeholder="End Date" name="created_end_date" maxlength="200" id="created_end_date" value="<?php echo $this->input->get('created_end_date') ? $this->input->get('created_end_date') : ""; ?>">
                                        </div>
                                    </div>
                                </div>
                            </div>
                   			<br />
                        <div class="form-actions">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-md-offset-3 col-md-9">
                                            <button type="submit" class="btn green" onclick="return ValidateDetails()" >Submit</button>
                                            <a class="btn red" href="<?php echo base_url().'Report'; ?>" >Reset</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6"> </div>
                            </div>
                        </div>
                     <?php echo form_close(); ?>
                       <hr />
                     <!-- form end-->
                        </div>
                        <div class="row">
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <div class="dashboard-stat blue">
                                <div class="visual">
                                    <i class="fa fa-comments"></i>
                                </div>
                                <div class="details">
                                    <div class="number">
                                        <span data-counter="counterup" data-value="1349"><?php echo number_format($report_result['totaldata']['total']); ?></span>
                                    </div>
                                    <div class="desc">No of Outward</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <div class="dashboard-stat blue">
                                <div class="visual">
                                    <i class="fa fa-comments"></i>
                                </div>
                                <div class="details">
                                    <div class="number">
                                        <span data-counter="counterup" data-value="1349"><?php echo number_format($report_result['itemdata']['item']); ?></span>
                                    </div>
                                    <div class="desc">No of Item in Outward</div>
                                </div>
                            </div>
                        </div>
                        
                        
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <div class="dashboard-stat purple">
                                <div class="visual">
                                    <i class="fa fa-globe"></i>
                                </div>
                                <div class="details">
                                    <div class="number">
                                        <span data-counter="counterup" data-value="89"><?php echo number_format($report_result['stockdata']['stock']); ?></span> </div>
                                    <div class="desc">Total No of stock Outward </div>
                                </div>
                            </div>
                        </div>
                        
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
                                                    <th width="2%"> Customer Name</th>
                                                    <th width="2%"> Bill Number </th>
                                                    <th width="2%"> Challen No</th>
                                                    <th width="2%"> Challen Date</th>
                                                    <th width="2%"> Transport Name </th>
                                                    <th width="2%"></th>
                                                </tr>
                                                <tr role="row" class="filter">
                                                    <td>
                                                    <input type="text" class="form-control form-filter input-sm" name="otw_no"> </td>
                                                    <td>
                                                        <input type="text" class="form-control form-filter input-sm" name="sales_return_master_party"> </td>
                                                    <td>
                                                        <input type="text" class="form-control form-filter input-sm" name="sales_return_bill_no"> </td>
                                                     <td>
                                                        <input type="text" class="form-control form-filter input-sm" name="sales_return_challan_no"> </td>
                                                    <td>
                                                        <input type="text" class="form-control form-filter input-sm" name="sales_return_challan_date"> </td>
                                                    <td>
                                                        <input type="text" class="form-control form-filter input-sm" name="sales_return_transporter_name"> </td>
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
            var vendor = "<?php echo  $this->input->get('vendor') ? $this->input->get('vendor') : '';?>";
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
         <script type="text/javascript">
        var created_start_date = "<?php echo $this->input->get('created_start_date') ? $this->input->get('created_start_date') : '';?>";
        var created_end_date = "<?php echo $this->input->get('created_end_date') ? $this->input->get('created_end_date') : '';?>";
    
         </script>
        <script src="<?php echo base_url(); ?>assets/custom/js/sales_return_report.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>assets/custom/js/Inquiry_form.js" type="text/javascript"></script>
        <!-- END PAGE LEVEL SCRIPTS -->
         <!-- BEGIN PAGE LEVEL PLUGINS -->
        <script src="<?php echo base_url(); ?>assets/global/plugins/bootstrap-select/js/bootstrap-select.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>assets/global/scripts/datatable.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>assets/global/plugins/datatables/datatables.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>assets/pages/scripts/components-bootstrap-select.min.js" type="text/javascript"></script>
        <!-- END PAGE LEVEL PLUGINS -->
        <?php //theme layout scripts ?>