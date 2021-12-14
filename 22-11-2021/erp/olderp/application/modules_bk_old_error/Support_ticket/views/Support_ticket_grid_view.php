<div class="container-fluid">
                <div class="page-content">
<!-- BEGIN BREADCRUMBS -->
                    <div class="breadcrumbs">
                        <h1>Support Tickets</h1>
                        <ol class="breadcrumb">
                            <li>
                                <a href="<?php echo base_url(); ?>dashboard">Dashboard</a>
                            </li>
                            <li class="active">
                                <a href="<?php echo base_url(); ?>Support_ticket">Support Tickets</a>
                            </li>
                            <li>
                                <a href="<?php echo base_url(); ?>Support_ticket/add">Support Ticket Add</a>
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
<!-- END BREADCRUMBS -->
            <!-- BEGIN CONTENT -->
            <div class="page-content-container">
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
                                        <?php /* $crud->display_as('master_party_code','Party Code')->display_as('master_party_name','Party Name')->display_as('master_party_state','State')->display_as('master_party_Support_ticket','Support_ticket')->display_as('master_party_area','Area')->display_as('master_party_pincode','Pincode')->display_as('master_party_category','Category')->display_as('master_party_contact_person','Contact Person')->display_as('master_party_contact_no','Contact No')->display_as('master_party_created_date','Created Date')->display_as('master_party_updated_date','Updated Date')->display_as('master_party_email_address','Email Address')->display_as('master_party_fax','Fax')->display_as('master_party_phone','Office Number')->display_as('master_party_webpage','Website'); */ ?>
                                            <thead>
                                                <tr role="row" class="heading">
                                                    <th width="7%"> Company Name </th>
                                                    <th width="3%"> Email </th>
                                                    <th width="2%"> Location </th>
                                                    <th width="2%"> Ticket No </th>
                                                    <th width="2%"> Support.Eng. </th>
                                                    <th width="5%"> Details </th>
                                                    <th width="5%"> Pro. Details </th>
                                                    <th width="2%"> Attended By </th>
                                                    <th width="1%"> Status </th>
                                                    <th width="2%"> Created </th>
                                                    <th width="1%">Date</th>
                                                    <th width="2%"></th>
                                                </tr>
                                                <tr role="row" class="filter">
                                                    <td>
                                                        <input type="text" class="form-control form-filter input-sm" name="st_coname"> </td>
                                                    <td>
                                                        <input type="text" class="form-control form-filter input-sm" name="st_email"> </td>
                                                    <td>
                                                        <input type="text" class="form-control form-filter input-sm" name="st_location"> </td>
                                                    <td>
                                                        <input type="text" class="form-control form-filter input-sm" name="st_ticketno"> </td>
                                                    <td>
                                                        <input type="text" class="form-control form-filter input-sm" name="st_tackenby"> </td>
                                                    <td>
                                                        <input type="text" class="form-control form-filter input-sm" name="st_details"> </td>
                                                     <td>
                                                        <input type="text" class="form-control form-filter input-sm" name="st_prodetails"> </td>
                                                     <td>
                                                        <input type="text" class="form-control form-filter input-sm" name="st_attendedby"> </td>
                                                    <td>
                                                        <!-- <input type="text" class="form-control form-filter input-sm" name="st_status"> -->
                                                        <select name="st_status" class="form-control form-filter input-sm">
                                                            <option value="">Select Status</option>
                                                            <option value="1">Active</option>
                                                            <option value="2">Close</option>
                                                        </select> </td>
                                                    <td>
                                                        <input type="text" class="form-control form-filter input-sm" name="st_createdby"> </td>
                                                    <td>
                                                        <input type="date" class="form-control form-filter input-sm" name="st_startudate" placeholder="Start Date"> 
                                                        <input type="date" class="form-control form-filter input-sm" name="st_endudate" placeholder="End Date"> </td>
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
        <!-- BEGIN PAGE LEVEL PLUGINS -->
        <script src="<?php echo base_url(); ?>assets/global/scripts/datatable.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>assets/global/plugins/datatables/datatables.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js" type="text/javascript"></script>
        <!-- END PAGE LEVEL PLUGINS -->
        <!-- BEGIN THEME GLOBAL SCRIPTS -->
        <script src="<?php echo base_url(); ?>assets/global/scripts/app.min.js" type="text/javascript"></script>
        <!-- END THEME GLOBAL SCRIPTS -->
        <!-- BEGIN PAGE LEVEL SCRIPTS -->
        <script src="<?php echo base_url(); ?>assets/custom/js/support_ticket.js" type="text/javascript"></script>
        <!-- END PAGE LEVEL SCRIPTS -->
        <?php //theme layout scripts ?>