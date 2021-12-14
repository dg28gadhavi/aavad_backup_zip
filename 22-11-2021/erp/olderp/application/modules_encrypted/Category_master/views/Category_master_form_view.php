<div class="container-fluid">
<div class="page-content">
<!-- BEGIN BREADCRUMBS -->
<div class="breadcrumbs">
    <h1>Category_master Add</h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>Dashboard">Dashboard</a></li>
        <li class="active"><a href="<?php echo base_url(); ?>Category_master">Category_master List</a></li>
        <li><a href="<?php echo base_url(); ?>Category_master/add">Category_master Add</a></li>
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
                    <h3 class="form-section">Category_master Name</h3>
                    <div class="row">
                     <div class="col-md-6">
                        <div class="form-group" id="mcna_namegr">
                            <label class="control-label col-md-3">Product Head Name</label>
                            <div class="col-md-9">
                                
                                <select name="cat_phid" id="cat_phid" tabindex="5" class="bs-select form-control country_change" data-live-search="true" data-size="8">
                                    <option value="">Select</option>
                                    <?php foreach($plist as $plists)
                                    { ?>
                                        <option value="<?php echo $plists['ph_id']; ?>" <?php if(isset($list[0]['cat_phid']) && ($list[0]['cat_phid'] == $plists['ph_id'])){ echo "selected='selected'";} ?>><?php echo $plists['ph_name']; ?></option>
                                    <?php }?>
                                </select>
                            </div>
                        </div>
                     </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group" id="mcna_namegr">
                                <label class="control-label col-md-3">Category_master Name</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" placeholder="Category_master Name" name="cat_name" maxlength="200" id="cat_name" value="<?php echo isset($list[0]['cat_name']) ? $list[0]['cat_name'] : ""; ?>" >
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
    document.getElementById('Category_master_name').className = 'form-control';
    $('#Category_master_name').parent().parent().removeClass('has-error');
    
    if (DoTrim(document.getElementById('Category_master_name').value).length == 0) {
        if(fields != 1){
        document.getElementById("Category_master_name").focus();
        }
        fields = '1';
        document.getElementById('Category_master_name').className = 'form-control error';
        if($('#Category_master_name').parent().parent().attr('class') == 'form-group')
        {
            $('#Category_master_name').parent().parent().addClass('has-error');
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