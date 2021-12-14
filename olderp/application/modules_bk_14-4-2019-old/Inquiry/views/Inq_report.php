<link href="<?php echo base_url(); ?>assets/global/plugins/bootstrap-select/css/bootstrap-select.min.css" rel="stylesheet" type="text/css" />
<!-- BEGIN PAGE LEVEL PLUGINS -->
      
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/search/css/jquery-ui.css">
<!-- END PAGE LEVEL PLUGINS -->            

<div class="container-fluid">
                <div class="page-content">
<!-- BEGIN BREADCRUMBS -->
                    <div class="breadcrumbs">
                        <h1>Inquiry List</h1>
                        <ol class="breadcrumb">
                            <li>
                                <a href="<?php echo base_url(); ?>Dashboard">Dashboard</a>
                            </li>
                            <li class="active">
                                <a href="<?php echo base_url(); ?>Inquiry">Inquiry List</a>
                            </li>
                            <li>
                                <a href="<?php echo base_url(); ?>Inquiry/add">Inquiry Add</a>
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
                <h3><a class="btn btn-default blue" href="<?php echo base_url().'Inquiry/store_excel'; ?>">Export CSV</a></h3>
            </div>
        </div>
                   <!--  <div class="row">
                <div class="col-md-12 col-sm-12 text-right">
                <h3><a class="btn btn-default blue" href="<?php echo base_url().'inquiry/csvimport'; ?>">Import CSV</a></h3>
                    </div>
                </div> -->
        <div class="page-content-container">
                <!-- BEGIN CONTENT -->
                <?php echo form_open(base_url().'Inquiry/inq_report', array('method'=>'get', 'class' => 'form-horizontal')); ?>
            
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
                                                        <label class="control-label col-md-3">Product Type </label>
                                                        <div class="col-md-9">
                                                             <select name="product_type" id="product_type" class="bs-select form-control" data-live-search="true" data-placeholder="Choose Source" tabindex="5">
                                                                <option value="">Select Product Type</option>
                                                               <?php foreach($datas['ptypes'] as $ptype) { ?>
                                                            <option value="<?php echo $ptype['prot_id']?>"<?php if($this->input->get('product_type') && ($this->input->get('product_type') == $ptype['prot_id'])){ ?> selected="selected" <?php } ?>><?php echo $ptype['prot_name']?></option> 
                                                            <?php } ?> 
                                                        </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group" id="mcna_namegr">
                                                        <label class="control-label col-md-3">Product Category</label>
                                                        <div class="col-md-9">
                                                             <select  name="Product_Category" id="Product_Category" class="bs-select form-control" data-live-search="true" data-placeholder="Choose Source">
                                                            <option value="">Select Product Category</option>
                                                           <?php if($this->input->get('Product_Category')) { foreach($datas['pcats'] as $ptype) { ?>
                                                            <option value="<?php echo $ptype['procat_id']?>"<?php if($this->input->get('Product_Category') && ($this->input->get('Product_Category') == $ptype['procat_id'])){ ?> selected="selected" <?php } ?>><?php echo $ptype['procat_name']?></option> 
                                                            <?php } } ?> 
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                        </div>
                                         <div class="row"> 
                                            <div class="col-md-6">
                                                <div class="form-group" id="mcna_namegr">
                                                    <label class="control-label col-md-3">Inq. Status</label>
                                                    <div class="col-md-9">
                                                         <?php //foreach ($inq_record as $list) { ?>
                                                         <select  name="inq_Status" id="inq_Status" class="bs-select form-control" data-live-search="true" data-placeholder="Choose Source">
                                                            <option value="">Select Inq. Status</option> 
                                                        <?php foreach($datas['inqst'] as $ptype) { ?>
                                                            <option value="<?php echo $ptype['inquiry_status_id']?>"<?php if($this->input->get('inq_Status') && ($this->input->get('inq_Status') == $ptype['inquiry_status_id'])){ ?> selected="selected" <?php } ?>><?php echo $ptype['inquiry_status_name']?></option> 
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
                                                <label class="control-label col-md-3">Inq. Type</label>
                                                <div class="col-md-9">
                                                   <select  name="inq_Type" id="inq_Type" class="bs-select form-control inq_type" data-live-search="true" data-placeholder="Choose Source">
                                                    <option value="">Select Inq. Type</option> 
                                                    <?php foreach($datas['inquirys'] as $ptype) { ?>
                                                            <option value="<?php echo $ptype['inquiry_type_id']?>"<?php if($this->input->get('inq_Type') && ($this->input->get('inq_Type') == $ptype['inquiry_type_id'])){ ?> selected="selected" <?php } ?>><?php echo $ptype['inquiry_type_name']?></option> 
                                                            <?php } ?> 
                                                    </select>
                                                </div>
                                            </div> 
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group" id="mcna_namegr">
                                                    <label class="control-label col-md-3">Source</label>
                                                    <div class="col-md-9">
                                                        <select  name="Source" id="Source" class="bs-select form-control" data-live-search="true" data-placeholder="Choose Source">
                                                            <option value="">Select Source</option> 
                                                        <?php foreach($datas['sources'] as $ptype) { ?>
                                                            <option value="<?php echo $ptype['source_cat_id']?>"<?php if($this->input->get('Source') && ($this->input->get('Source') == $ptype['source_cat_id'])){ ?> selected="selected" <?php } ?>><?php echo $ptype['source_cat_name']?></option> 
                                                            <?php } ?>   
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row"> 
                                            <div class="col-md-6">
                                                <div class="form-group" id="master_party_local_tingr">
                                                <label class="control-label col-md-3">Sub Source</label>
                                                    <div class="col-md-9">
                                                       <select name="Sub_Source" id="Sub_Source" class="bs-select form-control" data-live-search="true" data-placeholder="Choose Source">
                                                        <option value="">Select Sub Source</option>
                                                        <?php foreach($datas['sub_sources'] as $ptype) { ?>
                                                            <option value="<?php echo $ptype['source_cat_id']?>"<?php if($this->input->get('Sub_Source') && ($this->input->get('Sub_Source') == $ptype['source_cat_id'])){ ?> selected="selected" <?php } ?>><?php echo $ptype['source_cat_name']?></option> 
                                                            <?php } ?>  
                                                        </select>
                                                    </div>
                                                </div> 
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group" id="master_party_local_tingr">
                                                <label class="control-label col-md-3">Executive</label>
                                                    <div class="col-md-9">
                                                       <select name="Executive" id="Executive" class="bs-select form-control" data-live-search="true" data-placeholder="Choose Source">
                                                        <option value="">Select Executive</option> 
                                                        <?php foreach($datas['users'] as $ptype) { ?>
                                                            <option value="<?php echo $ptype['au_id']?>"<?php if($this->input->get('Executive') && ($this->input->get('Executive') == $ptype['au_id'])){ ?> selected="selected" <?php } ?>><?php echo $ptype['au_fname']?></option> 
                                                            <?php } ?>    
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
                                                                     <a class="btn red" href="<?php echo base_url(); ?>Inquiry/inq_report">RESET</a>
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
                                <form method="get" accept-charset="utf-8" action="<?php echo base_url(); ?>Inquiry/delete_all">
                                    <div class="table-container">
                                        <div class="table-actions-wrapper">
                                            <span> </span>
                                            <select class="table-group-action-input form-control input-inline input-small input-sm" id="dropdownHolder"  name="edu_is_delete">
                                                <option value="0">Select...</option>
                                                <option value="1">Delete</option>
                                                <option value="1">Bill No.</option>
                                            </select>
                                            <button class="btn btn-sm" name="submit" type="submit">
                                                <i class="fa fa-check"></i> Submit</button>
                                          
                                        </div>
                                 
                                        <table class="table table-striped table-bordered table-hover table-checkable" id="datatable_ajax">
                                       
                                            <thead>
                                                <tr role="row" class="heading">
                                                    <?php /*?><th width="2%">
                                                        <input type="checkbox" class="group-checkable"> </th>
                                                    <th width="2%"> Record&nbsp;# </th>
<?php */?>                                          <th width="2%"> Inquiry Date</th>
                                                    <th width="2%"> Inquiry Type</th>
                                                    <th width="2%"> First Name</th>
                                                    <th width="2%"> Last Name </th>
                                                    <th width="2%"> Client Name </th>
                                                    <th width="2%"> Company Name </th>
                                                    <th width="2%"> Contact No. </th> 
                                                    <th width="2%"> Product type</th>
                                                    <th width="2%"> Category </th>
                                                    <th width="2%"> Status </th>
                                                    <th width="2%"> Executive</th>
                                                    <th width="2%"> Source </th>
                                                    <th width="2%"> Sub Source</th>
                                                    <th width="2%"> Remark</th>
                                                    <th width="2%"></th>
                                                </tr>
                                                <tr role="row" class="filter">
                                                   <?php /*?> <td> </td>
                                                    <td>
                                                        <input type="text" class="form-control form-filter input-sm" name="order_id"> </td><?php */?>
                                                    <td>
                                                        <input type="text" class="form-control form-filter input-sm" name="inq_date"> </td>
                                                    <td>
                                                        <input type="text" class="form-control form-filter input-sm" name="inq_type"> </td>
                                                        <td>
                                                        <input type="text" class="form-control form-filter input-sm" name="first_name"> </td>
                                                        <td>
                                                        <input type="text" class="form-control form-filter input-sm" name="last_name"> </td>
                                                        <td>
                                                        <input type="text" class="form-control form-filter input-sm" name="clientname"> </td>
                                                        <td>
                                                        <input type="text" class="form-control form-filter input-sm" name="companyname"> </td>
                                                         <td>
                                                        <input type="text" class="form-control form-filter input-sm" name="mno"> </td> 
                                                        <td>
                                                        <input type="text" class="form-control form-filter input-sm" name="ptype"> </td>
                                                        <td>
                                                        <input type="text" class="form-control form-filter input-sm" name="category"> </td>
                                                        <td>
                                                        <input type="text" class="form-control form-filter input-sm" name="status"> </td>
                                                        <td>
                                                        <input type="text" class="form-control form-filter input-sm" name="executive"> </td>
                                                         <td>
                                                        <input type="text" class="form-control form-filter input-sm" name="source"> </td>
                                                        <td>
                                                        <input type="text" class="form-control form-filter input-sm" name="subsource"> </td>
                                                        <td>
                                                        <input type="text" class="form-control form-filter input-sm" name="remark"> </td>
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
                                    <?php echo $this->load->view('Inquiry_setting_popup'); ?>
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
            var product_type = "<?php echo  $this->input->get('product_type') ? $this->input->get('product_type') : '';?>";
            var Product_Category = "<?php echo $this->input->get('Product_Category') ? $this->input->get('Product_Category') : '';?>";
            var inq_Status = "<?php echo $this->input->get('inq_Status') ? $this->input->get('inq_Status') : '';?>";
            var inq_Type = "<?php echo $this->input->get('inq_Type') ? $this->input->get('inq_Type') : '';?>";
            var Source = "<?php echo $this->input->get('Source') ? $this->input->get('Source') : '';?>";
            var Sub_Source = "<?php echo $this->input->get('Sub_Source') ? $this->input->get('Sub_Source') : '';?>";
            var Executive = "<?php echo $this->input->get('Executive') ? $this->input->get('Executive') : '';?>";
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
        <script src="<?php echo base_url(); ?>assets/custom/js/inq_report.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>assets/custom/js/inquiry_form.js" type="text/javascript"></script>
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