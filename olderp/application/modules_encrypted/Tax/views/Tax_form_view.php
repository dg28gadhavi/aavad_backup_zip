<div class="container-fluid">
    <div class="page-content">
<!-- BEGIN BREADCRUMBS -->
        <div class="breadcrumbs">
            <h1>Tax Add</h1>
            <ol class="breadcrumb">
                <li><a href="<?php echo base_url(); ?>Dashboard">Dashboard</a></li>
                <li class="active"><a href="<?php echo base_url(); ?>Tax">Tax List</a></li>
                <li><a href="<?php echo base_url(); ?>Tax/add">Tax Add</a></li>
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
            <div class="col-md-12 col-xs-6">
                <div class="alert alert-danger">
                    <strong><?php echo $this->session->flashdata('error'); echo validation_errors();?></strong> 
                </div>
            </div>
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
                                <?php  $atr = array('class' => 'form-horizontal','autocomplate' => 'off');
                                 echo form_open_multipart($action,$atr); ?>
                            <div class="form-body">
                                <h3 class="form-section">Tax Name</h3>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group" id="mcna_namegr">
                                            <label class="control-label col-md-3">Tax Name</label>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control" placeholder="Tax Name for ex. VAT, CST etc" name="tax_name" maxlength="200" id="tax_name" value="<?php echo isset($list[0]['tax_name']) ? $list[0]['tax_name'] : ""; ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group" id="mcna_namegr">
                                            <label class="control-label col-md-3">Rate</label>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control" placeholder="Rate" name="tax_amount" maxlength="11" id="tax_amount" value="<?php echo isset($list[0]['tax_amount']) ? $list[0]['tax_amount'] : ""; ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group" id="mcna_namegr">
                                            <label class="control-label col-md-3">Rate Unit</label>
                                            <div class="col-md-9">
                                                <select class="form-control" name="tax_informat" id="tax_informat">
                                                    <option value="1" <?php if(isset($list) && isset($list[0]['tax_informat']) && ($list[0]['tax_informat'] == 1)){ ?> selected <?php } ?>>%</option>
                                                    <option value="2" <?php if(isset($list) && isset($list[0]['tax_informat']) && ($list[0]['tax_informat'] == 2)){ ?> selected <?php } ?>>Direct Amount</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group" id="mcna_namegr">
                                            <label class="control-label col-md-3">Used for <br/><small> automatically added this tax to specific module final amount</small></label>
                                            <div class="col-md-9">
                                                <select class="form-control" name="tax_usedfor" id="tax_usedfor">
                                                    <option value="1" <?php if(isset($list) && isset($list[0]['tax_usedfor']) && ($list[0]['tax_usedfor'] == 1)){ ?> selected <?php } ?>>Purchase</option>
                                                    <option value="2" <?php if(isset($list) && isset($list[0]['tax_usedfor']) && ($list[0]['tax_usedfor'] == 2)){ ?> selected <?php } ?>>Sale</option>
                                                    <option value="3" <?php if(isset($list) && isset($list[0]['tax_usedfor']) && ($list[0]['tax_usedfor'] == 3)){ ?> selected <?php } ?>>Both</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                              <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group" id="master_party_taxgr">
                                            <label class="control-label col-md-3">Tax Category</label>
                                            <div class="col-md-9">
                                                <select name="master_party_tax" id="master_party_tax" class="form-control"  required="required">
                                                    <option value="">Select Tax Category</option>
                                                    <?php foreach($tax_cat as $taxcat)
                                                    { ?>
                                                        <option value="<?php echo $taxcat['tax_cat_id']; ?>" <?php if(isset($list[0]['master_party_tax']) && ($list[0]['master_party_tax'] == $taxcat['tax_cat_id'])){ echo "selected='selected'";} ?>>
                                                            <?php
                                                                echo $taxcat['tax_cat_name']; 
                                                            ?></option>
                                                    <?php }?>
                                                        
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
    document.getElementById('tax_name').className = 'form-control';
    $('#tax_name').parent().parent().removeClass('has-error');
    
    if (DoTrim(document.getElementById('tax_name').value).length == 0) {
        if(fields != 1){
        document.getElementById("tax_name").focus();
        }
        fields = '1';
        document.getElementById('tax_name').className = 'form-control error';
        if($('#tax_name').parent().parent().attr('class') == 'form-group')
        {
            $('#tax_name').parent().parent().addClass('has-error');
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