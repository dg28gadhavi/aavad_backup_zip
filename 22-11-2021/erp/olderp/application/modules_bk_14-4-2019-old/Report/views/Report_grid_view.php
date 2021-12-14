<link href="<?php echo base_url(); ?>assets/global/plugins/bootstrap-select/css/bootstrap-select.min.css" rel="stylesheet" type="text/css" />

<div class="container-fluid">
                <div class="page-content">
<!-- BEGIN BREADCRUMBS -->
                    
                    <div class="row">
                <?php /*?><div class="col-md-12 col-sm-12 text-right">
                <h3><a class="btn btn-default blue" href="<?php echo base_url().'country/csvimport'; ?>">Import CSV</a></h3>
            </div><?php */?>
        </div>
<!-- END BREADCRUMBS -->
            <!-- BEGIN CONTENT -->
            <div class="page-content-container">
                <!-- BEGIN CONTENT BODY -->
                <div class="page-content-row">
                    <!-- BEGIN PAGE HEADER-->
                    <div class="page-content-col">
  <?php echo form_open(base_url().'Report', array('method'=>'get','class' => 'form-horizontal')); ?>                   
   <div class="row">
                    	<div class="col-md-12">
                            <?php echo validation_errors(); ?>
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
                            <div class="row">
                        <div class="col-md-6 col-sm-12 text-right">
                            <div class="form-group" id="mcna_namegr">
                                <h4 class="col-md-3 text-right">Item Wise</h4>
                                <div class="col-md-9">
                                    <select name="itemname" id="itemname" class="bs-select form-control" data-live-search="true">
                                        <option value="">Select Item</option>
                                       <?php  foreach($items as $item) {?>  <option value="<?php echo $item['master_item_id'];?>" <?php if($this->input->get('itemname') == $item['master_item_id']){ echo "selected";}?>><?php echo $item['master_item_name']; ?></option><?php } ?> 
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12 text-right">
                            <div class="form-group" id="mcna_namegr">
                                <h4 class="col-md-3 text-right">Admin</h4>
                                <div class="col-md-9">
                                    <select name="admin" id="admin" class="bs-select form-control" data-live-search="true">
                                        <option value="">Select Admin</option>
                                       <?php  foreach($admins as $admin) {?>  <option value="<?php echo $admin['au_id'];?>" <?php if($this->input->get('admin') == $admin['au_id']){ echo "selected";}?>><?php echo $admin['au_fname']; ?></option><?php } ?> 
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                    	<div class="col-md-6 col-sm-12 text-right">
                            <div class="form-group" id="mcna_namegr">
                                <h4 class="col-md-3 text-right">Method</h4>
                                <div class="col-md-9">
                                    <select name="credit" id="credit" class="bs-select form-control" data-live-search="true">
                                       <option value="">Select Method</option>
                                      <option value="1" <?php if($this->input->get('credit') == 1){ echo "selected";}?>>Credit</option>
                                      <option value="2" <?php if($this->input->get('credit') == 2){ echo "selected";}?>>Debit</option>
                                    </select>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr />
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
                     <!-- form end-->
                        </div>
                        <div class="col-md-12">
                            <!-- Begin: life time stats -->
                            <div class="portlet light portlet-fit portlet-datatable bordered">
                                <div class="portlet-title">
                                    
                                </div>
                                <div class="portlet-body">
                                <form method="get" accept-charset="utf-8" action="<?php echo base_url(); ?>Report/delete_all">
                                    <div class="table-container">
                                        <div class="table-actions-wrapper">
                                            <span> </span>
                                            <select class="table-group-action-input form-control input-inline input-small input-sm" id="dropdownHolder"  name="country_isdelete">
                                                <option value="0">Select...</option>
                                                <option value="1">Delete</option>
                                            </select>
                                            <button class="btn btn-sm" name="submit" type="submit">
                                                <i class="fa fa-check"></i> Submit</button>
                                          
                                        </div>
                                 
                                        <table class="table table-striped table-bordered table-hover table-checkable" id="datatable_ajax">
                                        <?php /* $crud->display_as('master_party_code','Party Code')->display_as('master_party_name','Party Name')->display_as('master_party_state','State')->display_as('master_party_city','City')->display_as('master_party_area','Area')->display_as('master_party_pincode','Pincode')->display_as('master_party_category','Category')->display_as('master_party_contact_person','Contact Person')->display_as('master_party_contact_no','Contact No')->display_as('master_party_created_date','Created Date')->display_as('master_party_updated_date','Updated Date')->display_as('master_party_email_address','Email Address')->display_as('master_party_fax','Fax')->display_as('master_party_phone','Office Number')->display_as('master_party_webpage','Website'); */ ?>
                                            <thead>
                                                <tr role="row" class="heading">
                                                    <th width="10%"> Product Name </th>
                                                    <th width="2%"> Qty </th>
                                                     <!-- <th width="1%"> Inw. Link </th>
                                                    <th width="1%"> Out. Link </th> -->
                                                    <th width="1%"> Type </th>
                                                    <th width="1%"> Opration </th>
                                                    <th width="2%"> Admin Name </th>
                                                    <th width="2%"> Date </th>
                                                    <th width="1%"></th>
                                                </tr>
                                                <tr role="row" class="filter">
                                                         <td>
                                                    <input type="text" class="form-control form-filter input-sm" name="itemname"> </td>
                                                         <!-- <td>
                                                        <input type="text" class="form-control form-filter input-sm" name="inward"> </td>
                                                         <td>
                                                        <input type="text" class="form-control form-filter input-sm" name="outwrd"> </td> -->
                                                         <td>
                                                        <input type="text" class="form-control form-filter input-sm" name="credit"> </td>
                                                         <td>
                                                        <input type="text" class="form-control form-filter input-sm" name="addedit"> </td>
                                                         <td>
                                                        <input type="text" class="form-control form-filter input-sm" name="qty"> </td>
                                                        <td>
                                                        <input type="text" class="form-control form-filter input-sm" name="admin"> </td>
                                                    <td>
                                                        <input type="text" class="form-control form-filter input-sm" name="created_date"> </td>
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
         <script type="text/javascript">
        var created_start_date = "<?php echo $this->input->get('created_start_date') ? $this->input->get('created_start_date') : '';?>";
        var created_end_date = "<?php echo $this->input->get('created_end_date') ? $this->input->get('created_end_date') : '';?>";
        
        var itemname = "<?php echo $this->input->get('itemname') ? $this->input->get('itemname'):'';?>";
        var admin = "<?php echo $this->input->get('admin') ? $this->input->get('admin'):'';?>";
		var credit = "<?php echo $this->input->get('credit') ? $this->input->get('credit'):'';?>";

         </script>
        <!-- END CORE PLUGINS -->
        <!-- BEGIN PAGE LEVEL PLUGINS -->
        <script src="<?php echo base_url(); ?>assets/global/scripts/datatable.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>assets/global/plugins/datatables/datatables.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js" type="text/javascript"></script>
           <script src="<?php echo base_url(); ?>assets/global/plugins/bootstrap-select/js/bootstrap-select.min.js" type="text/javascript"></script>
           <script src="<?php echo base_url(); ?>assets/pages/scripts/components-bootstrap-select.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js" type="text/javascript"></script>
        <!-- END PAGE LEVEL PLUGINS -->
        <!-- BEGIN THEME GLOBAL SCRIPTS -->
        <script src="<?php echo base_url(); ?>assets/global/scripts/app.min.js" type="text/javascript"></script>
        <!-- END THEME GLOBAL SCRIPTS -->
        <!-- BEGIN PAGE LEVEL SCRIPTS -->
        <script src="<?php echo base_url(); ?>assets/custom/js/Report.js" type="text/javascript"></script>
        <!-- END PAGE LEVEL SCRIPTS -->
        <?php //theme layout scripts ?>