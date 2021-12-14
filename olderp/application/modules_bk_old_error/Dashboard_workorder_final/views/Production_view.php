<?php //echo "<pre>";print_r($work_orders);die;

//echo "sasasasasasaS".$this->session->flashdata('rights_error');die; ?>
<link rel="stylesheet" href="https://www.webnots.com/resources/font-awesome/css/font-awesome.min.css">
<link href="<?php echo base_url(); ?>assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url(); ?>assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url(); ?>assets/global/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url(); ?>assets/global/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url(); ?>assets/global/plugins/clockface/css/clockface.css" rel="stylesheet" type="text/css" />
<div class="container-fluid">
                <div class="page-content">
<!-- BEGIN BREADCRUMBS -->
                    <div class="breadcrumbs">
                        <h1>Production User For WO</h1>
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
                        <?php if($this->input->post()){ ?>
                        <div class="col-md-12 col-xs-6"><div class="alert alert-danger">
                        <strong><?php echo $this->session->flashdata('error'); echo validation_errors();?></strong> 
                        </div></div>
                        </div>
                        <?php } ?>
                    </div>

<!-- END BREADCRUMBS -->
<!-- BEGIN CONTENT -->
            <div class="page-content-container">
                <!-- BEGIN CONTENT BODY -->
                <div class="page-content-row">
                    <!-- BEGIN PAGE HEADER-->
                    <div class="page-content-col">
                    <div class="row">
                        <?php if (!empty($rights_error) || $this->session->flashdata('rights_error') != '') {
            $msg = !empty($rights_error) ? $rights_error : $this->session->flashdata('rights_error');
            echo '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button>' . $msg . '</div>';}?>
                            <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
                                <div class="dashboard-stat2 bordered sales-dashbg">
                                    <div class="display">
                                        <div class="number">
                                            <h3 class="font-green-sharp">
                                                <span data-counter="counterup" data-value="<?php echo isset($production_count['total_production_pending']['count']) ? number_format($production_count['total_production_pending']['count']) : 0;?>"></span>
                                                <small class="font-green-sharp"></small>
                                            </h3>
                                            <a href="<?php echo base_url(); ?>Work_order_item_list/Work_order_item_list_report?productionapproved=2"><small>PENDING</small></a>
                                        </div>
                                        <div class="icon">
                                            <i class="icon-pie-chart"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
                                <div class="dashboard-stat2 bordered sales-dashbg">
                                    <div class="display">
                                        <div class="number">
                                            <h3 class="font-green-sharp">
                                                <span data-counter="counterup" data-value="<?php echo isset($production_count['total_store_pending']['count']) ? number_format($production_count['total_store_pending']['count']) : 0;?>"></span>
                                                <small class="font-green-sharp"></small>
                                            </h3>
                                            <a href="<?php echo base_url(); ?>Work_order_item_list/Work_order_item_list_report?storeapproved=2"><small>Store PENDING</small></a>
                                        </div>
                                        <div class="icon">
                                            <i class="icon-pie-chart"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
                                <div class="dashboard-stat2 bordered sales-dashbg">
                                    <div class="display">
                                        <div class="number">
                                            <h3 class="font-green-sharp">
                                                <span data-counter="counterup" data-value="<?php echo isset($production_count['total_production_approved']['count']) ? number_format($production_count['total_production_approved']['count']) : 0;?>"></span>
                                                <small class="font-green-sharp"></small>
                                            </h3>
                                            <a href="<?php echo base_url(); ?>Work_order_item_list/Work_order_item_list_report?productionapproved=1"><small>Approved</small></a>
                                        </div>
                                        <div class="icon">
                                            <i class="icon-pie-chart"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
                                <div class="dashboard-stat2 bordered sales-dashbg">
                                    <div class="display">
                                        <div class="number">
                                            <h3 class="font-green-sharp">
                                                <span data-counter="counterup" data-value="<?php echo isset($production_count['today_production_approved']['count']) ? number_format($production_count['today_production_approved']['count']) : 0;?>"></span>
                                                <small class="font-green-sharp"></small>
                                            </h3>
                                            <a href="#"><small>Today Approved</small></a>
                                        </div>
                                        <div class="icon">
                                            <i class="icon-pie-chart"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
                                <div class="dashboard-stat2 bordered sales-dashbg">
                                    <div class="display">
                                        <div class="number">
                                            <h3 class="font-green-sharp">
                                                <span data-counter="counterup" data-value="<?php echo isset($production_count['yesterday_production_approved']['count']) ? number_format($production_count['yesterday_production_approved']['count']) : 0;?>"></span>
                                                <small class="font-green-sharp"></small>
                                            </h3>
                                            <a href="#"><small>Yesterday Approved</small></a>
                                        </div>
                                        <div class="icon">
                                            <i class="icon-pie-chart"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
                                <div class="dashboard-stat2 bordered sales-dashbg">
                                    <div class="display">
                                        <div class="number">
                                            <h3 class="font-green-sharp">
                                                <span data-counter="counterup" data-value="<?php echo isset($production_count['this_month_production_approved']['count']) ? number_format($production_count['this_month_production_approved']['count']) : 0;?>"></span>
                                                <small class="font-green-sharp"></small>
                                            </h3>
                                            <a href="#"><small>This Month Approved</small></a>
                                        </div>
                                        <div class="icon">
                                            <i class="icon-pie-chart"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    </div>
                    <div class="row">
                            <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
                                <div class="dashboard-stat2 bordered sales-dashbg">
                                    <div class="display">
                                        <div class="number">
                                            <h3 class="font-green-sharp">
                                                <span data-counter="counterup" data-value="<?php echo isset($production_count['last_month_production_approved']['count']) ? number_format($production_count['last_month_production_approved']['count']) : 0;?>"></span>
                                                <small class="font-green-sharp"></small>
                                            </h3>
                                            <a href="#"><small>Last Month Approved</small></a>
                                        </div>
                                        <div class="icon">
                                            <i class="icon-pie-chart"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
                                <div class="dashboard-stat2 bordered sales-dashbg">
                                    <div class="display">
                                        <div class="number">
                                            <h3 class="font-green-sharp">
                                                <span data-counter="counterup" data-value="<?php echo isset($production_count['this_year_production_approved']['count']) ? number_format($production_count['this_year_production_approved']['count']) : 0;?>"></span>
                                                <small class="font-green-sharp"></small>
                                            </h3>
                                            <a href="#"><small>This Year Approved</small></a>
                                        </div>
                                        <div class="icon">
                                            <i class="icon-pie-chart"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    </div>



                 <div class="page-content-container">
                <!-- BEGIN CONTENT -->
                <?php $search_task = array('class' => 'form-horizontal','method' => 'get');
                                    echo form_open(base_url().'Dashboard_workorder_final',$search_task); ?>
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
                                        	<div class="col-md-1 col-sm-12">
                                                <div class="form-group" id="mcna_namegr">
                                                    <div class="col-md-12">
                                                        <input type="text" class="form-control form-control-inline date-picker" placeholder="Start Date" name="inq_start_date" maxlength="200" id="inq_start_date" value="<?php echo ($this->input->get('inq_start_date')) ? $this->input->get('inq_start_date') : "";?>">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-1 col-sm-12 text-right">
                                                <div class="form-group" id="mcna_namegr">
                                                    <div class="col-md-12">
                                                        <input type="text" class="form-control form-control-inline date-picker" placeholder="End Date" name="inq_end_date" maxlength="200" id="inq_end_date" value="<?php echo $this->input->get('inq_end_date') ? $this->input->get('inq_end_date') : ''; ?>">
                                                    </div>
                                                </div>
                                            </div>
                                             <div class="col-lg-1 col-md-1 col-sm-1 col-xs-12 text-left">
                                                     <input type="text" class="form-control" placeholder="Customer Search" name="customer_search" maxlength="200" id="customer_search" value="<?php echo $this->input->get('customer_search') ? $this->input->get('customer_search') : ''; ?>">
                                            </div>
                                            <div class="col-lg-1 col-md-1 col-sm-1 col-xs-12 text-left">
                                                     <input type="text" class="form-control" placeholder="Part No. Wise Search" name="part_no_search" maxlength="200" id="part_no_search" value="<?php echo $this->input->get('part_no_search') ? $this->input->get('part_no_search') : ''; ?>">
                                            </div>
                                            <div class="col-lg-1 col-md-1 col-sm-1 col-xs-12 text-left">
                                                     <input type="text" class="form-control" placeholder="Wo no" name="wo_no" maxlength="200" id="wo_no" value="<?php echo $this->input->get('wo_no') ? $this->input->get('wo_no') : ''; ?>">
                                            </div>
                                            <div class="col-md-2">
                                                <button class="btn green" type="submit"><i class="fa fa-check"></i></button>
                                                <a href="<?php echo base_url(); ?>Dashboard_workorder_final" class="btn red text-left"><i class="fa fa-refresh"></i></a>
                                            </div>                                           
                                        </div>  
                                        <?php echo form_close(); ?>
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
                        <div class="col-md-12">
                        <div class="portlet box">
                        <div class="portlet-body form">

                            <table class="table table-striped table-bordered dt-responsive" width="100%" id="sample_1">
                        <thead>
                            <tr>
                                <th  width="1%">Sr.No</th>
                                <th  width="3%">Wo.No</th>
                                <th  width="2%">Wo.Date</th>
                                <th  width="30%">Customer Name</th>
                                <th  width="50%">Item Description</th>
                                <th  width="2%">Qty</th>
                                <th  width="2%">Action</th>
                            </tr>
                        </thead>
                            <tbody>
                        <?php $id = 0; $j = 0;
                         if(isset($work_orders)) { 
                         foreach($work_orders as $row){ $id++; $j++; ?>

                        <tr <?php if($row['woi_store_approve'] == 1){ $date1 = strtotime($row['woi_store_approve_date']); ?> style="background-color: cyan; color: #000;"<?php  } else{ $date1 = strtotime($row['woi_promanager_approve_date']); ?> style="background-color: teal; color: #fff;" <?php } ?>>
                        <?php 
                                    $date2 = strtotime(date("Y-m-d H:i:s"));
                                    $diff = abs($date2 - $date1);
                                    $years = floor($diff / (365*60*60*24));
                                    $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
                                    $days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
                                    $hours = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24 - $days*60*60*24) / (60*60));
                                    $minutes = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24 - $days*60*60*24 - $hours*60*60)/ 60);
                                    $seconds = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24 - $days*60*60*24  - $hours*60*60 - $minutes*60)); ?>
                                    <script type="text/javascript">
                                        var outid = "<?php echo $j; ?>";
                                        var input<?php echo $j; ?> = {
                                            year: "<?php echo $years; ?>",
                                            month: "<?php echo $months; ?>",
                                            day: "<?php echo $days; ?>",
                                            hours: "<?php echo $hours; ?>",
                                            minutes: "<?php echo $minutes; ?>",
                                            seconds: "<?php echo $seconds; ?>",
                                        };
                                        //console.log(input);
                                        var timestamp<?php echo $j; ?> = new Date(input<?php echo $j; ?>.year, input<?php echo $j; ?>.month, input<?php echo $j; ?>.day,
                                        input<?php echo $j; ?>.hours, input<?php echo $j; ?>.minutes, input<?php echo $j; ?>.seconds);
                                    </script>
                            <td><?php echo $id;?><br/><span style="color:#F00;font-weight: 600;" id="countdown<?php echo $j; ?>"></span></td>
                            <td><?php echo $row['wo_wo_no'];?></td>
                            <td><?php echo $row['wo_wo_date'];?></td>
                            <td><?php echo $row['wo_customer_name'];?></td>
                            <td><?php echo $row['woi_part_no']." ".$row['woi_itm_title']."<br/>DESC:".nl2br($row['woi_itm_desc'])."<br/>Comment:".nl2br($row['woi_comment'])."<br/>Remark:".nl2br($row['woi_itm_remark']); ?><br/>
                            <a title="View PDF" href="<?php echo base_url(); ?>uploads/woi_product_drawing/<?php echo $row['woi_product_drawing']; ?>" class="btn btn-sm btn-outline blue " target="_blank"><i class="fa fa-picture-o"></i></a>
                            </td>
                            <td><?php echo $row['woi_qty'];?></td>
                            <?php $aid = encrypt_decrypt('encrypt', $row['woi_id']); ?>
                            <td>
                                <?php if($row['woi_production_approve'] == '0') { ?>
                                <a href="<?php echo base_url(); ?>Dashboard_workorder_final/check_qty?wo_itemid=<?php echo $row['woi_id']; ?>&itemid=<?php echo $row['woi_item_id']; ?>&wo_id=<?php echo $row['woi_wo_id']; ?>" class="btn btn-success" title="Approve"><i class="fa fa-check"></i></a>
                                <a href="<?php echo base_url(); ?>Dashboard_workorder_final/edit_qty?wo_itemid=<?php echo $row['woi_id']; ?>&itemid=<?php echo $row['woi_item_id']; ?>&wo_id=<?php echo $row['woi_wo_id']; ?>" target="_BLANK" class="btn btn-danger" title="Edit Qty." ><i class="fa fa-pencil"></i></a>
                                 <a href="<?php echo base_url(); ?>Dashboard_workorder_final/add_production_itemdetails?wo_itemid=<?php echo $row['woi_id']; ?>&itemid=<?php echo $row['woi_item_id']; ?>&wo_id=<?php echo $row['woi_wo_id']; ?>&pro_status=done" class="btn btn-success"><i class="fa fa-pencil"></i>Add Weight & Drawing</a>
                            <?php } ?>
                            <?php if($row['woi_production_approve'] == '2') { ?>
                                <a href="<?php echo base_url(); ?>Dashboard_workorder_final/check_qty?wo_itemid=<?php echo $row['woi_id']; ?>&itemid=<?php echo $row['woi_item_id']; ?>&wo_id=<?php echo $row['woi_wo_id']; ?>&pro_status=done" class="btn btn-success" title="Approve"><i class="fa fa-check"></i></a>

                                <a href="<?php echo base_url(); ?>Dashboard_workorder_final/add_production_itemdetails?wo_itemid=<?php echo $row['woi_id']; ?>&itemid=<?php echo $row['woi_item_id']; ?>&wo_id=<?php echo $row['woi_wo_id']; ?>&pro_status=done" class="btn btn-success"><i class="fa fa-pencil"></i>Add Weight & Drawing</a>

                            <?php } ?>
                            <a href="<?php echo base_url(); ?>Dashboard_workorder_final/change_desciption?wo_itemid=<?php echo $row['woi_id']; ?>&itemid=<?php echo $row['woi_item_id']; ?>&wo_id=<?php echo $row['woi_wo_id']; ?>" target="_BLANK" class="btn btn-danger"><i class="fa fa-pencil"></i> Change Comment</a>
                            </td>
                        </tr>
                           <?php } } ?>
                        </tbody>
                    </table>


                            
                        </div>
                        </div>
                    </div>
                </div>
                <!-- END CONTENT BODY -->
            </div>
            </div>
            </div>
            </div>
            <!-- END CONTENT -->
        <!-- END CONTAINER -->
