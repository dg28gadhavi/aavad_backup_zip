<div class="container-fluid">
    <div class="page-content">
<!-- BEGIN BREADCRUMBS -->
        <div class="breadcrumbs">
            <h1>Payment Customer Wise Overall Report</h1>
            <ol class="breadcrumb">
                
                <li class="active"><a href="<?php echo base_url(); ?>Payment_report">Payment Customer Wise Report</a></li>
                <li class="active"><a href="<?php echo base_url(); ?>Payment_report/inv_wise">Payment Invoice Wise Report</a></li>
                <li><a href="<?php echo base_url(); ?>Payment_report/add">Payment Add</a></li>
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


            <div class="page-content-container">
    <!-- BEGIN CONTENT -->
        <?php echo form_open(base_url().'Payment_report/overall_report', array('method'=>'get', 'class' => 'form-horizontal','autocomplete' => 'off')); ?>            
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
                                            <div class="col-md-1 col-sm-12">
                                                <div class="form-group" id="mcna_namegr">
                                                    <div class="col-md-12">
                                                        <input type="text" tabindex="1" class="form-control form-control-inline date-picker" placeholder="Start Date" name="inq_start_date" maxlength="200" id="inq_start_date" value="<?php echo ($this->input->get('inq_start_date')) ? $this->input->get('inq_start_date') : "";?>" autofocus>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-1 col-sm-12 text-right">
                                                <div class="form-group" id="mcna_namegr">
                                                    <div class="col-md-12">
                                                        <input type="text" tabindex="2" class="form-control form-control-inline date-picker" placeholder="End Date" name="inq_end_date" maxlength="200" id="inq_end_date" value="<?php echo $this->input->get('inq_end_date') ? $this->input->get('inq_end_date') : ''; ?>">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-2 col-sm-12">
                                                    <div class="form-group" id="mcna_namegr">
                                                        <div class="col-md-12">
                                                            <!--  <select name="vendor" id="vendor" class="bs-select form-control" data-live-search="true" data-placeholder="Choose Source" tabindex="5">
                                                                <option value="0">Select Customer</option>
                                                               <?php /* foreach($sales_enq as $ptype) { ?>
                                                            <option value="<?php echo $ptype['sq_id']?>"<?php if($this->input->get('vendor') && ($this->input->get('vendor') == $ptype['sq_id'])){ ?> selected="selected" <?php } ?>><?php echo $ptype['vendor']?></option> </select> 
                                                            <?php } */ ?> -->
                                                            <input type="text" tabindex="4" class="form-control" placeholder="Customer" name="vendor" maxlength="100" id="vendor" value="<?php echo $this->input->get('vendor') ? $this->input->get('vendor') : ''; ?>">
                                                        </div>
                                                    </div>
                                            </div>
                                            
                                            
                                        </div>
                                        
                                    <div class="form-actions">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="row">
                                                    <div class="col-md-offset-3 col-md-9">
                                                        <button type="submit" tabindex="10" class="btn green" ><?php echo $this->input->get('id')?'Submit':'SUBMIT'; ?></button>
                                                         <a class="btn red" tabindex="11" href="<?php echo base_url(); ?>Payment_report/overall_report">RESET</a>
                                                         
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
            <!-- Sidebar Toggle Button -->
        </div>
<!-- END BREADCRUMBS -->
            <!-- BEGIN CONTENT -->
            <div class="page-content-container">               
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
                                    <div class="table-container">
                                        <!-- <div class="table-actions-wrapper">
                                            <span> </span>
                                            <select class="table-group-action-input form-control input-inline input-small input-sm">
                                                <option value="">Select...</option>
                                                <option value="delete">Delete</option>
                                            </select>
                                            <button class="btn btn-sm green table-group-action-submit">
                                                <i class="fa fa-check"></i> Submit</button>
                                        </div> -->
                                        <table class="table table-striped table-bordered table-hover table-checkable" id="datatable_ajax">
                                        <?php /* $crud->display_as('master_party_code','Party Code')->display_as('master_party_name','Party Name')->display_as('master_party_state','State')->display_as('master_party_Payment_report','Payment_report')->display_as('master_party_area','Area')->display_as('master_party_pincode','Pincode')->display_as('master_party_category','Category')->display_as('master_party_contact_person','Contact Person')->display_as('master_party_contact_no','Contact No')->display_as('master_party_created_date','Created Date')->display_as('master_party_updated_date','Updated Date')->display_as('master_party_email_address','Email Address')->display_as('master_party_fax','Fax')->display_as('master_party_phone','Office Number')->display_as('master_party_webpage','Website'); */ ?>
                                            <thead>
                                                <tr role="row" class="heading">
                                                    <th width="1%"> Sr No </th>
                                                    <th width="5%"> Customer Name </th>
                                                    <th width="2%"> Cr/Dr </th>
                                                    <th width="2%"> Amount </th>
                                                    <th width="2%"> Payment Type </th>
                                                    <th width="2%"> Bank Name </th>
                                                    <th width="2%"> Invoice No </th>
                                                    <th width="2%"> Reference No </th>
                                                    <th width="2%"> Payment Date </th>
                                                    <th width="2%"> Remark </th>
                                                    <th width="2%"> Date </th>
                                                    <th width="5%"></th>
                                                </tr>
                                                <tr role="row" class="filter">
                                                    <td></td>
                                                   <td>
                                                    <input type="text" class="form-control form-filter input-sm" name="master_party_com_name"> </td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td>
                                                     <input type="text" class="form-control form-filter input-sm" name="tran_paymentudate"></td>
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
    var sq_attendto = "<?php echo  $this->input->get('sq_attendto') ? $this->input->get('sq_attendto') : '';?>";
    var sq_emailcc = "<?php echo  $this->input->get('sq_emailcc') ? $this->input->get('sq_emailcc') : '';?>";
    var vendor = "<?php echo  $this->input->get('vendor') ? $this->input->get('vendor') : '';?>";
    var country = "<?php echo $this->input->get('country') ? $this->input->get('country') : '';?>";
    var state = "<?php echo $this->input->get('state') ? $this->input->get('state') : '';?>";
    var sq_state = "<?php echo $this->input->get('sq_state') ? $this->input->get('sq_state') : '';?>";
    var sq_city = "<?php echo $this->input->get('sq_city') ? $this->input->get('sq_city') : '';?>";
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
<script src="<?php echo base_url(); ?>assets/global/plugins/counterup/jquery.waypoints.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/global/plugins/counterup/jquery.counterup.min.js" type="text/javascript"></script>
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
        <script src="<?php echo base_url(); ?>assets/custom/js/Payment_overall.js" type="text/javascript"></script>
        <!-- END PAGE LEVEL SCRIPTS -->
        <?php //theme layout scripts ?>