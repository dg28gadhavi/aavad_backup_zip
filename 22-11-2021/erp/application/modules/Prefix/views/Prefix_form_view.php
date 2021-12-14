<div class="container-fluid">
                <div class="page-content">
<!-- BEGIN BREADCRUMBS -->
                    <div class="breadcrumbs">
                        <h1>Prefix Edit</h1>
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
                    <!-- BEGIN PAGE HEADER-->
                    <div class="page-content-col">
                    <div class="row">
                        <div class="col-md-12">
                        <div class="portlet box">
                            <div class="portlet-body form">
                                <?php  $atr = array('class' => 'form-horizontal');
                                 echo form_open_multipart($action,$atr); ?>
                            <div class="form-body">
                            	<div class="row">
                                	<div class="col-md-6">
                                        <div class="form-group" id="mcna_namegr">
                                            <label class="control-label col-md-3">Enquiry Prefix</label>
                                            <div class="col-md-6">
                                                <input type="text" class="form-control" name="pre_enquiry" placeholder="ENQ/SllPL/17-18/" maxlength="200" id="pre_enquiry" value="<?php echo isset($list[0]['pre_enquiry']) ? $list[0]['pre_enquiry'] : ""; ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group" id="mcna_namegr">
                                            <label class="control-label col-md-3">Quotation Prefix</label>
                                            <div class="col-md-6">
                                                <input type="text" class="form-control" name="pre_quotation" maxlength="200" id="pre_quotation" value="<?php echo isset($list[0]['pre_quotation']) ? $list[0]['pre_quotation'] : ""; ?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group" id="mcna_namegr">
                                            <label class="control-label col-md-3">PO Prefix</label>
                                            <div class="col-md-6">
                                                <input type="text" class="form-control" name="pre_po" maxlength="200" id="pre_po" value="<?php echo isset($list[0]['pre_po']) ? $list[0]['pre_po'] : ""; ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group" id="mcna_namegr">
                                            <label class="control-label col-md-3">Invoice Prefix</label>
                                            <div class="col-md-6">
                                                <input type="text" class="form-control" name="pre_invoice" maxlength="200" id="pre_invoice" value="<?php echo isset($list[0]['pre_invoice']) ? $list[0]['pre_invoice'] : ""; ?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group" id="mcna_namegr">
                                            <label class="control-label col-md-3">GRN Prefix</label>
                                            <div class="col-md-6">
                                                <input type="text" class="form-control" name="pre_grn" maxlength="200" id="pre_grn" value="<?php echo isset($list[0]['pre_grn']) ? $list[0]['pre_grn'] : ""; ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group" id="mcna_namegr">
                                            <label class="control-label col-md-3">Vendor Prefix </label>
                                            <div class="col-md-6">
                                                <input type="text" class="form-control" name="pre_vendor" maxlength="200" id="pre_vendor" value="<?php echo isset($list[0]['pre_vendor']) ? $list[0]['pre_vendor'] : ""; ?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group" id="mcna_namegr">
                                            <label class="control-label col-md-3">D.C Prefix</label>
                                            <div class="col-md-6">
                                                <input type="text" class="form-control" name="pre_dc" maxlength="200" id="pre_dc" value="<?php echo isset($list[0]['pre_dc']) ? $list[0]['pre_dc'] : ""; ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group" id="mcna_namegr">
                                            <label class="control-label col-md-3">Job Card Prefix</label>
                                            <div class="col-md-6">
                                                <input type="text" class="form-control" name="pre_job_card" maxlength="200" id="pre_job_card" value="<?php echo isset($list[0]['pre_job_card']) ? $list[0]['pre_job_card'] : ""; ?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group" id="mcna_namegr">
                                            <label class="control-label col-md-3">OA Prefix</label>
                                            <div class="col-md-6">
                                                <input type="text" class="form-control" name="pre_oa" maxlength="200" id="pre_oa" value="<?php echo isset($list[0]['pre_oa']) ? $list[0]['pre_oa'] : ""; ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group" id="mcna_namegr">
                                            <label class="control-label col-md-3">Issue Voucher Prefix</label>
                                            <div class="col-md-6">
                                                <input type="text" class="form-control" name="pre_issue_voucher" maxlength="200" id="pre_issue_voucher" value="<?php echo isset($list[0]['pre_issue_voucher']) ? $list[0]['pre_issue_voucher'] : ""; ?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                     <div class="col-md-6">
                                        <div class="form-group" id="mcna_namegr">
                                            <label class="control-label col-md-3">P.I Prefix</label>
                                            <div class="col-md-6">
                                                <input type="text" class="form-control" name="pre_pi" maxlength="200" id="pre_pi" value="<?php echo isset($list[0]['pre_pi']) ? $list[0]['pre_pi'] : ""; ?>">
                                            </div>
                                        </div>
                                    </div>
                                     <div class="col-md-6">
                                        <div class="form-group" id="mcna_namegr">
                                            <label class="control-label col-md-3">Tax Invoice Prefix</label>
                                            <div class="col-md-6">
                                                <input type="text" class="form-control" name="pre_tax_invoice" maxlength="200" id="pre_tax_invoice" value="<?php echo isset($list[0]['pre_tax_invoice']) ? $list[0]['pre_tax_invoice'] : ""; ?>">
                                            </div>
                                        </div>
                                    </div>


                                    <div class="col-md-6">
                                        <div class="form-group" id="mcna_namegr">
                                            <label class="control-label col-md-3">Party Code Prefix</label>
                                            <div class="col-md-6">
                                                <input type="text" class="form-control" name="pre_party_code" maxlength="200" id="pre_party_code" value="<?php echo isset($list[0]['pre_party_code']) ? $list[0]['pre_party_code'] : ""; ?>">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group" id="mcna_namegr">
                                            <label class="control-label col-md-3">Item Code Prefix</label>
                                            <div class="col-md-6">
                                                <input type="text" class="form-control" name="pre_item_code" maxlength="200" id="pre_item_code" value="<?php echo isset($list[0]['pre_item_code']) ? $list[0]['pre_item_code'] : ""; ?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <div class="form-actions">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-md-offset-3 col-md-9">
                                                <button type="submit" class="btn green" onclick="return ValidateDetails()" ><?php echo $this->input->get('id')?'UPDATE':'SUBMIT'; ?></button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6"> </div>
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
    document.getElementById('prefix_name').className = 'form-control';
    $('#prefix_name').parent().parent().removeClass('has-error');
    
    if (DoTrim(document.getElementById('prefix_name').value).length == 0) {
        if(fields != 1){
        document.getElementById("prefix_name").focus();
        }
        fields = '1';
        document.getElementById('prefix_name').className = 'form-control error';
        if($('#prefix_name').parent().parent().attr('class') == 'form-group')
        {
            $('#prefix_name').parent().parent().addClass('has-error');
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