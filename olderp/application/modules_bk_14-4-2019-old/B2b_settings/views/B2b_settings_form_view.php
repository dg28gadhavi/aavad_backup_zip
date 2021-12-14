<?php //echo "<pre>";print_r($list);die; ?>
<link href="<?php echo base_url(); ?>assets/global/plugins/bootstrap-multiselect/css/bootstrap-multiselect.css" rel="stylesheet" type="text/css" />
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN THEME GLOBAL STYLES -->
<link href="<?php echo base_url(); ?>assets/global/css/components.min.css" rel="stylesheet" id="style_components" type="text/css" />
<link href="<?php echo base_url(); ?>assets/global/css/plugins.min.css" rel="stylesheet" type="text/css" />

<div class="container-fluid">
<div class="page-content">
<!-- BEGIN BREADCRUMBS -->
<div class="breadcrumbs">
    <h1>B2B Settings Add</h1>
    <ol class="breadcrumb">
        <li>
            <a href="<?php echo base_url(); ?>Dashboard">Dashboard</a>
        </li>
       <!--  <li class="active">
            <a href="<?php echo base_url(); ?>B2b_settings">B2b_settings List</a>
        </li> -->
        
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
                        <div class="portlet light bordered box">
                            <div class="portlet-body form">
                                <?php  $atr = array('class' => 'form-horizontal');
                                 echo form_open_multipart($action,$atr); ?>
                            <div class="form-body">
                                <h3 class="form-section">B2B Settings India Mart</h3>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group" id="mcna_namegr">
                                            <label class="control-label col-md-3"> Mobile Number </label>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control" placeholder="Mobile Number" name="b2b_ind_mob_no" maxlength="200" id="b2b_ind_mob_no" value="<?php echo isset($list[0]['b2b_ind_mob_no']) ? $list[0]['b2b_ind_mob_no'] : ""; ?>" >
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group" id="mcna_namegr">
                                            <label class="control-label col-md-3"> Mobile Key </label>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control" placeholder="Mobile Key" name="b2b_ind_mob_key" maxlength="200" id="b2b_ind_mob_key" value="<?php echo isset($list[0]['b2b_ind_mob_key']) ? $list[0]['b2b_ind_mob_key'] : ""; ?>" >
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <h3 class="form-section">B2B Settings Trade India</h3>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group" id="mcna_namegr">
                                            <label class="control-label col-md-3"> User ID </label>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control" placeholder="User Id" name="b2b_trad_uid" maxlength="200" id="b2b_trad_uid" value="<?php echo isset($list[0]['b2b_trad_uid']) ? $list[0]['b2b_trad_uid'] : ""; ?>" >
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group" id="mcna_namegr">
                                            <label class="control-label col-md-3"> Profile ID </label>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control" placeholder="Profile Id" name="b2b_trad_pid" maxlength="200" id="b2b_trad_pid" value="<?php echo isset($list[0]['b2b_trad_pid']) ? $list[0]['b2b_trad_pid'] : ""; ?>" >
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group" id="mcna_namegr">
                                            <label class="control-label col-md-3"> Key </label>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control" placeholder="Key" name="b2b_trad_key" maxlength="200" id="b2b_trad_key" value="<?php echo isset($list[0]['b2b_trad_key']) ? $list[0]['b2b_trad_key'] : ""; ?>" >
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
        <script src="<?php echo base_url(); ?>assets/global/plugins/bootstrap-multiselect/js/bootstrap-multiselect.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>assets/pages/scripts/components-bootstrap-multiselect.min.js" type="text/javascript"></script>
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
    document.getElementById('B2b_settings_name').className = 'form-control';
    $('#B2b_settings_name').parent().parent().removeClass('has-error');
    
    if (DoTrim(document.getElementById('B2b_settings_name').value).length == 0) {
        if(fields != 1){
        document.getElementById("B2b_settings_name").focus();
        }
        fields = '1';
        document.getElementById('B2b_settings_name').className = 'form-control error';
        if($('#B2b_settings_name').parent().parent().attr('class') == 'form-group')
        {
            $('#B2b_settings_name').parent().parent().addClass('has-error');
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