<!--[if lt IE 9]>
<script src="<?php echo base_url(); ?>assets/global/plugins/respond.min.js"></script>
<script src="<?php echo base_url(); ?>assets/global/plugins/excanvas.min.js"></script> 
<![endif]-->
        <!-- BEGIN CORE PLUGINS -->
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
        <script src="<?php echo base_url(); ?>assets/global/plugins/counterup/jquery.waypoints.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>assets/global/plugins/counterup/jquery.counterup.min.js" type="text/javascript"></script>
        <!-- END PAGE LEVEL PLUGINS -->
        <!-- BEGIN THEME GLOBAL SCRIPTS -->
        <script src="<?php echo base_url(); ?>assets/global/scripts/app.min.js" type="text/javascript"></script>
        <!-- END THEME GLOBAL SCRIPTS -->
        <!-- BEGIN PAGE LEVEL SCRIPTS -->
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
        <script type="text/javascript">
    function fsl(val)
    {
        if(val==1)
        {
            document.getElementById('stock_limit').style.display='block';
            document.getElementById('master_item_stock_limit').value="";

        }
        if(val==0)
        {
            document.getElementById('stock_limit').style.display="none";
        }
    }
</script>

<script type="text/javascript">
function DoTrim(strComp) {
            ltrim = /^\s+/
            rtrim = /\s+$/
            strComp = strComp.replace(ltrim, '');
            strComp = strComp.replace(rtrim, '');
            return strComp;
}

