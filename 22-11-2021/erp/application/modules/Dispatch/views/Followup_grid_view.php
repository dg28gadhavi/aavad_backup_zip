<?php //echo "<pre>"; print_r($listfolloup); die;?>

<link href="<?php echo base_url(); ?>assets/global/plugins/bootstrap-select/css/bootstrap-select.min.css" rel="stylesheet" type="text/css" />
<!-- BEGIN PAGE LEVEL PLUGINS -->
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/search/css/jquery-ui.css">
<!-- END PAGE LEVEL PLUGINS -->   
<div class="container-fluid">
        <div class="page-content">
<!-- BEGIN BREADCRUMBS -->
            <div class="breadcrumbs">
                <h1>Sales Inquiry Followup List</h1>
                <ol class="breadcrumb">
                    <li><a href="<?php echo base_url(); ?>Dashboard">Dashboard</a></li>
                    <li class="active"><a href="<?php echo base_url(); ?>inq-followup">Follow up List</a></li>
                    <li><a href="<?php echo base_url(); ?>Sales_enq/add">Sales Inquiry Add</a></li>
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
                                
            <div class="row" style="display:none">
                <div class="col-md-12 col-sm-12 text-right">
                    <h3><a class="btn btn-default blue" href="<?php echo base_url().'Inquiry/csvimport'; ?>">Import CSV</a></h3>
                </div>
            </div>
