<div class="container-fluid">
                <div class="page-content">
<!-- BEGIN BREADCRUMBS -->
                    <div class="breadcrumbs">
                        <h1>Attendance Report</h1>
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
                    </div>

                    <div class="page-content-container">
    <!-- BEGIN CONTENT -->
        <?php echo form_open(base_url().'Attendance_cal/Attendance_report', array('method'=>'get', 'class' => 'form-horizontal','autocomplete' => 'off')); ?>            
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
                                            <div class="col-md-4 col-sm-12">
                                                <div class="form-group" id="mcna_namegr">                                                   
                                                    <label class="control-label col-md-5">Start Date</label>
                                                    <div class="col-md-7">
                                                        <input type="text" tabindex="1" class="form-control form-control-inline date-picker" placeholder="Start Date" name="inq_start_date" maxlength="200" id="inq_start_date" value="<?php echo ($this->input->get('inq_start_date')) ? $this->input->get('inq_start_date') : "";?>" autofocus>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4 col-sm-12 text-right">
                                                <div class="form-group" id="mcna_namegr">
                                                    <label class="control-label col-md-5">End Date</label>
                                                    <div class="col-md-7">
                                                        <input type="text" tabindex="2" class="form-control form-control-inline date-picker" placeholder="End Date" name="inq_end_date" maxlength="200" id="inq_end_date" value="<?php echo $this->input->get('inq_end_date') ? $this->input->get('inq_end_date') :""; ?>">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4 col-sm-12">
                                                <div class="form-group" id="mcna_namegr">
                                                    <label class="control-label col-md-5">Executive By</label>
                                                    <div class="col-md-7">
                                                        <select name="exe" id="exe" tabindex="3" class="bs-select form-control itmchange" data-live-search="true" data-size="8">
                                                            <option value="0">Select Executive By</option>
                                                            <?php  foreach($admins as $vendor) {?>  <option value="<?php echo $vendor['au_id'];?>" <?php if($this->input->get('exe') && ($this->input->get('exe') == $vendor['au_id'])){ ?> selected="selected" <?php } ?>><?php echo $vendor['au_fname']; ?></option><?php } ?> 
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        
                                    <div class="form-actions">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="row">
                                                    <div class="col-md-offset-3 col-md-9">
                                                        <button type="submit" tabindex="10" class="btn green" ><?php echo $this->input->get('id')?'Submit':'SUBMIT'; ?></button>
                                                         <a class="btn red" tabindex="11" href="<?php echo base_url(); ?>Attendance_cal/Attendance_report">RESET</a>
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








                    <div class="row">
                        <div class="col-md-6">
                                <!-- BEGIN PORTLET-->
                         <div class="portlet light bordered">
                                <div class="portlet-title tabbable-line">
                                    <div class="caption">
                                        <i class="icon-globe font-green-sharp"></i>
                                        <span class="caption-subject font-green-sharp bold uppercase">This Month</span>
                                    </div>
                                </div>
                                <div class="portlet-body">
                                    <!--BEGIN TABS-->
                                    <div class="tab-content">
                                        <div class="tab-pane active" id="tab_1_1">
                                            <div class="scroller" style="height: 339px;" data-always-visible="1" data-rail-visible="0">
                                                <ul class="feeds">
                                                    <div class="portlet-body">
                                                                <table class="table table-striped table-bordered table-hover dt-responsive" width="100%">
                                                                            <thead>
                                                                                <tr role="row" class="heading">
                                                                                    <th width="1%"> No.</th>
                                                                                    <th width="2%"> Admin User</th>
                                                                                    <th width="2%"> T </th>
                                                                                    <th width="2%"> A</th>
                                                                                    <th width="2%"> P </th>
                                                                                </tr>
                                                                            </thead>
                                                                                <tbody>
                                                                                <?php  $srno = 0;
                                                                                 foreach($statics['this_month_data'] as $row){ $srno++;
                                                                                    ?>
                                                                        <tr>
                                                                            <td><?php echo $srno; ?></td>
                                                                            <td><?php echo $row['first_name'];?></td>
                                                                            <td><?php echo $row['total_count'];?></td>
                                                                            <td><?php echo $row['absent_count'];?></td>
                                                                            <td><?php echo $row['present_count'];?></td>
                                                                        </tr>
                                                                               <?php } ?>
                                                                            </tbody>
                                                                        </table>
                                                     </div>   
                                                
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <!--END TABS-->
                                </div>
                            </div>
                            <!-- END PORTLET-->
                        </div>
                        <div class="col-md-6">
                                <!-- BEGIN PORTLET-->
                         <div class="portlet light bordered">
                                <div class="portlet-title tabbable-line">
                                    <div class="caption">
                                        <i class="icon-globe font-green-sharp"></i>
                                        <span class="caption-subject font-green-sharp bold uppercase">Last Month</span>
                                    </div>
                                </div>
                                <div class="portlet-body">
                                    <!--BEGIN TABS-->
                                    <div class="tab-content">
                                        <div class="tab-pane active" id="tab_1_1">
                                            <div class="scroller" style="height: 339px;" data-always-visible="1" data-rail-visible="0">
                                                <ul class="feeds">
                                                    <div class="portlet-body">
                                                                <table class="table table-striped table-bordered table-hover dt-responsive" width="100%">
                                                                            <thead>
                                                                                <tr role="row" class="heading">
                                                                                    <th width="1%"> No.</th>
                                                                                    <th width="2%"> Admin User</th>
                                                                                    <th width="2%"> T </th>
                                                                                    <th width="2%"> A</th>
                                                                                    <th width="2%"> P </th>
                                                                                </tr>
                                                                            </thead>
                                                                                <tbody>
                                                                                <?php  $srno = 0;
                                                                                 foreach($statics['last_month_data'] as $row){ $srno++;
                                                                                    ?>
                                                                        <tr>
                                                                            <td><?php echo $srno; ?></td>
                                                                            <td><?php echo $row['first_name'];?></td>
                                                                            <td><?php echo $row['total_count'];?></td>
                                                                            <td><?php echo $row['absent_count'];?></td>
                                                                            <td><?php echo $row['present_count'];?></td>
                                                                        </tr>
                                                                               <?php } ?>
                                                                            </tbody>
                                                                        </table>
                                                     </div>   
                                                
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <!--END TABS-->
                                </div>
                            </div>
                            <!-- END PORTLET-->
                        </div>
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
                        </div>
                        <div class="col-md-12">
                            <!-- Begin: life time stats -->
                            <div class="portlet light portlet-fit portlet-datatable bordered">
                                <div class="portlet-title">
                                    <div class="actions">
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
                                <form method="get" accept-charset="utf-8" action="<?php echo base_url(); ?>Attendance_cal/delete_all">
                                    <div class="table-container">
                                        <table class="table table-striped table-bordered table-hover table-checkable" id="datatable_ajax">
                                            <thead>
                                                <tr role="row" class="heading">
                                                    <th width="2%"> Date </th>
                                                    <th width="2%"> Executive Name </th>
                                                    <th width="2%"> Attendance </th>
                                                    <th width="2%"> Intime </th>
                                                    <th width="2%"> Outtime </th>
                                                    

                                                </tr>
                                                <tr role="row" class="filter">
                                                    <td></td>
                                                    <td> </td>
                                                    <td> </td>
                                                    <td> </td>
                                                    <td> </td>
                                                   
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
        <script type="text/javascript">
    var inq_start_date = "<?php echo $this->input->get('inq_start_date') ? $this->input->get('inq_start_date') : '';?>";
    var inq_end_date = "<?php echo $this->input->get('inq_end_date') ? $this->input->get('inq_end_date') : '';?>";
    var exe = "<?php echo  $this->input->get('exe') ? $this->input->get('exe') : '';?>";
   
    </script>
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
        <script type="text/javascript">
    $('.date-picker').datepicker({
        format: 'dd-mm-yyyy',
    });
</script>
        <!-- BEGIN PAGE LEVEL SCRIPTS -->
        <script src="<?php echo base_url(); ?>assets/custom/js/attendance_cal.js" type="text/javascript"></script>
        <!-- END PAGE LEVEL SCRIPTS -->
        <?php //theme layout scripts ?>