<?php //echo "<pre>";print_r($work_orders);die; ?>
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
                        <h1>Store User For WO</h1>
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
                            <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
                                <div class="dashboard-stat2 bordered sales-dashbg">
                                    <div class="display">
                                        <div class="number">
                                            <h3 class="font-green-sharp">
                                                <span data-counter="counterup" data-value="<?php echo isset($store_count['total_store_pending']['count']) ? number_format($store_count['total_store_pending']['count']) : 0;?>"></span>
                                                <small class="font-green-sharp"></small>
                                            </h3>
                                            <a href="#"><small>PENDING</small></a>
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
                                                <span data-counter="counterup" data-value="<?php echo isset($store_count['total_store_approved']['count']) ? number_format($store_count['total_store_approved']['count']) : 0;?>"></span>
                                                <small class="font-green-sharp"></small>
                                            </h3>
                                            <a href="#"><small>Approved</small></a>
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
                                                <span data-counter="counterup" data-value="<?php echo isset($store_count['today_store_approved']['count']) ? number_format($store_count['today_store_approved']['count']) : 0;?>"></span>
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
                                                <span data-counter="counterup" data-value="<?php echo isset($store_count['yesterday_store_approved']['count']) ? number_format($store_count['yesterday_store_approved']['count']) : 0;?>"></span>
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
                                                <span data-counter="counterup" data-value="<?php echo isset($store_count['this_month_store_approved']['count']) ? number_format($store_count['this_month_store_approved']['count']) : 0;?>"></span>
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
                                                <span data-counter="counterup" data-value="<?php echo isset($store_count['last_month_store_approved']['count']) ? number_format($store_count['last_month_store_approved']['count']) : 0;?>"></span>
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
                                                <span data-counter="counterup" data-value="<?php echo isset($store_count['this_year_store_approved']['count']) ? number_format($store_count['this_year_store_approved']['count']) : 0;?>"></span>
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
                    <div class="row">
                        <div class="col-md-12">
                        <div class="portlet box">
                        <div class="portlet-body form">

                            <table class="table table-striped table-bordered table-hover dt-responsive" width="100%" id="sample_1">
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
                            <?php $date1 = strtotime($row['woi_production_approve_date']);
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
                        <tr>
                            <td><?php echo $id;?><br/><span style="color:#F00;font-weight: 600;" id="countdown<?php echo $j; ?>"></span></td>
                            <td><?php echo $row['wo_wo_no'];?></td>
                            <td><?php echo $row['wo_wo_date'];?></td>
                            <td><?php echo $row['wo_customer_name'];?></td>
                            <td><?php echo $row['woi_part_no']." ".$row['woi_itm_title']."<br/>DESC: ".$row['woi_itm_desc']."<br/>Comment: ".$row['woi_comment']."<br/>Remark: ".$row['woi_itm_remark']; ?></td>
                            <td><?php echo $row['woi_qty'];?></td>
                            <?php $aid = encrypt_decrypt('encrypt', $row['woi_id']); ?>
                            <td>
                                <?php if($row['woi_store_approve'] == '0') { ?>
                                <a href="<?php echo base_url(); ?>Dashboard_workorder_final/check_qty?wo_itemid=<?php echo $row['woi_id']; ?>&itemid=<?php echo $row['woi_item_id']; ?>&wo_id=<?php echo $row['woi_wo_id']; ?>" class="btn btn-success"><i class="fa fa-check"></i></a>
                                <?php /* <a href="<?php echo base_url(); ?>Dashboard_workorder_final/edit_qty?wo_itemid=<?php echo $row['woi_id']; ?>&itemid=<?php echo $row['woi_item_id']; ?>&wo_id=<?php echo $row['woi_wo_id']; ?>" target="_BLANK" class="btn btn-danger" ><i class="fa fa-pencil"></i></a> */ ?>
                            <?php } ?>
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