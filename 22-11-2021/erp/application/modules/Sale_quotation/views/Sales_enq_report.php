<?php //echo "hiiiiiiiii" ; die;?>

<link rel="stylesheet" href="<?php echo base_url(); ?>skin/css/style.css">
<link href="<?php echo base_url(); ?>assets/global/plugins/bootstrap-select/css/bootstrap-select.min.css" rel="stylesheet" type="text/css" />
<!-- BEGIN PAGE LEVEL PLUGINS -->
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/search/css/jquery-ui.css">
<!-- END PAGE LEVEL PLUGINS -->
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

<!--  <div class="row">
<div class="col-md-12 col-sm-12 text-right">
<h3><a class="btn btn-default blue" href="<?php echo base_url().'inquiry/csvimport'; ?>">Import CSV</a></h3>
    </div>
</div> -->
<div class="page-content-container">
    <!-- BEGIN CONTENT -->
    <?php echo form_open(base_url().'Sale_quotation/sales_qoute_report', array('method'=>'get', 'class' => 'form-horizontal', 'autocomplete' => 'off')); ?>
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
                                            <div class="col-md-4 col-sm-12">
                                                <div class="form-group" id="mcna_namegr">                                                   
                                                    <label class="control-label col-md-5">Inquiry Start Date</label>
                                                    <div class="col-md-7">
                                                        <input type="text" tabindex="1" class="form-control form-control-inline date-picker" placeholder="Start Date" name="inq_start_date" maxlength="200" id="inq_start_date" value="<?php echo ($this->input->get('inq_start_date')) ? $this->input->get('inq_start_date') : "";?>" autofocus>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4 col-sm-12 text-right">
                                                <div class="form-group" id="mcna_namegr">
                                                    <label class="control-label col-md-5">Inquiry End Date</label>
                                                    <div class="col-md-7">
                                                        <input type="text" tabindex="2" class="form-control form-control-inline date-picker" placeholder="End Date" name="inq_end_date" maxlength="200" id="inq_end_date" value="<?php echo $this->input->get('inq_end_date') ? $this->input->get('inq_end_date') : date('d-m-Y'); ?>">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4 col-sm-12">
                                                <div class="form-group" id="mcna_namegr">
                                                    <label class="control-label col-md-5">Executive By</label>
                                                    <div class="col-md-7">
                                                        <select name="sq_end_st" id="sq_end_st" tabindex="3" class="bs-select form-control itmchange" data-live-search="true" data-size="8">
                                                            <option value="0">Select Inquiry By</option>
                                                            <?php  foreach($admins as $vendor) {?>  <option value="<?php echo $vendor['au_id'];?>" <?php if($this->input->get('sq_end_st') && ($this->input->get('sq_end_st') == $vendor['au_id'])){ ?> selected="selected" <?php } ?>><?php echo $vendor['au_fname']; ?></option><?php } ?> 
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php /* ?>   
                                            <div class="col-md-4 col-sm-12" style="display: none;">
                                                    <div class="form-group" id="mcna_namegr">
                                                        <label class="control-label col-md-5">Customer :</label>
                                                        <div class="col-md-7">
                                                             <select name="vendor" id="vendor" class="bs-select form-control" data-live-search="true" data-placeholder="Choose Source" tabindex="4">
                                                                <option value="">Select Vendor</option>
                                                               <?php foreach($sales_enq as $ptype) { ?>
                                                            <option value="<?php echo $ptype['sa_id']?>"<?php if($this->input->get('vendor') && ($this->input->get('vendor') == $ptype['sa_id'])){ ?> selected="selected" <?php } ?>><?php echo $ptype['vendor']?></option>  
                                                            <?php } ?>
                                                        </select>
                                                        </div>
                                                    </div>
                                            </div> <?php */ ?>
                                        </div>  
                                        <?php /* ?>   
                                        <div class="row">                                                
                                            <div class="col-md-4 col-sm-12" style="display: none;">
                                                    <div class="form-group" id="mcna_namegr">
                                                        <label class="control-label col-md-5">Contact Person :</label>
                                                        <div class="col-md-7">
                                                             <select  name="conper" id="conper" class="bs-select form-control" data-live-search="true" data-placeholder="Choose Source">
                                                            <option value="">Select Contact Person</option>
                                                             <?php foreach($sales_enq as $ptype) { ?>
                                                            <option value="<?php echo $ptype['sa_id']?>"<?php if($this->input->get('conper') && ($this->input->get('conper') == $ptype['sa_id'])){ ?> selected="selected" <?php } ?>><?php echo $ptype['sa_con_person']?></option>  
                                                            <?php } ?> 
                                                            </select>
                                                        </div>
                                                    </div>
                                            </div>  
                                            <div class="col-md-4 col-sm-12" style="display: none;">
                                                <div class="form-group" id="master_party_taxgr">
                                                    <label class="control-label col-md-5">Source Category :</label>
                                                    <div class="col-md-7">
                                                        <select name="sq_source_cat" id="sq_source_cat" class="bs-select form-control" data-live-search="true"  onchange="sub_cat(this)">
                                                            <option value="0">Select Source category</option>
                                                            <?php foreach($sources as $source)
                                                            { ?>
                                                                    <option value="<?php echo $source['source_cat_id']; ?>" <?php if($this->input->get('sq_source_cat') && ($this->input->get('sq_source_cat') == $source['source_cat_id'])){ ?> selected="selected" <?php } ?>> <?php echo $source['source_cat_name']; ?>
                                                                    </option>                                                    
                                                            <?php }?>
                                                                
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4 col-sm-12" style="display: none;">
                                                <div class="form-group" id="mcna_namegr">
                                                    <label class="control-label col-md-5">Sub Source Category :</label>
                                                    <div class="col-md-7">
                                                    <select name="sq_subsource_cat" id="sq_subsource_cat" class="bs-select form-control" data-live-search="true">
                                                        <option value="0">Select Sub Category</option>
                                                          <?php  foreach($subsources as $subsource) {?>  
                                                          <option value="<?php echo $subsource['source_cat_id'];?>" <?php if($this->input->get('sq_subsource_cat') && ($this->input->get('sq_subsource_cat') == $subsource['source_cat_id'])){ ?> selected="selected" <?php } ?>><?php echo $subsource['source_cat_name']; ?></option>
                                                          <?php } ?> 
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>                                        
                                            <div class="col-md-4 col-sm-12" style="display: none;">
                                                <div class="form-group" id="mcna_namegr">
                                                    <label class="control-label col-md-5">Brand :</label>
                                                    <div class="col-md-7">
                                                        <select  class="bs-select form-control itmchange" data-live-search="true" id="my_multi_select1" name="sq_brand" tabindex="9">
                                                            <option value="0">Select Brand</option>
                                                          <?php foreach ($brands as $brand) { 
                                                        ?>

                                                    <option value="<?php echo $brand['brand_id'];?>" <?php if($this->input->get('sq_brand') && ($this->input->get('sq_brand') == $brand['brand_id'])){ ?> selected="selected" <?php } ?>><?php echo $brand['brand_name']; ?></option>
                                                    <?php } ?>
                                                        </select>
                                                    
                                                    </div>
                                                </div>
                                            </div> 
                                        </div>
                                        <div class="row"> 
                                            <div class="col-md-4 col-sm-12" style="display: none;">
                                                <div class="form-group" id="master_party_local_tingr">
                                                    <label class="control-label col-md-5">State :</label>
                                                    <div class="col-md-7">
                                                       <select  name="state" id="state" class="bs-select form-control inq_type" data-live-search="true" data-placeholder="Choose Source">
                                                        <option value="">Select State</option> 
                                                        <?php foreach($states as $ptype) { ?>
                                                                <option value="<?php echo $ptype['state_id']?>"<?php if($this->input->get('state') && ($this->input->get('state') == $ptype['state_id'])){ ?> selected="selected" <?php } ?>><?php echo $ptype['state_name']?></option> 
                                                                <?php } ?> 
                                                        </select>
                                                    </div>
                                                </div> 
                                            </div>
                                            <div class="col-md-4 col-sm-12" style="display: none;">
                                                <div class="form-group" id="mcna_namegr">
                                                    <label class="control-label col-md-5">City :</label>
                                                    <div class="col-md-7">
                                                        <select  name="city" id="city" class="bs-select form-control" data-live-search="true" data-placeholder="Choose Source">
                                                            <option value="">Select City</option> 
                                                        <?php foreach($cities as $ptype) { ?>
                                                            <option value="<?php echo $ptype['city_id']?>"<?php if($this->input->get('city') && ($this->input->get('city') == $ptype['city_id'])){ ?> selected="selected" <?php } ?>><?php echo $ptype['city_name']?></option> 
                                                            <?php } ?>   
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4 col-sm-12" style="display: none;">
                                                <div class="form-group" id="mcna_namegr">
                                                    <label class="control-label col-md-5">Country :</label>
                                                    <div class="col-md-7">
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
                                        <div class="col-md-4 col-sm-12" style="display: none;">
                                                <div class="form-group" id="master_party_local_tingr">
                                                <label class="control-label col-md-5">Mobile :</label>
                                                    <div class="col-md-7">
                                                       <select name="mobile" id="mobile" class="bs-select form-control" data-live-search="true" data-placeholder="Choose Source">
                                                        <option value="">Select Mobile</option>
                                                        <?php foreach($sales_enq as $ptype) { ?>
                                                            <option value="<?php echo $ptype['sa_id']?>"<?php if($this->input->get('mobile') && ($this->input->get('mobile') == $ptype['sa_id'])){ ?> selected="selected" <?php } ?>><?php echo $ptype['sa_mobile']?></option> 
                                                            <?php } ?>  
                                                        </select>
                                                    </div>
                                                </div> 
                                            </div>                                                 
                                            <div class="col-md-4 col-sm-12" style="display: none;">
                                                <div class="form-group" id="master_party_local_tingr">
                                                <label class="control-label col-md-5">Status :</label>
                                                    <div class="col-md-7">
                                                       <select name="status" id="status" class="bs-select form-control" data-live-search="true" data-placeholder="Choose Source">
                                                        <option value="">Select Status</option>
                                                        
                                                            <option value="Active"<?php if($this->input->get('status') && ($this->input->get('status') == 'Active')){ ?> selected="selected" <?php } ?>>Active</option> 
                                                             <option value="Pending"<?php if($this->input->get('status') && ($this->input->get('status') == 'Pending')){ ?> selected="selected" <?php } ?>>Pending</option>
                                                              <option value="Completed"<?php if($this->input->get('status') && ($this->input->get('status') == 'Completed')){ ?> selected="selected" <?php } ?>>Completed</option>                                                            
                                                        </select>
                                                    </div>
                                                </div> 
                                            </div>
                                        </div>   <?php */ ?>                                  
                                        <div class="form-actions">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="row">
                                                        <div class="col-md-offset-3 col-md-9">
                                                            <button type="submit" class="btn green" ><?php echo $this->input->get('id')?'Submit':'SUBMIT'; ?></button>
                                                            <a class="btn red" href="<?php echo base_url(); ?>Sale_quotation/sales_qoute_report">RESET</a>
                                                            <a class="btn blue" href="<?php echo base_url(); ?>Sale_quotation/add">Quotation Add</a>
                                                            <a class="btn btn-default blue" href="<?php echo base_url().'Sale_quotation/store_excel?'; ?>inq_start_date=<?php echo $this->input->get('inq_start_date'); ?>&inq_end_date=<?php echo $this->input->get('inq_end_date'); ?>&vendor=<?php echo $this->input->get('vendor'); ?>&conper=<?php echo $this->input->get('conper'); ?>&sq_source_cat=<?php echo $this->input->get('sq_source_cat'); ?>&sq_subsource_cat=<?php echo $this->input->get('sq_subsource_cat'); ?>&sq_end_st=<?php echo $this->input->get('sq_end_st'); ?>&country=<?php echo $this->input->get('country'); ?>&state=<?php echo $this->input->get('state'); ?>&city=<?php echo $this->input->get('city'); ?>&mobile=<?php echo $this->input->get('mobile'); ?>&status=<?php echo $this->input->get('status'); ?>">Download Report</a>
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
             <?php /* <!--  <div class="row">
                <div class="col-md-12 col-sm-12 text-right">
                <h3><a class="btn btn-default blue" href="<?php echo base_url().'Sale_quotation/store_excel?'; ?>inq_start_date=<?php echo $this->input->get('inq_start_date'); ?>&inq_end_date=<?php echo $this->input->get('inq_end_date'); ?>&vendor=<?php echo $this->input->get('vendor'); ?>&conper=<?php echo $this->input->get('conper'); ?>&sq_source_cat=<?php echo $this->input->get('sq_source_cat'); ?>&sq_subsource_cat=<?php echo $this->input->get('sq_subsource_cat'); ?>&sq_end_st=<?php echo $this->input->get('sq_end_st'); ?>&country=<?php echo $this->input->get('country'); ?>&state=<?php echo $this->input->get('state'); ?>&city=<?php echo $this->input->get('city'); ?>&mobile=<?php echo $this->input->get('mobile'); ?>&status=<?php echo $this->input->get('status'); ?>">Download Report</a>
                </h3>
                    </div>
                </div> --> */ ?>
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
                                     echo form_open(base_url()."Sale_quotation/create_oa",$atr);?>
                                <!-- <form method="get" accept-charset="utf-8" action=""> -->
                                    <div class="table-container">
                                        <!-- <div class="table-actions-wrapper">
                                            <span> </span>
                                              <select class="form-control" name="supplier">
                                                <option value="">Select Customer...</option>
                                                <?php /* foreach($vendors as $vendor) { ?>
                                                <option value="<?php echo $vendor['master_party_id'];?>"><?php echo $vendor['master_party_name'];?></option>
                                                <?php }  */ ?>
                                            </select>
                                            <span> </span>
                                              <select class="form-control" name="action">
                                                <option value="">Action...</option>
                                                <option value="oa">OA</option>
                                            </select>
                                            <button class="btn btn-sm" name="submit" type="submit">
                                                <i class="fa fa-check"></i> Submit</button>
                                          
                                        </div> -->
                                 
                                        <table class="table table-striped table-bordered table-hover table-checkable" id="datatable_ajax">                                      
                                            <thead>
                                                <tr role="row" class="heading">
                                                    <!-- th width="2%">
                                                        <input type="checkbox" class="group-checkable"> </th>
                                                    <th width="2%"> Record&nbsp;# </th> -->
                                                    <!-- <th width="2%"> <input type="checkbox" class="group-checkable"></th> -->
                                                    <th width="5%"> No.</th>
                                                    <th width="2%"> Quotation Date</th>
                                                    <th width="2%"> Customer Name </th>
                                                    <th width="2%"> Person Name </th>
                                                    <th width="2%"> Mobile No</th>
                                                    <th width="2%"> Location</th>
                                                    <th width="2%"> Product </th>
                                                    <th width="2%"> Grand Total </th>
                                                    <!-- <th width="2%"> Qty </th>
                                                    <th width="2%"> Price </th> -->
                                                   <!--  <th width="2%"> Inquiry By </th>
                                                    <th width="2%"> Mode Of Inquiry  </th> -->
                                                    <th width="2%"> Executive By </th>
                                                    <th width="2%"> Status </th>
                                                    <!-- <th width="2%"> Priority </th> -->
                                                    <th width="2%"> Remark </th>
                                                    <th width="2%"></th>
                                                </tr>
                                                <tr role="row" class="filter">
                                                    <!-- <td> </td> -->
                                                    <!-- <td> </td>
                                                    <td>
                                                        <input type="text" class="form-control form-filter input-sm" name="order_id"> </td> -->
                                                    <td>
                                                        <input type="text" class="form-control form-filter input-sm" name="inquiry_number"> </td>
                                                    <td>
                                                        <!-- <input type="text" class="form-control form-filter input-sm" name="inquiry_date"> --> </td>
                                                    <td>
                                                        <input type="text" class="form-control form-filter input-sm" name="order_customer_name"> </td>
                                                    <td></td>
                                                    <td>
                                                        <input type="text" class="form-control form-filter input-sm" name="mobile_no"> </td>
                                                    <td>
                                                        <input type="text" class="form-control form-filter input-sm" name="address"> </td>
                                                    <td>
                                                        <input type="text" class="form-control form-filter input-sm" name="product"> </td>
                                                    <td>
                                                        <input type="text" class="form-control form-filter input-sm" name="total"> </td>
                                                    <!-- <td>
                                                        <input type="text" class="form-control form-filter input-sm" name="detailofitm"> </td>
                                                    <td>
                                                        <input type="text" class="form-control form-filter input-sm" name="qty"> </td>
                                                    <td>
                                                        <input type="text" class="form-control form-filter input-sm" name="price"> </td> -->
                                                    <!-- <td>
                                                        <input type="text" class="form-control form-filter input-sm" name="inquiry_by"> </td>
                                                    <td>
                                                        <input type="text" class="form-control form-filter input-sm" name="mode_of_inq"> </td> -->
                                                    <td>
                                                        <input type="text" class="form-control form-filter input-sm" name="sa_inq_by"> </td>
                                                    <td>
                                                        <select class="form-control form-filter input-sm" name="status">
                                                           <option value="">Select Status</option>
                                                              <?php  foreach($status as $sts) {?>  
                                                              <option value="<?php echo $sts['qs_id'];?>"><?php echo $sts['qs_name']; ?></option>
                                                              <?php } ?> 
                                                        </select> 

                                                    </td>
                                                    <!-- <td>
                                                        <select class="form-control form-filter input-sm" name="priority">
                                                            <option value="">Select Status</option>
                                                            <option value="1">High</option>
                                                            <option value="2">Low</option>
                                                            <option value="3">Medium</option>
                                                        </select> </td> -->
                                                     
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
    var sq_brand = "<?php echo $this->input->get('sq_brand') ? $this->input->get('sq_brand') : '';?>";
    var conper = "<?php echo $this->input->get('conper') ? $this->input->get('conper') : '';?>";
    var sq_source_cat = "<?php echo $this->input->get('sq_source_cat') ? $this->input->get('sq_source_cat') : '';?>";
    var sq_subsource_cat = "<?php echo $this->input->get('sq_subsource_cat') ? $this->input->get('sq_subsource_cat') : '';?>";
    var sq_end_st = "<?php echo $this->input->get('sq_end_st') ? $this->input->get('sq_end_st') : '';?>";
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
<script src="<?php echo base_url(); ?>assets/global/plugins/counterup/jquery.waypoints.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/global/plugins/counterup/jquery.counterup.min.js" type="text/javascript"></script>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN THEME GLOBAL SCRIPTS -->
<script src="<?php echo base_url(); ?>assets/global/scripts/app.min.js" type="text/javascript"></script>
<!-- END THEME GLOBAL SCRIPTS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script type="text/javascript">
    $('.date-picker').datepicker({
        format: 'dd-mm-yyyy',
    });
</script>
<script src="<?php echo base_url(); ?>assets/custom/js/sales_qoute_report.js" type="text/javascript"></script>

<?php //theme layout scripts ?>