function isPositiveInteger(n) {
    return n >>> 0 === parseFloat(n);
}

function ValidateDetails()
{
    var fields;
    fields = "";
    document.getElementById('brand_name').className = 'form-control';
    $('#brand_name').parent().parent().removeClass('has-error');
    
    if (DoTrim(document.getElementById('brand_name').value).length == 0) {
        if(fields != 1){
        document.getElementById("brand_name").focus();
        }
        fields = '1';
        document.getElementById('brand_name').className = 'form-control error';
        if($('#brand_name').parent().parent().attr('class') == 'form-group')
        {
            $('#brand_name').parent().parent().addClass('has-error');
        }
        //return false;
    }
    
    
    if (fields != "") {
        fields = "Please fill in the following details:\n--------------------------------\n" + fields;
        
        return false;
    }
    else {
        return true;
    }    
}
</script>
<?php /* <script type="text/javascript">
    //var j = "<php echo $j; ?>";
    var interval = 1;

    setInterval(function () {
        <?php for (; $j >= 1; $j--) { ?>
            timestamp<?php echo $j; ?> = new Date(timestamp<?php echo $j; ?>.getTime() + interval * 1000);
        document.getElementById('countdown<?php echo $j; ?>').innerHTML = timestamp<?php echo $j; ?>.getDay() + ' Days ' + timestamp<?php echo $j; ?>.getHours() + ' Hour ' + timestamp<?php echo $j; ?>.getMinutes() + ' Min ' + timestamp<?php echo $j; ?>.getSeconds() + ' Sec ';
        <?php } ?>
    }, Math.abs(interval) * 1000);

</script> */ ?>
        <!-- END PAGE LEVEL SCRIPTS -->
        <?php //theme layout scripts ?>