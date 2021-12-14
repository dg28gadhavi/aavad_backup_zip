<?php //echo "<pre>";print_r($work_orders);die; ?>
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
                        <div class="col-md-12">
                        <div class="portlet box">
                        <div class="portlet-body form">

                            <table class="table table-striped table-bordered dt-responsive" width="100%" id="sample_1">
                        <thead>
                            <tr>
                                <th  width="2%">Sr.No</th>
                                <th  width="2%">Wo.No</th>
                                <th  width="2%">Wo.Date</th>
                                <th  width="2%">Customer Name</th>
                                <th  width="2%">Item Description</th>
                                <th  width="2%">Qty</th>
                                <th  width="2%">Action</th>
                            </tr>
                        </thead>
                            <tbody>
                        <?php $id = 0;
                         if(isset($work_orders)) { 
                         foreach($work_orders as $row){ $id++; ?>

                        <tr <?php if($row['woi_store_approve'] == 1){ ?> style="background-color: cyan; color: #000;"<?php  } else{ ?> style="background-color: teal; color: #fff;" <?php } ?>>
                            <td><?php echo $id;?></td>
                            <td><?php echo $row['wo_wo_no'];?></td>
                            <td><?php echo $row['wo_wo_date'];?></td>
                            <td><?php echo $row['wo_customer_name'];?></td>
                            <td><?php echo $row['woi_part_no']." ".$row['woi_itm_title']."<br/>DESC:".$row['woi_itm_desc']."<br/>Comment:".$row['woi_comment']."<br/>Remark:".$row['woi_itm_remark']; ?></td>
                            <td><?php echo $row['woi_qty'];?></td>
                            <?php $aid = encrypt_decrypt('encrypt', $row['woi_id']); ?>
                            <td>
                                <?php if($row['woi_production_approve'] == '0') { ?>
                                <a href="<?php echo base_url(); ?>Dashboard_workorder_final/check_qty?wo_itemid=<?php echo $row['woi_id']; ?>&itemid=<?php echo $row['woi_item_id']; ?>&wo_id=<?php echo $row['woi_wo_id']; ?>" class="btn btn-success"><i class="fa fa-check"></i></a>
                                <?php /* <a href="<?php echo base_url(); ?>Dashboard_workorder_final/edit_qty?wo_itemid=<?php echo $row['woi_id']; ?>&itemid=<?php echo $row['woi_item_id']; ?>&wo_id=<?php echo $row['woi_wo_id']; ?>" target="_BLANK" class="btn btn-danger" ><i class="fa fa-pencil"></i></a> */ ?>
                            <?php } ?>
                            <?php if($row['woi_production_approve'] == '2') { ?>
                                <a href="<?php echo base_url(); ?>Dashboard_workorder_final/check_qty?wo_itemid=<?php echo $row['woi_id']; ?>&itemid=<?php echo $row['woi_item_id']; ?>&wo_id=<?php echo $row['woi_wo_id']; ?>&pro_status=done" class="btn btn-success"><i class="fa fa-check"></i></a>
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
        <!-- END PAGE LEVEL SCRIPTS -->
        <?php //theme layout scripts ?>