<!-- END BREADCRUMBS -->
            <!-- BEGIN CONTENT -->
            <div class="page-content-container">
                <div class="row">
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <div class="dashboard-stat2 bordered">
                                <div class="display">
                                    <div class="number">
                                        <h3 class="font-green-sharp">
                                            <span data-counter="counterup" data-value=""></span>
                                            <small class="font-green-sharp"></small>
                                        </h3>
                                        <small>TOTAL FOLLOWUP WORK <h2><?php echo number_format($total['task']['cnt']);?></h2></small>
                                    </div>
                                    <div class="icon">
                                        <i class="icon-pie-chart"></i>
                                    </div>
                                </div>
                                <!-- <div class="progress-info">
                                    <div class="progress">
                                        <span style="width: 76%;" class="progress-bar progress-bar-success green-sharp">
                                            <span class="sr-only">76% progress</span>
                                        </span>
                                    </div>
                                    <div class="status">
                                        <div class="status-title"> progress </div>
                                        <div class="status-number"> 76% </div>
                                    </div>
                                </div> -->
                            </div>
                        </div>
                    </div>
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
                        <!-- msd start-->
                        <div class="col-md-12 col-sm-12">
                            <!-- BEGIN PORTLET-->
                         <div class="portlet light bordered">
                                <div class="portlet-title tabbable-line">
                                    <div class="caption">
                                        <i class="icon-globe font-green-sharp"></i>
                                        <span class="caption-subject font-green-sharp bold uppercase">List Of Followup Stastics</span>
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
                                                    <th>Sr no.</th>
                                                    <th>Contact Person Name</th>
                                                    <th>Contact No</th>
                                                    <th>Status</th>
                                                    <th>Follow Up Date</th>
                                                    <th>Executive</th>
                                                    <!-- <th>link</th> -->
                                                    <th>Remark</th>
                                                  </tr>
                                                </thead>
                                                <tbody>
                                                     <?php $i=0;foreach ($listfolloup as $sub) { $i++;?>
                                                     <?php if($sub['followdate'] == '1970-01-01')
                                                        {
                                                            $sub['followdate'] = '';
                                                        }else{
                                                            $sub['followdate'] = date("d-m-Y", strtotime($sub['followdate']));
                                                        }
                                                        if(strtotime(date("d-m-Y")) > strtotime($sub['followdate']))
                                                        {
                                                            $color = 'red';
                                                        }else{
                                                            $color = '';
                                                        }
                                                        if(isset($sub['folst']) && $sub['folst'] == 6)
                                                         {
                                                            $sub['stname'] = 'Deactive';
                                                         }elseif(isset($sub['folst']) && $sub['folst'] == 5){
                                                            $sub['stname'] = 'active';
                                                         }else{
                                                            $sub['stname'] = '';
                                                         }
                                                    ?>
                                                  <tr style="color:<?php echo  $color;?>;">
                                                     <td> 
                                                   <div class="cont-col1">
                                                        <div class="label label-sm label-danger">
                                                            <i class="fa fa-bolt"></i>
                                                        </div>
                                                    </div>
                                                   </td>
                                                   <td> 
                                                   <?php echo $i; ?>
                                                   </td>
                                                    <td> 
                                                   <?php echo $sub['name']; ?>
                                                   </td>
                                                    <td  class="body-space"><?php echo $sub['mno']; ?></td>
                                                    <td><?php echo $sub['stname']; ?></td>
                                                    <td><?php echo $sub['followdate']; ?></td>
                                                    <td><?php echo $sub['executive']; ?></td>
                                                    <td><?php echo $sub['fu_remark']; ?></td>
                                                    <td><?php
                                                        echo '<a class="btn" target="_blank" href="'.base_url().'Sales_enq/other_details/'.encrypt_decrypt('encrypt',$sub['id'])
                                                        ?>
                                                        ">View </a>
                                                       </td>
                                                       
                                                       <td>
                                                        <?php if(isset($sub['folst']) && $sub['folst'] == 6) { ?>
                                                        <?php
                                                        echo '<a class="btn" href="'.base_url().'Sales_enq/status_act/'.encrypt_decrypt('encrypt',$sub['fuid'])
                                                        ?>
                                                        ">Activate </a>
                                                        <?php } ?>
                                                        <?php if(isset($sub['folst']) && $sub['folst'] == 5) { ?>
                                                        <?php
                                                        echo '<a class="btn" href="'.base_url().'Sales_enq/status_deact/'.encrypt_decrypt('encrypt',$sub['fuid'])
                                                        ?>
                                                        ">Deactivate </a>
                                                        <?php } ?>
                                                       </td>
                                                  </tr>
                                                  <?php } ?>
                                                </tbody>
                                              </table>
                                            </div>   
                                            </div>
                                        </div>
                                    </div>
                                    <!--END TABS-->
                                </div>
                            </div>
                            <!-- END PORTLET-->
                        </div>
                        <!--msd end-->
                        
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
                                        <form method="get" accept-charset="utf-8" action="<?php echo base_url(); ?>Inquiry/status">
                                    <div class="table-container">
                                       <?php /*?> <div class="table-actions-wrapper">
                                            <span> </span>
                                            <select class="table-group-action-input form-control input-inline input-small input-sm" id="dropdownHolder"  name="inq_status_o">
                                                <option value="0">Select...</option>
                                                <option value="1">Order No</option>
                                            </select>
                                            <button class="btn btn-sm" name="submit" type="submit">
                                                <i class="fa fa-check"></i> Submit</button>
                                          
                                        </div>
                                        <div>
                                           <?php echo $pagi; ?> <strong>Total : <?php echo $total_rows; ?></strong>
                                        </div><?php */?>
                                        <table class="table table-striped table-bordered table-hover table-checkable" id="datatable_ajax">
                                       
                                            <thead>
                                                <tr role="row" class="heading">
                                                    <?php /*?><th width="2%">
                                                        <input type="checkbox" class="group-checkable"> </th>
                                                    <th width="2%"> Record&nbsp;# </th>

<?php */?>                                          <th width="2%"> Sr No. </th>
                                                    <th width="2%"> Contact Person  Name</th>
                                                    <th width="2%"> Contact No</th>
                                                    <th width="2%"> Status </th>
                                                    <th width="2%"> Follow Up Date </th>
                                                    <th width="2%"> Executive </th>
                                                    <th width="2%"> Remark </th>
                                                    <th width="2%"></th>
                                                </tr>
                                                <tr role="row" class="filter">
                                                    <td> </td>
                                                   <?php /*?> <td> </td>
                                                    <td>
                                                        <input type="text" class="form-control form-filter input-sm" name="order_id"> </td><?php */?>
                                                    <td>
                                                        <input type="text" class="form-control form-filter input-sm" name="name"> </td>
                                                    <td>
                                                        <input type="text" class="form-control form-filter input-sm" name="cno"> </td>
                                                        <td>
                                                        <input type="text" class="form-control form-filter input-sm" name="status"> </td>
                                                        <td>
                                                        <input type="text" class="form-control form-filter input-sm" name="date"> </td>
                                                    <td>
                                                        <input type="text" class="form-control form-filter input-sm" name="exec"> </td>
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
                                        
                                        
                                        <?php /*?><table class="table table-striped table-bordered table-hover table-checkable">
                                       
                                            <thead>
                                                <tr role="row" class="heading">
                                                    <th width="2%">
                                                        <input type="checkbox" class="group-checkable"> </th>
                                                    <th width="5%"> Inquiry Date</th>
                                                    <th width="2%"> Inquiry Type</th>
                                                    <th width="2%"> First Name</th>
                                                    <th width="2%"> Last Name </th>
                                                    <th width="2%"> Client Name </th>
                                                    <th width="2%"> Product type</th>
                                                    <th width="2%"> Category </th>
                                                    <th width="2%"> Status </th>
                                                    <th width="2%"> Contact No. </th>
                                                    <th width="2%"> Age </th>
                                                    <th width="2%"> Remark</th>
                                                    <th width="2%"></th>
                                                </tr>
                                                <tr role="row" class="filter">
                                                    <td> </td>
                                                    <td>
                                                       <div class="input-group date date-picker margin-bottom-5" data-date-format="dd-mm-yyyy">
                                                                <input type="text" class="form-control form-filter input-sm"  name="inq_start_date" placeholder="From">
                                                                <span class="input-group-btn">
                                                                    <button class="btn btn-sm default" type="button">
                                                                        <i class="fa fa-calendar"></i>
                                                                    </button>
                                                                </span>
                                                            </div>
                                                            <div class="input-group date date-picker" data-date-format="dd-mm-yyyy">
                                                                <input type="text" class="form-control form-filter input-sm"  name="inq_end_date" placeholder="To">
                                                                <span class="input-group-btn">
                                                                    <button class="btn btn-sm default" type="button">
                                                                        <i class="fa fa-calendar"></i>
                                                                    </button>
                                                                </span>
                                                            </div>
</td>
                                                    <td>
                                                          <select  name="inq_type" id="inq_ype" class="bs-select form-control inq_type  form-filter input-sm" data-live-search="true" data-placeholder="Choose Source">
                                                    <option value="">Select Inq. Type</option> 
                                                    <?php foreach($datass['inquirys'] as $ptype) { ?> 
                                                            <option value="<?php echo $ptype['inquiry_type_id']; ?>" <?php if(isset($this->session->userdata['inq_forn']['inq_type']) && ($this->session->userdata['inq_forn']['inq_type'] == $ptype['inquiry_type_id'])){ ?> selected="selected" <?php } ?> ><?php echo $ptype['inquiry_type_name']; ?></option>
                                                            <?php } ?>
                                                            </select>

                                                            </td>
<td><input type="text" class="form-control form-filter input-sm" name="fname" value="<?php 
echo isset($this->session->userdata['inq_forn']['fname']) ? $this->session->userdata['inq_forn']['fname'] : '';?>"> </td>
<td><input type="text" class="form-control form-filter input-sm" name="lname" value="<?php 
echo isset($this->session->userdata['inq_forn']['lname']) ? $this->session->userdata['inq_forn']['lname'] : '';?>"> </td>
<td><input type="text" class="form-control form-filter input-sm" name="clientname" value="<?php 
echo isset($this->session->userdata['inq_forn']['clientname']) ? $this->session->userdata['inq_forn']['clientname'] : '';?>"> </td>
<td> <select name="product_type" id="product_type" class="bs-select form-control pro_type form-filter input-sm" data-live-search="true" data-placeholder="Choose Source" tabindex="5">
                                                                <option value="">Select Product Type</option>
                                                               <?php foreach($datass['ptypes'] as $ptype) { ?>
                                                            <option value="<?php echo $ptype['prot_id']?>"<?php if(isset($this->session->userdata['inq_forn']['product_type']) && ($this->session->userdata['inq_forn']['product_type'] == $ptype['prot_id'])){ ?> selected="selected" <?php } ?>><?php echo $ptype['prot_name']?></option>  
                                                            <?php } ?> 
                                                        </select></td>
<td> <select  name="category" id="Product_Category" class="bs-select form-control form-filter input-sm" data-live-search="true" data-placeholder="Choose Source">
                                                            <option value="">Select Product Category</option>
                                                            <?php foreach($datass['pcats'] as $ptype) { ?>
                                                            <option value="<?php echo $ptype['procat_id']?>"<?php if(isset($this->session->userdata['inq_forn']['category']) && ($this->session->userdata['inq_forn']['category'] == $ptype['procat_id'])){ ?> selected="selected" <?php } ?>><?php echo $ptype['procat_name']?></option> 
                                                            <?php } ?>  
                                                            </select></td>
<td><select  name="status" id="inq_Status" class="bs-select form-control form-filter input-sm" data-live-search="true" data-placeholder="Choose Source">
                                                            <option value="">Select Inq. Status</option> 
                                                        <?php foreach($datass['inqst'] as $ptype) { ?>
                                                            <option value="<?php echo $ptype['inquiry_status_id']?>"<?php if(isset($this->session->userdata['inq_forn']['status']) && ($this->session->userdata['inq_forn']['status'] == $ptype['inquiry_status_id'])){ ?> selected="selected" <?php } ?>><?php echo $ptype['inquiry_status_name']?></option> 
                                                            <?php } ?> 
                                                        </select></td>
<td><input type="text" class="form-control form-filter input-sm" name="cno" value="<?php 
echo isset($this->session->userdata['inq_forn']['cno']) ? $this->session->userdata['inq_forn']['cno'] : '';?>"> </td>
<td><input type="text" class="form-control form-filter input-sm" name="age" value="<?php 
echo isset($this->session->userdata['inq_forn']['age']) ? $this->session->userdata['inq_forn']['age'] : '';?>"> </td>
<td><input type="text" class="form-control form-filter input-sm" name="remark"> </td>
                                                    <td>
                                                        <div class="margin-bottom-5">
                                                            <button class="btn btn-sm green btn-outline filter-submit margin-bottom">
                                                                <i class="fa fa-search"></i> Search</button>
                                                        </div>
                                                        <a class="btn btn-default red" href="<?php echo base_url().'Inquiry/reset_inquiry'; ?>">Reset</a>
                                                    </td>
                                                </tr>
                                            </thead>
                                            <tbody>
                                         
                                                <?php foreach ($inq_lists as $key => $inq_list) { ?>
                                                    <tr class="odd" role="row">
                                                         <td> <input type="checkbox" class="group-checkable"></td>
                                                        <td><?php echo date("d-m-Y", strtotime($inq_list['inq_date'])); ?></td>
                                                        <td><?php echo $inq_list['inquiry_type_name']; ?></td>
                                                        <td><?php echo $inq_list['bd_fname']; ?></td>
                                                        <td><?php echo $inq_list['bd_mname']; ?></td>
                                                        <td><?php echo $inq_list['bd_fullname']; ?></td>
                                                        <td><?php echo $inq_list['prot_name']; ?></td>
                                                        <td><?php echo $inq_list['procat_name']; ?></td>
                                                        <td><?php if($inq_list['inq_inqstatus'] == 8)
                                                        {
                                                            echo '<span class="label label-success">'.$inq_list['inquiry_status_name'].'</span>';
                                                        }else if($inq_list['inq_inqstatus'] == 5)
                                                        {
                                                            echo '<span class="label label-info">'.$inq_list['inquiry_status_name'].'</span>';
                                                        }else if($inq_list['inq_inqstatus'] == 3)
                                                        {
                                                            echo '<span class="label label-primary">'.$inq_list['inquiry_status_name'].'</span>';
                                                        }else if($inq_list['inq_inqstatus'] == 6)
                                                        {
                                                            echo '<span class="label label-warning">'.$inq_list['inquiry_status_name'].'</span>';
                                                        }else if($inq_list['inq_inqstatus'] == 2)
                                                        {
                                                            echo '<span class="label label-primary">'.$inq_list['inquiry_status_name'].'</span>';
                                                        }else if($inq_list['inq_inqstatus'] == 1)
                                                        {
                                                            echo '<span class="label label-info">'.$inq_list['inquiry_status_name'].'</span>';
                                                        }else if($inq_list['inq_inqstatus'] == 4)
                                                        {
                                                            echo '<span class="label label-warning">'.$inq_list['inquiry_status_name'].'</span>';
                                                        }else
                                                        {
                                                            echo '<span class="label label-info">'.$inq_list['inquiry_status_name'].'</span>';
                                                        } ?></td>
                                                        <td><?php echo $inq_list['con_no_mnos']; ?></td>
                                                        <td><?php echo $inq_list['bd_age']; ?></td>
                                                        <td><?php echo $inq_list['bd_remark']; ?></td>
                                                       <?php  $idenc = encrypt_decrypt('encrypt',$inq_list['inq_id']); ?>
                                                        <td><?php if(isset($editrights) && ($editrights != false)){ ?><a class="btn btn-default blue" href="<?php echo base_url().'Inquiry/edit/'.$idenc ?>">Edit</a> <?php 
                                                            }
                                                        ?>
                                                        <?php if(isset($editrights) && ($editrights != false)){ ?>
                                                        <a class="btn btn-default red" onclick="return confirm('Are you sure you want to Delete this record?');" href="<?php echo base_url().'Inquiry/delete/'.$idenc ?>">Delete</a>
                                                        <?php } ?>
                                                        </td>
                                                    </tr>
                                                <?php } ?>
                                                 
                                            </tbody>
                                        </table><?php */?>
                                        <?php /*?> <div>
                                           <?php echo $pagi; ?><strong>Total : <?php echo $total_rows; ?></strong>
                                        </div><?php */?>
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
<script src="<?php echo base_url(); ?>assets/custom/js/sales_inq_followup.js" type="text/javascript"></script>
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script src="<?php echo base_url(); ?>assets/global/plugins/bootstrap-select/js/bootstrap-select.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/pages/scripts/components-bootstrap-select.min.js" type="text/javascript"></script>
<!-- END PAGE LEVEL PLUGINS -->
<script type="text/javascript">
    var status = '<?php echo $this->input->get('status') ? $this->input->get('status') : ''; ?>';
</script>
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="../assets/pages/scripts/ui-general.min.js" type="text/javascript"></script>
<!-- END PAGE LEVEL SCRIPTS -->
<!-- END PAGE LEVEL SCRIPTS -->
        