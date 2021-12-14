<?php //echo '<pre>'; print_r($total); die;?>

            <div class="container-fluid">
                <div class="page-content">

<!-- BEGIN BREADCRUMBS -->
                    <div class="breadcrumbs">
                        <h1>Pending Work List</h1>
                        <ol class="breadcrumb">
                            <li>
                                <a href="<?php echo base_url(); ?>Dashboard">Dashboard</a>
                            </li>
                            <li class="active">
                                <a href="<?php echo base_url(); ?>Task_assign">Pending Work List</a>
                            </li>
                            <li>
                                <a href="<?php echo base_url(); ?>Task_assign/add">Pending Work Add</a>
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
            <div class="row">
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        <div class="dashboard-stat2 bordered">
                            <div class="display">
                                <div class="number">
                                    <h3 class="font-green-sharp">
                                        <span data-counter="counterup" data-value=""></span>
                                        <small class="font-green-sharp"></small>
                                    </h3>
                                    <small>TOTAL PENDING WORK <h2><?php echo number_format($total['task']['cnt']);?></h2></small>
                                </div>
                                <div class="icon">
                                    <i class="icon-pie-chart"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
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
                        <!--msd work start-->
                        	<div class="col-md-12 col-sm-12">
                            <!-- BEGIN PORTLET-->
                         <div class="portlet light bordered">
                                <div class="portlet-title tabbable-line">
                                    <div class="caption">
                                        <i class="icon-globe font-green-sharp"></i>
                                        <span class="caption-subject font-green-sharp bold uppercase">List Of Task Assigned By Admin </span>
                                    </div>
                                </div>
                                <div class="portlet-body">
                                    <!--BEGIN TABS-->
                                    <div class="tab-content">
                                        <div class="tab-pane active" id="tab_1_1">
                                            <div class="scroller" style="height: 339px;" data-always-visible="1" data-rail-visible="0">
                                            <div class="table-responsive"> 
                                                <table class="table">
                                                <thead>
                                                 <tr>
                                                    <th></th>
                                                    <th>Sr No.</th>
                                                    <th>Priority</th>
                                                    <th>Task Description</th>
                                                    <th>Assign Dt</th>
                                                    <th>When(Dt. To be completed)</th>
                                                    <th>Assigned By</th>
                                                    <th>link</th>
                                                  </tr>
                                                </thead>
                                                <tbody>
                                                     <?php $i=0; foreach ($taskbyadmin as $sub) { $i++;?>
                                                     <?php $current = date('d-m-Y'); $completed = date("d-m-Y", strtotime($sub['task_when'])); ?>
                                                           <?php if(strtotime($current) > strtotime($completed)) { ?>
                                                                  <?php  $stylestr =  ' style="color:#F00;" ';?>
                                                          <?php  }else{  $stylestr = 'style="color:#000;" ';} ?>

                                                     <?php if($sub['task_date'] == '1970-01-01')
                                                    {
                                                        $sub['task_date'] = '';
                                                    }else{
                                                        $sub['task_date'] = date("d-m-Y", strtotime($sub['task_date']));
                                                    }
                                                    ?> 
                                                    <?php if($sub['task_when'] == '1970-01-01')
                                                    {
                                                        $sub['task_when'] = '';
                                                    }else{
                                                        $sub['task_when'] = date("d-m-Y", strtotime($sub['task_when']));
                                                    }?>

                                                  

                                                  <tr>
                                                    <td <?php echo $stylestr; ?>> 
                                                   <div class="cont-col1">
                                                        <div class="label label-sm label-danger">
                                                            <i class="fa fa-bolt"></i>
                                                        </div>
                                                    </div>
                                                   </td>
                                                   <td <?php echo $stylestr; ?>> 
                                                   <?php echo $i; ?>
                                                   </td>
                                                    <td <?php echo $stylestr; ?>> 
                                                   <?php echo $sub['task_priority']; ?>
                                                   </td>
                                                      
                                                    <td  class="body-space" <?php echo $stylestr; ?>><?php echo $sub['task_desc']; ?></td>
                                                    <td <?php echo $stylestr; ?>><?php echo $sub['task_date']; ?></td>
                                                    <td <?php echo $stylestr; ?>><?php echo $sub['task_when']; ?></td>
                                                    <td <?php echo $stylestr; ?>><?php echo $sub['to']; ?></td>
                                                    <td <?php echo $stylestr; ?>><?php
                                                                echo '<a class="btn" target="_blank" href="'.base_url().'Task_assign/edit/'.encrypt_decrypt('encrypt',$sub['task_id'])
                                                                ?>
                                                                ">View </a>
                                                               </td>
                                                  </tr>
                                                  <?php } ?>
                                                </tbody>
                                              </table>
                                            </div>
                                                <ul class="feeds">
                                                <li>
                                                    
                                            </li>
                                            <li>
                                            </li>
                                                    <!-- <li>
                                                        <div class="col1">
                                                            <div class="cont">
                                                                <div class="cont-col1">
                                                                    <div class="label label-sm label-danger">
                                                                        <i class="fa fa-bolt"></i>
                                                                    </div>
                                                                </div>
                                                                
                                                                
                                                                
                                                            </div>
                                                        </div>
                                                        <div class="col2">
                                                            <div class="date">  </div>
                                                        </div>
                                                    </li> -->
                                                
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <!--END TABS-->
                                </div>
                            </div>
                            <!-- END PORTLET-->
                        </div>
                        
                        <div class="col-md-12 col-sm-12">
                            <!-- BEGIN PORTLET-->
                         <div class="portlet light bordered">
                                <div class="portlet-title tabbable-line">
                                    <div class="caption">
                                        <i class="icon-globe font-green-sharp"></i>
                                        <span class="caption-subject font-green-sharp bold uppercase">List Of Task Assigned To Admin </span>
                                    </div>
                                </div>
                                <div class="portlet-body">
                                    <!--BEGIN TABS-->
                                    <div class="tab-content">
                                        <div class="tab-pane active" id="tab_1_1">
                                            <div class="scroller" style="height: 339px;" data-always-visible="1" data-rail-visible="0">
                                                 <div class="table-responsive"> 
                                                <table class="table">
                                                <thead>
                                                  <tr>
                                                    <th></th>
                                                    <th>Sr No.</th>
                                                    <th>Priority</th>
                                                    <th>Task Description</th>
                                                    <th>Assign Dt</th>
                                                    <th>When(Dt. To be completed)</th>
                                                    <th>Assigned To</th>
                                                    <th>link</th>
                                                  </tr>
                                                </thead>
                                                <tbody>
                                                     <?php $i=0; foreach ($tasktoadmin as $sub) { $i++;?>
                                                       <?php $current = date('d-m-Y'); $completed = date("d-m-Y", strtotime($sub['task_when'])); ?>
                                                           <?php if(strtotime($current) > strtotime($completed)) { ?>
                                                                  <?php  $stylestr =  ' style="color:#F00;" ';?>
                                                          <?php  }else{  $stylestr = ' style="color:#000;" ';} ?>
                                                     <?php if($sub['task_date'] == '1970-01-01')
                                                    {
                                                        $sub['task_date'] = '';
                                                    }else{
                                                        $sub['task_date'] = date("d-m-Y", strtotime($sub['task_date']));
                                                    }
                                                    ?> 
                                                    <?php if($sub['task_when'] == '1970-01-01')
                                                    {
                                                        $sub['task_when'] = '';
                                                    }else{
                                                        $sub['task_when'] = date("d-m-Y", strtotime($sub['task_when']));
                                                    }?>
                                                  <tr>
                                                    <td <?php echo $stylestr; ?>> 
                                                   <div class="cont-col1">
                                                        <div class="label label-sm label-danger">
                                                            <i class="fa fa-bolt"></i>
                                                        </div>
                                                    </div>
                                                   </td>
                                                   <td <?php echo $stylestr; ?>> 
                                                   <?php echo $i; ?>
                                                   </td>
                                                    <td <?php echo $stylestr; ?>> 
                                                   <?php echo $sub['task_priority']; ?>
                                                   </td>
                                                    <td class="body-space" <?php echo $stylestr; ?>><?php echo $sub['task_desc']; ?></td>
                                                    <td <?php echo $stylestr; ?>><?php echo $sub['task_date']; ?></td>
                                                    <td <?php echo $stylestr; ?>><?php echo $sub['task_when']; ?></td>
                                                    <td <?php echo $stylestr; ?>><?php echo $sub['to']; ?></td>
                                                    <td <?php echo $stylestr; ?>><?php
                                                                echo '<a class="btn" target="_blank" href="'.base_url().'Task_assign/edit/'.encrypt_decrypt('encrypt',$sub['task_id'])
                                                                ?>
                                                                ">View </a>
                                                               </td>
                                                  </tr>
                                                  <?php } ?>
                                                </tbody>
                                              </table>
                                            </div>
                                                <ul class="feeds">
                                                
                                                    <!-- <li>
                                                        <div class="col1">
                                                            <div class="cont">
                                                                <div class="cont-col1">
                                                                    <div class="label label-sm label-danger">
                                                                        <i class="fa fa-bolt"></i>
                                                                    </div>
                                                                </div>
                                                                <div class="cont-col2">
                                                                    
                                                                    
                                                                    
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col2">
                                                            <div class="date">  </div>
                                                        </div>
                                                    </li> -->
                                                
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <!--END TABS-->
                                </div>
                            </div>
                            <!-- END PORTLET-->
                        </div>
                        
                                              <?php   if($this->session->userdata('miconlogin') && is_array($this->session->userdata['miconlogin']) && !empty($this->session->userdata['miconlogin']) && isset($this->session->userdata['miconlogin']['typeid']) && (encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['typeid']) == 3))
                        { ?>
                           <div class="col-md-12 col-sm-12">
                            <!-- BEGIN PORTLET-->
                         <div class="portlet light bordered">
                                <div class="portlet-title tabbable-line">
                                    <div class="caption">
                                        <i class="icon-globe font-green-sharp"></i>
                                        <span class="caption-subject font-green-sharp bold uppercase">List Of Super Admin Task</span>
                                    </div>
                                </div>
                                <div class="portlet-body">
                                    <!--BEGIN TABS-->
                                    <div class="tab-content">
                                        <div class="tab-pane active" id="tab_1_1">
                                            <div class="scroller" style="height: 339px;" data-always-visible="1" data-rail-visible="0">
                                                 <div class="table-responsive"> 
                                                <table class="table">
                                                <thead>
                                                  <tr>
                                                    <th></th>
                                                    <th>Sr No.</th>
                                                    <th>Priority</th>
                                                    <th>Task Description</th>
                                                    <th>Assign Dt</th>
                                                    <th>When(Dt. To be completed)</th>
                                                    <th>Assigned To</th>
                                                    <th>link</th>
                                                  </tr>
                                                </thead>
                                                <tbody>
                                                     <?php $i=0; foreach ($tasksuper as $sub) { $i++;?>
                                                       <?php $current = date('d-m-Y'); $completed = date("d-m-Y", strtotime($sub['task_when'])); ?>
                                                           <?php if(strtotime($current) > strtotime($completed)) { ?>
                                                                  <?php  $stylestr =  ' style="color:#F00;" ';?>
                                                          <?php  }else{  $stylestr = 'style="color:#000;" ';} ?>
                                                     <?php if($sub['task_date'] == '1970-01-01')
                                                    {
                                                        $sub['task_date'] = '';
                                                    }else{
                                                        $sub['task_date'] = date("d-m-Y", strtotime($sub['task_date']));
                                                    }
                                                    ?> 
                                                    <?php if($sub['task_when'] == '1970-01-01')
                                                    {
                                                        $sub['task_when'] = '';
                                                    }else{
                                                        $sub['task_when'] = date("d-m-Y", strtotime($sub['task_when']));
                                                    }?>
                                                  <tr>
                                                    <td <?php echo $stylestr; ?>> 
                                                   <div class="cont-col1">
                                                        <div class="label label-sm label-danger">
                                                            <i class="fa fa-bolt"></i>
                                                        </div>
                                                    </div>
                                                   </td >
                                                   <td <?php echo $stylestr; ?>> 
                                                   <?php echo $i; ?>
                                                   </td>
                                                    <td <?php echo $stylestr; ?>> 
                                                   <?php echo $sub['task_priority']; ?>
                                                   </td >
                                                    <td  class="body-space" <?php echo $stylestr; ?>><?php echo $sub['task_desc']; ?></td>
                                                    <td <?php echo $stylestr; ?>><?php echo $sub['task_date']; ?></td>
                                                    <td <?php echo $stylestr; ?>><?php echo $sub['task_when']; ?></td>
                                                    <td <?php echo $stylestr; ?>><?php echo $sub['to']; ?></td>
                                                    <td <?php echo $stylestr; ?>><?php
                                                                echo '<a class="btn" target="_blank" href="'.base_url().'Task_assign/edit/'.encrypt_decrypt('encrypt',$sub['task_id'])
                                                                ?>
                                                                ">View </a>
                                                               </td>
                                                  </tr>
                                                  <?php } ?>
                                                </tbody>
                                              </table>
                                            </div>
                                                <ul class="feeds">
                                                
                                                    <!-- <li>
                                                        <div class="col1">
                                                            <div class="cont">
                                                                <div class="cont-col1">
                                                                    <div class="label label-sm label-danger">
                                                                        <i class="fa fa-bolt"></i>
                                                                    </div>
                                                                </div>
                                                                <div class="cont-col2">
                                                                    
                                                                    
                                                                    
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col2">
                                                            <div class="date">  </div>
                                                        </div>
                                                    </li> -->
                                                
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <!--END TABS-->
                                </div>
                            </div>
                            <!-- END PORTLET-->
                        </div>
                      <?php  } ?>

                        <!-- msd work end-->
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
                                <form method="get" accept-charset="utf-8" action="<?php echo base_url(); ?>Task_assign/delete_all">
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
                                            <thead>
                                                <tr role="row" class="heading">
                                                    <th width="2%">
                                                        <input type="checkbox" class="group-checkable"> </th>
                                                    <th width="2%"> Record&nbsp;# </th>
                                                    <th width="2%"> Task Description </th>
                                                    <th width="2%"> Task Assigned by </th>
                                                    <th width="2%"> Task Assigned To </th>
                                                    <th width="2%"> Task Assign Date </th>
                                                    <th width="2%"> When to be Completed </th>
                                                    <th width="2%"> Completed date </th>
                                                    <th width="2%"> Priority </th>
                                                    <th width="2%"> Status </th>
                                                    <!-- <th width="2%"> Created Date </th>
                                                    <th width="2%"> Updated Date </th> -->
                                                  <!--   <th width="2%"> Task_assign Dricprition </th> -->
                                                    <th width="5%"></th>
                                                </tr>
                                                <tr role="row" class="filter">
                                                    <td> </td>
                                                    <td>
                                                        <input type="text" class="form-control form-filter input-sm" name="order_id"> </td>
                                                    <td>
                                                        <input type="text" class="form-control form-filter input-sm" name="task_desc"> </td>
                                                    <td>
                                                        <input type="text" class="form-control form-filter input-sm" name="task_assign"> </td>
                                                    <td>
                                                        <input type="text" class="form-control form-filter input-sm" name="task_to"> </td>
                                                    <td>
                                                        <input type="text" class="form-control form-filter input-sm" name="task_date"> </td>
                                                    <td>
                                                        <input type="text" class="form-control form-filter input-sm" name="when"> </td>
                                                    <td>
                                                        <input type="text" class="form-control form-filter input-sm" name="complete"> </td>
                                                    <td>
                                                        <input type="text" class="form-control form-filter input-sm" name="priority"> </td>
                                                    <td>
                                                        <input type="text" class="form-control form-filter input-sm" name="status_pending"> </td>
                                                    <!-- <td>
                                                        <input type="text" class="form-control form-filter input-sm" name="country_name"> </td>
                                                     <td>
                                                        <input type="text" class="form-control form-filter input-sm" name="country_name"> </td> -->
                                                    <!--  <td>
                                                        <input type="text" class="form-control form-filter input-sm" name="order_id"> </td> -->
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
        <script src="<?php echo base_url(); ?>assets/custom/js/Task_assign.js" type="text/javascript"></script>
        <!-- BEGIN PAGE LEVEL PLUGINS -->
        <script src="<?php echo base_url(); ?>assets/global/plugins/bootstrap-select/js/bootstrap-select.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>assets/global/scripts/datatable.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>assets/global/plugins/datatables/datatables.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>assets/pages/scripts/components-bootstrap-select.min.js" type="text/javascript"></script>
        <!-- END PAGE LEVEL PLUGINS -->
        <!-- BEGIN PAGE LEVEL SCRIPTS -->
        <script src="../assets/pages/scripts/ui-general.min.js" type="text/javascript"></script>
        <!-- END PAGE LEVEL SCRIPTS -->
        <!-- END PAGE LEVEL SCRIPTS -->