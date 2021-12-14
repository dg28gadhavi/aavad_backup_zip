<?php //echo "hiiiiiiiii" ; die;?>

<link href="<?php echo base_url(); ?>assets/global/plugins/bootstrap-select/css/bootstrap-select.min.css" rel="stylesheet" type="text/css" />
<!-- BEGIN PAGE LEVEL PLUGINS -->
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/search/css/jquery-ui.css">
<!-- END PAGE LEVEL PLUGINS -->            

<div class="container-fluid">
                <div class="page-content">
<!-- BEGIN BREADCRUMBS -->
                    <div class="breadcrumbs">
                        <h1>Task Report</h1>
                        <ol class="breadcrumb">
                            <li>
                                <a href="<?php echo base_url(); ?>Dashboard">Dashboard</a>
                            </li>
                             <li>
                                <a href="<?php echo base_url(); ?>Task/task_dashboard">Task Dashboard</a>
                            </li>
                            <li class="active">
                                <a href="<?php echo base_url(); ?>Task/Task_report">Task Report</a>
                            </li>
                            <li class="active">
                                <a href="<?php echo base_url(); ?>Task/add">Task Add</a>
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
                <?php echo form_open(base_url().'Task/Task_report', array('method'=>'get', 'class' => 'form-horizontal')); ?>
            
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
                                                    <h4 class="col-md-5 text-right">Reminder Start Date :</h4>
                                                    <div class="col-md-7">
                                                        <input type="text" class="form-control form-control-inline date-picker" placeholder="Start Date" name="inq_start_date" maxlength="200" id="inq_start_date" value="<?php echo ($this->input->get('inq_start_date')) ? $this->input->get('inq_start_date') : "";?>">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4 col-sm-12 text-right">
                                                <div class="form-group" id="mcna_namegr">
                                                    <h4 class="col-md-5 text-right">Reminder End Date :</h4>
                                                    <div class="col-md-7">
                                                        <input type="text" class="form-control form-control-inline date-picker" placeholder="End Date" name="inq_end_date" maxlength="200" id="inq_end_date" value="<?php echo $this->input->get('inq_end_date') ? $this->input->get('inq_end_date') : date('d-m-Y'); ?>">
                                                    </div>
                                                </div>
                                            </div> 

                                             <div class="col-md-4 col-sm-12">
                                                <div class="form-group" id="mcna_namegr">
                                                    <h4 class="col-md-5 text-right">Status :</h4>
                                                    <div class="col-md-7">
                                                        <select name="task_status" id="task_status" class="bs-select form-control Status" data-live-search="true" data-size="8">
                                                            
                                                                <option value="">Select Status</option>
                                                                <option value="1" <?php if($this->input->get('task_status') && ($this->input->get('task_status') == 1)){ echo "selected";} ?>>Active</option>
                                                                <option value="2" <?php if($this->input->get('task_status') && ($this->input->get('task_status') == 2)){ echo "selected";} ?>>Close</option>
                                                            
                                                        </select>
                                                    </div>
                                                </div>

                                            </div>                                         
                                            
                                        </div> 
                                        <div class="row">
                                            <div class="col-md-4 col-sm-12">
                                                <div class="form-group" id="mcna_namegr">
                                                    <h4 class="col-md-5 text-right">Complete Start Date :</h4>
                                                    <div class="col-md-7">
                                                        <input type="text" class="form-control form-control-inline date-picker" placeholder="Start Date" name="complete_start_date" maxlength="200" id="complete_start_date" value="<?php echo ($this->input->get('complete_start_date')) ? $this->input->get('complete_start_date') : "";?>">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4 col-sm-12 text-right">
                                                <div class="form-group" id="mcna_namegr">
                                                    <h4 class="col-md-5 text-right">Complete End Date :</h4>
                                                    <div class="col-md-7">
                                                        <input type="text" class="form-control form-control-inline date-picker" placeholder="End Date" name="complete_end_date" maxlength="200" id="complete_end_date" value="<?php echo $this->input->get('complete_end_date') ? $this->input->get('complete_end_date') : date('d-m-Y'); ?>">
                                                    </div>
                                                </div>
                                            </div> 
                                            <div class="col-md-4 col-sm-12">
                                                <div class="form-group" id="mcna_namegr">
                                                    <h4 class="col-md-5 text-right">Alloted To :</h4>
                                                    <div class="col-md-7">
                                                        <select name="task_attendto" id="task_attendto" tabindex="5" class="bs-select form-control itmchange" data-live-search="true" data-size="8">
                                                            <option value="0">Alloted To</option>
                                                            <?php  foreach($admins as $vendor) {?>  <option value="<?php echo $vendor['au_id'];?>" <?php if($this->input->get('task_attendto') && ($this->input->get('task_attendto') == $vendor['au_id'])){ ?> selected="selected" <?php } ?>><?php echo $vendor['au_fname']; ?></option><?php } ?> 
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                        </div>   
                                        <div class="row">
                                            <div class="col-md-4 col-sm-12">
                                                <div class="form-group" id="mcna_namegr">
                                                    <h4 class="col-md-5 text-right">Given By :</h4>
                                                    <div class="col-md-7">
                                                        <select name="task_givenby" id="task_givenby" tabindex="5" class="bs-select form-control itmchange" data-live-search="true" data-size="8">
                                                            <option value="0">Given By</option>
                                                            <?php  foreach($admins as $vendor) {?>  <option value="<?php echo $vendor['au_id'];?>" <?php if($this->input->get('task_givenby') && ($this->input->get('task_givenby') == $vendor['au_id'])){ ?> selected="selected" <?php } ?>><?php echo $vendor['au_fname']; ?></option><?php } ?> 
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4 col-sm-12">
                                                <div class="form-group" id="mcna_namegr">
                                                    <h4 class="col-md-5 text-right">Task Type :</h4>
                                                    <div class="col-md-7">
                                                        <select name="task_worktype" id="task_worktype" tabindex="5" class="bs-select form-control itmchange" data-live-search="true" data-size="8">
                                                            <option value="0">Select</option>
                                                            <?php  foreach($work_tasts as $work_tast) {?>  <option value="<?php echo $work_tast['type_of_work_id'];?>" <?php if($this->input->get('task_worktype') && ($this->input->get('task_worktype') == $work_tast['type_of_work_id'])){ ?> selected="selected" <?php } ?>><?php echo $work_tast['type_of_work_name']; ?></option><?php } ?> 
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
                                                            <a class="btn red" href="<?php echo base_url(); ?>Task/Task_report">RESET</a>
                                                            
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                             <?php echo form_close(); ?>
                                        </div>
                                            </div>                                                              </div>
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
              <!-- <div class="row">
                <div class="col-md-12 col-sm-12 text-right">
                <h3><a class="btn btn-default blue" href="<?php echo base_url().'Task/store_excel?'; ?>inq_start_date=<?php echo $this->input->get('inq_start_date'); ?>&inq_end_date=<?php echo $this->input->get('inq_end_date'); ?>&vendor=<?php echo $this->input->get('vendor'); ?>&conper=<?php echo $this->input->get('conper'); ?>&sq_source_cat=<?php echo $this->input->get('sq_source_cat'); ?>&sq_subsource_cat=<?php echo $this->input->get('sq_subsource_cat'); ?>&sq_end_st=<?php echo $this->input->get('sq_end_st'); ?>&country=<?php echo $this->input->get('country'); ?>&state=<?php echo $this->input->get('state'); ?>&city=<?php echo $this->input->get('city'); ?>&mobile=<?php echo $this->input->get('mobile'); ?>&status=<?php echo $this->input->get('status'); ?>">Download Report</a>
                </h3>
                    </div>
                </div> -->
            <div class="page-content-container">
                <div class="row" style="display:none">
                        <div class="col-md-6 col-sm-12">
                           <!--  <h3 class="page-title">Country Master </h3> -->
                        </div>
                        <div class="col-md-6 col-sm-12 text-right">
                        <a class="btn btn-default green" id="add_more_brand" data-toggle="modal" href="#inquir yselect"></i>Setting</a>
                           
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
                                 
                                        <table class="table table-striped table-bordered table-hover table-checkable" id="datatable_ajax">
                                       
                                            <thead>
                                                <tr role="row" class="heading">
                                                    <th width="10%"> Task No </th>
                                                    <th width="2%"> Subject </th>
                                                    <th width="2%"> Customer </th>
                                                    <th width="2%"> Contact Person </th>
                                                    <th width="2%"> Mobile </th>
                                                    <th width="2%"> Email </th>
                                                    <th width="2%"> Task Type </th>
                                                    <th width="2%"> Location</th>
                                                    <th width="2%"> Details</th>
                                                    <th width="2%"> Expense</th>
                                                    <th width="5%"> Alloted To</th>
                                                    <th width="5%"> Given By </th>
                                                    <th width="1%">Reminder Date</th>
                                                    <th width="1%">Completed Date</th>
                                                    <th width="2%">Status</th>
                                                    <th width="2%"></th>
                                                </tr>
                                                <tr role="row" class="filter">
                                                    <td>
                                                        <input type="text" class="form-control form-filter input-sm" name="task_ticketno"> </td>
                                                    <td>
                                                        <input type="text" class="form-control form-filter input-sm" name="task_subject"> </td>
                                                    <td>
                                                        <input type="text" class="form-control form-filter input-sm" name="task_worktype"> </td>
                                                    <td>
                                                            <input type="text" class="form-control form-filter input-sm" name="task_vendor">
                                                       </td>
                                                    <td>
                                                        <input type="text" class="form-control form-filter input-sm" name="task_contactperson">
                                                       </td>
                                                    <td>
                                                        <input type="text" class="form-control form-filter input-sm" name="task_location"> </td>
                                                    <td>
                                                       </td>
                                                     <td>
                                                        </td>
                                                    <td>
                                                        </td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
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
                                    <?php //echo $this->load->view(' y_setting_popup'); ?>
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
            var complete_start_date = "<?php echo $this->input->get('complete_start_date') ? $this->input->get('complete_start_date') : '';?>";
            var complete_end_date = "<?php echo $this->input->get('complete_end_date') ? $this->input->get('complete_end_date') : '';?>";
            var task_status = "<?php echo  $this->input->get('task_status') ? $this->input->get('task_status') : '';?>";
            var task_attendto = "<?php echo  $this->input->get('task_attendto') ? $this->input->get('task_attendto') : '';?>";
            var task_givenby = "<?php echo  $this->input->get('task_givenby') ? $this->input->get('task_givenby') : '';?>";
            var task_worktype = "<?php echo  $this->input->get('task_worktype') ? $this->input->get('task_worktype') : '';?>";
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
        <script src="<?php echo base_url(); ?>assets/global/scripts/app.min.js" type="text/javascript"></script>
        <!-- END THEME GLOBAL SCRIPTS -->
        <!-- BEGIN PAGE LEVEL SCRIPTS -->
        <script src="<?php echo base_url(); ?>assets/custom/js/Task.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>assets/custom/js/Inquiry_form.js" type="text/javascript"></script>
        <!-- END PAGE LEVEL SCRIPTS -->
         <!-- BEGIN PAGE LEVEL PLUGINS -->
        <script src="<?php echo base_url(); ?>assets/global/plugins/bootstrap-select/js/bootstrap-select.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>assets/global/scripts/datatable.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>assets/global/plugins/datatables/datatables.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js" type="text/javascript"></script>
        <script type="text/javascript">
    $('.date-picker').datepicker({
        format: 'dd-mm-yyyy',
    });
</script>
        <!-- END PAGE LEVEL PLUGINS -->
        <?php //theme layout scripts ?>