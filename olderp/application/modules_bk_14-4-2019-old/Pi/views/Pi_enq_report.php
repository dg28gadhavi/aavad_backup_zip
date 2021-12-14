<?php //echo "hiiiiiiiii" ; die;?>

<link href="<?php echo base_url(); ?>assets/global/plugins/bootstrap-select/css/bootstrap-select.min.css" rel="stylesheet" type="text/css" />
<!-- BEGIN PAGE LEVEL PLUGINS -->
      
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/search/css/jquery-ui.css">
<!-- END PAGE LEVEL PLUGINS -->            

<div class="container-fluid">
                <div class="page-content">
<!-- BEGIN BREADCRUMBS -->
                    <div class="breadcrumbs">
                        <h1>Sales Quotation Report</h1>
                        <ol class="breadcrumb">
                            <li>
                                <a href="<?php echo base_url(); ?>Dashboard">Dashboard</a>
                            </li>
                            <li class="active">
                                <a href="<?php echo base_url(); ?>Sale_quotation/sales_qoute_report">Sales Quotation Report</a>
                            </li>
                            <li>
                                <a href="<?php echo base_url(); ?>Sale_quotation/add">Sales Quotation Add</a>
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
                   <!--  <div class="row">
                <div class="col-md-12 col-sm-12 text-right">
                <h3><a class="btn btn-default blue" href="<?php echo base_url().'inquiry/csvimport'; ?>">Import CSV</a></h3>
                    </div>
                </div> -->
        <div class="page-content-container">
                <!-- BEGIN CONTENT -->
                <?php echo form_open(base_url().'Sale_quotation/sales_qoute_report', array('method'=>'get', 'class' => 'form-horizontal')); ?>
            
                <div class="page-content-container">
                    <!-- BEGIN CONTENT BODY -->
                    <div class="page-content-row">
                        <!-- BEGIN PAGE HEADER-->
                        <div class="page-content-col">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="portlet box">
                                        <div class="portlet-body form">
                                            <div class="form-body">  
                                        <div class="row">
                                            <div class="col-md-6 col-sm-12">
                                                <div class="form-group" id="mcna_namegr">
                                                    <h4 class="col-md-3 text-right">Inquiry Start Date</h4>
                                                    <div class="col-md-9">
                                                        <input type="text" class="form-control form-control-inline date-picker" placeholder="Start Date" name="inq_start_date" maxlength="200" id="inq_start_date" value="<?php echo ($this->input->get('inq_start_date')) ? $this->input->get('inq_start_date') : "";?>">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-sm-12 text-right">
                                                <div class="form-group" id="mcna_namegr">
                                                    <h4 class="col-md-3 text-right">Inquiry End Date</h4>
                                                    <div class="col-md-9">
                                                        <input type="text" class="form-control form-control-inline date-picker" placeholder="End Date" name="inq_end_date" maxlength="200" id="inq_end_date" value="<?php echo $this->input->get('inq_end_date') ? $this->input->get('inq_end_date') : ""; ?>">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>     
                                        <div class="row"> 
                                                <div class="col-md-6">
                                                    <div class="form-group" id="mcna_namegr">
                                                        <label class="control-label col-md-3">Vendor</label>
                                                        <div class="col-md-9">
                                                             <select name="vendor" id="vendor" class="bs-select form-control" data-live-search="true" data-placeholder="Choose Source" tabindex="5">
                                                                <option value="">Select Vendor</option>
                                                               <?php foreach($sales_enq as $ptype) { ?>
                                                            <option value="<?php echo $ptype['sa_id']?>"<?php if($this->input->get('vendor') && ($this->input->get('vendor') == $ptype['sa_id'])){ ?> selected="selected" <?php } ?>><?php echo $ptype['vendor']?></option>  
                                                            <?php } ?>
                                                        </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group" id="mcna_namegr">
                                                        <label class="control-label col-md-3">Contact Person</label>
                                                        <div class="col-md-9">
                                                             <select  name="conper" id="conper" class="bs-select form-control" data-live-search="true" data-placeholder="Choose Source">
                                                            <option value="">Select Contact Person</option>
                                                             <?php foreach($sales_enq as $ptype) { ?>
                                                            <option value="<?php echo $ptype['sa_id']?>"<?php if($this->input->get('conper') && ($this->input->get('conper') == $ptype['sa_id'])){ ?> selected="selected" <?php } ?>><?php echo $ptype['sa_con_person']?></option>  
                                                            <?php } ?> 
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                        </div>
                                         <div class="row"> 
                                            <div class="col-md-6">
                                                <div class="form-group" id="mcna_namegr">
                                                    <label class="control-label col-md-3">Country</label>
                                                    <div class="col-md-9">
                                                         <?php //foreach ($inq_record as $list) { ?>
                                                         <select  name="country" id="country" class="bs-select form-control" data-live-search="true" data-placeholder="Choose Source">
                                                            <option value="">Select Country</option> 
                                                        <?php foreach($countries as $ptype) { ?>
                                                            <option value="<?php echo $ptype['country_id']?>"<?php if($this->input->get('country') && ($this->input->get('country') == $ptype['country_id'])){ ?> selected="selected" <?php } ?>><?php echo $ptype['country_name']?></option> 
                                                            <?php } ?> 
                                                        </select>
                                                        <?php // } ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row"> 
                                            <div class="col-md-6">
                                                <div class="form-group" id="master_party_local_tingr">
                                                <label class="control-label col-md-3">State</label>
                                                <div class="col-md-9">
                                                   <select  name="state" id="state" class="bs-select form-control inq_type" data-live-search="true" data-placeholder="Choose Source">
                                                    <option value="">Select State</option> 
                                                    <?php foreach($states as $ptype) { ?>
                                                            <option value="<?php echo $ptype['state_id']?>"<?php if($this->input->get('state') && ($this->input->get('state') == $ptype['state_id'])){ ?> selected="selected" <?php } ?>><?php echo $ptype['state_name']?></option> 
                                                            <?php } ?> 
                                                    </select>
                                                </div>
                                            </div> 
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group" id="mcna_namegr">
                                                    <label class="control-label col-md-3">City</label>
                                                    <div class="col-md-9">
                                                        <select  name="city" id="city" class="bs-select form-control" data-live-search="true" data-placeholder="Choose Source">
                                                            <option value="">Select City</option> 
                                                        <?php foreach($cities as $ptype) { ?>
                                                            <option value="<?php echo $ptype['city_id']?>"<?php if($this->input->get('city') && ($this->input->get('city') == $ptype['city_id'])){ ?> selected="selected" <?php } ?>><?php echo $ptype['city_name']?></option> 
                                                            <?php } ?>   
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row"> 
                                            <div class="col-md-6">
                                                <div class="form-group" id="master_party_local_tingr">
                                                <label class="control-label col-md-3">Mobile</label>
                                                    <div class="col-md-9">
                                                       <select name="mobile" id="mobile" class="bs-select form-control" data-live-search="true" data-placeholder="Choose Source">
                                                        <option value="">Select Mobile</option>
                                                        <?php foreach($sales_enq as $ptype) { ?>
                                                            <option value="<?php echo $ptype['sa_id']?>"<?php if($this->input->get('mobile') && ($this->input->get('mobile') == $ptype['sa_id'])){ ?> selected="selected" <?php } ?>><?php echo $ptype['sa_mobile']?></option> 
                                                            <?php } ?>  
                                                        </select>
                                                    </div>
                                                </div> 
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group" id="master_party_local_tingr">
                                                <label class="control-label col-md-3">Status</label>
                                                    <div class="col-md-9">
                                                       <select name="status" id="status" class="bs-select form-control" data-live-search="true" data-placeholder="Choose Source">
                                                        <option value="">Select Status</option>
                                                        
                                                            <option value="Active"<?php if($this->input->get('status') && ($this->input->get('status') == 'Active')){ ?> selected="selected" <?php } ?>>Active</option> 
                                                             <option value="Pending"<?php if($this->input->get('status') && ($this->input->get('status') == 'Pending')){ ?> selected="selected" <?php } ?>>Pending</option>
                                                              <option value="Completed"<?php if($this->input->get('status') && ($this->input->get('status') == 'Completed')){ ?> selected="selected" <?php } ?>>Completed</option>
                                                            
                                                        </select>
                                                    </div>
                                                </div> 
                                            </div>
                                        </div>
                                     
                                                <div class="form-actions">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="row">
                                                                <div class="col-md-offset-3 col-md-9">
                                                                    <button type="submit" class="btn green" ><?php echo $this->input->get('id')?'Submit':'SUBMIT'; ?></button>
                                                                     <a class="btn red" href="<?php echo base_url(); ?>Sale_quotation/sales_qoute_report">RESET</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                     <?php echo form_close(); ?>
                                                </div>
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
                                    <?php
                                    $atr = array("method" => "get");
                                     echo form_open(base_url()."Sale_quotation/oatopo",$atr);?>
                                <!-- <form method="get" accept-charset="utf-8" action=""> -->
                                    <div class="table-container">
                                        <div class="table-actions-wrapper">
                                            <span> </span>
                                              <select class="form-control" name="action">
                                                <option value="">Action...</option>
                                                <option value="oa">OA</option>
                                            </select>
                                            <button class="btn btn-sm" name="submit" type="submit">
                                                <i class="fa fa-check"></i> Submit</button>
                                          
                                        </div>
                                 
                                        <table class="table table-striped table-bordered table-hover table-checkable" id="datatable_ajax">
                                       
                                            <thead>
                                                <tr role="row" class="heading">
                                                    <th width="2%">
                                                        <input type="checkbox" class="group-checkable"> </th>
                                                    <th width="2%"> Record&nbsp;# </th>
                                                    <th width="5%"> Inquiry Code</th>
                                                    <th width="2%"> Customer Name </th>
                                                   <!--  <th width="2%"> Inquiry By </th>
                                                    <th width="2%"> Mode Of Inquiry  </th> -->
                                                    <th width="2%"> Status </th>
                                                    <th width="2%"> Priority </th>
                                                    <th width="2%"> Amount</th>
                                                    <th width="2%"> Remark </th>
                                                    <th width="2%"> Mobile No</th>
                                                    <th width="2%"> Country</th>
                                                    <th width="2%"> State</th>
                                                    <th width="2%"> City </th>
                                                    <th width="2%"> Inquiry Date</th>
                                                    <th width="2%"> Referred By </th>
                                                    <th width="1%"> Created Date </th>
                                                    <th width="2%"></th>
                                                </tr>
                                                <tr role="row" class="filter">
                                                    <td> </td>
                                                    <td>
                                                        <input type="text" class="form-control form-filter input-sm" name="order_id"> </td>
                                                    <td>
                                                        <input type="text" class="form-control form-filter input-sm" name="inquiry_number"> </td>
                                                    <td>
                                                        <input type="text" class="form-control form-filter input-sm" name="order_customer_name"> </td>
                                                    
                                                    <!-- <td>
                                                        <input type="text" class="form-control form-filter input-sm" name="inquiry_by"> </td>
                                                    <td>
                                                        <input type="text" class="form-control form-filter input-sm" name="mode_of_inq"> </td> -->
                                                    <td>
                                                        <input type="text" class="form-control form-filter input-sm" name="status"> </td>
                                                    <td>
                                                        <input type="text" class="form-control form-filter input-sm" name="priority"> </td>
                                                     <td>
                                                        <input type="text" class="form-control form-filter input-sm" name="amount"> </td>
                                                    <td>
                                                        <input type="text" class="form-control form-filter input-sm" name="remark"> </td>
                                                    <td>
                                                        <input type="text" class="form-control form-filter input-sm" name="mobile_no"> </td>
                                                     <td>
                                                        <input type="text" class="form-control form-filter input-sm" name="country"> </td>
                                                    <td>
                                                        <input type="text" class="form-control form-filter input-sm" name="state"> </td>
                                                    <td>
                                                        <input type="text" class="form-control form-filter input-sm" name="city"> </td>
                                                    <td>
                                                        <input type="text" class="form-control form-filter input-sm" name="inquiry_date"> </td>
                                                    <td>
                                                        <input type="text" class="form-control form-filter input-sm" name="reffered_by"> </td>
                                                    <td>
                                                        <input type="text" class="form-control form-filter input-sm" name="inquiry_cdate"> </td>
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
                                    <?php echo form_close(); ?>
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
        <!-- BEGIN PAGE LEVEL SCRIPTS -->
        <script src="<?php echo base_url(); ?>assets/custom/js/sales_qoute_report.js" type="text/javascript"></script>
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