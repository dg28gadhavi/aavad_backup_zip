        <!-- BEGIN PAGE LEVEL PLUGINS -->
        <link href="<?php echo base_url(); ?>assets/global/plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" type="text/css" />
        <!-- END PAGE LEVEL PLUGINS -->
<div class="container-fluid">
                <div class="page-content">
<!-- BEGIN BREADCRUMBS -->
                    <div class="breadcrumbs">
                        <h1>Company Add</h1>
                        <ol class="breadcrumb">
                            <li>
                                <a href="<?php echo base_url(); ?>Dashboard">Dashboard</a>
                            </li>
                            <li class="active">
                                <a href="<?php echo base_url(); ?>Company">Company List</a>
                            </li>
                            <li>
                                <a href="<?php echo base_url(); ?>Company/add">Company Add</a>
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
                                <?php  $atr = array('class' => 'form-horizontal');
                                 echo form_open_multipart($action,$atr); ?>
                            <div class="form-body">
                                <h3 class="form-section">Company Name</h3>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group" id="mcna_namegr">
                                            <label class="control-label col-md-3">Name of the Institution</label>
                                            <div class="col-md-9">
                                                <select name="co_inst" id="co_inst" class="bs-select form-control" data-live-search="true" data-size="8">
                                                    <option></option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group" id="mcna_namegr">
                                            <label class="control-label col-md-3">Area of Study</label>
                                            <div class="col-md-9">
                                                <select name="co_study" id="co_study" class="bs-select form-control" data-live-search="true" data-size="8">
                                                    <option></option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group" id="mcna_namegr">
                                            <label class="control-label col-md-3">Degree</label>
                                            <div class="col-md-9">
                                                <select name="co_degree" id="co_degree" class="bs-select form-control" data-live-search="true" data-size="8">
                                                    <option></option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group" id="mcna_namegr">
                                            <label class="control-label col-md-3">Name of the course</label>
                                            <div class="col-md-9">
                                                <select name="co_course" id="co_course" class="bs-select form-control" data-live-search="true" data-size="8">
                                                    <option></option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                <div class="col-md-6">
                                        <div class="form-group" id="mcna_namegr">
                                            <label class="control-label col-md-3">Duration</label>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control" placeholder="Duration" name="co_duration" maxlength="200" id="co_duration" value="<?php echo isset($list[0]['co_duration']) ? $list[0]['co_duration'] : ""; ?>" >
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group" id="mcna_namegr">
                                            <label class="control-label col-md-3">Intakes</label>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control" placeholder="Intakes" name="co_intakes" maxlength="200" id="co_intakes" value="<?php echo isset($list[0]['co_intakes']) ? $list[0]['co_intakes'] : ""; ?>" >
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group" id="mcna_namegr">
                                            <label class="control-label col-md-3">Campus</label>
                                            <div class="col-md-9">
                                                <select name="co_campus" id="co_campus" class="bs-select form-control" data-live-search="true" data-size="8">
                                                    <option></option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group" id="mcna_namegr">
                                            <label class="control-label col-md-3">Fees in AUD $</label>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control" placeholder="Fees" name="co_fees" maxlength="200" id="co_fees" value="<?php echo isset($list[0]['co_fees']) ? $list[0]['co_fees'] : ""; ?>" >
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group" id="mcna_namegr">
                                            <label class="control-label col-md-3">Entry Criteria</label>
                                            <div class="col-md-9">
                                                <textarea name="co_criteria" id="co_criteria" class="form-control" rows="3"><?php echo isset($list[0]['co_criteria']) ? $list[0]['co_criteria'] : ""; ?></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group" id="mcna_namegr">
                                            <label class="control-label col-md-3">Link</label>
                                            <div class="col-md-9">
                                                <textarea name="co_link" class="form-control" rows="3" id="co_link"><?php echo isset($list[0]['co_link']) ? $list[0]['co_link'] : ""; ?></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group" id="mcna_namegr">
                                            <label class="control-label col-md-3">website</label>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control" placeholder="website" name="co_website" maxlength="200" id="co_website" value="<?php echo isset($list[0]['co_website']) ? $list[0]['co_website'] : ""; ?>" >
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group" id="mcna_namegr">
                                            <label class="control-label col-md-3">Specializations Available</label>
                                            <div class="col-md-9">
                                                <textarea name="co_speci" class="form-control" rows="3" id="co_speci"><?php echo isset($list[0]['co_speci']) ? $list[0]['co_speci'] : ""; ?></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group" id="mcna_namegr">
                                            <label class="control-label col-md-3">IELTS</label>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control" placeholder="IELTS" name="co_ielts" maxlength="200" id="co_ielts" value="<?php echo isset($list[0]['co_ielts']) ? $list[0]['co_ielts'] : ""; ?>" >
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group" id="mcna_namegr">
                                            <label class="control-label col-md-3">PTE</label>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control" placeholder="PTE" name="co_pte" maxlength="200" id="co_pte" value="<?php echo isset($list[0]['co_pte']) ? $list[0]['co_pte'] : ""; ?>" >
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group" id="mcna_namegr">
                                            <label class="control-label col-md-3">TOEFL</label>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control" placeholder="TOEFL" name="co_toefl" maxlength="200" id="co_toefl" value="<?php echo isset($list[0]['co_toefl']) ? $list[0]['co_toefl'] : ""; ?>" >
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                                <label class="col-md-3 control-label">Scholarship Available?</label>
                                                <div class="col-md-9">
                                                    <div class="mt-radio-inline">
                                                        <label class="mt-radio">
                                                            <input name="co_scho_avail" id="optionsRadios25" value="1" tabindex="7" checked="" type="radio"> Yes
                                                            <span></span>
                                                        </label>
                                                        <label class="mt-radio">
                                                            <input name="co_scho_avail" id="optionsRadios26" value="2" tabindex="8" type="radio"> No
                                                            <span></span>
                                                        </label>
                                                    </div>
                                                </div>
                                        </div>
                                    </div>
                                    
                                </div>
                            <div class="row">
                                <div class="col-md-6">
                                        <div class="form-group" id="mcna_namegr">
                                            <label class="control-label col-md-3">Work Experience</label>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control" placeholder="Work Experience" name="co_work_exp" maxlength="200" id="co_work_exp" value="<?php echo isset($list[0]['co_work_exp']) ? $list[0]['co_work_exp'] : ""; ?>" >
                                            </div>
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
        <!-- BEGIN PAGE LEVEL PLUGINS -->
        <script src="<?php echo base_url(); ?>assets/global/plugins/bootstrap-select/js/bootstrap-select.min.js" type="text/javascript"></script>
        <!-- END PAGE LEVEL PLUGINS -->
        <!-- END CORE PLUGINS -->
        <!-- BEGIN PAGE LEVEL PLUGINS -->
        <!-- END PAGE LEVEL PLUGINS -->
        <!-- BEGIN THEME GLOBAL SCRIPTS -->
        <script src="<?php echo base_url(); ?>assets/global/scripts/app.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>assets/pages/scripts/components-bootstrap-select.min.js" type="text/javascript"></script>
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
    document.getElementById('country_name').className = 'form-control';
    $('#country_name').parent().parent().removeClass('has-error');
    
    if (DoTrim(document.getElementById('country_name').value).length == 0) {
        if(fields != 1){
        document.getElementById("country_name").focus();
        }
        fields = '1';
        document.getElementById('country_name').className = 'form-control error';
        if($('#country_name').parent().parent().attr('class') == 'form-group')
        {
            $('#country_name').parent().parent().addClass('has-error');
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